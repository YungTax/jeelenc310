<?php
/**
 * Displays the post entry image / gallery / audio / video etc. As per the post format.
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

// Get post video
$video = pls_get_post_video();

if(! empty( $video ) ){?>
	<div class="entry-video">
		<?php echo apply_filters( 'pls_post_video', $video ); // WPCS: XSS OK. ?>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail('large');?>
		</div>
	<?php }
}