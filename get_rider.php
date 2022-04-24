<?php
include "config.php";

     $sql = "SELECT * FROM rider WHERE rider_id = '".$_GET['rider_id']."'";
     if ($result_edit = mysqli_query($conn, $sql))
         {
             $rows_edit = $result_edit->fetch_array();
             $total_edit = $result_edit->num_rows;
             $num_edit = 0;
         }	
?>