<?php
include LANDPICK_DIR . '/admin/vc-icons.php';

if ( function_exists( 'vc_set_as_theme' ) ):
    vc_set_as_theme( $disable_updater = false );
endif;
$dir = get_template_directory() . '/vc_templates';
vc_set_shortcodes_templates_dir( $dir );



function landpick_vc_column_class_options(){
    $array = array(
        '' => 'None',
        'content-boxes' => 'Content box',
        'content-txt' => 'Content Text', 
        'hero-txt' => 'Hero Text',
        'box-rounded' => 'Rounded border',
        'hero-img' => 'Hero image',
        'content-img' => 'Content image',
        'features-img' => 'Features image',
        'download-img' => 'Download image',
    );
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = $key;
    }
    return $new_arr;
}

add_filter( 'vc_font_container_output_data', 'landpick_vc_font_container_output_data', 10, 4 );
function landpick_vc_font_container_output_data( $data, $fields, $values, $settings ){
   $r = json_encode($values);
    $data['color'] = '
        <div class="vc_row-fluid vc_column vc_col-sm-4">
            <div class="wpb_element_label">' . __( 'Text color', 'landpick' ) . '</div>
            <div class="vc_font_container_form_field-color-container">
                <select class="vc_font_container_form_field-color-input">';
        $colors = landpick_vc_color_options(false);
        foreach ( $colors as $color ) {
            $data['color'] .= '<option value="' . $color . '" class="' . $color . '" ' . ( $values['color'] == $color ? 'selected' : '' ) . '>' . $color . '</option>';
        }
        $data['color'] .= '
                </select>
            </div>';
        if ( isset( $fields['color_description'] ) && strlen( $fields['color_description'] ) > 0 ) {
            $data['color'] .= '
            <span class="vc_description clear">' . $fields['color_description'] . '</span>
            ';
        }

    $data['color'] .= '</div>';

    

    return $data;            
}


function landpick_vc_hero_options(){
    $array = array('Layout 1', 'Layout 2', 'Layout 3', 'Layout 4', 'Layout 5',
        'Layout 6', 'Layout 7', 'Layout 8', 'Layout 9', 'Layout 10',
        'Layout 11', 'Layout 12');
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = ($key+1);
    }
    return $new_arr;
}

add_action( 'vc_after_init', 'landpick_vc_typography_param_options' );
function landpick_vc_typography_param_options(){
    $hl_group = __( 'Title options', 'landpick' );
    $hl_dep = array( 'element' => 'custom_title', 'value' => 'yes' );
    $newParamData = array(
        array(
            'type' => 'textfield',
            'value' => 'We bring the best things',
            'heading' => 'Title',
            'param_name' => 'title',
            'admin_label' => true,
            'edit_field_class' => 'vc_col-sm-8', 
        ),
        array(
            'type' => 'checkbox',
            'heading' => __( 'Custom title options?', 'landpick' ),
            'param_name' => 'custom_title',
            'value' => array( __( 'Yes', 'landpick' ) => 'yes' ), 
            'admin_label' => true,
            'edit_field_class' => 'vc_col-sm-4',
        ), 
        array(
            'type' => 'dropdown',
            'heading' => 'Title tag',
            'param_name' => 'title_tag',
            'value' => landpick_vc_tag_options(),
            'std' => 'h3',
            'group' => $hl_group,
            'edit_field_class' => 'vc_col-sm-4', 
            'dependency' => $hl_dep,
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Size',
            'param_name' => 'title_size',
            'value' => landpick_vc_size_class_options(),
            'group' => $hl_group,
            'edit_field_class' => 'vc_col-sm-4', 
            'dependency' => $hl_dep,
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Title color', 'landpick' ),
            'param_name' => 'title_color',
            'value' => landpick_vc_color_options(false),
            'group' => $hl_group,
            'edit_field_class' => 'vc_col-sm-4', 
            'dependency' => $hl_dep,
        ),
       

         
    );
    foreach ( $newParamData as $key => $value ) {       
        vc_update_shortcode_param( 'landpick_title_area', $value );
    }
}

