<?php
/**
 * Customize theme style functionality for PLS
 *
 * @package pls
 */

/**
 * Load dynamic css
 */
if ( ! function_exists( 'pls_theme_style' ) ) :
	function pls_theme_style() {
		
		/** Site Fonts */
		$style_options['font']['primary'] = pls_get_option( 'body-font', array(
			'font-weight'  		=> '400', 
			'font-family' 		=> 'Jost',
			'google'      		=> true,
			'font-backup' 		=> 'sans-serif',
			'font-size'   		=> '16px',
			'letter-spacing'	=> '',
		) );
		$style_options['font']['secondary'] = pls_get_option( 'secondary-font', array(
			'font-weight'  		=> '400',
			'font-family' 		=> 'Jost',
			'google'      		=> true,
			'font-backup' 		=> 'sans-serif',
			'color'       		=> '#333333',
		) );
	
		/* Site Layouts Options */
		$style_options['site']['site_layouts'] = pls_get_option( 'theme-layout', 'full' );
		$style_options['site']['container_width'] = pls_get_option( 'theme-container-width', 1396 );
		if( 'wide' == pls_get_option( 'theme-layout', 'full' ) ) {
			$style_options['site']['container_width'] = pls_get_option( 'theme-container-wide-width', 1820 );
		}
		$style_options['site']['grip_gap'] = pls_get_option( 'theme-grid-gap', 15 );
			
		$style_options['site']['wrapper_background'] = pls_get_option( 'body-content-background', array( 
				'background-color' 		=> '#ffffff', 
				'background-image' 		=> '',
				'background-repeat' 	=> '',
				'background-size' 		=> '',
				'background-attachment' => '',
				'background-position' 	=> ''
		) );
		$style_options['site']['link_color'] = pls_get_option( 'body-link-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#000000',
		) );
		$style_options['site']['border'] = pls_get_option( 'theme-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		$style_options['site']['preloader_background'] = pls_get_option( 'preloader-background', '#222222' );
		$style_options['site']['preloader_image'] = 'none';
		if( 'predefine-loader' != pls_get_option( 'preloader-image', 'predefine-loader' ) ){
			$url = pls_get_option( 'preloader-custom-image', '' );
			if(isset( $url['url']) ){
				$style_options['site']['preloader_image'] = $url['url'];
			}
		}
		
		/** Site Button Colors */
		$style_options['button']['background'] = pls_get_option( 'button-background', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['button']['color'] = pls_get_option( 'button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		
		/** Shop Page Cart Button Colors */
		$style_options['button']['shop_cart_background'] = pls_get_option( 'shop-cart-button-background', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['button']['shop_cart_color'] = pls_get_option( 'shop-cart-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		
		/** Product Page Cart Button Colors */
		$style_options['button']['product_cart_background'] = pls_get_option( 'product-cart-button-background', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['button']['product_cart_color'] = pls_get_option( 'product-cart-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		
		/** Buy Now Button Colors */
		$style_options['button']['buy_now_background'] = pls_get_option( 'buy-now-button-background', array(
			'regular' 	=> '#e5e5e5',
			'hover' 	=> '#222222',
		) );
		$style_options['button']['buy_now_color'] = pls_get_option( 'buy-now-button-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#ffffff',
		) );
		
		/** Checkout Button Colors */
		$style_options['button']['checkout_background'] = pls_get_option( 'checkout-button-background', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['button']['checkout_color'] = pls_get_option( 'checkout-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
						
		/* Promo Bar */	
		$style_options['promo_bar']['max_height'] = pls_get_option( 'promo-bar-height', 40 );
		$style_options['promo_bar']['button_text'] = pls_get_option( 'promo-button-text-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
		$style_options['promo_bar']['button_background'] = pls_get_option( 'promo-button-background', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#000000',
		) );
		
		/** Topbar Colors Options */
		$style_options['topbar']['link_color'] = pls_get_option( 'topbar-link-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#e9e9e9',
		) );
		$style_options['topbar']['border'] = pls_get_option( 'topbar-border', array(
			'border-color'  => '#222222',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['topbar']['height'] = str_replace( 'px', '', pls_get_option( 'topbar-height', array( 'height' => 42 ) ) );
	
		/** Header Colors Options */ 
		$style_options['header']['link_color'] = pls_get_option( 'header-link-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#000000',
		) );
		$style_options['header']['border'] = pls_get_option( 'header-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['header']['height'] = str_replace( 'px', '', pls_get_option( 'header-height', array( 'height' => 85 ) ) );
		$style_options['header']['mobile_height'] = str_replace( 'px', '', pls_get_option( 'header-mobile-height', array( 'height' => 60 ) ) );
		$style_options['header']['sticky_height'] = str_replace( 'px', '', pls_get_option( 'header-sticky-main-height', array( 'height' => 65 ) ) );
				
		/** Mobile Header */ 
		$style_options['mobile_header']['link_color'] = pls_get_option( 'header-mobile-link-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#000000',
		) );
		$style_options['mobile_header']['border'] = pls_get_option('header-mobile-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		/** Navigation */
		$style_options['navigation']['link_color'] = pls_get_option( 'navigation-link-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['navigation']['border'] = pls_get_option( 'navigation-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['navigation']['height'] = str_replace( 'px', '', pls_get_option( 'navigation-height', array( 'height' => 56 ) ) );
		
		$style_options['main_menu']['link_color'] = pls_get_option( 'first-level-menu-link-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		
		$style_options['categories_menu']['title_color'] = pls_get_option( 'categories-menu-title-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#ffffff',
		) );
		$style_options['categories_menu']['link_color'] = pls_get_option( 'categories-menu-link-color', array(
			'regular' 	=> '#555555',
			'hover' 	=> '#222222',
		) );
		$style_options['categories_menu']['border'] = pls_get_option( 'categories-menu-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		$menu_link_color = $style_options['popup_menu']['link_color'] = pls_get_option( 'popup-menu-link-color', array(
			'regular' 	=> '#555555',
			'hover' 	=> '#222222',
		) );
	
		/** Footer */
		$style_options['footer']['link_color'] = pls_get_option('footer-link-color', array(
			'regular' 	=> '#777777',
			'hover' 	=> '#222222',
		) );
		$style_options['footer']['border'] = pls_get_option('footer-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['footer']['social_color'] = pls_get_option('footer-link-color', array(
			'regular' 	=> '#777777',
			'hover' 	=> '#222222',
		) );
		
		/** Footer Subscribe **/
		$style_options['footer_subscribe']['button_color'] = pls_get_option( 'subscribe-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		$style_options['footer_subscribe']['button_background'] = pls_get_option( 'subscribe-button-background', array(
			'regular' 	=> '#333333',
			'hover' 	=> '#212121',
		) );
		$style_options['footer_subscribe']['border'] = pls_get_option( 'footer-subscribe-border', array(
			'border-color'  => '#222222',
			'border-style'  => 'solid',
			'border-top'    => '2px',
			'border-right'  => '2px',
			'border-bottom' => '2px',
			'border-left'   => '2px'
		) );
		
		/** Copyright */
		$style_options['copyright']['link_color'] = pls_get_option( 'copyright-link-color', array(
			'regular' 	=> '#777777',
			'hover' 	=> '#222222',
		) );
		$style_options['copyright']['border'] = pls_get_option( 'copyright-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
					
		/** Newsletter Popup Options */ 
		$style_options['newsletter']['button_background'] = pls_get_option( 'newsletter-button-bg-color', array(
			'regular' 	=> '#222222',
			'hover' 	=> '#222222',
		) );
		$style_options['newsletter']['button_color'] = pls_get_option( 'newsletter-button-text-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		$style_options['newsletter']['border'] = pls_get_option('newsletter-border', array(
			'border-color'  => '#e5e5e5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		/* WooCommerce */
		$product_tabs_content_width = pls_get_post_meta( 'single_product_tabs_content_width' );
		if( ! $product_tabs_content_width && $product_tabs_content_width < 30 ) {
			$product_tabs_content_width = pls_get_option( 'single-product-tabs-content-width', 70 );
		}		
		$style_options['woocommerce']['product_tabs_content_width'] = $product_tabs_content_width;
		
		/*Product Content Background Color */
		$product_content_background = pls_get_post_meta( 'product_content_background' );
		if( ! $product_content_background || 'default' == $product_content_background ) {
			$product_content_background = pls_get_option( 'product-content-background', 'none' );
		}
		
		$has_product_content_background = false;		
		if( 'custom' == $product_content_background || 'dark' == $product_content_background ){
			$has_product_content_background = true;
		}elseif( 'none' == $product_content_background ){
				$has_product_content_background = false;
		}
		
		$product_content_background_color =  array( 'background-color' => '#2d2d2d' );
		if( $has_product_content_background &&  'custom' == $product_content_background ){
			$color	= pls_get_post_meta( 'product_content_background_color' );
			$product_content_background_color = array( 'background-color' => $color );
			if( empty( $product_content_background_color['background-color'] ) ) { 
				$product_content_background_color = pls_get_option( 'body-content-background', array( 
						'background-color' 	=> '#f5f5f5'
				) );
			}
		}
		
		$theme_css = '		
		:root {
			/* Site Font */
			--pls-primary-font: "'.$style_options['font']['primary']['font-family'].'";
			--pls-secondary-font: "'.$style_options['font']['secondary']['font-family'].'";			
			--pls-font-size: '. $style_options['font']['primary']['font-size'] .';
			--pls-font-weight: '. $style_options['font']['primary']['font-weight'] .';
			--pls-line-height: 1.75;		
			
			/* Site Container Width & Gap */
			--pls-container-width: '.$style_options['site']['container_width'].'px;
			--pls-grid-gap: '. pls_get_option('theme-grid-gap',15) .'px;
			
			/* Site Colors */
			--pls-primary-color: '. pls_get_option('primary-color','#222222') .';
			--pls-primary-inverse-color: '. pls_get_option('primary-inverse-color','#ffffff') .';
			--pls-secondary-color: '. pls_get_option('secondary-color','#222222') .';
			--pls-secondary-inverse-color: '. pls_get_option('secondary-inverse-color','#ffffff') .';
			--pls-text-color: '. pls_get_option('body-text-color','#777777') .';
			--pls-hover-background-color: '. pls_get_option('theme-hover-background-color','#f5f5f5') .';
			--pls-body-background: '. $style_options['site']['wrapper_background']['background-color'] .';
			--pls-link-color: '. $style_options['site']['link_color']['regular'] .';
			--pls-link-hover-color: '. $style_options['site']['link_color']['hover'] .';
			--pls-border-top: '. $style_options['site']['border']['border-top'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--pls-border-right: '. $style_options['site']['border']['border-right'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--pls-border-bottom: '. $style_options['site']['border']['border-bottom'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--pls-border-left: '. $style_options['site']['border']['border-left'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';			
			--pls-border-color: '.$style_options['site']['border']['border-color'].';
			--pls-border-radius: '. pls_get_option('theme-border-radius',0) .'px;
			--pls-input-background: '. pls_get_option('body-input-background','#ffffff') .';
			--pls-input-color: '. pls_get_option('body-input-color','#777777') .';
			--pls-preloader-background: '.$style_options['site']['preloader_background'].';
			--pls-preloader-background-image: '.$style_options['site']['preloader_image'].';
			
			/* Site Button */
			--pls-button-color: '.$style_options['button']['color']['regular'].';
			--pls-button-hover-color: '.$style_options['button']['color']['hover'].';
			--pls-button-bg-color: '.$style_options['button']['background']['regular'].';
			--pls-button-bg-hover-color: '.$style_options['button']['background']['hover'].';			
			--pls-shop-cart-button-color: '.$style_options['button']['shop_cart_color']['regular'].';
			--pls-shop-cart-button-hover-color: '.$style_options['button']['shop_cart_color']['hover'].';
			--pls-shop-cart-button-bg-color: '.$style_options['button']['shop_cart_background']['regular'].';
			--pls-shop-cart-button-bg-hover-color: '.$style_options['button']['shop_cart_background']['hover'].';			
			--pls-product-cart-button-color: '.$style_options['button']['product_cart_color']['regular'].';
			--pls-product-cart-button-hover-color: '.$style_options['button']['product_cart_color']['hover'].';
			--pls-product-cart-button-bg-color: '.$style_options['button']['product_cart_background']['regular'].';
			--pls-product-cart-button-bg-hover-color: '.$style_options['button']['product_cart_background']['hover'].';		
			--pls-buy-now-button-color: '.$style_options['button']['buy_now_color']['regular'].';
			--pls-buy-now-button-hover-color: '.$style_options['button']['buy_now_color']['hover'].';
			--pls-buy-now-button-bg-color: '.$style_options['button']['buy_now_background']['regular'].';
			--pls-buy-now-button-bg-hover-color: '.$style_options['button']['buy_now_background']['hover'].';			
			--pls-checkout-button-color: '.$style_options['button']['checkout_color']['regular'].';
			--pls-checkout-button-hover-color: '.$style_options['button']['checkout_color']['hover'].';
			--pls-checkout-button-bg-color: '.$style_options['button']['checkout_background']['regular'].';
			--pls-checkout-button-bg-hover-color: '.$style_options['button']['checkout_background']['hover'].';
			
			/* Promo Bar */			
			--pls-promo-bar-height: '.$style_options['promo_bar']['max_height'].'px;
			--pls-promo-bar-button-color: '.$style_options['promo_bar']['button_text']['regular'].';
			--pls-promo-bar-button-hover-color: '.$style_options['promo_bar']['button_text']['hover'].';
			--pls-promo-bar-button-bg-color: '.$style_options['promo_bar']['button_background']['regular'].';
			--pls-promo-bar-button-bg-hover-color: '.$style_options['promo_bar']['button_background']['hover'].';
			
			/* Site Header */
			--pls-logo-width : '.pls_get_option('header-logo-width',360).'px;
			
			/* Site Topbar */
			--pls-topbar-text-color: '. pls_get_option('topbar-text-color','#ffffff') .';
			--pls-topbar-link-color: '. $style_options['topbar']['link_color']['regular'] .';
			--pls-topbar-link-hover-color: '. $style_options['topbar']['link_color']['hover'] .';
			--pls-topbar-border-top: '. $style_options['topbar']['border']['border-top'].' '.$style_options['topbar']['border']['border-style'].' '.$style_options['topbar']['border']['border-color'].';
			--pls-topbar-border-right: '. $style_options['topbar']['border']['border-right'].' '.$style_options['topbar']['border']['border-style'].' '.$style_options['topbar']['border']['border-color'].';
			--pls-topbar-border-bottom: '. $style_options['topbar']['border']['border-bottom'].' '.$style_options['topbar']['border']['border-style'].' '.$style_options['topbar']['border']['border-color'].';
			--pls-topbar-border-left: '. $style_options['topbar']['border']['border-left'].' '.$style_options['topbar']['border']['border-style'].' '.$style_options['topbar']['border']['border-color'].';
			--pls-topbar-border-color: '.$style_options['topbar']['border']['border-color'].';
			--pls-topbar-height: '.$style_options['topbar']['height']['height'].'px;
			
			/* Sit Main Header */			
			--pls-header-text-color: '.pls_get_option('header-text-color','#222222').';
			--pls-header-link-color: '.$style_options['header']['link_color']['regular'].';
			--pls-header-link-hover-color: '.$style_options['header']['link_color']['hover'].';
			--pls-header-border-top: '. $style_options['header']['border']['border-top'].' '.$style_options['header']['border']['border-style'].' '.$style_options['header']['border']['border-color'].';
			--pls-header-border-right: '. $style_options['header']['border']['border-right'].' '.$style_options['header']['border']['border-style'].' '.$style_options['header']['border']['border-color'].';
			--pls-header-border-bottom: '. $style_options['header']['border']['border-bottom'].' '.$style_options['header']['border']['border-style'].' '.$style_options['header']['border']['border-color'].';
			--pls-header-border-left: '. $style_options['header']['border']['border-left'].' '.$style_options['header']['border']['border-style'].' '.$style_options['header']['border']['border-color'].';
			--pls-header-height: '.$style_options['header']['height']['height'].'px;
			--pls-mobile-header-height: '.$style_options['header']['mobile_height']['height'].'px;
			--pls-sticky-header-height: '.$style_options['header']['sticky_height']['height'].'px;

			/* Site Mobile Header */
			--pls-mobile-header-text-color: '.pls_get_option('header-mobile-text-color','#777777').';
			--pls-mobile-header-background-color: '.pls_get_option('header-mobile-background','#ffffff').';
			--pls-mobile-header-link-color: '.$style_options['mobile_header']['link_color']['regular'].';
			--pls-mobile-header-link-hover-color: '.$style_options['mobile_header']['link_color']['hover'].';
			--pls-mobile-header-border-top: '. $style_options['mobile_header']['border']['border-top'].' '.$style_options['mobile_header']['border']['border-style'].' '.$style_options['mobile_header']['border']['border-color'].';
			--pls-mobile-header-border-right: '. $style_options['mobile_header']['border']['border-right'].' '.$style_options['mobile_header']['border']['border-style'].' '.$style_options['mobile_header']['border']['border-color'].';
			--pls-mobile-header-border-bottom: '. $style_options['mobile_header']['border']['border-bottom'].' '.$style_options['mobile_header']['border']['border-style'].' '.$style_options['mobile_header']['border']['border-color'].';
			--pls-mobile-header-border-left: '. $style_options['mobile_header']['border']['border-left'].' '.$style_options['mobile_header']['border']['border-style'].' '.$style_options['mobile_header']['border']['border-color'].';
			
			/* Site Navigation Header */
			--pls-navigation-text-color: '.pls_get_option('navigation-text-color','#222222').';
			--pls-navigation-link-color: '.$style_options['navigation']['link_color']['regular'].';
			--pls-navigation-link-hover-color: '.$style_options['navigation']['link_color']['hover'].';
			--pls-navigation-border-top: '. $style_options['navigation']['border']['border-top'].' '.$style_options['navigation']['border']['border-style'].' '.$style_options['navigation']['border']['border-color'].';
			--pls-navigation-border-right: '. $style_options['navigation']['border']['border-right'].' '.$style_options['navigation']['border']['border-style'].' '.$style_options['navigation']['border']['border-color'].';
			--pls-navigation-border-bottom: '. $style_options['navigation']['border']['border-bottom'].' '.$style_options['navigation']['border']['border-style'].' '.$style_options['navigation']['border']['border-color'].';
			--pls-navigation-border-left: '. $style_options['navigation']['border']['border-left'].' '.$style_options['navigation']['border']['border-style'].' '.$style_options['navigation']['border']['border-color'].';
			--pls-navigation-height: '.$style_options['navigation']['height']['height'].'px;
			
			/* Site Main Menu Color */
			--pls-main-menu-link-color: '.$style_options['main_menu']['link_color']['regular'].';
			--pls-main-menu-link-hover-color: '.$style_options['main_menu']['link_color']['hover'].';
			--pls-main-menu-bg-color: '.pls_get_option('first-level-menu-background-color','#f5f5f5').';

			/* Site Categories Menu */
			--pls-categories-menu-title-color: '.$style_options['categories_menu']['title_color']['regular'].';
			--pls-categories-menu-title-hover-color: '.$style_options['categories_menu']['title_color']['hover'].';
			--pls-categories-menu-title-background: '.pls_get_option('categories-menu-title-background','transparent').';
			--pls-categories-menu-title-hover-background: '.pls_get_option('categories-menu-title-hover-background','#222222').';
			--pls-categories-menu-wrapper-background: '.pls_get_option('categories-menu-wrapper-background','#ffffff').';
			--pls-categories-menu-hover-background: '.pls_get_option('categories-menu-hover-background','#f5f5f5').';
			--pls-categories-menu-link-color: '.$style_options['categories_menu']['link_color']['regular'].';
			--pls-categories-menu-link-hover-color: '.$style_options['categories_menu']['link_color']['hover'].';
			--pls-categories-menu-border-top: '. $style_options['categories_menu']['border']['border-top'].' '.$style_options['categories_menu']['border']['border-style'].' '.$style_options['categories_menu']['border']['border-color'].';
			--pls-categories-menu-border-right: '. $style_options['categories_menu']['border']['border-right'].' '.$style_options['categories_menu']['border']['border-style'].' '.$style_options['categories_menu']['border']['border-color'].';
			--pls-categories-menu-border-bottom: '. $style_options['categories_menu']['border']['border-bottom'].' '.$style_options['categories_menu']['border']['border-style'].' '.$style_options['categories_menu']['border']['border-color'].';
			--pls-categories-menu-border-left: '. $style_options['categories_menu']['border']['border-left'].' '.$style_options['categories_menu']['border']['border-style'].' '.$style_options['categories_menu']['border']['border-color'].';
			
			/* Site Popup Menu */
			--pls-popup-menu-text-color: '.pls_get_option('popup-menu-text-color','#555555').';
			--pls-popup-menu-title-color: '.pls_get_option('popup-menu-title-color','#555555').';
			--pls-popup-menu-hover-background: '.pls_get_option( 'popup-menu-hover-background', '#ffffff' ).';
			--pls-popup-menu-link-color: '.$style_options['popup_menu']['link_color']['regular'].';
			--pls-popup-menu-link-hover-color: '.$style_options['popup_menu']['link_color']['hover'].';
			
			/* Footer */
			--pls-footer-title-color: '.pls_get_option('footer-heading-color','#222222').';
			--pls-footer-text-color: '.pls_get_option('footer-text-color','#545454').';
			--pls-footer-link-color: '.$style_options['footer']['link_color']['regular'].';
			--pls-footer-link-hover-color: '.$style_options['footer']['link_color']['hover'].';
			--pls-footer-border-top: '. $style_options['footer']['border']['border-top'].' '.$style_options['footer']['border']['border-style'].' '.$style_options['footer']['border']['border-color'].';
			--pls-footer-border-right: '. $style_options['footer']['border']['border-right'].' '.$style_options['footer']['border']['border-style'].' '.$style_options['footer']['border']['border-color'].';
			--pls-footer-border-bottom: '. $style_options['footer']['border']['border-bottom'].' '.$style_options['footer']['border']['border-style'].' '.$style_options['footer']['border']['border-color'].';
			--pls-footer-border-left: '. $style_options['footer']['border']['border-left'].' '.$style_options['footer']['border']['border-style'].' '.$style_options['footer']['border']['border-color'].';
			
			/* Footer Subscribe */
			--pls-footer-subscribe-text-color: '.pls_get_option('footer-subscribe-text-color','#ffffff').';
			--pls-footer-subscribe-button-color: '.$style_options['footer_subscribe']['button_color']['regular'].';
			--pls-footer-subscribe-button-hover-color: '.$style_options['footer_subscribe']['button_color']['hover'].';
			--pls-footer-subscribe-button-bg-color: '.$style_options['footer_subscribe']['button_background']['regular'].';
			--pls-footer-subscribe-button-bg-hover-color: '.$style_options['footer_subscribe']['button_background']['hover'].';
			--pls-footer-subscribe-border-top: '. $style_options['footer_subscribe']['border']['border-top'].' '.$style_options['footer_subscribe']['border']['border-style'].' '.$style_options['footer_subscribe']['border']['border-color'].';
			--pls-footer-subscribe-border-right: '. $style_options['footer_subscribe']['border']['border-right'].' '.$style_options['footer_subscribe']['border']['border-style'].' '.$style_options['footer_subscribe']['border']['border-color'].';
			--pls-footer-subscribe-border-bottom: '. $style_options['footer_subscribe']['border']['border-bottom'].' '.$style_options['footer_subscribe']['border']['border-style'].' '.$style_options['footer_subscribe']['border']['border-color'].';
			--pls-footer-subscribe-border-left: '. $style_options['footer_subscribe']['border']['border-left'].' '.$style_options['footer_subscribe']['border']['border-style'].' '.$style_options['footer_subscribe']['border']['border-color'].';
			--pls-footer-subscribe-input-background: '. pls_get_option('footer-subscribe-input-background','#f5f5f5') .';
			--pls-footer-subscribe-input-color: '. pls_get_option('footer-subscribe-input-color','#777777') .';
					
			/* Footer Copyright */
			--pls-copyright-text-color: '.pls_get_option('copyright-text-color','#777777').';
			--pls-copyright-link-color: '.$style_options['copyright']['link_color']['regular'].';
			--pls-copyright-link-hover-color: '.$style_options['copyright']['link_color']['hover'].';
			--pls-copyright-border-top: '. $style_options['copyright']['border']['border-top'].' '.$style_options['copyright']['border']['border-style'].' '.$style_options['copyright']['border']['border-color'].';
			--pls-copyright-border-right: '. $style_options['copyright']['border']['border-right'].' '.$style_options['copyright']['border']['border-style'].' '.$style_options['copyright']['border']['border-color'].';
			--pls-copyright-border-bottom: '. $style_options['copyright']['border']['border-bottom'].' '.$style_options['copyright']['border']['border-style'].' '.$style_options['copyright']['border']['border-color'].';
			--pls-copyright-border-left: '. $style_options['copyright']['border']['border-left'].' '.$style_options['copyright']['border']['border-style'].' '.$style_options['copyright']['border']['border-color'].';
			
			/* WooCommerce */
			--pls-product-price-color: '.pls_get_option('product-price-color','#222222').';
			--pls-woocommece-sale-label-color: '.pls_get_option('sale-product-label-color','#ffa965').';
			--pls-woocommece-new-label-color: '.pls_get_option('new-product-label-color','#58cbe5').';
			--pls-woocommece-featured-label-color: '.pls_get_option('featured-product-label-color','#ff554e').';
			--pls-woocommece-outofstock-label-color: '.pls_get_option('outofstock-product-label-color','#a9a9a9').';			
			
			/* Newsletter */
			--pls-newsletter-popup-width: '.pls_get_option('newsletter-popup-width',750).'px;
			--pls-newsletter-popup-text-color: '.pls_get_option('newsletter-text-color','#777777').';
			--pls-newsletter-popup-button-color: '.$style_options['newsletter']['button_color']['regular'].';
			--pls-newsletter-popup-button-hover-color: '.$style_options['newsletter']['button_color']['hover'].';
			--pls-newsletter-popup-button-bg-color: '.$style_options['newsletter']['button_background']['regular'].';
			--pls-newsletter-popup-button-bg-hover-color: '.$style_options['newsletter']['button_background']['hover'].';
			--pls-newsletter-popup-border-top: '. $style_options['newsletter']['border']['border-top'].' '.$style_options['newsletter']['border']['border-style'].' '.$style_options['newsletter']['border']['border-color'].';
			--pls-newsletter-popup-border-right: '. $style_options['newsletter']['border']['border-right'].' '.$style_options['newsletter']['border']['border-style'].' '.$style_options['newsletter']['border']['border-color'].';
			--pls-newsletter-popup-border-bottom: '. $style_options['newsletter']['border']['border-bottom'].' '.$style_options['newsletter']['border']['border-style'].' '.$style_options['newsletter']['border']['border-color'].';
			--pls-newsletter-popup-border-left: '. $style_options['newsletter']['border']['border-left'].' '.$style_options['newsletter']['border']['border-style'].' '.$style_options['newsletter']['border']['border-color'].';
			--pls-newsletter-popup-border-radius: '.pls_get_option('newsletter-border-radius',0).'px;					
		}';
		
		$theme_css .= '
			.pls-no-sidebar .pls-product-content-background .pls-product-container:before {
				background-color: '.$product_content_background_color['background-color'].';
			}
			.woocommerce-tabs.tabs-layout .tab-content-wrap {
				width: '.$style_options['woocommerce']['product_tabs_content_width'].'%;
			}
		';
		
		if( pls_get_option( 'single-line-product-title', 1 ) ){
			$theme_css .= '
			.woocommerce ul.cart_list li .product-title, 
			.woocommerce ul.product_list_widget li .product-title,
			.widget.widget_layered_nav li  .nav-title,
			.products.grid-view .product-cats,
			.products.grid-view .product-title,
			.pls-bought-together-products .product-title,
			.products .woocommerce-loop-category__title a{
				text-overflow: ellipsis;
				white-space: nowrap;
				overflow: hidden;
			}';
		}		
		
		if( is_rtl() ){
			$theme_css .= '
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active {
				border-right-style: solid !important;
				border-left-style: none !important;
			}
			@media (min-width: 768px) {
				.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tabs-content-wrapper {
					border-style: solid none solid solid !important;
				}
			}
			.elementor-widget-tabs .elementor-tabs {
				text-align: right !important;
			}
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active:after,
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active:before{
				left: 0 !important;
				right: inherit !important;
			}';
		}
		
		/*
		* General
		*/
		if( ! pls_get_option( 'header-icon-text', 1 ) ) {
			$theme_css .= '
			.pls-header-icon-text{
				display: none;
			}';
		}
		
		$theme_css .= pls_get_option( 'custom-css', '' );	
		$theme_css .= pls_custom_font();
		
		$theme_css = apply_filters( 'pls_custom_css', $theme_css, $style_options );
		$theme_css = pls_cleanup_css( $theme_css );
		
		return $theme_css;
	}
endif;

if ( ! function_exists( 'pls_custom_font' ) ) :
	function pls_custom_font() {
		/* Custom Font Option */
		$enable_custom_font1 = pls_get_option( 'custom-font1', 0 );
		$enable_custom_font2 = pls_get_option( 'custom-font2', 0 );
		$enable_custom_font3 = pls_get_option( 'custom-font3', 0 );
		$font_face = array();
		if( $enable_custom_font1 ){
			$font1_name 			= pls_get_option('custom-font1-name',''); 
			$custom_font1_woff 		= pls_get_custom_fonturl('custom-font1-woff');
			$custom_font1_woff2 	= pls_get_custom_fonturl('custom-font1-woff2');
			$custom_font1_ttf 		= pls_get_custom_fonturl('custom-font1-ttf');
			$custom_font1_svg		= pls_get_custom_fonturl('custom-font1-svg');
			$custom_font1_eot 		= pls_get_custom_fonturl('custom-font1-eot');
			if( !empty( $font1_name ) && ( $custom_font1_woff != '' || $custom_font1_woff2 != '' || $custom_font1_ttf != '' || $custom_font1_svg != '' || $custom_font1_eot != '' ) ){				
				$font_face[] = '@font-face {font-family: "'.$font1_name.'";
				  src: url("'.$custom_font1_eot.'"); /* IE9*/
				  src: url("'.$custom_font1_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font1_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font1_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font1_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font1_svg.'#'.$font1_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		if( $enable_custom_font2 ){
			$font2_name 			= pls_get_option('custom-font2-name',''); 
			$custom_font2_woff 		= pls_get_custom_fonturl('custom-font2-woff');
			$custom_font2_woff2 	= pls_get_custom_fonturl('custom-font2-woff2');
			$custom_font2_ttf 		= pls_get_custom_fonturl('custom-font2-ttf');
			$custom_font2_svg		= pls_get_custom_fonturl('custom-font2-svg');
			$custom_font2_eot 		= pls_get_custom_fonturl('custom-font2-eot');
			if( !empty($font2_name ) && ( $custom_font2_woff != '' || $custom_font2_woff2 != '' || $custom_font2_ttf != '' || $custom_font2_svg != '' || $custom_font2_eot != '' ) ){
				$font_face[] = '@font-face {font-family: "'.$font2_name.'";
				  src: url("'.$custom_font2_eot.'"); /* IE9*/
				  src: url("'.$custom_font2_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font2_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font2_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font2_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font2_svg.'#'.$font2_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		if( $enable_custom_font3 ){
			$font3_name 			= pls_get_option('custom-font3-name',''); 
			$custom_font3_woff 		= pls_get_custom_fonturl('custom-font3-woff');
			$custom_font3_woff2 	= pls_get_custom_fonturl('custom-font3-woff2');
			$custom_font3_ttf 		= pls_get_custom_fonturl('custom-font3-ttf');
			$custom_font3_svg		= pls_get_custom_fonturl('custom-font3-svg');
			$custom_font3_eot 		= pls_get_custom_fonturl('custom-font3-eot');
			if( !empty( $font3_name) && ( $custom_font3_woff != '' || $custom_font3_woff2 != '' || $custom_font3_ttf != '' || $custom_font3_svg != '' || $custom_font3_eot != '' ) ){				
				$font_face[] = '@font-face {font-family: "'.$font3_name.'";
				  src: url("'.$custom_font3_eot.'"); /* IE9*/
				  src: url("'.$custom_font3_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font3_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font3_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font3_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font3_svg.'#'.$font3_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		return !empty( $font_face ) ? implode(' ', $font_face ) : '';
	}
endif;

function pls_get_custom_fonturl( $font_type ){
	$custom_font_file = pls_get_option( $font_type );
	return (isset($custom_font_file['url']) && !empty($custom_font_file['url'])) ? $custom_font_file['url'] : '';
}