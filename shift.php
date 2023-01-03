<?php
include('config.php');
session_start();

if(!$_SESSION['userID'])
{
	echo "<script language=javascript>alert('Session timeout!');
			window.location='index';</script>";
}

$sql_admin = "SELECT * FROM user WHERE userID = '".$_SESSION['userID']."'";
if($result_admin = mysqli_query($conn, $sql_admin))
{	
	$rows_admin = $result_admin->fetch_array();
}
?>

<html lang="en">
    <head>
        <!-- Required meta tags -->
  	<meta charset="utf-8">
  	<meta name="viewport" content= "width=device-width, user-scalable=no">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <!-- /CSS styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type = "text/javascript" >
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
    </head>

<body>
<?php
    
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = date("d/m/Y");
    $time = date('h:i:s A');

    if(isset($_POST['submit']))
                {   
                    //check database if the shift is already exist
	                $sql_u = "SELECT * FROM rider_shift WHERE shiftId = '".$_POST['shiftId']."' AND userID = '".$_SESSION['userID']."'";
	                $res_u = mysqli_query($conn, $sql_u);
                    if (mysqli_num_rows($res_u) > 0 ) 
                    {
	                
                        echo
                     "<script type='text/javascript'>
                                setTimeout(function() {
                                    swal({
                                        title: 'Failed!',
                                        text:  'Shift already applied!',
                                        icon:  'warning',
                                    }).then(function() {
                                        window.location = 'main';
                                    });
                                }, 1000);
                                </script>";
                    }
                    else
                    {
                        //insert into rider shift
                        $sql = "INSERT INTO rider_shift (userID, shiftId) VALUES ('".$_SESSION['userID']."', '".$_POST['shiftId']."')";
                    
                        if($result = mysqli_query($conn, $sql))
                        {
                            //update shift -1
                            $sql_update = "UPDATE shift SET available = available -1 WHERE shiftId = '".$_POST['shiftId']."'"; 
        
                            if($result_update = mysqli_query($conn, $sql_update))
                            {

                            echo 
                            "<script type='text/javascript'>
                                    setTimeout(function() {
                                    swal({
                                    title: 'Success!',
                                    text:  'Shift Recorded',
                                    icon:  'success'
                                }).then(function() {
                                    window.location = 'main';
                                });
                            }, 1000);
                            </script>";
                    }
                }
            }
        }
?>

</body>
</html>