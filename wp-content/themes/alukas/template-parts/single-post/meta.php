<?php
/**
 * Displays the post entry highlight
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

$meta_values = pls_get_loop_prop( 'specific-post-meta' );

if( ! pls_get_loop_prop( 'post-meta' ) || empty( $meta_values ) ) {
	return;
}
?>
<div class="entry-meta">

	<?php do_action('pls_loop_post_meta_top'); ?>		
	
	<?php foreach ( $meta_values as $meta_value ) :

		switch ( $meta_value ) {
			case 'post-author': ?>	
				<span class="author-link vcard">
					<?php echo the_author_posts_link(); ?>
				</span> <?php					
				break;
			case 'post-date': 					
				$format = apply_filters( 'pls_post_date_format', '' );?>					
				<span class="posted-date">
					<a href="<?php echo esc_url( get_permalink() );?> "><?php echo get_the_date( $format ); ?></a>
				</span>	<?php					
				break;
			case 'post-comments':				
				if( ! post_password_required() && ( comments_open() || get_comments_number() ) ){?>
					<span class="comments-count">
						<?php 
						$comment_tag = '%s<span class="post-meta-label"> %s</span>';			
						comments_popup_link( 
							sprintf( $comment_tag, '0', esc_html__( 'Comments', 'pls-theme' ) ),
							sprintf( $comment_tag, '1', esc_html__( 'Comment', 'pls-theme' ) ),
							sprintf( $comment_tag, '%', esc_html__( 'Comments', 'pls-theme' ) )
						);?>			
					</span><?php 
				}
				break;
			case 'post-rtime':?>
				<div class="post-read-time">
					<?php $reading_time = pls_get_post_reading_time();?>						
					<span class="post-meta-label">
						<?php echo sprintf( _n( '%s Minute read', '%s Minute read', $reading_time, 'pls-theme' ), $reading_time );?>
					</span>
				</div>
				<?php 
				break;
			case 'post-views':
				pls_post_views();
				break;								
			case 'post-edit':
				edit_post_link( sprintf(esc_html__( 'Edit ', 'pls-theme' ) ), '<span class="edit-link">', '</span>');
				break;
			default:				
		}
	endforeach; ?>		
	
	<?php do_action('pls_loop_post_meta_bottom');?>		
	
</div>