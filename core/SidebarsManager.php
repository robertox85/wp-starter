<?php
/*
 *  Class SidebarsManager
 */
Class SidebarsManager
{
    
    /**
     * Initializer for setting up action handler
     */
    public static function init()
    {
        add_action('widgets_init', [ get_called_class(), 'register_sidebar' ]); 
    }

    public static function register_sidebar()
    {
        // If Dynamic Sidebar Exists
        if (function_exists('register_sidebar')) {
            
            $sidebar1 = array(
                'name'          => __('Main sidebar 1', 'starter'),
                'id'            => 'sidebar-1',
                'description'   => '',
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
            );
    
            $sidebar2 = array(
                'name'          => __('Main sidebar 2', 'starter'),
                'id'            => 'sidebar-2',
                'description'   => '',
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
    
            );
    
            $sidebar3 = array(
                'name'          => __('Main sidebar 3', 'starter'),
                'id'            => 'sidebar-3',
                'description'   => '',
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
            );
    
            $sidebar4 = array(
                'name'          => __('Main sidebar 4', 'starter'),
                'id'            => 'sidebar-4',
                'description'   => '',
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
    
            );
    
            $pre_footer = array(
                'name'          => __('Pre footer', 'starter'),
                'id'            => 'pre_footer',
                'description'   => 'Attivo su tutti i footer.',
                'class'         => '',
                'before_widget' => '<div class="col-xl-3">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="color__primary col-12 px-0">',
                'after_title'   => '</h4>',
            );
    
            $footer_widget_1 = array(
                'name'          => __('Footer widget 1', 'starter'),
                'id'            => 'footer_widget_1',
                'description'   => 'Attivo su tutti i footer.',
                'class'         => '',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
                'after_title'   => '</h4>',
            );
    
            $footer_widget_2 = array(
                'name'          => __('Footer widget 2', 'starter'),
                'id'            => 'footer_widget_2',
                'description'   => 'Attivo su tutti i footer.',
                'class'         => '',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
                'after_title'   => '</h4>',
            );
    
            $footer_widget_3 = array(
                'name'          => __('Footer widget 3', 'starter'),
                'id'            => 'footer_widget_3',
                'description'   => 'Attivo su tutti i footer.',
                'class'         => '',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
                'after_title'   => '</h4>',
            );
    
            $footer_widget_4 = array(
                'name'          => __('Footer widget 4', 'starter'),
                'id'            => 'footer_widget_4',
                'description'   => 'Attivo su tutti i footer.',
                'class'         => '',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
                'after_title'   => '</h4>',
            );
    
            register_sidebar($sidebar1);
            register_sidebar($sidebar2);
            register_sidebar($sidebar3);
            register_sidebar($sidebar4);
            register_sidebar($pre_footer);
            register_sidebar($footer_widget_1);
            register_sidebar($footer_widget_2);
            register_sidebar($footer_widget_3);
            register_sidebar($footer_widget_4);
            
        }
    }
}
SidebarsManager::init();

