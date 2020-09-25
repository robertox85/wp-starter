<?php

$order_1 = (get_sub_field('posizione_testo') == 'text-right') ? 'order-lg-1' : 'order-lg-2';
$order_2 = (get_sub_field('posizione_testo') != 'text-right') ? 'order-lg-1' : 'order-lg-2';
$fadein  = (get_sub_field('posizione_testo') == 'text-right') ? 'fade-right' : 'fade-left';
$background_url = (get_sub_field('background_type') == 'immagine_2') ? get_sub_field('background_image') : '';
?>
<div class="modulo_2 cmd-ontainer box-container mx-auto d-block my-2 my-md-0 py-3 py-lg-5 <?php echo get_sub_field('background_type') ?>"
    style="background-image: url(<?php echo $background_url; ?>)">
    <div class="container-fluid py-lg-5 px-5">
        <div class="row">
            <div class="col-lg-6 box-img py-lg-5 <?php echo $order_1 ?>"
                    class="image-container"
                    class="animate"
                    data-aos="<?php echo $fadein?>"
                    data-aos-duration="500"
                    data-aos-easing="ease-in-out"
            >

                <?php if (get_sub_field('background_type') == 'immagine'): ?>
                    <img class="immagine" src="<?php echo get_sub_field('immagine'); ?>" alt="">
                <?php endif;?>

                <?php if (get_sub_field('background_type') == 'immagine_2'): ?>
                    <img class="immagine_2" src="<?php echo get_sub_field('immagine'); ?>" alt="">
                <?php endif;?>


                <?php if (get_sub_field('animazione')): ?>

                <div class="image-container scrollme"
                >
                <!-- data-aos-offset="500" -->
                <img

                        class="animateme anim4 img-fluid"
                        data-when="enter"
                        data-from="0"
                        data-to="1"
                        data-easing="easeinout"
                        data-translatey="-100"



                        src="<?php echo get_stylesheet_directory_uri() ?>/images/triangolo3.png" alt="">

                    <img
                        class="animateme anim2 img-fluid"
                        data-when="enter"
                        data-from="0"
                        data-to="1"
                        data-easing="easeinout"
                        data-translatex="-100"
                        src="<?php echo get_stylesheet_directory_uri() ?>/images/triangolo2.png" alt="">

                        <img
                    class="animateme anim1 img-fluid"
                        data-when="enter"
                        data-from="0"
                        data-to="1"
                        data-easing="easeinout"
                        data-translatex="-100"
                        src="<?php echo get_stylesheet_directory_uri() ?>/images/ecole42-logo.png" alt="">


                        <img
                        class="animateme anim3 img-fluid"
                        data-when="enter"
                        data-from="0"
                        data-to="1"
                        data-easing="easeinout"
                        data-translatey="-100"
                        src="<?php echo get_stylesheet_directory_uri() ?>/images/triangolo3.png" alt="">
                </div>


                <?php endif;?>

            </div>
            <div class="col-lg-6 py-lg-5 <?php echo $order_2 ?>">
                <h2><?php echo get_sub_field('titolo'); ?></h2>
                <?php echo get_sub_field('body'); ?>
                <?php
                        if (have_rows('cta')) {
                            while (have_rows('cta')) {
                                the_row();
                                if (!empty(get_sub_field('url'))) {
                                    ?>

                <a class="apply_cta cta text-uppercase"  href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('label'); ?></a>
                <?php
                                    }
                                }
                            }
                        ?>

            </div>
        </div>
    </div>
</div>
