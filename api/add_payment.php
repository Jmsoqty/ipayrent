<?php
include 'dbconfig.php'; // Include your database connection file

// Retrieve data from POST request
$transactionId = $_POST['transaction_id'];
$tenantName = $_POST['tenant_name'];
$roomNumber = $_POST['room_number'];
$roomRate = $_POST['room_rate'];
$payment = $_POST['payment'];
$startedDate = $_POST['started_date'];
$endedDate = $_POST['ended_date'];
$datePaid = $_POST['date_paid'];

// Validate if started date is not greater than ended date
if ($startedDate > $endedDate) {
    $response = array(
        'success' => false,
        'message' => 'Started date cannot be greater than ended date.'
    );
} else {
    // Insert transaction into database
    $sql = "INSERT INTO tbl_transactions (transaction_id, tenant_name, room_number, room_rate, payment, started_date, ended_date, date_paid)
            VALUES ('$transactionId', '$tenantName', '$roomNumber', '$roomRate', '$payment', '$startedDate', '$endedDate', '$datePaid')";

    if (mysqli_query($conn, $sql)) {
        $response = array(
            'success' => true,
            'message' => 'Transaction added successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error adding transaction: ' . mysqli_error($conn)
        );
    }
}

// Return JSON response
echo json_encode($response);

// Close database connection
mysqli_close($conn);
?>
