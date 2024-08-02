<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $recently_viewed_products ) : 
	$unique_id 		= pls_uniqid( 'section-' );
	$slider_data 	= array(
		'slider_autoplay'   		=> ( pls_get_option( 'related-upsell-auto-play', 1) ) ? 'yes' : false,
		'slider_loop'   			=> ( pls_get_option( 'related-upsell-loop', 1) ) ? 'yes' : false,
		'slider_autoHeight'			=> false,
		'slider_navigation' 		=> ( pls_get_option( 'related-upsell-navigation', 1) ) ? 'yes' : false,
		'slider_dots'     			=> ( pls_get_option( 'related-upsell-product-dots', 1) ) ? 'yes' : false,
		'slides_to_show'			=> pls_get_option( 'related-upsell-products-columns', 4 ),			
		'slides_to_show_tablet'		=> pls_get_option( 'related-upsell-products-columns-tablet', 3 ),
		'slides_to_show_mobile'		=> pls_get_option( 'related-upsell-products-columns-mobile', 2 ),
	);
	pls_set_loop_prop( 'name', 'pls-slider' );
	pls_set_loop_prop( 'slider_navigation', ( pls_get_option( 'related-upsell-navigation', 1) ) ? true : false );
	pls_set_loop_prop( 'slider_dots', ( pls_get_option( 'related-upsell-product-dots', 1) ) ? true : false );
	pls_set_loop_prop( 'products-columns', pls_get_option( 'related-upsell-products-columns', 4 ) );
	pls_set_loop_prop( 'slides_to_show', pls_get_option( 'related-upsell-products-columns', 4) );
	pls_set_loop_prop( 'slides_to_show_tablet', pls_get_option( 'related-upsell-products-columns-tablet', 3 ) );
	pls_set_loop_prop( 'slides_to_show_mobile', pls_get_option( 'related-upsell-products-columns-mobile', 2 ) );
	pls_set_loop_prop( 'unique_id', $unique_id );
	pls_set_loop_prop( 'slider_options', pls_slider_attributes( $slider_data ) ); ?>

	<section class="recently-viewed">

		<h2><?php esc_html_e( 'Recently Viewed', 'pls-theme' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $recently_viewed_products as $product_id ) : ?>
				<?php
				 	$post_object = get_post( $product_id );
					if($post_object){
						setup_postdata( $GLOBALS['post'] =& $post_object );
						wc_get_template_part( 'content', 'product' );
					}
				?>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
