<?php
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    $response = array();

    if (empty($username) || empty($password) || empty($email) || empty($confirmPassword)) {
        $response['message'] = 'All fields are required!';
    } else {
        if (!preg_match("/^[a-zA-Z]{2,}$/", $username)) {
            $response['message'] = 'Username must be at least 2 characters long and contain only letters.';
        } else {
            if ($password !== $confirmPassword) {
                $response['message'] = 'Passwords do not match!';
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['message'] = 'Please enter a valid email address.';
                } else {
                    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/\d/", $password)) {
                        $response['message'] = 'Password must be at least 8 characters long and include a mix of uppercase, lowercase, and numbers.';
                    } else {
                        $status = addUser($username, password_hash($password, PASSWORD_DEFAULT), $email, $role);
                        if ($status) {
                            $response['success'] = true;
                            $response['message'] = 'Registration successful!';
                        } else {
                            $response['message'] = 'Error: User could not be added.';
                        }
                    }
                }
            }
        }
    }
    

    echo json_encode($response);
}
?>
