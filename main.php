<?php
include('config.php');
session_start();

if(!$_SESSION['user_id'])
{
	echo "<script language=javascript>alert('Session timeout!');
			window.location='index';</script>";
}

$sql_admin = "SELECT * FROM user WHERE user_id = '".$_SESSION['user_id']."'";
if($result_admin = mysqli_query($conn, $sql_admin))
{	
	$rows_admin = $result_admin->fetch_array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Maqan Statement</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/Zaiwani_logo2.png" />
</head>
<body>
  <div class="container-scroller sidebar-dark">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="main"><img src="images/Zaiwani_logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="main"><img src="images/Zaiwani_logo2.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
           </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/usr_icon.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
         </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="main">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Statement</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="invoice_vendor">Vendor</a></li>
                <li class="nav-item"> <a class="nav-link" href="invoice_rider">Rider</a></li>
              </ul>
            </div>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="order">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Order</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">List</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="list_vendor">Vendor</a></li>
                <li class="nav-item"> <a class="nav-link" href="list_rider">Rider</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- SQL tag call total dashboard entry -->
        <?php
            $sql = "SELECT COUNT(*) o FROM orderlist";
            $result = mysqli_query($conn, $sql);
            $rows_order = mysqli_fetch_assoc($result);
        ?>
        <?php
            $sql = "SELECT COUNT(*) u FROM user";
            $result = mysqli_query($conn, $sql);
            $rows_user = mysqli_fetch_assoc($result);
        ?>
        <?php
            $sql = "SELECT COUNT(*) v FROM vendor";
            $result = mysqli_query($conn, $sql);
            $rows_vendor1 = mysqli_fetch_assoc($result);
        ?>
        <?php
            $sql = "SELECT COUNT(*) r FROM rider";
            $result = mysqli_query($conn, $sql);
            $rows_rider1 = mysqli_fetch_assoc($result);
        ?>
      <!-- End SQL tag call total dashboard entry -->

       <!-- SQL Tag call admin/user -->
       <?php
            $sql = "SELECT * FROM user";
                if ($result = mysqli_query($conn, $sql))
                    {
                        $rows = $result->fetch_array();
                        $total = $result->num_rows;
                        $num = 0;
                    }	
        ?>
      <!-- End SQL Tag call admin/user -->

      <!-- SQL Tag call vendor -->
      <?php
            $sql = "SELECT * FROM vendor";
                if ($result_vendor = mysqli_query($conn, $sql))
                    {
                        $rows_vendor = $result_vendor->fetch_array();
                        $total_vendor = $result_vendor->num_rows;
                        $num_vendor = 0;
                    }	
        ?>
      <!-- End SQL Tag call vendor -->

       <!-- SQL Tag call rider -->
       <?php
            $sql = "SELECT * FROM rider";
                if ($result_rider = mysqli_query($conn, $sql))
                    {
                        $rows_rider = $result_rider->fetch_array();
                        $total_rider = $result_rider->num_rows;
                        $num_rider = 0;
                    }	
        ?>
      <!-- End SQL Tag call rider -->

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?php echo $rows_admin ['name'];?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal"><?php
                                                                    date_default_timezone_set("Asia/Kuala_Lumpur");
                                                                    echo  date("d-m-Y"); 
                                                                ?>
                        </h4>
                        <h6 class="font-weight-normal"><?php 
                                                            date_default_timezone_set("Asia/Kuala_Lumpur");
                                                            echo  date("h:i:a"); 
                                                        ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Orders</p>
                      <p class="fs-30 mb-2"><?php echo $rows_order ['o'];?></p>
                      <p><?php echo $rows_order ['o'];?>.00% </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of User</p>
                      <p class="fs-30 mb-2"><?php echo $rows_user ['u'];?></p>
                      <p>0.<?php echo $rows_user ['u'];?>% </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Vendors</p>
                      <p class="fs-30 mb-2"><?php echo $rows_vendor1['v'];?></p>
                      <p><?php echo $rows_vendor1 ['v'];?>.00% </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Number of Riders</p>
                      <p class="fs-30 mb-2"><?php echo $rows_rider1 ['r'];?></p>
                      <p><?php echo $rows_rider1 ['r'];?>.00% </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Vendors</p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Vendor Name</th>
                          <th class="border-bottom pb-2">Vendor ID</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($total_vendor>0) {do { ?>
                        <tr>
                          <td class="pl-0"><?php echo $rows_vendor['vendor_name'];?></td>
                          <td><p class="mb-0"><span class="font-weight-bold mr-2"><?php echo $rows_vendor['ssm_no'];?></span></p></td>
                        </tr>
                      <?php } while ($rows_vendor = $result_vendor->fetch_array());} else {?>
	                    <tr>
		                    <td colspan=2 align="center">No Record!</td>
	                    </tr>
	                  <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Riders</p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Name</th>
                          <th class="border-bottom pb-2">Phone Number</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($total_rider>0) {do { ?>
                        <tr>
                          <td class="pl-0"><?php echo $rows_rider['rider_name'];?></td>
                          <td><p class="mb-0"><span class="font-weight-bold mr-2"><?php echo $rows_rider['phone_no'];?></span></p></td>
                         </tr>
                      <?php } while ($rows_rider = $result_rider->fetch_array());} else {?>
	                    <tr>
		                    <td colspan=2 align="center">No Record!</td>
	                    </tr>
	                  <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Admins</p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Name</th>
                          <th class="border-bottom pb-2">Roles</th>
                          <th class="border-bottom pb-2">Email</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($total>0) {do { ?>
                        <tr>
                          <td class="pl-0"><?php echo $rows['name'];?></td>
                          <td><p class="mb-0"><span class="font-weight-bold mr-2"><?php echo $rows['role'];?></span></p></td>
                          <td class="pl-0"><?php echo $rows['email'];?></td>
                         </tr>
                      <?php } while ($rows = $result->fetch_array());} else {?>
	                     <tr>
		                  <td colspan=3 align="center">No Record!</td>
	                     </tr>
	                  <?php } ?> 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021-<?php echo date("Y"); ?>.  Zaiwani holdings Sdn Bhd. All rights reserved.</span>
          </div>
        </footer>  
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

