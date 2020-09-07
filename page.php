<?php get_header(); ?>

<div id="primary" class="content-area container">
	<main id="main" class="site-main row">
		<?php
		if ( have_posts() ) :
			?>
			<div class="col-12">
				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();

					the_content();

				endwhile; // End the loop.
				?>
			</div>
			<?php
		endif;
		?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<div id="flexible-content">
	<?php get_template_part( 'template-parts/content', 'flexible' ); ?>
</div>

<?php
get_footer();
