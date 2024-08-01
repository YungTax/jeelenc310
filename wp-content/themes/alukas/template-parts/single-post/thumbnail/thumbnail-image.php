<?php
/**
 * Displays the post entry image post format.
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post/thumbnail
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !pls_get_option( 'single-post-thumbnail', 1 ) ) return;

// Get post image
$image = pls_get_post_image('large');

if(! empty( $image ) ){?>
	<div class="post-thumbnail">
		<?php echo wp_kses_post($image);?>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail('large');?>
		</div>
	<?php }
}