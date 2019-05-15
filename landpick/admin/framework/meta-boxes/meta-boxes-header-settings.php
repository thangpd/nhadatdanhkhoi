<?php
function landpick_header_settings_meta_boxes() {
	$meta_boxes = array(
            array (
                'id' => 'one_page_wp_nav',
                'type' => 'select',
                'column' => 'column-1',
                'name' => __('Landing page Nav menu', 'landpick'),
                'placeholder' => 'Select nav menu',
                'options' => landpick_get_terms_choices('nav_menu'),
                'tab' => 'General_settings',
                'visible' => array(
                    'when' => array(
                        array ('landpick_template_type','=','landing'),
                    ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'title_display',
                'type' => 'switch',
                'name' => 'Display title',
                'style' => 'square',
                'on_label' => 'ON',
                'off_label' => 'OFF',
                'tab' => 'General_settings',
                'std' => array(1)
            ),
            array (
                'id' => 'custom_title',
                'type' => 'switch',
                'name' => 'Custom title',
                'style' => 'square',
                'on_label' => 'ON',
                'off_label' => 'OFF',
                'tab' => 'General_settings',
                'visible' => array(
                    'when' => array(
                        array ( 'title_display', '=', 1 ),
                    ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'title',
                'type' => 'text',
                'name' => 'Title',
                'desc' => 'Optional, Leave blank to show the main title.',
                'columns' => 12,
                'class' => 'widfet',
                'tab' => 'General_settings',
                'visible' => array(
                    'when' => array(
                        array ( 'custom_title', '=', 1 ),
                    ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'subtitle',
                'type' => 'textarea',
                'name' => 'Subtitle',
                'desc' => 'Optional, Leave blank to avoid.',
                'tab' => 'General_settings',
                'visible' => array(
                    'when' => array(
                        array ( 'custom_title', '=', 1 ),
                    ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'shortcode',
                'type' => 'text',
                'name' => 'Shortcode',
                'desc' => 'Optional, Leave blank to avoid.',
                'tab' => 'General_settings',
                'visible' => array(
                    'when' => array(
                        array ( 'title_display', '=', 0 ),
                    ),
                    'relation' => 'and',
                ),
            ),          
            array (
                'id' => 'custom_logo_settings',
                'type' => 'switch',
                'name' => 'Custom logo settings',
                'desc' => 'By default all options comes from Theme options.',
                'style' => 'square',
                'on_label' => 'ON',
                'off_label' => 'OFF',
                'tab' => 'navbar_settings',
            ),          
            array (
                'id' => 'logo_settings_group',
                'type' => 'group',
                'fields' => landpick_header_options(true),
                'default_state' => 'expanded',
                'collapsible' => true,
                'save_state' => true,
                'group_title' => 'Logo settings',
                'tab' => 'navbar_settings',
                'visible' => array(
                    'when' => array(
                        array ( 'custom_logo_settings', '=', 1),
                    ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'divider_10',
                'type' => 'divider',
                'name' => 'Divider',
                'tab' => 'navbar_settings',
            ),
            array (
                'id' => 'custom_nav_settings',
                'type' => 'switch',
                'name' => 'Custom nav settings',
                'desc' => 'By default all options comes from Theme options.',
                'style' => 'square',
                'on_label' => 'ON',
                'off_label' => 'OFF',
                'tab' => 'navbar_settings',
            ),
            array (
                'id' => 'navbar_settings_group',
                'type' => 'group',
                'fields' => landpick_header_navbar_options(true),
                'default_state' => 'collapsed',
                'collapsible' => true,
                'save_state' => true,
                'group_title' => 'Navbar settings',
                'tab' => 'navbar_settings',
                'visible' => array(
                    'when' => array( array ( 'custom_nav_settings', '=', 1 ) ),
                    'relation' => 'and',
                ),
            ),
            array (
                'id' => 'divider_11',
                'type' => 'divider',
                'name' => 'Divider',
                'tab' => 'navbar_settings',
            ),
            array (
                'id' => 'custom_nav_icon_settings',
                'type' => 'switch',
                'name' => 'Custom nav icon settings',
                'desc' => 'By default all options comes from Theme options.',
                'style' => 'square',
                'on_label' => 'ON',
                'off_label' => 'OFF',
                'tab' => 'navbar_settings',
            ),
            array (
                'id' => 'navbar_icon_settings',
                'type' => 'group',
                'fields' => landpick_header_navbar_icons_options(true),
                'default_state' => 'collapsed',
                'collapsible' => true,
                'save_state' => true,
                'group_title' => 'Navbar settings',
                'tab' => 'navbar_settings',
                'visible' => array(
                    'when' => array( array ( 'custom_nav_icon_settings', '=', 1 ) ),
                    'relation' => 'and',
                ),
            ),          
            array (
                'id' => 'divider_18',
                'type' => 'divider',
                'name' => 'Divider',
                'tab' => 'navbar_settings',
            ),
        );
	

	return $meta_boxes;
}