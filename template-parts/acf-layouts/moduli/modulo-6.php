<?php
if (get_row_layout() == 'modulo_6'): 
$row                 = get_row( true );
$cards               = $row['ripetitore'];
$count               = count( $cards );
$colxrow             = 3;
$col                 = 'col-md-' . ( 12 / $colxrow );
$is_slick            = $row['slick_slider_config']['slider'];
$slick               = ( $is_slick ) ? ' slick-slider' : '';
$slick_slider_config = getSlickSliderConfig( $row['slick_slider_config'] );

?>
<div class="modulo modulo-6 my-2 my-md-0 container box-container">
    <div class="row equal">

        <?php if ( ! empty( get_sub_field( 'titolo' ) ) ) : ?>
        <h1 class="col-12 mt-3"><?php echo esc_html( get_sub_field( 'titolo' ) ); ?></h1>
        <?php endif; ?>

        <?php if ( have_rows( 'ripetitore' ) ) : ?>
        <div class="container-fluid">
            <div class="row <?php echo esc_attr( $slick ); ?>"
                data-slick='<?php echo esc_attr( $slick_slider_config ); ?>'>

                <?php  while ( have_rows( 'ripetitore' ) ) : the_row(); ?>
                <!-- Se c'è il link funziona per tutti -->
                <!-- PARTNER -->
                <?php if ( get_sub_field( 'background_type' ) == 'partner' ) : ?>
                <div class="box <?php echo $col ?>">
                    <a href="<?php echo get_sub_field( 'url' ); ?>" target="_blank">
                        <img src="<?php echo get_sub_field( 'background_image' ); ?>" class="img-fluid" />
                    </a>
                </div>
                <!-- BOX CON TESTO -->
                <?php elseif ( get_sub_field( 'background_type' ) == 'immagine' ) : ?>

                <div class="box <?php echo $col ?> image  <?php echo get_sub_field( 'posizione_testo' ); ?> ">

                    <div class="box-inner p-5"
                        style="background-image:url('<?php echo get_sub_field( 'background_image' ); ?>');background-size: cover;background-position: center center;">

                        <a href="<?php echo get_sub_field( 'url' ); ?>" target="_blank">
                            <h2><?php echo get_sub_field( 'titolo_card' ); ?></h2>
                            <p><?php echo get_sub_field( 'body' ); ?></p>
                        </a>
                    </div>

                </div>

                <?php else : ?>
                <div class="box <?php echo $col ?>  ">
                    <div
                        class="box-inner p-5 <?php echo get_sub_field( 'posizione_testo' ); ?> <?php echo get_sub_field( 'background_type' ); ?>">
                        <a href="<?php echo get_sub_field( 'url' ); ?>" target="_blank">
                            <h2><?php echo get_sub_field( 'titolo_card' ); ?></h2>
                            <p><?php echo get_sub_field( 'body' ); ?></p>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>