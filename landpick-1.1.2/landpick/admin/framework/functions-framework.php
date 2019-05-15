<?php
add_filter( 'perch_modules/wide_class_prefix', 'landpick_wide_class_prefix' );
function landpick_wide_class_prefix(){
	return 'wide-';
}

add_filter( 'perch_modules/ind_class_prefix', 'landpick_ind_class_prefix' );
function landpick_ind_class_prefix(){
	return 'ind-';
}

add_filter( 'perch_modules/margin_top_class_prefix', 'landpick_margin_top_class_prefix' );
function landpick_margin_top_class_prefix(){
	return 'mt-';
}

add_filter( 'perch_modules/margin_right_class_prefix', 'landpick_margin_right_class_prefix' );
function landpick_margin_right_class_prefix(){
	return 'mr-';
}

add_filter( 'perch_modules/margin_bottom_class_prefix', 'landpick_margin_bottom_class_prefix' );
function landpick_margin_bottom_class_prefix(){
	return 'mb-';
}

add_filter( 'perch_modules/margin_left_class_prefix', 'landpick_margin_left_class_prefix' );
function landpick_margin_left_class_prefix(){
	return 'ml-';
}

add_filter( 'perch_modules/padding_top_class_prefix', 'landpick_padding_top_class_prefix' );
function landpick_padding_top_class_prefix(){
	return 'pt-';
}

add_filter( 'perch_modules/padding_right_class_prefix', 'landpick_padding_right_class_prefix' );
function landpick_padding_right_class_prefix(){
	return 'pr-';
}

add_filter( 'perch_modules/padding_bottom_class_prefix', 'landpick_padding_bottom_class_prefix' );
function landpick_padding_bottom_class_prefix(){
	return 'pb-';
}

add_filter( 'perch_modules/padding_left_class_prefix', 'landpick_padding_left_class_prefix' );
function landpick_padding_left_class_prefix(){
	return 'pl-';
}

if( !function_exists('landpick_breakCSS') ){
	function landpick_breakCSS($css){

	    $results = array();

	    preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches);
	    foreach($matches[0] AS $i=>$original)
	        foreach(explode(';', $matches[2][$i]) AS $attr)
	            if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
	            {
	                list($name, $value) = explode(':', $attr);
	                $results[$matches[1][$i]][trim($name)] = trim($value);
	            }
	    return $results;
	}
}

if( !function_exists('landpick_breakCSS_iconArr') ){
	function landpick_breakCSS_iconArr($css){
		$css = landpick_breakCSS($css);
		$css = array_filter($css);

	    $results = array();

	    foreach ($css as $key => $value) {
	    	$key = str_replace(".","", $key );
	    	$key = str_replace(":before","", $key );

	    	$value = str_replace("-"," ", $key );

	    	$results[] = array ( $key => $value);
	    	
	    }
	    
	    return $results;
	}
}

function landpick_sidebar_common_class(){	 
	$mbottom = landpick_margin_bottom_class_prefix().'40';
	$array = array( 'sidebar-div', 'single-widget', $mbottom );

	return $array;
}

add_filter( 'perch_modules/vc_category', 'landpick_vc_category' );
if( !function_exists('landpick_vc_category') ){
	function landpick_vc_category(){
		return 'Landpick';
	}
}

add_filter( 'perch_modules/vc_class', 'landpick_vc_class' );
if( !function_exists('landpick_vc_class') ){
	function landpick_vc_class(){
		return 'landpick-vc';
	}
}

function landpick_input_field_settings_options(){
    $array = array(
        'input_field' => true,
        'textarea' => false,  
        'google_font_settings' => false,          
        'typo_settings' => true,
        'highlight_settings' => true,
        'typo_std' => '',
        'highlight_std' => '',       
    );

    if( class_exists('PerchVcMap') ){
    	$array['typo_fields'] = PerchVcMap::typography_fields_settings_options();
        $array['highlight_fields'] = PerchVcMap::highlight_fields_settings_options();
    }
    return $array;
}


