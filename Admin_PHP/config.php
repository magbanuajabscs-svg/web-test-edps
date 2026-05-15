<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_PORT', 3307); // Custom MySQL port
define('DB_NAME', 'edps_studio');
define('DB_USER', 'root'); // Change this to your MySQL username
define('DB_PASS', ''); // Change this to your MySQL password

// Application Configuration
define('APP_NAME', 'EDPS Studio');
define('APP_URL', 'http://localhost/edps_studio'); // Change this to your app URL
define('UPLOAD_PATH', __DIR__ . '/Pictures/');

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

// Error Reporting (set to 0 in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Timezone
date_default_timezone_set('America/Los_Angeles');

// Start session
session_start();

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Helper functions
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function generateSlug($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}

function formatDate($date, $format = 'M j, Y') {
    return date($format, strtotime($date));
}

function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

// Flash messages
function setFlashMessage($type, $message) {
    $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
}

function getFlashMessages() {
    $messages = $_SESSION['flash_messages'] ?? [];
    unset($_SESSION['flash_messages']);
    return $messages;
}

// Authentication check
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

// Admin check
function requireAdmin() {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: unauthorized.php');
        exit;
    }
}

// CSRF token validation
function validateCSRF($token) {
    return hash_equals($_SESSION['csrf_token'], $token);
}
?>