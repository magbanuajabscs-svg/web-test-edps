<?php
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Create staff table if missing (matches blueprint)
    $createStaff = <<<SQL
CREATE TABLE IF NOT EXISTS staff (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  role ENUM('photographer','editor','assistant','manager') NOT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  join_date DATE NOT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  profile_image VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL;
    $pdo->exec($createStaff);

    // Create project_assignments table (matches blueprint)
    $createAssign = <<<SQL
CREATE TABLE IF NOT EXISTS project_assignments (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  project_id INT(11) NOT NULL,
  staff_id INT(11) NOT NULL,
  role_in_project VARCHAR(100) DEFAULT NULL,
  assigned_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('assigned','completed','removed') DEFAULT 'assigned',
  UNIQUE KEY unique_assignment (project_id, staff_id),
  KEY idx_project_assignments_project (project_id),
  KEY idx_project_assignments_staff (staff_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL;
    $pdo->exec($createAssign);

    // Add foreign keys (attempt safe alter, ignore if already present)
    try {
        $pdo->exec("ALTER TABLE project_assignments ADD CONSTRAINT fk_pa_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE");
    } catch (PDOException $e) {
        // ignore if already exists or fails
    }
    try {
        $pdo->exec("ALTER TABLE project_assignments ADD CONSTRAINT fk_pa_staff FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE");
    } catch (PDOException $e) {
        // ignore if already exists or fails
    }

    echo "Migration completed (staff + project_assignments).\n";

} catch (PDOException $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}

?>
