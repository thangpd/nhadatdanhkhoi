<?php
function landpick_header_navbar_icons_options( $metabox = false, $args = array( ) ) {
	  

    $options =  array( 
        array(
             'id' => 'header_search_display',
            'title' => __( 'Navbar Search icon display', 'landpick' ),
            'desc' => '',
            'default' => false,
            'type' => 'switch',          
        ),
        array(
             'id' => 'nav_search_placeholder',
            'title' => __( 'Navbar Search placeholder text', 'landpick' ),
            'desc' => '',
            'default' => 'What are you looking for?',
            'type' => 'text',
            'required' => array('header_search_display', '=', true),
        ),
        array(
             'id' => 'header_social_icons_display',
            'title' => __( 'Social Icons display', 'landpick' ),
            'desc' => '',
            'default' => false,
            'type' => 'switch',          
        ),
        array(
            'id'       => 'header_social_icons',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Social Icons', 'landpick'),            
            'desc'     => sprintf(__('You can set up your social settings <a target="_blank" href="%s">here</a>', 'landpick'), admin_url( 'admin.php?page=landpick-settings#tab-social_settings' )),           
            'options'  => landpick_supported_social_links_callback(),
            'default'  => array('facebook','twitter'),
            'required' => array('header_social_icons_display', '=', true),
        ),
        array(
             'id' => 'header_button_display',
            'title' => __( 'Header button display', 'landpick' ),
            'desc' => '',
            'default' => false,
            'type' => 'switch',          
        ),
        array(
            'id'       => 'header_buttons',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Header buttons', 'landpick'),            
            'desc'     => sprintf(__('You can set up your button settings <a target="_blank" href="%s">here</a>', 'landpick'), admin_url( 'admin.php?page=landpick-settings#tab-button_settings' )),           
            'options'  => landpick_supported_buttons_callback(),
            'default'  => array('contact_us'),
            'required' => array('header_button_display', '=', true),
        ),
    );    


    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}