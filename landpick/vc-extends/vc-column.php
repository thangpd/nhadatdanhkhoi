<?php
add_action( 'vc_after_init', 'landpick_vc_column_settings' );
function landpick_vc_column_settings() {
    $newParamData = array( 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Predefined Column class', 'landpick' ),
            'param_name' => 'column_inner_style',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_column_class_options(),
            'std' => '',
            'description' => '',            
        ), 
        landpick_vc_column_type_params('hero_type', 'Hero style', 12, 'hero-img'), 
        landpick_vc_column_type_params('hero_txt_type', 'Hero style', 12, 'hero-txt'), 
        landpick_vc_column_type_params('content_img_type', 'Content style', 12, 'content-img'), 
        landpick_vc_column_type_params('content_txt_type', 'Content style', 12, 'content-txt'), 
        landpick_vc_column_type_params('download_img_type', 'Download style', 12, 'download-img'), 
        array(
             'group' => 'Landpick Settings',
            'type' => 'dropdown',
            'heading' => __( 'Border color', 'landpick' ),
            'param_name' => 'rounded_color',
            'std' => 'theme',
            'value' => landpick_vc_color_options(true),
            'dependency' => array(
                'element' => 'column_inner_style',
                'value' => 'box-rounded',
            )
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Column Background', 'landpick' ),
            'param_name' => 'column_bg_class',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_background_options(),
            'std' => 'bg-tra',
            'description' => '' 
        )
         
    );
    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_column', $value );
        vc_update_shortcode_param( 'vc_column_inner', $value );
    }     

    
}

