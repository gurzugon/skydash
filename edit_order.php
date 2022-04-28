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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
  @import"compass/css3";

    * {
      box-sizing: border-box;
    }
    .formPopup {
      display: none;
      position: fixed;
      left: 55%;
      top: 20%;
      transform: translate(-50%, 5%);
      z-index: 9;
    }
    .formContainer input[type=text],
    .formContainer input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 20px 0;
      border: none;
      background: #eee;
    }
    .formContainer input[type=text]:focus,
    .formContainer input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    .formContainer .btn {
      padding: 12px 20px;
      border: none;
      background-color: #8ebf42;
      color: #fff;
      cursor: pointer;
      width: 100%;
      margin-bottom: 15px;
      opacity: 0.8;
    }
    .formContainer .cancel {
      background-color: #cc0000;
    }
    .formContainer .btn:hover,
    .openButton:hover {
      opacity: 1;
    } 
  </style>
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
    
         <!-- SQL Tag call vendor -->
    <?php
            $sql = "SELECT * FROM orderlist WHERE order_id = $_GET[order_id]";
                if ($result_order = mysqli_query($conn, $sql))
                    {
                        $rows_order = $result_order->fetch_array();
                        $total_order = $result_order->num_rows;
                        $num_order = 0;
                    }	
        ?>
      <!-- End SQL Tag call vendor -->

      <!-- SQL Tag call update vendor -->
    <?php
            if(isset($_POST['update']))
                    {
                      
                      $sql_update = "UPDATE orderlist SET order_no = '".$_POST['order_no']."', date = '".$_POST['date']."', 
                      status = '".$_POST['status']."', vendor_name = '".$_POST['vendor_name']."', rider_name = '".$_POST['rider_name']."', 
                      type_pay = '".$_POST['type_pay']."', tips = '".$_POST['tips']."', delivery_fees = '".$_POST['delivery_fees']."' WHERE order_id = '".$_GET['order_id']."'";
                      if($result_update = mysqli_query($conn, $sql_update))
                      {
                        echo "<script language=javascript>alert('Vendor Updated!');
                        window.location='order';</script>";
                      }
                      else
                      {
                        echo" FAILED ";
                      }
                    }
    ?>
      <!-- End SQL Tag call update vendor -->

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Update Order</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
               </div><br><br>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <?php if($total_order>0) {do { ?>
                   <form class="forms-sample" method="post">
                      <div class="form-group">
                        <label>Order No.</label>
                        <input type="text" name="order_no" class="form-control" value="<?php echo $rows_order['order_no'];?>">
                      </div>
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo $rows_order['date'];?>">
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status">
                            <option><?php echo $rows_order['status'];?></option>
                            <option value="Delivered">Delivered</option>
                            <option value="Failed">Failed</option>
                          </select>
                        </div>
                      <div class="form-group">
                        <label>Vendor Name</label>
                        <input type="text" name="vendor_name" class="form-control" value="<?php echo $rows_order['vendor_name'];?>">
                      </div>
                      <div class="form-group">
                        <label>Rider Name</label>
                        <input type="text" name="rider_name" class="form-control" value="<?php echo $rows_order['rider_name'];?>">
                      </div>
                      <div class="form-group">
                        <label>Type of Payments</label>
                          <select class="form-control" name="type_pay">
                            <option><?php echo $rows_order['type_pay'];?></option>
                            <option value="Cash">Cash</option>
                            <option value="FPX">FPX</option>
                            <option value="Credit/Debit Card">Credit/Debit Card</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Tips (RM)</label>
                            <input type="text" name="tips" class="form-control" value="<?php echo $rows_order['tips'];?>">
                          </div>
                          <div class="form-group">
                            <label>Delivery Fees (RM)</label>
                            <input type="text" name="delivery_fees" class="form-control" value="<?php echo $rows_order['delivery_fees'];?>">
                          </div>
                          <div class="form-group">
                            <label>Gross Sale (RM)</label>
                            <input type="text" class="form-control" id="gross" placeholder="ringgit2" readonly/>
                          </div>
                          <div class="form-group">
                            <label>Sum Order (RM)</label>
                            <input type="text" class="form-control"id="sum" placeholder="posen2" readonly/>
                          </div>
                      <button name="update" type="submit" class="btn btn-primary mr-2">Update</button>
                      <a href="list_rider">
                        <input type="button" value="Back" class="btn btn-light mr-2" onClick="history.go(-1);">
                      </a>
                    </form>
                    <?php } while ($rows_order = $result_order->fetch_array());}?>
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

