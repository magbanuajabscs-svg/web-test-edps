<?php
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Check if assigned_role exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'project_assignments' AND COLUMN_NAME = 'assigned_role'");
    $stmt->execute();
    $has = (int)$stmt->fetchColumn() > 0;

    if ($has) {
        echo "Column 'assigned_role' already exists.\n";
        exit(0);
    }

    // Add column
    $pdo->exec("ALTER TABLE project_assignments ADD COLUMN assigned_role VARCHAR(100) DEFAULT NULL AFTER staff_id");
    echo "Added column 'assigned_role'.\n";

    // If role_in_project exists, copy its values
    $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'project_assignments' AND COLUMN_NAME = 'role_in_project'");
    $stmt2->execute();
    $hasRoleIn = (int)$stmt2->fetchColumn() > 0;
    if ($hasRoleIn) {
        $pdo->exec("UPDATE project_assignments SET assigned_role = role_in_project WHERE assigned_role IS NULL");
        echo "Copied values from 'role_in_project' to 'assigned_role'.\n";
    }

    echo "Fix completed.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

?>
