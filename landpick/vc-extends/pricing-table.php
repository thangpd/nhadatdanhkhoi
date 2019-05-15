<?php
add_filter( 'perch_modules/vc/perch_pricing_table', 'landpick_vc_pricing_table_default_args' );
function landpick_vc_pricing_table_default_args( $args ){
	$default = array(
		'align' => '',              
        'title' => 'Starter', 
        'title_font_container' => 'tag:h4|size:xs',
        'validity' => 'monthly', 
        'validity_font_container' => 'tag:p|extra_class:validity',
        'leadtext' => '',
        'subtitle_font_container' => 'tag:p|size:md',    
        'el_class' => '',       
    );

    $args = landpick_set_default_vc_values($default, $args);   
    
    return $args;    
}

add_filter( 'perch_modules/pricing_table/output', 'landpick_vc_pricing_table_output', 10, 3 );
function landpick_vc_pricing_table_output( $output, $args, $atts ){
    if( !empty($args) ){
        extract($args);
        $output ='
        <div '. implode( ' ', $wrapper_attributes ).'> 
            <div class="pricing-table">
                <div class="pricing-title">'.$pricing_title.'</div>
                <div class="pricing-text">              
                '.$leadtext_html.' 
                </div>      
                '.$feture_list_html.'
                <div class="pricing-plan price">                    
                    '.$price_html.'   
                    '.$validity_html.'
                    '.$vat_html.' 
                </div>                 
                '.$button_html.'           
            </div>       
        </div>';
    }
    return $output;
}