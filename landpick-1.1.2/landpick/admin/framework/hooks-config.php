<?php
defined( 'ABSPATH' ) || exit;
/*
* Landpick hooks class
*/

add_action( 'landpick/preloader', 'landpick_preloader_template_part', 10 );
// header hook
add_action( 'landpick/header', 'landpick_navbar_template_part', 10 );
add_action( 'landpick/header', 'landpick_breadcrumbs_template_part', 15 );
add_action( 'landpick/header/logo', 'landpick_header_logo', 10 );
add_action( 'landpick/header/menu', 'landpick_header_mobile_menu_icon', 10 );
add_action( 'landpick/header/menu', 'landpick_header_nav_menu', 15 );
add_action( 'landpick/header/menu/after', 'landpick_header_nav_menu_after', 10 );
//footer hooks
add_action( 'landpick/footer/before', 'landpick_newsletter_form_template_part' );
add_action( 'landpick/footer/before', 'landpick_cta_template_part' );
add_action( 'landpick/footer', 'landpick_footer_widget_area_template_part', 10 );
add_action( 'landpick/footer', 'landpick_footer_copyright_template_part', 20 );
add_action( 'landpick/footer/after', 'landpick_quick_contact_form_template_part', 10 );

//posts hook
// archive post
add_action( 'landpick_post_content', 'landpick_post_header_callback' );
add_action( 'landpick_post_content', 'landpick_wp_link_pages_callback' );
add_action( 'landpick_post_content', 'landpick_post_format_callback' );
add_action( 'landpick_post_content', 'landpick_post_link_callback' );

//single post
add_action( 'landpick_post_single_content', 'landpick_post_format_callback' );
add_action( 'landpick_post_single_content', 'landpick_post_header_single_callback' );
add_action( 'landpick_post_single_content', 'landpick_wp_link_pages_callback' );

// Related post content
add_action( 'landpick_post_single_after', 'landpick_related_posts_callback' );
add_action( 'landpick_post_related_content', 'landpick_post_header_related_callback' );
add_action( 'landpick_post_related_content', 'landpick_post_link_callback' );
add_action( 'landpick_post_single_after', 'landpick_post_comment_callback' );

function landpick_post_comment_callback(){
	get_template_part( 'template-parts/post/post-comment' );
}

function landpick_related_posts_callback(){
	get_template_part( 'template-parts/post/related-posts' );
}

function landpick_post_content_editor_callback(){	
	if( is_singular('post') ){
		get_template_part( 'template-parts/post/post', 'editor-content' );	
	}else{
		get_template_part( 'template-parts/post/post', 'excerpt' );
	}
}

function landpick_post_excerpt_callback(){
	get_template_part( 'template-parts/post/post', 'excerpt' );
}

function landpick_post_link_callback(){	
	get_template_part( 'template-parts/post/post', 'link' );	
}

function landpick_wp_link_pages_callback(){
	get_template_part( 'template-parts/post/wp', 'link-pages' );
}

function landpick_post_header_callback(){	
	get_template_part( 'template-parts/post/post', 'header' );
}

function landpick_post_header_single_callback(){	
	get_template_part( 'template-parts/post/post', 'header-single' );
}

function landpick_post_header_related_callback(){	
	get_template_part( 'template-parts/post/post', 'header-related' );
}

function landpick_post_format_callback(){	
	global $post;

	$enable_video = get_post_meta( $post->ID, 'enable_video_popup', true );

	if( $enable_video ){
		get_template_part( 'template-parts/post/format', 'video' );
	}else{
		get_template_part( 'template-parts/post/format', 'image' );
	}
}

if( !function_exists( 'landpick_cta_template_part' ) ):
function landpick_cta_template_part(){
	get_template_part( 'footer/cta' );
}
endif;

if( !function_exists( 'landpick_newsletter_form_template_part' ) ):
function landpick_newsletter_form_template_part(){
	get_template_part( 'footer/newsletter' );
}
endif;

if( !function_exists( 'landpick_footer_copyright_template_part' ) ):
function landpick_footer_copyright_template_part(){
	get_template_part( 'footer/copyright' );
}
endif;

if( !function_exists( 'landpick_quick_contact_form_template_part' ) ):
function landpick_quick_contact_form_template_part(){
	get_template_part( 'footer/quick-form' );
}
endif;

if( !function_exists( 'landpick_footer_widget_area_template_part' ) ):
function landpick_footer_widget_area_template_part(){
	get_template_part( 'footer/widget-area' );
}
endif;

if( !function_exists( 'landpick_preloader_template_part' ) ):
function landpick_preloader_template_part(){
	get_template_part( 'header/preloader' );
}
endif;

if( !function_exists( 'landpick_navbar_template_part' ) ):
function landpick_navbar_template_part(){
	get_template_part( 'header/navbar', Landpick_Header_Config::get_navbar_style() );
}
endif;

if( !function_exists( 'landpick_breadcrumbs_template_part' ) ):
function landpick_breadcrumbs_template_part(){
	get_template_part( 'header/breadcrumbs' );
}
endif;

if( !function_exists( 'landpick_header_logo' ) ):
function landpick_header_logo(){
	get_template_part( 'header/logo', Landpick_Header_Config::get_logo_type() );
}
endif;

if( !function_exists( 'landpick_header_mobile_menu_icon' ) ):
function landpick_header_mobile_menu_icon(){
	get_template_part( 'header/mobilemenu', 'icon' );
}
endif;

if( !function_exists( 'landpick_header_nav_menu' ) ):
function landpick_header_nav_menu(){
	get_template_part( 'header/navigation' );
}
endif;

if( !function_exists( 'landpick_header_nav_menu_after' ) ):
function landpick_header_nav_menu_after(){
	if(Landpick_Header_Config::get_navbar_style() == 'style2'){
		get_template_part( 'header/navigation', 'after' );
	}	
}
endif;