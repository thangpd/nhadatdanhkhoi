<?php
add_filter( 'rwmb_meta_boxes', 'landpick_register_post_format_meta_boxes' );
function landpick_register_post_format_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array (
		'title' => 'Post format',
		'id' => 'landpick_post_format',
		'post_types' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'style' => 'seamless',
		'fields' => array(			
			array (
				'id' => 'enable_video_popup',
				'type' => 'switch',
				'name' => 'Enable video popup',
				'label_description' => __('Display top of the post (Optional)', 'landpick'),				
				'size' => 80,				
			),
			/*array (
				'id' => 'oembed',
				'type' => 'oembed',
				'name' => 'Embed url',
				'label_description' => __('Leave blank to avoid this (Optional)', 'landpick'),
				'desc' => sprintf( __( 'Embed video from services like Youtube, Vimeo, or Hulu. You can find a list of supported oEmbed sites in the %1$s.', 'landpick' ), '<a href="http://codex.wordpress.org/Embeds" target="_blank">' . __( 'Wordpress Codex', 'landpick' ) .'</a>' ),
				'size' => 80,	
				'visible' => array(
					'when' => array(						
						array ('enable_video_popup','=', 0 ),
					),
					'relation' => 'and',
				),			
			),*/
			array (
				'id' => 'video_link',
				'type' => 'text',
				'name' => 'Video link',
				'std' => array('https://www.youtube.com/embed/SZEflIVnhH8'),
				'label_description' => __('Display popup video link on featured image', 'landpick'),				
				'size' => 80,	
				'desc' => 'Example: https://www.youtube.com/embed/SZEflIVnhH8',
				'visible' => array(
					'when' => array(						
						array ('enable_video_popup','=', 1 ),
					),
					'relation' => 'and',
				),			
			),
		),		
	);
	return $meta_boxes;
}

add_filter( 'rwmb_oembed_not_available_string',  'landpick_oembed_not_available_string');
function landpick_oembed_not_available_string( $message ) {
    $message = __('Sorry, what you are looking here is not available.', 'landpick');
    return $message;
}
