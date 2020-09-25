<div class="container-fluid my-2 my-md-0" style="background-image:url('<?php echo get_sub_field('background_image') ?>');background-size:cover;">
    <div class="module_9">
		<div class="body py-3 py-md-5">
		<?php if(!empty(get_sub_field('body'))): ?>
			<?php the_sub_field('body') ?>
		<?php endif;?>
		</div>

		<ul class="timeline container px-0 my-0">
			<?php if (have_rows('ripetitore')): ?>
				<?php $i = 0;?>
				<?php while (have_rows('ripetitore')): the_row();?>
					<?php $is_inverted = ($i % 2 == 1) ? 'timeline-inverted' : '';?>
					<?php $fade = ($i % 2 == 1) ? 'fade-left' : 'fade-right';?>
					<li class="<?php echo $is_inverted; ?>"

					class="animate"
                    data-aos="<?php echo $fade ?>"
                    data-aos-duration="500"
                    data-aos-easing="ease-in-out"

					>
						<!-- <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div> -->
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title"><?php echo get_sub_field('titolo') ?></h4>
							</div>
							<div class="timeline-body">
							<p><?php echo get_sub_field('body') ?></p>
							</div>
						</div>
					</li>
					<?php $i++;endwhile;?>
			<?php endif;?>
		</ul>
    </div>
</div>
