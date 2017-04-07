<?php
require_once('resources/db/db_connect.php');

$select_db_query = "SELECT id, imageurls, price, name FROM Product";

if (isset($_GET['id'])){
    $select_db_query = "SELECT * FROM Product WHERE id=" . $conn->real_escape_string($_GET['id']) . ";";
}


header("Content-Type: application/json");

try{    
    $result = $conn->query($select_db_query);
    $encode = array();
    
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
             
            $row["imageurls"] = explode(",", $row["imageurls"]);
            $encode[] = $row;
        }        
        
        echo json_encode($encode);
    }
    else{
        $fail = array('ifa_error' => 'empty');
        //$fail[] = array("msg" => $select_db_query);
        echo json_encode($fail, JSON_FORCE_OBJECT);
    }
}catch(Exception $e){
    $err = array('ifa_error' => $conn_error);
    echo json_encode($err, JSON_FORCE_OBJECT);
}finally{
    $conn->close();
}

?>