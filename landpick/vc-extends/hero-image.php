<?php
add_filter( 'perch_modules/vc/perch_hero_image', 'landpick_vc_hero_image_default_args' );
function landpick_vc_hero_image_default_args( $args ){
	$default = array(
		'source' => 'external_link',              
        'custom_src' => LANDPICK_URI. '/images/hero-1-img.png', 
        'onclick' => 'custom_link', 
        'img_link_target' => '_blank',         
        'el_class' => 'hero-img',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}