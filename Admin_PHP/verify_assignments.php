<?php
require_once __DIR__ . '/Database.php';

$db = Database::getInstance();

try {
    // Check if project_assignments has 'assigned_role' column
    $hasAssignedRole = false;
    try {
        // Debug: list staff_accounts
        $staffList = $db->fetchAll("SELECT id, username, full_name, role FROM staff_accounts ORDER BY id");
        echo "\nStaff accounts:\n";
        foreach ($staffList as $s) {
            echo "  - [{$s['id']}] {$s['username']} ({$s['full_name']}) role={$s['role']}\n";
        }

        // Debug: list project_assignments rows
        $paRows = $db->fetchAll("SELECT * FROM project_assignments ORDER BY id");
        echo "\nproject_assignments rows:\n";
        if (empty($paRows)) {
            echo "  (no assignment rows)\n";
        } else {
            foreach ($paRows as $ar) {
                echo "  - [{$ar['id']}] project_id={$ar['project_id']} staff_id={$ar['staff_id']} assigned_role=" . ($ar['assigned_role'] ?? '(null)') . "\n";
            }
        }

        $col = $db->fetch("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'project_assignments' AND COLUMN_NAME = 'assigned_role'");
        $hasAssignedRole = !empty($col);
    } catch (Exception $e) { /* ignore */ }

    if ($hasAssignedRole) {
        $rows = $db->fetchAll("SELECT p.id AS project_id, p.title, pa.staff_id, pa.assigned_role, sa.username, sa.full_name
            FROM projects p
            LEFT JOIN project_assignments pa ON pa.project_id = p.id
            LEFT JOIN staff_accounts sa ON sa.id = pa.staff_id
            ORDER BY p.id, pa.id");
    } else {
        // Fallback if assigned_role column missing
        $rows = $db->fetchAll("SELECT p.id AS project_id, p.title, pa.staff_id, sa.username, sa.full_name
            FROM projects p
            LEFT JOIN project_assignments pa ON pa.project_id = p.id
            LEFT JOIN staff_accounts sa ON sa.id = pa.staff_id
            ORDER BY p.id, pa.id");
    }

    if (empty($rows)) {
        echo "No projects found.\n";
        exit(0);
    }

    $current = null;
    foreach ($rows as $r) {
        if ($current !== $r['project_id']) {
            $current = $r['project_id'];
            echo "Project {$r['project_id']}: {$r['title']}\n";
            echo "  Assignments:\n";
        }
        if (!empty($r['staff_id'])) {
            echo "    - {$r['assigned_role']}: {$r['full_name']} ({$r['username']}) [staff_id={$r['staff_id']}]\n";
        } else {
            echo "    - (no assignments)\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
