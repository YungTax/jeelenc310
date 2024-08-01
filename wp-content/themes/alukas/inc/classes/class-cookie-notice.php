<?php
/*
* Cookie Notice allows you to elegantly inform users that your site uses cookies and to comply with the EU cookie law regulations.
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;
if ( ! class_exists( 'PLS_Cookie_Notice' ) ) {
	/**
	 * Cookie Notice class.
	 *
	 * @class Cookie_Notice
	 * @version	1.0
	 */
	class PLS_Cookie_Notice {
		
		/**
		 * @var $cookie, holds cookie name
		 */
		private static $cookie = array(
			'name'	 => 'pls_cookie_notice_accepted',
			'value'	 => 'TRUE'
		);

		/**
		 * Constructor.
		 */
		public function __construct() {			
			
			// actions
			add_action( 'wp_enqueue_scripts', array( $this, 'front_load_scripts_styles' ) );
			add_action( 'wp_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
			add_action( 'pls_body_bottom', array( $this, 'add_cookie_notice' ), 1000 );
		}	
		
		/**
		 * Cookie notice output.
		 */
		public function add_cookie_notice() {
			if( ! pls_get_option( 'cookie-notice', 0 ) ){ return false; }
			if ( ! $this->cookie_setted()  && pls_get_option( 'cookie-notice', 0 ) ) {
				
				// get cookie container args
				$options = apply_filters( 'pls_cookie_notice_args', array(
					'position'				=> pls_get_option('cookie-positions', 'bottom' ),
					'cookie_style'			=> pls_get_option('cookie-style', 'bar' ),
					'cookie_title'			=> pls_get_option('cookie-title', 'Cookies Notice'),
					'colors'				=> array( 
													'text' 	=> pls_get_option( 'cookie-text-color', '#777777' ), 
													'bar'	=> pls_get_option( 'cookie-background-color', '#f5f5f5' ) 
											   ),
					'message_text'			=> pls_get_option('cookie-message-text','We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.'),
					'accept_text'			=> pls_get_option( 'cookie-accept-text', 'Ok' ),
					'refuse_text'			=> pls_get_option( 'cookie-refuse-text', 'No' ),
					'refuse_opt'			=> pls_get_option( 'cookie-refuse-opt',0 ),
					'see_more'				=> pls_get_option( 'cookie-see-more-opt', 0 ),
					'see_more_text'			=> pls_get_option( 'cookie-see-more-text','Read more' ),
					'see_more_link_type'	=> pls_get_option( 'cookie-see-more-link-type','custom' ),
					'see_more_link_custom'	=> pls_get_option( 'cookie-see-more-link-custom','#' ),
					'see_more_link_pages'	=> pls_get_option( 'cookie-see-more-link-pages','' ),
					'link_target'			=> pls_get_option( 'cookie-see-more-link-target','_blank' ),
				) );
				
				// message output
				$output = '
				<div id="cookie-notice" class="cn-' . esc_attr($options['position']) .' '.( $options['position'] == 'bottom' ? $options['cookie_style'] : ''). '" style="color: ' . $options['colors']['text'] . '; background-color: ' . $options['colors']['bar'] . ';">'
					. '<div class="cookie-notice-container"><h2>'.$options['cookie_title'].'</h2><span id="cn-notice-text">'. $options['message_text'] .'</span>'
					. '<a href="#" id="cn-accept-cookie" data-cookie-set="accept" class="cn-set-cookie button' . '">' . $options['accept_text'] . '</a>'
					. ($options['refuse_opt'] == 1 ? '<a href="#" id="cn-refuse-cookie" data-cookie-set="refuse" class="cn-set-cookie button' . '">' . $options['refuse_text'] . '</a>' : '' )
					. ($options['see_more'] == 1 ? '<a href="' . ( $options['see_more_link_type'] === 'custom' ? esc_url( $options['see_more_link_custom'] ) : esc_url( get_permalink( $options['see_more_link_pages'] ) ) ) . '" target="' . $options['link_target'] . '" id="cn-more-info" class="button' . '">' . $options['see_more_text'] . '</a>' : '') . '
					</div>
				</div>';
			
				echo apply_filters( 'pls_cookie_notice_output', $output, $options );
			}
		}

		/**
		 * Checks if cookie is setted
		 */
		public function cookie_setted() {
			return isset( $_COOKIE[self::$cookie['name']] );
		}

		/**
		 * Checks if third party non functional cookies are accepted
		 */
		public static function cookie_pls_accepted() {
			return ( isset( $_COOKIE[self::$cookie['name']] ) && strtoupper( $_COOKIE[self::$cookie['name']] ) === self::$cookie['value'] );
		}

		/**
		 * Load scripts and styles - frontend.
		 */
		public function front_load_scripts_styles() {
			if(!pls_get_option('cookie-notice', 0)){ return false;}
			if ( ! $this->cookie_setted() ) {
				$style = ( is_rtl() ) ? 'cookie-notice-rtl' : 'cookie-notice';
				if( !class_exists( 'WooCommerce' ) ) { 
					wp_enqueue_script( 'cookie' );
				}
				wp_enqueue_script(
					'cookie-notice-front', PLS_SCRIPTS .'cookie-notice.js', array( 'jquery' ), '1.0.0', ( pls_get_option('cookie-script-placements','footer') ) === 'footer' ? true : false
				);

				wp_localize_script(
					'cookie-notice-front', 'cnArgs', array(
						'ajaxurl'				=> admin_url( 'admin-ajax.php' ),
						'hideEffect'			=> 'fade',
						'onScroll'				=> pls_get_option('cookie-on-scroll',0),
						'onScrollOffset'		=> pls_get_option('cookie-on-scroll-offset', 100),
						'cookieName'			=> self::$cookie['name'],
						'cookieValue'			=> self::$cookie['value'],
						'cookieTime'			=> pls_get_option('cookie-expiry-times', '2592000'),
						'cookiePath'			=> ( defined( 'COOKIEPATH' ) ? COOKIEPATH : '' ),
						'cookieDomain'			=> ( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '' )
					)
				);

				wp_enqueue_style( 'cookie-notice-front', PLS_STYLES.$style.'.css' );
			}
		}
		
		/**
		 * Print non functional javascript.
		 * 
		 * @return mixed
		 */
		public function print_footer_scripts() {
			if(!pls_get_option('cookie-notice', 0)){ return false;}
			$scripts = html_entity_decode( trim( wp_kses_post( pls_get_option( 'cookie-refuse-code', '' ) ) ) );
			
			if ( $this->cookie_setted() && ! empty( $scripts ) ) {
				?>
				<script type='text/javascript'>
					<?php echo esc_js( $scripts ); ?>
				</script>
				<?php
			}
		}
		
	}

	// set plugin instance
	$cookie_notice = new PLS_Cookie_Notice();
}