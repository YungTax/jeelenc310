<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_style	= pls_get_loop_prop( 'product-style' );
$product_view 	= pls_get_loop_prop( 'products_view' );
$rows 			= (int) pls_get_loop_prop( 'product_rows' );
$count 			= (int) pls_get_loop_prop( 'count' );
$classes 		= pls_product_loop_classes();
if( $product_view == 'list-view' ||  $product_view == 'grid-list'){
	$product_style = 'product-list-view';
} 

if( $rows > 1 && $count % $rows == 0 ){
	echo '<div class="slider-group swiper-slide">';
}
?>

<div <?php wc_product_class( $classes, $product ); ?>>	 
	<?php wc_get_template_part( 'content', $product_style ); ?>	 
</div>
<?php
if( $rows > 1 && ( $count % $rows == $rows - 1 || $count == wc_get_loop_prop( 'total' ) - 1 ) ){
	echo '</div>';
} 
$count++;
pls_set_loop_prop( 'count', $count);