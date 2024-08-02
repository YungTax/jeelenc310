<?php
/**
 * Template part for displaying location of topbar
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

if( pls_get_option( 'header-store-location' ) != '' ) {
	$pageID = pls_get_option( 'header-store-location-page', '' );
	if( ! empty ( $pageID ) ) {
		$pageURL = get_page_link( $pageID );
	}else{
		$pageURL = '#';
	} ?>
	<span class="pls-store-location">
		<a class="store-location-icon-text" href="https://maps.app.goo.gl/sVnBXWDGXXZdGdAU9" target="_blank">
			<span class="pls-store-location-icon"></span>
			<span><?php echo esc_html( pls_get_option( 'header-store-location', 'Find Store' ) );?></span>
		</a>
	</span>
<?php } ?>
