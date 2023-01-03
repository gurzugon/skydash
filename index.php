<?php
include 'config.php';
session_start();

if(isset($_POST['submit']))
{

  //Getting Post Values
  $userID= $_POST['userID'];
	$phone = $_POST['phone'];

	//Prevent SQL Injection
  $userID = stripslashes($userID);
	$phone = stripslashes($phone);

	//Prevent SQL Injection	
  $userID = mysqli_real_escape_string($conn, $userID);
	$phone = mysqli_real_escape_string($conn, $phone);

	$sql_login = "SELECT * FROM user WHERE userID = '$userID' AND phone =
	'$phone'";
	if($result_login = mysqli_query($conn, $sql_login))
	{
		$rows_login = $result_login->fetch_array();
		if($total_login = $result_login->num_rows)
		{
			$_SESSION['userID'] = $rows_login['userID'];
			header('Location:main.php');
			
		}
				else
					{
						echo "<script language=javascript>alert('Invalid ID or Phone Number!');
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
  <meta name="viewport" content="user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  
  <title>Rider Schedule</title>
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
  <link rel="shortcut icon" href="images/icon.png" />
  <script type = "text/javascript" >
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
  </script>
</head>

<body>
  <div class="container-scroller sidebar-dark">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: #28343c;">
              <div class="brand-logo">
                <img src="images/logo.png" alt="logo">
              </div>
              <h4 style="color: aliceblue;">Hello! let's get started</h4>
              <h6 class="font-weight-light" style="color: #ffff;">Insert phone number.</h6>
              <form class="pt-3" role="login" method="post">
              <div class="form-group">
                  <input style="color: #fff;" type="text" name="userID" class="form-control form-control-lg" placeholder="Rider ID" required>
                </div>
                <div class="form-group">
                  <input style="color: #fff;" type="text" name="phone" class="form-control form-control-lg" placeholder="Phone No." required>
                </div>
                <div class="mt-3">
                  <button style="background-color: #db2b30; border-color: #db2b30;" type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
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
