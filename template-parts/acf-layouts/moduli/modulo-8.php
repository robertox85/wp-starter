<?php if (get_row_layout() == 'modulo_8'): ?>
<div class="modulo modulo-8 container-fluid box-container position-relative py-3 py-md-0 my-2 my-md-0"  style="background-image:url(<?php echo get_sub_field('background_image'); ?>)">
    <div class="row container mx-auto px-0">
    <?php if (   !empty( get_sub_field('titolo')) || !empty( get_sub_field('sottotitolo'))  ): ?>
        <div class="col-12">
        
        <?php if (   !empty( get_sub_field('titolo'))   ): ?>
            <h2 class="mt-3"><?php echo get_sub_field('titolo'); ?></h2>
        <?php endif; ?>

        <?php if (   !empty( get_sub_field('sottotitolo'))  ): ?>
            <h3><?php echo get_sub_field('sottotitolo'); ?></h3>
        <?php endif; ?>
        
        </div>
    <?php endif; ?>

        <div class="col-md-6">
            <?php echo get_sub_field('colonna_1'); ?>
        </div>
        <div class="col-md-6">
            <?php echo get_sub_field('colonna_2'); ?>
        </div>
    </div>

</div>
<?php endif; ?>