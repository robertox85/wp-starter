<?php
/**
 * Header V-1.
 *
 * Versione 1 dell'header.
 *
 * @package    WordPress
 */

?>
<header id="v1" class="masthead">
    <div class="masthead--container">

        <?php if ( get_theme_mod( 'starter_header_top_menu_activate' ) === 'yes' ) : ?>
        <?php
			$top_menu_container_class = ( get_theme_mod( 'starter_header_top_menu_container' ) === 'yes' ) ? 'container' : '';
			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location'  => 'social',
						'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'nav justify-content-end d-none d-xl-flex ' . $top_menu_container_class,
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'add_li_class'    => 'nav-item',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);
			} else {
				echo '<p class="container text-right"><small>Nessun menu assegnato</small></p>';
			}

			?>

        <?php endif; ?>

        <nav class="navbar main-navigation container-fluid navbar-expand-xl">
            <div class="container nav--inner">

                <a class="navbar-brand" href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>"
                    style="background-image:url(<?php echo esc_url( get_theme_mod( 'logo_default' ) ); ?>)">

                </a>

                <button class="hamburger hamburger--collapse navbar-toggler d-xl-none ml-auto" type="button"
                    data-toggle="collapse" data-target="#mainNavigation" aria-controls="mainNavigation"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>


                <div class="collapse navbar-collapse position-relative" id="mainNavigation">

                    <?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
								'container'       => false,
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'navbar-nav ml-xl-5 mr-auto order-2 order-xl-1',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'add_li_class'    => 'nav-item',
								'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
								'walker'          => new WP_Bootstrap_Navwalker(),
							)
						);
					} else {
						echo '<p class="container text-center"><small>Nessun menu assegnato</small></p>';
					}

					?>

                    <div class="searchbox order-1 order-xl-2">
                        <?php get_search_form(); ?>
                        <div class="button--search-container">
                            <a class="button button--search"><i class="fa fa-search color-primary"></i></a>
                        </div>
                    </div>


                </div>


            </div>

        </nav>
    </div>
</header>