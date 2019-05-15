<?php
function landpick_h2_typography_options( $args = array() ){
    $options  = array(
        array(
            'id'       => 'h2-xs',
            'type'     => 'typography',
            'title'    => __( 'H2 extra small', 'landpick' ),
            'subtitle' => __( 'Specify the global h2 font properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('h2.h2-xs'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '',  
                'letter-spacing' => '',              
                'line-height' => '',             
            ),
        ),
        array(
            'id'       => 'h2-sm',
            'type'     => 'typography',
            'title'    => __( 'H2 small', 'landpick' ),
            'subtitle'    => __( 'h2.h2-sm', 'landpick' ),
            'desc' => __( 'Specify the h2 small properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('h2.h2-sm'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '',
                'letter-spacing' => '',              
                'line-height' => '',               
            ),
        ),
        array(
            'id'       => 'h2-md',
            'type'     => 'typography',
            'title'    => __( 'H2 medium', 'landpick' ),
            'subtitle' => __( 'Specify the h2 medium properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('h2.h2-md'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '',  
                'letter-spacing' => '',              
                'line-height' => '',             
            ),
        ),
        array(
            'id'       => 'h2-lg',
            'type'     => 'typography',
            'title'    => __( 'H2 large', 'landpick' ),
            'subtitle' => __( 'Specify the h2 large properties.', 'landpick' ),           
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'compiler' => array('h2.h2-lg'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '', 
                'letter-spacing' => '',              
                'line-height' => '',              
            ),
        ),
        array(
            'id'       => 'h2-xl',
            'type'     => 'typography',
            'title'    => __( 'H2 extra large', 'landpick' ),
            'subtitle' => __( 'Specify the h2 extra large properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('h2.h2-xl'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '',
                'letter-spacing' => '',              
                'line-height' => '',               
            ),
        ), 
        array(
            'id'       => 'h2-huge',
            'type'     => 'typography',
            'title'    => __( 'H2 huge', 'landpick' ),
            'subtitle' => __( 'Specify the h2 huge properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('h2.h2-huge'),
            'default'  => array(
                'color'       => '',
                'font-style'  => '',
                'font-family' => '',                 
                'font-size'     => '',  
                'letter-spacing' => '',              
                'line-height' => '',              
            ),
        ),
    );
    return $options;
}