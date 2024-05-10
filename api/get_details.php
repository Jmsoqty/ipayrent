<?php
include 'dbconfig.php';

$email = $_GET['email']; 

$sql_apartment_id = "SELECT apartment_id FROM tbl_tenants WHERE email = '$email'";
$result_apartment_id = $conn->query($sql_apartment_id);

if ($result_apartment_id->num_rows > 0) {
    $row_apartment_id = $result_apartment_id->fetch_assoc();
    $apartment_id = $row_apartment_id['apartment_id'];

    $sql_rate = "SELECT rate FROM tbl_apartments WHERE room_number = '$apartment_id'";
    $result_rate = $conn->query($sql_rate);

    if ($result_rate->num_rows > 0) {
        $row_rate = $result_rate->fetch_assoc();
        $rate = $row_rate['rate'];

        $sql_transaction = "SELECT MAX(date_paid) as date_paid
                            FROM tbl_transactions
                            WHERE tenant_name = (SELECT name FROM tbl_tenants WHERE email = '$email' AND apartment_id = '$apartment_id')";
        $result_transaction = $conn->query($sql_transaction);

        if ($result_transaction->num_rows > 0) {
            $data = array();
            while ($row_transaction = $result_transaction->fetch_assoc()) {
                $next_month_date_paid = date('Y-m-d', strtotime('+1 month', strtotime($row_transaction['date_paid'])));
                $row_transaction['next_month_date_paid'] = $next_month_date_paid;
                $row_transaction['rate'] = $rate;
                $data[] = $row_transaction;
            }

            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => "No transaction data found for the provided email and apartment."));
        }
    } else {
        echo json_encode(array("error" => "No rate found for the provided apartment."));
    }
} else {
    echo json_encode(array("error" => "No apartment found for the provided email."));
}

$conn->close();
?>
