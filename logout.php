<?php
include ('config.php');

session_start();
session_destroy();
unset($_SESSION['user_id']);
echo "<SCRIPT LANGUAGE='JavaScript'>
window.alert('Logout!');
window.location='index';
</SCRIPT>";
?>