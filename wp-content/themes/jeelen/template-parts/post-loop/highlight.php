<?php
/**
 * Displays the post entry highlight
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ( pls_get_loop_prop( 'sticky-post-icon' ) || pls_get_loop_prop( 'post-format-icon' ) ) && ( is_sticky() || !empty( get_post_format() ) ) ){ ?>
	<div class="post-highlight">		
	
		<?php do_action( 'pls_loop_post_highlight_top' ); ?>
		
		<?php if( pls_get_loop_prop( 'sticky-post-icon' ) && is_sticky() ): ?>
		
			<span class="post-sticky-icon"></span>
			
		<?php endif;?>
		
		<?php if( pls_get_loop_prop( 'post-format-icon' ) ) : ?>
			
			<span class="post-format"></span>
			
		<?php endif;?>
		
		<?php do_action( 'pls_loop_post_highlight_bottom' ); ?>
	</div>
<?php }