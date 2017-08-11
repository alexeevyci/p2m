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

 	// filters accordion
 	if ($(".filters_accordion").length) {
	 	$(".filters_accordion").accordion({
		  	collapsible: true, 
		  	active: false,
		  	heightStyle: "content",
		  	icons: false 
		});
	 }

 	 
});
