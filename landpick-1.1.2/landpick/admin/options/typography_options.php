<?php
function landpick_recognized_font_families( $families ) {
    $families[ 'roboto' ] = 'Roboto';
    $families[ 'montserrat' ] = 'Montserrat';
    return $families;
}
add_filter( 'ot_recognized_font_families', 'landpick_recognized_font_families' );
function landpick_filter_typography_fields( $array, $field_id ) {
    if ( $field_id == "primary_font" ) {
        $array = array(
             'font-family' 
        );
    } //$field_id == "primary_font"
    if ( $field_id == "secondary_font" ) {
        $array = array(
             'font-family' 
        );
    } //$field_id == "secondary_font"
    return $array;
}

function landpick_typography_options( $args = array() ) {    

    $options  = array(
        array(
            'id'       => 'body',
            'type'     => 'typography',
            'title'    => __( 'Body Font', 'landpick' ),
            'subtitle' => __( 'Specify the global body font properties.', 'landpick' ),
            'font_family_clear' => false,
            'google'   => true,
            'font-backup' => true,
            'non-google' => 'Arial',
            'letter-spacing'=> false,
            'font-size'     => true,
            'line-height'   => false,
            'text-align'   => false,
            'units'       => 'px',
            'output' => array('body'),
            'default'  => array(
                'color'       => '#333',
                'font-weight'  => '300',
                'font-family' => 'Roboto',                 
                'font-size'     => '16px',               
            ),
        ),
        array(
            'id'       => 'heading',
            'type'     => 'typography',
            'title'    => __( 'Heading Font', 'landpick' ),
            'subtitle' => __( 'Specify the heading font properties.', 'landpick' ),
            'google'   => true,
            'font-backup' => true,
            'letter-spacing'=> true,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'   => false,
            'units'       => 'px',
            'output' => array('h1, h2, h3, h4, h5, h6'),
            'default'  => array(
                'color'       => '#222',
                'font-weight'  => '700',
                'font-family' => 'Montserrat', 
                'non-google' => 'Arial',              
                'letter-spacing' => '0',               
            ),
        ), 
        array(
            'id'       => 'logo_text_typo',
            'type'     => 'typography',
            'title'    => __( 'Text Logo typography settings', 'landpick' ),
            'subtitle' => __( 'Specify the Logo font properties.', 'landpick' ),
            'google'   => true,
            'letter-spacing'=> true,
            'font-size'     => true,
            'font-style'     => true,
            'text-transform' => true,
            'line-height'   => true,
            'text-align'   => true,
            'compiler' => true,
            'units'       => 'rem',
            'output' => array('.navbar-light .logo-text, .navbar-dark .logo-text'),
            'default'  => array(                       
                'font-size'     => '3rem',               
            ),
            'preview' => array(
                'text' => get_bloginfo( 'name' ),
                'font-size' => '3rem',
                'always_display' => true
            ),
        ),
    );
    return $options;
}

foreach ( glob( LANDPICK_DIR . "/admin/options/typography/*-settings.php" ) as $filename ) {
    include $filename;
}