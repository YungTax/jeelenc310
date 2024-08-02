<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

	do_action( 'pls_before_page_loop' );
	
	while ( have_posts() ) : the_post();			
			
		get_template_part( 'template-parts/page/layout', 'page' );

	endwhile; // End of the loop. 
	
	/**
	 * Hook: pls_after_loop_page.
	 *
	 */
	do_action( 'pls_after_page_loop' );
	
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
