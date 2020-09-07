<?php
/**
 * Functions
 *
 * Main header file for the theme.
 *
 * @package    WordPress
 */

if ( file_exists( get_template_directory() . '/inc/' ) ) {

	// Define path and URL to the ACF plugin.
	define( 'INCLUDE_PATH', get_template_directory() . '/inc/' );
	define( 'INCLUDE_URL', get_template_directory_uri() . '/inc/' );
	define( 'ACF_PATH', get_template_directory() . '/inc/acf/' );
	define( 'ACF_URL', get_template_directory_uri() . '/inc/acf/' );
	// Include the ACF plugin.
	include_once ACF_PATH . 'acf.php';
	// Include post types.
	foreach ( glob( INCLUDE_PATH . 'post-types/*.php' ) as $file ) {
		include $file;
	}
}




/**
 * ACF JSON.
 *
 * @param  url $path bla bla bla.
 * @return url
 */
function ba_acf_json_save_point( $path ) {
	if ( file_exists( INCLUDE_PATH . '/acf-json/' ) ) {
		$path = INCLUDE_PATH . '/acf-json';
	}

	return $path;
}
add_filter( 'acf/settings/save_json', 'ba_acf_json_save_point' );

/**
 * Setup theme options
 */
function starter_setup_theme() {
	// load theme languages.
	load_theme_textdomain( 'starter', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'starter' ),
			'footer'  => __( 'Footer Menu', 'starter' ),
			'social'  => __( 'Social Links Menu', 'starter' ),
		)
	);
	// This feature enables Post Formats support for a theme.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status' ) );

	// This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	/**
	 * Refresh widgest
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Custom logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	if ( ! file_exists( INCLUDE_PATH . '/class-wp-bootstrap-navwalker.php' ) ) {
		// File does not exist... return an error.
		return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
	} else {
		// File exists... require it.
		include_once INCLUDE_PATH . '/class-wp-bootstrap-navwalker.php';
	}
}
add_action( 'after_setup_theme', 'starter_setup_theme' );

/**
 * Add theme style
 *
 * @return void
 */
function starter_add_theme_styles() {
	wp_register_style( 'fawesome', get_theme_file_uri( '/node_modules/fontawesome/css/all.min.css' ), '', true );
	wp_register_style( 'hamburgers', get_theme_file_uri( '/node_modules/hamburgers/dist/hamburgers.min.css' ), '', true );

	wp_enqueue_style( 'fawesome' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'hamburgers' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), time(), 'all' );

	wp_register_script( 'boostrap-js', get_theme_file_uri( '/node_modules/bootstrap/dist/js/bootstrap.min.js' ), array( 'jquery' ), true, true );
	wp_register_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js', array(), true, true );
	wp_register_script( 'starter', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ), time(), true );

	wp_enqueue_script( 'jquery', '', array(), true, true );
	wp_enqueue_script( 'boostrap-js' );
	wp_enqueue_script( 'gsap' );
	wp_enqueue_script( 'starter' );
}
add_action( 'wp_enqueue_scripts', 'starter_add_theme_styles' );

/**
 * Assets
 *
 * @return void
 */
function assets() {
	$inline_css = '';

	if ( have_rows( 'layouts' ) ) {
		$section_id = 1;
		while ( have_rows( 'layouts' ) ) {
			the_row();

			$styles = get_sub_field( 'section_styles' );

			$inline_css .= "#content-section-{$section_id} {";

			if ( ! empty( $styles['background_image'] ) ) {
				$inline_css .= "background-image: url({$styles['background_image']['url']});";
			}

			$inline_css .= "
                background-color: {$styles['background_color']};
                border-style: {$styles['border_style']};
                border-color: {$styles['border_color']};
                border-width: {$styles['border_width']};
                margin: {$styles['margin']};
                padding: {$styles['padding']};
            ";

			$inline_css .= '}';
			$section_id++;
		}
	}

	wp_add_inline_style( 'style', $inline_css );
}

add_action( 'wp_enqueue_scripts', 'assets' );

/**
 * Registro le sidebar
 *
 * @return void
 */
