<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PLS_Core_Import' ) )
{
	class PLS_Core_Import {
		public $content_path;
		public $widget_path;
		public $revslider_path = array();
		public $menu;
		public $pages;
		public $data_demos;
		public $import_items;
		public $api_url;
		public $item_id;
		public $option_name = 'envato_purchase_code_45256351';
		function __construct() {
			
			$this->api_url = 'https://www.presslayouts.com/api/envato';
			$this->item_id = '45256351';
			
			/*Admin menu*/
			add_action( 'admin_menu', array( $this, 'theme_page_menu' ),99 );
			add_filter( 'pls_dashboard_tabs', array( $this, 'import_demo' ) );
			add_action( 'wp_ajax_get_demo_data',  array( $this, 'ajax_get_demo_data' ) );
			add_action( 'wp_ajax_import_full_content',  array( $this, 'import_full_content' ) );
			add_action( 'wp_ajax_import_content',  array( $this, 'import_content' ) );
			add_action( 'wp_ajax_import_menu',  array( $this, 'import_menu' ) );
			add_action( 'wp_ajax_import_theme_options',  array( $this, 'import_theme_options' ) );
			add_action( 'wp_ajax_import_widget',  array( $this, 'import_widget' ) );
			add_action( 'wp_ajax_import_revslider',  array( $this, 'import_revslider' ) );
			add_action( 'wp_ajax_import_config',  array( $this, 'import_config' ) );
			$menu_locations = array(
				'primary'					=> 'Primary Menu',
				'secondary'					=> 'Secondary Menu',
				'categories-menu' 			=> 'Categories Menu',
				'topbar-menu' 				=> 'Topbar Menu',
				'mobile-menu' 				=> 'Mobile Menu',
				'mobile-categories-menu'	=> 'Mobile Categories Menu',
				'myaccount-menu'			=> 'MyAccount/Profile Menu',
			);
			$item_import = array(
				'import_full_content'    	=> 'Import All',
				'import_content' 			=> 'Import Contents',
				'import_theme_options'   	=> 'Import Theme Options',
				'import_menu'            	=> 'Import Menu',
				'import_widget'          	=> 'Import Widgets',
				'import_revslider'       	=> 'Import Sliders',
				'import_attachments'     	=> 'Import Images',
			);
			
			$this->import_items = $item_import;
			$pages = array(
				'show_on_front' 				=> 'page',
				'page_on_front' 				=> 'Home',
				'page_for_posts' 				=> 'Blog',
				'woocommerce_shop_page_id' 		=> 'Shop',
				'woocommerce_cart_page_id' 		=> 'Cart',
				'woocommerce_checkout_page_id'  => 'Checkout',
				'woocommerce_myaccount_page_id' => 'My Account',
			);
			
			$sample_data = array(
			
				'home-v1'		=> array(
					'title' 			=> esc_html__('Home v1','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v1.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v1/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v1',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v1',
				),
				'home-v2'		=> array(
					'title' 			=> esc_html__('Home v2','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v2.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v2/?layout=v2',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v2',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v2',
				),
				'home-v3'		=> array(
					'title' 			=> esc_html__('Home v3','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v3.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v3/?layout=v3',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v3/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v3',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v3',
				),
				'home-v4'		=> array(
					'title' 			=> esc_html__('Home v4','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v4.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v4/?layout=v4',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v4',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v4',
				),
				'home-v5'		=> array(
					'title' 			=> esc_html__('Home v5','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v5.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v5/?layout=v5',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v5/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v5',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v5',
				),
				'home-v6'		=> array(
					'title' 			=> esc_html__('Home v6','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v6.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v6/?layout=v6',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v6/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v6',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v6',
				),
				'home-v7'		=> array(
					'title' 			=> esc_html__('Home v7','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v7.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v7/?layout=v7',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v7/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v7',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v7',
				),
				'home-v8'		=> array(
					'title' 			=> esc_html__('Home v8','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v8.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v8/?layout=v8',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v8/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v8',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v8',
				),
				'home-v9'		=> array(
					'title' 			=> esc_html__('Home v9','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v9.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v9/?layout=v9',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v9',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v9',
				),
				'home-v10'		=> array(
					'title' 			=> esc_html__('Home v10','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v10.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v10/?layout=v10',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v10',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v10',
				),
				'home-v11'		=> array(
					'title' 			=> esc_html__('Home v11','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v11.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v11/?layout=v11',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v11',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v11',
				),
				'home-v12'		=> array(
					'title' 			=> esc_html__('Home v12','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v12.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v12/?layout=v12',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v12/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v12',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v12',
				),
				'home-v13'		=> array(
					'title' 			=> esc_html__('Home v13','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v13.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v13/?layout=v13',
					'widgets' 			=> 'widget_data.json',
					'revslider_path' 	=> PLS_CORE_DIR . '/inc/admin/importer/demo-data/home-v13/revsliders/',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v13',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v13',
				),
				'home-v14'		=> array(
					'title' 			=> esc_html__('Home v14','pls-core'),
					'description' 		=> esc_html__('Description here','pls-core'),
					'category' 			=> 'shop',
					'preview_image' 	=> PLS_CORE_URL.'inc/admin/assets/images/home-v14.jpg',
					'preview_demo_link' => 'https://alukas.presslayouts.com/home-v14/?layout=v14',
					'widgets' 			=> 'widget_data.json',
					'theme_options' 	=> 'theme_options.json',
					'settings' 			=> array(
						'menu' 		=> $menu_locations,
						'pages' 	=> $pages,
					),
					'homepage'       	=> 'Home v14',
					'blogpage'       	=> 'Blog',
					'slug' 				=> 'home-v14',
				),
			);			
			
			$import_data   = apply_filters( 'pls_core_data_import', $sample_data );
			$this->data_demos = $import_data;
		}
		
		public function theme_page_menu() {
			add_submenu_page( 'pls-theme',
				esc_html__( 'Demo Import', 'pls-core' ),
				esc_html__( 'Demo Import', 'pls-core' ),
				'manage_options',
				'pls-demo-import',
				array( $this, 'pls_core_demo_import' )
			);
		}
		public function import_demo($args){
			$args['pls-demo-import'] = esc_html__("Demo Import", 'pls-core');
			return $args;
		}
		public function pls_core_demo_import() {
			require_once PLS_DIR.'/inc/admin/dashboard/header.php';
			$this->importer_page_content();
			require_once PLS_DIR.'/inc/admin/dashboard/footer.php';
		}
		
		private function pls_core_is_license_activated(){ 
			if( get_option( PLS_THEME_SLUG.'_is_activated' ) && get_option( $this->option_name ) ){
				return true;
			}
			return false;
		}
		
		public function importer_page_content() {
			$is_license_active			= $this->pls_core_is_license_activated();
			$time_limit					= ini_get('max_execution_time');
			$required_plugins			= pls_core_get_required_plugins_list();
			$uninstalled_plugins		= array();
			$all_plugins				= array();
			$notice_required_plugins	= array();
			foreach( $required_plugins as $plugin ) {
				if ( $plugin['required'] && is_plugin_inactive( $plugin['url'] ) ) {
					$uninstalled_plugins[$plugin['slug']] = $plugin;
					$notice_required_plugins[] = $plugin['name'];
				}
				$all_plugins[$plugin['slug']] = $plugin;
				
			}
			
			$import_notice = array();
			if($time_limit < 600 ){
				$import_notice[] = wp_kses(sprintf( __( 'Current execution time %s - We recommend setting max execution time to at least <strong>600</strong> for import demo content. See: <a href="%s" target="_blank">Increasing max execution to PHP</a>', 'pls-core' ), $time_limit, 'https://wordpress.org/support/article/common-wordpress-errors/#php-errors' ), array( 'strong' => array(), 'br' => array(), 'a' => array( 'href' => array(), 'target' => array() ) ) );
			}
			if(!empty($uninstalled_plugins)){
				$plugin_install_link = admin_url().'themes.php?page=pls-install-plugins';
				$import_notice[] = sprintf(__('Please Install Required plugin : %s <a href="%s">Click here</a>','pls-core'), implode(', ', $notice_required_plugins),$plugin_install_link);
			}
			$import_demo_system_status = false;
			if(empty($import_notice)){
				$import_demo_system_status = true;
			}
			?>			
			<div class="pls-import-data">
				<div class="pls-row">
					<div class="pls-wrap">
						<div class="pls-box">
							<div class="pls-box-header">
								<div class="title"><?php esc_html_e('Import Demo Content', 'pls-core');?></div>
							</div>
							<div class="pls-box-body">
								<div class="pls-warning">
									<h3><?php esc_html_e('Please read before importing:','pls-core');?></h3>
									<p><?php esc_html_e('This importer will help you build your site look like our demo. Importing data is recommended on fresh install.','pls-core');?></p>
									<p><?php echo sprintf(esc_html__('Please ensure you have already installed and activated %s Core, WooCommerce, Elementor and Revolution Slider plugins.','pls-core'), PLS_THEME_NAME);?></p>
									<p><?php echo sprintf( esc_html__('The media is replace with placeholders in dummy import data','pls-core'));?></p>
									<p><?php echo sprintf( __('It can take a few minutes to complete. <strong>Please don\'t close your browser while importing.</strong>','pls-core'));?></p>
									<p><?php echo sprintf(__('See recommendation for importer and WooCommerce to run fine: <a target="_blank" href="%s"> Click here </a>','pls-core'), 'https://docs.presslayouts.com/toolsmart/index.html#requirement');?>
									</p>									
								</div>
								
								<?php if($is_license_active ) { 
									if( !empty( $import_notice ) ){ ?>
										<div class="pls-import-notice pls-error">
											<h3><?php esc_html_e('Demo import notice :','pls-core');?></h3>
											<?php foreach($import_notice as $notice){	?>
												<p><?php echo ($notice)?></p>
											<?php } ?>
										</div>
									<?php }
									if ( empty($notice_required_plugins) ) :
									?>
									<h3><?php esc_html_e('Select the options below which you want to import:','pls-core');?></h3>
									<div class="theme-browser rendered">
										<div id="pls-demo-themes" class="themes wp-clearfix">		
											<?php 
											$demo_versions = $this->data_demos;
											
												if(!empty($demo_versions)){
													foreach($demo_versions as $demo_key => $demo_data){
													?>
													<div class="col-md-4 theme <?php echo esc_attr($demo_data['category']);?>" id="pls-<?php echo esc_attr($demo_key);?>" data-name="<?php echo esc_attr($demo_key);?>">
														<div class="theme-screenshot">
															<img src="<?php echo esc_url($demo_data['preview_image']);?>" alt='<?php echo esc_attr($demo_data['title']);?>'>
														</div>
														<span class="more-details import-button" data-name="<?php echo esc_attr($demo_key);?>"><?php esc_html_e('Import','pls-core');?></span>
														
														<div class="theme-id-container">				
															<h2 class="theme-name">
																<?php echo esc_html($demo_data['title']);?>
															</h2>
															<div class="theme-actions">
																<a href="<?php echo esc_url($demo_data['preview_demo_link']);?>" target="_blank"class="button button-primary"><?php esc_html_e('Preview','pls-core');?></a>
															</div>
														</div>
													</div>
													<?php
													}
													$this->import_popup();
												}
											?>
										</div> <!-- #pls-demo-themes -->
									</div><!-- .theme-browser -->
									<?php endif; ?>
								<?php } else { 
									$activate_page_link = admin_url( 'admin.php?page=pls-theme' );
									echo sprintf( __('Please Active theme license to import our demo content: <a href="%s"> Click here </a>','pls-core'), esc_url( $activate_page_link ) );
								 }?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		
		public function import_popup(){
			$required_plugins = pls_core_get_required_plugins_list();
			$uninstalled_plugins = array();
			$all_plugins = array();
			foreach( $required_plugins as $plugin ) {
				if ( $plugin['required'] && is_plugin_inactive( $plugin['url'] ) ) {
					$uninstalled_plugins[$plugin['slug']] = $plugin;
				}
				$all_plugins[$plugin['slug']] = $plugin;
			}
					
			?>
			<div class="pls-import-demo-popup mfp-hide">
				<div id="pls-popup-content"></div>
				<script type="text/html" id="tmpl-pls-popup-data">
					<div class="pls-box import-popup-wrp">
						<div class="pls-box-header">
							<div class="title">{{data.title}}</div>
						</div>
						<div class="pls-box-body">
							<?php 
							if(!empty($uninstalled_plugins)){
								esc_html_e('Please Install Required plugin.','pls-core');
							?>
								<a href="<?php echo admin_url().'themes.php?page=pls-install-plugins';?>"><?php esc_html_e('Click Here','pls-core');?></a>
							<?php
							}else{ ?>
								<p>
									<?php esc_html_e('The import process can take about 10 minutes. Please don\'t refresh the page. ','pls-core'); ?>
								</p>
								<div class="import-options">
									<?php 
										foreach($this->import_items as $key => $item){
										?>
										<label for="<?php echo $key?>_{{data.demo_key}}">
										<input id="<?php echo $key?>_{{data.demo_key}}" value="1" type="checkbox" class="<?php echo esc_attr( $key ); ?>">
										<?php echo $item;?>
										</label>
										<?php
										}
										?>	
								</div>
								<div class="import-process" style="display:none">
									<div class="progress-percent">0%</div>
									<div class="progress-bar"></div>
								</div>
								<div class="button install-demo disabled" data-demo='{{data.demo_key}}'><?php esc_html_e('Install Demo','pls-core');?></div>
								
								<div id="installation-progress">{{data.process_msg}}</div>
							<?php } ?>
						</div>
					</div>
				</script>
			</div> <?php
		}
		
		public function get_token_key(){
			return get_option( PLS_THEME_SLUG.'_token_key' );
		}
		
		public function get_purchase_code(){
			return get_option( $this->option_name);
		}
		public function theme_token_key_exist(){
			global $wp_version;	
			$purchase_code = $this->get_purchase_code();
			$token_key = $this->get_token_key();
			$item_id = $this->item_id;	
			$response = wp_remote_request($this->api_url.'/importdemo.php', array(
					'user-agent' => 'WordPress/'.$wp_version.'; '. home_url( '/' ) ,
					'method' => 'POST',
					'sslverify' => false,
					'body' => array(
						'purchase_code' => urlencode($purchase_code),
						'token_key' 	=> urlencode($token_key),
						'item_id' 		=> urlencode($item_id),
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
					$return = true;
				}
			}
			
			return $return;
		}
		
		public function ajax_get_demo_data(){
			$demo_name 				= isset($_POST['demo']) ? $_POST['demo'] :'demo-1';
			$demo_data 				= $this->data_demos[$demo_name];
			$demo_data['status'] 	= true;
			$token_exist 			= $this->theme_token_key_exist();
			if( !$token_exist ){
				$demo_data = array();
				$demo_data['status'] 	= false;
				$demo_data['message']	= 'Something went wrong!!';
			}			
			echo json_encode($demo_data);
			die();
		}
		
		public function import_full_content(){
			$demo_name = isset($_POST['demo_name']) ? $_POST['demo_name'] :'demo-1';
			echo $demo_name.' import_full_content';
			die();
		}
		
		function before_content_import() {
            // Set some WooCommerce settings
            if ( class_exists( 'WooCommerce' ) ) {
				$woocommerce_pages = array(
					'woocommerce_shop_page_id' 		=> 'Shop',
					'woocommerce_cart_page_id' 		=> 'Cart',
					'woocommerce_checkout_page_id'  => 'Checkout',
					'woocommerce_myaccount_page_id' => 'My Account',
					'yith_wcwl_wishlist_page_id' 	=> 'Wishlist'
				);			
				foreach ( $woocommerce_pages as $page_name => $page_title ) {
					$page_id = $this->pls_get_page_by_title( $page_title );
					if ( $page_id ) {
						wp_delete_post( $page_id, true );
						update_option( $page_name, '' );
					}
				}
                
				update_option( 'woocommerce_single_image_width', 800 );
				update_option( 'woocommerce_thumbnail_image_width', 325 );
				update_option( 'woocommerce_thumbnail_cropping', '1:1' );			
				update_option( 'medium_size_w', 480 );
				update_option( 'medium_size_h', 360 );
				update_option( 'large_size_w', 1024 );
				update_option( 'large_size_h', 576 );
				
				global $wpdb;
				$prefix = PLS_PREFIX;
                if (current_user_can('administrator')) {
                    $attributes = array(
						array(
                            'attribute_label'   => 'Collection',
                            'attribute_name'    => 'collection',
                            'attribute_type'    => 'select',
                            'attribute_orderby' => 'menu_order',
                            'attribute_public'  => '0'
                        ),
                        array(
                            'attribute_label'   => 'Color',
                            'attribute_name'    => 'color',
                            'attribute_type'    => 'select',
                            'attribute_orderby' => 'menu_order',
                            'attribute_public'  => '0'
                        ),						
						array(
                            'attribute_label'   => 'Composition',
                            'attribute_name'    => 'composition',
                            'attribute_type'    => 'select',
                            'attribute_orderby' => 'menu_order',
                            'attribute_public'  => '0'
                        ),
						array(
                            'attribute_label'   => 'Material',
                            'attribute_name'    => 'material',
                            'attribute_type'    => 'select',
                            'attribute_orderby' => 'menu_order',
                            'attribute_public'  => '0'
                        ),
                        array(
                            'attribute_label'   => 'Size',
                            'attribute_name'    => 'size',
                            'attribute_type'    => 'select',
                            'attribute_orderby' => 'menu_order',
                            'attribute_public'  => '0'
                        ),
                    );

                    foreach ($attributes as $attribute):
                        if (empty($attribute['attribute_name']) || empty($attribute['attribute_label'])) {
                            return new WP_Error('error', __('Please, provide an attribute name and slug.', 'pls-core'));
                        } elseif (($valid_attribute_name = $this->wc_valid_attribute_name($attribute['attribute_name'])) && is_wp_error($valid_attribute_name)) {
                            return $valid_attribute_name;
                        } elseif (taxonomy_exists(wc_attribute_taxonomy_name($attribute['attribute_name']))) {
							
							$attribute_name = wc_sanitize_taxonomy_name('pa_' . $attribute['attribute_name']);
							update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_size', 'normal' );
							if( 'color' == $attribute['attribute_name'] || 'size' == $attribute['attribute_name'] ){
								update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_enable_swatch', 1);
							}							
							update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_style', 'circle' );
							if( 'color' == $attribute['attribute_name']){
								update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_type', 'color' );
							}else{
								update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_type', 'label' );
							}
                            return new WP_Error('error', sprintf(__('Slug "%s" is already in use. Change it, please.', 'pls-core'), sanitize_title($attribute['attribute_name'])));
                        }

                        $wpdb->insert($wpdb->prefix . 'woocommerce_attribute_taxonomies', $attribute);

                        do_action('woocommerce_attribute_added', $wpdb->insert_id, $attribute);
						
                        $attribute_name = wc_sanitize_taxonomy_name('pa_' . $attribute['attribute_name']);
						update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_size', 'normal' );
						if( 'color' == $attribute['attribute_name'] || 'size' == $attribute['attribute_name'] ){
							update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_enable_swatch', 1);
						}
						update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_style', 'circle' );
						if( 'color' == $attribute['attribute_name']){
							update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_type', 'color' );
						}else{
							update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_type', 'label' );
						}
						
                        if (!taxonomy_exists($attribute_name)) {
                            $args = array(
                                'hierarchical' => true,
                                'show_ui'      => false,
                                'query_var'    => true,
                                'rewrite'      => false,
                            );
                            register_taxonomy($attribute_name, array('product'), $args);
                        }


                        flush_rewrite_rules();
                        delete_transient('wc_attribute_taxonomies');
                    endforeach;
                }
            }
        }

        function wc_valid_attribute_name($attribute_name) {
            if (!class_exists('WooCommerce')) {
                return false;
            }

            if (strlen($attribute_name) >= 28) {
                return new WP_Error('error', sprintf(__('Slug "%s" is too long (28 characters max). Shorten it, please.', 'pls-core'), sanitize_title($attribute_name)));
            } elseif (wc_check_if_attribute_name_is_reserved($attribute_name)) {
                return new WP_Error('error', sprintf(__('Slug "%s" is not allowed because it is a reserved term. Change it, please.', 'pls-core'), sanitize_title($attribute_name)));
            }

            return true;
        }
		
		
		public function import_content(){			
			$attachments		= isset($_POST['attachments']) ? $_POST['attachments'] :false;			
			$conetnt_data_file	= PLS_CORE_DIR . '/inc/admin/importer/demo-data/sample_data.xml';	
			$content_import		= get_option( 'pls_content_import', false );
			if ( current_user_can( 'manage_options' ) && !$content_import ) {
				$this->before_content_import();
				if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

				if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
					$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
					include $wp_importer;
				}

				if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
					$wp_import = PLS_CORE_DIR . '/inc/admin/importer/wordpress-importer.php';					
					include $wp_import;
				}
				if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { 
					/* Import Posts, Pages, Product, Portfolio Content, Blocks, Images, Menus */
					$importer = new WP_Import();
					$importer->fetch_attachments = $attachments;
					ob_start();
					//set_time_limit(0);					
					$importer->import($conetnt_data_file);
					ob_end_clean();					
					// Flush rules after install
					flush_rewrite_rules();			
				}
				update_option( 'pls_content_import', 1 );
				echo 'Import content successfully';
			}			
			die();
		}
		public function import_menu(){			
			$primary  = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
			$categories_menu = get_term_by( 'name', 'Categories Menu', 'nav_menu' );
			$topbar_menu = get_term_by( 'name', 'Topbar Menu', 'nav_menu' );
			$menu_location = array();
			if( isset( $primary->term_id ) ){
				$menu_location['primary'] = $primary->term_id; 
			}
			if( isset( $categories_menu->term_id ) ){
				$menu_location['categories-menu'] = $categories_menu->term_id; 
			}
			if( isset( $topbar_menu->term_id ) ){
				$menu_location['topbar-menu'] = $topbar_menu->term_id; 
			}
			if( !empty( $menu_location ) ){
				set_theme_mod( 'nav_menu_locations', $menu_location );
			}			
			die();
		}
		public function import_theme_options(){
			$demo_name = isset($_POST['demo_name']) ? $_POST['demo_name'] :'';			
			$demo_data = $this->data_demos[$demo_name];
			$data_file_url = PLS_CORE_URL.'inc/admin/importer/demo-data/'.$demo_data['slug'].'/'.$demo_data['theme_options'];
			$options_json = $this->pls_core_get_remote_content($data_file_url);
			if($options_json){
				$options=json_decode($options_json, true);
				if( $demo_name == 'home-v11' ){
					$id = $this->pls_get_page_by_title('Landing Footer','block');
					if( !empty( $id ) ){
						$options['footer-block-id'] = $id;
					}					
				}
				update_option('pls_options', $options);
				echo 'Import options successfully';
			}else{
				echo $data_file_url;
				echo 'options missing!!';
			}
			die();
		}
		
		/* Import Widget */
		function import_widget() {
			
			$demo_name = isset($_POST['demo_name']) ? $_POST['demo_name'] :'default';
			$demo_data = $this->data_demos[$demo_name];
			$data_file_url = PLS_CORE_URL.'inc/admin/importer/demo-data/'.$demo_data['slug'].'/'.$demo_data['widgets'];
			$widget_data = $this->pls_core_get_remote_content($data_file_url);
			
			/* Clear Widgets */
			$sidebars = wp_get_sidebars_widgets();
			$inactive = isset($sidebars['wp_inactive_widgets']) && is_array( $sidebars['wp_inactive_widgets'] ) ? $sidebars['wp_inactive_widgets'] : array();

			unset($sidebars['wp_inactive_widgets']);

			foreach ( $sidebars as $sidebar => $widgets ) {
				if( is_array( $widgets ) ){
					$inactive = array_merge($inactive, $widgets);
				}

				$sidebars[$sidebar] = array();
			}

			$sidebars['wp_inactive_widgets'] = $inactive;
			wp_set_sidebars_widgets( $sidebars );
			/* End Clear Widgets */			
			
			$widget_data = json_decode( $widget_data, true);
			unset($widget_data[0]['wp_inactive_widgets']);

			$sidebar_data = $widget_data[0];
			$widget_data = $widget_data[1];

			foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
				$widgets[ $widget_data_title ] = array();
				foreach ( $widget_data_value as $widget_data_key => $widget_data_array ) {
					if ( is_int( $widget_data_key ) ) {
						$widgets[ $widget_data_title ][ $widget_data_key ] = 'on';
					}
				}
			}
			unset( $widgets[''] );

			foreach( $sidebar_data as $title => $sidebar ) {
				$count = count( $sidebar );
				for ( $i = 0; $i < $count; $i++ ) {
					$widget = array( );
					$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
					$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
					if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
						unset( $sidebar_data[$title][$i] );
					}
				}
				$sidebar_data[$title] = array_values( $sidebar_data[$title] );
			}

			foreach( $widgets as $widget_title => $widget_value ) {
				if (is_array($widget_value) || is_object($widget_value) ) {
					foreach( $widget_value as $widget_key => $widget_value ) {
						$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
					}
				}
			}

			$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

			/* Parse data */
			global $wp_registered_sidebars;

			$sidebars_data = $sidebar_data[0];
			$widget_data = $sidebar_data[1];

			$current_sidebars = get_option( 'sidebars_widgets' );

			$new_widgets = array();

			foreach( $sidebars_data as $import_sidebar => $import_widgets ) {
				foreach( $import_widgets as $import_widget ) {
					if( array_key_exists( $import_sidebar, $current_sidebars ) ) {
						$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
						$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );

						$current_widget_data = get_option( 'widget_' . $title );

						$new_widget_name = $this->pls_core_get_new_widget_name( $title, $index );
						$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

						if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
							while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
								$new_index++;
							}
						}

						$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;

						if ( array_key_exists( $title, $new_widgets ) ) {
							$new_widgets[$title][$new_index] = $widget_data[$title][$index];
							$multiwidget = $new_widgets[$title]['_multiwidget'];
							unset( $new_widgets[$title]['_multiwidget'] );
							$new_widgets[$title]['_multiwidget'] = $multiwidget;
						} else {
							$current_widget_data[$new_index] = $widget_data[$title][$index];
							$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
							$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
							$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
							unset( $current_widget_data['_multiwidget'] );
							$current_widget_data['_multiwidget'] = $multiwidget;
							$new_widgets[$title] = $current_widget_data;
						}

					}
				}
			}

			if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
				update_option( 'sidebars_widgets', $current_sidebars );

				foreach ( $new_widgets as $title => $content ) {
					$content = apply_filters( 'widget_data_import', $content, $title );
					update_option( 'widget_' . $title, $content );
				}

				return true;
			}

			return false;

			wp_die();
		}

		public function pls_core_get_new_widget_name( $widget_name, $widget_index ) {

			$current_sidebars = get_option( 'sidebars_widgets' );
			$all_widget_array = array();

			foreach ( $current_sidebars as $sidebar => $widgets ) {
				if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
					foreach ( $widgets as $widget ) {
						$all_widget_array[] = $widget;
					}
				}
			}

			while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
				$widget_index++;
			}

			$new_widget_name = $widget_name . '-' . $widget_index;
			return $new_widget_name;
		}
		
		public function import_revslider(){
			$demo_name = isset($_POST['demo_name']) ? $_POST['demo_name'] :'demo-1';			
			$demo_data = $this->data_demos[$demo_name];
			if ( !empty($demo_data['revslider_path']) && class_exists( 'RevSliderSliderImport' ) && class_exists( 'ZipArchive' ) ){
				// Import Revslider							
				foreach( glob( $demo_data['revslider_path'] . '*.zip' ) as $filename ) { // get all files from revsliders data dir					
					$filename = basename($filename);
					$filepath = $demo_data['revslider_path'] . $filename;
					ob_start();
						$import_slider = new RevSliderSliderImport();
						$import_slider->import_slider(true, $filepath);
					ob_clean();
				}
			}
			die();
		}
		
		public function find_menu_id_by_title($menu_name = 'Primary Menu',$menu_item_title = 'Shop'){
			$main_menu = get_term_by( 'name', $menu_name, 'nav_menu' );
			$menu_list_items = wp_get_nav_menu_items($menu_name);
			if(!empty($menu_list_items)){
				$selected_menu_item = array_filter( $menu_list_items, function( $item ) use($menu_item_title) {
					return $item->title == $menu_item_title;
				});			
				$current_item = array_shift( $selected_menu_item );
				if($current_item){
					return $current_item->ID;
				}
			}
			return false;
		}
		
		public function mega_menu_setup(){
			$primary_menu = array(
				'Shop' => array(
					'_menu_item_type' 				=> 'post_type',
					'_menu_item_object'				=> 'page',
					'_menu_item_pls_enable'			=> 'enabled',
					'_menu_item_pls_design'			=> 'full-width',
					'_menu_item_pls_custom_block'	=> '138'
				),
				'Product' => array(
					'_menu_item_type'				=> 'post_type',
					'_menu_item_object'				=> 'page',
					'_menu_item_pls_enable'			=> 'enabled',
					'_menu_item_pls_design'			=> 'full-width',
					'_menu_item_pls_custom_block'	=> '140'
				),
			);
			
			$categories_menu = array(
				'Necklaces' => array(
					'_menu_item_type'				=> 'taxonomy',
					'_menu_item_object'				=> 'product_cat',
					'_menu_item_pls_enable'			=> 'enabled',
					'_menu_item_pls_design'			=> 'full-width',
					'_menu_item_pls_custom_block'	=> '583'
				),
				'Rings' => array(
					'_menu_item_type'				=> 'taxonomy',
					'_menu_item_object'				=> 'product_cat',
					'_menu_item_pls_enable'			=> 'enabled',
					'_menu_item_pls_design'			=> 'full-width',
					'_menu_item_pls_custom_block'	=> '583'
				),
				'Charm & Dangles' => array(
					'_menu_item_type'				=> 'taxonomy',
					'_menu_item_object'				=> 'product_cat',
					'_menu_item_pls_enable'			=> 'enabled',
					'_menu_item_pls_design'			=> 'full-width',
					'_menu_item_pls_custom_block'	=> '583'
				),
			);
						
			foreach ($primary_menu as $menu_page => $meta_data) {
				$menu_id = $this->find_menu_id_by_title('Primary Menu',$menu_page);
				if($menu_id){
					foreach ($meta_data as $key => $value) {				
						update_post_meta( $menu_id, $key, $value);
					}
				}
			} 
			
			foreach ($categories_menu as $menu_page => $meta_data) {
				$menu_id = $this->find_menu_id_by_title('Categories Menu',$menu_page);
				if($menu_id){
					foreach ($meta_data as $key => $value) {				
						update_post_meta( $menu_id, $key, $value);
					}
				}
			}
		}
		public function import_config(){			
			$demo_name = isset($_POST['demo_name']) ? $_POST['demo_name'] :'home-v1';
			$this->mega_menu_setup();
			$this->after_import();
			$demo_data = $this->data_demos[$demo_name];
			
			$woocommerce_pages = array(
				'woocommerce_shop_page_id' 		=> 'Shop',
				'woocommerce_cart_page_id' 		=> 'Cart',
				'woocommerce_checkout_page_id'  => 'Checkout',
				'woocommerce_myaccount_page_id' => 'My Account',
			);	
			
			foreach ( $woocommerce_pages as $page_name => $page_title ) {
				$page_id = $this->pls_get_page_by_title( $page_title );
				if ( $page_id ) {
					update_option( $page_name, $page_id );
				}
			}
			
			if ( class_exists( 'YITH_Woocompare' ) ) {
				update_option( 'yith_woocompare_compare_button_in_products_list', 'yes' );
				update_option( 'yith_woocompare_is_button', 'button' );
			}
			if ( function_exists( 'yith_plugin_registration_hook' ) ) {
				update_option( 'yith_wcwl_enabled', 'yes' );
				$wishlist_page_id = $this->pls_get_page_by_title( 'Wishlist' );
				if ( $wishlist_page_id ) { 
					update_option( 'yith_wcwl_wishlist_page_id', $wishlist_page_id );
				}
				
			}
			if ( class_exists( 'WC_Admin_Notices' ) ) {
				WC_Admin_Notices::remove_notice( 'install' );
			}
			
			//Fix On Sale Products widget and elements
				
			if ( ! wc_update_product_lookup_tables_is_running() ) {
				wc_update_product_lookup_tables();
			}
			
			delete_option( '_wc_needs_pages' );
			delete_transient( '_wc_activation_redirect' );	
			delete_transient( 'wc_products_onsale' );		
						
			update_option( 'show_on_front', 'page' );
			// Home page
			if ( isset( $demo_data['homepage'] ) && $demo_data['homepage'] != "" ) {
				
				$homepage_id = $this->pls_get_page_by_title( $demo_data['homepage'] );
				if ( $homepage_id ) {
					
					update_option( 'page_on_front', $homepage_id );
				}
			}
			// Blog page
			if ( isset( $demo_data['blogpage'] ) ) {
				$post_page_id = $this->pls_get_page_by_title( $demo_data['blogpage'] );
				if ( $post_page_id ) {
					update_option( 'page_for_posts', $post_page_id );
				}
			}
			
			update_option( 'permalink_structure', '/%postname%/' );
			
			update_option( 'pls_demo_'.$demo_name, 'yes' );
			
			$mc4wp = get_posts( array( 'post_type'   => 'mc4wp-form','numberposts' => 1 ) );
			if ( $mc4wp ) {
				update_option( 'mc4wp_default_form_id', $mc4wp[0]->ID );
			}
			
			// Support Custom Post Types
			$cpt_support = get_option('elementor_cpt_support');
			if (!$cpt_support) {
				$cpt_support = [ 'page', 'post', 'product', 'block'];
				update_option('elementor_cpt_support', $cpt_support);
			} else {
				$new_support = [ 'page', 'post', 'product', 'block'];
				foreach ($new_support as $cpt) {
					if (!in_array($cpt, $cpt_support)) {
						$cpt_support[] = $cpt;
					}
				}
				update_option('elementor_cpt_support', $cpt_support);
			}
			
			// Set Elementor Options
			update_option('elementor_container_width', 1200);
			update_option('elementor_load_fa4_shim', 'yes');
			update_option('elementor_disable_color_schemes', 'yes');
			update_option('elementor_disable_typography_schemes', 'yes');
			
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			$from_url = 'https://alukas.presslayouts.com/dummy';
			$to_url = get_option( 'siteurl', '' );	
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . str_replace( '/', '\\\/', $from_url ) . "', '" . str_replace( '/', '\\\/', $to_url ) . "') where `meta_key` = '_elementor_data';");	
	
			Elementor\Plugin::$instance->files_manager->clear_cache();
			
			flush_rewrite_rules();			
			die();
		}
		
		public function after_import(){
			// Move Hello World post to trash
			wp_trash_post( 1 );
			 
			// Move Sample Page to trash
			wp_trash_post( 2 );
			$cat_term = array( 
				'bracelets'		=> array('category_icon' => 689),
				'charm-dangles'	=> array('category_icon' => 689),
				'earnings'		=> array('category_icon' => 689),
				'gift-ideas'	=> array('category_icon' => 689),
				'necklaces'		=> array('category_icon' => 689),
				'rings'			=> array('category_icon' => 689),
			);
			$prefix	= PLS_PREFIX;
			foreach ($cat_term as $term_name => $data) {
				$term = get_term_by( 'slug', $term_name, 'product_cat' );
				if(!empty($term)){
					foreach ($data as $key => $value) {
						update_term_meta( $term->term_id, $prefix.$key, $value );
					}
				}				
			}
			
			$brand_term = array( 
				'bershka'	=> array('thumbnail_id' => 688),
				'h-m'		=> array('thumbnail_id' => 688),
				'mango'		=> array('thumbnail_id' => 688),
				'pull-bear'	=> array('thumbnail_id' => 688),
				'ray-ban'	=> array('thumbnail_id' => 688),
				'zara'		=> array('thumbnail_id' => 688),
			);
			foreach ($brand_term as $term_name => $data) {
				$term = get_term_by( 'slug', $term_name, 'product_brand' );
				if(!empty($term)){
					foreach ($data as $key => $value) {
						update_term_meta( $term->term_id, $key, $value );
					}
				}				
			}
		}
		
		public function pls_get_page_by_title($page_title, $post_type = 'page'){
			global $wpdb;
			$page_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '".$page_title."' AND post_type = '".$post_type."'" );
			return $page_id;
		}
		
		public function pls_core_get_remote_content( $url) {
			$response = wp_remote_get($url);
			if( is_array($response) && $response['response']['code'] !== 404 ) {
				$header = $response['headers'];
				$body = $response['body'];
				return $body;
			}
			return false;
		}
	
	}
	$obj_import = new PLS_Core_Import();
	
}