<?php
namespace Hound\includes;

class Frontend {
	public function __construct() {
		add_shortcode( 'themexplosion_hound', array( $this, 'search_shortcode' ) );
		add_shortcode( 'hound', array( $this, 'hound_shortcode' ) );
	}

	/**
	 * Frontend search form.
	 */
	public function search_shortcode() {

		$hound_settings = get_option( 'hound_options' );
		$placeholder    = $hound_settings['search_box_placeholder'] ?? __( 'Type your keyword...', 'hound' );

		$value = '';

		if ( isset( $_GET['_hound_search'] ) && isset( $_GET['phrase'] ) ) {
			$value = wp_verify_nonce( $_GET['_hound_search'], 'hound_search' ) ? $_GET['phrase'] : '';
		}

		// Search form view.
		require_once HOUND_DIR . 'includes/frontend/views/hound-search-form.php';

		return $form;
	}

	/**
	 * Frontend search form.
	 */
	public function hound_shortcode() {
		return '<div>Hi there</div>';
	}
}
