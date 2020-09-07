<?php
/**
 * Content flexible layouts.
 * Questo file stampa i componenti creati per la pagina che si sta visualizzando.
 * I campi personalizzati vengono passati al templater-parts settando la variabile fields.
 *
 * @package    WordPress
 */

if ( have_rows( 'layouts' ) ) {
	while ( have_rows( 'layouts' ) ) {
		the_row();
		set_query_var( 'fields', get_row( true ) );

		if ( get_row_layout() === 'section_header' ) {
			get_template_part( 'template-parts/acf-layouts/section', 'header' );
		}

		if ( get_row_layout() === 'section_header_cta' ) {
			get_template_part( 'template-parts/acf-layouts/section', 'header-cta' );
		}
	}
}
