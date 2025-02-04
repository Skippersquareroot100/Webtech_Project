<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $profile_picture = '';


    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_picture = basename($_FILES["profile_picture"]["name"]);
    }

   
    $resume_data = json_encode([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'qualification' => $qualification,
        'profile_picture' => $profile_picture
    ]);

    
    header("Location: view_resume.php?data=" . urlencode($resume_data));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder</title>
    <style>
      
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f7f7f7;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 5px 0;
        }

        input[type="text"], input[type="email"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Create Your Resume</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Name: </label><br>
        <input type="text" name="name" required><br><br>

        <label>Email: </label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone: </label><br>
        <input type="text" name="phone" required><br><br>

        <label>Address: </label><br>
        <textarea name="address" required></textarea><br><br>

        <label>Qualification: </label><br>
        <textarea name="qualification" required></textarea><br><br>

        <label>Profile Picture: </label><br>
        <input type="file" name="profile_picture" accept="image/*"><br><br>

        <input type="submit" value="Submit">
    </form>

    <a href="../controller/logout.php">Logout</a>
</body>
</html>
