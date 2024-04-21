<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $roomNumber = $_POST['roomNumber'];
    $roomDescription = $_POST['roomDescription'];
    $roomRate = $_POST['roomRate'];

    // Check if image file is selected
    if (!isset($_FILES['roomImageInput']) || $_FILES['roomImageInput']['error'] != UPLOAD_ERR_OK) {
        $response['error'] = 'No image file selected';
    } else {
        // Process image upload
        $imageData = file_get_contents($_FILES['roomImageInput']['tmp_name']); // Get image data

        // Check if room number already exists
        $check_query = "SELECT * FROM tbl_apartments WHERE room_number = '$roomNumber'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Room number already exists, return error response
            $response['error'] = 'Room number already exists';
        } else {
            // Insert data into tbl_apartments
            $insert_query = "INSERT INTO tbl_apartments (room_number, room_description, rate, vacancy, image, date_created) 
                            VALUES (?, ?, ?, 'Vacant', ?, NOW())";
            
            // Prepare the statement
            $stmt = mysqli_prepare($conn, $insert_query);
            if ($stmt) {
                // Bind the parameters
                mysqli_stmt_bind_param($stmt, "ssss", $roomNumber, $roomDescription, $roomRate, $imageData);
                
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    // Room added successfully, return success response
                    $response['success'] = 'Room added successfully';
                } else {
                    // Error executing the statement, return error response
                    $response['error'] = 'Error adding room: ' . mysqli_stmt_error($stmt);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                // Error preparing the statement, return error response
                $response['error'] = 'Error preparing statement: ' . mysqli_error($conn);
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
