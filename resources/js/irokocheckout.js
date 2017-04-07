//Olusegun Abimbola, Copyright 2017

var orderData = {
    data : null,
    orderTotal : 0.0,
    orderDataItemCount : 0,
    items : [],
    shipping_info : {}
};

var email;

(function loadCartData(){
    var url = "getcart.php";

    $.getJSON(url, function(data){
        if (data){
            if (!data.ifa_error){
                orderData.data = data;
                generateOrder();
            }
        }
    });
})();


function generateOrder(){
    $.each(orderData.data, function(i, item){
        orderData.items.push({
            sku : item.pId,
            quantity : item.qty,
            price : item.item_data.price,
            name : item.item_data.name,
            currency : "USD"            
        });
        
        orderData.data[i].orderItemPrice = parseFloat(item.qty) * parseFloat(item.item_data.price);
        orderData.orderTotal += orderData.data[i].orderItemPrice;
        orderData.orderDataItemCount += parseInt(item.qty);
    });
}

function getOrderSummary(data){
    console.log(data);
    var summ = "";
    var p, n, q, t, ot, c, i, e, s;
    //$("#payment-info-div div").html("Payment Successful.");
    i = data.id.split('-')[1]; //tran.invoice_number;
    
    s = data.payer.payer_info.shipping_address;
    
    $.each(data.transactions, function(index, tran){
        
        ot = tran.amount.total;
        c = tran.amount.currency;
        email = tran.custom;
        
        summ += '<div style="width:100%;text-align:center;"><h4>Invoice number: ' + i + '</h4><br/><table><thead>';
        summ += "<tr><th>Name</th><th>Price</th><th>Qty</th><th>Total</th></thead></tr>";
        
        $.each(tran.item_list.items, function(i, item){
            q = item.quantity;
            n = item.name;
            p = item.price;
            t = p * q;
            summ += "<tr><td>" + n + "</td><td>$" + p + "</td><td>" + q + "</td><td>$" + t + "</td></tr>";
        });
        summ += '<tr><td colspan="2"></td><td>Total:</td><td>$' + ot + ' ' + c + '</td></tr>';
        summ += "</table><br/>";
        
        if (s){
            summ +=  "<h4>Shipping Address</h4><br/>" + (s.line1 ? s.line1 : "") + ", " + (s.line2 ? s.line2 : "") + ", " + s.city + ", " + s.state + ", " + s.postal_code + ", " + s.country_code + "<br/>" + (s.phone ? ("Phone: " + s.phone) : "");
        }
        summ += "<br/><br/>";        
        summ += "</div>";
    });
    
    return summ;
}


paypal.Button.render({
    
        env: 'sandbox', // Specify 'production' for the live environment
    
        client: {
            sandbox: 'Ac1wXPBTAI7wlIU7w-IpwzBUW788z-HaAE_pR8nrXPEU6F-au1kTlZoy_iD60CBgQNZWzfiIqluloBrO'
        },

        payment: function() {
            
            // Set up the payment here, when the buyer clicks on the button
            var env    = this.props.env;
            var client = this.props.client;
            email = $('input[name="email"]').val();
            
            return paypal.rest.payment.create(env, client, {
                intent : "sale",
                payer : {
                    payment_method : "paypal"
                },
                transactions : [
                {
                    amount: { 
                        total: orderData.orderTotal,
                        currency: "USD"
                    },
                    description: "SonOfIroko Store purchase",
                    custom: email,
                    payment_options: {
                        allowed_payment_method: "INSTANT_FUNDING_SOURCE"
                    },
                    item_list : {
                        items : orderData.items
                    }
                }],
                redirect_urls: {
                    return_url: "http://store.sonofiroko.com",
                    cancel_url: "http://store.sonofiroko.com/viewcart.php"
                }
            });
            
        },
        commit: true, // Optional: show a 'Pay Now' button in the checkout flow
    
        onAuthorize: function(data, actions) {
            // Execute the payment here, when the buyer approves the transaction
            return actions.payment.execute().then(function() {
                // Show a success page to the buyer
                $("#cust-info-div").toggleClass("disappear");
                $("#payment-info-div").toggleClass("disappear");
                
                actions.payment.get().then(function(data){
                    var summDat = getOrderSummary(data);
                    
                    var summary = '<div style="width:100%;text-align:center;"><p>An email has been sent to your address: ' + email + '</p>';
                    summary += summDat;
                    summary += '</div><br/><br/>';
                    
                    
                    summDat = '<div style="width:100%;text-align:center;"><p style="font-size:large;font-weight:bold;font-family:cursive;color:darkgoldenrod;">Thank you for your purchase.</p><br/><p style="color:black;font-family:cursive;">We will let you know as soon as your order is shipped.</p><br/>' + summDat + "</div>";
                    
                    //clear shopping cart and send Order data to server
                    $.post("clearcart.php", function(d){
                        var obj = {
                            email : email,
                            summ : summDat,
                            data : JSON.stringify(data)
                        };
                        $.post("sendorderdata.php", obj, function(r){
                            
                            $("#payment-info-div div").html(summary);
                        });
                    });
                });
            });
       }
            ,
    }, '#paypal-checkout-button');