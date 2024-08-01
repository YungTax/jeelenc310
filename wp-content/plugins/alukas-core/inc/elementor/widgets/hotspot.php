<?php
/*
Element: Hotspot
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
class PLS_Elementor_Hotspot extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-hotspot';
    }

	/**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Hotspot', 'pls-core' );
    }

    /**
     * Get widget icon.
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-image-hotspot';
    }
	
	public function get_keywords() {
		return [ 'image', 'tooltip', 'hotspot' ];
	}
	
	/**
     * Register tabs widget controls.
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
			'hotspot_image',
			[
				'label'     => esc_html__( 'Choose Image', 'pls-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' 	=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'hotspot_image_size',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'	=> ['custom'],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'pls_hotspot_section',
            [
                'label' => esc_html__( 'Hotspot', 'pls-core' ),
            ]
        );
		
		$repeater = new Repeater();		
		
		$repeater->start_controls_tabs( 'hotspot_repeater' );

		$repeater->start_controls_tab(
			'hotspot_content_tab',
			[
				'label' => esc_html__( 'Content', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'content_type',
			[
				'label'   => esc_html__( 'Type', 'pls-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'custom_text'	=> esc_html__( 'Custom Text', 'pls-core' ),
					'product' 		=> esc_html__( 'Product', 'pls-core' ),
				],
				'default' => 'custom_text',
			]
		);
		$repeater->add_control( 
			'custom_content', 
			[
				'label'   => esc_html__( 'Content', 'pls-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'pls-core' ),
				'condition' => [
					'content_type' => [ 'custom_text' ],
				],
			] 
		);
		$repeater->add_control(
            'product_id',
            [
                'label'			=> esc_html__('Select Product', 'pls-core'),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_post',
				'render'		=> 'pls_core_elementor_render_post',
				'post_type'		=> 'product',
				'multiple'		=> false,
				'label_block'	=> true,
				'condition' => [
					'content_type' => [ 'product' ],
				],
            ]
        );
		$repeater->add_control(
			'hotspot_position',
			[
				'label'       => esc_html__( 'Position', 'pls-core' ),
				'description' => esc_html__( 'Select position.', 'pls-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'left-top'   	=> esc_html__( 'Left Top', 'pls-core' ),
					'left-bottom'   => esc_html__( 'Left Bottom', 'pls-core' ),
					'right-top'  	=> esc_html__( 'Right Top', 'pls-core' ),
					'right-bottom'  => esc_html__( 'Right Bottom', 'pls-core' ),
					'top-left'    	=> esc_html__( 'Top Left', 'pls-core' ),
					'top-right'    => esc_html__( 'Top Right', 'pls-core' ),
					'bottom-left' 	=> esc_html__( 'Bottom Left', 'pls-core' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'pls-core' ),
				],
				'default'     => 'left-bottom',
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'position_tab',
			[
				'label' => esc_html__( 'Position', 'pls-core' ),
			]
		);
		$repeater->add_responsive_control(
			'horizontal',
			[
				'label'     => esc_html__( 'Horizontal(%)', 'pls-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 50,
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
			]
		);
		$repeater->add_responsive_control(
			'vertical',
			[
				'label'     => esc_html__( 'Vertical(%)', 'pls-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 50,
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		
		$this->add_control(
            'hotspot_items',
            [
                'label' 	=> esc_html__('Hotspot','pls-core'),
                'type' 		=> Controls_Manager::REPEATER,
                'fields' 	=> $repeater->get_controls(),
				'default'     => [
					[
						'content_type'		=> 'custom_text',
						'custom_content'	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						//'hotspot_position'	=> 'right-bottom',
					],
				],
            ]
        );
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings['id'] 	= pls_uniqid('pls-hotspot-');
		$class				= array( 'pls-element', 'pls-hotspot' );		 
			
		$settings['class'] 	= implode(' ', array_filter( $class ) );
		$settings['image_src'] = '';
		if ( !empty( $settings['hotspot_image']['id'] ) ) {
			$settings['image_src'] = Group_Control_Image_Size::get_attachment_image_src($settings['hotspot_image']['id'], 'hotspot_image_size', $settings);
		} elseif( !empty( $settings['hotspot_image']['url'] ) ) {
			$settings['image_src'] = $settings['hotspot_image']['url'];
		}
		pls_core_get_templates( 'elements-widgets/hotspot', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_Hotspot());