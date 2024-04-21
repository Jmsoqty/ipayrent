<?php
include 'dbconfig.php';

// Initialize response array
$response = [];

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using MD5
    $hashed_password = md5($password);

    // Check if the email already exists
    $check_query = "SELECT * FROM tbl_users WHERE username = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Email already exists, return error response
        $response['error'] = 'Email already exists';
    } else {
        // Insert data into tbl_users
        $insert_query = "INSERT INTO tbl_users (username, password, usertype, date_created) 
                        VALUES ('$email', '$hashed_password', 'user', NOW())";

        if (mysqli_query($conn, $insert_query)) {
            // User added successfully, return success response
            $response['success'] = 'User added successfully';
        } else {
            // Error inserting user data, return error response
            $response['error'] = 'Error adding user: ' . mysqli_error($conn);
        }
    }
} else {
    // Invalid request method, return error response
    $response['error'] = 'Invalid request method';
}

// Encode response as JSON and output
echo json_encode($response);
?>