if (!function_exists('landpick_get_option')) {
    function landpick_get_option($option_id, $default = ''){
        global $landpick_options;
       
        /* look for the saved value */
        if (isset($landpick_options[$option_id])) {
            return $landpick_options[$option_id];
        }
        return $default;
    }
}

function landpick_range_option( $start, $limit, $step = 1 ) {
  if ( $step < 0 )
  $step = 1;
  $range = range( $start, $limit, $step );	
  foreach( $range as $k => $v ) {
    if ( strpos( $v, 'E' ) ) {
      $range[$k] = 0;
    }
  }

  return $range;
}
function landpick_wrapper_id(){
	$id = 'page';
	$id = apply_filters( 'landpick_wrapper_id', $id );
	echo sanitize_title($id);
}

function landpick_wrapper_class( $class = '' ) {
	// Separates classes with a single space, collates classes for wrapper element
	echo 'class="' . join( ' ', landpick_get_wrapper_class( $class ) ) . '"';
}

function landpick_get_wrapper_class( $class = '' ) {
	global $wp_query;

	$classes = array('page');	

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	$classes = apply_filters( 'landpick_wrapper_class', $classes, $class );

	return array_unique( $classes );
}


function landpick_header_id(){
	$id = 'header';
	$id = apply_filters( 'landpick_header_id', $id );
	echo sanitize_title($id);
}

function landpick_header_class( $class = '' ) {
	// Separates classes with a single space, collates classes for wrapper element
	echo 'class="' . join( ' ', landpick_get_header_class( $class ) ) . '"';
}

function landpick_get_header_class( $class = '' ) {
	global $wp_query;

	$classes = array('header');	

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	$classes = apply_filters( 'landpick_header_class', $classes, $class );

	return array_unique( $classes );
}

function landpick_navbar_class( $class = '' ) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', landpick_get_navbar_class( $class ) ) . '"';
}

function landpick_get_navbar_class( $class = '' ) {
	global $wp_query;

	$classes = array('navbar', 'navbar-expand-lg', 'hover-menu');		

	
	$nav_style = landpick_get_option( 'nav_bg_class', 'bg-tra' );	
	$nav_style = apply_filters( 'landpick/nav_bg_class', $nav_style );	

	$custom_nav_style = '';	
	if( strpos($nav_style, 'bg-custom') !==  false ){
		$custom_nav_style = landpick_get_option( 'nav_bg_type' );	
		$custom_nav_style = apply_filters( 'landpick/nav_bg_type', $custom_nav_style );		
	}

	$sticky_navbar = landpick_get_option( 'header_sticky_nav', true );
	$sticky_navbar = apply_filters( 'landpick/header_sticky_nav', $sticky_navbar );	
	//print_r($sticky_navbar); die;
	$classes[] = $nav_style;
	if( $sticky_navbar ){
		$nav_style_scroll = landpick_get_option( 'nav_style_scroll', 'black-scroll' );	
		$nav_style_scroll = apply_filters( 'landpick/nav_style_scroll', $nav_style_scroll );
		$classes[] = 'fixed-top';
		$classes[] = $nav_style_scroll;

		$args = array('prefix' => '', 'postfix' => '-scroll');
		$dark_classes = landpick_default_dark_color_classes($args);
		if( $custom_nav_style == 'white-color' ){
			$dark_classes[] =  $nav_style_scroll;
		}
		$classes[] = in_array($nav_style_scroll, $dark_classes)? 'scrollbg-dark' : 'scrollbg-light';

	}

	$dark_classes = landpick_default_dark_color_classes();
	if( $custom_nav_style == 'white-color' ){
		$dark_classes[] =  $nav_style;
	}
	$classes[] = in_array($nav_style, $dark_classes)? 'navbar-dark' : 'navbar-light';

	if($nav_style == 'bg-tra-dark'){
		$classes[] = 'bg-tra navbar-dark';
	}
	   

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );


	$classes = apply_filters( 'landpick_navbar_class', $classes, $class );

	return array_unique( $classes );
}

function landpick_breadcrumbs_id(){
	$id = 'breadcrumbs-hero';
	$id = apply_filters( 'landpick_breadcrumbs_id', $id );
	echo sanitize_title($id);
}

