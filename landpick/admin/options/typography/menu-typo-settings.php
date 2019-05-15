<?php
function landpick_menu_typography_options( $args = array() ){
    $options  = array(
        array(
            'id'       => 'menu_a',
            'type'     => 'typography',
            'title'    => __( 'First lavel menu', 'landpick' ),
            'subtitle' => __( 'Specify the First lavel menu item font properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'font-backup' => false,
            'non-google' => 'Arial',
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-transform' => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('.navbar-expand-lg .navbar-nav .nav-link'),
            'default'  => array(
                'font-weight'  => '600',
                'font-family' => 'Montserrat',                
                'font-size'     => '0.85rem',               
            ),
        ),
        array(
            'id'       => 'submenu_a',
            'type'     => 'typography',
            'title'    => __( 'Second lavel menu', 'landpick' ),
            'subtitle' => __( 'Specify the Second lavel menu item font properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-transform' => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('.dropdown-item, .dropdown-menu li a'),
            'default'  => array(
                'font-weight' => '500',                  
                'font-size'     => '1rem',               
            ),
        ),
        array(
            'id'       => 'submenu_ul_a',
            'type'     => 'typography',
            'title'    => __( 'Third lavel menu', 'landpick' ),
            'subtitle' => __( 'Specify the Third lavel menu item font properties.', 'landpick' ),
            'font_family_clear' => true,
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'line-height'   => true,
            'text-transform' => true,
            'text-align'   => false,
            'units'       => 'rem',
            'output' => array('.dropdown-item li a, .dropdown-menu ul li a'),
            'default'  => array(
                'font-weight' => '500',                  
                'font-size'     => '1rem',               
            ),
        ),
    );

    return apply_filters( 'landpick/menu_typography_options', $options, $args );
}