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
        // Function to handle view button click
        function handleView() {
            // Display modal for viewing tenant details
            $('#viewTenantModal').modal('show');
        }

        // Function to handle edit button click
        function handleEdit() {
            // Display modal for editing tenant details
            $('#editTenantModal').modal('show');
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
                <li class="active"><a href="Tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
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
        
        <div class="p-3">

            <div class="text-end ">
               
                    
            </nav>
            <div class="container-fluid px-4 mt-3">
                <div class="p-5">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Tenant</button>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary-subtle">
                            <p class="fs-6 fw-bold mt-3">Tenants</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Edgar</td>
                                        <td>Sermo</td>
                                        <td>EdgarSiocon@gmail.com</td>
                                        <td>Chowking</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="handleView()">View</button>
                                            <button type="button" class="btn btn-sm btn-success" onclick="handleEdit()">Edit</button>
                                        </td>
                                    </tr>
                                    <!-- Add more rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Tenant Modal -->
    <div class="modal fade" id="viewTenantModal" tabindex="-1" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTenantModalLabel">View Tenant Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Firstname: Edgar</p>
                    <p>Lastname: Sermo</p>
                    <p>Email: EdgarSiocon@gmail.com</p>
                    <p>Occupation: Chowking</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tenant Modal -->
    <div class="modal fade" id="editTenantModal" tabindex="-1" aria-labelledby="editTenantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTenantModalLabel">Edit Tenant Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editFirstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="editFirstname" value="Edgar">
                        </div>
                        <div class="mb-3">
                            <label for="editLastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="editLastname" value="Sermo">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="EdgarSiocon@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="editOccupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="editOccupation" value="Chowking">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tenant Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="addFirstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="addFirstname">
                        </div>
                        <div class="mb-3">
                            <label for="addLastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="addLastname">
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail">
                        </div>
                        <div class="mb-3">
                            <label for="addOccupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="addOccupation">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