add_action( 'vc_after_init', 'landpick_vc_heighlights_text_param_options' );
function landpick_vc_heighlights_text_param_options(){
    $hl_group = __( 'Highlight text options', 'landpick' );
    $hl_dep = array( 'element' => 'highlight_text', 'value' => 'yes' );
    $newParamData = array(
        array(
            'type' => 'checkbox',
            'heading' => __( 'Enable highlight text options?', 'landpick' ),
            'param_name' => 'highlight_text',
            'description' => __( 'Checked to select enable highlight text option', 'landpick' ),
            'value' => array( __( 'Yes', 'landpick' ) => 'yes' ), 
            'admin_label' => true
        ), 
        array(
             'type' => 'dropdown',
            'heading' => __( 'Underline for highlight text', 'landpick' ),
            'param_name' => 'highlight_text_underline',
            'value' => landpick_vc_underline_color_options(),
            'std' => 'underline-yellow',
            'group' => $hl_group,
            'dependency' => $hl_dep, 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Highlight text bg', 'landpick' ),
            'param_name' => 'highlight_text_bg',
            'value' => landpick_vc_background_options(true),
            'group' => $hl_group,  
            'std' => '',
            'description' => __( 'Only worked for highlighted text', 'landpick' ),
            'dependency' => $hl_dep,  
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Highlight text color', 'landpick' ),
            'param_name' => 'highlight_text_color',
            'value' => landpick_vc_color_options(true),
            'std' => '',
            'group' => $hl_group,
            'dependency' => $hl_dep,
        ),
       landpick_vc_tag_options_param( 'highlight_text_tag', 'Highlight text tag', 'span', $hl_group, $hl_dep ),
       landpick_vc_size_options_param( 'highlight_text_size', 'Title size', '', $hl_group, $hl_dep ),
       landpick_vc_weight_options_param( 'highlight_text_weight', 'Title weight', '', $hl_group, $hl_dep ),
       
        landpick_vc_animation_type('fadeInUp'),
        landpick_vc_animation_duration(),
        landpick_vc_spacing_options_param('margin', 'top'),
        landpick_vc_spacing_options_param('margin', 'bottom'), 
        landpick_vc_spacing_options_param('padding', 'left'),
        landpick_vc_spacing_options_param('padding', 'right'),
         
    );
    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'landpick_counter_up', $value );
        vc_update_shortcode_param( 'landpick_service_box', $value );       
    }
}


function landpick_vc_style_options($name = "Style", $total = 3){

    $new_arr = array();
    $new_arr["None"] = '';
    for ($i = 1; $i <= $total; $i++) { 
        $new_arr["{$name} {$i}"] = $i;
    }
    return $new_arr;
}

function landpick_vc_section_type_params( $param_name = '', $optiontype = "", $total = 3, $dep="" ){
    if( $param_name == '' ) return false;
    if( $optiontype == '' ) return false;

    return array(
             'type' => 'dropdown',
            'heading' => __( 'Choose', 'landpick' ).' '.esc_attr($optiontype),
            'param_name' => $param_name,
            'group' => 'Landpick Settings',
            'value' => landpick_vc_style_options($optiontype, $total),
            'description' => __( 'You need to add also hero element in this section, then it worked perfectly. Hero style select mean changes the default background, font size, spacing etc. of this section.', 'landpick' ),
            'std'  => '',
            'edit_field_class' => 'vc_col-sm-4',
            'description' => '',
            'dependency' => array(
                'element' => 'section_type',
                'value' => $dep 
            ) 
        );
}

function landpick_vc_row_type_params( $param_name = '', $optiontype = "", $total = 3, $dep="" ){
    if( $param_name == '' ) return false;
    if( $optiontype == '' ) return false;

    return array(
             'type' => 'dropdown',
            'heading' => __( 'Choose', 'landpick' ).' '.esc_attr($optiontype),
            'param_name' => $param_name,
            'group' => 'Landpick Settings',
            'value' => landpick_vc_style_options($optiontype, $total),
            'description' => __( 'You need to add also hero element in this section, then it worked perfectly. Hero style select mean changes the default background, font size, spacing etc. of this section.', 'landpick' ),
            'std'  => '',
            'description' => '',
            'dependency' => array(
                'element' => 'row_type',
                'value' => $dep 
            ) 
        );
}

function landpick_vc_column_type_params( $param_name = '', $optiontype = "", $total = 3, $dep="" ){
    if( $param_name == '' ) return false;
    if( $optiontype == '' ) return false;

    return array(
             'type' => 'dropdown',
            'heading' => __( 'Choose', 'landpick' ).' '.esc_attr($optiontype),
            'param_name' => $param_name,
            'group' => 'Landpick Settings',
            'value' => landpick_vc_style_options($optiontype, $total),
            'description' => __( 'You need to add also hero element in this section, then it worked perfectly. Hero style select mean changes the default background, font size, spacing etc. of this section.', 'landpick' ),
            'std'  => '',
            'description' => '',
            'dependency' => array(
                'element' => 'column_inner_style',
                'value' => $dep 
            ) 
        );
}



