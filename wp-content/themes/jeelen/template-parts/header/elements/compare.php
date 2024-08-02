<?php
/**
 * Template part for displaying compare in header.php
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

if( ! pls_get_option( 'header-compare', 1 ) || ! PLS_WOOCOMMERCE_ACTIVE || ! defined( 'YITH_WOOCOMPARE' ) ) {
	return;
}
				
global $yith_woocompare; 
$compare_count = count( $yith_woocompare->obj->products_list ); 
?>

<div class="pls-header-compare">
	<a href="#" class="yith-woocompare-open">
		<span class="pls-header-compare-icon">
			<span class="pls-header-compare-count"><?php echo esc_html( $compare_count );?></span>
		</span>
		<span class="pls-header-icon-text"><?php esc_html_e( "Compare", 'pls-theme') ?></span>
	</a>	
</div>	