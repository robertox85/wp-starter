<?php

$header = get_folder_templates('header');
Kirki::add_field( 'starter_theme', [
	'type'        => 'select',
	'settings'    => 'starter_header_layout_select',
	'label'       => esc_html__( 'This is the label', 'kirki' ),
	'section'     => 'header_panel_layout',
	'default'     => 'option-1',
	'placeholder' => esc_html__( 'Select an option...', 'kirki' ),
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => $header,
] );