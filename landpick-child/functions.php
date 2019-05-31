<?php
function landpick_child_enqueue_styles() {
	//wp_dequeue_style( 'landpick-google-fonts' );
	$parent_style = 'landpick-style';
	$dependency   = array( 'bootstrap', 'landpick-default-style' );

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', $dependency );
	wp_enqueue_style( 'landpick-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
}

add_action( 'wp_enqueue_scripts', 'landpick_child_enqueue_styles' );


if ( ! function_exists( "landpick_enqueue_header_custom" ) ) {
	function landpick_enqueue_header_custom() {

		echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTVBV9R');</script>";

	}

	add_action( 'wp_head', 'landpick_enqueue_header_custom' );
}
if ( ! function_exists( "landpick_enqueue_footer_custom" ) ) {
	function landpick_enqueue_footer_custom() {

		echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTVBV9R');</script>


<div class=\"phonering-alo-phone phonering-alo-green phonering-alo-show\" id=\"phonering-alo-phoneIcon\">
<div class=\"phonering-alo-ph-circle\"></div>
 <div class=\"phonering-alo-ph-circle-fill\"></div>
<a href=\"tel:+84123456789\" class=\"pps-btn-img\" title=\"Liên hệ\">
 <div class=\"phonering-alo-ph-img-circle\"></div>
 </a>
</div>

";

	}

	add_action( 'wp_footer', 'landpick_enqueue_footer_custom' );
}
