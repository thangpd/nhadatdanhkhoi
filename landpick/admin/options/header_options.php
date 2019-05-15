<?php
function landpick_woo_cart_icon_option( ) {
    if ( function_exists( 'is_woocommerce' ) ) {
        return array(
             'id' => 'header_cart_icon',
            'label' => __( 'Header cart icon display', 'landpick' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'header_options',
            'condition' => '',
            'operator' => 'or' 
        );
    } //function_exists( 'is_woocommerce' )
}
function landpick_langs_dropdown_option( ) {
    return array(
         'id' => 'header_language_dropdown',
        'label' => __( 'Header topbar Language dropdown display', 'landpick' ),
        'desc' => 'This option only applicable when <strong>WPML</strong>, <strong>Polylang</strong> or <strong>Multilanguage by BestWebSoft</strong> plugins are installed',
        'std' => 'on',
        'type' => 'on-off',
        'section' => 'header_options',
        'condition' => '',
        'operator' => 'or' 
    );
}
function landpick_header_options( $metabox = false ) {
    $options = array(
        array(
            'id'       => 'logo_type',
            'type'     => 'button_set',
            'title'    => __( 'Logo type', 'landpick' ), 
            'subtitle'    => __('Choose your site logo', 'landpick'),          
            'options'  => array(
                'image' => 'Image',
                'text' => 'Text',
            ),
            'default'  => 'image'
        ),
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Logo', 'landpick' ),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc'     => '',
            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'landpick' ),
            'default'  => array( 'url' => apply_filters( 'landpick_header_logo_default', LANDPICK_URI . '/images/logo.png') ),
            'hint'      => array(
                'content'   => __('Display on light color navbar background', 'landpick'),
            ),
            'required' => array('logo_type','equals','image')
        ), 
        array(
            'id'       => 'logo_white',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Logo white', 'landpick' ),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc'     => '',
            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'landpick' ),
            'default'  => array( 'url' => apply_filters( 'landpick_header_logo_default', LANDPICK_URI . '/images/logo-white.png') ),
            'hint'      => array(
                'content'   => __('Display on dark type navbar background', 'landpick'),
            ),
            'required' => array('logo_type','equals','image')
        ), 
        array(
            'id'             => 'logo_dimensions',
            'type'           => 'dimensions',
            'units'          => array( 'px' ),    // You can specify a unit value. Possible: px, em, %
            'units_extended' => false,  // Allow users to select any type of unit
            'title'          => __( 'Logo Dimensions (Width/Height)', 'landpick' ),
            'subtitle'       => __( 'Choose width, height', 'landpick' ),
            'default'        => array(
                'width'  => 125,
                'height' => 30,
            ),
            'required' => array('logo_type','equals','image')
        ),
        array(
            'id'    => 'logo_text',
            'type'  => 'text',
            'title' => 'Logo',
            'default' => get_bloginfo( 'name' ),
            'required' => array('logo_type','equals','text')
        ),   
        /*array(        
        'id' => 'header_menu_breakpoint',        
        'label' => __( 'Header menu breakpoint', 'landpick' ),        
        'desc' => 'in pixel',        
        'std' => '800',        
        'type' => 'text',
        'section' => 'header_options'         
        ),*/
        //landpick_langs_dropdown_option(),
        //landpick_woo_cart_icon_option(),         
    );
    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
    
}


foreach ( glob( LANDPICK_DIR . "/admin/options/header/*-settings.php" ) as $filename ) {
    if( file_exists($filename) ){
        load_template($filename);
    }    
}