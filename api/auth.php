<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

try {
    $pdo = getDBConnection();
} catch (Exception $e) {
    error_log("Database bootstrap error in auth.php: " . $e->getMessage());
    sendError('Database connection failed', 500);
}

try {
    switch ($method) {
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $action = '';
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
            } elseif (isset($data['action'])) {
                $action = $data['action'];
            }
            
            if ($action === 'login') {
                $usernameOrEmail = '';
                if (isset($data['username'])) {
                    $usernameOrEmail = trim($data['username']);
                }
                $password = '';
                if (isset($data['password'])) {
                    $password = $data['password'];
                }
                
                if (empty($usernameOrEmail) || empty($password)) {
                    sendError('Username/email and password are required', 400);
                }
                
                $isEmail = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL);
                $field = $isEmail ? 'email' : 'username';
                
                $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE " . $field . " = ? LIMIT 1");
                $stmt->execute(array($usernameOrEmail));
                $user = $stmt->fetch();
                
                if (!$user || !password_verify($password, $user['password'])) {
                    sendError('Invalid credentials', 401);
                }
                
                setUserSession($user['id'], $user['username'], $user['email']);
                
                sendSuccess('Login successful', array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ));
                
            } elseif ($action === 'signup') {
                $username = '';
                if (isset($data['username'])) {
                    $username = trim($data['username']);
                }
                $email = '';
                if (isset($data['email'])) {
                    $email = trim($data['email']);
                }
                $password = '';
                if (isset($data['password'])) {
                    $password = $data['password'];
                }
                
                if (empty($username) || empty($email) || empty($password)) {
                    sendError('Username, email, and password are required', 400);
                }
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    sendError('Invalid email format', 400);
                }
                
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
                $stmt->execute(array($email));
                if ($stmt->fetch()) {
                    sendError('Email already registered', 409);
                }
                
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
                $stmt->execute(array($username));
                if ($stmt->fetch()) {
                    sendError('Username already taken', 409);
                }
                
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute(array($username, $email, $hashedPassword));
                
                $userId = $pdo->lastInsertId();
                
                setUserSession($userId, $username, $email);
                
                sendSuccess('Account created successfully', array(
                    'user_id' => $userId,
                    'username' => $username,
                    'email' => $email
                ), 201);
                
            } elseif ($action === 'request_password_reset') {
                $email = '';
                if (isset($data['email'])) {
                    $email = trim($data['email']);
                }
                
                if (empty($email)) {
                    sendError('Email is required', 400);
                }
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    sendError('Invalid email format', 400);
                }
                
                $stmt = $pdo->prepare("SELECT id, email FROM users WHERE email = ? LIMIT 1");
                $stmt->execute(array($email));
                $user = $stmt->fetch();
                
                if (!$user) {
                    sendError('No account found with that email address', 404);
                }
                
                $_SESSION['password_reset_user_id'] = (int)$user['id'];
                $_SESSION['password_reset_email'] = $user['email'];
                $_SESSION['password_reset_expires'] = time() + 600;
                
                sendSuccess('Password reset confirmed. Please enter a new password.');
                
            } elseif ($action === 'reset_password') {
                $resetUserId = null;
                if (isset($_SESSION['password_reset_user_id'])) {
                    $resetUserId = $_SESSION['password_reset_user_id'];
                }
                $resetExpiry = 0;
                if (isset($_SESSION['password_reset_expires'])) {
                    $resetExpiry = $_SESSION['password_reset_expires'];
                }
                
                if (!$resetUserId || $resetExpiry < time()) {
                    unset($_SESSION['password_reset_user_id']);
                    unset($_SESSION['password_reset_email']);
                    unset($_SESSION['password_reset_expires']);
                    sendError('Password reset session expired. Please try again.', 401);
                }
                
                $newPassword = '';
                if (isset($data['password'])) {
                    $newPassword = $data['password'];
                }
                $providedEmail = '';
                if (isset($data['email'])) {
                    $providedEmail = trim($data['email']);
                }
                $sessionEmail = null;
                if (isset($_SESSION['password_reset_email'])) {
                    $sessionEmail = $_SESSION['password_reset_email'];
                }
                
                if ($providedEmail !== '') {
                    if (!filter_var($providedEmail, FILTER_VALIDATE_EMAIL)) {
                        sendError('Invalid email format', 400);
                    }
                    if (!$sessionEmail || strcasecmp($providedEmail, $sessionEmail) !== 0) {
                        sendError('Email does not match password reset request', 400);
                    }
                }
                
                if (empty($newPassword)) {
                    sendError('New password is required', 400);
                }
                
                if (strlen($newPassword) < 8) {
                    sendError('Password must be at least 8 characters long', 400);
                }
                
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute(array($hashedPassword, $resetUserId));
                
                unset($_SESSION['password_reset_user_id']);
                unset($_SESSION['password_reset_email']);
                unset($_SESSION['password_reset_expires']);
                
                sendSuccess('Password reset successfully');
                
            } else {
                sendError('Invalid action. Use ?action=login, signup, request_password_reset, or reset_password', 400);
            }
            break;
            
        case 'DELETE':
            clearUserSession();
            sendSuccess('Logged out successfully');
            break;
            
        case 'GET':
            $userId = getCurrentUserId();
            
            if ($userId) {
                $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = ? LIMIT 1");
                $stmt->execute(array($userId));
                $user = $stmt->fetch();
                
                if ($user) {
                    sendSuccess('User authenticated', array(
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email']
                    ));
                }
            }
            
            sendError('Not authenticated', 401);
            break;
            
        case 'OPTIONS':
            http_response_code(200);
            exit;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in auth.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in auth.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
