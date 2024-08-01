<?php
/**
 * Template part for displaying footer
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

<footer id="footer" class="pls-site-footer">	
	
	<?php do_action( 'pls_footer_top' ); ?>
	
	<?php if( $footer_style == 'predefined' ) { ?>
		<div class="pls-footer-main <?php echo esc_attr( $footer_classes ); ?>">
			<div class="container">
				<?php if( ! empty( $footer_layout_data ) ){ ?>
					<div class="row">
						<?php
						$collapse_class = pls_get_option( 'footer-widget-collapse', 0 ) ? ' footer-widget-collapse' : '';
						foreach($footer_layout_data['class'] as $key => $classes){
							$count = $key + 1;
							?>
							<div class="footer-widget<?php echo esc_attr( $collapse_class ); ?> <?php echo esc_attr( $classes ); ?>">
								<?php dynamic_sidebar( 'pls-footer-widget-' . $count ); ?>
							</div>
							<?php
						} ?>
					</div>
				<?php } ?>
			</div><!-- .container -->	
		</div><!-- .pls-footer-main -->
	<?php }elseif( $footer_style == 'custom-block' ){		
		echo pls_block_get_content( $footer_block_id );
	}?>
	
	<?php
	/**
	 * Hook: pls_footer_bottom.
	 *
	 * @hooked pls_template_footer_copyright- 10
	 */
	do_action( 'pls_footer_bottom' );
	?>		
	
</footer><!-- .pls-site-footer -->