function starter_multiple_widget_init() {
	if ( function_exists( 'register_sidebar' ) ) {

		$sidebar1 = array(
			'name'          => __( 'Main sidebar 1', 'starter' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		);

		$sidebar2 = array(
			'name'          => __( 'Main sidebar 2', 'starter' ),
			'id'            => 'sidebar-2',
			'description'   => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',

		);

		$sidebar3 = array(
			'name'          => __( 'Main sidebar 3', 'starter' ),
			'id'            => 'sidebar-3',
			'description'   => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		);

		$sidebar4 = array(
			'name'          => __( 'Main sidebar 4', 'starter' ),
			'id'            => 'sidebar-4',
			'description'   => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',

		);

		$pre_footer = array(
			'name'          => __( 'Pre footer', 'starter' ),
			'id'            => 'pre_footer',
			'description'   => 'Attivo su tutti i footer.',
			'class'         => '',
			'before_widget' => '<div class="col-xl-3">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="color__primary col-12 px-0">',
			'after_title'   => '</h4>',
		);

		$footer_widget_1 = array(
			'name'          => __( 'Footer widget 1', 'starter' ),
			'id'            => 'footer_widget_1',
			'description'   => 'Attivo su tutti i footer.',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
			'after_title'   => '</h4>',
		);

		$footer_widget_2 = array(
			'name'          => __( 'Footer widget 2', 'starter' ),
			'id'            => 'footer_widget_2',
			'description'   => 'Attivo su tutti i footer.',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
			'after_title'   => '</h4>',
		);

		$footer_widget_3 = array(
			'name'          => __( 'Footer widget 3', 'starter' ),
			'id'            => 'footer_widget_3',
			'description'   => 'Attivo su tutti i footer.',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
			'after_title'   => '</h4>',
		);

		$footer_widget_4 = array(
			'name'          => __( 'Footer widget 4', 'starter' ),
			'id'            => 'footer_widget_4',
			'description'   => 'Attivo su tutti i footer.',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4 class="color__standard-white col-12 px-0">',
			'after_title'   => '</h4>',
		);

		register_sidebar( $sidebar1 );
		register_sidebar( $sidebar2 );
		register_sidebar( $sidebar3 );
		register_sidebar( $sidebar4 );

		register_sidebar( $pre_footer );

		register_sidebar( $footer_widget_1 );
		register_sidebar( $footer_widget_2 );
		register_sidebar( $footer_widget_3 );
		register_sidebar( $footer_widget_4 );
	}
}

add_action( 'widgets_init', 'starter_multiple_widget_init' );

// Aggiungo nei widget di WordPress un flag per racchiudere gli elementi del widget in un div e un campo di testo per inserire una class css personalizzata.
function starter_add_widget_option( $widget, $return, $instance ) {
	$flag = isset( $instance['flag'] ) ? $instance['flag'] : '';

	?>
	<p>
		<input onchange="toggle_visibility('<?php echo $widget->get_field_id( 'custom_class' ); ?>')" class="checkbox" type="checkbox" id="<?php echo esc_attr( $widget->get_field_id( 'flag' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'flag' ) ); ?>" <?php checked( true, $flag ); ?> />
		<label for="<?php echo esc_attr( $widget->get_field_id( 'flag' ) ); ?>">
	<?php _e( 'Racchiudere in un div?', 'starter' ); ?>
		</label>
	</p>

	<p id="<?php echo esc_attr( $widget->get_field_id( 'custom_class' ) ); ?>" style="display:none;">
		<label>
	<?php _e( 'Aggiungi classe al contenitore', 'starter' ); ?>
		</label>
		<input class="custom_class" type="text" name="<?php echo esc_attr( $widget->get_field_name( 'custom_class' ) ); ?>" />

	</p>

	<script type="text/javascript">
		function toggle_visibility(id) {
			var e = document.getElementById(id);
			if (e.style.display == 'block')
				e.style.display = 'none';
			else
				e.style.display = 'block';
		}
	</script>

	<?php
}
add_filter( 'in_widget_form', 'starter_add_widget_option', 10, 3 );

// Salvo le opzioni custom dei widget.
function starter_save_widget_option( $instance, $new_instance ) {
	// Is the instance a nav menu and are descriptions enabled?
	if ( isset( $new_instance['flag'] ) && ! empty( $new_instance['flag'] ) ) {
		$new_instance['flag'] = 1;
	}

	return $new_instance;
}
add_filter( 'widget_update_callback', 'starter_save_widget_option', 10, 2 );

// Stampo nel front-end i widget con flag e classi aggiuntive.
function starter_dynamic_params( $params ) {
	global $wp_registered_widgets;

	$this_widget_id = $params[0]['widget_id'];  // Current widget ID.
	$this_widget    = $wp_registered_widgets[ $this_widget_id ];
	$widget_object  = $this_widget['callback'][0];  // Current widget object.

	$all_settings   = get_option( $widget_object->option_name );
	$saved_settings = $all_settings[ $params[1]['number'] ];

	if ( isset( $saved_settings['flag'] ) && ! empty( $saved_settings['custom_class'] ) ) {
		$params[0]['before_widget'] = '<div class="' . $saved_settings['custom_class'] . '">';
		$params[0]['after_widget']  = '</div>';
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'starter_dynamic_params' );

// Aggiungo una classe agli elementi <li> della navigazione.
function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}
	if ( in_array( 'menu-item-has-children', $classes ) && $args->depth > 2 ) {
		$classes[] = 'multilevel';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );

// Aggiungo elementi al Customizer di WordPress.
function starter_customize_register( $wp_customize ) {
	
	$wp_customize->add_section(
		'upload_custom_logo',
		array(
			'title'       => esc_html_e( 'Logo', 'starter' ),
			'description' => esc_html_e( 'Display a custom logo?', 'starter' ),
			'priority'    => 25,
		)
	);

	$wp_customize->add_setting(
		'custom_logo'
	);

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'custom_logo',
			array(
				'label'        => esc_html_e( 'Custom logo', 'starter' ),
				'section'      => 'upload_custom_logo',
				'settings'     => 'custom_logo',
				'height'       => 60,
				'width'        => 350,
				'flex_width '  => true,
				'flex_height ' => true,

			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_2',
	);

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'custom_logo_2',
			array(
				'label'       => esc_html_e( 'Custom logo 2', 'starter' ),
				'section'     => 'upload_custom_logo',
				'settings'    => 'custom_logo_2',
				'height'      => 60,
				'width'       => 350,
				'flex_width'  => true,
				'flex_height' => true,
			)
		)
	);

	$wp_customize->add_panel(
		'starter_header',
		array(
			'title' => esc_html_e( 'Header', 'starter' ),
		)
	);

	$wp_customize->add_section(
		'starter_header_section',
		array(
			'title' => esc_html_e( 'Template header', 'starter' ),
			'panel' => 'starter_header',
		)
	);

	$wp_customize->add_section(
		'starter_header_top_menu',
		array(
			'title' => __( 'Top menu', 'starter' ),
			'panel' => 'starter_header',
		)
	);

	$wp_customize->add_setting(
		'starter_header_version_select',
		array(
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		'starter_header_version_select_control',
		array(
			'label'    => esc_html_e( 'Seleziona', 'starter' ),
			'section'  => 'starter_header_section',
			'settings' => 'starter_header_version_select',
			'type'     => 'select',
			'choices'  => get_header_templates(),
		)
	);

	$wp_customize->add_setting(
		'starter_header_top_menu_activate',
		array(
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_control(
		'starter_header_top_menu_activate_control',
		array(
			'label'    => esc_html_e( 'Attivare top menu', 'starter' ),
			'section'  => 'starter_header_top_menu',
			'settings' => 'starter_header_top_menu_activate',
			'type'     => 'checkbox',
			'choices'  => array(
				'yes' => esc_html_e( 'Si', 'starter' ),
			),
		)
	);

	$wp_customize->add_setting(
		'starter_header_top_menu_container',
		array(
			'default'   => 'yes',
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_control(
		'starter_header_top_menu_container_control',
		array(
			'label'    => esc_html_e( 'Top menu container class', 'starter' ),
			'section'  => 'starter_header_top_menu',
			'settings' => 'starter_header_top_menu_container',
			'type'     => 'checkbox',
			'choices'  => array(
				'yes' => esc_html_e( 'Si', 'starter' ),
			),
		)
	);

	$wp_customize->add_panel(
		'starter_footer_panel',
		array(
			'title' => esc_html_e( 'Footer', 'starter' ),
		)
	);

	$wp_customize->add_section(
		'starter_footer_section',
		array(
			'title' => esc_html_e( 'Footer Copy', 'starter' ),
			'panel' => 'starter_footer_panel',
		)
	);

	$wp_customize->add_section(
		'starter_footer_section_stile',
		array(
			'title' => esc_html_e( 'Footer stile', 'starter' ),
			'panel' => 'starter_footer_panel',
		)
	);

	$wp_customize->add_setting(
		'starter_footer_version_select',
		array(
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_control(
		'starter_footer_version_select_control',
		array(
			'label'    => esc_html_e( 'Seleziona', 'starter' ),
			'section'  => 'starter_footer_section_stile',
			'settings' => 'starter_footer_version_select',
			'type'     => 'select',
			'choices'  => get_footer_templates(),
		)
	);

	$wp_customize->add_setting(
		'starter_footer_copy_text',
		array(
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_control(
		'starter_footer_copy_text_control',
		array(
			'label'    => esc_html_e( 'Copy', 'starter' ),
			'section'  => 'starter_footer_section',
			'settings' => 'starter_footer_copy_text',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'starter_footer_copy_privacy_link',
		array(
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_control(
		'starter_footer_copy_privacy_link_control',
		array(
			'label'       => esc_html_e( 'Aggiungi privacy policy?', 'starter' ),
			'description' => esc_html_e( 'Lascia vuoto per non inserire nulla', 'starter' ),
			'section'     => 'starter_footer_section',
			'settings'    => 'starter_footer_copy_privacy_link',
			'type'        => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'starter_customize_register' );

/**
 * Seleziona nel customizer un template da assegnare all'header.
 * I template si trovato nella cartella templates/header del tema.
 */
function get_header_templates() {
	$array     = array();
	$array[''] = 'Seleziona un template';
	try {
		foreach ( glob( get_template_directory() . '/templates/header/*.php' ) as $file ) {
			$file                   = basename( $file, '.php' );
			$file_explode           = explode( '/', $file );
			$filename               = end( $file_explode );
			$filename_explode       = explode( '-', $filename );
			$file_version           = end( $filename_explode );
			$array[ $file_version ] = $filename;
		}
	} catch ( \Exception $e ) {
		echo esc_html( $e->message() );
	}

	return $array;
}

/**
 * Seleziona nel customizer un template da assegnare al footer.
 * I template si trovato nella cartella templates/footer del tema.
 */
function get_footer_templates() {
	$array     = array();
	$array[''] = 'Seleziona un template';
	try {
		foreach ( glob( get_template_directory() . '/templates/footer/*.php' ) as $file ) {
			$file                   = basename( $file, '.php' );
			$file_explode           = explode( '/', $file );
			$filename               = end( $file_explode );
			$filename_explode       = explode( '-', $filename );
			$file_version           = end( $filename_explode );
			$array[ $file_version ] = $filename;
		}
	} catch ( \Exception $e ) {
		echo esc_html( $e->message() );
	}

	return $array;
}

/**
 * Visualizza nel front-end il template dell'header assegnato nel customizer.
 */
function starter_get_header_version() {
	$header_version = get_theme_mod( 'starter_header_version_select' );

	if ( ! empty( $header_version ) ) {
		get_template_part( 'templates/header/header', $header_version );
	} else {
		get_template_part( 'templates/header/header', 'v1' );
	}
}

/**
 * Visualizza nel front-end il template del footer assegnato nel customizer.
 */
function starter_get_footer_version() {
	$footer_version = get_theme_mod( 'starter_footer_version_select' );

	if ( ! empty( $footer_version ) ) {
		get_template_part( 'templates/footer/footer', $footer_version );
	} else {
		get_template_part( 'templates/footer/footer', 'v1' );
	}
}
/**
 * Aggiungo la colonna Data Inizio Evento nella dashboard dei CPT Eventi.
 *
 * @param array $columns lista delle colonne.
 * @return $column
 */
function starter_page_columns( $columns ) {
	$columns = array(
		'cb'          => '< input type="checkbox" />',
		'title'       => esc_html_e( 'Title' ),
		'data_inizio' => esc_html_e( 'Data Inizio' ),
		'date'        => esc_html_e( 'Date' ),
	);
	return $columns;
}
add_filter( 'manage_edit-eventi_columns', 'starter_page_columns' );

/**
 * Per ogni CPT eventi, aggiungo il campo data_inizio.
 *
 * @param array $column lista colonne.
 */
function starter_custom_columns( $column ) {
	global $post;
	if ( 'data_inizio' === $column ) {
		if ( ! empty( get_field( 'data_inizio', $post->ID ) ) ) {
			echo esc_html( gmdate( 'd/m/Y', strtotime( get_field( 'data_inizio', $post->ID ) ) ) );
		}
	}
}
add_action( 'manage_eventi_posts_custom_column', 'starter_custom_columns' );

/**
 * Colonna Data Inizio Eventi Ordinabile.
 *
 * @param array $columns Lista colonne.
 * @return $columns ordinate per data_inizio.
 */
function sortable_eventi_custom_columns( $columns ) {
	$columns['data_inizio'] = 'data_inizio';
	return $columns;
}
add_filter( 'manage_edit-eventi_sortable_columns', 'sortable_eventi_custom_columns' );


/**
 * Ordino gli eventi per data_inizio.
 *
 * @param WP_Post $query elenco post.
 */
function starter_posts_orderby( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( 'data_inizio' === $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'data_inizio' );
		$query->set( 'meta_type', 'numeric' );
	}
}
add_action( 'pre_get_posts', 'starter_posts_orderby' );

/**
 * Undocumented function
 *
 * @param [type] $post_id
 * @return void
 */
function get_titolo( $post_id ) {
	$titolo_args = array();
	if ( have_rows( 'attributi', $post_id ) ) {
		while ( have_rows( 'attributi', $post_id ) ) {
			the_row();
			$titolo_args['titolo_id']    = get_sub_field( 'attributi_contenuto_id' );
			$titolo_args['titolo_class'] = get_sub_field( 'attributi_contenuto_classe' );
		}
	}
	return $titolo_args;
}

function stampa_tag_titolo( $titolo_args ) {
	switch ( $titolo_args['html_tag'] ) {
		case 'p':
			// code...
			printf( '<p id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</p>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h1':
			// code...
			printf( '<h1 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h1>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h2':
			// code...
			printf( '<h2 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h2>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h3':
			// code...
			printf( '<h3 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h3>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h4':
			// code...
			printf( '<h4 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h4>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h5':
			// code...
			printf( '<h5 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h5>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		case 'h6':
			// code...
			printf( '<h6 id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</h6>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
		default:
			// code...
			printf( '<p id="%s" class="section color__primary %s">' . esc_html( $titolo_args['titolo'] ) . '</p>', esc_attr( $titolo_args['titolo_id'] ), esc_attr( $titolo_args['titolo_class'] ) );
			break;
	}
}

function get_cta( $post_id ) {
	$cta = array();
	if ( have_rows( 'gruppo_cta', $post_id ) ) {
		while ( have_rows( 'gruppo_cta', $post_id ) ) {
			the_row();

			$cta['cta_etichetta'] = get_sub_field( 'cta_etichetta' );
			$cta['cta_link']      = ( get_sub_field( 'link_interno_o_esterno' ) === 'interno' ) ? get_sub_field( 'link_interno' ) : get_sub_field( 'link_esterno' );

			if ( have_rows( 'bottone_semplice', $post_id ) ) {
				while ( have_rows( 'bottone_semplice', $post_id ) ) {
					the_row();

					if ( get_sub_field( 'background' ) === 'solid' ) {
						$cta['bottone_semplice']['background_class'] = get_sub_field( 'background_class' );
					}

					if ( get_sub_field( 'background' ) === 'outline' ) {
						$cta['bottone_semplice']['background_class'] = get_sub_field( 'outline_class' );
					}
				}
			}

			if ( have_rows( 'bottone_icona', $post_id ) ) {
				while ( have_rows( 'bottone_icona', $post_id ) ) {
					the_row();
					$cta['bottone_icona']['cta_icona']    = get_sub_field( 'cta_icona' );
					$cta['bottone_icona']['rounded_icon'] = ( get_sub_field( 'cta_icona_standard' ) === 'rounded' ) ? 'button--rounded-icon' : '';
				}
			}

			if ( get_sub_field( 'cta_tipo' ) === 'simple' ) {
				unset( $cta['bottone_icona'] );
			}

			if ( get_sub_field( 'cta_tipo' ) === 'icon' ) {
				unset( $cta['bottone_semplice'] );
			}
		}
	}

	return $cta;
}
