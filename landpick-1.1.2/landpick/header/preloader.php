<?php 
$preloader_display = landpick_get_option( 'preloader_display', 'default' );
if( $preloader_display != 'none' ):
	$custom_preloader = landpick_get_option( 'custom_preloader', array( 'url' => LANDPICK_URI . '/images/preloader.png') );
?>

<!-- PRELOADER SPINNER -->
<div id="loader-wrapper">
	<?php if( $preloader_display == 'default' ): ?>
	<div id="loader">
		<div class="cssload-spinner">
			<div class="cssload-ball cssload-ball-1"></div>
			<div class="cssload-ball cssload-ball-2"></div>
			<div class="cssload-ball cssload-ball-3"></div>
			<div class="cssload-ball cssload-ball-4"></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if( $preloader_display == 'custom' ): ?>
		<div class="preloader-img text-center"><img src="<?php echo esc_url($custom_preloader['url']) ?>" alt="<?php echo esc_attr(apply_filters('landpick_vc_image_upload_alt', '')); ?>"></div>
	<?php endif; ?>
		
</div>
<?php endif; ?>