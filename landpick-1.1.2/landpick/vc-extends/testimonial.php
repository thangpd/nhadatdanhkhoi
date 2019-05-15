<?php
add_filter( 'perch_modules/vc/perch_testimonial', 'landpick_vc_testimonial_default_args' );
function landpick_vc_testimonial_default_args( $args ){
	$default = array(
		'align' => '',              
        'title' => 'Super Support!', 
        'title_font_container' => 'tag:h5|size:md',
        'name' => 'Robert Peterson', 
        'name_font_container' => 'tag:h5|size:xs',
        'info' => 'SEO Manager', 
        'info_font_container' => 'tag:span',
        'subtitle' => 'An orci nullam tempor sapien, eget orci gravida donec enim ipsum porta justo integer at odio velna auctor. Magna undo ipsum vitae purus ipsum primis in laoreet augue lectus',
        'subtitle_font_container' => 'tag:p',
        'review' => 'star:star:star:star:star-half',       
        'el_class' => 'review',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}

add_filter( 'perch_modules/testimonial/output', 'landpick_testimonial_output', 10, 3 );
function landpick_testimonial_output($html, $html_args, $atts){
    extract($atts);
    extract($html_args);

    '<!-- TESTIMONIAL #1 -->
                                <div class="review-1">
                                                                                                    
                                    <!-- Testimonial Text -->
                                    <p>An orci nullam tempor sapien, eget orci gravida donec enim ipsum porta justo integer at odio
                                       velna auctor. Magna undo ipsum vitae purus ipsum primis in laoreet augue lectus                     
                                    </p>    

                                    <!-- Testimonial Author -->
                                    <div class="author-data clearfix">
                                    
                                        <!-- Author Avatar -->
                                        <div class="testimonial-avatar">
                                            <img src="images/review-author-1.jpg" alt="testimonial-avatar">
                                        </div>

                                        <!-- Author Data -->
                                        <div class="review-author">

                                            <h5 class="h5-xs">pebz13</h5>   

                                            <!-- App Rating -->
                                            <div class="app-rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half"></i>
                                            </div>  

                                        </div>

                                    </div>  <!-- End Testimonial Author -->                                                     
                                                            
                                </div>';

    // Fill $html var with data
        if( $display_as == 'review-3' ){
            $html = '<div '. implode( ' ', $wrapper_attributes ).'>
                        '.$single_image.' 
                        '.$review_title.'
                        '.$subtitle_html.' 

                        <!-- Author Data -->
                        <div class="review-author">
                            '.$title_html.' 
                            '.$info.'
                            '.$rating_html.'
                        </div>
                </div><!-- END review style 3-->'."\n";
        }elseif( $display_as == 'review-2' ){
            $html = '
            <div '. implode( ' ', $wrapper_attributes ).'>
                '.$image_html.'
                '.$review_title.'
                '.$subtitle_html.'
                '.$title_html.'
                '.$info.'            
                '.$rating_html.'
            </div>  <!-- END review style 2-->'."\n"; 
        }else{

            $html = '<div '. implode( ' ', $wrapper_attributes ).'>
                <div class="review-txt">
                    '.$review_title.'
                    '.$subtitle_html.'
                </div>  <!-- Testimonial Text -->
                
                <div class="review-author clearfix">
                    '.$image_html.'
                    <div class="review-author">
                    '.$title_html.'
                    '.$info.'
                    '.$rating_html.'
                    </div>
                </div><!-- Testimonial Author -->                
            </div>  <!-- END review style 1-->'."\n"; 

        }

    return $html;    
}