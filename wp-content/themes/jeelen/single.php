<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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


do_action( 'pls_before_single_post_loop' ); 
		
/* Start the Loop */
while ( have_posts() ) : the_post();
		
	// Include the post content template.
	get_template_part( 'template-parts/single-post/layout', get_post_format() );	

endwhile; // End of the loop.		
		
do_action( 'pls_after_single_post_loop' ); 

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