<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';
require_once 'activity_logger.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$pdo = getDBConnection();
$userId = getCurrentUserId();

if (!$userId) {
    sendError('Authentication required', 401);
}

try {
    switch ($method) {
        case 'GET':
            $categoryId = null;
            if (isset($_GET['id'])) {
                $categoryId = (int)$_GET['id'];
            }
            $typeFilter = null;
            if (isset($_GET['type'])) {
                $typeFilter = $_GET['type'];
            }
            $budgetIdFilter = null;
            if (isset($_GET['budget_id'])) {
                $budgetIdFilter = (int)$_GET['budget_id'];
            }
            
            if ($categoryId) {
                $stmt = $pdo->prepare("SELECT id, name, type, icon, budget_id FROM categories WHERE id = ? AND user_id = ? LIMIT 1");
                $stmt->execute(array($categoryId, $userId));
                $category = $stmt->fetch();
                
                if (!$category) {
                    sendError('Category not found', 404);
                }
                
                $formatted = array(
                    'id' => (int)$category['id'],
                    'name' => $category['name'],
                    'type' => $category['type'],
                    'icon' => isset($category['icon']) ? $category['icon'] : 'category',
                    'budget_id' => $category['budget_id'] ? (int)$category['budget_id'] : null
                );
                
                sendSuccess('Category retrieved', $formatted);
                break;
            }
            
            $sql = "SELECT id, name, type, icon, budget_id FROM categories WHERE user_id = ?";
            $params = array($userId);
            
            if ($typeFilter && in_array($typeFilter, array('Income', 'Expense'))) {
                $sql .= " AND type = ?";
                $params[] = $typeFilter;
            }
            
            if ($budgetIdFilter) {
                $sql .= " AND budget_id = ?";
                $params[] = $budgetIdFilter;
            }
            
            $sql .= " ORDER BY id DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $categories = $stmt->fetchAll();
            
            $formatted = array();
            foreach ($categories as $row) {
                $formatted[] = array(
                    'id' => (int)$row['id'],
                    'name' => $row['name'],
                    'type' => $row['type'],
                    'icon' => $row['icon'] ? $row['icon'] : 'category',
                    'budget_id' => $row['budget_id'] ? (int)$row['budget_id'] : null
                );
            }
            
            sendSuccess('Categories retrieved', $formatted);
            break;
            
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $name = '';
            if (isset($data['name'])) {
                $name = trim($data['name']);
            }
            $type = '';
            if (isset($data['type'])) {
                $type = $data['type'];
            }
            $icon = 'category';
            if (isset($data['icon'])) {
                $icon = $data['icon'];
            }
            $budgetId = null;
            if (isset($data['budget_id'])) {
                $budgetId = (int)$data['budget_id'];
            }
            
            if (empty($name) || !in_array($type, array('Income', 'Expense'))) {
                sendError('Invalid category data', 400);
            }
            
            if ($budgetId !== null) {
                if ($type !== 'Expense') {
                    sendError('Only Expense categories can be linked to budgets', 400);
                }
                
                $stmt = $pdo->prepare("SELECT id FROM budgets WHERE id = ? AND user_id = ?");
                $stmt->execute(array($budgetId, $userId));
                if (!$stmt->fetch()) {
                    sendError('Invalid budget', 400);
                }
            }
            
            $stmt = $pdo->prepare("SELECT id FROM categories WHERE user_id = ? AND name = ? AND type = ? LIMIT 1");
            $stmt->execute(array($userId, $name, $type));
            if ($stmt->fetch()) {
                sendError('Category already exists', 409);
            }
            
            $stmt = $pdo->prepare("INSERT INTO categories (user_id, name, type, icon, budget_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(array($userId, $name, $type, $icon, $budgetId));
            
            $categoryId = (int)$pdo->lastInsertId();
            
            $payload = array(
                'id' => $categoryId,
                'name' => $name,
                'type' => $type,
                'icon' => $icon,
                'budget_id' => $budgetId
            );
            
            logActivity($pdo, $userId, 'category', 'CREATE', $payload);
            
            sendSuccess('Category created', $payload, 201);
            break;
            
        case 'PUT':
            // PUT: Update an existing category
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$id) {
                sendError('Category ID required', 400);
            }
            
            // Get category data from request
            $name = trim($data['name'] ?? '');
            $type = $data['type'] ?? '';
            $icon = $data['icon'] ?? 'category';
            $budgetId = isset($data['budget_id']) ? (int)$data['budget_id'] : null;
            
            // Validate required fields
            if (empty($name) || !in_array($type, ['Income', 'Expense'])) {
                sendError('Invalid category data', 400);
            }
            
            // Validate budget_id if provided
            // Only Expense categories can be linked to budgets
            if ($budgetId !== null) {
                if ($type !== 'Expense') {
                    sendError('Only Expense categories can be linked to budgets', 400);
                }
                
                // Check if budget exists and belongs to user
                $stmt = $pdo->prepare("SELECT id FROM budgets WHERE id = ? AND user_id = ?");
                $stmt->execute([$budgetId, $userId]);
                if (!$stmt->fetch()) {
                    sendError('Invalid budget', 400);
                }
            }
            
            // Update category in database
            $stmt = $pdo->prepare("
                UPDATE categories 
                SET name = ?, type = ?, icon = ?, budget_id = ? 
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$name, $type, $icon, $budgetId, $id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Category not found', 404);
            }
            
            // Prepare response data
            $payload = [
                'id' => $id,
                'name' => $name,
                'type' => $type,
                'icon' => $icon,
                'budget_id' => $budgetId
            ];
            
            // Log the activity
            logActivity($pdo, $userId, 'category', 'UPDATE', $payload);
            
            sendSuccess('Category updated', $payload);
            break;
            
        case 'DELETE':
            // DELETE: Remove a category
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                sendError('Category ID required', 400);
            }
            
            // Get category details before deleting (for logging)
            $stmt = $pdo->prepare("SELECT name, type FROM categories WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            $category = $stmt->fetch();
            
            if (!$category) {
                sendError('Category not found', 404);
            }
            
            // Delete category from database
            $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Category not found', 404);
            }
            
            // Log the activity
            logActivity($pdo, $userId, 'category', 'DELETE', [
                'name' => $category['name'],
                'type' => $category['type']
            ]);
            
            sendSuccess('Category deleted');
            break;
            
        case 'OPTIONS':
            // Handle CORS preflight request
            http_response_code(200);
            exit;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in categories.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in categories.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
