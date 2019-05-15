<?php
add_filter( 'perch_modules/icon_type_options', 'landpick_vc_icon_type_options' );
function landpick_vc_icon_type_options($args){
    $args['Tonicons'] = 'tonicons';
    $args['Flaticon'] = 'flaticon';
    return $args;
}

add_filter( 'perch_modules/icon_type_std', 'landpick_vc_icon_type_std' );
function landpick_vc_icon_type_std($std){
    $std = 'flaticon';
    return $std;
}

add_filter('perch_modules/vc_icon_type_element', 'landpick_vc_tonicon_icon_type_element');
function landpick_vc_tonicon_icon_type_element($args){
    $args = array(
        landpick_vc_icon_set( array(), 'tonicons', 'icon_tonicons', 'ti-Line-Key-2', 'icon_type')
    );
    return $args;
}

add_filter('perch_modules/vc_icon_type_element', 'landpick_vc_flaticon_icon_type_element');
function landpick_vc_flaticon_icon_type_element($args){
    $args = array(
        landpick_vc_icon_set( array(), 'flaticon', 'icon_flaticon', 'flaticon-080-shield', 'icon_type')
    );
    return $args;
}

add_filter('perch_modules/buttons/common_class', 'landpick_buttons_common_class');
function landpick_buttons_common_class($args){
    $args = array('btn');
    return $args;
}

add_filter('perch_modules/button/default_icon', 'landpick_button_default_icon');
function landpick_button_default_icon(){
	return '';
}

add_filter('perch_modules/content_list/list_type/value', 'landpick_content_list_type_options');
function landpick_content_list_type_options($args){
    $args = array(
        'Option list' => 'option-list theme-list mt-30',
        'Content list' => 'content-list',
    );
    return $args;
}

add_filter('perch_modules/content_list/list_type/std', 'landpick_content_list_type_std');
function landpick_content_list_type_std(){
    return 'option-list theme-list mt-30';
}

add_filter('perch_modules/content_list/output', 'landpick_content_list_type_output', 10, 2);
function landpick_content_list_type_output($value, $atts){
    $list_type = $icon_fontawesome = $icon_size = $icon_type = $li_spacing_left = $icon_html = '';        
    extract($atts); 

    if('option-list theme-list mt-30' == $list_type){
        $icon_fontawesome = ( $icon_fontawesome != '' )? $icon_fontawesome : 'fas fa-check';
        $value = '<div class="cbox-4"><span class="white-color"><i class="'.esc_attr($icon_fontawesome).'"></i></span><div class="cbox-4-txt '.esc_attr($li_spacing_left).'">'.$value.'</div></div>';
    }

    if('content-list' == $list_type){
        $icon_classes = array( 'fa-li', 'fa-'.$icon_size );
        $icon_classes[] = ( $icon_type == 'fontawesome' )? $icon_color : '';
        $icon_classes = array_filter($icon_classes); 
        if( ( $icon_type == 'fontawesome' ) && ($icon_fontawesome != '') ){
            wp_enqueue_style( 'font-awesome' );
            $icon_html = '<span class="'.implode(' ', $icon_classes).'"><i class="'.$icon_fontawesome.'"></i></span>';
        }       
        if( $icon_type == 'image' ){
            $icon_html = '<span class="'.implode(' ', $icon_classes).'">
            <img src="'.esc_url($image).'" alt="'.esc_attr($title).'" width="" class="img-fluid">
        </span>';
        }
        $value = $icon_html.'<div class="'.esc_attr($li_spacing_left).'">'.$value.'<div>';
    } 

    if('description-list' == $list_type){
        $icon_classes = array( 'fa-li', 'fa-'.$icon_size );
        $icon_classes[] = ( $icon_type == 'fontawesome' )? $icon_color : '';
        $icon_classes = array_filter($icon_classes); 
        if( ( $icon_type == 'fontawesome' ) && ($icon_fontawesome != '') ){
            wp_enqueue_style( 'font-awesome' );
            $icon_html = '<span class="'.implode(' ', $icon_classes).'"><i class="'.$icon_fontawesome.'"></i></span>';
        }       
        if( $icon_type == 'image' ){
            $icon_html = '<span class="'.implode(' ', $icon_classes).'">
            <img src="'.esc_url($image).'" alt="'.esc_attr($title).'" width="" class="img-fluid">
        </span>';
        }
        $value = $icon_html.'<div class="'.esc_attr($li_spacing_left).'">'.$value.'<div>';
    } 


    return $value;
}

add_filter( 'perch_modules/admin_logo', 'landpick_login_logo' );
function landpick_login_logo( $css ) {
    $logo = ( function_exists( 'landpick_get_option' ) ) ? landpick_get_option( 'admin_logo', LANDPICK_URI . '/images/logo.png' ) : LANDPICK_URI . '/images/logo.png';
    $logo = is_array($logo)? $logo['url'] : $logo;
    $css = 'body.login div#login h1 a {
            background-image: url(' . esc_url( $logo ) . ');
            background-position: bottom center; 
        }';

    return $css;
}