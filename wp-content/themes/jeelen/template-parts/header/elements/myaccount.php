<?php
/**
 * Template part for displaying my account
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! pls_get_option( 'header-myaccount', 1 ) || ! PLS_WOOCOMMERCE_ACTIVE ) {
	return;
}

$user_data 					= wp_get_current_user();
$myaccount_menu_location	= apply_filters( 'pls_header_myaccount_menu_location', 'myaccount-menu' );
$current_user 				= apply_filters('pls_myaccount_username', $user_data->user_login );		
$user_logged_in 			= apply_filters( 'pls_header_myaccount_logged_in', is_user_logged_in() );
$signin_text  				= apply_filters( 'pls_header_signin_text', esc_html__( 'Sign In', 'pls-theme' ) );
$myaccount_text  			= apply_filters( 'pls_header_myaccount_text', esc_html__( 'My Account', 'pls-theme' ) );
$orders  					= get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
$account_page_id 			= get_option( 'woocommerce_myaccount_page_id' );
$account_page_url 			= !empty( $account_page_id ) ? get_permalink( $account_page_id ) : '#';
if ( !empty( $account_page_id ) && substr( $account_page_url, - 1, 1 ) != '/' ) {
	$account_page_url .= '/';
}
$orders_url   				= $account_page_url . $orders;
$dashboard_url				= apply_filters( 'pls_myaccount_dashboard_url', $account_page_url );
$myaccount_menu  			= pls_get_account_menu();
$myaccount_style			= pls_get_option( 'header-myaccount-style', 1 );
?>			

<div class="pls-header-myaccount">
	
	<?php if( $user_logged_in ){
		$myaccount_class = is_user_logged_in() ? 'user-myaccount' : 'customer-signinup'; ?>
		<a class="<?php echo esc_attr($myaccount_class);?>" href="<?php echo esc_url($dashboard_url);?>"><span class="pls-header-icon-text"><?php echo esc_html($myaccount_text); ?></span></a>
		<?php if( has_nav_menu( $myaccount_menu_location ) ){
			wp_nav_menu( array( 
				'theme_location' 	=> $myaccount_menu_location,
				'menu_class'      	=> 'myaccount-items pls-arrow',
				'container'   		=> false,
				'fallback_cb' 		=> '',
				'walker' 			=> new PLS_Menu_Walker()
			) );?>
		<?php }else{?>
			<ul class="myaccount-items pls-arrow">
				<?php 
				foreach( $myaccount_menu as $menu_item ){
					$class = ( isset( $menu_item['class'] ) && !empty( $menu_item['class'] ) ) ? $menu_item['class'] : '';?>
					<li>
						<a class="<?php echo esc_attr($class);?>" href="<?php echo esc_url($menu_item['link']);?>">
							<i class="<?php echo esc_attr($menu_item['icon']);?>"></i><?php echo esc_html($menu_item['label']);?>
						</a>
					</li>
					<?php
				}?>
			</ul>
		<?php }?>
	<?php }else{?>
		<a class="customer-signinup" href="<?php echo esc_url($dashboard_url);?>"><span class="pls-header-icon-text"><?php echo esc_html( $signin_text );?></span></a>		
	<?php }?>
</div>