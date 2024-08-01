<?php
/**
 * Post Loop Start
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( pls_get_loop_prop( 'name' ) == 'pls-slider' || pls_get_loop_prop( 'name' ) == 'posts-slider-shortcode' || ( pls_get_loop_prop('name') == 'related-posts' ) ) { ?>
	<div id="<?php echo esc_attr( pls_get_loop_prop( 'unique_id' ) );?>" class="pls-slider swiper row">
		<div class="<?php pls_blog_wrapper_classes();?>" <?php if(!empty(pls_get_loop_prop( 'slider_options' )) ){ echo 'data-slider_options="'.esc_attr( pls_get_loop_prop( 'slider_options' ) ).'"';  } ?>>
<?php } else { ?>
<div class="<?php pls_blog_wrapper_classes();?>">
<?php }