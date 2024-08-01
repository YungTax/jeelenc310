<?php 
/**
 * Action/filter hooks used for woocommerce functions/templates.
 *
 * @package /inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_theme_support( 'woocommerce');
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter('woocommerce_show_page_title', '__return_false');
add_filter( 'body_class', 'pls_body_woocommerce_classes' );

/**
 * PLS Header
 *
 * @see pls_ajax_wishlist_count()
 * @see pls_ajax_compare_count()
 * @see pls_empty_mini_cart_button()
 */
add_action( 'wp_ajax_pls_ajax_wishlist_count', 'pls_ajax_wishlist_count' );
add_action( 'wp_ajax_nopriv_pls_ajax_wishlist_count', 'pls_ajax_wishlist_count' );
add_action( 'wp_ajax_pls_ajax_compare_count', 'pls_ajax_compare_count' );
add_action( 'wp_ajax_nopriv_pls_ajax_compare_count', 'pls_ajax_compare_count' );
add_action( 'pls_after_empty_mini_cart', 'pls_empty_mini_cart_button', 20 );

/**
 * Content Wrappers
 *
 * @see pls_output_content_wrapper()
 * @see pls_output_content_wrapper_end()
 * @see pls_reset_loop()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'pls_output_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'pls_output_content_wrapper_end', 10 );

add_action( 'woocommerce_after_shop_loop', 'pls_reset_loop', 999 );

/**
 * Products Loop
 *
 * @see pls_woocommerce_before_shop_loop()
 * @see pls_woocommerce_product_loop_view()
 * @see pls_woocommerce_product_loop_show()
 * @see pls_woocommerce_active_filter_widgets()
 * @see pls_woocommerce_clear_filters_btn()
 * @see pls_loop_product_wrapper()
 * @see pls_before_shop_loop_item_title()
 * @see pls_woocommerce_output_product_labels()
 * @see pls_woocommerce_product_loop_quick_view_button()
 * @see pls_woocommerce_template_loop_product_thumbnail()
 * @see pls_woocommerce_shop_loop_item_title()
 * @see pls_woocommerce_loop_product_info_wrapper()
 * @see pls_woocommerce_product_loop_categories()
 * @see pls_woocommerce_product_price_buttons_wrapper()
 * @see pls_woocommerce_after_shop_loop_item_title()
 * @see pls_woocommerce_product_sale_percentage()
 * @see pls_woocommerce_product_loop_buttons_variations()
 * @see pls_woocommerce_template_loop_action_buttons()
 * @see pls_woocommerce_product_loop_cart_button()
 * @see pls_woocommerce_product_loop_wishlist_button()
 * @see pls_woocommerce_product_loop_compare_button()
 * @see pls_woocommerce_stock_progress_bar()
 * @see pls_woocommerce_sale_product_countdown()
 * @see pls_woocommerce_after_shop_loop_item()
 * @see pls_woocommerce_product_wrapper_end()
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_before_shop_loop', 'pls_woocommerce_before_shop_loop', 20 );
add_action( 'pls_woocommerce_shop_loop_header_left', 'pls_woocommerce_product_off_canvas_sidebar', 10 );
add_action( 'pls_woocommerce_shop_loop_header_left', 'woocommerce_result_count', 20 );
add_action( 'pls_woocommerce_shop_loop_header_right', 'pls_product_filter_top', 5 );
add_action( 'pls_woocommerce_shop_loop_header_right', 'woocommerce_catalog_ordering', 10 );
add_action( 'pls_woocommerce_shop_loop_header_right', 'pls_woocommerce_product_loop_show', 20 );
add_action( 'pls_woocommerce_shop_loop_header_right', 'pls_woocommerce_product_loop_view', 30 );
add_action( 'woocommerce_before_shop_loop', 'pls_shop_top_filter_widgets', 25 );

add_action( 'woocommerce_before_shop_loop', 'pls_woocommerce_active_filter_widgets', 30 );
add_action( 'pls_woocommerce_before_active_filters_widgets', 'pls_woocommerce_clear_filters_btn', 30 ); 

add_action( 'woocommerce_before_shop_loop_item_title', 'pls_woocommerce_output_product_labels', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'pls_woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'pls_woocommerce_sale_product_countdown', 15 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'pls_woocommerce_product_loop_cart_button', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'pls_woocommerce_stock_progress_bar', 10 );

/**
 * Subcategories Loop.
 */
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

add_action( 'woocommerce_before_subcategory_title', 'woocommerce_template_loop_category_link_open', 9 );
add_action( 'woocommerce_before_subcategory_title', 'woocommerce_template_loop_category_link_close', 11 );
add_action( 'woocommerce_before_subcategory', 'pls_woocommerce_loop_product_wrapper', 5 );
add_action( 'woocommerce_after_subcategory', 'pls_woocommerce_product_wrapper_end', 10 );

