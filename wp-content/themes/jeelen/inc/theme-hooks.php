<?php
/**
 * Action/filter hooks used for theme functions/templates.
 *
 * @author 		PressLayouts
 * @package 	/inc
 * @since     	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'body_class', 'pls_body_classes' );
add_filter( 'post_class', 'pls_post_classes', 10, 3 );

add_action( 'pls_body_top', 'pls_site_loader', 1 );

/**
 * Content Wrappers.
 *
 * @see pls_output_content_wrapper()
 * @see pls_output_content_wrapper_end()
 */
add_action( 'pls_before_main_content', 'pls_output_content_wrapper', 10 );
add_action( 'pls_after_main_content', 'pls_output_content_wrapper_end', 10 );

/**
 * Header.
 *
 * @see pls_template_header()
 * @see pls_header_topbar_left()
 * @see pls_header_topbar_right()
 * @see pls_header_main_left()
 * @see pls_header_main_center()
 * @see pls_header_main_right()
 * @see pls_header_navigation_left()
 * @see pls_header_navigation_center()
 * @see pls_header_navigation_right()
 */
add_action( 'pls_header', 'pls_template_header', 10 );
add_action( 'pls_header_topbar_left', 'pls_header_topbar_left', 10 );
add_action( 'pls_header_topbar_right', 'pls_header_topbar_right', 10 );
add_action( 'pls_header_main_left', 'pls_header_main_left', 10 );
add_action( 'pls_header_main_center', 'pls_header_main_center', 10 );
add_action( 'pls_header_main_right', 'pls_header_main_right', 10 );
add_action( 'pls_header_navigation_left', 'pls_header_navigation_left', 10 );
add_action( 'pls_header_navigation_center', 'pls_header_navigation_center', 10 );
add_action( 'pls_header_navigation_right', 'pls_header_navigation_right', 10 );
add_action( 'pls_header_sticky_left', 'pls_header_sticky_left', 10 );
add_action( 'pls_header_sticky_center', 'pls_header_sticky_center', 10 );
add_action( 'pls_header_sticky_right', 'pls_header_sticky_right', 10 );
add_action( 'pls_header_mobile_topbar_center', 'pls_header_mobile_topbar_center', 10 );
add_action( 'pls_header_mobile_left', 'pls_header_mobile_left', 10 );
add_action( 'pls_header_mobile_center', 'pls_header_mobile_center', 10 );
add_action( 'pls_header_mobile_right', 'pls_header_mobile_right', 10 );

/**
 * Page Title.
 *
 * @see pls_template_breadcrumbs()
 * @see pls_template_page_title()
 */
add_action( 'pls_page_title', 'pls_page_title', 10 );
add_action( 'pls_inner_page_title', 'pls_template_page_title', 10 );
add_action( 'pls_inner_page_title', 'pls_template_breadcrumbs', 20 );
add_action( 'pls_page_title', 'pls_template_blog_category', 20 );

/**
 * Page
 *
 * @see pls_template_page_content()
 * @see pls_template_page_comments()
 */
add_action( 'pls_page_content', 'pls_template_page_content', 10 );
add_action( 'pls_after_page_entry', 'pls_template_page_comments', 10 );

/**
 * Sidebar.
 *
 * @see pls_get_sidebar()
 */
add_action( 'pls_sidebar', 'pls_get_sidebar', 10 );

/**
 * Post Loop.
 *
 * @see pls_post_wrapper()
 * @see pls_template_loop_post_highlight()
 * @see pls_template_loop_post_thumbnail()
 * @see pls_template_loop_post_header()
 * @see pls_template_loop_post_title()
 * @see pls_template_loop_post_meta()
 * @see pls_template_loop_post_content()
 * @see pls_template_loop_post_footer()
 * @see pls_template_read_more_link()
 * @see pls_post_wrapper_end()
 * @see pls_pagination()
 */
 
