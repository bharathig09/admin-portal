
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>FSW - Admin Dashboard Template</title>
 
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/core/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/daygrid/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/timegrid/main.min.css' />
  <link rel="stylesheet" href="assets/bundles/prism/prism.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/fs_world/assets/img/favicon.ico' />

  <link rel="stylesheet" href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline me-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="menu"></i></a></li>
            <li>
              <form class="form-inline me-auto">
                <div class="search-element d-flex">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a></li>
          <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="admin.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello - <?php echo $_SESSION['username']?></div>
              <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="/fs_world/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="https://fullstackworld.co.in/"> <img alt="image" src="sclogo.png" class="header-logo" /> <span
                class="logo-name">FS World</span>
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="admin.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name">Welcome - <?php echo $_SESSION['username']?></div>
              <div class="user-role">Administrator</div>
              <div class="sidebar-userpic-btn">
                <a href="#" data-bs-toggle="tooltip" title="Profile">
                  <i data-feather="user"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Mail">
                  <i data-feather="mail"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Chat">
                  <i data-feather="message-square"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Log Out">
                  <i data-feather="log-out"></i>
                </a>
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="index.php"  id="loadDashboard2" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Menus</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="menudb.php" id="loadDashboard">Add Menu</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Instructors</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="instructorsdb.php" id="loadDashboard">Add instructors</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Bootcamp</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="bootcampdb.php" id="loadDashboard">Add Bootcamp</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Current Openings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="current_opendb.php" id="loadDashboard">Add Current Openings</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Metadata</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="metadb.php" id="loadDashboard">Add Metadata</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"  class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Registration</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="registrationdb.php" id="loadDashboard">Add Registration</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>
    </div>
  </div>

    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
    <script src="assets/bundles/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <script src="assets/bundles/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/index.js"></script>
    <script src="assets/js/page/form-wizard.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
  
    <script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
    <script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
   
      <!-- JS Libraies -->
    <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
    <script src="assets/js/page/toastr.js"></script>
    <script src="assets/js/page/sweetalert.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>