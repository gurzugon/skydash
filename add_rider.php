 <!-- SQL tag insert rider -->
 <?php
 include 'config.php';
  if(isset($_POST['add']))
  {
	
	$sql_add = 	"INSERT INTO rider (rider_name, address, phone_no, status) VALUES ('".$_POST['name']."','".$_POST['address']."', '".$_POST['phone_no']."', '".$_POST['status']."')";
	if($result_add = mysqli_query($conn, $sql_add))	
			{		
						echo  ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Succesfully Add');
						window.location='list_rider';
						</SCRIPT>");
					}
						else
						{
							echo "FAILED";
						}								
  }				
  ?>
  <!-- End SQL tag insert rider -->