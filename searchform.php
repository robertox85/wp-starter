
<form class="navbar--search form-inline " role="search" method="get" action=" <?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="form-control form-control--search" type="search" placeholder="<?php echo esc_attr_x( 'Scrivi e premi Invio &hellip;', 'placeholder', 'wp-starter' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<a class="button button--close" ><i class="fa fa-times color__primary"></i></a>
</form>
