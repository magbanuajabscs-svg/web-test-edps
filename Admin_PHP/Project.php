<?php
require_once 'Database.php';

class Project {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Get all projects
    public function getAll($status = null) {
        $sql = "SELECT * FROM projects";
        $params = [];

        if ($status) {
            $sql .= " WHERE status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY created_at DESC";
        return $this->db->fetchAll($sql, $params);
    }

    // Get project by ID with staff assignments
    public function getById($id) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $project = $this->db->fetch($sql, [$id]);

        if ($project) {
            $project['assigned_staff'] = $this->getAssignedStaff($id);
        }

        return $project;
    }

    // Create new project
    public function create($data) {
        $sql = "INSERT INTO projects (name, description, event_date, status, budget, location, client_name, client_email, client_phone, notes)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            sanitize($data['name']),
            sanitize($data['description'] ?? ''),
            $data['event_date'] ?? null,
            $data['status'] ?? 'planning',
            $data['budget'] ?? null,
            sanitize($data['location'] ?? ''),
            sanitize($data['client_name'] ?? ''),
            sanitize($data['client_email'] ?? ''),
            sanitize($data['client_phone'] ?? ''),
            sanitize($data['notes'] ?? '')
        ];
        return $this->db->insert($sql, $params);
    }

    // Update project
    public function update($id, $data) {
        $sql = "UPDATE projects SET
                name = ?, description = ?, event_date = ?, status = ?, budget = ?,
                location = ?, client_name = ?, client_email = ?, client_phone = ?,
                notes = ?, updated_at = CURRENT_TIMESTAMP
                WHERE id = ?";
        $params = [
            sanitize($data['name']),
            sanitize($data['description'] ?? ''),
            $data['event_date'] ?? null,
            $data['status'] ?? 'planning',
            $data['budget'] ?? null,
            sanitize($data['location'] ?? ''),
            sanitize($data['client_name'] ?? ''),
            sanitize($data['client_email'] ?? ''),
            sanitize($data['client_phone'] ?? ''),
            sanitize($data['notes'] ?? ''),
            $id
        ];
        return $this->db->update($sql, $params);
    }

    // Delete project
    public function delete($id) {
        $sql = "DELETE FROM projects WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    // Assign staff to project
    public function assignStaff($projectId, $staffId, $role = null) {
        $sql = "INSERT INTO project_assignments (project_id, staff_id, role_in_project)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE role_in_project = VALUES(role_in_project), status = 'assigned'";
        return $this->db->insert($sql, [$projectId, $staffId, $role]);
    }

    // Remove staff from project
    public function removeStaff($projectId, $staffId) {
        $sql = "UPDATE project_assignments SET status = 'removed' WHERE project_id = ? AND staff_id = ?";
        return $this->db->update($sql, [$projectId, $staffId]);
    }

    // Get assigned staff for project
    public function getAssignedStaff($projectId) {
        $sql = "SELECT s.*, pa.role_in_project, pa.assigned_date
                FROM staff s
                JOIN project_assignments pa ON s.id = pa.staff_id
                WHERE pa.project_id = ? AND pa.status = 'assigned'
                ORDER BY s.name ASC";
        return $this->db->fetchAll($sql, [$projectId]);
    }

    // Get available staff (not assigned to this project)
    public function getAvailableStaff($projectId) {
        $sql = "SELECT * FROM staff
                WHERE status = 'active'
                AND id NOT IN (
                    SELECT staff_id FROM project_assignments
                    WHERE project_id = ? AND status = 'assigned'
                )
                ORDER BY name ASC";
        return $this->db->fetchAll($sql, [$projectId]);
    }

    // Search projects
    public function search($query) {
        $sql = "SELECT * FROM projects
                WHERE name LIKE ? OR description LIKE ? OR client_name LIKE ?
                ORDER BY created_at DESC";
        $searchTerm = "%$query%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }

    // Get project statistics
    public function getStats() {
        $sql = "SELECT
                COUNT(*) as total_projects,
                COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed,
                COUNT(CASE WHEN status = 'in_progress' THEN 1 END) as in_progress,
                COUNT(CASE WHEN status = 'planning' THEN 1 END) as planning,
                SUM(budget) as total_budget
                FROM projects";
        return $this->db->fetch($sql);
    }

    // Get recent projects
    public function getRecent($limit = 5) {
        $sql = "SELECT * FROM projects ORDER BY created_at DESC LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }

    // Update project status
    public function updateStatus($id, $status) {
        $sql = "UPDATE projects SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        return $this->db->update($sql, [$status, $id]);
    }
}
?>