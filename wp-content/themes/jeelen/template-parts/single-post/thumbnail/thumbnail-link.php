<?php
/**
 * Displays the post entry link post format.
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post/thumbnail
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prefix = PLS_PREFIX;
$quote_meta=get_post_meta( get_the_ID());

if(! empty( $quote_meta[$prefix.'post_format_link_text'] ) ){?>
	<div class="entry-link">
		<a href="<?php echo esc_url($quote_meta[$prefix.'post_format_link_url'][0]); ?>" target="_blank"><?php echo esc_html($quote_meta[$prefix.'post_format_link_text'][0]); ?></a>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail('large');?>
		</div>
	<?php }
}