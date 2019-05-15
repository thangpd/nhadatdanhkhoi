<?php
defined( 'ABSPATH' ) || exit;
if( !class_exists('Landpick') ):

load_template( LANDPICK_DIR . "/admin/framework/color-functions.php" );
load_template( LANDPICK_DIR . "/admin/framework/functions-framework.php" );
load_template( LANDPICK_DIR . "/admin/framework/theme-config.php" );
load_template( LANDPICK_DIR . "/admin/framework/theme-plugin-config.php" );


/*
* Landpick class
*/
class Landpick{
	
	function __construct(){	
		add_filter( 'landpick/bg-color', array( $this, 'redux_bg_color' ), 10, 2 );
		add_filter( 'landpick/redux_to_metaboxes', array( $this, 'redux_to_metaboxes' ) );		
		add_action( 'wp_ajax_landpick_vc_admin_view', array( $this, 'vc_admin_view' ) );
		add_filter( 'perch_modules/css_class_filter', array( $this, 'css_class_filter' ), 10, 2 );
		add_filter( 'perch_modules/vc_typography_css_classes', array( $this, 'vc_typography_add_css_animation' ), 10, 3 );
		add_filter( 'perch_modules/vc_typography_atts', array( $this, 'vc_typography_add_animation_atts' ), 10, 3 );
		add_filter( 'perch_modules/vc_typography_animation_atts', array( $this, 'vc_typography_animation_duration' ), 10, 2 );

	}

	public static function vc_typography_animation_duration( $atts, $field_id ){
		if( $field_id == 'highlight' ) return $atts;
		
		if( isset($atts['periodic_animation']) && ($atts['periodic_animation'] == 'yes') ){
			if( isset($atts['animation']) && ($atts['animation'] != 'none') ){
				$duration = isset($atts['duration'])? $atts['duration'] : 100;
				$delay = isset($atts['delay'])? $atts['delay'] : 300;
				$atts['delay'] = intval($delay) + intval($duration);
			}
		}
		return $atts;
	}

	public static function vc_typography_add_animation_atts($args, $field_id, $atts){
		if( isset($atts['periodic_animation']) && ($atts['periodic_animation'] == 'yes') ){
			if( isset($atts['animation']) && ($atts['animation'] != 'none') ){
				$delay = isset($atts['delay'])? $atts['delay'] : 300;
				$args['data-wow-delay'] = intval($delay).'ms';
			}
		}
		return $args;
	}

	public static function vc_typography_add_css_animation($classes, $field_id, $atts){		
		if( isset($atts['periodic_animation']) && ($atts['periodic_animation'] == 'yes') ){
			if( isset($atts['animation']) && ($atts['animation'] != 'none') ){
				$classes[] = 'wow';
				$classes[] = $atts['animation'];
			}
		}		
		return $classes;
	}

	public static function css_class_filter($classes, $atts){		
		if( empty($classes) ) return $classes;
		if( empty($atts) ) return $classes;

		extract($atts);

		$classes = array_filter($classes);
		$classes = array_unique($classes);

		$classes = self::add_css_animation($classes, $atts);

		$bulk_classes = array('Inherit', 'inherit', 'None', 'none', 'default', 'Default');
		foreach($classes as $key => $value) {
			if (in_array( $value, $bulk_classes )) {
				unset($classes[$key]);
			}
		}

		return $classes;
	}

	public static function add_css_animation($classes, $atts){
		if( isset($atts['periodic_animation']) && ($atts['periodic_animation'] != 'yes') ){
			if( isset($atts['animation']) && ($atts['animation'] != 'none') ){
				$classes[] = 'wow';
				$classes[] = $atts['animation'];
			}
		}
		return $classes;
	}

	public static function get_id(){
		if( is_home() || (get_post_type() == 'post') ){
			$post_id = get_option( 'page_for_posts' ); 
		}elseif( is_page() ){
			$post_id = get_the_ID();
		}else{
			$post_id = NULL;
		}

		if( get_post_type() == 'portfolio' ){
			$post_id = landpick_get_option('portfolio_archive', NULL);
		}
		if( get_post_type() == 'team' ){
			$post_id = landpick_get_option('team_archive', NULL);
		}

		if( function_exists('is_woocommerce') ){
			if( (get_post_type() == 'product') ):
				$post_id = get_option( 'woocommerce_shop_page_id' );	
			endif;
		}

		return $post_id;
	}

