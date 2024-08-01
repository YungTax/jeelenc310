<?php
/**
 * Product hover style template
 *
 * @package pls
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="pls-product-inner">
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	
	<div class="pls-product-image">
		<?php 
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		
		pls_woocommerce_product_loop_quick_view_button();
		?>
	</div>
	<div class="pls-product-info">
		<?php 
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		pls_woocommerce_product_loop_categories();
		?>
		<div class="pls-product-title-wishlist">
			<?php 
			do_action( 'woocommerce_shop_loop_item_title' );
			pls_woocommerce_product_loop_wishlist_button();
			?>
		</div>
		<?php 
		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		
		<?php pls_woocommerce_product_loop_cart_button(); ?>
		
		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>