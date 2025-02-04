<?php
session_start();
require_once('../model/userModel.php');

$search_term = '';
if (isset($_POST['mydata'])) {
    $data = json_decode($_POST['mydata'], true);
    if (isset($data['search_term'])) {
        $search_term = $data['search_term'];
    }
}

$con = getConnection();


if (!empty($search_term)) {
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE (title LIKE ? OR description LIKE ?) AND status = 'approved'");
    $like_term = '%' . $search_term . '%';
    $stmt->bind_param('ss', $like_term, $like_term);
} else {
   
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE status = 'approved'");
}

$stmt->execute();
$jobs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


$stmt->close();
$con->close();

echo json_encode($jobs);

