<?
$date = "3rd October 2012";
$title="ShadowSlide";

$content = '

<p>
I initially had a slideshow of images on the homepage of this website but, having put it up, it seemed a bit self-indulgent
to have a scrolling view of images of my face. </p>

<p>I took the slideshow down in the end, but decided to stick the code for it on Github anyway since it used some nice (but simple) CSS
to produce a kind of internal-shadow effect as shown below. Note that the effect is more heavily applied here for demonstration.</p>

<p>The repo for it is available <a href="https://github.com/flyingsparx/ShadowSlide" target="_blank">here</a>.

	<div id="slideshow">
            <div class="slide">
                <div class="carousel">
                    <img src="../media/slideshow/image1.jpg" alt="image 1" />
                    <img src="../media/slideshow/image2.jpg" alt="image 2" />
                    <img src="../media/slideshow/image3.jpg" alt="image 3" />
                </div>
	     </div>
        </div>
        


<script type="text/javascript">
var slidePos = 0;
var numSlides = $("#slideshow .slide .carousel img").length;
var requiredWidth = numSlides * 500;
$("#slideshow .slide .carousel").css("width", requiredWidth);

function changeSlide() {    
    slidePos -= 500;
    if((slidePos * -1) == requiredWidth){
        slidePos = 0;
    }
    $("#slideshow .slide .carousel").animate({
        left: slidePos
    }, 1000, "easeOutQuint", function(){});
}

$(document).ready(function() {
	$("head").append(\'<link type="text/css" href="http://www.willwebberley.net/includes/css/shadow-slide.css" rel="stylesheet"/>\');
    	$(".active").css("opacity", "1.0");
        slideshowTimer = setInterval("changeSlide()", 6000);
});
</script>
';
?>