if ( !function_exists( 'landpick_get_posts_dropdown' ) ):
    function landpick_get_posts_dropdown( $args = array( ) ) {
        global $wpdb, $post;
        $dropdown  = array( );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $dropdown[ get_the_ID() ] = get_the_title();
            } //$the_query->have_posts()
        } //$the_query->have_posts()
        wp_reset_postdata();
        return $dropdown;
    }
endif;
if ( !function_exists( 'landpick_get_terms' ) ):
    function landpick_get_terms( $tax = 'category', $key = 'id' ) {
        $terms = array( );
        if ( !taxonomy_exists( $tax ) )
            return false;
        if ( $key === 'id' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->term_id ] = $term->name;
        elseif ( $key === 'slug' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->slug ] = $term->name;
        return $terms;
    }
endif;

function landpick_vc_icontype_dropdown( $name = 'icon_type', $value = array( 'flaticon' => 'flaticon', 'Linecons' => 'linecons', 'Entypo' => 'entypo', 'Typicons' => 'typicons', 'Openiconic' => 'openiconic', 'Fontawesome' => 'fontawesome' ) ) {
    return array(
         'type' => 'dropdown',
        'heading' => __( 'Icon type', 'landpick' ),
        'param_name' => $name,
        'description' => '',
        'value' => $value 
    );
}

function landpick_vc_icon_set( $arr, $type, $name = 'icon_fontawesome', $value = '', $dependency = '' ) {
    $arr = array(
         'type' => 'iconpicker',
        'heading' => __( 'Icon', 'landpick' ),
        'param_name' => $name,
        'value' => $value,
        'settings' => array(
             'emptyIcon' => true,
            'type' => $type,
            'iconsPerPage' => 4000 
        ),
        'description' => __( 'Select icon from library.', 'landpick' ) ,
    );
    if ( $dependency != '' ) {
        $arr[ 'dependency' ][ 'element' ] = $dependency;
        $arr[ 'dependency' ][ 'value' ]   = $type;
    } //$dependency != ''
    return $arr;
}

add_filter( 'perch_modules/vc_icon_set', 'landpick_vc_icon_set', 10, 5);

function landpick_vc_animation_duration( $label = false, $default = 300 ){
    return array(
                 'type' => 'textfield',
                'value' => intval($default),
                'heading' => __( 'Animation delay', 'landpick' ) ,
                'param_name' => 'animation_delay',
                'admin_label' => $label,
                'description' => __( 'Number only', 'landpick' ),                
                'group' => __( 'Animation', 'landpick' ),   
                'dependency' => array(
                    'element' => 'css_animation',
                    'value_not_equal_to' => 'none'
                )             
            );
}

function landpick_vc_animation_type($std = ''){
    $output = vc_map_add_css_animation();
    $output['group'] = __( 'Animation', 'landpick' );

    if( $std != '' ) $output['std'] = esc_attr($std);

    return $output;
}

add_filter( 'landpick_vc_element_params', 'landpick_vc_element_params_callback' );
function landpick_vc_element_params_callback($args){
    $args['params'][] = landpick_vc_animation_type();
    $args['params'][] = landpick_vc_animation_duration();
    return $args;
}

