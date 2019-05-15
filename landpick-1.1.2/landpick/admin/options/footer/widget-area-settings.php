<?php
function landpick_widget_area_options( $metabox = false, $options = array() ){
	$options = array(
        array(
             'id' => 'footer_widget_area',
            'title' => __( 'Footer widget area Display','landpick' ),
            'desc' => '',
            'default' => true,
            'type' => 'switch',          
        ), 
        array(
            'id'            => 'footer_widget_area_column',
            'type'          => 'slider',
            'title'         => __( 'Footer widget area column', 'landpick' ),
            'desc'          => __( 'Min: 1, max: 4, step: 1, default value: 4', 'landpick' ),
            'default'       => 4,
            'min'           => 1,
            'step'          => 1,
            'max'           => 4,
            'resolution'    => 1,
            'display_value' => 'text',
            'required' => array('footer_widget_area','equals',true)
        ),          
        
	);
	

    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}