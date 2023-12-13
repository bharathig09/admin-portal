
<?php include 'header.php'; ?>
<div class="main-content">
        <section class="section">
            <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Home</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="#">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Home</li>
            </ul>
            <div class="section-body">
                <h1 class="text-center">Welcome!</h1>
                
                <div class="text-center">
                <?php echo "<h2>".$_SESSION["admin_name"]."</h2><br>";?>
                </div>
            </div>
        </section>
</div>
<?php include 'footer.php'; ?>

</body>

</html>