<?php
function landpick_single_post_options( $metabox = false, $args = array( ) ) {
	$options = array();

	$options = array(
        array(
             'id' => 'single_post_header',
            'label' => __( 'Single post header', 'landpick' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'single_layout',
            'label' => __( 'Single post layout', 'landpick' ),
            'desc' => '',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'blog_options',
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
             'id' => 'single_layout_sidebar',
            'label' => __( 'Single post Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-post',
            'type' => 'sidebar-select',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'single_layout:not(full)',
            'operator' => 'and' 
        ),
        /*array(
            'id'          => 'single_post_meta',
            'label'       => __( 'Single post meta options', 'landpick' ),
            'std'         => array('date', 'category', 'comment'),
            'type'        => 'checkbox',
            'section'     => 'blog_options',
            'condition'   => 'post_meta_display:is(on)',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'date',
                'label'       => __( 'Post date', 'landpick' ),
              ),
              array(
                'value'       => 'category',
                'label'       => __( 'Post category', 'landpick' ),
              ),
              array(
                'value'       => 'author',
                'label'       => __( 'Post author', 'landpick' ),
              ),
              array(
                'value'       => 'comment',
                'label'       => __( 'Post comments', 'landpick' ),
              )
            )
        ),*/
        array(
             'id' => 'single_post_share',
            'label' => __( 'Single post share', 'landpick' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'realted_post_display',
            'label' => __( 'Display related posts', 'landpick' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'related_title',
            'label' => __( 'Related Posts title', 'landpick' ),
            'desc' => '',
            'std' => 'Related Posts',
            'type' => 'text',
            'section' => 'blog_options',
            'condition' => 'realted_post_display:is(on)' 
        ),
        array(
             'id' => 'realted_post_base',
            'label' => __( 'Related posts based on', 'landpick' ),
            'desc' => '',
            'std' => 'tag',
            'type' => 'select',
            'section' => 'blog_options',
            'condition' => 'realted_post_display:is(on)', 
            'choices' => array(
                array( 'label' => 'Tags',  'value' => 'tag' ),
                array( 'label' => 'Category',  'value' => 'category' ),
            )
        ),
        /*array(
            'id'          => 'related_post_meta',
            'label'       => __( 'Related post meta options', 'landpick' ),
            'std'         => array('date', 'category'),
            'type'        => 'checkbox',
            'section'     => 'blog_options',
            'condition'   => 'post_meta_display:is(on)',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'date',
                'label'       => __( 'Post date', 'landpick' ),
              ),
              array(
                'value'       => 'category',
                'label'       => __( 'Post category', 'landpick' ),
              ),
              array(
                'value'       => 'author',
                'label'       => __( 'Post author', 'landpick' ),
              ),
              array(
                'value'       => 'comment',
                'label'       => __( 'Post comments', 'landpick' ),
              )
            )
        ),*/
        
    );
    $options = apply_filters( 'landpick_theme_options', $options, 'blog_options' );

	if($metabox){
        return apply_filters( 'landpick/redux_to_metaboxes', $options);
    }else{
        return $options;
    }
}