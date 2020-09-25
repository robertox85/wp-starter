<div class="modulo_3 container-fluid box-container py-md-5 mt-5 mt-md-0">
    <div class="row no-gutters">
        <div style="z-index: 999999;" class="col-lg-4 box-1 p-3 p-md-5
        animate"
        data-aos="fade-right"
        data-aos-delay="300"
        data-aos-duration="500"
        data-aos-easing="ease-in-out"

        >
             <?php if ( have_rows('colonna_1') ) : ?>
                 <?php while(have_rows('colonna_1')): the_row();?>
                     <p><?php echo get_sub_field('body'); ?></p>
                    <?php
                        if (have_rows('cta')) {
                            while (have_rows('cta')) {
                                the_row();
                                if(!empty(get_sub_field('url'))){
                                ?>
                                <a class="cta text-uppercase mt-5 ml-0 apply_cta" href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('label'); ?></a>
                                <?php
                                }
                            }
                        }
                    ?>
                 <?php endwhile; ?>
             <?php endif; ?>
         </div>
        <div class="col-lg-4 box-2 p-3 p-md-5">
             <?php if ( have_rows('colonna_2') ) : ?>
                <div>
                    <?php while(have_rows('colonna_2')): the_row();?>
                        <p><?php echo get_sub_field('body'); ?></p>
                    <?php endwhile; ?>
                </div>
             <?php endif; ?>
         </div>
        <div class="col-lg-4 box-3 p-3 p-md-5">
             <?php if ( have_rows('colonna_3') ) : ?>
                <div>
                    <?php while(have_rows('colonna_3')): the_row();?>
                        <p><?php echo get_sub_field('body'); ?></p>
                    <?php endwhile; ?>
                </div>
             <?php endif; ?>
         </div>
        <a href="#" class="d-block d-lg-none read-more" >Read <span>More</span> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
     </div>
 </div>
