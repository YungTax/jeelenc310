<?php
/*
Element: Product Brand
*/
use Elementor\Controls_Manager;

class PLS_Elementor_ProductBrands extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-product-brands';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Brand widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Brands', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Brand widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-post-slider';
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
		return [ 'woocommerce', 'brand' ];
	}
	
	/**
     * Register Product Brand widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		$image_sizes 		= pls_core_get_all_image_sizes(true);
		$product_brands = pls_core_elementor_get_terms('product_brand');
		$this->start_controls_section(
            'section_content_general',
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
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'brand-square'	=> esc_html__( 'Square', 'pls-core' ),
					'brand-circle'	=> esc_html__( 'Circle', 'pls-core' ),
				],
                'default' 	=> 'brand-square',
            ]
        );
		$this->add_control(
            'image_size',
            [
                'label' 	=> esc_html__( 'Image Size', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
                'default' 	=> 'full',
            ]
        );
		$this->add_responsive_control(
			'image_width',
			[
				'label'     	=> esc_html__( 'Image Width', 'pls-core' ),
				'label_block'	=> true,
				'type'      	=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'selectors' 	=> [
					'{{WRAPPER}} .pls-product-brands.brand-circle .brand-image' => 'width: {{SIZE}}px;height: {{SIZE}}px;border-radius: {{SIZE}}px'
				],
				'condition' 	=> [
					'style' => 'brand-circle'
				],
			]
		);
		$this->add_control(
            'brands',
            [
                'label' 		=> esc_html__( 'Specific Brands', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT2,
				'multiple' 		=> true,
                'options' 		=> $product_brands,
                'description' 	=> esc_html__( 'Select specific brands.', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number of Brands', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '6',
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'name'	=> esc_html__( 'Name', 'pls-core' ),
					'slug'	=> esc_html__( 'Slug', 'pls-core' ),
					'ID'	=> esc_html__( 'ID', 'pls-core' ),
				],
				'default' 	=> 'ID',
            ]
        );
		$this->add_control(
            'order',
            [
                'label' 	=> esc_html__( 'Sort By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'desc'	=> esc_html__( 'Descending', 'pls-core' ),
					'asc'	=> esc_html__( 'Ascending', 'pls-core' ),
				],
				'default' 	=> 'desc',
            ]
        );
		
		$this->add_control(
			'show_title',
			[
				'label' 	=> esc_html__( 'Show Title', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'hover_effect',
			[
				'label' 	=> esc_html__( 'Enable Hover Effect', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'hide_empty_brand',
			[
				'label' 	=> esc_html__( 'Hide Empty Brands', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
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
					'7'		=> esc_html__( '7', 'pls-core' ),
					'8'		=> esc_html__( '8', 'pls-core' ),
				],
				'default' 			=> '6',
				'tablet_default' 	=> '4',
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
					'7'		=> esc_html__( '7', 'pls-core' ),
					'8'		=> esc_html__( '8', 'pls-core' ),
				],
				'default' 			=> '6',
				'tablet_default' 	=> '4',
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
		
		$settings 					= $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 4,
			'slides_to_show_mobile' => 2,
			'grid_columns_tablet' => 4,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		$settings['id'] 			= pls_uniqid( 'pls-product-brand-' );
		$class						= array( 'pls-element', 'pls-product-brands', $style );	
		$class[]					= $hover_effect ? 'brand-hover-effect' : '';
		$settings['class'] 			= implode(' ', array_filter( $class ) );
		$settings['column_class'] 	= '';
		$settings['section_class'] 	= '';
		$settings['slider_class'] 	= 'row';
		$query_args = array(
			'taxonomy'  	=> 'product_brand',
			'number'    	=> $settings['number'],
			'orderby'    	=> $settings['orderby'],
			'order'      	=> $settings['order'],
			'hide_empty' 	=> $hide_empty_brand,
		);
		
		if ( !empty( $settings['brands'] ) ) {
			$query_args['include'] = $settings['brands'];			
		} 
		
		$product_brands = get_terms( $query_args );	
		
		$settings['product_brands'] = $product_brands;
		$columns_class = array();
		$settings['rows'] = 1;
		if( $layout == 'grid' ){			
			$columns_class[] = 'col-' .pls_get_rs_grid_columns ( $grid_columns_mobile );
			$columns_class[] = 'col-md-' .pls_get_rs_grid_columns ( $grid_columns_tablet );
			$columns_class[] = 'col-lg-' .pls_get_rs_grid_columns ( $grid_columns );
			
		}else{
			$settings['section_class'] 	= ' pls-slider swiper row';
			$settings['slider_class'] 	= 'swiper-wrapper';
			$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
			$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
			$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
			$settings['slider_options'] 	= pls_slider_attributes( $settings);
			$columns_class[] = 'swiper-slide';
		}
		$settings['column_class'] = join( ' ', $columns_class );
		pls_core_get_templates( 'elements-widgets/woo-product-brands', $settings );
	}
}

$widgets_manager->register( new PLS_Elementor_ProductBrands() );