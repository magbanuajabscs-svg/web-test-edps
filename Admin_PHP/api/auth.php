<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once '../config.php';
require_once '../Database.php';
require_once '../User.php';

session_start();

$method = $_SERVER['REQUEST_METHOD'];
$user = new User();

switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['action'])) {
            switch ($data['action']) {
                case 'login':
                    if (isset($data['username']) && isset($data['password'])) {
                        $result = $user->authenticate($data['username'], $data['password']);
                        if ($result) {
                            $_SESSION['user_id'] = $result['id'];
                            $_SESSION['username'] = $result['username'];
                            $_SESSION['role'] = $result['role'];
                            echo json_encode(['success' => true, 'message' => 'Login successful', 'user' => $result]);
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Username and password required']);
                    }
                    break;

                case 'logout':
                    session_destroy();
                    echo json_encode(['success' => true, 'message' => 'Logout successful']);
                    break;

                case 'check_session':
                    if (isset($_SESSION['user_id'])) {
                        echo json_encode(['success' => true, 'user' => [
                            'id' => $_SESSION['user_id'],
                            'username' => $_SESSION['username'],
                            'role' => $_SESSION['role']
                        ]]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Not logged in']);
                    }
                    break;

                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid action']);
                    break;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Action required']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        break;
}
?>