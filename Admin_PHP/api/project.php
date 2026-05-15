<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config.php';
require_once '../Database.php';
require_once '../Project.php';

$method = $_SERVER['REQUEST_METHOD'];
$project = new Project();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $project->getProjectById($_GET['id']);
        } else {
            $result = $project->getAllProjects();
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $result = $project->addProject($data);
            echo json_encode(['success' => $result, 'message' => $result ? 'Project added successfully' : 'Failed to add project']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
        }
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data) {
                $result = $project->updateProject($_GET['id'], $data);
                echo json_encode(['success' => $result, 'message' => $result ? 'Project updated successfully' : 'Failed to update project']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Project ID required']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $project->deleteProject($_GET['id']);
            echo json_encode(['success' => $result, 'message' => $result ? 'Project deleted successfully' : 'Failed to delete project']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Project ID required']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        break;
}
?>