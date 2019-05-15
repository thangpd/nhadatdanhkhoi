<?php
$cta_area_display = landpick_get_option( 'cta_area_display', false );
if( $cta_area_display && !is_page() ):

$cta_title = landpick_get_option( 'cta_title', 'Have a project in mind? Let\'s discuss' );	
$cta_title = sprintf( _x('%s', 'Footer CTA title', 'landpick'), $cta_title );
$sub = 'Donec vel sapien augue integer urna vel turpis cursus porta, mauris sed augue luctus dolor velna auctor congue tempus magna integer';
$newsletter_subtitle = landpick_get_option( 'cta_subtitle', $sub );
$newsletter_subtitle = sprintf( _x('%s', 'Footer CTA subtitle', 'landpick'), $newsletter_subtitle );
$button_text = landpick_get_option( 'cta_button_text', 'Let\'s Started' );
$button_text = sprintf( _x('%s', 'Footer CTA button text', 'landpick'), $button_text );
$button_link = landpick_get_option( 'cta_button_link', '#' );
?>
<section id="cta-4" class="bg-lightdark cta-section division">
	<div class="container white-color">
		<div class="row d-flex align-items-center">
			<div class="col-lg-8">
				<div class="cta-txt">					
					<h4 class="h4-lg"><?php echo landpick_parse_text($cta_title); ?></h4><!-- Title -->						
					<p class="p-md"><?php echo landpick_parse_text($newsletter_subtitle); ?></p><!-- Text -->
				</div>
			</div><!-- CALL TO ACTION TEXT -->
			
			<div class="col-lg-3 offset-lg-1">
				<div class="cta-btn text-right">
					<a href="<?php echo esc_url($button_link) ?>" class="btn btn-md btn-theme tra-hover"><?php echo esc_attr($button_text) ?></a>
				</div>
			</div><!-- CALL TO ACTION BUTTON -->	


		</div>	 <!-- End row -->
	</div>	   <!-- End container -->	
</section>
<?php endif; ?>