<?php 
/**
 * Functions to allow styling of the templating system
 *
 * General core functions available on both the front-end and admin.
 *
 * @package /inc
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Adds custom classes to the array of body classes.
 */
function pls_body_woocommerce_classes( $classes ) {
	
	if(  pls_is_catalog() ) {
		$classes[] = 'pls-catalog-page';
		if(  pls_get_option( 'shop-page-off-canvas-sidebar', 0 ) ){
			$classes[] = 'pls-off-canvas-sidebar';
		}
		if(  pls_get_option( 'ajax-filter', 0 ) ){
			$classes[] = 'pls-catalog-ajax-filter';
		}		
	}
	
	if( is_product() && pls_get_option( 'single-product-quick-buy', 0 ) ) {
		$classes[] = 'pls-single-product-quick-buy';
	}
	
	if( is_cart() && pls_get_option( 'cart-auto-update', 1 ) ) {
		$classes[] = 'has-auto-update-cart';
	}
	
	$classes = apply_filters( 'pls_body_woocommerce_classes', $classes );
	
	return $classes;
}

/**
 * Product loop row classes
 */
if ( ! function_exists( 'pls_product_row_classes' ) ):
	function pls_product_row_classes(){
		
		$product_style 		= pls_get_loop_prop( 'product-style' );
		$products_columns 	= pls_get_loop_prop( 'products-columns' );
		$classes[]	 		= 'products-wrap';
		$classes[] 			= $product_style;
		
		if( $product_style == 'product-style-widget' ){
			return implode( ' ', $classes );
		}
		
		if( pls_get_loop_prop( 'name' ) == 'pls-slider' ){
			$classes[] 		= 'grid-view';
			$classes[] 		= 'swiper-wrapper';
			$classes[] 		= 'slider-col-lg-'.pls_get_loop_prop( 'slides_to_show' );
			$classes[] 		= 'slider-col-md-'.pls_get_loop_prop( 'slides_to_show_tablet' );
			$classes[] 		= 'slider-col-'.pls_get_loop_prop( 'slides_to_show_mobile' );
		}else{			
			$classes[] 		= 'row';	
			if( 'grid-list' == pls_get_loop_prop( 'products_view' ) || 'list-view' == pls_get_loop_prop( 'products_view' ) ){
				$classes[] 		= 'list-view';
			}else{
				$classes[] 		= 'grid-view';
			}	
			$classes[] 	= 'grid-col-lg-'.pls_get_products_columns();			
			$classes[] 	= 'grid-col-md-'.pls_get_loop_prop( 'products-columns-tablet' );
			$classes[] 	= 'grid-col-'.pls_get_loop_prop( 'products-columns-mobile' );
		}
		
		if ( pls_get_option( 'catalog-mode', 0 ) || ! pls_get_option( 'product-price' , 1 ) || ! pls_get_option( 'product-buttons', 1 ) || ! pls_get_option( 'product-cart-button', 1 ) || ( ! is_user_logged_in() && pls_get_option( 'login-to-see-price', 0 ) ) ) {
			$classes[] 	= 'pls-add-to-cart-button-effect-none';
		}
		
		$classes = apply_filters( 'pls_product_row_classes', $classes );
		
		return implode( ' ', $classes );
	}
endif;

/**
 * Product loop classes
 */
if( ! function_exists( 'pls_product_loop_classes' ) ):
	function pls_product_loop_classes() {
		$classes = array();		
		if( pls_get_loop_prop( 'name' ) == 'pls-slider' ){
			$rows 			= pls_get_loop_prop( 'product_rows' );
			if( $rows <= 1  ){
				$classes[] = 'swiper-slide';
			}		
		}
		return apply_filters( 'pls_product_loop_classes', $classes );
	}
endif;

/**
 * Product classes
 */
function pls_woocommerce_product_class ( ){
	$classes = [];
	$product_content_layout = pls_get_post_meta( 'single_product_content_layout' );
	if( ! $product_content_layout || 'default' == $product_content_layout ) {
		$product_content_layout = pls_get_option( 'single-product-content-layout', 'style-1' );
	}
	
	$product_content_fullwidth = pls_get_post_meta( 'product_content_fullwidth' );
	if( ! $product_content_fullwidth || 'default' == $product_content_fullwidth ) {
		$product_content_fullwidth = pls_get_option( 'product-content-fullwidth', 0 );
	}elseif( $product_content_fullwidth == 'enable' ){
		$product_content_fullwidth = true;
	}elseif( $product_content_fullwidth == 'disable' ){
			$product_content_fullwidth = false;
	}
	
	$product_content_background = pls_get_post_meta( 'product_content_background' );
	if( ! $product_content_background || 'default' == $product_content_background ) {
		$product_content_background = pls_get_option( 'product-content-background', 'none' );
	}	
	if( 'custom' == $product_content_background || 'dark' == $product_content_background ){
		$has_product_content_background = true;
	}elseif( 'none' == $product_content_background ){
			$has_product_content_background = false;
	}
	
	if ( 'product-gallery-horizontal' == pls_get_product_gallery_style() ){
		$product_content_layout = 'style-4';
	}
	
	$classes[]		= 'pls-single-product-page';
	$classes[]		= 'pls-product-content-'. $product_content_layout;
	$classes[]		= ( $product_content_fullwidth ) ? 'pls-product-content-fullwidth' : '';
	$classes[]		= ( $has_product_content_background ) ? 'pls-product-content-background' : '';
	$classes[]		= ( 'dark' == $product_content_background ) ? 'pls-dark-mode' : '';
	$classes[]		= pls_get_product_gallery_style();
	
	return $classes;
}

/**
 * Adds extra post classes for products.
 *
 * @return array
 */
function pls_get_product_gallery_style() {
	
	$product_layout = pls_get_post_meta( 'product_gallery_style' );
	if( ! $product_layout ){
		$product_layout = pls_get_option( 'product-gallery-style', 'product-gallery-left' );			
	}	
	return $product_layout;
}

/**
 * Mini Cart Slide
 */
if( ! function_exists( 'pls_minicart_slide' ) ) :
	function pls_minicart_slide(){
	
		if ( 'slider' != pls_get_option( 'header-minicart-popup', 'slider' ) ){ return; }
		
		$color_mode		= '';
		if( 'dark-mode' == pls_get_option( 'header-minicart-slider-color-mode', 'light-mode' ) ) {
			$color_mode = 'pls-'.pls_get_option( 'header-minicart-slider-color-mode', 'light-mode' );
		}?>		
		<div class="pls-minicart-slide <?php echo esc_attr( $color_mode );?>">
			<div class="pls-minicart-header">
				<h3 class="minicart-title"><?php echo apply_filters( 'pls_mini_cart_header_text', esc_html__( 'Your Cart','pls-theme' ) );?> <span class="pls-minicart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span> </h3>
				<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'pls-theme' ); ?></a>
			</div>
			<div class="woocommerce widget_shopping_cart">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart();?>
				</div>
			</div>
		</div>
		<?php
	}
endif;

/**
 * Canvas Sidebar
 */
if( ! function_exists( 'pls_canvas_sidebar' ) ) :
	function pls_canvas_sidebar() {
		
		if( 'full-width' == pls_get_layout() || ! pls_get_option( 'sidebar-canvas-mobile', 1 ) ) {
			return;
		}
		if( pls_get_option( 'mobile-bottom-navbar', 0 ) ){
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
				return;
			}
		}?>
		
		<div class="pls-canvas-sidebar">
			<div class="canvas-sidebar-icon"><?php esc_html_e( 'Sidebar', 'pls-theme' )?></div>
		</div>
		<?php
	}
endif;

/**
 * User Login Signup Popup
 */
if( ! function_exists( 'pls_login_signup_popup' ) ) :
	function pls_login_signup_popup() {
		
		if( !pls_get_option( 'show-login-register-popup', 1 ) ){
			return;
		}
		if ( ! shortcode_exists( 'woocommerce_my_account' ) || is_user_logged_in() ) {
			return;
		}
		if( is_account_page() || is_checkout() || is_page('vendor-registration') ){
			return;
		} ?>	
		<div id="pls-login-register-popup" class="pls-login-register-popup mfp-hide">
			<?php echo do_shortcode( '[woocommerce_my_account]' ); ?>
		</div>
		<?php
	}
endif;

/** 	
 * Ajax Count Wishlist Product
 */
if( ! function_exists( 'pls_ajax_wishlist_count' ) ) :
	function pls_ajax_wishlist_count() {
		if( function_exists( 'YITH_WCWL' ) ){
			wp_send_json( YITH_WCWL()->count_products() );
			die();
		}
	}
endif;

/* 	Ajax Count Compare Product
/* --------------------------------------------------------------------- */
if( ! function_exists( 'pls_ajax_compare_count' ) ) :
	function pls_ajax_compare_count(){
		
		if( defined( 'YITH_WOOCOMPARE' ) ){	
			$products_list=array();
			$products_list = isset( $_COOKIE[ 'yith_woocompare_list' ] ) && !empty($_COOKIE[ 'yith_woocompare_list' ]) ? maybe_unserialize( $_COOKIE[ 'yith_woocompare_list' ] ) : array();
			$products_list= json_decode($products_list);
			if (!empty($products_list) && $products_list > 0) {
				
				if( isset( $_REQUEST['id'] ) ) {
					if ( $_REQUEST['id'] == 'all' ) {
						unset($products_list);
					} else {
						$products_list=array_diff($products_list, array($_REQUEST['id']));
					}
				}			
				
				echo count($products_list);
			} else {
				echo '0';
			}
		}
		die();
	}
