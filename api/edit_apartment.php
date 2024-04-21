<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request including vacancy status
    $roomNumber = $_POST['roomNumber'];
    $roomDescription = $_POST['roomDescription'];
    $roomRate = $_POST['roomRate'];
    $vacancy = $_POST['vacancy']; // Get vacancy status

    // Check if image file is selected
    if (isset($_FILES['roomImageInput']) && $_FILES['roomImageInput']['error'] == UPLOAD_ERR_OK) {
        // Process image upload
        $imageData = file_get_contents($_FILES['roomImageInput']['tmp_name']); // Get image data

        // Update room details including the image as blob
        $update_query = "UPDATE tbl_apartments SET room_description = ?, rate = ?, image = ?, vacancy = ? WHERE room_number = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "sssss", $roomDescription, $roomRate, $imageData, $vacancy, $roomNumber);

        if (mysqli_stmt_execute($stmt)) {
            // Room updated successfully, return success response
            $response['success'] = 'Room updated successfully';
        } else {
            // Error updating room, return error response
            $response['error'] = 'Error updating room: ' . mysqli_stmt_error($stmt);
        }
    } else {
        // Update room details excluding the image
        $update_query = "UPDATE tbl_apartments SET room_description = ?, rate = ?, vacancy = ? WHERE room_number = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ssss", $roomDescription, $roomRate, $vacancy, $roomNumber);

        if (mysqli_stmt_execute($stmt)) {
            // Room updated successfully, return success response
            $response['success'] = 'Room updated successfully';
        } else {
            // Error updating room, return error response
            $response['error'] = 'Error updating room: ' . mysqli_stmt_error($stmt);
        }
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
