<?php
include '../api/authentication.php';
?>
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
                <li class="active"><a href="tenant.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/user.png" alt="Home" class="me-2" width="20" height="20">Tenants</a></li>
                <li class=""><a href="apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
                <!-- <li class=""><a href="payrent.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/payrent.png" alt="Home" class="me-2" width="20" height="20">Pay Rent</a></li> -->
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
                            <p class="fs-6 fw-bold mt-3 text-center">Tenants</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">Contact Number</th>
                                        <th scope="col" class="text-center">Occupation</th>
                                        <th scope="col" class="text-center">Room Number</th>
                                        <th scope="col" class="text-center">Date Started</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_tenants";

                                $result = $conn->query($sql);

                                if (!$result) {
                                    die("Invalid query: " . $conn->error);
                                }

                                $i = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                    echo "
                                    <tr>
                                        <td class='text-center'>{$i}</td>
                                        <td class='text-center'>{$row['name']}</td>
                                        <td class='text-center'>{$row['email']}</td>
                                        <td class='text-center'>{$row['contact_number']}</td>
                                        <td class='text-center'>{$row['occupation']}</td>
                                        <td class='text-center'>{$row['apartment_id']}</td>
                                        <td class='text-center'>" . date('m/d/Y', strtotime($row['date_started'])) . "</td>
                                        <td class='text-center'>
                                            <button class='btn btn-primary btn-sm mr-2' data-bs-toggle='modal' data-bs-target='#editModal_{$row['tenant_id']}'>Edit</button>
                                            <button class='btn btn-danger btn-sm delete-btn' data-user-id='{$row['tenant_id']}' data-apartment-id='{$row['apartment_id']}'>Delete</button>
                                        </td>
                                    </tr>";
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
    <?php
$sql = "SELECT * FROM tbl_tenants";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
<!-- Edit Tenant Modal -->
<div class="modal fade" id="editModal_<?php echo $row['tenant_id']; ?>" tabindex="-1" aria-labelledby="editTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTenantModalLabel">Edit Tenant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tenant_id" value="<?php echo $row['tenant_id']; ?>">
                <div class="mb-3">
                    <label for="Fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="Fullname_<?php echo $row['tenant_id']; ?>" placeholder="Enter fullname" value="<?php echo $row['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email_<?php echo $row['tenant_id']; ?>" placeholder="Enter email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contact_<?php echo $row['tenant_id']; ?>" placeholder="Enter contact number" value="<?php echo $row['contact_number']; ?>">
                </div>
                <div class="mb-3">
                    <label for="addOccupation" class="form-label">Occupation</label>
                    <input type="text" class="form-control" id="addOccupation_<?php echo $row['tenant_id']; ?>" placeholder="Enter occupation" value="<?php echo $row['occupation']; ?>">
                </div>
                <div class="mb-3">
                    <label for="apartment" class="form-label">Room Number</label>
                    <input type="text" class="form-control" id="apartment_<?php echo $row['tenant_id']; ?>" value="<?php echo $row['apartment_id']; ?>" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary edit-btn" data-id="<?php echo $row['tenant_id']; ?>">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="Fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="Fullname" placeholder="Enter fullname">
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contact" placeholder="Enter contact number">
                </div>
                <div class="mb-3">
                    <label for="addOccupation" class="form-label">Occupation</label>
                    <input type="text" class="form-control" id="addOccupation" placeholder="Enter occupation">
                </div>
                <div class="mb-3">
                    <label for="apartmentSelect" class="form-label">Apartment</label>
                    <select class="form-select" id="apartmentSelect">
                        <?php
                            $apartmentQuery = "SELECT apartment_id, room_number, room_description FROM tbl_apartments WHERE vacancy = 'Vacant'";
                            $apartmentResult = mysqli_query($conn, $apartmentQuery);

                            // Check if there are any apartments
                            if (mysqli_num_rows($apartmentResult) > 0) {
                                // Output options for each apartment
                                while ($row = mysqli_fetch_assoc($apartmentResult)) {
                                    // Concatenate room number and room description with a space
                                    echo "<option value='" . $row['room_number'] . "'>" . $row['room_number'] . " - " . $row['room_description'] . "</option>";
                                }
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $(".add-btn").click(function(){
        var fullname = $("#Fullname").val();
        var email = $("#Email").val();
        var contact = $("#contact").val();
        var occupation = $("#addOccupation").val();
        var apartment_id = $("#apartmentSelect").val(); // Get selected apartment ID

        // Validate fields
        if (fullname === '' || email === '' || contact === '') {
            alert('Please fill in all required fields.');
            return; // Exit function if any required field is empty
        }

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return; // Exit function if email is invalid
        }

        $.ajax({
            url: "../api/add_tenants.php",
            type: "POST",
            dataType: "json",
            data: {
                fullname: fullname,
                email: email,
                contact: contact,
                occupation: occupation,
                apartment_id: apartment_id, // Pass apartment ID to PHP script
            },
            success: function(response){
                if (response.success) {
                    alert(response.success);
                    location.reload();
                } else if (response.error) {
                    alert(response.error); // Error message
                }
            },
            error: function(xhr, status, error){
                alert("Error: " + error); // Alert any AJAX error
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    $(".edit-btn").click(function(){
        var tenant_id = $(this).data("id");
        var fullname = $("#Fullname_" + tenant_id).val();
        var email = $("#Email_" + tenant_id).val();
        var contact = $("#contact_" + tenant_id).val();
        var occupation = $("#addOccupation_" + tenant_id).val();

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return; // Exit function if email is invalid
        }

        $.ajax({
            url: "../api/edit_tenants.php", // Replace with the API for editing tenant
            type: "POST",
            dataType: "json",
            data: {
                tenant_id: tenant_id,
                fullname: fullname,
                email: email,
                contact: contact,
                occupation: occupation
            },
            success: function(response){
                if (response.success) {
                    alert(response.success); // Success message
                    // Optionally, you can reload the page or update the table dynamically
                    location.reload(); // Reload the page to reflect changes
                } else if (response.error) {
                    alert(response.error); // Error message
                }
            },
            error: function(xhr, status, error){
                alert("Error: Unable to edit tenant.");
            }
        });
    });
});
</script>


<script>
$(document).ready(function(){
    $(".delete-btn").click(function(){
        var tenant_id = $(this).data("user-id");
        var apartment_id = $(this).data("apartment-id"); // Get the apartment ID
        
        var confirmation = confirm("Are you sure you want to delete this tenant?");
        
        if (confirmation) {
            $.ajax({
                url: "../api/delete_tenants.php", // API endpoint for deleting tenant and updating vacancy status
                type: "POST",
                dataType: "json",
                data: {
                    tenant_id: tenant_id,
                    apartment_id: apartment_id // Pass apartment ID to the PHP script
                },
                success: function(response){
                    if (response.success) {
                        alert(response.success); // Success message
                        location.reload(); // Reload the page to reflect changes
                    } else if (response.error) {
                        alert(response.error); // Error message
                    }
                },
                error: function(xhr, status, error){
                    alert("Error: Unable to delete tenant.");
                }
            });
        }
    });
});
</script>
</body>
</html>
