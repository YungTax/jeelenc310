<?php
/**
 * Displays the post entry footer
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="entry-footer">
	<?php 
	/**
	 * pls_loop_post_footer hook.
	 *
	 * @hooked pls_read_more_link - 10
	 */
	do_action( 'pls_loop_post_footer' );
	?>
</div>