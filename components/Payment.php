<?php
include '../api/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script type="text/javascript" src="../assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/dashboard.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box">
                <h1 class="fs-4 p-2 mb-2"><span class="text-white ">IPayrent</span></h1>
            </div>
            <ul class="list-unstyled px-2 d-flex flex-column" style="height: 100vh;">
                <li class=""><a href="success.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/home.png" alt="Home" class="me-2" width="20" height="20">Home</a></li>
                <li class=""><a href="tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
                <li class=""><a href="apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
                <!-- <li class=""><a href="payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li> -->
                <li class="active"><a href="payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Transactions</a></li>
                <li class=""><a href="create_user.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Create Account</a></li>
                <li class="mt-auto"><a href="../api/logout.php" class="text-decoration-none px-3 py-2 d-block"><img src="../assets/images/logout.png" alt="Home" class="me-2" width="20" height="20">Logout</a></li>
            </ul>
            
        </div>
        <div class="content">
        <nav class="navbar bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/images/logo-whites.png" class="img-fluid" width="200px">
                </a>
            </div>
        </nav>
                <div class="container-fluid px-4 mt-3">
                <div class="text-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#print">Print Transaction</button>
                </div>
                <div class="d-flex justify-content-around mt-3">
                    <img src="../assets/images/find.png" class="img-fluid me-2" id="searchbar" width="35px">
                    <input class="form-control mr-sm-2" type="text" id="search" placeholder="Search Transaction.." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="searchBtn">Search</button>
                </div>
                <div class="card mt-3">
                    <div class="card-header bg-primary-subtle">
                        <p class="fs-6 fw-bold mt-3 text-center">Transaction History</p>
                    </div>
                    <div class="table-responsive">
                        <table id="transactionTable" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Transaction ID</th>
                                        <th scope="col" class="text-center">Tenant's Email</th>
                                        <th scope="col" class="text-center">Room Number</th>
                                        <th scope="col" class="text-center">Room Rate</th>
                                        <th scope="col" class="text-center">Payment</th>
                                        <th scope="col" class="text-center">Duration</th>
                                        <th scope="col" class="text-center">Date Paid</th>
                                    </tr>
                                </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination links -->
                <div class="d-flex justify-content-center mt-3">
                    <ul id="pagination" class="pagination">
                        <!-- Pagination links will be inserted here -->
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="print" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Print Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-20">
                    <label for="inputTenant" class="form-label">Tenant Email</label>
                    <select class="form-select" id="inputTenant" required>
                        <option value="">Select Tenant Email</option>
                        <?php
                        // SQL query to fetch email addresses from tbl_tenants
                        $sql = "SELECT email FROM tbl_tenants";
                        $result = mysqli_query($conn, $sql);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["email"] . "'>" . $row["email"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No tenants found</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">
                        Select All Tenants
                    </label>
                </div>
                <div class="input-group mt-3">
                    <label class="input-group-text" for="month">Month</label>
                    <select class="form-select" id="month">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="input-group mt-3">
                    <label class="input-group-text" for="year">Year</label>
                    <select class="form-select" id="year">
                        <?php
                        // Generate options for years, adjust as needed
                        $currentYear = date('Y');
                        for ($i = $currentYear - 10; $i <= $currentYear; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" name="print">Print</button>
            </div>
        </div>
    </div>
</div>



</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Select Tenant Email dropdown
    var selectTenant = $('#inputTenant');
    // Select All checkbox
    var selectAllCheckbox = $('#selectAll');

    // Event listener for Select All checkbox
    selectAllCheckbox.change(function() {
        // If Select All is checked, disable Tenant Email dropdown and reset its value
        if ($(this).is(':checked')) {
            selectTenant.prop('disabled', true).val('');
        } else {
            // If Select All is unchecked, enable Tenant Email dropdown
            selectTenant.prop('disabled', false);
        }
    });

    // Event listener for Tenant Email dropdown
    selectTenant.change(function() {
        // If Tenant Email dropdown is changed, uncheck Select All checkbox
        selectAllCheckbox.prop('checked', false);
    });
});

</script>

<script>
    $(document).ready(function() {
    var currentPage = 1;
    var totalPages = 1;
    var searchValue = '';

    // Function to fetch and display data based on page and search value
    function fetchData() {
        $.ajax({
            url: '../api/fetch_transactions.php', // URL to your PHP script for fetching transactions
            method: 'GET',
            data: { page: currentPage, search: searchValue },
            dataType: 'json', // Specify JSON data type for automatic parsing
            success: function(response) {
                $('#tableBody').html(response.tableData);
                $('#pagination').html(response.pagination);
                console.log("Table data inserted into #tableBody:", $('#tableBody').html());
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Initial data fetch
    fetchData();

    // Search button click event
    $('#searchBtn').click(function() {
        searchValue = $('#search').val();
        currentPage = 1; // Reset to first page when searching
        fetchData();
    });

    // Pagination link click event (using event delegation)
    $('#pagination').on('click', 'li.page-item', function() {
        var page = $(this).data('page');
        if (page === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (page === 'next' && currentPage < totalPages) {
            currentPage++;
        } else if (typeof page === 'number') {
            currentPage = page;
        }
        fetchData();
    });
});

</script>
<script>
    $(document).ready(function() {
        $('button[name="print"]').click(function() {
            var month = $('#month').val();
            var year = $('#year').val();
            var tenant = $('#inputTenant').val();

            if (tenant || $('#selectAll').prop('checked')) {
                if (tenant) {
                    window.open('../api/report.php?month=' + month + '&year=' + year + '&tenant=' + tenant, '_blank');
                } else {
                    window.open('../api/report.php?month=' + month + '&year=' + year, '_blank');
                }
            } else {
                alert('Please select a tenant email or check "Select All Tenants".');
            }
        });
    });
</script>



</html>