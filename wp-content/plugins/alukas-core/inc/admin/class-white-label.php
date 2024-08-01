<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PLS_White_Label' ) )
{
	class PLS_White_Label {
		
		function __construct() {
			if( ! $this->is_white_label_enabled() ){
				return;
			}
			add_filter( 'pls_menu_icon', [ $this, 'menu_icon' ] );
			add_filter( 'pls_menu_title', [ $this, 'menu_title' ] );
			add_filter( 'pls_dashboard_title', [ $this, 'dashboard_title' ] );
			add_filter( 'pls_dashboard_description', [ $this, 'dashboard_description' ] );			
			add_filter( 'pls_dashboard_logo', [ $this, 'dashboard_logo' ] );
			add_filter( 'pls_dashboard_tabs', [ $this, 'dashboard_tabs' ] );
			add_action( 'admin_menu', [ $this, 'remove_admin_dashboard' ], 100);
			add_filter( 'pls_theme_name', [ $this, 'white_label_themename' ] );
			add_filter( 'wp_prepare_themes_for_js', [ $this, 'theme_data' ] );
			add_filter( 'login_headerurl', [ $this, 'login_headerurl' ] );
			add_action( 'login_head', [ $this, 'white_label_login_form' ] );
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elementor_enqueue_style' ] ,100 );
		}
		
		function is_white_label_enabled(){
			$return = false;
			$pls_option = get_option('pls_options',array());
			if( isset( $pls_option['white-label-enable'] ) && $pls_option['white-label-enable'] == '1'){
				$return = true;
			}
			return $return;
		}
		function white_label_themename( $name ){
			
			$pls_option = get_option( 'pls_options', array() );
			
			if( !empty( $pls_option['theme-name'] ) ){
				$name = $pls_option['theme-name'];
			}
			return $name;
		}
		function theme_data( $themes ){
			$theme_name = !empty( pls_get_option('theme-name', '' ) ) ? pls_get_option('theme-name', '' ) : '' ;
			$screenshot = pls_get_option( 'theme-screenshot' );
			$screenshot_url = isset( $screenshot['url'] ) ? $screenshot['url'] : '' ;
			
			if( isset( $themes[PLS_THEME_SLUG] ) && !empty( $theme_name ) ){		
				$themes[PLS_THEME_SLUG]['name']= $theme_name;
				if(!empty( $screenshot_url )){
					$themes[PLS_THEME_SLUG]['screenshot']= array( $screenshot_url );
				}
			}
			if( isset( $themes[PLS_THEME_SLUG.'-child'] ) && !empty( $theme_name ) ){
				$themes[PLS_THEME_SLUG.'-child']['name']= $theme_name.' Child';
				if(!empty( $screenshot_url )){
					$themes[PLS_THEME_SLUG.'-child']['screenshot']= array( $screenshot_url );
				}
			}
			return $themes;
		}
		
		function menu_icon( $menu_icon ){
			$theme_icon = pls_get_option( 'theme-menu-icon' );
			$menu_icon = isset( $theme_icon['url'] ) ? $theme_icon['url'] : $menu_icon ;
			return $menu_icon;
		}
		function dashboard_logo( $icon ){
			$welcome_page_icon = pls_get_option( 'theme-welcome-page-icon' );
			$icon = isset( $welcome_page_icon['url'] ) ? $welcome_page_icon['url'] : $icon ;
			return $icon;
		}		
		function menu_title( $theme_name ){
			$theme_name = !empty( pls_get_option('theme-name', '' ) ) ? pls_get_option('theme-name', PLS_THEME_NAME ) : $theme_name ;
			return $theme_name;
		}		
		function dashboard_title( $dashboard_title ){
			$dashboard_title = !empty( pls_get_option('theme-welcome-page-title', '' ) ) ? pls_get_option('theme-welcome-page-title') : $dashboard_title ;
			return $dashboard_title;
		}		
		function dashboard_description( $welcome_desc ){
			$welcome_desc = !empty( pls_get_option('theme-welcome-page-description', '' ) ) ? pls_get_option('theme-welcome-page-description') : $welcome_desc ;
			return $welcome_desc;
		}
		function dashboard_tabs( $tabs ){
			if(pls_get_option( 'disable-welcome-page', 0 ) ){
				unset($tabs['pls-theme']);
			}
			if(pls_get_option( 'disable-demo-import', 0 ) ){
				unset($tabs['pls-demo-import']);
			}
			
			return $tabs;
		}
		function remove_admin_dashboard(){
			if(pls_get_option( 'disable-welcome-page', 0 ) ){
				remove_submenu_page( 'pls-theme', 'pls-theme' );
			}
			if(pls_get_option( 'disable-demo-import', 0 ) ){
				remove_submenu_page( 'pls-theme', 'pls-demo-import' );
			}
		}
		
		function login_headerurl(){
			return site_url();
		}
		function white_label_login_form(){
			$loginPage_logo = pls_get_option( 'wp-login-page-logo' );
			$loginPage_logo_width = pls_get_option( 'wp-login-page-logo-width', 150 );
			$loginPage_logo_height = pls_get_option( 'wp-login-page-logo-height', 84 );
			$loginPage_background = pls_get_option( 'wp-login-page-background', array( 'background-color' => '#f0f0f1' ) );
			$loginPage_form_background = pls_get_option( 'wp-login-form-background', '#ffffff' );
			$loginPage_form_padding = pls_get_option( 'wp-login-form-padding', array(
				'padding-top' 		=> '2em',
				'padding-right' 	=> '2em',
				'padding-bottom' 	=> '2em',
				'padding-left' 		=> '2em',
			) );
			$loginPage_form_box_shadow = pls_get_option( 'wp-login-form-box-shadow', 1 );
			$loginPage_text_color = pls_get_option( 'wp-login-text-color', '#333333' );
			$loginPage_link_color = pls_get_option( 'wp-login-link-color', array(
				'regular' 	=> '#222222',
				'hover' 	=> '#222222',
			) );
			$loginPage_border = pls_get_option( 'wp-login-border', array(
				'border-color'  => '#e9e9e9',
				'border-style'  => 'solid',
				'border-top'    => '1px',
				'border-right'  => '1px',
				'border-bottom' => '1px',
				'border-left'   => '1px'
			) );
			$loginPage_border_radius = pls_get_option( 'wp-login-border-radius', 4 );
			$loginPage_input_color = pls_get_option( 'wp-login-input-color', '#656565' );
			$loginPage_input_background = pls_get_option( 'wp-login-input-background', '#ffffff' );
			$loginPage_button_background = pls_get_option( 'wp-login-button-background', array(
				'regular' 	=> '#222222',
				'hover' 	=> '#222222',
			) );
			$loginPage_button_color = pls_get_option('wp-login-button-color', array(
				'regular' 	=> '#ffffff',
				'hover' 	=> '#fcfcfc',
			) );
			?>
			
			<style>
				<?php if( ! empty( $loginPage_logo['url'] ) ){ ?>
					#login h1 a,
					.login h1 a {
						background-image: url(<?php echo esc_url( $loginPage_logo['url'] );?>);
						<?php if ( ! empty ( $loginPage_logo_height ) ) { ?>
							height: <?php echo $loginPage_logo_height;?>px;
						<?php } ?>
						<?php if ( ! empty ( $loginPage_logo_width ) ) { ?>
							width: <?php echo $loginPage_logo_width;?>px;
							background-size: <?php echo $loginPage_logo_width;?>px;
						<?php } ?>
					}
				<?php } ?>				
				body {
					display: flex;
					flex-direction: column;
					align-items: center;
					background-color:<?php echo $loginPage_background['background-color'] ?>;
					<?php if( ! empty ( $loginPage_background['background-image'] ) ){ ?>
						background-image: url(<?php echo $loginPage_background['background-image'] ?>);
					<?php } ?>
					<?php if( !empty ( $loginPage_background['background-repeat'] ) ){ ?>
						background-repeat:<?php echo $loginPage_background['background-repeat'] ?>;
					<?php } ?>
					<?php if( !empty ( $loginPage_background['background-position'] ) ){ ?>
						background-position:<?php echo $loginPage_background['background-position'] ?>;
					<?php } ?>
					<?php if( !empty ( $loginPage_background['background-size'] ) ){ ?>
						background-size:<?php echo $loginPage_background['background-size'] ?>;
					<?php } ?>
					<?php if( !empty ( $loginPage_background['background-attachment'] ) ){ ?>
						background-attachment:<?php echo $loginPage_background['background-attachment'] ?>;
					<?php } ?>
				}
				.login #login {
					background-color: <?php echo $loginPage_form_background; ?>;
					border-radius: 5px;
					padding-top: <?php echo $loginPage_form_padding['padding-top']; ?>;
					padding-right: <?php echo $loginPage_form_padding['padding-right']; ?>;
					padding-bottom: <?php echo $loginPage_form_padding['padding-bottom']; ?>;
					padding-left: <?php echo $loginPage_form_padding['padding-left']; ?>;
					<?php if( $loginPage_form_box_shadow ){ ?>
						box-shadow: 0 0 6px rgb(0 0 0 / 15%);
					<?php } ?>
				    margin: inherit;
					margin-top: 4%;					
				}
				.login form {
					background: none;
					box-shadow: none;
					border: none;
					margin: 0;
					padding: 0;
				}
				.login form .forgetmenot,
				.login .button-primary {
					float: inherit;
				}	
				.login #nav,			
				.login #backtoblog{
					padding: 0;
				}
				#login form p.submit {
					margin-top: 10px;
				}
				.login .submit .button-primary {
					font-size: 14px;
					font-weight: 600;
					padding: 5px;
					text-transform: uppercase;
					width: 100%;
				}
				.login #nav {
				    font-size: 0;
					display: flex;
					justify-content: space-between;
				}
				.login #nav a {
					font-size: 13px;
				}
				.login #login {
					color: <?php echo $loginPage_text_color; ?>;
				}
				.login #nav a,			
				.login #backtoblog a {
					color: <?php echo $loginPage_link_color['regular']; ?>;
				}
				.login #nav a:hover,			
				.login #backtoblog a:hover {
					color: <?php echo $loginPage_link_color['hover']; ?>;
				}
				.login form .input:not( input[type=submit] ) {
					background: <?php echo $loginPage_input_background; ?>;
					color: <?php echo $loginPage_input_color; ?>;
					border-style: <?php echo $loginPage_border['border-style']; ?>;
					border-color: <?php echo $loginPage_border['border-color']; ?>;
					border-top-width: <?php echo $loginPage_border['border-top']; ?>;
					border-bottom-width: <?php echo $loginPage_border['border-bottom']; ?>;
					border-left-width: <?php echo $loginPage_border['border-left']; ?>;
					border-right-width: <?php echo $loginPage_border['border-right']; ?>;
				}
				.login form input:not( input[type=checkbox] ) {
					border-radius: <?php echo $loginPage_border_radius;?>px;
					padding-left: 15px;
				}
				.login input[type=submit] {
					color: <?php echo $loginPage_button_color['regular']; ?>;
					background-color: <?php echo $loginPage_button_background['regular']; ?>;
					border-color: <?php echo $loginPage_button_background['regular']; ?>;
				}
				.login input[type=submit]:hover {
					color: <?php echo $loginPage_button_color['hover']; ?>;
					background-color: <?php echo $loginPage_button_background['hover']; ?>;
					border-color: <?php echo $loginPage_button_background['hover']; ?>;
				}
				.login form .input:not( input[type=submit] ):focus {
					border-color: <?php echo $loginPage_border['border-color']; ?>;
					box-shadow: none;
					outline: none;
				}
				.login form input[type=submit]:focus {
					background-color: <?php echo $loginPage_button_background['hover']; ?>;
					border-color: <?php echo $loginPage_button_background['hover']; ?>;
					box-shadow: none;
					outline: none;
				}
				.login .button.wp-hide-pw:focus {
					border: none;
					box-shadow: none;
					outline: none;
				}
				.login .button.wp-hide-pw .dashicons {
					color: <?php echo $loginPage_input_color; ?>;
				}
				.login .language-switcher {
					margin: 20px auto;
				    padding: 0;
				}
			</style>
		<?php }
		
		
		/*Editor style*/
		function elementor_enqueue_style(){
			
			$theme_icon = pls_get_option( 'theme-menu-icon' );
			$menu_icon = isset( $theme_icon['url'] ) ? $theme_icon['url'] : '' ;
			if(empty($menu_icon)){
				return;
			} ?>
			<style>
				.elementor-element .pls-icon:after{
				  background-image: url(<?php echo $menu_icon;?>) !important; 
				}
			</style>
			<?php
		}
	}
	$obj_white_label = new PLS_White_Label();
}