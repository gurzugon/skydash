<?php
include ('config.php');

$rider_name = $_POST['rider_name'];
$date = $_POST['date'];

	$sql_search= "SELECT * FROM orderlist WHERE rider_name LIKE '%$rider_name%' AND date LIKE '%$date%'";
	$result = $conn->query($sql);

    if ($result->num_rows > 0){
    while($row = $result->fetch_assoc() ){
	echo $row["order_no"]."  ".$row["date"]."  ".$row["driver_fees"]."<br>";
    }
    } else {
	echo "No records";
    }

    $conn->close();

?>