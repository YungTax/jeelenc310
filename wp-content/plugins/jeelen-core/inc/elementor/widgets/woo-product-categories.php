<?php
/*
Element: Product Categories
*/
use Elementor\Controls_Manager;
use Elementor\Utils;
class PLS_Elementor_Productcategories extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-product-categories';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Categories widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Categories', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Categories widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-product-categories';
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
		return [ 'woocommerce', 'categories', 'product categories'];
	}
	
	/**
     * Register Product Categories widget controls.
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
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'categories-default'					=> esc_html__( 'Default', 'pls-core' ),
					'categories-sub-categories-box'			=> esc_html__( 'Categories and Sub Categories Box', 'pls-core' ),
					'categories-sub-categories-vertical'	=> esc_html__( 'Categories and Sub Categories Vertical', 'pls-core' ),
				],
                'default' 		=> 'categories-default',
				'description' 	=> esc_html__( 'Select style.', 'pls-core' ),
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
            'parent_category',
            [
                'label' 	=> esc_html__( 'Parent Category', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '',
                'options' 	=> $product_cats,				
                'description' => esc_html__( 'Each category item will be a sub category of this category. This option is available when the specific Categories option is empty.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'exclude_categories',
            [
                'label'			=> esc_html__( 'Exclude Category', 'pls-core' ),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_taxonomies',
				'render'		=> 'pls_core_elementor_render_taxonomies',
				'taxonomy'		=> array('product_cat'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Exclude specific categories.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number of Categories', 'pls-core'),
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
					'name'			=> esc_html__( 'Name', 'pls-core' ),
					'slug'			=> esc_html__( 'Slug', 'pls-core' ),
					'ID'			=> esc_html__( 'ID', 'pls-core' ),
					'menu_order'	=> esc_html__( 'Sort Order', 'pls-core' ),
				],
				'default' 	=> 'name',
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
			'show_child_of',
			[
				'label' 	=> esc_html__( 'Child Of', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
				'condition' => [
					'style!'	=> [ 'categories-sub-categories-box','categories-sub-categories-vertical' ],
				],
			]
		);
		$this->add_control(
			'hide_empty_categories',
			[
				'label' 	=> esc_html__( 'Hide Empty Categories', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->add_control(
			'show_count',
			[
				'label' 	=> esc_html__( 'Show Count', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' => [
					'style'	=> [ 'categories-default'],
				],
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
			'grid_columns_tablet'	=> 3,
			'grid_columns_mobile'	=> 2
		]);
		extract( $settings );
		
		$settings['id'] 			= pls_uniqid( 'pls-product-cat-' );
		$column_class				= array();
		$class						= array( 'pls-element', 'pls-product-categories' );		 
		$class[]					= $style;
		$class[]					= 'layout-'.$layout;
		$settings['class'] 			= implode(' ',array_filter( $class ) );
		$settings['show_count'] 			= $show_count ? true : false;
		$settings['slider_class'] 			= 'row';
		$settings['section_class'] 			= '';		
		$settings['banner_layout'] 	= '';
		
		$query_args = array(
			'taxonomy'  	=> 'product_cat',
			'number'    	=> $settings['number'],
			'orderby'    	=> $settings['orderby'],
			'order'      	=> $settings['order'],
			'hide_empty' 	=> $hide_empty_categories,
		);
		$settings['args']		= $query_args; // Query for inner sub categories
		
		if( empty( $categories ) && empty( $parent_category ) ){
			$query_args['parent'] = 0;
		}
		
		$ids = array();
		if ( ! empty( $parent_category ) && empty( $categories ) ) {
			if( $style == 'categories-sub-categories-box' || $style == 'categories-sub-categories-vertical' ){				
				$query_args['parent'] = (int)$parent_category;
			} else {				
				if($show_child_of){
					$query_args['child_of'] = (int)$parent_category;
				}else{
					$query_args['parent'] = (int)$parent_category;
				}				
			}
		}		
		
		if ( ! empty( $settings['exclude_categories'] ) ) {
			$query_args['exclude'] = $settings['exclude_categories'];			
		} 		
		
		$link_url = '';		
		if( !empty( $settings['view_more_button_link']['url']) ) {
			$link_url = pls_core_elementor_get_url_data($settings['view_more_button_link']);			
		}
		
		if ( !empty( $settings['categories'] ) ) {			
			$query_args['include'] 		= $categories;	
		}
		
		$product_categories 			= get_terms( $query_args );		
		$settings['product_categories'] = $product_categories;
		
		if( 'grid' == $layout ){
			$column_class[] 	= 'col-lg-'. pls_get_rs_grid_columns( $grid_columns );
			$column_class[] 	= 'col-md-'. pls_get_rs_grid_columns( $grid_columns_tablet );
			$column_class[] 	= 'col-'. pls_get_rs_grid_columns( $grid_columns_mobile );
			$settings['rows'] = 1;
		}else{			
			$settings['section_class'] 	= ' pls-slider swiper row';
			$settings['slider_options'] 	= pls_slider_attributes( $settings);
			$settings['slider_class'] 	= 'swiper-wrapper';
			$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
			$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
			$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
			if( $settings['rows'] <= 1 ){
				$column_class[] = 'swiper-slide';
			}						
		}
		
		$settings['column_class']	= implode( ' ', array_filter( $column_class ) );
		pls_core_get_templates( 'elements-widgets/product-categories/'.$style, $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_Productcategories());