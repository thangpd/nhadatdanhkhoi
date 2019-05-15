<?php
function landpick_vc_section_type_options(){
    $array = array(
        '' => 'None',
        'hero' => 'Hero section', 
        'features' => 'Features section', 
        'content' => 'Content section', 
        'video' => 'Video section', 
        'reviews' => 'Reviews section', 
        'brands' => 'Brands section', 
        'pricing' => 'Pricing section', 
        'download' => 'Download section', 
        'faqs' => 'Faqs section', 
        'contacts' => 'Contacts section', 
        'footer' => 'Footer section', 
    );
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = $key;
    }
    return $new_arr;
}

function landpick_vc_section_class_options(){
    $array = array(
        'None' => '',
        'Hero content' => 'hero-content',
    );

    return $array;
}

add_action( 'vc_after_init', 'landpick_vc_section_settings' );
function landpick_vc_section_settings($return = 0) {

    
    $newParamData = array( 
        array(
            'type' => 'el_id',
            'heading' => __( 'Section ID', 'landpick' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landpick' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            'group' => 'Landpick Settings',
            'edit_field_class' => 'vc_col-sm-8',
            'weight' => 130
        ),  
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'landpick' ),
            'param_name' => 'el_class',
            'description' => __( 'Use this field to add a class name, refer to it in your css file. E.g: white-color', 'landpick' ),
            'group' => 'Landpick Settings',
            'weight' => 125,
            'edit_field_class' => 'vc_col-sm-4',
        ),    
        array(
            'group' => 'Landpick Settings',
            'type' => 'dropdown',
            'heading' => __( 'Section stretch', 'landpick' ),
            'param_name' => 'full_width',
            'weight' => 120,
            'value' => array(
                 __( 'Default', 'landpick' ) => 'container',
                __( 'Stretch section', 'landpick' ) => 'container-wide' 
            ),
            'description' => __( 'Select stretching options for section and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'landpick' ),
            'edit_field_class' => 'vc_col-sm-8',             
        ), 
        array(
            'type' => 'checkbox',
            'param_name' => 'enable_inner',
            'description' => __( 'Checked to setup section inner bg. You can change image in Design options', 'landpick' ),
            'value' => array( __( 'Enable section inner', 'landpick' ) => 'yes' ), 
            'group' => 'Landpick Settings',
            'edit_field_class' => 'vc_col-sm-4',
            'weight' => 119,
        ),       
        array(
            'group' => 'Landpick Settings',
            'type' => 'dropdown',
            'weight' => 118,
            'heading' => __( 'Pre-defined Section type', 'landpick' ),
            'param_name' => 'section_type',
            'value' => landpick_vc_section_type_options(),
            'std' => '',
            'description' => __( 'Predefined section setup section spacing, background image etc.', 'landpick' ),
            'edit_field_class' => 'vc_col-sm-8', 
        ),
        landpick_vc_section_type_params('hero_type', 'Hero style', 18, 'hero'),        
        landpick_vc_section_type_params('features_type', 'Features style', 6, 'features'),        
        landpick_vc_section_type_params('content_type', 'Content style', 10, 'content'),        
        landpick_vc_section_type_params('video_type', 'Video style', 3, 'video'),        
        landpick_vc_section_type_params('reviews_type', 'Reviews style', 3, 'reviews'),        
        landpick_vc_section_type_params('brands_type', 'Brands style', 2, 'brands'),        
        landpick_vc_section_type_params('pricing_type', 'Pricing style', 2, 'pricing'),        
        landpick_vc_section_type_params('download_type', 'Download style', 3, 'download'),        
        landpick_vc_section_type_params('faqs_type', 'Faqs style', 1, 'faqs'),        
        landpick_vc_section_type_params('contacts_type', 'Contacts style', 6, 'contacts'), 
        landpick_vc_section_type_params('footer_type', 'Footer style', 4, 'footer'),
        array(
            'type' => 'el_id',
            'heading' => __( 'Section inner ID', 'landpick' ),
            'param_name' => 'inner_el_id',
            'description' => sprintf( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landpick' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            'group' => 'Section inner settings',
            'edit_field_class' => 'vc_col-sm-6', 
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )           
        ),  
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class for section inner', 'landpick' ),
            'param_name' => 'inner_el_class',
            'description' => __( 'Use this field to add a class name, refer to it in your css file. E.g: white-color', 'landpick' ),
            'group' => 'Section inner settings',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ), 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Background', 'landpick' ),
            'param_name' => 'inner_bg_class',
            'group' => 'Section inner settings',
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
            'group' => 'Section inner settings',
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
            'group' => 'Section inner settings',
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
            'group' => 'Section inner settings',
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
            'group' => 'Section inner settings',
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
            'group' => 'Section inner settings',
            'value' => landpick_vc_spacing_options('margin', 'bottom'),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'enable_inner',
                'value' => 'yes'
            )
        ), 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Section Background', 'landpick' ),
            'param_name' => 'bg_class',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_background_options(),
            'std' => 'bg-white',
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
            'heading' => __( 'Section wide', 'landpick' ),
            'param_name' => 'padding_class',
            'group' => 'Landpick Settings',
            'value' => landpick_vc_padding_options(),
            'std'  => 'wide-60',
            'description' => __( 'Section top & bottom padding', 'landpick' ),          
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
            'heading' => __( 'Parallax', 'landpick' ),
            'param_name' => 'parallax',
            'std' => '',
            'weight' => 1,
            'value' => array(
                __( 'None', 'landpick' ) => '',
                __( 'Simple', 'landpick' ) => 'content-moving',
                __( 'With fade', 'landpick' ) => 'content-moving-fade',
            ),
            'description' => __( 'Add parallax type background for section (Note: If no image is specified, parallax will use background image from Design Options).', 'landpick' ),
            'dependency' => array(
                'element' => 'video_bg',
                'is_empty' => true,
            ),
        ),       
        array(
             'type' => 'image_upload',
            'heading' => __( 'Image', 'landpick' ),
            'param_name' => 'parallax_image',
            'weight' => 119,
            'value' => LANDPICK_URI . '/images/banner-1.jpg',
            'description' => __( 'Select image from media library.', 'landpick' ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
            'group' => 'Parallax Settings',
            'type' => 'textfield',
            'heading' => __( 'Parallax background image opacity', 'landpick' ),
            'param_name' => 'parallax_image_opacity',
            'value' => '1',      
            'description' => __( 'Maximum value 1', 'landpick' ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ),
            'edit_field_class' => 'vc_col-sm-6',  
        ),
        array(
             'group' => 'Parallax Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax width', 'landpick' ),
            'param_name' => 'parallax_width',
            'std' => '100%',
            'value' => array(
                 '100%' => '100%',
                '75%' => '75%',
                '50%' => '50%',
                '25%' => '25%' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ),
            'edit_field_class' => 'vc_col-sm-6',  
        ),
        array(
             'group' => 'Parallax Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image size', 'landpick' ),
            'param_name' => 'parallax_image_size',
            'std' => 'cover',
            'value' => array(
                 'Cover' => 'cover',
                'Contain' => 'contain',
                'Auto' => 'auto',
                '25% auto' => '25% auto',
                '50% auto' => '50% auto',
                'auto 50%' => 'auto 50%',
                'auto 25%' => 'auto 25%' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) ,
            'edit_field_class' => 'vc_col-sm-6', 
        ),
        array(
             'group' => 'Parallax Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image repeat', 'landpick' ),
            'param_name' => 'parallax_image_repeat',
            'std' => 'cover',
            'value' => array(
                 'Default' => '',
                'No Repeat' => 'no-repeat',
                'Repeat' => 'repeat' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) ,
            'edit_field_class' => 'vc_col-sm-6', 
        ),
        array(
             'group' => 'Parallax Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image position', 'landpick' ),
            'param_name' => 'parallax_image_position',
            'std' => 'cover',
            'value' => array(
                 'Default' => '50% 0',
                'Center' => 'center',
                'Top center' => 'top center',
                'Bottom center' => 'bottom center',
                'Top left' => 'top left',
                'Bottom left' => 'bottom left',
                'Top right' => 'top right',
                'Bottom right' => 'bottom right' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ),
            'edit_field_class' => 'vc_col-sm-6',  
        ),
         
    );

    if( $return ) return $newParamData;

    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_section', $value );
    } //$newParamData as $key => $value 

   

    $settings = array (
        'show_settings_on_create' => true,
      'category' => __( 'Landpick', 'landpick' )
    );
    vc_map_update( 'vc_section', $settings ); 


}

