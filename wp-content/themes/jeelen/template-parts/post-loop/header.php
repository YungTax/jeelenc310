<?php
/**
 * Displays the post entry header
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

<header class="entry-header">

	<?php
	/**
	 * Hook: pls_loop_post_header.
	 *
	 * @hooked pls_template_loop_post_fancy_date - 10
	 * @hooked pls_template_loop_post_title - 20
	 * @hooked pls_template_loop_post_meta - 30
	 */
	do_action( 'pls_loop_post_header' );
	?>
	
</header><!-- .entry-header -->