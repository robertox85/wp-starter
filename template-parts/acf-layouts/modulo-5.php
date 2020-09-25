<div class="modulo_5 container my-2 my-md-0">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3"><?php echo get_sub_field('titolo'); ?>  </h1>
            <?php if (have_rows('gruppo')): ?>
                <?php while (have_rows('gruppo')): the_row();?>
                    <?php if(get_sub_field('checkbox') == 'mappa'): ?>
                        <?php echo stampa_mappa(get_sub_field('mappa'),'100%','600px') ?>
                    <?php endif; ?>

                    <?php if(get_sub_field('checkbox') == 'video'): ?>
                        <?php echo get_sub_field('video') ?>
                    <?php endif; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
