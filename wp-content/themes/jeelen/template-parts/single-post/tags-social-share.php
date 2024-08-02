<?php
/**
 * Template part for displaying posts social share
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$posttags = get_the_tags();
if( ( $is_tag_enable && $posttags ) || ( function_exists( 'pls_social_share' ) && $is_share_enable ) ) { ?>
	<div class="tag-social-share">
		<?php if( $is_tag_enable && $posttags ){?>
			<div class="single-tags">
				<span class="tags-title"><?php esc_html_e( 'Tags:', 'pls-theme' ); ?></span>
				<?php echo get_the_tag_list(' ');?>
			</div>
		<?php }
		
		if( $is_share_enable && function_exists( 'pls_social_share' )  ){
			pls_social_share(
				array(
					'type' 	=> 'share', 
					'style' => $social_icons_style, 
					'size' 	=> $social_icons_size
				)
			);
		} ?>
	</div>
<?php }