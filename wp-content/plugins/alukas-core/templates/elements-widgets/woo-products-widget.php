<?php 
/**
 * Products Widget Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php } 
		echo do_shortcode( '[products '. $shortcodestr . ']'  );	
		wp_reset_postdata();
		pls_reset_loop();
	?>
	
</div>