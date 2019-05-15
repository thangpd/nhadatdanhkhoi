<?php
/**
 * Initialize the meta boxes. 
 */

add_action( 'admin_init', 'landpick_general_onepage_meta_boxes' );
if( !function_exists('landpick_general_onepage_meta_boxes') ):
function landpick_general_onepage_meta_boxes() {
    $screen = get_current_screen(); 

    $my_meta_box = array(
        'id'        => 'landpick_template_sttings_boxes',
        'title'     => __('Landpick page template Settings', 'landpick'),
        'desc'      => '',
        'pages'     => array( 'page' ),
        'context'   => 'side',
        'priority'  => 'high',
        'fields'    =>  array(
            array(
                'id' => 'landpick_template_type',
                'label' => __('Page template type', 'landpick'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'choices' => array(           
                array( 'label' => 'Default', 'value' => '' ),
                array( 'label' => 'Landing page template', 'value' => 'landing' ),
                array( 'label' => 'Front page template', 'value' => 'frontpage' )
                )
            ),
        ),

      );
    ot_register_meta_box( $my_meta_box );   


    $navarr = array(
            array(
                 'id' => 'nav_general_option_tab',
                'label' => __( 'General settings', 'landpick' ),
                'desc' => __( 'Display social Icon or Buttons', 'landpick' ),
                'type' => 'tab',
                'section' => 'header_options',
                //'class' => 'half-column-size', 
            ),
            array(
                'id' => 'one_page_wp_nav',
                'label' => __('Select Nav menu', 'landpick'),
                'desc' => '<a href="' . admin_url( 'nav-menus.php' ) . '" class="nav-link">' . __( 'Add a menu', 'landpick' ) . '</a>',
                'std' => '',
                'type' => 'select',
                'choices' => landpick_get_terms_choices('nav_menu')
            ),
        ); 



      $my_meta_box = array(
        'id'        => 'landpick_onepage_sttings_boxes',
        'title'     => __('Landing Page Navbar Settings', 'landpick'),
        'desc'      => '',
        'pages'     => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'fields'    =>  array_merge($navarr, landpick_header_options())

      );
      ot_register_meta_box( $my_meta_box );

      $my_meta_box = array(
        'id'        => 'landpick_onepage_footer_sttings_boxes',
        'title'     => __('Landing Page footer Settings', 'landpick'),
        'desc'      => '',
        'pages'     => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'fields'    => array(
            array(
                 'id' => 'onepage_footer_display',
                'label' => __( 'Footer display', 'landpick' ),
                'type' => 'on-off',
                'std' => 'on',
                //'class' => 'half-column-size', 
            ),
            array(
                 'id' => 'quickform_area',
                'label' => __( 'Quick contact form Display','landpick' ),
                'desc' => __( 'Display in bottom of page','landpick' ),
                'std' => 'off',
                'type' => 'on-off',
                'section' => 'footer_options' 
            ),
            array(
                'id' => 'footer_bg_style',
                'label' => __('Footer background style', 'landpick'),
                'desc' => '',
                'std' => landpick_get_option( 'footer_bg_style', 'bg-tra' ),
                'type' => 'select',
                'choices' => landpick_bg_color_options(),
            ),
        )

      );
      ot_register_meta_box( $my_meta_box );

}
endif;