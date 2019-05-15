<?php 
if ( $posts->have_posts() ):  
$info = $posts->info;
extract($info);
?>
<div class="row">
    <?php 
    // Posts are found
    $count = 300;
    while ( $posts->have_posts() ) :
        $posts->the_post();
        global $post;        
        ?>
        <div class="col-md-6 col-lg-4">           
            <div class="blog-post mb-40">
                <div class="blog-post-txt">
                    <p class="post-meta theme-color"><?php landpick_entry_meta(); ?></p>
                    
                    <h5 class="h5-sm"><?php landpick_sticky_post_text(); ?><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5><!-- Post Title --> 
                    <?php echo landpick_get_trim_words(get_the_excerpt(), $excerpt_length, '...'); ?>
                    
                    </div><!-- BLOG POST TEXT -->

                    <?php if( has_post_thumbnail($post->ID) ): ?>            
                    <div class="blog-post-img">
                        <?php $image_url = get_the_post_thumbnail_url( $post->ID, $img_size ); ?>  
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr( get_the_title($post->ID) ) ?>" class="img-fluid"> 
                    </div><!-- BLOG POST IMAGE -->
                    <?php endif; ?>   

                    <?php
                    $read_more_text = landpick_get_option( 'read_more_text', 'More Details' );
                    $read_more_text = sprintf( _x('%s', 'Read more text', 'landpick'), $read_more_text );
                    ?>
                    <div class="blog-post-link">
                        <h5 class="h5-xs"><a href="<?php the_permalink(); ?>"><?php echo esc_attr($read_more_text); ?></a></h5>
                        <div class="footer-meta"><?php landpick_footer_entry_meta(); ?></div>
                    </div><!-- Post Link -->   
                                
            </div>                
        </div>

        <?php  
        $count = $count + 100;
    endwhile; 
   ?>   
</div>
<?php 
// Posts not found
else :
    echo '<h4>' . __( 'Posts not found', 'landpick' ) . '</h4>';
endif; 