function landpick_animation_attr($css_animation, $animation_delay = 100){
    $output = '';
    if($css_animation == '') return $output;  
    $output .= ' data-wow-delay="'.intval($animation_delay).'ms"';

    return $output;
}
function landpick_vc_tag_options(){
    $arr = array(
        __('Default', 'landpick') => '',
        __('H1', 'landpick') => 'h1',
        __('H2', 'landpick') => 'h2',
        __('H3', 'landpick') => 'h3',
        __('H4', 'landpick') => 'h4',
        __('H5', 'landpick') => 'h5',
        __('H6', 'landpick') => 'h6',
        __('P', 'landpick') => 'p',                
        __('Span', 'landpick') => 'span',       
        __('Small', 'landpick') => 'small',       
        __('Strong', 'landpick') => 'strong', 
        __('Div', 'landpick') => 'div',
        __('Footer', 'landpick') => 'footer', 
         __('Underline', 'landpick') => 'u',      
        __('Blockquote', 'landpick') => 'blockquote',               
        __('Address', 'landpick') => 'address',       
        __('em', 'landpick') => 'em',       
        __('Del', 'landpick') => 'del',       
        __('Mark', 'landpick') => 'mark',       
        __('S', 'landpick') => 's',       
        __('Ins', 'landpick') => 'ins',       
        __('Code', 'landpick') => 'code',       
        __('Pre', 'landpick') => 'pre',       
        __('Var', 'landpick') => 'var',       
        __('kbd', 'landpick') => 'kbd',       
        __('samp', 'landpick') => 'samp',       
             
    );

    return $arr;
}
function landpick_vc_size_class_options(){
    $arr = array(
        __('Default', 'landpick') => '',
        __('Huge', 'landpick') => 'huge',
        __('Extra large', 'landpick') => 'xl',
        __('Large', 'landpick') => 'lg',
        __('Medium', 'landpick') => 'md',
        __('Small', 'landpick') => 'sm',
        __('Extra small', 'landpick') => 'xs',
    );

    return $arr;
}

function landpick_vc_weight_class_options(){
    $arr = array(
        __('Default', 'landpick') => '',
        __('Font weight thin', 'landpick') => 'txt-300',    
        __('Font weight normal', 'landpick') => 'txt-400',
        __('Font weight 500', 'landpick') => 'txt-500',    
        __('Font weight 600', 'landpick') => 'txt-600',    
        __('Font weight Bold', 'landpick') => 'txt-700',    
        __('Font weight 800', 'landpick') => 'txt-800',    
        __('Font weight 900', 'landpick') => 'txt-900',  
         __('Section id', 'landpick') => 'section-id',  
    );

    return $arr;
}
function landpick_vc_tag_options_param($param_name, $heading='', $std = '', $group='', $dep=array()){    
    
    $arr = array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => landpick_vc_tag_options(),
                'group' => __( 'Design option', 'landpick' ),
                'save_always' => true,
            );
    if( $std != '' ) $arr['std'] = $std;
    if( $group != '' ) $arr['group'] = $group;
    if( !empty($dep) ) $arr['dependency'] = $dep;

    return $arr;
}
function landpick_vc_size_options_param($param_name, $heading='', $std = '', $group='', $dep=array()){    
   
    $arr = array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => landpick_vc_size_class_options(),
                'group' => __( 'Design option', 'landpick' ),
            );
    if( $std != '' ) $arr['std'] = $std;
    if( $group != '' ) $arr['group'] = $group;
    if( !empty($dep) ) $arr['dependency'] = $dep;
    
    return $arr;
}

function landpick_vc_weight_options_param($param_name, $heading='', $std = '', $group='', $dep=array()){    
    $arr = array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => landpick_vc_weight_class_options(),
                'group' => __( 'Design option', 'landpick' ),
            );
    if( $std != '' ) $arr['std'] = $std;
    if( $group != '' ) $arr['group'] = $group;
    if( !empty($dep) ) $arr['dependency'] = $dep;
    
    return $arr;
}

function landpick_vc_color_options_param($param_name, $heading='', $std = '', $group='', $dep=array()){    
    $arr = array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => landpick_vc_color_options(true),
                'group' => __( 'Design option', 'landpick' ),
            );
    if( $std != '' ) $arr['std'] = $std;
    if( $group != '' ) $arr['group'] = $group;
    if( !empty($dep) ) $arr['dependency'] = $dep;
    
    return $arr;
}

