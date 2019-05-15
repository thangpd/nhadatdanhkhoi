<?php do_action( 'landpick_post_single_before' ); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php do_action( 'landpick_post_before' ); ?>	

	<?php do_action( 'landpick_post_single_content' ); ?>

	<?php do_action( 'landpick_post_after' ); ?>

</div>	<!-- END BLOG POST #post-<?php the_ID(); ?> -->

<?php do_action( 'landpick_post_single_after' ); ?>

