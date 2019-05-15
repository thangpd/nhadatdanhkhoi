<?php
function landpick_child_enqueue_styles() {
    //wp_dequeue_style( 'landpick-google-fonts' );
    $parent_style = 'landpick-style';
    $dependency = array('bootstrap', 'landpick-default-style');   

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', $dependency );
    wp_enqueue_style( 'landpick-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );   
}
add_action( 'wp_enqueue_scripts', 'landpick_child_enqueue_styles' );