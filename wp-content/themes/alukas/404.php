<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pls
 */

get_header(); 

/**
 * Hook: pls_before_main_content.
 *
 * @hooked pls_output_content_wrapper - 10 (outputs opening divs for the content area)
 */
do_action( 'pls_before_main_content' );?>
		<?php 
			$block_id = pls_get_option( '404-page-content', ' ' );
			if( !empty( trim( $block_id ) ) ){
				echo pls_block_get_content($block_id);
			} else { ?>
		<div class="error-404 not-found">
			
				<h1>404<span><?php echo esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pls-theme' ); ?><span></h1>			
				<p><?php echo esc_html_e( 'Try using the button below to go to back previous page.', 'pls-theme' ); ?></p>
				<a class="button" href="<?php echo esc_url( get_home_url() );?>"><?php echo esc_html_e( 'Back To Homepage', 'pls-theme' );?></a>
		</div><!-- .error-404 -->
		
	</div>
			<?php } ?>

<?php 
/**
 * Hook: pls_after_main_content.
 *
 * @hooked pls_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'pls_after_main_content' );

get_footer();