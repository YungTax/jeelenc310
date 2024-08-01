<?php
/**
 * Functions for dokan vendor plugin
 *
 * @since  1.0
 */
 
add_action( 'woocommerce_shop_loop_item_title', 'pls_dokan_loop_sold_by_label', 10 );
add_action( 'woocommerce_single_product_summary', 'pls_dokan_item_sold_by_label', 8 );

if ( ! function_exists( 'pls_dokan_loop_sold_by_label' ) ) {
	function pls_dokan_loop_sold_by_label(){
		$sold_by_loop = pls_get_option( 'enable-sold-by-in-loop' , 1 );
		if( !$sold_by_loop ) { return false; }
		pls_get_dokan_vendor_name();
	}
}

if ( ! function_exists( 'pls_dokan_item_sold_by_label' ) ) {
	function pls_dokan_item_sold_by_label(){
		$sold_by_single = pls_get_option( 'enable-sold-by-in-single' , 1 );
		if( !$sold_by_single ) { return false; }
		pls_get_dokan_vendor_name();
	}
}

if ( ! function_exists( 'pls_get_dokan_vendor_name' ) ) {
	function pls_get_dokan_vendor_name(){
		
		global $product;
		$author_id = get_post_field( 'post_author', $product->get_id() );
		$author    = get_user_by( 'id', $author_id );
		if ( empty( $author ) ) {
			return;
		}

		$shop_info = get_user_meta( $author_id, 'dokan_profile_settings', true );
		$shop_name = $author->display_name;
		if ( $shop_info && isset( $shop_info['store_name'] ) && $shop_info['store_name'] ) {
			$shop_name = $shop_info['store_name'];
		} 
		$sold_by_label = apply_filters('pls_sold_by_label',esc_html__( 'Sold By : ', 'pls-theme' ));
		?>
		<div class="sold-by">
			<span class="sold-by-label"><?php echo esc_html( $sold_by_label ); ?> </span>
			<a href="<?php echo esc_url( dokan_get_store_url( $author_id ) ); ?>"><?php echo esc_html( $shop_name ); ?></a>
		</div>
		<?php	
	}
}