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

if ( post_password_required() || is_attachment() || ! pls_get_option( 'single-post-thumbnail', 1 ) ) {
	return;
}
$post_format = get_post_format(); 
switch ( $post_format ) {
	case 'image':
		$output = pls_get_image_from_post();
		break;

	case 'gallery':
		$output = pls_get_gallery_from_post();
		break;
		
	case 'video':
		$output = pls_get_video_from_post();
		break;

	case 'audio':
		$output .= pls_get_audios_from_post();
		break;
		
	case 'quote':
		$output .= pls_get_quote_from_post();
		break;
		
	case 'link':
		$output .= pls_get_link_from_post();
		break;
		
	default:
		if( has_post_thumbnail() ){?>
			<div class="post-thumbnail">
				<?php echo pls_get_post_thumbnail('full'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
			</div>
		<?php }
		break;
}