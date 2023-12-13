<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .login-form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20vh;
        }
        .login-form h3 {
            color: #000;
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form .form-control {
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .login-form .btn-primary {
            background-color: #000;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            width: 100%;
        }
        .login-form .btn-primary:hover {
            background-color: #fff;
            color: #000;
        }
        .login-form .btn-secondary {
            background-color: #fff;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            width: 100%;
            color: #000;
            border: 1px solid #000;
        }
        .login-form .btn-secondary:hover {
            background-color: #000;
            color: #fff;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        .copyright {
            font-size: 12px;
            margin-top: 20px;
            text-align: center;
        }
        .trademark {
            font-size: 12px;
            margin-top: 10px;
            text-align: center;
        }
        .logo {
            width: 100px;
            height: 50px;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
    </style>
</head>
<body>
<?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
        <form action="/fs_world/signup.php" method="post" class="login-form">
                <h3>Signup</h3>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <input type="Confirm password" class="form-control" id="cpassword" name="cpassword" placeholder="Retype your  password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <img src='logo.png' alt="Logo" class="logo">
            <div class="trademark">© 2023 FS World Company. All rights reserved.</div>
            <div class="copyright">
                All trademarks, service marks, trade names, product names, logos and trade dress appearing on our website are the property of their respective owners.
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
