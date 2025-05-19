<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log the session state before logout
error_log("Session before logout: " . print_r($_SESSION, true));

// Clear all session variables
$_SESSION = array();

// Get session parameters
$params = session_get_cookie_params();

// Delete the session cookie
setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

// Destroy the session
session_destroy();

// Log the session state after logout
error_log("Session after logout: " . print_r($_SESSION, true));

// Send success response
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
exit;
