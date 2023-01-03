<?php
include ('config.php');

session_start();
session_destroy();
unset($_SESSION['userID']);
echo "<SCRIPT LANGUAGE='JavaScript'>
window.alert('Press back for home!');
window.location='index';
</SCRIPT>";
?>