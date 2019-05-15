<?php
function landpick_styling_options( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'primary_color',
            'label' => __( 'Preset color', 'landpick' ),
            'desc' => '',
            'std' => landpick_primary_color(),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'primary_color_2',
            'label' => __( 'Preset color dark', 'landpick' ),
            'desc' => '',
            'std' => apply_filters( 'landpick_primary_color_2_default', '#389bf2'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'secondary_color',
            'label' => __( 'Dark color', 'landpick' ),
            'desc' => '',
            'std' => apply_filters( 'landpick_dark_color_default', '#222'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'white_color_alt',
            'label' => __( 'Grey color', 'landpick' ),
            'desc' => '',
            'std' => apply_filters( 'landpick_grey_color_default', '#f0f0f0'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'landpick_theme_options', $options, 'styling_options' );
}
?>