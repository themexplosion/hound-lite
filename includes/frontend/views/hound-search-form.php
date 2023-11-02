<?php
defined( 'ABSPATH' ) || exit;

$hound_settings = get_option( 'hound_options' );
$placeholder    = $hound_settings['search_box_placeholder'] ?? __( 'Type your keyword...', 'hound' );

$value = '';
if ( isset( $_GET['_hound_search'] ) && isset( $_GET['phrase'] ) ) {
	$value = wp_verify_nonce( $_GET['_hound_search'], 'hound_search' ) ? $_GET['phrase'] : '';
}
?>

<div class="hound-search-form-wrapper text-center">
	<form role="search" action="#" class="hound-search-form hound-search-border flex" autocomplete="off"
			aria-label="Search form">
		<input aria-label="Search input" type="search" id="hound-search-input-field" class="hound-search-form-input"
				name="phrase" placeholder="<?php echo esc_attr( $placeholder ); ?>"
				value="<?php echo esc_attr( $value ); ?>" autocomplete="off">

		<?php wp_nonce_field( 'hound_search', '_hound_search' ); ?>

		<button class="hound-btn hound-submit-btn" type="submit">
			<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
				<path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/>
			</svg>
		</button>
	</form>

	<div id="hound-search-result"></div>
</div>
