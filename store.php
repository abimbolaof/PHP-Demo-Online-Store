<?php require 'templates/header.php'; ?>

<div class="slideshow-container">
            <div class="mySlides s-fade">
                <div class="s-slide-div-1">
                    <div class="s-text">
                        <div>Premium Hand-made artifacts from <em class="magic-quote">solid</em> materials</div>
                        <div class="gold-line"></div><br/>
                        <div></div>
                    </div>
                </div>
            </div>
            
            <div class="mySlides s-fade">
                <div class="s-slide-div-2">
                    <div class="s-text">
                        <div>Carefully crafted to bring out the <em class="magic-quote">deity</em> in you.</div>
                        <div class="gold-line"></div><br/>
                        <div></div>
                    </div>
                </div>
            </div>

            <div class="mySlides s-fade">
                <div class="s-slide-div-3">
                    <div class="s-text">
                        <div>Bold and stylish...for the <em class="magic-quote">modern</em> man</div>
                        <div class="gold-line"></div><br/>
                        <div></div>
                    </div>
                </div>
            </div>
            <div id="home-down-arrow"><a onclick="scrollDown()" href="Javascript:void(0)">&#8671;</a></div>
</div>
<div style="background-color:white;">
        <div id="prods" class="product-list-div">
            <h3 style="margin:0 0 30px 0;text-align:center;color:black;text-transform:uppercase;font-family:cursive;color:darkgoldenrod;">Products</h3>
            <div>
                <div id="wait-img-div">
                    <img src="resources/images/wait.gif"/>
                </div>
            </div>
        </div>
    </div>


<!--<div class="store-back-image">
        <div>
            <h4 id="poetry-h4">Premium hand-made designs...<br/>Made by gods...for men</h4>
        </div>
    </div>-->
    

<script src="resources/js/formatmoney.js"></script>
<script src="resources/js/store.js"></script>
<script>
    
function scrollDown(){
    var off = $("#prods").offset().top - 25;
    $("html, body").animate({
            scrollTop : off
    }, 600);
}
    
    
//Slide Show
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 8000); // Change image every 2 seconds
}
</script>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>