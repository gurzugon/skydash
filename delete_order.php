<?php
include ('config.php');

	$sql_delete= "DELETE FROM orderlist WHERE order_id = '".$_GET['order_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('Deleted!');
		window.location='order';</script>";
	}
	else
	{
		echo "FAILED";
	}
?>