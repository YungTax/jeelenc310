<?php
/**
 * Template part for displaying cart
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

if( ! pls_get_option( 'header-cart', 1 ) || pls_get_option( 'catalog-mode', 0 ) || ! PLS_WOOCOMMERCE_ACTIVE || ( ! is_user_logged_in() && pls_get_option( 'login-to-see-price', 0 ) ) ) return;

global $woocommerce;
$count 				= WC()->cart->get_cart_contents_count();
$cart_url			= wc_get_cart_url();
$cart_style			= pls_get_option( 'header-cart-style', 1 );
?>			

<div class="pls-header-cart cart-style-<?php echo esc_attr($cart_style); ?>">
	<a href="<?php echo esc_url( $cart_url );?>">		
		<?php switch ( $cart_style ) {
			case 1: ?>
				<div class="pls-header-cart-icon">
					<span class="pls-header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				</div>
				<span class="pls-header-icon-text"><?php esc_html_e( 'Cart', 'pls-theme' );?></span>
				<?php
				break;
			case 2: ?>
				<div class="pls-header-cart-icon"></div>
				<span class="pls-header-icon-text"><?php esc_html_e( 'Cart', 'pls-theme' );?>				
					<span class="pls-header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				</span>
				<?php
				break;
			default:
		} ?>				
	</a>
	<?php if ( 'dropdow'== pls_get_option( 'header-minicart-popup', 'slider' ) && ! is_cart() && ! is_checkout() ){?>
		<div class="woocommerce widget_shopping_cart pls-arrow">
			<div class="dropdow-minicart-header">
				<h3 class="minicart-title"><?php echo apply_filters( 'pls_mini_cart_header_text', esc_html__( 'Your Cart', 'pls-theme' ) );?> <span class="pls-minicart-count">(<?php echo WC()->cart->get_cart_contents_count(); ?>)</span> </h3>
			</div>
			<div class="widget_shopping_cart_content">
				<?php woocommerce_mini_cart();?>
			</div>
		</div>
	<?php }?>	
</div>