/**
 * Single Product
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
 
/**
 * Single Products Summary Div.
 *
 * @see pls_output_product_labels()
 * @see pls_single_product_video_btn()
 * @see pls_single_product_degree360_btn()
 * @see pls_single_product_photoswipe_btn()
 * @see pls_single_product_before_price()
 * @see pls_product_navigation_share()
 * @see pls_single_product_navigation()
 * @see woocommerce_template_single_rating()
 * @see pls_woocommerce_sale_product_countdown()
 * @see pls_single_product_after_price()
 * @see pls_single_product_price_discount()
 * @see pls_single_product_stock_availability()
 * @see pls_single_product_brands()
 * @see pls_single_product_size_chart()
 * @see pls_single_product_share()
 * @see pls_output_recently_viewed_products()
 */

add_action( 'pls_product_gallery_top', 'pls_woocommerce_output_product_labels', 10 ); 
add_action( 'pls_product_gallery_top', 'pls_single_product_photoswipe_btn', 15 );
add_action( 'pls_product_gallery_bottom', 'pls_single_product_video_btn', 10 );
add_action( 'pls_product_gallery_bottom', 'pls_single_product_degree360_btn', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8) ;
add_action( 'woocommerce_single_product_summary', 'pls_single_product_after_price', 12);
add_action( 'pls_single_product_after_price', 'pls_single_product_brands', 10 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_stock_availability', 22 );
add_action( 'woocommerce_single_product_summary', 'pls_woocommerce_sale_product_countdown', 25 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_size_chart', 35 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_delivery_return_ask_question', 36 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_estimated_delivery', 37 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_visitor_count', 38 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_policy', 39 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_trust_badge', 39 );
add_action( 'woocommerce_single_product_summary', 'pls_single_product_share', 50 );
add_action( 'woocommerce_after_single_product_summary', 'pls_output_recently_viewed_products', 25 );

/* Quick Buy*/
add_action( 'woocommerce_after_add_to_cart_button', 'pls_add_quick_buy_pid');
add_action( 'woocommerce_after_add_to_cart_button', 'pls_add_quick_buy_button', 99 );
add_filter( 'woocommerce_add_to_cart_redirect', 'pls_quick_buy_redirect', 99 );

/**
 * Quantity Buttons
 *
 * @see pls_quantity_button_minus()
 * @see pls_quantity_button_plus()
 */
add_action( 'woocommerce_before_quantity_input_field', 'pls_quantity_button_minus', 10 );
add_action( 'woocommerce_after_quantity_input_field', 'pls_quantity_button_plus', 10 );

/**
 * My Account Page
 */
remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );

add_action( 'pls_before_signup_form', 'wc_registration_privacy_policy_text', 10 );
add_action( 'woocommerce_before_account_navigation', 'pls_before_account_navigation' );
add_action( 'woocommerce_after_account_navigation', 'pls_after_account_navigation' );
add_action( 'woocommerce_before_account_orders', 'pls_woocommerce_before_account_orders', 10 );
add_action( 'woocommerce_before_account_downloads', 'pls_woocommerce_before_account_downloads', 10 );
add_filter( 'woocommerce_my_account_my_address_description', 'pls_woocommerce_my_account_my_address_description', 10 );
add_action( 'woocommerce_before_edit_account_form', 'pls_woocommerce_myaccount_edit_account_heading', 10 );

/**
 * Cart Page
 *
 * @see pls_free_shipping_bar()
 * @see pls_woocommerce_cart_page_wrapper()
 * @see pls_woocommerce_cart_page_wrapper_end()
 * @see woocommerce_cross_sell_display()
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_action( 'woocommerce_proceed_to_checkout', 'pls_free_shipping_bar', 10 );
add_action( 'woocommerce_before_cart', 'pls_woocommerce_cart_page_wrapper', 10 );
add_action( 'woocommerce_after_cart', 'pls_woocommerce_cart_page_wrapper_end', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 20 );

 /**
 * Mini Cart
 *
 * @see pls_free_shipping_bar()
 */
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'pls_free_shipping_bar', 10 );

/**
 * Footer
 *
 * @see pls_login_signup_popup()
 * @see pls_minicart_slide()()
 * @see pls_canvas_sidebar()
 * @see pls_single_product_360_degree_content()
 * @see pls_sticky_add_to_cart_button()
 */
add_action( 'pls_body_bottom', 'pls_login_signup_popup', 50 );
add_action( 'pls_body_bottom', 'pls_minicart_slide', 55 );
add_action( 'pls_body_bottom', 'pls_canvas_sidebar', 60 );
add_action( 'pls_body_bottom', 'pls_single_product_360_degree_content', 65 );
add_action( 'pls_body_bottom', 'pls_sticky_add_to_cart_button', 70 );