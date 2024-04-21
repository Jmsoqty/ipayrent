<?php
// Include your database connection file
include 'dbconfig.php';

// Initialize an array to store fully booked dates
$fullyBookedDates = array();

// Fetch all room numbers
$roomQuery = "SELECT room_number FROM tbl_apartments";
$roomResult = mysqli_query($conn, $roomQuery);

if ($roomResult) {
    $allRooms = array();
    while ($row = mysqli_fetch_assoc($roomResult)) {
        $allRooms[] = $row['room_number'];
    }
    mysqli_free_result($roomResult);
} else {
    // Handle query error
    echo json_encode(array('error' => 'Error executing query for fetching room numbers: ' . mysqli_error($conn)));
    exit();
}

// Fetch booked dates from the transaction history
$transactionsQuery = "SELECT room_number, started_date, ended_date FROM tbl_transactions";
$transactionsResult = mysqli_query($conn, $transactionsQuery);

if ($transactionsResult) {
    // Initialize an array to store room availability for each date
    $roomAvailability = array();
    while ($row = mysqli_fetch_assoc($transactionsResult)) {
        // Extract the room number, start date, and end date of each transaction
        $roomNumber = $row['room_number'];
        $startDate = strtotime($row['started_date']);
        $endDate = strtotime($row['ended_date']);

        // Loop through each day in the date range
        for ($date = $startDate; $date <= $endDate; $date += 86400) {
            // Initialize room availability for each date if not set
            if (!isset($roomAvailability[date('Y-m-d', $date)])) {
                $roomAvailability[date('Y-m-d', $date)] = $allRooms;
            }
            // Remove the booked room from the available rooms for that date
            $key = array_search($roomNumber, $roomAvailability[date('Y-m-d', $date)]);
            if ($key !== false) {
                unset($roomAvailability[date('Y-m-d', $date)][$key]);
            }
        }
    }

    // Find fully booked dates where all rooms are occupied
    foreach ($roomAvailability as $date => $availableRooms) {
        if (empty($availableRooms)) {
            $fullyBookedDates[] = $date;
        }
    }

    // Free result set
    mysqli_free_result($transactionsResult);
} else {
    // Handle query error
    echo json_encode(array('error' => 'Error executing query for fetching transaction history: ' . mysqli_error($conn)));
    exit();
}

// Encode the fullyBookedDates array as JSON and output
echo json_encode(array('fully_booked_dates' => $fullyBookedDates));
?>
