<?php


// Database connection
$host = 'localhost';
$db = 'trainingapp';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Session timeout settings
$sessionTimeout = 8 * 60 * 60; // 8 hours in seconds

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log session state for debugging
error_log("Session state in config.php: " . print_r($_SESSION, true));

// Initialize session variables if not set
//if (!isset($_SESSION['role'])) $_SESSION['role'] = null; for testing login2.php
if (!isset($_SESSION['user_role'])) $_SESSION['user_role'] = null;
if (!isset($_SESSION['accessible_cards'])) $_SESSION['accessible_cards'] = [];
if (!isset($_SESSION['training_name'])) $_SESSION['training_name'] = null;

// Check session timeout
if (!isset($_SESSION['created_at'])) {
    $_SESSION['created_at'] = time(); // Initialize if not set
} else if (time() - $_SESSION['created_at'] > $sessionTimeout) {
    session_unset();
    session_destroy();
    header("Location: login2.php?error=sessionExpired");
    exit();
}

// Redirect to login.php if the session is not active
if (!isset($_SESSION['role']) && basename($_SERVER['PHP_SELF']) !== 'login2.php') {
    header("Location: login2.php?error=notLoggedIn");
    exit();
}

// Logout function
/*
function logout()
{
    // Log session state before logout
    error_log("Session state before logout: " . print_r($_SESSION, true));

    // Get session cookie parameters
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

    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_unset();
    session_destroy();

    // Log session state after logout
    error_log("Session state after logout: " . print_r($_SESSION, true));

    header("Location: login.php?info=loggedOut");
    exit();
} */
// Logout function
function logout()
{
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login2.php?info=loggedOut");
    exit();
}
