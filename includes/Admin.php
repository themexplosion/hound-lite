<?php
namespace Hound\includes;

class Admin {
	public function __construct() {

		$this->load_csf();

		add_action( 'admin_menu', array( $this, 'hound_menu' ) );
	}

	/**
	 * Load Codestar Framework for options.
	 *
	 * @return void
	 */
	public function load_csf() {
		include_once plugin_dir_path( __FILE__ ) . 'admin/settings/codestar-framework/codestar-framework.php';
		include_once plugin_dir_path( __FILE__ ) . 'admin/settings/hound-settings.php';
	}

	/**
	 * Hound main menu and sub menus.
	 *
	 * @return void
	 */
	public function hound_menu() {
		$capability  = 'manage_options';
		$parent_slug = 'hound';

		add_menu_page( __( 'Hound - AJAX Search Plugin', 'hound' ), __( 'Hound Search', 'hound' ), $capability, $parent_slug, array( $this, 'hound_main_page' ), 'dashicons-search', 5 );
		add_submenu_page( $parent_slug, __( 'Hound Search', 'hound' ), __( 'Hound Search', 'hound' ), $capability, $parent_slug, array( $this, 'hound_main_page' ) );
	}

	/**
	 * Hound main menu page.
	 *
	 * @return void
	 */
	public function hound_main_page() {
		?>
			<div class="hound-welcome-panel">
				<div class="hound-panel-section-container bg-white">
					<section class="hound-welcome-heading">
						<div class="hound-welcome-title">
							<h1><?php esc_html_e( 'Hound - AJAX Search Plugin for WordPress', 'hound' ); ?></h1>
							<span><?php esc_html_e( 'Lite version', 'hound' ); ?></span>
						</div>

						<p class="hound-subtitle"><?php esc_html_e( 'The most powerful AJAX search engine for WordPress.', 'hound' ); ?></p>
					</section>

					<hr class="dashed-separator">

					<section class="hound-shortcode">
						<h3 class="text-2xl font-medium mb-2"><?php esc_html_e( 'Hound Shortcode', 'hound' ); ?></h3>

						<input type="text" value="<?php echo esc_attr( '[themexplosion_hound]' ); ?>" id="hound-shortcode">
						<button id="hound-copy-shortcode" class="hound-copy-shortcode-btn text-white">
							<?php esc_html_e( 'Copy Shortcode', 'hound' ); ?>
						</button>						
					</section>

					<hr class="dashed-separator">

					<section class="support-section">
						<ul>
							<li>
								<svg id="hound-documentation" fill="var(--hound-pink)" enable-background="new 0 0 512 512" height="25" viewBox="0 0 512 512" width="25" xmlns="http://www.w3.org/2000/svg"><path d="m433.798 106.268-96.423-91.222c-10.256-9.703-23.68-15.046-37.798-15.046h-183.577c-30.327 0-55 24.673-55 55v402c0 30.327 24.673 55 55 55h280c30.327 0 55-24.673 55-55v-310.778c0-15.049-6.27-29.612-17.202-39.954zm-29.137 13.732h-74.661c-2.757 0-5-2.243-5-5v-70.364zm-8.661 362h-280c-13.785 0-25-11.215-25-25v-402c0-13.785 11.215-25 25-25h179v85c0 19.299 15.701 35 35 35h91v307c0 13.785-11.215 25-25 25z"/><path d="m363 200h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m363 280h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m215.72 360h-72.72c-8.284 0-15 6.716-15 15s6.716 15 15 15h72.72c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></svg>
									<a href="https://docs.themexplosion.com/docs/hound-ajax-search-plugin/"><?php esc_html_e( 'Online Documentation', 'hound' ); ?></a>
							</li>
							<li>
								<svg id="hound-customer-support" fill="var(--hound-pink)" enable-background="new 0 0 64 64" height="25" viewBox="0 0 64 64" width="25" xmlns="http://www.w3.org/2000/svg"><g><path d="m54.963 19.44h-16.754v-11.951c0-1.949-.758-3.773-2.129-5.13-1.373-1.373-3.195-2.129-5.131-2.129h-23.04c-4.003 0-7.26 3.257-7.26 7.26v15.36c0 4.003 3.257 7.26 7.26 7.26h.42v4.26c0 1.402.837 2.647 2.131 3.171.417.168.85.25 1.279.25.896 0 1.769-.355 2.408-1.018l4.878-4.851v14.273c0 4.625 3.763 8.388 8.388 8.388h12.191l8.083 8.039c.727.75 1.702 1.149 2.699 1.149.476 0 .956-.091 1.416-.277 1.437-.581 2.364-1.965 2.364-3.523v-5.388h.796c4.625 0 8.388-3.763 8.388-8.388v-18.367c.001-4.625-3.762-8.388-8.387-8.388zm-35.931 8.245-7.021 6.981c-.122.127-.265.16-.426.093-.117-.047-.256-.153-.256-.39v-5.76c0-.829-.671-1.5-1.5-1.5h-1.92c-2.349 0-4.26-1.911-4.26-4.26v-15.36c0-2.349 1.911-4.26 4.26-4.26h23.04c1.134 0 2.203.444 3.015 1.256.803.795 1.245 1.862 1.245 3.004v11.951h-7.796c-2.236 0-4.341.874-5.928 2.46-1.552 1.552-2.416 3.602-2.453 5.785zm41.319 18.509c0 2.971-2.417 5.388-5.388 5.388h-2.296c-.828 0-1.5.672-1.5 1.5v6.888c0 .491-.343.684-.49.743-.143.057-.511.155-.854-.199l-8.541-8.495c-.281-.279-.661-.437-1.058-.437h-12.811c-2.971 0-5.388-2.417-5.388-5.388v-18.366c0-1.436.562-2.787 1.581-3.806 1.02-1.02 2.372-1.582 3.807-1.582h27.55c2.971 0 5.388 2.417 5.388 5.388z"/><path d="m31.902 34.822c-1.22 0-2.213.994-2.213 2.213s.994 2.213 2.213 2.213c1.221 0 2.215-.994 2.215-2.213s-.994-2.213-2.215-2.213z"/><path d="m41.187 34.822c-1.22 0-2.213.994-2.213 2.213s.994 2.213 2.213 2.213c1.221 0 2.215-.994 2.215-2.213s-.993-2.213-2.215-2.213z"/><path d="m50.473 34.822c-1.22 0-2.213.994-2.213 2.213s.994 2.213 2.213 2.213c1.221 0 2.215-.994 2.215-2.213s-.994-2.213-2.215-2.213z"/></g></svg>
									<a href="https://wordpress.org/support/plugin/hound-lite/"><?php esc_html_e( 'Get Support', 'hound' ); ?></a>
							</li>
						</ul>
					</section>
				</div>
			</div>
		<?php
	}
}
