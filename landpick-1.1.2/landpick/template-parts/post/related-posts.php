<?php
$realted_post_display = landpick_get_option( 'realted_post_display', 'off' ); 
if($realted_post_display == 'on'):
$orig_post = $post;
global $post;
$realted_post_base = landpick_get_option( 'realted_post_base', 'tag' );
$terms = ( $realted_post_base == 'tag' )? wp_get_post_tags($post->ID) : wp_get_object_terms($post->ID, 'category');
$term_ids = array();	
foreach($terms as $individual_term) $term_ids[] = $individual_term->term_id;

if ( !empty($term_ids) ) :	
	$args = array(		
		'post__not_in' => array($post->ID),
		'posts_per_page' => 2, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand',
    	'order'    => 'ASC'
	);	
	if( $realted_post_base == 'tag' ) $args['tag__in'] = $term_ids; 
	else $args['category__in'] = $term_ids;	
	?>
			
		<?php 		
		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) :
			$related_title = landpick_get_option( 'related_title', 'Related Posts' ); 			
			?>
		<div class="related-post mb-30">		
			<!-- Title -->	
			<h5 class="h5-lg mb-60"><?php printf( _x( '%s','Related Posts title', 'landpick' ), esc_attr($related_title)) ?></h5>
			<div class="row">
			<?php
			while( $my_query->have_posts() ):
				$my_query->the_post(); 
				?>
				<div class="col-md-6">
					<div class="blog-post mb-40">
						<?php do_action( 'landpick_post_related_content' ); ?>						
					</div>
				</div>
			<?php endwhile; ?>
		</div> <!-- End row -->	
		</div>
		<?php endif; ?>	
	
	<?php
	$post = $orig_post;
	wp_reset_postdata();  
endif; 
endif; 
 ?>