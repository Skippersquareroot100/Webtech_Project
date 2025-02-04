<?php
$questions = [
    ['question' => 'What does UX stand for?', 'options' => ['A) User Experience', 'B) Unique Expression', 'C) User Experiment'], 'correct' => 'A'],
    ['question' => 'What tool is commonly used for graphic design?', 'options' => ['A) Adobe Photoshop', 'B) Microsoft Excel', 'C) AutoCAD'], 'correct' => 'A'],
    ['question' => 'What is a wireframe in design?', 'options' => ['A) A blueprint of a design layout', 'B) A type of framework', 'C) A color scheme'], 'correct' => 'A'],
    ['question' => 'Which principle relates to design symmetry?', 'options' => ['A) Balance', 'B) Proportion', 'C) Harmony'], 'correct' => 'A'],
    ['question' => 'What is the golden ratio in design?', 'options' => ['A) A mathematical ratio for aesthetics', 'B) A color combination', 'C) A tool for alignment'], 'correct' => 'A'],
    ['question' => 'What does RGB stand for?', 'options' => ['A) Red, Green, Blue', 'B) Rapid Graphic Build', 'C) Random Generated Blocks'], 'correct' => 'A'],
    ['question' => 'What is the purpose of typography?', 'options' => ['A) Arranging type to make text readable and appealing', 'B) Creating 3D designs', 'C) Developing UI components'], 'correct' => 'A'],
    ['question' => 'Which software is used for UI/UX design?', 'options' => ['A) Figma', 'B) MySQL', 'C) Java'], 'correct' => 'A'],
    ['question' => 'What is a mood board?', 'options' => ['A) A visual representation of a design concept', 'B) A tool for coding', 'C) A physical board for brainstorming'], 'correct' => 'A'],
    ['question' => 'Which format is best for scalable vector graphics?', 'options' => ['A) SVG', 'B) PNG', 'C) JPEG'], 'correct' => 'A']
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
    <title>Design Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
            padding: 0 15px;
        }

        form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        label {
            font-size: 16px;
            margin-right: 20px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 8px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            form {
                width: 90%;
            }

            h1 {
                font-size: 24px;
            }

            p, label {
                font-size: 14px;
            }
        }
    </style>
    <script>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            alert("You scored <?php echo $score; ?> out of <?php echo $total_questions; ?> (<?php echo number_format($percentage, 2); ?>%).");
        <?php endif; ?>
    </script>
</head>
<body>
    <h1>Design Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_Design.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_Design.php" method="POST">
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
