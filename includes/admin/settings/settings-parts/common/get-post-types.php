<?php
defined( 'ABSPATH' ) || exit;

add_action( 'init', 'hound_get_public_post_types' );

function hound_get_public_post_types() {

		// Get all public post types and save.
		$registered_public_post_types = get_post_types( array( 'public' => true ) );

		update_option( 'hound_public_post_types', $registered_public_post_types );

		// Get all private post types and save
		$registered_private_post_types = get_post_types( array( 'public' => false ) );

		update_option( 'hound_private_post_types', $registered_private_post_types );

		// post status list.
		$post_status_list = get_post_stati();

		update_option( 'hound_post_status_list', $post_status_list );
}

$selected_post_types  = get_option( 'hound_public_post_types' ) ?? get_post_types( array( 'public' => true ) );
$available_post_types = get_option( 'hound_private_post_types' ) ?? get_post_types( array( 'public' => false ) );
$post_status_list     = get_option( 'hound_post_status_list' ) ?? get_post_stati();