add_action( 'pls_loop_post_entry_top', 'pls_post_wrapper', 10 );
add_action( 'pls_loop_post_thumbnail', 'pls_template_loop_post_highlight', 10 );
add_action( 'pls_loop_post_thumbnail', 'pls_template_loop_post_thumbnail', 20 );
add_action( 'pls_loop_post_content', 'pls_template_loop_post_header', 10 );
add_action( 'pls_loop_post_content', 'pls_template_loop_post_content', 20 );
add_action( 'pls_loop_post_content', 'pls_template_loop_post_footer', 30 );
add_action( 'pls_loop_post_entry_bottom', 'pls_post_wrapper_end', 10 );
add_action( 'pls_after_loop_post', 'pls_pagination', 10 );

//Inner hook
add_action( 'pls_loop_post_header', 'pls_template_loop_post_category', 10 );
add_action( 'pls_loop_post_header', 'pls_template_loop_post_meta', 20 );
add_action( 'pls_loop_post_header', 'pls_template_loop_post_title', 30 );
add_action( 'pls_loop_post_footer', 'pls_template_read_more_link', 10 );

/**
 * Single Post.
 *
 * @see pls_post_wrapper()
 * @see pls_template_single_post_thumbnail()
 * @see pls_template_single_post_highlight()
 * @see pls_template_single_post_header()
 * @see pls_template_single_post_content()
 * @see pls_post_wrapper_end()
 * @see pls_template_single_post_author_bios()
 * @see pls_template_single_tag_social_share()
 * @see pls_template_single_post_navigation()
 * @see pls_template_single_post_related()
 * @see pls_template_single_post_comments()
 * @see pls_template_single_post_category()
 * @see pls_template_single_post_title()
 * @see pls_template_single_post_meta()
 */
 
add_action( 'pls_single_post_entry_top', 'pls_post_wrapper', 10 );
add_action( 'pls_single_post_thumbnail', 'pls_template_single_post_header', 10 );
add_action( 'pls_single_post_thumbnail', 'pls_template_single_post_thumbnail', 10 );
add_action( 'pls_single_post_thumbnail', 'pls_template_single_post_highlight', 20 );
add_action( 'pls_single_post_content', 'pls_template_single_post_content', 20 );
add_action( 'pls_single_post_entry_bottom', 'pls_post_wrapper_end', 10 );
add_action( 'pls_after_single_post_entry', 'pls_template_single_post_author_bios', 10 );
add_action( 'pls_after_single_post_entry', 'pls_template_single_tag_social_share', 20 );
add_action( 'pls_after_single_post_entry', 'pls_template_single_post_navigation', 30 );
add_action( 'pls_after_single_post_entry', 'pls_template_single_post_related', 40 );
add_action( 'pls_after_single_post_entry', 'pls_template_single_post_comments', 50 );

//Inner hook
add_action( 'pls_single_post_header', 'pls_template_single_post_category', 5 );
add_action( 'pls_single_post_header', 'pls_template_single_post_title', 10 );
add_action( 'pls_single_post_header', 'pls_template_single_post_meta', 20 );

/* Comming Soon */
add_action( 'template_redirect', 'pls_coming_soon_redirect' );

/**
 * Footer.
 *
 * @see pls_template_footer()
 * @see pls_template_footer_copyright()
 * @see pls_back_to_top()
 * @see pls_mobile_menu()
 * @see pls_search_popup()
 * @see pls_newsletter_popup()
 * @see pls_mobile_bottom_navbar()
 * @see pls_mask_overaly()
 */
add_action( 'pls_footer_top', 'pls_template_footer_subscribe', 10 );
add_action( 'pls_footer_top', 'pls_template_footer_features_box', 20 );
add_action( 'pls_footer', 'pls_template_footer', 10 );
add_action( 'pls_footer_bottom', 'pls_template_footer_copyright', 10 );
add_action( 'pls_body_bottom', 'pls_back_to_top', 10 );
add_action( 'pls_body_bottom', 'pls_mobile_menu', 20 );
add_action( 'pls_body_bottom', 'pls_search_popup', 25 );
add_action( 'pls_body_bottom', 'pls_newsletter_popup', 30 );
add_action( 'pls_body_bottom', 'pls_mobile_bottom_navbar', 40 );
add_action( 'pls_body_bottom', 'pls_mask_overaly', 100 );