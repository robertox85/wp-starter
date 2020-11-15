<?php if (get_row_layout() == 'modulo_7'): ?>
<div class="modulo-7 my-2 my-md-0">

<?php if (have_rows('ripetitore')): ?>
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
            $i = 0;

            ?>
            <?php while (have_rows('ripetitore')): the_row();?>
                <?php $active = ($i == 0) ? 'active':''; ?>
                <div class="carousel-item <?php echo $active; ?>" style="background-image:url('<?php echo get_sub_field('background_image') ?> ')">

                </div>
                <?php $i++; ?>
	    <?php endwhile;?>
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php endif; ?>



</div>
<?php endif; ?>