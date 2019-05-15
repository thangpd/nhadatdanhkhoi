<?php
function landpick_quick_contact_form_options( $metabox = false, $options = array() ){
	$old_options = array(		
        array(
             'id' => 'quickform_area',
            'label' => __( 'Quick contact form Display','landpick' ),
            'desc' => __( 'Display in bottom of page','landpick' ),
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'footer_options' 
        ),
        array(
             'id' => 'quickform_title',
            'label' => __( 'Contact form title', 'landpick' ),
            'std' => __( 'Quick Contact Form', 'landpick' ),
            'type' => 'text',
            'section' => 'footer_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'quickform_shortcode',
            'label' => __( 'Contact form shortcode', 'landpick' ),
            'std' => '',
            'desc' => __('Choose shortcode from Contact form 7.', 'landpick').' <a href="'.admin_url('admin.php?page=wpcf7').'" target="_blank">'.__('Click here', 'landpick').'</a>',
            'type' => 'text',
            'section' => 'footer_options',
            'operator' => 'and' 
        ),
	);

	// Filter for option tree to redux options
    $modyfied_option = apply_filters( 'landpick_theme_options', $old_options, 'footer_options' );
    $options = array_merge( $options, $modyfied_option );

    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}