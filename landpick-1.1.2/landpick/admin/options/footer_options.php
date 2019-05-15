<?php
function landpick_footer_options( $metabox = false, $options = array() ) {
    $old_options = array(
        /*array(
            'id' => 'footer_bg_style',
            'label' => __('Footer background style', 'landpick'),
            'desc' => '',
            'std' => 'bg-tra',
            'type' => 'select',
            'choices' => landpick_bg_color_options(),
            'section' => 'footer_options'
        ),*/
        /*
        array(
        'id'          => 'footer_background',
        'label'       => __( 'Footer background', 'landpick' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_widget_area:is(on)',
        'operator'    => 'and',
        'action'   => array()
      ), */       
         
    );
    $bg_color = array(
        array(
            'id' => 'footer_bg_class',
            'title' => __( 'Footer background style', 'landpick' ),
            'desc' => '',
            'default' => 'bg-tra',
            'type' => 'select',            
            'prefix' => 'footer_bg',
            'selector' => 'footer.footer',            
            'options' => landpick_redux_options(landpick_bg_color_options()),                     
        )
    );
    $bg_color = apply_filters( 'landpick/bg-color', $bg_color );
    $options = array_merge( $options, $bg_color);
    // Filter for option tree to redux options
    //$modyfied_option = apply_filters( 'landpick_theme_options', $old_options, 'footer_options' );
    //$options = array_merge( $options, $modyfied_option );


    if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}

foreach ( glob( LANDPICK_DIR . "/admin/options/footer/*-settings.php" ) as $filename ) {
    if( file_exists($filename) ){
        load_template($filename);
    }    
}