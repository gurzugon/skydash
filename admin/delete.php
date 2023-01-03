<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/maqan.png" type="image/icon type">
    <title>Admin Business Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="//db.onlinewebfonts.com/c/3ff4d3b607da33fdf736f779bc636648?family=Hiruko" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800%7CWork+Sans:200,300%7CJosefin+Sans:100" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/uikit.min.js" defer></script>
    <script src="../js/uikit-icons.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<?php
include ('../config.php');

	$sql_delete= "DELETE FROM businessRegister WHERE businessId = '".$_GET['businessId']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script type='text/javascript'>
                                setTimeout(function() {
                                    swal({
                                        title: 'Success!',
                                        text: 'Business Deleted!',
                                        icon: 'success'
                                    }).then(function() {
                                        window.location = 'https://vendor.maqan.my/admin/';
                                    });
                                }, 1000);
                                </script>";
	}
	else
	{
        echo "<script type='text/javascript'>
                                setTimeout(function() {
                                    swal ( {
                                        title: 'Failed!',
                                        text: 'Unsuccessful. Please try again.',
                                        icon: 'warning',
                                }).then(function() {
                                        window.location = 'https://vendor.maqan.my/admin/';
                                });
                            }, 1000);
                            </script>";
	}
?>