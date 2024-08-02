<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( pls_get_loop_prop( 'name' ) == 'pls-slider' ){ ?>
	<div id="<?php echo esc_attr( pls_get_loop_prop( 'unique_id' ) );?>" class="pls-slider swiper row">
		<div class="products <?php echo pls_product_row_classes(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" <?php if( ! empty( pls_get_loop_prop( 'slider_options' ) ) ){ echo 'data-slider_options="'.esc_attr( pls_get_loop_prop( 'slider_options' ) ).'"';  } ?> >
<?php }else { ?>
	<div class="products <?php echo pls_product_row_classes(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
<?php }?>

