<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" type="text/css" href="../assets/boostrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script type="text/javascript" src="/assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/rental.js"></script>

</head>
<body>
   <div class="container">
    <form class="form-group" action="login.php" method="post">
        <div class="mb-3 bg p-5 rounded ">
            <img src="../assets/images/logo.png" alt="Logo" class="img-fluid mb-1 mx-auto d-block" style="max-width: 200px;">
            <h2 class="text-center log">Login</h2>
        <label for="" class="form-label mt-5 fw-semibold">Username</label>
        <input type="text" class="form-control" name="Username" id="Username"placeholder="Enter Username">
        <label for="" class="form-label mt-3 fw-semibold">Password</label>
        <input type="password" class="form-control" name="Password" id="Password" placeholder="Enter Password">
        <button type="submit"class="form-control btn-color fw-semibold mt-4 " id="loginbtn"> Login</button>
        </div>
    </form>
   </div>
      
</body>
</html>