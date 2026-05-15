<?php
/**
 * setup_database.php
 * Standalone script to create initial tables and seed data for the staff portal.
 * Usage: php setup_database.php
 */

// Database configuration - edit if your MySQL uses a different port/credentials
$dbHost = '127.0.0.1';
$dbPort = 3307;
$dbName = 'edps_studio';
$dbUser = 'root';
$dbPass = '';

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Connect to MySQL server (not yet to a database)
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);

    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$dbName}`");

    // Create tables
    $createStaff = <<<SQL
CREATE TABLE IF NOT EXISTS staff_accounts (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

    $createProjects = <<<SQL
CREATE TABLE IF NOT EXISTS projects (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

    $pdo->exec($createStaff);
    $pdo->exec($createProjects);

        // Create junction table for project assignments (project_id, staff_id, assigned_role)
        $createAssignments = <<<SQL
CREATE TABLE IF NOT EXISTS project_assignments (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    project_id INT UNSIGNED NOT NULL,
    staff_id INT UNSIGNED NOT NULL,
    assigned_role VARCHAR(100) NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pa_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    CONSTRAINT fk_pa_staff FOREIGN KEY (staff_id) REFERENCES staff_accounts(id) ON DELETE CASCADE,
    UNIQUE KEY uq_project_staff (project_id, staff_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

        $pdo->exec($createAssignments);

        // If the table existed previously without the assigned_role column, add it
        $checkAssignCol = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'project_assignments' AND COLUMN_NAME = 'assigned_role'");
        $checkAssignCol->execute([$dbName]);
        $hasAssignRole = (int)$checkAssignCol->fetchColumn() > 0;
        if (!$hasAssignRole) {
            // Add the column without dropping the table
            $pdo->exec("ALTER TABLE project_assignments ADD COLUMN assigned_role VARCHAR(100) NOT NULL AFTER staff_id");
            echo "Added missing column 'assigned_role' to project_assignments table.\n";
        }

    // Ensure projects table has required columns (in case an existing table differs)
    $checkCol = $pdo->prepare("SELECT COUNT(*) AS c FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'projects' AND COLUMN_NAME = ?");
    $checkCol->execute([$dbName, 'title']);
    $hasTitle = (int)$checkCol->fetchColumn() > 0;
    if (!$hasTitle) {
        // Add title column
        $pdo->exec("ALTER TABLE projects ADD COLUMN title VARCHAR(255) NOT NULL AFTER id");
        echo "Added missing column 'title' to projects table.\n";
    }
    $checkCol->execute([$dbName, 'description']);
    $hasDesc = (int)$checkCol->fetchColumn() > 0;
    if (!$hasDesc) {
        $pdo->exec("ALTER TABLE projects ADD COLUMN description TEXT DEFAULT NULL AFTER title");
        echo "Added missing column 'description' to projects table.\n";
    }

    // Seed staff accounts
    $insertStaff = $pdo->prepare('INSERT IGNORE INTO staff_accounts (full_name, username, password_hash, role) VALUES (?, ?, ?, ?)');

    $pw = password_hash('password123', PASSWORD_DEFAULT);

    $staffSeeds = [
        ['Alex Artist', 'artist', $pw, 'Artist'],
        ['Eddie Editor', 'editor', $pw, 'Editor'],
        ['Ben Bindery', 'bindery', $pw, 'Bindery'],
        ['Anna Acrylic', 'acrylic', $pw, 'Acrylic'],
    ];

    foreach ($staffSeeds as $s) {
        $insertStaff->execute($s);
    }

    // Ensure two projects exist: Gens & Shaina, The Montgomery Wedding
    $getProject = $pdo->prepare('SELECT id FROM projects WHERE title = ? LIMIT 1');
    $insertProject = $pdo->prepare('INSERT INTO projects (title, description) VALUES (?, ?)');

    $projectsToEnsure = [
        ['Gens & Shaina', 'Seeded project entry.'],
        ['The Montgomery Wedding', 'Seeded demo project for dashboard.']
    ];

    $projectIds = [];
    foreach ($projectsToEnsure as $p) {
        $getProject->execute([$p[0]]);
        $row = $getProject->fetch(PDO::FETCH_ASSOC);
        if ($row && isset($row['id'])) {
            $projectIds[$p[0]] = (int)$row['id'];
        } else {
            $insertProject->execute([$p[0], $p[1]]);
            $projectIds[$p[0]] = (int)$pdo->lastInsertId();
        }
    }

    // Lookup staff IDs for seeded usernames
    $getStaffId = $pdo->prepare('SELECT id FROM staff_accounts WHERE username = ? LIMIT 1');
    $usernames = ['artist', 'editor', 'bindery', 'acrylic'];
    $staffIds = [];
    foreach ($usernames as $u) {
        $getStaffId->execute([$u]);
        $r = $getStaffId->fetch(PDO::FETCH_ASSOC);
        $staffIds[$u] = $r ? (int)$r['id'] : null;
    }

    // Insert assignments per requirements
    $insertAssign = $pdo->prepare('INSERT IGNORE INTO project_assignments (project_id, staff_id, assigned_role) VALUES (?, ?, ?)');

    // Assign 'artist' to Project 1 (Gens & Shaina) as Artist
    if (!empty($staffIds['artist']) && !empty($projectIds['Gens & Shaina'])) {
        $insertAssign->execute([$projectIds['Gens & Shaina'], $staffIds['artist'], 'Artist']);
    }

    // Assign 'editor' to Project 1 (Gens & Shaina) as Editor
    if (!empty($staffIds['editor']) && !empty($projectIds['Gens & Shaina'])) {
        $insertAssign->execute([$projectIds['Gens & Shaina'], $staffIds['editor'], 'Editor']);
    }

    // Assign 'artist' to Project 2 (The Montgomery Wedding) as Artist
    if (!empty($staffIds['artist']) && !empty($projectIds['The Montgomery Wedding'])) {
        $insertAssign->execute([$projectIds['The Montgomery Wedding'], $staffIds['artist'], 'Artist']);
    }

    // Intentionally do NOT assign 'bindery' or 'editor' to Project 2

    echo "Database setup successful!\n";

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    exit(1);
}

?>
