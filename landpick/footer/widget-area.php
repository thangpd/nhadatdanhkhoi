<?php if ( Landpick_Footer_Config::widget_area_is_on() ): ?>
<div class="row pt-100 mb-20">
	<?php
	$classArr = array('col-lg-4', 'col-md-4 col-lg-3', 'col-md-3 col-lg-2 offset-md-1 offset-lg-0', 'col-md-4 col-lg-3');
	$classArr = apply_filters( 'landpick_footer_widget_area_column_classes', $classArr );

    $total = landpick_get_option( 'footer_widget_area_column', '4' );
    for( $i=1; $i<=$total; $i++ ):
        $class = ($total == 4)? $classArr[$i-1] : 'col-md-'.(12/$total);       
        $sidebar = 'footer-'.$i;
        if ( is_active_sidebar( $sidebar ) ) :
        	 $class .= ' ';
			?>
			<div class="<?php echo esc_attr($class) ?>">
	            <?php  dynamic_sidebar( $sidebar ); ?>
	        </div>
			<?php 
		else:
			echo '<div class="'.esc_attr($class).'"></div>';	
		endif;
	endfor;
	?>
</div>
<?php endif; ?>
