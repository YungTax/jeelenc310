<?php
/**
 * Template part for displaying page title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/page-title
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="entry-header">
	
	<h1 class="title">
		<?php echo pls_get_page_title(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</h1>
	
	<?php $page_subtitle = pls_get_post_meta( 'page_subtitle' );
	if( !empty( $page_subtitle ) ){ ?>
		<div class="header-subtitle">
			<?php echo esc_html( $page_subtitle ); ?>
		</div>
	<?php } ?>
	
</div>