<?php
function landpick_copyright_bar_options( $metabox = false, $options = array() ){
    $options = array(
        array(
             'id' => 'footer_copyright_bar',
            'title' =>  __( 'Footer copyright', 'landpick' ),
            'desc' => '',
            'default' => true,
            'type' => 'switch',          
        ), 
        array(
             'id' => 'copyright_text',
            'title' => __( 'Copyright Text', 'landpick' ),
            'desc' => '',
            'default' => '&copy; ' . date( 'Y' ).' <span>Landpick.</span> All Rights Reserved',
            'type' => 'editor',
            'args' => array('media_buttons' => false, 'teeny' => true, 'textarea_rows' => 2, 'wpautop' => false),
            'required' => array('footer_copyright_bar', '=', true),
        ),         
        
    );

    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}