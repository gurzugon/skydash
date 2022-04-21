<?php
include ('config.php');

	$sql_delete= "DELETE FROM rider WHERE rider_id = '".$_GET['rider_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('Deleted!');
		window.location='list_rider';</script>";
	}
	else
	{
		echo "FAILED";
	}
?>