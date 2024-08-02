<?php
/*
Element: Product Widgets
*/
use Elementor\Controls_Manager;

class PLS_Elementor_ProductsWidget extends PLS_Elementor_Widget_Base {
	
	public $exclude_product = [];
	
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-products-widget';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Widgets widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Widget', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Widgets widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-post-list';
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
		return [ 'woocommerce', 'product widget', 'products' ];
	}
	
	/**
     * Register Product Widgets widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {		
		$product_cats = pls_core_elementor_get_terms('product_cat',true);
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Recent Products', 'pls-core' ),
            ]
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
				'description' 	=> esc_html__( 'Select data source', 'pls-core' ),
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
				'default' 	=> 3,
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
		$this->add_control(
			'show_rating',
			[
				'label' 	=> esc_html__( 'Show Rating?', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->end_controls_section();		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 	= pls_uniqid( 'pls-product-widget-' );
		$class				= array( 'pls-element', 'widget', 'pls-products-widget', 'woocommerce' );
		$settings['class'] = implode(' ', array_filter( $class ) ) ;		
		$this->exclude_product 	= $settings['exclude'];
		$shortcodestr 			= pls_core_get_products_shortcode_attr( $settings );
		
		pls_set_loop_prop( 'is_shortcode', true );
		pls_set_loop_prop( 'type', 'product_shortcode' );
		pls_set_loop_prop( 'products_view', 'grid-view' );
		pls_set_loop_prop( 'product-style', 'product-style-widget' );
		pls_set_loop_prop( 'product_rows',1 );
		pls_set_loop_prop( 'count', 0 );
		pls_set_loop_prop( 'show_rating', $show_rating );		
		$settings['shortcodestr'] 	= $shortcodestr;
		if( !empty( $this->exclude_product ) ){
			add_filter('woocommerce_shortcode_products_query', [$this, 'exclude_products_query'], 10, 3);
		}
		pls_core_get_templates( 'elements-widgets/woo-products-widget', $settings );
		if( !empty( $this->exclude_product ) ){
			remove_filter('woocommerce_shortcode_products_query', [$this, 'exclude_products_query'], 10, 3);
		}
	}
	
	function exclude_products_query($query_args, $atts, $loop){
		
		$query_args['post__not_in'] = $this->exclude_product;
		return $query_args;
	}
}

$widgets_manager->register( new PLS_Elementor_ProductsWidget() );