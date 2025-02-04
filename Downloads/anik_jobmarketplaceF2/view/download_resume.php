<?php

require_once('../fpdf/fpdf.php'); 

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


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, 'Resume: ' . $name, 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . $phone, 0, 1);
$pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
$pdf->Cell(0, 10, 'Qualification: ' . $qualification, 0, 1);

$pdf->Output('D', 'resume_' . $name . '.pdf');
?>
