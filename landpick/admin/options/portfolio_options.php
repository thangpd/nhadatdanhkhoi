<?php
function landpick_portfolio_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'Portfolio_option_tab',
            'label' => __( 'Portfolio settings', 'landpick' ),
            'type' => 'tab',
            'section' => 'portfolio_options',
        ),
         array(
             'id' => 'portfolio_archive',
            'label' => 'Portfolio Archive page',
            'desc' => sprintf( __( 'If archive page is not working, then save again <a href="%s" target="_blank">permalink settings</a>, For best performance use Pretty permalink(Example: Post name, Day and name etc)', 'landpick' ), admin_url( 'options-permalink.php' ) ),
            'std' => ( get_post_status( get_option( 'portfolio_archive_id' ) ) == 'publish' ) ? get_option( 'portfolio_archive_id' ) : '',
            'type' => 'page-select',
            'section' => 'portfolio_options',
            'rows' => '' 
        ),
        array(
             'id' => 'portfolio_single_layout',
            'label' => __( 'Single portfolio layout', 'landpick' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'portfolio_options',
            'operator' => 'and',
            'choices' => array(
                 array(
                     'value' => 'full',
                    'label' => __( 'Full width', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/full-width.png' 
                ),
                array(
                     'value' => 'ls',
                    'label' => __( 'Left sidebar', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/left-sidebar.png' 
                ),
                array(
                     'value' => 'rs',
                    'label' => __( 'Right sidebar', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/right-sidebar.png' 
                ) 
            ) 
        ),
        array(
             'id' => 'portfolio_single_layout_sidebar',
            'label' => __( 'Single portfolio Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-1',
            'type' => 'sidebar-select',
            'section' => 'portfolio_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'portfolio_single_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'display_single_related_portfolio',
            'label' => __( 'Related portfolio', 'landpick' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'portfolio_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_portfolio_title',
            'label' => __( 'Related portfolio title', 'landpick' ),
            'desc' => '',
            'std' => 'Related portfolio',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_single_related_portfolio:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_portfolio',
            'label' => __( 'Related portfolio display', 'landpick' ),
            'min_max_step' => '-1,20,1',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'portfolio_options',
            'condition' => 'display_single_related_portfolio:is(on)',
            'operator' => 'and' 
        ), 
        array(
             'id' => 'Team_option_tab',
            'label' => __( 'Team settings', 'landpick' ),
            'type' => 'tab',
            'section' => 'portfolio_options',
        ),       
        array(
             'id' => 'team_archive',
            'label' => 'Team Archive page',
            'desc' => sprintf( __( 'If archive page is not working, then save again <a href="%s" target="_blank">permalink settings</a>, For best performance use Pretty permalink(Example: Post name, Day and name etc)', 'landpick' ), admin_url( 'options-permalink.php' ) ),
            'std' => ( get_post_status( get_option( 'team_archive_id' ) ) == 'publish' ) ? get_option( 'team_archive_id' ) : '',
            'type' => 'page-select',
            'section' => 'portfolio_options',
            'rows' => '' 
        ),
        array(
             'id' => 'display_team_hiring',
            'label' => __( 'Display team hiring', 'landpick' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'portfolio_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_title',
            'label' => __( 'Team hiring title', 'landpick' ),
            'desc' => '',
            'std' => 'We Are Hiring!',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_link_text',
            'label' => __( 'Team hiring link text', 'landpick' ),
            'desc' => '',
            'std' => 'Become part of our team',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_link',
            'label' => __( 'Team hiring link', 'landpick' ),
            'desc' => '',
            'std' => '#',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_single_layout',
            'label' => __( 'Single team layout', 'landpick' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'portfolio_options',
            'operator' => 'and',
            'choices' => array(
                 array(
                     'value' => 'full',
                    'label' => __( 'Full width', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/full-width.png' 
                ),
                array(
                     'value' => 'ls',
                    'label' => __( 'Left sidebar', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/left-sidebar.png' 
                ),
                array(
                     'value' => 'rs',
                    'label' => __( 'Right sidebar', 'landpick' ),
                    'src' => OT_URL . '/assets/images/layout/right-sidebar.png' 
                ) 
            ) 
        ),
        array(
             'id' => 'team_single_layout_sidebar',
            'label' => __( 'Single portfolio Sidebar', 'landpick' ),
            'desc' => '',
            'std' => 'sidebar-page',
            'type' => 'sidebar-select',
            'section' => 'portfolio_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'team_single_layout:not(full)',
            'operator' => 'and' 
        ),
    );
    return apply_filters( 'landpick_theme_options', $options, 'portfolio_options' );
}
?>