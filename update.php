<?php
/*©Copyright SonOfIroko (Segun Abimbola)*/
require_once 'cartobject.php';
include 'session_config.php';

if (isset($_POST['update'])){
    
    $data = $_POST['update'];
    
    if (isset($_SESSION['cartitems'])){
        
        $exp = explode(",", $data);
        
        foreach($exp as $xp){
            $vals = explode(":", $xp);
            $cid = $vals[0];
            $qty = $vals[1];
            
            $_SESSION['cartitems'][$cid]->setQty($qty);
        }
        
        //$_SESSION['cartsize'] = $_POST['count'];
        
        echo "OK";
        exit();
    }
}
?>