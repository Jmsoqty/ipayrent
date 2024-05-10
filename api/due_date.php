<?php
include 'dbconfig.php';

// Check if email parameter is set in the request
if (isset($_GET['email'])) {
    // Get the email parameter value
    $email = $_GET['email'];

    // Prepare SQL query to select date_started based on the provided email
    $sql = "SELECT date_started FROM tbl_tenants WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $due_dates = array();
        while ($row = $result->fetch_assoc()) {
            $due_dates[] = $row["date_started"];
        }
        echo json_encode($due_dates);
    } else {
        echo "0 results";
    }
} else {
    echo "Email parameter is missing";
}

$conn->close();
?>
