<?php

$questions = [
    ['question' => 'What does HTTP stand for?', 'options' => ['A) HyperText Transfer Protocol', 'B) HyperText Transfer Platform', 'C) High Transfer Text Protocol'], 'correct' => 'A'],
    ['question' => 'What is the primary function of an operating system?', 'options' => ['A) To perform calculations', 'B) To manage hardware and software resources', 'C) To store data'], 'correct' => 'B'],
    ['question' => 'Which of these is a programming language?', 'options' => ['A) HTML', 'B) Python', 'C) SQL'], 'correct' => 'B'],
    ['question' => 'What does RAM stand for?', 'options' => ['A) Random Access Memory', 'B) Read Access Memory', 'C) Run Active Memory'], 'correct' => 'A'],
    ['question' => 'Which of these is a database management system?', 'options' => ['A) MySQL', 'B) Apache', 'C) Linux'], 'correct' => 'A'],
    ['question' => 'What is the purpose of a firewall?', 'options' => ['A) To cool down a system', 'B) To secure a network from unauthorized access', 'C) To improve performance'], 'correct' => 'B'],
    ['question' => 'Which protocol is used for email retrieval?', 'options' => ['A) IMAP', 'B) FTP', 'C) HTTP'], 'correct' => 'A'],
    ['question' => 'What is the binary representation of the number 5?', 'options' => ['A) 101', 'B) 110', 'C) 100'], 'correct' => 'A'],
    ['question' => 'Which of the following is an example of cloud storage?', 'options' => ['A) Dropbox', 'B) Windows', 'C) Photoshop'], 'correct' => 'A'],
    ['question' => 'Which company developed the Java programming language?', 'options' => ['A) Oracle', 'B) Microsoft', 'C) IBM'], 'correct' => 'A']
];


$score = 0;
$total_questions = count($questions);
$user_answers = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_answers = $_POST['answers'] ?? [];
    foreach ($questions as $index => $question) {
        if (isset($user_answers[$index]) && $user_answers[$index] === $question['correct']) {
            $score++;
        }
    }
    $percentage = ($score / $total_questions) * 100;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-bottom: 15px;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            alert("You scored <?php echo $score; ?> out of <?php echo $total_questions; ?> (<?php echo number_format($percentage, 2); ?>%).");
        <?php endif; ?>
    </script>
</head>
<body>
    <h1>IT Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_IT.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_IT.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <p><strong>Q<?php echo $index + 1; ?>: <?php echo $question['question']; ?></strong></p>
                <?php foreach ($question['options'] as $key => $option): ?>
                    <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo chr(65 + $key); ?>" required>
                    <label><?php echo $option; ?></label><br>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <br>
            <input type="submit" value="Submit Quiz">
        </form>
    <?php endif; ?>
    <a href="../controller/logout.php">Logout</a>
</body>
</html>
