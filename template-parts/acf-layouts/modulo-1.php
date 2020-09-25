<div class="modulo_1 container-fluid box-container my-2 my-md-0" style="background-image:url(<?php echo get_sub_field('background_image'); ?>);background-size:contain;background-color:#fff">
    <div class="md-container px-0">
    <div class="box col-lg-6 <?php echo get_sub_field('posizione_box'); ?> <?php echo get_sub_field('background_color'); ?>">
        <?php echo get_sub_field('body'); ?>
        <?php
            if (have_rows('cta')) {
                while (have_rows('cta')) {
                    the_row();
                    if(!empty(get_sub_field('url'))){
                    ?>

                    <a class="apply_cta cta text-uppercase mt-5" href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('label'); ?></a>
                    <?php
                    }
                }
            }
        ?>
    </div>

    </div>
</div>
