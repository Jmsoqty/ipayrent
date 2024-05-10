<?php
include 'dbconfig.php';

date_default_timezone_set('Asia/Manila');

$email = $_GET['email'];

// Get today's date
$today = date('Y-m-d');

// Fetch the tenant's name from the tbl_transactions table using the provided email
$sqlTenantName = "SELECT name FROM tbl_tenants WHERE email = ?";
$stmtTenantName = $conn->prepare($sqlTenantName);
$stmtTenantName->bind_param("s", $email);
$stmtTenantName->execute();
$resultTenantName = $stmtTenantName->get_result();

if ($resultTenantName->num_rows > 0) {
    // Tenant found, fetch the latest ended date
    $rowTenantName = $resultTenantName->fetch_assoc();
    $tenantName = $rowTenantName['name'];
    
    // Check if a notification with the same title and subject already exists for the tenant
    $sqlCheckNotification = "SELECT * FROM tbl_notifications WHERE to_whom = ? AND title = ? AND subject = ?";
    $stmtCheckNotification = $conn->prepare($sqlCheckNotification);
    $stmtCheckNotification->bind_param("sss", $email, $notificationTitle, $notificationSubject);
    
    // Construct title and subject
    $nextMonth = date('F', strtotime('+1 month'));
    $nextMonthYear = date('Y', strtotime('+1 month'));
    $notificationTitle = "Your Due Date for $nextMonth $nextMonthYear is Tomorrow";
    $notificationSubject = "Please pay your rent ASAP!";
    
    $stmtCheckNotification->execute();
    $resultCheckNotification = $stmtCheckNotification->get_result();
    
    if ($resultCheckNotification->num_rows == 0) {
        // No existing notification found, proceed to insert
        // Insert notification for the tenant
        $sqlInsertNotification = "INSERT INTO tbl_notifications (to_whom, title, subject, date_created) VALUES (?, ?, ?, ?)";
        $stmtInsertNotification = $conn->prepare($sqlInsertNotification);
        $stmtInsertNotification->bind_param("ssss", $email, $notificationTitle, $notificationSubject, $today);
        $stmtInsertNotification->execute();
        
        // Check if the notification was successfully inserted
        if ($stmtInsertNotification->affected_rows > 0) {
            // Notification inserted successfully
            echo json_encode(array("success" => true, "message" => "Notification sent successfully."));
        } else {
            // Failed to insert notification
            echo json_encode(array("success" => false, "message" => "Failed to send notification."));
        }
        
        // Close the statement
        $stmtInsertNotification->close();
    } else {
        // Notification already exists, no action needed
        echo json_encode(array("success" => false, "message" => "Notification already exists."));
    }
    
    // Close the statement
    $stmtCheckNotification->close();
} else {
    // Tenant not found
    echo json_encode(array("success" => false, "message" => "Tenant not found."));
}

$stmtTenantName->close();
$conn->close();
?>
