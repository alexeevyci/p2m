$(document).ready(function() {
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
});
