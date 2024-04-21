<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from POST request
    $userId = $_POST['userId'];

    // Check if user ID exists in tbl_users
    $check_query = "SELECT * FROM tbl_users WHERE user_id = '$userId'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Delete user from tbl_users
        $delete_query = "DELETE FROM tbl_users WHERE user_id = '$userId'";

        if (mysqli_query($conn, $delete_query)) {
            // User deleted successfully, return success response
            $response['success'] = 'User deleted successfully';
        } else {
            // Error deleting user, return error response
            $response['error'] = 'Error deleting user: ' . mysqli_error($conn);
        }
    } else {
        // User does not exist, return error response
        $response['error'] = 'User does not exist';
    }
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
