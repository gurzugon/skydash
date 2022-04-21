 <!-- SQL tag insert vendor -->
 <?php
 include 'config.php';
  if(isset($_POST['add']))
  {
	
	$sql_add = 	"INSERT INTO vendor (vendor_name, owner_name, vendor_add, ssm_no) VALUES ('".$_POST['vendor_name']."','".$_POST['owner_name']."', '".$_POST['vendor_add']."', '".$_POST['ssm_no']."')";
	if($result_add = mysqli_query($conn, $sql_add))	
			{		
						echo  ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Succesfully Add');
						window.location='list_vendor';
						</SCRIPT>");
					}
						else
						{
							echo "FAILED";
						}								
  }				
  ?>
  <!-- End SQL tag insert vendor -->