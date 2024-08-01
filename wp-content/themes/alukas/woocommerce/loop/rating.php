<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}
$review_count 	= $product->get_review_count();
?>

<div class="pls-star-rating">
	<?php
	if( $review_count ){
		echo wc_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.
	}else{
		$label = sprintf( esc_html__( 'Rated %s out of 5', 'pls-theme' ), 0 );
		$output  = '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( 0, 0 ) . '</div>';
		echo $output; // WordPress.XSS.EscapeOutput.OutputNotEscaped.
	}
	
	if( pls_get_option( 'product-rating-count', 1 ) ){
		 ?>
		<span class="rating-counts">
			<?php echo sprintf( _n( '(%s)', '(%s)', $review_count, 'pls-theme' ), number_format_i18n( $review_count ) );?>
		</span>
	<?php } ?>
</div>