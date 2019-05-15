<?php
function landpick_background_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'container_width',
            'label' => __( 'Container width', 'landpick' ),
            'desc' => '',
            'std' => array( '1140',  'px' ),
            'type' => 'measurement',
            'section' => 'background_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '320,2000,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and',
            'action' => array( ) 
        ),
        array(
             'id' => 'body_background',
            'label' => __( 'Body background', 'landpick' ),
            'desc' => '',
            'std' => '',
            'type' => 'background',
            'section' => 'background_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'operator' => 'and',
            'action' => array( ) 
        ),
        array(
             'id' => 'title_display',
            'label' => __( 'Banner display', 'landpick' ),
            'desc' => __('You can edit banner option from each page.', 'landpick'),
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'background_options',
        ),
        array(
             'id' => 'header_bg_img',
            'label' => __( 'Header Default background image', 'landpick' ),
            'desc' => '',
            'std' => LandpickHeader::get_default_header_image(),
            'type' => 'upload',
            'section' => 'background_options',
            'condition' => '',
            'operator' => 'and' 
        ), 
        array(
            'id'          => 'breadcrumbs_overlay_type',
            'label'       => __( 'Breadcrumbs overlay type', 'landpick' ),
            'std'         => apply_filters( 'landpick_breadcrumbs_overlay_type', 'light'),
            'type'        => 'radio',
            'section'     => 'background_options',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'light',
                'label'       => __( 'Light', 'landpick' ),
              ),
              array(
                'value'       => 'dark',
                'label'       => __( 'Dark', 'landpick' ),
              ),
              array(
                'value'       => 'theme',
                'label'       => __( 'Preset color', 'landpick' ),
              ),
            )
        ), 
        array(
             'id' => 'overlay_opacity',
            'label' => __( 'Breadcrumbs overlay opacity', 'landpick' ),
            'desc' => '',
            'std' => '0',
            'type' => 'numeric-slider',
            'section' => 'background_options',
            'min_max_step' => '0,100,1',
            'condition' => '',
            'operator' => 'and' 
        ),
    );
    return apply_filters( 'landpick_theme_options', $options, 'background_options' );
}
?>