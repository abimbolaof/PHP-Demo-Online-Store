<?php /*
session_start();
unset($_SESSION['cartitems']);*/
require 'templates/header.php'; ?>

<div id="maincontent" style="background-color:white;">
    <h2 style="color:darkgreen;">Your Shopping Cart</h2><br/>
    <div id="cart-items-div">
        <div id="wait-img-div">
            <img src="resources/images/wait.gif"/>
        </div>
    </div>
    <div id="proceed-checkout-div">
        <button id="back-store-button" onclick="goback()">Back to Store</button><br/>
    </div>
    
    
    
</div>
<!--END OF MAIN CONTENT-->

<!--©Copyright SonOfIroko (Segun Abimbola)-->
<script src="resources/js/formatmoney.js"></script>
<script src="resources/js/viewcart.js"></script>
    
<?php require 'templates/footer.php'; ?>