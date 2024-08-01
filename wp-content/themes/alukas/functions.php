<?php
/**
 * PLS functions and definitions
 *
 * @package pls
 */

/*-----------------------------------------------------------------------*/
/* Define Constants.
/*-----------------------------------------------------------------------*/
define( 'PLS_DIR',	get_template_directory() );			// template directory
define( 'PLS_URI',	get_template_directory_uri() );		// template directory uri
update_option( 'alukas_token_key', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' );
update_option( 'alukas_is_activated', true );
update_option( 'alukas_plugin_file', get_template_directory().'/plugins/' );
update_option( 'envato_purchase_code_45256351', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' );
add_filter( 'pre_http_request', function( $pre, $args, $url ){
	if ( strpos( $url, 'https://www.presslayouts.com/api/envato/importdemo.php' ) !== false ) {
		return [
			'response' => [ 'code' => 200, 'message' => 'ОК' ],
			'body'     => json_encode( [ 'success' => 1 ] )
		];
	}
	return $pre;
}, 10, 3 );
//nullcave
class PLS_Theme_Class {	
	
	public function __construct() {
		$this->constants();
		$this->include_functions();
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ), 10 );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_style' ) );
			add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
		} else {		
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );		
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_scripts' ) );		
			add_action( 'wp_head', array( $this, 'google_theme_color' ), 2 );
			add_action( 'wp_head', array( $this, 'custom_head_js') );
			add_action( 'wp_footer', array( $this, 'enqueue_inline_style'), 10 );
			add_action( 'wp_footer', array( $this, 'print_css'), 15 );
			add_action( 'wp_footer', array( $this, 'custom_footer_js') );
			add_action( 'pre_get_posts', array( $this, 'search_posts_per_page' ) );		
			add_action( 'wp', array( $this, 'post_view_count'), 999 );		
			add_filter( 'excerpt_more', array( $this, 'excerpt_more') );	
			add_filter( 'the_content_more_link',  array( $this, 'read_more_tag' ) );
			add_filter( 'excerpt_length', array( $this, 'excerpt_length'), 999 );
			add_action( 'wp_footer', array( $this, 'owl_param' ) );			
			if( PLS_WOOCOMMERCE_ACTIVE ){
				add_filter( 'posts_search', array( $this, 'product_search_sku' ), 9 );
			}
		}				
	}
	
	/**
	 * Define Constants
	 *
	 * @since   1.0
	 */
	public  function constants() {

		// Theme version
		define( 'PLS_THEME_NAME', 'Alukas' );
		define( 'PLS_THEME_SLUG', 'alukas' );
		$theme = wp_get_theme( PLS_THEME_SLUG );
		define( 'PLS_VERSION', $theme->get( 'Version' ) );
		define( 'PLS_FRAMEWORK', PLS_DIR .'/inc/' );
		define( 'PLS_FRAMEWORK_URI', PLS_URI .'/inc/' );
		define( 'PLS_ADMIN_DIR_URI', PLS_FRAMEWORK_URI .'admin/' );
		define( 'PLS_SCRIPTS', PLS_URI .'/assets/js/' );
		define( 'PLS_STYLES', PLS_URI .'/assets/css/' );
		define( 'PLS_IMAGES', PLS_URI . '/assets/images/');
		define( 'PLS_ADMIN_IMAGES', PLS_ADMIN_DIR_URI . 'assets/images/' );
		
		// Check if plugins are active		
		if( ! defined( 'PLS_WOOCOMMERCE_ACTIVE' ) ) {
			define( 'PLS_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		}
		if( ! defined( 'PLS_DOKAN_ACTIVE' ) ) {
			define( 'PLS_DOKAN_ACTIVE', class_exists( 'WeDevs_Dokan' ) );
		}
		if( ! defined( 'PLS_WC_VENDORS_ACTIVE' ) ) {
			define( 'PLS_WC_VENDORS_ACTIVE', class_exists( 'WC_Vendors' ) );
		}
		
		// Othere		
		if( ! defined( 'PLS_API' ) ) {
			define('PLS_API', 'https://presslayouts.com/api/');
		}
		if( ! defined( 'PLS_PREFIX' ) ) {
			define('PLS_PREFIX', '_pls_');
		}		
	}
	
	/**
	 * Load all core theme function files
	 *
	 * @since 1.0
	 */
	public function include_functions(){
		
		require_once PLS_FRAMEWORK.'theme-layout.php';		
		require_once PLS_FRAMEWORK.'font-config.php';
		require_once PLS_FRAMEWORK.'core-functions.php';
		require_once PLS_FRAMEWORK.'theme-tags.php';
		require_once PLS_FRAMEWORK.'theme-functions.php';		
		require_once PLS_FRAMEWORK.'theme-hooks.php';
		require_once PLS_FRAMEWORK.'dynamic-css.php';
		require_once PLS_FRAMEWORK.'admin/admin-function.php';		

		if( PLS_WOOCOMMERCE_ACTIVE ) {
			require_once PLS_FRAMEWORK.'integrations/woocommerce/wc-core-functions.php';
			require_once PLS_FRAMEWORK.'integrations/woocommerce/wc-template-hooks.php';
			require_once PLS_FRAMEWORK.'integrations/woocommerce/wc-template-functions.php';
			require_once PLS_FRAMEWORK.'classes/class-swatches.php';
			require_once PLS_FRAMEWORK.'classes/class-woocommerce.php';
			require_once PLS_FRAMEWORK.'classes/class-bought-together.php';
			
			if( class_exists('WeDevs_Dokan') ){
				require_once PLS_FRAMEWORK.'integrations/dokan/dokan-core-functions.php';
			}
			
			if( class_exists('WCMp') ){
				require_once PLS_FRAMEWORK.'integrations/wcmp/wcmp-core-functions.php';
			}
			
			if( class_exists('WC_Vendors') ){
				require_once PLS_FRAMEWORK.'integrations/wc-vendor/wc-vendors-core-functions.php';
			}
			
			if( class_exists('WCFMmp') ){
				require_once PLS_FRAMEWORK.'integrations/wcfm/wcfm-core-functions.php';
			}
			
			if( function_exists( 'YITH_YWRAQ_Frontend' ) ){
				require_once PLS_FRAMEWORK.'integrations/yith-add-to-quote/yith-add-to-quote-core-functions.php';
			}
		}		
		
		require_once PLS_FRAMEWORK.'classes/class-metabox.php';
		require_once PLS_FRAMEWORK.'classes/class-walker-nav-menu.php';
		require_once PLS_FRAMEWORK.'classes/class-breadcrumb.php';
		require_once PLS_FRAMEWORK.'classes/class-ajax-search.php';
		require_once PLS_FRAMEWORK.'classes/sidebar-generator-class.php';
		require_once PLS_FRAMEWORK.'classes/class-cookie-notice.php';
		if ( is_admin() ) {
			require_once PLS_FRAMEWORK.'classes/class-tgm-plugin-activation.php';
		}
		require_once PLS_FRAMEWORK.'admin/theme_options.php';
		require_once PLS_FRAMEWORK.'admin/class-admin.php';
		require_once PLS_FRAMEWORK.'admin/class-dashboard.php';
		require_once PLS_FRAMEWORK.'admin/class-update-theme.php';
	}
	
	/**
	 * Theme Setup
	 *
	 * @since   1.0
	 */
	public function theme_setup() {
	
		load_theme_textdomain( 'pls-theme', get_template_directory() . '/languages' );	
		load_theme_textdomain( 'pls-theme', get_stylesheet_directory() . '/languages' );
		
		/* Theme support */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );	
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote', 'link' ) );
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );
		add_theme_support( 'wp-block-styles' );
				
		// Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );		
		
		// Disable Widget block editor.
		if( apply_filters( 'pls_disable_widgets_block_editor', true ) ) {
			remove_theme_support( 'block-templates' );
			remove_theme_support( 'widgets-block-editor' );
		}
		
		// Set the default content width.
		$GLOBALS['content_width'] = 1200;
		
		register_nav_menus( array(
			'primary' 					=> esc_html__( 'Primary Menu', 'pls-theme' ),
			'secondary'					=> esc_html__( 'Secondary Menu', 'pls-theme' ),
			'categories-menu' 			=> esc_html__( 'Categories(Vertical) Menu', 'pls-theme' ),
			'topbar-menu' 				=> esc_html__( 'Topbar Menu', 'pls-theme' ),
			'mobile-menu' 				=> esc_html__( 'Mobile Menu', 'pls-theme' ),
			'mobile-categories-menu' 	=> esc_html__( 'Mobile Categories Menu', 'pls-theme' ),
			'myaccount-menu' 			=> esc_html__( 'MyAccount/Profile Menu', 'pls-theme' ),
		) );
	}
	
	/*-----------------------------------------------------------------------*/
	/* Register custom fonts.
	/*-----------------------------------------------------------------------*/
	public function fonts_url() {
		$fonts_url = '';	
		
		if ( 'off' !== _x( 'on', 'Jost font: on or off', 'pls-theme' ) ) {
			$font_families[] = 'Jost:300,400,500,600,700,800,900';
		}

		if ( ! empty( $font_families ) ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );		
	}
	
	/**
	 * Register required plugins
	 *
	 * @since   1.0
	*/
	public function register_required_plugins(){
		$plugins = array(
			array(
				'name' 					=> PLS_THEME_NAME.' Core',
				'slug' 					=> PLS_THEME_SLUG.'-core',
				'source' 				=> $this->pls_get_tgm_plugin_path( PLS_THEME_SLUG.'-core.zip' ),
				'version'  				=> '1.3.5',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'Elementor Website Builder',
				'slug' 					=> 'elementor',
				'required' 				=> true,
			),		
			array(
				'name' 					=> 'Woocommerce',
				'slug' 					=> 'woocommerce',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'Revolution Slider',
				'slug' 					=> 'revslider',
				'source'             	=> $this->pls_get_tgm_plugin_path( 'revslider.zip' ),
				'version'  				=> '6.7.15',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'YITH WooCommerce Wishlist',
				'slug' 					=> 'yith-woocommerce-wishlist',
				'required' 				=> false,
			),
			array(
				'name' 					=> 'MailChimp for WordPress',
				'slug' 					=> 'mailchimp-for-wp',
				'required' 				=> false,
			),
			array(
				'name'      			=> 'Contact Form 7',
				'slug'     			 	=> 'contact-form-7',
				'required' 			 	=> false,
			),

		);		
		$config = array(
			'id'           => 'tgmpa',
			'menu'         => 'pls-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'is_automatic' => false,			
		);
		tgmpa( $plugins, $config );
	}
	
	public function pls_get_tgm_plugin_path( $plugin_name = '' ){
	
		$is_license_activated= ( get_option( PLS_THEME_SLUG.'_is_activated' ) && get_option( 'envato_purchase_code_45256351' ) ) ? true : false;
		
		// bail early if no plugin name provided
		if( empty( $plugin_name ) ) { return ''; }
		if( !$is_license_activated ) { return ''; }
		$plugin_url = get_option( PLS_THEME_SLUG.'_plugin_file' );
		return $plugin_url.$plugin_name;
	}
	
	/**
	 * Registers sidebars
	 *
	 * @since   1.0
	 */
	public function register_sidebars(){

		register_sidebar( array(
			'name'          => esc_html__( 'Blog Sidebar', 'pls-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Page Sidebar', 'pls-theme' ),
			'id'            => 'shop-page-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in shop page sidebar.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Filter Sidebar', 'pls-theme' ),
			'id'            => 'shop-filters-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your shop page.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Product Page Sidebar', 'pls-theme' ),
			'id'            => 'single-product-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in single product page sidebar.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 1', 'pls-theme' ),
			'id'            => 'pls-footer-widget-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 2', 'pls-theme' ),
			'id'            => 'pls-footer-widget-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 3', 'pls-theme' ),
			'id'            => 'pls-footer-widget-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 4', 'pls-theme' ),
			'id'            => 'pls-footer-widget-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 5', 'pls-theme' ),
			'id'            => 'pls-footer-widget-5',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pls-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	
	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0
	 */
	public function admin_style( $hook ) {
		//Admin css
		global $pagenow,$typenow;
		// sanitize_title('Autopart theme');
		wp_enqueue_style( 'wp-color-picker' );		
		wp_enqueue_style( 'pls-font', PLS_STYLES.'presslayouts-font.css', array(), '1.0' );
		$dashboard_pages = array( 'toplevel_page_pls-theme', 'pls_page_pls-system-status', 'pls_page_pls-theme-option', 'pls_page_pls-demo-import' );
		
		if ( strpos( $hook, 'pls-demo-import' ) !== false){
			wp_enqueue_style( 'magnific-popup', PLS_STYLES.'magnific-popup.css', array(), PLS_VERSION );
		}
		
		if ( 'customize.php' != $pagenow ) {
			wp_enqueue_style( 'pls-style', PLS_FRAMEWORK_URI.'admin/assets/css/admin.css', array(), PLS_VERSION );
		}
		
		if( $typenow == 'pls_size_chart' ){
			wp_register_style( 'pls-edittable', PLS_FRAMEWORK_URI.'admin/assets/css/jquery.edittable.css', null, time() );
			wp_enqueue_style( 'pls-edittable' );
		}		
	}
	
	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0
	 */
	public function admin_scripts( $hook ) {
		global $pagenow, $typenow;
		wp_enqueue_media(); 
		wp_enqueue_script( 'wp-color-picker' );
				
		if ( 'toplevel_page_pls-theme' == $hook ) {
			wp_enqueue_script( 'pls-activation-theme', PLS_FRAMEWORK_URI.'admin/assets/js/theme-activation.js' );
		}
		
		if ( strpos( $hook, 'pls-system-status' ) !== false ){
			wp_enqueue_script( 'pls-system-status', PLS_FRAMEWORK_URI.'admin/assets/js/system-status.js' );
		}
		
		if ( 'nav-menus.php' == $pagenow ) {
			wp_enqueue_style( 'pls-font', PLS_STYLES.'presslayouts-font.css', array(), '1.0' );
			wp_enqueue_script( 'pls-mega-menu', PLS_FRAMEWORK_URI.'admin/assets/js/mega-menu.js' );
		}
		
		if( $typenow == 'pls_size_chart' ){
			wp_register_script( 'pls-edittablejs', PLS_FRAMEWORK_URI.'admin/assets/js/jquery.edittable.js', array('jquery'), time(), true );
			wp_enqueue_script( 'pls-edittablejs' );
		}
		
		if ( strpos( $hook, 'pls-demo-import' ) !== false){
			wp_enqueue_script( 'magnific-popup', PLS_SCRIPTS.'jquery.magnific-popup.min.js', array(), PLS_VERSION );
		}
		
		wp_enqueue_script( 'pls-admin-js', PLS_FRAMEWORK_URI.'admin/assets/js/admin.js' );
		wp_localize_script( 'pls-admin-js', 'pls_admin_params', apply_filters('pls_admin_js_params', array(
			'ajaxurl'          		=> admin_url( 'admin-ajax.php' ),
			'nonce'            		=> wp_create_nonce( 'pls_nonce' ),
			'loading_text'      	=> esc_html__( 'Loading...', 'pls-theme' ),
			'bindmessage'      		=> esc_html__( 'Are you sure you want to leave?','pls-theme' ),
			'demo_success'      	=> esc_html__( 'Demo imported successfully.', 'pls-theme' ),
			'menu_icon_change_text'	=> esc_html__( 'Change Custom Icon', 'pls-theme' ),
			'menu_icon_upload_text'	=> esc_html__( 'Upload Custom Icon', 'pls-theme' ),
			'menu_delete_icon_msg'	=> esc_html__( 'Are you sure,You want to remove this icon?', 'pls-theme' ),
		)));
	}

	/**
	 * Disable Unused Scripts
	 */
	function dequeue_scripts() {
		
		// Disable font awesome style from plugins
		if ( pls_get_option( 'disable-fontawesome', 1 ) ) {
			wp_deregister_style( 'fontawesome' );
			wp_deregister_style( 'font-awesome' );
			wp_deregister_style( 'wplc-font-awesome' );
		}
		
		// YITH WCWL styles & scripts
		if ( defined( 'YITH_WCWL' ) && ! defined( 'YITH_WCWL_PREMIUM' ) ) {
			
			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-selectBox' );
			
			// checkout
			if ( function_exists( 'is_checkout' ) && is_checkout() ) {
				wp_dequeue_style( 'selectWoo' );
				wp_deregister_style( 'selectWoo' );
			}
		}
		
		if ( function_exists( 'yith_wcwl_is_wishlist_page' ) && !yith_wcwl_is_wishlist_page() ) {
			// YITH : main style was dequeued because of font-awesome
			wp_dequeue_style( 'yith-wcwl-main' );
			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		}
		
		// WooCommerce PrettyPhoto(deprecated), but YITH Wishlist use
		if ( class_exists( 'WooCommerce' ) && ! defined( 'YITH_WCWL_PREMIUM' ) ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );			
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'prettyPhoto' );
		}

		// Disable wp block library 
		if ( pls_get_option( 'disable-gutenberg', 0 ) ) {
			wp_deregister_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library' );
		}
		
		// Disable Default wc blocks styles
		if ( pls_get_option( 'disable-wc-blocks', 0 ) ) {
			wp_dequeue_style( 'wc-blocks-style' );
			wp_deregister_style( 'wc-blocks-style' );
			wp_dequeue_style( 'wc-blocks-vendors-style' );
			wp_deregister_style( 'wc-blocks-vendors-style' );
		}
		
		// REMOVE WP EMOJI
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles');
	}

	/**
	 * Load front-end css
	 *
	 * @since 1.0
	 */
	public function enqueue_styles() {
				
		// Load our main stylesheet.
		wp_enqueue_style( 'pls-style', PLS_URI.'/style.css' , array(), PLS_VERSION );
		
		// Load elementor css
		wp_enqueue_style( 'elementor-frontend' );

		$theme = ( is_rtl() ) ? PLS_STYLES.'theme-rtl' : PLS_STYLES.'theme';
		$woocommerce_style = ( is_rtl() ) ? PLS_STYLES.'woocommerce-rtl' : PLS_STYLES.'woocommerce' ;		
		
		if ( ! class_exists('ReduxFrameworkPlugin') ) {
			wp_enqueue_style( 'pls-fonts', $this->fonts_url(), array(), null );
		}
		wp_enqueue_style( 'presslayouts-font', PLS_STYLES.'presslayouts-font.css', array(), '1.0' );
		wp_enqueue_style( 'linearicons-free', PLS_STYLES.'linearicons.css', array(), '1.0.0' );
		wp_enqueue_style( 'pls-woocommerce', $woocommerce_style.'.css' , array(), '7.0.1' );
		wp_enqueue_style( 'swiper', PLS_STYLES.'swiper.min.css', array(), '5.3.6' );
		wp_enqueue_style( 'slick', PLS_STYLES.'slick.css', array(), '1.9.0' );
		wp_enqueue_style( 'magnific-popup', PLS_STYLES.'magnific-popup.css', array(), '1.1.0' );
		wp_enqueue_style( 'animate', PLS_STYLES.'animate.min.css', array(), '3.7.2' );	
				
		// Theme basic stylesheet.
		wp_enqueue_style( 'pls-base', $theme.'.css', array( 'pls-woocommerce' ), PLS_VERSION );
		
		//Dynamic CSS
		wp_add_inline_style( 'pls-base', pls_theme_style() );
		
		// load typekit fonts
		$enable_typekit_font 	= pls_get_option( 'typekit-font', 0 );
		$typekit_id 			= pls_get_option( 'typekit-kit-id', '' );

		if ( $enable_typekit_font && ! empty( $typekit_id ) ) {
			wp_enqueue_style( 'pls-typekit', pls_get_protocol().'//use.typekit.net/' . esc_attr ( $typekit_id ) . '.css', array(), PLS_VERSION );
		}
		
		wp_register_style( 'pls-custom-css', false );
	}
	
	/**
	 * Load front-end script
	 *
	 * @since 1.0
	 */
	public function enqueue_scripts() {
		
		// Load waypoints Js
		wp_enqueue_script( 'waypoints', PLS_SCRIPTS .'waypoints.min.js', array( 'jquery' ), '2.0.2', true );
		wp_enqueue_script( 'popper', PLS_SCRIPTS.'popper.min.js', array( 'jquery' ), '4.0.0', true );
		wp_enqueue_script( 'bootstrap', PLS_SCRIPTS.'bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
		wp_enqueue_script( 'swiper', PLS_SCRIPTS.'swiper.min.js', array( 'jquery' ), '5.3.6', true );
		wp_register_script( 'isinviewport', PLS_SCRIPTS.'isInViewport.min.js', array( 'jquery' ), '1.8.0', true );
		wp_enqueue_script( 'slick', PLS_SCRIPTS.'slick.min.js', array( 'jquery' ), '1.9.0', true );
		wp_register_script( 'isotope', PLS_SCRIPTS.'isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
		wp_register_script( 'cookie', PLS_SCRIPTS.'cookie.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'parallax', PLS_SCRIPTS.'jquery.parallax.js', array( 'jquery' ), '', true );
		wp_register_script( 'threesixty', PLS_SCRIPTS .'threesixty.min.js', array( 'jquery' ), '2.0.5', true );
		wp_enqueue_script ( 'magnific-popup', PLS_SCRIPTS.'jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'nanoscroller', PLS_SCRIPTS.'jquery.nanoscroller.min.js', array( 'jquery' ), '0.8.7', true );
		wp_register_script( 'countdown', PLS_SCRIPTS.'jquery.countdown.min.js', array( 'jquery' ), '2.2.0', true );
		wp_register_script( 'counterup', PLS_SCRIPTS.'jquery.counterup.min.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'sticky-kit', PLS_SCRIPTS.'sticky-kit.min.js', array( 'jquery' ), '1.10.0', true );
		if( pls_get_option( 'product-ajax-search', 1 ) ){
			wp_enqueue_script( 'pls-autocomplete', PLS_SCRIPTS.'jquery.autocomplete.min.js', array( 'jquery' ), '', true );
		}
		if( pls_get_option( 'lazy-load', 0 ) ){
			wp_enqueue_script( 'lazyload', PLS_SCRIPTS .'jquery.lazy.min.js', array( 'jquery' ), PLS_VERSION, true );
		}
		if( pls_get_option( 'widget-items-hide-max-limit', 0 ) ){
			wp_enqueue_script( 'hideMaxListItem', PLS_SCRIPTS.'hideMaxListItem-min.js', array( 'jquery' ), '1.36', true );
		}
		if( class_exists( 'WooCommerce' ) &&  pls_get_option( 'ajax-filter', 0 ) ){
			wp_enqueue_script( 'jquery-pjax', PLS_SCRIPTS.'jquery.pjax.js', array( 'jquery' ), '1.0', true );
		}	
		if( class_exists( 'WooCommerce' ) && pls_get_option( 'product-quickview-button', 1 ) ){
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
		if ( ! wp_script_is( 'wc-cart-fragments', 'enqueued' ) && wp_script_is( 'wc-cart-fragments', 'registered' ) ) {
			wp_enqueue_script( 'wc-cart-fragments' );
		}
		if( pls_get_option( 'sticky-sidebar', 1 ) && ( 'full-width' != pls_get_layout() ) ){
			wp_enqueue_script( 'sticky-kit' );
		}
		if ( function_exists('is_product') && is_product() && ( pls_get_option( 'sticky-product-image', 0 ) || pls_get_option( 'sticky-product-summary', 0 ) ) ){
			wp_enqueue_script( 'sticky-kit' );			
		}		
		
		$google_api_key = pls_get_option( 'google-map-api', '' );
		if( ! empty( $google_api_key ) ){
			wp_enqueue_script( 'pls-google-map-api', pls_get_protocol().'//maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.22&key=' . $google_api_key . '', array(), '', false );
		}		
		wp_enqueue_script( 'pls-script', PLS_SCRIPTS.'functions.js', array( 'jquery' ), PLS_VERSION, true );
		
		$is_rtl = is_rtl() ? true : false ;		
		$pls_settings = apply_filters( 'pls_localize_script_data', array(
			'rtl' 							=> $is_rtl,
			'ajax_url' 						=> admin_url( 'admin-ajax.php' ),
			'ajax_nonce' 					=> esc_js( wp_create_nonce( 'pls-ajax-nonce' ) ),
			'product_ajax_search'			=> pls_get_option( 'product-ajax-search', 1 ) ? true : false,	
			'sticky_header'					=> pls_get_option( 'header-sticky', 0 ) ? true : false,
			'sticky_header_class'			=> pls_get_option( 'header-sticky-part', 'main' ),
			'sticky_header_scroll_up'		=> pls_get_option( 'header-sticky-scroll-up', 0 ) ? true : false,	
			'sticky_header_tablet'			=> pls_get_option( 'header-sticky-tablet', 0 ) ? true : false,	
			'sticky_header_mobile'			=> pls_get_option( 'header-sticky-mobile', 0 ) ? true : false,
			'login_register_popup'			=> pls_get_option( 'login-register-popup', 1 ) ? true : false,
			'button_loader'					=> true,
			'header_minicart_popup'			=> pls_get_option( 'header-minicart-popup', 'slider' ),
			'promo_bar'						=> pls_get_option( 'promo-bar', 0 ) ? true : false,	
			'lazy_load'						=> pls_get_option( 'lazy-load', 0 ) ? true : false,	
			'cookie_path'					=> COOKIEPATH,
			'cookie_expire'					=> 3600 * 24 * 30,			
			'show_promobar_in_next_days'	=> 1,			
			'permalink'						=> ( get_option( 'permalink_structure' ) == '' ) ? 'plain' : '',			
			'newsletter_args'				=> apply_filters( 'pls_js_newsletter_args', array(
				'newsletter_popup'			=> pls_get_option( 'newsletter-popup', 0 ) ? true : false,
				'popup_display_on'		=> pls_get_option( 'newsletter-when-appear', 'page_load' ),
				'popup_delay'			=> pls_get_option( 'newsletter-delay', 5 ),
				'popup_x_scroll'		=> pls_get_option( 'newsletter-x-scroll', 30 ),
				'show_for_mobile'		=> pls_get_option( 'newsletter-show-mobile', 1 ),
				'show_in_next_days'		=> 1,
				'version'				=> pls_get_option( 'newsletter-version', 1 ),
			) ),
			'js_translate_text'				=> apply_filters( 'pls_js_text', array(
				'days_text'					=> esc_html__( 'Days', 'pls-theme' ),
				'hours_text'				=> esc_html__( 'Hours', 'pls-theme' ),
				'mins_text'					=> esc_html__( 'Mins', 'pls-theme' ),
				'secs_text'					=> esc_html__( 'Secs', 'pls-theme' ),
				'sdays_text'				=> esc_html__( 'd', 'pls-theme' ),
				'shours_text'				=> esc_html__( 'h', 'pls-theme' ),
				'smins_text'				=> esc_html__( 'm', 'pls-theme' ),
				'ssecs_text'				=> esc_html__( 's', 'pls-theme' ),
				'show_more'					=> esc_html__( '+ Show more', 'pls-theme' ),
				'show_less'					=> esc_html__( '- Show less', 'pls-theme' ),
				'loading_txt'				=> esc_html__( 'Loading...', 'pls-theme' ),
				'variation_unavailable'		=> esc_html__( 'Sorry, this product is unavailable. Please choose a different combination.', 'pls-theme' ),
			) ),
			'cart_auto_update'				=> pls_get_option( 'cart-auto-update', 1 ) ? true : false,
			'checkout_product_quantity'		=> pls_get_option( 'checkout-product-quantity', 0 ) ? true : false,
			'product_tooltip'				=> true ,
			'product_image_zoom'			=> pls_get_option( 'product-gallery-zoom', 1 ) ? true : false,
			'product_PhotoSwipe'			=> pls_get_option( 'product-gallery-lightbox', 1 ) ? true : false,
			'product_gallery_style'			=> function_exists( 'pls_get_product_gallery_style' ) ? pls_get_product_gallery_style() : pls_get_option( 'product-gallery-style', 'product-gallery-left' ),
			'typeahead_options'     		=> array( 'hint' => false, 'highlight' => true ),
			'nonce'                 		=> wp_create_nonce( 'pls_nonce' ),						
			'enable_add_to_cart_ajax' 		=> pls_get_option( 'product-add-to-cart-ajax', 0 ) ? true : false,
			'mini_cart_popup' 				=> ( 'slider' == pls_get_option( 'header-minicart-popup', 'slider' ) )  ? true : false,
			'sticky_product_image'			=> pls_get_option( 'sticky-product-image', 0 ) ? true : false,
			'sticky_product_summary'		=> pls_get_option( 'sticky-product-summary', 0 ) ? true : false,
			'sticky_sidebar'				=> pls_get_option( 'sticky-sidebar', 1 ) ? ( ( pls_is_catalog() && pls_get_option( 'shop-page-off-canvas-sidebar', 0 ) ) ? false : true) : false,
			'widget_toggle'					=> pls_get_option( 'widget-toggle', 0 ) ? true : false,
			'widget_menu_toggle'			=> pls_get_option( 'widget-menu-toggle', 0 ) ? true : false,
			'widget_hide_max_limit_item' 	=> pls_get_option( 'widget-items-hide-max-limit', 0 ) ? true : false,
			'number_of_show_widget_items'	=> pls_get_option( 'number-of-show-widget-items', 8 ),			
			'touch_slider_mobile'			=> pls_get_option( 'touch-slider-mobile', 0 ) ? true : false,
			'disable_variation_price_change'=> false,
			'maintenance_mode'				=> pls_get_option( 'maintenance-mode' , 0 ) ? true : false,
			
		));
		
		if ( class_exists( 'WooCommerce' ) ) {
			$pls_settings['price_format']             = get_woocommerce_price_format();
			$pls_settings['price_decimals']           = wc_get_price_decimals();
			$pls_settings['price_thousand_separator'] = wc_get_price_thousand_separator();
			$pls_settings['price_decimal_separator']  = wc_get_price_decimal_separator();
			$pls_settings['currency_symbol']          = get_woocommerce_currency_symbol();
			$pls_settings['wc_tax_enabled']           = wc_tax_enabled();
			$pls_settings['cart_url']                 = wc_get_cart_url();
			if ( wc_tax_enabled() ) {
				$pls_settings['ex_tax_or_vat'] = WC()->countries->ex_tax_or_vat();
			} else {
				$pls_settings['ex_tax_or_vat'] = '';
			}
		}
		
		//general ajax
		wp_localize_script( 'pls-script', 'pls_options', $pls_settings );			
		
		wp_enqueue_script( 'html5', PLS_SCRIPTS .'html5.js' , array(), '3.7.3' );
		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}	

	/**
	 * Load custom js in footer
	 * @since 1.0
	 */
	function owl_param() {
		global $pls_owlparam;
		wp_localize_script( 'pls-script', 'plsOwlArg', (array) $pls_owlparam );
	}
	
	/**
	 * Search product with sku
	 * @since 1.0
	 */
	public function product_search_sku( $where ) {
        global $pagenow, $wpdb, $wp;
 
        if ( ( is_admin() && 'edit.php' != $pagenow )
             || ! is_search()
             || ! isset( $wp->query_vars['s'] )
             || ( isset( $wp->query_vars['post_type'] ) && 'product' != $wp->query_vars['post_type'] )
             || ( isset( $wp->query_vars['post_type'] ) && is_array( $wp->query_vars['post_type'] ) && ! in_array( 'product', $wp->query_vars['post_type'] ) )
        ) {
            return $where;
        }
        $search_ids = array();
        $terms      = explode( ',', $wp->query_vars['s'] );
 
        foreach ( $terms as $term ) {
            //Include the search by id if admin area.
            if ( is_admin() && is_numeric( $term ) ) {
                $search_ids[] = $term;
            }
            // search for variations with a matching sku.
 
            $sku_to_parent_id = $wpdb->get_col( $wpdb->prepare( "SELECT p.post_parent as post_id FROM {$wpdb->posts} as p join {$wpdb->postmeta} pm on p.ID = pm.post_id and pm.meta_key='_sku' and pm.meta_value LIKE '%%%s%%' where p.post_parent <> 0 group by p.post_parent", wc_clean( $term ) ) );
 
            //Search for a simple product that matches the sku.
            $sku_to_id = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_sku' AND meta_value LIKE '%%%s%%';", wc_clean( $term ) ) );
 
            $search_ids = array_merge( $search_ids, $sku_to_id, $sku_to_parent_id );
        }
 
        $search_ids = array_filter( array_map( 'absint', $search_ids ) );
 
        if ( sizeof( $search_ids ) > 0 ) {
            $where = str_replace( ')))', ") OR ({$wpdb->posts}.ID IN (" . implode( ',', $search_ids ) . "))))", $where );
        }
 
        return $where;
    }
		
	function google_theme_color(){
		
		$google_theme_color = pls_get_option( 'google-theme-color', 'transparent' );
		
		if( 'transparent' != $google_theme_color ){ ?>	
			<meta name="theme-color" content="<?php echo esc_attr( $google_theme_color ); ?>">
		<?php
		}
	}
	
	/**
	 * Output of custom js options.
	 */
	public function custom_head_js() {
		
		$custom_js = pls_get_option( 'custom-js-header', '' );
		
		if ( !empty( trim( $custom_js ) ) ) {			
			echo apply_filters( 'pls_head_custom_js', $custom_js ); // WPCS: XSS OK.			
		}
	}

	/**
	* Javascript detection
	*/
	public function custom_footer_js(){
		
		$custom_js 	= trim( pls_get_option( 'custom_js', '' ) );
		$output = '';
		
		if( !empty( $custom_js ) ){ 
			$output .= '<script>' ;
			$output .= $custom_js ;
			$output .= '</script>' ;
		}
		echo apply_filters( 'pls_custom_js', $output ); // WPCS: XSS OK.
	}
	
	/**
	 * Output of dyanamic css.
	 */
	public  function print_css() {
		global $pls_custom_css;

		if ( ! empty( trim( (string)$pls_custom_css ) ) ) {
			// Sanitize.
			$pls_custom_css = wp_check_invalid_utf8( $pls_custom_css );			
			wp_add_inline_style( 'pls-custom-css', $pls_custom_css );
		}
	}
	
	/**
	 * Enqueue custom inline style
	 */
	public function enqueue_inline_style(){
		wp_enqueue_style( 'pls-custom-css' );
	}
	
	/**
	 * Alter the search posts per page
	 *
	 * @since 1.0
	 */
	public  function search_posts_per_page( $query ) {
		
		if ( is_admin() || ! $query->is_main_query() ) return;
		
		if( $query->is_main_query() && is_search() && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'product' ){
			$posts_per_page = pls_get_option( 'products-per-page', 12);
			if ( isset( $_GET[ 'per_page' ] ) ) {
				$posts_per_page = $_GET[ 'per_page' ];
			}
			$query->set( 'posts_per_page', $posts_per_page);
		}
	}
	
	/**
	 *Post View Count 
	 */
	public function post_view_count(){
		$prefix = PLS_PREFIX;
		if( ! is_single() || ! is_singular( 'post' ) ) return;
		$post_id = get_the_ID();
		$views = get_post_meta( $post_id, $prefix.'views_count', true );
		$views = !empty($views) ? $views : 0;
		
		update_post_meta( $post_id, $prefix.'views_count', ( $views + 1 ) );
		$views = get_post_meta( $post_id, $prefix.'views_count', true );
	}
	
	
	/**
	 * 'Continue reading' link.
	 */
	public function excerpt_more( $link ) {
		return '';
	}
	
	public function read_more_tag() {
		
		return sprintf( '<p class="read-more-btn link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			pls_get_loop_prop( 'post-readmore-text' )
		);
	}

	/**
	 * Filter the except length to 30 words.
	 */
	function excerpt_length( $length ) {
		return pls_get_option( 'blog-excerpt-length', 30 );
	}
} 
// Initialize theme
$pls_theme_class = new PLS_Theme_Class;