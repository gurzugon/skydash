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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/icon.png" />
  <!-- script -->
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</head>

<body>
  <div class="container-scroller">
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">        
        <div class="content-wrapper" style="background-color: #db2b30; background-image: url('../images/bg1.png'); background-size: contain;">
                <div class="row">
                  <div class="col-md-12 grid-margin">
                  <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <h3 class="font-weight-bold" style="color: #fff;">Rider Dashboard</h3>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row" style="float: right;">
                    <a href="logout?admin_id=<?php echo $rows_admin ['admin_id'];?>" style="float: right;">
                      <button name="Logout" type="button" class="btn btn-outline-dark btn-rounded btn-icon">
                        <i class="ti-share" style="width: 100;"></i>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
                  </div>
                </div>

                <!--- Count vendor -->
                <?php
                $sql = "SELECT COUNT(*) o FROM user";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_assoc($result);
                ?>    
                <!--- End count vendor -->
               
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body" style="background-color:#f7ede2; border-radius: 15px;">
                      <h4 class="card-title">Rider Details</h4>
                      <p class="card-title">Total Rider : <?php echo $rows ['o'];?></p>
                      <div class="input-group">
                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                          <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                          </span>
                        </div>

                        <!-- SQL Tag call rider -->
                        <?php
                        $sql = "SELECT * FROM user";
                                if ($result_rider = mysqli_query($conn, $sql))
                                    {
                                        $rows_rider= $result_rider->fetch_array();
                                        $total_rider = $result_rider->num_rows;
                                        $num_rider = 0;
                                    }	
                        ?>
                        <!-- End SQL Tag call rider -->

                        <input type="text" class="form-control" onkeyup="myFunction()" id="Search" placeholder="Search Vendor" aria-label="search" aria-describedby="search">
                      </div><br>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>
                                No.
                              </th>
                              <th>
                                Rider Name
                              </th>
                              <th>
                                Email
                              </th>
                              <th>
                               Phone No.
                              </th>
                              <th>
                                Earning
                              </th>
                              <th>
                                Date
                              </th>
                              <th>
                                Time
                              </th>
                             </tr>
                          </thead>
                          <tbody>
                          <?php if($total_rider>0) {do { ?>
                            <tr class="target">
                              <td>
                              <?php echo ++$num_rider;?>
                              </td>
                              <td class="py-1">
                              <?php echo $rows_rider['name'];?>
                              </td>
                              <td>
                              <?php echo $rows_rider['email'];?>
                              </td>
                              <td>
                              <?php echo $rows_rider['phone'];?>
                              </td>
                              <td>
                              <?php echo $rows_rider['earning'];?>
                              </td>
                              <td>
                              <?php echo $rows_rider['date'];?>
                              </td>
                              <td>
                              <?php echo $rows_rider['time'];?>
                              </td>
                              <td>
                                <a href="details?userId=<?php echo $rows_rider['userID'];?>">
                                <button title="Edit" type="button" class="btn btn-primary btn-rounded btn-icon" onclick="openForm2()">
                                    <i class="ti-write"></i>
                                </button>
                                </a>
                                
                            </td>
                            </tr>
                            <tr>
                                <?php } while ($rows_rider = $result_rider->fetch_array());} else {?>
	                        <tr>
		                    <td colspan=7 align="center">No Record!</td>
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
   
  <!-- Search Function-->
  <script>
  function myFunction() {
    var input = document.getElementById("Search");
    var filter = input.value.toLowerCase();
    var nodes = document.getElementsByClassName('target');
  
    for (i = 0; i < nodes.length; i++) {
      if (nodes[i].innerText.toLowerCase().includes(filter)) {
        nodes[i].style.display = "block";
      } else {
        nodes[i].style.display = "none";
      }
    }
  }
</script>
  <!-- End Search Function-->
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
