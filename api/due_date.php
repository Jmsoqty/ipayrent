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
        while ($row = $result->fetch_assoc()) {
            $date_started = new DateTime($row["date_started"]);
            $due_dates = array();
            // Set the initial due date as the date started
            $due_date = clone $date_started;
            // Set the interval to be one month
            $interval = new DateInterval('P1M');
            // Set the number of due dates you want to generate (e.g., 12 for one year)
            $num_due_dates = 12;

            // Calculate the next 12 due dates
            for ($i = 0; $i < $num_due_dates; $i++) {
                // Add one month to the due date
                $due_date->add($interval);
                // Add the due date to the array
                $due_dates[] = $due_date->format('Y-m-d');
            }
            // Output due dates
            echo json_encode($due_dates);
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Email parameter is missing";
}

$conn->close();
?>