	public static function vc_admin_view(){
         
        $paramsArr = $_POST['params'];    
        $paramsArr['title_animation'] = '';
        $paramsArr['subtitle_animation'] = '';
        $paramsArr['css_animation'] = '';
        //var_dump($paramsArr);
        $params = ' ';
        foreach ($paramsArr as $key => $value) {
            $params .= ' '.$key.'="'.$value.'"';
        }
       //echo $params;

        $admin_view_style = landpick_get_option('vc_admin_view', 'full');

        $base = $_POST['element'];
        if( $admin_view_style == 'simple' ){
            $admin_params = $_POST['admin_params'];
            if($admin_params != ''){
                echo self::admin_vc_view($paramsArr, $admin_params);
            }
        }else{
           echo do_shortcode('['.$base.$params.']'); 
        }
        

        wp_die();
    }

	public static function cleanSetting($value, $withWarnings = false) {
			global $landpick_options;
            $value = array_filter($value);            
            
            $value['column'] = 12;

            if (isset($value['title'])) {
                $value['name'] = $value['title'];
                unset($value['title']); 
            }
            if (isset($value['subtitle'])) {
                $value['desc'] = $value['subtitle'];
                unset($value['subtitle']); 
            }
            if (isset($value['default'])) {            	
                $value['std'] = ( isset($landpick_options->$value['id']) && ($landpick_options->$value['id'] != ''))? $landpick_options->$value['id'] : $value['default'];
                unset($value['default']);   
            }
            if (isset($value['multi'])) {
                $value['multiple'] = $value['multi'];
                unset($value['multi']);   
            }

            if (isset($value['required'])) {
            	if(isset($value['required'][1]) && ($value['required'][1] == 'equals')){
            		$value['required'][1] = '=';
            	}
                $value['visible'] = $value['required'];
                $value['relation'] = 'and';
                unset($value['required']);   
            }

            if (isset($value['prefix'])) {
            	 unset($value['prefix']);
            }

            switch ($value['type']) {               
                case "media":
                  $value['type'] = "file_input";
                  $value['mime_type'] = array('image/jpeg', 'image/png', 'image/gif');
                break;
                case "section":
                  $value['type'] = "heading";
                break;
                case "switch":
                  	$value['style'] = "square";
                   	$value['on_label'] = 'ON';
				  	$value['off_label'] = 'OFF';
                break;
                case "select":
                  $value['type'] = "select_advanced";                  
                break;
                case "dimensions":
                  $value = array();
                break;
                case "typography":
                  $value = array();
                break;
                case "button_set":
                    $value['type'] = "button_group"; 
                    $value['multiple'] = false;                 
                    $value['inline'] = true;                 
                break;  
                default:
                //$value = array();
                //unset($value); 
                // Can't do custom types. Must be fixed manually.
                    # code...
                    break;                  
            }

                      
            return $value;
        }

	public static function redux_to_metaboxes( $options ){
		if( empty($options) ) return false;

		$metaboxs = array();
		foreach ($options as $key => $value) {
			if(isset($value['id'])){
                    $metaboxs[] = $this->cleanSetting($value);
            } 
		}

		$metaboxs = array_filter($metaboxs);

		return $metaboxs;
	}

