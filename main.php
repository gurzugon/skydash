<?php
include('config.php');
session_start();

if(!$_SESSION['userID'])
{
	echo "<script language=javascript>alert('Insert your ID and phone number!');
			window.location='index';</script>";
}

$sql_admin = "SELECT * FROM user WHERE userID = '".$_SESSION['userID']."'";
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
  <meta name="viewport" content="user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Rider Schedule</title>
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
  <link rel="shortcut icon" href="images/icon.png" />
  <script>
    (function(){
	    var window_width = $(window).width();
	    if(window_width < 480){
		  document.getElementById("first").text = "";
	  }
    })()
  </script>
  <script type = "text/javascript" >
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
  </script>
</head>
<style>
    * {
      box-sizing: border-box;
    }
    .formPopup {
      display: none;
      position: fixed;
      left: 50%;
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
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="height: 50px;">
      <div style="background-color: #fff;" class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="main"><img src="images/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="main"><img src="images/icon.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
           </li>
        </ul>
        <center>
          <h3 style="padding-right: 70px;" class="font-weight-bold"><?php echo $rows_admin ['earning'];?></h3>
          <h6 style="padding-right: 65px;" class="font-weight-normal mb-0"><?php echo $rows_admin ['date'];?>, <?php echo $rows_admin ['time'];?></span></h6>
        </center> 
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/rider.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout?=<?php echo $rows ['userID'];?>">
                <i class="ti-power-off text-primary"></i>
                Home
              </a>
            </div>
          </li>
         </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Rider Shift</h3>
                  <h6 class="font-weight-normal mb-0"><?php echo $rows_admin ['name'];?></span></h6>
                  <h6 class="font-weight-normal mb-0"><?php echo $rows_admin ['userID'];?></span></h6>
                </div>
                <button style="background-color: #db2b30;" type="button" class="btn btn-primary btn-icon-text openButton" onclick="openForm()">
                    <i class="ti-plus btn-icon-prepend"></i>
                    <i class="ti-timer btn-icon-prepend"></i>
                    Add Shift
                </button>
              </div>
            </div>
          </div>
         
        <!-- SQL Tag call add shift -->
        <?php
            $sql = "SELECT * FROM rider_shift, shift WHERE rider_shift.shiftId = shift.shiftId AND rider_shift.userID = '".$_SESSION['userID']."'"; 
                if ($result = mysqli_query($conn, $sql))
                    {
                        $rows = $result->fetch_array();
                        $total = $result->num_rows;
                        $num = 0;
                    }	
        ?>
        <!-- End SQL Tag call add shift -->

         <!-- SQL Tag call add shift -->
         <?php
            $sql_shift = "SELECT * FROM shift";
                if ($result_shift = mysqli_query($conn, $sql_shift))
                    {
                        $rows_shift = $result_shift->fetch_array();
                        $total_shift = $result_shift->num_rows;
                        $num_shift = 0;
                    }	
        ?>
        <!-- End SQL Tag call add shift -->

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
               <h4 class="card-title">Shift Details</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          Shift
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if($total>0) {do { ?>
                      <tr>
                       <td>
                        <?php echo $rows['shift'];?>
                        </td>
                      </tr>
                      <?php } while ($rows = $result->fetch_array());} else {?>
	                     <tr>
		                  <td colspan=4 align="center">No Record!</td>
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
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. Maqan Sdn Bhd.</span>
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
  <div class="col-md-6 grid-margin stretch-card formPopup" id="popupForm" style="background-color: #9796f4;">
    
      <div class="card-body"><a class="close" href="#" onclick="closeForm()">&times;</a>
        <h4 class="card-title">Add Rider Shift</h4>
        <form class="forms-sample" action="shift" method="post">
          <div class="form-group">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Available Shift</label>
                <div class="col-sm-9">
                  <select name="shiftId" class="form-control">
                    <option disabled>--Shift--</option>
                    <?php if($total_shift>0) {do { ?>
                    <option value="<?php echo $rows_shift['shiftId'];?>"><?php echo $rows_shift['shift'];?>(<?php echo $rows_shift['available'];?>)</option>
                    <?php } while ($rows_shift = $result_shift->fetch_array());}?>
                  </select>
               </div>
              </div>
            </div>
          </div>
          <div class="form-check form-check-flat form-check-primary">
          <button name="submit" type="submit" class="btn btn-primary mr-2">Submit</button>
        </div>
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

