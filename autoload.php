<?php
/**
 * Autoload all the classes of the plugin.
 *
 * @package Hound
 * @author Arafat Jamil
 */

spl_autoload_register(
	function ( $class ) {
		$class_name = str_replace( 'Hound\\', '\\', $class );

		$path = __DIR__ . str_replace( '\\', '/', $class_name ) . '.php';

		if ( file_exists( $path ) ) {
			include_once $path;
		}
	}
);

