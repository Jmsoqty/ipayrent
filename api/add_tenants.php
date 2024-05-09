<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $occupation = trim($_POST['occupation']);
    $apartment_id = trim($_POST['apartment_id']);
    $date_started = date('Y-m-d'); // Get current date in YYYY-MM-DD format

    // Generate unique transaction_id
    $transaction_id = uniqid();

    // Get room_rate based on apartment_id
    $room_rate_query = "SELECT rate FROM tbl_apartments WHERE room_number = '$apartment_id'";
    $room_rate_result = mysqli_query($conn, $room_rate_query);

    if (!$room_rate_result) {
        $response['error'] = 'Error fetching room rate: ' . mysqli_error($conn);
    } else {
        $row = mysqli_fetch_assoc($room_rate_result);
        $room_rate = $row['rate'];

        // Calculate payment based on room_rate
        $payment = $room_rate;

        // Calculate ended_date (1 month duration)
        $started_date = date('Y-m-d', strtotime($date_started));
        $ended_date = date('Y-m-d', strtotime('+1 month', strtotime($started_date)));

        // Get today's date as date_paid
        $date_paid = date('Y-m-d');

        // Check if email or contact number already exists
        $check_query = "SELECT * FROM tbl_tenants WHERE email = '$email' OR contact_number = '$contact'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Email or contact number already exists, return error response
            $response['error'] = 'Email or contact number already exists';
        } else {
            // Begin a transaction
            mysqli_begin_transaction($conn);

            // Insert data into tbl_tenants
            $insert_query = "INSERT INTO tbl_tenants (name, email, contact_number, occupation, apartment_id, date_started) 
                            VALUES ('$fullname', '$email', '$contact', '$occupation', '$apartment_id', '$date_started')";

            if (mysqli_query($conn, $insert_query)) {
                // Insert data into tbl_transactions
                $transactions_query = "INSERT INTO tbl_transactions (transaction_id, tenant_name, room_number, room_rate, payment, started_date, ended_date, date_paid) 
                                    VALUES ('$transaction_id', '$fullname', '$apartment_id', '$room_rate', '$payment', '$started_date', '$ended_date', '$date_paid')";
                if (mysqli_query($conn, $transactions_query)) {
                    // Update vacancy status of the apartment to "Occupied"
                    $update_query = "UPDATE tbl_apartments SET vacancy = 'Occupied' WHERE room_number = '$apartment_id'";
                    if (mysqli_query($conn, $update_query)) {
                        // Data inserted and vacancy status updated successfully, commit the transaction
                        mysqli_commit($conn);
                        $response['success'] = 'Tenant added successfully';
                    } else {
                        // Error updating vacancy status, rollback the transaction
                        mysqli_rollback($conn);
                        $response['error'] = 'Error updating vacancy status: ' . mysqli_error($conn);
                    }
                } else {
                    // Error inserting data into tbl_transactions, rollback the transaction
                    mysqli_rollback($conn);
                    $response['error'] = 'Error adding transaction: ' . mysqli_error($conn);
                }
            } else {
                // Error inserting data into tbl_tenants, rollback the transaction
                mysqli_rollback($conn);
                $response['error'] = 'Error adding tenant: ' . mysqli_error($conn);
            }
        }
    }
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
