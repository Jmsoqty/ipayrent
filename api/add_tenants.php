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

    // Check if email or contact number already exists
    $check_query = "SELECT * FROM tbl_tenants WHERE email = '$email' OR contact_number = '$contact'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Email or contact number already exists, return error response
        $response['error'] = 'Email or contact number already exists';
    } else {
        // Insert data into tbl_tenants
        $insert_query = "INSERT INTO tbl_tenants (name, email, contact_number, occupation) 
                        VALUES ('$fullname', '$email', '$contact', '$occupation')";

        if (mysqli_query($conn, $insert_query)) {
            // Data inserted successfully, return success response
            $response['success'] = 'Tenant added successfully';
        } else {
            // Error inserting data, return error response
            $response['error'] = 'Error adding tenant: ' . mysqli_error($conn);
        }
    }
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
