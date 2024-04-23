<?php
include '../api/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script type="text/javascript" src="../assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/dashboard.js"></script>
    <link rel="stylesheet" href="style.css" />

    <!-- FONTAWESOME -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
</head>
<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box">
                <h1 class="fs-4 p-2 mb-2"><span class="text-white ">IPayrent</span></h1>
            </div>
            <ul class="list-unstyled px-2 d-flex flex-column" style="height: 100vh;">
                <li class="active"><a href="success.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/home.png" alt="Home" class="me-2" width="20" height="20">Home</a></li>
                <li class=""><a href="tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
                <li class=""><a href="apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
                <li class=""><a href="payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
                <li class=""><a href="payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Transactions</a></li>
                <li class=""><a href="create_user.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Create Account</a></li>
                <li class="mt-auto"><a href="../api/logout.php" class="text-decoration-none px-3 py-2 d-block"><img src="../assets/images/logout.png" alt="Home" class="me-2" width="20" height="20">Logout</a></li>
            </ul>
            
        </div>
        <div class="content">
        <div class="container-fluid px-2 mt-3">

        <?php
        // Fetch total houses count from tbl_house_details
        $house_query = "SELECT COUNT(*) AS total_houses FROM tbl_apartments";
        $house_result = mysqli_query($conn, $house_query);
        $house_data = mysqli_fetch_assoc($house_result);
        $total_houses = $house_data['total_houses'];

        // Fetch total tenants count from tbl_tenants
        $tenant_query = "SELECT COUNT(*) AS total_tenants FROM tbl_tenants";
        $tenant_result = mysqli_query($conn, $tenant_query);
        $tenant_data = mysqli_fetch_assoc($tenant_result);
        $total_tenants = $tenant_data['total_tenants'];

        $tr_query = "SELECT COUNT(*) AS total_transactions FROM tbl_transactions";
        $tr_result = mysqli_query($conn, $tr_query);
        $tr_data = mysqli_fetch_assoc($tr_result);
        $total_transactions = $tr_data['total_transactions'];
        ?>

    <div class="row g-3 my-2 justify-content-center"> <!-- Added justify-content-center to center the columns -->
        <div class="col-md-3">
            <div class="p-1 bg-white shadow d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $total_tenants; ?></h3>
                    <p class="fs-5">Tenants</p>
                </div>
                <img src="../assets/images/tenant.png" alt="Tenant" class="" width="70" height="70">
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-1 bg-white shadow d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $total_houses; ?></h3>
                    <p class="fs-5">Rooms</p>
                </div>
                <img src="../assets/images/Rooms.png" alt="Rooms" class="" width="70" height="70">
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-1 bg-white shadow d-flex justify-content-around align-items-center rounded">
                <div>
                    <h3 class="fs-2"><?php echo $total_transactions; ?></h3>
                    <p class="fs-5">Payment</p>
                </div>
                <img src="../assets/images/pera.png" alt="Payment" class="" width="70" height="70">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="legend-container">
        <h3>Legend</h3>
        <div class="legend">
            <div class="occupied">
                <div class="color"></div>
                <span>Occupied</span>
            </div>
            <div class="vacant">
                <div class="color"></div>
                <span>Vacant</span>
            </div>
        </div>
    </div>
    <div class="calendar">
        <div class="header">
            <div class="month"></div>
            <div class="btns">
                <div class="btn today-btn">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="btn prev-btn">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="btn next-btn">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="weekdays">
            <div class="day">Sun</div>
            <div class="day">Mon</div>
            <div class="day">Tue</div>
            <div class="day">Wed</div>
            <div class="day">Thu</div>
            <div class="day">Fri</div>
            <div class="day">Sat</div>
        </div>
        <div class="days">
            <!-- lets add days using js -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>