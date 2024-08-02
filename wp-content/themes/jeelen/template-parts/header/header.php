<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/header
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$args['header_top'] = $header_top;
?>

<header id="header" class="pls-site-header <?php echo esc_attr( $class );?>">
	
	<?php do_action( 'pls_header_top' );?>
	
	<?php pls_get_template( 'template-parts/header/'.$header_style, $args );?>
	
	<?php do_action( 'pls_header_bottom' );?>
	
</header><!-- .pls-site-header -->