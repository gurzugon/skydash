<?php
include 'config.php';
session_start();

if(isset($_POST['submit']))
{
	$sql_login = "SELECT * FROM user WHERE email =
	'".$_POST['email']."' AND password ='".$_POST['password']."'";
	if($result_login = mysqli_query($conn, $sql_login))
	{
		$rows_login = $result_login->fetch_array();
		if($total_login = $result_login->num_rows)
		{
			$_SESSION['user_id'] = $rows_login['user_id'];
			header('Location:main');
			
		}
				else
					{
						echo "<script language=javascript>alert('Invalid Email or Password!');
						window.location='index';</script>";
					}
	}
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
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/Zaiwani_logo2.png" />
</head>

<body>
  <div class="container-scroller sidebar-dark">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: #232227;">
              <div class="brand-logo">
                <img src="../../images/Zaiwani_logo.png" alt="logo">
              </div>
              <h4 style="color: aliceblue;">Hello! let's get started</h4>
              <h6 class="font-weight-light" style="color: #ffff;">Sign in to continue.</h6>
              <form class="pt-3" role="login" method="post">
                <div class="form-group">
                  <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
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
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
