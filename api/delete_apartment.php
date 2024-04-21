<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get room number from POST request
    $roomNumber = $_POST['roomNumber'];

    // Delete room from the database
    $delete_query = "DELETE FROM tbl_apartments WHERE room_number = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "s", $roomNumber);

    if (mysqli_stmt_execute($stmt)) {
        // Room deleted successfully, return success response
        $response['success'] = 'Room deleted successfully';
    } else {
        // Error deleting room, return error response
        $response['error'] = 'Error deleting room: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
