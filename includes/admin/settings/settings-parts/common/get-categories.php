<?php
defined( 'ABSPATH' ) || exit;

$available_categories = get_categories();
foreach ( $available_categories as $category ) {
	$category_names[ $category->term_id ] = $category->name;
}
