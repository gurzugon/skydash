<?php
$host = "localhost";
$username = "u971974946_rider";
$password = "Admin@112912**";
$db_name = "u971974946_rider";

//create connection
$conn = new mysqli($host, $username, $password, $db_name);

//check connection
if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
?>