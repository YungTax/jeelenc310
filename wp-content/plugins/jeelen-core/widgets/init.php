<?php

/* Theme Widget sidebars. */
require PLS_CORE_DIR . '/widgets/widget-base/abstract-widget-base.php';
require PLS_CORE_DIR . '/widgets/class-about-us.php';
require PLS_CORE_DIR . '/widgets/class-social-links.php';
require PLS_CORE_DIR . '/widgets/class-newsletter.php';
require PLS_CORE_DIR . '/widgets/class-recent-posts.php';

add_action('widgets_init','pls_core_register_widget');
function pls_core_register_widget(){
	register_widget( 'PLS_About_Us_Widget' );
	register_widget( 'PLS_Social_Links' );	
	register_widget( 'PLS_Newsletter_Widget' );
	register_widget( 'PLS_Recent_Posts_Widget' );
	if ( class_exists( 'WC_Widget' ) ) {	
		require PLS_CORE_DIR . '/widgets/woocommerce-product.php';		
		require PLS_CORE_DIR . '/widgets/woocommerce-product-attributes-filter.php';		
		require PLS_CORE_DIR . '/widgets/woocommerce-brand-filter.php';			
		require PLS_CORE_DIR . '/widgets/woocommerce-product-sorting.php';			
		require PLS_CORE_DIR . '/widgets/woocommerce-price-filter.php';			
		register_widget( 'PLS_Products_Widget' );		
		register_widget( 'PLS_Widget_Attributes_Filter' );		
		register_widget( 'PLS_Brand_Filter_Widget' );
		register_widget( 'PLS_WC_Widget_Product_Sorting' );
		register_widget( 'PLS_Price_Filter_List_Widget' );
	}
}