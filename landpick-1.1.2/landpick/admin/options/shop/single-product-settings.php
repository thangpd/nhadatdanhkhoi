<?php
function landpick_single_product_options( $metabox = false, $args = array( ) ) {
	$options = array();

	$options = array(
        array(
             'id' => 'single_product_header',
            'label' => __( 'Single product header', 'landpick' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'woo_options' 
        ),
        array(
             'id' => 'product_layout',
            'label' => __( 'Product layout', 'landpick' ),
            'desc' => '',
            'std' => 'rs',
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
             'id' => 'product_layout_sidebar',
            'label' => __( 'Product Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-product',
            'type' => 'sidebar-select',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'product_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_image_width',
            'label' => __( 'Single Product Image Width', 'landpick' ),
            'desc' => __( 'This size used in single product page.', 'landpick' ),
            'std' => '600',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '400,1200,5',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_image_height',
            'label' => __( 'Single Product Image height', 'landpick' ),
            'desc' => __( 'This size used in single product page.', 'landpick' ),
            'std' => '700',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '400,1000,5',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_product_display',
            'label' => __( 'Related product show in single product', 'landpick' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'woo_options',
            'condition' => '',
            'operator' => 'and' 
        ), 
        array(
             'id' => 'related_product_title',
            'label' => __( 'Related products title', 'landpick' ),
            'desc' => '',
            'std' => 'Keep Shopping: Related Products',
            'type' => 'text',
            'section' => 'woo_options',
            'condition' => 'related_product_display:is(on)' 
        ),
        array(
             'id' => 'related_product_loop_columns',
            'label' => __( 'Related Products column', 'landpick' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '1,4,1',
            'condition' => 'related_product_display:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_products_per_page',
            'label' => __( 'Related Products display', 'landpick' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '2,12,1',
            'condition' => 'related_product_display:is(on)',
            'operator' => 'and' 
        ),
        
    );
    $options = apply_filters( 'landpick_theme_options', $options, 'blog_options' );

	if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}