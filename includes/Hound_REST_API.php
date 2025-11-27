<?php
namespace Hound\includes;

use WP_REST_Response;

class Hound_REST_API {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	private function check_api_permissions(){
		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_Error( 'rest_forbidden', __( 'You do not have permission to access this resource.', 'hound-lite' ), array( 'status' => 403 ) );
		}

		$nonce = isset( $_SERVER['HTTP_X_WP_NONCE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_WP_NONCE'] ) ) : '';
		if ( empty( $nonce ) && isset( $_GET['_wpnonce'] ) ) {
			$nonce = sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) );
		}

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			return new \WP_Error( 'rest_nonce_invalid', __( 'Nonce verification failed.', 'hound-lite' ), array( 'status' => 403 ) );
		}

		return true;
	}

	public function register_rest_routes() {
		register_rest_route(
			'hound/v1',
			'/search',
			array(
				'methods'  => 'GET',
				'callback' => array( $this, 'search_callback' ),
				'permission_callback' => array( $this, 'check_api_permissions' ),
			)
		);
	}

	public function search_callback( $request ) {
		return new WP_REST_Response( array( 'message' => 'Hello World!' ) );
	}
}