endif;

/** 	
 * Ensure cart contents update when products are added to the cart via AJAX
 */
if( ! function_exists( 'pls_cart_data' ) ) :
	add_filter('woocommerce_add_to_cart_fragments', 'pls_cart_data', 30);
	function pls_cart_data( $array ) {
		$count  		= WC()->cart->get_cart_contents_count();
		$cart_count 	= '<span class="pls-header-cart-count">'.WC()->cart->get_cart_contents_count().'</span>';
		$cart_total 	= '<span class="pls-header-cart-total">'.WC()->cart->get_cart_subtotal().'</span>';
		$cart_item_text = '<span class="pls-header-cart-item-text">'.WC()->cart->get_cart_contents_count().' '._n( 'item', 'items', $count, 'pls-theme' ).'</span>';
		$mini_cart_count 	= '<span class="pls-minicart-count">('.WC()->cart->get_cart_contents_count().')</span>';
		$array['span.pls-header-cart-count'] 		= $cart_count;
		$array['span.pls-header-cart-total'] 		= $cart_total;
		$array['span.pls-header-cart-item-text'] 	= $cart_item_text;
		$array['span.pls-minicart-count'] 			= $mini_cart_count;
		
		return $array;
	}
endif;

if( ! function_exists( 'pls_empty_mini_cart_button' ) ) :
	/** 	
	 * Empty Mini Cart Shop Button
	 */
	function pls_empty_mini_cart_button(){?>
	<p class="woocommerce-empty-mini-cart__buttons">
		<a class="button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php echo apply_filters( 'pls_woocommerce_empty_mini_cart_button_text', esc_html__( 'Continue Shopping', 'pls-theme' ) );?></a>
	</p>
	<?php }
endif;

if ( ! function_exists( 'pls_shop_page_categories' ) ) :
	/**
	 * PLS template page breadcrumbs.
	 */
	function pls_shop_page_categories() {
			
		global $wp_query;
		$args 		= ['taxonomy' => 'product_cat', 'hide_empty ' => pls_get_option( 'shop-page-hide-empty-category', 0 ), 'parent' => 0, 'number' => pls_get_option( 'shop-page-categories-limit', 6 )];
		
		$current_cat_id = isset( $wp_query->queried_object->term_id ) ? $wp_query->queried_object->term_id : 0 ;
		
		if( pls_get_option( 'shop-page-current-child-cat', 0 ) ){
			$args['parent'] = $current_cat_id;
		}
		
		if( !empty( pls_get_option( 'shop-page-selected-categories', [] ) )  ){
			unset($args['parent']);
			$args['include'] = pls_get_option( 'shop-page-selected-categories', [] );
		}
		if( !empty( pls_get_option( 'shop-page-exculde-categories', [] ) )  ){
			$args['exclude'] = pls_get_option( 'shop-page-exculde-categories', [] );
		}
		$cat_args 		= apply_filters( 'pls_shop_page_category_args', $args );
		$categories 	= get_categories( $cat_args );
		if( empty( $categories ) ){
			return;
		}
		$current_active = false;
		$results 		= [];			
		foreach( $categories as $cat ){
			$cat_link = get_term_link( $cat );
			if( $current_cat_id == $cat->term_id ){
				$current_active = true;
			}
			$results[$cat->term_id] = [
				'name' 		=> $cat->name,
				'term_id' 	=> $cat->term_id,
				'slug' 		=> $cat->slug,
				'link' 		=> $cat_link,
				'current_active' => $current_active,				
			];
			$current_active = false;
		}		
		$categories 	= apply_filters( 'pls_shop_page_categories' , $results ) ;
		$shop_cat_style = pls_get_option( 'shop-page-categories-style', 'cate-with-image' );
		$cat_class	   	= ' pls-'.$shop_cat_style; 
		$slider_wrap	= $swiper_slide = '';
		if( $shop_cat_style != 'only-link' ){
			$cat_class	   .=	' slider-col-lg-6 slider-col-md-4 slider-col-3'; 
			$cat_class	   .=	' swiper-wrapper'; 
			$cat_slider_data		= array(
				'slider_loop'			=> false,
				'slider_navigation'		=> 'yes',
				'slider_dots'			=> false,
				'slides_to_show' 		=> 6,
				'slides_to_show_tablet'	=> 4,
				'slides_to_show_mobile' => 2,
			);
			$slider_data 		= shortcode_atts( pls_slider_options(), $cat_slider_data );
			$slider_wrap	= ' pls-slider swiper row';
			$swiper_slide .= ' swiper-slide';
		}
		?>
		
		<div class="pls-shop-categories <?php echo esc_attr($slider_wrap); ?>">
			<ul class="pls-products-categories <?php echo esc_attr( $cat_class );?>" <?php if( $shop_cat_style != 'only-link' ){ ?>data-slider_options="<?php echo esc_attr( pls_slider_attributes($slider_data) ); ?>" <?php } ?>>
				<?php foreach ( $categories as $key => $data ) {
					$class = 'product-category cat-item-'.$key;
					if( $data['current_active'] ){
						$class .= ' has-current';
					}
					$class .= ' pls-underline';
					$class .= $swiper_slide;
					
					if( $shop_cat_style == 'cate-with-image' ) {
						$thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
						$thumb_url = wp_get_attachment_url( $thumbnail_id ); ?>
						<li class="<?php echo esc_attr( $class ); ?>">							 
							<?php if( $thumb_url ){ ?>
								<div class="product-cat-image">
									<img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($data['name']); ?>" />
								</div>
							<?php } ?>
							<div class="product-cat-title">
								<a class="product-cat-link" href="<?php echo esc_url( $data['link'] );?>">
									<?php echo esc_html( $data['name'] );?>
								</a>
							</div>
						</li>
					<?php } elseif( $shop_cat_style == 'cate-with-icon' ) {
						$thumbnail_id 	= get_term_meta( $key, PLS_PREFIX.'category_icon', true );
						$thumb_url 		= wp_get_attachment_url( $thumbnail_id ); ?>
						<li class="<?php echo esc_attr( $class ); ?>">
							<?php if( $thumb_url ){ ?>
								<div class="product-cat-image">
									<img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($data['name']); ?>" />
								</div>
							<?php } ?>
							<div class="product-cat-title">
								<a class="product-cat-link" href="<?php echo esc_url( $data['link'] );?>">
									<?php echo esc_html( $data['name'] );?>
								</a>
							</div>
						</li>
					<?php } else { ?>
						<li class="<?php echo esc_attr( $class ); ?>">
							<div class="product-cat-title">
								<a class="product-cat-link" href="<?php echo esc_url( $data['link'] );?>">
									<?php echo esc_html( $data['name'] );?>
								</a>
							</div>
						</li>
					<?php }
				} ?>
			</ul>
		</div>
	<?php }	
endif;

if( ! function_exists( 'pls_checkout_steps' ) ) :
	/** 	
	 * Checkout Progress Steps
	 */
	function pls_checkout_steps(){	
				
		$step = 1;
		if( is_checkout() ){
			$step = 2;
		}
		if( is_order_received_page() ){
			$step = 3;
		}?>
		
		<ul class="pls-chekout-steps">
			<li class="step <?php echo esc_attr( $step == 1 ) ? 'current' : ''; ?>">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<span><?php esc_html_e( 'Shopping Cart', 'pls-theme' ); ?></span>
				</a>
			</li>
			<li class="step <?php echo esc_attr( $step == 2 ) ? 'current' : ''; ?>">
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
					<span><?php esc_html_e( 'Checkout', 'pls-theme' ); ?></span>
				</a>
			</li>
			<li class="step <?php echo esc_attr( $step == 3 ) ? 'current' : ''; ?>">
				<span><?php esc_html_e( 'Order Complete', 'pls-theme' ); ?></span>
			</li>
		</ul>
		<?php
	}
endif;

/**
 * Shop Loop Header
 */
