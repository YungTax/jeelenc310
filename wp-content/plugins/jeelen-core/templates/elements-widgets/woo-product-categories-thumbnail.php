<?php 
/**
 * Product Categories Thumbnail Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-content<?php echo esc_attr( $row_class ); ?>">
		<div class="products <?php echo esc_attr( $slider_class ); ?>" 
		<?php if( $layout == 'slider' ) : ?>
			data-slider_options="<?php echo esc_attr( $slider_options );?>" 
		<?php endif;?>>	
			<?php if ( $product_categories ) {
				$count = 0;
				$lastElement = end( $product_categories );	
				$total_categories = count($product_categories);
				foreach ( $product_categories as $cat ) {
					$cate_link = get_term_link( $cat ); 
					if( $rows > 1 && $count % $rows == 0 ){
						echo '<div class="slider-group swiper-slide">';
					}?>
					<div class="product-category <?php echo esc_attr($column_class);?>">	
						<a href="<?php echo esc_url($cate_link);?>">
							<div class="category-image">
								<?php 
								if( $image_type == 'icon' ){
									$prefix = PLS_PREFIX;
									$thumbnail_id = get_term_meta( $cat->term_id, $prefix.'category_icon', true );
								}else{
									$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
								}
								
								$category_img = wp_get_attachment_image_src( $thumbnail_id, $image_size );
								if ( ! empty( $category_img ) ) { 
									$attribute 			= array();
									$attribute['alt'] 	= esc_html($cat->name);
									 echo pls_get_image_html($thumbnail_id, $image_size, '', $attribute);					
								}else{ ?>
									<img src="<?php echo esc_url(PLS_CORE_URL.'assets/images/product-thumbnail.jpg');?>" alt="<?php esc_html($cat->name);?>"/>
								<?php } ?>
							</div>
							
							<?php if( $show_title ){ ?>
								<div class="category-title"><span><?php echo esc_html($cat->name); ?></span></div>
							<?php } ?>
						</a>
					</div>
					<?php
					if( $rows > 1 && ($count % $rows == $rows - 1 || $cat == $lastElement) ){
						echo '</div>';
					}
					$count++; 
				}
			} ?>
		</div>
	</div>
</div>