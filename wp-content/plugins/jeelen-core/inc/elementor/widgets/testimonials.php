<?php
/*
Element: Testimonials
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
class PLS_Elementor_Testimonials extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-testimonials';
    }

	/**
     * Get widget title.
     *
     * Retrieve Testimonials widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Testimonials', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Testimonials widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-testimonial-carousel';
    }
	
	/**
     * Register Testimonials widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= pls_core_get_all_image_sizes(true);
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );		
		$this->add_control(
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'style-1'	=> esc_html__( 'Style 1', 'pls-core' ),
					'style-2'	=> esc_html__( 'Style 2', 'pls-core' ),
					'style-3'	=> esc_html__( 'Style 3', 'pls-core' ),
				],
                'default' 		=> 'style-1',
				'description'	=> esc_html__( 'Select style.', 'pls-core' ),
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_tab',
			array(
				'label'     => esc_html__( 'Member', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);		
		$repeater = new Repeater();
		$repeater->add_control(
			'name',
			[
				'label' 		=> esc_html__( 'Name', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter Client name', 'pls-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Title', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter title', 'pls-core' ),
			]
		);		
		$repeater->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Member Avatar', 'pls-core' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url'		=> Utils::get_placeholder_image_src(),
				],
				'description'	=> esc_html__( 'Client Avatar', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' 		=> esc_html__( 'Description', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> '',
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' 		=> esc_html__( 'Rating', 'pls-core' ),
				'type' 			=> Controls_Manager::SELECT,
				'options'		=> [ '1' => 1, '2' => 2 , '3' => 3, '4' => 4, '5' => 5 ],
				'default'		=> '5'
			]
		);
		
		$this->add_control(
            'testimonials_items',
            [
                'label' 	=> esc_html__( 'Testimonials Item', 'pls-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'name' 			=> 'Donald Duclk',
						'title' 		=> 'jeelen is my favourite store',
						'description' 	=> 'Great products and designs and such great quality, they always wash up well no matter how many times I wash them.',
						'rating' 		=> '5',
					],
					[
						'name' 			=> 'Niamh Oxley',
						'title' 		=> 'Beautiful products',
						'description' 	=> 'Beautiful clothes. I always get complements. Good quality and items wash well. products and designs and such great.',
						'rating' 		=> '4',
					],
					[
						'name' 			=> 'Mary Green',
						'title' 		=> 'Lovely products',
						'description' 	=> 'Great products and designs and such great quality, they always wash up well no matter how many times I wash them.',
						'rating' 		=> '3',
					],
				],
				'title_field' => '{{{ name }}}',
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
		
		$this->start_controls_section(
			'general_style_section',
			[
				'label' => esc_html__( 'Title', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} .testimonial-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .testimonial-title',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'name_style_section',
			[
				'label' => esc_html__( 'Name', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .testimonial-name',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'Description', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#555555',
				'selectors' => [
					'{{WRAPPER}} .testimonial-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .testimonial-description',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 2,
			'slides_to_show_mobile' => 1,
		]);
		extract( $settings );
		$settings['id'] 	= pls_uniqid( 'pls-testimonial-' );
		$class				= array( 'pls-element', 'pls-testimonials', 'row', $style, 'swiper', 'pls-slider' );
		$settings['class']	= implode( ' ', $class );		
		$settings['slider_class'] 	= 'swiper-wrapper';
		$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
		$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
		$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
		$settings['slider_options'] 	= pls_slider_attributes( $settings);
		pls_core_get_templates( 'elements-widgets/testimonials', $settings );
	}
}
$widgets_manager->register( new PLS_Elementor_Testimonials() );