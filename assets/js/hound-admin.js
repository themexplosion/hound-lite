(function ($) {
	"use strict";

	$(document).ready(function() {
		$('#hound-copy-shortcode').on('click', function(e) {
			e.preventDefault();
			var copyText = $('#hound-shortcode');
			copyText.select();
			document.execCommand("copy");
			var button = $(this);
			button.text('Successfully copied');
			button.css('background-color', 'green').css('border-color', 'green');

			setTimeout(function() {
				button.text('Copy Shortcode');
				button.css('background-color', '').css('border-color','');
				copyText.blur();
			}, 5000);
		});
	});
})(jQuery);