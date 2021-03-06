<?php
/**
 * Footer V-1.
 *
 * Versione 1 del footer.
 *
 * @package    WordPress
 */

?>
<footer id="v1" class="container-fluid bg-primary pt-48 pb-40">
	<div class="container px-0" id="footer-content">
		<div class="row">

			<!-- footer_widget_1 -->
			<?php if ( is_active_sidebar( 'footer_widget_1' ) ) : ?>
			<div id="footer_widget_1" class="col-xl-6">
				<?php dynamic_sidebar( 'footer_widget_1' ); ?>
			</div><!-- #primary-sidebar -->
			<?php endif; ?>

			<!-- footer_widget_2 -->
			<?php if ( is_active_sidebar( 'footer_widget_2' ) ) : ?>
			<div id="footer_widget_2" class="col-xl-6 row">
				<?php dynamic_sidebar( 'footer_widget_2' ); ?>
			</div><!-- #primary-sidebar -->
			<?php endif; ?>

		</div>
	</div>

	<!-- todo: sezione del customizer -->
	<div class="container px-0 pt-40" id="footer-info">
		<div class="row">
			<div class="col-12">

				<!-- footer_widget_2 -->
				<?php if ( is_active_sidebar( 'footer_widget_copy' ) ) : ?>
					
						<?php dynamic_sidebar( 'footer_widget_copy' ); ?>
					
				<?php endif; ?>
				
				<?php if ( get_theme_mod( 'starter_footer_copy_text' ) || get_theme_mod( 'starter_footer_copy_privacy_link' ) ) : ?>

				<p class="color-standard--white paragraph--small">

					<!-- copy. -->
					<?php if ( get_theme_mod( 'starter_footer_copy_text' ) ) : ?>
						<?php echo esc_html( get_theme_mod( 'starter_footer_copy_text' ) ); ?>
					<?php endif; ?>

					<!-- Privacy link -->
					<?php if ( get_theme_mod( 'starter_footer_copy_privacy_link' ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_theme_mod( 'starter_footer_copy_privacy_link' ) ) ); ?>"
						class="color-standard--white" target="_blank">Privacy Policy</a>
					<?php endif; ?>
				</p>

				<?php endif; ?>
			</div>
		</div>
	</div>

</footer>
