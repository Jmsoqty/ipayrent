<?php
include 'dbconfig.php';

date_default_timezone_set('Asia/Manila');

$email = $_GET['email'];
$payment = $_GET['payment'];
$transaction_id = $_GET['transaction_id'];
$date_paid = date('Y-m-d H:i:s');

// Fetch tenant details based on email
$sqlTenant = "SELECT apartment_id, name FROM tbl_tenants WHERE email = ?";
$stmtTenant = $conn->prepare($sqlTenant);
$stmtTenant->bind_param("s", $email);
$stmtTenant->execute();
$resultTenant = $stmtTenant->get_result();
$rowTenant = $resultTenant->fetch_assoc();
$apartmentId = $rowTenant['apartment_id'];
$tenantName = $rowTenant['name']; // Fetch the name of the tenant

// Fetch rate and room number based on apartment ID
$sqlApartment = "SELECT room_number, rate FROM tbl_apartments WHERE room_number = ?";
$stmtApartment = $conn->prepare($sqlApartment);
$stmtApartment->bind_param("s", $apartmentId);
$stmtApartment->execute();
$resultApartment = $stmtApartment->get_result();
$rowApartment = $resultApartment->fetch_assoc();
$roomNumber = $rowApartment['room_number'];
$rate = $rowApartment['rate'];

// Fetch the latest transaction end date
$sqlLatestTransactionEndDate = "SELECT MAX(ended_date) AS latest_end_date FROM tbl_transactions WHERE tenant_name = ?";
$stmtLatestTransactionEndDate = $conn->prepare($sqlLatestTransactionEndDate);
$stmtLatestTransactionEndDate->bind_param("s", $tenantName);
$stmtLatestTransactionEndDate->execute();
$resultLatestTransactionEndDate = $stmtLatestTransactionEndDate->get_result();
$rowLatestTransactionEndDate = $resultLatestTransactionEndDate->fetch_assoc();
$latestEndDate = $rowLatestTransactionEndDate['latest_end_date'];

// Calculate new start date and end date
$newStartDate = date('Y-m-d', strtotime($latestEndDate)); // Start date is one day after the latest end date
$newEndDate = date('Y-m-d', strtotime($newStartDate . ' +1 month')); // End date is one month after the new start date

// Insert transaction data into database
$sqlInsertTransaction = "INSERT INTO tbl_transactions (transaction_id, tenant_name, room_number, room_rate, payment, started_date, ended_date, date_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmtInsertTransaction = $conn->prepare($sqlInsertTransaction);
$stmtInsertTransaction->bind_param("ssssssss", $transaction_id, $tenantName, $roomNumber, $rate, $payment, $newStartDate, $newEndDate, $date_paid);
$stmtInsertTransaction->execute();

// Check if the transaction was successfully inserted
if ($stmtInsertTransaction->affected_rows > 0) {
    // Transaction inserted successfully
    echo json_encode(array("success" => true, "message" => "Transaction data inserted successfully."));

    // Now, let's insert a notification into tbl_notifications
    $notificationTitle = "Payment Successful";
    $notificationSubject = "You paid your rent on the Month of " . date('F Y', strtotime($newStartDate));
    $notificationDate = date('Y-m-d');
    
    $sqlInsertNotification = "INSERT INTO tbl_notifications (to_whom, title, subject, date_created) VALUES (?, ?, ?, ?)";
    $stmtInsertNotification = $conn->prepare($sqlInsertNotification);
    $stmtInsertNotification->bind_param("ssss", $email, $notificationTitle, $notificationSubject, $notificationDate);
    $stmtInsertNotification->execute();

    // Check if the notification was successfully inserted
    if ($stmtInsertNotification->affected_rows > 0) {
        // Notification inserted successfully
        echo json_encode(array("notification_success" => true, "notification_message" => "Notification inserted successfully."));
    } else {
        // Failed to insert notification
        echo json_encode(array("notification_success" => false, "notification_message" => "Failed to insert notification."));
    }
} else {
    // Failed to insert transaction
    echo json_encode(array("success" => false, "message" => "Failed to insert transaction data."));
}

$stmtInsertTransaction->close();
$conn->close();
?>
