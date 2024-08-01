<?php
/**
 * Template part for displaying email adress on topbar
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

if( pls_get_option( 'header-email','support@domain.com' ) != '' ) { ?>			
	<span class="pls-contact-email"><?php echo esc_html( pls_get_option('header-email','support@domain.com' ) );?></span>
<?php } ?>
