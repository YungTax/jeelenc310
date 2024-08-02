<?php
/*
Element: Product Custom Categories
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Utils;
class PLS_Elementor_ProductCustomCategories extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-custom-categories';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Custom Categories widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Custom Categories', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Custom Categories widget icon.
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
     * Register Product Custom Categories widget controls.
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
            'image_size',
            [
                'label' 	=> esc_html__( 'Image Size', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
                'default' 	=> 'full',
            ]
        );
		$this->add_control(
			'show_cat_title',
			[
				'label' 	=> esc_html__( 'Show Category Title', 'pls-core' ),
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
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_custom_categories',
			array(
				'label'     => esc_html__( 'Custom Categories', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$repeater = new Repeater();
		$repeater->add_control(
			'custom_title',
			[
				'label' 	=> esc_html__( 'Custom Title', 'pls-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> '',
			]
		);
		$repeater->add_control(
			'cat_title',
			[
				'label' 		=> esc_html__( 'Title', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_html__( 'Cat Title', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'category',
			[
				'label' 		=> esc_html__( 'Select Category', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options'		=> $product_cats,
                'default' 		=> '',
				'description' 	=> esc_html__( 'Select category', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'cat_image',
			[
				'label'     => esc_html__( 'Image', 'pls-core' ),
				'type'      => Controls_Manager::MEDIA,
				'description'	=> esc_html__( 'Upload category image.', 'pls-core' ),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);		
		$this->add_control(
            'category_list',
            [
                'label' 	=> esc_html__('Category','pls-core'),
                'type' 		=> Controls_Manager::REPEATER,
                'fields' 	=> $repeater->get_controls(),
                'title_field' => '{{{ cat_title }}}',
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
					'7'	 	=> esc_html__( '7', 'pls-core' ),
					'8'	 	=> esc_html__( '8', 'pls-core' ),
					'9'	 	=> esc_html__( '9', 'pls-core' ),
					'10' 	=> esc_html__( '10', 'pls-core' ),
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
		if ( empty( $settings['category_list'] ) ) {
			return;
		}
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 3,
			'slides_to_show_mobile' => 2,
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		$settings['id'] 			= pls_uniqid( 'pls-custom-cat-' );
		$class						= array( 'pls-element', 'pls-product-custom-categories' );
		$settings['class'] 			= implode(' ', array_filter( $class ) );
		$column_class				= array();
		$settings['slider_class'] 	= 'row';
		$settings['section_class'] 	= '';		
		$settings['banner_layout'] 	= '';
				
		if( 'grid' == $layout ){
			$column_class[] 	= 'col-lg-'. pls_get_rs_grid_columns( $grid_columns );
			$column_class[] 	= 'col-md-'. pls_get_rs_grid_columns( $grid_columns_tablet );
			$column_class[] 	= 'col-'. pls_get_rs_grid_columns( $grid_columns_mobile );
			$settings['rows'] 	= 1;
		}else{			
			$settings['slider_options'] 	= pls_slider_attributes( $settings);
			$settings['section_class'] 	= ' pls-slider swiper row';
			$settings['slider_class'] 	= 'swiper-wrapper';
			$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
			$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
			$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
			if( $settings['rows'] <= 1 ){
				$column_class[] = 'swiper-slide';
			}
		}		
		$settings['column_class']	= implode( ' ', array_filter( $column_class ) );
		$results = array();
		foreach( $settings['category_list'] as $cat_data ){
			$data= array();
			$query_args = array(
							'taxonomy'  	=> 'product_cat',
							'number'    	=> 1,
							'include' => array( $cat_data['category'] )
						);
			$cat = get_terms( $query_args );			
			if( empty( $cat ) || empty( trim( $cat_data['category'] ) ) ) {
				continue;
			}
			if($hide_empty_categories && $cat[0]->count == 0 ){
				continue;
			}
			$thumbnail_id 				= get_term_meta( $cat[0]->term_id, 'thumbnail_id', true );
			$data['category_title'] 	= $cat[0]->name;
			$data['category_count'] 	= $cat[0]->count;
			$data['category_thumbnail'] = wp_get_attachment_image_src( $thumbnail_id, $image_size );
			$data['category_link'] 		= get_term_link( (int)$cat_data['category'], 'product_cat' );
			if( $cat_data['custom_title'] ){
				$data['category_title'] = $cat_data['cat_title'];				
			}
			$data['category_image'] = '';
			if( $cat_data['cat_image']['id'] ){
				$data['category_image'] = wp_get_attachment_image_src( $cat_data['cat_image']['id'] , $image_size );
				if( !empty( $data['category_image'] )){
					$data['category_image'] = $data['category_image'][0];
				}
			}elseif(!empty( $data['category_thumbnail'] ) ){
				$data['category_image'] = $data['category_thumbnail'][0];
			}
			elseif( $cat_data['cat_image']['url'] ){
				$data['category_image'] = $cat_data['cat_image']['url'];
			}
			
			$results[] = $data;
		}
		$settings['cutom_category'] = $results;		
		pls_core_get_templates( 'elements-widgets/woo-product-cutstom-category', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_ProductCustomCategories());