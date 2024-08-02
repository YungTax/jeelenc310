<?php
/**
 * Displays the post entry image / gallery / audio / video etc. As per the post format.
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

if ( ! pls_get_option( 'single-post-thumbnail', 1 ) ) {
	return;
}

if( has_post_thumbnail() ){ ?>
	<div class="post-thumbnail">
		<?php echo pls_get_post_thumbnail('full'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
<?php }