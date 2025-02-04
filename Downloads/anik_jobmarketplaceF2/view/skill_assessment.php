<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Sector</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9f7e4; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            color: #2c6b2f; 
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            color: #4a9d42; 
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        form {
            margin: 0;
        }

        button {
            padding: 15px 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background-color: #4CAF50; 
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049; 
        }

        a {
            display: inline-block;
            margin-top: 30px;
            color: #2c6b2f; 
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h1>Welcome to the Skill Assessment</h1>
        <p>Select your sector to begin the quiz:</p>

        <div class="form-container">
            
            <form action="quiz_IT.php" method="GET">
                <button type="submit" name="sector" value="IT">IT</button>
            </form>
            <form action="quiz_Engineering.php" method="GET">
                <button type="submit" name="sector" value="Engineering">Engineering</button>
            </form>
            <form action="quiz_Medical.php" method="GET">
                <button type="submit" name="sector" value="Medical">Medical</button>
            </form>
            <form action="quiz_Marketing.php" method="GET">
                <button type="submit" name="sector" value="Marketing">Marketing</button>
            </form>
            <form action="quiz_Sales.php" method="GET">
                <button type="submit" name="sector" value="Sales">Sales</button>
            </form>
            <form action="quiz_Design.php" method="GET">
                <button type="submit" name="sector" value="Design">Design</button>
            </form>
            <form action="quiz_Finance.php" method="GET">
                <button type="submit" name="sector" value="Finance">Finance</button>
            </form>
        </div>

        <a href="../controller/logout.php">Logout</a>
    </div>
</body>
</html>
