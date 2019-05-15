<?php get_header(); ?>

	
		<?php get_template_part( 'template-parts/content', 'before' );	?>

		<!-- HERO-15
		============================================= -->	
		<div id="error-page" class="error-page-section division mb-30">
			<div class="container">	
				<div class="row">

					<?php
					$title = landpick_get_option( '404_title', '404');
					?>
					<!-- HERO TEXT -->
					<div class="col-md-10 offset-md-1">
						<div class="hero-txt text-center">
								
							<!-- Image -->
							<img class="img-fluid mb-30" src="<?php echo LANDPICK_URI; ?>/images/404-error.jpg" alt="<?php echo esc_attr($title) ?>">

							<!-- Text -->
							<h4 class="h4-xl mb-30"><?php echo esc_html__('Oops! It looks like you are lost ...!', 'landpick'); ?></h4>

							<!-- Button -->
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-theme btn-lg btn-arrow">
								<span><?php echo esc_html__('Go Back To Home', 'landpick'); ?></span>
							</a>
							
						</div>
					</div>	<!-- END HERO TEXT -->
					

				</div>	  <!-- End row -->
			</div>	   <!-- End container --> 	
		</div>	<!-- END HERO-15 -->	


	<?php get_template_part( 'template-parts/content', 'after' );	?>
		 			

<?php get_footer(); ?>