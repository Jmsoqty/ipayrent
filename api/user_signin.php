<?php
include 'dbconfig.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $hashed_password = md5($password);
    $response = [];

    $query_users = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$hashed_password' AND usertype = 'user'";
    $result_users = mysqli_query($conn, $query_users);

    if (mysqli_num_rows($result_users) > 0) {
        $user = mysqli_fetch_assoc($result_users);
        $response['success'] = 'Sign In Successful';
    } else {
        $response['error'] = 'Invalid username or password';
    }

    echo json_encode($response);
} else {
    $response['error'] = 'Invalid request method';
    echo json_encode($response);
}
?>
