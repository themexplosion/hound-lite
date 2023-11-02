<?php
defined( 'ABSPATH' ) || exit;

CSF::createSection(
	$prefix,
	array(
		'id'     => 'hound_export_import',
		'title'  => __( 'Export/Import', 'hound' ),
		'icon'   => 'fas fa-download',
		'fields' => array(
			array(
				'type' => 'backup',
			),
		),
	),
);
