<?php
add_filter('perch_modules/perch_feature_box/name', 'landpick_service_box_name', 100);
function landpick_service_box_name(){	
	return esc_attr__( 'Service box', 'landpick' );
}

add_filter( 'perch_modules/vc/perch_feature_box', 'landpick_vc_feature_box_default_args' );
function landpick_vc_feature_box_default_args( $args ){
	$default = array(
		'display_as' => 'sbox-1',
		'icon_tonicons' => 'flaticon-080-shield',
		'icon_color' => 'grey-color',
		'title' => 'Concrete Security',
		'title_font_container' => 'tag:h5|size:sm',        
        'subtitle' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat dolor impedit felis magna dolor vitae ',
        'subtitle_font_container' => 'tag:p|text_color:grey-color',   
        'el_class' => 'sbox',      
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}


