<?php


header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$sector = $input['sector'] ?? '';

$sectorQuizPages = [
    'IT' => 'quiz_IT.php',
    'Engineering' => 'quiz_Engineering.php',
    'Medical' => 'quiz_Medical.php',
    'Marketing' => 'quiz_Marketing.php',
    'Sales' => 'quiz_Sales.php',
    'Design' => 'quiz_Design.php',
    'Finance' => 'quiz_Finance.php'
];


if (array_key_exists($sector, $sectorQuizPages)) {
    
    echo json_encode([
        'success' => true,
        'redirect_url' => $sectorQuizPages[$sector]
    ]);
} else {
    
    echo json_encode([
        'success' => false,
        'error' => 'Invalid sector selected.'
    ]);
}
?>
