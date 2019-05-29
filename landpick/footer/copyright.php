<?php
if( Landpick_Footer_Config::copyright_bar_is_on() ):
	$copyright_text = landpick_get_option( 'copyright_text', '&copy; ' . date( 'Y' ).' <span>Landpick.</span> All Rights Reserved' );
	$copyright_text = sprintf( _x('%s', 'Copyright text', 'landpick'), $copyright_text );
	?>

	<div class="bottom-footer pt-50 pb-50 mt-0">
		<div class="row">
			<div class="col-md-12">
				<div class="footer-copyright">
					<?php echo do_shortcode($copyright_text); ?>
				</div><!-- END FOOTER COPYRIGHT -->
			</div>
		</div>
	</div><!-- END FOOTER bottom -->
<?php endif; ?>