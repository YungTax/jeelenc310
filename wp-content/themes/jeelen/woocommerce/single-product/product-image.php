<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           	= apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id 	= $product->get_image_id();
$attachment_ids 	= $product->get_gallery_image_ids(); // PLS
$wrapper_classes   	= apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'pls-product-gallery-' . ( $attachment_ids ? 'with-thumbnails' : 'without-thumbnails' ),
		'images',
	)
);
$is_quick_view      = pls_get_loop_prop( 'is_quick_view' );
$gallery_style 		= pls_get_product_gallery_style();	
$gallery_classes 	= array( 'single-product-images-wrapper' );

if( $attachment_ids && ( 'product-gallery-left' == $gallery_style || 'product-gallery-right' == $gallery_style || 'product-gallery-bottom' == $gallery_style || 'product-gallery-none' == $gallery_style || 'product-gallery-horizontal' == $gallery_style ) ){
	$gallery_classes[] 	= 'single-product-gallery';
}

if( $is_quick_view ) {
	$gallery_style 		= 'no-thumbnails';
	$gallery_classes[] 	= 'single-product-gallery';
}

$single_product_gallery_classes		= apply_filters( 'single_product_gallery_classes', $gallery_classes );
$single_product_thumbnails_classes	= apply_filters( 'single_product_thumbnails_classes', array( 'single-product-thumbnails' ) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" >
	<div class="woocommerce-product-gallery__wrapper">
		<?php do_action( 'pls_product_gallery_top' ); ?>
		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $single_product_gallery_classes ) ) ); ?>">
		<?php
		if ( $post_thumbnail_id ) {
			array_unshift( $attachment_ids, $post_thumbnail_id );
			$html = pls_wc_get_gallery_html( $attachment_ids, true );
		} else {
			$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			$html              = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
			$html             .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'pls-theme' ) );
			$html             .= '</div>';
		}
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		?>
		</div>
		<div class="pls-gallery-bottom-btns">
			<?php do_action( 'pls_product_gallery_bottom' ); ?>
		</div>
	</div>
	<?php if( $attachment_ids && count( $attachment_ids ) > 1 && ( 'product-gallery-left' == $gallery_style || 'product-gallery-right' == $gallery_style || 'product-gallery-bottom' == $gallery_style ) ){?>
		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $single_product_thumbnails_classes  ) ) ); ?>">
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</div>
	<?php }?>
</div>
