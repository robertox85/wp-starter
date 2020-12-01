<?php
if (get_row_layout() == 'modulo_10'):
$row                 = get_row( true );
$acf_post_type       = $row['query_args']['post_type'];
$acf_post_type_limit = -1;
$args                = array(
	'post_type'      => $acf_post_type,
	'posts_per_page' => $acf_post_type_limit,
	'nopaging'       => true,
);
$cards               = get_posts( $args );
$count               = count( $cards );
$colxrow             = 3;
$col                 = 'col-md-' . ( 12 / $colxrow );
$is_slick            = $row['slick_slider_config']['slider'];
$slick               = ( $is_slick ) ? ' slick-slider' : '';
$slick_slider_config = ( count( $cards ) >= $colxrow ) ? getSlickSliderConfig( $row['slick_slider_config'] ) : '';

?>
<div class="modulo modulo-10 my-2 my-md-0 container box-container">
	<div class="row equal">

		<?php if ( ! empty( get_sub_field( 'titolo' ) ) ) : ?>
			<h1 class="col-12 mt-3"><?php echo esc_html( get_sub_field( 'titolo' ) ); ?></h1>
		<?php endif; ?>

		<div class="container-fluid">	
			<div class="row <?php echo esc_attr( $slick ); ?>" data-slick='<?php echo esc_attr( $slick_slider_config ); ?>'>
				<?php foreach ( $cards as $card ) : 
					$cat = Helper::get_category_root( $card );
					?>
					<div class="col-12 col-lg-4 col-md-6 box">
						<div class="box-inner p-5" style="background-image: linear-gradient(0deg, rgb(0, 18, 36) 0%, rgba(0, 18, 36, 0)), url(<?php echo get_the_post_thumbnail_url( $card->ID ); ?>)">
							<a href="<?php echo esc_url( get_permalink( $card->ID ) ); ?>" target="_blank">
								<p class="color-standard--white paragraph--small "><?php echo date_i18n( 'F d, Y', strtotime( $card->post_date ) ); ?></p>
								<p class="color-standard--white font-weight-bold"> <?php echo $cat->name; ?> </p>
								<h4 class="color-standard--white "> <?php echo esc_html( $card->post_title ); ?> </h4>
								<p class="color-standard--white paragraph--small">by <?php echo get_the_author_meta('user_nicename', $card->post_author); ?></p>
								<a class="color-primary--light" href="<?php echo esc_url( get_permalink( $card->ID ) ); ?>">Read more</a>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	</div>
</div>
<?php endif; ?>