<?php
function getConnection() {
    $con = new mysqli('127.0.0.1', 'root', 'root', 'jobmarketplace', 8889);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}

function addUser($username, $password, $email, $role) {
    $con = getConnection();
    $sql = "INSERT INTO anik_users (username, password, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssss', $username, $password, $email, $role);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
    $con->close();
}
?>
