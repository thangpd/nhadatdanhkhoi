<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
/**
 * Default template location: landpick/header
 *
 * @hooked landpick_preloader_template_part - 10
 */
 do_action( 'landpick/preloader' ); 
?>


<div id="<?php landpick_wrapper_id(); ?>" <?php landpick_wrapper_class(); ?>>

	<?php
	/**
	 * Default template location: landpick/header
	 *
	 * @hooked landpick_navbar_template_part - 10
	 * @hooked landpick_breadcrumbs_template_part - 15
	 */
	 do_action( 'landpick/header' );	
	?>