<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "rent_db"; 

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $query = "SELECT * FROM login WHERE username='$Username' AND password ='$Password'";

    $result = $conn->query($query);

        if($result->num_rows == 1){
            header("Location:../components/success.php");
            exit();
        }
        return;
        $conn->close();
}
?>