<?php
if ( ! function_exists( 'landpick_get_typography_font_options' ) ) :
// template default fonts	
function landpick_get_typography_font_options(){
	
	$fonts = array(
		'Roboto:300,regular,500,700,900',
		'Montserrat:300,regular,500,600,700,800,900',
	);

	return $fonts;
}
endif;

if ( ! function_exists( 'landpick_fonts_url' ) ) :
/**
 * Register Google fonts for landpick.
 *
 * @return string Google fonts URL for the theme.
 */
function landpick_fonts_url() {
	$fonts_url = '';
	$fonts     = array();

	/*
	 * Translators: If there are characters in your language that are not supported
	 */
	$fonts = landpick_get_typography_font_options();
	

	$subsets   = 'latin,latin-ext';
	$subset = 'no-subset';

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function landpick_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'landpick_javascript_detection', 0 );

// Register Style
function landpick_styles() {

	wp_register_style( 'landpick-google-fonts', landpick_fonts_url(), array(), null );
	wp_enqueue_style( 'landpick-google-fonts' );
	

	
	if( is_rtl() ){
		wp_register_style( 'bootstrap-rtl', LANDPICK_URI. '/rtl/bootstrap-rtl.min.css', false, '1.0' );
		wp_enqueue_style( 'bootstrap-rtl' );
	}else{
		wp_enqueue_style( 'bootstrap', LANDPICK_URI. '/css/bootstrap.min.css', false, '4.0.0' );
	}
	wp_enqueue_style( 'fa-svg-with-js', LANDPICK_URI. '/css/fa-svg-with-js.css', false, '1.0.0' );			
	wp_enqueue_style( 'tonicons' );
	wp_enqueue_style( 'flaticon' );
	wp_enqueue_style( 'fontawesome' );
	wp_enqueue_style( 'magnific-popup', LANDPICK_URI. '/css/magnific-popup.css', false, '1.0.0' );		
	wp_enqueue_style( 'slick', LANDPICK_URI. '/css/slick.css', false, '1.0.0' );		
	wp_enqueue_style( 'slick-theme', LANDPICK_URI. '/css/slick-theme.css', false, '1.0.0' );		
	wp_enqueue_style( 'landpick-flexslider', LANDPICK_URI. '/css/flexslider.css', false, '1.0.0' );
	wp_enqueue_style( 'owl-carousel', LANDPICK_URI. '/css/owl.carousel.min.css', false, '1.0.0' );
	wp_enqueue_style( 'owl-theme-default', LANDPICK_URI. '/css/owl.theme.default.min.css', false, '1.0.0' );
	wp_enqueue_style( 'animate', LANDPICK_URI. '/css/animate.css', false, '1.0.0' );	
	wp_enqueue_style( 'selectize-bootstrap4', LANDPICK_URI. '/css/selectize.bootstrap4.css', false, '1.0.0' );	
	wp_enqueue_style( 'landpick-spinner', LANDPICK_URI. '/css/spinner.css', false, '1.0.0' );
	if( function_exists('is_woocommerce') ){
    	wp_enqueue_style( 'landpick-woocommerce', get_theme_file_uri( '/css/woocommerce.css' ), array('woocommerce-general'), '1.0.1.3' );
	}

	wp_enqueue_style( 'landpick-default-style', LANDPICK_URI. '/css/style.css', false, '1.0.0' );
	wp_enqueue_style( 'landpick-style', get_stylesheet_uri(), false, '1.0.0.1' );
	if( is_rtl() ){
		wp_enqueue_style( 'landpick-styles-rtl', LANDPICK_URI. '/rtl/style-rtl.css', array('landpick-style'), '1.0.1.8' );		
	}
	
	wp_enqueue_style( 'landpick-responsive', LANDPICK_URI. '/css/responsive.css', array('landpick-style'), '1.0.1.3' );

	

	$landpick_layout_style = landpick_get_option( 'landpick_layout_style', 'rounded' );
	if( $landpick_layout_style != 'semirounded' ){
		wp_enqueue_style( 'landpick-layout-'.$landpick_layout_style, LANDPICK_URI. '/css/landpick-'.$landpick_layout_style.'.css', array('landpick-style'), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'landpick_styles' );


/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 */
function landpick_inline_css_style() {	
	wp_add_inline_style( 'landpick-style', landpick_get_dynamic_header_css() );	
  wp_add_inline_style( 'landpick-default-style', landpick_dynamic_general_style_css() );
  wp_add_inline_style( 'bootstrap', landpick_bootstrap_style_css() );  
  if(function_exists('is_woocommerce')){
    wp_add_inline_style( 'landpick-woocommerce', landpick_woocommerce_general_style_css() );
  }
}
add_action( 'wp_enqueue_scripts', 'landpick_inline_css_style' );


// Register Script
function landpick_scripts() {
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// google map scripts
	wp_register_script( 'landpick-map', get_theme_file_uri( '/js/landpick-map.js' ), array( 'jquery' ), '1.0.0', true );	
	$key = landpick_get_option( 'google_map_api', '' );
	$key = ($key != '')? '&key='.esc_attr($key) : '';
	wp_register_script( 'landpick-googleapis', '//maps.googleapis.com/maps/api/js?callback=landpickinitMap'.$key, array( 'jquery', 'landpick-map' ), '1.0.0', true );	
	
	// Jquery library
	wp_register_script( 'imgLiquid', get_theme_file_uri( '/js/imgLiquid-min.js' ), array( 'jquery' ), '1.0.0', true ); 	
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/js/bootstrap.min.js' ), array( 'jquery' ), '1.0.0', true ); 	
	wp_enqueue_script( 'fontawesome-all', get_theme_file_uri( '/js/fontawesome-all.min.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'v4-shims', get_theme_file_uri( '/js/fa-v4-shims.min.js' ), array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'modernizr-custom', get_theme_file_uri( '/js/modernizr.custom.js' ), array('jquery'),'1.0.0',true );	
	wp_enqueue_script( 'jquery-easing', get_theme_file_uri( '/js/jquery.easing.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-stellar', get_theme_file_uri( '/js/jquery.stellar.min.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/js/jquery.scrollto.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-appear', get_theme_file_uri( '/js/jquery.appear.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-superslides', get_theme_file_uri( '/js/jquery.superslides.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'vidbg', get_theme_file_uri( '/js/vidbg.min.js' ), array('jquery'),'0.5.1',true );
	wp_enqueue_script( 'isotope-pkgd', get_theme_file_uri( '/js/isotope.pkgd.min.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-flexslider', get_theme_file_uri( '/js/jquery.flexslider.js' ), array('jquery'),'1.0.0',true );	
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/js/owl.carousel.min.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'slick', get_theme_file_uri( '/js/slick.min.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'selectize', get_theme_file_uri( '/js/selectize.min.js' ), array('bootstrap'),'1.0.0',true );
	wp_enqueue_script( 'wow', get_theme_file_uri( '/js/wow.js' ), array('jquery'),'1.0.0',true );
	wp_enqueue_script( 'jquery-magnific-popup', get_theme_file_uri( '/js/jquery.magnific-popup.min.js' ), array('jquery'),'1.0.0',true );
	wp_register_script( 'front_enqueue_js', get_theme_file_uri( '/js/front_enqueue_js.js' ), array('jquery'),'1.0.0',true );
	wp_register_script( 'jquery-countdown', get_theme_file_uri( '/js/jquery.countdown.min.js' ), array( 'landpick-custom' ), '1.0.0', true);

	// Landpick custom scripts
	wp_enqueue_script( 'landpick-custom', get_theme_file_uri(  '/js/custom.js' ), array( 'jquery', 'jquery-masonry', 'masonry' ), '1.0.1.3', true );
	 
	// Landpick licalize
	$arr = array( 
		'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
		'LANDPICK_URI' => esc_url(LANDPICK_URI),
		'LANDPICK_DIR' => LANDPICK_DIR,
		'animation' => landpick_get_option( 'landpick_animation', 'on' )
		);
	wp_localize_script( 'landpick-custom', 'LANDPICK', $arr );

}
add_action( 'wp_enqueue_scripts', 'landpick_scripts' );


if( function_exists('register_block_type') ): // checked for lower version of WP
// Landpick gutenberg button block compability
function landpick_gutenberg_block_styles() {
	wp_register_style(
        'landpick-fonts',
        landpick_fonts_url(),
        array(),
        false
    );

    wp_register_style(
        'button',
        get_theme_file_uri( 'css/buttons/style.css' ),
        array(),
        filemtime( LANDPICK_DIR . '/css/buttons/style.css' )
    );

    register_block_type( 'core/button', array(
        'style' => 'button',
    ));

    if( is_admin() ):
	    wp_register_style(
	        'paragraph',
	        get_theme_file_uri( 'css/typography/style.css' ),
	        array( 'landpick-fonts', 'wp-editor' ),
	        filemtime( LANDPICK_DIR . '/css/typography/style.css' )
	    );

	    register_block_type( 'core/paragraph', array(
	        'style' => 'paragraph',
	    ));
	endif;
}
add_action( 'init', 'landpick_gutenberg_block_styles' );
endif;