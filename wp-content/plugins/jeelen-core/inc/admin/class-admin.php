<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PLS_CORE_ADMIN' ) )
{
	class PLS_CORE_ADMIN {
		
		function __construct() {
			// Action to add metabox
			add_action( 'add_meta_boxes', array( $this, 'size_chart_metabox' ) );
			add_action( 'save_post', array( $this, 'size_chart_content_meta_save' ) );
			add_filter( 'upload_mimes', array( $this, 'support_mimes' ) );
		}
		
		/**
		 * Support to font mime
		 * @since 1.0
		 */
		function support_mimes( $mimes ) {		
			// Allow svg
			$mimes['svg'] = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';			
			// Allow font
			$mimes['woff']	= 'application/x-font-woff';
			$mimes['woff2'] = 'application/x-font-woff2';
			$mimes['ttf']	= 'application/x-font-ttf';
			$mimes['otf']	= 'application/x-font-otf';
			$mimes['eot']	= 'application/vnd.ms-fontobject';
			return $mimes;
		}
	
		/**
		 * Size Chart Metabox
		 * @since 1.0.0
		 */
		 
		public function size_chart_metabox(){
			add_meta_box( 'pls-size-chart', esc_html__( 'Size Chart Table', 'pls-core' ), array( $this, 'size_chart_content' ), 'pls_size_chart', 'normal', 'high' );
		}
		
		/**
		 * Size Chart Metabox HTML
		 * 
		 * @since 1.0.0

		 */
		public function size_chart_content(){
			include_once( PLS_CORE_DIR .'/inc/admin/size-chart-metabox.php');
		}
		
		/**
		 * Save the meta when the chart post is saved.
		 *
		 * @param int $post_id The ID of the post being saved.
		 */
		public function size_chart_content_meta_save( $post_id ) {
			// Check if our nonce is set.
			if ( ! isset( $_POST['pls_size_chart'] ) )
				return $post_id;

			$nonce = $_POST['pls_size_chart'];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'pls_size_chart' ) )
				return $post_id;

			// If this is an autosave, our form has not been submitted,
			// so we don't want to do anything.
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;

			// Check the user's permissions.
			if ('pls_size_chart' == $_POST['post_type']) {

				if (!current_user_can('edit_page', $post_id))
					return $post_id;
			} else {

				if (!current_user_can('edit_post', $post_id))
					return $post_id;
			}
			
			$prefix = PLS_PREFIX; // Metabox prefix
			
			// Sanitize the user input.
			$chart_table 		= isset($_POST[$prefix.'size_chart_data']) ? sanitize_text_field($_POST[$prefix.'size_chart_data']) : '';
			$diable_chart_data 	= isset($_POST[$prefix.'diable_chart_data']) ? sanitize_text_field($_POST[$prefix.'diable_chart_data']) : 0;
			/* save the data  */
			update_post_meta($post_id, $prefix.'size_chart_data', $chart_table);
			update_post_meta($post_id, $prefix.'diable_chart_data', $diable_chart_data);
		}
	
	}
	$obj_pls_core_admin = new PLS_CORE_ADMIN();	
}