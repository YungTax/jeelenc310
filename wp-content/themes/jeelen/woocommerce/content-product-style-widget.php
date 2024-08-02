<?php
/**
 * Product hover style template
 *
 * @package pls
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}
?>

<div class="product-widget-image">
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo $product->get_image(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
</div>
<div class="product-widget-content">
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
	</a>
	<?php if ( pls_get_loop_prop( 'show_rating' ) ) : ?>
		<?php woocommerce_template_loop_rating(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php endif; ?>
	<span class="price">
		<?php echo $product->get_price_html(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
</div>