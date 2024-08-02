<?php
/**
 * Template part for displaying wishlist in header.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! pls_get_option( 'header-wishlist', 1 ) || ! PLS_WOOCOMMERCE_ACTIVE || ! function_exists( 'YITH_WCWL' ) ){
	return;
}

$wishlist_url 	= YITH_WCWL()->get_wishlist_url();
$wishlist_count	= YITH_WCWL()->count_products(); ?>			

<div class="pls-header-wishlist">
	<a href="<?php echo esc_url( $wishlist_url );?>">
		<span class="pls-header-wishlist-icon">
			<span class="pls-header-wishlist-count"><?php echo esc_html( $wishlist_count );?></span>			
		</span>
		<span class="pls-header-icon-text"><?php esc_html_e( 'Wishlist', 'pls-theme' );?></span>
	</a>	
</div>
