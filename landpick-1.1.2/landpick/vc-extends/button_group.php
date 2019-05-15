<?php
add_filter( 'perch_modules/vc/perch_button_group', 'landpick_vc_button_group_default_args' );
function landpick_vc_button_group_default_args( $args ){
	$default = array(       
        'subtitle' => '* Requires iOS 7.0 or higher',
        'subtitle_font_container' => 'tag:span|extra_class:os-version',         
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}