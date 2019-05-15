<?php
add_filter( 'perch_modules/vc/perch_list', 'landpick_vc_list_style_default_args' );
function landpick_vc_list_style_default_args( $args ){
	$default = array(
		'list_title' => 'Feature Integration',
		'list_title_font_container' => 'tag:h5|size:sm',
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}