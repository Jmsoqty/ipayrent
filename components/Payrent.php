<?php
include '../api/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paying of Rent</title>
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script type="text/javascript" src="../assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/dashboard.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Abs-N-M4WYrdHc1qxT_uzaGW88PryBVPS36QImte-DMDvnU7oCWPFSQHEllGcCKUE_lT0asYfezU3-zt&currency=USD"></script>

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
                <li class="active"><a href="payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
                <li class=""><a href="payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Transactions</a></li>
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
                  
            <!--  FORM -->
            <div class="container-fluid px-4 mt-3">
                <div class="p-3">  
                    <form class="row g-3">
                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <label for="inputRoom" class="form-label">Room Number</label>
                        <select class="form-select" id="inputRoom" required>
                            <option value="">Select Room Number</option>
                            <?php
                            // SQL query to fetch room numbers from tbl_apartments
                            $sql = "SELECT room_number FROM tbl_apartments";
                            $result = mysqli_query($conn, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row["room_number"] . "'>" . $row["room_number"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No rooms found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputType" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="inputType" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="inputRate" class="form-label">Room Rate</label>
                        <input type="text" class="form-control" id="inputRate" readonly>
                    </div>

                        <div class="col-md-6">
                            <label for="inputPaymentAmount" class="form-label">Payment Amount</label>
                            <input type="number" class="form-control" id="inputPaymentAmount" min="1" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label for="inputTransactionDate" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="inputTransactionDate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputTransactionDate" class="form-label">Started Date</label>
                            <input type="date" class="form-control" id="inputStartedDate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputTransactionDate" class="form-label">Ended Date</label>
                            <input type="date" class="form-control" id="inputEndedDate" required>
                        </div>
                        <!-- Add more fields as needed -->
                        <div class="d-flex justify-content-center">
                        <div class="align-items-center" id="paypal-button-container-1"></div>
                    </form>
                </div>
            </div>
            <!-- FORM -->
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#inputRoom').change(function() {
            var roomNumber = $(this).val();
            var amount = $('#inputPaymentAmount').val();
            var amount = $('#inputRate').val();
            $.ajax({
                url: '../api/fetch_room_details.php',
                method: 'POST',
                data: {
                    roomNumber: roomNumber
                },
                dataType: 'json',
                success: function(response) {
                    $('#inputType').val(response.roomType);
                    $('#inputRate').val(response.roomRate);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            var amount = parseFloat($('#inputPaymentAmount').val());
            var rate = parseFloat($('#inputRate').val());
            var email = $('#inputTenant').val();
            var paid_date = new Date($('#inputTransactionDate').val());
            var startedDate = new Date($('#inputStartedDate').val());
            var endedDate = new Date($('#inputEndedDate').val());

            if (email.trim() === '') {
                alert('Email cannot be empty');
                return false;
            }

            if (isNaN(amount) || isNaN(rate) || isNaN(startedDate) || isNaN(endedDate) || isNaN(paid_date)) {
                alert('Please fill in all fields.');
                return false;
            }

            if (amount !== rate) {
                alert('Payment amount does not match the room rate. Please enter the correct amount.');
                return false;
            }

            if (startedDate > endedDate) {
                alert('Started date cannot be greater than ended date.');
                return false;
            }

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount.toFixed(2),
                        currency_code: 'USD'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                var amount = $('#inputPaymentAmount').val();
                var rate = $('#inputRate').val();
                var transactionId = data.orderID;

                // AJAX request to add transaction
                $.ajax({
                    type: "POST",
                    url: "../api/add_payment.php",
                    data: {
                        transaction_id: transactionId,
                        tenant_name: $('#inputTenant').val(),
                        room_number: $('#inputRoom').val(),
                        room_rate: rate,
                        payment: amount,
                        started_date: $('#inputStartedDate').val(),
                        ended_date: $('#inputEndedDate').val(),
                        date_paid: $('#inputTransactionDate').val(),
                    },
                    success: function(response) {
                        try {
                            var parsedResponse = JSON.parse(response);
                            if (parsedResponse.success) {
                                alert(parsedResponse.message); // Display success message
                                location.reload();
                            } else {
                                alert(parsedResponse.message); // Display error message
                            }
                        } catch (error) {
                            alert('An error occurred while processing the response.'); // Display error message
                            console.error(error);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 0) {
                            alert('Network error occurred. Please check your internet connection.');
                        } else {
                            alert('An error occurred while making the request. Please try again later.');
                        }
                        console.error(error);
                    }
                });
            });
        },
        onCancel: function(data) {
            alert('Payment cancelled');
        },
        onError: function(err) {
            console.error(err);
        }
    }).render('#paypal-button-container-1');
</script>

</html>
