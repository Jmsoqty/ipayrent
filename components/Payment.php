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
                <li class=""><a href="Payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
                <li class="active"><a href="Payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Payment</a></li>
                
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
        
        <div class="p-3">

            <div class="text-end ">
               
                    
            </div>

        <div class="card mt-3">
            <div class="card-header bg-primary-subtle"><p class="fs-6 fw-bold mt-3">Payment </p></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tenant</th>
                        <th scope="col">Room</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td scope="col"><button type="button" class="btn  btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button>
                                        
                                        </td>

                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

        </div>
    </div>

    
</body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <div class="row">

                        <div class="col">
                                <label for="labelTenant" class="form-label fw-bold">Tenant</label>
                           
                        </div>
                        <div class="col">
                                <label for="labelRoom" class="form-label  fw-bold">Room</label>
                                
                            </div>
                                </div>
                                
                    <div class="row">
                        <div class="col">
                        <label for="" class="text-body-secondary ms-3 mb-3"> Doflamingcoy Velphy</label>
                        </div>
                        <div class="col">
                        <label for="" class="text-body-secondary ms-3 mb-3"> Room 2B</label>
                        </div>
                            </div>

                    <div class="row">

                        <div class="col">
                            <label for="labelTenant" class="form-label fw-bold">Amount</label>
                        </div>
                        <div class="col">
                            <label for="labelRoom" class="form-label  fw-bold">Date</label> 
                        </div>
                        </div>
                            
                        <div class="row">
                            <div class="col">
                        <label for="" class="text-body-secondary ms-3 mb-3"> Php 5,000</label>
                         </div>
                        <div class="col">
                        <label for="" class="text-body-secondary ms-3 mb-3"> July 1 , 2024 8:31 AM</label>
                        </div>
                            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>