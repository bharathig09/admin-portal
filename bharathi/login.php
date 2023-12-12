<?php
session_start();

require_once("config.php");


if(isset($_SESSION['login_error'])) {
    echo "<script>  
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Account details',
                text: ''
            });
        });
    </script>";

   
    unset($_SESSION['login_error']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["loginBtn"])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]); 
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $sql = mysqli_query($conn, "SELECT * FROM admins WHERE admin_email='$email' AND admin_password='$password'");
        // $num_rows = mysqli_num_rows($sql);

        if ($sql->num_rows > 0) {
          $row = $sql->fetch_assoc();
          $_SESSION["admin_name"] =$row["admin_name"];
          $_SESSION["admin_email"] = $email;

          header("location:index.php");
        } else {
            
            $_SESSION['login_error'] = true;
            header("location:login.php");
            exit(); 
        }
    } 
}

?>


<html lang="en">
    <script src="blob:https://www.einfosoft.com/97b2cf34-2e9c-4601-bc2e-279c4e6b8276"></script>
    <head>


  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gati - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
<style type="text/css">
</style>
</head>

<body class="dark theme-black dark-sidebar sidebar-gone">
  <div class="loader" style="display: none;"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="">
                    <div class="invalid-feedback">
                      Please fill valid email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                    <div class="invalid-feedback">
                      please fill valid password
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="loginBtn" name="loginBtn">
                      Login
                    </button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  

</body>



</html>