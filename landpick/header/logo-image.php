<?php
$logo  = Landpick_Header_Config::get_logo(); 
$logo_white = Landpick_Header_Config::get_logo(false);
?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand logo-white" rel="home"><img src="<?php echo esc_url($logo); ?>" height="30" alt="<?php bloginfo( 'name' ); ?>"></a>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand logo-black" rel="home"><img src="<?php echo esc_url($logo_white); ?>" height="30" alt="<?php bloginfo( 'name' ); ?>"></a>