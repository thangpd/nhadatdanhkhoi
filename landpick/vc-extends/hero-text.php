<?php
add_filter( 'perch_modules/vc/perch_hero_text', 'landpick_vc_hero_text_default_args' );
function landpick_vc_hero_text_default_args( $args ){
	$default = array(
        'name' => '',
        'name_font_container' => 'tag:h2',        
        'title' => 'Powerful App for creative people & designers', 
        'title_font_container' => 'tag:h3|size:xl',
        'subtitle' => ' Feugiat primis ligula risus auctor laoreet augue egestas mauris viverra tortor in iaculis pretium magna, mauris rhoncus ipsum in placerat feugiat primis ultrice ',
        'subtitle_font_container' => 'tag:p|size:md',
        'periodic_animation' => 'yes',
        'el_class' => 'hero-txt',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}
