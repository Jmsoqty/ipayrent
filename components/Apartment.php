<?php
include '../api/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartments</title>
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
                <li class="active"><a href="apartment.php" class="text-decoration-none px-3 py-2 d-block mb-2"><img src="../assets/images/apartment.png" alt="Home" class="me-2" width="20" height="20">Apartments</a></li>
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
                <div class="p-5">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Room</button>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-primary-subtle ">
                            <p class="fs-6 fw-bold mt-3">Apartment</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Room Number</th>
                                        <th scope="col" class="text-center">Description</th>
                                        <th scope="col" class="text-center">Rate</th>
                                        <th scope="col" class="text-center">Vacancy</th>
                                        <th scope="col" class="text-center">Image</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM tbl_apartments";

                                    $result = $conn->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $conn->error);
                                    }

                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;
                                        // Convert rate to include peso sign
                                        $rate_with_peso = '₱' . number_format($row['rate'], 2);

                                        // Convert image to base64
                                        $image_base64 = base64_encode($row['image']);

                                        echo "
                                        <tr>
                                            <td class='text-center'>{$i}</td>
                                            <td class='text-center'>{$row['room_number']}</td>
                                            <td class='text-center'>{$row['room_description']}</td>
                                            <td class='text-center'>{$rate_with_peso}</td>
                                            <td class='text-center'>{$row['vacancy']}</td>
                                            <td class='text-center'><img src='data:image/jpeg;base64,{$image_base64}' style='max-width:100px; max-height:100px;' alt='Room Image'></td>
                                            <td class='text-center'>
                                                <button class='btn btn-primary btn-sm mr-2' data-bs-toggle='modal' data-bs-target='#editModal_{$row['room_number']}'>Edit</button>
                                                <button class='btn btn-danger btn-sm delete-btn' data-room-id='{$row['room_number']}'>Delete</button>
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

    
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRoomModalLabel">Add Room</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="roomNumber" placeholder="Enter Room Number">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room Description</label>
                        <input type="text" class="form-control" id="roomDescription" placeholder="Enter Description">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate</label>
                        <input type="number" class="form-control" id="roomRate" placeholder="Enter Rate">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room View</label>
                        <div id="roomImageContainer" style="margin: 10px;">
                            <div id="roomImagePreview" style="max-width: 100%; margin: 10px;"></div>
                            <input type="file" class="form-control" id="roomImageInput" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="addRoomBtn">Add Room</button>
            </div>
        </div>
    </div>
</div>
<?php
$sql = "SELECT * FROM tbl_apartments";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $image_base64 = base64_encode($row['image']);
?>

<div class="modal fade" id="editModal_<?php echo $row['room_number']; ?>" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRoomModalLabel">Edit Room</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="roomNumber_<?php echo $row['room_number']; ?>" value="<?php echo $row['room_number']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room Description</label>
                        <input type="text" class="form-control" id="roomDescription_<?php echo $row['room_number']; ?>" value="<?php echo $row['room_description']; ?>"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate</label>
                        <input type="number" class="form-control" id="roomRate_<?php echo $row['room_number']; ?>" value="<?php echo $row['rate']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vacancy</label>
                        <select class="form-select" id="vacancy_<?php echo $row['room_number']; ?>">
                            <option value="Vacant" <?php echo ($row['vacancy'] == 'Vacant') ? 'selected' : ''; ?>>Vacant</option>
                            <option value="Occupied" <?php echo ($row['vacancy'] == 'Occupied') ? 'selected' : ''; ?>>Occupied</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Room View</label>
                        <div id="roomImageContainer_<?php echo $row['room_number']; ?>" style="margin: 10px; text-align: center;">
                            <div id="roomImagePreview_<?php echo $row['room_number']; ?>" style="max-width: 100%; margin: 10px;"><img src='data:image/jpeg;base64,<?php echo $image_base64; ?>' alt='Room Image' style="max-width: 100%; height: auto;"></div>
                            <input type="file" class="form-control roomImageInput" data-room-number="<?php echo $row['room_number']; ?>" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary editRoomBtn" data-room-number="<?php echo $row['room_number']; ?>">Edit Room</button>
            </div>
        </div>
    </div>
