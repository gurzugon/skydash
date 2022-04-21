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
              <a class="dropdown-item" href="logout.php">
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
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->

      <!-- SQL tag call order -->

      <?php
            
            $sql = "SELECT * FROM orderlist, vendor, rider WHERE orderlist.vendor_name = vendor.vendor_name AND orderlist.rider_name = rider.rider_name AND orderlist.order_id = order_id";
                if ($result_order = mysqli_query($conn, $sql))
                    {
                        $rows_order = $result_order->fetch_array();
                        $total_order = $result_order->num_rows;
                        $num_order = 0;
                    }	
        ?>

      <!-- End SQL tag to call order -->

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

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Orders</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>
                </div>
                <button type="button" class="btn btn-primary btn-icon-text openButton" onclick="openForm()">
                  <i class="ti-write btn-icon-prepend"></i>
                  Add Order
                </button>
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Order Details</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="" class="display expandable-table" style="width:100%" cellpadding="5" cellspacing="0" border="0">
                          <thead>
                            <tr class="expanded-row">
                              <th>Order No.</th>
                              <th>Type of Payments</th>
                              <th>Vendor</th>
                              <th>Rider</th>
                              <th>Total</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                          </thead>
                          <?php if($total_order>0) {do { ?>
                           <tr class="expanded-row">
                             <td><?php echo $rows_order['order_no'];?></td>
                             <td><?php echo $rows_order['type_pay'];?></td>
                             <td><?php echo $rows_order['vendor_name'];?></td>
                             <td><?php echo $rows_order['rider_name'];?></td>
                             <td>RM 200</td>
                             <td><?php echo $rows_order['status'];?></td>
                             <td><?php echo $rows_order['date'];?></td>
                             <td></td>
                             <tr class="expanded-row">
                              <td colspan="8" class="row-bg"><div>
                                <div class="d-flex justify-content-between">
                                  <div class="cell-hilighted">
                                    <div class="d-flex mb-2">
                                      <div class="mr-2 min-width-cell">
                                        <p>Date</p>
                                        <h6><?php echo $rows_order['date'];?></h6>
                                      </div>
                                      <div class="min-width-cell">
                                        <p>Tips</p>
                                        <h6><?php echo $rows_order['tips'];?></h6>
                                      </div>
                                    </div>
                                    <div class="d-flex">
                                      <div class="mr-2 min-width-cell">
                                        <p>Delivery Fees</p>
                                        <h5><?php echo $rows_order['delivery_fees'];?></h5>
                                      </div>
                                      <div class="min-width-cell">
                                        <p>Sum Order</p>
                                        <h5>RM 26.00</h5>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-3 d-flex">
                                      <div class="highlighted-alpha"><?php echo $rows_order['vendor_name'];?></div>
                                      <div><p>Vendor Name</p>
                                        <h6><?php echo $rows_order['vendor_name'];?></h6>
                                      </div>
                                    </div>
                                    <div class="mr-2 d-flex"> 
                                      <img src="images/faces/rider.png" alt="profile"/>
                                      <div>
                                        <p>Rider Name</p>
                                        <h6><?php echo $rows_order['rider_name'];?></h6>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="expanded-table-normal-cell">
                                    <div class="mr-2 mb-4">
                                      <p>Address</p>
                                      <h6><?php echo $rows_order['vendor_add'];?></h6>
                                    </div>
                                  </div>
                                  <div class="expanded-table-normal-cell">
                                    
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                           </tr>
                           <?php } while ($rows_order = $result_order->fetch_array());} else {?>
	                     <tr>
		                  <td colspan=7 align="center">No Record!</td>
	                     </tr>
	                     <?php } ?> 
                      </table>
                      </div>
                    </div>
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
  <!-- SQL tag insert order -->

<?php
if(isset($_POST['add']))
{
    //check database if the order number is already exist
	$sql_u = "SELECT * FROM orderlist WHERE order_no = '".$_POST['order_no']."' ";
	$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0 ) {
	echo  ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Order already beeen made!');
				window.location='order';
			</SCRIPT>");
}else{
	$sql_add = 	"INSERT INTO orderlist (order_no, date, status, vendor_name, rider_name, type_pay, delivery_fees, tips) VALUES 
    ('".$_POST['order_no']."', '".$_POST['date']."', '".$_POST['status']."', '".$_POST['vendor_name']."', '".$_POST['rider_name']."', '".$_POST['type_pay']."', '".$_POST['delivery_fees']."', '".$_POST['tips']."')";
	if($result_add = mysqli_query($conn, $sql_add))
	{
		
		echo  ("<SCRIPT LANGUAGE='JavaScript'>
				    window.alert('Succesfully Add');
				    window.location='order';
				</SCRIPT>");
			}
			
		}
	}
?>

  <!-- End SQL tag insert order -->

   <!-- Form rider -->
   <div class="col-md-8 grid-margin stretch-card formPopup" id="popupForm"  style="background-color: #9796f4; border-radius: 5%;">  <div class="card-body" style="padding-left: 0px; padding-right: 0px;"><a class="close" href="#" onclick="closeForm()">&times;</a>
        <h3 class="card-title">Add Order</h3>
        <form class="form-sample" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Order Number</label>
                <div class="col-sm-9">
                  <input type="text" name="order_no" class="form-control" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-9">
                  <input type="date" name="date" class="form-control" placeholder="dd-mm-yyyy" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Vendor</label>
                <div class="col-sm-9">
                  <select name="vendor_name" class="form-control" required>
                    <option>--Vendor--</option>
                    <?php if($total_vendor>0) {do { ?>
                    <option value="<?php echo $rows_vendor['vendor_name'];?>"><?php echo $rows_vendor['vendor_name'];?></option>
                    <?php } while ($rows_vendor = $result_vendor->fetch_array());}?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Rider</label>
                <div class="col-sm-9">
                <select name="rider_name" class="form-control" required>
                    <option>--Rider--</option>
                    <?php if($total_rider>0) {do { ?>
                    <option value="<?php echo $rows_rider['rider_name'];?>"><?php echo $rows_rider['rider_name'];?></option>
                    <?php } while ($rows_rider = $result_rider->fetch_array());}?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" class="form-control" required>
                    <option>--Order Status--</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed">Failed</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Type of Payment</label>
                <div class="col-sm-9">
                  <select name="type_pay" class="form-control" required>
                    <option>--Payment--</option>
                    <option value="Cash">Cash</option>
                    <option value="FPX">FPX</option>
                    <option value="Credit/Debit Card">Credit/Debit Card</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Delivery Fee(RM)</label>
              <div class="col-sm-9">
                <input type="text" name="delivery_fees" class="form-control" required/>
              </div>
            </div>
          </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tips(RM)</label>
                <div class="col-sm-9">
                  <input type="text" name="tips" class="form-control" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gross Sale(RM)</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Geross" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Sum Order(RM)</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="posen2" readonly/>
                </div>
              </div>
            </div>
            </div>
            <div class="mt-3">
              <button type="submit" name="add" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Add Order</button>
            </div>
         </form>
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
