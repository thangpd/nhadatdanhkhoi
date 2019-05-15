<?php
add_filter( 'perch_modules/vc/perch_content_text', 'landpick_vc_content_text_default_args' );
function landpick_vc_content_text_default_args( $args ){
	$default = array(
        'name' => 'Welcome to Landpick', 
        'name_font_container' => 'tag:span|extra_class:section-id',        
        'title' => 'High Converting Landing Page', 
        'title_font_container' => 'tag:h3|size:xl',
        'subtitle' => 'Semper lacus cursus porta, feugiat primis in ultrice ligula tempus auctor ipsum and mauris lectus enim ipsum enim gravida purus pretium ligula ',
        'subtitle_font_container' => 'tag:p|size:md',
        'enable_content' => 'yes',
        'periodic_animation' => 'yes',
        'animation_interval' => '100',
        'el_class' => 'content-txt',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}
