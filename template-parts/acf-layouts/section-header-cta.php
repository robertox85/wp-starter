<?php
/**
 * Section header con cta.
 * I campi personalizzati sono accessibili richiamando la query_var fields.
 *
 * @package    WordPress
 */

$container_id            = get_sub_field( 'section_header_clone_id' );
$container_class         = ( get_sub_field( 'section_header_clone_fullwidth' ) ) ? 'container-fluid ' : 'container ';
$container_class        .= get_sub_field( 'section_header_clone_classe' );
$titolo_args             = get_titolo( get_the_ID() );
$titolo_args['titolo']   = get_sub_field( 'titolo' );
$titolo_args['html_tag'] = get_sub_field( 'tag' );
$cta                     = get_cta( get_the_ID() );
$fields                  = get_query_var( 'fields' );

// TODO: rinomina i fields in acf.

?>


<!-- SECTION CON CTA -->
<div id="<?php esc_attr( $container_id ); ?>" class="<?php echo esc_attr( $container_class ); ?>">
	<div class="row">

		<div class="col-12 d-flex justify-content-between align-items-center">

			<?php stampa_tag_titolo( $titolo_args ); ?>

			<?php if ( isset( $cta['bottone_icona'] ) ) : ?>
				<a href="<?php echo esc_url( $cta['cta_link'] ); ?>" class="button button--with-icon mb-0">
				<span class="button--label">
					<!-- button--negative button--primary -->
					<?php echo esc_html( $cta['cta_etichetta'] ); ?>
				</span>
				<span class="button--icon <?php echo esc_attr( $cta['bottone_icona']['rounded_icon'] ); ?>">
					<?php echo esc_html( $cta['bottone_icona']['cta_icona'] ); ?>
				</span>
			</a>
			<?php endif; ?>

			<?php if ( isset( $cta['bottone_semplice'] ) ) : ?>

			<a href="<?php echo esc_url( $cta['cta_link'] ); ?>"
				class="button <?php echo esc_attr( $cta['bottone_semplice']['background_class'] ); ?> mb-0">
				<?php echo esc_html( $cta['cta_etichetta'] ); ?>
			</a>

			<?php endif; ?>




		</div>
	</div>
</div>
