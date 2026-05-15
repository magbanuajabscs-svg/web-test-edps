<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config.php';
require_once '../Database.php';
require_once '../Staff.php';

$method = $_SERVER['REQUEST_METHOD'];
$staff = new Staff();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $staff->getStaffById($_GET['id']);
        } else {
            $result = $staff->getAllStaff();
        }
        echo json_encode($result);
        break;

    case 'POST':
        // Support project report submissions: ?action=report_project
        if (isset($_GET['action']) && $_GET['action'] === 'report_project') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['staff_id'], $data['project_id'], $data['reason'])) {
                $db = Database::getInstance();
                try {
                    $insertId = $db->insert(
                        "INSERT INTO project_reports (project_id, staff_id, reason, created_at) VALUES (?, ?, ?, NOW())",
                        [$data['project_id'], $data['staff_id'], $data['reason']]
                    );
                    echo json_encode(['success' => true, 'message' => 'Report submitted', 'id' => $insertId]);
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Failed to submit report: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            }
            break;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $result = $staff->addStaff($data);
            echo json_encode(['success' => $result, 'message' => $result ? 'Staff added successfully' : 'Failed to add staff']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
        }
        break;

    case 'PUT':
        if (isset($_GET['action']) && $_GET['action'] === 'update_theme') {
            // Handle theme preference update
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['theme_preference']) && isset($data['staff_id'])) {
                $db = Database::getInstance();
                $theme = in_array($data['theme_preference'], ['light', 'dark']) ? $data['theme_preference'] : 'light';
                $result = $db->update(
                    "UPDATE staff SET theme_preference = ? WHERE id = ?",
                    [$theme, $data['staff_id']]
                );
                echo json_encode([
                    'success' => $result > 0,
                    'message' => $result > 0 ? 'Theme updated successfully' : 'Failed to update theme',
                    'theme_preference' => $theme
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Missing theme_preference or staff_id']);
            }
            break;
        }

        // Update assignment status: ?action=update_assignment_status
        if (isset($_GET['action']) && $_GET['action'] === 'update_assignment_status') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['staff_id'], $data['project_id'], $data['status'])) {
                $db = Database::getInstance();
                try {
                    $count = $db->update(
                        "UPDATE project_assignments SET status = ? WHERE staff_id = ? AND project_id = ?",
                        [$data['status'], $data['staff_id'], $data['project_id']]
                    );
                    echo json_encode(['success' => $count > 0, 'updated' => $count]);
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Failed to update assignment: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            }
            break;
        }

        // Allow setting a temporary profile image (stored in session) so previews apply across pages
        if (isset($_GET['action']) && $_GET['action'] === 'set_temp_profile') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['data']) && is_string($data['data'])) {
                // basic validation: must be a data URL for an image
                if (preg_match('#^data:image/(png|jpeg|jpg|gif);base64,#i', $data['data'])) {
                    $_SESSION['profile_image'] = $data['data'];
                    echo json_encode(['success' => true, 'message' => 'Temporary profile image set']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid image data']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Missing image data']);
            }
            break;
        }
        } elseif (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data) {
                $result = $staff->updateStaff($_GET['id'], $data);
                echo json_encode(['success' => $result, 'message' => $result ? 'Staff updated successfully' : 'Failed to update staff']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Staff ID or action required']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $staff->deleteStaff($_GET['id']);
            echo json_encode(['success' => $result, 'message' => $result ? 'Staff deleted successfully' : 'Failed to delete staff']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Staff ID required']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        break;
}
?>