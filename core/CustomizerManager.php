<?php 


Class CustomizerManager
{
    /**
     * Initializer for setting up action handler
     */
    public static function init()
    {
        // create custom Post Types 
        CustomizerManager::create_custmizer_settings();       
    }

    public static function create_custmizer_settings()
    {
        if (class_exists('Kirki') ) {

            Kirki::add_config(
                'starter_theme',
                array(
                    'option_type' => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                )
            );
        
        
            Kirki::add_panel(
                'tipography_panel',
                array(
                    'priority'    => 10,
                    'title'       => esc_html__('Tipografia', 'starter'),
                )
            );

            Kirki::add_section(
                'tipography_panel_font',
                array(
                    'title'          => esc_html__('Font', 'starter'),
                    'description'    => '',
                    'panel'          => 'tipography_panel',
                    'priority'       => 160,
                )
            );

            Kirki::add_field(
                'starter_theme',
                array(
                    'type'        => 'toggle',
                    'settings'    => 'typography_heading_toggle',
                    'section'     => 'tipography_panel_font',
                    'label'       => esc_attr__( 'Edit heading fonts?', 'starter' ),
                    'description' => esc_attr__( 'Select the main typography options for your site.', 'starter' ),
                    'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'starter' ),
                    'priority'    => 10,
                    'default'     => 0,
                )
            );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'typography',
                'settings'    => 'typography_heading_setting',
                'section'     => 'tipography_panel_font',
                'label'       => esc_html__( 'Heading font', 'kirki' ),
                'priority'    => 10,
                'default'     => [
                    'font-family'    => 'Luiss Sans, sans-serif',
                    'variant'        => 'regular',
                    'font-size'      => '14px',
                    'line-height'    => '1.5',
                    'letter-spacing' => '0',
                    'color'          => '#333333',
                    'text-transform' => 'none',
                    'text-align'     => 'left',
                ],
                'choices' => [
                    'fonts' => [
                        'google' => [ 'popularity', 30 ],
                    ],
                ],
                'required'    => array(
                    array(
                        'setting'  => 'typography_heading_toggle',
                        'operator' => '==',
                        'value'    => 1,
                    ),
                ),
                'output'      => array(
                    array(
                        'element' => array( 'h1', '.h1','h2','.h2','h3','.h3','h4','.h4','h5','.h5','h6','.h6' ),
                    ),
                ),
            ] );


            Kirki::add_field(
                'starter_theme',
                array(
                    'type'        => 'toggle',
                    'settings'    => 'typography_body_toggle',
                    'section'     => 'tipography_panel_font',
                    'label'       => esc_attr__( 'Edit body fonts?', 'starter' ),
                    'description' => esc_attr__( 'Select the main typography options for your site.', 'starter' ),
                    'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'starter' ),
                    'priority'    => 10,
                    'default'     => 0,
                )
            );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'typography',
                'settings'    => 'typography_body_setting',
                'section'     => 'tipography_panel_font',
                'label'       => esc_html__( 'Body font', 'kirki' ),
                'priority'    => 10,
                'default'     => [
                    'font-family'    => 'Luiss Sans, sans-serif',
                    'variant'        => 'regular',
                    'font-size'      => '14px',
                    'line-height'    => '1.5',
                    'letter-spacing' => '0',
                    'color'          => '#333333',
                    'text-transform' => 'none',
                    'text-align'     => 'left',
                ],
                'choices' => [
                    'fonts' => [
                        'google' => [ 'popularity', 30 ],
                    ],
                ],
                'required'    => array(
                    array(
                        'setting'  => 'typography_body_toggle',
                        'operator' => '==',
                        'value'    => 1,
                    ),
                ),
                'output'      => array(
                    array(
                        'element' => array( 'p', '.p','a','.a','label','.label','input','.input','textarea','.textarea' ),
                    ),
                ),
            ] );


            Kirki::add_section(
                'tipography_panel_colors',
                array(
                    'title'          => esc_html__('Colori', 'starter'),
                    'description'    => '',
                    'panel'          => 'tipography_panel',
                    'priority'       => 160,
                )
            );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_standard_setting_hex',
                'label'       => __( 'Standard', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#1f2326',
                'css_vars'        => array(
                    array( '--standard' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_standard_light_setting_hex',
                'label'       => __( 'Standard Light', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#8c8e90',
                'css_vars'        => array(
                    array( '--standard--light' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_standard_white_setting_hex',
                'label'       => __( 'Standard White', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#ffffff',
                'css_vars'        => array(
                    array( '--standard--white' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_setting_hex',
                'label'       => __( 'Primary', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#003a70',
                'css_vars'        => array(
                    array( '--primary' ),
                ),
                'transport'       => 'postMessage',
            ] );


            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_light_setting_hex',
                'label'       => __( 'Primary light', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#7f9cb7',
                'css_vars'        => array(
                    array( '--primary--light' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_lighter_setting_hex',
                'label'       => __( 'Primary lighter', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#e0e2e6',
                'css_vars'        => array(
                    array( '--primary--lighter' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_superlight_setting_hex',
                'label'       => __( 'Primary superlight', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#f2f8fd',
                'css_vars'        => array(
                    array( '--primary--superlight' ),
                ),
                'transport'       => 'postMessage',
            ] );


            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_ultralight_setting_hex',
                'label'       => __( 'Primary ultralight', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#f9fcfe',
                'css_vars'        => array(
                    array( '--primary--ultralight' ),
                ),
                'transport'       => 'postMessage',
            ] );

            Kirki::add_field( 'starter_theme', [
                'type'        => 'color',
                'settings'    => 'color_primary_secondary_setting_hex',
                'label'       => __( 'Secondary secondary', 'kirki' ),
                'description' => esc_html__( 'This is a color control - without alpha channel.', 'kirki' ),
                'section'     => 'tipography_panel_colors',
                'default'     => '#f9fcfe',
                'css_vars'        => array(
                    array( '--secondary' ),
                ),
                'transport'       => 'postMessage',
            ] );


            Kirki::add_panel(
                'header_panel',
                array(
                    'priority'    => 10,
                    'title'       => esc_html__('Header', 'starter'),
                    'description' => esc_html__('Header description', 'starter'),
                )
            );
        
            Kirki::add_section(
                'header_panel_logo',
                array(
                    'title'          => esc_html__('Logo', 'starter'),
                    'description'    => '',
                    'panel'          => 'header_panel',
                    'priority'       => 160,
                )
            );

            Kirki::add_section(
                'header_panel_top_menu',
                array(
                    'title'          => esc_html__('Top menu', 'starter'),
                    'description'    => '',
                    'panel'          => 'header_panel',
                    'priority'       => 160,
                )
            );

            Kirki::add_field(
                'starter_theme', [
                    'type'        => 'toggle',
                    'settings'    => 'topmenu_toggle_setting',
                    'label'       => esc_html__( 'Attivare top menu', 'starter' ),
                    'section'     => 'header_panel_top_menu',
                    'default'     => '0',
                    'priority'    => 10,
                 ] 
            );

            Kirki::add_field(
                'starter_theme', [
                    'type'        => 'toggle',
                    'settings'    => 'topmenu_container_toggle_setting',
                    'label'       => esc_html__( 'Container Fluid?', 'starter' ),
                    'section'     => 'header_panel_top_menu',
                    'default'     => '0',
                    'priority'    => 10,
                 ] 
            );
        
            Kirki::add_section(
                'header_panel_layout',
                array(
                    'title'          => esc_html__('Header layout', 'starter'),
                    'description'    => '',
                    'panel'          => 'header_panel',
                    'priority'       => 160,
                )
            );

            Kirki::add_panel(
                'footer_panel',
                array(
                    'priority'    => 10,
                    'title'       => esc_html__('Footer', 'starter'),
                    'description' => esc_html__('Footer description', 'starter'),
                )
            );

            Kirki::add_section(
                'footer_panel_layout',
                array(
                    'title'          => esc_html__('Footer Layout', 'starter'),
                    'description'    => '',
                    'panel'          => 'footer_panel',
                    'priority'       => 160,
                )
            );

            $footer = get_folder_templates('footer');
            Kirki::add_field(
                'starter_theme', [
                'type'        => 'select',
                'settings'    => 'starter_footer_layout_select',
                'label'       => esc_html__('This is the label', 'kirki'),
                'section'     => 'footer_panel_layout',
                'default'     => 'option-1',
                'placeholder' => esc_html__('Select an option...', 'kirki'),
                'priority'    => 10,
                'multiple'    => 1,
                'choices'     => $footer,
                 ] 
            );
            

        
        
        
            include_once CORE_PATH . 'customizer/header/logo.php';
            include_once CORE_PATH . 'customizer/header/layout.php';
            
        
        }
    }
}

CustomizerManager::init();