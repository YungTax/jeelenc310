<?php 
/***
* products recently viewed template
**/
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<?php
	woocommerce_product_loop_start();		
		while ( $query->have_posts() ) {			
			$query->the_post();
			wc_get_template_part( 'content', 'product' );
		}
		wp_reset_postdata();			
	woocommerce_product_loop_end();
	pls_reset_loop(); ?>
</div>