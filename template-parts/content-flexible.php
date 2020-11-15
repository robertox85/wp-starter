<?php

/**
 * Content flexible layouts.
 * Questo file stampa i componenti creati per la pagina che si sta visualizzando.
 * I campi personalizzati vengono passati al template-parts settando la variabile fields.
 *
 * @package WordPress
 */

if (have_rows('layouts')) {
    while (have_rows('layouts')) {
        the_row();
        foreach ( glob( get_template_directory() . '/template-parts/acf-layouts/moduli/*.php' ) as $file ) {
			$file             = basename( $file, '.php' );
			$file_explode     = explode( '/', $file );
			$filename         = end( $file_explode );
			$filename_explode = explode( '-', $filename );
			$file_version     = end( $filename_explode );
            get_template_part( 'template-parts/acf-layouts/moduli/modulo', $file_version );
		}
    }
}
