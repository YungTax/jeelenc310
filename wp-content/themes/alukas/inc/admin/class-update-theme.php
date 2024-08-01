<?php 
class PLS_Update_Theme {
	public $prefix, $theme_data, $current_version, $api_url, $token_key, $purchase_code, $item_name, $slug, $item_id, $changelog_link;
	public $option_name = 'envato_purchase_code_45256351';
	function __construct( $purchase_code = null ) {
		$this->prefix			= PLS_PREFIX;
		$this->theme_data		= $this->get_theme_data();
		$this->current_version	= $this->theme_data->get('Version');
        $this->api_url			= 'https://www.presslayouts.com/api/envato';
        $this->token_key		= $this->get_token_key();
        if($purchase_code)		{
			$this->purchase_code = $purchase_code;
		}else {
			$this->purchase_code = $this->get_purchase_code();
		}
        $this->item_name	= PLS_THEME_NAME;
        $this->slug			= PLS_THEME_SLUG;
		$this->item_id		= '45256351';
		
		$this->changelog_link = 'https://'.PLS_THEME_SLUG.'.presslayouts.com/';
     
		/* Theme Update */
		add_action( 'wp_ajax_activate_theme', array( $this, 'activate_theme' ) );
		
		/* Theme Deactivate */
		add_action( 'wp_ajax_deactivate_theme', array( $this, 'deactivate_theme_data' ) );
		
		/* Admin Notice */
		add_action( 'admin_notices', array( $this, 'check_theme_license_activate' ), 90);
		
		add_action( 'admin_init', array( $this, 'theme_token_key_exist' ), 10 );
	}
	
	public function activate_theme(){
		check_ajax_referer( 'pls_nonce', 'nonce' );
		$purchase_code			= sanitize_key( wp_unslash( $_REQUEST['purchase_code'] ) );
		$theme_data				= $this->get_activate_theme_data($purchase_code);
		$data					= json_decode($theme_data,true);
		$data['purchase_code']	= $purchase_code;
		$response				= array( 'message'=> $data['message'], 'success'=> 0 );
		if($data['success']){			
			$this->update_theme_data($data);
			$response = array( 'message'=> $data['message'], 'success'=> 1 );
		}		
		echo json_encode($response);
		die();
	}
	
	public function update_theme_data($data){
		update_option( PLS_THEME_SLUG.'_token_key', $data['token'] );
		update_option( PLS_THEME_SLUG.'_is_activated', true );
		update_option( PLS_THEME_SLUG.'_plugin_file', $data['file'] );
		update_option( $this->option_name, $data['purchase_code'] );
	}
	
	public function deactivate_theme_data(){
		check_ajax_referer( 'pls_nonce', 'nonce' );
		$purchase_code			= sanitize_key( wp_unslash( $_REQUEST['purchase_code'] ) );
		$theme_data				= $this->deactivate_theme($purchase_code);
		$data					= json_decode($theme_data,true);
		$data['purchase_code']	= $purchase_code;
		$response				= array( 'message'=> $data['message'], 'success'=> 0 );
		if($data['success']){			
			$this->remove_theme_data();
			$response = array( 'message'=> $data['message'], 'success'=> 1 );
		}		
		echo json_encode($response);
		die();
	}
	
	public function remove_theme_data(){
		delete_option( PLS_THEME_SLUG.'_token_key' );
		delete_option( PLS_THEME_SLUG.'_is_activated' );
		delete_option( PLS_THEME_SLUG.'_plugin_file' );
		delete_option( $this->option_name );
	}
	
	public function get_activate_theme_data($purchase_code){
		global $wp_version;		
		$item_id	= $this->item_id;		
		$domain		= $this->get_domain();
		$response	= wp_remote_request($this->api_url.'/activate.php', array(
				'user-agent'	=> 'WordPress/'.$wp_version.'; '. home_url( '/' ) ,
				'method'		=> 'POST',
				'sslverify' => false,
				'body'			=> array(
					'purchase_code'	=> urlencode($purchase_code),
					'item_id'		=> urlencode($item_id),
					'domain'		=> urlencode($domain),
				)
			)
		);

        $response_code = wp_remote_retrieve_response_code( $response );
        $activate_info = wp_remote_retrieve_body( $response );

        if ( $response_code != 200 || is_wp_error( $activate_info ) ) {
			return json_encode(array("message"=>"Registration Connection error",'success'=>0));
        }
		return $activate_info;
	}
	