function landpick_vc_heading_size_options(){
    $arr = array(
        __('H2 Normal', 'landpick') => 'h2:h2-normal',
        __('H2 Huge', 'landpick') => 'h2:h2-huge',
        __('H2 extra large', 'landpick') => 'h2:h2-xl',
        __('H2 Large', 'landpick') => 'h2:h2-lg',
        __('H2 Medium', 'landpick') => 'h2:h2-md',
        __('H2 small', 'landpick') => 'h2:h2-sm',
        __('H2 Extra small', 'landpick') => 'h2:h2-xs',
        
        __('H3 Normal', 'landpick') => 'h3:h3-normal',
        __('H3 extra large', 'landpick') => 'h3:h3-xl',
        __('H3 Large', 'landpick') => 'h3:h3-lg',
        __('H3 Medium', 'landpick') => 'h3:h3-md',
        __('H3 small', 'landpick') => 'h3:h3-sm',
        __('H3 Extra small', 'landpick') => 'h3:h3-xs',

         __('H4 extra large', 'landpick') => 'h4:h4-xl',
        __('H4 Large', 'landpick') => 'h4:h4-lg',
        __('H4 Medium', 'landpick') => 'h4:h4-md',
        __('H4 small', 'landpick') => 'h4:h4-sm',
        __('H4 Extra small', 'landpick') => 'h4:h4-xs',

        __('H5 extra large', 'landpick') => 'h5:h5-xl',
        __('H5 Large', 'landpick') => 'h5:h5-lg',
        __('H5 Medium', 'landpick') => 'h5:h5-md',
        __('H5 small', 'landpick') => 'h5:h5-sm',
        __('H5 Extra small', 'landpick') => 'h5:h5-xs',
    );

    return $arr;
}

function landpick_vc_icon_class_options(){
    $arr = array(
        __('None', 'landpick') => 'none',
        __('Rotation 90 deg', 'landpick') => 'fa-rotate-90',
         __('Rotation 180 deg', 'landpick') => 'fa-rotate-180',
         __('Rotation 270 deg', 'landpick') => 'fa-rotate-270',
         __('Mirrors icon horizontally', 'landpick') => 'fa-flip-horizontal',
         __('Mirrors icon vertically', 'landpick') => 'fa-flip-vertical',
         __('Spinner', 'landpick') => 'fa-spin',
    );
    return $arr;
}
function landpick_vc_underline_color_options(){
    $arr = array(
        __('None', 'landpick') => 'none',
        __('Image', 'landpick') => 'underline-image',
         __('Font weight bold', 'landpick') => 'font-weight-bold',
         __('Font weight thin', 'landpick') => 'txt-300',
         __('Font weight thiner', 'landpick') => 'txt-100',
         __('Italic text', 'landpick') => 'font-italic',
         __('Indicates uppercased text', 'landpick') => 'text-uppercase',
    );

    $colors = landpick_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'underline-'.$key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}
function landpick_vc_global_color_options(){
    $arr = array();

    $colors = landpick_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = $key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}

function landpick_vc_text_size_options(){
    return array(
        __('Default', 'landpick') => '',
        __('Small', 'landpick') => 'p-sm',
        __('Medium', 'landpick') => 'p-md',
        __('large', 'landpick') => 'p-lg',
        __('Font weight bold', 'landpick') => 'p-lg font-weight-bold',
         __('Italic text', 'landpick') => 'p-lg font-italic',
         __('Indicates uppercased text', 'landpick') => 'p-lg text-uppercase',
    );
}

function landpick_vc_spacing_options($type='padding', $pos = 'bottom'){
    $total = apply_filters('landpick_vc_spacing_total', 120);
    $arr = array();
    $prefix = ($type == 'padding')? 'p' : 'm';
    $_pos = ($pos == 'bottom')? 'b' : 't';
    $prefix = $prefix.$_pos.'-';
    $arr = array(
        __('Inherit', 'landpick') => '',     
    );
    for ($i=0; $i <= $total; $i+=5) { 
        $name = ucfirst($type).' '.$pos. ' '.$i.'px';
       $arr[$name] = $prefix.$i; 
    }
    return $arr;
}


function landpick_vc_spacing_options_param($type = 'padding', $pos = 'bottom', $name = ''){
    $prefix = ($type == 'padding')? 'p' : 'm';
    $param_name = $prefix.$pos;
    $param_name = ( $name != '' )? $name : $param_name;
    $heading = ucfirst($type).' '.$pos;
    return array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => landpick_vc_spacing_options($type, $pos),
                'group' => __( 'Spacing option', 'landpick' ),
                'edit_field_class' => 'vc_col-sm-6', 
            );
}

