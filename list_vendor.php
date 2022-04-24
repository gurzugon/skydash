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
            $sql = "SELECT * FROM vendor";
                if ($result_vendor = mysqli_query($conn, $sql))
                    {
                        $rows_vendor = $result_vendor->fetch_array();
                        $total_vendor = $result_vendor->num_rows;
                        $num_vendor = 0;
                    }	
        ?>
      <!-- End SQL Tag call vendor -->

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Maqan Vendor</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
                <button type="button" class="btn btn-primary btn-icon-text openButton" data-toggle="modal" data-target="#exampleModal">
                    <i class="ti-plus btn-icon-prepend"></i>
                    <i class="ti-shopping-cart btn-icon-prepend"></i>
                    Add Vendor
                </button>
              </div>
            </div>
          </div>
         
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
               <h4 class="card-title">Vendor Details</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          Vendor ID
                        </th>
                        <th>
                          Vendor Name
                        </th>
                        <th>
                          Owner Name
                        </th>
                        <th>
                          SSM No.
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
                    <?php if($total_vendor>0) {do { ?>
                      <tr>
                        <td>
                        <?php echo $rows_vendor['vendor_id'];?>
                        </td>
                        <td>
                        <?php echo $rows_vendor['vendor_name'];?>
                        </td>
                        <td>
                        <?php echo $rows_vendor['owner_name'];?>
                        </td>
                        <td>
                        <?php echo $rows_vendor['ssm_no'];?>
                        </td>
                        <td>
                        <?php echo $rows_vendor['vendor_add'];?>
                        </td>
                        <td>
                            <button title="Edit" type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="modal" data-target="#exampleModal2">
                                <i class="ti-write"></i>
                            </button>
                            <a href="delete_vendor?vendor_id=<?php echo $rows_vendor['vendor_id'];?>">
                            <button title="Delete" type="button" class="btn btn-primary btn-rounded btn-icon">
                                <i class="ti-trash"></i>
                            </button>
                        </td>
                      </tr>
                      <?php } while ($rows_vendor = $result_vendor->fetch_array());} else {?>
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

    <!-- SQL Tag call edit vendor -->
    <?php
            if(isset($_POST['update']))
                    {
                      
                      $sql_update = "UPDATE vendor SET vendor_name = '".$_POST['vendor_name']."', owner_name = '".$_POST['owner_name']."', vendor_add = '".$_POST['vendor_add']."', ssm_no = '".$_POST['ssm_no']."'";
                      if($result_update = mysqli_query($conn, $sql_update))
                      {
                        echo "<script language=javascript>alert('Vendor Updated!');
                        window.location='list_vendor';</script>";
                      }
                      else
                      {
                        echo" FAILED ";
                      }
                    }
    ?>
      <!-- End SQL Tag call edit vendor -->
  
  <!--popup form add vendor-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="add_vendor">
          <div class="form-group">
            <label>Vendor Name</label>
            <input type="text" name="vendor_name" class="form-control" id="" placeholder="Vendor Name" required>
          </div>
          <div class="form-group">
            <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control" id="" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="vendor_add" class="form-control" id="" placeholder="Address" required>
          </div>
          <div class="form-group">
            <label>SSM Number</label>
            <input type="text" name="ssm_no" class="form-control" id="" placeholder="SSM" required>
          </div>
          <div class="mt-3">
              <button type="submit" name="add" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--end popup form add rider-->

<!--popup form edit vendor-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="add_vendor">
          <div class="form-group">
            <label>Vendor Name</label>
            <input type="text" name="vendor_name" class="form-control" id="" placeholder="Vendor Name" required>
          </div>
          <div class="form-group">
            <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control" id="" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="vendor_add" class="form-control" id="" placeholder="Address" required>
          </div>
          <div class="form-group">
            <label>SSM Number</label>
            <input type="text" name="ssm_no" class="form-control" id="" placeholder="SSM" required>
          </div>
          <div class="mt-3">
              <button type="submit" name="add" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--end popup form edit rider-->

  <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
})
  </script>
  <!-- end js call up popup from-->

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

