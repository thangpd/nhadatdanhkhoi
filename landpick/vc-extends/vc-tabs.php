<?php
add_action( 'vc_after_init', 'landpick_vc_tta_tabs_settings' );
function landpick_vc_tta_tabs_settings( ) {
	$value = array(
			'type' => 'dropdown',
			'param_name' => 'style',
			'value' => array(
				'Landpick style1' => 'landpick',
				'Landpick style2' => 'landpick-style2',
				__( 'Classic', 'landpick' ) => 'classic',
				__( 'Modern', 'landpick' ) => 'modern',
				__( 'Flat', 'landpick' ) => 'flat',
				__( 'Outline', 'landpick' ) => 'outline',
			),
			'heading' => __( 'Style', 'landpick' ),
			'description' => __( 'Select tabs display style.', 'landpick' ),
		);
	vc_update_shortcode_param( 'vc_tta_tabs', $value );
}