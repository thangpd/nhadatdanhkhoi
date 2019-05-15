<div class="blog-post-txt">
	<p class="post-meta"><?php landpick_entry_meta(); ?></p>
	
	<h5 class="h5-sm"><?php landpick_sticky_post_text(); ?><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5><!-- Post Title -->	
	<?php echo landpick_get_trim_words(get_the_excerpt(), 13, '...'); ?>
	
</div><!-- BLOG POST TEXT -->

<?php if( has_post_thumbnail() ): ?>			
<div class="blog-post-img">
	<?php the_post_thumbnail( 'landpick-800x400-crop', array('class' => 'img-fluid') ) ?>	
</div><!-- BLOG POST IMAGE -->
<?php endif; ?>
