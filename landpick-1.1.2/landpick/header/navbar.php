<header id="<?php landpick_header_id(); ?>" <?php landpick_header_class('navbar-style2'); ?>>
	<nav <?php landpick_navbar_class(); ?>>
		<div class="container">
			<?php
			/**
			 * Hook: landpick/header/logo.
			 * Default template file location: landpick/header
			 *
			 * @hooked landpick_header_logo - 10
			 */
			 do_action( 'landpick/header/logo' ); 
			?>

			<?php
			/**
			 * Hook: landpick/header/menu.
			 * Default template file location: landpick/header
			 *
			 * @hooked landpick_header_mobile_menu_icon - 10
			 * @hooked landpick_header_nav_menu - 15
			 */
			 do_action( 'landpick/header/menu' ); 
			?>

		</div><!-- End container -->
	</nav><!-- End navbar -->
</header><!-- End header -->
