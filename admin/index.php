<?php
include '../config.php';

 if (isset($_POST['submit']))
	{
	//Getting Post Values
	$admin_name = $_POST['admin_name'];
	$admin_pass = $_POST['admin_pass'];

	//Prevent SQL Injection
	$admin_name = stripslashes($admin_name);
	$admin_pass = stripslashes($admin_pass);

	//Prevent SQL Injection	
	$admin_name = mysqli_real_escape_string($conn, $admin_name);
	$admin_pass = mysqli_real_escape_string($conn, $admin_pass);

	//login vendor query
	$sql_login = "SELECT * FROM admin WHERE admin_name =
	'$admin_name' AND admin_pass = '$admin_pass'";
	
	if($result_login = mysqli_query($conn, $sql_login))
	{
		$rows_login = $result_login->fetch_array();
		if($total_login = $result_login->num_rows)
		{
			$_SESSION['admin_id'] = $rows_login['admin_id'];
			header('Location:main');
		}
						else
						{
							echo "<script type='text/javascript'>
            			      	setTimeout(function() {
                			  	swal ( {
                 			  		title: 'Failed!',
                 			  		text: 'Please Try Again.',
                 			 		icon: 'warning',
            				 	}).then(function() {
                			 		window.location = 'index';
            				 	});
            				 	}, 1000);
         					 	</script>";
						}
					}
				
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
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/logo.png"/>
</head>

<body>
  <div class="container-scroller sidebar-dark">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-color: #db2b30; background-image: url('../images/bg1.png'); background-size: contain;">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: #232227; border-radius: 15px; box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 12px 40px 0 rgba(0, 0, 0, 0.19);">
              <div class="brand-logo">
                <center><img src="../images/logoVendor.png" style="width: 100%; border-radius: 10px;"></center>
              </div>
              <h4 style="color: aliceblue;">Rider Admin Dashboard</h4>
              <h6 class="font-weight-light" style="color: #ffff;">Sign in to continue.</h6>
              <form class="pt-3" role="login" method="post">
                <div class="form-group">
                  <input type="text" name="admin_name" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="admin_pass" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label style="color: #ffff;" class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
