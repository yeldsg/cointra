<?php

function sendResponse($success, $message, $data = null, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    
    $response = array(
        'success' => $success,
        'message' => $message
    );
    
    if ($data !== null) {
        $response['data'] = $data;
    }
    
    echo json_encode($response);
    exit;
}

function sendError($message, $statusCode = 400) {
    sendResponse(false, $message, null, $statusCode);
}

function sendSuccess($message, $data = null) {
    sendResponse(true, $message, $data);
}

