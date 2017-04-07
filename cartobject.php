<?php 

class CartItem {
    private $pId;
    //private $customField;
    private $qty;
    private $size;
    
    function __construct($pId, $size, $qty){
        $this->pId = $pId;
        $this->size = $size;
        $this->qty = $qty;
    }
    
    function getId(){
        return $this->pId;
    }
    
    function getSize(){
        return $this->size;
    }
    
    function getQty(){
        return $this->qty;
    }
    
    function setQty($q){
        $this->qty = $q;
    }
}

 ?>