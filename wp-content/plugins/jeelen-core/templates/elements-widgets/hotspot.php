<?php 
/**
 * Hotspot Template
 */
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class );?>">
	<div class="pls-hotspot-wrapper">
		<?php if( ! empty( $image_src ) ){ ?>
			<img src="<?php echo esc_url( $image_src );?>" alt="<?php echo esc_attr_e('Hotspot','pls-core');?>">
		<?php } ?>
		<div class="pls-hotspot-items">
			<?php $i = 1;
			foreach ( $hotspot_items as $item ): ?>
				<div class="pls-hotspot-item elementor-repeater-item-<?php echo esc_attr($item['_id']);?>">					
					<div class="pls-hotspot-content pls-hotspot-content-<?php echo esc_attr($item['hotspot_position']);?>">
						<?php if( $item['content_type'] == 'product' && ! empty( $item['product_id'] ) ){
							$product_id = $item['product_id'];
							$product 	= wc_get_product($product_id); 
							if( !$product){
								return;
							}
							?>
							<div class="pls-hotspot-product">
								<div class="pls-product-image">
									<a href="<?php echo esc_url( get_permalink( $product_id ) );?>">
										<?php echo $product->get_image();?>
									</a>
								</div>
								<div class="pls-product-info">
									<div class="product-title">
										<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
											<?php echo esc_html( $product->get_title() ); ?>
										</a>
									</div>
									<div class="product-price">
										<?php echo $product->get_price_html();?>
									</div>
									<div class="pls-cart-button">
										<a class="button" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>">
											<?php echo esc_html( $product->add_to_cart_text() ); ?>
										</a>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="pls-hotspot-custom-text">
								<?php echo do_shortcode( $item[ 'custom_content' ] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php $i++;
			endforeach ?>
		</div>
	</div>
</div>