function landpick_breadcrumbs_class( $class = '' ) {
	// Separates classes with a single space, collates classes for wrapper element
	echo 'class="' . join( ' ', landpick_get_breadcrumbs_class( $class ) ) . '"';
}

function landpick_get_breadcrumbs_class( $class = '' ) {
	global $wp_query;

	$classes = array('breadcrumbs-area', 'page-hero-section', 'division', 'parallax');
	$bg_class = landpick_get_option( 'header_bg_class', 'bg-light');	
	$classes[] = $bg_class;
	$dark_class = landpick_default_dark_color_classes();	
	$classes[] = in_array( $bg_class, $dark_class)? 'white-color' : '';
	if( strpos($bg_class, 'bg-custom') !==  false){
  		$classes[] = landpick_get_option( 'header_bg_type', '');
  	}

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	$classes = apply_filters( 'landpick_breadcrumbs_class', $classes, $class );

	return array_unique( $classes );
}

/*
* Container
*/
function landpick_container_id(){
	$id = landpick_default_container_id();	
	$id = apply_filters( 'landpick_container_id', $id );
	echo sanitize_title($id);
}

function landpick_container_class( $class = '' ) {
	// Separates classes with a single space, collates classes for wrapper element
	echo 'class="' . join( ' ', landpick_get_container_class( $class ) ) . '"';
}

function landpick_get_container_class( $class = '' ) {
	global $wp_query;

	$classes = array('division');	
	$classes[] = 'landpick-'.get_post_type().'-content';

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	$classes = apply_filters( 'landpick_container_class', $classes, $class );

	return array_unique( $classes );
}

/*
* Sidebar
*/
function landpick_sidebar_id(){
	$id = 'landpick-'.get_post_type().'-sidebar';
	
	$id = apply_filters( 'landpick_sidebar_id', $id );
	echo sanitize_title($id);
}

function landpick_sidebar_class( $class = '' ) {
	// Separates classes with a single space, collates classes for wrapper element
	echo 'class="' . join( ' ', landpick_get_sidebar_class( $class ) ) . '"';
}

function landpick_get_sidebar_class( $class = '' ) {
	global $wp_query;

	$classes = array('col-md-4');	
	$classes[] = 'landpick-'.get_post_type().'-sidebar';

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	$classes = apply_filters( 'landpick_sidebar_class', $classes, $class );

	return array_unique( $classes );
}

/*
* Footer
*/
function landpick_footer_id(){
	$id = 'footer';
	$id = apply_filters( 'landpick_footer_id', $id );
	echo sanitize_title($id);
}

function landpick_footer_class( $class = '' ) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', landpick_get_footer_class( $class ) ) . '"';
}

function landpick_get_footer_class( $class = '' ) {
	global $wp_query;

	$classes = array('footer', 'division');
	$bg_class = landpick_get_option( 'footer_bg_class');	
	$bg_class = apply_filters( 'landpick/footer_bg_class', $bg_class );
	$classes[] = $bg_class;

	$custom_bg_style = '';	
	if( strpos($bg_class, 'bg-custom') !==  false){
		$custom_style = landpick_get_option( 'footer_bg_type' );	
		$custom_style = apply_filters( 'landpick/custom_footer_bg_type', $custom_style );		
		$classes[] = $custom_style;
	}

	$dark_class = landpick_default_dark_color_classes();
  	$classes[] = in_array( $bg_class, $dark_class)? 'white-color' : '';

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );


	$classes = apply_filters( 'landpick_footer_class', $classes, $class );

	return array_unique( $classes );
}

/*
* Newsletter
*/
function landpick_newsletter_id(){
	$id = 'newsletter-1';
	$id = apply_filters( 'landpick_footer_id', $id );
	echo sanitize_title($id);
}

function landpick_newsletter_class( $class = '' ) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', landpick_get_newsletter_class( $class ) ) . '"';
}

