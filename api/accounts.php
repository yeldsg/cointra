<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';
require_once 'activity_logger.php';

// Set response headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    // Get database connection and user info
    $pdo = getDBConnection();
    $userId = getCurrentUserId();
    
    // Check if user is logged in
    if (!$userId) {
        sendError('Authentication required', 401);
    }
    
    switch ($method) {
        case 'GET':
            // GET: Retrieve all accounts for the user
            $stmt = $pdo->prepare("
                SELECT id, name, icon, balance 
                FROM accounts 
                WHERE user_id = ? 
                ORDER BY id DESC
            ");
            $stmt->execute([$userId]);
            $accounts = $stmt->fetchAll();
            
            // Format accounts for response
            $formatted = [];
            foreach ($accounts as $row) {
                $formatted[] = [
                    'id' => (int)$row['id'],
                    'name' => $row['name'],
                    'icon' => $row['icon'] ? $row['icon'] : 'account_balance',
                    'value' => (float)$row['balance']
                ];
            }
            
            sendSuccess('Accounts retrieved', $formatted);
            break;
            
        case 'POST':
            // POST: Create a new account
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Get account data from request
            $name = trim($data['name'] ?? '');
            $icon = $data['icon'] ?? 'account_balance';
            $balance = isset($data['value']) ? (float)$data['value'] : 0.00;
            
            // Validate required fields
            if (empty($name)) {
                sendError('Account name is required', 400);
            }
            
            // Insert account into database
            $stmt = $pdo->prepare("
                INSERT INTO accounts (user_id, name, icon, balance) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$userId, $name, $icon, $balance]);
            
            $accountId = (int)$pdo->lastInsertId();
            
            // Prepare response data
            $payload = [
                'id' => $accountId,
                'name' => $name,
                'icon' => $icon,
                'value' => (float)$balance
            ];
            
            // Log the activity
            logActivity($pdo, $userId, 'account', 'CREATE', $payload);
            
            sendSuccess('Account created', $payload, 201);
            break;
            
        case 'PUT':
            // PUT: Update an existing account
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$id) {
                sendError('Account ID required', 400);
            }
            
            // Get account data from request
            $name = trim($data['name'] ?? '');
            $icon = $data['icon'] ?? 'account_balance';
            $balance = isset($data['value']) ? (float)$data['value'] : 0.00;
            
            // Validate required fields
            if (empty($name)) {
                sendError('Account name is required', 400);
            }
            
            // Update account in database
            $stmt = $pdo->prepare("
                UPDATE accounts 
                SET name = ?, icon = ?, balance = ? 
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$name, $icon, $balance, $id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Account not found', 404);
            }
            
            // Prepare response data
            $payload = [
                'id' => $id,
                'name' => $name,
                'icon' => $icon,
                'value' => (float)$balance
            ];
            
            // Log the activity
            logActivity($pdo, $userId, 'account', 'UPDATE', $payload);
            
            sendSuccess('Account updated', $payload);
            break;
            
        case 'DELETE':
            // DELETE: Remove an account
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                sendError('Account ID required', 400);
            }
            
            // Get account details before deleting (for logging)
            $stmt = $pdo->prepare("SELECT name FROM accounts WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            $account = $stmt->fetch();
            
            if (!$account) {
                sendError('Account not found', 404);
            }
            
            // Delete account from database
            $stmt = $pdo->prepare("DELETE FROM accounts WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Account not found', 404);
            }
            
            // Log the activity
            logActivity($pdo, $userId, 'account', 'DELETE', ['name' => $account['name']]);
            
            sendSuccess('Account deleted');
            break;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in accounts.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in accounts.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
