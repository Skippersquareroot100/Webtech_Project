<?php
$questions = [
    ['question' => 'What does ROI stand for in finance?', 'options' => ['A) Return On Investment', 'B) Rate Of Interest', 'C) Revenue On Income'], 'correct' => 'A'],
    ['question' => 'Which of the following is a financial statement?', 'options' => ['A) Balance Sheet', 'B) Marketing Plan', 'C) Design Layout'], 'correct' => 'A'],
    ['question' => 'What is the role of a budget?', 'options' => ['A) To plan income and expenses', 'B) To design a logo', 'C) To market products'], 'correct' => 'A'],
    ['question' => 'Which of these is a fixed expense?', 'options' => ['A) Rent', 'B) Groceries', 'C) Utility Bills'], 'correct' => 'A'],
    ['question' => 'What is compound interest?', 'options' => ['A) Interest calculated on both principal and accrued interest', 'B) Interest only on the principal amount', 'C) Interest deducted from taxes'], 'correct' => 'A'],
    ['question' => 'What is an asset?', 'options' => ['A) A resource with economic value', 'B) A financial liability', 'C) A marketing tool'], 'correct' => 'A'],
    ['question' => 'Which market deals with buying and selling shares?', 'options' => ['A) Stock Market', 'B) Commodity Market', 'C) Real Estate Market'], 'correct' => 'A'],
    ['question' => 'What is the primary goal of financial management?', 'options' => ['A) Maximizing shareholder wealth', 'B) Minimizing marketing costs', 'C) Designing investment portfolios'], 'correct' => 'A'],
    ['question' => 'What does GDP stand for?', 'options' => ['A) Gross Domestic Product', 'B) General Data Privacy', 'C) Government Development Plan'], 'correct' => 'A'],
    ['question' => 'What is diversification in finance?', 'options' => ['A) Spreading investments across various assets', 'B) Investing all funds in one stock', 'C) Avoiding all risks'], 'correct' => 'A']
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
    <title>Finance Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        p {
            font-size: 18px;
            margin: 15px 0;
        }

        label {
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 18px;
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
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            form {
                width: 90%;
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
    <h1>Finance Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_Finance.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_Finance.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <p><strong>Q<?php echo $index + 1; ?>: <?php echo $question['question']; ?></strong></p>
                <?php foreach ($question['options'] as $key => $option): ?>
                    <label>
                        <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo chr(65 + $key); ?>" required>
                        <?php echo $option; ?>
                    </label>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <br>
            <input type="submit" value="Submit Quiz">
        </form>
    <?php endif; ?>
    <a href="../controller/logout.php">Logout</a>
</body>
</html>
