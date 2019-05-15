<?php
add_filter( 'perch_modules/vc/perch_press_logo', 'landpick_vc_press_logo_default_args' );
function landpick_vc_press_logo_default_args( $args ){
	$default = array(
		'source' => 'external_link',              
        'custom_src' => LANDPICK_URI. '/images/press-4.png', 
        'onclick' => 'custom_link', 
        'img_link_target' => '_blank',         
        'el_class' => 'press-logo',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}