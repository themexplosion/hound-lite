(function () {
	"use strict";

	// Click the 'Copy shortcode' button to copy a shortcode.
	const clickToCopyButton = document.getElementById('hound-copy-shortcode');
	clickToCopyButton && clickToCopyButton.addEventListener('click', copyToClipboard);

	//Function to select and copy the value from the input field to clipboard.
	function copyToClipboard(e) {
		e.preventDefault();

		let inputFieldValue = document.getElementById("hound-shortcode");

		// Select the text field.
		inputFieldValue.select();
		inputFieldValue.setSelectionRange(0, 99999);// For mobile devices

		// Copy the text inside the text field.
		navigator.clipboard.writeText(inputFieldValue.value);
		clickToCopyButton.classList.add('hound-copy-shortcode-success');
		clickToCopyButton.innerText = "Successfully copied";
	}
})();
