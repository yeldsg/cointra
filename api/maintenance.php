<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($method !== 'POST') {
    sendError('Method not allowed', 405);
}

$pdo = getDBConnection();
$userId = getCurrentUserId();

if (!$userId) {
    sendError('Authentication required', 401);
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

if (!$action) {
    sendError('Action is required', 400);
}

try {
    switch ($action) {
        case 'delete_records':
            deleteTransactionsOnly($pdo, $userId);
            sendSuccess('All records deleted (accounts, categories, and budgets retained).');
            break;
        case 'delete_all':
            deleteEverythingButUser($pdo, $userId);
            sendSuccess('All data deleted for your account.');
            break;
        case 'reset_all':
            deleteEverythingButUser($pdo, $userId);
            resetUserProfile($pdo, $userId);
            sendSuccess('Cointra has been reset to its default state.');
            break;
        default:
            sendError('Invalid action specified', 400);
    }
} catch (PDOException $e) {
    error_log("Database Error in maintenance.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in maintenance.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}

function deleteTransactionsOnly($pdo, $userId) {
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("DELETE FROM transactions WHERE user_id = ?");
        $stmt->execute([$userId]);

        $stmt = $pdo->prepare("UPDATE budgets SET spent = 0 WHERE user_id = ?");
        $stmt->execute([$userId]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function deleteEverythingButUser($pdo, $userId) {
    $pdo->beginTransaction();
    try {
        $pdo->prepare("DELETE FROM transactions WHERE user_id = ?")->execute([$userId]);
        $pdo->prepare("DELETE FROM accounts WHERE user_id = ?")->execute([$userId]);
        $pdo->prepare("DELETE FROM budgets WHERE user_id = ?")->execute([$userId]);
        $pdo->prepare("DELETE FROM categories WHERE user_id = ?")->execute([$userId]);
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function resetUserProfile($pdo, $userId) {
    $stmt = $pdo->prepare("
        UPDATE users 
        SET username = username, -- keep existing username
            email = email,       -- keep email to allow login
            birthday = NULL,
            about_me = NULL,
            avatar = NULL,
            banner = NULL,
            updated_at = NOW()
        WHERE id = ?
    ");
    $stmt->execute([$userId]);
}

