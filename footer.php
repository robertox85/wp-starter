<?php

/**
 * Footer
 *
 * Main footer file for the theme.
 *
 * @package    WordPress
 */

?>

</div> <!-- chiusura di #content -->

<!-- pre footer 1 -->
<?php if ( is_active_sidebar( 'pre_footer' ) ) : ?>
	<div id="pre_footer" class="container-fluid bg__primary--superlight">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row pre_footer--container">
						<?php dynamic_sidebar( 'pre_footer' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


<?php starter_get_footer_version(); ?>


<?php wp_footer(); ?>

</body>

</html>
