<?php
/**
 * Template part for displaying customer support
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
}?>			

<?php if( ! empty( pls_get_option( 'header-phone-number', '(+123) 4567 890' ) )  || ! empty( pls_get_option( 'header-email','support@domain.com' ) ) ){ ?>
	<div class="pls-customer-support">
		<div class="pls-customer-support-wrap">
			<?php if( ! empty( pls_get_option( 'header-phone-number', '(+123) 4567 890' ) ) ){ ?>
				<span> <?php esc_html_e( '24/7 Support', 'pls-theme' ); ?> </span>
				<span><b><?php echo esc_html( pls_get_option( 'header-phone-number', '(+123) 4567 890' ) );?></b></span>
			<?php } ?>
		</div>
	</div>
<?php } ?>
