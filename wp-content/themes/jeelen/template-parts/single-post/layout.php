<?php
/**
 * Template part for displaying posts
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

$classes[] = 'single-post-page';
$classes[] = ( pls_get_option( 'post-meta', 1 ) ) ? pls_get_option( 'post-meta-separator', 'meta-separator-hyphen' ) : '';
$classes[] = ( pls_get_option( 'post-meta', 1 ) && pls_get_option( 'post-meta-icon', 0 ) ) ? 'post-meta-icon' : 'post-meta-label';
$classes[] = ( pls_get_option( 'single-post-thumbnail', 1 ) && pls_has_post_thumbnail() ) ? 'has-post-thumbnail' : 'no-post-thumbnail';
$classes[] = ( is_sticky() ) ? 'sticky' : '';
?>

<?php do_action( 'pls_before_single_post_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php
	/**
	 * pls_single_post_entry_top hook.
	 *
	 * @hooked pls_post_wrapper - 10	 
	 */
	do_action( 'pls_single_post_entry_top' );
	?>
	
	<div class="entry-thumbnail-wrapper">
		<?php 
		/**
		 * pls_single_post_thumbnail hook.
		 *
		 * @hooked pls_template_single_post_thumbnail - 10
		 * @hooked pls_template_single_post_highlight - 20
		 */
		do_action( 'pls_single_post_thumbnail' );
		?>
	</div>
	
	<div class="entry-content-wrapper">
		<?php	
		/**
		 * pls_single_post_content hook.
		 *
		 * @hooked pls_single_post_header - 10
		 * @hooked pls_single_post_content - 20
		 */
		do_action( 'pls_single_post_content' );
		?>
	</div>
	
	<?php	
	/**
	 * pls_single_post_entry_bottom hook.
	 *
	 * @hooked pls_post_wrapper_end - 10
	 */
	do_action( 'pls_single_post_entry_bottom' );
	?>
		
</article>

<?php
/**
 * pls_after_single_post_entry hook.
 * 
 * @hooked pls_template_single_post_author_bios - 10
 * @hooked pls_template_single_social_share - 20
 * @hooked pls_template_single_post_navigation - 30
 * @hooked pls_template_single_related - 40
 * @hooked pls_template_single_post_comments - 50
 */
do_action( 'pls_after_single_post_entry' ); 