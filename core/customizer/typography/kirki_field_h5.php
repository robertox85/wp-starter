<?php 




    /**
     * H5
     */
	Kirki::add_field(
		'starter_theme',
		array(
			'type'        => 'toggle',
			'settings'    => 'typography_h5_toggle_field',
			'section'     => 'typography_section_h5',
			'label'       => esc_attr__( 'Edit?', 'starter' ),
			'description' => esc_attr__( 'Select the main typography options for your site.', 'starter' ),
			'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'starter' ),
			'priority'    => 10,
			'default'     => '0',
		)
	);

	Kirki::add_field(
		'starter_theme',
		array(
			'type'        => 'typography',
			'settings'    => 'typography_h5_field',
			'section'     => 'typography_section_h5',
			'label'       => esc_attr__( 'Typography', 'starter' ),
			'description' => esc_attr__( 'Select the main typography options for your site.', 'starter' ),
			'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'starter' ),
			'priority'    => 10,
			'choices' => [
                'fonts' => [
                    'google' => [ 'popularity', 30 ],
                ],
            ],
			'default'     => array(
				'font-family'    => 'Luiss Sans, sans-serif',
				'variant'        => 'regular',
				'font-size'      => '14px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333',
				'text-transform' => 'none',
				'text-align'     => 'left',
			),
			'required'    => array(
				array(
					'setting'  => 'typography_h5_toggle_field',
					'operator' => '==',
					'value'    => true,
				),
			),
			'output'      => array(
				array(
                    'element' => array('h5','.h5'),
                ),
			),
		)
    );
