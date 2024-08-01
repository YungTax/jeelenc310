<?php
/**
 * Template part for displaying posts layout
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$blog_post_style	= pls_get_loop_prop( 'blog-post-style' );	
if( pls_get_loop_prop( 'name' ) == 'related-posts' ) {
	$classes[] 	= 'related-post';
	$classes[] 	= 'swiper-slide';
}else{
	$classes[]  = 'blog-post-loop';
}
$classes[] = ( ! pls_get_loop_prop( 'blog-post-thumbnail' ) ) ? 'no-post-thumbnail' : '';
if( pls_get_loop_prop( 'name' ) == 'posts-loop-shortcode' ){
	if( $blog_post_style == 'blog-grid' ){
		$classes[] = 'col-lg-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns' ) );
		$classes[] = 'col-md-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns-tablet' ) );
		$classes[] = 'col-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns-mobile' ) );
	}				
}elseif( $blog_post_style == 'blog-grid' && ! is_single() ){
	if( pls_get_loop_prop( 'name' ) != 'posts-slider-shortcode' ){
		
		$classes[] = 'col-lg-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns' ) );
		$classes[] = 'col-md-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns-tablet' ) );
		$classes[] = 'col-' .pls_get_rs_grid_columns( pls_get_loop_prop( 'blog-grid-columns-mobile' ) );
	}					
}
if( pls_get_loop_prop( 'name' ) == 'posts-slider-shortcode' ){
	$classes[] = 'swiper-slide';
}
$classes[] = ( pls_get_loop_prop( 'post-meta' ) ) ? pls_get_option( 'post-meta-separator', 'meta-separator-hyphen' ) : '';
$classes[] = ( pls_get_loop_prop( 'post-meta' ) && pls_get_option( 'post-meta-icon', 0 ) ) ? 'post-meta-icon' : 'post-meta-label';
?>

<?php do_action( 'pls_before_loop_post_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php
	/**
	 * pls_loop_post_entry_top hook.
	 *
	 * @hooked pls_post_wrapper - 10
	 */
	do_action( 'pls_loop_post_entry_top' );
	?>
	
	<div class="entry-thumbnail-wrapper">
		<?php 
		/**
		 * pls_loop_post_thumbnail hook.
		 *
		 * @hooked pls_template_loop_post_highlight - 10
		 * @hooked pls_template_loop_post_thumbnail - 20
		 */
		do_action( 'pls_loop_post_thumbnail' );
		?>
	</div>
	
	<div class="entry-content-wrapper">
		<?php	
		/**
		 * pls_loop_post_content hook.
		 *
		 * @hooked pls_loop_post_header 	- 10
		 * @hooked pls_loop_post_content 	- 20
		 * @hooked pls_loop_post_footer 	- 30
		 */
		do_action( 'pls_loop_post_content' );
		?>
	</div>
	
	<?php	
	/**
	 * pls_loop_post_entry_bottom hook.
	 *
	 * @hooked pls_post_wrapper_end - 10
	 */
	do_action( 'pls_loop_post_entry_bottom' );
	?>
		
</article>

<?php
do_action( 'pls_after_loop_post_entry' ); 