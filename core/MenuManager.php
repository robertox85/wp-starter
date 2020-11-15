<?php
/*
 *  Class MenuManager
 */
Class MenuManager {
    
    /**
     * Initializer for setting up action handler
     */
    public static function init() {
        add_action('after_setup_theme', [ get_called_class(), 'register_menu' ] ); // Add Menu         
    }


    /**
     * Insert a new row 
     */
    public static function register_menu()
    {
        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'starter' ),
                'footer'  => __( 'Footer Menu', 'starter' ),
                'social'  => __( 'Social Links Menu', 'starter' ),
            )
        );
    }
}
MenuManager::init();