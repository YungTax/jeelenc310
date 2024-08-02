<?php
/**
 * Functions to allow styling of the templating system
 *
 * @package 	/inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Sets up the pls_loop global from the passed args.
 */
function pls_setup_loop( $args = array() ) {
	
	$default_args = array(
	
		'name'          						=> 'posts-loop',
		
		//Blog
		'post-single-line-title'          		=> 0,
		'sticky-post-icon'          			=> pls_get_option( 'sticky-post-icon', 1 ),
		'post-format-icon'          			=> pls_get_option( 'post-format-icon', 0 ),
		'post-category'          				=> pls_get_option( 'post-category', 1 ),
		'post-meta'          					=> pls_get_option( 'post-meta', 1 ),
		'specific-post-meta'          			=> pls_get_option( 'specific-post-meta', array( 'post-author', 'post-date' ) ),
		
		//Blog Archive
		'blog-post-style'          				=> pls_get_option( 'blog-post-style', 'blog-classic' ),
		'blog-grid-layout'          			=> pls_get_option( 'blog-grid-layout', 'simple-grid' ),
		'blog-grid-columns'        				=> pls_get_option( 'blog-grid-columns', 2 ),
		'blog-grid-columns-tablet'        		=> pls_get_option( 'blog-grid-columns-tablet', 2 ),
		'blog-grid-columns-mobile'        		=> pls_get_option( 'blog-grid-columns-mobile', 1 ),
		'first-standard-post'        			=> pls_get_option( 'first-standard-post', 1 ),
		'blog-post-thumbnail'          			=> pls_get_option( 'blog-post-thumbnail', 1 ),
		'blog-post-title'          				=> pls_get_option( 'blog-post-title', 1 ),
		'show-blog-post-content'          		=> pls_get_option( 'show-blog-post-content', 1 ),
		'blog-post-content'          			=> pls_get_option( 'blog-post-content', 'full-content' ),
		'blog-excerpt-length'          			=> pls_get_option( 'blog-excerpt-length', 30 ),
		'read-more-button'          			=> pls_get_option( 'read-more-button', 1 ),
		'read-more-button-style'          		=> pls_get_option( 'read-more-button-style', 'read-more-button-fill' ),
		'post-readmore-text'          	    	=> pls_get_option( 'post-readmore-text', 'Continue Reading' ),
		'blogs-pagination-type'          		=> pls_get_option( 'blogs-pagination-type', 'default' ),
		'blog-pagination-load-more-button-text'	=> pls_get_option( 'blog-pagination-load-more-button-text', 'Load More' ),
		'blog-pagination-finished-message'		=> pls_get_option( 'blog-pagination-finished-message', 'No More Available...' ),
				
		/* woocommerce */
		'product-style'        					=> pls_get_option( 'product-style', 'product-style-1' ),
		'products-columns'        				=> (int) pls_get_option( 'products-columns', 3 ),
		'products-columns-tablet'        		=> (int) pls_get_option( 'products-columns-tablet', 2 ),
		'products-columns-mobile'        		=> (int) pls_get_option( 'products-columns-mobile', 2 ),
		'product_rows'        					=> 1,
		'products-per-page'        				=> pls_get_option( 'products-per-page', 12 ),
		'products-view-icon'        			=> pls_get_option( 'products-view-icon', 1 ),
		'products-pagination-style'        		=> pls_get_option( 'products-pagination-style', 'default' ),
		'products-pagination-load-more-button-text' => pls_get_option( 'products-pagination-load-more-button-text', 'Load More' ),
		'products-pagination-finished-message'  => pls_get_option( 'products-pagination-finished-message', 'No More Products Available' ),
		'product-countdown'          			=> pls_get_option( 'product-countdown', 0 ), 
		'products_view'							=> function_exists ( 'pls_get_products_view' ) ? pls_get_products_view() : 'grid-view',
		'is_quick_view'		                    => false,
	);
	
	// Merge any existing values.
	if ( isset( $GLOBALS['pls_loop'] ) ) {
		$default_args = array_merge( $default_args, $GLOBALS['pls_loop'] );
	}

	$GLOBALS['pls_loop'] = wp_parse_args( $args, $default_args );
}
add_action( 'woocommerce_before_shop_loop', 'pls_setup_loop' );
add_action( 'wp', 'pls_setup_loop', 10 );

/**
 * Sets a property in the pls_loop global.
 */
function pls_set_loop_prop( $prop, $value = '' ) {
	if ( ! isset( $GLOBALS['pls_loop'] ) ) {
		pls_setup_loop();
	}
	$GLOBALS['pls_loop'][ $prop ] = $value;
}

/**
 * Resets the pls_loop global.
 */
function pls_reset_loop() {
	unset( $GLOBALS['pls_loop'] );
}
add_action( 'woocommerce_after_shop_loop', 'woocommerce_reset_loop', 999 );

/**
 * Gets a property from the pls_loop global.
 */
if ( ! function_exists( 'pls_get_loop_prop' ) ) {
	function pls_get_loop_prop( $prop, $default = '' ) {

		pls_setup_loop(); // Ensure post loop is setup.

		$value = isset( $GLOBALS['pls_loop'], $GLOBALS['pls_loop'][ $prop ] ) ? $GLOBALS['pls_loop'][ $prop ] : $default;
		$value = apply_filters( 'pls_get_loop_prop' , $value, $prop, $GLOBALS['pls_loop']);
		return apply_filters( 'pls_get_loop_prop_' . $prop, $value, $prop,$GLOBALS['pls_loop']) ;
	}
}

/**
 * Adds custom classes to the array of body classes.
 */
function pls_body_classes( $classes ) {
	
	$layout 			= pls_get_layout();
	$classes[] 			= 'pls-'.PLS_THEME_SLUG.'-v' . PLS_VERSION;
	$classes[] 			= 'pls-wrapper-' . pls_get_option( 'theme-layout', 'full' );
	$classes[] 			= 'pls-skin-' . pls_get_option( 'site-skin', 'light' );
		
	
	if( pls_is_open_categories_menu() ){
		$classes[] = 'pls-open-categories-menu';
	}
	
	if( $layout != 'full-width' ){
		$classes[] = 'pls-has-sidebar';
		$classes[] = $layout;
	}else{
		$classes[] = 'pls-no-sidebar';
	}
	
	if( pls_get_option( 'ajax-filter', 0 ) && pls_is_catalog() ){
		$classes[] = 'pls-catalog-ajax-filter';
	}
	
	$classes[] 			= 'pls-widget-' . pls_get_option( 'widget-style', 'default' );
	
	if( pls_get_option( 'widget-toggle', 0 ) ){
		$classes[] = 'pls-widget-toggle';
	}
	
	if( pls_get_option( 'widget-menu-toggle', 0 ) ){
		$classes[] = 'pls-widget-menu-toggle';
	}
	
	if( pls_get_option( 'product-hover-mobile', 0 ) ){
		$classes[] = 'pls-product-hover-mobile';
	}
	
	if( pls_get_option( 'mobile-bottom-navbar', 0 ) ) { 
		if( function_exists('is_product') && is_product() ) {
			if( pls_get_option( 'mobile-product-page-button', 1 ) ){
				$classes[] = 'pls-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'pls-mobile-bottom-navbar';
			}
		}elseif( function_exists('is_cart') && is_cart() ){
			if( pls_get_option( 'mobile-cart-page-button', 1 ) ) {
				$classes[] = 'pls-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'pls-mobile-bottom-navbar';
			}
		}elseif( function_exists('is_checkout') && is_checkout() ){
			if( pls_get_option( 'mobile-checkout-page-button', 1 ) ){
				$classes[] = 'pls-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'pls-mobile-bottom-navbar';
			}
		}else{
			$classes[] = 'pls-mobile-bottom-navbar';
		}		
	}
	
	if( pls_get_option('sidebar-canvas-mobile', 1 ) || pls_get_option('shop-page-off-canvas-sidebar', 0 ) ){
		if( ! pls_is_vendor_page() ){
			$classes[] = 'pls-mobile-canvas-sidebar';
		}
	}elseif( pls_get_option( 'mobile-bottom-navbar', 0 )  && !pls_is_vendor_page() ){
		$mobile_elemets = (array)pls_get_option( 'mobile-navbar-elements',  array(
				'enabled'  => array(
					'home'     		=> esc_html__( 'Home', 'pls-theme' ),
					'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'pls-theme' ),
					'search'  		=> esc_html__( 'Search', 'pls-theme' ),
					'wishlist' 		=> esc_html__( 'Wishlist', 'pls-theme' ),
					'account'  		=> esc_html__( 'Account', 'pls-theme' ),							
				) ) );
		
		if(!isset($mobile_elemets['enabled'])){
			$mobile_elemets['enabled'] =  array(
				'home'     		=> esc_html__( 'Home', 'pls-theme' ),
				'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'pls-theme' ),
				'search'  		=> esc_html__( 'Search', 'pls-theme' ),
				'wishlist' 		=> esc_html__( 'Wishlist', 'pls-theme' ),
				'account'  		=> esc_html__( 'Account', 'pls-theme' ),							
			);
		}		
		if( array_key_exists( 'sidebar', $mobile_elemets['enabled'] ) ){
			if( function_exists('is_product') && is_product() && pls_get_option('mobile-product-page-button')  ){
				$classes[] = '';
			}else{
				$classes[] = 'pls-mobile-canvas-sidebar';
			}			
		}
	}
	
	if( pls_get_option( 'promo-bar', 0 ) && 'bottom' == pls_get_option( 'promo-bar-position', 'top' ) ) {
		$classes[] = 'pls-promo-bar-bottom';
	}
	
	$classes = apply_filters( 'pls_body_classes', $classes );
	
	return $classes;
}

