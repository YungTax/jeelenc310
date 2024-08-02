<?php
/**
 * Template part for displaying posts content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! pls_get_loop_prop( 'show-blog-post-content' ) ) {
			return;
}?>

<div class="entry-content">
	<?php pls_the_content(); ?>	
</div>