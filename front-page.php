<?php get_header(); ?>


<div id="flexible-content">
    <?php get_template_part( 'template-parts/content', 'flexible' ); ?>
</div>
<div id="primary" class="content-area container">
	<main id="main" class="site-main row">
		<?php if ( have_posts() ) : ?>
			<div class="col-12">
				<?php
				while ( have_posts() ) :
					the_post();

					the_content();
				endwhile;
				?>
            </div>
            
        <?php endif; ?>
        
		</div>
	</main><!-- #main -->
</div><!-- #primary -->



<?php
get_footer();
