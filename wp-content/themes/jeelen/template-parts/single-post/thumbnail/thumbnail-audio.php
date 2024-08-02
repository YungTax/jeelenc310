<?php
/**
 * Displays the post entry audio post format.
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post/thumbnail
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! pls_get_option( 'single-post-thumbnail', 1 ) ) return;

// Get post audio
$audio = pls_get_post_audio();

if(! empty( $audio ) ){?>
	<div class="post-thumbnail">
		<?php echo apply_filters( 'pls_post_audio', $audio ); // WPCS: XSS OK. ?>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php echo pls_get_post_thumbnail('large'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	<?php }
}