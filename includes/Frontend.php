<?php
namespace Hound\includes;

class Frontend {
	public function __construct() {
		add_shortcode( 'themexplosion_hound', array( $this, 'search_shortcode' ) );
	}

	public function search_shortcode() {
		require_once HOUND_DIR . 'includes/frontend/views/hound-search-form.php';
	}
}
