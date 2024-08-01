<?php 
/***
* Products Grid Slider Template
**/
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<?php
		echo do_shortcode( '[products '. $shortcodestr . ']'  );
		wp_reset_postdata();
		pls_reset_loop(); 
	?>	
</div>