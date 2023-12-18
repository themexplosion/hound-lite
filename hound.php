<?php
/*
Plugin Name:       Hound - AJAX Search Lite
Plugin URI:        https://themexplosion.com/hound/
Description:       Best live search engine for WordPress. Search as you keep typing your keywords. This plugin will take your searching experience to the next level.
Version:           1.0.1
Author:            Arafat Jamil
Author URI:        https://github.com/arafatjamil01
License:           GPL v2 or later
Text Domain:       hound
Domain Path:       /languages/
*/

namespace Hound;

defined( 'ABSPATH' ) || exit;

// Automatically load all the classes
require_once __DIR__ . '/autoload.php';

/**
 * Main Plugin Class
 */
final class Hound {
	const VERSION = '1.0.0';

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->define_constants();

		load_plugin_textdomain( 'hound', false, HOUND_DIR . '/languages' );

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'load_plugin_views' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_assets' ), 20 );
	}

	/**
	 * Define Plugin Constants
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'HOUND_VERSION', self::VERSION );
		define( 'HOUND_FILE', __FILE__ );
		define( 'HOUND_DIR', __DIR__ . '/' );
		define( 'HOUND_URL', plugins_url( '/', HOUND_FILE ) );
		define( 'HOUND_ASSETS', plugins_url( 'assets/', HOUND_FILE ) );
	}

	/**
	 *  Initializing Hound class
	 *
	 * @return \Hound
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}
	}

	/**
	 * Actions on plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		$installed = get_option( 'hound_installed' );

		if ( ! $installed ) {
			update_option( 'hound_installed', time() );
		}

		update_option( 'hound_version', HOUND_VERSION );
	}

	/**
	 * Load Frontend, Backend views
	 *
	 * @return void
	 */
	public function load_plugin_views() {
		new \Hound\includes\Admin();
		new \Hound\includes\Frontend();

		new \Hound\includes\AJAX_Handler();
	}

	/**
	 * Load Admin Side styles and scripts.
	 *
	 * @return void
	 */
	public function load_admin_assets( $hook ) {

		if ( 'toplevel_page_hound' === $hook || 'hound-search_page_hound-settings' === $hook ) {

			// Stylesheets.
			wp_enqueue_style( 'hound-admin', HOUND_ASSETS . 'css/hound-admin.css', array(), HOUND_VERSION );

			// Scripts.
			wp_enqueue_script( 'hound-admin', HOUND_ASSETS . 'js/hound-admin.js', array(), HOUND_VERSION, true );
		}
	}

	/**
	 * Load Frontend css files and scripts.
	 *
	 * @return void
	 */
	public function load_frontend_assets() {
		// Stylesheets.
		wp_enqueue_style( 'hound-search', HOUND_ASSETS . 'css/hound-frontend.css', array(), HOUND_VERSION );

		// Scripts.
		wp_enqueue_script(
			'hound-search',
			HOUND_ASSETS . 'js/hound-search.js',
			array(
				'wp-i18n',
				'jquery',
			),
			HOUND_VERSION,
			true
		);
		wp_localize_script(
			'hound-search',
			'hound_search_params',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'action'  => 'hound_ajax_search',
				'nonce'   => wp_create_nonce( '_hound_search' ),
			)
		);
	}
}

Hound::init();
