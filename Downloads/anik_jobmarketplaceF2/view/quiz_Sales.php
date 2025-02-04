<?php

$questions = [
    ['question' => 'What is the primary goal of sales?', 'options' => ['A) To close deals and generate revenue', 'B) To manage finances', 'C) To create advertisements'], 'correct' => 'A'],
    ['question' => 'What is a sales pipeline?', 'options' => ['A) A visual representation of sales stages', 'B) A physical channel for products', 'C) A marketing tool'], 'correct' => 'A'],
    ['question' => 'What is an upsell?', 'options' => ['A) Selling a higher-priced item', 'B) Selling additional items', 'C) Offering a discount'], 'correct' => 'A'],
    ['question' => 'Which skill is essential for a salesperson?', 'options' => ['A) Communication', 'B) Coding', 'C) Graphic Design'], 'correct' => 'A'],
    ['question' => 'What does CRM stand for?', 'options' => ['A) Customer Relationship Management', 'B) Cost Reduction Management', 'C) Corporate Resource Management'], 'correct' => 'A'],
    ['question' => 'What is a lead in sales?', 'options' => ['A) A potential customer', 'B) A team leader', 'C) A product line'], 'correct' => 'A'],
    ['question' => 'What is cold calling?', 'options' => ['A) Calling a prospect without prior contact', 'B) Calling a customer for a survey', 'C) Following up with an existing client'], 'correct' => 'A'],
    ['question' => 'What is cross-selling?', 'options' => ['A) Selling additional products related to the initial purchase', 'B) Offering a replacement product', 'C) Selling a warranty'], 'correct' => 'A'],
    ['question' => 'Which tool is commonly used for sales tracking?', 'options' => ['A) Salesforce', 'B) Photoshop', 'C) Final Cut Pro'], 'correct' => 'A'],
    ['question' => 'What is the term for a finalized sale?', 'options' => ['A) Closed deal', 'B) Open deal', 'C) Negotiation'], 'correct' => 'A']
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
    <title>Sales Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
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
    <h1>Sales Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_Sales.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_Sales.php" method="POST">
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
