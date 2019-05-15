<?php
function landpick_dynamic_general_style_css(){

  $primary_color = landpick_get_option('primary_color', landpick_primary_color());
  $primary_color_2 = landpick_get_option('primary_color_2', apply_filters( 'landpick_primary_color_2', '#469248'));
  $dark_color = landpick_get_option('secondary_color', apply_filters( 'landpick_secondary_color', '#222'));
  $grey_color = landpick_get_option('secondary_color_light', apply_filters( 'landpick_grey_color_light', '#f0f0f0'));
  $css = '.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top.vc_tta-style-landpick .vc_tta-tabs-list .vc_active a{background-color: '.esc_attr($primary_color).';}
  .wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top.vc_tta-style-landpick .vc_tta-tabs-list li a span{color: '.esc_attr($primary_color).';} ';
  

$css .= '
.mb-0 { margin-bottom: 0; }.p-bottom-0 { padding-bottom: 0; }.p-left-0 { padding-left: 0px; }.p-right-0 { padding-right: 0px; }
.btn{color: #fff; }
.bg-dark { background-color: '. esc_attr( $dark_color ) .' !important; }
.bg-lightgrey { background-color: '. esc_attr( $grey_color ) .' !important; }
.cssload-ball,
.bg-preset,
.bg-theme { background-color: '. esc_attr($primary_color) .' !important; }
.primary-color, .theme-color, .theme-text, .preset-color, .preset-text,
.navbar.scroll.navbar-light .rose-hover .navbar-nav .nav-link:hover, 
.navbar.scroll.navbar-dark .rose-hover .navbar-nav .nav-link:hover,
.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top.vc_tta-style-landpick .vc_tta-tabs-list li a span,
a.theme-hover:hover { color: '. esc_attr($primary_color) .'; }
.portfolio-filter.theme-btngroup .btn-group > .btn.active, 
.portfolio-filter.theme-btngroup .btn-group > .btn.focus,
.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top.vc_tta-style-landpick .vc_tta-tabs-list .vc_active a{ background-color: '. esc_attr($primary_color) .'; border-color: '. esc_attr($primary_color) .'; }
.btn-theme{background-color: '. esc_attr($primary_color) .';border: 2px solid '. esc_attr($primary_color) .';}
.btn-tra,.white-color .btn-tra{color: '.esc_attr($primary_color).';border-color:'.esc_attr($primary_color).';}
.pricing-plan.theme-border{ border-color: '. esc_attr($primary_color) .' }
.btn:hover { background-color:'.esc_attr($primary_color_2 ).';border-color:'.esc_attr($primary_color_2).';}
.btn-tra:hover{background-color: '.esc_attr($primary_color) .';border-color:'. esc_attr($primary_color).';}
.theme-progress .progress-bar {  background-color: '. esc_attr($primary_color) .'; }
.white-color .theme-icon span, .theme-icon span,
.theme-hover:hover .grey-icon span { color: '. esc_attr($primary_color) .'; }
.btn.btn-simple:hover,
.btn.btn-simple:focus,
.portfolio-filter button.is-checked, .bg-dark .portfolio-filter button.is-checked,
.widget_rss cite,.recentcomments .comment-author-link, .recentcomments .comment-author-link a,.theme-color,
.theme-color h2, .theme-color h3,.theme-color h4, .theme-color h5, .theme-color h6, .theme-color p, .theme-color a, 
.theme-color li, .theme-color i, .white-color .theme-color,
.hover-menu .collapse.rose-hover ul ul > li:hover > a, 
.navbar .rose-hover .show .dropdown-menu > li > a:focus, 
.navbar .rose-hover .show .dropdown-menu > li > a:hover, 
.hover-menu .collapse.rose-hover ul ul ul > li:hover > a{ 
  color: '. esc_attr($primary_color) .'; 
}
.btn,
.btn-type-light.btn-tra:hover,
.btn-type-light.btn-tra:focus,
.loop-item-hover-in .btn-tra-white:hover,.loop-item-hover-in .btn-tra-white:focus,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.wpb-js-composer .vc_tta-tabs.vc_tta-tabs-position-top.vc_tta-style-landpick-style2 .vc_tta-tabs-list .vc_active a,
.navbar-expand-lg .nl-simple a::before{
  background-color: '. esc_attr($primary_color) .';
}
.btn,
.btn-type-light.btn-tra:hover,
.btn-type-light.btn-tra:focus,
.comment-form .form-control:focus,
.loop-item-hover-in .btn-tra-white:hover,.loop-item-hover-in .btn-tra-white:focus,
.woocommerce button.button.alt.single_add_to_cart_button{border: 2px solid '. esc_attr($primary_color) .';}
.portfolio-filter button.is-checked, .bg-dark .portfolio-filter button.is-checked{
  border-color: '. esc_attr($primary_color) .';
}
.blog-post-txt .post-meta a:hover,
.blog-post-txt .post-meta a:focus{
  color: '. esc_attr($dark_color) .';
}
';

$darkcolorArr = landpick_default_dark_color_classes(array('prefix' => 'btn-'));   
$darkcolortraArr = landpick_default_dark_color_classes(array('prefix' => 'btn-tra-'));

$colors_arr = landpick_default_color_classes();
    foreach ($colors_arr as $key => $value) {

        //check dark color
        $btncolorcss = '';
        $button_style = 'btn-'.$key;
        if(in_array( $button_style, $darkcolorArr)){
            $btncolorcss = 'color: #fff;';
        }
       

        $color = $value['value'];
        $css .= "
        .fbox-3.{$key}-hover:hover {
            border-bottom: 1px solid {$color};
        }
        .fbox-3.{$key}-hover:hover .b-icon span,
        .bg-{$key} { background-color: {$color}; } 
        .underline-{$key} { 
          background-image: linear-gradient(120deg, {$color} 0%, {$color} 90%); 
          background-repeat: no-repeat;
          background-size: 100% 0.22em;
          background-position: 0 105%; 
        }";
        $color =  isset($value['color'])? $value['color']: $value['value'];
        $css .= "
        .has-{$key}-color.has-text-color,
        .{$key}-icon [class^='ti-'], .{$key}-icon [class*=' ti-'],
        .{$key}-color-icon [class^='ti-'], .{$key}-color-icon [class*=' ti-'],
        .{$key}-nav .slick-prev::before, 
        .{$key}-nav .slick-next::before,
        .navbar.{$key}-hover .navbar-nav .nav-link:focus, 
                  .navbar.{$key}-hover .navbar-nav .nav-link:hover, 
                  .modal-video .{$key}-color,
                  .{$key}-color,
                  .{$key}-color h2, 
                  .{$key}-color h3, 
                  .{$key}-color h4, 
                  .{$key}-color h5, 
                  .{$key}-color h6, 
                  .{$key}-color p, 
                  .{$key}-color a, 
                  .{$key}-color li,
                  .{$key}-color i, 
                  .white-color .{$key}-color,
                  span.section-id.{$key}-color,
                  .{$key}-color p{ color: {$color}; }";
        $css .= "
        .btn-{$key},
        .navbar .nav-button .btn-tra-{$key}:hover,
        .navbar .nav-button .btn-tra-{$key}:focus,
        .btn-tra-{$key}:hover,
        .btn-tra-{$key}:focus,
        .btn-{$key}:hover,
        .btn-{$key}:focus{
          background-color: {$color}; 
          border-color: {$color};
          {$btncolorcss}
        }";          
        $css .= "  
        .is-style-outline .has-{$key}-background-color,            
        .btn-tra-{$key}{
          background-color: transparent; 
          border-color: {$color};
        }";          
        $css .= ".{$key}-icon, .{$key}-icon [class^='flaticon-']::before {color: {$color};}"; 
        $css .= ".navbar.scroll.{$key}-scroll{background-color: {$color} !important;}";        
        $css .= "        
        .header-socials a:focus,
        .header-socials a:hover, 
        .scrollbg-dark.scroll .header-socials a:focus,
        .scrollbg-dark.scroll .header-socials a:hover,
        .video-btn.play-icon-{$key}, 
        .box-rounded.box-rounded-{$key}{
          border-color: {$color};
        }";   

        $css .= "
        .has-{$key}-koromiko-background-color,
        .has-{$key}-background-color,
        .header-socials a:focus,
        .header-socials a:hover, 
        .fbox-3:hover .{$key}-color-box .box-line,
        .fbox-3:hover .{$key}-icon [class^='ti-'], .fbox-3:hover .{$key}-icon [class*=' ti-'],
        .fbox-3:hover .{$key}-color-icon [class^='ti-'], .fbox-3:hover .{$key}-color-icon [class*=' ti-'],
        .video-btn.play-icon-{$key},
        .video-1 .video-btn.play-icon-{$key},
        .{$key}-nav.perch-vc-carousel .owl-nav [class*='owl-']:hover,
        .{$key}-nav.perch-vc-carousel .owl-dots .owl-dot.active span,
        .perch-vc-carousel.{$key}-nav .slick-dots li.slick-active button::before,
        .vc-bg-{$key} .landpick-vc .wpb_element_wrapper{ background-color: {$color} }
        "; 
       
    }


  return landpick_compress($css);
}
function landpick_bootstrap_style_css(){
    $primary_color = landpick_get_option('primary_color', apply_filters( 'landpick_primary_color', '#ff3366'));
    $css = '.btn{ background-color:'.esc_attr($primary_color).';border:2px solid '.esc_attr($primary_color).';}';
    return landpick_compress($css);
}

function landpick_woocommerce_general_style_css(){
    $primary_color = landpick_get_option('primary_color', apply_filters( 'landpick_primary_color', '#ff3366'));
    $primary_color_2 = landpick_get_option('primary_color_2', apply_filters( 'landpick_primary_color_2', '#e62354'));
    $dark_color = landpick_get_option('secondary_color', apply_filters( 'landpick_secondary_color', '#2c353f'));
    $grey_color = landpick_get_option('secondary_color_light', apply_filters( 'landpick_grey_color_light', '#f0f0f0'));

    $output = '';
    $output .= ' 
    .woocommerce-info > a:hover,
    .woocommerce-info::before,
    .woocommerce-MyAccount-content p a,
    .page-content .woocommerce-MyAccount-navigation ul .active a,
    .woocommerce .single-widget a:hover,
    .woocommerce .single-widget a:focus,
    .product_meta a,
    .order-total .amount,
    .product-name strong,
    .single-product .summary .yith-wcwl-add-to-wishlist a,   
    .woocommerce div.product p.price, 
    .woocommerce div.product span.price{
        color: '.$primary_color.';
    }
    #headersearch .caret,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce #respond input#submit:hover, 
    .woocommerce a.button:hover, 
    .woocommerce button.button:hover, 
    .woocommerce input.button:hover,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
    .product-inner-buttons .yith-wcwl-wishlistaddedbrowse a,
    .product-inner-buttons .yith-wcwl-wishlistexistsbrowse a,
    .product-inner-buttons .yith-wcqv-button:hover,
    .product-inner-buttons .yith-wcqv-button:focus,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt{
        background-color: '.$primary_color.';
    }
    .product-item .product-inner-buttons .yith-wcwl-wishlistaddedbrowse a,
    .product-item .product-inner-buttons .yith-wcwl-wishlistexistsbrowse a,
    .product-inner-buttons .yith-wcqv-button:hover,
    .product-inner-buttons .yith-wcqv-button:focus{
      border-color: '.$primary_color.';
    }
    .nav-item .cart-contents .cart-contents-count,
    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
    .woocommerce #respond input#submit.alt:hover, 
    .woocommerce a.button.alt:hover, 
    .woocommerce button.button.alt:hover, 
    .woocommerce input.button.alt:hover{
        background-color: '.$primary_color_2.';
    }
    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message{
        background-color: '.$grey_color.';
    }    
    ';

    return landpick_compress($output);
}

function landpick_background_css($option_id, $selector = ''){
  $background = landpick_get_option($option_id, array());
   $output = '';
   if ( !empty( $background ) ) {
        $background_color       = ( isset($background['background-color']) && ($background['background-color'] != '') ) ? 'background-color:'. $background['background-color'] . '!important ; '."\n" : '';
        $background_image       = ( isset($background['background-image']) && ($background['background-image'] != '') ) ? 'background-image: url('.esc_url($background['background-image']).');'."\n" : '';
        $background_repeat      = ( isset($background['background-repeat']) && ($background['background-repeat'] != '') ) ? 'background-repeat: '. $background['background-repeat']. ';'."\n" : '';
        $background_positon     = ( isset($background['background-position']) && ($background['background-position'] != '') ) ? 'background-position:'. $background['background-position']. ';'."\n" : '';
        $background_attachment  = ( isset($background['background-attachment']) && ($background['background-attachment'] != '') ) ? 'background-attachment:'. $background['background-attachment']. ';'."\n" : '';
        $background_size        = ( isset($background['background-size']) && ($background['background-size'] != '') ) ? 'background-size: '. $background['background-size']. ';'."\n" : '';
        

        $output .=  "\n".esc_attr($selector) .' { '."\n".$background_color.$background_image.$background_repeat.$background_attachment.$background_positon. $background_size .'}'. "\n";
        
    }
    return $output;
}

function landpick__background_css($background, $selector = ''){  
   $output = '';
   if ( !empty( $background ) ) {
        $background_color       = ( isset($background['background-color']) && ($background['background-color'] != '') ) ? 'background-color:'. $background['background-color'] . ';'."\n" : '';
        $background_image       = ( isset($background['background-image']) && ($background['background-image'] != '') ) ? 'background-image: url('.esc_url($background['background-image']).');'."\n" : '';
        $background_repeat      = ( isset($background['background-repeat']) && ($background['background-repeat'] != '') ) ? 'background-repeat: '. $background['background-repeat']. ';'."\n" : '';
        $background_positon     = ( isset($background['background-position']) && ($background['background-position'] != '') ) ? 'background-position:'. $background['background-position']. ';'."\n" : '';
        $background_attachment  = ( isset($background['background-attachment']) && ($background['background-attachment'] != '') ) ? 'background-attachment:'. $background['background-attachment']. ';'."\n" : '';
        $background_size        = ( isset($background['background-size']) && ($background['background-size'] != '') ) ? 'background-size: '. $background['background-size']. ';'."\n" : '';
        

        $output .=  "\n".esc_attr($selector) .' { '."\n".$background_color.$background_image.$background_repeat.$background_attachment.$background_positon. $background_size .'}'. "\n";
        
    }
    return $output;
}

function landpick_spacing_option( $option_id ){
  $spacing = landpick_get_option( $option_id, array() );
  if(!empty($spacing)){
      $unit = (isset($spacing['unit']) && ($spacing['unit'] != ''))? $spacing['unit'] : 'px';
      return (isset($spacing['top'])? $spacing['top'].$unit : 0).' '.(isset($spacing['right'])? $spacing['right'].$unit : 0).' '.(isset($spacing['bottom'])? $spacing['bottom'].$unit : 0).' '.(isset($spacing['left'])? $spacing['left'].$unit : 0);
  }else{
    return '';
  } 
  
}

function landpick_typography_css($option_id){

    $typography = landpick_get_option( $option_id, array() );
    $css = '';
    if(!empty($typography) && is_array($typography)) :       
                
        foreach ($typography as $key => $value) {

            if( ($key == 'font-color') && ($value != '') ) $css .= 'color: '.$value.'; ';
            elseif( $key == 'font-family' ){
                if($value != ''){
                    $ot_set_google_fonts  = get_theme_mod( 'ot_google_fonts', array() );

                    $default = array(
                        'roboto'     => 'Roboto',
                        'montserrat'     => 'Montserrat',
                        'arial'     => 'Arial',
                        'georgia'   => 'Georgia',
                        'helvetica' => 'Helvetica',
                        'palatino'  => 'Palatino',
                        'tahoma'    => 'Tahoma',
                        'times'     => '"Times New Roman", sans-serif',
                        'trebuchet' => 'Trebuchet',
                        'verdana'   => 'Verdana'
                      );

                    $family = isset($ot_set_google_fonts[$value])? $ot_set_google_fonts[$value]['family'] : '';
                    $css .= ($family != '')? 'font-family: "'.$family.'", sans-serif; ' : '';
                }
                
            } 
            else
              $css .= ( ($key != 'font-family') && ($value != '') )? $key. ': '.$value.'; ' : '';
        }

    endif;

    return $css;
}

function landpick_custom_bg_css( $selector = '', $prefix = '', $args = array() ){
    $property = '';
    if( $selector == '' ) return false;
    if( $prefix == '' ) return false;

    $bg_class = esc_attr(landpick_get_option( $prefix.'_class'));
    $bg_class = apply_filters( 'landpick/'.$prefix.'_class', $bg_class );

    $colors = array();
    if( $bg_class == 'bg-custom-gradient'){
      $selector .= '.bg-custom-gradient';
      $colors = landpick_get_option( $prefix.'_gradient' );
      $colors = apply_filters( 'landpick/'.$prefix.'_gradient', $colors );

      if( empty($colors) ) return false;
      $type = landpick_get_option( $prefix.'_gradient_type');
      $type = apply_filters( 'landpick/'.$prefix.'_gradient_type', $type );
        extract( shortcode_atts( array(
               'position' => '',
          ), $args ) );

        if( $position == '' ){
            $position = ($type == 'linear')? 'to right' : 'circle';
        } 

        $from = $colors['from'];
        $to = $colors['to'];
        $property = 'background-image: '.$type.'-gradient('.$position.', '.$from.', '.$to.');';
    }
    
    if( $bg_class == 'bg-custom'){
      $selector .= '.bg-custom';
      $color = landpick_get_option( $prefix.'_color' );
      $color = apply_filters( 'landpick/'.$prefix.'_color', $color );
      $property = ($color != '')? 'background-color: '.$color.';' : '';
    }
    
      

    
    if( $property != '' ){
        return $selector.' { '.$property.' }';
    }
    

}

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function landpick_get_dynamic_header_css() {
  global $landpick_options;
  $primary_color = landpick_get_option('primary_color', apply_filters( 'landpick_primary_color', '#ff3366'));
  $primary_color_2 = landpick_get_option('primary_color_2', apply_filters( 'landpick_primary_color_2', '#e62354'));

	$css = '';
  
  $default_header_bg = array(
        'background-color' => '',
        'background-attachment' => 'fixed',
        'background-image' => landpick_get_option('header_bg_img', LandpickHeader::get_default_header_image()),
        'background-size' => 'cover'
    ); 
  $header_bg = apply_filters( 'landpick_header_image_url', $default_header_bg );
  $css .= landpick_background_css('body_background', 'body' );
  $css .= landpick_background_css('footer_background', '#footer-1' );
  if($landpick_options['header_parallax_switch']){
    $css .= '.breadcrumbs-area .parallax-inner{opacity: '.$landpick_options['header_parallax_opacity'].'}';
  }

  
  $css .= landpick_custom_bg_css('.breadcrumbs-area', 'header_bg');
  $css .= landpick_custom_bg_css('.navbar', 'nav_bg');
  $css .= landpick_custom_bg_css('footer.footer', 'footer_bg');
  $css .= landpick_custom_bg_css('.newsletter-section', 'newsletter_bg');
  if($landpick_options['newsletter_parallax_switch']){
    $css .= '.newsletter-section .parallax-inner{opacity: '.$landpick_options['newsletter_parallax_opacity'].'}';
  }
  


  $arr = landpick_get_option( 'container_width', array( '1140',  'px' ) );
  $css .= '@media (min-width: 1200px) { .container {  max-width: '.esc_attr($arr[0]).esc_attr($arr[1]).'; } }';
          

  $css .= '.navbar-brand > img{ max-height: '.implode('', landpick_get_option('logo_height', array('30', 'px'))).' }';
  $overlay_opacity = landpick_get_option('overlay_opacity', 0);

  $overlay_type = apply_filters( 'landpick_breadcrumbs_overlay_type', 'light');
  $overlay_type = landpick_get_option( 'breadcrumbs_overlay_type', $overlay_type);
  $color = landpick_hex2rgb( '#000', false );
  if( $overlay_type == 'light' ){
    $color = landpick_hex2rgb( '#fff', false );
  }
  if( $overlay_type == 'theme' ){
    $color = landpick_hex2rgb( $primary_color, false );
  }

  $css .= landpick_spacing_css_style();

	return landpick_compress($css);
}