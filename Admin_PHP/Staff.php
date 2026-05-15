<?php
require_once 'Database.php';

class Staff {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Get all staff members
    public function getAll($status = 'active') {
        $sql = "SELECT * FROM staff WHERE status = ? ORDER BY name ASC";
        return $this->db->fetchAll($sql, [$status]);
    }

    // Get staff member by ID
    public function getById($id) {
        $sql = "SELECT * FROM staff WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    // Create new staff member
    public function create($data) {
        $sql = "INSERT INTO staff (name, email, role, phone, join_date, status, profile_image)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            sanitize($data['name']),
            sanitize($data['email']),
            $data['role'],
            sanitize($data['phone'] ?? ''),
            $data['join_date'],
            $data['status'] ?? 'active',
            $data['profile_image'] ?? null
        ];
        return $this->db->insert($sql, $params);
    }

    // Update staff member
    public function update($id, $data) {
        $sql = "UPDATE staff SET
                name = ?, email = ?, role = ?, phone = ?, join_date = ?,
                status = ?, profile_image = ?, updated_at = CURRENT_TIMESTAMP
                WHERE id = ?";
        $params = [
            sanitize($data['name']),
            sanitize($data['email']),
            $data['role'],
            sanitize($data['phone'] ?? ''),
            $data['join_date'],
            $data['status'] ?? 'active',
            $data['profile_image'] ?? null,
            $id
        ];
        return $this->db->update($sql, $params);
    }

    // Delete staff member
    public function delete($id) {
        $sql = "UPDATE staff SET status = 'inactive', updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        return $this->db->update($sql, [$id]);
    }

    // Get staff workload (active projects)
    public function getWorkload($id) {
        $sql = "SELECT COUNT(pa.project_id) as active_projects
                FROM project_assignments pa
                JOIN projects p ON pa.project_id = p.id
                WHERE pa.staff_id = ? AND pa.status = 'assigned'
                AND p.status IN ('planning', 'in_progress')";
        $result = $this->db->fetch($sql, [$id]);
        return $result['active_projects'] ?? 0;
    }

    // Get staff projects
    public function getProjects($id) {
        $sql = "SELECT p.*, pa.role_in_project, pa.assigned_date
                FROM projects p
                JOIN project_assignments pa ON p.id = pa.project_id
                WHERE pa.staff_id = ? AND pa.status = 'assigned'
                ORDER BY p.event_date DESC";
        return $this->db->fetchAll($sql, [$id]);
    }

    // Search staff
    public function search($query) {
        $sql = "SELECT * FROM staff
                WHERE (name LIKE ? OR email LIKE ? OR role LIKE ?)
                AND status = 'active'
                ORDER BY name ASC";
        $searchTerm = "%$query%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }

    // Get staff statistics
    public function getStats() {
        $sql = "SELECT
                COUNT(CASE WHEN status = 'active' THEN 1 END) as total_active,
                COUNT(CASE WHEN role = 'photographer' AND status = 'active' THEN 1 END) as photographers,
                COUNT(CASE WHEN role = 'editor' AND status = 'active' THEN 1 END) as editors,
                COUNT(CASE WHEN role = 'assistant' AND status = 'active' THEN 1 END) as assistants,
                COUNT(CASE WHEN role = 'manager' AND status = 'active' THEN 1 END) as managers
                FROM staff";
        return $this->db->fetch($sql);
    }

    // Add new staff member (alternative method for form registration)
    public function addStaff($data) {
        $sql = "INSERT INTO staff (name, email, username, role, password, join_date, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            sanitize($data['full_name'] ?? ''),
            sanitize($data['email'] ?? ''),
            sanitize($data['username'] ?? ''),
            sanitize($data['role'] ?? ''),
            $data['password'] ?? '',
            date('Y-m-d'),
            'active'
        ];
        return $this->db->insert($sql, $params);
    }
}
?>