<?php
/**
 * Displays the post entry quote.
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
$quote_meta = get_post_meta( get_the_ID());

if(! empty( $quote_meta[$prefix.'post_format_quote'] ) ){?>
	<div class="entry-quote">
		<?php 
		if(isset($quote_meta[$prefix.'post_format_quote'][0])){
			echo esc_html($quote_meta[$prefix.'post_format_quote'][0]); 
		}
		$author_url = isset($quote_meta[$prefix.'post_format_quote_author_url'][0]) ? $quote_meta[$prefix.'post_format_quote_author_url'][0] : '';
		$quote_author = isset($quote_meta[$prefix.'post_format_quote_author'][0]) ? $quote_meta[$prefix.'post_format_quote_author'][0] : ''; ?>
		<span class="quote-author"> 
			<a href="<?php echo esc_url($author_url); ?>" target="_blank"><?php echo esc_html($quote_author); ?></a>
		</span>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail('large');?>
		</div>
	<?php }
}