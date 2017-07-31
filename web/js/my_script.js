$(document).ready(function() {

	// homepahe slider
 	 $('.last_product_carousel').slick({
 	 	infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: true,
		arrows: true,
		autoplay: true,
 		autoplaySpeed: 2000,
 		responsive: [
		    {
		      breakpoint: 710,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1
		      }
		    }
		    ,
		    {
		      breakpoint: 500,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
  		]
	});

 	// google recaptcha responsive
 	var reCaptchaWidth = 304;
 	var container = $('#grecaptcha_wrapper').width();
 	if(reCaptchaWidth > containerWidth) {
    	var captchaScale = containerWidth / reCaptchaWidth;
	    $('.g-recaptcha').css({
	      'transform':'scale('+captchaScale+')'
	    });
	}
});
