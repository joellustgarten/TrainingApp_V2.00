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

session_start();

// Initialize session variables if not set
if (!isset($_SESSION['user_role'])) $_SESSION['user_role'] = null;
if (!isset($_SESSION['accessible_cards'])) $_SESSION['accessible_cards'] = [];
if (!isset($_SESSION['training_name'])) $_SESSION['training_name'] = null;

// Check session timeout
if (!isset($_SESSION['created_at'])) {
    $_SESSION['created_at'] = time(); // Initialize if not set
} else if (time() - $_SESSION['created_at'] > $sessionTimeout) {
    session_unset();
    session_destroy();
    header("Location: login.php?error=sessionExpired");
    exit();
}

// Redirect to login.php if the session is not active
if (!isset($_SESSION['user_role']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header("Location: login.php?error=notLoggedIn");
    exit();
}

// Logout function
function logout() {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php?info=loggedOut");
    exit();
}

?>

