<?php 
require_once('resources/db/db_connect.php');
require_once 'cartobject.php';

include 'session_config.php';


$select_db_query = "";
$output = array();

header("Content-Type: application/json");

if (isset($_SESSION['cartitems'])){
    //generate SQL queries
    try{
        foreach ($_SESSION['cartitems'] as $cartId => $item){
            
            $select_db_query = "SELECT id, name, price, stock, imageurls FROM Product WHERE id=" . $item->getId() . ";";

            //get products 
            $result = $conn->query($select_db_query);

            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $row["imageurls"] = explode(",", $row["imageurls"]);
                
                $output[] = array('cId' => $cartId, 'pId' => $item->getId(), 'item_data' => $row, 'qty' => $item->getQty());
            }
        }
        echo json_encode($output);
    }
    catch(Exception $e){

    }finally{
        $conn->close();
    }
}else{
    $empty = [];
    echo json_encode($empty);
}

?>