	public function deactivate_theme($purchase_code){
		global $wp_version;		
		$token_key	= $this->get_token_key();
		$item_id 	= $this->item_id;
		$response	= wp_remote_request($this->api_url.'/deactivate.php', array(
				'user-agent'	=> 'WordPress/'.$wp_version.'; '. home_url( '/' ) ,
				'method'		=> 'POST',
				'sslverify' => false,
				'body'			=> array(
					'purchase_code'	=> urlencode($purchase_code),
					'token_key'		=> urlencode($token_key),
					'item_id' 		=> urlencode($item_id),
				)
			)
		);

        $response_code = wp_remote_retrieve_response_code( $response );
        $activate_info = wp_remote_retrieve_body( $response );

        if ( $response_code != 200 || is_wp_error( $activate_info ) ) {
            return json_encode(array("message"=>"Registration Connection error",'success'=>0));
        }
		if(  $response_code == 200 ){
			return json_encode( array( "message"=>"Successfully deactivate theme license.",'success'=> 1 ) ) ;
		}
		return $activate_info;
	}
	
	public function get_domain() {
        $domain = get_option('siteurl');
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('www.', '', $domain);
        return $domain;
    }
	public function get_theme_data(){
		return wp_get_theme();
	}
	
	public function get_current_version(){
		return $this->current_version;
	}
	
	public function get_token_key(){
		return get_option( PLS_THEME_SLUG.'_token_key');
	}
	
	public function get_purchase_code(){
		return get_option( $this->option_name);
	}
		
	public function pls_is_license_activated(){ 
		if( get_option( PLS_THEME_SLUG.'_is_activated') && get_option($this->option_name) ){
			return true;
		}
		return false;
	}

	public function check_theme_license_activate(){
        
		if( pls_is_license_activated() ){
			return;
		}
		$theme_details		= wp_get_theme();
		$activate_page_link	= admin_url( 'admin.php?page=pls-theme' );

		?>
		<div class="notice notice-error is-dismissible">
			<p>
				<?php 
					echo sprintf( esc_html__( ' %1$s Theme is not activated! Please activate your theme and enjoy all features of the %2$s theme', 'pls-theme'), PLS_THEME_NAME, PLS_THEME_NAME );
					?>
			</p>
			<p>
				<strong style="color:red"><?php esc_html_e( 'Please activate the theme!', 'pls-theme' ); ?></strong> -
				<a href="<?php echo esc_url(( $activate_page_link )); ?>">
					<?php esc_html_e( 'Activate Now','pls-theme' ); ?> 
				</a> 
			</p>
		</div>
	<?php
	}
	
	public function theme_token_key_exist(){
		
		$transient_key = 'pls_verify_code';
		$is_verify = get_transient($transient_key);
		if( false !== $is_verify ){
			return;
		}
		
		global $wp_version;	
		$purchase_code	= $this->get_purchase_code();
		$token_key 		= $this->get_token_key();
		$item_id 		= $this->item_id;
		$domain 		= $this->get_domain();
		
		if( empty($token_key) ){
			delete_option( PLS_THEME_SLUG.'_token_key' );
			delete_option( PLS_THEME_SLUG.'_is_activated' );
			delete_option( PLS_THEME_SLUG.'_plugin_file' );
			delete_option( $this->option_name );
			return;
		}
		$response = wp_remote_request($this->api_url.'/verify-purchasecode.php', array(
				'user-agent'	=> 'WordPress/'.$wp_version.'; '. home_url( '/' ) ,
				'method'		=> 'POST',
				'sslverify' => false,
				'body' => array(
					'purchase_code'	=> urlencode($purchase_code),
					'token_key'		=> urlencode($token_key),
					'item_id'		=> urlencode($item_id),
					'domain'		=> urlencode($domain),
				)
			)
		);
		$response_code = wp_remote_retrieve_response_code( $response );
		$activate_info = wp_remote_retrieve_body( $response );
		$return = false;
		if ( $response_code != 200 || is_wp_error( $activate_info ) ) {
			$return = true;
		}
		if(  $response_code == 200 ){
			$data = json_decode($activate_info,true);				
			if($data['success'] == 1){
				set_transient( $transient_key, 'yes', WEEK_IN_SECONDS );
				$return = true;
			}else{
				set_transient( $transient_key, 'yes', DAY_IN_SECONDS );
			}
		}
		if( !$return ){
			delete_option( PLS_THEME_SLUG.'_token_key' );
			delete_option( PLS_THEME_SLUG.'_is_activated' );
			delete_option( PLS_THEME_SLUG.'_plugin_file' );
			delete_option( $this->option_name );
		}
	}
}
global $obj_updatetheme;
$obj_updatetheme = new PLS_Update_Theme();