function landpick_get_newsletter_class( $class = '' ) {
	global $wp_query;

	$classes = array('newsletter-section', 'wide-80', 'division', 'parallax');
	$bg_class = landpick_get_option( 'newsletter_bg_class');	
	$classes[] = $bg_class;

	$custom_bg_style = '';	
	if( strpos($bg_class, 'bg-custom') !==  false){
		$custom_style = landpick_get_option( 'newsletter_bg_type' );	
		$custom_style = apply_filters( 'landpick/custom_newsletter_bg_type', $custom_style );		
		$classes[] = $custom_style;
	}

	$dark_class = landpick_default_dark_color_classes();
  	$classes[] = in_array( $bg_class, $dark_class)? 'white-color' : '';

	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );


	$classes = apply_filters( 'landpick_newsletter_class', $classes, $class );

	return array_unique( $classes );
}

add_filter( 'perch_modules/supported_social_links', 'landpick_default_social_links_callback' );
function landpick_default_social_links_callback($array = array()){
	$new_array = array(
		'500px' 		=> array( 'title' => '500px', 'url' => '#', 'icon' => 'fab fa-500px', ),
		'amazon' 		=> array( 'title' => 'Amazon', 'url' => '#', 'icon' => 'fab fa-amazon', ),
		'adn' 			=> array( 'title' => 'Adn', 'url' => '#', 'icon' => 'fab fa-adn', ),
		'android' 		=> array( 'title' => 'Android', 'url' => '#', 'icon' => 'fab fa-android', ),
		'angellist' 	=> array( 'title' => 'Angel list', 'url' => '#', 'icon' => 'fab fa-angellist', ),
		'bandcamp' 		=> array( 'title' => 'Bandcamp', 'url' => '#', 'icon' => 'fab fa-bandcamp', ),
		'behance' 		=> array( 'title' => 'Behance', 'url' => '#', 'icon' => 'fab fa-behance', ),
		'bitbucket' 	=> array( 'title' => 'Bitbucket', 'url' => '#', 'icon' => 'fab fa-bitbucket', ),
		'bitcoin' 		=> array( 'title' => 'Bitcoin', 'url' => '#', 'icon' => 'fab fa-bitcoin', ),
		'codepen' 		=> array( 'title' => 'Codepen', 'url' => '#', 'icon' => 'fab fa-codepen', ),
		'delicious' 	=> array( 'title' => 'Delicious', 'url' => '#', 'icon' => 'fab fa-delicious', ),
		'digg' 			=> array( 'title' => 'Digg', 'url' => '#', 'icon' => 'fab fa-digg', ),
		'dribbble' 		=> array( 'title' => 'Dribbble', 'url' => '#', 'icon' => 'fab fa-dribbble', ),
		'dropbox' 		=> array( 'title' => 'Dropbox', 'url' => '#', 'icon' => 'fab fa-dropbox', ),
		'facebook' 		=> array( 'title' => 'Facebook', 'url' => '#', 'icon' => 'fab fa-facebook-f', ),
		'flickr' 		=> array( 'title' => 'Flickr', 'url' => '#', 'icon' => 'fab fa-flickr', ),
		'git' 			=> array( 'title' => 'Git', 'url' => '#', 'icon' => 'fab fa-git', ),
		'github' 		=> array( 'title' => 'Github', 'url' => '#', 'icon' => 'fab fa-github', ),	
		'gitlab' 		=> array( 'title' => 'Gitlab', 'url' => '#', 'icon' => 'fab fa-gitlab', ),
		'google-plus' 	=> array( 'title' => 'Google-plus', 'url' => '#', 'icon' => 'fab fa-google-plus', ),
		'instagram' 	=> array( 'title' => 'Instagram', 'url' => '#', 'icon' => 'fab fa-instagram', ),
		'jsfiddle' 		=> array( 'title' => 'jsfiddle', 'url' => '#', 'icon' => 'fab fa-jsfiddle', ),
		'linkedin' 		=> array( 'title' => 'Linkedin', 'url' => '#', 'icon' => 'fab fa-linkedin', ),
		'linux' 		=> array( 'title' => 'Linux', 'url' => '#', 'icon' => 'fab fa-linux', ),
		'linode' 		=> array( 'title' => 'Linode', 'url' => '#', 'icon' => 'fab fa-linode', ),
		'medium' 		=> array( 'title' => 'Medium', 'url' => '#', 'icon' => 'fab fa-medium', ),
		'meetup' 		=> array( 'title' => 'Meetup', 'url' => '#', 'icon' => 'fab fa-meetup', ),
		'odnoklassniki' => array( 'title' => 'Odnoklassniki', 'url' => '#', 'icon' => 'fab fa-odnoklassniki', ),
		'paypal' 		=> array( 'title' => 'Paypal', 'url' => '#', 'icon' => 'fab fa-paypal', ),
		'pinterest' 	=> array( 'title' => 'Pinterest', 'url' => '#', 'icon' => 'fab fa-pinterest', ),
		'reddit' 		=> array( 'title' => 'Reddit', 'url' => '#', 'icon' => 'fab fa-reddit', ),
		'scribd' 		=> array( 'title' => 'Scribd', 'url' => '#', 'icon' => 'fab fa-scribd', ),
		'share' 		=> array( 'title' => 'Share-alt', 'url' => '#', 'icon' => 'fab fa-share-alt', ),
		'skype' 		=> array( 'title' => 'Skype', 'url' => '#', 'icon' => 'fab fa-skype', ),
		'slack' 		=> array( 'title' => 'Slack', 'url' => '#', 'icon' => 'fab fa-slack', ),
		'soundcloud' 	=> array( 'title' => 'Soundcloud', 'url' => '#', 'icon' => 'fab fa-soundcloud', ),
		'stack-exchange' => array( 'title' => 'Stack-exchange', 'url' => '#', 'icon' => 'fab fa-stack-exchange', ),
		'stack-overflow' => array( 'title' => 'Stack-overflow', 'url' => '#', 'icon' => 'fab fa-stack-overflow', ),
		'stumbleupon' 	=> array( 'title' => 'Stumbleupon', 'url' => '#', 'icon' => 'fab fa-stumbleupon', ),
		'trello' 		=> array( 'title' => 'Trello', 'url' => '#', 'icon' => 'fab fa-trello', ),
		'tumblr' 		=> array( 'title' => 'Tumblr', 'url' => '#', 'icon' => 'fab fa-tumblr', ),
		'twitter' 		=> array( 'title' => 'Twitter', 'url' => '#', 'icon' => 'fab fa-twitter', ),
		'vimeo' 		=> array( 'title' => 'Vimeo', 'url' => '#', 'icon' => 'fab fa-vimeo', ),
		'vk' 			=> array( 'title' => 'VK', 'url' => '#', 'icon' => 'fab fa-vk', ),
		'whatsapp' 		=> array( 'title' => 'Whatsapp', 'url' => '#', 'icon' => 'fab fa-whatsapp', ),
		'wikipedia' 	=> array( 'title' => 'Wikipedia', 'url' => '#', 'icon' => 'fab fa-wikipedia-w', ),
		'wordpress' 	=> array( 'title' => 'WordPress', 'url' => '#', 'icon' => 'fab fa-wordpress', ),
		'xing' 			=> array( 'title' => 'Xing', 'url' => '#', 'icon' => 'fab fa-xing', ),
		'yahoo' 		=> array( 'title' => 'Yahoo', 'url' => '#', 'icon' => 'fab fa-yahoo', ),
		'yelp' 			=> array( 'title' => 'Yelp', 'url' => '#', 'icon' => 'fab fa-yelp', ),
		'youtube' 		=> array( 'title' => 'Youtube', 'url' => '#', 'icon' => 'fab fa-youtube', ),

	);
	$array = array_merge($array, $new_array );
	return $array;
}

