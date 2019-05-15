<?php
function landpick_header_navbar_options( $metabox = false, $args = array( ) ) {
	$options = array();
    $old_options = array( 
        array(
             'id' => 'navbar_style',
            'label' => __( 'Navbar style', 'landpick' ),
            'desc' => '',
            'std' => 'style1',
            'type' => 'select',
            'section' => 'header_options',
            'choices' => array(
                array( 'label' => 'Navbar style #1',  'value' => 'style1' ),
                array( 'label' => 'Navbar style #2',  'value' => 'style2' ),
            )
        ),
    );
    // option tree options to redux options
    $modyfied_option = apply_filters( 'landpick_theme_options', $old_options, 'header_options' );
    $options = array_merge( $options, $modyfied_option );


    $bg_color = array(
        array(
            'id' => 'nav_bg_class',
            'title' => __( 'Navbar background color', 'landpick' ),
            'desc' => '',
            'default' => 'bg-tra',
            'type' => 'select',            
            'prefix' => 'nav_bg',                    
            'options' => landpick_redux_options(landpick_bg_color_options()),                      
        )
    );
    // filter for custom color/gradient settings
    $bg_color = apply_filters( 'landpick/bg-color', $bg_color );
    $options = array_merge( $options, $bg_color);

    $new_options =  array(
        array(
             'id' => 'header_sticky_nav',
            'title' => __( 'Sticky navbar', 'landpick' ),
            'desc' => '',
            'default' => true,
            'type' => 'switch',
        ), 
        array(
             'id' => 'nav_style_scroll',
            'title' => __( 'Navbar background color while scrolling', 'landpick' ),
            'desc' => '',
            'default' => 'black-scroll',
            'type' => 'select',
            'options' => landpick_redux_options(landpick_navscrool_bg_color_options()),  
            'required' => array('header_sticky_nav', '=', true),       
        ),
                       
    );	
    $options = array_merge( $options, $new_options );

    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}