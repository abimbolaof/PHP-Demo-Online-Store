/**
 * 
 */
function ajaxSendCartData(i, s, q, ref) {
	var xhttp, pId, size, quantity;
    
	if (window.XMLHttpRequest) {
		xhttp = new XMLHttpRequest();
	} else {
		xhttp = new ActieXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("POST", "addcart.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4) {
            if ( this.status == 200){
                document.getElementById("cart-icon-span").innerHTML = this.responseText;
            }else{
                //handle error
            }
            ref.setAttribute("enabled", "true");
            ref.style.cursor = "pointer";
		}
	}    
    
    if (typeof s == 'undefined'){
        size = "0";
    }
    
    if (typeof q == 'undefined'){
        quantity = "1";
    }
    
    pId = encodeURIComponent(i);
    size = encodeURIComponent(s);
    quantity = encodeURIComponent(q);
    
	xhttp.send("itemid=" + pId + "&size=" + size + "&qty=" + quantity);
}