add_filter( 'perch_modules/supported_buttons', 'landpick_default_buttons_set_callback' );
function landpick_default_buttons_set_callback($array = array()){
	$new_array = array(
		'btn1' => array(
			'name' => 'Amazon - image', 
			'title' => 'Buy on amazon', 
			'type' => 'image',
			'url' => '#', 
			'target'=> '_blank',
			'image'=>LANDPICK_URI.'/images/amazon.png',
			'style' => ''
		),
		'btn2' => array(
			'name' => 'App store - image', 
			'title' => 'App store', 
			'type' => 'image',
			'url' => '#', 
			'target'=> '_blank',
			'image'=>LANDPICK_URI.'/images/appstore.png',
			'style' => ''
		),
		'btn3' => array(
			'name' => 'Google play - image', 
			'title' => 'Google play', 
			'type' => 'image',
			'url'=>'#',
			'target'=> '_blank',
			'image'=>LANDPICK_URI.'/images/googleplay.png',
			'style' => ''
		),
		'btn4' => array(
			'name' => 'Get started - text button', 
			'title' => 'Get started', 
			'type' => 'text',
			'url'=>'#',
			'target'=> '_self',
			'style' => ''
		),
		'btn5' => array(
			'name' => 'Contact us - text button', 
			'title' => 'Contact us', 
			'type' => 'text',
			'url'=>'#',
			'target'=> '_self',
			'style' => ''
		),
	);
	$array = array_merge($array, $new_array );

	return $array;
}

