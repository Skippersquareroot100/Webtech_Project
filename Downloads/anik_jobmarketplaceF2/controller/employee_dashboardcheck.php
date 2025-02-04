<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$employee_id = $_SESSION['user_id'];
$con = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $title = trim($data['title']);
    $description = trim($data['description']);
    $location = trim($data['location']);

    if ($title && $description && $location) {
        $stmt = $con->prepare("INSERT INTO anik_jobs (title, description, location, employee_id, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param('sssi', $title, $description, $location, $employee_id);
        $stmt->execute();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE employee_id = ?");
    $stmt->bind_param('i', $employee_id);
    $stmt->execute();
    $jobs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['jobs' => $jobs]);
}
?>