function landpick_vc_content_list_group(){
    return array(
            'type' => 'param_group',
            'save_always' => true,
            'heading' => __( 'Content list', 'landpick' ),
            'param_name' => 'content_list',
            'value' => urlencode( json_encode( array(
                array( 'title' => 'Fully Responsive Design' ),
                array( 'title' => 'Bootstrap 4.0 Based' ),
                array( 'title' => 'Google Analytics Ready' ),
                array( 'title' => 'Cross Browser Compatability' ),
                array( 'title' => 'Developer Friendly Commented Code' ),
                array( 'title' => 'and much more...' ),
            ) ) ),
            'params' => array(
                 array(
                    'type' => 'textarea',
                    'heading' => __( 'Title', 'landpick' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => '',
                    'admin_label' => true 
                ),
            ),            
            'dependency' => array(
                'element' => 'enable_list',
                'value' => 'yes'
            )  
        );
}

if( !function_exists('landpick_target_param_list') ):
function landpick_target_param_list() {
    return array(
        __( 'Same window', 'landpick' ) => '_self',
        __( 'New window', 'landpick' ) => '_blank',
    );
}
endif;


function landpick_vc_counter_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Counter up', 'landpick' ),
        'param_name' => 'counter_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'Happy Clients',
                'count' => '438',
                'prefix' => '3,',
            ),
            array(
                 'title' => 'Tickets Closed',
                'count' => '263',
                'prefix' => '1,',
            ),
        ) ) ),
        'params' => array(
            array(
                 'type' => 'textfield',
                'heading' => __( 'Counter Prefix', 'landpick' ),
                'param_name' => 'prefix',
                'description' => '',
                'value' => '3,',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Count', 'landpick' ),
                'param_name' => 'count',
                'description' => 'Number only',
                'value' => '' ,
                'admin_label' => true 
            ),
             array(
                 'type' => 'textfield',
                'heading' => __( 'Title', 'landpick' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
            
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'counter'
        ),
        'group' => __( 'Content bottom', 'landpick' ),  
    );
}

function landpick_vc_techs_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Techs', 'landpick' ),
        'param_name' => 'techs_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'HTML5',
                'icon' => 'fa fa-html5',
                'image' => ''
            ),
            array(
                 'title' => 'CSS3',
                'icon' => 'fa fa-css3',
                'image' => ''
            ),
            array(
                 'title' => 'jsfiddle',
                'icon' => 'fa fa-jsfiddle',
                'image' => ''
            ),
            array(
                 'title' => 'git',
                'icon' => 'fa fa-git',
                'image' => ''
            ),
            array(
                 'title' => 'WordPress',
                'icon' => 'fa fa-wordpress',
                'image' => ''
            ),
            array(
                 'title' => 'mixcloud',
                'icon' => 'fa fa-mixcloud',
                'image' => ''
            ),
        ) ) ),
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'landpick' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
             landpick_vc_icon_set( 'fontawesome', 'icon' ),
             array(
                'type' => 'image_upload',
                'heading' => __( 'Icon Image', 'landpick' ),
                'param_name' => 'image',
                'description' => 'You can use image instead of Icon',
                'value' => '' 
            ),
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'techs'
        ),
        'group' => __( 'Content bottom', 'landpick' ),  
    );
}

