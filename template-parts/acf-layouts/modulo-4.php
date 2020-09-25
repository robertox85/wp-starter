<div class="modulo_4 container-fluid py-5 my-2 my-md-0">
    <div id="accordianId" class="container px-0" role="tablist" aria-multiselectable="true">
        <?php if (have_rows('ripetitore')) : ?>
            <?php $i = 0;  ?>
            <?php while (have_rows('ripetitore')) : the_row(); ?>
                <div class="accordion">
                    <div class="accordion-header" role="tab" id="section<?php echo $i; ?>HeaderId">
                        <p class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordianId" href="#section<?php echo $i; ?>ContentId" aria-expanded="false" aria-controls="section<?php echo $i; ?>ContentId">
                                <?php echo get_sub_field('titolo') ?>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>

                        </p>
                    </div>
                    <div id="section<?php echo $i; ?>ContentId" class="collapse in" role="tabpanel" aria-labelledby="section<?php echo $i; ?>HeaderId">
                        <div class="accordion-body">
                            <?php echo get_sub_field('contenuto') ?>
                        </div>
                    </div>
                </div>
            <?php $i++;
            endwhile; ?>
        <?php endif; ?>
    </div>

</div>
