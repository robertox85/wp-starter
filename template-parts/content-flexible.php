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

		if (get_row_layout() == 'modulo_1')
            get_template_part('template-parts/acf-layouts/modulo','1');

        // Case: Sfondo colore/immagine con box immagine e box testo
        if (get_row_layout() == 'modulo_2')
            get_template_part('template-parts/acf-layouts/modulo','2');

        // Case: 1 box testo principale e 2 secondari
        if (get_row_layout() == 'modulo_3')
            get_template_part('template-parts/acf-layouts/modulo','3');

        // Case: Collapse
        if (get_row_layout() == 'modulo_4')
            get_template_part('template-parts/acf-layouts/modulo','4');

        // Case: Iframe
        if (get_row_layout() == 'modulo_5')
            get_template_part('template-parts/acf-layouts/modulo','5');

        // Case: Gruppo di card testo/immagine
        if (get_row_layout() == 'modulo_6')
            get_template_part('template-parts/acf-layouts/modulo','6');

        // Case: Slider
        if (get_row_layout() == 'modulo_7')
            get_template_part('template-parts/acf-layouts/modulo','7');

        // Case: Testo du due colonne con titolo, sottotitolo e imamgine di sfondo
        if (get_row_layout() == 'modulo_8')
            get_template_part('template-parts/acf-layouts/modulo','8');

        // Case: Timeline.
        if (get_row_layout() == 'modulo_9')
            get_template_part('template-parts/acf-layouts/modulo','9');
	}
}
