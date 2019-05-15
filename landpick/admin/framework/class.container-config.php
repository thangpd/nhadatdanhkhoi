<?php
defined( 'ABSPATH' ) || exit;
/**
* Landpick config
*/
class Landpick_Container_Config extends Landpick{

	function __construct(){	
		add_filter('landpick_container_id', array( $this, 'predefined_container_id' ) );
		add_filter('landpick_container_class', array( $this, 'predefined_container_class' ), 50, 2 );	
		add_filter('landpick_container_class', array( $this, 'custom_container_class' ), 10, 2 );	
		add_filter('landpick_sidebar_id', array( $this, 'predefined_sidebar_id' ) );		
		add_filter('landpick_sidebar_class', array( $this, 'custom_sidebar_class' ), 10, 2 );	
		add_action('landpick_sidebar_before', array( $this, 'sidebar_before' ));	
		add_action('landpick_sidebar_after', array( $this, 'sidebar_after' ));	
	}

	/*
	* get_template_type
	* @return default/landing
	*/
	public static function get_template_type(){
		$opt_name = 'landpick_template_type';
		$output = false;	
		if( function_exists('rwmb_meta') ){
			$output = rwmb_meta( $opt_name, array(), self::get_id() );
		}	

		return $output;
	}

	/*
	* predefined_template
	* @return Boolean
	*/
	public static function get_layout_type(){
		$opt_name = 'layout_type';
		$output = false;	
		if( landpick_is_meta_field_exists($opt_name) ){
			$output = rwmb_meta( $opt_name, array(), self::get_id() );
		}	

		return $output;
	}

	/*
	* predefined_template
	* @return Boolean
	*/
	public static function is_predefined_template(){
		$opt_name = 'predefined_template';
		$post_id = self::get_id();
		$default = true;

		if( landpick_is_meta_field_exists($opt_name) && $post_id ){
			$output = rwmb_meta( $opt_name, array(), $post_id );			
		}else{
			$output = $default;
		}	

		return $output;
	}

	/*
	* predefined_layout
	* @return string
	*/
	public static function predefined_container_id($output){	
		$opt_name = 'predefined_layout';
		$default = landpick_default_container_id();
		$post_id = get_the_ID();
			

		if( landpick_is_meta_field_exists($opt_name, $post_id) && self::is_predefined_template() ){
			$meta = rwmb_meta( $opt_name, array(), $post_id );						
			$output = landpick_get_predefined_template_attr($meta, 'id');
		}else{
			$output = $default;
		}		
		return $output;
	}

	/*
	* predefined_layout class
	* @return array
	*/
	public static function predefined_container_class($classes, $class){	
		$opt_name = 'predefined_layout';
		$default = '';
		$meta = (is_page())? 'page' : 'blog';	
		$meta = is_singular( 'post' )? 'blog_single' : $meta;	
		$post_id = self::get_id();

		if(self::is_predefined_template()):					
			if( landpick_is_meta_field_exists($opt_name, $post_id) ){
				$meta = rwmb_meta( $opt_name, array(), $post_id );
				$classes = array(landpick_get_predefined_template_attr($meta, 'class'));
			}else{
				$classes = array(landpick_get_predefined_template_attr($meta, 'class'));
			}		
		endif;	
		return $classes;
	}

	/*
	* predefined_layout class
	* @return array
	*/
	public static function custom_container_class($classes, $class){	
		$opt_name = 'container_spacing';
		$post_id = self::get_id();
		$default = 'wide-60';

		if(!self::is_predefined_template()):					
			if( landpick_is_meta_field_exists($opt_name, $post_id) ){
				$meta = rwmb_meta( $opt_name, array(), $post_id );
				$classes[] = landpick_wide_class_prefix().$meta;
			}else{
				$classes[] = $default;
			}
		else:	
			$classes[] = $default;
		endif;	
		return $classes;
	}

	public static function sidebar_before(){		
		
		if(landpick_get_layout() == 'full' ) return false;

		if(landpick_get_layout() == 'ls' ){
			$class = landpick_padding_right_class_prefix().'60';
		}else{
			$class = landpick_padding_left_class_prefix().'60';
		}
		echo '<div class="'.esc_attr($class).'">';
	}

	public static function sidebar_after(){		
		$output = '';
		if(self::get_layout_type() == 'full' ) return false;	
		echo '</div>';
	}

