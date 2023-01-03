<?php
include ('../config.php');

session_start();
session_destroy();
unset($_SESSION['admin_id']);
echo "<SCRIPT LANGUAGE='JavaScript'>
window.alert('Logout!');
window.location='index';
</SCRIPT>";
?>