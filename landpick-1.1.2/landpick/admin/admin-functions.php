<?php
include get_template_directory() . '/admin/helpers.php';
include get_template_directory() . '/admin/admin-scripts.php';
require get_template_directory() . '/admin/theme-options.php';
include get_template_directory() . '/admin/framework/class.framework.php';
include get_template_directory() . '/admin/framework/meta-boxes/meta-boxes.php';
include get_template_directory() . '/admin/framework/helpers/mr-image-resize.php';
include get_template_directory() . '/admin/framework/helpers/mce-button.php';
include get_template_directory() . '/admin/widgets-area.php';
include get_template_directory() . '/admin/demo-data.php'; 


add_filter( 'tiny_mce_before_init', 'landpick_formatTinyMCE' );
function landpick_formatTinyMCE( $in ) {
    $in[ 'wordpress_adv_hidden' ] = FALSE;
    return $in;
}

add_action( 'perch_modules/get_parse_text_html', 'landpick_get_parse_text_html', 10, 3 );
function landpick_get_parse_text_html($text = '', $args = array(), $type = 'title'){
    if( $text == '' ) return false;
    if( $type == '' ) return false;

    $text = esc_attr($text);

    shortcode_atts( array(
            $type.'_tag' => '',
            $type.'_size' => '',
            $type.'_weight' => '', 
            $type.'_color' => '', 
             $type.'_style' => '',
             $type.'_class' => '',
        ), $args );

    $echo = (isset( $args['echo'] ) && $args['echo'])? $args['echo'] : true;

    //print_r($args);

    $tag = isset($args[ $type.'_tag' ])? $args[ $type.'_tag' ] : 'div';
    $size = isset($args[ $type.'_size' ])? $args[ $type.'_size' ] : '';
    $color = isset($args[ $type.'_color' ])? $args[ $type.'_color' ] : '';
    $weight = isset($args[ $type.'_weight' ])? $args[ $type.'_weight' ] : '';
    $class = isset($args[ $type.'_class' ])? $args[ $type.'_class' ] : '';
    $style = isset($args[ $type.'_style' ])? $args[ $type.'_style' ] : '';

    $style = ( $style != '' )? ' style="'.$style.'"' : '';


    $tagclassArr = array();
    $tagclassArr[] = ($size != '')? $tag. '-'.$size : '';
    $tagclassArr[] = $weight;         
    $tagclassArr[] = $class;         
    $tagclassArr[] = ($color != '')? $color : '';
    $tagclassArr = array_filter($tagclassArr);
    $tagclassclass = implode( ' ', $tagclassArr );

    

    if( $echo ){
        $text = landpick_get_parse_text($text, $args);    
        return ($tag != '')?"<{$tag} class='{$tagclassclass}'{$style}>".$text."</{$tag}>" : $text;
    }else{
        return $args;
    }    

}  


function landpick_header_search_icon( $align = "" ) {
    return '<li class="search-box' . ( ( $align != '' ) ? ' ' . $align : '' ) . '"><a href="#"><i class="fa fa-search"></i></a><ul><li><div class="search-form">' . get_search_form( false ) . '</div></li></ul></li>';
}
function landpick_post_thumbnail( $size = 'thumbnail' ) {
    global $post;
    $postid = $post->ID;
    echo landpick_get_post_thumbnail( $postid, $size );
}
function landpick_get_post_thumbnail( $postid, $size = 'thumbnail' ) {
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
    $sizearr         = landpick_get_image_size( $size );
    return '<img src="' . landpick_image_resize( $large_image_url[ 0 ], $sizearr[ 'width' ], $sizearr[ 'height' ] ) . '" alt="' . esc_attr(get_the_title( $postid )) . '">';
}

// ADD NEW COLUMN
function landpick_columns_head( $defaults ) {
    $defaults[ 'featured_image' ] = esc_attr__( 'Featured Image', 'landpick' );
    return $defaults;
}
function landpick_columns_content( $column_name, $post_ID ) {
    if ( $column_name == 'featured_image' ) {
        if ( has_post_thumbnail( $post_ID ) ) {
            // HAS A FEATURED IMAGE
            echo landpick_get_post_thumbnail( $post_ID, 'thumbnail' );
        } //has_post_thumbnail( $post_ID )
    } 
}

