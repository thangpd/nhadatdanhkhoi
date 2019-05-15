<?php
function landpick_header_background_options( $args = array( ) ) {   

    $options = array(  
        array(
            'id'       => 'title_display',
            'type'     => 'switch', 
            'title'    => __('Header breadcrumbs display', 'landpick'),            
            'default'  => true,
        ),         
        array(
            'id'       => 'header_bg_style',
            'type'     => 'button_set',
            'title'    => __( 'Header background type', 'landpick' ),
            'subtitle'    => __('Choose your site header background type', 'landpick'),          
            'options'  => array(
                '' => 'Inherit',
                'solid' => 'Solid/Gradient color',
            ),
            'default'  => 'solid'
        ),       
    );

    $bg_color = array(
        array(
            'id' => 'header_bg_class',
            'title' => __( 'Header background color', 'landpick' ),
            'desc' => '',
            'default' => 'bg-light',
            'type' => 'select',            
            'prefix' => 'header_bg',
            'selector' => '#breadcrumbs-hero',            
            'options' => landpick_redux_options(landpick_bg_color_options()),
            'required' => array( 
                array('header_bg_style','!=',''),
            )           
        )
    );
    $bg_color = apply_filters( 'landpick/bg-color', $bg_color );

    $options = array_merge( $options, $bg_color);
    $options = array_merge( $options, array( 
        array(
            'id'       => 'header_parallax_switch',
            'type'     => 'switch', 
            'title'    => __('Header background parallax', 'landpick'),            
            'default'  => false,
        ),
        array(
            'id'       => 'header_parallax_bg',
            'type'     => 'background',
            'output'   => array( '#breadcrumbs-hero .parallax-inner' ),
            'title'    => __( 'Header parallax background', 'landpick' ),
            'subtitle' => __( 'Header background with image, color, etc.', 'landpick' ),
            'preview' => true,
            'preview_media' => false,
            'background-clip' => true,
            'background-origin' => true,
            'background-color' => false,
            'preview_height' => '200px',
            'default'  => array(
                'background-size' => 'cover',
            ),
            'required' => array('header_parallax_switch','equals',true)
        ),
        array(
            'id'            => 'header_parallax_opacity',
            'type'          => 'slider',
            'title'         => __( 'Header parallax opacity', 'landpick' ),
            'desc'          => __( 'Min: 0, max: 1, step: .1, default value: 1', 'landpick' ),
            'default'       => 1,
            'min'           => 0,
            'step'          => .1,
            'max'           => 1,
            'resolution'    => 0.1,
            'display_value' => 'text',
            'required' => array('header_parallax_switch','equals',true)
        ),
               
    ));
    return $options;
}