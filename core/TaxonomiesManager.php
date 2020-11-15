<?php

Class TaxonomiesManager {
    
    /**
     * Initializer for setting up action handler
     */
    public static function init() {
        add_action('init', [ get_called_class(), 'register_tax' ] ); // Add Menu         
    }


    public static function register_tax() {
        
        register_taxonomy('tipologia', ['corsi-online'], [
            'hierarchical' => false,
            'labels' => Helper::generate_labels('tipologia','f'),
            'show_ui' => true,'show_in_rest' => true,'query_var' => true,
            'rewrite' => ['slug' => 'tipologia', 'with_front' => true],
            'capabilities' => ['manage_terms' => 'manage_categories','edit_terms' => 'manage_categories','delete_terms' => 'manage_categories','assign_terms' => 'edit_posts'],
        ]);

      
    }
}
TaxonomiesManager::init();

