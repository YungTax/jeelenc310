<?php
/*
Element: Product Grid Slider
*/
use Elementor\Controls_Manager;

class PLS_Elementor_Product_Grid_Slider extends PLS_Elementor_Widget_Base {
	
	public $exclude_product = [];
	
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-products-grid-slider';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Grid slider widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Grid Or Slider', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Grid slider widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-products';
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
		return [ 'woocommerce', 'product', 'grid','slider' ];
	}
	
	/**
     * Register Product Grid slider widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$product_cats = pls_core_elementor_get_terms('product_cat',true);
		
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
		$this->add_control(
            'pagination',
            [
                'label' 	=> esc_html__( 'Products Pagination', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'none'				=> esc_html__( 'None', 'pls-core' ),
					'default'			=> esc_html__( 'Default', 'pls-core' ),
					'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'pls-core' ),
					'load-more-button'	=> esc_html__( 'Load More', 'pls-core' ),
				],
				'default' 	=> 'none',
				'condition' => array(
					'layout' => 'grid',
				),
            ]
        );
		$this->add_control(
			'products_countdown',
			[
				'label' 	=> esc_html__( 'Show Count Down', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> '',
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
            'data_source',
            [
                'label' 	=> esc_html__( 'Data source', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'recent_products'		=> esc_html__( 'Recent Products', 'pls-core' ),
					'featured_products'		=> esc_html__( 'Featured Products', 'pls-core' ),
					'sale_products'			=> esc_html__( 'On Sale Products', 'pls-core' ),
					'best_seller_products'	=> esc_html__( 'Best Seller Products', 'pls-core' ),
					'top_rated_products'	=> esc_html__( 'Top Rated Products', 'pls-core' ),
					'products'				=> esc_html__( 'List of Products', 'pls-core' ),
				],
                'default' 		=> 'recent_products',
				'description' 	=> esc_html__( 'Select data source for your product grid', 'pls-core' ),
            ]
        );
		$this->add_control(
            'product_ids',
            [
                'label'			=> esc_html__('Include Product Ids', 'pls-core'),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_post',
				'render'		=> 'pls_core_elementor_render_post',
				'post_type'		=> 'product',
				'multiple'		=> true,
				'label_block'	=> true,
				'condition'		=> [
					'data_source'	=> [ 'products' ],
				],
				'description' 	=> esc_html__( 'Select specific products.', 'pls-core' ),
            ]
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
				'condition'		=> [
					'data_source!'	=> 'products',
				],
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
				'default' 	=> 8,
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'date'	=> esc_html__( 'Date', 'pls-core' ),
					'title'	=> esc_html__( 'Title', 'pls-core' ),
					'name'	=> esc_html__( 'Name(Slug)', 'pls-core' ),
					'rand'	=> esc_html__( 'Random', 'pls-core' ),
					'ID'	=> esc_html__( 'ID', 'pls-core' ),
				],
				'default' 	=> 'date',
            ]
        );
		$this->add_control(
            'order',
            [
                'label' 	=> esc_html__( 'Sort By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'DESC'	=> esc_html__( 'Descending', 'pls-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'pls-core' ),
				],
				'default' 	=> 'DESC',
            ]
        );		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout'	=> 'grid',
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
					'layout'	=> 'slider',
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
				'label'			=> esc_html__( 'Slides to Show', 'pls-core' ),
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
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 3,
			'slides_to_show_mobile' => 2,
			'grid_columns_tablet'	=> 3,
			'grid_columns_mobile'	=> 2
		]);
		extract( $settings );
		
		$settings['id'] 		= pls_uniqid( 'pls-products-grid-slider-' );
		$class					= array( 'pls-element', 'woocommerce' );
		$class[]				= ( 'horizontal' == $product_view_mode ) ? 'pls-product-'.$product_view_mode : '';
		$this->exclude_product 	= $settings['exclude'];
		$shortcodestr 			= pls_core_get_products_shortcode_attr( $settings );
		
		pls_set_loop_prop( 'pagination', $pagination );
		pls_set_loop_prop( 'is_shortcode', true );
		pls_set_loop_prop( 'type', 'products_shortcode' );
		
		if( $product_style != 'default' ){
			pls_set_loop_prop( 'product-style', $product_style );
		}
		
		pls_set_loop_prop( 'products_view', 'grid-view' );
		pls_set_loop_prop( 'product-countdown', $products_countdown );
		if( $layout == 'grid' ){
			pls_set_loop_prop( 'products-columns', $grid_columns );
			pls_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
			pls_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
			wc_set_loop_prop( 'columns', $grid_columns );
			$settings['rows'] = 1;			
		}else{
			$unique_id 		= pls_uniqid( 'section-' );
			$class[]		= 'products-slider';						
			pls_set_loop_prop( 'name', 'pls-slider' );
			pls_set_loop_prop( 'products-columns', $slides_to_show );
			pls_set_loop_prop( 'slider_navigation', $slider_navigation );
			pls_set_loop_prop( 'slider_dots', $slider_dots );
			pls_set_loop_prop( 'slides_to_show', $slides_to_show );
			pls_set_loop_prop( 'slides_to_show_tablet', $slides_to_show_tablet );
			pls_set_loop_prop( 'slides_to_show_mobile', $slides_to_show_mobile );
			pls_set_loop_prop( 'unique_id', $unique_id );
			pls_set_loop_prop( 'slider_options', pls_slider_attributes( $settings) );
		}
		pls_set_loop_prop( 'product_rows', $settings['rows'] );
		pls_set_loop_prop( 'count', 0 );
		
		$settings['class'] 		= implode(' ', array_filter( $class ) );
		$settings['attribute'] 	= wp_json_encode( array_intersect_key( $settings, pls_core_default_product_args() ) );
		$settings['shortcodestr'] 	= $shortcodestr;
		pls_set_loop_prop( 'attribute', $settings['attribute'] );
		pls_init_woocommerce_loop_hook();
		
		if( !empty( $this->exclude_product ) ){
			add_filter('woocommerce_shortcode_products_query', [$this, 'exclude_products_query'], 10, 3);
		}
		pls_core_get_templates( 'elements-widgets/woo-products-grid-slider', $settings );
		if( !empty( $this->exclude_product ) ){
			remove_filter('woocommerce_shortcode_products_query', [$this, 'exclude_products_query'], 10, 3);
		}
	}
	
	function exclude_products_query($query_args, $atts, $loop){
		
		$query_args['post__not_in'] = $this->exclude_product;
		return $query_args;
	}
	
}
$widgets_manager -> register( new PLS_Elementor_Product_Grid_Slider() );