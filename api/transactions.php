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

function getBudgetIdFromCategory($pdo, $userId, $category, $transactionDate = null) {
    if (empty($category) || $transactionDate === null) {
        return null;
    }
    
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE user_id = ? AND name = ? AND type = 'Expense' LIMIT 1");
    $stmt->execute(array($userId, $category));
    $categoryResult = $stmt->fetch();
    
    if (!$categoryResult) {
        return null;
    }
    
    $categoryId = (int)$categoryResult['id'];
    $transactionYearMonth = date('Y-m', strtotime($transactionDate));
    
    $stmt = $pdo->prepare("SELECT id FROM budgets WHERE user_id = ? AND category_id = ? AND DATE_FORMAT(budget_month, '%Y-%m') = ? ORDER BY budget_month DESC LIMIT 1");
    $stmt->execute(array($userId, $categoryId, $transactionYearMonth));
    $budgetResult = $stmt->fetch();
    
    if ($budgetResult) {
        return (int)$budgetResult['id'];
    }
    
    return null;
}

function getBudgetInfo($pdo, $userId, $budgetId) {
    $stmt = $pdo->prepare("
        SELECT id, name, budget_limit, spent 
        FROM budgets 
        WHERE id = ? AND user_id = ? 
        LIMIT 1
    ");
    $stmt->execute([$budgetId, $userId]);
    return $stmt->fetch();
}

function checkBudgetLimit($pdo, $userId, $budgetId, $amount, $type) {
    if ($type !== 'Expense') {
        return null; // Only check expenses
    }
    
    $budgetInfo = getBudgetInfo($pdo, $userId, $budgetId);
    if (!$budgetInfo) {
        return null;
    }
    
    $limit = (float)$budgetInfo['budget_limit'];
    $currentSpent = (float)$budgetInfo['spent'];
    
    if ($limit > 0 && ($currentSpent + $amount) > $limit) {
        return "Budget limit exceeded for {$budgetInfo['name']}. Please adjust the amount or increase the budget limit.";
    }
    
    return null;
}

function updateAccountBalance($pdo, $userId, $accountId, $type, $amount) {
    if ($accountId === null) {
        return; // No account to update
    }
    
    // Validate account exists
    $stmt = $pdo->prepare("SELECT id FROM accounts WHERE id = ? AND user_id = ?");
    $stmt->execute([$accountId, $userId]);
    if (!$stmt->fetch()) {
        return; // Invalid account
    }
    
    // Calculate balance change: Income adds, Expense subtracts
    $balanceChange = ($type === 'Income') ? $amount : -$amount;
    
    // Update account balance
    $stmt = $pdo->prepare("
        UPDATE accounts 
        SET balance = balance + ? 
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([$balanceChange, $accountId, $userId]);
}

function updateBudgetSpent($pdo, $userId, $budgetId, $type, $amount) {
    if ($budgetId === null || $type !== 'Expense') {
        return;
    }
    $budgetInfo = getBudgetInfo($pdo, $userId, $budgetId);
    if (!$budgetInfo) {
        return;
    }
    $stmt = $pdo->prepare("UPDATE budgets SET spent = spent + ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$amount, $budgetId, $userId]);
}

function groupTransactionsByDate($transactions) {
    $grouped = [];
    
    foreach ($transactions as $tx) {
        $dateKey = date('Y-m-d', strtotime($tx['transaction_date']));
        
        if (!isset($grouped[$dateKey])) {
            $grouped[$dateKey] = [];
        }
        
        $grouped[$dateKey][] = [
            'id' => (int)$tx['id'],
            'type' => $tx['type'],
            'category' => $tx['category'] ?? '',
            'name' => $tx['name'],
            'value' => (float)$tx['amount'],
            'dateKey' => $dateKey,
            'account_id' => $tx['account_id'] ? (int)$tx['account_id'] : null,
            'budget_id' => $tx['budget_id'] ? (int)$tx['budget_id'] : null,
            'created_at' => $tx['created_at']
        ];
    }
    
    return $grouped;
}

try {
    switch ($method) {
        case 'GET':
            $stmt = $pdo->prepare("SELECT id, type, category, name, amount, transaction_date, account_id, budget_id, created_at FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC, id DESC");
            $stmt->execute(array($userId));
            $transactions = $stmt->fetchAll();
            $grouped = groupTransactionsByDate($transactions);
            sendSuccess('Transactions retrieved', $grouped);
            break;
            
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $type = '';
            if (isset($data['type'])) {
                $type = $data['type'];
            }
            $name = '';
            if (isset($data['name'])) {
                $name = trim($data['name']);
            }
            $value = 0;
            if (isset($data['value'])) {
                $value = (float)$data['value'];
            }
            $dateKey = date('Y-m-d');
            if (isset($data['dateKey'])) {
                $dateKey = $data['dateKey'];
            }
            $category = '';
            if (isset($data['category'])) {
                $category = $data['category'];
            }
            $accountId = null;
            if (isset($data['account_id'])) {
                $accountId = (int)$data['account_id'];
            }
            $budgetId = null;
            if (isset($data['budget_id'])) {
                $budgetId = (int)$data['budget_id'];
            }
            
            if (empty($name) || $value <= 0 || !in_array($type, array('Income', 'Expense'))) {
                sendError('Invalid transaction data', 400);
            }
            
            if ($accountId === null) {
                sendError('Account is required', 400);
            }
            
            $stmt = $pdo->prepare("SELECT id FROM accounts WHERE id = ? AND user_id = ?");
            $stmt->execute(array($accountId, $userId));
            if (!$stmt->fetch()) {
                sendError('Invalid account', 400);
            }
            
            if ($type === 'Expense' && !empty($category) && $budgetId === null) {
                $budgetId = getBudgetIdFromCategory($pdo, $userId, $category, $dateKey);
            }
            
            if ($type === 'Expense' && $budgetId !== null) {
                $budgetInfo = getBudgetInfo($pdo, $userId, $budgetId);
                if ($budgetInfo) {
                $budgetWarning = checkBudgetLimit($pdo, $userId, $budgetId, $value, $type);
                    if ($budgetWarning !== null) {
                        sendError($budgetWarning, 400);
                    }
                }
            }
            
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, category, name, amount, transaction_date, account_id, budget_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($userId, $type, $category, $name, $value, $dateKey, $accountId, $budgetId));
            $transactionId = $pdo->lastInsertId();
            
            updateAccountBalance($pdo, $userId, $accountId, $type, $value);
            updateBudgetSpent($pdo, $userId, $budgetId, $type, $value);
            
            $responseData = array(
                'id' => (int)$transactionId,
                'type' => $type,
                'category' => $category,
                'name' => $name,
                'value' => $value,
                'dateKey' => $dateKey,
                'account_id' => $accountId,
                'budget_id' => $budgetId
            );
            
            logActivity($pdo, $userId, 'transaction', 'CREATE', $responseData);
            sendSuccess('Transaction created', $responseData, 201);
            break;
            
        case 'PUT':
            $id = 0;
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
            }
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$id) {
                sendError('Transaction ID required', 400);
            }
            
            $type = '';
            if (isset($data['type'])) {
                $type = $data['type'];
            }
            $name = '';
            if (isset($data['name'])) {
                $name = trim($data['name']);
            }
            $value = 0;
            if (isset($data['value'])) {
                $value = (float)$data['value'];
            }
            $dateKey = date('Y-m-d');
            if (isset($data['dateKey'])) {
                $dateKey = $data['dateKey'];
            }
            $category = '';
            if (isset($data['category'])) {
                $category = $data['category'];
            }
            $accountId = null;
            if (isset($data['account_id'])) {
                $accountId = (int)$data['account_id'];
            }
            $budgetId = null;
            if (isset($data['budget_id'])) {
                $budgetId = (int)$data['budget_id'];
            }
            
            if (empty($name) || $value <= 0 || !in_array($type, array('Income', 'Expense'))) {
                sendError('Invalid transaction data', 400);
            }
            
            if ($accountId === null) {
                sendError('Account is required', 400);
            }
            
            $stmt = $pdo->prepare("SELECT id FROM accounts WHERE id = ? AND user_id = ?");
            $stmt->execute(array($accountId, $userId));
            if (!$stmt->fetch()) {
                sendError('Invalid account', 400);
            }
            
            if ($type === 'Expense' && !empty($category) && $budgetId === null) {
                $budgetId = getBudgetIdFromCategory($pdo, $userId, $category, $dateKey);
            }
            
            $stmt = $pdo->prepare("SELECT type, amount, account_id, budget_id FROM transactions WHERE id = ? AND user_id = ?");
            $stmt->execute(array($id, $userId));
            $oldTx = $stmt->fetch();
            
            if (!$oldTx) {
                sendError('Transaction not found', 404);
            }
            
            if ($type === 'Expense' && $budgetId !== null) {
                $budgetInfo = getBudgetInfo($pdo, $userId, $budgetId);
                if ($budgetInfo) {
                $limit = (float)$budgetInfo['budget_limit'];
                $currentSpent = (float)$budgetInfo['spent'];
                
                if ($oldTx['budget_id'] == $budgetId && $oldTx['type'] === 'Expense') {
                    $currentSpent -= (float)$oldTx['amount'];
                    if ($currentSpent < 0) {
                        $currentSpent = 0;
                    }
                }
                
                if ($limit > 0 && ($currentSpent + $value) > $limit) {
                        sendError("Budget limit exceeded for " . $budgetInfo['name'] . ". Please adjust the amount or increase the budget limit.", 400);
                    }
                }
            }
            
            if ($oldTx['account_id']) {
                $oldBalanceChange = ($oldTx['type'] === 'Income') ? -$oldTx['amount'] : $oldTx['amount'];
                $stmt = $pdo->prepare("UPDATE accounts SET balance = balance + ? WHERE id = ? AND user_id = ?");
                $stmt->execute(array($oldBalanceChange, $oldTx['account_id'], $userId));
            }
            
            if ($oldTx['budget_id'] && $oldTx['type'] === 'Expense') {
                $stmt = $pdo->prepare("UPDATE budgets SET spent = spent - ? WHERE id = ? AND user_id = ?");
                $stmt->execute(array($oldTx['amount'], $oldTx['budget_id'], $userId));
            }
            
            $updateStmt = $pdo->prepare("UPDATE transactions SET type = ?, category = ?, name = ?, amount = ?, transaction_date = ?, account_id = ?, budget_id = ? WHERE id = ? AND user_id = ?");
            $updateStmt->execute(array($type, $category, $name, $value, $dateKey, $accountId, $budgetId, $id, $userId));
            
            if ($updateStmt->rowCount() === 0) {
                sendError('Transaction not found', 404);
            }
            
            updateAccountBalance($pdo, $userId, $accountId, $type, $value);
            updateBudgetSpent($pdo, $userId, $budgetId, $type, $value);
            
            $responseData = array(
                'id' => $id,
                'type' => $type,
                'category' => $category,
                'name' => $name,
                'value' => $value,
                'dateKey' => $dateKey,
                'account_id' => $accountId,
                'budget_id' => $budgetId
            );
            
            logActivity($pdo, $userId, 'transaction', 'UPDATE', $responseData);
            sendSuccess('Transaction updated', $responseData);
            break;
            
        case 'DELETE':
            // DELETE: Remove a transaction
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                sendError('Transaction ID required', 400);
            }
            
            // Get transaction data before deleting
            $stmt = $pdo->prepare("
                SELECT name, type, amount, account_id, budget_id 
                FROM transactions 
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$id, $userId]);
            $tx = $stmt->fetch();
            
            if (!$tx) {
                sendError('Transaction not found', 404);
            }
            
            // Reverse transaction's effect on account balance
            if ($tx['account_id']) {
                $balanceChange = ($tx['type'] === 'Income') ? -$tx['amount'] : $tx['amount'];
                $stmt = $pdo->prepare("
                    UPDATE accounts 
                    SET balance = balance + ? 
                    WHERE id = ? AND user_id = ?
                ");
                $stmt->execute([$balanceChange, $tx['account_id'], $userId]);
            }
            
            // Reverse transaction's effect on budget spent
            if ($tx['budget_id'] && $tx['type'] === 'Expense') {
                $stmt = $pdo->prepare("
                    UPDATE budgets 
                    SET spent = spent - ? 
                    WHERE id = ? AND user_id = ?
                ");
                $stmt->execute([$tx['amount'], $tx['budget_id'], $userId]);
            }
            
            // Delete transaction from database
            $stmt = $pdo->prepare("DELETE FROM transactions WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            
            // Log the activity
            logActivity($pdo, $userId, 'transaction', 'DELETE', [
                'name' => $tx['name'],
                'type' => $tx['type'],
                'value' => (float)$tx['amount']
            ]);
            
            sendSuccess('Transaction deleted');
            break;
            
        case 'OPTIONS':
            // Handle CORS preflight request
            http_response_code(200);
            exit;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in transactions.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in transactions.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
