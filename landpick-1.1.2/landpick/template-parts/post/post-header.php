<div class="blog-post-txt">
	<div class="theme-color post-meta"><?php landpick_entry_meta(); ?></div>
	
	<h5 class="h5-lg"><?php landpick_sticky_post_text(); ?><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5><!-- Post Title -->
	
	<?php the_excerpt(); ?><!-- Post Text -->	
	
</div><!-- BLOG POST TEXT -->
