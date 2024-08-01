<?php
/*
Element: Product Tab
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class PLS_Elementor_ProductsTabs extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-products-tabs';
    }

	/**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Tabs', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-product-tabs';
    }
	
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'woocommerce', 'product', 'tabs','tab' ];
	}
	
	/**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Layout', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'slider'	=> esc_html__( 'Slider', 'pls-core' ),
					'grid'		=> esc_html__( 'Grid', 'pls-core' ),
				],
                'default' 	=> 'slider',
            ]
        );
		$this->add_control(
            'product_view_mode',
            [
                'label' 	=> esc_html__( 'Product View Mode', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'vertical'		=> esc_html__( 'Vertical', 'pls-core' ),
					'horizontal'	=> esc_html__( 'Horizontal', 'pls-core' ),
				],
                'default' 	=> 'vertical',
            ]
        );
		$this->add_control(
            'product_style',
            [
                'label' 	=> esc_html__( 'Products Hover Style', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'default'			=> esc_html__( 'Default', 'pls-core' ),
					'product-style-1'	=> esc_html__( 'Products Hover Style 1', 'pls-core' ),
					'product-style-2'	=> esc_html__( 'Products Hover Style 2', 'pls-core' ),
					'product-style-3'	=> esc_html__( 'Products Hover Style 3', 'pls-core' ),
					'product-style-4'	=> esc_html__( 'Products Hover Style 4', 'pls-core' ),
				],
                'default' 		=> 'default',
				'description' 	=> esc_html__( 'Select product hover style.', 'pls-core' ),
            ]
        );	
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_tab',
			array(
				'label'     => esc_html__( 'Tabs', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'enable_ajax',
			[
				'label'     => esc_html__( 'Enable Ajax', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'tab_enable',
			[
				'label' 	=> esc_html__( 'Enable', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$repeater->add_control(
			'tab_title',
			[
				'label' 		=> esc_html__( 'Tab Title', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Tab Title', 'pls-core' ),
				'placeholder'	=> esc_html__( 'Tab Title', 'pls-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);

		$repeater->add_control(
			'tab_data_source',
			[
				'label' 	=> esc_html__( 'Data source', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'recent_products'		=> esc_html__( 'New Arrivals', 'pls-core' ),
					'featured_products'		=> esc_html__( 'Featured Products', 'pls-core' ),
					'sale_products'			=> esc_html__( 'On Sale Products', 'pls-core' ),
					'best_seller_products'	=> esc_html__( 'Best Seller Products', 'pls-core' ),
					'top_rated_products'	=> esc_html__( 'Top Rated Products', 'pls-core' ),
					'products'				=> esc_html__( 'List of Products', 'pls-core' ),
				],
                'default' 		=> 'recent_products',
				'description' 	=> esc_html__( 'Select data source for your product tab', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'product_ids',
            [
                'label' 		=> esc_html__('Include Product Ids', 'pls-core'),
                'type'        => 'pls_autocomplete',
				'search'      => 'pls_core_elementor_search_post',
				'render'      => 'pls_core_elementor_render_post',
				'post_type'   => 'product',
				'multiple'    => true,
				'label_block' => true,
				'condition' 	=> [
					'tab_data_source' => [ 'products' ],
				],
				'description' 	=> esc_html__( 'Select specific products.', 'pls-core' ),
            ]
		);
		
		$this->add_control(
            'product_tabs',
            [
                'label' 	=> esc_html__( 'Tabs Items', 'pls-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'New Arrivals', 'pls-core' ),
						'tab_data_source' 	=> 'recent_products',
					],
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'Featured', 'pls-core' ),
						'tab_data_source' 	=> 'featured_products',
					],
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'Best Seller', 'pls-core' ),
						'tab_data_source' 	=> 'best_seller_products',
					],
				],
				'title_field' => '{{{ tab_title }}}',
            ]
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_product_query',
			array(
				'label'     => esc_html__( 'Products Query', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
            'categories',
            [
                'label'			=> esc_html__( 'Specific Category', 'pls-core' ),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_taxonomies',
				'render'		=> 'pls_core_elementor_render_taxonomies',
				'taxonomy'		=> array('product_cat'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Select specific categories.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'exclude',
            [
                'label'			=> esc_html__('Exclude Products', 'pls-core'),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_post',
				'render'		=> 'pls_core_elementor_render_post',
				'post_type'		=> 'product',
				'multiple'		=> true,
				'label_block'	=> true,
				'description' 	=> esc_html__( 'Exclude some products which you do not want to display.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 5,
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_responsive_control(
			'grid_columns',
			[
				'label'			=> esc_html__( 'Columns', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'pls-core' ),
					'2'		=> esc_html__( '2', 'pls-core' ),
					'3'		=> esc_html__( '3', 'pls-core' ),
					'4'		=> esc_html__( '4', 'pls-core' ),
					'5'		=> esc_html__( '5', 'pls-core' ),
					'6'		=> esc_html__( '6', 'pls-core' ),
				],
				'default' 			=> '4',
				'tablet_default' 	=> '3',
				'mobile_default' 	=> '2',
			]
		);		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Slider Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout' => 'slider',
				),
			)
		);
		$this->add_control(
            'rows',
            [
                'label' 	=> esc_html__( 'Rows', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( '1', 'pls-core' ),
					'2'	=> esc_html__( '2', 'pls-core' ),
					'3'	=> esc_html__( '3', 'pls-core' ),
				],
				'default' 	=> '1',
            ]
        );
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'			=> esc_html__( 'Columns', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'pls-core' ),
					'2'		=> esc_html__( '2', 'pls-core' ),
					'3'		=> esc_html__( '3', 'pls-core' ),
					'4'		=> esc_html__( '4', 'pls-core' ),
					'5'		=> esc_html__( '5', 'pls-core' ),
					'6'		=> esc_html__( '6', 'pls-core' ),
				],
				'default' 			=> '4',
				'tablet_default' 	=> '3',
				'mobile_default' 	=> '2',
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_pause_on_hover',
			[
				'label'     => esc_html__( 'Pause On Hover', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
				'condition' => [
					'slider_autoplay' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Loop', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_navigation',
			[
				'label'     => esc_html__( 'Nav', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'slider_dots',
			[
				'label'     => esc_html__( 'Dots', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Title', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' 			=> 'color: {{VALUE}}',
					'{{WRAPPER}} .nav-tabs .nav-link::after'	=> 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active' 		=> 'color: {{VALUE}}',
					'{{WRAPPER}} .nav-tabs .nav-link.active::after' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
			]
		);		
		
		$this->end_controls_section();
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 3,
			'slides_to_show_mobile' => 2,
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		
		$default_atts		= $settings;
		$settings['id'] 	= pls_uniqid('pls-products-tabs-');
		$class				= array('pls-element', 'products-tabs', 'pls-tabs', 'align-center' );
		$class[]			= ( 'horizontal' == $product_view_mode ) ? 'pls-product-'.$product_view_mode : '';
		$class[]	 		= 'navigation-middle';
		$class[]			= ( $enable_ajax ) ? 'enable-ajax' : '';
		$settings['class']	= implode( ' ', $class );
		if( $product_style != 'default' ){
			pls_set_loop_prop( 'product-style', $product_style );
		}
		$settings['slider_data'] = pls_slider_attributes( $settings);
		
		$tabs_data = array();
		if( ! empty( $product_tabs ) ){
			foreach( $product_tabs as $intex => $items ){
				if( $items['tab_enable'] == 'yes' && !empty( $items['tab_title'] ) ) {
					$settings['data_source'] 	= $settings['product_ids'] = '';
					$settings['data_source']	= $items['tab_data_source'];
					if( $items['tab_data_source'] == 'products' ) {
						$settings['product_ids'] = $items['product_ids'];
					}
					$data		= wp_json_encode( array_intersect_key( $settings, pls_core_default_product_args() ) );
					
					$the_query = [];
					if( $enable_ajax && ( $intex == 0 ) ){
						$shortcodestr = pls_core_get_products_shortcode_attr( $settings );
					}else{
						$shortcodestr = pls_core_get_products_shortcode_attr( $settings );
					}					
					$tabs_data[]	= array(
						'id' 			=> pls_uniqid( 'pls-tab-' ),
						'title' 		=> $items['tab_title'],
						'data_source' 	=> $items['tab_data_source'],
						'shortcodestr' 	=> $shortcodestr,
						'data'			=> $data,
					);
				}
			}
		}		
		$settings['tabs'] = $tabs_data;
		pls_set_loop_prop( 'product_rows', $settings['rows'] );
		pls_init_woocommerce_loop_hook();
		pls_core_get_templates( 'elements-widgets/woo-products-tabs', $settings );
	}
}

$widgets_manager -> register( new PLS_Elementor_ProductsTabs() );