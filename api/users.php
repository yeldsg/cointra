<?php
define('API_CONTEXT', true);
require_once '../config/Database.php';
require_once 'response.php';

// Set response headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle CORS preflight request
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Get database connection
try {
    $pdo = getDBConnection();
} catch (Exception $e) {
    error_log("Database connection error in users.php: " . $e->getMessage());
    sendError('Database connection failed: ' . $e->getMessage(), 500);
}

// Get user ID from session
$userId = getCurrentUserId();

function uploadFile($file, $type, $userId) {
    // Check if file was uploaded successfully
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        error_log("File upload error: " . ($file['error'] ?? 'File not set'));
        return null;
    }
    
    // Allowed file types
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    
    // Check file extension and MIME type
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions) || !in_array($file['type'], $allowedTypes)) {
        error_log("Invalid file type: " . $file['type']);
        return null;
    }
    
    // Create uploads directory if it doesn't exist
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            error_log("Failed to create uploads directory: " . $uploadDir);
            return null;
        }
    }
    
    // Generate unique filename: type_userId_timestamp_uniqueid.extension
    $filename = $type . '_' . $userId . '_' . time() . '_' . uniqid() . '.' . $fileExtension;
    $filepath = $uploadDir . $filename;
    
    // Move uploaded file to destination
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Verify file was saved
        if (file_exists($filepath)) {
            // Return relative path for database storage
            return 'uploads/' . $filename;
        } else {
            error_log("File was not saved: " . $filepath);
            return null;
        }
    } else {
        error_log("Failed to move uploaded file to: " . $filepath);
        return null;
    }
}

function handleUserUpdate($pdo, $userId) {
    // Check if user is logged in
    if (!$userId) {
        sendError('Authentication required', 401);
    }

    $data = [];
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    $isMultipart = stripos($contentType, 'multipart/form-data') !== false;

    // Handle file uploads (multipart form data)
    if ($isMultipart && !empty($_FILES)) {
        // Handle avatar upload
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatarPath = uploadFile($_FILES['avatar'], 'avatar', $userId);
            if ($avatarPath) {
                $data['avatar'] = $avatarPath;
            } else {
                sendError('Failed to upload avatar image', 400);
            }
        }

        // Handle banner upload
        if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
            $bannerPath = uploadFile($_FILES['banner'], 'banner', $userId);
            if ($bannerPath) {
                $data['banner'] = $bannerPath;
            } else {
                sendError('Failed to upload banner image', 400);
            }
        }
    } else {
        // Handle JSON data (text fields)
        $jsonData = json_decode(file_get_contents('php://input'), true);
        if ($jsonData) {
            if (isset($jsonData['username'])) $data['username'] = trim($jsonData['username']);
            if (isset($jsonData['email'])) $data['email'] = trim($jsonData['email']);
            if (isset($jsonData['birthday'])) $data['birthday'] = $jsonData['birthday'];
            if (isset($jsonData['about_me'])) $data['about_me'] = trim($jsonData['about_me']);
        }
    }

    // Check if there's any data to update
    if (empty($data)) {
        sendError('No data to update', 400);
    }

    // Build SQL UPDATE query dynamically
    $fields = [];
    $values = [];
    foreach ($data as $key => $value) {
        $fields[] = "$key = ?";
        $values[] = $value;
    }
    $values[] = $userId; // Add user ID for WHERE clause

    // Execute update query
    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    // Check if user exists (in case no rows were changed)
    if ($stmt->rowCount() === 0) {
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE id = ? LIMIT 1");
        $checkStmt->execute([$userId]);
        if (!$checkStmt->fetch()) {
            sendError('User not found', 404);
        }
    }

    // Get updated user data
    $stmt = $pdo->prepare("
        SELECT id, username, email, birthday, about_me, avatar, banner, created_at 
        FROM users 
        WHERE id = ? 
        LIMIT 1
    ");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // Return updated user data
    sendSuccess('User updated', [
        'id' => (int)$user['id'],
        'username' => $user['username'] ?? '',
        'email' => $user['email'] ?? '',
        'birthday' => $user['birthday'] ?? '',
        'about_me' => $user['about_me'] ?? '',
        'avatar' => $user['avatar'] ?? '',
        'banner' => $user['banner'] ?? '',
        'created_at' => $user['created_at'] ?? ''
    ]);
}

try {
    switch ($method) {
        case 'GET':
            // GET: Retrieve user profile
            if (!$userId) {
                sendError('Authentication required. Please log in.', 401);
            }
            
            try {
                // Get user data from database
                $stmt = $pdo->prepare("
                    SELECT id, username, email, birthday, about_me, avatar, banner, created_at 
                    FROM users 
                    WHERE id = ? 
                    LIMIT 1
                ");
                $stmt->execute([$userId]);
                $user = $stmt->fetch();
                
                if (!$user) {
                    error_log("User ID $userId not found in database");
                    sendError('User profile not found', 404);
                }
                
                // Return user data
                sendSuccess('User retrieved', [
                    'id' => (int)$user['id'],
                    'username' => $user['username'] ?? '',
                    'email' => $user['email'] ?? '',
                    'birthday' => $user['birthday'] ?? '',
                    'about_me' => $user['about_me'] ?? '',
                    'avatar' => $user['avatar'] ?? '',
                    'banner' => $user['banner'] ?? '',
                    'created_at' => $user['created_at'] ?? ''
                ]);
            } catch (PDOException $e) {
                error_log("Database query error in users.php GET: " . $e->getMessage());
                sendError('Database error occurred', 500);
            }
            break;
            
        case 'PUT':
        case 'POST':
            // PUT/POST: Update user profile
            handleUserUpdate($pdo, $userId);
            break;
            
        case 'OPTIONS':
            // Handle CORS preflight request
            http_response_code(200);
            exit;
            
        default:
            sendError('Method not allowed', 405);
    }
} catch (PDOException $e) {
    error_log("Database Error in users.php: " . $e->getMessage());
    sendError('Database error occurred', 500);
} catch (Exception $e) {
    error_log("Error in users.php: " . $e->getMessage());
    sendError('An error occurred', 500);
}
