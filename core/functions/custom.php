<?php

// custom print_r function
function pre($text, $stop = false) {
    echo "<pre>";
    print_r($text);
    echo "</pre>";
    if ($stop) exit;
}

/** 
 * Replace special characters and spaces in a given string
 * and return the result lowering capital letters
 */
function slugify($text) {

    $text = str_replace('à', 'a', $text);
    $text = str_replace(array('è','é'), 'e', $text);
    $text = str_replace('ì', 'i', $text);
    $text = str_replace('ò', 'o', $text);
    $text = str_replace('ù', 'u', $text);
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}


/**
 * Returns the type of the current page 
 */
function check_page() {

    global $wp_query;
    //pre($wp_query);
    $loop = 'notfound';

    if ($wp_query->is_page) {
        $loop = is_front_page() ? 'front' : 'page';
    } elseif ($wp_query->is_home) {
        $loop = 'home';
    } elseif ($wp_query->is_single) {
        $loop = ($wp_query->is_attachment) ? 'attachment' : 'single';
    } elseif ($wp_query->is_category) {
        $loop = 'category';
    } elseif ($wp_query->is_tag) {
        $loop = 'tag';
    } elseif ($wp_query->is_tax) {
        $loop = 'tax';
    } elseif ($wp_query->is_archive) {
        if ($wp_query->is_day) {
            $loop = 'day';
        } elseif ($wp_query->is_month) {
            $loop = 'month';
        } elseif ($wp_query->is_year) {
            $loop = 'year';
        } elseif ($wp_query->is_author) {
            $loop = 'author';
        } else {
            $loop = 'archive';
        }
    } elseif ($wp_query->is_search) {
        $loop = 'search';
    } elseif ($wp_query->is_404) {
        $loop = 'notfound';
    }

    $output = $loop;

    if (!empty($wp_query->query_vars['post_type'])){
        if (is_array($wp_query->query_vars['post_type'])) {
            $output = implode("-", $wp_query->query_vars['post_type']) . "-" .$loop;
        }else{
            $output = $wp_query->query_vars['post_type'] . "-" .$loop;
        }
    }
    return  $output;
}

function printTimestamp($datetime) { 
    $date = new DateTime($datetime);
    return $date->getTimestamp();
}

 // Function to get the client IP address
