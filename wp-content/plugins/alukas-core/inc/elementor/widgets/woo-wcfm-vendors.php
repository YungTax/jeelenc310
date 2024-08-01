<?php
/*
Element: WCFM Vendors
*/
use Elementor\Controls_Manager;

class PLS_Elementor_WCFMVendors extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-wcfm-vendors';
    }

	/**
     * Get widget title.
     *
     * Retrieve WCFM Vendors widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'WCFM Vendors', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve WCFM Vendors widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-user-circle-o';
    }
	
	/**
     * Register WCFM Vendors widget controls.
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
                'label'		=> esc_html__( 'General', 'pls-core' ),
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
					'default'					=> esc_html__( 'Default', 'pls-core' ),
					'boxed'						=> esc_html__( 'Boxed', 'pls-core' ),
					'boxed-center-products'		=> esc_html__( 'Boxed Center with Products', 'pls-core' ),
					'boxed-horizontal-products'	=> esc_html__( 'Boxed Horizontal with Products', 'pls-core' ),
					'boxed-simple'				=> esc_html__( 'Boxed Simple', 'pls-core' ),
				],
                'default' 		=> 'default',
				'description' 	=> esc_html__( 'Select style.', 'pls-core' ),
            ]
        );
		$this->add_control(
			'recent_products',
			[
				'label' 	=> esc_html__( 'Show Recent Products', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' 	=> [
					'style' => [ 'boxed-center-products', 'boxed-horizontal-products' ],
				],
			]
		);
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number Of Vendor', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 3,
            ]
        );
		$this->add_control(
            'specific_vendor',
            [
                'label' 		=> esc_html__('Specific Vendor', 'pls-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'description' 	=> esc_html__( 'Enter vendor id, multiple vendor id with comma-separated.', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'display_name'	=> esc_html__( 'Store Name', 'pls-core' ),
					'ID'			=> esc_html__( 'ID', 'pls-core' ),
				],
				'default' 	=> 'display_name',
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
				'default' 	=> 'ASC',
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
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
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
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
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
			'slides_to_show_tablet' => 2,
			'slides_to_show_mobile' => 1,
			'grid_columns_tablet' => 2,
			'grid_columns_mobile' => 1
		]);
		extract( $settings );
		$default_atts			= $settings;
		$settings['id'] 		= pls_uniqid( 'pls-wcfm-vendors-' );
		$class					= array( 'pls-element', 'pls-wcfm-vendors', 'pls-vendors-'.$style );
		$settings['class'] 			= implode( ' ', array_filter( $class ) );
		$settings['wrapper'] 	= 'pls-vendor-container';
		$settings['slider_class'] 	= '';
		$settings['column_class'] 	= '';
		if( $layout == 'grid' ){
			$columns_class 		= array();
			$column_class[] 	= 'col-lg-'. pls_get_rs_grid_columns( $grid_columns );
			$column_class[] 	= 'col-md-'. pls_get_rs_grid_columns( $grid_columns_tablet );
			$column_class[] 	= 'col-'. pls_get_rs_grid_columns( $grid_columns_mobile );
			$settings['column_class'] 	= join( ' ', $column_class );
			$settings['rows'] = 1;	
			
		}else{
			$settings['wrapper'] 	.= ' pls-slider swiper row';
			$settings['slider_class'] 	= 'swiper-wrapper';
			$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
			$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
			$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
			$settings['slider_options'] 	= pls_slider_attributes( $settings);
			if( $settings['rows'] <= 1 ){
				$settings['column_class'] = 'swiper-slide';
			}	
		}
				
		$user_args = array();
		$user_args['number'] 	= $number;
		$user_args['role'] 		= 'wcfm_vendor';
		$user_args['orderby'] 	= $orderby;
		$user_args['order'] 	= $order;
		$user_args['meta_query'] = array( 
			array( 
				'key' 		=> '_disable_vendor', 
				'compare' 	=> 'NOT EXISTS'										
			)
		 );
		$user_args['fields'] 	= 'ID';
		if( ! empty( $specific_vendor ) ){
			$specific_ids = explode( ',', $atts[ 'specific_vendor' ] );
			$specific_ids = array_map( 'trim', $specific_ids );
			$user_args['include'] 	= $specific_ids;
			$user_args['number'] 	= count($specific_ids);
			unset($user_args['orderby']);
			unset($user_args['order']);
		}
		
		$vendors = get_users( $user_args );
		
		if(!$vendors){
			return;
		}
		
		$settings['vendors'] = $vendors;
		$settings['vendors_count'] = count($vendors);	
		
		pls_core_get_templates( 'elements-widgets/wcfm-vendors/'.$style, $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_WCFMVendors());