<?php 
/**
 * Categories and Sub Categories Box Template
 */
?>
<div class="<?php echo esc_attr( $class );?>">
	<div id="<?php echo esc_attr($id);?>" class="section-content <?php echo esc_attr( $section_class ); ?>">
		<div class="products <?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >	
			<?php if ( $product_categories ) {
				$count = 0;
				$total_categories = count($product_categories);
				$lastElement = end( $product_categories );	
				foreach ( $product_categories as $cat ) {
					
					$cate_link = get_term_link( $cat ); 					
					//Get Sub Categories								
					$args['parent']= $cat->term_id;
					$args['number']= 5;
					$args['hide_empty']= ($hide_empty_categories) ? true : false;
					$inner_subcats = get_categories($args);
					
					if( ! empty( $inner_subcats ) ){
						if( $rows > 1 && $count % $rows == 0 ){
							echo '<div class="slider-group swiper-slide">';
						} 
						?>
						<div class="product <?php echo esc_attr($column_class);?>">
							<div class="pls-product-inner">								
								<div class="sub-categories-content">
									<div class="category-image">
										<?php $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
										$catalog_img = wp_get_attachment_image_src( $thumbnail_id, $image_size );
										if ( ! empty( $catalog_img ) ) { 
											$attribute 			= array();
											$attribute['alt'] 	= esc_html($cat->name);
											?>
											<a href="<?php echo esc_url($cate_link);?>">
												<?php echo pls_get_image_html( $thumbnail_id, $image_size, '', $attribute ); ?>
											</a>
										<?php }else{ ?>
											<img src="<?php echo esc_url(PLS_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html($cat->name);?>"/>
										<?php } ?>
									</div>
									<div class="category-content">										
										<?php if( ! empty( $inner_subcats ) ){?>
											<h5 class="category-title">
												<a href="<?php echo esc_url($cate_link);?>"><?php echo esc_html($cat->name);?></a>
											</h5>
											<ul class="sub-categories">
												<?php foreach( $inner_subcats as $inner_subcat ){
													$inner_subcat_link = get_term_link( $inner_subcat ); ?>
													<li>
														<a href="<?php echo esc_url($inner_subcat_link);?>"><?php echo esc_html($inner_subcat->name);?></a>
													</li>
												<?php }?>
												<li class="show-all-cate">
													<a href="<?php echo esc_url( $cate_link );?>"><?php echo esc_html__('Show All', 'pls-core');?></a>
												</li>
											</ul>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						<?php 
						if( $rows > 1 && ($count % $rows == $rows - 1 || $cat == $lastElement) ){
							echo '</div>';
						}
						$count++; 
					}
				}
			} ?>
		</div>
	</div>
</div>