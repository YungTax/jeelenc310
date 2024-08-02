<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pls
 */

get_header(); ?>

<?php
/**
 * Hook: pls_before_main_content.
 *
 * @hooked pls_output_content_wrapper - 10 (outputs opening divs for the content area)
 */
do_action( 'pls_before_main_content' );

if ( have_posts() ) :

	do_action( 'pls_before_loop_post' );
	
	pls_post_loop_start();
	
	while ( have_posts() ) :
		the_post();	
		
		// Include the loop post content template.
		get_template_part( 'template-parts/post-loop/layout', get_post_format() );

	endwhile;
	
	pls_post_loop_end();
	
	/**
	 * Hook: pls_after_loop_post.
	 *
	 * @hooked pls_pagination - 10
	 */
	do_action( 'pls_after_loop_post' );

else :

	get_template_part( 'template-parts/post-loop/content', 'none' );

endif;

/**
 * Hook: pls_after_main_content.
 *
 * @hooked pls_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'pls_after_main_content' );

/**
 * Hook: pls_sidebar.
 *
 * @hooked pls_get_sidebar - 10
 */
do_action( 'pls_sidebar' );?>

<?php get_footer();
