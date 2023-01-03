<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Rider Admin</title>
    <link rel="shortcut icon" href="images/logo1.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="//db.onlinewebfonts.com/c/3ff4d3b607da33fdf736f779bc636648?family=Hiruko" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800%7CWork+Sans:200,300%7CJosefin+Sans:100" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/uikit.min.js" defer></script>
    <script src="js/uikit-icons.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <link href="http://fonts.cdnfonts.com/css/simply-rounded" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/bubbleboddy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css"/>
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <style type="text/css">
      @media only screen and (min-width: 620px) {
      .u-row {
      width: 600px !important;
      }
      .u-row .u-col {
      vertical-align: top;
      }
      .u-row .u-col-33p33 {
      width: 199.98px !important;
      }
      .u-row .u-col-50 {
      width: 300px !important;
      }
      .u-row .u-col-100 {
      width: 600px !important;
      }
      }

      @media (max-width: 620px) {
      .u-row-container {
      max-width: 100% !important;
      padding-left: 0px !important;
      padding-right: 0px !important;
      }
      .u-row .u-col {
      min-width: 320px !important;
      max-width: 100% !important;
      display: block !important;
      }
      .u-row {
      width: calc(100% - 40px) !important;
      }
      .u-col {
      width: 100% !important;
      }
      .u-col > div {
      margin: 0 auto;
      }
      }
      body {
      margin: 0;
      padding: 0;
      }

      table,
      tr,
      td {
        vertical-align: top;
        border-collapse: collapse;
      }

      p {
        margin: 0;
      }

      .ie-container table,
      .mso-container table {
      table-layout: fixed;
      }

    * {
      line-height: inherit;
      }

      a[x-apple-data-detectors='true'] {
      color: inherit !important;
      text-decoration: none !important;
      }

    table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: auto !important; } #u_content_image_2 .v-src-max-width { max-width: 75% !important; } #u_content_heading_1 .v-font-size { font-size: 20px !important; } #u_content_heading_3 .v-font-size { font-size: 30px !important; } #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 100% !important; } #u_content_heading_5 .v-container-padding-padding { padding: 150px 10px 0px !important; } #u_content_image_3 .v-container-padding-padding { padding: 50px 10px 80px !important; } #u_content_image_3 .v-src-width { width: auto !important; } #u_content_image_3 .v-src-max-width { max-width: 80% !important; } #u_column_6 .v-col-padding { padding: 0px 30px !important; } #u_content_image_5 .v-src-width { width: auto !important; } #u_content_image_5 .v-src-max-width { max-width: 30% !important; } #u_column_7 .v-col-padding { padding: 0px 30px !important; } #u_content_image_6 .v-src-width { width: auto !important; } #u_content_image_6 .v-src-max-width { max-width: 30% !important; } #u_column_8 .v-col-padding { padding: 0px 30px !important; } #u_content_image_4 .v-src-width { width: auto !important; } #u_content_image_4 .v-src-max-width { max-width: 30% !important; } #u_content_heading_11 .v-font-size { font-size: 20px !important; } }
    :root {
    color-scheme: light;
    supported-color-schemes: light;
  }
  </style>

</head>
 
<?php
                include '../config.php';

                if (isset($_POST['update']))
                {
                    date_default_timezone_set('Asia/Kuala_Lumpur');
                    $date = date("d/m/Y");
                    $time = date('h:i:s A');

                    $sql = "UPDATE user SET earning = '".$_POST[earning]."', date = '$date', time = '$time' WHERE userID = '".$_GET[userID]."'";

                    if($result = mysqli_query($conn, $sql))
                    {
                       echo "<script type='text/javascript'>
                                setTimeout(function() {
                                    swal({
                                        title: 'Updated',
                                        text: 'Earning Updated!',
                                        icon: 'success'
                                    }).then(function() {
                                        window.location = 'main';
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
                                        window.location = 'main';
                                    });
                                }, 1000);
                              </script>";
                    }
                }
?>