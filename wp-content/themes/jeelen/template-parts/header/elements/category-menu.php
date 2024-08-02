<?php
/**
 * Template part for displaying categories menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! pls_get_option( 'categories-menu', 1 ) ) return;

if ( has_nav_menu( 'categories-menu' ) ) { 	
	$class 			= ( pls_is_open_categories_menu() ) ? ' opened-categories' : '';
	$hover_style 	= pls_get_option( 'menu-hover-style', 'line' ); ?>
	
	<div class="pls-categories-menu-wrapper<?php echo esc_attr( $class );?>">
		<div class="pls-categories-menu-title">
			<span class="title"><?php echo esc_html( pls_get_option( 'categories-menu-title', 'Browse Categories' ) );?></span>
			<span class="arrow-down-up"></span>
		</div>
		<?php wp_nav_menu( 
			array(
				'theme_location' 	=> 'categories-menu',
				'container_class'   => 'categories-menu pls-navigation pls-menu-hover-'.$hover_style,
				'walker' 			=> new PLS_Mega_Menu_Walker()
			)
		);?>
	</div>	
<?php } ?>