<?php
/**
 * The Header of theme
 *
 * @package pls
 */ 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php do_action( 'pls_head_bottom' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action( 'pls_body_top' ); ?>
	
	<div id="page" class="pls-site-wrapper">
		
		<?php
		/**
		 * Hook: pls_header.
		 *
		 * @hooked pls_template_header- 10
		 */
		do_action( 'pls_header' );
		?>		
		
		<div id="main-content" class="pls-site-content">
		
			<?php
			/**
			 * Hook: pls_page_title.
			 *
			 * @hooked pls_template_page_title - 10
			 */
			do_action( 'pls_page_title' );
			?>	
		
			<?php do_action( 'pls_site_content_top' ); ?>
			
			<div class="container">
				<?php do_action( 'pls_after_container' ); ?>
				<div class="row <?php pls_sidebar_reverse(); ?>">