function get_client_ip() {

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


/**
 * Salvo/importo i campi acf in formato json.
 */
function ba_acf_json_save_point( $path ) {
	if ( file_exists( CORE_PATH . '/acf-json/' ) ) {
		$path = CORE_PATH . '/acf-json';
	}
	return $path;
}
add_filter( 'acf/settings/save_json', 'ba_acf_json_save_point' );

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

add_filter( 'kirki/fonts/standard_fonts', 'tmu_custom_fonts', 20 );
function tmu_custom_fonts( $standard_fonts ) {
	$my_custom_fonts = array();
	$my_custom_fonts['luisssans'] = array(
		'label' => 'Luiss Sans',
		'stack' => 'Luiss Sans, sans-serif',
	);

	$my_custom_fonts['luissserif'] = array(
		'label' => 'Luiss Serif',
		'stack' => 'Luiss Serif, serif',
	);

	return array_merge_recursive( $my_custom_fonts, $standard_fonts );

}




/**
 * Seleziona nel customizer un template da assegnare.
 * I template si trovato nella cartella template-parts/{nome_cartella} del tema.
 */
function get_folder_templates($folder){
	$array     = array();
	
	try {
		foreach ( glob( get_template_directory() . '/template-parts/'.$folder.'/*.php' ) as $file ) {
			$file                   = basename( $file, '.php' );
			$file_explode           = explode( '/', $file );
			$filename               = end( $file_explode );
			$filename_explode       = explode( '-', $filename );
			$file_version           = end( $filename_explode );
			$array[ $file_version ] = $filename;
		}
	} catch ( \Exception $e ) {
		echo esc_html( $e->getMessage() );
	}

	return $array;
}

/**
 * Seleziona nel customizer un template da assegnare all'header.
 * I template si trovato nella cartella template-parts/header del tema.
 */
function get_header_templates() {
	$array     = array();
	$array[''] = 'Seleziona un template';
	try {
		foreach ( glob( get_template_directory() . '/template-parts/header/*.php' ) as $file ) {
			$file                   = basename( $file, '.php' );
			$file_explode           = explode( '/', $file );
			$filename               = end( $file_explode );
			$filename_explode       = explode( '-', $filename );
			$file_version           = end( $filename_explode );
			$array[ $file_version ] = $filename;
		}
	} catch ( \Exception $e ) {
		echo esc_html( $e->getMessage() );
	}

	return $array;
}

/**
 * Seleziona nel customizer un template da assegnare al footer.
 * I template si trovato nella cartella template-parts/footer del tema.
 */
function get_footer_templates() {
	$array     = array();
	$array[''] = 'Seleziona un template';
	try {
		foreach ( glob( get_template_directory() . '/template-parts/footer/*.php' ) as $file ) {
			$file                   = basename( $file, '.php' );
			$file_explode           = explode( '/', $file );
			$filename               = end( $file_explode );
			$filename_explode       = explode( '-', $filename );
			$file_version           = end( $filename_explode );
			$array[ $file_version ] = $filename;
		}
	} catch ( \Exception $e ) {
		echo esc_html( $e->getMessage() );
	}

	return $array;
}


/**
 * Visualizza nel front-end il template assegnato nel customizer.
 *
 * @param string $template è il tipo di template che vogliamo stampare (header/footer).
 * todo: ricordarsi di nomimare le opzioni nello stesso modo
 * @return void
 */
function starter_get_template_version($template){
	
	$template_version = get_theme_mod( 'starter_'.$template.'_layout_select' );
	$filepath = $_SERVER['DOCUMENT_ROOT'] . '/themes/wp-starter/template-parts/'.$template.'/'.$template.'-'. $template_version .'.php';

	if ( ! empty( $template_version )  	) {
		get_template_part( 'template-parts/'.$template.'/'.$template.'', $template_version );
	} else {
		get_template_part( 'template-parts/'.$template.'/'.$template.'', 'v1' );
	}
	
}

function starter_get_included_templates() {
	$included_files = get_included_files();
	$stylesheet_dir = str_replace( '\\', '/', get_stylesheet_directory() );
	$template_dir   = str_replace( '\\', '/', get_template_directory() );

	foreach ( $included_files as $key => $path ) {

		$path = str_replace( '\\', '/', $path );

		if ( false === strpos( $path, $stylesheet_dir ) && false === strpos( $path, $template_dir ) ) {
			unset( $included_files[ $key ] );
		}
	}

	return $included_files;

}

function removeBasePathFromArray( $array ) {
	$arr = array();
	foreach ( $array as $path ) {
		$arr[] = basename( $path );
	}
	return $arr;
}
function starter_get_included_modules() {
	$included_files = get_included_files();
	$stylesheet_dir = str_replace( '\\', '/', get_stylesheet_directory() . '/template-parts/acf-layouts/' );
	$template_dir   = str_replace( '\\', '/', get_template_directory() . '/template-parts/acf-layouts/' );

	foreach ( $included_files as $key => $path ) {
		if ( false === strpos( $path, $stylesheet_dir ) && false === strpos( $path, $template_dir ) ) {
			unset( $included_files[ $key ] );
		}
	}

	return removeBasePathFromArray( $included_files );

}



function get_all_modules( $type = 'php', &$results = array() ) {
	$stylesheet_dir = str_replace( '\\', '/', get_stylesheet_directory() . '/template-parts/acf-layouts/' );
	$path           = str_replace( '\\', '/', get_template_directory() . '/template-parts/acf-layouts/' );
	$directories    = glob( $path . '*', GLOB_ONLYDIR );
	$files          = array();
	foreach ( $directories as $dir ) {
		$rii = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir ) );
		foreach ( $rii as $file ) {
			if ( ! $file->isDir() && ( $file->getExtension() === $type ) ) {
				$files[] = basename( $file->getPathname() );
			}
		}
	}

	return $files;

}
function get_modules_path( $type ) {
	if ( $type === 'relative' ) {
		return get_stylesheet_directory_uri() . '/template-parts/acf-layouts';
	}

	if ( $type === 'absolute' ) {
		return get_template_directory() . '/template-parts/acf-layouts';
	}

	return get_stylesheet_directory_uri() . '/template-parts/acf-layouts';

}

function get_css_module_file( $module, $type = 'relative' ) {
	$filename = $module;
	$without_extension = pathinfo( $filename, PATHINFO_FILENAME );
	return get_modules_path( $type ) . '/' . $without_extension . '/' . $without_extension . '.css';
}


/**
 * Questa funzione rimuove ricorsivamente gli array vuoti.
 *
 * @param  array $haystack
 * @return void
 */
function array_remove_empty( $haystack ) {
	foreach ( $haystack as $key => $value ) {
		if ( is_array( $value ) ) {
			$haystack[ $key ] = array_remove_empty( $haystack[ $key ] );
		}

		if ( empty( $haystack[ $key ] ) ) {
			unset( $haystack[ $key ] );
		}
	}

	return $haystack;
}

/**
 * Add theme style
 *
 * @return void
 */



