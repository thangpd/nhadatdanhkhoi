<?php do_action( 'landpick/breadcrumbs/before' ); ?>
<?php if(LandpickHeader::header_banner_is_on()): ?>
	<section id="<?php echo landpick_breadcrumbs_id(); ?>" <?php landpick_breadcrumbs_class(); ?>>
		<div class="container">	
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<div class="hero-txt text-center">
						<?php do_action( 'landpick/breadcrumbs/title/before' ); ?>
						<h2 class="h2-md"><?php echo LandpickHeader::get_title(); ?></h2><!-- Title -->
						<?php do_action( 'landpick/breadcrumbs/title/after' ); ?>
						<p class="p-hero subtitle">
							<?php echo LandpickHeader::get_subtitle(); ?>						
						</p><!-- Text -->	
						<?php do_action( 'landpick/breadcrumbs/subtitle/after' ); ?>
					</div><!-- End hero-txt -->
				</div>	<!-- End col-md-10 -->
			</div>	  <!-- End row -->
		</div>	   <!-- End container --> 	
		<div class="parallax-inner"></div>
	</section>	<!-- End breadcrumbs-area -->
<?php endif; ?>
<?php do_action( 'landpick/breadcrumbs/after' ); ?>