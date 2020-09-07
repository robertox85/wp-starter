<?php
/**
 * Section header.
 * I campi personalizzati sono accessibili richiamando la query_var fields.
 *
 * @package    WordPress
 */

$container_id            = get_sub_field( 'section_header_clone_id' );
$container_class         = ( get_sub_field( 'section_header_clone_fullwidth' ) ) ? 'container-fluid ' : 'container ';
$container_class        .= get_sub_field( 'section_header_clone_classe' );
$titolo_args             = array();
$titolo_args['titolo']   = get_sub_field( 'titolo' );
$titolo_args['html_tag'] = get_sub_field( 'tag' );
$cta                     = array();
$row                     = get_query_var( 'row' );

if ( have_rows( 'attributi' ) ) {
	while ( have_rows( 'attributi' ) ) {
		the_row();
		$titolo_args['titolo_id']    = get_sub_field( 'attributi_contenuto_id' );
		$titolo_args['titolo_class'] = get_sub_field( 'attributi_contenuto_classe' );
	}
}
?>

<div id="<?php esc_attr( $container_id ); ?>" class="<?php echo esc_attr( $container_class ); ?>">
	<div class="row">
		<div class="col-12 d-flex justify-content-center">
			<?php stampa_tag_titolo( $titolo_args ); ?>
		</div>
	</div>
</div>
