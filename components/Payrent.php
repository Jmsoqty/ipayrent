<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <script type="text/javascript" src="../assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/dashboard.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
    <script>
        // Function to generate a unique transaction ID
        function generateTransactionID() {
            var timestamp = new Date().getTime();
            var random = Math.floor(Math.random() * 10000); // Adjust range as needed
            return 'TXN-' + timestamp + '-' + random;
        }
        
        // Function to set the generated transaction ID to the input field
        function setTransactionID() {
            document.getElementById('inputTransactionID').value = generateTransactionID();
        }
    </script>
</head>
<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box">
                <h1 class="fs-4 p-2 mb-2"><span class="text-white ">IPayrent</span></h1>
            </div>
            <ul class="list-unstyled px-2 d-flex flex-column" style="height: 100vh;">
                <li class=""><a href="success.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/home.png" alt="Home" class="me-2" width="20" height="20">Home</a></li>
                <li class=""><a href="Tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
                <li class=""><a href="Apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
                <li class="active"><a href="Payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
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
                  
            <!--  FORM -->
            <div class="container-fluid px-4 mt-3">
                <div class="p-3">  
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="inputTenant" class="form-label">Tenant Name</label>
                            <input type="text" class="form-control" id="inputTenant" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Tenant Email</label>
                            <input type="email" class="form-control" id="inputEmail" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputRoom" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="inputRoom" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputType" class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="inputType" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPaymentAmount" class="form-label">Payment Amount</label>
                            <input type="number" class="form-control" id="inputPaymentAmount" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPaymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="inputPaymentMethod" required>
                                <option value="">Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputTransactionID" class="form-label">Transaction ID</label>
                            <input type="text" class="form-control" id="inputTransactionID" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="inputTransactionDate" class="form-label">Transaction Date</label>
                            <input type="date" class="form-control" id="inputTransactionDate" required>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary" onclick="setTransactionID()">Generate Transaction ID</button>
                        </div>
                        <!-- Add more fields as needed -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Pay Rent</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- FORM -->
        </div>
    </div>
</body>
</html>
