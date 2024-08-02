<?php
/**
 * Template part for displaying welcome message of topbar
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
$welcome_message = pls_get_option( 'header-welcome-message','Summer Sale 15% off! Shop Now!' );
if( !empty( trim( $welcome_message ) ) ) { ?>	
	<span class="pls-welcome-message">
		<?php echo do_shortcode( $welcome_message );?>
	</span>
<?php } ?>
