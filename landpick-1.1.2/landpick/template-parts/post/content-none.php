<div class="error">
	<div class="row">
		<div class="col-md-12">
			<?php
			$title = landpick_get_option( '404_title', '404');
			?>
			<h3 class="h3-xs"><?php 
			$subtitle = landpick_get_option( '404_subtitle', '{Sorry}, The page was not found');
			echo landpick_parse_color_text(esc_attr($subtitle)); 
			?></h3>
			<?php 
			$content = landpick_get_option('404_content');
			if( !empty($content) ){
				echo wpautop($content);
			}else{				
				echo '<p>'.sprintf(__('Sorry, the page you are looking for is not here. Use the search field below to find something else or go back to %1s to start from scratch.', 'landpick'), '<a href="'.get_home_url().'" class="primary-color">Homepage</a>').'</p>';
			 } ?>

			 <div class="error-search mt-50">
				<?php echo get_search_form() ?>
			</div>
		</div>
	</div><!-- .row -->
</div>

