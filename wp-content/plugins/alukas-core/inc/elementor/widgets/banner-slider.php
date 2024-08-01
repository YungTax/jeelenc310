<?php
/*
Element: Banner Slider
*/
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;

class PLS_Elementor_BannerSlider extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-banner-slider';
    }

	/**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Banner Slider', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-banner';
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
		return [ 'slider', 'banner', 'offer'];
	}
	
	/**
     * Register tabs widget controls.
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
		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'banner_tabs' );

		$repeater->start_controls_tab(
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'banner_image',
			[
				'label'     => esc_html__( 'Banner Image', 'pls-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' 	=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
			]
		);		
		$repeater->add_control(
            'banner_image_size',
            [
                'label' 	=> esc_html__( 'Banner Image Size', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
				'default' 	=> 'full',
            ]
        );
		$repeater->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$repeater->add_control(
            'subtitle',
            [
                'label' 	=> esc_html__('Subtitle', 'pls-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$repeater->add_control(
            'banner_content',
            [
                'label' 	=> esc_html__('Banner Content', 'pls-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$repeater->add_control(
            'button_text',
            [
                'label' 	=> esc_html__('Button Text', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]
        );
		$repeater->add_control(
			'button_icon',
			[
				'label'     => esc_html__( 'Add Icon', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,				
			]
		);
		
		$repeater->add_control(
            'icon_alignment',
            [
                'label' 	=> esc_html__('Icon Alignment', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'left'	=> esc_html__( 'Left', 'pls-core' ),
					'right'	=> esc_html__( 'Right', 'pls-core' ),
				],
                'default' 	=> 'right',
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);
		
		$repeater->add_control(
            'selected_icon',
            [
                'label' 	=> esc_html__('Icon', 'pls-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);		
		$repeater->add_control(
			'banner_link',
			[
				'label' 		=> esc_html__( 'Banner Link', 'pls-core' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'pls-core' ),
				'default'		=> [
					'url'	=> '#',
				],
			]
		);
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'position_tab',
			[
				'label' => esc_html__( 'Content Style', 'pls-core' ),
			]
		);
		$repeater->add_control(
            'banner_settings',
            [
                'label'		=> esc_html__('Banner Settings', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
            'banner_hover_effect',
            [
                'label'		=> esc_html__( 'Hover Style', 'pls-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					''			=> esc_html__( 'None', 'pls-core' ),
					'zoom-in'	=> esc_html__( 'Zoom In', 'pls-core' ),
					'zoom-out'	=> esc_html__( 'Zoom Out', 'pls-core' ),
				],
                'default'	=> 'zoom-out',
            ]
        );
		$repeater->add_control(
            'banner_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-wrapper' => 'background-color: {{VALUE}};'
                ],
            ]
        );
		$repeater->add_responsive_control(
            'banner_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'pls-core'),
               'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		$repeater->add_responsive_control(
			'banner_padding',
			[
				'label'			=> esc_html__( 'Padding', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'banner_min_height',
			[
				'label'			=> esc_html__( 'Min Height', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'description' => esc_html__( 'Min height value of banner.', 'pls-core' ),
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default'     => [
					'unit' => 'px',
					'size' => 200,
				],
				'range'       	=> [
					'px'  => [
						'step' => 1,
						'min'  => 0,
						'max'  => 600,
					],
					'rem' => array(
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					),
					'%'   => [
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors'		=> [
					'{{WRAPPER}} .banner-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'banner_max_height',
			[
				'label'       => esc_html__( 'Max Height', 'pls-core' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Max height value of banner.', 'pls-core' ),
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default'     => [
					'unit' => 'px',
				],
				'range'       => [
					'px' => [
						'step' => 1,
						'min'  => 0,
						'max'  => 600,
					],
				],
				'selectors'		=> [
					'{{WRAPPER}} .banner-wrapper, {{WRAPPER}} .banner-wrapper img' => 'max-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$repeater->add_control(
            'banner_title_settings',
            [
                'label'		=> esc_html__('Title', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
            'title_color',
            [
                'label'		=> esc_html__( 'Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-title' => 'color: {{VALUE}};'
                ],
            ]
        );
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .banner-title',
			]
		);
		$repeater->add_responsive_control(
			'title_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-title-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
            'banner_subtitle_settings',
            [
                'label'		=> esc_html__('Subtitle', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
			'subtitle_style',
			[
				'label'   => esc_html__( 'Style', 'pls-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default'    => esc_html__( 'Default', 'pls-core' ),
					'background' => esc_html__( 'Background', 'pls-core' ),
				],
				'default' => 'default',
			]
		);
		$repeater->add_control(
			'subtitle_bg_color',
			[
				'label'     => esc_html__( 'Background color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(), 
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-subtitle-background .banner-subtitle' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'subtitle_style' => 'background',
				],
			]
		);
		$repeater->add_responsive_control(
			'banner_subtitle_bg_padding',
			[
				'label'			=> esc_html__( 'Padding', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default' => [
                    'top'		=> '5',
					'right'		=> '5',
					'bottom'	=> '5',
					'left'		=> '5',
					'unit'		=> 'px',
                ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-subtitle-background .banner-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'subtitle_style' => 'background',
				],
			]
		);
		$repeater->add_control(
            'subtitle_color',
            [
                'label'		=> esc_html__( 'Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-subtitle' => 'color: {{VALUE}};'
                ],
            ]
        );
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .banner-subtitle',
			]
		);
		$repeater->add_responsive_control(
			'subtitle_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-subtitle-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
            'banner_Content_settings',
            [
                'label'		=> esc_html__('Content', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
            'content_color',
            [
                'label'		=> esc_html__( 'Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-content-text' => 'color: {{VALUE}};'
                ],
            ]
        );
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'banner_content_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .banner-content-text',
			]
		);
		$repeater->add_control(
            'banner_button_settings',
            [
                'label'		=> esc_html__('Button', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
            'button_style',
            [
                'label'		=> esc_html__('Style', 'pls-core'),
                'type'		=> Controls_Manager::SELECT,
                'options'	=> [
					'link'		=> esc_html__( 'Link', 'pls-core' ),
					'flat'		=> esc_html__( 'Flat', 'pls-core' ),
					'outline'	=> esc_html__( 'Outline', 'pls-core' ),
					'text'		=> esc_html__( 'Text', 'pls-core' ),
				],
                'default'	=> 'link',
            ]
        );
		$repeater->add_control(
            'button_shape',
            [
                'label'		=> esc_html__('Shape', 'pls-core'),
                'type'		=> Controls_Manager::SELECT,
                'options'	=> [
					'square'	=> esc_html__( 'Square', 'pls-core' ),
					'rounded'	=> esc_html__( 'Rounded', 'pls-core' ),
					'round'		=> esc_html__( 'Round', 'pls-core' ),
				],
                'default'	=> 'square',
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				],
            ]
        );
		$repeater->add_control(
            'button_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'condition' => [
					'button_style' => [ 'outline' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .button.btn-style-outline' => 'border-width: {{VALUE}}px;',
                ],
            ]
        );
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button a',
			]
		);
		$repeater->add_responsive_control(
			'button_padding',
			[
				'label'			=> esc_html__( 'Padding', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pls-button a.btn-style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pls-button a.btn-style-outline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				],
			]
		);
		$repeater->add_responsive_control(
			'button_margin',
			[
				'label'			=> esc_html__( 'Margin Top', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);		
		$repeater->add_control(
            'button_text_color',
            [
                'label'		=> esc_html__('Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_color(),
               	'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .button, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-text'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-link:after, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-outline' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button a > svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
		$repeater->add_control(
            'button_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_inverse_color(),
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-flat' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'link', 'text' ],
				]
            ]
        );		
		$repeater->add_control(
            'button_text_hover_color',
            [
                'label' 	=> esc_html__('Hover Color', 'pls-core'),
				'type'		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_inverse_color(),
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .button:hover, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-link:hover, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-text:hover'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-link:hover:after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button a:hover > svg' => 'fill: {{VALUE}};',
                ],
            ]
        );			
		$repeater->add_control(
            'button_bg_hover_color',
            [
                'label'		=> esc_html__( 'Hover Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-flat:hover, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-outline:hover, {{WRAPPER}} {{CURRENT_ITEM}} .pls-button .btn-style-link:hover:after' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'link', 'text' ],
				]
            ]
        );	
		
		$repeater->add_control(
            'banner_content_box_settings',
            [
                'label'		=> esc_html__('Content Box', 'pls-core'),
				'type' 		=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
		$repeater->add_control(
            'banner_content_bg_color',
            [
                'label'		=> esc_html__( 'Background', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$repeater->add_responsive_control(
			'banner_content_width',
			[
				'label'			=> esc_html__( 'Width', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%', 'px' ],
				'range'			=> [
					'%' 	=> [ 'min' => 0, 'max' => 100 ],
					'px' 	=> [ 'min' => 0, 'max' => 1600, 'step' => 1 ], 
				],
				'default' 		=> [ 'unit' => '%', 'size' => 70 ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'max-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$repeater->add_responsive_control(
			'banner_content_padding',
			[
				'label'			=> esc_html__( 'Padding', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
            'box_border_style',
            [
                'label' 	=> esc_html__('Border Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'none'		=> esc_html__( 'None', 'pls-core' ),
					'solid'		=> esc_html__( 'Solid', 'pls-core' ),
					'dashed'	=> esc_html__( 'Dashed', 'pls-core' ),
					'dotted'	=> esc_html__( 'Dotted', 'pls-core' ),
					'double'	=> esc_html__( 'Double', 'pls-core' ),
					'inset'		=> esc_html__( 'Inset', 'pls-core' ),
					'outset'	=> esc_html__( 'Outset', 'pls-core' ),			
				],
				'default'	=> 'none',
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$repeater->add_responsive_control(
			'box_border_width',
			[
				'label'			=> esc_html__( 'Border Width', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border_style!' => [ 'none' ],
				],
			]
		);
		
		$repeater->add_responsive_control(
            'box_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'pls-core'),
               'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		$repeater->add_control(
            'box_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'pls-core'),
                'type'      => Controls_Manager::COLOR,
				'condition' => [
					'box_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner-content' => 'border-color: {{VALUE}};',
                ],
				
            ]
		);
		$repeater->add_responsive_control(
            'content_text_align',
            [
                'label'		=> esc_html__('Text Alignment', 'pls-core'),
				'type' 		=> Controls_Manager::CHOOSE,
                'options' 	=> [
					'left' => [ 
						'title' => esc_html__('Left', 'pls-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'pls-core'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'pls-core'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'pls-core'),
						'icon' => 'eicon-text-align-justify',
					],
				],
                'default'	=> 'left',
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}}.pls-banner .banner-content-wrap' => 'text-align: {{VALUE}};',
				],
            ]
        );
		
		$repeater->add_responsive_control(
            'content_horizontal_align',
            [
                'label'		=> esc_html__('Horizontal Alignment', 'pls-core'),
                'type'		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'flex-start' => [
						'title' => esc_html__('Left', 'pls-core'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'pls-core'),
						'icon' 	=> 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'pls-core'),
						'icon' 	=> 'eicon-h-align-right',
					],
				],
                'default'	=> 'start',
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}}.pls-banner .banner-content-wrap' => 'align-items: {{VALUE}};',
				],
            ]
        );
		
		$repeater->add_responsive_control(
            'content_vertical_align',
            [
                'label'		=> esc_html__('Vertical Alignment', 'pls-core'),
				'type'		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'flex-start' => [ 
						'title' => esc_html__('Top', 'pls-core'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Middle', 'pls-core'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__('Bottom', 'pls-core'),
						'icon' => 'eicon-v-align-bottom',
					],
					'space-between' => [
						'title' => esc_html__('Justify', 'pls-core'),
						'icon' => 'eicon-v-align-middle',
					],
				],
                'default' => 'start',
				'selectors'		=> [
					'{{WRAPPER}} {{CURRENT_ITEM}}.pls-banner .banner-content-wrap' => 'justify-content: {{VALUE}};',
				],
            ]
        );
		
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		/**
		 * Repeater settings
		 */
		$this->add_control(
			'banners',
			[
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'			=> 'Banner Title',
						'subtitle'		=> 'Banner subtitle',
						'button_text'	=> 'Shop Now',
					],
					[
						'title'			=> 'Banner Title',
						'subtitle' 		=> 'Banner subtitle',
						'button_text'	=> 'Shop Now',
					],
					[
						'title'    		=> 'Banner Title',
						'subtitle' 		=> 'Banner subtitle',
						'button_text' 	=> 'Shop Now',
					],
				],
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
		]);
		extract( $settings );
		$settings['id'] 	= pls_uniqid('pls-banners-slider-');
		$class				= array( 'row', 'pls-element', 'pls-banners-slider','swiper', 'pls-slider');
		$settings['class']  = implode(' ', array_filter( $class ) );			
		$button_class		= array( 'button' );
		
		$settings['slider_class'] 	= 'swiper-wrapper';
		$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
		$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
		$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
		$settings['slider_options'] 	= pls_slider_attributes( $settings);
		pls_core_get_templates( 'elements-widgets/banner-slider', $settings );
	}
}

$widgets_manager->register( new PLS_Elementor_BannerSlider() );