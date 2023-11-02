<?php
defined( 'ABSPATH' ) || exit;

CSF::createSection(
	$prefix,
	array(
		'id'    => 'layout_options',
		'title' => __( 'Layout Options', 'hound' ),
		'icon'  => 'fas fa-th-large',
	)
);

// Search box colors and skins.
CSF::createSection(
	$prefix,
	array(
		'parent' => 'layout_options',
		'title'  => __( 'Search Box Styling', 'hound' ),
		'fields' => array(

			array(
				'id'          => 'search_box_padding',
				'type'        => 'spacing',
				'title'       => __( 'Search box padding', 'hound' ),
				'output'      => '.hound-search-form input[type=search]',
				'output_mode' => 'padding',
				'default'     => array(
					'top'    => '10',
					'right'  => '20',
					'bottom' => '10',
					'left'   => '20',
					'unit'   => 'px',
				),
			),

			array(
				'id'          => 'search_box_margin',
				'type'        => 'spacing',
				'title'       => __( 'Search box margin', 'hound' ),
				'output'      => '.hound-search-form',
				'output_mode' => 'margin', // or margin, relative
				'default'     => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
			),

			array(
				'id'      => 'search_box_placeholder',
				'type'    => 'text',
				'title'   => __( 'Search box placeholder', 'hound' ),
				'default' => __( 'Type your keyword...', 'hound' ),
			),
		),
	)
);