/**
 * Adds custom class to the array of posts classes.
 */
function pls_post_classes( $classes, $class, $post_id ) {
	//$classes[] = 'entry';

	return $classes;
}

/**
 * Display classes for primary div
 */
if ( ! function_exists( 'pls_primary_class' ) ) :
	function pls_primary_class( $class = '' ) {
		echo 'class="' . esc_attr( join( ' ', pls_get_primary_class( $class ) ) ) . '"';
	}
endif;

/**
 * Retrieve the classes for the primary element as an array.
 */
if ( ! function_exists( 'pls_get_primary_class' ) ) :
	function pls_get_primary_class( $class = '' ) {
		$classes 		= array();
		$page_id 		= get_the_ID();
		$page_layout 	= get_post_meta( $page_id, PLS_PREFIX.'page_sidebar_position', true );
		
		$classes[] = 'pls-content-area';
		
		$content_columns = pls_get_content_columns();
		if( !empty( $content_columns ) ){
			$classes = array_merge( $classes, $content_columns );
		}
		
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}
		
		$classes = apply_filters( 'pls_primary_class', $classes, $class );
		$classes = array_map( 'sanitize_html_class', $classes );

		return array_unique( $classes );
	}
endif;


/**
 * Display classes for sidebar div
 */
if ( ! function_exists( 'pls_sidebar_class' ) ) :
	function pls_sidebar_class( $class = '' ) {
		echo 'class="' . esc_attr( join( ' ', pls_get_sidebar_class( $class ) ) ) . '"';
	}
endif;

/**
 * Retrieve the classes for the sidebar as an array.
 */
if ( ! function_exists( 'pls_get_sidebar_class' ) ) :
	function pls_get_sidebar_class( $class = '' ) {
		$classes 	= array();
		$classes[] 	= 'pls-widget-area';
		
		$sidebar_columns = pls_get_sidebar_columns();		
		if( !empty( $sidebar_columns ) ){
			$classes = array_merge( $classes, $sidebar_columns );
		}
		
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}
		
		$classes = apply_filters( 'pls_sidebar_class', $classes, $class );

		return array_unique( $classes );
	}
endif;

/**
 * Blog wrapper classes
 */
if( ! function_exists( 'pls_blog_wrapper_classes' ) ):
	function pls_blog_wrapper_classes() {			
		$classes = array();
		if( pls_get_loop_prop('name') == 'related-posts' ){			
			$classes[]	= 'swiper-wrapper';
			$classes[]	= 'slider-col-lg-'.pls_get_loop_prop( 'slides_to_show' );
			$classes[] 	= 'slider-col-md-'.pls_get_loop_prop( 'slides_to_show_tablet' );
			$classes[] 	= 'slider-col-'.pls_get_loop_prop( 'slides_to_show_mobile' );
			$classes[] = ( pls_get_loop_prop( 'read-more-button-style' ) ) ? pls_get_loop_prop( 'read-more-button-style' ) : '';
		}else{
			$blog_post_style		= pls_get_loop_prop( 'blog-post-style' );
			$blog_grid_layout		= pls_get_loop_prop( 'blog-grid-layout' );			
			$first_standard_post	= pls_get_loop_prop( 'first-standard-post' );
			
			$classes[] = 'articles-list';
			if( 'blog-grid' == $blog_post_style && 'posts-slider-shortcode' != pls_get_loop_prop( 'name' ) ){
				$classes[] = 'row';
			}
			
			if( 'masonry-grid' == $blog_grid_layout ){
				wp_enqueue_script( 'isotope' );
				wp_enqueue_script( 'masonry' );
			}
			
			$classes[] = $blog_post_style;
			
			if( 'blog-grid' == $blog_post_style ){
				$classes[] = $blog_grid_layout;
			}
						
			if( $first_standard_post && ( 'blog-grid' == $blog_post_style || 'blog-listing' == $blog_post_style ) && 'posts-slider-shortcode' != pls_get_loop_prop( 'name' ) ){
				$classes[] = 'pls-standard-post';
			}
			
			if( 'posts-slider-shortcode' == pls_get_loop_prop( 'name' ) ){
				$classes[]	= 'swiper-wrapper';
				$classes[]	= 'slider-col-lg-'.pls_get_loop_prop( 'slides_to_show' );
				$classes[] 	= 'slider-col-md-'.pls_get_loop_prop( 'slides_to_show_tablet' );
				$classes[] 	= 'slider-col-'.pls_get_loop_prop( 'slides_to_show_mobile' );
			}
			
			$classes[] = ( pls_get_loop_prop( 'read-more-button-style' ) ) ? pls_get_loop_prop( 'read-more-button-style' ) : '';
		}
		
		if( pls_get_loop_prop( 'post-single-line-title' ) ){
			$classes[] 	= 'post-single-line-title';
		}
		
		$classes = apply_filters( 'pls_blog_wrapper_classes', $classes );
		
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}
		
		echo esc_attr( $classes );
	}
endif;

/**
 * Checks to see if we're on the homepage or not.
 */
function pls_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if we're on the homepage or not.
 */
function pls_site_loader() {
	
	if( ! pls_get_option( 'site-preloader', 0 ) ) return;
	
	$preloader_style = pls_get_option('predefine-loader-style', '1' );
	
	if( 'predefine-loader' == pls_get_option('preloader-image', 'predefine-loader' ) ){		
		$html = '';
		switch ( $preloader_style ) {
			case '1':
				$html ='<div class="spinner style-'.$preloader_style.'">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>';
				break;
			case '2':
				$html ='<div class="sk-folding-cube style-'.$preloader_style.'">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>';
				break;
			case '3':
				$html ='<div class="spinner style-'.$preloader_style.'"></div>';
				break;
			case '4':
				$html ='<div class="spinner style-'.$preloader_style.'">						
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>';
				break;
			case '5':
				$html ='<div class="spinner style-'.$preloader_style.'">						
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>';
				break;
		}
		$html = '<div class="pls-site-preloader">'.$html.'</div>';
	}else{		
		$html = '<div class="pls-site-preloader"></div>';
	}
	
	echo apply_filters( 'pls_site_preloader', $html, $preloader_style );
}

/**
 * Global
 */
if ( ! function_exists( 'pls_output_content_wrapper' ) ) {

	/**
	 * Output the start of the page wrapper.
	 */
	function pls_output_content_wrapper() {
		pls_get_template( 'template-parts/global/wrapper-start.php' );		
	}
}
if ( ! function_exists( 'pls_output_content_wrapper_end' ) ) {

	/**
	 * Output the end of the page wrapper.
	 */
	function pls_output_content_wrapper_end() {
		pls_get_template( 'template-parts/global/wrapper-end.php' );
	}
}

