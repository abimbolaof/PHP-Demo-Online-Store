<?php 
include 'session_config.php';
require_once 'cartobject.php';

if (isset($_GET['id'])){
    //$_SESSION['cartitems'][] = $_POST['cartitem'];
    $cId = $_GET['id'];
    
    if (isset($_SESSION['cartitems'])){
        if (isset($_SESSION['cartitems'][$cId])){
            unset($_SESSION['cartitems'][$cId]);
        }
    }
    
    header("Location: viewcart.php");
    exit();
}

 ?>