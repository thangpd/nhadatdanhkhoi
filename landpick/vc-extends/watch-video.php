<?php
add_filter( 'perch_modules/vc/perch_watch_video', 'landpick_vc_watch_video_default_args' );
function landpick_vc_watch_video_default_args( $args ){
	$default = array(       
        'title_highlight_text_enable' => 'yes',
        'title_highlight_text' => 'text_underline:'         
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}