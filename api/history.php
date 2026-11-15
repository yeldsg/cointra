<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';
require_once 'activity_logger.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    $pdo = getDBConnection();
    $userId = getCurrentUserId();

    if (!$userId) {
        sendError('Authentication required', 401);
    }

    ensureActivityLogsTable($pdo);

    switch ($method) {
        case 'GET':
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 200;
            if ($limit <= 0) {
                $limit = 50;
            }
            $limit = min($limit, 500);

            $stmt = $pdo->prepare("
                SELECT id, entity, action, description, created_at
                FROM activity_logs
                WHERE user_id = ?
                ORDER BY id DESC
                LIMIT ?
            ");
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->execute();
            $logs = $stmt->fetchAll();

            $formatted = [];
            foreach ($logs as $row) {
                $formatted[] = [
                    'id' => (int)$row['id'],
                    'entity' => $row['entity'],
                    'action' => strtoupper($row['action']),
                    'description' => $row['description'],
                    'created_at' => $row['created_at'],
                ];
            }

            sendSuccess('Activity history retrieved', $formatted);
            break;

        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in history.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in history.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}