	public static function redux_bg_color( $args ){

		$settings = $args[0];		

		if( isset( $settings['prefix'] ) && ( '' != $settings['prefix'] ) ){
			// Re-initialize $args
			$settings['id'] = $settings['prefix'].'_class';
			$args = array($settings);

			// Background type for custom 
			$background_type = array(
	        	array(
		            'id'       => $settings['prefix'].'_type',
		            'type'     => 'button_set',
		            'title'    => __('Custom Background type', 'landpick'),  
		            'options'  => array(
		                'white-color' => 'Dark',
		                'dark-color' => 'Light',
		            ),
		            'default'  => 'dark-color',
		            'required' => array(
		                array( $settings['prefix'].'_class','contains','bg-custom'),
		            ) 
		        )
	        );
	        $args = array_merge( $args, $background_type);


			// custom bg class
			$selector = ( isset($settings['selector']) && ('' != $settings['selector']) )? $settings['selector'] : '';
			$custom_bg_options = array(
				 array(
		            'id'       => $settings['prefix'].'_color',
		            'type'     => 'color',
		            'title'    => __('Custom color', 'landpick'),
		            'default'  => '',
		            'output'   => array( 'background-color' => $selector ),
		            'required' => array(
		                array( $settings['prefix'].'_class','=','bg-custom'),
		            )
		        )
			);
	        $args = array_merge( $args, $custom_bg_options);

	        //Gradient bg class
	        $gradient_options = array(
	        	array(
		            'id'       => $settings['prefix'].'_gradient_section_start',
		            'type'     => 'section',
		            'title'    => __( 'Gradient settings', 'landpick' ),
		            'indent'   => true, // Indent all options below until the next 'section' option is set.
		            'required' => array(
		                array( $settings['prefix'].'_class','=','bg-custom-gradient'),
		            )
		        ),
		        array(
		            'id'       => $settings['prefix'].'_gradient',
		            'type'     => 'color_gradient',
		            'title'    => __( 'Gradient Color Option', 'landpick' ),
		            'transparent' => true,
		            'default'  => array(
		                'from' => '#1e73be',
		                'to'   => '#00897e'
		            ), 
		            'compiler' => true,           
		            'required' => array(
		                array( $settings['prefix'].'_class','=','bg-custom-gradient'),
		            )
		        ),
		        array(
		            'id'       => $settings['prefix'].'_gradient_type',
		            'type'     => 'button_set', 
		            'title'    => __('Gradient type', 'landpick'),  
		            'options'  => array(
		                'linear' => 'Linear',
		                'radial' => 'Radial',
		            ),
		            'default'  => 'linear',
		            'required' => array(                 
		                array( $settings['prefix'].'_class','=','bg-custom-gradient'),
		            ) 
		        ),
		        array(
		            'id'     => $settings['prefix'].'_gradient_section_end',
		            'type'   => 'section',
		            'indent' => false, // Indent all options below until the next 'section' option is set.
		            'required' => array(                 
		                array( $settings['prefix'].'_class','=','bg-custom-gradient'),
		            )
		        )
	        );
	        $args = array_merge( $args, $gradient_options);

	        
		}

		$args = array_filter($args);
		
		return $args;
	}

	public static function getCSSAnimation($animation = NULL){
		if( $animation == NULL ) return false;
		return 'wow '. esc_attr($animation);
	}

	/*
	* buttons list html
	* @params $array, $array
	* @return array()
	*/
	public static function get_buttons_html( $buttons = array(), $extra_class = '' ) {
	    if ( empty( $buttons ) ) return;
	    $output = '';

	    $darkcolorArr = landpick_default_dark_color_classes(array('prefix' => 'btn-'));  
	    unset($darkcolorArr[array_flip($darkcolorArr)['btn-tra-dark']]); 
	    $darkcolortraArr = landpick_default_dark_color_classes(array('prefix' => 'btn-tra-'));

	    
	    foreach ( $buttons as $key => $value ):
	        extract( shortcode_atts( array(
	            'type' => 'text', 
	            'image' => LANDPICK_URI. '/images/googleplay.png',
	            'image_size' => '160',	            
	            'title' => 'Get Started Now',
	            'name' => 'Get Started Now',
	            'url' => '#',
	            'target' => '_self',
	            'style' => 'btn-preset',
	            'size' => '',
	            'icon_position' => 'icon_position-right',
	            'icon' => landpick_button_default_icon(''),
	        ), $value ) );
	        $buttonClass              = array();
	        $iconClass              = array();
	        $iconClass[ ]           = $icon;
	        $iconClass              = array_filter( $iconClass );

	        if( $type == 'text' ){
	             $buttonClass = landpick_buttons_common_class(''); 
	             $btntxt = landpick_parse_text( $title, array( 'tag' => 'strong') );
	             $buttonClass[]         = $style;
	            $buttonClass[]         = $size;
	            $buttonClass[]  = (($icon != '') && ($button_text != ''))? $icon_position : '';



	            if($style){
	            	$buttonClass[] = (in_array( $style, $darkcolorArr))? 'btn-type-dark' : 'btn-type-light';
	            	if(in_array( $style, $darkcolortraArr)){ $buttonClass[] = 'btn-hover-type-dark'; } 
	            }
	            
	            
	      
	        }else{
	            $icon_position = '';
	            $buttonClass =  array('img-btn');
	            $btntxt = '<img src="'.esc_url($image).'" alt="'.esc_attr($title).'" class="store-btn" width="'.intval($image_size).'">';
	        }
	        $buttonClass[] = $extra_class;	       	 
	        
	        $buttonClass            = array_filter( $buttonClass );
	        $buttonAttr             = array( );
	        $buttonAttr[ 'target' ] = $target;
	        $buttonAttr[ 'href' ]   = esc_url( $url );
	        $buttonAttr[ 'title' ]  = esc_attr( $title );
	        $buttonAttr[ 'class' ]  = implode( ' ', $buttonClass );
	        $attr                   = '';
	        foreach ( $buttonAttr as $key => $value ) {
	            $attr .= ' ' . $key . '="' . $value . '"';
	        } //$buttonAttr as $key => $value
	       
	        if ( $icon != '' ) {
	            $icon = ' <i class="' . implode( ' ', $iconClass ) . '"></i>';
	        } //$icon_landpick != ''
	        $output .= '<a' . $attr . '><span>';
	        $output .= $btntxt;
	        $output .= ( $icon_position == 'icon_position-right' ) ? $icon : '';
	        $output .= '</span></a>';
	    endforeach;
	    
	    return $output;
	}

