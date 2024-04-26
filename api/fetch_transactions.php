<?php
    // Include your database connection file here
    include 'dbconfig.php';

    // Define the number of results per page
    $results_per_page = 20;

    // Determine the current page number
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the SQL LIMIT clause
    $limit_start = ($page - 1) * $results_per_page;

    // Add search functionality
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $search_condition = '';
    if (!empty($search)) {
        // You should perform proper sanitization and validation here to prevent SQL injection
        $search = mysqli_real_escape_string($conn, $search);
        $search_condition = "WHERE tenant_name LIKE '%$search%' OR room_number LIKE '%$search%'";
    }

    // Construct the SQL query with search condition and pagination
    $sql = "SELECT * FROM tbl_transactions $search_condition ORDER BY date_paid DESC LIMIT $limit_start, $results_per_page";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }

    // Fetch table rows
    $tableData = '';
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
        $startedDate = date('m/d/y', strtotime($row['started_date']));
        $endedDate = date('m/d/y', strtotime($row['ended_date']));
        $datePaid = date('m/d/y', strtotime($row['date_paid']));
        
        $tableData .= "
            <tr>
                <td class='text-center'>{$i}</td>
                <td class='text-center'>{$row['transaction_id']}</td>
                <td class='text-center'>{$row['tenant_name']}</td>
                <td class='text-center'>{$row['room_number']}</td>
                <td class='text-center'>{$row['room_rate']} PHP</td>
                <td class='text-center'>{$row['payment']} PHP</td>
                <td class='text-center'>{$startedDate} - {$endedDate}</td>
                <td class='text-center'>{$datePaid}</td>
            </tr>";
    }

    // Fetch total number of pages
    $sql = "SELECT COUNT(*) AS total FROM tbl_transactions $search_condition";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $results_per_page);

    // Construct pagination links
    $pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= "<li class='page-item' data-page='$i'><a class='page-link' href='#'>$i</a></li>";
    }

    // Add previous and next page links
    if ($page > 1) {
        $pagination = "<li class='page-item' data-page='prev'><a class='page-link' href='#'>Previous</a></li>" . $pagination;
    }
    if ($page < $total_pages) {
        $pagination .= "<li class='page-item' data-page='next'><a class='page-link' href='#'>Next</a></li>";
    }

    // Return data as JSON
    echo json_encode(array('tableData' => $tableData, 'pagination' => $pagination));
?>
