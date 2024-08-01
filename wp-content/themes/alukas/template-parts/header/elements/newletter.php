<?php
/**
 * Template part for displaying newsletter
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

if( pls_get_option( 'header-newsletter' ) !='' ) { ?>
	<span class="header-newsletter"><i class="picon-envelope"></i> <?php echo esc_html( pls_get_option('header-newsletter','Newsletter') );?></span>
<?php } ?>
