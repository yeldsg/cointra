<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'cointra');
define('DB_USER', 'root');
define('DB_PASS', '');

function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            );
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

function getCurrentUserId() {
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    }
    return null;
}

function setUserSession($userId, $username = null, $email = null) {
    $_SESSION['user_id'] = $userId;
    if ($username) {
        $_SESSION['username'] = $username;
    }
    if ($email) {
        $_SESSION['email'] = $email;
}
}

function clearUserSession() {
    session_unset();
    session_destroy();
}

if (!defined('API_CONTEXT')) {
    try {
        $pdo = getDBConnection();
        $user_id = getCurrentUserId();
        if (!$user_id) {
            $user_id = 1;
        }
    } catch (Exception $e) {
        error_log("Database initialization error: " . $e->getMessage());
    }
}

?>
