<?php
/**
 * Displays the post entry gallery post format.
 *
 * @author 	PressLayouts
 * @package /template-parts/single-post/thumbnail
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! pls_get_option( 'single-post-thumbnail', 1 ) ) return;

$thumbnail_size		= apply_filters( 'pls_single_post_image_size', ( pls_get_option('single-post-layout', 'right-sidebar' ) == 'full-width' ? 'full' : 'large' ) );
$gallery_style 	 	= apply_filters( 'pls_single_post_gallery_style', pls_get_option('single-post-gallery-style', 'slider' ) );
$post_thumbnail_id 	= get_post_thumbnail_id( get_the_ID() );
$attachment_ids		= get_post_meta( get_the_ID(), PLS_PREFIX.'post_format_gallery' );
$carousel_classes	= ( ! empty ($attachment_ids ) && pls_get_option( 'single-post-gallery-style', 'slider' ) == 'slider' ? array('pls-slider', 'swiper') : array( 'row', 'gallery-grid' ) );
$wrapper_classes	= apply_filters( 'pls_single_post_image_classes', array_merge( array(
	'pls-post-image',
	( has_post_thumbnail() ? 'with-images' : 'without-images' ),
), $carousel_classes) );
$slider_data	= array(
	'slider_autoplay'   		=> 'false',
	'slider_loop'   			=> 'yes',
	'slider_autoHeight'			=> false,
	'slider_navigation' 		=> 'yes',
	'slider_dots'     			=> 'yes',
	'slides_to_show'			=> 1,			
	'slides_to_show_tablet'		=> 1, 
	'slides_to_show_mobile'		=> 1,
	'slides_to_scroll'			=> 1,
	'slides_to_scroll_tablet' 	=> 1,
	'slides_to_scroll_mobile' 	=> 1,
);
$html				= '';
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	
	<?php 
	if( ! empty ( $attachment_ids ) ){
		if( $gallery_style  == 'slider' ){
			$html .= '<div class="swiper-wrapper grid-col-1" data-slider_options="'.esc_attr(pls_slider_attributes( $slider_data) ).'">';
		}
		foreach ( $attachment_ids as $attachment_id ) {
			
			$html	.= pls_get_gallery_image_html( $attachment_id, $thumbnail_size, $gallery_style );
			
		}
		if($gallery_style  == 'slider'){
			$html .= '</div>';
		}
	}elseif( has_post_thumbnail() ){
		$html  = pls_get_gallery_image_html( $post_thumbnail_id, $thumbnail_size );
	}
	
	echo apply_filters( 'pls_single_post_image_html', $html );
	?>
</div>