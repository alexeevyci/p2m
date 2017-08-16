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


	// search
	$('.input_search').keypress(function (e) {
	 	var key = e.which;
	 	if(key == 13) { // the enter key code
		    $(this).siblings('.search_span').click();
	  	}
	});   
	$('.search_span').on('click', function() {
		var searchText = $(this).siblings('.input_search').val();
		if (searchText) {
			window.location = createSearchLink(searchText);
		}
	});

 	 
});

function createSearchLink(searchText) {
	var parameters = {'search': searchText};
	var querystring = encodeQueryData(parameters);
	return search_url + '?' + querystring;
}

function encodeQueryData(data) {
   let ret = [];
   for (let d in data)
     ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
   return ret.join('&');
}
