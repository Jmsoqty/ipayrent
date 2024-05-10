<?php
include 'dbconfig.php';

$email = $_GET['email'];

// Fetch notifications based on email
$sqlNotifications = "SELECT `notification_id`, `to_whom`, `title`, `subject`, `date_created` FROM `tbl_notifications` WHERE `to_whom` = ?";
$stmtNotifications = $conn->prepare($sqlNotifications);
$stmtNotifications->bind_param("s", $email);
$stmtNotifications->execute();
$resultNotifications = $stmtNotifications->get_result();

$notifications = array();

// Fetch notifications into an array
while ($row = $resultNotifications->fetch_assoc()) {
    $notification = array(
        "notification_id" => $row['notification_id'],
        "title" => $row['title'],
        "subject" => $row['subject'],
        "date_created" => $row['date_created']
    );
    array_push($notifications, $notification);
}

// Return JSON response
echo json_encode($notifications);

$stmtNotifications->close();
$conn->close();
?>
