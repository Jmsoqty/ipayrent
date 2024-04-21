<?php
include 'dbconfig.php'; // Include your database connection file

// Initialize response array
$response = [];

// Check if roomNumber is set and not empty
if (isset($_POST['roomNumber']) && !empty($_POST['roomNumber'])) {
    // Sanitize the input
    $roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber']);

    // SQL query to fetch room details based on room number
    $sql = "SELECT room_description, rate FROM tbl_apartments WHERE room_number = '$roomNumber'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch room details from the result
            $row = mysqli_fetch_assoc($result);

            // Add room type and rate to response array
            $response['roomType'] = $row['room_description'];
            $response['roomRate'] = $row['rate'];
        } else {
            // No room found with the specified room number
            $response['error'] = 'No room found with the specified room number';
        }
    } else {
        // Error executing the query
        $response['error'] = 'Error executing query: ' . mysqli_error($conn);
    }
} else {
    // Room number not set or empty
    $response['error'] = 'Room number is not set or empty';
}

// Encode response as JSON and output
echo json_encode($response);
?>
