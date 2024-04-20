<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script type="text/javascript" src="../assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/dashboard.js"></script>
</head>
<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box">
                <h1 class="fs-4 p-2 mb-2"><span class="text-white ">IPayrent</span></h1>
            </div>
            <ul class="list-unstyled px-2 d-flex flex-column" style="height: 100vh;">
                <li class="active"><a href="success.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/home.png" alt="Home" class="me-2" width="20" height="20">Home</a></li>
                <li class=""><a href="Tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
                <li class=""><a href="Apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
                <li class=""><a href="Payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
                <li class=""><a href="Payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Payment</a></li>
                
                <li class="mt-auto"><a href="../pages/index.php" class="text-decoration-none px-3 py-2 d-block"><img src="../assets/images/logout.png" alt="Home" class="me-2" width="20" height="20">Logout</a></li>
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
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="p-3 bg-white shadow d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">13 </h3>
                        <p class="fs-5">Tenants</p>
                    </div>
                    <img src="../assets/images/tenant.png"alt="Tenant" class="" width="70" height="70">
              </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">15 </h3>
                        <p class="fs-5">Rooms</p>
                    </div>
                <img src="../assets/images/Rooms.png"alt="Rooms" class="" width="70" height="70">
                    
              </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">0 </h3>
                        <p class="fs-5">Payment</p>
                    </div>
                    <img src="../assets/images/pera.png"alt="Payment" class="" width="70" height="70">
              </div>
            </div>

        </div>
    </div>
     
                
    
    
    </div>
            </div>

        </div>
    </div>

    
</body>
</html>