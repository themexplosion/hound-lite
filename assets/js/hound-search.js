(function ($) {

	jQuery( document ).ready(
		function ($) {

			// Handle the search form submission
			$( '#hound-search-input-field' ).keyup(
				function (e) {
					e.preventDefault(); // Prevent the form from submitting normally

					// Get the search query
					let searchQuery      = $( '#hound-search-input-field' ).val();
					let resultsContainer = $( '#hound-search-result' );

					if ( ! searchQuery.length > 0) {
						resultsContainer.empty();
						return;
					}
					// Send the Ajax request
					$.ajax(
						{
							url: hound_search_params.ajaxurl,
							type: 'POST',
							data: {
								action: hound_search_params.action,
								search_query: searchQuery,
								nonce: hound_search_params.nonce
							},
							success: function (response) {
								resultsContainer.empty(); // Clear previous results
								resultsContainer.html( response );
							},
							error: function (error) {
								console.log( error );
							}
						}
					);
				}
			);
		}
	);
})( jQuery );
