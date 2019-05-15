<?php get_header(); ?>

	
		<?php get_template_part( 'template-parts/content', 'before' );	?>	

		<?php
		if ( have_posts() ) :

			 woocommerce_content(); 

		endif;
		?>

	<?php get_template_part( 'template-parts/content', 'after' );	?>

	<?php do_action('landpick/woocommerce/footer'); ?>
	 			

<?php get_footer(); ?>