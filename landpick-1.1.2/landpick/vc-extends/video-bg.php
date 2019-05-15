<?php
add_filter( 'perch_modules/vc/perch_video_bg', 'landpick_vc_video_bg_default_args' );
function landpick_vc_video_bg_default_args( $args ){
	$default = array(
		'image' => LANDPICK_URI.'/images/video/video.jpg',              
        'mp4' => LANDPICK_URI.'/images/video/video.mp4', 
        'webm' => LANDPICK_URI.'/images/video/video.webm',
        'ogv' => LANDPICK_URI.'/images/video/video.webm',
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}