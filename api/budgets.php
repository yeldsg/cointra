<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';
require_once 'activity_logger.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

function migrateBudgetsTable($pdo) {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM budgets LIKE 'category_id'");
        if ($stmt->rowCount() === 0) {
            $pdo->exec("ALTER TABLE budgets ADD COLUMN category_id INT NULL AFTER budget_month");
            $pdo->exec("ALTER TABLE budgets ADD CONSTRAINT fk_budgets_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL");
            
            $pdo->exec("UPDATE budgets b INNER JOIN categories c ON c.budget_id = b.id AND c.user_id = b.user_id SET b.category_id = c.id");
            
            try {
                $pdo->exec("ALTER TABLE budgets ADD UNIQUE KEY unique_category_month (user_id, category_id, budget_month)");
            } catch (PDOException $e) {
                if (strpos($e->getMessage(), 'Duplicate key') === false) {
                    throw $e;
                }
            }
        }
    } catch (PDOException $e) {
        error_log("Migration error: " . $e->getMessage());
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$pdo = getDBConnection();
migrateBudgetsTable($pdo);
$userId = getCurrentUserId();

if (!$userId) {
    sendError('Authentication required', 401);
}

try {
    switch ($method) {
        case 'GET':
            $monthFilter = isset($_GET['month']) ? $_GET['month'] : null;
            $params = [$userId];
            $where = "WHERE user_id = ?";
            
            if ($monthFilter !== null) {
                if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthFilter)) {
                    sendError('Invalid month filter. Use YYYY-MM format.', 400);
                }
                $where .= " AND DATE_FORMAT(budget_month, '%Y-%m') = ?";
                $params[] = $monthFilter;
            }
            
            $stmt = $pdo->prepare("
                SELECT id, name, budget_limit, spent, budget_month, category_id 
                FROM budgets 
                $where
                ORDER BY id DESC
            ");
            $stmt->execute($params);
            $budgets = $stmt->fetchAll();
            $formatted = [];
            foreach ($budgets as $row) {
                $monthString = $row['budget_month'] ? date('Y-m', strtotime($row['budget_month'])) : null;
                $formatted[] = [
                    'id' => (int)$row['id'],
                    'name' => $row['name'],
                    'limit' => (float)$row['budget_limit'],
                    'spent' => (float)$row['spent'],
                    'month' => $monthString,
                    'category_id' => $row['category_id'] ? (int)$row['category_id'] : null
                ];
            }
            
            sendSuccess('Budgets retrieved', $formatted);
            break;
            
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $name = trim($data['name'] ?? '');
            $limit = isset($data['limit']) ? (float)$data['limit'] : 0;
            $categoryId = isset($data['category_id']) ? (int)$data['category_id'] : null;
            $monthKey = $data['month'] ?? date('Y-m');
            
            if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthKey)) {
                sendError('Invalid month provided. Use YYYY-MM format.', 400);
            }
            
            $budgetMonth = sprintf('%s-01', $monthKey);
            $spent = 0.0;
            
            if (empty($name)) {
                sendError('Please provide a budget name', 400);
            }
            if ($limit < 0) {
                sendError('Budget limit must be 0 or greater', 400);
            }
            
            if ($categoryId !== null) {
                $stmt = $pdo->prepare("SELECT id, name, type FROM categories WHERE id = ? AND user_id = ?");
                $stmt->execute([$categoryId, $userId]);
                $category = $stmt->fetch();
                
                if (!$category) {
                    sendError('Category not found', 404);
                }
                
                if ($category['type'] !== 'Expense') {
                    sendError('Only Expense categories can be linked to budgets', 400);
                }
                
                $stmt = $pdo->prepare("
                    SELECT id, name 
                    FROM budgets 
                    WHERE user_id = ? AND category_id = ? AND budget_month = ?
                ");
                $stmt->execute([$userId, $categoryId, $budgetMonth]);
                $existingBudget = $stmt->fetch();
                
                if ($existingBudget) {
                    $monthName = date('F Y', strtotime($budgetMonth));
                    sendError("A budget for '{$category['name']}' already exists for {$monthName}. Please edit the existing budget or choose a different month.", 400);
                }
            }
            
            $stmt = $pdo->prepare("
                INSERT INTO budgets (user_id, name, budget_limit, spent, budget_month, category_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$userId, $name, $limit, $spent, $budgetMonth, $categoryId]);
            
            $budgetId = (int)$pdo->lastInsertId();
            $payload = [
                'id' => $budgetId,
                'name' => $name,
                'limit' => (float)$limit,
                'spent' => $spent,
                'month' => $monthKey,
                'category_id' => $categoryId
            ];
            
            logActivity($pdo, $userId, 'budget', 'CREATE', $payload);
            sendSuccess('Budget created', $payload, 201);
            break;
            
        case 'PUT':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$id) {
                sendError('Budget ID required', 400);
            }
            
            $stmt = $pdo->prepare("SELECT id, spent, budget_month FROM budgets WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            $existing = $stmt->fetch();
            
            if (!$existing) {
                sendError('Budget not found', 404);
            }
            
            $name = trim($data['name'] ?? '');
            $limit = isset($data['limit']) ? (float)$data['limit'] : 0;
            $categoryId = isset($data['category_id']) ? (int)$data['category_id'] : null;
            $spent = (float)$existing['spent'];
            
            if (empty($name)) {
                sendError('Please provide a budget name', 400);
            }
            if ($limit < 0) {
                sendError('Budget limit must be 0 or greater', 400);
            }
            
            $monthKey = $data['month'] ?? ($existing['budget_month'] ? date('Y-m', strtotime($existing['budget_month'])) : date('Y-m'));
            
            if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthKey)) {
                sendError('Invalid month provided. Use YYYY-MM format.', 400);
            }
            
            $budgetMonth = sprintf('%s-01', $monthKey);
            
            if ($categoryId !== null) {
                $stmt = $pdo->prepare("SELECT id, name, type FROM categories WHERE id = ? AND user_id = ?");
                $stmt->execute([$categoryId, $userId]);
                $category = $stmt->fetch();
                
                if (!$category) {
                    sendError('Category not found', 404);
                }
                
                if ($category['type'] !== 'Expense') {
                    sendError('Only Expense categories can be linked to budgets', 400);
                }
                
                $stmt = $pdo->prepare("
                    SELECT id, name 
                    FROM budgets 
                    WHERE user_id = ? AND category_id = ? AND budget_month = ? AND id != ?
                ");
                $stmt->execute([$userId, $categoryId, $budgetMonth, $id]);
                $existingBudget = $stmt->fetch();
                
                if ($existingBudget) {
                    $monthName = date('F Y', strtotime($budgetMonth));
                    sendError("A budget for '{$category['name']}' already exists for {$monthName}. Please edit the existing budget or choose a different month.", 400);
                }
            }
            
            $stmt = $pdo->prepare("
                UPDATE budgets 
                SET name = ?, budget_limit = ?, budget_month = ?, category_id = ? 
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$name, $limit, $budgetMonth, $categoryId, $id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Budget not found', 404);
            }
            
            $payload = [
                'id' => $id,
                'name' => $name,
                'limit' => (float)$limit,
                'spent' => $spent,
                'month' => $monthKey,
                'category_id' => $categoryId
            ];
            
            logActivity($pdo, $userId, 'budget', 'UPDATE', $payload);
            sendSuccess('Budget updated', $payload);
            break;
            
        case 'DELETE':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if (!$id) {
                sendError('Budget ID required', 400);
            }
            
            $stmt = $pdo->prepare("SELECT name FROM budgets WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            $budget = $stmt->fetch();
            
            if (!$budget) {
                sendError('Budget not found', 404);
            }
            
            $stmt = $pdo->prepare("DELETE FROM budgets WHERE id = ? AND user_id = ?");
            $stmt->execute([$id, $userId]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Budget not found', 404);
            }
            
            logActivity($pdo, $userId, 'budget', 'DELETE', ['name' => $budget['name']]);
            sendSuccess('Budget deleted');
            break;
            
        case 'OPTIONS':
            http_response_code(200);
            exit;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in budgets.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in budgets.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
