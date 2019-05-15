<?php if( has_post_thumbnail() ): ?>			
<div class="<?php landpick_post_format_class('blog-post-img'); ?>">
	<?php the_post_thumbnail( 'landpick-800x400-crop', array('class' => 'img-fluid') ) ?>	
</div><!-- BLOG POST IMAGE -->
<?php endif; ?>