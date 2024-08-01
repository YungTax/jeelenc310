<?php
/*
Element: Product Recently Viewed
*/
use Elementor\Controls_Manager;

class PLS_Elementor_ProductsRecentlyViewed extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-products-recently-viewed';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Recently Viewed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Recently Viewed', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Recently Viewed widget icon.
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
		return [ 'woocommerce', 'product', 'recently viewed','viewed' ];
	}
	
	/**
     * Register Product Recently Viewed widget controls.
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
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 10,
            ]
        );
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Slider Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
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
		]);
		extract( $settings );
		$default_atts		= $settings;
		$settings['id'] 	= pls_uniqid( 'pls-recently-viewed-' );
		$class				= array( 'pls-element', 'pls-products-recently-viewed', 'woocommerce' );
		$settings['class'] 	= implode(' ',array_filter($class));
		$unique_id 		= pls_uniqid( 'section-' );
		pls_set_loop_prop( 'name', 'pls-slider' );
		pls_set_loop_prop( 'products_view', 'grid-view' );		
		pls_set_loop_prop( 'products-columns', $slides_to_show );
		pls_set_loop_prop( 'slider_navigation', $slider_navigation );
		pls_set_loop_prop( 'slider_dots', $slider_dots );
		pls_set_loop_prop( 'slides_to_show', $slides_to_show );
		pls_set_loop_prop( 'slides_to_show_tablet', $slides_to_show_tablet );
		pls_set_loop_prop( 'slides_to_show_mobile', $slides_to_show_mobile );
		pls_set_loop_prop( 'unique_id', $unique_id );
		pls_set_loop_prop( 'slider_options', pls_slider_attributes( $settings) );
	
		$viewed_products = pls_get_recently_viewed_products();
		if( empty( $viewed_products ) ) { return; }
		
		$query = array(
			'posts_per_page' => $settings['limit'],
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'post__in'       => $viewed_products,
			'orderby'        => 'post__in',
		);

		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			);
		}
		
		$the_query 		= new WP_Query( $query );		
		$settings['query'] 	= $the_query;		
		pls_init_woocommerce_loop_hook();
		pls_core_get_templates( 'elements-widgets/woo-products-recently-viewed', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_ProductsRecentlyViewed());