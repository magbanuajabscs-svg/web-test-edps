<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Database.php';

header('Content-Type: application/json; charset=utf-8');
$db = Database::getInstance();
$conn = $db->getConnection();

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? null;

try {
    if ($action === 'unread_count') {
        $row = $db->fetch('SELECT COUNT(*) AS cnt FROM notifications WHERE staff_id = ? AND status = ?', [$userId, 'unread']);
        $cnt = intval($row['cnt'] ?? 0);
        echo json_encode(['success' => true, 'unread' => $cnt]);
        exit;
    }

    if ($action === 'list') {
        $notes = $db->fetchAll('SELECT id, title, message, project_id, type, status, created_at FROM notifications WHERE staff_id = ? ORDER BY created_at DESC LIMIT 100', [$userId]);
        echo json_encode(['success' => true, 'notifications' => $notes]);
        exit;
    }

    // mark single or multiple read
    if ($action === 'mark_read') {
        $input = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!empty($input['id'])) {
            $db->update('UPDATE notifications SET status = ? WHERE id = ? AND staff_id = ?', ['read', intval($input['id']), $userId]);
            echo json_encode(['success' => true]);
            exit;
        }
        if (!empty($input['ids']) && is_array($input['ids'])) {
            $placeholders = rtrim(str_repeat('?,', count($input['ids'])), ',');
            $params = array_map('intval', $input['ids']);
            // append status and staff_id
            $sql = "UPDATE notifications SET status = 'read' WHERE id IN ($placeholders) AND staff_id = ?";
            $params[] = $userId;
            $db->query($sql, $params);
            echo json_encode(['success' => true]);
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'No id(s) provided']);
        exit;
    }

    if ($action === 'mark_unread') {
        $input = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!empty($input['id'])) {
            $db->update('UPDATE notifications SET status = ? WHERE id = ? AND staff_id = ?', ['unread', intval($input['id']), $userId]);
            echo json_encode(['success' => true]);
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'No id provided']);
        exit;
    }

    if ($action === 'mark_all_read') {
        $db->update('UPDATE notifications SET status = ? WHERE staff_id = ? AND status = ?', ['read', $userId, 'unread']);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete') {
        $input = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!empty($input['id'])) {
            $deleted = $db->delete('DELETE FROM notifications WHERE id = ? AND staff_id = ?', [intval($input['id']), $userId]);
            if ($deleted) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Not found or not allowed']);
            }
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'No id provided']);
        exit;
    }

    if ($action === 'create_sample') {
        // Allow creating sample notifications for the current user (UI/testing)
        $title = $_POST['title'] ?? 'Sample Notification';
        $message = $_POST['message'] ?? 'This is a sample notification.';
        $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : null;
        $db->insert('INSERT INTO notifications (staff_id, project_id, title, message, type, status) VALUES (?, ?, ?, ?, ?, ?)', [$userId, $project_id, $title, $message, 'sample', 'unread']);
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

?>
