<?php
session_start();
require_once('../model/usermodel.php'); 

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $con = getConnection(); 

    $stmt = $con->prepare("SELECT id, username, role, password FROM anik_users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($username === 'anik' && $user['role'] === 'moderator' && $password === '123') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            $response['success'] = true;
            $response['message'] = 'Login successful!';
            $response['redirect_url'] = '../view/moderator_dashboard.html';
        } 
        else if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            $response['success'] = true;
            $response['message'] = 'Login successful!';

            switch ($user['role']) {
                case 'applicant':
                    $response['redirect_url'] = '../view/applicant_dashboard.php';
                    break;
                case 'employee':
                    $response['redirect_url'] = '../view/employee_dashboard.html';
                    break;
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Incorrect password.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'No account found with that username.';
    }

    $stmt->close();
    $con->close();
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
?>