</div>

<?php } ?>




    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to handle file input change event
    $("#roomImageInput").change(function() {
        readURL(this);
    });

    // Function to read the selected file and display it
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#roomImagePreview').html('<img src="' + e.target.result + '" style="max-width: 100%; margin: 15px;">').show();
            }

            reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
        }
    }
});
</script>
<script>
$(document).ready(function() {
    // Function to handle file input change event
    $("#roomImageInput").change(function() {
        readURL(this);
    });

    // Function to read the selected file and display it
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#roomImagePreview').html('<img src="' + e.target.result + '" style="max-width: 100%; margin-top: 20px;">').show();
            }

            reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
        }
    }

    // Function to handle add room button click event
    $("#addRoomBtn").click(function() {
        // Check if all input fields are filled up
        var roomNumber = $("#roomNumber").val();
        var roomDescription = $("#roomDescription").val();
        var roomRate = $("#roomRate").val();
        var roomImageInput = $("#roomImageInput").val();

        if (roomNumber === '' || roomDescription === '' || roomRate === '' || roomImageInput === '') {
            alert('Please fill up all fields');
            return;
        }

        // Get room details from input fields
        var formData = new FormData();
        formData.append('roomNumber', roomNumber);
        formData.append('roomDescription', roomDescription);
        formData.append('roomRate', roomRate);
        formData.append('roomImageInput', $('#roomImageInput')[0].files[0]);

        // Send AJAX request to the API
        $.ajax({
            url: '../api/add_apartment.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response from the API
                response = JSON.parse(response);
                if (response.success) {
                    alert(response.success); // Display success message
                    location.reload();
                } else if (response.error) {
                    alert(response.error); // Display error message
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
                alert('Error adding room. Please try again.'); // Display generic error message
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {
        // Function to handle editing room details
        $('.editRoomBtn').click(function() {
            var roomNumber = $(this).data('room-number');
            var roomDescription = $('#roomDescription_' + roomNumber).val();
            var roomRate = $('#roomRate_' + roomNumber).val();
            var vacancy = $('#vacancy_' + roomNumber).val(); // Get selected vacancy status
            var imageInput = $('.roomImageInput[data-room-number="' + roomNumber + '"]')[0].files[0];

            var formData = new FormData();
            formData.append('roomNumber', roomNumber);
            formData.append('roomDescription', roomDescription);
            formData.append('roomRate', roomRate);
            formData.append('vacancy', vacancy); // Append vacancy status to formData
            if (imageInput) {
                formData.append('roomImageInput', imageInput);
            }

            $.ajax({
                type: 'POST',
                url: '../api/edit_apartment.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        // Room updated successfully
                        alert(data.success);
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        // Error updating room
                        alert(data.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating room: ' + error);
                }
            });
        });

        // Handle change event of file input
        $('.roomImageInput').change(function() {
            var roomNumber = $(this).data('room-number');
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#roomImagePreview_' + roomNumber).html('<img src="' + e.target.result + '" alt="Room Image" style="max-width: 100%; height: auto;">');
            }

            reader.readAsDataURL(file);
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Function to handle delete button click
        $('.delete-btn').click(function() {
            // Get the room number from the button's data attribute
            var roomNumber = $(this).data('room-id');

            // Ask for confirmation before deleting
            var confirmation = confirm("Are you sure you want to delete this room?");
            if (confirmation) {
                // User confirmed, make AJAX request to delete the room
                $.ajax({
                    url: '../api/delete_apartment.php',
                    method: 'POST',
                    data: { roomNumber: roomNumber },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Room deleted successfully, reload the page or update UI as needed
                            alert(response.success);
                            location.reload(); // Reload the page
                        } else {
                            // Error deleting room, display error message
                            alert(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Error making AJAX request, display error message
                        alert('Error deleting room: ' + error);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
