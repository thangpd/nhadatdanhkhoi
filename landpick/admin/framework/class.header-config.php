<?php
defined( 'ABSPATH' ) || exit;
/**
* Landpick config
*/
class Landpick_Header_Config extends Landpick{

	function __construct(){	
		add_filter('landpick_wrapper_class', array( $this, 'predefined_wrapper_class' ), 10, 2 );		
	}

	/*
	* predefined_layout class
	* @return array
	*/
	public static function predefined_wrapper_class($classes, $class){	
		if(LandpickHeader::header_banner_is_on()){
			$classes[] = 'header-banner-on';
		}
		
		return $classes;
	}

	/*
	* Get logo type
	* @return    string
	*/
	public static function logo_type(){
		$opt_name = 'logo_type';
		$default = 'image';

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/logo_type', $output );

		return $output;
	}	

	/*
	* logo text
	* @param     string
	* @return    html
	*/
	private static function logo_text( $text = '' ){
		if( $text == '' ) return '';

		return $text;
	}

	/*
	* logo
	* @param     boolean
	* @return    url
	*/
	public static function logo( $dark ){
		$logo_type = self::logo_type();		
		$opt_name = ( $dark )? 'logo_white' : 'logo';
		$default = ( $dark )? LANDPICK_URI.'/images/logo-white.png' : LANDPICK_URI.'/images/logo.png';
		
		// image logo
		if( $logo_type == 'image' ):
			$logo = landpick_get_option( $opt_name );			
			$output = isset($logo[ 'url' ])? $logo[ 'url' ] : $default;		
		endif;

		// text logo
		$opt_name = 'logo_text';
		if( $logo_type == 'text' ):
			$logo = landpick_get_option( $opt_name, get_bloginfo( 'name' ));

			//Generate logo html
			//$logo = self::logo_text($logo);
			$output = $logo;		
		endif;

		$output = apply_filters( 'landpick/get_logo', $output, $logo_type, $dark );

		return $output;
	}	

	/*
	* logo type
	* @return string
	*/
	public static function get_logo_type(){
		return self::logo_type();
	}

	/*
	* logo type
	* @param boolean
	* @return Url
	*/
	public static function get_logo($dark = true){
		return self::logo($dark);
	}

	/*
	* navbar_style
	* @return    string
	*/
	private static function navbar_style(){
		$opt_name = 'navbar_style';
		$default = 'style1';

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/navbar_style', $output );
		return $output;
	}

	/*
	* Navbar style
	* @return string
	*/
	public static function get_navbar_style(){
		return self::navbar_style();
	}

	/*
	* Social Icons display
	* @return Boolean
	*/
	public static function header_search_icon_is_on(){
		$opt_name = 'header_search_display';
		$default = false;

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/header_search_display', $output );
		return $output;
	}

	/*
	* Social Icons display
	* @return Boolean
	*/
	public static function header_social_icons_is_on(){
		$opt_name = 'header_social_icons_display';
		$default = false;

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/header_social_icons_display', $output );
		return $output;
	}

	/*
	* Social Icons
	* @return array
	*/
	public static function header_social_icons(){
		$opt_name = 'header_social_icons';
		$default = array('facebook','twitter');

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/header_social_icons', $output );
		return $output;
	}

	/*
	* Social Icons
	* @return array()
	*/
	public static function _header_social_icons(){
		if(self::header_social_icons_is_on()){
			return self::header_social_icons();
		}else{
			return array();
		}		
	}

	/*
	* Social Icons html
	* @return array()
	*/
	public static function get_header_social_icons($args = array(), $output = ''){		
		$iconsArr = self::_header_social_icons();		
		if(empty($iconsArr)) return $output;
		
		$icon_list = landpick_default_social_links_callback();	
		$options = get_option('landpick_settings', array());
		if( !empty($options) ):			
		$icon_list = $options['social_links_group'];		
		endif;

		$iconsArr = array_filter($iconsArr);
		$array = array();
		if( !empty($iconsArr) ):			
			foreach ($iconsArr as $key => $value) {
				$array[] = isset($icon_list[$value])? $icon_list[$value] : array();
			}
		endif;
		$array = array_filter($array);

		$output = self::get_social_icons_html($array, $args);

		return $output;
	}

	/*
	* Buttons display
	* @return Boolean
	*/
	public static function header_buttons_is_on(){
		$opt_name = 'header_button_display';
		$default = false;

		$output = landpick_get_option( $opt_name, $default );

		$output = apply_filters( 'landpick/header_button_display', $output );

		return $output;
	}

	/*
	* Buttons
	* @return array
	*/
	public static function header_buttons(){
		$opt_name = 'header_buttons';
		$default = array('contact_us');

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/header_buttons', $output );		
		return $output;
	}

	/*
	* Buttons
	* @return array()
	*/
	public static function _header_buttons(){
		if(self::header_buttons_is_on()){
			return self::header_buttons();
		}else{
			return array();
		}		
	}

	/*
	* Buttons html
	* @return array()
	*/
	public static function get_header_buttons($args = array(), $output = ''){		
		
		$iconsArr = self::_header_buttons();
		if(empty($iconsArr)) return $output;

		$_array = landpick_default_buttons_set_callback();	
		$options = get_option('landpick_settings', array());
		if( !empty($options) ):			
		$_array = $options['buttons_group'];		
		endif;

		$iconsArr = array_filter($iconsArr);

		
		$array = array();
		foreach ($iconsArr as $key => $value) {
			$array[] = isset($_array[$value])? $_array[$value] : array();
		}
		$array = array_filter($array);
		$output = '<span>'.self::get_buttons_html($array).'</span>';

		return $output;
	}
	
	
}
new Landpick_Header_Config();