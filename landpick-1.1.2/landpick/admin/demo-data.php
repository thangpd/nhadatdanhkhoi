<?php
function landpick_import_demo_data() {

  $redux_options = array( array(
                      'file_url'    => LANDPICK_URI.'/admin/demo-data/theme-options.json', 
                      'option_name' => 'landpick_options',
                    ));

  return array( 
    array(
      'import_file_name'           => 'Home Multipage',
      'categories'                 => array( 'Multi pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-2.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos',
    ),
    array(
      'import_file_name'           => 'Layout - 01',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat',
      'import_redux'               => $redux_options, 
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-1.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-01',
    ),
    array(
      'import_file_name'           => 'Layout - 02',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-2.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-02',
    ),
    array(
      'import_file_name'           => 'Layout - 03',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-3.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-03',
    ),
    array(
      'import_file_name'           => 'Layout - 04',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-4.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-04',
    ),
    array(
      'import_file_name'           => 'Layout - 05',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-5.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-05',
    ),
    array(
      'import_file_name'           => 'Layout - 06',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-6.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-06',
    ),
    array(
      'import_file_name'           => 'Layout - 07',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-7.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-07',
    ),
    array(
      'import_file_name'           => 'Layout - 08',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-8.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-08',
    ),
    array(
      'import_file_name'           => 'Layout - 09',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-9.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-09',
    ),
    array(
      'import_file_name'           => 'Layout - 10',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-10.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-10',
    ),
    array(
      'import_file_name'           => 'Layout - 11',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-11.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-11',
    ),
    array(
      'import_file_name'           => 'Layout - 12',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-12.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-12',
    ),
    array(
      'import_file_name'           => 'Layout - 13',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-19.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-13',
    ),
    array(
      'import_file_name'           => 'Layout - 14',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-20.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-14',
    ),
    array(
      'import_file_name'           => 'Layout - 15',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-21.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-15',
    ),
    array(
      'import_file_name'           => 'Layout - 16',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-22.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-16',
    ),
    array(
      'import_file_name'           => 'Layout - 17',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-23.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-17',
    ),
    array(
      'import_file_name'           => 'Layout - 18',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => LANDPICK_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => LANDPICK_URI.'/admin/demo-data/widgets.wie',
      'import_customizer_file_url' => LANDPICK_URI.'/admin/demo-data/customizer.dat', 
      'import_redux'               => $redux_options,
      'import_preview_image_url'   => '//jthemes.org/wp/landpick/assests/images/layout-24.jpg',
      'preview_url'                => '//jthemes.org/wp/landpick/demos/layout-18',
    ),

  );

}

add_filter( 'pt-ocdi/import_files', 'landpick_import_demo_data' );


function landpick_after_import_setup() {
  // Assign menus to their locations.
  $primary = get_term_by( 'name', 'Header menu', 'nav_menu' );
  $theme_location = get_nav_menu_locations();
  if( empty($theme_location) ):
    set_theme_mod( 'nav_menu_locations', array(
          'primary' => $primary->term_id,
          //'footer' => $footer->term_id,
        )
    );
  endif;

  if( get_option('page_on_front') != '' ):
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    if( is_page($front_page_id->ID) ){
      update_option( 'page_on_front', $front_page_id->ID );
    }

    if( is_page($blog_page_id->ID) ){
      update_option( 'page_for_posts', $blog_page_id->ID );
    }
  endif;
  

}
add_action( 'pt-ocdi/after_import', 'landpick_after_import_setup' );

function landpick_after_import( $selected_import ) {

	$array = array(
		'Layout - 01', 'Layout - 02', 'Layout - 03', 'Layout - 04', 'Layout - 05', 'Layout - 06', 'Layout - 07', 'Layout - 08', 'Layout - 09', 'Layout - 10', 'Layout - 11', 'Layout - 12', 'Layout - 13', 'Layout - 14', 'Layout - 15', 'Layout - 16', 'Layout - 17', 'Layout - 18'
	);

	foreach ($array as $key => $value) {
		$pagename = trim($value);
		if ( $pagename === $selected_import['import_file_name'] ) {
			$front_page_id = get_page_by_title( $pagename );
      if( is_page($front_page_id->ID) ){
        update_option( 'page_on_front', $front_page_id->ID );
      }
			
		}
	}
  
}
//pt-ocdi/after_import
add_action( 'pt-ocdi/after_import', 'landpick_after_import' );