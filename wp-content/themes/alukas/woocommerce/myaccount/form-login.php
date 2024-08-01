<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="pls-customer-login-register" id="customer_login">
	<div class="pls-customer-login active">
	
		<h2><?php esc_html_e( 'Login', 'pls-theme' ); ?></h2>
		
		<form class="woocommerce-form woocommerce-form-login login" method="post" action="<?php echo esc_url( $account_link );?>">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">					
				<label for="username"><?php esc_html_e( 'User Name or Email', 'pls-theme' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">					
				<label for="password"><?php esc_html_e( 'Password', 'pls-theme' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row woocommerce-rememberme-lost_password">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'pls-theme' ); ?></span>
				</label>
				<a class="woocommerce-LostPassword" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'pls-theme' ); ?></a>
			</p>
			
			<p class="woocommerce-login-button">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'pls-theme' ); ?>"><?php esc_html_e( 'Log in', 'pls-theme' ); ?></button>				
			</p>
			<?php do_action( 'woocommerce_login_form_end' ); ?>
			
			<?php				
			if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
			<p class="woocommerce-pls-new-register">
				<?php 
				$site_title = get_bloginfo( 'name' );
				if( PLS_DOKAN_ACTIVE && !is_account_page() ){
				$account_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
				echo sprintf( __("<a class='button' href='%s'> New to %s? Register </a>", 'pls-theme'), esc_url($account_page_url) , $site_title);
				} else {
				?>
				<a class="pls-new-register" href="#"><?php  echo sprintf( esc_html__(' New to %s? Register','pls-theme'),$site_title );?></a>
				<?php } ?>
			</p>
			<?php endif; ?>
		</form>
	</div>
	
	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
		<div class="pls-customer-register">
		
			<h2><?php esc_html_e( 'Register', 'pls-theme' ); ?></h2>
			
			<form method="post" class="woocommerce-form woocommerce-form-register register" action="<?php echo esc_url( $account_link );?>" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'pls-theme' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'pls-theme' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'pls-theme' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A password will be sent to your email address.', 'pls-theme' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'pls-theme' ); ?>"><?php esc_html_e( 'Register', 'pls-theme' ); ?></button>
				</p>
				<?php do_action( 'woocommerce_register_form_end' ); ?>
				<p class="woocommerce-pls-new-register">
					<a class="pls-new-login" href="#"><?php esc_html_e( 'Existing User? Log in', 'pls-theme' ); ?></a>
				</p>
			</form>
		</div>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>