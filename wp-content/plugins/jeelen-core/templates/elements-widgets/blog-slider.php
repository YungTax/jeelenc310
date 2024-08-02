<?php 
/**
 * Blog Slider Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">	
	<div class="section-content">
		<?php
		pls_post_loop_start();	
			while ( $query->have_posts() ) :
				$query->the_post();			
				// Include the loop post content template.
				get_template_part( 'template-parts/post-loop/layout', get_post_format() );

			endwhile;	
			wp_reset_postdata();
		pls_post_loop_end();
		pls_reset_loop(); ?>
	</div>
</div>