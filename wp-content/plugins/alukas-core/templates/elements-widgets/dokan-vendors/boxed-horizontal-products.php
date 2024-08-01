<?php 
/**
 * Dokan Vendors Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<div class="<?php echo esc_attr( $wrapper );?>">
		<div class="pls-vendors-list <?php echo esc_attr($slider_class);?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
			<?php 
			$count = 0;
			foreach ( $vendors as $key => $vendor_id ) {
				$vendor				= dokan()->vendor->get( $vendor_id );
				$store_banner_id	= $vendor->get_banner_id();
				$store_name			= $vendor->get_shop_name();
				$store_url			= $vendor->get_shop_url();
				$store_rating		= $vendor->get_rating();
				$store_phone		= $vendor->get_phone();
				$is_store_featured 	= $vendor->is_featured();
				$store_info			= dokan_get_store_info( $vendor_id);
				$store_address		= dokan_get_seller_short_address( $vendor_id );
				$image_size			= 'full';
				$store_banner_url	= $store_banner_id ? wp_get_attachment_image_src( $store_banner_id, $image_size ) : DOKAN_PLUGIN_ASSEST . '/images/default-store-banner.png';
				if( $rows > 1 && $count % $rows == 0 ){
					echo '<div class="slider-group swiper-slide">';
				}
				?>
				<div class="pls-single-vendor woocommerce <?php echo esc_attr($column_class);?>">
					<div class="pls-store-wrapper">
						<div class="pls-store-content">
							<div class="pls-store-content-wrapper">
								<div class="pls-store-content-container">
									<?php if ( $is_store_featured ) : ?>
										<div class="pls-store-featured">							
											<div class="featured-label"><?php esc_html_e( 'Featured', 'pls-core' ); ?></div>
										</div>
									<?php endif ?>
									<div class="vendor-avatar">
										<?php echo get_avatar( $vendor_id, 150 ); ?>						
									</div>
									<div class="pls-store-data">
										<?php if ( ! empty( $store_rating['count'] ) ) { ?>
											<div class="star-rating pls-store-rating" title="<?php echo sprintf( esc_attr__( 'Rated %s out of 5', 'pls-core' ), esc_attr( $store_rating['rating'] ) ) ?>">
												<span style="width: <?php echo ( esc_attr( ( $store_rating['rating'] / 5 ) ) * 100 - 1 ); ?>%">
													<strong class="rating"><?php echo esc_html( $store_rating['rating'] ); ?></strong> <?php esc_html_e( 'out of 5', 'pls-core' ); ?>
												</span>
											</div>
										<?php } ?>							
									</div>
									<a class="button pls-store-link" href="<?php echo esc_attr( $store_url ); ?>"><?php esc_html_e( 'Visit Store', 'pls-core' )?></a>
								</div>
							</div>
						</div>
						<div class="pls-store-footer">						
							<div class="pls-store-data">
								<h2><?php echo esc_html( $store_name ); ?></h2>	
								<?php if ( $store_address || $store_phone ){ ?>
									<ul class="store-details">
										<?php if ( $store_address ){
											$allowed_tags = array(
												'span' => array(
													'class' => array(),
												)
											); ?>
											<li class="store-address">
												<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo wp_kses( $store_address, $allowed_tags ); ?>
											</li>
										<?php } ?>
										
										<?php if ( $store_phone ) { ?>
											<li class="store-phone">
												<i class="fa fa-mobile" aria-hidden="true"></i> <?php echo esc_html( $store_phone ); ?>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</div>
							<?php
							if( $recent_products ) {
								$args = array(
									'posts_per_page' => 4,
									'author' => $vendor_id,
								);
								$query = pls_core_vendor_products( $args );
								if ( $query->have_posts() ){
									echo '<div class="pls-store-products">';				
									while ( $query->have_posts() ) : $query->the_post();
										echo '<div class="store-product">';
										echo '<a href="'. get_permalink( $query->ID ) .'">';
											$image_size = 'thumbnail';
											echo pls_get_post_thumbnail( $image_size );
										echo '</a>';
										echo '</div>';
									endwhile;
									echo '</div>';
								}
								wp_reset_postdata(); 
							} 
							?>						
						</div>
					</div>
				</div>	
			<?php 
				if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $vendors_count - 1) ){
					echo '</div>';
				}
				$count++;
			}	?>
		</div>
	</div>
</div>