add_filter( 'manage_team_posts_columns', 'landpick_team_columns_item' );
add_action( 'manage_team_posts_custom_column', 'landpick_manage_team_posts_custom_column', 10, 2 );
function landpick_team_columns_item( $columns ) {
    unset( $columns[ 'featured_image' ], $columns[ 'date' ] );
    $new_columns = array(
         'designation' => esc_attr__( 'Designation', 'landpick' ),
        'date' => esc_attr__( 'Date', 'landpick' ),
        'featured_image' => esc_attr__( 'Member image', 'landpick' )
    );
    return array_merge( $columns, $new_columns );
}
function landpick_manage_team_posts_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'designation':
            echo get_post_meta( $post_id, 'designation', true );
            break;
    } //$column
}
add_action( 'print_media_templates', function( ) {
    // define your backbone template;
    // the "tmpl-" prefix is required,
    // and your input field should have a data-setting attribute
    // matching the shortcode name
    ?>
  <script type="text/html" id="tmpl-landpick-custom-gallery-setting">
    <label class="setting">
      <span><?php echo esc_attr__( 'Gallery type', 'landpick' ); ?></span>
      <select data-setting="gallery_type">
        <option value="default"> <?php echo esc_attr__( 'Default', 'landpick' ); ?> </option>
        <option value="slider"> <?php echo esc_attr__( 'Slider', 'landpick' ); ?> </option>
        <option value="tiled"> <?php echo esc_attr__( 'Tiled', 'landpick' ); ?> </option>
      </select>
    </label>
  </script>
  <script>
    jQuery(document).ready(function(){
      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        gallery_type: 'default'
      });
      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('landpick-custom-gallery-setting')(view);
        }
      });
    });
  </script>
  <?php
} );

function landpick_set_post_views( $postID ) {
    $count_key = 'landpick_post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } //$count == ''
    else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

//landpick_set_post_views(get_the_ID());
function landpick_track_post_views( $post_id ) {
    if ( !is_single() )
        return;
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    } //empty( $post_id )
    landpick_set_post_views( $post_id );
}
add_action( 'wp_head', 'landpick_track_post_views' );

function landpick_get_post_views( $postID ) {
    $count_key = 'landpick_post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return "0";
    } //$count == ''
    return landpick_format_count( $count );
}
//landpick_get_post_views(get_the_ID());
if ( !function_exists( 'landpick_get_comments_number' ) ):
    function landpick_get_comments_number( ) {
        global $post;
        $num_comments = get_comments_number( $post->ID ); // get_comments_number returns only a numeric value
        if ( comments_open( $post->ID ) ) {
            if ( $num_comments == 0 ) {
                $comments = esc_attr__( 'No Comments', 'landpick' );
            } //$num_comments == 0
            elseif ( $num_comments > 1 ) {
                $comments = $num_comments . ' <span>' . esc_attr__( 'Comments', 'landpick' ) . '</span>';
            } //$num_comments > 1
            else {
                $comments = '1 <span>' . esc_attr__( 'Comment', 'landpick' ) . '</span>';
            }
            $write_comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
        } //comments_open( $post->ID )
        else {
            $write_comments = esc_attr__( 'Comments off', 'landpick' );
        }
        return '<i class="fa fa-comment-o"></i>' . $write_comments;
    }
endif;


