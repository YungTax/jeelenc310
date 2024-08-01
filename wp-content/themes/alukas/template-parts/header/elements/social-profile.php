<?php
/**
 * Template part for displaying social profile icon on topbar
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

$style 	= pls_get_option( 'social-profile-icons-style', 'icons-default' );
$shape 	= pls_get_option( 'profile-icons-shape', 'icons-shape-circle' );
$size 	= pls_get_option( 'profile-icons-size', 'icons-size-default' );
if ( function_exists( 'pls_social_share' ) ) {		
	pls_social_share( 
		array(
			'type' => 'profile', 
			'style' => $style, 
			'shape' => $shape,
			'size' => $size
		) 
	);
}