<?php  
if ( ! defined( 'PLS_DIR' ) ) exit( 'No direct script access allowed' );
/**
 * PLS Metabox
 * @package 	/inc
 */
 
if ( ! class_exists( 'PLS_Metabox' ) ) :

	/**
	 * PLS_Metabox
	 *
	 * @since 1.0
	 */
	class PLS_Metabox {
		
		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;
		
		private $prefix = PLS_PREFIX;
		
		public $post_types;
		
		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->post_types = array( 'post', 'page', 'product' );
			add_action( 'admin_init', array( $this, 'register_metaboxes' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_js_var' ) );
		}		
		
		public function meta_boxes(){
			/* Page Meta Options */
			$meta_boxes					= array();
			$meta_boxes['post_format']	= $this->post_format_options();						
			$meta_boxes['products_tab']	= $this->products_tab_options();
			$meta_boxes['products']		= $this->products_options();			
			$meta_boxes['page_layout']	= $this->page_layout_options();			
			$meta_boxes['header']		= $this->header_options();			
			$meta_boxes['page_title']	= $this->page_title_options();
			$meta_boxes['footer']		= $this->footer_options();
			
			return apply_filters('pls_page_meta_options' , $meta_boxes );
		}
		public function post_format_options(){
			$prefix = $this->prefix;
			$options = array(
				'title' 		=> esc_html__('Post Format', 'pls-theme'),
				'id' 			=> $prefix .'meta_box_post_format',
				'post_types' 	=> array('post'),
				'tab'   		=> true,
				'fields' 		=> array(
					array(
						'name' 				=> esc_html__('Image', 'pls-theme'),
						'label_description' => esc_html__( 'Select images image for post', 'pls-theme' ),
						'id' 				=> $prefix . 'post_format_image',
						'type' 				=> 'image_advanced',
						'max_file_uploads' 	=> 1,
					),
					array(
						'name' 				=> esc_html__('Gallery', 'pls-theme'),
						'label_description' => esc_html__( 'Select images gallery for post', 'pls-theme' ),
						'id' 				=> $prefix . 'post_format_gallery',
						'type' 				=> 'image_advanced',
					),
					array(
						'name' 				=> esc_html__( 'Video URL or Embeded Code', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter the URL or embed code of Vimeo.com or YouTube.com streaming services.<br>To get the code, go to the external video page, click "share" button and copy the Embed code.This setting is used for your video post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_video',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Audio URL or Embeded Code', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter the URL or Embeded code of the audio.This setting is used for your audio post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_audio',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Quote', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter your quote.This setting is used for your quote post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_quote',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Author', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter quote author.This setting is used for your quote post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_quote_author',
						'type' 				=> 'text',
					),
					array(
						'name' 				=> esc_html__( 'Author URL', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter quote author url.This setting is used for your quote post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_quote_author_url',
						'type' 				=> 'url',
					),
					array(
						'name' 				=> esc_html__( 'Link', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter your external url.This setting is used for your link post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_link_url',
						'type' 				=> 'url',
					),					
					array(
						'name' 				=> esc_html__( 'Text', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter link text for link.This setting is used for your link post formats.', 'pls-theme' ),
						'id'   				=> $prefix . 'post_format_link_text',
						'type' 				=> 'text',
					),
				),
			);	
			return apply_filters('pls_post_format_meta_options' , $options);
		}
		
		public function products_tab_options(){		
			$prefix = $this->prefix;
			$options = array(
				'id' 			=> $prefix . 'product_custom_tab_meta',
				'title' 		=> esc_html__( 'Product Custom Tab', 'pls-theme' ),
				'post_types' 	=> array('product'),
				'fields' 		=> array(
					array(
						'name'  			=> esc_html__( 'Enable Custom Tab.', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Check this for enable custom tab.', 'pls-theme' ),
						'id'    			=> $prefix . 'enable_custom_tab',
						'type'  			=> 'checkbox',
						'std'				=> 0,
					),
					array (
						'name' 				=> esc_html__('Custom Tab Title', 'pls-theme'),
						'label_description' => esc_html__( 'Enter tab title.', 'pls-theme' ),
						'id' 				=> $prefix . 'product_custom_tab_heading',
						'type' 				=> 'text',
						'std' 				=> '',
						'required-field' 	=> array( $prefix . 'enable_custom_tab', '=', array( '1' ) ),
					),
					array(
						'name'  			=> esc_html__( 'Custom Tab Content.', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter tab content.', 'pls-theme' ),
						'id'    			=> $prefix . 'product_custom_tab_content',
						'type'  			=> 'wysiwyg',
						'raw'     			=> false,
						'options' 			=> array(
							'textarea_rows' 	=> 4,
							'teeny'         	=> true,
						),
						'required-field' 	=> array( $prefix . 'enable_custom_tab', '=', array( '1' ) ),
					), 
				)
			);
			return apply_filters('pls_product_tabs_meta_options' , $options);
		}
		
		public function products_options(){
			$prefix		= $this->prefix;
			$size_guide = pls_get_posts_by_post_type( 'pls_size_chart', esc_html__( 'Select Size Chart', 'pls-theme' ) );
			
			$options = array(
				'id' 			=> $prefix . 'product_setting_meta_box',
				'title' 		=> esc_html__( 'Product Setting', 'pls-theme' ),
				'post_types' 	=> array( 'product' ),
				'tab' 			=> true,
				'fields' 		=> array(											
					array(
						'name'  			=> esc_html__( 'Product Content layout', 'pls-theme' ),
						'label_description' => esc_html__( 'Select product content layout.', 'pls-theme' ),
						'id'    			=> $prefix . 'single_product_content_layout',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'		=> esc_html__( 'Default', 'pls-theme' ),
							'style-1' 		=> esc_html__( 'Simple', 'pls-theme' ),
							'style-2'  		=> esc_html__( 'Showcase', 'pls-theme' ),
							'style-3'  		=> esc_html__( 'Modern', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Product Content Full Width', 'pls-theme' ),
						'label_description'	=> esc_html__( 'You want to display product content area in full width? Note: This option only works when the Page Layout is full width (no sidebar).', 'pls-theme' ),
						'id'    			=> $prefix . 'product_content_fullwidth',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'enable' 	=> esc_html__( 'Enable', 'pls-theme' ),
							'disable'  	=> esc_html__( 'Disable', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Content Background Color', 'pls-theme' ),
						'label_description'	=> esc_html__( 'You want to display content background color? Note: This option only works when the Page Layout is full width (no sidebar).', 'pls-theme' ),
						'id'    			=> $prefix . 'product_content_background',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'		=> esc_html__( 'Default', 'pls-theme' ),
							'none'			=> esc_html__( 'None', 'pls-theme' ),
							'custom' 		=> esc_html__( 'Custom','pls-theme' ),
							'dark'  		=> esc_html__( 'Dark', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Background Color', 'pls-theme' ),
						'label_description' => esc_html__( 'Set product content background color. Note: This option only works when Content Background Color enable.', 'pls-theme' ),
						'id'    			=> $prefix.'product_content_background_color',
						'type'  			=> 'color',
						'std'				=> '#f5f5f5',
					),
					array(
						'name'  			=> esc_html__( 'Product Gallery Style', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Select product gallery style.', 'pls-theme' ),
						'id'    			=> $prefix.'product_gallery_style',
						'type'  			=> 'image_set',
						'allowClear' 		=> true,
						'options' 			=> array(
							'product-gallery-left'	  		=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
							'product-gallery-right'	  		=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
							'product-gallery-bottom'		=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
							'product-gallery-none'			=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
							'product-gallery-grid'			=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-grid.png',
							'product-sticky-info'			=> PLS_ADMIN_IMAGES . 'product-page/product-sticky-info.png',
							'product-gallery-horizontal'	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-horizontal.png',
						),
						'std'				=> '',
						'multiple' 			=> false,
						'required' 			=> true,
					),
					array(
						'name' 				=> esc_html__( 'Product Video url', 'pls-theme' ),
						'id'   				=> $prefix . 'product_video',
						'label_description'	=> esc_html__( 'Youtube, Vimeo embaded link', 'pls-theme' ),
						'type' 				=> 'text',
					),
					array(
						'name' 				=> esc_html__( 'Product Size Guide', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Select product size guide.', 'pls-theme' ),
						'id'   				=> $prefix . 'size_guide',
						'type' 				=> 'select',
						'options'			=> $size_guide,
						'max_file_uploads' 	=> 1,
					),
					array(
						'name'             	=> esc_html__( 'Product 360 Degree Images', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Upload 360 degree images.', 'pls-theme' ),
						'id'               	=> $prefix . 'product_360_degree_images',
						'type'             	=> 'image_advanced',
						'force_delete'     	=> false,
					),
					array(
						'name'  			=> esc_html__( 'Bought Together Location', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Select Bought Together Location.', 'pls-theme' ),
						'id'    			=> $prefix . 'product_bought_together_location',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'			=> esc_html__('Default','pls-theme'),
							'summary-bottom' 	=> esc_html__('Summary Bottom','pls-theme'),
							'after-summary'  	=> esc_html__('After Summary','pls-theme'),
							'in-tab'  			=> esc_html__('In Tab','pls-theme'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),						
					array(
						'name'  			=> esc_html__( 'Product Tabs Style', 'pls-theme' ),
						'label_description' => esc_html__( 'Select Product Tabs Style.', 'pls-theme' ),
						'id'    			=> $prefix . 'single_product_tabs_style',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'		=> esc_html__('Default','pls-theme'),
							'tabs' 			=> esc_html__('Tabs','pls-theme'),
							'accordion'  	=> esc_html__('Accordion','pls-theme'),
							'toggle'  		=> esc_html__('Toggle','pls-theme'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Product Tabs Location', 'pls-theme' ),
						'label_description' => esc_html__( 'Select Product Tabs Location.', 'pls-theme' ),
						'id'    			=> $prefix . 'single_product_tabs_location',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'			=> esc_html__( 'Default', 'pls-theme' ),
							'after-summary' 	=> esc_html__( 'After Summary', 'pls-theme' ),
							'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name' 				=> esc_html__( 'Tabs Content Width', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Enter tabs content width( Min 30% & Max 100% ). Note: Content width work only tabs layout.', 'pls-theme' ),
						'id' 				=> $prefix.'single_product_tabs_content_width',
						'type' 				=> 'number',
					),
				)
			);
			return apply_filters('pls_product_meta_options' , $options);
		}
		
		public function page_layout_options(){
			$prefix	= $this->prefix;			
			/* Page  Options */
			$options = array(
				'title' 		=> 	esc_html__('Page Layout', 'pls-theme'),
				'id' 			=> $prefix.'layout_options',
				'post_types' 	=> $this->post_types,
				'tab' 			=> 	true,
				'fields' 		=> 	array(
					array(
						'name'  		=> esc_html__( 'Page Sidebar', 'pls-theme' ),
						'id'    		=> $prefix.'page_layout',
						'type'  		=> 'image_set',
						'allowClear' 	=> true,
						'options' 		=> array(
							'full-width'	  => PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
							'left-sidebar'	  => PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
							'right-sidebar'	  => PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
						),
						'std'			=> '',
						'multiple' 		=> false,
						'required' 		=> true,
					),
					array (
						'name' 				=> esc_html__('Sidebar Widget', 'pls-theme'),
						'label_description'	=> esc_html__('Select sidebar. If empty then it take value from theme options.','pls-theme'),
						'id' 				=> $prefix.'sidebar_widget',
						'type' 				=> 'sidebar',
						'field_type'  		=> 'select_advanced',
						'placeholder' 		=> esc_attr__('Select Sidebar','pls-theme'),
						'std' 				=> '',	
						'required-field' 	=> array($prefix . 'page_layout', '=', array( 'left-sidebar', 'right-sidebar' ) ),																
					),										
				),
			);
			return apply_filters('pls_page_layout_meta_options' , $options);
		}
		
		public function header_options(){		
			$prefix = $this->prefix;
			/* Header Options */
			$options = array(
				'title' 		=> esc_html__('Header', 'pls-theme'),
				'id' 			=> $prefix .'header_options',
				'post_types' 	=> array('post','page','product'),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Header Top', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Enable or disable the top bar.', 'pls-theme' ),
						'id'    			=> $prefix . 'header_top',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Header', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable the header.', 'pls-theme' ),
						'id'    			=> $prefix . 'header',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Select Header Style', 'pls-theme' ),
						'label_description' => esc_html__( 'Select header style.', 'pls-theme' ),
						'id'    			=> $prefix.'header_style',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'		=> esc_html__( 'Default', 'pls-theme' ),
							'1'      		=> esc_html__( 'Header 1', 'pls-theme' ),
							'2'   			=> esc_html__( 'Header 2', 'pls-theme' ),
							'3' 			=> esc_html__( 'Header 3', 'pls-theme' ),
							'4'				=> esc_html__( 'Header 4', 'pls-theme' ),
							'5'				=> esc_html__( 'Header 5', 'pls-theme' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Header Transparent', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable the header transparent/overlay.', 'pls-theme' ),
						'id'    			=> $prefix . 'header_transparent',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'enable' 	=> esc_html__( 'Enable', 'pls-theme' ),
							'disable'  	=> esc_html__( 'Disable', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Header Transparent Color', 'pls-theme' ),
						'label_description' => esc_html__( 'Select header color schema.', 'pls-theme' ),
						'id'    			=> $prefix . 'header_transparent_color',
						'type'  			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'light'    	=> esc_html__( 'Light', 'pls-theme' ),
							'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
				),
			);
			return apply_filters('pls_header_meta_options' , $options);
		}
		
		public function page_title_options(){		
			$prefix	= $this->prefix;
			/* Title Options */
			$options = array(
				'title' 		=> esc_html__( 'Page Title', 'pls-theme' ),
				'id' 			=> $prefix.'page_title_options',
				'post_types' 	=> array( 'page' ),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Page Title', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable the page title section.', 'pls-theme' ),
						'id'    			=> $prefix.'page_title',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'enable'	=> esc_html__( 'Enable', 'pls-theme' ),
							'disable'	=> esc_html__( 'Disable', 'pls-theme' ),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Heading', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable the heading.', 'pls-theme' ),
						'id'    			=> $prefix.'page_heading',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'enable' 	=> esc_html__( 'Enable', 'pls-theme' ),
							'disable'  	=> esc_html__( 'Disable', 'pls-theme' ),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name' 				=> esc_html__( 'Custom Header Title', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Alter the main title display.', 'pls-theme' ),
						'desc' 				=> '',
						'id' 				=> $prefix . 'custom_page_title',
						'type' 				=> 'text',
					),
					array(
						'name' 				=> esc_html__( 'Sub Title', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Enter page subtitle.', 'pls-theme' ),
						'desc' 				=> '',
						'id' 				=> $prefix . 'page_subtitle',
						'type' 				=> 'text',
					),
					array(
						'name'  			=> esc_html__( 'Title Style', 'pls-theme' ),
						'label_description' => esc_html__( 'Select a page title style.', 'pls-theme' ),
						'id'    			=> $prefix.'page_title_layout',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'title-centered' => esc_html__( 'Title Centered', 'pls-theme' ),
							'center'	=> esc_html__( 'Centered', 'pls-theme' ),
							'left' 		=> esc_html__( 'Left', 'pls-theme' ),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Header Font Size', 'pls-theme' ),
						'label_description' => esc_html__( 'Select page title font size.', 'pls-theme' ),
						'id'    			=> $prefix.'title_font_size',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'small'    	=> esc_html__( 'Small', 'pls-theme' ),
							'large'		=> esc_html__( 'Large', 'pls-theme' ),						
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std'			=> 'default',
					),
					array(
						'name' 				=> esc_html__( 'Padding Top', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Enter padding top in pixel', 'pls-theme' ),
						'id' 				=> $prefix.'title_padding_top',
						'type' 				=> 'number',
					),
					array(
						'name' 				=> esc_html__( 'Padding Bottom', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter padding bottom in pixel', 'pls-theme' ),
						'id' 				=> $prefix.'title_padding_bottom',
						'type' 				=> 'number',
					),
					array(
						'name'  			=> esc_html__( 'Background Color', 'pls-theme' ),
						'label_description' => esc_html__( 'Select a background color for title.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_color',
						'type'  			=> 'color',
					),
					array(
						'name' 				=> esc_html__( 'Color', 'pls-theme' ),
						'label_description'	=> esc_html__( 'Select a title color.', 'pls-theme' ),
						'desc' 				=> '',
						'id' 				=> $prefix.'title_color',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'light'    	=> esc_html__( 'Light', 'pls-theme' ),
							'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Background Image', 'pls-theme' ),
						'label_description' => esc_html__( 'Select a custom image for your main title.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_img',
						'type'  			=> 'single_image',
					),
					array(
						'name'  			=> esc_html__( 'Position', 'pls-theme' ),
						'label_description' => esc_html__( 'Select your background image position.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_position',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'		=> esc_html__( 'Default', 'pls-theme' ),
							'left-top'      => esc_html__( 'Left Top', 'pls-theme' ),
							'left-center'   => esc_html__( 'Left Center', 'pls-theme' ),
							'left-bottom' 	=> esc_html__( 'Left Bottom', 'pls-theme' ),
							'right-top'		=> esc_html__( 'Right Top', 'pls-theme' ),
							'right-center'	=> esc_html__( 'Right Center', 'pls-theme' ),
							'right-bottom'	=> esc_html__( 'Right Bottom', 'pls-theme' ),
							'center-top'	=> esc_html__( 'Center Top', 'pls-theme' ),
							'center-center'	=> esc_html__( 'Center Center', 'pls-theme' ),
							'center-bottom'	=> esc_html__( 'Center Bottom', 'pls-theme' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Attachment', 'pls-theme' ),
						'label_description' => esc_html__( 'Select your background image attachment.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_attachment',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'scroll'    => esc_html__( 'Scroll', 'pls-theme' ),
							'fixed' 	=> esc_html__( 'Fixed', 'pls-theme' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Repeat', 'pls-theme' ),
						'label_description' => esc_html__( 'Select your background image repeat.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_repeat',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'no-repeat'	=> esc_html__( 'No-Repeat', 'pls-theme' ),
							'repeat'    => esc_html__( 'Repeat', 'pls-theme' ),
							'repeat-x'  => esc_html__( 'Repeat-X', 'pls-theme' ),
							'repeat-y' 	=> esc_html__( 'Repeat-Y', 'pls-theme' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Size', 'pls-theme' ),
						'label_description' => esc_html__( 'Select your background image size.', 'pls-theme' ),
						'id'    			=> $prefix.'title_bg_size',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'pls-theme' ),
							'auto'		=> esc_html__( 'Auto', 'pls-theme' ),
							'cover'     => esc_html__( 'Cover', 'pls-theme' ),
							'contain'   => esc_html__( 'contain', 'pls-theme' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name' 				=> esc_html__( 'Background Opacity', 'pls-theme' ),
						'label_description' => esc_html__( 'Enter a number between 0.1 to 1. Default is 0.5.', 'pls-theme' ),
						'desc' 				=> '',
						'id' 				=> $prefix . 'title_bg_opacity',
						'type' 				=> 'number',
						'min'  				=> 0,
						'max'  				=> 1,
						'step' 				=> 0.1,
					),
					array(
						'type'     			=> 'button_group',
						'id'    			=> $prefix.'breadcrumb',
						'name'  			=> esc_html__( 'Show Breadcrubm', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable the page title breadcrumbs.', 'pls-theme' ),
						'options'  			=> array(
							'default'   => esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std' 				=> 'default',
					),	
				),
			);
			return apply_filters('pls_page_title_meta_options' , $options);
		}
		
		public function footer_options(){
			$prefix = $this->prefix;
			$custom_blocks	= pls_get_posts_by_post_type('block');
			/* Footer Options */
			$options = array(
				'title' 		=> esc_html__('Footer', 'pls-theme'),
				'id' 			=> $prefix .'footer_options',
				'post_types' 	=> array('post','page','product'),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Footer', 'pls-theme' ),
						'label_description' => esc_html__( 'Select footer.', 'pls-theme' ),
						'id'    			=> $prefix.'site_footer',
						'type'     			=> 'select',
						'options'  			=> array(
													'default'	=> esc_html__( 'Default', 'pls-theme' ),
													'none'		=> esc_html__( 'None', 'pls-theme' ) 
												) +
												$custom_blocks
						,
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Subscribe', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable subscribe.', 'pls-theme' ),
						'id'    			=> $prefix.'footer_subscribe',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'				=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Featurebox', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable featurebox.', 'pls-theme' ),
						'id'    			=> $prefix.'footer_featurebox',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'				=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Popular Categories', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable categories.', 'pls-theme' ),
						'id'    			=> $prefix.'footer_categories',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'				=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Copyright', 'pls-theme' ),
						'label_description' => esc_html__( 'Enable or disable copyright.', 'pls-theme' ),
						'id'    			=> $prefix.'footer_copyright',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','pls-theme'),
							'enable' 	=> esc_html__('Enable','pls-theme'),
							'disable'  	=> esc_html__('Disable','pls-theme'),
						),
						'std'				=> 'default',
					),
				),
			);
			return apply_filters('pls_footer_meta_options' , $options);
		}
		
		public function register_metaboxes(){
			$meta_boxes = $this->meta_boxes();
			// Make sure there's no errors when the plugin is deactivated or during upgrade
			if (class_exists('RW_Meta_Box')) {
					foreach ($meta_boxes as $meta_box) {
							new RW_Meta_Box($meta_box);
					}
			}
		}
		public function admin_js_var(){
			$meta_boxes = $this->meta_boxes();
			$meta_box_id = '';
			foreach ($meta_boxes as $box) {
				if ( !isset($box['tab']) ) {
					continue;
				}
				if ( !empty( $meta_box_id ) ) {
					$meta_box_id .= ',';
				}
				$meta_box_id .= '#' . $box['id'];
			}
			$pls_option_string 	= apply_filters( 'pls_theme_name', PLS_THEME_NAME ).' '.esc_html__( 'Options', 'pls-theme' );
			wp_enqueue_script( 'pls-meta-box', PLS_FRAMEWORK_URI . '/admin/assets/js/meta-box.js');
			$pls_meta_data		= apply_filters( 'pls_meta_data_arg', array( 
									'meta_box_ids'		=> $meta_box_id,
									'meta_box_title'	=> $pls_option_string,
								) );
			
			wp_localize_script( 'pls-meta-box' , 'pls_meta_data', $pls_meta_data );
		}		
	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	PLS_Metabox::get_instance();

endif;