<?php 
/**
 * Categories Default Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-content <?php echo esc_attr( $section_class ); ?>">
		<div class="products <?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
			<?php if ( $product_categories ) {
				$count = 0;
				$total_categories = count($product_categories);
				foreach ( $product_categories as $cat ) {
					$cate_link = get_term_link( $cat );
					if( $rows > 1 && $count % $rows == 0 ){
						echo '<div class="slider-group swiper-slide">';
					} ?>
					<div class="product-category product <?php echo esc_attr($column_class);?>">
						<div class="pls-product-inner">
							<div class="category-image">
								<a href="<?php echo esc_url($cate_link);?>">
									<?php $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
									$catalog_img = wp_get_attachment_image_src( $thumbnail_id, $image_size );
									if ( ! empty( $catalog_img ) ) {
										$attribute 			= array();
										$attribute['alt'] 	= esc_html($cat->name);
										echo pls_get_image_html( $thumbnail_id, $image_size, '', $attribute ); 
									}else{ ?>
										<img src="<?php echo esc_url(PLS_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html($cat->name);?>"/>
									<?php } ?>
								</a>
							</div>
							<h3 class="woocommerce-loop-category__title">
								<a href="<?php echo esc_url( $cate_link );?>">									
									<?php echo esc_html( $cat->name );									
									if( $show_count ) {
										echo sprintf(
											'<span class="product-count">%1$s</span>',
											sprintf( _n( '%s Product', '%s Products', $cat->count, 'pls-core' ), $cat->count )
										);
									} ?>
								</a>
							</h3>
						</div>
					</div>
					<?php 
					if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $total_categories - 1) ){
						echo '</div>';
					}
					$count++; 
				}
			} ?>
		</div>
	</div>
</div>