<?php

Class ThemeManager
{
    
    /**
     * Initializer for setting up action handler
     */
    public static function init()
    {
        
        
        
        add_action('after_setup_theme', [ get_called_class(),'add_theme_support']);

        //disabled  gutemberg editori
        add_filter('use_block_editor_for_post', '__return_false', 5);
        
        // remove unncessary header info
        add_action('init', [ get_called_class(),'remove_header_meta']);
        
        if(function_exists('acf_add_options_page') ) {
            
            acf_add_options_page(
                array(
                'page_title'     => 'Site Settings',
                'menu_title'    => 'Site Settings',
                'menu_slug'     => 'site-general-settings',
                'capability'    => 'edit_posts',
                'redirect'        => false
                )
            );
            
        }

        // Remove Actions
        remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
        remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
        remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
        remove_action('wp_head', 'index_rel_link'); // Index link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
        remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', '_wp_render_title_tag', 1);

        // remove emojis
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }

    public static function remove_header_meta()
    {
        remove_action('wp_head', 'description');
    }
    
    public static function add_theme_support()
    {
        if (function_exists('add_theme_support')) {

            
            // Add Menu Support
            add_theme_support('menus');
        
        
            // Add Custom Thumbnail Theme Support
            add_theme_support('post-thumbnails');
               
            // Enables post and comment RSS feed links to head
            add_theme_support('automatic-feed-links');


            // load theme languages.
            load_theme_textdomain('starter', get_template_directory() . '/languages');

            add_theme_support('title-tag');

            /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
            */
            add_theme_support('post-thumbnails');

            // This theme uses wp_nav_menu() in two locations.
    
            // This feature enables Post Formats support for a theme.
            add_theme_support('post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status' ));

            // This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.
            add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));

            /**
             * Refresh widgest
             */
            add_theme_support('customize-selective-refresh-widgets');

            /**
             * Custom logo
             */
            add_theme_support('custom-logo', array( 'header-text' => array( 'site-title', 'site-description' )));
                
            add_post_type_support('page', 'excerpt');
            
            // add_image_size('square', 160, 160, true);
            // update_option('thumbnail_crop', 1);
            // update_option('thumbnail_size_w', 384);
            // update_option('thumbnail_size_h', 216);
            // update_option('medium_crop', 1);
            // update_option('medium_size_w', 768);
            // update_option('medium_size_h', 432);
            // update_option('large_crop', 1);    
            // update_option('large_size_w', 1060);
            // update_option('large_size_h', 424);
        
            
            //add_image_size('small-x2', 768, 432, true); // *** small-x2  = medium ***
            //add_image_size('medium-x2', 1536, 864, true);
            // add_image_size('large_x2', 2120, 848, true);
            //add_image_size('square-x2', 320, 320, true);
            
            
            // Remove first p in single content
            //remove_filter('the_content', 'wpautop');
        
            
        }
    }
}
ThemeManager::init();

