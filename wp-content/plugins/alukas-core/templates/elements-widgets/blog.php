<?php 
/**
 * Blog Template
 */
?>
<div id="<?php echo esc_attr( $id );?>" class="<?php echo esc_attr( $class );?>">
	<?php
	pls_post_loop_start();	
		while ( $query->have_posts() ) :
			$query->the_post();			
			// Include the loop post content template.
			get_template_part( 'template-parts/post-loop/layout', get_post_format() );
		endwhile;
		
	pls_post_loop_end();
	
	if( $show_pagination ) { ?>
		<nav class="pls-pagination">
			<?php		
			if ( $pagination != 'default' ){
				$load_more_label 		= pls_get_loop_prop( 'blog-pagination-load-more-button-text' );
				$loading_finished_msg 	= pls_get_loop_prop( 'blog-pagination-finished-message' );
			?>
			<div class="pls-blog-load-more" data-pagination_style = "<?php echo esc_attr($pagination);?>" data-page="2" data-total="<?php echo esc_attr($total);?>" data-attribute="<?php echo esc_attr($attribute); ?>" data-load_more_label="<?php echo esc_html($load_more_label); ?>" data-loading_finished_msg="<?php echo esc_html($loading_finished_msg); ?>">
				<a class="button pls-load-more <?php echo esc_attr( $pagination ); ?>" href="javascript:void(0);">
					<?php echo esc_html( $load_more_label ); ?>
				</a>
			</div>
			<?php }else{				
				echo paginate_links(
					apply_filters(
						'pls_pagination_args',
						array( // WPCS: XSS ok.
							'base'      => $base,
							'format'    => $format,
							'add_args'  => false,
							'current'   => max( 1, $current ),
							'total'     => $total,
							'prev_text' => esc_html__( 'Previous', 'pls-core' ),
							'next_text' => esc_html__( 'Next', 'pls-core' ),
							'type'      => 'list',
							'end_size'  => 2,
							'mid_size'  => 2,
						)
					)
				);
			} ?>
		</nav>
	<?php }
	wp_reset_postdata();
	pls_reset_loop();
	?>
</div>