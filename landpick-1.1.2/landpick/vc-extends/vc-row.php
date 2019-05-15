<?php
function landpick_vc_row_type_options(){
    $array = array(
        '' => 'None',
        'hero' => 'Hero row',
        'content' => 'Content row', 
        'reviews' => 'Reviews row',
    );
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = $key;
    }
    return $new_arr;
}

function landpick_vc_row_class_options(){
    $array = array(
        '' => 'None',
        'content-boxes' => 'Content box',
        'content-txt' => 'Content Text', 
        'hero-txt' => 'Hero Text',
        'hero-img' => 'Hero Image',
        'bg-inner' => 'Inner bg',
        'hero-content' => 'Hero content',
        'section-content' => 'Section content',
    );
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = $key;
    }
    return $new_arr;
}

add_action( 'vc_after_init', 'landpick_vc_row_settings' );
function landpick_vc_row_settings($return = 0) {
    $newParamData = array(
        array(
            'type' => 'el_id',
            'heading' => __( 'Row ID', 'landpick' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landpick' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            'group' => 'Landpick Settings',
            'edit_field_class' => 'vc_col-sm-8',
            'weight' => 123
        ),
        array(
            'type' => 'checkbox',
            'heading' => __( 'Enable outer row container?', 'landpick' ),
            'param_name' => 'enable_outer_container',          
            'value' => array( __( 'Checked to enable', 'landpick' ) => 'yes' ), 
            'group' => 'Landpick Settings',
            'edit_field_class' => 'vc_col-sm-4',
            'weight' => 122
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'landpick' ),
            'param_name' => 'full_width',
            'group' => 'Landpick Settings',
            'value' => array(
                __( 'Default', 'landpick' ) => '',
                __( 'Stretch row', 'landpick' ) => 'stretch_row',
                __( 'Stretch row and content', 'landpick' ) => 'stretch_row_content',
                __( 'Stretch row and content (no paddings)', 'landpick' ) => 'stretch_row_content_no_spaces',
            ),
            'description' => __( 'Select stretching options for row and content.', 'landpick' ),
          
        ),  
        array(
            'type' => 'checkbox',
            'heading' => __( 'Enable inner row container?', 'landpick' ),
            'param_name' => 'enable_inner',
            'description' => __( 'Checked to setup section inner bg. You can change image in Design options', 'landpick' ),
            'value' => array( __( 'Yes', 'landpick' ) => 'yes' ), 
            'group' => 'Landpick Settings',
            'dependency' => array(
                'element' => 'full_width',
                'value' => array('stretch_row', 'stretch_row_content')
            )
        ),
        array(
            'group' => 'Landpick Settings',
            'type' => 'dropdown',
            'heading' => __( 'Column style', 'landpick' ),
            'param_name' => 'column_style',
            'std' => '',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => array(
                 'Default' => '',
                'Border separated' => 'border-separated-column',
                'No spacing in column' => 'no-spacing-column',
            ),
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Predefined row class', 'landpick' ),
            'param_name' => 'row_class',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_row_class_options(),
            'std' => '',
            'description' => '',
            'edit_field_class' => 'vc_col-sm-6',
        ), 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Background', 'landpick' ),
            'param_name' => 'inner_bg_class',
            'group' => 'Row inner settings',
            'value' => landpick_vc_background_options(),
            'std' => 'bg-tra',
            'description' => '',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Section inner wide', 'landpick' ),
            'param_name' => 'inner_padding_class',
            'group' => 'Row inner settings',
            'value' => landpick_vc_padding_options(),
            'description' => __( 'Section top & bottom padding', 'landpick' ),  
            'edit_field_class' => 'vc_col-sm-6', 
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )       
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Padding top', 'landpick' ),
            'param_name' => 'inner_padding_top',
            'group' => 'Row inner settings',
            'value' => landpick_vc_spacing_options('padding', 'top'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Padding bottom', 'landpick' ),
            'param_name' => 'inner_padding_bottom',
            'group' => 'Row inner settings',
            'value' => landpick_vc_spacing_options('padding', 'bottom'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ),        
        
        array(
             'type' => 'dropdown',
            'heading' => __( 'Margin top', 'landpick' ),
            'param_name' => 'inner_margin_top',
            'group' => 'Row inner settings',
            'value' => landpick_vc_spacing_options('margin', 'top'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Margin bottom', 'landpick' ),
            'param_name' => 'inner_margin_bottom',
            'group' => 'Row inner settings',
            'value' => landpick_vc_spacing_options('margin', 'bottom'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ), 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Row Background color', 'landpick' ),
            'param_name' => 'bg_class',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_background_options(),
            'std' => 'bg-tra',
            'description' => '',
            'edit_field_class' => 'vc_col-sm-6',
        ),           
        array(
            'type' => 'dropdown',
            'group' => 'Landpick Settings',
            'heading' => __( 'Background attachment', 'landpick' ),
            'param_name' => 'parallax_image_attachment',
            'std' => 'cover',
            'value' => array(
                 'Default' => 'inherit',
                'Fixed' => 'fixed',
                'Scroll' => 'scroll',
                'Local' => 'local',
                'Unset' => 'inset' 
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Padding top', 'landpick' ),
            'param_name' => 'padding_top',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_spacing_options('padding', 'top'),
            'edit_field_class' => 'vc_col-sm-6',  
            'dependency' => array(
                'element' => 'padding_class',
                'value' => array('')
            )          
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Padding bottom', 'landpick' ),
            'param_name' => 'padding_bottom',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_spacing_options('padding', 'bottom'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'padding_class',
                'value' => array('')
            )            
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Margin top', 'landpick' ),
            'param_name' => 'margin_top',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_spacing_options('margin', 'top'),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Margin bottom', 'landpick' ),
            'param_name' => 'margin_bottom',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_spacing_options('margin', 'bottom'),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Content position', 'landpick' ),
            'param_name' => 'content_placement',
            'value' => array(
                __( 'Default', 'landpick' ) => '',
                __( 'Top', 'landpick' ) => 'top',
                __( 'Middle', 'landpick' ) => 'middle',
                __( 'Bottom', 'landpick' ) => 'bottom',
            ),
            'std' => 'middle',
            'description' => __( 'Select content position within columns.', 'landpick' ),
            'weight' => 100
        ),
        

         
    );

    if( $return ) return $newParamData;

    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_row', $value );
        vc_update_shortcode_param( 'vc_row_inner', $value );
    } 
    

    $settings = array (
    'show_settings_on_create' => true,
    'category' => __( 'Landpick', 'landpick' )
    );
    vc_map_update( 'vc_row_inner', $settings );
}

