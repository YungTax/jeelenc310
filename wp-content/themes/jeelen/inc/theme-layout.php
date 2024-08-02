<?php
/**
 * Custom functions for layout.
 *
 * @author 	PressLayouts
 * @package /inc
 * @since 1.0
 */
 
if ( ! function_exists( 'pls_get_layout' ) ) :
	/**
	 * Get layout base on current page
	 *
	 * @return string
	 */
	function pls_get_layout() {
		$layout = pls_get_option( 'blog-page-layout', 'right-sidebar' );
		
		if ( pls_get_post_meta( 'page_layout' ) ) {		
			$layout = pls_get_post_meta( 'page_layout' );
		} elseif ( is_singular( 'post' ) ) {
			$layout = pls_get_option( 'single-post-layout', 'right-sidebar' );
		} elseif( function_exists( 'pls_is_wcmp_vendor_page' ) && pls_is_wcmp_vendor_page() ) {
			$layout = pls_get_option( 'vendor-page-layout', 'left-sidebar' );
		}elseif( pls_is_wc_vendor_page() ){
			$layout = pls_get_option( 'vendor-page-layout', 'left-sidebar' );
		}elseif ( pls_is_catalog() ) {
			$layout = pls_get_option( 'shop-page-layout', 'left-sidebar' );
		}elseif( PLS_DOKAN_ACTIVE && ( dokan_is_store_page() || dokan_is_product_edit_page() )){
			$layout = 'full-width';
		} elseif( function_exists('pls_is_wcmp_vendor_page') && pls_is_wcmp_vendor_page() ){
			$layout = 'full-width';
		} elseif ( function_exists('is_product') && is_product() )  {
			$layout = pls_get_option( 'product-page-layout', 'full-width' );
		} elseif ( function_exists( 'pls_full_pages' ) && pls_full_pages() )  {
			$layout = 'full-width';
		} elseif ( is_404() ) {
			$layout = 'full-width';
		}elseif (  is_singular( 'page' ) ) { 
			$layout = pls_get_option( 'page-layout', 'full-width' );
		}
		
		$layout = !empty($layout) ? $layout : 'full-width';	
		return apply_filters( 'pls_site_layout', $layout );
	}
endif;

if ( ! function_exists( 'pls_get_sidebar_name' ) ) :
	/**
	 * Get sidebar name on current page
	 *
	 * @return string
	 */
	function pls_get_sidebar_name() {
		$layout = pls_get_layout();
		$sidebar_widget = pls_get_option( 'blog-page-sidebar', 'sidebar-1' );
		if($layout == 'full-width'){
			$sidebar_widget = '';
		}else{
			if ( pls_get_post_meta( 'sidebar_widget' ) ) {
				$sidebar_widget = pls_get_post_meta( 'sidebar_widget' );
			} elseif ( is_singular( 'post' ) ) {
				$sidebar_widget = pls_get_option( 'single-post-sidebar', 'sidebar-1' );
			} elseif( function_exists( 'pls_is_wcmp_vendor_page' ) && pls_is_wcmp_vendor_page() ) {
				$sidebar_widget = pls_get_option( 'vendor-page-sidebar', 'shop-page-sidebar' );
			} elseif( pls_is_wc_vendor_page() ){
				$sidebar_widget = pls_get_option( 'vendor-page-sidebar', 'shop-page-sidebar' );
			} elseif ( pls_is_catalog() ) {
				$sidebar_widget = pls_get_option( 'shop-page-sidebar', 'shop-page-sidebar' );
				$prefix = PLS_PREFIX;
				$cat_sidebar    = '';
				if ( function_exists( 'is_product_category' ) && is_product_category() ) {
					$queried_object = get_queried_object();
					$term_id        = $queried_object->term_id;
					$cat_sidebar    = get_term_meta( $term_id, $prefix.'sidebar', true );
					$cat_ancestors  = get_ancestors( $term_id, 'product_cat' );
					if ( empty( $cat_sidebar ) && count( $cat_ancestors ) > 0 ) {
						$parent_id   = $cat_ancestors[0];
						$cat_sidebar = get_term_meta( $parent_id, $prefix.'sidebar', true );
					}
				}
				if ( pls_is_product_brand() ) {
					$queried_object = get_queried_object();
					$term_id        = $queried_object->term_id;
					$cat_sidebar    = get_term_meta( $term_id, $prefix.'sidebar', true );
					$cat_ancestors  = get_ancestors( $term_id, 'product_brand' );
					if ( empty( $cat_sidebar ) && count( $cat_ancestors ) > 0 ) {
						$parent_id   = $cat_ancestors[0];
						$cat_sidebar = get_term_meta( $parent_id, $prefix.'sidebar', true );
					}
				}
				if( !empty( $cat_sidebar ) ){
					$sidebar_widget  = $cat_sidebar;
				}
			} elseif ( function_exists('is_product') && is_product() ) {
				$sidebar_widget = pls_get_option( 'product-page-sidebar', 'single-product-sidebar' );
			}
		}
		
		return apply_filters( 'pls_sidebar_widget', $sidebar_widget );
	}
