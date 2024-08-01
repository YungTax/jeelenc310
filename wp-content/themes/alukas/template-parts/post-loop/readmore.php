<?php
/**
 * Displays the post entry readmore link
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! pls_get_loop_prop( 'read-more-button' ) || ( pls_get_loop_prop( 'blog-post-content' ) == 'full-content' && pls_get_loop_prop( 'name' ) != 'related-posts' ) ) return;
?>

<p class="read-more-btn">
	<a href="<?php echo esc_url( get_permalink( get_the_ID() ) );?>" class="more-link"><?php echo esc_html( pls_get_loop_prop( 'post-readmore-text' ) );?> </a>
</p>