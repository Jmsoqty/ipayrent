<?php
include 'dbconfig.php';

// API endpoint to fetch transactions for a given email
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the email from the query parameters
    $email = $_GET['email'];

    // Prepare SQL query to fetch room_number based on email
    $sql_room_number = "
        SELECT apartment_id
        FROM tbl_tenants
        WHERE email = ?
    ";

    // Prepare and bind parameters
    $stmt_room_number = $conn->prepare($sql_room_number);
    $stmt_room_number->bind_param("s", $email);

    // Execute query
    $stmt_room_number->execute();

    // Bind result variable
    $stmt_room_number->bind_result($room_number);

    // Fetch room_number
    $stmt_room_number->fetch();

    // Close statement
    $stmt_room_number->close();

    // Prepare SQL query to fetch transactions based on room_number
    $sql_transactions = "
        SELECT transaction_id, payment, date_paid 
        FROM tbl_transactions
        WHERE room_number = ?
    ";

    // Prepare and bind parameters
    $stmt_transactions = $conn->prepare($sql_transactions);
    $stmt_transactions->bind_param("s", $room_number);

    // Execute query
    $stmt_transactions->execute();

    // Bind result variables
    $stmt_transactions->bind_result($transaction_id, $payment, $date_paid);

    // Fetch results
    $transactions = array();
    while ($stmt_transactions->fetch()) {
        $transaction = array(
            'transaction_id' => $transaction_id,
            'payment' => $payment,
            'date_paid' => $date_paid
        );
        $transactions[] = $transaction;
    }

    // Close statement
    $stmt_transactions->close();

    // Close connection
    $conn->close();

    // Return transactions as JSON response
    header('Content-Type: application/json');
    echo json_encode($transactions);
}
?>
