<?php

Class PostTypesManager {
    
    /**
     * Initializer for setting up action handler
     */
    public static function init() {
        // create standard pages 
        if (get_page_by_title('ajax') == null) Helper::createPage('ajax');    
      
        // create custom Post Types 
        add_action('init', [ get_called_class(), 'create_post_types' ] ); // Add custom post types     
        
        add_action('save_post', [ get_called_class(), 'post_save'], 10, 3);
        add_action('future_to_publish',  [ get_called_class(), 'post_save_future']);
        
        // Remove side menu
        add_action( 'admin_menu', [ get_called_class(), 'remove_default_post_type'] );
        // Remove +New post in top Admin Menu Bar
        add_action( 'admin_bar_menu', [ get_called_class(), 'remove_default_post_type_menu_bar'], 999 );
        // Remove Quick Draft Dashboard Widget
        add_action( 'wp_dashboard_setup', [ get_called_class(), 'remove_draft_widget'], 999 );
        // End remove post type

        
    }

    
    
    /**
     * create_post_types
     */
    public static function create_post_types()
    {
        
        

        register_post_type('acf-widgets', [
            'labels' => Helper::generate_labels('Widgets'),        
            'rewrite' => [ 'slug' => 'acf-widgets' ],
            'public' => true, 'hierarchical' => false, 'has_archive' => true, 'show_in_rest' => true, 'can_export' => true,
            'supports' => ['title'], 
        ]);
        
        register_post_type('eventi', [
            'labels' => Helper::generate_labels('eventi'),        
            'rewrite' => [ 'slug' => 'eventi' ],
            'public' => true, 'hierarchical' => false, 'has_archive' => true, 'show_in_rest' => true, 'can_export' => true,
            'supports' => ['title','editor','excerpt','thumbnail','author'], 
            'taxonomies' => [ 'category' ]  // Add Category and Post Tags support
        ]);

        
    }
    

    
    public static function post_save_future($post_id){ 
      
    }
    public static function post_save($post_id, $post, $update){  
        
    }

    
    public static function remove_default_post_type_menu_bar( $wp_admin_bar ) {
        // $wp_admin_bar->remove_node( 'new-post' );
    }
    public static function remove_draft_widget(){
        // remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    }
    public static function remove_default_post_type() {
        // remove_menu_page( 'edit.php' );
    }
}
PostTypesManager::init();