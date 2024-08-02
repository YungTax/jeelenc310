<?php
/**
 * Template part for displaying footer subscribe
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

<div class="footer-subscribe <?php echo esc_attr( $class ); ?>">
	<div class="container">	
		<div class="row subscribe-wrap">
			<div class="col-12 col-md-6">
				<?php
				if( ! empty( $title ) ){ ?>
					<h3> <?php echo esc_html( $title );?></h3>	
				<?php }
				if( ! empty( $subtitle ) ){ ?>
					<p> <?php echo esc_html( $subtitle );?></p>	
				<?php } ?>
			</div>
			<?php if( function_exists( 'mc4wp_show_form' ) ){ ?>
				<div class="col-12 col-md-6">						
					<?php mc4wp_show_form(); ?>
				</div>
			<?php }?>
		</div>
	</div>
</div><!-- .footer-subscribe -->