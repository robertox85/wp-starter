<?php

Class WidgetsManager {
    
    /**
     * Initializer for setting up action handler
     */
    public static function init() {
        add_action('init', [ get_called_class(), 'load_widget' ] ); // Add Menu         
    }


    /**
     * Insert a new row 
     */
    public static function load_widget()
    {
        register_nav_menus([ // Using array to specify more menus if needed
            'header-menu'  => 'Header Menu', // Main Navigation
            'sidebar-menu' => 'Sidebar Menu', // Sidebar Navigation
            'extra-menu'   => 'Extra Menu', // Extra Navigation if needed (duplicate as many as you need!)
        ]);
    }
}

WidgetsManager::init();