if( ! function_exists( 'pls_mobile_menu' ) ) {
	/**
	 * Header Mobile menu
	 */
	function pls_mobile_menu() {
		
		$mobile_primary_menu 		= 'mobile-menu';
		$mobile_categories_menu 	= 'mobile-categories-menu';
		
		if ( ! has_nav_menu( $mobile_primary_menu ) ) {
			$mobile_primary_menu = 'primary';
		}
		
		if ( ! has_nav_menu( $mobile_categories_menu ) ) {
			$mobile_categories_menu = 'categories-menu';
		}
				
		$primary_menu_location 		= apply_filters( 'pls_mobile_primary_menu_location', $mobile_primary_menu );
		$categories_menu_location 	= apply_filters( 'pls_mobile_categories_menu_location', $mobile_categories_menu );
		$mobile_menu_color	 		= pls_get_option('mobile-menu-color', 'light' );
		$mobile_menu_text			= apply_filters( 'pls_mobile_menu_text', esc_html__( 'Menu','pls-theme' ) );
		$mobile_categories_text		= apply_filters( 'pls_mobile_categories_text', esc_html__( 'Categories','pls-theme' ) );
		$menu_link 					= get_admin_url( null, 'nav-menus.php' );
		
		$mobile_logo_url			= pls_get_option( 'mobile-header-logo', array( 'url' => PLS_IMAGES.'logo-1.svg' ) );
		$logo_light_url 			= pls_get_option( 'header-logo-light', array( 'url' => PLS_IMAGES.'logo-light-1.svg' ) );
		$site_title 				= get_bloginfo( 'name', 'display' );
		if( is_ssl() ) {
			$mobile_logo 			= str_replace('http://', 'https://', $mobile_logo_url['url']);
			$logo_light				= str_replace('http://', 'https://', $logo_light_url['url']);
		}else{
			$mobile_logo			= $mobile_logo_url['url'];
			$logo_light				= $logo_light_url['url'];
		} ?>			
		<div class="pls-mobile-menu pls-mobile-menu-color-<?php echo esc_attr( $mobile_menu_color ); ?>">
			<div class="pls-mobile-menu-wrap">
				<div class="pls-mobile-menu-header">
					<div class="pls-header-logo" rel="<?php echo esc_attr('home');?>">
						<?php if( 'light' == pls_get_option('mobile-menu-color', 'light' ) ) { ?>
							<img class="pls-mobile-logo" src="<?php echo esc_url($mobile_logo);?>" alt="<?php echo esc_attr($site_title);?>" />
						<?php } else { ?>
							<img class="pls-mobile-logo" src="<?php echo esc_url($logo_light);?>" alt="<?php echo esc_attr($site_title);?>" />
						<?php } ?>
					</div>
					<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'pls-theme' ); ?></a>
				</div>
				
				<?php if( has_nav_menu( $primary_menu_location ) || has_nav_menu( $categories_menu_location ) ){ ?>
					<div class="mobile-nav-tabs">
						<ul class="pls-underline">
							<li class="primary active" data-menu="primary"><span><?php echo esc_html( $mobile_menu_text );?></span></li>
							<?php if ( pls_get_option('mobile-categories-menu', 1 ) && has_nav_menu( 'categories-menu' ) ) { ?>
								<li class="categories" data-menu="categories"><span><?php echo esc_html($mobile_categories_text);?></span></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				
				<?php
				// Mobile Primary Menu
				$admin_menu_link = get_admin_url( null, 'nav-menus.php' );
				if ( has_nav_menu( $primary_menu_location ) ) {
					wp_nav_menu( array( 
						'theme_location' 	=> $primary_menu_location,
						'menu_class'      	=> 'mobile-main-menu',
						'container_class'	=> 'mobile-primary-menu mobile-nav-content active',
						'fallback_cb' 		=> '',
						'walker' 			=> new PLS_Menu_Walker()
					) ); 			
				}else{ ?>
					<div class="mobile-primary-menu mobile-nav-content active">
						<span class="add-navigation-message">
							<?php printf( wp_kses( __('Add your <a href="%s">navigation menu here</a>', 'pls-theme' ),array( 'a' => array( 'href' => array() )	) )	, $admin_menu_link );	?>
						</span>
					</div>
				<?php }
				
				// Mobile Categories Menu
				if ( pls_get_option('mobile-categories-menu', 1 ) && has_nav_menu( $categories_menu_location ) ) {
					wp_nav_menu( array( 
						'theme_location' 	=> $categories_menu_location,
						'menu_class'      	=> 'mobile-main-menu',
						'container_class'   => 'mobile-categories-menu mobile-nav-content',
						'fallback_cb' 		=> '',
						'walker' 			=> new PLS_Menu_Walker()
					) );
				}?>
				
				<?php if( pls_get_option( 'mobile-menu-social-profile', 0 ) ) { ?>
					<div class="pls-mobile-menu-social">
						<?php pls_get_template( 'template-parts/header/elements/social-profile' ); ?>
					</div>
				<?php } ?>
				<?php if( pls_get_option( 'header-language-switcher', 1 ) || pls_get_option( 'header-currency-switcher', 1 ) ) { ?>
					<div class="pls-mobile-menu-bottom">
						<?php pls_get_template( 'template-parts/header/elements/language-switcher' ); ?>
						<?php pls_get_template( 'template-parts/header/elements/currency-switcher' ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}

/**
 * Header
 */
 
if ( ! function_exists( 'pls_get_header_style' ) ) {
	
	/**
	 * Get header style.
	 */
	function pls_get_header_style() {
		$header_style 			= pls_get_post_meta( 'header_style' );
		if( !$header_style || $header_style == 'default' ){
			if( pls_get_option( 'header-select', 'style' ) == 'style' ){
				$header_style 	= pls_get_option( 'header-style', '1' );
			}else{
				$header_style 	= pls_get_option( 'header-select', 'builder' );
			}
		}		
		return apply_filters( 'pls_header_style', $header_style );
	}
}

if ( ! function_exists( 'pls_is_header_transparent' ) ) {

	/**
	 * PLS template header.
	 */
	function pls_is_header_transparent() {
		$header_transparent 	= pls_get_post_meta( 'header_transparent' );
		if( ! $header_transparent || 'default' == $header_transparent ){
			$header_transparent = 0;
			if( pls_get_option( 'header-transparent', 0 ) ){
				if ( is_front_page() && 'front-page' == pls_get_option( 'header-transparent-on', 'front-page' ) ) {
					$header_transparent = 1;
				}elseif( 'all-pages' == pls_get_option( 'header-transparent-on', 'front-page' ) ){
					$header_transparent = 1;
				}
			}
		}elseif( 'enable' == $header_transparent ){
			$header_transparent = 1;
		}elseif( 'disable' == $header_transparent ){
			$header_transparent = 0;
		}
		
		return $header_transparent;
	}
	
}
if ( ! function_exists( 'pls_template_header' ) ) {

	/**
	 * PLS template header.
	 */
	function pls_template_header() {
		
		$args = $class = array();
		$header_style 			= pls_get_post_meta( 'header_style' );
		if( !$header_style || $header_style == 'default' ){
			if( pls_get_option( 'header-select', 'style' ) == 'style' ){
				$header_style 	= pls_get_option( 'header-style', '1' );
			}else{
				$header_style 	= pls_get_option( 'header-select', 'builder' );
			}
		}	
		$header_style 			= pls_get_header_style();
		$class[]				= 'header-'.$header_style;
		$class[]				= ( pls_get_option( 'header-sticky', 0 ) ) ? 'header-sticky' : '';
		$class[]				= ( pls_get_option( 'header-full-width', 0 ) ) ? 'pls-header-full-width' : '';
		
		$header_top 			= pls_get_post_meta( 'header_top' );
		$header 				= pls_get_post_meta( 'header' );
		$header_transparent_color	= pls_get_post_meta( 'header_transparent_color' );
		
		if( !$header_top || $header_top == 'default' ){
			$header_top = pls_get_option( 'header-topbar', 1 );				
		}elseif( $header_top == 'enable' ){
			$header_top = 1;
		}elseif( $header_top == 'disable' ){
				$header_top = 0;
		}

		if( ! $header || $header == 'default' ){
			$header = 1;				
		}elseif( $header == 'enable' ){
			$header = 1;
		}elseif( $header == 'disable' ){
				$header = 0;
		}
		
		$header_transparent = pls_is_header_transparent();
		if( PLS_WOOCOMMERCE_ACTIVE && is_product() ){
			$header_transparent = 0;
		}
		
		if( $header_transparent ){
			$class[]	= 'pls-header-overlay';
			if( !$header_transparent_color || $header_transparent_color == 'default' ){
				$header_transparent_color = pls_get_option( 'header-transparent-color', 'dark' );				
			}
			$class[]	= 'header-color-'.$header_transparent_color;
		}
		
		$args['header_style']	= 'header-'.$header_style;
		$args['class']	 		= implode( ' ', array_filter( $class ) );
		$args['header_top'] 	= apply_filters( 'pls_enable_header_top', $header_top );
		$args['header'] 		= apply_filters( 'pls_enable_header', $header );
		
		if( ! $header ) return;
		
		pls_get_template( 'template-parts/header/header', $args );
	}
}

if ( ! function_exists( 'pls_search_popup' ) ) {

	/**
	 * Header search popup.
	 */
	function pls_search_popup() {
		if( ! pls_get_option( 'header-search', 1 ) ) {
			return;
		}?>
		<div class="pls-search-popup">
			<div class="pls-search-popup-wrap">
				<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'pls-theme' ); ?></a>
				<?php pls_get_template( 'template-parts/header/elements/ajax-search' );?>
			</div>
		</div>
	<?php }
}

if ( ! function_exists( 'pls_header_topbar_left' ) ) {

	/**
	 * Output header topbar left.
	 */
	function pls_header_topbar_left() {
		$elements = pls_get_option( 'header-topbar-manager', array ( 'left' => array ( 'email' => 'Email', 'customer-care' => 'Phone Number' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_topbar_right' ) ) {

	/**
	 * Output header topbar right.
	 */
	function pls_header_topbar_right() {
		$elements = pls_get_option( 'header-topbar-manager', array ( 'right' => array ( 'welcome-message' => 'Welcome Message Switcher', 'language-switcher' => 'Language Switcher', 'currency-switcher' => 'Currency Switcher' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_main_left' ) ) {

	/**
	 * Output header main left.
	 */
	function pls_header_main_left() {
		$elements = pls_get_option( 'header-main-manager', array ( 'left' => array ( 'logo' => 'Logo' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_main_center' ) ) {

	/**
	 * Output header main center.
	 */
	function pls_header_main_center() {
		$elements = pls_get_option( 'header-main-manager', array ( 'center' => array ( 'ajax-search' => 'Ajax Search' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ($elements['center']): 
			foreach ($elements['center'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_main_right' ) ) {

	/**
	 * Output header main right.
	 */
	function pls_header_main_right() {
		$elements = pls_get_option( 'header-main-manager', array ( 'right' => array ( 'myaccount' => 'My Account', 'wishlist' => 'Wishlist', 'cart' => 'Cart' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_navigation_left' ) ) {

	/**
	 * Output header navigation left.
	 */
	function pls_header_navigation_left() {
		$elements = pls_get_option( 'header-navigation-manager', array ( 'left' => array ( 'category-menu' => 'Category Menu' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_navigation_center' ) ) {

	/**
	 * Output header navigation center.
	 */
	function pls_header_navigation_center() {
		$elements = pls_get_option( 'header-navigation-manager', array ( 'center' => array ( 'primary-menu' => 'Primary Menu' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ($elements['center']): 
			foreach ($elements['center'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_navigation_right' ) ) {

	/**
	 * Output header navigation right.
	 */
	function pls_header_navigation_right() {
		$elements = pls_get_option( 'header-navigation-manager', array ( 'right' => array ( ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				pls_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_mobile_topbar_center' ) ) {

	/**
	 * Output header mobile topbar.
	 */
	function pls_header_mobile_topbar_center() {
		$elements = pls_get_option( 'header-mobile-topbar-manager', array ( 'center' => array ( 'welcome-message'=> 'Welcome Message', 'language-switcher'=> 'Language Switcher', 'currency-switcher'=> 'Currency Switcher' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ( $elements['center'] ): 
			foreach ($elements['center'] as $element => $value) {
				pls_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_mobile_left' ) ) {

	/**
	 * Output header mobile left.
	 */
	function pls_header_mobile_left() {
		$elements = pls_get_option( 'header-mobile-manager', array ( 'left' => array ( 'mobile-menu'=> 'Mobile Nav' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ( $elements['left'] ): 
			foreach ( $elements['left'] as $element => $value ) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_mobile_center' ) ) {

	/**
	 * Output header mobile center.
	 */
	function pls_header_mobile_center() {
		$elements = pls_get_option( 'header-mobile-manager', array ( 'left' => array ( 'logo' => 'Logo' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ( $elements['center'] ): 
			foreach ( $elements['center'] as $element => $value ) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_header_mobile_right' ) ) {

	/**
	 * Output header mobile right.
	 */
	function pls_header_mobile_right() {
		$elements = pls_get_option( 'header-mobile-manager', array ( 'right' => array ( 'mini-search' => 'Mini Search', 'cart' => 'Cart' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ( $elements['right'] ): 
			foreach ( $elements['right'] as $element => $value ) {
				pls_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'pls_is_open_categories_menu' ) ) :

	/**
	 * Check categories menu is open in home page or not.
	 */
	function pls_is_open_categories_menu() {
		
		$return_value = false;
		
		if( is_front_page() && pls_get_option( 'open-categories-menu', 0 ) ){
			$return_value = true;
		}
		
		return apply_filters('pls_open_categories_menu', $return_value );
	}
endif;

/**
 * Page Title
 */
if ( ! function_exists( 'pls_page_title' ) ) :

	/**
	 * PLS page title.
	 */
	function pls_page_title() {
		
		// Return if page title disable
		if( ( is_front_page() && !is_home() )
			|| ( function_exists( 'is_product' ) && is_product() ) 
			|| ( pls_is_catalog() && 'disable' == pls_get_option( 'shop-page-title-layout', 'center' ) ) ) {
			return;
		} 
		
		if( pls_is_vendor_page() ){
			return;			
		}
		
		$prefix 					= PLS_PREFIX; // Taking metabox prefix
		$page_title_section 		= pls_get_post_meta('page_title');
		$page_title_layout 			= pls_get_post_meta('page_title_layout');
		$title_font_size 			= pls_get_post_meta('title_font_size');
		$page_heading 				= pls_get_post_meta('page_heading');
		$breadcrumb 				= pls_get_post_meta('breadcrumb');
		
		/* Style Param*/
		$title_padding_top 			= pls_get_post_meta('title_padding_top');
		$title_padding_bottom 		= pls_get_post_meta('title_padding_bottom');
		$title_bg_color 			= pls_get_post_meta('title_bg_color');
		$title_color 				= pls_get_post_meta('title_color'); /* Dark/Light */
		$title_bg_img 				= pls_get_post_meta('title_bg_img');
		$title_bg_position 			= pls_get_post_meta('title_bg_position');
		$title_bg_attachment 		= pls_get_post_meta('title_bg_attachment'); /* Scroll/Fixed */
		$title_bg_repeat 			= pls_get_post_meta('title_bg_repeat');
		$title_bg_size 				= pls_get_post_meta('title_bg_size');
		$title_bg_opacity 			= pls_get_post_meta('title_bg_opacity');
		
		if ( function_exists( 'is_product_category' ) && is_product_category() ) {				
			$queried_object = get_queried_object();
			$term_id        = $queried_object->term_id;				
			$cat_title_bg_img    	= get_term_meta( $term_id, $prefix.'header_banner', true );
			$sidebar_title_color    = get_term_meta( $term_id, $prefix.'sidebar_title_color', true );
			
			$cat_ancestors  = get_ancestors( $term_id, 'product_cat' );
			if ( empty( $cat_title_bg_img ) && count( $cat_ancestors ) > 0 ) {
				$parent_id   = $cat_ancestors[0];
				$cat_title_bg_img = get_term_meta( $parent_id, $prefix.'header_banner', true );
			}
			
			if( !empty( $cat_title_bg_img ) ){
				$title_bg_img 	= $cat_title_bg_img;
			}
			if( !empty( $sidebar_title_color ) ){
				$title_color 	= $sidebar_title_color;
			}
		}
		
		if ( pls_is_product_brand() ) {				
			$queried_object = get_queried_object();
			$term_id        = $queried_object->term_id;				
			$cat_title_bg_img    	= get_term_meta( $term_id, $prefix.'header_banner', true );
			$sidebar_title_color    = get_term_meta( $term_id, $prefix.'sidebar_title_color', true );
			
			$cat_ancestors  = get_ancestors( $term_id, 'product_brand' );
			if ( empty( $cat_title_bg_img ) && count( $cat_ancestors ) > 0 ) {
				$parent_id   = $cat_ancestors[0];
				$cat_title_bg_img = get_term_meta( $parent_id, $prefix.'header_banner', true );
			}
			
			if( !empty( $cat_title_bg_img ) ){
				$title_bg_img 	= $cat_title_bg_img;
			}
			if( !empty( $sidebar_title_color ) ){
				$title_color 	= $sidebar_title_color;
			}
		}
		
		if( ! $page_title_section || $page_title_section == 'default' ){
			$page_title_section = pls_get_option( 'page-title-layout', 'title-centered' );
			if( pls_is_catalog() ) {
				$page_title_section = pls_get_option( 'shop-page-title-layout', 'center' );
			}
		}elseif( $page_title_section == 'enable' ){
			$page_title_section = true;
		}elseif( $page_title_section == 'disable' ){
				$page_title_section = false;
		}
		
		if( is_tax() || is_tag() || is_category() || is_date() || is_author() ){
			if( ! pls_get_option( 'blog-page-title', 1 ) && ! pls_get_option( 'blog-page-breadcrumb', 1 ) ){
				$page_title_section = false;
			}
			
		}			
		
		// Return if disabled page title
		if( ! $page_title_section || 'disable' == $page_title_section ) {
			return;
		}
		
		if( ! $page_title_layout || $page_title_layout == 'default' ){
			$page_title_layout = pls_get_option( 'page-title-layout', 'title-centered' );
		}
		
		if( ! $title_font_size || $title_font_size == 'default' ){
			$title_font_size = pls_get_option( 'page-title-size', 'default' );				
		}
		
		if( pls_is_catalog() ) {
			$page_title_layout = pls_get_option( 'shop-page-title-layout', 'center' );
			$title_font_size = pls_get_option( 'shop-page-title-size', 'default' );
		}		
		
		if( ! $page_heading || $page_heading == 'default' ){
			$page_heading = pls_get_option( 'page-heading', 1 );
			if( pls_is_catalog() ) {
				$page_heading = pls_get_option( 'shop-page-heading', 1 );
			}
		}elseif( $page_heading == 'enable' ){
			$page_heading = true;
		}elseif( $page_heading == 'disable' ){
			$page_heading = false;
		}
		
		if ( is_single() && 'post' == get_post_type() ) {
			$page_heading = false;
		}
		
		if( ! $breadcrumb || 'default' == $breadcrumb ){
			$breadcrumb = pls_get_option( 'page-breadcrumb', 1 );
			if( pls_is_catalog() ) { 
				$breadcrumb = pls_get_option( 'shop-page-breadcrumb', 1 );
			}
		}elseif( 'enable' == $breadcrumb ){
			$breadcrumb = true;
		}elseif( 'disable' == $breadcrumb ){
			$breadcrumb = false;
		}
		
		if ( is_home() ) {
			$page_heading = (int)pls_get_option( 'blog-page-title', 1 );			
			$breadcrumb = pls_get_option( 'blog-page-breadcrumb', 1 );
		}
		$custom_css = array();
		$custom_style = '';
		if( ! empty( $title_padding_top ) ){
			$custom_css[] = 'padding-top:'.$title_padding_top.'px;';
		}
		if( ! empty( $title_padding_bottom ) ){
			$custom_css[] = 'padding-bottom:'.$title_padding_bottom.'px;';
		}
		
		if( !$title_color || $title_color == 'default' ){
			$title_color = pls_get_option( 'page-title-color', 'dark' );
			if( pls_is_catalog() ) { 
				$title_color = pls_get_option( 'shop-page-title-color', 'dark' );
			}
		}
		$title_bg_img = apply_filters( 'pls_title_bg_attachment' , $title_bg_img );
		if( ! empty( $title_bg_img ) ){
			$image_src = pls_get_image_src( $title_bg_img, 'full' );
			$custom_css[] = 'background-image:url('.$image_src.');';
			if( ! empty($title_bg_position) && $title_bg_position != 'default' ){
				$title_bg_position =  str_replace('-',' ',$title_bg_position);
				$custom_css[] = 'background-position:'.$title_bg_position.';';
			}
			if( ! empty($title_bg_attachment) && $title_bg_attachment != 'default' ){
				$custom_css[] = 'background-attachment:'.$title_bg_attachment.';';
			}
			if( ! empty($title_bg_repeat) && $title_bg_repeat != 'default' ){
				$custom_css[] = 'background-repeat:'.$title_bg_repeat.';';
			}
			if( ! empty($title_bg_size) && $title_bg_size != 'default' ){
				$custom_css[] = 'background-size:'.$title_bg_size.';';
			}
			if( ! empty( $title_bg_opacity ) ){
				$custom_css[] = 'opacity:'.$title_bg_opacity.';';
			}
		}
		
		$header_transparent = pls_is_header_transparent();
		if( $page_title_layout == 'title-centered') {
			$title_color 		= 'inherit';
			$custom_css[] 		= 'background: none;';
		}
		if( $page_title_layout == 'title-centered' && !$header_transparent) {
			$custom_css[] 		= 'padding-top: 0;';
			$custom_css[] 		= 'padding-bottom: 0;';
		}
		
		if( ! empty( $custom_css ) ){
			$custom_style .= '.page-title-wrapper {';
			$custom_style .= implode(' ', $custom_css );
			$custom_style .= '}';
		}		
		
		if( ! empty( $title_bg_color ) ){
			$custom_css[] = 'background-color:'.$title_bg_color.';';
		}
		
		$title_bg_img 	= apply_filters( 'pls_title_bg_attachment' , $title_bg_img );
		$page_heading 	= apply_filters( 'pls_page_heading' , $page_heading );
		$breadcrumb 	= apply_filters( 'pls_page_breadcrumb' , $breadcrumb );
		$title_color	= apply_filters( 'pls_page_title_color' , $title_color );
		
		if( $page_heading || $breadcrumb  ) {
			$args 				= array();
			$class[]			= 'pls-page-title-'.$page_title_layout;
			$class[]			= 'title-size-'.$title_font_size;
			$class[]			= 'color-scheme-'.$title_color;
			$args['class']	 	= implode( ' ', array_filter( $class ) );
			$args['custom_css'] = '';
			$args['custom_css']	= implode( ' ', array_filter( $custom_css ) );
			pls_get_template( 'template-parts/page-title/page-title', $args );
		}
	}
endif;

if ( ! function_exists( 'pls_template_page_title' ) ) :

	/**
	 * PLS Template title.
	 */
	function pls_template_page_title() {
		
		$page_heading 		= pls_get_post_meta( 'page_heading' );
		$page_title_layout 	= pls_get_post_meta( 'page_title_layout' );		
		
		if( ! $page_heading || $page_heading == 'default' ){
			$page_heading = pls_get_option( 'page-heading', 1 );
			if( pls_is_catalog() ) {
				$page_heading = pls_get_option( 'shop-page-heading', 1 );
			}
		}elseif( $page_heading == 'enable' ){
			$page_heading = 1;
		}elseif( $page_heading == 'disable' ) {
				$page_heading = 0;
		}
		
		if( ! $page_title_layout || $page_title_layout == 'default' ){
			$page_title_layout = pls_get_option( 'page-title-layout', 'title-centered' );
		}
		if ( is_single() && 'post' == get_post_type() ) {
			$page_heading = false;
		}
		if( pls_is_catalog() ) {
			$page_title_layout = pls_get_option( 'shop-page-title-layout', 'center' );
		}
		$page_heading 	= apply_filters( 'pls_page_heading' , $page_heading );
		if( ! $page_heading ) { return; }

		pls_get_template( 'template-parts/page-title/title' );
	}
endif;

if ( ! function_exists( 'pls_template_breadcrumbs' ) ) :
	/**
	 * PLS template page breadcrumbs.
	 */
	function pls_template_breadcrumbs( $args = array() ) {
		$breadcrumb			= pls_get_post_meta('breadcrumb');
		
		if( ! $breadcrumb || $breadcrumb == 'default' ){
			$breadcrumb = pls_get_option( 'page-breadcrumb', 1 );
			if( pls_is_catalog() ) { 
				$breadcrumb = pls_get_option( 'shop-page-breadcrumb', 1 );
			}
		}elseif( $breadcrumb == 'enable' ){
			$breadcrumb = 1;
		}elseif( $breadcrumb == 'disable' ){
				$breadcrumb = 0;
		}
		if( is_tax() || is_tag() || is_category() || is_date() || is_author() ){
			$breadcrumb = pls_get_option( 'blog-page-breadcrumb', 1 );
		}
		if ( is_home()) {
			$breadcrumb = pls_get_option( 'blog-page-breadcrumb', 1 );
		}
		if( pls_is_catalog() ) {			
			$breadcrumb = pls_get_option( 'shop-page-breadcrumb', 1 );
		}
		$breadcrumb 	= apply_filters( 'pls_page_breadcrumb' , $breadcrumb );
		if( ! $breadcrumb ) return;

		$delimiter = pls_get_option( 'breadcrumbs-delimiter', 'greater-than' );
		
		// use yoast breadcrumbs if enabled
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$yoast_breadcrumbs = yoast_breadcrumb( '', '', false );
			yoast_breadcrumb( '<div class="entry-breadcrumbs">','</div>' );
			if ( $yoast_breadcrumbs ) {
				return $yoast_breadcrumbs;
			}
		}
		
		$args = wp_parse_args( $args, apply_filters( 'pls_breadcrumb_defaults', array(
			'wrap_before' 		=> '<nav class="pls-breadcrumb">',
			'wrap_after'  		=> '</nav>',
			'delimiter_before'	=> '<span class="pls-delimiter-sep pls-'.$delimiter.'">',
			'delimiter_after'	=> '</span>',
			'delimiter'   		=> '',
			'before'      		=> '',
			'after'       		=> '',
		) ) );
		$breadcrumbs = new PLS_Breadcrumb();
		 

		$args['breadcrumb'] = $breadcrumbs->generate();

		do_action( 'pls_breadcrumb', $breadcrumbs, $args );

		pls_get_template( 'template-parts/page-title/breadcrumbs',$args );
	}
endif;

if ( ! function_exists( 'pls_template_blog_category' ) ) :
	/**
	 * PLS Blog Archive Categories.
	 */
	function pls_template_blog_category() {
				
		if( ! pls_get_option( 'blog-archive-categories', 0 ) || ! pls_is_blog_archive() ){
			return;
		}
		
		global $wp_query;
		$cat_args 		= apply_filters('pls_blog_category_args',['number' => 10]);
		$categories 	= get_categories( $cat_args );
		
		if( empty( $categories ) ){
			return;
		}
		
		$current_cat_id = isset($wp_query->queried_object->term_id) ? $wp_query->queried_object->term_id : '' ;
		
		$current_active = false;
		$results = [];
		if( empty( $current_cat_id ) ){
			$current_active = true;
		}
		$results[0] = [
			'name' => esc_html__( 'All', 'pls-theme' ),
			'slug' => '',
			'term_id' => 0,
			'link' => get_permalink( get_option( 'page_for_posts' ) ),
			'current_active' => $current_active,
		];
		$current_active = false;		
		foreach( $categories as $cat){
			$cat_link = get_term_link( $cat );
			if($current_cat_id == $cat->term_id ){
				$current_active = true;
			}
			$results[$cat->term_id] = [
			'name' => $cat->name,
			'term_id' => $cat->term_id,
			'slug' => $cat->slug,
			'link' => $cat_link,
			'current_active' => $current_active,				
			];
			$current_active = false;
		}		
		$args['categories'] = apply_filters( 'pls_blog_category' , $results ) ;
		pls_get_template( 'template-parts/post-loop/blog-categories', $args );
	}
endif;

/**
 * Footer Subscribe
 */
if ( ! function_exists( 'pls_template_footer_subscribe' ) ) :

	/**
	 * PLS template footer.
	 */
	function pls_template_footer_subscribe() {
		$footer_subscribe 		= pls_get_post_meta( 'footer_subscribe' );
		
		if( ! $footer_subscribe || $footer_subscribe == 'default' ){
			$footer_subscribe 	= pls_get_option( 'footer-subscribe', 0 );				
		}elseif( $footer_subscribe == 'enable' ){
			$footer_subscribe 	= 1;
		}elseif( $footer_subscribe == 'disable' ){
			$footer_subscribe 	= 0;
		}
		$footer_subscribe = apply_filters('pls_footer_subscribe', $footer_subscribe );
		if( ! $footer_subscribe ){ return; }
		$args = array();
		$args['layout'] 		= pls_get_option( 'footer-subscribe-layout', 'centered' );
		$args['form_style'] 	= pls_get_option( 'subscribe-form-style', 'simple-form' );
		$args['field_shape'] 	= pls_get_option( 'subscribe-field-shape', 'shape-square' );
		$args['title'] 			= pls_get_option( 'footer-subscribe-title', esc_html__( 'Subscribe to Our Newsletter', 'pls-theme' ) );
		$args['subtitle'] 		= pls_get_option( 'footer-subscribe-subtitle', esc_html__( 'Subscribe today and get special offers, coupons and news.', 'pls-theme' ) );
		$args['class'] 			= 'footer-subscribe-'.$args['layout'] .' '. $args['form_style'] . ' ' .$args['field_shape'];
		
		pls_get_template( 'template-parts/footer/footer-subscribe', $args );
	}
endif;

/**
 * Footer Subscribe
 */
if ( ! function_exists( 'pls_template_footer_features_box' ) ) :

	/**
	 * PLS template footer.
	 */
	function pls_template_footer_features_box() {
		
		$footer_featurebox 		= pls_get_post_meta( 'footer_featurebox' );
		
		if( ! $footer_featurebox || $footer_featurebox == 'default' ){
			$footer_featurebox 	= pls_get_option( 'footer-features-box', 0 );				
		}elseif( $footer_featurebox == 'enable' ){
			$footer_featurebox 	= 1;
		}elseif( $footer_featurebox == 'disable' ){
			$footer_featurebox 	= 0;
		}
		
		$footer_featurebox = apply_filters('pls_footer_features_box', $footer_featurebox );
		
		if( ! $footer_featurebox ){ 
			return; 
		}
		
		$block_id = pls_get_option( 'footer-features-block', 0 );
		if( ! $block_id ){
			return;
		}
		echo pls_block_get_content($block_id);
	}
endif;
/**
 * Footer
 */
if ( ! function_exists( 'pls_template_footer' ) ) :

	/**
	 * PLS template footer.
	 */
	function pls_template_footer() {
		$footer_layout 			= pls_get_option( 'footer-layout', '3' );
		$footer_layout_data 	= pls_get_footer_layout( $footer_layout );
		$site_footer 			= pls_get_post_meta( 'site_footer' );
		$footer_copyright 		= pls_get_post_meta( 'footer_copyright' );
		$footer_block_id		= 0;
		if( ! $site_footer || $site_footer == 'default' ){
			$footer_style 			= pls_get_option( 'site-footer-style', 'predefined' );
			$footer_block_id 		= pls_get_option( 'footer-block-id', 0 );
		}elseif( $site_footer == 'none' ){
			$footer_style = 'none';
		}else{
			$footer_style		= 'custom-block';
			$footer_block_id	= $site_footer;
		}
		
		if( ! $footer_copyright || $footer_copyright == 'default' ){
			$footer_copyright = pls_get_option( 'footer-copyright', 1 );				
		}elseif( $footer_copyright == 'enable' ){
			$footer_copyright = 1;
		}elseif( $footer_copyright == 'disable' ){
				$footer_copyright = 0;
		}
		
		if( $footer_style == 'predefined' && ! pls_footer_widget_active() ){
			$footer_style = 'none';
		}
		
		$classes[]	= 'footer-layout-'.pls_get_option( 'footer-layout', '3' );
		if( pls_get_option( 'footer-widget-alignment', 0 ) ) {
			$classes[]	= 'text-center';
		}
		$classes[]	= 'footer-social-color-'.pls_get_option( 'footer-social-color', 'default' );
		
		$args['footer_classes'] 	= implode( ' ', $classes );
		$args['footer_style']		= $footer_style;
		$args['footer_block_id']	= $footer_block_id;
		$args['footer_copyright']	= $footer_copyright;
		$args['footer_layout_data']	= $footer_layout_data;
		
		pls_get_template( 'template-parts/footer/footer', $args );
	}
endif;

if ( ! function_exists( 'pls_template_footer_copyright' ) ) :

	/**
	 * PLS template footer copyright.
	 */
	function pls_template_footer_copyright() {
		$footer_copyright 		= pls_get_post_meta( 'footer_copyright' );
		
		if( ! $footer_copyright || $footer_copyright == 'default' ){
			$footer_copyright 	= pls_get_option( 'footer-copyright', 1 );				
		}elseif( $footer_copyright == 'enable' ){
			$footer_copyright 	= 1;
		}elseif( $footer_copyright == 'disable' ){
			$footer_copyright 	= 0;
		}
		
		if( ! $footer_copyright ){ return; }
		
		get_template_part( 'template-parts/footer/footer-copyright' );	
	}
endif;

if ( ! function_exists( 'pls_footer_widget_active' ) ) :
	/**
	 * Check is footer widget active
	 */
	function pls_footer_widget_active() {
		if ( is_active_sidebar( 'pls-footer-widget-1' ) 
			|| is_active_sidebar( 'pls-footer-widget-2' ) 
			|| is_active_sidebar( 'pls-footer-widget-3' ) 
			|| is_active_sidebar( 'pls-footer-widget-4' ) ){
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'pls_back_to_top' ) ) :

	/**
	 * Back to top button.
	 */
	function pls_back_to_top() {
		if( ! pls_get_option( 'back-to-top', 1 ) 
			|| ( wp_is_mobile() 
			&& ! pls_get_option( 'back-to-top-mobile', 1 ) ) ) {
				return; 
		}?>
		
		<div class="pls-back-to-top">
			<?php esc_html_e( 'Scroll To Top', 'pls-theme' );?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_mask_overaly' ) ) :

	/**
	 * Close sidebar popup.
	 */
	function pls_mask_overaly() {?>
	
		<div class="pls-mask-overaly"></div>
		
	<?php }
endif;

/**
 * Sidebar
 */
if ( ! function_exists( 'pls_get_sidebar' ) ) :

	/**
	 * Get the pls sidebar.
	 */
	function pls_get_sidebar() {
		get_sidebar();
	}
endif;

/**
 * Page
 */
if ( ! function_exists( 'pls_template_page_content' ) ) :

	/**
	 * PLS template page content.
	 */
	function pls_template_page_content() {
		get_template_part( 'template-parts/page/content');
	}
endif;

if ( ! function_exists( 'pls_template_page_comments' ) ) :

	/**
	 * PLS template page comments.
	 */
	function pls_template_page_comments() {
		get_template_part( 'template-parts/page/comments');
	}
endif;

/**
 * Post Loop
 */
if ( ! function_exists( 'pls_post_loop_start' ) ) :

	/**
	 * Post loop start.
	 */
	function pls_post_loop_start( $echo = true ) {
				
		ob_start();
		
		pls_get_template( 'template-parts/post-loop/loop-start.php' );

		if ( $echo ) {
			echo apply_filters( 'pls_post_loop_start', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'pls_post_loop_start', ob_get_clean() );
		}		
	}
endif;

if ( ! function_exists( 'pls_post_loop_end' ) ) :

	/**
	 * Post loop end.
	 */
	function pls_post_loop_end( $echo = true ) {
		
		ob_start();

		pls_get_template( 'template-parts/post-loop/loop-end.php' );

		if ( $echo ) {
			echo apply_filters( 'pls_post_loop_end', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'pls_post_loop_end', ob_get_clean() );
		}
	}
endif;

if ( ! function_exists( 'pls_post_wrapper' ) ) {

	/**
	 * Post wrapper.
	 */
	function pls_post_wrapper() {
		$output='<div class="entry-post">';
		echo apply_filters('pls_post_wrapper',$output);
	}
}

if ( ! function_exists( 'pls_post_wrapper_end' ) ) {

	/**
	 * Post wrapper end.
	 */
	function pls_post_wrapper_end() {
		$output='</div>';
		echo apply_filters('pls_post_wrapper_end',$output);
	}
}

if ( ! function_exists( 'pls_template_loop_post_highlight' ) ) {

	/**
	 * Loop post highlight format, sticky.
	 */
	function pls_template_loop_post_highlight() {
		get_template_part( 'template-parts/post-loop/highlight' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_thumbnail' ) ) {

	/**
	 * Loop post thumbnail.
	 */
	function pls_template_loop_post_thumbnail() {
		get_template_part( 'template-parts/post-loop/thumbnail' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_header' ) ) {

	/**
	 * Loop post header.
	 */
	function pls_template_loop_post_header() {
		get_template_part( 'template-parts/post-loop/header' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_category' ) ) {

	/**
	 * Loop post header category.
	 */
	function pls_template_loop_post_category() {
		get_template_part( 'template-parts/post-loop/category' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_title' ) ) {

	/**
	 * Loop post header title.
	 */
	function pls_template_loop_post_title() {
		get_template_part( 'template-parts/post-loop/title' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_meta' ) ) {

	/**
	 * Loop post header meta.
	 */
	function pls_template_loop_post_meta() {
		get_template_part( 'template-parts/post-loop/meta' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_content' ) ) {

	/**
	 * Loop post content.
	 */
	function pls_template_loop_post_content() {
		get_template_part( 'template-parts/post-loop/content' );		
	}
}

if ( ! function_exists( 'pls_template_loop_post_footer' ) ) {

	/**
	 * Loop post footer.
	 */
	function pls_template_loop_post_footer() {
		get_template_part( 'template-parts/post-loop/footer' );		
	}
}

if ( ! function_exists( 'pls_template_read_more_link' ) ) {

	/**
	 * Loop post readmore link.
	 */
	function pls_template_read_more_link() {
		get_template_part( 'template-parts/post-loop/readmore' );		
	}
}

if ( ! function_exists( 'pls_pagination' ) ) {

	/**
	 * Output the pagination.
	 */
	function pls_pagination() {
		get_template_part( 'template-parts/global/pagination' );
	}
}

if ( ! function_exists( 'pls_template_single_post_highlight' ) ) {

	/**
	 * Single post highlight format, sticky.
	 */
	function pls_template_single_post_highlight() {
		get_template_part( 'template-parts/single-post/highlight' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_thumbnail' ) ) {

	/**
	 * Single post thumbnail.
	 */
	function pls_template_single_post_thumbnail() {
		get_template_part( 'template-parts/single-post/thumbnail/thumbnail', get_post_format() );		
	}
}

if ( ! function_exists( 'pls_template_single_post_header' ) ) {

	/**
	 * Single post header.
	 */
	function pls_template_single_post_header() {
		get_template_part( 'template-parts/single-post/header' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_category' ) ) {

	/**
	 * Single post header category.
	 */
	function pls_template_single_post_category() {
		get_template_part( 'template-parts/single-post/category' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_title' ) ) {

	/**
	 * Single post header title.
	 */
	function pls_template_single_post_title() {
		get_template_part( 'template-parts/single-post/title' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_meta' ) ) {

	/**
	 * Single post header meta.
	 */
	function pls_template_single_post_meta() {
		get_template_part( 'template-parts/single-post/meta' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_content' ) ) {

	/**
	 * Single post content.
	 */
	function pls_template_single_post_content() {
		get_template_part( 'template-parts/single-post/content' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_footer' ) ) {

	/**
	 * Single post footer.
	 */
	function pls_template_single_post_footer() {
		get_template_part( 'template-parts/single-post/footer' );		
	}
}

if ( ! function_exists( 'pls_template_single_tag_social_share' ) ) {

	/**
	 * Single post Tags & Social share.
	 */
	function pls_template_single_tag_social_share() {
		
		$args = array();
		$args['is_tag_enable'] 		= pls_get_option( 'single-post-tag', 1 );
		$args['is_share_enable'] 	= pls_get_option( 'single-post-social-share-link', 1 );		
		$args['social_icons_style'] = pls_get_option( 'social-sharing-icons-style','icons-default' );
		$args['social_icons_size']  = pls_get_option( 'sharing-icons-size','icons-size-default' );
		
		pls_get_template( 'template-parts/single-post/tags-social-share', $args );		
	}
}

if ( ! function_exists( 'pls_template_single_post_author_bios' ) ) {

	/**
	 * Single post author bios.
	 */
	function pls_template_single_post_author_bios() {
		get_template_part( 'template-parts/single-post/author-bios' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_navigation' ) ) {

	/**
	 * Single post navigation.
	 */
	function pls_template_single_post_navigation() {
		get_template_part( 'template-parts/single-post/navigation' );		
	}
}

if ( ! function_exists( 'pls_template_single_post_related' ) ) {

	/**
	 * Single related posts.
	 */
	function pls_template_single_post_related( $args = array() ) {
		
		if ( ! pls_get_option( 'single-post-related', 0 ) ) { return; }
		
		$post_id = get_the_id();
		$taxonomy = pls_get_option( 'related-posts-taxonomy', 'post_tag' );
		
		$defaults = array (
			'post_type'     	 	=> 'post',
			'post_status' 			=> array( 'publish' ),
			'ignore_sticky_posts'	=> true,
			'post__not_in' 			=> array($post_id),
			'showposts' 			=> pls_get_option( 'single-posts-related', 6 ),
			'orderby' 				=> pls_get_option( 'related-posts-orderby', 'rand' ),
			'order' 				=> pls_get_option( 'related-posts-order', 'DESC' ),
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		$taxs = get_the_terms($post_id, $taxonomy);
		
		if ( $taxs ) {
			$tax_ids = array();
			foreach( $taxs as $tag ) $tax_ids[] = $tag->term_id;			
		}

		if( !empty($tax_ids) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'id',
					'terms' => $tax_ids
				)
			);
		}
		
		$query 	= new WP_Query( apply_filters( 'pls_related_posts_args', $args ) );
		
		$args['related_posts'] = $query;
		
		$unique_id = pls_uniqid( 'section-' );
		$slider_data = [
				'slides_to_show'		=> 2,			
				'slides_to_show_tablet'	=> 2,			
				'slides_to_show_mobile'	=> 1,
			];
		pls_set_loop_prop( 'slider_options', pls_slider_attributes( $slider_data) );
		$args['unique_id'] = $unique_id;
		// Set global loop values.
		pls_set_loop_prop( 'name', 'related-posts' );
		pls_set_loop_prop( 'unique_id', $unique_id );
		pls_set_loop_prop( 'products-columns', 2 );
		pls_set_loop_prop( 'slides_to_show', 2 );
		pls_set_loop_prop( 'slides_to_show_tablet', 2 );
		pls_set_loop_prop( 'slides_to_show_mobile', 1 );
		pls_set_loop_prop( 'slider_navigation', 1 );
		pls_set_loop_prop( 'slider_dots', 1 );
		pls_set_loop_prop( 'blog-custom-thumbnail-size', 'medium' );
		pls_set_loop_prop( 'specific-post-meta', array( 'post-author', 'post-date' ) );
		pls_set_loop_prop( 'show-blog-post-content', 0 );
		pls_set_loop_prop( 'read-more-button', 0 );
		
		pls_get_template( 'template-parts/single-post/related.php', $args );		
	}
}

if ( ! function_exists( 'pls_template_single_post_comments' ) ) {

	/**
	 * Single post comments.
	 */
	function pls_template_single_post_comments() {
		get_template_part( 'template-parts/single-post/comments' );		
	}
}

/**
 * Get HTML for a gallery image.
 *
 * @return string
 */
function pls_get_gallery_image_html( $attachment_id, $thumbnail_size, $gallery_style = '' ) {	
	$grid_classes	='';
	if( $gallery_style == 'grid' ){
		$grid_classes = 'col-12 col-sm-6';
	}elseif( $gallery_style == 'one-column' ){
		$grid_classes = 'col-12 col-sm-12';
	}elseif( $gallery_style == 'slider' ){
		$grid_classes = 'swiper-slide';
	}
	
	$grid_classes	= apply_filters( 'pls_post_gallery_grid_classes', $grid_classes );
	$full_size		= apply_filters( 'pls_post_gallery_full_size', 'full' );
	$full_src       = wp_get_attachment_image_src( $attachment_id, $full_size );
	$image     		= wp_get_attachment_image( $attachment_id, $thumbnail_size );
	
	return '<div class="pls-post-gallery__image '.$grid_classes.'"><a href="' . esc_url( $full_src[0] ) . '" data-elementor-open-lightbox="no">' . $image . '</a></div>';
}

if ( ! function_exists( 'pls_newsletter_popup' ) ) {
	
	/**
	 * Newsletter Popup.
	 */
	function pls_newsletter_popup(){
		
		if( ( ! pls_get_option( 'newsletter-popup', 0 ) ) || 
			( 'front-page' == pls_get_option( 'newsletter-popup-on', 'all-pages' ) && !is_front_page() ) ) {
			return; 
		}
		
		$tag_line 				= pls_get_option( 'newsletter-tag-line', 'Sign up to get all the latest fashion news, website updates, offers and promos.' );
		$newsletter_layout 		= 'pls-'.pls_get_option( 'newsletter-layout', 'banner-left' );
		$banner 				= pls_get_option( 'newsletter-banner', array( 'url' => PLS_ADMIN_IMAGES.'newsletter-banner.jpg' ) );
		$form_style 			= pls_get_option( 'newsletter-form-style', 'simple-form' );
		$field_shape 			= pls_get_option( 'newsletter-field-shape', 'shape-square' );
		$class 					= $newsletter_layout. ' '.$form_style . ' ' .$field_shape ;
		$dont_show_text 		= pls_get_option( 'newsletter-dont-show', 'Do not show this window' );
		?>
		<div class="pls-newsletter-popup mfp-hide">		
			<div class="pls-newsletter-wrap <?php echo esc_attr( $class ); ?> style-2 field-shape-square">
				<?php if( 'pls-banner-left' == $newsletter_layout || 'pls-banner-right' == $newsletter_layout ){ ?>
					<div class="pls-newsletter-banner">
						<img src="<?php echo esc_url( $banner['url'] );?>" alt="<?php esc_attr_e( 'Newsletter Banner', 'pls-theme' );?>" />
					</div>
				<?php } ?>
				<div class="pls-newsletter-content">
					<?php $newsletter_logo = pls_get_option( 'newsletter-logo' );
					if( ! empty( $newsletter_logo ) ):?>
						<div class="newsletter-logo">
							<img src="<?php echo esc_url( $newsletter_logo['url'] );?>" alt="<?php esc_attr_e( 'logo', 'pls-theme' );?>">
						</div>
					<?php endif;?>					
					<h2 class="pls-newsletter-title"><?php echo esc_html( pls_get_option( 'newsletter-title', 'Join the our family' ) );?></h2>
					<p class="tag-line"><?php echo do_shortcode( $tag_line );?></p>
					<div class="newsletter-form">
						<?php if( function_exists( 'mc4wp_show_form' ) ) {
							mc4wp_show_form();
						}						
						if( !empty( $dont_show_text ) ){ ?>
							<div class="checkbox-group form-group-top clearfix">
							  <input type="checkbox" id="newsletter-donotshow" value="do-not-show">
							  <label for="newsletter-donotshow"> 
								<span class="check"></span>
								<span class="box"></span>
								<?php echo esc_html( $dont_show_text );?>
							  </label>
							</div>
						<?php } ?>
					</div>
				</div>				
			</div>  	  
		</div>
		<?php
	}
}

if ( ! function_exists( 'pls_coming_soon_redirect' ) ) {	
	/**
	 *  Comming Soon
	 */
	function pls_coming_soon_redirect(){
		
		$is_maintenance 	= pls_get_option( 'maintenance-mode', 0 );
		$maintenance_page 	= pls_get_option( 'maintenance-page', 0 );
		
        // Dont't show coming soon page if not coming soon mode on or  is user logged in.
        if ( is_user_logged_in() || !$is_maintenance ) {
            return;
        }
		
		if (!is_page( $maintenance_page ) && $is_maintenance && $maintenance_page && !current_user_can('edit_posts') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ){
            wp_redirect( esc_url( home_url( 'index.php?page_id='.$maintenance_page) ) );
            exit();
        }
	}
}

if ( ! function_exists( 'pls_mobile_bottom_navbar' ) ) {	
	/**
	 * Mobile Bottom Navbar.
	 */
	function pls_mobile_bottom_navbar(){
		
		if( ! apply_filters( 'pls_mobile_bottom_navbar', true ) || ! pls_get_option( 'mobile-bottom-navbar', 0 ) ) {
			return; 
		}
		
		$mobile_elemets = pls_get_option( 'mobile-navbar-elements',  array(
                    'enabled'  => array(
                        'shop'  		=> esc_html__( 'Shop', 'pls-theme' ),
						'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'pls-theme' ),
						'wishlist' 		=> esc_html__( 'Wishlist', 'pls-theme' ),
						'cart'     		=> esc_html__( 'Cart', 'pls-theme' ),
						'account'  		=> esc_html__( 'Account', 'pls-theme' ),				
                    ) ) );
		
		if ( isset( $mobile_elemets['enabled']['placebo'] ) ) {
			unset( $mobile_elemets['enabled']['placebo'] );
		}
		
		if( empty( $mobile_elemets['enabled'] ) ){
			return;
		}
		$args 					= array();
		$args['navbar_class']	= ( !pls_get_option( 'mobile-navbar-label', 1 ) ) ? ' navbar-label-hide' : '';
		$args['navbar_class']	.= ' pls-bottom-navbar-color-'.pls_get_option( 'mobile-bottom-navbar-color', 'dark' );
		
		foreach ( $mobile_elemets['enabled'] as $element => $value ) {
			$element_args = array();
			switch ( $element ) {
				case 'shop':
					if ( ! function_exists( 'is_shop' ) ) {
						continue 2;
					}
					$element_args['link'] 	= get_permalink( get_option( 'woocommerce_shop_page_id' ) );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-shop', 'picon-home' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-label-shop', esc_html__( 'shop', 'pls-theme' ) );
					$element_args['class'] 	= 'item-shop';					
					break;
				case 'wishlist':
					if ( ! function_exists( 'YITH_WCWL' ) ) {
						continue 2;
					}		
					$wishlist_page_id 		= get_option( 'yith_wcwl_wishlist_page_id' );
					$wishlist_url 			= YITH_WCWL()->get_wishlist_url();
					$element_args['link'] 	= apply_filters('pls_myaccount_wishlist_url', $wishlist_url );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-wishlist', 'picon-heart' );
					$element_args['count'] 	= YITH_WCWL()->count_products();
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-wishlist',esc_html__( 'Wishlist', 'pls-theme' ) );
					$element_args['class'] 	= 'item-wishlist';					
					if ( is_page( $wishlist_page_id ) ) {
						$element_args['class'] .= ' active';
					}
					break;			
				case 'cart':
					if( ! PLS_WOOCOMMERCE_ACTIVE || pls_get_option( 'catalog-mode', 0 ) || ( ! is_user_logged_in() && pls_get_option( 'login-to-see-price', 0 ) ) ){
						continue 2;
					}					
					$element_args['link'] 	= wc_get_cart_url();
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-cart', 'picon-handbag' );
					$element_args['count'] 	= WC()->cart->get_cart_contents_count();
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-cart', esc_html__( 'Cart', 'pls-theme' ) );
					$element_args['class'] 	= 'item-cart pls-header-cart';
					if ( function_exists( 'is_cart' ) && is_cart() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'account':
					if( ! PLS_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$element_args['link'] 	= get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-account', 'picon-user' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-account', esc_html__( 'Account', 'pls-theme' ) );
					$element_args['class'] 	= 'item-account';	
					if( ! is_user_logged_in() ){
						$element_args['class'] 	.= ' customer-signinup';	
					}
					if ( is_account_page() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'home':
					$element_args['link'] 	= home_url( '/' );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-home', 'picon-home' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-home', esc_html__( 'Home', 'pls-theme' ));
					$element_args['class'] 	= 'item-home';					
					if ( is_front_page() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'menu':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-menu', 'picon-menu' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-menu', esc_html__( 'Menu', 'pls-theme' ) );
					$element_args['class'] 	= 'item-menu navbar-toggle';					
					break;
				case 'category':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-category', 'picon-categories' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-category', esc_html__( 'Category', 'pls-theme' ) );
					$element_args['class'] 	= 'item-category';					
					break;
				case 'compare':
					if ( ! class_exists( 'YITH_Woocompare' ) ) {
						continue 2;
					}
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-compare', 'picon-shuffle' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-compare', esc_html__( 'Compare', 'pls-theme' ) );
					$element_args['class'] 	= 'yith-woocompare-open';					
					break;
				case 'sidebar':
					if( 'full-width' == pls_get_layout() || ! pls_get_option( 'sidebar-canvas-mobile', 1 ) ) {
						continue 2;
					}
					if( pls_is_catalog() ){												
						$element_args['link'] 	= '#';
						$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-filter', 'picon-equalizer' );
						$element_args['label'] 	= pls_get_option('mobile-navbar-label-filter', esc_html__( 'Filters', 'pls-theme' ) );
						$element_args['class'] 	= 'item-sidebar canvas-sidebar-icon';
					}else{						
						$element_args['link'] 	= '#';
						$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-sidebar', 'picon-sidebar' );
						$element_args['label'] 	= pls_get_option('mobile-navbar-label-sidebar', esc_html__( 'Sidebar', 'pls-theme' ) );
						$element_args['class'] 	= 'item-sidebar canvas-sidebar-icon';
					}						
					break;
				case 'search':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-search', 'picon-magnifier' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-search', esc_html__( 'Search', 'pls-theme' ) );
					$element_args['class'] 	= 'item-search search-icon-text';					
					break;
				case 'order':
					if( ! PLS_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$orders  = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
					$account_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					if ( substr( $account_page_url, - 1, 1 ) != '/' ) {
						$account_page_url .= '/';
					}
					$orders_url   			= $account_page_url . $orders;					
					$element_args['link'] 	= apply_filters('pls_myaccount_orders_url', $orders_url  );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-order', 'picon-letter' );
					$element_args['label'] 	= pls_get_option('mobile-navbar-label-order', esc_html__( 'Order', 'pls-theme' ) );
					$element_args['class'] 	= 'item-order';	
					break;
				case 'order-tracking':
					if( ! PLS_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$tracking_pageid		= pls_get_option( 'order-tracking-page', '' );
					if( empty( $tracking_pageid ) ){
						continue 2;
					}
					$order_tracking_url		= apply_filters('pls_myaccount_order_tracking_url', ( ! empty ( $tracking_pageid ) ) ? get_permalink( $tracking_pageid ) : '' );
					$element_args['link'] 	= $order_tracking_url;
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-order-tracking', 'picon-plane' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-label-order-tracking', esc_html__( 'Order Tracking', 'pls-theme' ) );
					$element_args['class'] 	= 'item-order';					
					break;
				case 'blog':
					$element_args['link'] 	= get_permalink( get_option( 'page_for_posts' ) );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-label-icon-blog', 'picon-note' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-label-blog', esc_html__( 'Blog', 'pls-theme' ) );
					$element_args['class'] 	= 'item-blog';					
					break;
				case 'custom_link1':
					$element_args['link'] 	= pls_get_option( 'mobile-navbar-custom-link1-url', '' );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-custom-link1-icon', '' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-custom-link1-label' );
					$element_args['class'] 	= 'item-custom-link1';					
					break;
				case 'custom_link2':
					$element_args['link'] 	= pls_get_option( 'mobile-navbar-custom-link2-url', '' );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-custom-link2-icon', '' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-custom-link2-label' );
					$element_args['class'] 	= 'item-custom-link2';					
					break;
				case 'custom_link3':
					$element_args['link'] 	= pls_get_option( 'mobile-navbar-custom-link3-url', '' );
					$element_args['icon'] 	= pls_get_option( 'mobile-navbar-custom-link3-icon', '' );
					$element_args['label'] 	= pls_get_option( 'mobile-navbar-custom-link3-label' );
					$element_args['class'] 	= 'item-custom-link3';					
					break;
			}
			$args['elements'][$element] = apply_filters( 'pls_mobile_bottom_navbar_element'.$element, $element_args );
			
		}
		
		if( empty( $args['elements'] ) ) { 
			return;
		}
		
		pls_get_template( 'template-parts/mobile/mobile-bottom-navbar.php', $args );			
	}
}

if ( ! function_exists( 'pls_promo_bar' ) ) {
	/**
	 * Promo bar
	 */
	function pls_promo_bar() {
		
		if( ( pls_get_option( 'promo-bar-close-btn', 1 ) && pls_get_option( 'promo-bar-dismiss', 0 ) && isset( $_COOKIE['pls_promo_bar_close'] ) ) ){
			return; 
		}
			
		$args = array();
		
		$args['promo_position'] 			= pls_get_option( 'promo-bar-position', 'top' );
		$args['promo_position_type'] 		= pls_get_option( 'promo-bar-position-type', 'absolute' );
		$args['promo_message'] 				= pls_get_option( 'promo-bar-message-text', esc_html__( 'SUMMER SALE, Get 40% Off for all products.', 'pls-theme' ) );
		$args['promo_link_btn'] 			= pls_get_option( 'promo-bar-link-btn', 0 );
		$args['promo_link_text'] 			= pls_get_option( 'promo-bar-link-btn-text', esc_html__( 'Click Here', 'pls-theme' ) );
		$args['promo_link_url'] 			= pls_get_option( 'promo-bar-link-btn-url', '#' );
		$args['promo_link_open_new_tab'] 	= pls_get_option( 'promo-bar-link-open-new-tab', 0 ) ;
		$args['promo_close_btn']			= pls_get_option( 'promo-bar-close-btn', 1 ) ;
		$args['promo_dismiss_class'] 		= '' ;
		$args['target'] 					= '_self' ;
		
		if( pls_get_option( 'promo-bar-dismiss', 0 ) ){
			$args['promo_dismiss_class'] = 'promo-bar-dismiss' ;
		}
		
		if( pls_get_option( 'promo-bar-link-open-new-tab', 0 ) ){
			$args['target'] = '_blank' ;
		}
		
		pls_get_template( 'template-parts/promo-bar/promo-bar', $args );
	}
}