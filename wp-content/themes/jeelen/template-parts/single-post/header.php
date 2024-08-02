<?php
/**
 * Displays the post entry header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post
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
	 * Hook: pls_single_post_header.
	 *
	 * @hooked pls_template_single_post_fancy_date - 10
	 * @hooked pls_template_single_post_title - 20
	 * @hooked pls_template_single_post_meta - 30
	 */
	do_action( 'pls_single_post_header' );
	?>
	
</header><!-- .entry-header -->