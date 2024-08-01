<?php
/**
 * Template part for displaying main menu
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

$hover_style = pls_get_option( 'menu-hover-style', 'line' );

wp_nav_menu(
	array(
		'theme_location' 	=> 'primary',
		'container_class'   => 'pls-main-navigation pls-navigation pls-menu-hover-'.$hover_style,
		'fallback_cb' 		=> 'pls_fallback_menu',
		'walker' 			=> new PLS_Mega_Menu_Walker()
	)
);