	/*
	* Social Icons list html
	* @params $array, $array
	* @return array()
	*/
	public static function get_social_icons_html( $social_icons = array(), $args = array() ) {
		$output = '';
	    if ( empty( $social_icons ) ) return $output;	    

	    $default = array(
	        'wrap' => 'span',
	        'wrapid' => '',
	        'wrapclass' => 'header-socials',
	        'linkwrapbefore' => '',
	        'linkwrap' => 'span',
	        'linkwrapclass' => '',
	        'linkclass' => '',
	        'iconprefix' => 'ico-',
	        'iconclass' => '',
	        'linktext' => false, 
	        'display_icon' => true, 
	    );
	    $default = apply_filters( 'landpick/get_social_icons_args', $default );
	    extract( shortcode_atts( $default, $args ) );
	  
	    $output .= ( $wrap != '' ) ? '<' . esc_attr( $wrap ) . ( ( $wrapclass != '' ) ? ' class="' . esc_attr( $wrapclass ) . '"' : '' ) . '>' : '';
	    $output .= ( $linkwrapbefore != '' ) ? wpautop( $linkwrapbefore ) : '';
	    $linkbefore = ( $linkwrap != '' ) ? '<' . esc_attr( $linkwrap ) . ( ( $linkwrapclass != '' ) ? ' class="' . esc_attr( $linkwrapclass ) . '"' : '' ) . '>' : '';
	    $linkafter  = ( $linkwrap != '' ) ? '</' . esc_attr( $linkwrap ) . '>' : '';
	    
	    foreach ( $social_icons as $key => $value ) {

	        $url        = isset( $value[ 'url' ] ) ? $value[ 'url' ] : '';
	        $title      = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
	        $icon_class  = isset( $value[ 'icon' ] ) ? $value[ 'icon' ] : '';

	        $_linkclass = array();
	        $_linkclass[]  = ( $linkclass != '' ) ? esc_attr( $linkclass ) : '';
	    	$_linkclass[]  = ( $iconprefix != '' ) ? esc_attr($iconprefix) . sanitize_title($title) : '';
	    	$_linkclass = array_filter($_linkclass);
	    	

	        $iconhtml = ($display_icon)? '<i class="' . esc_attr( $icon_class ) . '"></i>' : '';
	        $linktexthtml =  ( $linktext ) ? '<span>' . esc_attr( $title ) . '</span>' : ''; 	       

	        $html = $linkbefore . 
	        '<a target="_blank" href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" class="'.implode(' ', $_linkclass).'">
		      '.$iconhtml.'
		      '.$linktexthtml.'
		      </a>' 
	      . $linkafter;	     
	      $output .= $html;
	    } //$social_icons as $key => $value
	    $output .= ( $wrap != '' ) ? '</' . esc_attr( $wrap ) . '>' : '';

	    return $output;
	}
}

new Landpick();

load_template(LANDPICK_DIR . "/admin/framework/class.header-config.php") ;
load_template(LANDPICK_DIR . "/admin/framework/class.container-config.php") ;
load_template(LANDPICK_DIR . "/admin/framework/class.footer-config.php") ;
load_template(LANDPICK_DIR . "/admin/framework/hooks-config.php") ;
load_template(LANDPICK_DIR . "/admin/framework/filters-config.php") ;
endif;