// Custom filter function to modify default gallery shortcode output
function landpick_post_gallery( $output, $attr ) {
    // Initialize
    global $post, $wp_locale;
    // Gallery instance counter
    static $instance = 0;
    $instance++;
    // Validate the author's orderby attribute
    if ( isset( $attr[ 'orderby' ] ) ) {
        $attr[ 'orderby' ] = sanitize_sql_orderby( $attr[ 'orderby' ] );
        if ( !$attr[ 'orderby' ] )
            unset( $attr[ 'orderby' ] );
    } //isset( $attr[ 'orderby' ] )
    // Get attributes from shortcode
    extract( shortcode_atts( array(
         'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'div',
        'icontag' => 'div',
        'captiontag' => 'p',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
        'gallery_type' => 'default' 
    ), $attr ) );
    // Initialize
    $id          = intval( $id );
    $attachments = array( );
    if ( $order == 'RAND' )
        $orderby = 'none';
    if ( !empty( $include ) ) {
        // Include attribute is present
        $include      = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array(
             'include' => $include,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
        // Setup attachments array
        foreach ( $_attachments as $key => $val ) {
            $attachments[ $val->ID ] = $_attachments[ $key ];
        } //$_attachments as $key => $val
    } //!empty( $include )
    else if ( !empty( $exclude ) ) {
        // Exclude attribute is present 
        $exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
        // Setup attachments array
        $attachments = get_children( array(
             'post_parent' => $id,
            'exclude' => $exclude,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
    } //!empty( $exclude )
    else {
        // Setup attachments array
        $attachments = get_children( array(
             'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
    }
    if ( empty( $attachments ) )
        return '';
    // Filter gallery differently for feeds
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        return $output;
    } //is_feed()
    // Filter tags and attributes
    $itemtag    = tag_escape( $itemtag );
    $captiontag = tag_escape( $captiontag );
    $columns    = intval( $columns );
    $itemwidth  = $columns > 0 ? floor( 100 / $columns ) : 100;
    $float      = is_rtl() ? 'right' : 'left';
    $selector   = "gallery-{$instance}";
    $output     = '';
    if ( $gallery_type == 'slider' ):
        $output = '<div class="image-holder post-carousel">';
        foreach ( $attachments as $id => $attachment ) {
            $src         = wp_get_attachment_image_src( $id, $size );
            $fullsrc     = wp_get_attachment_image_src( $id, 'full' );
            $imagewidth  = ( landpick_get_layout() == 'full' ) ? 1170 : 832;
            $imageheight = ( landpick_get_layout() == 'full' ) ? 585 : 554;
            $output .= '<img alt="' . esc_attr( $attachment->post_title ) . '"

                 src="' . landpick_image_resize( $fullsrc[ 0 ], $imagewidth, $imageheight ) . '">';
        } //$attachments as $id => $attachment
        $output .= '</div>';
    elseif ( $gallery_type == 'tiled' ):
        $uniqid = uniqid( 'tiled_gallery_' );
        wp_enqueue_style( 'unite-gallery' );
        wp_enqueue_script( 'ug-theme-tiles' );
        $output = '<div id="' . $uniqid . '" class="gallery-tiled" style="display:none;">';
        foreach ( $attachments as $id => $attachment ) {
            $src     = wp_get_attachment_image_src( $id, $size );
            $fullsrc = wp_get_attachment_image_src( $id, 'full' );
            $output .= '<a href="' . get_attachment_link( $id ) . '">
            <img alt="' . esc_attr( $attachment->post_title ) . '"
                 src="' . esc_url( $src[ 0 ] ) . '"
                 data-image="' . esc_url( $fullsrc[ 0 ] ) . '"
                 data-description="' . wptexturize( $attachment->post_excerpt ) . '"
                 style="display:none">
            </a>';
        } //$attachments as $id => $attachment
        $output .= '</div>

    <script>
      jQuery(document).ready(function(){
        jQuery("#' . $uniqid . '").unitegallery({
          tiles_type:"justified",
          tiles_justified_space_between: 10
        });
      });

    </script>';
    else:
        // Filter gallery CSS
        $output = apply_filters( 'gallery_style', "
      <style type='text/css'>
        #{$selector} {
          margin-left:  -15px;
          margin-right:  -15px;
        }
        #{$selector} .gallery-item {
          float: {$float};
          margin-top: 10px;
          text-align: center;
          width: {$itemwidth}%;
          padding-left: 15px;
          padding-right: 15px;
        }
        #{$selector} img {         

        }
        #{$selector} .gallery-caption {
          margin-left: 0;
        }
      </style>
      <!-- see gallery_shortcode() in wp-includes/media.php -->
      <div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns}'>" );
        // Iterate through the attachments in this gallery instance
        $i      = 0;
        $class  = ( isset( $attr[ 'link' ] ) && $attr[ 'link' ] == 'file' ) ? ' image-link' : '';
        foreach ( $attachments as $id => $attachment ) {
            // Attachment link
            $link = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
            // Start itemtag
            $output .= "<{$itemtag} class='gallery-item{$class}'>";
            // icontag
            $output .= "
      <{$icontag} class='gallery-icon'>
        $link
      </{$icontag}>";
            if ( $captiontag && trim( $attachment->post_excerpt ) ) {
                // captiontag
                $output .= "
        <{$captiontag} class='gallery-caption'>
          " . wptexturize( $attachment->post_excerpt ) . "
        </{$captiontag}>";
            } //$captiontag && trim( $attachment->post_excerpt )
            // End itemtag
            $output .= "</{$itemtag}>";
            // Line breaks by columns set
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both;">';
        } //$attachments as $id => $attachment
        // End gallery output
        $output .= "
    </div>\n";
    endif;
    return $output;
}
// Apply filter to default gallery shortcode
add_filter( 'post_gallery', 'landpick_post_gallery', 10, 2 );