if( ! function_exists( 'pls_woocommerce_before_shop_loop' ) ) :
	function pls_woocommerce_before_shop_loop(){ 
		
		if( pls_get_loop_prop( 'is_shortcode' ) ){
			return;
		} ?>
		<div class="pls-products-header">
			<div class="pls-products-header-left">
				<?php 
				/**
				 * Hook: pls_woocommerce_shop_loop_header_left.
				 *
				 * @hooked pls_woocommerce_product_off_canvas_sidebar - 10
				 * @hooked woocommerce_result_count - 20
				 */
				do_action( 'pls_woocommerce_shop_loop_header_left' );
				?>
			</div>
			<div class="pls-products-header-right">
				<?php 
				/**
				 * Hook: pls_woocommerce_shop_loop_header_right.
				 *
				 * @hooked pls_woocommerce_product_loop_view - 10
				 * @hooked pls_woocommerce_product_loop_show - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'pls_woocommerce_shop_loop_header_right' );
				?>
			</div>
		</div>
	<?php }
endif;

if ( ! function_exists( 'pls_product_filter_top' ) ) :
	/**
	 * Shop top filter button
	 */
	function pls_product_filter_top() {
			
		if( ! pls_get_option( 'shop-top-filter', 0 ) ) {
			return;
		}
		
		$filter_text =  apply_filters( 'pls_filter_button_text', esc_html__('Filters', 'pls-theme') ); ?>
		
		<span class="pls-product-filter-btn"><?php echo esc_html( $filter_text );?></span>
	
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_product_grid_list_text' ) ) :
	/**
	 * Products view grid/list style on shop page
	 */
	function pls_woocommerce_product_grid_list_text( $list_type ) {
		$list = [ 
			'list-view' 		=> esc_html__('List', 'pls-theme'),
			'grid-list' 		=> esc_html__('List', 'pls-theme'),
			'grid-two-col' 		=> esc_html__('2 Columns', 'pls-theme'),
			'grid-three-col' 	=> esc_html__('3 Columns', 'pls-theme'),
			'grid-four-col'		=> esc_html__('4 Columns', 'pls-theme'),
		];
		return isset( $list[$list_type] ) ? $list[$list_type] : '';
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_columns_text' ) ) :
	/**
	 * Products view grid/list style on shop page
	 */
	function pls_woocommerce_product_columns_text() {
		$products_columns = pls_get_products_columns();
		$list = [ 
			'2' => 'grid-two-col',
			'3' => 'grid-three-col',
			'4' => 'grid-four-col',
		];
		return isset( $list[$products_columns] ) ? $list[$products_columns] : '';
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_view' ) ) :
	/**
	 * Products view grid/list style on shop page
	 */
	function pls_woocommerce_product_loop_view() {
		
		if( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) return;
		$product_view = pls_get_loop_prop( 'products_view' );
		$produc_view_icons = pls_get_option( 'products-view-icon', ['list-view', 'grid-two-col', 'grid-three-col', 'grid-four-col'] );
		if( empty( $produc_view_icons ) ) {
			return;
		}
		$products_columns 	= pls_woocommerce_product_columns_text();
		if( $product_view == 'list-view' || $product_view == 'grid-list' ) {
			$products_columns = 'grid-list';
		} ?>
		<div class="pls-products-view">
			<?php 
			foreach($produc_view_icons as $view_style ){ ?>
				<a class="pls-tooltip <?php echo esc_attr( $view_style )?> <?php echo esc_attr( $products_columns == $view_style ) ? 'active' : ''; ?>" data-shopview="<?php echo esc_attr( $view_style )?>" href="<?php echo esc_url( add_query_arg( array( 'view' => $view_style ) ) );?>"><?php echo esc_html(pls_woocommerce_product_grid_list_text( $view_style ) );?></a>
			<?php }
			?>
		</div>
		<?php 
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_show' ) ) :
	/**
	 * Show number of products per page on product loop
	 */
	function pls_woocommerce_product_loop_show() {
			
		if( ! pls_get_option( 'products-per-page-dropdown', 0 ) || ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) return;
		
		$show_numbers = pls_get_shop_viewnumbers();
		$loop_shop_per_page = pls_loop_shop_per_page();
		
		if( !empty( $show_numbers ) ) { ?>
			<div class="pls-product-show">
				<form class="show-products-number" method="get">
					<span><?php esc_html_e('Show:','pls-theme');?></span>
					<select class="show-number per_page" name="per_page">
						<?php foreach( $show_numbers as $show_per_page ) { 	?> 
							<option value="<?php echo esc_attr($show_per_page); ?>" <?php selected( $show_per_page, $loop_shop_per_page );?>><?php echo absint($show_per_page);?></option>
						<?php } ?>
					</select>
					<?php
					foreach( $_GET as $name => $value ) {
						if ( 'per_page' != $name ) {
							printf( '<input type="hidden" name="%s" value="%s">', esc_attr( $name ), esc_attr( $value ) );
						}
					}
					?>
				</form>
			</div>
		<?php }
	}
endif;

if ( ! function_exists( 'pls_shop_top_filter_widgets' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function pls_shop_top_filter_widgets() {
		if( pls_get_loop_prop( 'is_shortcode' ) ){
			return;
		}
		
		if( ! pls_get_option( 'shop-top-filter', 0 ) ) {
			return; 
		} ?>
		<div id="pls-filter-widgets" class="pls-filter-widgets" style="display:none">
			<div class="pls-filter-inner row">
				<?php 
				if ( is_active_sidebar('shop-filters-sidebar') ) { 
				dynamic_sidebar('shop-filters-sidebar');
				}else{
					esc_html_e('No, Any filters available.','pls-theme');
				} ?>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_woocommerce_active_filter_widgets' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function pls_woocommerce_active_filter_widgets() { 
		
		if( pls_get_loop_prop( 'is_shortcode' ) ){
			return;
		}
		?>
		<div class="pls-active-filters">
			<?php 
			do_action( 'pls_woocommerce_before_active_filters_widgets' );

			the_widget( 'WC_Widget_Layered_Nav_Filters', array( 'title' => '' ), array() ); 

			do_action( 'pls_woocommerce_after_active_filters_widgets' );
			?>
		</div>
	<?php
	}
endif;

if ( ! function_exists( 'pls_woocommerce_clear_filters_btn' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function pls_woocommerce_clear_filters_btn() { 
			global $wp;  
			$url = home_url( add_query_arg( array( $_GET ), $wp->request ) );
			$filters = array( 'filter_', 'rating_filter', 'min_price', 'max_price', 'product_visibility', 'stock', 'onsales' );
			$need_clear = false;
				
			foreach ( $filters as $filter )
				if ( strpos( $url, $filter ) ) $need_clear = true;	
				
			if ( $need_clear ) {
				$reset_url = strtok( $url, '?' );
				if ( isset( $_GET['post_type'] ) ) $reset_url = add_query_arg( 'post_type', wc_clean( wp_unslash( $_GET['post_type'] ) ), $reset_url );
				?>
					<div class="pls-clear-filters-wrapp">
						<a class="pls-clear-filters" href="<?php echo esc_url( $reset_url ); ?>"><?php echo esc_html__( 'Clear filters', 'pls-theme' ); ?></a>
					</div>
				<?php
			}
		}
endif;

if ( ! function_exists( 'pls_woocommerce_product_off_canvas_sidebar' ) ) :
	/**
	 * Product Off Canvas Sidebar Button
	 */
	function pls_woocommerce_product_off_canvas_sidebar() {
			
		if( ! pls_get_option( 'shop-page-off-canvas-sidebar', 0 ) ) {
			return;
		}
		
		$filter_text =  pls_get_option( 'off-canvas-button-text', esc_html__('Filters', 'pls-theme') ); ?>
		
		<span class="pls-product-off-canvas-btn"><?php echo esc_html( $filter_text );?></span>
	
	<?php }
endif;

if( ! function_exists( 'pls_loop_shop_per_page' ) ) :
	/**
	 * Set per page product loop product page
	 */
	function pls_loop_shop_per_page(){
		
		$shop_loop_per_page = pls_get_loop_prop( 'products-per-page' );
		if ( isset( $_GET[ 'per_page' ] ) ) {
			return $_GET[ 'per_page' ];
		}
		
		return $shop_loop_per_page;
	}
	add_filter( 'loop_shop_per_page', 'pls_loop_shop_per_page', 20 );
endif;

if ( ! function_exists( 'pls_woocommerce_loop_product_wrapper' ) ) :
	/**
	 * Product loop wrapper start
	 */
	function pls_woocommerce_loop_product_wrapper() { ?>
		<div class="pls-product-inner">
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_product_wrapper_end' ) ) :
	/**
	 * Product loop wrapper end
	 */
	function pls_woocommerce_product_wrapper_end() { ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_before_shop_loop_item_title' ) ) :
	/**
	 * Product loop image
	 */
	function pls_woocommerce_before_shop_loop_item_title() { ?>
		<div class="pls-product-image">
			<?php
			/**
			 * Hook: pls_woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked pls_woocommerce_template_loop_product_thumbnail - 10
			 */
			 do_action( 'pls_woocommerce_before_shop_loop_item_title' );?>
		 </div>
		 <?php 
	}
endif;

if ( ! function_exists( 'woocommerce_template_loop_category_title' ) ) {

	/**
	 * Show the subcategory title in the product loop.
	 *
	 * @param object $category Category object.
	 */
	function woocommerce_template_loop_category_title( $category ) {
		$category_term = get_term( $category, 'product_cat' );
		$category_name = ( ! $category_term || is_wp_error( $category_term ) ) ? '' : $category_term->name; ?>
		
		<h3 class="woocommerce-loop-category__title">
			<?php			
			/* translators: %s: Category name */
			echo '<a aria-label="' . sprintf( esc_attr__( 'Visit product category %1$s', 'woocommerce' ), esc_attr( $category_name ) ) . '" href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '">';
				echo esc_html( $category->name );

				 echo sprintf(
					'<span class="product-count">%1$s</span>',
					sprintf( _n( '%s Product', '%s Products', $category->count, 'pls-theme' ), $category->count )
				);
			echo '</a>';
			?>
		</h3>
		<?php
	}
}

if ( ! function_exists( 'pls_subcategory_count_html' ) ) :
	/**
	 * Categories loop products count
	 */
	function pls_subcategory_count_html( $html, $category ) { 	
		 return sprintf(
			'<span class="product-count">%1$s</span>',
			sprintf( _n( '%s Product', '%s Products', $category->count, 'pls-theme' ), $category->count )
		);
	}
	add_filter('woocommerce_subcategory_count_html', 'pls_subcategory_count_html', 10, 2);
endif;

if ( ! function_exists( 'pls_woocommerce_template_loop_product_thumbnail' ) ) :
	/**
	 * Get the product thumbnail, slider for the loop.
	 */
	function pls_woocommerce_template_loop_product_thumbnail() {
				
		global $product;

		$image_size 	= apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );		
		$attachment_ids = $product->get_gallery_image_ids();
		$hover_image 	= '';
		$mobile_hover_image	= true;
			
		if( wp_is_mobile() && ! pls_get_option( 'mobile-product-hover-image', 0 ) ) {
			$mobile_hover_image	= false;
		}
		
		if ( $mobile_hover_image && ! empty( $attachment_ids[0] ) ) {
			$hover_image = pls_get_image_html( $attachment_ids[0] , $image_size, 'hover-image' );
		}
		
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		
		$target = '_self';
		if( pls_get_option( 'open-product-page-new-tab', 0 ) ){
			$target = '_blank';
		}
		
		$html = '<a href="'. esc_url( $link ) .'" class="woocommerce-LoopProduct-link" target="'.$target.'">';		
			$html .=  $product ? pls_get_post_thumbnail( $image_size, 'front-image' ) : '';			
			if( '' != $hover_image && pls_get_option( 'product-hover-image', 1 ) ):
				$html .= $hover_image;
			endif;			
		$html .= '</a>';
		
		echo apply_filters( 'pls_woocommerce_template_loop_product_thumbnail', $html );
	}
endif;

if ( ! function_exists( 'pls_woocommerce_shop_loop_item_title' ) ) :
	/**
	 * Product loop title hooke
	 */
	function pls_woocommerce_shop_loop_item_title() { 
		/**
		 * Hook: pls_woocommerce_shop_loop_item_title.
		 *
		 * @hooked pls_woocommerce_loop_product_info_wrapper - 5
		 * @hooked pls_product_loop_category - 15
		 * @hooked woocommerce_template_loop_product_title - 20
		 * @hooked woocommerce_template_single_excerpt - 30
		 * @hooked pls_woocommerce_product_wrapper_end - 50
		 */
		 do_action( 'pls_woocommerce_shop_loop_item_title' );
	}
endif;

if ( ! function_exists( 'pls_woocommerce_loop_product_info_wrapper' ) ) :
	/**
	 * Product loop info wrapper start
	 */
	function pls_woocommerce_loop_product_info_wrapper() { ?>
		<div class="pls-product-info">
	<?php }
endif;

if( ! function_exists( 'pls_woocommerce_product_loop_categories' ) ) :
	
	function pls_woocommerce_product_loop_categories() { 

		global $product;
		
		if( ! pls_get_option( 'product-category', 1 ) ) { return; } ?>
		
		<div class="product-cats">
			<?php echo wc_get_product_category_list( $product->get_id(), ', ' );?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) :
	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function woocommerce_template_loop_product_title() {
		
		if( ! pls_get_option( 'product-title', 1 ) ) { return; }
		
		global $product;

		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		
		$target = '_self';
		if( pls_get_option( 'open-product-page-new-tab', 0 ) ){
			$target = '_blank';
		}
		echo '<h3 class="product-title"><a href="' . esc_url( $link ) . '" target="'.$target.'">' . get_the_title() . '</a></h3>';
	}
endif;

if ( ! function_exists( 'pls_product_labels' ) ) :
	/**
	 * Product labels
	 */
	function pls_product_labels( $sale_label ='' ) {
		global $product;
		$output 				= array();
		$sale_percentage_label 	= ( $sale_label == 'percentages' ) ? $sale_label : pls_get_option( 'sale-product-label-text-options', 'text' );
		
		if ( pls_get_option( 'product-new-label', 1 ) ) {
			
			$postdate 		= get_the_time( 'Y-m-d' );								// Post date
			$postdatestamp 	= strtotime( $postdate );								// Timestamped post date
			$newness 		= pls_get_option( 'product-newness-days', 90 ); 		// Newness in days
			$new_label_text	= pls_get_option( 'new-product-label-text', 'New' );

			if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
				$output['new'] = '<span class="new">' . $new_label_text . '</span>';
			}					
		}
		
		if( $product->is_on_sale() && pls_get_option( 'sale-product-label', 1 ) ) {		
			$percentage = '';
			if( $product->get_type() == 'variable' && $sale_percentage_label =='percentages' ){				
				$available_variations = $product->get_variation_prices();
				$max_value = 0;
				foreach( $available_variations['regular_price'] as $key => $regular_price ) {					
					$sale_price = $available_variations['sale_price'][$key];					
					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
						if ( $percentage > $max_value ) {
							$max_value = $percentage;
						}
					}
				}
				$percentage = $max_value;
				
			} elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) && $sale_percentage_label =='percentages' ) {				
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}
			if ( $percentage ) {	
				$sale_percentage_label_text = pls_get_option( 'sale-product-label-percentage-text', 'Off' ); 
				$output['sale'] = '<span class="on-sale"><span>'. $percentage . '</span>% ' .$sale_percentage_label_text. '</span>';
			}else{				
				if($product->is_on_sale() && $sale_percentage_label == 'percentages' ){
					/* Fixed issue for you may also like variable products*/
					$percentage = 0;
					if($product->get_regular_price() && $product->get_sale_price()){
						$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
					}
					if( $percentage > 0 ){
						$sale_percentage_label_text = pls_get_option( 'sale-product-label-percentage-text', 'Off' );
						$output['sale'] = '<span class="on-sale"><span>'. $percentage . '</span>% ' .$sale_percentage_label_text. '</span>';
					}
				} else {
					$sale_label_text = pls_get_option( 'sale-product-label-text', 'Sale' );
					$output['sale'] = '<span class="on-sale"><span>' . $sale_label_text . '</span></span>';
				}
				
			}
		}		

		if ( $product->is_featured() && pls_get_option( 'featured-product-label', 1 ) ) {
			$featured_label_text = pls_get_option( 'featured-product-label-text', 'Hot' );
			$output['featured'] = '<span class="featured">' . $featured_label_text . '</span>';
		}	
		
		if( !$product->is_in_stock() && pls_get_option( 'outofstock-product-label', 1 ) ){
			$out_stock_label_text = pls_get_option( 'outofstock-product-label-text', 'Out Of Stock' );
			$output['out_of_stock'] = '<span class="out-of-stock">' . $out_stock_label_text . '</span>';
		}
		if ( ! is_user_logged_in() && pls_get_option( 'login-to-see-price', 0 ) ) {
			if(isset($output['sale'])){
				unset($output['sale']);
			}
		}		
		return apply_filters( 'pls_product_labels', $output );
	}
endif;

if ( ! function_exists( 'pls_woocommerce_output_product_labels' ) ) :
	/**
	 * Product labels
	 */
	function pls_woocommerce_output_product_labels() {
		
		if( ! pls_get_option( 'product-labels', 1 ) ){ return; }
		
		$output_labels = pls_product_labels();
		$html='';
		$current_filter = current_filter();
		
		if( isset( $output_labels['out_of_stock'] ) && ( is_product() && $current_filter == 'pls_product_gallery_top') ){			
			unset($output_labels['out_of_stock']);			
		}		
		if ( ! empty( $output_labels ) ) {
			$html = '<div class="product-labels">' . implode( '', $output_labels ) . '</div>';
		}
		echo apply_filters( 'pls_woocommerce_output_product_labels', $html, $output_labels );
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_cart_button' ) ) :
	/**
	 * Product loop cart button
	 */
	function pls_woocommerce_product_loop_cart_button() {
		
		if( ! pls_get_option( 'product-buttons', 1 ) || ! pls_get_option( 'product-cart-button', 1 ) || ( ! is_user_logged_in() && pls_get_option( 'login-to-see-price', 0 ) ) ) {
			return; 
		} ?>
		
		<div class="pls-cart-button">
			<?php
			/**
			 * Hook: pls_woocommerce_product_loop_cart_button.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			 do_action( 'pls_woocommerce_product_loop_cart_button' );?>
		 </div>
		<?php 
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_wishlist_button' ) ) :
	/**
	 * Product loop wishlist button
	 */
	function pls_woocommerce_product_loop_wishlist_button() {
		
		if( ! pls_get_option( 'product-buttons', 1 ) || ! pls_get_option( 'product-wishlist-button', 1 ) ) return; ?>
		
		<div class="pls-whishlist-button">
			<?php if( class_exists('YITH_WCWL_Shortcode')) echo YITH_WCWL_Shortcode::add_to_wishlist(array()); ?>
		</div>
		<?php 
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_compare_button' ) ) :
	/**
	 * Product loop compare button
	 */
	function pls_woocommerce_product_loop_compare_button() {
		
		if( ! defined( 'YITH_WOOCOMPARE' )) return; 
		if( ! pls_get_option( 'product-buttons', 1 ) || ! pls_get_option( 'product-compare-button', 1 ) ) return; 
		global $product;
		$id = $product->get_id();
		$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'pls-theme' ) );
		$compare_button_style = get_option( 'yith_woocompare_is_button' );		
		?>
		
		<div class="pls-compare-button">
			<?php printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>',
						pls_compare_add_product_url( $id ),
						'compare'.' '.$compare_button_style,
						$id,
						$button_text ); 
			?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_compare_add_product_url' ) ) :
	function pls_compare_add_product_url( $product_id ) {

		$action_add = 'yith-woocompare-add-product';

		$url_args = array(
			'action' => $action_add,
			'id'     => $product_id,
		);

		return apply_filters( 'yith_woocompare_add_product_url',
			esc_url_raw( add_query_arg( $url_args ) ),
			$action_add );
	}
endif;

if ( ! function_exists( 'pls_woocommerce_product_loop_quick_view_button' ) ) :
	/**
	 * Product loop quick view button
	 */
	function pls_woocommerce_product_loop_quick_view_button() {
		
		if( ! pls_get_option( 'product-buttons', 1 ) || ! pls_get_option( 'product-quickview-button', 1 ) ) return; ?>
		
		<div class="pls-quickview-button">
			<a class="pls-quickview-btn" href="<?php echo esc_url( get_the_permalink() );?>" data-id="<?php echo esc_attr(get_the_ID());?>"><?php esc_html_e('Quick View','pls-theme')?></a>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_quantity_button_plus' ) ) :
	/**
	 * Quantity Button Plus
	 */
	function pls_quantity_button_plus() { ?>
		<label class="plus"></label>
	<?php }
endif;

if ( ! function_exists( 'pls_quantity_button_minus' ) ) :
	/**
	 * Quantity Button Minus
	 */
	function pls_quantity_button_minus() { ?>
		<label class="minus"></label>
		
	<?php }
endif;	

if ( ! function_exists( 'pls_woocommerce_stock_progress_bar' ) ) :
	/**
	 * Product loop buttons & variations
	 */
	function pls_woocommerce_stock_progress_bar() { 
		if( ! pls_get_loop_prop( 'products-stock-progressbar' ) ){
			return;
		}
		global $product;
		$product_error 		= false;
		$productId 			= get_the_ID();	
		$stock_available 	= false;	
		$stock_sold 		= ( $total_sales = get_post_meta( $productId, 'total_sales', true ) ) ? round( $total_sales ) : 0;
		$stock_available 	= ($stock = get_post_meta($productId, '_stock', true)) ? round($stock) : 0;
		$percentage 		= $stock_available > 0 ? round($stock_sold/($stock_available + $stock_sold) * 100) : 0;
		if( $stock_available ) : ?>
			<div class="pls-product-stock-progressbar">
				<div class="pls-product-stock-label">
					<span class="pls-stock-sold"><?php esc_html_e('Already Sold:', 'pls-theme');?> <span><?php echo esc_html($stock_sold); ?></span></span>
					<span class="pls-stock-available"><?php esc_html_e('Available:', 'pls-theme');?> <span><?php echo esc_html($stock_available); ?></span></span>
				</div>
				<div class="progress">
					<span class="progress-bar active" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"><?php echo esc_html( $percentage ).'%'; ?></span>
				</div>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'pls_woocommerce_after_shop_loop_item' ) ):
	/**
	 * Product after shop loop wrapper end
	 */
	function pls_woocommerce_after_shop_loop_item() {
		/**
		 * Hook: pls_woocommerce_after_shop_loop_item.
		 *
		 * @hooked pls_woocommerce_product_wrapper_end - 10
		 * @hooked pls_woocommerce_product_wrapper_end - 20
		 * @hooked pls_woocommerce_product_wrapper_end - 30
		 */
		 do_action( 'pls_woocommerce_after_shop_loop_item' );
	}
endif;

/**
 * Single Product
 */
if( ! function_exists( 'pls_wc_get_gallery_image_html' ) ) :
	/**
	 * Get Product Gallery Thumbnails
	 */
	function pls_wc_get_gallery_image_html( $attachment_id ){	
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $thumbnail[0],
			'data-large_image'        => $thumbnail[0],
			'data-large_image_width'  => $thumbnail[1],
			'data-large_image_height' => $thumbnail[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
		$html .= '</div>';
		
		return $html;
	}
endif;

/**
 * Single Product
 */
if( ! function_exists( 'pls_wc_get_gallery_image_html' ) ) :
	/**
	 * Get Product Gallery Thumbnails
	 */
	function pls_wc_get_gallery_image_html( $attachment_id ){	
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $thumbnail[0],
			'data-large_image'        => $thumbnail[0],
			'data-large_image_width'  => $thumbnail[1],
			'data-large_image_height' => $thumbnail[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
		$html .= '</div>';
		
		return $html;
	}
endif;

if ( ! function_exists( 'pls_single_product_photoswipe_btn' ) ) :
	/**
	 * Single product photoswipe button
	 */
	function pls_single_product_photoswipe_btn(){
		
		if( ! pls_get_option( 'product-gallery-lightbox', 1 ) ) return; ?>
		
		<div class="product-photoswipe-btn">
			<a href="#" class="pls-product-image-full"><?php esc_html_e('Lightbox', 'pls-theme'); ?></a>
		</div>		
	<?php
	}
endif;

if ( ! function_exists( 'pls_single_product_video_btn' ) ) :
	/**
	 * Single product video button
	 */
	function pls_single_product_video_btn(){
		
		if( ! pls_get_option( 'product-video', 1 ) ) return;
		
		$prefix 	= PLS_PREFIX;
		$video_url 	= get_post_meta(get_the_ID(),  $prefix .'product_video', true );
		if( ! empty( $video_url ) ){ ?>
			<div class="product-video-btn">
				<a href="<?php echo esc_url( $video_url ); ?>" class="pls-video-popup"><?php esc_html_e( 'Watch Video', 'pls-theme' ); ?></a>
			</div>
			
		<?php }
	}
endif;

if ( ! function_exists( 'pls_single_product_degree360_btn' ) ) :
	/**
	 * Single product 360 degree View button
	 */
	function pls_single_product_degree360_btn(){
		
		if( ! pls_get_option( 'product-360-degree', 1 ) ) return;
		global $post;
		if ( ! $post ) {
			return;
		}
		$prefix 			= PLS_PREFIX;
		$gallery_images 	= get_post_meta($post->ID,  $prefix .'product_360_degree_images' );
		
		if( ! empty( $gallery_images ) ){ ?>
			<div class="product-360-degree-btn">
				<a href="#pls-360-degree-wrapper" ><?php esc_html_e('360 Degree', 'pls-theme'); ?></a>
			</div>			
		<?php }
	}
endif;

if ( ! function_exists( 'pls_single_product_360_degree_content' ) ) :
	/**
	 * Single Product 360 Degree Content
	 */
	function pls_single_product_360_degree_content(){
		
		if( ! pls_get_option( 'product-360-degree', 1 ) ) return;
		global $post;
		if ( ! $post ) {
			return;
		}
		$prefix 	= PLS_PREFIX;
		$gallery_images 	= get_post_meta( $post->ID,  $prefix .'product_360_degree_images' );
		if( empty( $gallery_images ) ){
			return;
		}
		$image_array = array();
		foreach ( $gallery_images as $attachment_id ) {
			$image_src = wp_get_attachment_image_url( $attachment_id, 'woocommerce_single' );
			if( $image_src ){
				$image_array[] = "'" . $image_src . "'";
			}		
		}
		$frames_count  = count( $image_array );
		$images_js_string = implode( ',', $image_array );	?>
		<div id="pls-360-degree-wrapper" class="pls-360-degree-wrapper mfp-hide">
			<ol class="pls-360-degree-images"></ol>	
			<div class="spinner">
				<span>0%</span>
			</div>
		</div>
		<?php
		wp_enqueue_script( 'threesixty' );
		wp_add_inline_script('threesixty',
			'jQuery(document).ready(function( $ ) {
				$(".pls-360-degree-wrapper").ThreeSixty({
					totalFrames: ' . esc_js( $frames_count ) . ',
					endFrame: ' . esc_js( $frames_count ) . ',
					currentFrame: 1,
					imgList: ".pls-360-degree-images",
					progress: ".spinner",
					imgArray: ' . '[' . $images_js_string . ']' . ', 
					width: 300,
					height: 300,
					responsive: true,
					navigation: true,
					position: "bottom-center",
				});
			});',
			'after'
		);
	}
endif;

if( ! function_exists( 'pls_single_product_navigation' ) ) :
	/**
	 * Single Product Navigation
	 */
	function pls_single_product_navigation(){
		
		if( ! pls_get_option( 'single-product-navigation', 1 ) ) { return; }
	
		$next = get_next_post();
	    $prev = get_previous_post();

	    $next = ( ! empty( $next ) ) ? wc_get_product( $next->ID ) : false;
	    $prev = ( ! empty( $prev ) ) ? wc_get_product( $prev->ID ) : false; ?>
		
		<div class="product-navigation">
			<?php if ( ! empty( $prev ) ): ?>
				<div class="product-nav-btn product-prev">
					<a href="<?php echo esc_url( $prev->get_permalink() ); ?>">
						<?php esc_html_e('Previous product', 'pls-theme'); ?>
					</a>				
					<div class="product-info-wrap pls-arrow">
						<div class="pls-product-info">
							<div class="product-thumb">
								<a href="<?php echo esc_url( $prev->get_permalink() ); ?>">
									<?php echo wp_kses( $prev->get_image(), pls_allowed_html(array('img')) );?>
								</a>
							</div>
							<div class="product-title-price">							
								<a class="product-title" href="<?php echo esc_url( $prev->get_permalink() ); ?>">
									<?php echo esc_html( $prev->get_title() ); ?>
								</a>
								<span class="price"><?php echo wp_kses( $prev->get_price_html(), pls_allowed_html(array( 'span','del','ins' ) ) );?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			
			<?php if ( ! empty( $next ) ): ?>
				<div class="product-nav-btn product-next">				
					<a href="<?php echo esc_url( $next->get_permalink() ); ?>">
						<?php esc_html_e('Next product', 'pls-theme'); ?>
					</a>
					<div class="product-info-wrap pls-arrow">
						<div class="pls-product-info">
							<div class="product-thumb">
								<a href="<?php echo esc_url( $next->get_permalink() ); ?>">
									<?php echo wp_kses( $next->get_image(), pls_allowed_html(array('img')) );?>
								</a>
							</div>
							<div class="product-title-price">							
								<a class="product-title" href="<?php echo esc_url( $next->get_permalink() ); ?>">
									<?php echo esc_html( $next->get_title() ); ?>
								</a>
								<span class="price"><?php echo wp_kses( $next->get_price_html(), pls_allowed_html(array( 'span','del','ins' ) ) );?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_sale_product_countdown' ) ) :
	/**
	 * Sale Product Countdown
	 */
	function pls_woocommerce_sale_product_countdown() {
		
		$current_filter = current_filter();
		if( ( !pls_get_loop_prop('product-countdown')  && !in_array( $current_filter, ['woocommerce_single_product_summary','woocommerce_single_product_summary_first'] ) ) || ( is_product() && ( $current_filter == 'woocommerce_single_product_summary' || $current_filter == 'woocommerce_single_product_summary_first' ) && !pls_get_option('single-product-countdown', 1 ) ) ) {
			return; 
		}
		
		global $product;
		$html = $sale_time 	= $offer_text = $offer_html = '';
		$countdown_style 	= 'countdown-box';
		$timezone 			= wc_timezone_string();
		
		if ( !$product->is_in_stock() ) : 
			return; 
		endif;

		if ( $product->is_on_sale() ) : 
			$sale_time = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		endif;
		
		/* variable product */
		if( $product->has_child() && $product->is_on_sale() ){
			$vsale_end = array();
			
			$pvariables = $product->get_children();
			foreach($pvariables as $pvariable){
				$vsale_end[] = (int)get_post_meta( $pvariable, '_sale_price_dates_to', true );
			}			
			/* get the latest time */
			$sale_time = max( $vsale_end );				
		}
		
		if( $product->is_on_sale() && $sale_time ) :
			wp_enqueue_script( 'countdown' );
			$sale_time = $sale_time;
			$sale_time = date('Y-m-d H:i:s', $sale_time); ?>
			<div class="product-countdown-timer <?php echo esc_attr( $countdown_style );?>">
				<div class="product-countdown" data-end-date="<?php echo esc_attr( $sale_time );?>" data-timezone="<?php echo esc_attr( $timezone );?>"></div>	
			</div>
			<?php
		endif;
		
		echo apply_filters( 'pls_woocommerce_sale_product_countdown', $html, $sale_time, $timezone, $countdown_style );
	}
endif;

if ( ! function_exists( 'pls_single_product_after_price' ) ) :
	/**
	 * Single Product Summary After Price
	 */
	function pls_single_product_after_price() {
		/**
		 * Hook: pls_single_product_after_price.
		 * @hooked pls_single_product_brands - 10
		 */
		 do_action( 'pls_single_product_after_price' );
	}
endif;
if ( ! function_exists( 'pls_get_products_availability' ) ) :
	/* Change In Stock Text */
	function pls_get_products_availability( $availability, $_product ) {
	  	
		if ( ! $_product->is_in_stock() ) {
			$availability['availability']	= pls_get_option( 'single-product-availability-outstock-msg', 'Out of Stock' );
			$availability['class']			= 'out-of-stock';
		} elseif ( $_product->managing_stock() && $_product->is_on_backorder( 1 ) ) {
			$availability['availability']	= $_product->backorders_require_notification() ? esc_html__( 'Available on backorder', 'pls-theme' ) : '';
			$availability['class']			= 'out-of-stock';
		} elseif ( ! $_product->managing_stock() && $_product->is_on_backorder( 1 ) ) {
			$availability['availability'] 	= esc_html__( 'Available on backorder', 'pls-theme' );
			$availability['class'] 			= 'out-of-stock';
		} elseif ( $_product->managing_stock() ) {
			$stock_amount 	= $_product->get_stock_quantity();
			$stockQty		= pls_get_option( 'single-product-availability-lowstock-qty', 5 );
			if( $stock_amount <= $stockQty){
				$stock_string 					= pls_get_option( 'single-product-availability-hurry-left-msg', 'Hurry, Only {qty} left.' );
				$stock_outputstring  			= str_replace('{qty}',$stock_amount,$stock_string); 
				$availability['availability'] 	= $stock_outputstring;
				$availability['class'] 			= 'min-stock';
				
			}else{
				$stock_string 					= pls_get_option( 'single-product-availability-instock-msg', 'In Stock' );
				$stock_outputstring  			= str_replace('{qty}',$stock_amount,$stock_string); 
				$availability['availability'] 	= $stock_outputstring;
				$availability['class'] 			= 'in-stock';
			}			
		} else {
			$stock_string 						= pls_get_option( 'single-product-availability-instock-msg', 'In Stock' );
			$stock_outputstring  				= str_replace('{qty}','',$stock_string); 
			$availability['availability'] 		= $stock_outputstring;
			$availability['class']				= 'in-stock';
		}
		return $availability;
	}
endif;
add_filter( 'woocommerce_get_availability', 'pls_get_products_availability', 1, 2);

if ( ! function_exists( 'pls_single_product_stock_availability' ) ) :
	/**
	 * Single Product Stock Availability Message
	 */
	function pls_single_product_stock_availability() {

		if( ! pls_get_option( 'single-product-availability', 1 ) ) return;
		
		global $product;    
		$availability = $product->get_availability(); ?>
		
		<div class="stock-availability <?php echo esc_attr($availability['class']); ?>">
			<span><?php esc_html_e ( 'Availability:', 'pls-theme' );?></span>
			<?php echo wp_kses_post( $availability['availability'] ); ?>
		</div>
		<?php 
	}
endif;

if( ! function_exists( 'pls_single_product_brands' ) ) :
	/**
	 * Single Product Brands
	 */
	function pls_single_product_brands(){		
		
		if( ! pls_get_option( 'single-product-brands', 1 ) ) return;
		
		$brands = get_the_terms( get_the_ID(), 'product_brand' );	
		if( ! is_wp_error( $brands ) && !empty ( $brands ) ):?>		
			<div class="product-brands">
				<?php foreach( $brands as $brand ): 
					$thumbnail_id 	= absint( get_term_meta( $brand->term_id, 'thumbnail_id', true ) );
					$brand_link 	= get_term_link( $brand, 'product_brand' ); 
					$brand_class 	= $thumbnail_id ? 'brand-image' : 'brand-title'; ?>
					<a class="<?php echo esc_attr($brand_class);?>" href="<?php echo esc_url( get_term_link($brand) ); ?>" title="<?php echo esc_attr($brand->name);?>">                        
						<?php 
						if ($thumbnail_id  ) {
							echo wp_get_attachment_image( $thumbnail_id, 'full' );
						} else {
							echo esc_html($brand->name);
						}
						 ?>
					</a> 
				<?php endforeach; // end of the loop. ?>
			</div>
		<?php
		endif;
	}
endif;

if( ! function_exists( 'pls_woocommerce_grouped_product_list_image' ) ) :
	/**
	 * Group Product added image in grouped product list
	 */
	function pls_woocommerce_grouped_product_list_image( $product ){
		 $image = $product->get_image( array( '50', '50' ), array( 'class' => 'product-img' ) );
		$thumbnail = '<div class="product-thumbnail">'.$image.'</div>';
		echo '<td class="woocommerce-grouped-product-list-item__thumbnail">'.$thumbnail.'</td>';
	}
	add_action( 'woocommerce_grouped_product_list_before_quantity', 'pls_woocommerce_grouped_product_list_image' );
endif;

if( ! function_exists('pls_add_quick_buy_pid') ) :
	/* Quick buy button*/
	function pls_add_quick_buy_pid() {
		
		if( ! pls_get_option( 'single-product-quick-buy', 0 ) ) return;
		
		global $product;
		if ( $product != null ) {
			echo '<input type="hidden" class="pls_quick_buy_product_' . esc_attr( $product->get_id() ). '" value="' . esc_attr( $product->get_id() ) . '"  />';
		}
	}
endif;

if( ! function_exists('pls_add_quick_buy_button') ) :
	function pls_add_quick_buy_button(){
		
		if( ! pls_get_option( 'single-product-quick-buy', 0 ) ) return;
		
		global $product;
		$html = '';

		if ( $product == null ) {
			return;
		}
		if ( $product->get_type() == 'external' ) {
			return;
		}
		$pid 			= $product->get_id();
		$type 			= $product->get_type();
		$label 			= pls_get_option( 'product-quickbuy-button-text', 'Buy It Now' );
		$quick_buy_btn_style 	= 'button';
		$class 			= '';
		$defined_class 	= 'pls_quick_buy_' . $type . ' pls_quick_buy_' . $pid;
		$defined_attrs 	= 'name="pls_quick_buy_button"  data-product-type="' . esc_attr( $type ) . '" data-pls-product-id="' . esc_attr($pid ) . '"';
		echo '<div class="pls-quick-buy">';

		if ( $quick_buy_btn_style == 'button' ) {
			echo '<button  class="pls_quick_buy_button '.esc_attr( $defined_class ).'" value="' . esc_attr($label) . '" type="button" ' . $defined_attrs . '>' . esc_attr($label) . '</button>';
		}
		echo  '</div>';
	}
endif;

if( ! function_exists('pls_quick_buy_redirect') ) :
	/**
	 * Function to redirect user after qucik buy button is submitted
	 */
	function pls_quick_buy_redirect( $url ) {
		if ( isset( $_REQUEST['pls_quick_buy'] ) && $_REQUEST['pls_quick_buy'] == true ) {
			$redirect = 'checkout';
			if ( $redirect == 'cart' ) {
				return wc_get_cart_url();
			} elseif ( $redirect == 'checkout' ) {
				return wc_get_checkout_url();
			}
		}
		return $url;
	}
endif;

if( ! function_exists( 'pls_single_product_size_chart' ) ) :
	/**
	 * Single Product Size Chart
	 */
	function pls_single_product_size_chart(){
		
		if( ! pls_get_option( 'single-product-size-chart', 0 ) ) return;
		
		$prefix 	= PLS_PREFIX;
		$chart_id 	= get_post_meta(get_the_ID(),  $prefix.'size_guide', true );
		if( empty( trim($chart_id) ) ) return;?>		
		<div class="product-sizechart">
			<a href="#" data-id="<?php echo esc_attr($chart_id);?>" class="pls-ajax-size-chart"><?php echo apply_filters( 'pls_single_product_sizechart_label', esc_html__('Size Guide', 'pls-theme') );?></a>
		</div>
		<?php 
	}
endif;

if( ! function_exists('pls_single_product_delivery_return_ask_question') ) :
	/**
	 * Single Product Delivery Return & Ask a Quesion
	 */
	function pls_single_product_delivery_return_ask_question() {
		
		if( pls_get_option( 'product-delivery-return', 0 ) || pls_get_option( 'product-ask-quetion', 0 ) ){ ?>
			
			<div class="pls-deliver-return-ask-questions">
				<?php if( pls_get_option( 'product-delivery-return', 0 ) ){
					$class = '';
					$block_id = pls_get_option( 'delivery-return-terms', 0 ); 
					if( $block_id ){
						$class = ' pls-ajax-block';
					}
					?>
					<div class="pls-deliver-return<?php echo esc_attr($class);?>" data-id="<?php echo esc_attr($block_id);?>"><?php echo esc_html( pls_get_option( 'delivery-return-label', 'Delivery & Return' ) ); ?></div>
				<?php } ?>
				
				<?php if( pls_get_option( 'product-ask-quetion', 0 ) ){
					$class = '';
					$form_id = pls_get_option( 'ask-question-form', 0 );					
					$class = ' pls-ask-questions-ajax';										
					global $product;
					$product_title = $product->get_name(); ?>
					<div class="pls-ask-questions<?php echo esc_attr( $class );?>" data-id="<?php echo esc_attr( $form_id );?>"><?php echo esc_html( pls_get_option( 'ask-quetion-label', 'Ask a Question' ) ); ?></div>
					<div id="pls-ask-questions-popup" class="pls-ask-questions-popup mfp-hide">
						<h3 class="ask-questions-form-tile"> 
							<?php echo esc_html( pls_get_option( 'ask-quetion-form-title', 'Ask a Question' ) ); ?>
						</h3>
						<?php 
						$form_shortcode = apply_filters('pls_ask_questions_form','[contact-form-7 id="'.$form_id.'" product-title="'.$product_title.'"]');
						echo do_shortcode( $form_shortcode ); ?>
					</div>
				<?php } ?>
			</div>
		<?php }
	}
endif;

if( ! function_exists('pls_shortcode_atts_wpcf7_filter') ) :
	/**
	 * Custom attribute add to form
	 */
	function pls_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
		$my_attr = 'product-title';
		if ( isset( $atts[$my_attr] ) ) {
			$out[$my_attr] = $atts[$my_attr];
		}
		return $out;
	}
	add_filter( 'shortcode_atts_wpcf7', 'pls_shortcode_atts_wpcf7_filter', 10, 3 );
endif;

if( ! function_exists('pls_single_product_estimated_delivery') ) :
	/**
	 * Single Product Estimated Delivery Time
	 */
	function pls_single_product_estimated_delivery() {
		
		if( ! pls_get_option( 'product-estimated-delivery', 0 ) ) { 
			return;			
		}
		
		global $product;
		
		if( !$product->is_in_stock() ){
			return;
		}
		
		$number			= pls_get_option( 'estimated-delivery-days', array( 1 => 3, 2 => 7, ) );
		$to_days		= $number['1'];
		$from_days		= $number['2'];
		$minDate		= wp_date( 'Y-m-d', strtotime( " + " . $to_days . " days" ) );
		$maxDate 		= wp_date( 'Y-m-d', strtotime( " + " . $from_days . " days" ) );
		$date_string	= date_i18n( "d F ", strtotime( $minDate ) ) . ' - ' . date_i18n( "d F", strtotime( $maxDate ) );
		?>
		<div class="pls-estimated-delivery">
			<div class="pls-delivery-label">
				<?php echo esc_html( pls_get_option( 'estimated-delivery-label', 'Estimated Delivery:' ) ); ?>
			</div>
			<div class="pls-delivery-date"><?php echo esc_html( $date_string );?> </div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_single_product_visitor_count' ) ) :
	/**
	 * Single Product Visitor Count
	 */
	function pls_single_product_visitor_count() {
		
		if( ! pls_get_option( 'single-product-visitor-count', 0 ) ) { 
			return;
		}
		
		$number			= pls_get_option( 'random-visitor-number', array( 1 => 20, 2 => 50, ) );
		$min 			= $number['1'];
		$max 			= $number['2'];
		$delay 			=  pls_get_option( 'visitor-count-delay-time', '5' );
		$visitor_count 	= rand( $min, $max );
		$enable_enterval = '';
		if( $delay  > 0 ){
			$enable_enterval 	= ' pls-visitor-change';
		}		
		$visitor_count_btml = '<span class="product-visitor-count">'.$visitor_count.'</span>';
		$count_message		= pls_get_option( 'visitor-count-text', '{visitor_count} People viewing this product right now!' );
		$count_message		= str_replace( '{visitor_count}', $visitor_count_btml, $count_message );
		
		
		$visitor_count_html = '<div class="pls-visitor-count'.$enable_enterval.'" data-min="'.$min.'" data-max="'.$max.'" data-delay="'.$delay.'">'. $count_message .'</div>';
		
		echo apply_filters('pls_product_visitor_count', $visitor_count_html );
	}
endif;

if ( ! function_exists( 'pls_single_product_policy' ) ) :
	/**
	 * Single Product Policy
	 */
	function pls_single_product_policy() {
		
		if( ! pls_get_option( 'single-product-policies', 0 ) ) { 
			return;
		}
		
		$defualt_policy = [ 
			'policy_title'	=> [
				'Free Shipping',
				'1 Year Warranty',
				'Secure payment',
				'30 Days Return',
			],
			'policy_icon_class'	=> [
				'picon-truck',
				'picon-shield-check',
				'picon-handshake',
				'picon-reload',
			],
			'policy_block'	=> [
				'',
				'',
				'',
				'',
			]
		];
		
		$product_policies = pls_get_option( 'product-policies', $defualt_policy );
		
		if( empty( $product_policies ) ){
			return;
		}
		
		$policy_title 		= $product_policies['policy_title'];
		$policy_icon_class 	= $product_policies['policy_icon_class'];
		$policy_block 		= $product_policies['policy_block'];
		
		ob_start();?>
		<div class="pls-product-policy">
			<ul class="product-policy-list">
				<?php foreach( $policy_title as $key => $value ){ 
					if( empty( trim( $value ) ) ){
						continue;
					}
					$icon_html 	= $link_class = '';
					$block_id 	= 0;
					if( !empty( $policy_icon_class[$key] ) ){
						$icon_html = '<span class="policy-item-icon '.$policy_icon_class[$key].'"></span>';
					}
					
					if( !empty( $policy_block[$key] ) ){
						$link_class = ' pls-ajax-block';
						$block_id 	= $policy_block[$key];
					}?>
					<li class="policy-item<?php echo esc_attr($link_class);?>" data-id="<?php echo esc_attr($block_id);?>">
						<?php echo wp_kses( $icon_html, pls_allowed_html( array('span') ) ); ?>
						<span class="policy-item-name"> <?php echo esc_html( $value ); ?> </span>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<?php		
		$output = ob_get_clean();
		
		echo apply_filters( 'pls_product_policy',  $output );		
	}
endif;

if ( ! function_exists( 'pls_single_product_trust_badge' ) ) :
	/**
	 * Single Product Trust Badge
	 */
	function pls_single_product_trust_badge() {
		
		if( ! pls_get_option( 'single-product-trust-badge', 0 ) ) { 
			return;
		}
		
		$trust_badge_url = pls_get_option( 'trust-badge-image', array( 'url' => PLS_IMAGES.'/trust_badge.png') );
		
		if( empty( $trust_badge_url ) ) { 
			return;
		}
		
		ob_start(); ?>						
		<div class="pls-product-trust-badge">
			<fieldset>
				<legend><?php echo esc_html( pls_get_option( 'trust-badge-label', 'Guaranteed Safe Checkout' ) ); ?></legend>
				<img src="<?php echo esc_url($trust_badge_url['url']); ?>" alt="<?php esc_attr_e( 'Trues Badge', 'pls-theme'); ?>"/>
			</fieldset>
		</div>		
		<?php 
		$badge_html = ob_get_clean();
			
		echo apply_filters('pls_product_trust_badge', $badge_html );
	}
endif;

if ( ! function_exists( 'pls_single_product_share' ) ) :
	/**
	 * Single Product Share
	 */
	function pls_single_product_share() {
		
		if( ! pls_get_option( 'single-product-share', 1 ) ) { return; } ?>
		
		<?php if ( function_exists( 'pls_social_share' ) ) { ?>
			<div class="product-share">
				<span class="share-label">
					<?php esc_html_e( 'Share:', 'pls-theme' );?>
				</span>
				<?php
				$social_icons_style = pls_get_option( 'social-sharing-icons-style','icons-default' );
				$social_icons_size  = pls_get_option( 'sharing-icons-size','icons-size-default' );
				pls_social_share(
					array(
						'type' 		=> 'share', 
						'style' 	=> $social_icons_style,
						'size' 		=> $social_icons_size,
					)
				); ?>
			</div>
		<?php 
		}
	}
endif;

if ( ! function_exists( 'pls_output_recently_viewed_products' ) ) :
	/**
	 * Single Product Share
	 */
	function pls_output_recently_viewed_products() {
		
		$recently_viewed_products = pls_get_recently_viewed_products();	
		
		if( ! empty( $recently_viewed_products ) ){
			$args['recently_viewed_products'] = $recently_viewed_products;
			// Set global loop values.
			wc_set_loop_prop( 'name', 'recently-viewed' );
			wc_get_template( 'single-product/recently-viewed.php', $args );
		}
	}
endif;

if( ! function_exists('pls_reduce_woocommerce_min_strength_requirement') ) :
	/** 
	 *Reduce the strength requirement on the woocommerce password.
	 * 
	 * Strength Settings
	 * 3 = Strong (default)
	 * 2 = Medium
	 * 1 = Weak
	 * 0 = Very Weak / Anything
	 */
	function pls_reduce_woocommerce_min_strength_requirement( $strength ) {
		if( pls_get_option( 'manage-password-strength', 0 ) )
			return pls_get_option( 'user-password-strength', 3 );
		else
			return 3;		 
	}
	add_filter( 'woocommerce_min_password_strength', 'pls_reduce_woocommerce_min_strength_requirement' );
endif;

/**
 * My Account Page
 */
if ( ! function_exists( 'pls_before_account_navigation' ) ) :
	/**
	 * Add wrap and user info to the account navigation
	 */
	function pls_before_account_navigation() {

		// Name to display
		$current_user = wp_get_current_user();

		if ( $current_user->display_name ) {
			$name = $current_user->display_name;
		} else {
			$name = esc_html__( 'Welcome!', 'pls-theme' );
		}
		$name = apply_filters( 'pls_user_profile_name_text', $name );

		echo '<div class="MyAccount-navigation-wrapper">';
			echo '<div class="pls-user-profile">';
				echo '<div class="user-avatar">'. get_avatar( $current_user->user_email, 128 ) .'</div>';
				echo '<div class="user-info">';
					echo '<h5 class="display-name">'. esc_attr( $name ) .'</h5>';
				echo '</div>';
			echo '</div>';
	}
endif;

if ( ! function_exists( 'pls_after_account_navigation' ) ) :
	/**
	 * Add wrap to the account navigation.
	 */
	function pls_after_account_navigation() {
		echo '</div>';
	}
endif;

if ( ! function_exists( 'pls_woocommerce_before_account_orders' ) ) :
	/**
	 *  My Orders Page Title
	 */
	function pls_woocommerce_before_account_orders( $has_orders) {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My Orders', 'pls-theme' ); ?></h2>
			<p><?php esc_html_e( 'Your recent orders are displayed in the table below.', 'pls-theme' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_woocommerce_before_account_downloads' ) ) :
	/**
	 *  My Downloads Page Title
	 */
	function pls_woocommerce_before_account_downloads( $has_orders) {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My Downloads', 'pls-theme' ); ?></h2>
			<p><?php esc_html_e( 'Your digital downloads are displayed in the table below.', 'pls-theme' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_woocommerce_my_account_my_address_description' ) ):
	/**
	 *  My Address Page Title
	 */
	function pls_woocommerce_my_account_my_address_description( $address_desc ) {
		
		$address_title = '<div class="section-title">';
		$address_title .= '<h2>'.esc_html__('Address','pls-theme').'</h2>';
		$address_title .= '<p>' . $address_desc . '</p>';
		$address_title .= '</div>';
		return $address_title;
	}
endif;


if ( ! function_exists( 'pls_woocommerce_myaccount_edit_account_heading' ) ) :
	/**
	 * Edit Account Heading
	 */
	function pls_woocommerce_myaccount_edit_account_heading() {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My account', 'pls-theme' ) ?></h2>
			<p><?php esc_html_e( 'Edit your account details or change your password', 'pls-theme' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'pls_free_shipping_bar' ) ) :
	/**
	 * Free Shipping Progress Bar
	 */
	function pls_free_shipping_bar() {
		
		if( ! pls_get_option( 'free-shipping-bar', 0 ) ) {
			return;
		}
		
		if( empty( pls_get_option( 'free-shipping-amount', '' ) ) ) {
			return;
		}
		
		$subtotal 		= WC()->cart->subtotal;
		$minimum_amount = pls_get_option( 'free-shipping-amount', 0 );
		if( $subtotal < $minimum_amount ){
			$remaining 	= $minimum_amount - $subtotal;
			$percentage = round( ( $subtotal / $minimum_amount ) * 100 ) ;
			$missing_amount = wc_price($remaining);
			$free_shipping_text = pls_get_option( 'free-shipping-msg', 'Spend {missing_amount} to get <span>free shipping</span>' );
			$free_shipping_text = str_replace( '{missing_amount}', $missing_amount, $free_shipping_text );
			$class = 'active';
			
		}else{
			$free_shipping_text = pls_get_option( 'free-shipping-complete-msg', 'Congratulation! You have got free shipping' );
			$percentage 		= 100;
			$class 				= 'completed';
		}?>
		<div class="pls-freeshipping-bar <?php echo esc_attr($class);?>">
			<div class="freeshipping-bar">				
				<span class="pls-progress-bar active" style="width:<?php echo esc_attr( $percentage );?>%"><?php echo wp_kses_post( $percentage );?>%</span>
			</div>
			<div class="freeshipping-bar-msg"><?php echo wp_kses_post( $free_shipping_text );?></div>
		</div>
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_cart_page_wrapper' ) ) :
	/**
	 * Cart Page Wrapper Start
	 */
	function pls_woocommerce_cart_page_wrapper() { ?>
		<div class="woocommerce-cart-wrapper">
	<?php }
endif;

if ( ! function_exists( 'pls_woocommerce_cart_page_wrapper_end' ) ) :
	/**
	 * Cart Page Wrapper End
	 */
	function pls_woocommerce_cart_page_wrapper_end() { ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'pls_sticky_add_to_cart_button' ) ) :
	/**
	 * Single Product Sticky Add To Cart Button
	 */
	function pls_sticky_add_to_cart_button(){
		
		global $product;		
		$stick_add_to_cart = pls_get_option( 'sticky-add-to-cart-button', 1 );
		
		if ( !$product || ! is_singular( 'product' ) || ! $stick_add_to_cart || !$product->is_in_stock() ) {
			return;
		}
				
		?>
		<div class="pls-sticky-add-to-cart">
			<div class="container">
				<div class="row">
					<div class="col pls-sticky-add-to-cart-left">
						<div class="pls-sticky-product-image">
							<?php echo woocommerce_get_product_thumbnail( 'woocommerce_gallery_thumbnail'); ?>
						</div>
						<div class="pls-sticky-product-info">
							<div class="pls-sticky-product-title"><?php the_title(); ?></div>
							<?php if( wc_review_ratings_enabled() ) {
								echo wc_get_rating_html( $product->get_average_rating() );
							} ?>
							<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
						</div>
					</div>
					<div class="col-auto pls-sticky-add-to-cart-right">						
						<?php woocommerce_template_single_add_to_cart(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
endif;