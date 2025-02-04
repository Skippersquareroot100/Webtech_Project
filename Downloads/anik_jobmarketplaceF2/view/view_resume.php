<?php

if (isset($_GET['data'])) {
 
    $resume_data = json_decode(urldecode($_GET['data']), true);
} else {
    die("No resume data found.");
}


$name = htmlspecialchars($resume_data['name']);
$email = htmlspecialchars($resume_data['email']);
$phone = htmlspecialchars($resume_data['phone']);
$address = htmlspecialchars($resume_data['address']);
$qualification = htmlspecialchars($resume_data['qualification']);
$profile_picture = htmlspecialchars($resume_data['profile_picture']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f7f7f7;
        }

        h2 {
            color: #333;
        }

        .resume-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: auto;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .download-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
        }

        .download-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Your Resume</h2>
    <div class="resume-container">
        <?php if ($profile_picture): ?>
            <img src="uploads/<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-picture"><br><br>
        <?php endif; ?>

        <h3>Name: <?php echo $name; ?></h3>
        <p>Email: <?php echo $email; ?></p>
        <p>Phone: <?php echo $phone; ?></p>
        <p>Address: <?php echo nl2br($address); ?></p>
        <p>Qualification: <?php echo nl2br($qualification); ?></p>

      
        <a href="download_resume.php?data=<?php echo urlencode(json_encode($resume_data)); ?>" class="download-btn">Download Resume</a>
    </div>

</body>
</html>
