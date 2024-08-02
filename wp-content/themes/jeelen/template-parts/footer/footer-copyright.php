<?php
/**
 * Template part for displaying footer copyright
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/footer
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="pls-footer-copyright copyright-<?php echo esc_attr( pls_get_option( 'copyright-layout', 'centered' ) );?>">
	<div class="container">	
		<div class="row pls-copyright-wrap">
			<?php if( pls_get_option( 'show-payments-logo', 0 ) ){ ?>
				<div class="text-left col-12 col-md-6">						
					<?php $payments_url = pls_get_option( 'payments-logo', array( 'url' => PLS_IMAGES.'/payemnt-gateway.png') );?>
					<img src="<?php echo esc_url( $payments_url['url'] );?>" alt="<?php echo esc_attr__( 'Payment logo', 'pls-theme' );?>">
				</div>
			<?php }?>
			<div class="text-right reset-mb-10 col-12 col-md-6">
				<p>
					<?php
					$copyright_text = pls_get_option( 'copyright-text',
						wp_kses( sprintf( __( PLS_THEME_NAME.' &copy; {current_year} by <a href="%s" target="_blank">PressLayouts</a> All Rights Reserved.', 'pls-theme' ), esc_url( 'https://presslayouts.com' ) ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							) 
						)
					);
					$current_year 	= date("Y"); 
					$copyright_text = str_replace( '{current_year}', $current_year, $copyright_text );
					echo wp_kses_post( $copyright_text ); ?>
				</p>
			</div>
		</div>
	</div>
</div><!-- .pls-footer-copyright -->