function landpick_supported_social_links(){
	$array = landpick_default_social_links_callback();

	$options = get_option('landpick_settings', array());
	if( !empty($options) ):			
	$array = $options['social_links_group'];
	//$array = apply_filters( 'perch_modules/supported_social_links_meta', $array, $meta );
	endif;
	
	return $array;
}

function landpick_supported_buttons(){
	$array = landpick_default_buttons_set_callback();	

	$options = get_option('landpick_settings', array());
	if( !empty($options) ):			
	$array = $options['buttons_group'];
	//$array = apply_filters( 'perch_modules/supported_buttons_meta', $array, $meta );
	endif;	
	return $array;
}

function landpick_supported_social_links_callback($array = array()){	
	$supported = landpick_supported_social_links();
	foreach ($supported as $key => $value) {
		$array[$key] = $value['title'];
	}
	return $array;
}


function landpick_supported_buttons_callback($array = array()){	
	$supported = landpick_supported_buttons();
	foreach ($supported as $key => $value) {		
		$array[$key] = isset($value['name'])? $value['name'] : '';
	}
	return $array;
}

function landpick_predefined_page_templates( $array = array() ){
	$_array = array(
		'blog' => array(
			'title' => __('Blog page', 'landpick'),
			'id' => 'blog-page',
			'class' => 'wide-100 blog-page-section division',
			'sidebar' => array(
				'id' => 'sidebar-right',
				'class' => '',
			),
		),
		'blog_single' => array(
			'title' => get_the_title(),
			'id' => 'single-blog-page',
			'class' => 'wide-100 blog-page-section division',
			'sidebar' => array(
				'id' => 'sidebar-right',
				'class' => '',
			),
		),
		'faqs' => array(
			'title' => __('Faq page', 'landpick'),
			'id' => 'faqs-page',
			'class' => 'bg-fixed download-section division',
		),
		'terms' => array(
			'title' => __('Terms page', 'landpick'),
			'id' => 'terms-page',
			'class' => 'terms-section division',
		),
		'download' => array(
			'title' => __('Download page', 'landpick'),
			'id' => 'download-page',
			'class' => 'bg-fixed download-section division',
		),
		'page' => array(
			'title' => __('Default page', 'landpick'),
			'id' => 'page',
			'class' => 'page-section wide-100 division',
		),
		
	);
	return array_merge($array, $_array);
}
add_filter( 'perch_modules/predefined_page_templates', 'landpick_predefined_page_templates' );

function landpick_predefined_page_templates_options(){
	$array = landpick_predefined_page_templates();
	$output = array();
	if( !empty($array) ):
		foreach ($array as $key => $value) {
			$output[$key] = $value['title'];
		}
	endif;

	return $output;
}

function landpick_get_predefined_template_attr( $id = NULL, $attr = 'class'  ){
	$array = landpick_predefined_page_templates();
	if( $id == NULL ) return false;
	if( !isset($array[$id]) ) return false;
	$template = $array[$id];
	if( !isset($template[$attr]) ) return false;
	$output = $template[$attr];
	return $output;
}

