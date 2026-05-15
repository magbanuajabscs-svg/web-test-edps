<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Authenticate user
    public function authenticate($username, $password) {
        $sql = "SELECT id, username, email, role, password FROM users WHERE username = ? OR email = ?";
        $user = $this->db->fetch($sql, [$username, $username]);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // Remove password from session data
            return $user;
        }

        return false;
    }

    // Get user by ID
    public function getById($id) {
        $sql = "SELECT id, username, email, role, created_at FROM users WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    // Create new user
    public function create($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email, role)
                VALUES (?, ?, ?, ?)";
        $params = [
            sanitize($data['username']),
            $hashedPassword,
            sanitize($data['email']),
            $data['role'] ?? 'admin'
        ];
        return $this->db->insert($sql, $params);
    }

    // Update user
    public function update($id, $data) {
        $sql = "UPDATE users SET username = ?, email = ?, role = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $params = [
            sanitize($data['username']),
            sanitize($data['email']),
            $data['role'] ?? 'admin',
            $id
        ];
        return $this->db->update($sql, $params);
    }

    // Change password
    public function changePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        return $this->db->update($sql, [$hashedPassword, $id]);
    }

    // Delete user
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    // Get all users
    public function getAll() {
        $sql = "SELECT id, username, email, role, created_at FROM users ORDER BY username ASC";
        return $this->db->fetchAll($sql);
    }

    // Check if username/email exists
    public function exists($username, $email = null) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $params = [$username];

        if ($email) {
            $sql .= " OR email = ?";
            $params[] = $email;
        }

        return $this->db->fetch($sql, $params) !== false;
    }

    // Log activity
    public function logActivity($userId, $action, $description = null, $entityType = null, $entityId = null) {
        $sql = "INSERT INTO activity_log (user_id, action, description, entity_type, entity_id, ip_address)
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $userId,
            $action,
            $description,
            $entityType,
            $entityId,
            $_SERVER['REMOTE_ADDR'] ?? null
        ];
        return $this->db->insert($sql, $params);
    }

    // Get recent activity
    public function getRecentActivity($limit = 10) {
        $sql = "SELECT al.*, u.username
                FROM activity_log al
                LEFT JOIN users u ON al.user_id = u.id
                ORDER BY al.created_at DESC LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }
}
?>