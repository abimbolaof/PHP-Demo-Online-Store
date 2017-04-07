<?php 

require_once 'cartobject.php';
include 'session_config.php';

if (isset($_POST['itemid']) && isset($_POST['size']) && isset($_POST['qty'])){
    $pId = $_POST['itemid'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];
    
    if (!isset($_SESSION['cartitems'])){
        
        $_SESSION['cartitems'] = array();
        //$_SESSION['cartsize'] = 0;
        
    }
    
    $cartId = $pId . '-' . count($_SESSION['cartitems']);
    
    $obj = new CartItem($pId, $size, $qty);
    $_SESSION['cartitems'][$cartId] = $obj;
    
    //$_SESSION['cartsize'] += $qty;
    
    /*if (!isset($_SESSION['cartitems'][$cartId])){
        $_SESSION['cartitems'][$cartId] = array();
    }
    
    $_SESSION['cartsize'] += $qty;
    $_SESSION['cartidindex'] = $_SESSION['cartsize'];
    
    
    $obj = new CartItem($pId, $custom, $qty);
    $_SESSION['cartitems'][$cartId][] = $obj;*/
    //echo var_dump($_SESSION['cartitems']);
    
    
    echo count($_SESSION['cartitems']);
}

 ?>