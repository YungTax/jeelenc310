<?php
/*
Plugin Name: jeelen Core
Plugin URI: https://themeforest.net/user/presslayouts
Description: Elementor elements, Posts, widget and Data Importer for jeelen - Elementor WooCommerce Theme.
Version: 1.3.5
Author: PressLayouts
Author URI: https://presslayouts.com
Text Domain: pls-core
*/

// don't load directly
if ( !defined( 'ABSPATH' ) ){
    die('-1');
}

if ( 'jeelen' !== get_template() ) {
	return;
}

if ( ! class_exists( 'PLS_Core' ) ) :

	/** PLS Core */
	
	class PLS_Core {
		
		public function __construct() {
			
			$this->constants();
			$this->includes();
			add_action( 'plugins_loaded',  array( $this, 'pls_core_init_elementor' ) );
			
		}
		
		/**
		 * Define Constants
		 *
		 * @since   1.0
		 */
		public  function constants() {
			
			if( ! defined( 'PLS_CORE_DIR' ) ) {
				define( 'PLS_CORE_DIR', dirname( __FILE__ ) ); // Plugin dir
			}

			if( ! defined( 'PLS_CORE_URL' ) ) {
				define( 'PLS_CORE_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
			}
			
			if( ! defined( 'PLS_PREFIX' ) ) {
				define( 'PLS_PREFIX', '_pls_' );
			}
		}
		
		/**
		 * Load all core file and function files
		 *
		 * @since 1.0
		 */
		public function includes(){
			$this->load_textdomain();
			
			// Load Custom Post types
			require_once PLS_CORE_DIR .'/posts/posts-content.php';

			// Load Custom widget
			require PLS_CORE_DIR . '/widgets/init.php';
			
			if ( ! class_exists ( 'ReduxFramework' ) && file_exists ( PLS_CORE_DIR.'/inc/admin/redux-core/framework.php' ) ) {
				require_once ( PLS_CORE_DIR .'/inc/admin/redux-core/framework.php' );
			} 

			if ( ! class_exists ( 'RWMB_Loader' ) && file_exists ( PLS_CORE_DIR.'/inc/admin/meta-box/meta-box.php' ) ) {
				require_once ( PLS_CORE_DIR.'/inc/admin/meta-box/meta-box.php' );
				require_once PLS_CORE_DIR .'/inc/admin/custom-field-image-set.php';
			} 

			// Load Wordpress Importer plugin
			require_once PLS_CORE_DIR .'/inc/admin/class-import.php';
			require_once PLS_CORE_DIR .'/inc/admin/class-admin.php';
			require_once PLS_CORE_DIR .'/inc/admin/class-white-label.php';

			//Load functions
			require_once PLS_CORE_DIR .'/inc/functions.php';
		}
		
		/**
		 * Init elementor elements
		 */
		public function pls_core_init_elementor() {
			
			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, '2.0.0', '>=' ) ) {
				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, '5.4', '<' ) ) {
				return;
			}

			// Once we get here, We have passed all validation checks so we can safely include our plugin
			include_once( PLS_CORE_DIR . '/inc/elementor/elementor-functions.php' );
			include_once( PLS_CORE_DIR . '/inc/elementor/class-elementor.php' );
		}
		
		/**
		 * Load plugin text domain
		 */
		public function load_textdomain() {			
			load_plugin_textdomain( 'pls-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}	
	}
	
	new PLS_Core();

endif;