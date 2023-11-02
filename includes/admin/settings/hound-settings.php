<?php
if ( class_exists( 'CSF' ) ) {

	$prefix = 'hound_options';

	// Create options.
	CSF::createOptions(
		$prefix,
		array(
			'menu_title'      => __( 'Settings', 'hound' ),
			'menu_slug'       => 'hound-settings',
			'menu_type'       => 'submenu',
			'menu_parent'     => 'hound',

			'framework_title' => __( 'Hound - AJAX Search Plugin <small>by Themexplosion</small>', 'hound' ),
			'framework_class' => 'hound-settings-panel',

			'footer_text'     => '',
			'theme'           => 'light',
		)
	);

	$hound_settings_path = __DIR__ . '/settings-parts/';

	// Required files for settings.
	require __DIR__ . '/settings-parts/common/get-post-types.php';
	require __DIR__ . '/settings-parts/common/get-categories.php';

	// Separated settings files.
	require $hound_settings_path . 'layout.php';
	require $hound_settings_path . 'export-import.php';
}
