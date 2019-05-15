<?php
defined( 'ABSPATH' ) || exit;
/**
* Landpick config
*/
class Landpick_Footer_Config extends Landpick{

	function __construct(){			
	}

	/*
	* Newsletter area display
	* @return Boolean
	*/
	public static function newsletter_area_is_on(){
		$opt_name = 'newsletter_area';
		$default = false;

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/newsletter_area', $output );
		return $output;
	}

	/*
	* Widget area display
	* @return Boolean
	*/
	public static function widget_area_is_on(){
		$opt_name = 'footer_widget_area';
		$default = false;

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/footer_widget_area', $output );
		return $output;
	}

	/*
	* Widget area display
	* @return Boolean
	*/
	public static function copyright_bar_is_on(){
		$opt_name = 'footer_copyright_bar';
		$default = true;

		$output = landpick_get_option( $opt_name, $default );
		$output = apply_filters( 'landpick/footer_copyright_bar', $output );
		return $output;
	}
	
	
}
new Landpick_Footer_Config();