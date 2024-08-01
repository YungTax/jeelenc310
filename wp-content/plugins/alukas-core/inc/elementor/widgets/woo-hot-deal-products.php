<?php
/*
Element: Hot Deal Products
*/
use Elementor\Controls_Manager;

class PLS_Elementor_HotDealProducts extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-hot-deal-products';
    }

	/**
     * Get widget title.
     *
     * Retrieve Hot Deal Products widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Hot Deal Products', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Hot Deal Products widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-countdown';
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
		return [ 'woocommerce', 'hot deal', 'products','deal of the day' ];
	}
	
	/**
     * Register Hot Deal Products widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= pls_core_get_all_image_sizes(true);
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
					'product-style-4'	=> esc_html__( 'Products Hover Style 4', 'pls-core' ),
				],
                'default' 		=> 'default',
				'description' 	=> esc_html__( 'Select product hover style.', 'pls-core' ),
            ]
        );
		$this->add_control(
			'show_stock_progressbar',
			[
				'label' 	=> esc_html__( 'Show Progressbar', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'show_countdown',
			[
				'label' 	=> esc_html__( 'Show Countdown', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->add_control(
			'highlighted_border',
			[
				'label' 	=> esc_html__( 'Highlighted with Border', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
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
				'condition'		=> [
					'data_source!'	=> 'products',
				],
            ]
        );
		$this->add_control(
            'product_ids',
            [
                'label'			=> esc_html__('Specific Product Ids', 'pls-core'),
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
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 5,
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
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
				
		//Get Products
        global $woocommerce_loop, $wpdb;
		
		// Get products on sale
		$product_ids_raw = $wpdb->get_results(
		"SELECT posts.ID, posts.post_parent
		FROM `$wpdb->posts` posts
		INNER JOIN `$wpdb->postmeta` ON (posts.ID = `$wpdb->postmeta`.post_id)
		INNER JOIN `$wpdb->postmeta` AS mt1 ON (posts.ID = mt1.post_id)
		WHERE
			posts.post_status = 'publish'
			AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().") 
			GROUP BY posts.ID 
			ORDER BY posts.post_title");

		$product_ids_on_sale = array();

		foreach ( $product_ids_raw as $product_raw ) 
		{
			if(!empty($product_raw->post_parent))
			{
				$product_ids_on_sale[] = $product_raw->post_parent;
			}
			else
			{
				$product_ids_on_sale[] = $product_raw->ID;  
			}
		}
		$product_ids_on_sale = array_unique( $product_ids_on_sale );
		
		//Hot Deal products
		$query_args = array(
				'post_type'				=> 'product',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> $limit,
				'orderby' 			    => $orderby,
				'order' 				=> $order,
				'post__in'			    => array_merge( array( 0 ), $product_ids_on_sale ),
			);
		$meta_query			= WC()->query->get_meta_query();
		$tax_query   		= WC()->query->get_tax_query();	
		
		//Get Categories
		if( ! empty( $product_ids ) ):
			$product_ids_array 		= explode(',', $product_ids);
			$product_ids_array 		= array_map( 'trim', $product_ids_array );
			$query_args['post__in'] = $product_ids_array;
		endif;
		
		if( apply_filters( 'pls_hotdeal_hide_outofstock_products', true ) ){
			$tax_query[] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			);
		}
		
		if( ! empty( $categories ) ):
			$tax_query[] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);		
		endif;
		
		$query_args['meta_query']	= $meta_query;
		$query_args['tax_query']	= $tax_query;
		$the_query 					= new WP_Query( $query_args );		
		$settings['query'] 			= $the_query;		
		
		$settings['id'] 	= pls_uniqid( 'pls-hot-deal-' );
		$class				= array( 'pls-element', 'pls-hot-deal-products', 'woocommerce' );
		$class[]			= ( 'horizontal' == $product_view_mode ) ? 'pls-product-'.$product_view_mode : '';
		$class[]	 		= ( $highlighted_border ) ? 'highlighted-border' : '';
		if( $product_style != 'default' ){
			pls_set_loop_prop( 'product-style', $product_style );
		}
		pls_set_loop_prop( 'products_view', 'grid-view' );
		
		if( 'grid' == $layout ){
			pls_set_loop_prop( 'products-columns', $grid_columns );
			pls_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
			pls_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
			wc_set_loop_prop( 'columns', $grid_columns );
			$settings['rows'] = 1;
			
		}else{
			$unique_id 		= pls_uniqid( 'section-' );
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
		pls_set_loop_prop( 'product-countdown', 0 );
		
		if( $show_countdown == 'yes' ){
			pls_set_loop_prop( 'product-countdown', 1 );
		}
		
		if( $show_stock_progressbar ){
			pls_set_loop_prop( 'products-stock-progressbar', 1 );
		}
		
		$settings['class'] 				= implode( ' ', array_filter( $class ) );
		
		$settings['class'] = implode( ' ', array_filter( $class ) );		
		pls_init_woocommerce_loop_hook();
		pls_core_get_templates( 'elements-widgets/woo-hot-deal-products', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_HotDealProducts());