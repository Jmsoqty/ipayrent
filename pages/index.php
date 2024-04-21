<?php
session_start();
include '../api/dbconfig.php';
if (isset($_SESSION['loggedinasadmin']) && $_SESSION['loggedinasadmin'] === true) {
  header('Location: ../components/success.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
   <div class="container">
        <div class="mb-3 bg p-5 rounded ">
            <img src="../assets/images/logo.png" alt="Logo" class="img-fluid mb-1 mx-auto d-block" style="max-width: 200px;">
            <h2 class="text-center log">Login</h2>
            <label for="Username" class="form-label mt-5 fw-semibold">Username</label>
            <input type="text" class="form-control" name="username" id="Username" placeholder="Enter Username">
            <label for="Password" class="form-label mt-3 fw-semibold">Password</label>
            <input type="password" class="form-control" name="password" id="Password" placeholder="Enter Password">
            <button type="button" class="form-control btn-color fw-semibold mt-4" id="loginbtn"> Login</button>
        </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
    $(document).ready(function(){
        $("#loginbtn").click(function(){
            var username = $("#Username").val();
            var password = $("#Password").val();
            $.ajax({
                url: "../api/sign_in.php",
                type: "POST",
                dataType: "json",
                data: {
                    username: username,
                    password: password
                },
                success: function(response){
                    if(response.success){
                        window.location.href = response.redirect;
                    } else {
                        alert(response.error);
                    }
                },
                error: function(){
                    alert("Error: Unable to login.");
                }
            });
        });
    });
   </script>
</body>
</html>
