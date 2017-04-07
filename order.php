<?php
/*©Copyright SonOfIroko (Segun Abimbola)*/
session_start();

require 'templates/header.php'; ?>
<div id="maincontent" style="background-color:white;">
    <form class="userform" id="orderform" action="Javascript:void(0)" method="POST">
                <div id="cust-info-div">
                    <h4 style="font-family:cursive;color:black;">Personal info</h4><br/>
                    <label>*E-mail</label><br/>
                    <input id="email-field" type="text" name="email" placeholder="email"/><br/><br/>
                    <label>Social ID (e.g @customerXYZ)</label><br/>
                    <input type="text" name="social" placeholder="social ID"/><br/><br/>
                    <div id="payment-button-div">
                        <div id="paypal-checkout-button">
                            <!--<div id="wait-img-div">
                                <img src="resources/images/wait.gif"/>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div id="payment-info-div" class="disappear">
                    <h4 style="font-family:cursive;color:black;">Order Completed.</h4><br/>
                    <div style="color:black;display:inline-block;">
                        <div id="wait-img-div">
                            <img src="resources/images/wait.gif"/>
                        </div>
                    </div><br/>
                    <button id="back-store-button" onclick="goback()">Back to Store</button>
                </div>
    </form>
</div>
<script src="resources/js/validate.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="resources/js/irokocheckout.js"></script>
<script>
    function goback(){
        window.location.replace("store.php");
    }

</script>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>