<?php
$questions = [
    ['question' => 'What does the 4 Ps in marketing stand for?', 'options' => ['A) Product, Price, Place, Promotion', 'B) Plan, Process, Price, People', 'C) Product, People, Price, Plan'], 'correct' => 'A'],
    ['question' => 'Which of these is an example of digital marketing?', 'options' => ['A) Social Media Advertising', 'B) Billboard Advertising', 'C) Magazine Advertising'], 'correct' => 'A'],
    ['question' => 'What is SEO in marketing?', 'options' => ['A) Search Engine Optimization', 'B) Social Engagement Optimization', 'C) Strategic Enterprise Optimization'], 'correct' => 'A'],
    ['question' => 'What does CTR stand for in marketing?', 'options' => ['A) Click Through Rate', 'B) Cost to Revenue', 'C) Customer Transaction Rate'], 'correct' => 'A'],
    ['question' => 'Which of these is a marketing strategy?', 'options' => ['A) Branding', 'B) Networking', 'C) Benchmarking'], 'correct' => 'A'],
    ['question' => 'What does a CRM system help with?', 'options' => ['A) Managing customer relationships', 'B) Controlling financial risk', 'C) Managing inventory'], 'correct' => 'A'],
    ['question' => 'What is a common metric to measure email campaign success?', 'options' => ['A) Open Rate', 'B) Bounce Rate', 'C) Lead Conversion Rate'], 'correct' => 'A'],
    ['question' => 'Which platform is primarily used for B2B marketing?', 'options' => ['A) LinkedIn', 'B) Instagram', 'C) Snapchat'], 'correct' => 'A'],
    ['question' => 'What is the purpose of A/B testing in marketing?', 'options' => ['A) To compare two strategies', 'B) To analyze financial results', 'C) To build brand loyalty'], 'correct' => 'A'],
    ['question' => 'What does the term "target audience" refer to?', 'options' => ['A) Specific group of potential customers', 'B) Entire population of customers', 'C) Competitors in the market'], 'correct' => 'A']
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
    <title>Marketing Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin: 0;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-bottom: 15px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        label {
            font-size: 16px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
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
    <h1>Marketing Quiz</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Result</h2>
        <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong> (<?php echo number_format($percentage, 2); ?>%).</p>
        <a href="quiz_Marketing.php">Take the Quiz Again</a>
    <?php else: ?>
        <form action="quiz_Marketing.php" method="POST">
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
