<?php
/*©Copyright SonOfIroko (Segun Abimbola)*/

session_start();


if (!isset($_POST['order-submit'])){
    
    //process/store order details and redirect
    http_response_code(302);
    header("Location: store.php");
}

require 'templates/header.php'; 

?>
<div id="maincontent">  
    
    <div>
        <h4>Cart Total</h4>
        <?php
        echo '$' . $_SESSION['carttotal'];
        
        /*echo '$' . $_SESSION['carttotal'];
        
        if (isset($_SESSION['cartitems']))
            unset($_SESSION['cartitems']);
        
        if (isset($_SESSION['cartsize']))
            unset($_SESSION['cartsize']);*/
        ?>
        <div id="payment-button-div">
            <div id="paypal-checkout-button"></div>
        </div>
    </div>
    
    
</div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    
    paypal.Button.render({
    
        env: 'production', // Specify 'sandbox' for the test environment

        payment: function() {
            // Set up the payment here, when the buyer clicks on the button
        },

        onAuthorize: function(data, actions) {
            // Execute the payment here, when the buyer approves the transaction
       }
            
    }, '#paypal-checkout-button');

</script>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>