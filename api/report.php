<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconfig.php'; // Make sure this file contains your database connection code
session_start();

require('fpdf/fpdf.php');

// Get the selected month and year from the GET parameters
$selectedMonth = $_GET['month']; // Default to current month if not provided
$selectedYear = $_GET['year']; // Default to current year if not provided

// Query the database to retrieve payment data for the selected month and year
$query = "SELECT `transaction_id`, `tenant_name`, `room_number`, `room_rate`, `payment`, `started_date`, `ended_date`, `date_paid` FROM `tbl_transactions` WHERE MONTH(`date_paid`) = ? AND YEAR(`date_paid`) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $selectedMonth, $selectedYear);
$stmt->execute();
$result = $stmt->get_result();

// Check for errors
if (!$result) {
    die('Error in SQL query: ' . $conn->error);
}

// Check if any rows were returned
if ($result->num_rows === 0) {
    die('No data found for the selected month and year.');
}

// Create a new PDF instance with landscape orientation
$pdf = new FPDF('L');
$pdf->AddPage();

// Add title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'IPayRent: Apartment Online Payment System', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, date("F Y", strtotime($selectedYear . '-' . $selectedMonth . '-01')) . ' Reports', 0, 1, 'C');
$pdf->Ln(10);

// Set font for table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 10, 'Transaction ID', 1, 0, 'C');
$pdf->Cell(50, 10, 'Tenant Name', 1, 0, 'C');
$pdf->Cell(30, 10, 'Room Number', 1, 0, 'C');
$pdf->Cell(30, 10, 'Room Rate', 1, 0, 'C');
$pdf->Cell(30, 10, 'Payment', 1, 0, 'C');
$pdf->Cell(55, 10, 'Payment Period', 1, 0, 'C');
$pdf->Cell(30, 10, 'Date Paid', 1, 1, 'C'); // Adjusted width for 'Date Paid' column

// Set font for table content
$pdf->SetFont('Arial', '', 10);

// Loop through the payment data and add rows to the PDF
while ($row = $result->fetch_assoc()) {
    // Format the dates as "Month Day, Year"
    $formattedStartDate = date("m/d/y", strtotime($row['started_date']));
    $formattedEndDate = date("m/d/y", strtotime($row['ended_date']));
    $formattedDatePaid = date("m/d/y", strtotime($row['date_paid']));
    
    // Combine start and end dates for payment period
    $paymentPeriod = $formattedStartDate . ' - ' . $formattedEndDate;
    
    // Add payment data row
    $pdf->Cell(50, 10, $row['transaction_id'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['tenant_name'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['room_number'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['room_rate'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['payment'], 1, 0, 'C');
    $pdf->Cell(55, 10, $paymentPeriod, 1, 0, 'C');
    $pdf->Cell(30, 10, $formattedDatePaid, 1, 1, 'C');
    
    // Check if content will touch or near the page footer
    if ($pdf->GetY() + 10 > $pdf->GetPageHeight() - 15) {
        $pdf->AddPage(); // Add new page
        // Add title
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'IPayRent: Apartment Online Payment System', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, date("F Y", strtotime($selectedYear . '-' . $selectedMonth . '-01')) . ' Reports', 0, 1, 'C');
        $pdf->Ln(10);
        // Re-add table headers
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'Transaction ID', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tenant Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Room Number', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Room Rate', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Payment', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Payment Period', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Date Paid', 1, 1, 'C');
        // Set font for table content
        $pdf->SetFont('Arial', '', 10);
        // Define page footer for the new page
        $pdf->SetY(-15);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 10, 'Page ' . ($pdf->PageNo() + 1), 0, 0, 'C'); // Increment page number for new page
    }
}

// Output the PDF
$pdf->Output();

// Close the database connection
$stmt->close();
$conn->close();
?>
