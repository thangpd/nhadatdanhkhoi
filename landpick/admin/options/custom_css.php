<?php
function landpick_custom_css( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'custom_css',
            'label' => __( 'Custom css', 'landpick' ),
            'desc' => '',
            'std' => '',
            'type' => 'css',
            'section' => 'custom_css',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'landpick_custom_css', $options );
}
?>