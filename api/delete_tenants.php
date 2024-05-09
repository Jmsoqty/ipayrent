<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get tenant ID and apartment ID from POST data
    $tenant_id = $_POST['tenant_id'];
    $apartment_id = $_POST['apartment_id'];

    // Begin a transaction
    mysqli_begin_transaction($conn);

    // Delete tenant from the database
    $delete_query = "DELETE FROM tbl_tenants WHERE tenant_id = '$tenant_id'";
    if (mysqli_query($conn, $delete_query)) {
        // Update vacancy status of the corresponding apartment to "Vacant"
        $update_query = "UPDATE tbl_apartments SET vacancy = 'Vacant' WHERE room_number = '$apartment_id'";
        if (mysqli_query($conn, $update_query)) {
            // Tenant deleted and vacancy status updated successfully
            mysqli_commit($conn);
            $response['success'] = 'Tenant deleted successfully';
        } else {
            // Error updating vacancy status
            mysqli_rollback($conn);
            $response['error'] = 'Error updating vacancy status: ' . mysqli_error($conn);
        }
    } else {
        // Error deleting tenant
        mysqli_rollback($conn);
        $response['error'] = 'Error deleting tenant: ' . mysqli_error($conn);
    }
} else {
    // Invalid request method
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
