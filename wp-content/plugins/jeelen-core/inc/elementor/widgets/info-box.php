<?php
/*
Element: InfoBox
*/
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
class PLS_Elementor_InfoBox extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-infobox';
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
        return esc_html__( 'Info Box', 'pls-core' );
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
        return 'pls-icon eicon-icon-box';
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
		return [ 'image box', 'feature', 'icon box' ];
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
		
		$this->start_controls_section(
            'pls_info_box_section',
            [
                'label'		=> esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label'			=> esc_html__('Sub Title', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'title_text',
            [
                'label'			=> esc_html__('Title', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Infobox Title', 'pls-core'),
				'label_block'	=> true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'pls-core' ),
                'type' 	=> Controls_Manager::SELECT,
                'options' => [
                    'h1' 	=> 'H1',
                    'h2' 	=> 'H2',
                    'h3' 	=> 'H3',
                    'h4' 	=> 'H4',
                    'h5' 	=> 'H5',
                    'h6' 	=> 'H6',
                    'div' 	=> 'div',
                    'span' 	=> 'span',
                    'p'    	=> 'p',
                ],
                'default' => 'h4',
            ]
        );
		$this->add_control(
            'description',
            [
                'label'			=> esc_html__('Description', 'pls-core'),
				'type'			=> Controls_Manager::TEXTAREA,
                'default'		=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit ut elit tellus.', 'pls-core'),
                'label_block'	=> true,
            ]
        );
		$this->add_control(
            'apply_to_link',
            [
                'label' 	=> esc_html__('Apply link to', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'default'		    => esc_html__( 'No Link', 'pls-core' ),
					'complete_box'	    => esc_html__( 'Complete Box', 'pls-core' ),
					'box_title'		    => esc_html__( 'Box Title', 'pls-core' ),
					'display_read_more' => esc_html__( 'Display Read More', 'pls-core' ),
				],
				'default'	=> 'default',
            ]
		);
		$this->add_control(
			'link',
			[
				'label' 		=> esc_html__( 'Add Link', 'pls-core' ),
				'type'  		=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'pls-core' ),
				'default'		=> [
					'url'		=> '#',
				],
				'condition' 	=> [
					'apply_to_link'	=> [ 'complete_box','box_title','display_read_more' ],
				],
			]
		);
		$this->add_control(
            'read_more_text',
            [
                'label' 		=> esc_html__('Read More', 'pls-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__('Read More', 'pls-core'),
				'placeholder' 	=> esc_html__('Read More', 'pls-core'),
				'condition'		=> [
					'apply_to_link' => [ 'display_read_more' ],
				],
            ]
        );
		$this->add_control(
			'button_icon',
			[
				'label'     => esc_html__( 'Add Icon', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
				'condition'		=> [
					'apply_to_link' => [ 'display_read_more' ],
				],
			]
		);
		
		$this->add_control(
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
					'button_icon' => 'yes',
					'apply_to_link' => [ 'display_read_more' ],
				],
            ]
		);
		
		$this->add_control(
            'selected_btn_icon',
            [
                'label' 	=> esc_html__('Icon', 'pls-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'button_icon' => 'yes',
					'apply_to_link' => [ 'display_read_more' ],
				],
            ]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'icon_section',
            [
                'label' => esc_html__( 'Icon', 'pls-core' ),
            ]
        );
		$this->add_control(
            'icon_display_type',
            [
                'label' 	=> esc_html__('Icon to display', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'font'	=> esc_html__( 'Font Icon Manager', 'pls-core' ),
					'image'	=> esc_html__( 'Custom Image Icon', 'pls-core' ),
					'text'	=> esc_html__( 'Text', 'pls-core' ),
				],
				'default'	=> 'font',
            ]
		);
		$this->add_control(
            'selected_icon',
            [
                'label' 	=> esc_html__('Icon', 'pls-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'lnr lnr-rocket',
					'library' => 'linearicons-icons',
				],
				'condition' => [
					'icon_display_type' => [ 'font' ],
				],
            ]
		);
		
		$this->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Choose image', 'pls-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' 	=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_display_type' => [ 'image' ],
				],
			]
		);
		$this->add_control(
            'icon_text',
            [
                'label' 	=> esc_html__('Text', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> '01',
				'condition' => [
					'icon_display_type' => [ 'text' ],
				],
            ]
        );
		$this->add_control(
            'icon_hover_effet',
            [
                'label' 	=> esc_html__('Icon Hover Effect', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icon-effect-none'		=> esc_html__( 'No Effect', 'pls-core' ),
					'icon-effect-zoom'		=> esc_html__( 'Icon Zoom', 'pls-core' ),
					'icon-effect-bounceup'	=> esc_html__( 'Icon Bounce Up', 'pls-core' ),
				],
				'default'	=> 'icon-effect-none',
            ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => esc_html__( 'Subtitle', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .info-box-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_mb',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'selectors'		=> [ 
					'{{WRAPPER}} .info-box-wrap .info-box-subtitle' => 'margin-bottom: {{SIZE}}px'
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Title', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-title > *' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .info-box-title > *',
			]
		);
		$this->add_responsive_control(
			'title_mb',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'selectors'		=> [ 
					'{{WRAPPER}} .info-box-wrap .info-box-title' => 'margin-bottom: {{SIZE}}px' 
				],
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
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-description > *' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .info-box-description > *',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Box Style', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'box_style',
            [
                'label' 	=> esc_html__('Box Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icon-top'		      => esc_html__( 'Icon Top', 'pls-core' ),
					'icon-left'		      => esc_html__( 'Icon Left', 'pls-core' ),
					'icon-right'		  => esc_html__( 'Icon Right', 'pls-core' ),
					'box-square'		  => esc_html__( 'Boxed Square', 'pls-core' ),
					'box-square-hover-bg' => esc_html__( 'Boxed Square With Hover Background', 'pls-core' ),
				],
				'default'	=> 'icon-top',
            ]
		);
		$this->add_control(
            'align',
            [
                'label' 	=> esc_html__('Alignment', 'pls-core'),
                'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> $this->alignment_options(),
				'default'	=> 'center',
				'condition' => [
					'box_style' => [ 'icon-top' ],
				],
            ]
		);
		$this->add_control(
            'box_min_height',
            [
                'label' 	=> esc_html__('Box Min Height', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'condition' => [
					'box_style' => [ 'box-square' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .pls-info-box .info-box-content' => 'height: {{VALUE}}px;max-height: {{VALUE}}px;',
                ],
            ]
        );
		$this->add_control(
            'box_border_style',
            [
                'label' 	=> esc_html__('Box Border Style', 'pls-core'),
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
				'condition' => [
					'box_style' => [ 'box-square' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-content' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_control(
            'box_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'condition' => [
					'box_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-content' => 'border-width: {{VALUE}}px;',
                ],
            ]
        );
		$this->add_control(
            'box_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'pls-core'),
                'type'      => Controls_Manager::COLOR,
				'condition' => [
					'box_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-content' => 'border-color: {{VALUE}};',
                ],
				
            ]
		);
		$this->add_control(
            'box_color',
            [
                'label' 	=> esc_html__('Box Color', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'inherit' => esc_html__( 'Inherit', 'pls-core' ),
					'light'	  => esc_html__( 'Light', 'pls-core' ),
					'dark'	  => esc_html__( 'Dark', 'pls-core' ),
				],
				'default'	=> 'inherit',
            ]
		);
		$this->add_control(
            'box_bg_color',
            [
                'label' 	=> esc_html__( 'Box Background Color', 'pls-core' ),
                'type'  	=> Controls_Manager::COLOR,
				'condition' => [
					'box_style' => [ 'box-square', 'box-square-hover-bg' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .pls-info-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'box_hover_color',
            [
                'label' 	=> esc_html__('Box Hover Color', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'inherit' => esc_html__( 'Inherit', 'pls-core' ),
					'light'	  => esc_html__( 'Light', 'pls-core' ),
					'dark'	  => esc_html__( 'Dark', 'pls-core' ),
				],
				'default'	=> 'inherit',
				'condition' => [
					'box_style' => [ 'box-square-hover-bg' ],
				],
            ]
		);
		$this->add_control(
            'box_bg_hover_color',
            [
                'label' 	=> esc_html__( 'Box Background Hover Color', 'pls-core' ),
                'type'  	=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .pls-info-box:hover' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'box_style' => [ 'box-square-hover-bg' ],
				],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => esc_html__( 'Icon', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_responsive_control(
            'icon_image_size',
            [
                'label' 	=> esc_html__('Icon Image Width(px)', 'pls-core'),
				'type'			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range'			=> [ 
					'px' 	=> [ 'min' => 0, 'max' => 500,'step' => 1 ], 
					'%' 	=> [ 'min' => 1,'max' => 100 ] 
				],
				'default' 		=> [ 'unit' => 'px', 'size' => 48 ],
				'selectors'		=> [
					'{{WRAPPER}} .box-icon-wrap .info-box-icon img' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_display_type' => [ 'image' ],
				],
            ]
        );
		
		$this->add_responsive_control(
            'icon_size',
            [
                'label' 		=> esc_html__('Icon Size', 'pls-core'),
                'type' 			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'label_block' 	=> true,
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 48,
				],
				'selectors' => [
                    '{{WRAPPER}} .box-icon-wrap .info-box-icon' => 'font-size: {{SIZE}}px;',
                ],
				'condition' => [
					'icon_display_type' => [ 'font','text' ],
				],
            ]
        );
		
		$this->add_control(
            'icon_color',
            [
                'label' 	=> esc_html__( 'Color', 'pls-core' ),
                'type' 		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .info-box-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition' => [
					'icon_display_type' => [ 'font','text' ],
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .info-box-icon',
				'condition' => [
					'icon_display_type' => [ 'text' ],
				],
			]
		);
		$this->add_control(
            'icon_style',
            [
                'label' 	=> esc_html__('Icon Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icon-simple'	=> esc_html__( 'Simple', 'pls-core' ),
					'icon-circle'	=> esc_html__( 'Circle Background', 'pls-core' ),
					'icon-square'	=> esc_html__( 'Square Background', 'pls-core' ),
					'icon-custom'	=> esc_html__( 'Design Your Own', 'pls-core' ),
				],
				'default'	=> 'icon-simple',
            ]
		);
		$this->add_control(
            'icon_bg_color',
            [
                'label' 	=> esc_html__('Background Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_secondary_color(),
				'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'icon_style' => [ 'icon-circle','icon-square','icon-custom' ],
				],
            ]
		);
		$this->add_control(
            'icon_border_style',
            [
                'label' 	=> esc_html__('Icon Border Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					''			=> esc_html__( 'None', 'pls-core' ),
					'solid'		=> esc_html__( 'Solid', 'pls-core' ),
					'dashed'	=> esc_html__( 'Dashed', 'pls-core' ),
					'dotted'	=> esc_html__( 'Dotted', 'pls-core' ),
					'double'	=> esc_html__( 'Double', 'pls-core' ),
					'inset'		=> esc_html__( 'Inset', 'pls-core' ),
					'outset'	=> esc_html__( 'Outset', 'pls-core' ),
				],
				'default'	=> '',
				'condition' => [
					'icon_style' => [ 'icon-custom' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_control(
            'icon_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'border-color: {{VALUE}};',
                ],
				'condition' => [
					'icon_style' 		=> [ 'icon-custom' ],
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				
            ]
		);
		$this->add_control(
            'icon_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default'	=> 1,
				'condition' => [
					'icon_style' 		=> [ 'icon-custom' ],
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'border-width: {{VALUE}}px;',
                ],
            ]
		);
		$this->add_control(
            'icon_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER, 
				'default'	=> 100,
				'condition' => [
					'icon_style' 		=> [ 'icon-custom' ],
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .info-box-icon' => 'border-radius: {{VALUE}}px;',
                ],
				
            ]
		);		
		$this->add_responsive_control(
            'icon_bg_size',
            [
                'label' 		=> esc_html__('Background Size(px)', 'pls-core'),
                'type' 			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'label_block' 	=> true,
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 88,
				],
				'condition' 	=> [
					'icon_style'	=> [ 'icon-custom' ],
				],
				'selectors'		=> [
                    '{{WRAPPER}} .info-box-icon' => 'width: {{SIZE}}px; height: {{SIZE}}px; line-height: {{SIZE}}px;',
                ],
            ]
        );
		$this->add_responsive_control(
			'icon_mb',
			[
				'label'     	=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'label_block' 	=> true,
				'type'      	=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'selectors' 	=> [
					'{{WRAPPER}} .info-box-wrap .box-icon-wrap' => 'margin-bottom: {{SIZE}}px'
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Button settings.
		 */
		/**
		 * Button settings.
		 */
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'button_style',
            [
                'label'		=> esc_html__('Style', 'pls-core'),
                'type'		=> Controls_Manager::SELECT,
                'options'	=> [
					'flat'		=> esc_html__( 'Flat', 'pls-core' ),
					'outline'	=> esc_html__( 'Outline', 'pls-core' ),
					'link'		=> esc_html__( 'Link', 'pls-core' ),
					'text'		=> esc_html__( 'Text', 'pls-core' ),
				],
                'default'	=> 'flat',
            ]
        );
		$this->add_control(
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
		$this->add_control(
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-button a',
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label'			=> esc_html__( 'Padding', 'pls-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'rem' ],
				'selectors'		=> [
					'{{WRAPPER}} .pls-button a.btn-style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pls-button a.btn-style-outline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				],
			]
		);
		$this->start_controls_tabs( 'banner_buttons_colors' );

        $this->start_controls_tab(
            'banner_buttons_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'pls-core' ),                
            ]
        );
		$this->add_control(
            'button_text_color',
            [
                'label'		=> esc_html__('Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_color(),
               	'selectors' => [
                    '{{WRAPPER}} .pls-button .button, {{WRAPPER}} .pls-button .btn-style-text'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .pls-button .btn-style-link:after, {{WRAPPER}} .pls-button .btn-style-outline' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .pls-button a > svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_inverse_color(),
               	'selectors' => [
                    '{{WRAPPER}} .pls-button .btn-style-flat' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				]
            ]
        );		
		$this->end_controls_tab();

        $this->start_controls_tab(
            'banner_buttons_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'pls-core' ),
            ]
        );
		$this->add_control(
            'button_text_hover_color',
            [
                'label' 	=> esc_html__('Color', 'pls-core'),
				'type'		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-button .button:hover, {{WRAPPER}} .pls-button .btn-style-link:hover, {{WRAPPER}} .pls-button .btn-style-text:hover'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .pls-button .btn-style-link:hover:after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .pls-button a:hover > svg' => 'fill: {{VALUE}};',
                ],
            ]
        );		
		$this->add_control(
            'button_bg_hover_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-button .btn-style-flat:hover, {{WRAPPER}} .pls-button .btn-style-outline:hover, {{WRAPPER}} .pls-button .btn-style-link:hover:after' => 'background-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'link', 'text' ],
				]
            ]
        );
		
		$this->end_controls_tab();

        $this->end_controls_tabs();
		
		$this->add_responsive_control(
			'description_mt',
			[
				'label'			=> esc_html__( 'Margin Top', 'pls-core' ),
				'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'selectors'		=> [ 
					'{{WRAPPER}} .pls-info-box .info-box-btn' => 'margin-top: {{SIZE}}px'
				],
			]
		);
		$this->end_controls_section();
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 		= pls_uniqid( 'pls-info-box-' );
		$class					= array( 'pls-element', 'pls-info-box' );
		$class[]				= $icon_hover_effet;
		$class[]				= $icon_style;
		$class[]				= $box_style;
		$class[]				= 'color-scheme-'.$box_color;
		$class[]				= 'hover-color-scheme-'.$box_hover_color;
		$class[]				= ($box_style == 'icon-top') ? 'text-'.$align: '';
		
		$button_class			= array( );
		if( $button_style != 'text' ){
			$button_class[] = 'button';
		}
		$button_class[]			= 'btn-style-'.$button_style;
		if( 'flat' == $button_style || 'outline' == $button_style ){
			$button_class[]			= 'btn-shape-'.$button_shape;
		}
		$button_class[]			= ( $button_icon ) ? 'btn-icon-'.$icon_alignment : '';
		$settings['button_class'] 	= implode(' ', array_filter( $button_class ) );
		$btn_icon_html 			= '';
		if( $settings['button_icon'] ) {			
			ob_start();
			Icons_Manager::render_icon( $settings['selected_btn_icon'], [ 'aria-hidden' => 'true' ]  );
			$btn_icon_html = ob_get_clean();
		}
		if( $button_icon && $icon_alignment == 'left' ){
			$settings['read_more_text'] = $btn_icon_html .' '.$read_more_text;
		}
		
		if( $button_icon && $icon_alignment == 'right' ){
			$settings['read_more_text'] = $read_more_text.' '.$btn_icon_html;
		}
		
		
		$icon_html 			= '';
		if( $icon_display_type !== '' ){
			if ( $icon_display_type == 'image' ) {
				if ( isset( $settings['icon_image']['id'] ) && $settings['icon_image']['id'] ) {
					$icon_image_src = pls_get_image_src( $settings['icon_image']['id'], 'full' );
					$icon_html 		= '<img src="'. esc_url($icon_image_src) .'" alt="'.strip_tags( $title_text ).'"/>';
				}elseif( !empty($settings['icon_image']['url'])){
					$icon_image_src = $settings['icon_image']['url'];
					$icon_html 		= '<img src=" '. esc_url($icon_image_src) .' " alt="'.strip_tags( $title_text ).'"/>';
				}
			}elseif( $icon_display_type == 'text' ){
				$icon_html = $icon_text;
			}else {                    
				ob_start();
				Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
				$icon_html = ob_get_clean();
			}

		}	
		$settings['icon_html'] = $icon_html;
		
		$link_url				= $settings['link']['url'];
		$link_target 			= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$window_link_target 	= $settings['link']['is_external'] ? '_blank' : '_self';
		$link_on_complete_box 	= '';
		$link_on_box_title 		= '';
		
		if($apply_to_link == 'complete_box' && !empty( $link_url ) ){ 
			$link_on_complete_box 	= ' onclick="window.open(\''.$link_url.'\',\''.$window_link_target.'\')"';
			$class[]				= 'pls-full-info-link';
		}
		
		if($apply_to_link == 'box_title' && !empty( $link_url ) ){
			$link_on_box_title = ' onclick="window.open(\''.$link_url.'\',\''.$window_link_target.'\')"';
		}
		
		$settings['class'] 					= implode(' ',array_filter($class));
		$settings['link_url'] 				= empty($link_url) ?  'javascript:voide();' : $link_url;
		$settings['link_target'] 			= $link_target;
		$settings['link_attributes'] 		= isset($link) ? pls_core_elementor_get_url_attribute($link) : '';
		$settings['link_on_complete_box'] 	= $link_on_complete_box;
		$settings['link_on_box_title'] 		= $link_on_box_title;
		
		pls_core_get_templates( 'elements-widgets/info-box', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_InfoBox());