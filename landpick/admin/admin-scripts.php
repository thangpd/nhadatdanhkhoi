<?php
// Register Style
function landpick_iconpicker_styles() {
    wp_register_style( 'fontawesome', LANDPICK_URI. '/css/fontawesome.css', false, '5.0.0', 'all' );    
    wp_register_style( 'flaticon', LANDPICK_URI. '/css/flaticon.css', false, '1.1' );
    wp_register_style( 'tonicons', LANDPICK_URI. '/css/tonicons.css', false, '1.0' );
}

// Hook into the 'admin_enqueue_scripts' action
add_action( 'init', 'landpick_iconpicker_styles' );


// Register Style
function landpick_admin_styles( ) {
    wp_enqueue_style( 'landpick-admin-style', LANDPICK_URI . '/admin/assets/css/style.css', false, '1.0.0', 'all' );
    wp_enqueue_style( 'landpick-vc-admin', LANDPICK_URI . '/admin/assets/css/vc-admin.css', false, '1.0.0', 'all' );   
    wp_enqueue_style( 'tonicons' );
    wp_enqueue_style( 'flaticon' );
	wp_enqueue_style( 'fontawesome' );
    wp_add_inline_style( 'landpick-admin-style', landpick_dynamic_general_style_css() ); 

}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'landpick_admin_styles' );
// Register Script
function landpick_admin_scripts( ) {
    wp_enqueue_media();
    wp_enqueue_script( 'v4-shims', LANDPICK_URI .'/js/fa-v4-shims.min.js', array( 'jquery' ), '1.0.0', true );
   
    wp_register_script( 'landpick-scripts', LANDPICK_URI . '/admin/assets/js/scripts.js', array(
         'jquery' 
    ), '1.0.0.8', false );
    wp_enqueue_script( 'landpick-scripts' );

    $arr = array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'LANDPICK_URI' => LANDPICK_URI,
        'LANDPICK_DIR' => LANDPICK_DIR,
        'animation' => landpick_get_option( 'landpick_animation', 'on' ),
        'vc_preview' => landpick_get_option('vc_admin_view', 'full')
        );
    wp_localize_script( 'landpick-scripts', 'LANDPICK', $arr );
}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'landpick_admin_scripts' );

function landpick_admin_editor_dynamic_css() {    
    wp_add_inline_style( 'landpick-admin-bootstrap', landpick_dynamic_general_style_css() );  
}
add_action( 'admin_enqueue_scripts', 'landpick_admin_editor_dynamic_css' );