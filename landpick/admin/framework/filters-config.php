<?php
add_filter( 'landpick/nav_style_scroll', 'landpick_nav_style_scroll', 10, 1 );
add_filter( 'landpick/header_sticky_nav', 'landpick_header_sticky_nav', 10, 1 );
add_filter( 'landpick/nav_bg_class', 'landpick_nav_bg_class', 10, 1 );
add_filter( 'landpick/nav_bg_gradient', 'landpick_nav_bg_gradient', 10, 1 );
add_filter( 'landpick/nav_bg_gradient_type', 'landpick_nav_bg_gradient_type', 10, 1 );
add_filter( 'landpick/nav_bg_color', 'landpick_nav_bg_custom_color', 10, 1 );
add_filter( 'landpick/nav_bg_type', 'landpick_custom_nav_bg_type', 10, 1 );
add_filter( 'landpick/navbar_style', 'landpick_navbar_style', 10, 1 );
add_filter( 'landpick/logo_type', 'landpick_page_logo_type', 10, 1 );	
add_filter( 'landpick/get_logo', 'landpick_get_logo', 10, 3 );	
add_filter( 'landpick/header_search_display', 'landpick_header_search_display', 10, 1 );
add_filter( 'landpick/nav_search_placeholder', 'landpick_nav_search_placeholder', 10, 1 );	
add_filter( 'landpick/header_social_icons_display', 'landpick_header_social_icons_display', 10, 1 );	
add_filter( 'landpick/header_social_icons', 'landpick_header_social_icons', 10, 1 );	
add_filter( 'landpick/header_button_display', 'landpick_header_button_display', 10, 1 );	
add_filter( 'landpick/header_buttons', 'landpick_header_buttons', 10, 1 );	
add_filter( 'perch_modules/perch_buttons/color/options', 'landpick_button_scolor_options', 10, 1 );
		
/*footer*/	
add_filter( 'landpick/footer_bg_class', 'landpick_footer_bg_class', 10, 1 );
add_filter( 'landpick/footer_bg_gradient', 'landpick_footer_bg_gradient', 10, 1 );
add_filter( 'landpick/footer_bg_gradient_type', 'landpick_footer_bg_gradient_type', 10, 1 );
add_filter( 'landpick/footer_bg_color', 'landpick_footer_bg_custom_color', 10, 1 );
add_filter( 'landpick/custom_footer_bg_type', 'landpick_custom_footer_bg_type', 10, 1 );

function landpick_button_scolor_options($array){
	$new_array = landpick_redux_options(landpick_btn_style_options(false));
	return array_merge($array, $new_array);
}
function landpick_get_post_group_meta( $output, $group_id = '', $opt_name = '', $default = '' ){
	$output = $default;
	if($group_id == '') return $output;
	if($opt_name == '') return $output;

	if( function_exists('rwmb_meta')  ) {
		$meta = rwmb_meta( $group_id );		
		$output = !isset($meta[$opt_name])? false : $output;	
	}
		
	
	if( isset($meta[$opt_name]) && ($meta[$opt_name] != '') ){
		return $meta[$opt_name];
	}else{			
		return $output;
	}
}

function landpick_footer_bg_custom_color($output){
	$opt_name = 'footer_bg_color';
	$group_id = 'footer_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_footer_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_custom_footer_bg_type($output){
	$opt_name = 'footer_bg_type';
	$group_id = 'footer_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_footer_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_footer_bg_gradient_type($output){
	$opt_name = 'footer_bg_gradient_type';
	$group_id = 'footer_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_footer_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_footer_bg_gradient($output){
	$opt_name = 'footer_bg_gradient';
	$group_id = 'footer_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_footer_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_footer_bg_class($output){

	$opt_name = 'footer_bg_class';
	$group_id = 'footer_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_footer_settings')){		
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );		
	}			
	return $output;
}

function landpick_header_social_icons($output){
	$opt_name = 'header_social_icons';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );		
	}			
	return $output;
}

function landpick_header_social_icons_display($output){
	$opt_name = 'header_social_icons_display';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_header_button_display($output){
	$opt_name = 'header_button_display';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );		
	}			
	return $output;
}

function landpick_header_buttons($output){
	$opt_name = 'header_buttons';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );			
	}			
	return $output;
}

function landpick_header_search_display($output){
	$opt_name = 'header_search_display';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_nav_search_placeholder($output){
	$opt_name = 'nav_search_placeholder';
	$group_id = 'navbar_icon_settings';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_icon_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_nav_style_scroll($output){
	$opt_name = 'nav_style_scroll';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_header_sticky_nav($output){
	$opt_name = 'header_sticky_nav';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = false;
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}

	return $output;
}

function landpick_nav_bg_class($output){

	$opt_name = 'nav_bg_class';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){		
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_nav_bg_gradient($output){
	$opt_name = 'nav_bg_gradient';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_nav_bg_gradient_type($output){
	$opt_name = 'nav_bg_gradient_type';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_nav_bg_custom_color($output){
	$opt_name = 'nav_bg_color';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_custom_nav_bg_type($output){
	$opt_name = 'nav_bg_type';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_navbar_style($output){
	$opt_name = 'navbar_style';
	$group_id = 'navbar_settings_group';
	if(function_exists('rwmb_meta') && rwmb_meta('custom_nav_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_page_logo_type($output){
	$opt_name = 'logo_type';
	$group_id = 'logo_settings_group';

	if(function_exists('rwmb_meta') && rwmb_meta('custom_logo_settings')){
		$output = landpick_get_post_group_meta($output, $group_id, $opt_name );
	}			
	return $output;
}

function landpick_get_logo($output, $logo_type, $dark){
	$group_id = 'logo_settings_group';
	
	if(function_exists('rwmb_meta') && rwmb_meta('custom_logo_settings')):	

		$opt_name = ( $dark )? 'logo_white' : 'logo';
		if( $logo_type == 'image' ){
			$image_url = landpick_get_post_group_meta($output, $group_id, $opt_name);
			//$image = RWMB_Image_Field::file_info( $image_id, array( 'size' => 'full' ) );		

			$output = $image_url;
		}

		// text logo
		$opt_name = 'logo_text';
		if( $logo_type == 'text' ){
			$logo = landpick_get_post_group_meta($output, $group_id, $opt_name);
			$output = $logo;		
		}

	endif;

	return $output;
}


add_filter( 'perch_modules/vc_spacing_options_param', 'landpick_spacing_options_param', 10, 4 );
function landpick_spacing_options_param($arr, $type, $pos, $name ){
	$new_array = landpick_vc_spacing_options($type, $pos);
	$arr = array_merge($arr, $new_array);
	return $arr;
}