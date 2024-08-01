<?php
/**
 * Template part for displaying posts content
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
?>
<div class="entry-content">		
	
	<?php 	
	the_content(); 
	
	wp_link_pages(
		array(
			'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'pls-theme' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		)
	);	
	?>	
</div><!-- .entry-content -->