<?php
require_once 'config.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role_selected = $_POST['role'] ?? '';

    // 1. Admin demo credentials
    if ($username === 'admin' && $password === '1234') {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'Admin';
        $_SESSION['user_role'] = 'admin';

        header('Location: Bulletin.php');
        exit;
    }

    // 2. Try authenticate against staff_accounts table
    try {
        $db = Database::getInstance();
        $row = $db->fetch('SELECT * FROM staff_accounts WHERE username = ?', [$username]);
        if ($row && password_verify($password, $row['password_hash'])) {
            // Set session keys expected across the app
            $_SESSION['staff_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['role'] = $row['role'];

            // Backwards-compatible keys
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_role'] = 'staff';

            header('Location: staff-dashboard.php');
            exit;
        }
    } catch (Exception $e) {
        error_log('Login DB error: ' . $e->getMessage());
    }

    // 3. Legacy/demo staff fallback
    if ($username === 'staff' && $password === '1234') {
        $_SESSION['user_id'] = 99; // Dummy ID for staff
        $_SESSION['username'] = 'Staff Member';
        $_SESSION['user_role'] = 'staff';

        header('Location: staff-dashboard.php');
        exit;
    }

    // 4. Invalid credentials
    echo "<script>alert('Invalid Credentials!'); window.location.href='login.php';</script>";
}

?>