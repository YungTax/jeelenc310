<?php 
/**
 * Load Elementor Elements
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Elementor\Controls_Manager;
class PLS_Elementor {
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
		add_action('elementor/widgets/register', [ $this, 'extend_element' ] );
		add_action( 'elementor/widgets/register', [ $this, 'include_widgets' ] );		
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elementor_enqueue_style' ]  );
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'elementor_custom_font' ] );
		add_filter( 'elementor/fonts/groups', [ $this, 'elementor_custom_font_groups' ] );
		add_filter( 'elementor/fonts/additional_fonts', [ $this, 'elementor_custom_additional_fonts' ] );
		
		/* Added custom controll in section/column*/
		add_action('elementor/element/before_section_end', [ $this, 'add_extra_controls' ], 10, 3);
		add_action( 'elementor/frontend/element/before_render', [ $this, 'extra_controls_render' ], 10 );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'extra_controls_render' ], 10 );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'extra_controls_render' ], 10 );
		
		add_action( 'init', [ $this, 'add_elementor_support' ] );
		add_shortcode( 'pls_block_html', [ $this, 'pls_block_html' ] );
		add_shortcode( 'pls_newsletter_dontshow_message', [ $this, 'pls_newsletter_dontshow_message' ] );
		add_action('redux/options/pls_options/saved', [ $this, 'elementor_global_settings' ] );
	}
	
	public function add_category( $elements_manager ) {		
		
		$theme_name = apply_filters( 'pls_theme_name', PLS_THEME_NAME );
		$new_categories['pls-elements'] = [
			'title' => $theme_name.' '.esc_html__( 'Elements', 'pls-core' ),
			'icon' => 'fab fa-plug',
		];
		
		$exists_categories	= $elements_manager->get_categories();		
		$split_arr			= array_splice( $exists_categories, 2 );
        $all_categories		= array_merge( $exists_categories, $new_categories, $split_arr);
		
		$rearrange_categories = function ( $categories ) {
			$this->categories = $categories;
		};
		$rearrange_categories->call( $elements_manager, $all_categories );
    }
	
	function register_controls( $controls_manager ){
		require_once PLS_CORE_DIR .'/inc/elementor/controls/autocomplete.php';
		$controls_manager->register( new PLS_Autocomplete_Control() );
	}
	
	/**
     * Extend defualt elementor element
     */
    public function extend_element() {
		require_once PLS_CORE_DIR .'/inc/elementor/extend-element/accordion.php';
	}
	
	/**
     * @param $widgets_manager Elementor\Widgets_Manager
     */
    public function include_widgets($widgets_manager) {		
        $this->include_base_class($widgets_manager);
        $this->include_general_widgets($widgets_manager);
	}
	
	/*Editor style*/
	function elementor_enqueue_style(){
		wp_enqueue_style( 'pls-font', PLS_STYLES.'presslayouts-font.css', array(), '1.0' );
		wp_enqueue_style( 'linearicons-free', PLS_STYLES.'linearicons.css', array(), '1.0.0' );
		wp_enqueue_style( 'pls-elementor-style',  PLS_CORE_URL . 'inc/elementor/assets/css/pls-elementor.css', array( 'elementor-editor' ),'1.0.0' );
	}
		
	function elementor_custom_font( $settings ){
		
		/* pls font */
		$settings['pls-icons'] = [
			'name'          => 'pls-icons',
			'label'         => esc_html__( 'PLS Icons', 'pls-core' ),
			'url' 			=> '',
			'enqueue' 		=> '',
			'prefix' 		=> 'picon-',
			'displayPrefix' => 'picon',
			'labelIcon' 	=> 'picon-user',
			'ver' 			=> '1.0',
			'fetchJson' 	=> PLS_CORE_URL.'inc/elementor/assets/js/icons/presslayouts-font.js',
			'native' 		=> true,
		];

		/*  linearicons font */
		$settings['linearicons-icons'] = [
			'name'          => 'linearicons-icons',
			'label'         => esc_html__( 'Linearicons', 'pls-core' ),
			'url' 			=> '',
			'enqueue' 		=> '',
			'prefix' 		=> 'lnr-',
			'displayPrefix' => 'lnr',
			'labelIcon' 	=> 'lnr lnr-home',
			'ver' 			=> '1.0',
			'fetchJson' 	=> PLS_CORE_URL.'inc/elementor/assets/js/icons/linearicon-font.js',
			'native' 		=> true,
		];
		
		return $settings;		
	}
	
	function elementor_custom_font_groups( $font_groups){		
		if( function_exists( 'pls_add_custom_fonts' ) ){
			$custom_font = pls_add_custom_fonts();
			if( !empty( $custom_font ) ){
				$new_font_groups = array( 'pls_custom_font' => esc_html__( 'Theme fonts', 'pls-core' ) );
				$font_groups = array_merge($new_font_groups,$font_groups);
			}
		}
		return $font_groups;		
	}
	
	function elementor_custom_additional_fonts( $additional_fonts){
		if( function_exists( 'pls_add_custom_fonts' ) ){
			$custom_font = pls_add_custom_fonts();
			if( !empty( $custom_font ) ){
				foreach( $custom_font['Custom-Fonts'] as $font ){
					$additional_font[$font] = 'pls_custom_font';
				}
				$additional_fonts = array_merge($additional_font,$additional_fonts);
			}
		}
		return $additional_fonts;		
	}
	
	/*
		Add Parallax options
	*/
	function add_extra_controls( $element, $section_id, $args ){
		if ( ( 'section' === $element->get_name() && 'section_background' === $section_id ) || ( 'column' === $element->get_name() && 'section_style' === $section_id ) ) {
			$theme_name = apply_filters( 'pls_theme_name','Alukas' );
			$element->add_control(
				'pls_option_controls',
				array(
					'label'       => '['.$theme_name.']'.esc_html__( ' Options', 'pls-core' ),
					'type'        => Controls_Manager::HEADING,
					'separator'  => 'before',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'terms' => [
									[
										'name' => 'background_background',
										'value' => 'classic',
									],
									[
										'name' => 'background_image[url]',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
							[
								'terms' => [
									[
										'name' => 'background_background',
										'value' => 'gradient',
									],
									[
										'name' => 'background_color',
										'operator' => '!==',
										'value' => '',
									],
									[
										'name' => 'background_color_b',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
						],
					],
				)
			);
			$element->add_control(
				'pls_bg_parallaxa',
				array(
					'label'       => __( 'Background Parallax', 'pls-core' ),
					'type'        => Controls_Manager::SWITCHER,
					'default'     => '',
					'return_value' => 'parallax-background',
					'prefix_class' => 'pls-',
					'render_type'  => 'template',
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'terms' => [
									[
										'name' => 'background_background',
										'value' => 'classic',
									],
									[
										'name' => 'background_image[url]',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
							[
								'terms' => [
									[
										'name' => 'background_background',
										'value' => 'gradient',
									],
									[
										'name' => 'background_color',
										'operator' => '!==',
										'value' => '',
									],
									[
										'name' => 'background_color_b',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
						],
					],
				)
			);
		}
	}
	
	/*
	Call Parallax script
	*/
	function extra_controls_render( $element ){
		$settings = $element->get_settings();		
		if( $settings['pls_bg_parallaxa'] == 'yes' || $settings['pls_bg_parallaxa'] == 'parallax-background' ){
			wp_enqueue_script('parallax');
		}
	}
	
	/**
     * Widgets Abstract Theme
     */
    public function include_base_class($widgets_manager) {
        require_once PLS_CORE_DIR .'/inc/elementor/base.php';
    }
	
	/**
     * Widgets Abstract Theme
     */
    public function include_general_widgets($widgets_manager) {    
		$woocommerce_widgets = [];
		if ( class_exists( 'WooCommerce' ) ) {
			$woocommerce_widgets = array(
				'woo-products-grid-slider',
				'woo-products-tabs',
				'woo-products-category-tabs',
				'woo-hot-deal-products',
				'woo-product-categories',
				'woo-product-custom-categories',
				'woo-product-categories-thumbnails',
				'woo-products-recently-viewed',
				'woo-products-widget',
				'woo-product-brands',
				'hotspot',
			);
			if( class_exists('WeDevs_Dokan') ){
				array_push( $woocommerce_widgets,'woo-dokan-vendors' );				
			}
			if( class_exists('WCMp') ){
				array_push( $woocommerce_widgets,'woo-wcmp-vendors' );				
			}
			if( class_exists('WCVendors_Pro') ){
				array_push( $woocommerce_widgets,'woo-wcmp-vendors' );				
			}
			if( class_exists('WCFMmp') ){
				array_push( $woocommerce_widgets,'woo-wcfm-vendors' );				
			}
		}
		
		$theme_widgets = array(
			'blog',
			'blog-slider',
			'banner',
			'banner-slider',
			'heading',
			'info-box',
			'testimonials',
			'team',
			'instagram',
			'newsletter',
			'menu-block',
			'counter',
			'countdown',
			'button',
			'social-buttons',
			'tabs',
			'accordion',
			'about-us',
			'call-to-action',
		);
		
		if( class_exists( 'WPCF7' ) ){
			array_push( $theme_widgets,'contact-us' );				
		}
		
		$widgets = array_merge( $woocommerce_widgets, $theme_widgets );
		foreach( $widgets as $widget ){
			 require_once PLS_CORE_DIR .'/inc/elementor/widgets/'.$widget.'.php';
		}
    }
	
	public function add_elementor_support() {
		//if exists, assign to $cpt_support var
		$cpt_support = get_option( 'elementor_cpt_support' );
		
		if ( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', 'product', 'portfolio', 'block' ];
			update_option( 'elementor_cpt_support', $cpt_support );
		} else  {
			$new_support = [ 'page', 'post', 'product', 'portfolio', 'block' ];
			$cpt_support = array_unique ( array_merge ( $cpt_support, $new_support ) );
			update_option( 'elementor_cpt_support', $cpt_support );
		}
	}
	
	/*
		PLS html block shortcode pls_block_html
	*/
	public function pls_block_html( $atts ){
		$args = ( shortcode_atts( array(
			'id' 	=> '',
		), $atts ) );
		extract( $args );
		
		if( empty( $id ) ){ return;}
		
		$post 		= get_post( $id );
		$content 	= '';		
		if ( ! $post || $post->post_type != 'block' ) { return; }
		if( function_exists( 'pls_block_get_content' ) ){
			$content = pls_block_get_content($id);
		}
		return $content;
	}
	
	/*
	shortcode pls_newsletter_dontshow_message
	*/
	public function pls_newsletter_dontshow_message( $atts ){
		$args = ( shortcode_atts( array(
			'message' 	=> '',
		), $atts ) );
		extract( $args );
		
		if( empty( $message ) ){ return;}
		ob_start();
		?>
		<div class="checkbox-group form-group-top clearfix">
		  <input type="checkbox" id="newsletter-donotshow" value="do-not-show">
		  <label for="newsletter-donotshow"> 
			<span class="check"></span>
			<span class="box"></span>
			<?php echo esc_html( $message );?>
		  </label>
		</div>
		<?php
		$content = ob_get_clean();
		return $content;
	}
	
	public function get_font_family_weight( $font_type, $default = array() ){
		$font = pls_get_option( $font_type, $default );
		$return_data = [ 
			'font_family' => $font['font-family'],
			'font_weight' => $font['font-weight']
		];
		return $return_data;
	}
	
	/*
		Update Global elementor settings
	*/
	public function elementor_global_settings(){
		
		$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();	
		if ( $active_kit_id ) {
			$elementor_site_settings = get_post_meta( $active_kit_id, '_elementor_page_settings', true );
			if ( empty( $elementor_site_settings ) ) {
				$elementor_site_settings = array();
			}
			$update_settings = [];
			if(isset( $elementor_site_settings['system_colors'] )){
				$link_color = pls_get_option( 'body-link-color', [ 'regular' => '#222222',
			'hover' => '#222222' ] );
				$system_colors = $elementor_site_settings['system_colors'];
				$system_colors[0]['color'] = pls_get_option( 'primary-color', '222222' );
				$system_colors[1]['color'] = pls_get_option( 'secondary-color', '#222222' );
				$system_colors[2]['color'] = pls_get_option( 'body-text-color', '#777777' );
				$system_colors[3]['color'] = $link_color['regular'];
				$system_colors[3]['title'] = esc_html__('Link', 'pls-core');
				$update_settings['system_colors'] = $system_colors;
			}else{
				$elementor_site_settings['system_colors'] = [];
				$link_color = pls_get_option( 'body-link-color', [ 'regular' => '#222222',
			'hover' => '#000000' ] );
				$system_colors = [
					0 => [ 
						'_id' => 'primary',
						'title' => 'Primary',
						'color' => '#0C99D5'
					],
					1 => [ 
						'_id' => 'secondary',
						'title' => 'Secondary',
						'color' => '#54595F'
					],
					2 => [ 
						'_id' => 'text',
						'title' => 'Text',
						'color' => '#7A7A7A'
					],
					3 => [ 
						'_id' => 'link',
						'title' => 'Link',
						'color' => '#7A7A7A'
					],
				];
				$system_colors[0]['color'] = pls_get_option( 'primary-color', '#222222' );
				$system_colors[1]['color'] = pls_get_option( 'secondary-color', '#222222' );
				$system_colors[2]['color'] = pls_get_option( 'body-text-color', '#777777' );
				$system_colors[3]['color'] = $link_color['regular'];
				$system_colors[3]['title'] = esc_html__('Link', 'pls-core');
				$update_settings['system_colors'] = $system_colors;
			}
			if(isset( $elementor_site_settings['system_typography'] )){
				$body_font = $this->get_font_family_weight('body-font',[
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px',
					'letter-spacing'	=> '',
				]);
				$secondary_font = $this->get_font_family_weight('secondary-font',[
					'color'       		=> '#333333',
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
				]);
				$heading_font = $this->get_font_family_weight('h1-headings-font',[
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '28px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				]);
				$system_typography = $elementor_site_settings['system_typography'];	
				$system_typography[0]['typography_font_family'] = $body_font['font_family'];
				$system_typography[0]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[1]['typography_font_family'] = $secondary_font['font_family'];
				$system_typography[1]['typography_font_weight'] = $secondary_font['font_weight'];
				$system_typography[2]['typography_font_family'] = $body_font['font_family'];
				$system_typography[2]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[3]['typography_font_family'] = $body_font['font_family'];
				$system_typography[3]['typography_font_weight'] = $body_font['font_weight'];
				$update_settings['system_typography'] = $system_typography;
			}else{
				$elementor_site_settings['system_typography'] = [];
				$body_font = $this->get_font_family_weight('body-font',[
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px',
					'letter-spacing'	=> '',
				]);
				$secondary_font = $this->get_font_family_weight('secondary-font',[
					'color'       		=> '#333333',
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
				]);
				$heading_font = $this->get_font_family_weight('h1-headings-font',[
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '28px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				]);
				
				$system_typography = [
					0 => [ 
						'_id' => 'primary',
						'title' => 'Primary',
						'typography_typography' => 'custom',
						'typography_font_family' => 'Jost',
						'typography_font_weight' => '400'
					],
					1 => [ 
						'_id' => 'secondary',
						'title' => 'Secondary',
						'typography_typography' => 'custom',
						'typography_font_family' => 'Jost',
						'typography_font_weight' => '400'
					],
					2 => [ 
						'_id' => 'text',
						'title' => 'Text',
						'typography_typography' => 'custom',
						'typography_font_family' => 'Jost',
						'typography_font_weight' => '400'
					],
					3 => [ 
						'_id' => 'accent',
						'title' => 'Accent',
						'typography_typography' => 'custom',
						'typography_font_family' => 'Jost',
						'typography_font_weight' => '400'
					],
				];
				
				$system_typography[0]['typography_font_family'] = $body_font['font_family'];
				$system_typography[0]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[1]['typography_font_family'] = $secondary_font['font_family'];
				$system_typography[1]['typography_font_weight'] = $secondary_font['font_weight'];
				$system_typography[2]['typography_font_family'] = $body_font['font_family'];
				$system_typography[2]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[3]['typography_font_family'] = $body_font['font_family'];
				$system_typography[3]['typography_font_weight'] = $body_font['font_weight'];
				$update_settings['system_typography'] = $system_typography;
			}
			
			$containerWidth		= pls_get_option( 'theme-container-width', 1370 );
			if( 'wide' == pls_get_option( 'theme-layout', 'full' ) ) {
				$containerWidth	= pls_get_option( 'theme-container-wide-width', 1200 );
			}
					
			$update_settings['container_width'] = ['unit' => 'px', 'size' => $containerWidth ];
			
			$elementor_site_settings = array_merge($elementor_site_settings, $update_settings);			
			update_post_meta( $active_kit_id, '_elementor_page_settings', $elementor_site_settings );
			Elementor\Plugin::$instance->files_manager->clear_cache();			
		}		
	}
	
}
new PLS_Elementor();