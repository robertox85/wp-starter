<?php get_header(); ?>

<div id="primary" class="content-area container">
	<main id="main" class="site-main row">
		<div class="col-12">
		<?php

		// Start the Loop.
		while ( have_posts() ) :
			the_post();

			the_content();

			// todo:formatta template
			// If comments are open or we have at least one comment, load up the comment template.
			// if (comments_open() || get_comments_number()) {
			// comments_template();
			// }

		endwhile; // End the loop.
		?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
