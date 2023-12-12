
<?php 
session_start();

if (!isset($_SESSION['id'])) {
    // Redirect to login.php
    header("Location: login.php");
    exit(); // Ensure that the script stops here
}

    require_once("config.php");

    include_once("header.php");


?>

<body>
    <div class="main-content">
        <section class="section">
        <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Dashboard</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="menu.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Dashboard</li>

        </ul>
    
        </section>

        <h2><?php echo $id; ?> Welcome <?php echo $name; ?></h2>


    </div>

</body>
    
<?php
    include_once("footer.php");

?>

