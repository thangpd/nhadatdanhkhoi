<?php
if( Landpick_Footer_Config::newsletter_area_is_on() && !is_page() ):
$newsletter_title = landpick_get_option( 'newsletter_title', 'Subscribe to Landpick Update' );	
$newsletter_title = sprintf( _x('%s', 'Newsletter title', 'landpick'), $newsletter_title );
$newsletter_placeholder = landpick_get_option( 'newsletter_placeholder', 'Your email address' );
$placeholder = sprintf( _x('%s', 'Newsletter placeholder', 'landpick'), $newsletter_placeholder );
$sub = 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius';
$newsletter_subtitle = landpick_get_option( 'newsletter_subtitle', $sub );
$newsletter_footer = landpick_get_option( 'newsletter_footer', 'We don\'t share your personal information with anyone. Check out our 
						   <a href="#">Privacy Policy</a> for more information' );
?>
<section id="<?php landpick_newsletter_id(); ?>" <?php landpick_newsletter_class('footer-newsletter'); ?>>
	<div class="container">
		
		<div class="row">	
			<div class="col-md-12 text-center section-title">
				<h2 class="h2-xs"><?php echo landpick_parse_text($newsletter_title); ?></h2><!-- Title 	-->
				<p class="p-lg"><?php echo landpick_parse_text($newsletter_subtitle); ?></p><!-- Text -->
			</div>
		</div>	 <!-- END SECTION TITLE -->	
		
		<div class="row">
			<div class="offset-lg-2 col-lg-8">								
				<?php 
					if(class_exists('PerchNewsletter')){
						$args = array();
						$group = 'landpick';						

						$args['email'] = esc_attr($placeholder);								
						$args['button_style'] = '';						
						$args['es_group'] = esc_attr($group);
						$args['enable_name'] = false;
						$args['es_desc'] = '';
						$args['es_pre'] = '';
						$args['name'] = '';
						$args['el_class'] = 'newsletter-form newsletter-form-simple';
						$args['button_text'] = 'Get started';
						$args['form_button_style'] = 'btn-theme';
						$args['inline_form'] = 'yes';
						echo PerchNewsletter::es_get_form_horizontal($args);
					}else{
						echo 'Please Install Theme Required & Recommended PLugins.';
					}
					?>
				
				<p class="p-sm"><?php echo do_shortcode($newsletter_footer); ?></p><!-- Small Text -->
			</div>
		</div>	  <!-- END NEWSLETTER FORM -->

	</div>	   <!-- End container -->	
	<div class="parallax-inner"></div>
</section>
<?php 
endif; ?>
