<?php
include ('config.php');

	$sql_delete= "DELETE FROM vendor WHERE vendor_id = '".$_GET['vendor_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('Deleted!');
		window.location='list_vendor';</script>";
	}
	else
	{
		echo "FAILED";
	}
?>