function getSlickSliderConfig($array){

	$data = [];
	$data['autoplay']       = $array['config']['autoplay'];
	$data['autoplaySpeed']  = $array['config']['autoplayspeed'];
	$data['slidesToShow']   = $array['config']['slidestoshow'];
	$data['slidesToScroll'] = $array['config']['slidestoscroll'];
	$data['infinite']       = $array['config']['infinite'];
	$data['arrows']         = $array['config']['arrows'];
	$data['prevArrow']      = $array['config']['prevarrow'];
	$data['nextArrow']      = $array['config']['nextarrow'];
	$data['centerMode']     = $array['config']['centermode'];
	$data['centerPadding']  = $array['config']['centerpadding'];
	
	if(!empty($array['breakpoints'])){
		$data['config']['responsive']     = [];
		$i = 0;
		foreach($array['config']['breakpoints'] as $breakpoint){
			
			$data['responsive'][$i]['breakpoint']                 = $breakpoint['breakpoint'];
			$data['responsive'][$i]['settings']['autoplay']       = $breakpoint['autoplay'];
			$data['responsive'][$i]['settings']['autoplaySpeed']  = $breakpoint['autoplayspeed'];
			$data['responsive'][$i]['settings']['slidesToShow']   = $breakpoint['slidestoshow'];
			$data['responsive'][$i]['settings']['slidesToScroll'] = $breakpoint['slidestoscroll'];
			$data['responsive'][$i]['settings']['infinite']       = $breakpoint['infinite'];
			$data['responsive'][$i]['settings']['arrows']         = $breakpoint['arrows'];
			$data['responsive'][$i]['settings']['prevArrow']      = $breakpoint['prevarrow'];
			$data['responsive'][$i]['settings']['nextArrow']      = $breakpoint['nextarrow'];
			$data['responsive'][$i]['settings']['centerMode']     = $breakpoint['centermode'];
			$data['responsive'][$i]['settings']['centerPadding']  = $breakpoint['centerpadding'];

			$i++;
		}
	}
	
	
	$data = array_filter($data, function($value) { return !is_null($value) && $value !== ''; });
	if(!empty($array['breakpoints'])){
		$i = 0;
		foreach($data['responsive'] as $breakpoint){
			$res['responsive'][$i]['breakpoint'] = $breakpoint['breakpoint'];
			$settings = $breakpoint['settings'];
			$res['responsive'][$i]['settings'] = array_filter($settings, function($value) { return !is_null($value) && $value !== ''; });
			$i++;
		}
		$data['responsive'] = $res['responsive'];
	}
	$data = json_encode($data,JSON_NUMERIC_CHECK);
	return $data;
}
function starter_add_theme_styles() {
	wp_register_style( 'font-awesome', get_theme_file_uri( '/assets/vendor/font-awesome/font-awesome.css' ), '', time() );
	wp_enqueue_style( 'font-awesome' );

	wp_register_style( 'hamburgers', get_theme_file_uri( '/assets/vendor/hamburgers/hamburgers.min.css' ), '', true );
	wp_enqueue_style( 'hamburgers' );

	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), null, 'all' );
	wp_enqueue_style( 'splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css', array(), null, 'all' );
	
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), time(), 'all' );

	get_styles();

	wp_register_script( 'boostrap-js', get_theme_file_uri( '/assets/vendor/bootstrap/bootstrap.min.js' ), array( 'jquery' ), true, true );
	wp_enqueue_script( 'boostrap-js' );

	wp_register_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js', array(), true, true );
	wp_enqueue_script( 'gsap' );

	wp_register_script( 'swup', get_theme_file_uri( '/assets/vendor/swup/swup.js' ), array(), true, true );
	wp_enqueue_script( 'swup' );

	
	wp_register_script( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'slick' );

	wp_register_script( 'splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'splide' );


	

	wp_register_script( 'starter', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ), time(), true );
	wp_enqueue_script( 'starter' );

	$enqueue = false;

	if ( is_page( 'eventi' ) || get_the_ID() === 12 ) {

		/* Enqueue style only if we are on the correct CPT editor page. */
		if ( isset( $_GET['view'] ) && ( 'week' === $_GET['view'] )) { 
			$enqueue = true;
		}

		if ( $enqueue ) {

			wp_enqueue_script( 'eventi', get_template_directory_uri() . '/assets/js/weekly.js', array( 'jquery' ), time(), true );

		} else {

			wp_enqueue_script( 'eventi', get_template_directory_uri() . '/assets/js/eventi.js', array( 'jquery' ), time(), true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'starter_add_theme_styles' );

function get_styles() {
	if ( have_rows( 'layouts' ) ) {
		while ( have_rows( 'layouts' ) ) {
			the_row();
			$row    = get_row();
			$modulo = get_modulo( $row['acf_fc_layout'] );
			$src    = get_css_module_file( $modulo, 'absolute' );
			if ( file_exists( $src ) ) {
				$handle = str_replace( '.php', '', $modulo );
				$src    = get_css_module_file( $src );

				wp_register_style( $handle, $src, '', filemtime( get_css_module_file( $src, 'absolute' ) ) );
				wp_enqueue_style( $handle );
			}
		}
	}
}

function get_modulo( $modulo ) {

	return str_replace( '_', '-', $modulo ) . '.php';
}



add_action( 'wp_head', 'myplugin_ajaxurl' );
function myplugin_ajaxurl() {
	echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
         </script>';
}