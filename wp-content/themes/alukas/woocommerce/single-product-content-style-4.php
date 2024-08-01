<?php
/**
 * Single product content style 1 template
 *
 * @package pls
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="pls-product-container">
	<div class="pls-single-product-top">
		<?php
		/**
		 * Hook: pls_woocommerce_single_product_top.
		 *
		 * @hooked pls_single_product_breadcrumbs - 10
		 * @hooked pls_single_product_navigation - 20
		 */
		do_action( 'pls_woocommerce_single_product_top' );
		?>
	</div>
	<div class="pls-single-product-wrapper">
		<div class="single-product-content row">
			<div class="col-12">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
			<div class="col-12 row">
				<div class="col-lg-6">
					<div class="summary entry-summary">
						<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 */
						do_action( 'woocommerce_single_product_summary_first' );
						?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="summary entry-summary">
						<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						do_action( 'woocommerce_single_product_summary' );
						?>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>