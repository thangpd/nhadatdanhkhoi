<?php
if( !function_exists( 'landpick_primary_color' ) ):
function landpick_primary_color(){
	return '#389bf2';
}
endif;

if( !function_exists( 'landpick_default_container_id' ) ):
function landpick_default_container_id(){
	$output = 'blog-page';
	
	if( is_page() ) $output = 'page';

	if('post' == get_post_type()){
		$output = ( is_singular() )? 'single-blog-page' : $output;
	}	

	return trim($output);	
}
endif;

if( !function_exists( 'landpick_blog_classes' ) ):
function landpick_blog_classes(){
	return 'blog-post';
}
endif;

if( !function_exists( 'landpick_blog_single_classes' ) ):
function landpick_blog_single_classes(){
	return 'single-blog-post';
}
endif;

if( !function_exists( 'landpick_post_header_class' ) ):
function landpick_post_header_class(){
	$output = ( is_singular() )? 'sblog-post-txt' : 'blog-post-txt';

	echo trim($output);
}
endif;

function landpick_post_format_class( $classes = '' ){
	$classes .= ( is_singular() )? ' mb-40' : '';

	echo trim($classes);
}

function ladpick_default_pagination_classes(){
	$output = ( is_singular() )? ' mb-0 mt-40' : ' pl-25 mb-25';

	return $output;
}


if( !function_exists( 'landpick_footer_column_style' ) ):
function landpick_footer_column_style(){
	$array = array(
		'col-md-10 col-lg-4,col-md-3 col-lg-2 offset-lg-1,col-md-3 col-lg-2,col-md-6 col-lg-3' => '4 column',
		'col-md-10 col-lg-4,col-md-3 col-lg-2,col-md-3 col-lg-2 offset-lg-1,col-md-6 col-lg-3',
		'col-md-3 col-lg-2 offset-lg-1,col-md-3 col-lg-2,col-md-6 col-lg-3,col-md-10 col-lg-4',
		'col-md-10 col-lg-4,col-md-3 col-lg-3,col-md-3 col-lg-2,col-md-6 col-lg-3',
		'col-md-10 col-lg-3,col-md-3 col-lg-3,col-md-3 col-lg-2,col-md-6 col-lg-4',
		'col-md-6 col-lg-3,col-md-6 col-lg-3,col-md-6 col-lg-3,col-md-6 col-lg-3',
	);

	$array = array_filter($array);
	return $array;
}
endif;

function landpick_general_options_social_link(){
	return array('facebook','twitter', 'linkedin', 'tumblr');
}