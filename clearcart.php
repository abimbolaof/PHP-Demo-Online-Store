<?php 
include 'session_config.php';

if (isset($_SESSION['cartitems'])){
    
    unset($_SESSION['cartitems']);
    
    if (isset($_SESSION['cartsize'])){
        unset($_SESSION['cartsize']);
    }
    
    header("Location: viewcart.php");
    exit();
}

 ?>