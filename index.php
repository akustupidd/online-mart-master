<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Mart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php
    include_once "pages/db/db_con.php";
        if(!isset($_SESSION)){
        session_start();
    }
?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
	
	<!--start block header -->
	
    <?php
               
                        include "Pages\Header\header2.php";
              
                
            ?>	
	<!--end block header -->
	   
    <?php
        if(isset($_GET['p'])){
            if($_GET['p']=='signup'){

            }else{
                require "pages/".$_GET['p'].".php";
            }
        }
        else if(isset($_GET['pp'])){
            require "pages/".$_GET['pp'].".php";
        }
        else{
            require "pages/homepage.php";
        }
    ?>
	<!--Start block other pages-->
	<!--End block other pages-->

	<!--start block Footer -->
    <?php
        if(isset($_GET['p'])){
            if($_GET['p']=='signup' || $_GET['p']=='login' ){

            }else{
                include_once "pages/footer/footer.php";
            }
        }else{
            include_once "pages/footer/footer.php";
        }
    ?>
	<!--end block Footer -->
		

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>