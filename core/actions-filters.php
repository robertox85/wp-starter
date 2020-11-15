<?php

/*------------------------*\
    Actions + Filters
\*------------------------*/


// Add Actions





// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class 

/** Per fare debug sul template richiamato */
// add_action( 'wp_head', 'debug_rewrite_rules' );
function debug_rewrite_rules() {
    global $wp, $template, $wp_rewrite;

    echo '<pre>';
    echo 'Request: ';
    echo empty($wp->request) ? "None" : esc_html($wp->request) . PHP_EOL;
    echo 'Matched Rewrite Rule: ';
    echo empty($wp->matched_rule) ? "None" : esc_html($wp->matched_rule) . PHP_EOL;
    echo 'Matched Rewrite Query: ';
    echo empty($wp->matched_query) ? "None" : esc_html($wp->matched_query) . PHP_EOL;
    echo 'Loaded Template: ';
    echo basename($template);
    echo '</pre>' . PHP_EOL;

    echo '<pre>';
    print_r($wp_rewrite->rules);
    echo '</pre>';
}

define('WP_DEBUG_SCRIPTS',false);
define('WP_DEBUG_STYLES' ,false);

function wp_inspect_scripts() {
    
    if ( WP_DEBUG_SCRIPTS ) {
		global $wp_scripts;
		echo '<pre><h1>Script Handles</h1><ul>';
		foreach ( $wp_scripts->queue as $handle ) :
			echo '<li>' . $handle . '</li>';
		endforeach;
        echo '</ul></pre>';
        exit();
	}

}
add_action( 'wp_print_scripts', 'wp_inspect_scripts' );
function wp_inspect_styles() {
	if ( WP_DEBUG_STYLES ) {
		global $wp_styles;
		echo '<pre><h1>Style Handles</h1><ul>';
		foreach ( $wp_styles->queue as $handle ) :
			echo '<li>' . $handle . '</li>';
		  endforeach;
        echo '</ul></pre>';
        
	}

}
add_action( 'wp_print_styles', 'wp_inspect_styles' );