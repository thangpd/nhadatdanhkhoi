<?php
function landpick_general_options( $options = array() ) {
    $_options = array(
        array(
            'id'       => 'landpick_layout_style',
            'type'     => 'button_set',
            'title'    => __( 'Global layout design', 'landpick' ), 
            'desc'    => __('Globally effect on theme buttons, form elements etc', 'landpick'),          
            'options'  => array(
                'rounded' => 'Rounded',
                'semirounded' => 'Semi-rounded',
                'flat' => 'Flat'
            ),
            'default'  => 'semirounded'
        ),
        array(
            'id'       => 'preloader_display',
            'type'     => 'button_set',
            'title'    => __( 'Preloader display', 'landpick' ),           
            'options'  => array(
                'none' => 'None',
                'default' => 'Default preloader',
                'custom' => 'Custom preloader'
            ),
            'default'  => 'default'
        ),
        
    );
    $options = array(                   
        array(
             'id' => 'custom_preloader',
            'label' => __( 'Custom preloader image', 'landpick' ),
            'desc' => '',
            'std' => LANDPICK_URI . '/images/preloader.png',
            'type' => 'upload',
            'section' => 'general_options',
            'condition' => 'preloader_display:is(custom)',
            'operator' => 'and' 
        ),                      
        array(
             'id' => 'google_map_api',
            'label' => __( 'Google map API', 'landpick' ),
            'desc' => 'Authentication for the standard API - API keys. <br><a class="button" href="//console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank"><strong>Get an API key</strong></a>',
            'std' => '',
            'type' => 'text',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
            'id'       => 'social_links',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Social Links', 'landpick'),            
            'desc'     => sprintf(__('You can set up your social settings <a target="_blank" href="%s">here</a>', 'landpick'), admin_url( 'admin.php?page=landpick-settings#tab-social_settings' )),           
            'options'  => landpick_supported_social_links_callback(),
            'default'  => landpick_general_options_social_link(),            
        ),
        array(
             'id' => 'search_placeholder',
            'label' => __( 'Search Placeholder Text', 'landpick' ),
            'desc' => '',
            'std' => 'Search...',
            'type' => 'text',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ),       
        
    );
    $options =  apply_filters( 'landpick_theme_options', $options, 'general_options' );

    return array_merge($_options, $options);
}

function landpick_general_advanced_options(){

    $options = array( 
        array(
             'id' => 'admin_logo',
            'label' => __( 'Admin logo', 'landpick' ),
            'desc' => '',
            'std' => LANDPICK_URI . '/images/logo.png',
            'type' => 'upload',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ), 
        array(
            'id'          => 'vc_admin_view',
            'label'       => __( 'Visual composer element preview', 'landpick' ),
            'desc'        => __('Only worked in VC admin page edit', 'landpick'),
            'std'         => 'full',
            'type'        => 'select',
            'section'     => 'general_options',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'   => array(
                array(
                    'label' => 'Full preview',
                    'value' => 'full' 
                    ),
                array(
                    'label' => 'Simple preview',
                    'value' => 'simple' 
                    ),
                )
        ),
        
    );

    return  apply_filters( 'landpick_theme_options', $options, 'general_options' );

}