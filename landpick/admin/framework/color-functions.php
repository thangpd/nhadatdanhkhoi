<?php
add_filter( 'perch_default_color_classes', 'landpick_default_color_classes'); 
function landpick_default_color_classes(){
  $array = array(
    'tra' => array('label' => 'Transparent color', 'value' => 'transparent' ),
    'light' => array('label' => 'Light color', 'value' => '#fff' ),
    'white' => array('label' => 'White color', 'value' => '#fff' ),   
    'black' => array('label' => 'Black color', 'value' => '#333' ),   
    'preset' => array('label' => 'Preset color', 'value' => landpick_get_option('primary_color', landpick_primary_color())), 
    'preset2' => array('label' => 'Preset color 2', 'value' => landpick_get_option('primary_color_2', landpick_primary_color())), 
    'dark' => array('label' => 'Dark color', 'value' => '#222', 'color' => '#000' ),
    'lightdark' => array('label' => 'Dark color - Light', 'value' => '#252d35'),
    'deepdark' => array('label' => 'Dark color - Deep', 'value' => '#1a1a1a'),
    'grey' => array('label' => 'Grey color', 'value' => '#ede9e6', 'color' => '#666'),
    'lightgrey' => array('label' => 'Grey color - Light', 'value' => '#f2f2f2', 'color' => '#858585'),    
    'deepgrey' => array('label' => 'Grey color - Deep', 'value' => '#ddd'),        
    'red' => array('label' => 'Red color', 'value' => '#e35029'),
    'rose' => array('label' => 'Red color - Rose', 'value' => '#ff3366'),
    'tomato' => array('label' => 'Red color - Tomato', 'value' => '#eb2f5b'),
    'coral' => array('label' => 'Red color - Coral', 'value' => '#ea5c5a'),
    'redplum' => array('label' => 'Red color - Plum', 'value' => '#8E3178'),
    'yellow' => array('label' => 'Yellow color', 'value' => '#fed841', 'color' => '#fcb80b'),    
    'yellowKoromiko' => array('label' => 'Yellow color - Koromiko', 'value' => '#feb75f'),    
    'green' => array('label' => 'Green color', 'value' => '#42a045', 'color' => '#56a959'),
    'lightgreen' => array('label' => 'Green color - Light', 'value' => '#59bd56', 'color' => '#22bc3f'),
    'deepgreen' => array('label' => 'Green color - Deep', 'value' => '#009587'),
    'greensushi' => array('label' => 'Green color - Sushi', 'value' => '#80a63f'),
    'greenscooter' => array('label' => 'Green color - Scooter', 'value' => '#2abdc7'),
    'blue' => array('label' => 'Blue color', 'value' => '#2154cf', 'color' => '#3176ed'),
    'lightblue' => array('label' => 'Blue color - Light', 'value' => '#1e88e5'),
    'skyblue' => array('label' => 'Blue color - Skyblue', 'value' => '#01b7de'),
    'deepblue' => array('label' => 'Blue color - Deep', 'value' => '#004861'),
    'bluebayoux' => array('label' => 'Blue color - Bayoux', 'value' => '#517082'),
    'tinyblue' => array('label' => 'Blue color - Tiny', 'value' => '#e6f9fa'),
    'blueyonder' => array('label' => 'Blue color - Wild Yonder', 'value' => '#8a8cbd'),
    'purple' => array('label' => 'Purple color', 'value' => '#6e45e2'),
    'deeppurple' => array('label' => 'Purple color - Deep', 'value' => '#691883', 'color' => '#691883'),
    'lightpurple' => array('label' => 'Purple color - Light', 'value' => '#e79aff'),
    'tinypurple' => array('label' => 'Purple color - Tiny', 'value' => '#f3ccff'),
    'purplesmoky' => array('label' => 'Purple color - Smoky', 'value' => '#6b507d'),
  );
  return apply_filters( 'landpick_default_color_classes', $array);
}


add_filter('perch_modules/default_dark_color_classes', 'landpick_default_dark_color_classes');
function landpick_default_dark_color_classes( $args = array() ){

    if ( is_array( $args ) ) {
        extract( shortcode_atts( array(
             'prefix' => 'bg-',
            'postfix' => '',
        ), $args ) );
    }

    $array = array( 'preset', 'preset2', 'black', 'deepdark', 'dark', 'lightdark', 'rose', 'red', 'green', 'lightgreen', 'deepgreen', 'blue','skyblue', 'deepblue', 'lightblue', 'purple','deeppurple', 'lightpurple', 'tomato', 'coral', 'tra-dark', 'greensushi', 'blueyonder', 'tinypurple', 'redplum', 'greenscooter', 'purplesmoky', 'yellowKoromiko', 'bluebayoux' );

    if($prefix != ''){
        $oldarr = $array;
        $array = array();
        foreach ($oldarr as $key => $value) {
            $array[] = $prefix.$value;
        }
    }

    if($postfix != ''){
        $oldarr = $array;
        $array = array();
        foreach ($oldarr as $key => $value) {
            $array[] = $value.$postfix;
        }
    }
    return apply_filters( 'landpick_default_dark_color_classes', $array);
}

function landpick_setup_theme_supported_features() {
    $colorArr = landpick_default_color_classes();
    unset($colorArr['tra']);
    unset($colorArr['light']);
    $colors = array();
    foreach ($colorArr as $key => $value) {
        $colors[] = array(
            'name' => esc_attr($value['label']),
            'slug' => $key,
            'color' => esc_attr($value['value']),
        );
    }
    add_theme_support( 'editor-color-palette', $colors);
}

add_action( 'after_setup_theme', 'landpick_setup_theme_supported_features' );


add_action('perch_modules/get_color_options', 'landpick_get_color_options');
function landpick_get_color_options( $prefix = '', $postfix = '', $label_postfix = '' ){
    $arr = landpick_default_color_classes();   
    foreach ($arr as $key => $value) {
    	$key = $prefix.$key.$postfix;
        $colorArr[$key] = $value['label'].$label_postfix; 
    }    
    return $colorArr;
}


add_filter('perch_modules/get_allowed_color_class', 'landpick_get_allowed_text_color_class');
if( !function_exists('landpick_get_allowed_text_color_class') ){
	function landpick_get_allowed_text_color_class($array){
		$new_array = landpick_get_color_options('', '-color');
		$array = array_merge($array, $new_array);
		$array = array_flip($array);
		return $array;
	}
}

add_filter('perch_modules/get_allowed_btn_class', 'landpick_get_allowed_btn_class');
if( !function_exists('landpick_get_allowed_btn_class') ){
	function landpick_get_allowed_btn_class($array){

		$new_array = landpick_get_color_options('btn-', '');
		$array = array_merge($array, $new_array);
		$new_array = landpick_get_color_options('btn-tra-', '', ' border + Transparent bg');
		$array = array_merge($array, $new_array);

		$array = array_flip($array);
		return $array;
	}
}

add_filter('perch_modules/get_allowed_underline_class', 'landpick_get_allowed_underline_class');
if( !function_exists('landpick_get_allowed_underline_class') ){
	function landpick_get_allowed_underline_class($array){
		$new_array = landpick_get_color_options('underline-', '');
		$array = array_merge($array, $new_array);
		$array = array_flip($array);
		return $array;
	}
}