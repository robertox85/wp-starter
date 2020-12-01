<?php if (get_row_layout() == 'modulo_7bis'): ?>
<?php 
$row = get_row(true);
$items = $row['ripetitore'];
?>
<div class="modulo modulo-7 my-2 my-md-0">

<?php if (!empty($items)): ?>
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $i = 0; ?>
            <?php foreach ($items as $item): ?>
                <?php $active = ($i == 0) ? 'active':''; ?>
                <div class="carousel-item <?php echo $active; ?>" style="background-image:url('<?php echo $item['background_image']['url'] ?> ')">
                    <div class="carousel-caption">
                        <h2 class="color-standard--white"><?php echo $item['titolo'] ?></h2>
                        <p class="color-standard--white"><?php  echo $item['caption'] ?></p>
                        <a href="#" class="button button-standard--white"><?php echo $item['cta_label'] ?></a>
                    </div>
                </div>
                <?php $i++; ?>
	        <?php endforeach;?>
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