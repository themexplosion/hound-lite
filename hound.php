<?php
/*
Plugin Name:       Hound - AJAX Search Lite
Plugin URI:        https://themexplosion.com/hound/
Description:       Best live search engine for WordPress. Search as you keep typing your keywords. This plugin will take your searching experience to the next level.
Version:           1.0.1
Author:            Arafat Jamil
Author URI:        https://github.com/arafatjamil01
License:           GPL v2 or later
Text Domain:       hound-lite
Domain Path:       /languages/
*/

namespace Hound;

use WP_REST_Response;

defined( 'ABSPATH' ) || exit;

// Automatically load all the classes.
require_once __DIR__ . '/autoload.php';

/**
 * Main Plugin Class
 */
final class Hound {
	const VERSION = '1.0.0';
	const SLUG    = 'hound-dashboard';
	const HANDLE  = 'hound-dashboard-script';

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->define_constants();

		add_action( 'init', array( $this, 'i18n' ) );

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'load_plugin_views' ) );

		add_action( 'admin_menu', array( $this, 'hound_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_assets' ), 20 );

		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Define Plugin Constants, for plugin wide usage.
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
	 * Load Text Domain
	 *
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'hound', false, HOUND_DIR . '/languages' );
	}

	/**
	 *  Initializing Hound class
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}
	}

	/**
	 * Hound main menu and sub menus.
	 *
	 * @return void
	 */
	public function hound_menu() {
		add_menu_page(
			__( 'Hound - AJAX Search Plugin', 'hound' ),
			__( 'Hound Search', 'hound' ),
			'manage_options',
			self::SLUG,
			array( $this, 'hound_dashboard_page' ),
			'dashicons-search',
			5
		);
	}

	/**
	 * Hound main menu page.
	 *
	 * @return void
	 */
	public function hound_dashboard_page() {
		?>
		<div id="hound-dashboard-root"></div>
		<?php
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
	 * @param string $page_suffix Page suffix for toplevel page.
	 * @return void
	 */
	public function load_admin_assets( $page_suffix ) {

		if ( 'toplevel_page_' . self::SLUG !== $page_suffix ) {
			return;
		}

		$dev_server = defined( 'WP_DEV_SERVER' ) ? WP_DEV_SERVER : '';

		// Load built assets from /assets.
		$js_path  = HOUND_DIR . 'assets/js/hound-dashboard.min.js';
		$css_path = HOUND_DIR . 'assets/css/hound-dashboard.min.css';

		if ( file_exists( $js_path ) ) {
			wp_enqueue_script(
				self::HANDLE,
				plugins_url( 'assets/js/hound-dashboard.min.js', __FILE__ ),
				array(),
				filemtime( $js_path ),
				true
			);
		}

		if ( file_exists( $css_path ) ) {
			wp_enqueue_style(
				'rwg-dashboard-css',
				plugins_url( 'assets/css/hound-dashboard.min.css', __FILE__ ),
				array(),
				filemtime( $css_path )
			);
		}

		wp_localize_script(
			self::HANDLE,
			'houndDom',
			array(
				'rootId'  => 'hound-dashboard-root',
				'restUrl' => esc_url_raw( rest_url( 'rwg/v1/' ) ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
				'user'    => wp_get_current_user()->user_login,
				'site'    => get_site_url(),
			)
		);
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

	/**
	 * Register REST API routes.
	 */
	public function register_rest_routes() {
		// register_rest_route();
	}
}

Hound::init();
