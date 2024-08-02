<?php
/**
 * Template part for displaying header logo
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
		
$logo_url 				= pls_get_option( 'header-logo', array( 'url' => PLS_IMAGES.'logo-1.svg' ) );
$logo_light_url 		= pls_get_option( 'header-logo-light', array( 'url' => PLS_IMAGES.'logo-light-1.svg' ) );
$mobile_logo_url		= pls_get_option( 'mobile-header-logo', array( 'url' => PLS_IMAGES.'logo-1.svg' ) );
$site_title 			= get_bloginfo( 'name', 'display' );

if( is_ssl() ) {
	$logo 					= str_replace('http://', 'https://', $logo_url['url']);
	$logo_light				= str_replace('http://', 'https://', $logo_light_url['url']);
	$mobile_logo 			= str_replace('http://', 'https://', $mobile_logo_url['url']);
}else{
	$logo					= $logo_url['url'];
	$logo_light				= $logo_light_url['url'];
	$mobile_logo			= $mobile_logo_url['url'];
}?>	

<div class="pls-header-logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="<?php echo esc_attr('home');?>">
		<img class="pls-logo" src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($site_title);?>" />
		<img class="pls-logo-light" src="<?php echo esc_url($logo_light);?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) );?>" />
		<img class="pls-mobile-logo" src="<?php echo esc_url($mobile_logo);?>" alt="<?php echo esc_attr($site_title);?>" />
	</a>
</div>
