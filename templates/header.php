<?php
error_reporting(0);
include 'session_config.php';
//unset($_SESSION['cartitems']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description"
	content="Olusegun Abimbola (Software Engineer)">
<meta name="keywords"
	content="software, java, segun, abimbola, yoruba, orisa, ife, tradition, medicine, ifa, audio, video, sango, oyo, java, html, css, javascript, computer, nigeria, usa">
<meta name="robots" content="index,follow,archive">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css"
	href="resources/css/stylesheetbig.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript"
	src="resources/js/mainscript.js"></script>
<script type="text/javascript"
	src="resources/js/irokocart.js"></script>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<title>SonOfIroko &trade;</title>
</head>


<body>
    
    <nav>
        <div class="container">
            <div style="text-align:center;">
                <!-- Main menu Icon -->
                <div id="title-div" style="display:inline-block;float:left;">
                    <a href="store.php"><h3 style="color:darkgoldenrod;text-transform:uppercase;font-family:Courier New;font-weight:bold;letter-spacing:1.5px;">
                    SonOfIroko Store
                    </h3></a>
                </div>
                <div style="display:inline-block;float:right;">
                    <a href="viewcart.php"><button class="btn btn-lg btn-primary-outline"><span class="glyphicon glyphicon-shopping-cart"></span><span id="cart-icon-span" unselectable="yes" onselectstart="return false" onmousedown="return false">
                                        <?php 
                                            $c = count($_SESSION['cartitems']);
                                            /*if (isset($_SESSION['cartsize'])){
                                                if ($_SESSION['cartsize'] > 0)
                                                    $c = $_SESSION['cartsize'];
                                            }*/
                                            echo $c;
                                        ?>
                    </span></button></a>
                </div>
            </div>
        </div>
    </nav>