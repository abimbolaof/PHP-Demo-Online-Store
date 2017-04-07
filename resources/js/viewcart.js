    var url = "getcart.php";
    var cartData = [];
    var index = 0;
    var cartTotal = 0;
    $(document).ready(function(){   
        
        getShoppingCart();
        
    });
    
    function goback(){
        var obj = getUpdateQuery();
        
        if (obj){
            //save changes to items(qty modifications)
            $.post("update.php", obj, function(data){
                if (data){
                    if (data === "OK"){
                        //do something
                    }
                }
                window.location.replace("store.php");
            });
        }else
            window.location.replace("store.php");
        
    }
    
    function getShoppingCart(){
        try{
            $.getJSON(url, function(data){
                if (data){
                    if (!data.ifa_error){
                        cartData = data;
                        
                        var cartView = "<div class=\"container\">";
                        var pid = 0;
                        var imageUrls = [];
                        
                        //calculate subtotals of each item based on qty
                        calculateCartTotals();
                        
                        $.each(cartData, function(i, product){
                            pid = product.pId;
                            
                            if (product.item_data.imageurls != null)
                                imageUrls = product.item_data.imageurls;
                            
                            cartView +="<div class=\"row\">";
                            
                            cartView += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-4 col-cust-left\">";
                            cartView += "<img src=\"resources/products/images/" + imageUrls[0] + "\"/>"
                            cartView += "</div>";
                            
                            
                            cartView += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-6 col-cust-left\">";
                            cartView += "<a href=\"product.php?id=" + pid +"  \">" + product.item_data.name + "</a><br/><br/>" +
                                "<span>Qty: <input id=\"" + index + "\" class=\"qty-input\" type=\"number\" min=\"1\" value=\"" + product.qty + "\"/></span>";
                            cartView += "</div>";
                            
                            
                            cartView += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-6 col-cust-left\">";
                            cartView += "<div>$<label id=\"price-div-" + index + "\">" + formatPrice(cartData[index].cartItemPrice) + "</label></div>";
                            cartView += "</div>";
                            
                            cartView += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-6 col-cust-right\"><button id=\"r-" + index + "\" class=\"remove-cart-item-button\">X remove</button></div>"
                            cartView += "</div>";
                            cartView += "<hr/>";
                            
                            index++;
                        });
                        
                        cartView += "<div>Total: <span id=\"cart-total-td\">$" + formatPrice(cartTotal) + "</span></div>";
                        cartView += "</div>";
                        
                        //if cart has items
                        if (index > 0){
                            $("#cart-items-div").html(cartView);
                            var cont = $("#proceed-checkout-div").html();
                            $("#proceed-checkout-div").html(cont + '<button id="proceed-checkout-button">Proceed to checkout</button>');
                        }
                        else{//Shopping cart is empty
                            var h = "<h3>Shopping cart is empty</h3>";
                            $("#cart-items-div").html(h);
                        }
                        
                        
                        //check if value of Quantity changed
                        $(".qty-input").change(function(){
                            var elem = $(this);
                            var i = elem.attr("id");
                            var v = elem.val();
                            cartData[i].qty = (!v || (v < 1)) ? 1 : v;
                            elem.val(cartData[i].qty);
                            //alert(cartData[i].qty);
                            
                            calculateCartTotals();
                            //alert(cartData[i].cartItemPrice);
                            $("#price-div-" + i).text(formatPrice(cartData[i].cartItemPrice));
                            $("#cart-total-td").html("$" + formatPrice(cartTotal));
                        });
                        
                        //remove item from cart
                        $(".remove-cart-item-button").click(function(evt){
                            var rId = $(this).attr("id").split("-")[1];
                            
                            cartData[rId].qty = 0;
                            calculateCartTotals();
                            //save changes to items(qty modifications) before deleting, which reloads the page
                            var obj = getUpdateQuery();
                            
                            //update shopping cart session data
                            $.post("update.php", obj, function(data){
                                if (data){
                                    //remove item
                                    window.location.replace("removecartitem.php?id=" + cartData[rId].cId);
                                }
                            });                            
                        });
                        
                        //proceed to checkout
                        $("#proceed-checkout-button").click(function(){
                            //update shopping cart data and relocate page
                            var obj = getUpdateQuery();
                            
                            //save changes to items(qty modifications)
                            $.post("update.php", obj, function(data){
                                if (data){
                                    if (data === "OK"){
                                        window.location.replace("order.php");
                                    }
                                }
                            });
                        });
                        
                    }else{//Error loading  shopping cart
                        var h = "<h3>Error loading  shopping cart</h3>";
                        $("#cart-items-div").html(h);
                    }
                }else{//Could not retrieve shopping cart
                    var h = "<h3>Could not retrieve shopping cart</h3>";
                    $("#cart-items-div").html(h);
                }
            });
        }catch(e){
        }
    }
    
    
    function getUpdateQuery(){
        if (cartData.length < 1)
            return null;
        
        var obj = "update=";
        $.each(cartData, function(i, d){
            if (i>0)
                obj += ",";
            obj += d.cId + ":" + d.qty;
        });
        //add cart total amount to request
        //obj += "&count=" + cartData.itemCount;
        return obj;
    }
    
    function calculateCartTotals(){
        var item;
        cartTotal = 0;
        cartData.itemCount = 0;
        $.each(cartData, function(i, item){
            cartData[i].cartItemPrice = parseFloat(item.qty) * parseFloat(item.item_data.price);/*(item.qty *1.0) + 1.0; //*/
            cartTotal += cartData[i].cartItemPrice;
            cartData.itemCount += parseFloat(item.qty);
        });
    }
    