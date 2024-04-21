<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $tenant_id = $_POST['tenant_id']; // Assuming you receive the tenant ID to be updated
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $occupation = trim($_POST['occupation']);

    // Check if email or contact number already exists for other tenants
    $check_query = "SELECT * FROM tbl_tenants WHERE (email = '$email' OR contact_number = '$contact') AND tenant_id != '$tenant_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Email or contact number already exists for other tenants, return error response
        $response['error'] = 'Email or contact number already exists for another tenant';
    } else {
        // Update data in tbl_tenants
        $update_query = "UPDATE tbl_tenants SET name = '$fullname', email = '$email', contact_number = '$contact', occupation = '$occupation' WHERE tenant_id = '$tenant_id'";

        if (mysqli_query($conn, $update_query)) {
            // Data updated successfully, return success response
            $response['success'] = 'Tenant updated successfully';
        } else {
            // Error updating data, return error response
            $response['error'] = 'Error updating tenant: ' . mysqli_error($conn);
        }
    }
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
