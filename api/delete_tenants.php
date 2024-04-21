<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get tenant ID from POST data
    $tenant_id = $_POST['tenant_id'];

    // Delete tenant from the database
    $delete_query = "DELETE FROM tbl_tenants WHERE tenant_id = '$tenant_id'";
    if (mysqli_query($conn, $delete_query)) {
        // Tenant deleted successfully
        $response['success'] = 'Tenant deleted successfully';
    } else {
        // Error deleting tenant
        $response['error'] = 'Error deleting tenant: ' . mysqli_error($conn);
    }
} else {
    // Invalid request method
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