endif;

if ( ! function_exists( 'pls_get_content_columns' ) ) :
	/**
	 * Get Bootstrap column classes for content area
	 *
	 * @since  1.0
	 *
	 * @return array Array of classes
	 */
	function pls_get_content_columns( $layout = null ) {
		$layout  		= $layout ? $layout : pls_get_layout();
		$classes 		= array( 'col-12', 'col-md-8', 'col-lg-9', 'col-xl-9' );	
		$sidebar_name 	= pls_get_sidebar_name();
		if ( 'full-width' == $layout  || ! is_active_sidebar( $sidebar_name ) ) {
			$classes = array( 'col-md-12' );
		}

		return apply_filters( 'pls_content_columns', $classes );
	}
endif;

if ( ! function_exists( 'pls_get_sidebar_columns' ) ) :
	/**
	 * Get Bootstrap column classes for sidebar area
	 *
	 * @since  1.0
	 *
	 * @return array Array of classes
	 */
	function pls_get_sidebar_columns( $layout = null ) {
		$layout  = $layout ? $layout : pls_get_layout();
		
		$classes = array( 'col-12', 'col-md-4', 'col-lg-3', 'col-xl-3' );


		return apply_filters( 'pls_sidebar_columns', $classes );
	}
endif;


if ( ! function_exists( 'pls_get_grid_class' ) ) :
	/**
	 * Function to get grid class
	 */
	function pls_get_grid_class( $column = '3' ){
		$grid_class = '';
		switch($column){
			case 1:
				$grid_class = ' col-12';
				break;
			case 2:
				$grid_class = ' col-12 col-md-6 col-lg-6';
				break;
			case 3:
				$grid_class = ' col-12 col-md-6 col-lg-4';
				break;
			case 4:
				$grid_class = ' col-12 col-md-6 col-lg-3';
				break;
		}
		
		return apply_filters( 'pls_get_grid_class', $grid_class );
	}
endif;

if ( ! function_exists( 'pls_sidebar_reverse' ) ) :
	/**
	 * Get Bootstrap reverse class
	 *
	 * @since  1.0
	 *
	 * @return string 
	 */
	function pls_sidebar_reverse( $echo = true ) {
		$layout  		= pls_get_layout();
		$reverse_class 	= '';
		if( $layout == 'left-sidebar' ){
			$reverse_class = 'flex-row-reverse';
		}
		if( $echo ){
			echo apply_filters( 'pls_sidebar_reverse', $reverse_class );
		}else{
			return apply_filters( 'pls_sidebar_reverse', $reverse_class );
		}
	}
endif;

