<?php

$questions = [
    ['question' => 'What is the normal human body temperature?', 'options' => ['A) 37°C', 'B) 35°C', 'C) 40°C'], 'correct' => 'A'],
    ['question' => 'Which organ is responsible for pumping blood?', 'options' => ['A) Heart', 'B) Liver', 'C) Kidney'], 'correct' => 'A'],
    ['question' => 'What does DNA stand for?', 'options' => ['A) Deoxyribonucleic Acid', 'B) Dicarboxylic Nucleic Acid', 'C) Diatomic Nitrogen Acid'], 'correct' => 'A'],
    ['question' => 'Which blood type is known as the universal donor?', 'options' => ['A) O-', 'B) AB+', 'C) A+'], 'correct' => 'A'],
    ['question' => 'What is the largest organ in the human body?', 'options' => ['A) Skin', 'B) Liver', 'C) Lungs'], 'correct' => 'A'],
    ['question' => 'What is the main function of red blood cells?', 'options' => ['A) Transport oxygen', 'B) Fight infection', 'C) Clot blood'], 'correct' => 'A'],
    ['question' => 'Which system controls the body’s responses to stimuli?', 'options' => ['A) Nervous system', 'B) Endocrine system', 'C) Respiratory system'], 'correct' => 'A'],
    ['question' => 'What is the smallest unit of life?', 'options' => ['A) Cell', 'B) Atom', 'C) Tissue'], 'correct' => 'A'],
    ['question' => 'Which part of the eye is responsible for focusing light?', 'options' => ['A) Lens', 'B) Retina', 'C) Cornea'], 'correct' => 'A'],
    ['question' => 'Which disease is caused by a lack of Vitamin C?', 'options' => ['A) Scurvy', 'B) Rickets', 'C) Beriberi'], 'correct' => 'A']
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
    <title>Medical Quiz</title>
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
    <h1>Medical Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_Medical.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_Medical.php" method="POST">
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