function landpick_header_default_social_icons( ) {
    return array(
         array(
             'title' => 'Facebook',
            'icon_link' => array(
                 'icon' => 'fa-facebook-f',
                'input' => '#' 
            ) 
        ),        
        array(
             'title' => 'Twitter',
            'icon_link' => array(
                 'icon' => 'fa-twitter',
                'input' => '#' 
            ) 
        ) ,
        array(
             'title' => 'Dribbble',
            'icon_link' => array(
                 'icon' => 'fa-dribbble',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'Pinterest',
            'icon_link' => array(
                 'icon' => 'fa-pinterest-p',
                'input' => '#' 
            ) 
        ),
    );
}
function landpick_header_default_contact_info( ) {
    return array(
         array(
             'title' => 'Email us',
            'icon_link' => array(
                 'icon' => 'landpick-envelop',
                'input' => 'info@landpick.com' 
            ),
            'link' => 'mailto:info@landpick.com' 
        ),
        array(
             'title' => 'Call us',
            'icon_link' => array(
                 'icon' => 'landpick-phone',
                'input' => '+68004540088' 
            ),
            'link' => 'tel:+68004540088' 
        ) 
    );
}

add_filter('perch_modules/social_icons', 'landpick_default_social_icons');
function landpick_default_social_icons( ) {
    return array(
         array(
             'title' => 'Facebook',
            'icon_link' => array(
                 'icon' => 'fa-facebook',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'Twitter',
            'icon_link' => array(
                 'icon' => 'fa-twitter',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'youtube',
            'icon_link' => array(
                 'icon' => 'fa-youtube',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'tumblr',
            'icon_link' => array(
                 'icon' => 'fa-tumblr',
                'input' => '#' 
            ) 
        ) 
    );
}

function landpick_get_social_icons( $social_icons = array( ), $args = array( ) ) {
    if ( empty( $social_icons ) )
        return;
    $output = '';
    extract( shortcode_atts( array(
        'wrap' => 'ul',
        'wrapclass' => '',
        'linkwrapbefore' => '',
        'linkwrap' => 'li',
        'linkwrapclass' => '',
        'linkclass' => '',
        'iconprefix' => 'foo',
        'iconclass' => '',
        'linktext' => false, 
        'icon' => true, 
    ), $args ) );
    $output = ( $wrap != '' ) ? '<' . esc_attr( $wrap ) . ( ( $wrapclass != '' ) ? ' class="' . esc_attr( $wrapclass ) . '"' : '' ) . '>' : '';
    $output .= ( $linkwrapbefore != '' ) ? wpautop( $linkwrapbefore ) : '';
    $linkbefore = ( $linkwrap != '' ) ? '<' . esc_attr( $linkwrap ) . ( ( $linkwrapclass != '' ) ? ' class="' . esc_attr( $linkwrapclass ) . '"' : '' ) . '>' : '';
    $linkafter  = ( $linkwrap != '' ) ? '</' . esc_attr( $linkwrap ) . '>' : '';
    
    foreach ( $social_icons as $key => $value ) {
        $url        = isset( $value[ 'icon_link' ][ 'input' ] ) ? $value[ 'icon_link' ][ 'input' ] : '';
        $title      = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';

        $_linkclass = array();
        $_linkclass[]  = ( $linkclass != '' ) ? esc_attr( $linkclass ) : '';
    	$_linkclass[]  = ( $iconprefix != '' ) ? esc_attr($iconprefix).'-'. sanitize_title($title) : '';
    	$_linkclass = array_filter($_linkclass);
    	if( !empty($_linkclass) ) $linkclass = implode(' ', $_linkclass);

        $icon_class = isset( $value[ 'icon_link' ][ 'icon' ] ) ? $value[ 'icon_link' ][ 'icon' ] : '';
        $icon_class .= ( $iconclass ) ? ' ' . $iconclass : '';

        $iconhtml = ($icon)? '<i class="fa ' . esc_attr( $icon_class ) . '"></i>' : '';
        $linktexthtml =  ( $linktext ) ? '<span>' . esc_attr( $title ) . '</span>' : ''; 

        $output .= $linkbefore . 
        '<a target="_blank" href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" class="' . trim($linkclass) . '">
	      '.$iconhtml.'
	      '.$linktexthtml.'
	      </a>' 
      . $linkafter;
    } //$social_icons as $key => $value
    $output .= ( $wrap != '' ) ? '</' . esc_attr( $wrap ) . '>' : '';
    return $output;
}

// Add Profile Fields
if ( !function_exists( 'landpick_contact_options' ) ):
    function landpick_contact_options( ) {
        $profile_fields                   = array( );
        $profile_fields[ 'facebook' ]     = array(
             'Facebook',
            'fb' 
        );
        $profile_fields[ 'twitter' ]      = array(
             'Twitter',
            'tw' 
        );
        $profile_fields[ 'youtube-play' ] = array(
             'Youtube',
            'yt' 
        );
        $profile_fields[ 'pinterest' ]    = array(
             'Pinterest',
            'pt' 
        );
        $profile_fields[ 'linkedin' ]     = array(
             'Linkedin',
            'li' 
        );
        $profile_fields[ 'flickr' ]       = array(
             'Flickr',
            'fl' 
        );
        $profile_fields[ 'google-plus' ]  = array(
             'Google+',
            'gplus' 
        );
        $profile_fields[ 'instagram' ]    = array(
             'Instagram',
            'ig' 
        );
        $profile_fields[ 'vk' ]           = array(
             'Vk',
            'vk' 
        );
        return $profile_fields;
    }
endif;

function landpick_get_user_contacts_list( ) {
    global $post;
    $array = landpick_contact_options();
    foreach ( $array as $key => $value ) {
        $link = get_user_meta( get_the_author_meta( 'ID' ), $key, true );
        if( $link != '' ){
            echo '<li><a class="' . esc_attr( $value[ 1 ] ) . '" href="' . esc_url( $link ) . '" title="' . esc_attr( $value[ 0 ] ) . '"><i class="fa fa-' . esc_attr( $key ) . '"></i></a></li>';
        }
    } //$array as $key => $value
}

function landpick_get_header_type( ) {
    global $post;
    $output = array(
         'type' => '',
        'shortcode' => false 
    );
    if ( is_page() ) {
        $header_type           = get_post_meta( $post->ID, 'header_type', true );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? get_post_meta( get_the_ID(), 'shortcode', true ) : false;
    } //is_page()
    elseif ( is_single() ) {
        $header_type           = landpick_get_option( 'single_post_header_style', 'style1' );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? landpick_get_option( 'single_post_shortcode' ) : false;
    } //is_single()
    else {
        $header_type           = landpick_get_option( 'blog_header_style', 'style1' );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? landpick_get_option( 'blog_shortcode' ) : false;
    }
    $output[ 'type' ] = ( $header_type != '' ) ? $header_type : 'style1';
    return $output;
}

add_action( 'landpick_after_header', 'landpick_get_header_style' );
function landpick_get_header_style( ) {
    $header      = landpick_get_header_type();
    $header_type = $header[ 'type' ];
    if ( ( $header_type == 'style1' ) || ( $header_type == 'style2' ) ) {
        $args[ 'template' ] = 'header/slider-' . $header_type . '.php';
    } //( $header_type == 'style1' ) || ( $header_type == 'style2' )
    else {
        $args[ 'template' ] = 'header/page-header.php';
    }
    if ( isset( $args[ 'template' ] ) ) {
        echo landpick_posts_template( $args );
    } //isset( $args[ 'template' ] )
}

function landpick_parse_color_text( $text ) {
    preg_match_all( "/\{([^\}]*)\}/", $text, $matches );
    if ( !empty( $matches ) ) {
        foreach ( $matches[ 1 ] as $value ) {
            $text = str_replace( "{{$value}}", "<span class='primary-color'>{$value}</span>", $text );
        } //$matches[ 1 ] as $value
    } //!empty( $matches )
    return $text;
}

add_filter( 'nav_menu_css_class', 'landpick_active_nav_class', 10, 2 );
function landpick_active_nav_class( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) ) {
        $classes[ ] = 'active';
    } //in_array( 'current-menu-item', $classes )
    return $classes;
}

function landpick_password_form( ) {
    global $post;
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $o     = '<form class="password-form newsletter-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">

    ' . esc_attr( __( "To view this protected post, enter the password below:", "landpick" ) ) . '
    <div class="input-group"><input class="form-control" placeholder="' . esc_attr( __( "Password:", "landpick" ) ) . '" required="" id="s-email" name="post_password" type="password"><span class="input-group-btn input-group-append"><button type="submit" name="submit" class="btn btn-theme"><i class="fas fa-arrow-right fa-lg"></i></button></span></div>

    </form><p>&nbsp;</p>

    ';
    return $o;
}
add_filter( 'the_password_form', 'landpick_password_form' );
add_action( 'wp_ajax_instafeed_access_token_action', 'landpick_instafeed_access_token_action' );
add_action( 'wp_ajax_nopriv_instafeed_access_token_action', 'landpick_instafeed_access_token_action' );
function landpick_instafeed_access_token_action( ) {
    global $wpdb;
    $access_token = ( isset( $_POST[ 'access_token' ] ) ) ? $_POST[ 'access_token' ] : '';
    if ( $access_token != '' ) {
        update_option( 'access_token', $access_token );
        echo 'Updated';
    } //$access_token != ''
    else {
        echo 'Some thing went wrong';
    }
    wp_die();
}
function landpick_wpcf7_dynamic_recipient_for_members( $args ) {
    if ( is_singular( 'team' ) ) {
        $args[ 'recipient' ] = get_post_meta( get_the_ID(), 'contact_form_email', true );
        return $args;
    } //is_singular( 'team' )
    return $args;
}

/* This code filters the Categories archive widget to include the post count inside the link */
//add_filter( 'wp_list_categories', 'cat_count_span' );
function cat_count_span( $links ) {
    $links = str_replace( '</a> <span class="count">(', ' [', $links );
    $links = str_replace( ')</span>', ']</a>', $links );
    $links = str_replace( '</a> (', ' [', $links );
    $links = str_replace( ')', ']</a>', $links );
    return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
//add_filter( 'get_archives_link', 'archive_count_span' );
function archive_count_span( $links ) {
    $links = str_replace( '</a>&nbsp;(', ' [', $links );
    $links = str_replace( ')', ']</a>', $links );
    return $links;
}
add_action( 'init', 'landpick_archive_page_id' );
function landpick_archive_page_id( ) {
    global $wpdb;
    $archiveArr = array(
         'portfolio',
        'service',
        'partner',
        'team',
        'job' 
    );
    foreach ( $archiveArr as $key => $value ) {
        $default = ( get_post_status( get_option( $value . '_archive_id' ) ) == 'publish' ) ? get_option( $value . '_archive_id' ) : '';
        $aid     = landpick_get_option( $value . '_archive', $default );
        if ( $default != $aid ) {
            delete_option( $value . '_archive_id' );
            add_option( $value . '_archive_id', $aid );
            flush_rewrite_rules();
        } //$default != $aid
    } //$archiveArr as $key => $value
}

add_filter( 'revslider_mod_default_css_handles', 'landpick_revslider_mod_default_css_handles', 10, 1 );
function landpick_revslider_mod_default_css_handles( $defaults ) {
    $defaults[ '.tp-caption.landpick-subtitle-style1' ] = '5.0';
    $defaults[ '.tp-caption.landpick-subtitle-style2' ] = '5.0';
    $defaults[ '.tp-caption.landpick-title-style1' ]    = '5.0';
    $defaults[ '.tp-caption.landpick-title-style2' ]    = '5.0';
    return $defaults;
}

function landpick_wpml_lang_select_option( ) {
    $display = landpick_get_option( 'header_language_dropdown', 'on' );
    if ( $display != 'on' )
        return false;
    if ( function_exists( 'icl_disp_language' ) ):
        $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
        if ( !empty( $languages ) ) {
            $activeflag = landpick_wpml_custom_flags();
            echo '<li id="language_list" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="' . $activeflag[ 'country_flag_url' ] . '"><span class="caret"></span></a><ul class="dropdown-menu">';
            foreach ( $languages as $l ) {
                echo '<li>';
                if ( $l[ 'country_flag_url' ] ) {
                    if ( !$l[ 'active' ] )
                        echo '<a href="' . $l[ 'url' ] . '">';
                    echo '<img src="' . $l[ 'country_flag_url' ] . '" height="12" alt="' . esc_attr($l[ 'language_code' ]) . '" width="18" />';
                    if ( !$l[ 'active' ] )
                        echo '</a>';
                } //$l[ 'country_flag_url' ]
                if ( !$l[ 'active' ] )
                    echo '<a href="' . $l[ 'url' ] . '">';
                echo icl_disp_language( $l[ 'native_name' ], $l[ 'translated_name' ] );
                if ( !$l[ 'active' ] )
                    echo '</a>';
                echo '</li>';
            } //$languages as $l
            echo '</ul></li>';
        } //!empty( $languages )
    endif;
    if ( function_exists( 'pll_the_languages' ) ):
        $args         = array(
             'current_lang' => true,
            'raw' => 1 
        );
        $current_lang = pll_the_languages( $args );
        $current_lang = array_filter( $current_lang, function( $ar ) {
            return ( $ar[ 'current_lang' ] == 1 );
        } );
        echo '<li  id="language_list" class="dropdown">';
        foreach ( $current_lang as $key => $value ) {
            if ( is_array( $value ) && array_key_exists( 'current_lang', $value ) ) {
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                echo '<img src="' . esc_url( $value[ 'flag' ] ) . '" height="12" alt="' . esc_attr( $value[ 'locale' ] ) . '" width="18" />';
                echo '<span class="caret"></span></a>';
                break;
            } //is_array( $value ) && array_key_exists( 'current_lang', $value )
        } //$current_lang as $key => $value
        $args = array(
             'dropdown' => 0,
            'echo' => 1,
            'show_flags' => 1 
        );
        echo '<ul class="dropdown-menu">';
        pll_the_languages( $args );
        echo '</ul>';
        echo '</li>';
    endif;
    if ( function_exists( 'mltlngg_get_switcher_block' ) ):
        global $mltlngg_current_language, $mltlngg_enabled_languages;
        echo '<li  id="language_list" class="dropdown">';
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
        echo '<img class="mltlngg-lang" src="' . plugins_url( 'multilanguage/images/flags/', '' ) . $mltlngg_current_language . '.png" alt="' . esc_attr($mltlngg_current_language) . '">';
        echo '<span class="caret"></span></a>';
        echo '<ul class="dropdown-menu">';
        echo '<form name="mltlngg_change_language" method="post" action="">';
        foreach ( $mltlngg_enabled_languages as $item ) {
            $flag = ( empty( $item[ 'flag' ] ) ) ? plugins_url( 'multilanguage/images/flags/', '' ) . $item[ 'locale' ] . '.png' : $item[ 'flag' ];
            echo '<li><button class="mltlngg-lang-button-icons" name="mltlngg_change_display_lang" value="' . $item[ 'locale' ] . '" title="' . $item[ 'name' ] . '"><img class="mltlngg-lang" src="' . $flag . '" alt="' . esc_attr($item[ 'name' ]) . '"> ' . $item[ 'name' ] . '</button></li>';
        } //$mltlngg_enabled_languages as $item
        echo '</form>';
        echo '</ul>';
        echo '</li>';
    endif;
}

function landpick_wpml_custom_flags( ) {
    $languages = icl_get_languages( 'skip_missing=1' );
    $curr_lang = array( );
    if ( !empty( $languages ) ) {
        foreach ( $languages as $language ) {
            if ( !empty( $language[ 'active' ] ) ) {
                $curr_lang = $language; // This will contain current language info.
                break;
            } //!empty( $language[ 'active' ] )
        } //$languages as $language
    } //!empty( $languages )
    return $curr_lang;
}

function landpick_menu_search_icon( $class = '' ) {
    $search_icon_display = landpick_get_option( 'search_icon_display', 'off' );
    if ( $search_icon_display == 'on' ):
        $sticky_display = landpick_get_option( 'sticky_search_display', 'off' );
        return '<li class="search-icon sticky-' . $sticky_display . ' ' . $class . '"><a href="#"><i class="perch perch-Search"></i></a><ul class="dropdown-menu"><li>' . get_search_form( false ) . '</li></ul></li>';
    endif;
}

if ( !function_exists( 'landpick_disable_post_type_arr' ) ):
    function landpick_disable_post_type_arr( ) {
        if ( function_exists( 'landpick_get_option' ) ) {
            return landpick_get_option( 'disable_post_type', array( ) );
        } //function_exists( 'landpick_get_option' )
        else {
            return array( );
        }
    }
endif;

function landpick_vc_btn_style(){
    return landpick_btn_style_options(true);
}


function landpick_button_groups_param($args = array()) {
    return array(
        array(
             'type' => 'dropdown',
            'heading' => __( 'Button type', 'landpick' ),
            'param_name' => 'button_type',
            'value' => array(
                 'Text button' => 'text_btn',
                'Image button' => 'img_btn' 
            ),
            'save_always' => true, 
            'admin_label' => true
        ),
        array(
            'type' => 'image_upload',
            'heading' => __( 'Button Image', 'landpick' ),
            'param_name' => 'img_btn',
            'value' => LANDPICK_URI. '/images/googleplay.png',
            'dependency' => array(
                 'element' => 'button_type',
                'value' => 'img_btn' 
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Button size', 'landpick' ),
            'param_name' => 'img_btn_size',
            'value' => '160',
            'dependency' => array(
                 'element' => 'button_type',
                'value' => 'img_btn' 
            ),
        ),
        array(
            'type' => 'textfield',
            'value' => 'Get Started Now',
            'heading' => 'Button title',
            'param_name' => 'button_text',
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'value' => '#',
            'heading' => 'Button URL',
            'param_name' => 'button_url',
        ),
        landpick_vc_icon_set('fontawesome','icon','fa fa-angle-double-right'),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Button target', 'landpick' ),
            'param_name' => 'button_target',
            'value' => array(
                 'Open link in a self tab' => '_self',
                'Open link in a new tab' => '_blank' 
            ) 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Button style', 'landpick' ),
            'param_name' => 'button_style',
            'std' => 'btn-theme',
            'value' => landpick_btn_style_options(true),
            'dependency' => array(
                    'element' => 'button_type',
                    'value' => 'text_btn' 
                ),  
        ),
        array(
             'type' => 'dropdown',
            'std' => 'btn-normal',
            'value' => array( 
                'Default' => '',
                'Medium' => 'btn-md',                
                'Large' => 'btn-lg',
                'Small' => 'btn-sm',               
                
            ),
            'heading' => 'Button size',
            'param_name' => 'button_size',
            'dependency' => array(
                    'element' => 'button_type',
                    'value' => 'text_btn' 
                ),   
        ) 
    );
}

function landpick_get_post_type_archive_page_id( $post_type ) {
    if ( $post_type == '' )
        return false;
    $id = false;
    if ( $post_type == 'portfolio' ) {
        $id = landpick_get_option( 'portfolio_archive', $id );
        update_option( 'landpick_portfolio_archive_id', $id, 'yes' );
    } //$post_type == 'portfolio'
    if ( $post_type == 'team' ) {
        $id = landpick_get_option( 'team_archive', $id );
        update_option( 'landpick_team_archive_id', $id, 'yes' );
    } //$post_type == 'team'
    if ( $post_type == 'service' ) {
        $id = landpick_get_option( 'service_archive', $id );
        update_option( 'landpick_service_archive_id', $id, 'yes' );
    } //$post_type == 'service'
    return $id;
}
add_filter( 'display_post_states', 'landpick_add_display_post_states', 10, 2 );
function landpick_add_display_post_states( $post_states, $post ) {
    if ( intval( get_option( 'landpick_portfolio_archive_id' ) ) === $post->ID ) {
        $post_states[ ] = esc_attr__( 'Portfolio Page', 'landpick' );
    } //intval( get_option( 'landpick_portfolio_archive_id' ) ) === $post->ID

     if ( intval( get_option( 'landpick_team_archive_id' ) ) === $post->ID ) {
        $post_states[ ] = esc_attr__( 'Team Page', 'landpick' );
    }
    return $post_states;
}

function landpick_bg_color_options(){
    $arr = array(
        array( 'label' => 'Custom color', 'value' =>  'bg-custom' ),
        array( 'label' => 'Gradient color', 'value' =>  'bg-custom-gradient' ),
        array( 'label' => 'Transparent dark', 'value' =>  'bg-tra-dark' )
    );
    $colors = landpick_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'bg-'.$key;
        $arr[] = array( 'label' => $color_name, 'value' =>  $color_class ); 
    }
    return $arr;
}

function landpick_navscrool_bg_color_options(){
    $arr = array();
    $colors = landpick_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = $key .'-scroll';
        $arr[] = array( 'label' => $color_name, 'value' =>  $color_class ); 
    }
    return $arr;
}

function landpick_vc_color_options($coloronly = false, $prefix = '', $postfix = '' ){
    $arr = landpick_bg_color_options();
    $colorArr = array('Default' => '');
    $newarr = array('Default' => '');
    foreach ($arr as $key => $value) {
        $newkey = $value['label'];        
        $newvalue = $value['value'];
        $newvalue = str_replace( 'bg-', '', $newvalue );
        $newvalue = trim($prefix.$newvalue.$postfix);
        $colorArr[$newkey] = $newvalue;
        $newvalue = $newvalue. '-color';
        $newvalue = trim($prefix.$newvalue.$postfix);
        $newarr[$newkey] = $newvalue;
    }
    if($coloronly){
        return $colorArr;
    }else{
        return $newarr;
    }    
}
add_action( 'perch_modules/vc_color_options', 'landpick_vc_color_options', 10, 3);





function landpick_btn_style_options($vcoptions = false){
    $arr = array(
            array( 'label' => 'Transparent white',  'value' => 'btn-tra-white tra-hover' ),
        );
    $vcArr = array(
        'Default' => 'btn-default',
        'Transparent white' => 'btn-tra-white tra-hover',
    );
     $colorarr = landpick_default_color_classes();
     foreach ($colorarr as $key => $value) {
         $arr[] = array( 'label' => $value['label'],  'value' => 'btn-'.$key );
         $vcArr[$value['label']] = 'btn-'.$key;
         if( $key != 'tra' ){
            $arr[] = array( 'label' => $value['label'] . ' Transparent background',  'value' => 'btn-tra-'.$key );
            $vcArr[$value['label']. ' Transparent background'] = 'btn-tra-'.$key;
         }
         
     }
     if($vcoptions){
        return $vcArr;
     }else{
        return $arr;
     }
    
}

function landpick_spacing_options(){
    $arr = array();

    for ($i=0; $i < 15 ; $i++) { 
      $value =  $i*10;
      $arr[] = array( 'label' => 'Wide '.intval($value),  'value' => 'wide-'.intval($value) );
    }
    return $arr;
}

function landpick_vc_padding_options(){
    $output = array();
    $output['None'] = '';
    for ($i=0; $i <= 12 ; $i++) { 
        $output['Wide '. ($i * 10)] = 'wide-'. ($i * 10);
    }
    return $output;
}


function landpick_vc_background_options(){
    $output = array();

    $arr = landpick_bg_color_options();
   $output['Transparent'] = 'bg-tra';
    foreach ($arr as $value) {
        $key = $value['label'];
        $output[$key] =  $value['value'];
    }
    return $output;
}

function landpick_contact_form_options(){
    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

    $contact_forms = array();
    if ( $cf7 ) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->ID;
        }
    } else {
        $contact_forms[ esc_attr__( 'No contact forms found', 'landpick' ) ] = 0;
    }

    return $contact_forms;
}

function landpick_inline_bg_image($bg_url = ''){
    $style = ($bg_url != '')?' style="background-image: url('.esc_url($bg_url).')"' : '';

    return $style;
}


function landpick_archive_page_size( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'portfolio' ) ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', 6 );
        return;
    }

    if ( is_post_type_archive( 'team' ) ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'landpick_archive_page_size', 1 );

if( function_exists('landpick_vc_underline_color_options') ):
    add_filter( 'perch_modules/vc_underline_color_options', 'landpick_vc_underline_color_options' );
endif;

if( function_exists('landpick_vc_background_options') ):
    add_filter( 'perch_modules/vc_background_options', 'landpick__vc_background_options' );
    function landpick__vc_background_options(){
        return landpick_vc_background_options(true);
    }    
endif;

if( function_exists('landpick_vc_color_options') ):
    add_filter( 'perch_modules/vc_color_options', 'landpick__vc_color_options' );
    function landpick__vc_color_options(){
        return landpick_vc_color_options(true);
    }    
endif;


if ( function_exists( 'vc_set_as_theme' ) ):
    include get_template_directory() . '/admin/vc-extends.php';
endif;