if ( ! function_exists( 'pls_is_blog_archive' ) ) :
	/**
	 * Check is catalog
	 *
	 * @return bool
	 */
	function pls_is_blog_archive() {

		global $post;

		// Post type must be 'post'.
		$post_type = get_post_type($post);

		// Check all blog-related conditional tags, as well as the current post type, 
		// to determine if we're viewing a blog page.
		$has_blog = (( $post_type === 'post' ) && ( is_home() || is_archive() ) ) ? true : false;

		return apply_filters( 'pls_is_blog_archive', $has_blog );
	}
endif;

if ( ! function_exists( 'pls_is_catalog' ) ) :
	/**
	 * Check is catalog
	 *
	 * @return bool
	 */
	function pls_is_catalog() {

		if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag() || pls_is_product_brand() ) ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'pls_is_product_brand' ) ) :
	/**
	 * Check is catalog
	 *
	 * @return bool
	 */
	function pls_is_product_brand() {

		if ( is_tax( 'product_brand' )  ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'pls_full_pages' ) ) :
	/**
	 * Check is fullpage
	 *
	 * @return bool
	 */
	function pls_full_pages() {

		if ( ( function_exists( 'is_cart' )  && is_cart() ) ||
			 ( function_exists( 'is_checkout' )  && is_checkout() ) ||
			 ( function_exists( 'is_account_page' )  && is_account_page() ) ||
			 ( function_exists( 'is_wc_endpoint_url' )  && is_wc_endpoint_url() ) || pls_is_wishlist_page() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'pls_is_wishlist_page' ) ) :
	/**
	 * Check is wishlist page
	 *
	 * @return bool
	 */
	function pls_is_wishlist_page() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			$wishlist_pageid = get_option( 'yith_wcwl_wishlist_page_id', true );
			global $post;
			if( $post ){
				$page_id = $post->ID;
				if( $page_id == $wishlist_pageid ){
					return true;
				}
			}			
		}
		return false;
	}
endif;

if ( ! function_exists( 'pls_get_post_thumbnail_size' ) ) :
	/**
	 * Get image size
	 *
	 * @since  1.0
	 *
	 * @return string size
	 */
	function pls_get_post_thumbnail_size() {
		$layout  					= pls_get_layout();
		$blog_post_style			= pls_get_loop_prop( 'blog-post-style' );
		$blog_page_show_column		= pls_get_loop_prop( 'blog-grid-columns' );
		$blog_custom_image_size		= pls_get_loop_prop( 'blog-custom-thumbnail-size' );
		
		$size	= 'large';
		if( $layout == 'full-width' && $blog_post_style == 'blog-classic' ){
			$size	= 'full';
		} elseif(	$blog_post_style == 'blog-grid'  && ( $layout != 'full-width' || $blog_page_show_column !=  2 ) ){
			$size	='medium';
		}
		if( ! empty( $blog_custom_image_size ) ){
			$size = $blog_custom_image_size;	 
		}
		return apply_filters( 'pls_post_thumbnail_size', $size );
	}
endif;

if ( ! function_exists( 'pls_is_vendor_page' ) ) :
	function pls_is_vendor_page(){
		
		/* Dokan */
		if ( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			return true;
		}

		/* WC Vendor */
		if ( pls_is_wc_vendor_page() ) {
			return true;
		}	
		
		/* WCMP plugin*/
		if ( function_exists( 'pls_is_wcmp_vendor_page' ) && pls_is_wcmp_vendor_page() ) {
			return true;
		}
		
		/* WCFM plugin*/
		if ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) {
			return true;
		}
		return false;
			
	}
endif;

if ( ! function_exists( 'pls_is_wc_vendor_page' ) ) :
	/**
	 * Check is vendor page
	 *
	 * @return bool
	 */
	function pls_is_wc_vendor_page() {
	
		if ( class_exists( 'WCV_Vendors' ) && method_exists( 'WCV_Vendors', 'is_vendor_page' ) ) {
			return WCV_Vendors::is_vendor_page();
		}		
		return false;
	}
endif;