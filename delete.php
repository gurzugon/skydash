<?php
include ('config.php');

	$sql_delete= "DELETE FROM rider_shift WHERE RshiftId = '".$_GET['RshiftId']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
        if($result = mysqli_query($conn, $sql))
        {
            //update shift -1
            $sql_update = "UPDATE shift SET available = available +1 WHERE shiftId = '".$_POST['shiftId']."'"; 

            if($result_update = mysqli_query($conn, $sql_update))
            {
		echo "<script language=javascript>alert('Deleted!');
		window.location='main';</script>";
	}
	else
	{
		echo "FAILED";
	}
}
    }
?>