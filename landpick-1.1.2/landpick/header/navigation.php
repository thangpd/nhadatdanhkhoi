<div id="navbarSupportedContent" class="collapse navbar-collapse">	

	<?php do_action( 'landpick/header/menu/before' ); ?>

	<?php 
      $args = array(
        'container'       => '',		        
        'menu_class'      => '',
        'theme_location'  => 'primary',
        'depth'           => 2,
        'walker'          => new Landpick_Walker_Menu(),
        'fallback_cb'     => 'Landpick_Walker_Menu::fallback',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      );
      $args = apply_filters( 'landpick_navbar_style_args', $args );
      wp_nav_menu( $args );
    ?>

  	<?php do_action( 'landpick/header/menu/after' ); ?>

    <?php
    ?>

</div>	<!-- End Navigation Menu -->