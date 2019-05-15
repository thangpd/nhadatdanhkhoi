<?php
add_filter( 'perch_modules/vc/perch_counter_up', 'landpick_vc_counter_up_default_args', 30, 1 );
function landpick_vc_counter_up_default_args( $args ){
	$default = array(
		'icon_tonicons' => 'flaticon-032-coffee',
		'icon_color' => 'theme-color',
		'title' => 'Cups of Coffee',
        'counter_typo' => 'tag:h5|extra_class:statistic-number txt-700',
		'title_font_container' => 'tag:p|text_color:txt-500',        
        'subtitle' => '',
        'subtitle_font_container' => 'tag:p',  
        'el_class' => 'statistic-block box-icon'       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}