<?php
/**
 * Template part for displaying secondary menu
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

if ( has_nav_menu( 'secondary' ) ) { 	
	wp_nav_menu( 
		array( 
			'theme_location' 	=> 'secondary',
			'container_class'   => 'pls-main-navigation pls-navigation pls-menu-hover-'.$hover_style,
			'walker' 			=> new PLS_Mega_Menu_Walker()
		)
	); 
}		