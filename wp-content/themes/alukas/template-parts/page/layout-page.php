<?php
/**
 * Template part for displaying page layout
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0
 */

do_action( 'pls_before_page_entry' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php	
	/**
	 * pls_page_content hook.
	 *		 
	 * @hooked pls_template_page_content - 10
	 */
	do_action( 'pls_page_content' );
	?>	
</article><!-- #post-## -->

<?php
/**
 * pls_after_page_entry hook.
 * 
 * @hooked pls_template_page_comments - 10
 */
do_action( 'pls_after_page_entry' ); 
