<?php 
/**
 * WC Vendors Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<div class="pls-vendors-list <?php echo esc_attr($slider_class);?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
		<?php 
		$count = 0;
		foreach ( $vendors as $key => $vendor_id ) {
			
			$store_banner_id	= get_user_meta( $vendor_id, '_wcv_store_banner_id', true );
			$store_name			= WCV_Vendors::get_vendor_shop_name( $vendor_id );
			$store_url			= WCV_Vendors::get_vendor_shop_page( $vendor_id );
			$vendor_meta = array_map(
				function ( $a ) {
						return $a[0];
				},
				get_user_meta( $vendor_id )
			);
			
			// Migrate to store address array
			$address1       = ( array_key_exists( '_wcv_store_address1', $vendor_meta ) ) ? $vendor_meta['_wcv_store_address1'] : '';
			$address2       = ( array_key_exists( '_wcv_store_address2', $vendor_meta ) ) ? $vendor_meta['_wcv_store_address2'] : '';
			$city           = ( array_key_exists( '_wcv_store_city', $vendor_meta ) ) ? $vendor_meta['_wcv_store_city'] : '';
			$state          = ( array_key_exists( '_wcv_store_state', $vendor_meta ) ) ? $vendor_meta['_wcv_store_state'] : '';
			$phone          = ( array_key_exists( '_wcv_store_phone', $vendor_meta ) ) ? $vendor_meta['_wcv_store_phone'] : '';
			$store_postcode = ( array_key_exists( '_wcv_store_postcode', $vendor_meta ) ) ? $vendor_meta['_wcv_store_postcode'] : '';

			$store_address = ( $address1 != '' ) ? $address1 . ', ' . $city . ', ' . $state . ', ' . $store_postcode : '';


			$store_banner_url	= get_user_meta( $vendor_id, '_wcv_store_banner_id', true ) ? wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_banner_id', true ), 'full' ) : WCVendors_Pro::get_option( 'default_store_banner_src' );
			$has_bg_class 		= $store_banner_id ? "has-vendor-background" : '';
			if( $rows > 1 && $count % $rows == 0 ){
				echo '<div class="slider-group swiper-slide">';
			}
			?>
			<div class="pls-single-vendor woocommerce <?php echo esc_attr($column_class);?>">
				<div class="pls-store-wrapper">
					<div class="pls-store-content">
						<div class="pls-store-content-wrapper <?php echo esc_attr($has_bg_class);?>" style="background-image: url( '<?php echo is_array( $store_banner_url ) ? esc_attr( $store_banner_url[0] ) : esc_attr( $store_banner_url ); ?>');">
							<div class="pls-store-content-container">
								
								<div class="pls-store-data">
									<h2><?php echo esc_html( $store_name ); ?></h2>
									
									<a class="button pls-store-link" href="<?php echo esc_attr( $store_url ); ?>"><?php esc_html_e( 'Visit Store', 'pls-core' )?></a>
								</div>
								<div class="vendor-avatar">
									<?php echo get_avatar( $vendor_id, 150 ); ?>						
								</div>
							</div>
						</div>
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