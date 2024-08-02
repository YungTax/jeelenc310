<?php
/**
 * Template part for displaying mini search in header.php
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

if( ! pls_get_option( 'header-search', 1 ) ) return;
?>			

<div class="pls-header-mini-search">
	<a class="search-icon-text" href="#">
		<span class="header-search-icon"></span>
		<span class="pls-header-icon-text"><?php esc_html_e( 'Search', 'pls-theme') ?></span>
	</a>
</div>	