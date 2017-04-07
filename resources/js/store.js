var url = "getproducts.php";
    var start = 0, limit = 10, resultCount = 0;
    var query = {
        start : start,
        limit : limit
    };
    
    $(document).ready(function(){
        
        getProducts();
    });
    
    function getProducts(){
        try{
            $.getJSON(url, query, function(data){
                if (data){
                    if (!data.ifa_error){
                        resultCount = 0;
                        var html = "<ul>";
                        var pid = 0;
                        $.each(data, function(i, product){
                            pid = product.id;
                            
                            html += "<li><table><tr><td><a href=\"product.php?id=" + pid +"  \"><img src=\"resources/products/images/" + product.imageurls[0] + "\"/></a></td></tr><tr><td><div>" + product.name + "</div></td></tr><tr><td>$" + formatPrice(Number(product.price)) + "</td></tr></table></li>";
                            resultCount++;
                        });
                        html += "</ul>";
                        $(".product-list-div > div").html(html);
                        start = resultCount+1;
                    }
                }
            });
        }catch(e){
            
        }
    }
    
     //add item to cart
    function addToCart(){
        this.setAttribute("enabled", "false");
        this.style.cursor = "not-allowed";
        var pid = $('#main-product-id').html();
        var size = $('#main-product-size').val();
        var qty = $('#main-product-qty').val();
        console.log(pid + '-' + size + '-' + qty);
        ajaxSendCartData(pid, size, qty, this);
    }