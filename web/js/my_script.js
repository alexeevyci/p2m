// var el = document.querySelector('input.choosed_color');
// var picker = new CP(el);
// picker.on("change", function(color) {
//     $(el).css('background-color', '#'+color);
//     el.value('#'+color);
// });

$(document).ready(function() {
 	// vars
 	var chooseColorOptions = $('select#chooseColor option');


	chooseColorOptions.each(function() {
		var tempColor = $(this).attr('value');
		$(this).prepend('<div class="square_color" style="background-color:#'+tempColor+'; width:5px; height:5px"></div>');
	})
});
