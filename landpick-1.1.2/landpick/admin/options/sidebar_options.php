<?php
function landpick_sidebar_options( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'create_sidebar',
            'label' => __( 'Create Sidebar', 'landpick' ),
            'desc' => 'You must save after create sidebar, otherwise creared sidebar is not populated in Sidebar selection dropdown list.',
            'std' => '',
            'type' => 'list-item',
            'section' => 'sidebar_option',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'desc',
                    'label' => __( 'Description', 'landpick' ),
                    'desc' => __( '(optional)', 'landpick' ),
                    'std' => '',
                    'type' => 'text',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'min_max_step' => '',
                    'class' => '',
                    'condition' => '',
                    'operator' => 'and' 
                ) 
            ) 
        ),
    );
    return apply_filters( 'landpick_theme_options', $options, 'sidebar_options' );
}
?>