	/*
	* predefined_sidebar_id
	* @return string
	*/
	public static function predefined_sidebar_id($output){	
		$opt_name = 'predefined_layout';		
		if( function_exists('rwmb_meta') ){
			$meta = rwmb_meta( $opt_name, array(), self::get_id() );	
			$arr = landpick_get_predefined_template_attr($meta, 'sidebar');
			$output = ( isset($arr['id']) )? $arr['id'] : 'sidebar-right';
		}else{
			$output = 'sidebar-right';
		}		
		return $output;
	}

	/*
	* predefined_layout class
	* @return array
	*/
	public static function predefined_sidebar_class($classes, $class){	
		if(self::is_predefined_template()):
			$opt_name = 'predefined_layout';		
			
		endif;	
		return $classes;
	}

	/*
	* predefined_layout class
	* @return array
	*/
	public static function custom_sidebar_class($classes, $class){	
		if(!self::is_predefined_template()):
			$opt_name = 'container_spacing';		
			
		endif;	
		return $classes;
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
new Landpick_Container_Config();

/*
* Container functions
*/
/* Layout option for landpick */
function landpick_layout_option_values( $options = array() ){
	

	if( is_page() ):		
		$layout = Landpick_Container_Config::get_layout_type();

		$sidebar = 	get_post_meta( get_the_ID(), 'sidebar', true );	
		$sidebar = ( $sidebar== '' )? 'sidebar-page' : $sidebar;

	elseif( is_singular('post') ):
		$layout = landpick_get_option('single_layout', 'rs');	
		$sidebar = 	landpick_get_option( 'single_layout_sidebar', 'sidebar-post' );			
	else:
		$layout = landpick_get_option('blog_layout', 'rs');
		$sidebar = 	landpick_get_option( 'blog_layout_sidebar', 'sidebar-post' );				
	endif;

	if( function_exists('is_woocommerce') ){
		if( is_product() ):
			$layout = landpick_get_option('product_layout', 'rs');
			$sidebar = 	landpick_get_option( 'product_layout_sidebar', 'sidebar-product' );
		elseif( is_woocommerce() ):
			$layout = landpick_get_option('shop_layout', 'full');
			$sidebar = 	landpick_get_option( 'shop_layout_sidebar', 'sidebar-product' );
		endif;
	}

	

	if ( 'portfolio' == get_post_type() ){
		$archive_id = landpick_get_option('portfolio_archive');
		if(get_post_status($archive_id) == 'publish'){
			$page_id = $archive_id; 
			$layout = get_post_meta( $page_id, 'page_layout', true );
			$sidebar = 	get_post_meta( $page_id, 'sidebar', true );

		}else{
			$layout = landpick_get_option('portfolio_layout', 'full');
			$sidebar = 	landpick_get_option( 'portfolio_layout_sidebar', 'sidebar-portfolio' );			
		}

		if( is_singular('portfolio') ){
			$layout = landpick_get_option('portfolio_single_layout', 'full');
			$sidebar = 	landpick_get_option( 'portfolio_single_layout_sidebar', 'sidebar-portfolio' );
		}		
	}


	if ( 'team' == get_post_type() ){
		$archive_id = landpick_get_option('team_archive');
		if(get_post_status($archive_id) == 'publish'){
			$page_id = $archive_id; 
			$layout = get_post_meta( $page_id, 'page_layout', true );
			$sidebar = 	get_post_meta( $page_id, 'sidebar', true );

		}else{
			$layout = landpick_get_option('team_layout', 'full');
			$sidebar = 	landpick_get_option( 'team_layout_sidebar', 'sidebar-page' );			
		}

		if( is_singular('team') ){
			$layout = landpick_get_option('team_single_layout', 'full');
			$sidebar = 	landpick_get_option( 'team_single_layout_sidebar', 'sidebar-page' );
		}		
	}

	if(is_404()) $layout = 'full';



	if ( !is_active_sidebar( $sidebar ) ){
		$layout = 'full';
	}

	
	
	$layout = ( $layout == '' )? 'full' : $layout;	

	$options['layout'] = $layout;
	$options['sidebar'] = ( $layout != 'full' )? $sidebar : '';

	return apply_filters(  'landpick_layout_option_values', $options );
	
}


function landpick_get_layout(){
	global $wp_query;
	return $wp_query->landpick['layout'];
}

function landpick_get_sidebar(){
	global $wp_query;	
	return $wp_query->landpick['sidebar'];
}