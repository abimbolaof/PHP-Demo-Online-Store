<?php require 'templates/header.php'; ?>
<div id="maincontent" style="background-color:white;color:black;font-family:verdana;">
    <div id="main-product-div">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="thumbnail">
                        <img id="main-product-img" src=""/><br/>
                        <div class="h-divider"></div>
                        <div style="text-align:center;padding:0;margin:0;">
                            <ul id="product-img-thumb-ul">
                                <!-- <li><img onclick="setMainImg(this)" class="product-img-thumb" src=""/></li>
                                <li><img class="product-img-thumb" src=""/></li>
                                <li><img class="product-img-thumb" src=""/></li>
                                <li><img class="product-img-thumb" src=""/></li>-->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-cust-left">
                    <div id="product-table-div" style="display:inline-block;">
                        <h4 id="main-product-name">-</h4>
                        <h4 style="font-size:small;color:darkgoldenrod;" id="main-product-manufacturer"></h4><br/>
                        <table>
                            <tr>
                                <td>Price:</td>
                                <td id="main-product-price">$-</td>
                            </tr>
                            <tr>
                                <td>Size:</td>
                                <td>
                                    <select id="main-product-size">
                                        <option>-</option>
                                        <!--<option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>-->
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Qty:</td>
                                <td><input id="main-product-qty" type="number" min="1" value="1"/></td>
                            </tr>
                        </table><br/>
                        <button id="main-product-add-cart" onclick="addToCart.call(this)" id="" class="magic-button">Add to Cart</button>
                        <label id="main-product-id" hidden></label>
                    </div>
                </div>
            </div><br/>
            <div style="text-align:left;">
            <h4 style="font-family:verdana;letter-spacing:1.5px;">Description</h4>
            <div class="h-divider"></div>
            <p style="font-family:verdana;letter-spacing:1.5px;" id="main-product-desc"></p>
        </div>
        </div>
    </div>
</div>

<script src="resources/js/formatmoney.js"></script>
<script src="resources/js/store.js"></script>
<script>
    $(document).ready(function(){

        getItem();
    });
    
    function setMainImg() {
        var thumb_url = $(this).attr('src');
        //console.log(thumb_url);
        $('#main-product-img').attr('src', thumb_url);
    }
    
    function getItem(){
        var url = "getproducts.php";
        var id = window.location.href.split("=")[1];
        document.getElementById("main-product-id").innerHTML = id;
        var query = {
            id : id
        };
        var imageUrls = [];

        try{
            $.getJSON(url, query, function(data){
                if (data){
                    if (!data[0].ifa_error){
                        var product = data[0];
                        
                        if (product.imageurls != null){
                            var thumbs = "";
                            $.each(product.imageurls, function(i, item){
                                thumbs += "<li><img onclick=\"setMainImg.call(this)\" class=\"product-img-thumb\" src='resources/products/images/" + product.imageurls[i] + "'/></li>";
                            });
                            $('#product-img-thumb-ul').html(thumbs);
                        }
                        
                        if (product.sizes != null){
                            var sizes = "<option>-</option>";
                            $.each(product.sizes, function(i, item){
                                sizes += "<option>" + product.sizes[i] + "</option>";
                            });
                            $('#main-product-size').html(sizes);
                        }
                        
                        
                        
                        $('#main-product-img').attr('src', "resources/products/images/" + product.imageurls[0]);
                        $('#main-product-price').html('$' + formatPrice(Number(product.price)));
                        $('#main-product-name').html(product.name);
                        $('#main-product-manufacturer').html(product.manufacturer);
                        $('#main-product-desc').html(product.description);
                        //console.log(product);
                    }
                }
            });
        }catch(e){

        }
    }
</script>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>