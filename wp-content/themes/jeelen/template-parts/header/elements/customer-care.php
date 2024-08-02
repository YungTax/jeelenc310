<?php
/**
 * Template part for displaying customer care on topbar
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

if( '' != pls_get_option( 'header-phone-number', '+123 4567 890' ) ) { ?>
	<span class="pls-customer-care">		
		<span class="pls-customer-care-icon"></span>
		<span><?php echo esc_html( pls_get_option( 'header-phone-number', '+123 4567 890' ) ); ?></span>
	</span>
<?php } ?>
