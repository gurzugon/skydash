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
                  <h3 class="font-weight-bold">Maqan Rider</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
                <button type="button" class="btn btn-primary btn-icon-text openButton" onclick="openForm()">
                    <i class="ti-plus btn-icon-prepend"></i>
                    <i class="ti-user btn-icon-prepend"></i>
                    Add Rider
                  </button>
              </div>
            </div>
          </div>
         
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Rider Details</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          Rider
                        </th>
                        <th>
                          Rider Name
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Phone No.
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if($total_rider>0) {do { ?>
                      <tr>
                        <td class="py-1">
                          <img src="images/faces/rider.png" alt="image"/>
                        </td>
                        <td>
                        <?php echo $rows_rider['rider_name'];?>
                        </td>
                        <td>
                        <?php echo $rows_rider['status'];?>
                        </td>
                        <td>
                        <?php echo $rows_rider['phone_no'];?>
                        </td>
                        <td>
                        <?php echo $rows_rider['address'];?>
                        </td>
                        <td>
                          <button title="Edit" type="button" class="btn btn-primary btn-rounded btn-icon" onclick="openForm2()">
                              <i class="ti-write"></i>
                          </button>
                        <a href="delete_rider?rider_id=<?php echo $rows_rider['rider_id'];?>">
                          <button title="Delete" type="button" class="btn btn-primary btn-rounded btn-icon">
                            <i class="ti-trash"></i>
                          </button>
                        </a>
                      </td>
                      </tr>
                      <?php } while ($rows_rider = $result_rider->fetch_array());} else {?>
	                     <tr>
		                  <td colspan=6 align="center">No Record!</td>
	                     </tr>
	                    <?php } ?> 
                    </tbody>
                  </table>
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

  <!-- Form rider -->
  <div class="col-md-6 grid-margin stretch-card formPopup overlay" id="popupForm" style="background-color: #9796f4;">
    <div class="card" style="background-color: #9796f4;">
      <div class="card-body"><a class="close" href="#" onclick="closeForm()">&times;</a>
        <h4 class="card-title">Add Maqan Rider</h4>
        <form class="forms-sample" method="post" action="add_rider">
          <div class="form-group">
            <label>Rider Name</label>
            <input type="text" name="name" class="form-control" id="" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" id="" placeholder="Address" required>
          </div>
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" name="phone_no" class="form-control" id="" placeholder="Phone" required>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                    <option>--Status--</option>
                    <option value="Active">Active</option>
                    <option value="Deactivate">Deactivate</option>
                  </select>
          </div>
          <div class="mt-3">
              <button type="submit" name="add" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- SQL Tag call edit rider -->
   <?php
            $sql = "SELECT * FROM rider WHERE rider_id = '".$_GET['rider_id']."'";
            if ($result_edit = mysqli_query($conn, $sql))
                {
                    $rows_edit = $result_edit->fetch_array();
                    $total_edit = $result_edit->num_rows;
                    $num_edit = 0;
                }	

            if(isset($_POST['update']))
                    {
                      
                      $sql_update = "UPDATE rider SET rider_name = '".$_POST['rider_name']."', address = '".$_POST['address']."', phone_no = '".$_POST['phone_no']."', status = '".$_POST['status']."'";
                      if($result_update = mysqli_query($conn, $sql_update))
                      {
                        echo "<script language=javascript>alert('Rider Updated!');
                        window.location='list_rider';</script>";
                      }
                      else
                      {
                        echo" FAILED ";
                      }
                    }
    ?>
      <!-- End SQL Tag call edit rider -->

  <!-- Edit Rider -->
  <div class="col-md-6 grid-margin stretch-card formPopup overlay" id="popupForm2" style="background-color: #9796f4;">
    <div class="card" style="background-color: #9796f4;">
      <div class="card-body"><a class="close" href="#" onclick="closeForm2()">&times;</a>
        <h4 class="card-title">Edit Maqan Rider</h4>
        <form class="forms-sample" method="post" action="">
          <div class="form-group">
            <label>Rider Name</label>
            <input type="text" name="rider_name" class="form-control" id="" value="HAZIQ" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" id="" value="NO 7 JALAN PULAI 11 TAMAN BUKIT TIRAM" required>
          </div>
          <div class="form-group">
            <label>Phone No.</label>
            <input type="text" name="phone_no" class="form-control" id="" value="0197621919" required>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                    <option>--Status--</option>
                    <option value="Active">Active</option>
                    <option value="Deactivate">Deactivate</option>
                  </select>
          </div>
          <div class="form-check form-check-flat form-check-primary">
          </div>
          <button type="submit" name="update" class="btn btn-primary mr-2">Update</button>
         </form>
         </div>
    </div>
  </div>
 <script>
    function openForm() {
      document.getElementById("popupForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("popupForm").style.display = "none";
    }
  </script>
  <script>
    function openForm2() {
      document.getElementById("popupForm2").style.display = "block";
    }
    function closeForm2() {
      document.getElementById("popupForm2").style.display = "none";
    }
  </script>
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

