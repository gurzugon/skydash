<?php
$host = "localhost";
$username = "id17993851_invoice01";
$password = "O1xNb3NlQ7Jgk|WV";
$db_name = "id17993851_invoice";

//create connection
$conn = new mysqli($host, $username, $password, $db_name);

//check connection
if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
?>