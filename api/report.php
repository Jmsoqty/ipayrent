<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconfig.php';
session_start();

require('fpdf/fpdf.php');

$selectedMonth = $_GET['month'];
$selectedYear = $_GET['year'];
$selectedTenant = isset($_GET['tenant']) ? $_GET['tenant'] : '';

$whereClause = "";
$parameters = array();
$types = "ii";

if ($selectedTenant != "all" && $selectedTenant != "") {
    $whereClause = " AND `tenant_name` = ?";
    $parameters[] = $selectedTenant;
    $types .= "s";
}

$query = "SELECT `transaction_id`, `tenant_name`, `room_number`, `room_rate`, `payment`, `started_date`, `ended_date`, `date_paid` FROM `tbl_transactions` WHERE MONTH(`date_paid`) = ? AND YEAR(`date_paid`) = ?" . $whereClause;
$stmt = $conn->prepare($query);
$stmt->bind_param($types, $selectedMonth, $selectedYear, ...$parameters);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die('Error in SQL query: ' . $conn->error);
}

if ($result->num_rows === 0) {
    die('No data found for the selected criteria.');
}

$pdf = new FPDF('L');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'IPayRent: Apartment Online Payment System', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, date("F Y", strtotime($selectedYear . '-' . $selectedMonth . '-01')) . ' Reports', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 10, 'Transaction ID', 1, 0, 'C');
$pdf->Cell(50, 10, 'Tenant Name', 1, 0, 'C');
$pdf->Cell(30, 10, 'Room Number', 1, 0, 'C');
$pdf->Cell(30, 10, 'Room Rate', 1, 0, 'C');
$pdf->Cell(30, 10, 'Payment', 1, 0, 'C');
$pdf->Cell(55, 10, 'Payment Period', 1, 0, 'C');
$pdf->Cell(30, 10, 'Date Paid', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

while ($row = $result->fetch_assoc()) {
    $formattedStartDate = date("m/d/y", strtotime($row['started_date']));
    $formattedEndDate = date("m/d/y", strtotime($row['ended_date']));
    $formattedDatePaid = date("m/d/y", strtotime($row['date_paid']));
    
    $paymentPeriod = $formattedStartDate . ' - ' . $formattedEndDate;
    
    $pdf->Cell(50, 10, $row['transaction_id'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['tenant_name'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['room_number'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['room_rate'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['payment'], 1, 0, 'C');
    $pdf->Cell(55, 10, $paymentPeriod, 1, 0, 'C');
    $pdf->Cell(30, 10, $formattedDatePaid, 1, 1, 'C');
    
    if ($pdf->GetY() + 10 > $pdf->GetPageHeight() - 15) {
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'IPayRent: Apartment Online Payment System', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, date("F Y", strtotime($selectedYear . '-' . $selectedMonth . '-01')) . ' Reports', 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'Transaction ID', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tenant Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Room Number', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Room Rate', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Payment', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Payment Period', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Date Paid', 1, 1, 'C');
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetY(-15);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 10, 'Page ' . ($pdf->PageNo() + 1), 0, 0, 'C');
    }
}

$pdf->Output();

$stmt->close();
$conn->close();
?>