function landpick_vc_strategy_list_group($group = true){
    $output = array(
            'type' => 'param_group',
            'save_always' => true,
            'heading' => __( 'Content group', 'landpick' ),
            'param_name' => 'strategy_list',
            'value' => urlencode( json_encode( array(
                array(
                     'title' => 'Vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus velna auctor congue tempus undo magna ',
                ),
                array(
                     'title' => 'An enim nullam tempor sapien gravida donec enim ipsum porta blandit justo integer odio velna vitae auctor integer luctus',
                ),
            ) ) ),
            'params' => array(
                 array(
                    'type' => 'textarea',
                    'heading' => __( 'Description', 'landpick' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => '',
                    'admin_label' => true 
                ),
            ),
        );

    if($group) $output['group'] = __( 'Content', 'landpick' );

    return $output;
}

function landpick_vc_get_strategy_list( $type = 'list', $paramsArr = array() , $duration = 400  ){
    if( empty($paramsArr) ) return false;
   
    if( $type == 'list' ){
        echo '<ul class="content-list">';
            foreach ($paramsArr as $key => $value): 
                extract($value);                                    
                echo '<li class="wow fadeInUp" data-wow-delay="'.intval($duration).'ms">';
                    echo wpautop($title);                 
                echo '</li>';
                $duration = $duration + 100;
            endforeach;
        echo '</ul>';
    }else{
        foreach ($paramsArr as $key => $value): 
            extract($value);                                    
            echo '<div class="wow fadeInUp" data-wow-delay="'.intval($duration).'ms">';
                echo wpautop($title);                 
            echo '</div>';
            $duration = $duration + 100;
        endforeach;
    }
}

function landpick_vc_element_display_option(){
    return array(
                    'None' => 'none',
                    'Video link' => 'video',                    
                    'Counter' => 'counter',
                    'Techs' => 'techs',
                );
}

function landpick_vc_element_icon_size(){
    return array(
                    'Default' => 'icon',
                    'Extra small' => 'xs',                    
                    'Small' => 'sm',
                    'Medium' => 'md',
                    'Large' => 'lg',
                    '2X size' => '2x',
                    '3X size' => '3x',
                    '5X size' => '5x',
                    '7X size' => '7x',
                    '10X size' => '10x',
                );
}

function landpick_vc_get_content_list_group( $paramsArr = array(), $animation = '', $delay = '100'){
    if(empty($paramsArr)) return false;
    echo '<ul class="content-list">';
    foreach ($paramsArr as $key => $value):                     
        echo '<li class="wow '.esc_attr($animation).'" data-wow-delay="'. intval($delay).'ms">'.esc_attr($value['title']).'</li>';
        $delay = $delay + 100; 
    endforeach; 
    echo '</ul>';
}

add_filter( 'perch_modules/service_style', 'landpick_service_style' );
function landpick_service_style( $args ){
    $total = 4;
    $prefix = 'sbox-';
    $label_prefix = __( 'Service box', 'landpick' );
    $args = array('Default' => '');
    for ($i=1; $i <= $total; $i++) { 
        $args[$label_prefix.' '.$i] = $prefix.$i;
    }
    
    return $args;
}

add_filter( 'landpick_vc_templates_param_group', 'landpick_vc_templates_param_group' );
function landpick_vc_templates_param_group($output){
    $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($output) : array();
    $new_array = array();
    if( !empty($paramsArr) ){
        foreach ($paramsArr as $key => $value) {
            $new_array[] = landpick_vc_image_url_filter($value);
        }
    }
    return urlencode(json_encode($new_array));
}

function landpick_vc_image_url_filter($arr){
    if( !empty($arr) ){

    }
    return $arr;
}


/**
* vc_map default values
* @param array
* @return array
*/
function landpick_vc_get_params_value($args = array(), $_content = NULL){
    $array = array();
    if( !isset($args['base']) || !isset($args['params']) ){
        return $array;
    }

    $newarray = array();
    $map_arr = $args['params'];
    foreach ( $map_arr as $key => $value) {
        $param_name = isset($value['param_name'])? $value['param_name'] : '';
            $std = '';
            if(isset($value['value']) ){
                if( is_array($value['value']) ) {                    
                    if(!isset($value['std'])){
                        $array = $value['value']; reset($array); $std = key($array);
                    }else{
                        $std = $value['std'];
                    }
                }else {
                    $std = $value['value'];
                }
            }
            $std = isset($value['std'])? $value['std'] : $std;

            if( $param_name != '' ){
                $newarray[$param_name] = $std;
            }
    }
    $newarray['content'] = $_content;


    if( !empty($newarray) ) $array = $newarray;

    return $array;
}


if ( function_exists( 'vc_set_as_theme' ) ):
    vc_set_as_theme( $disable_updater = false );
    $list = array(
         'page',
        'post',
        'team',
        'portfolio',
        'service',
        'job' 
    );
    vc_set_default_editor_post_types( $list );
endif;

add_action( 'vc_after_init_base', 'add_more_custom_layouts' );
function add_more_custom_layouts() {
  global $vc_row_layouts;
  $new_layouts = array(
      'cells' => '512_112_12',
      'mask' => '424',
      'title' => 'Custom 5/12 + 1/12 + 6/12',
      'icon_class' => '512_112_12' 
    );
  array_push( $vc_row_layouts,  $new_layouts );

  $new_layouts = array(
      'cells' => '12_112_512',
      'mask' => '424',
      'title' => 'Custom 6/12 + 1/12 + 5/12',
      'icon_class' => '12_112_512' 
    );
  array_push( $vc_row_layouts,  $new_layouts );

  $new_layouts = array(
      'cells' => '112_56_112',
      'mask' => '424',
      'title' => 'Custom 1/12 + 10/12 + 1/12',
      'icon_class' => '112_56_112' 
    );
  array_push( $vc_row_layouts,  $new_layouts );

  
}

/* global vc include files */
foreach ( glob( LANDPICK_DIR . "/vc-extends/*.php" ) as $filename ) {
    include $filename;
} //glob( LANDPICK_DIR . "/admin/vc-extends/*.php" ) as $filename