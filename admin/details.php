<?php
    include '../config.php';
    session_start();

    if($_SESSION['admin_id'])
      {
	      echo "<script language=javascript>alert('Please Log in Again!');
			  window.location.href ='index';</script>";
      }
      //session user
      $sql_admin = "SELECT * FROM admin WHERE admin_id = '".$_SESSION['admin_id']."'";
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
  <title>Admin Rider</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/logo.png" />
</head>

<body oncontextmenu="return false;">
  <div class="container-scroller">
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">        
        <div class="content-wrapper" style="background-color: #db2b30; background-image: url('../images/bg2.png'); background-size: contain;">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <a href="main">
                <button name="" type="button" class="btn btn-outline-dark btn-rounded btn-icon">
                    <i class="ti-angle-left" style="width: 100;"></i>
                </button>
              </a>
            </div>
           </div><br><br>

             <!-- SQL Tag call rider -->
             <?php
                        $sql = "SELECT * FROM user WHERE userID = '".$_GET['userID']."'";
                                if ($result_rider = mysqli_query($conn, $sql))
                                    {
                                        $rows_rider= $result_rider->fetch_array();
                                        $total_rider = $result_rider->num_rows;
                                        $num_rider = 0;
                                    }	
              ?>
                        <!-- End SQL Tag call rider -->

              
               <!-- SQL Tag call add shift -->
           <?php
                    $sql = "SELECT * FROM rider_shift, shift WHERE rider_shift.shiftId = shift.shiftId AND rider_shift.userID = '".$_GET['userID']."'"; 
                     if ($result = mysqli_query($conn, $sql))
                      {
                        $rows = $result->fetch_array();
                        $total = $result->num_rows;
                        $num = 0;
                      }	
          ?>

        <!-- End SQL Tag call add shift -->
            <div class="col-100 grid-margin">
            <?php if($total_rider>0) {do { ?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $rows_rider['userID'];?></h4>
                  <h4 class="card-title"><?php echo $rows_rider['name'];?></h4>
                 <form class="form-sample" method="post" action="update?userID=<?php echo $rows_rider['userID'];?>">
                    <p class="card-description">
                    <?php echo $rows_rider['email'];?><br>
                    <?php echo $rows_rider['phone'];?><br>
                    </p><br>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Earning(RM)</label>
                          <div class="col-sm-9">
                            <input type="text" name="earning" class="form-control" value="<?php echo $rows_rider['earning'];?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date and time</label>
                          <div class="col-sm-9">
                            <input type="text" name="date" class="form-control" value="<?php echo $rows_rider['date'];?>, <?php echo $rows_rider['time'];?>" readonly/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button name="update" type="submit" class="btn btn-outline-danger mr-2">Update</button>
                          </div>
                    <?php } while ($rows_rider = $result_rider->fetch_array());}?> 
                  </form>
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
              </div>
            </div>
          </div>
         </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer" style="background-color: #f7ede2;">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?>. Zaiwani Holdings Sdn Bhd. All rights reserved.</span>
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
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/file-upload.js"></script>
  <script src="../js/typeahead.js"></script>
  <script src="../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
