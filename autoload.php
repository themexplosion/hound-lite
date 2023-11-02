<?php
/**
 * Autoload all the classes of the plugin.
 *
 * @package Hound
 * @author Arafat Jamil
 */

defined( 'ABSPATH' ) || exit;

spl_autoload_register(
	function ( $class_name ) {
		$class_with_namespace = str_replace( 'Hound\\', '\\', $class_name );

		$path = __DIR__ . str_replace( '\\', '/', $class_with_namespace ) . '.php';

		if ( file_exists( $path ) ) {
			include_once $path;
		}
	}
);
