<?php 
/**
 * Categories Default Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-content <?php echo esc_attr( $section_class ); ?>">
		<div class="products <?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
			<?php if ( $cutom_category ) {
				$count = 0;
				$total_categories = count($cutom_category);
				foreach ( $cutom_category as $cat ) {
					if( $rows > 1 && $count % $rows == 0 ){
						echo '<div class="slider-group swiper-slide">';
					}?>
					<div class="product-category product <?php echo esc_attr($column_class);?>">
						<div class="pls-product-inner">
							<div class="category-image">
								<a href="<?php echo esc_url( $cat['category_link'] );?>">
									<?php if( !empty( $cat['category_image'] ) ) {?>
									<img src="<?php echo esc_url( $cat['category_image']);?>" alt="<?php esc_attr($cat['category_title']);?>"/>
									<?php } else {?>
									<img src="<?php echo esc_url( PLS_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_attr($cat['category_title']);?>"/>
									<?php } ?>
								</a>
							</div>
							<?php if( $show_cat_title ) { ?>
								<h3 class="woocommerce-loop-category__title">
									<a href="<?php echo esc_url( $cat['category_link'] );?>">				
										<?php echo $cat['category_title'];									
										if( $show_count ) {
											echo sprintf(
												'<span class="product-count">%1$s</span>',
												sprintf( _n( '%s Product', '%s Products', $cat['category_count'], 'pls-core' ), $cat['category_count'] )
											);
										} ?>
									</a>
								</h3>
							<?php } ?>
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