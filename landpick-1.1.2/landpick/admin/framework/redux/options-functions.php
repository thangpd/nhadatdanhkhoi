<?php
if (!function_exists('landpick_options_id')){
    function landpick_options_id(){
        return apply_filters('landpick_options_id', 'option_tree');
    }
}

if (!function_exists('landpick_settings_id')) {
    function landpick_settings_id(){
        return apply_filters('landpick_settings_id', 'option_tree_settings');
    }
}

if (!function_exists('landpick_layouts_id')){
    function landpick_layouts_id(){
        return apply_filters('landpick_layouts_id', 'option_tree_layouts');
    }
}

if (!function_exists('landpick_echo_option')) {
    function landpick_echo_option($option_id, $default = ''){
        echo landpick_get_option($option_id, $default);
    }
}

if (!function_exists('landpick_wpml_filter')) {
    function landpick_wpml_filter($options, $option_id){
        // Return translated strings using WMPL
        if (function_exists('icl_t')) {
            $settings = get_option(landpick_settings_id());
            if (isset($settings['settings'])) {
                foreach ($settings['settings'] as $setting) {
                    // List Item & Slider
                    if ($option_id == $setting['id'] && in_array($setting['type'], array(
                        'list-item',
                        'slider'
                    ))) {
                        foreach ($options[$option_id] as $key => $value) {
                            foreach ($value as $ckey => $cvalue) {
                                $id      = $option_id . '_' . $ckey . '_' . $key;
                                $_string = icl_t('Theme Options', $id, $cvalue);
                                if (!empty($_string)) {
                                    $options[$option_id][$key][$ckey] = $_string;
                                }
                            }
                        }
                        // List Item & Slider
                    } else if ($option_id == $setting['id'] && $setting['type'] == 'social-links') {
                        foreach ($options[$option_id] as $key => $value) {
                            foreach ($value as $ckey => $cvalue) {
                                $id      = $option_id . '_' . $ckey . '_' . $key;
                                $_string = icl_t('Theme Options', $id, $cvalue);
                                if (!empty($_string)) {
                                    $options[$option_id][$key][$ckey] = $_string;
                                }
                            }
                        }
                        // All other acceptable option types
                    } else if ($option_id == $setting['id'] && in_array($setting['type'], apply_filters('landpick_wpml_option_types', array(
                            'text',
                            'textarea',
                            'textarea-simple'
                        )))) {
                        $_string = icl_t('Theme Options', $option_id, $options[$option_id]);
                        if (!empty($_string)) {
                            $options[$option_id] = $_string;
                        }
                    }
                }
            }
        }
        return $options[$option_id];
    }
}

if (!function_exists('landpick_load_dynamic_css')) {
    function landpick_load_dynamic_css(){
        /* don't load in the admin */
        if (is_admin()) {
            return;
        }
        
        if (false === (bool) apply_filters('landpick_load_dynamic_css', true)) {
            return;
        }
        /* grab a copy of the paths */
        $landpick_css_file_paths = get_option('landpick_css_file_paths', array());
        if (is_multisite()) {
            $landpick_css_file_paths = get_blog_option(get_current_blog_id(), 'landpick_css_file_paths', $landpick_css_file_paths);
        }
        if (!empty($landpick_css_file_paths)) {
            $last_css = '';
            /* loop through paths */
            foreach ($landpick_css_file_paths as $key => $path) {
                if ('' != $path && file_exists($path)) {
                    $parts = explode('/wp-content', $path);
                    if (isset($parts[1])) {
                        $sub_parts = explode('/', $parts[1]);
                        if (isset($sub_parts[1]) && isset($sub_parts[2])) {
                            if ($sub_parts[1] == 'themes' && $sub_parts[2] != get_stylesheet()) {
                                continue;
                            }
                        }
                        $css = set_url_scheme(WP_CONTENT_URL) . $parts[1];
                        if ($last_css !== $css) {
                            /* enqueue filtered file */
                            //wp_enqueue_style('ot-dynamic-' . $key, $css, false, OT_VERSION);
                            $last_css = $css;
                        }
                    }
                }
            }
        }
    }
}

if (!function_exists('landpick_load_google_fonts_css')) {
    function landpick_load_google_fonts_css(){
        /* don't load in the admin */
        if (is_admin())
            return;
        $landpick_google_fonts     = get_theme_mod('landpick_google_fonts', array());
        $landpick_set_google_fonts = get_theme_mod('landpick_set_google_fonts', array());
        $families            = array();
        $subsets             = array();
        $append              = '';
        if (!empty($landpick_set_google_fonts)) {
            foreach ($landpick_set_google_fonts as $id => $fonts) {
                foreach ($fonts as $font) {
                    // Can't find the font, bail!
                    if (!isset($landpick_google_fonts[$font['family']]['family'])) {
                        continue;
                    }
                    // Set variants & subsets
                    if (!empty($font['variants']) && is_array($font['variants'])) {
                        // Variants string
                        $variants = ':' . implode(',', $font['variants']);
                        // Add subsets to array
                        if (!empty($font['subsets']) && is_array($font['subsets'])) {
                            foreach ($font['subsets'] as $subset) {
                                $subsets[] = $subset;
                            }
                        }
                    }
                    // Add family & variants to array
                    if (isset($variants)) {
                        $families[] = str_replace(' ', '+', $landpick_google_fonts[$font['family']]['family']) . $variants;
                    }
                }
            }
        }
        if (!empty($families)) {
            $families = array_unique($families);
            // Append all subsets to the path, unless the only subset is latin.
            if (!empty($subsets)) {
                $subsets = implode(',', array_unique($subsets));
                if ($subsets != 'latin') {
                    $append = '&subset=' . $subsets;
                }
            }
           
        }
    }
}

if (!function_exists('landpick_register_theme_options_adminbar_menu')) {
    function landpick_register_theme_options_adminbar_menu($wp_admin_bar){
        if (!current_user_can(apply_filters('landpick_theme_options_capability', 'edit_theme_options')) || !is_admin_bar_showing())
            return;
        $wp_admin_bar->add_node(array(
            'parent' => 'appearance',
            'id' => apply_filters('landpick_theme_options_menu_slug', 'ot-theme-options'),
            'title' => apply_filters('landpick_theme_options_page_title', __('Theme Options', 'landpick')),
            'href' => admin_url(apply_filters('landpick_theme_options_parent_slug', 'themes.php') . '?page=' . apply_filters('landpick_theme_options_menu_slug', 'ot-theme-options'))
        ));
    }
}