<?php
add_action( 'vc_after_init', 'landpick_hero_image_shortcode_vc' );
function landpick_hero_image_shortcode_vc() {

	$args = array(
		'name' => __( 'Single Image', 'landpick' ),
		'base' => 'vc_single_image',
		'icon' => 'landpick-icon',
		'category' => __( 'Landpick', 'landpick' ),
		'description' => __( 'Simple image with CSS animation', 'landpick' ),
		'params' => array(			
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image source', 'landpick' ),
				'param_name' => 'source',
				'std' => 'external_link',
				'value' => array(
					__( 'Media library', 'landpick' ) => 'media_library',
					__( 'External link', 'landpick' ) => 'external_link',
					__( 'Featured Image', 'landpick' ) => 'featured_image',
				),
				'description' => __( 'Select image source.', 'landpick' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'landpick' ),
				'param_name' => 'image',
				'value' => '',
				'description' => __( 'Select image from media library.', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'media_library',
				),
				'admin_label' => true,
			),
			array(
				'type' => 'image_upload',
				'heading' => __( 'External link', 'landpick' ),
				'param_name' => 'custom_src',
				'value' => LANDPICK_URI. '/images/image-01.png',
				'description' => __( 'Select external link.', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image size', 'landpick' ),
				'param_name' => 'img_size',
				'std' => 'full',
				'value' => array_flip( landpick_get_image_sizes_Arr() ),
				'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'landpick' ),
				'param_name' => 'external_img_size',
				'value' => '',
				'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Caption', 'landpick' ),
				'param_name' => 'caption',
				'description' => __( 'Enter text for image caption.', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add caption?', 'landpick' ),
				'param_name' => 'add_caption',
				'description' => __( 'Add image caption.', 'landpick' ),
				'value' => array( __( 'Yes', 'landpick' ) => 'yes' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image alignment', 'landpick' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Left', 'landpick' ) => 'left',
					__( 'Right', 'landpick' ) => 'right',
					__( 'Center', 'landpick' ) => 'center',
				),
				'description' => __( 'Select image alignment.', 'landpick' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image style', 'landpick' ),
				'param_name' => 'style',
				'value' => getVcShared( 'single image styles' ),
				'description' => __( 'Select image display style.', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image style', 'landpick' ),
				'param_name' => 'external_style',
				'value' => getVcShared( 'single image external styles' ),
				'description' => __( 'Select image display style.', 'landpick' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Border color', 'landpick' ),
				'param_name' => 'border_color',
				'value' => getVcShared( 'colors' ),
				'std' => 'grey',
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'vc_box_border',
						'vc_box_border_circle',
						'vc_box_outline',
						'vc_box_outline_circle',
						'vc_box_border_circle_2',
						'vc_box_outline_circle_2',
					),
				),
				'description' => __( 'Border color.', 'landpick' ),
				'param_holder_class' => 'vc_colored-dropdown',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Border color', 'landpick' ),
				'param_name' => 'external_border_color',
				'value' => getVcShared( 'colors' ),
				'std' => 'grey',
				'dependency' => array(
					'element' => 'external_style',
					'value' => array(
						'vc_box_border',
						'vc_box_border_circle',
						'vc_box_outline',
						'vc_box_outline_circle',
					),
				),
				'description' => __( 'Border color.', 'landpick' ),
				'param_holder_class' => 'vc_colored-dropdown',
			),
			array(
                'type' => 'checkbox',
                'heading' => __( 'Force image to overflow container?', 'landpick' ),
                'param_name' => 'max_width',
                'description' => __( 'Checked to force image to overflow container.', 'landpick' ),
                'value' => array( __( 'Yes', 'landpick' ) => 'yes' ),  
                'admin_label' => true,
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display image as background image', 'landpick' ),
                'param_name' => 'image_as_bg',
                'description' => __( 'Checked to force image to overflow container.', 'landpick' ),
                'value' => array( __( 'Yes', 'landpick' ) => 'yes' ),  
                'admin_label' => true,
            ),
			array(
				'type' => 'dropdown',
				'heading' => __( 'On click action', 'landpick' ),
				'param_name' => 'onclick',
				'value' => array(
					__( 'None', 'landpick' ) => '',
					__( 'Link to large image', 'landpick' ) => 'img_link_large',
					__( 'Open prettyPhoto', 'landpick' ) => 'link_image',
					__( 'Open custom link', 'landpick' ) => 'custom_link',
					__( 'Zoom', 'landpick' ) => 'zoom',
					__( 'Video', 'landpick' ) => 'video',
				),
				'description' => __( 'Select action for click action.', 'landpick' ),
				'std' => '',
				'group' => __('On click action', 'landpick'),
			),
			array(
				'type' => 'href',
				'heading' => __( 'Video link', 'landpick' ),
				'param_name' => 'video_link',
				'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
				'description' => __( 'Enter URL if you want this image to have a popup video link', 'landpick' ),
				'dependency' => array(
					'element' => 'onclick',
					'value' => 'video',
				),
				'group' => __('On click action', 'landpick'),
			),
			array(
	             'type' => 'dropdown',
	            'heading' => __( 'Video icon color', 'landpick' ),
	            'param_name' => 'icon_class',	            
	            'value' => landpick_vc_global_color_options(),
	            'std' => 'theme',
	            'description' => '',
	            'dependency' => array(
					'element' => 'onclick',
					'value' => 'video',
				), 
				'group' => __('On click action', 'landpick'),
	        ),
			array(
				'type' => 'href',
				'heading' => __( 'Image link', 'landpick' ),
				'param_name' => 'link',
				'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'landpick' ),
				'dependency' => array(
					'element' => 'onclick',
					'value' => 'custom_link',
				),
				'group' => __('On click action', 'landpick'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Link Target', 'landpick' ),
				'param_name' => 'img_link_target',
				'value' => landpick_target_param_list(),
				'dependency' => array(
					'element' => 'onclick',
					'value' => array(
						'custom_link',
						'img_link_large',
					),
				),
				'group' => __('On click action', 'landpick'),
			),
			landpick_vc_animation_type(),
			array(
				'type' => 'el_id',
				'heading' => __( 'Element ID', 'landpick' ),
				'param_name' => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'landpick' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'landpick' ),
				'param_name' => 'el_class',
				'value' => '',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'landpick' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'landpick' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'landpick' ),
			),
			// backward compatibility. since 4.6
			array(
				'type' => 'hidden',
				'param_name' => 'img_link_large',
			),
		),
	);
	
	$newParamData = $args['params'];

 	foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_single_image', $value );
    } //$newParamData as $key => $value

    
}