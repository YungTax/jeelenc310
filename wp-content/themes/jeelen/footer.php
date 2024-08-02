<?php
/**
 * The template for displaying the footer
 *
 * @package pls
 */
?>
				</div><!-- .row -->		
			</div><!-- .container -->
			
			<?php do_action( 'pls_site_content_botton' ); ?>
			
		</div><!-- .pls-site-content -->
		
		<?php
		/**
		 * Hook: pls_footer.
		 *
		 * @hooked pls_template_footer- 10
		 */
		do_action( 'pls_footer' );
		?>
		
	</div><!-- .pls-site-wrapper -->
	
	<?php do_action( 'pls_body_bottom' ); ?>
	<?php wp_footer(); ?>
	</body>
</html>