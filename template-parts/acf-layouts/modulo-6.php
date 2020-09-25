<?php
$class = '';
$color = '';
if(have_rows('ripetitore')){
    while(have_rows('ripetitore')){
        the_row();
        if(get_sub_field('background_type') == 'partner'){
            $class = 'container';
        }
        elseif(get_sub_field('background_type') == 'immagine'){
            $class = 'container';
        }

        else{
            $class = 'container-fluid';
        }

    }
}
?>
<div class="modulo_6 my-2 my-md-0 <?php echo $class; ?> box-container <?php echo get_sub_field('background_color'); ?>">
    <div class="row equal">

        <?php if(!empty(get_sub_field('titolo'))): ?>
            <h1 class="col-12 mt-3"><?php echo get_sub_field('titolo') ?></h1>
        <?php endif; ?>

        <?php if ( have_rows('ripetitore') ) : ?>
            <?php $delay = 0; ?>
            <?php while(have_rows('ripetitore')): the_row();?>
                <!-- Se c'è il link funziona per tutti -->
                <!-- PARTNER -->
                <?php if(get_sub_field('background_type') == 'partner'): ?>

                    <div class="box col-6 col-lg-4 py-5 animate"

                    data-aos="fade-up"
                    data-aos-delay="<?php echo $delay ?>"
                    data-aos-duration="500"
                    data-aos-easing="ease-in-out"

                    >
                        <a href="<?php echo get_sub_field('url') ?>" target="_blank">
                            <img src="<?php echo get_sub_field('background_image'); ?>" class="img-fluid" />
                        </a>
                    </div>

                <!-- BOX CON TESTO -->
                <?php elseif(get_sub_field('background_type') == 'immagine'): ?>

                    <div class="box col-lg-4 image my-3 my-lg-5 <?php echo get_sub_field('posizione_testo') ?>  animate"
                    data-aos="fade-up"
                    data-aos-delay="<?php echo $delay ?>"
                    data-aos-duration="500"
                    data-aos-easing="ease-in-out">

                        <div class="box-inner p-5" style="background-image:url('<?php echo get_sub_field('background_image') ?>');background-size: cover;background-position: center center;">
                            <a href="<?php echo get_sub_field('url') ?>" target="_blank">
                                <h2><?php echo get_sub_field('titolo_card'); ?></h2>
                                <?php echo get_sub_field('body'); ?>
                            </a>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="box col-lg-4 my-3 my-lg-5 animate"
                    data-aos="fade-up"
                    data-aos-delay="<?php echo $delay ?>"
                    data-aos-duration="500"
                    data-aos-easing="ease-in-out"
                    >
                        <div class="box-inner p-5 <?php echo get_sub_field('posizione_testo') ?> <?php echo get_sub_field('background_type'); ?>">
                            <a href="<?php echo get_sub_field('url') ?>" target="_blank">
                                <h2><?php echo get_sub_field('titolo_card'); ?></h2>
                                <?php echo get_sub_field('body'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $delay = $delay+300; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
