<?php



/**
 * Default behaviour (saves data as a URL).
 */

Kirki::add_field(
	'starter_theme',
	array(
		'type'        => 'image',
		'settings'    => 'logo_default',
		'section'     => 'header_panel_logo',
		'label'       => esc_html__( 'Logo default', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'default'     => '',
	)
);

Kirki::add_field(
	'starter_theme',
	array(
		'type'        => 'image',
		'settings'    => 'logo_2_default',
		'section'     => 'header_panel_logo',
		'label'       => esc_html__( 'Logo secondario default', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'default'     => '',
	)
);





