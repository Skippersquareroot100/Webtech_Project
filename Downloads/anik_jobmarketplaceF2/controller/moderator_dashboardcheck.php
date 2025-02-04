<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'moderator') {
    header('Location: ../view/login.html');
    exit;
}

$con = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['approve_job_id'])) {
        $job_id = intval($data['approve_job_id']);
        $stmt = $con->prepare("UPDATE anik_jobs SET status = 'approved' WHERE id = ?");
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => true]);
    } elseif (isset($data['reject_job_id'])) {
        $job_id = intval($data['reject_job_id']);
        $stmt = $con->prepare("DELETE FROM anik_jobs WHERE id = ?");
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => true]);
    } elseif (isset($data['ban_user_id'])) {
        $user_id = intval($data['ban_user_id']);
        $stmt = $con->prepare("UPDATE anik_users SET role = 'banned' WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => true]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'fetch_jobs') {
        $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE status = 'pending'");
        $stmt->execute();
        $jobs_result = $stmt->get_result();

        $jobs = [];
        while ($job = $jobs_result->fetch_assoc()) {
            $jobs[] = $job;
        }
        
        echo json_encode(['jobs' => $jobs]);
    }

    if (isset($_GET['action']) && $_GET['action'] === 'fetch_users') {
        $stmt = $con->prepare("SELECT id, username, role FROM anik_users WHERE role != 'moderator'");
        $stmt->execute();
        $users_result = $stmt->get_result();

        $users = [];
        while ($user = $users_result->fetch_assoc()) {
            $users[] = $user;
        }

        echo json_encode(['users' => $users]);
    }
}

$con->close();
?>
