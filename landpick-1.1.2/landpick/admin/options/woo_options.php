<?php
function landpick_woo_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'shop_layout',
            'label' => __( 'Shop layout', 'landpick' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and',
            'choices' => array(
                 array(
                     'value' => 'full',
                    'label' => __( 'Full width', 'landpick' ),
                    'src' => LANDPICK_URI . '/admin/assets/images/layout/full-width.png' 
                ),
                array(
                     'value' => 'ls',
                    'label' => __( 'Left sidebar', 'landpick' ),
                    'src' => LANDPICK_URI . '/admin/assets/images/layout/left-sidebar.png' 
                ),
                array(
                     'value' => 'rs',
                    'label' => __( 'Right sidebar', 'landpick' ),
                    'src' => LANDPICK_URI . '/admin/assets/images/layout/right-sidebar.png' 
                ) 
            ) 
        ),
        array(
             'id' => 'shop_layout_sidebar',
            'label' => __( 'Select shop Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-product',
            'type' => 'sidebar-select',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'shop_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'loop_columns',
            'label' => __( 'Products column', 'landpick' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '1,4,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'shop_per_page',
            'label' => __( 'Products per page', 'landpick' ),
            'desc' => '',
            'std' => '9',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '-1,15,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'catalog_image_width',
            'label' => __( 'Catalog Images Width', 'landpick' ),
            'desc' => __( 'The size used in product listing.', 'landpick' ),
            'std' => '400',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '350,1200,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'catalog_image_height',
            'label' => __( 'Catalog Images height', 'landpick' ),
            'desc' => __( 'The size used in product listing.', 'landpick' ),
            'std' => '500',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '350,1000,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),

        
    );
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return apply_filters( 'landpick_theme_options', $options, 'woo_options' );
    } //in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
    else {
        $options = array(
             array(
                 'id' => 'woo_info',
                'label' => 'Woocommerce',
                'desc' => __( 'Woocommerce plugin is Required. Installed & activated woocommerce plugin to get Woo options', 'landpick' ),
                'std' => '3',
                'type' => 'textblock',
                'section' => 'woo_options' 
            ) 
        );
        return apply_filters( 'landpick_theme_options', $options, 'woo_options' );
    }
}

foreach ( glob( LANDPICK_DIR . "/admin/options/shop/*-settings.php" ) as $filename ) {
    if( file_exists($filename) ){
        load_template($filename);
    }    
}