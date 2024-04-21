<?php
include '../api/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation of Accounts</title>
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
                <li class=""><a href="payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li>
                <li class=""><a href="payment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payment.png" alt="Home" class="me-2" width="20" height="20">Transactions</a></li>
                <li class="active"><a href="create_user.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Create Account</a></li>
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
        
        <div class="p-3">

            <div class="text-end ">
               
                    
            </nav>
            <div class="container-fluid px-4 mt-3">
                <div class="p-5">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary-subtle">
                            <p class="fs-6 fw-bold mt-3 text-center">User Accounts</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Username/Email</th>
                                        <th scope="col" class="text-center">Date Created</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_users WHERE usertype != 'admin'";
                                $result = $conn->query($sql);

                                if (!$result) {
                                    die("Invalid query: " . $conn->error);
                                }

                                $i = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                    // Format the date
                                    $formatted_date = date('M d, Y', strtotime($row['date_created']));

                                    echo "
                                    <tr>
                                        <td class='text-center'>{$i}</td>
                                        <td class='text-center'>{$row['username']}</td>
                                        <td class='text-center'>{$formatted_date}</td>
                                        <td class='text-center'>
                                            <button class='btn btn-danger btn-sm delete-btn' data-user-id='{$row['user_id']}'>Delete</button>
                                        </td>
                                    </tr>
                                    ";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tenant Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Enter password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.add-btn').click(function() {
        // Get form data
        var email = $('#Email').val().trim(); // Trim to remove leading and trailing whitespace
        var password = $('#Password').val().trim();
        // Make AJAX request to API endpoint
        if (email === '' || password === '') {
            alert('Please fill in all fields.');
            return; // Exit function if fields are empty
        }

        $.ajax({
            type: 'POST',
            url: '../api/register.php', // Update the URL to your PHP API endpoint
            data: {
                email: email,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                // Check if the response contains success or error message
                if (response.success) {
                    alert(response.success);
                    location.reload();
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
    $('.delete-btn').click(function() {
        // Get user ID from data attribute
        var userId = $(this).data('user-id');

        // Ask for confirmation
        if (confirm('Are you sure you want to delete this user?')) {
            // Make AJAX request to delete user API endpoint
            $.ajax({
                type: 'POST',
                url: '../api/delete_user.php', // Update the URL to your PHP API endpoint
                data: {
                    userId: userId
                },
                dataType: 'json',
                success: function(response) {
                    // Check if the response contains success or error message
                    if (response.success) {
                        alert(response.success);
                        location.reload();
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error(xhr.responseText);
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    });
});

</script>
</body>
</html>
