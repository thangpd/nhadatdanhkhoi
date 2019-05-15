<?php
function landpick_footer_newsletter_options( $metabox = false ){
    $options = array(        
        array(
             'id' => 'newsletter_area',
            'title' => __( 'Newsletter area Display', 'landpick' ),
            'desc' => 'Display before footer area',
            'default' => false,
            'type' => 'switch',          
        ),
        array(
             'id' => 'newsletter_title',
            'title' => __( 'Newsletter title', 'landpick' ),
            'desc' => 'Use {} to highlight text',
            'default' => __( 'Subscribe to Landpick Update', 'landpick' ),
            'type' => 'text',
            'required' => array('newsletter_area', '=', 1),
        ),
        array(
             'id' => 'newsletter_subtitle',
            'title' => __( 'Newsletter subtitle', 'landpick' ),
            'desc' => 'Use {} to highlight text',
            'default' => 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius',
            'type' => 'textarea',
            'args' => array('media_buttons' => false, 'wpautop' => false),
            'required' => array('newsletter_area', '=', true),
        ),
        array(
             'id' => 'newsletter_placeholder',
            'title' => __( 'Newsletter email placeholder', 'landpick' ),
            'desc' => '',
            'default' =>  __( 'Your email address', 'landpick' ),
            'type' => 'text',
            'required' => array('newsletter_area', '=', true),
        ),
        array(
             'id' => 'newsletter_footer',
            'title' => __( 'Newsletter footer text', 'landpick' ),
            'desc' => '',
            'default' => 'We don\'t share your personal information with anyone. Check out our <a href="#">Privacy Policy</a> for more information',
            'type' => 'editor',
            'args' => array('media_buttons' => false),
            'required' => array('newsletter_area', '=', true),
        )
    );

    $bg_color = array(
        array(
            'id' => 'newsletter_bg_class',
            'title' => __( 'Newsletter background color', 'landpick' ),
            'desc' => '',
            'default' => 'bg-lightgrey',
            'type' => 'select',            
            'prefix' => 'newsletter_bg',
            'selector' => '.newsletter-section',            
            'options' => landpick_redux_options(landpick_bg_color_options()),
            'required' => array('newsletter_area', '=', true),         
        )
    );
    $bg_color = apply_filters( 'landpick/bg-color', $bg_color );
    $options = array_merge( $options, $bg_color);

    $options = array_merge( $options, array(
        array(
            'id'       => 'newsletter_parallax_switch',
            'type'     => 'switch', 
            'title'    => __('Newsletter background parallax', 'landpick'),            
            'default'  => false,
            'required' => array('newsletter_area', '=', true)
        ),        
        array(
            'id'       => 'newsletter_bg',
            'type'     => 'background',
            'output'   => array( '.newsletter-section .parallax-inner' ),
            'title'    => __( 'Newsletter parallax background', 'landpick' ),
            'subtitle' => __( 'Newsletter background with image, color, etc.', 'landpick' ),
            'preview' => true,
            'preview_media' => false,
            'background-clip' => true,
            'background-origin' => true,
            'background-color' => false,
            'preview_height' => '200px',
            'default'  => array( 'background-size' => 'cover',),
            'required' => array('newsletter_parallax_switch', '=', true)
        ),
        array(
            'id'            => 'newsletter_parallax_opacity',
            'type'          => 'slider',
            'title'         => __( 'Newsletter parallax opacity', 'landpick' ),
            'desc'          => __( 'Min: 0, max: 1, step: .1, default value: 1', 'landpick' ),
            'default'       => 1,
            'min'           => 0,
            'step'          => .1,
            'max'           => 1,
            'resolution'    => 0.1,
            'display_value' => 'text',
            'required' => array('newsletter_parallax_switch','equals',true)
        ),
        array(
             'id' => 'cta_area_display',
            'title' => __( 'Call to action area Display', 'landpick' ),
            'desc' => 'Display before footer area',
            'default' => false,
            'type' => 'switch',          
        ),
        array(
             'id' => 'cta_title',
            'title' => __( 'Call to action title', 'landpick' ),
            'desc' => 'Use {} to highlight text',
            'default' => __( 'Have a project in mind? Let\'s discuss', 'landpick' ),
            'type' => 'text',
            'required' => array('cta_area_display', '=', true),
        ),
        array(
             'id' => 'cta_subtitle',
            'title' => __( 'Call to action subtitle', 'landpick' ),
            'desc' => 'Use {} to highlight text',
            'default' => 'Donec vel sapien augue integer urna vel turpis cursus porta, mauris sed augue luctus dolor velna auctor congue tempus magna integer',
            'type' => 'textarea',
            'args' => array('media_buttons' => false, 'wpautop' => false),
            'required' => array('cta_area_display', '=', true),
        ),
        array(
             'id' => 'cta_button_text',
            'title' => __( 'Call to action button text', 'landpick' ),
            'default' => __( 'Let\'s Started', 'landpick' ),
            'type' => 'text',
            'required' => array('cta_area_display', '=', true),
        ),
        array(
             'id' => 'cta_button_link',
            'title' => __( 'Call to action button link', 'landpick' ),
            'default' => '#',
            'type' => 'text',
            'required' => array('cta_area_display', '=', true),
        ),
    ));

	

    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}