function landpick_set_default_vc_values($default, $args){
	
	foreach ($default as $key => $value) {
        $arrKey = array_search($key, array_column($args, 'param_name'));
        if( !is_array($value) ){
        	if( isset($args[$arrKey]['value']) && is_array($args[$arrKey]['value']) ){
            	$args[$arrKey]['std'] = $value;
	        }elseif( isset($args[$arrKey]['settings']) && is_array($args[$arrKey]['settings']) ){
	        	$args[$arrKey]['std'] = $value;
	        }else{
	            $args[$arrKey]['value'] = $value;
	        }
        }else{
        	$args[$arrKey] = array_merge($args[$arrKey], $value );        	
        }       
    }

    return $args;
}

function landpick_range_css_option($prefix, $property, $args = array()){
	$default = array('start' => 0, 'limit' => 10, 'step' => 1, 'unit' => 'px');
	extract(shortcode_atts($default , $args));

   	$range = landpick_range_option( $start, $limit, $step );
	$array = array();
    foreach( $range as $k => $v ) {
      $array[] = $prefix.$v. ' { '.$property.': '. $v . $unit . '; }';
    } 

   return apply_filters( 'perch_vc_dropdown_options', $array );
}

function landpick_get_social_links_by_options($iconsArr = array(), $args = array()){

	$icon_list = landpick_supported_social_links();	
	$social_links = array();
	if( !empty($iconsArr) ):			
		foreach ($iconsArr as $key => $value) {
			$array = landpick_array_search_by_key_value($icon_list, 'key', $value);		
			$social_links[] = isset($array[0])? $array[0] : '';
		}
	endif;
	$social_links = array_filter($social_links);
	return Landpick::get_social_icons_html($social_links, $args);
}

function landpick_spacing_css_style(){

  	$css = '';
  	// Wide
  	$wide = '.'.landpick_wide_class_prefix();
	$arr = landpick_range_css_option( $wide, 'padding-bottom', array('limit' => 200, 'step' => 10));
	$css .= implode(' ', $arr);
	$arr = landpick_range_css_option( $wide, 'padding-top', array('start' => 100, 'limit' => 200, 'step' => 10));
	$css .= implode(' ', $arr);

	// Ind
	$ind = '.'.landpick_ind_class_prefix();
	$arr = landpick_range_css_option($ind, 'padding-left', array('limit' => 150, 'step' => 5));
	$css .= implode(' ', $arr);
	$arr = landpick_range_css_option($ind, 'padding-right', array('limit' => 150, 'step' => 5));
	$css .= implode(' ', $arr);

	// Margin
	$args = array('limit' => 200, 'step' => 5);
	$mtop  		= '.'.landpick_margin_top_class_prefix();
	$arr = landpick_range_css_option($mtop, 'margin-top', $args );
	$css .= implode(' ', $arr);

	$mright  		= '.'.landpick_margin_right_class_prefix(); 
	$arr = landpick_range_css_option($mright, 'margin-right', $args );
	$css .= implode(' ', $arr);

	$mbottom  	= '.'.landpick_margin_bottom_class_prefix(); 
	$arr = landpick_range_css_option($mbottom, 'margin-bottom', $args );
	$css .= implode(' ', $arr);

	$mleft  	= '.'.landpick_margin_left_class_prefix();
	$arr = landpick_range_css_option($mleft, 'margin-left', $args );
	$css .= implode(' ', $arr);

	// Padding
	$args = array('limit' => 200, 'step' => 5);
	$ptop = '.'.landpick_padding_top_class_prefix();
	$arr = landpick_range_css_option($ptop, 'padding-top', $args );
	$css .= implode(' ', $arr);
	$pbottom = '.'.landpick_padding_bottom_class_prefix();
	$arr = landpick_range_css_option($pbottom, 'padding-bottom', $args );
	$css .= implode(' ', $arr);

	$property = is_rtl()? 'padding-right' : 'padding-left';
	$pleft = '.'.landpick_padding_left_class_prefix();
	$arr = landpick_range_css_option($pleft, $property, $args );
	$css .= implode(' ', $arr);
	$pright = '.'.landpick_padding_right_class_prefix();
	$arr = landpick_range_css_option($pright, 'padding-right', $args );
	$css .= implode(' ', $arr);

  	return $css;
}