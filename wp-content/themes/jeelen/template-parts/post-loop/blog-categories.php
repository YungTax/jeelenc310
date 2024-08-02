<?php
/**
 * Template part for displaying blog categories
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/blog-categories
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<ul class="pls-blog-categories pls-underline">
	<?php foreach ( $categories as $key => $data ) {
		$class = 'cat-item-'.$key;
		if( $data['current_active'] ){
			$class .= ' has-current';
		}
		echo '<li class="'.esc_attr($class).'"><a href="' . esc_url( $data['link'] ) . '">' . esc_html( $data['name'] ) . '</a></li>';
	} ?>
</ul>