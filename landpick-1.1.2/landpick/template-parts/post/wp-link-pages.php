<?php
wp_link_pages( array(					
	'nextpagelink'     => esc_attr__( 'Next', 'landpick'),
	'previouspagelink' => esc_attr__( 'Previous', 'landpick' ),
	'pagelink'         => '%',
	'echo'             => 1
) );
?>