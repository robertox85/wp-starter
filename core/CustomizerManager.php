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
            Kirki::add_field( 'starter_theme', [
                'type'        => 'select',
                'settings'    => 'starter_footer_layout_select',
                'label'       => esc_html__( 'This is the label', 'kirki' ),
                'section'     => 'footer_panel_layout',
                'default'     => 'option-1',
                'placeholder' => esc_html__( 'Select an option...', 'kirki' ),
                'priority'    => 10,
                'multiple'    => 1,
                'choices'     => $footer,
            ] );
            

        
        
        
            include_once CORE_PATH . 'customizer/header/logo.php';
            include_once CORE_PATH . 'customizer/header/layout.php';
            
        
        }
    }
}

CustomizerManager::init();