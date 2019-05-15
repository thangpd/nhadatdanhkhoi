<?php
function landpick_blog_options( $options = array( ) ) {
    $options = array(        
        array(
             'id' => 'blog_layout',
            'label' => __( 'Blog layout', 'landpick' ),
            'desc' => 'Optional. Only work, When Posts page is not selected in Settings > Reading.',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'blog_options',
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
             'id' => 'blog_layout_sidebar',
            'label' => __( 'Blog Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-post',
            'type' => 'sidebar-select',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'blog_layout:not(full)',
            'operator' => 'and' 
        ),
         array(
             'id' => 'sticky_post_text',
            'label' => __( 'Sticky post text', 'landpick' ),
            'desc' => '',
            'std' => 'Sticky',
            'type' => 'text',
            'section' => 'blog_options',
            'condition' => '',
            'operator' => 'and' 
        ),
         array(
             'id' => 'post_meta_display',
            'label' => __( 'Post meta display', 'landpick' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        /*array(
            'id'          => 'post_meta',
            'label'       => __( 'Post meta options', 'landpick' ),
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
        array(
             'id' => 'excerpt_length',
            'label' => __( 'Excerpt Length', 'landpick' ),
            'desc' => '',
            'std' => '40',
            'type' => 'text',
            'section' => 'blog_options',
            'min_max_step' => '1,150,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'read_more_text',
            'label' => __( 'Read more text', 'landpick' ),
            'desc' => '',
            'std' => 'More Details',
            'type' => 'text',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'next_post_text',
            'label' => __( 'Next post text', 'landpick' ),
            'desc' => '',
            'std' => 'Next',
            'type' => 'text',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'prev_post_text',
            'label' => __( 'Previous post text', 'landpick' ),
            'desc' => '',
            'std' => 'Previous',
            'type' => 'text',
            'section' => 'blog_options' 
        ),
        
    );
    return apply_filters( 'landpick_theme_options', $options, 'blog_options' );
}

foreach ( glob( LANDPICK_DIR . "/admin/options/blog/*-settings.php" ) as $filename ) {
    if( file_exists($filename) ){
        load_template($filename);
    }    
}