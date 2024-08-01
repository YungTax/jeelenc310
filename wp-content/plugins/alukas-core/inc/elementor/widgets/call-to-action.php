<?php
/*
Element: InfoBox
*/
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
class PLS_Elementor_CallToAction extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-call-to-action';
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
        return esc_html__( 'Call to Action', 'pls-core' );
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
        return 'pls-icon eicon-image-rollover';
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
		return [ 'call to action', 'cta', 'button' ];
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
            'title_text',
            [
                'label'			=> esc_html__('Title', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Heading Text Here', 'pls-core'),
				'label_block'	=> true,
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
            'button_text',
            [
                'label' 		=> esc_html__('Button Text', 'pls-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__('Find Store', 'pls-core'),
				'placeholder' 	=> esc_html__('Shop Now', 'pls-core'),
            ]
        );
		$this->add_control(
			'link',
			[
				'label' 		=> esc_html__( 'Button Link', 'pls-core' ),
				'type'  		=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'pls-core' ),
				'default'		=> [
					'url'		=> '#',
				],
			]
		);
		
		$this->add_control(
			'button_icon',
			[
				'label'     => esc_html__( 'Add Icon', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
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
				],
            ]
		);
		$this->add_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'pls-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' 		=> esc_html__( 'Left', 'pls-core' ),
					'center' 	=> esc_html__( 'Center', 'pls-core' ),
					'right' 	=> esc_html__( 'Right', 'pls-core' ),
				],
				'default' 		=> 'center',
				'description' 	=> esc_html__( 'Select call to action alignment.', 'pls-core' ),
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
					'value'   => 'picon-home',
					'library' => 'pls-icons',
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
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} .pls-cta-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-cta-title',
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
					'{{WRAPPER}} .pls-cta-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-cta-subtitle',
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
            'icon_size',
            [
                'label' 		=> esc_html__('Icon Size', 'pls-core'),
                'type' 			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 15, 'max' => 100 ] ],
				'label_block' 	=> true,
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 24,
				],
				'selectors' => [
                    '{{WRAPPER}} .pls-call-to-action .pls-cta-icon' => 'font-size: {{SIZE}}px;',
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
                    '{{WRAPPER}} .pls-cta-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pls-cta-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition' => [
					'icon_display_type' => [ 'font' ],
				],
            ]
        );
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     	=> esc_html__( 'Spacing', 'pls-core' ),
				'label_block' 	=> true,
				'type'      	=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 18,
				],
				'selectors' 	=> [
					'body:not(.rtl) {{WRAPPER}} .pls-cta-icon' => 'margin-right: {{SIZE}}px',
					'body.rtl {{WRAPPER}} .pls-cta-icon' => 'margin-left: {{SIZE}}px'
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
                'default'	=> 'outline',
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
		$this->add_control(
            'button_border_style',
            [
                'label' 	=> esc_html__('Border Style', 'pls-core'),
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
				'default'	=> 'solid',
				'condition' => [
					'button_style' => [ 'outline' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .pls-cta-btn .btn-style-outline' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_control(
            'button_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
                    '{{WRAPPER}} .pls-cta-btn .btn-style-outline' => 'border-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style' 		=> [ 'outline' ],
					'button_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				
            ]
		);
		$this->add_control(
            'button_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default'	=> 2,
				'condition' => [
					'button_style' 		=> [ 'outline' ],
					'button_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .pls-cta-btn .btn-style-outline' => 'border-width: {{VALUE}}px;',
                ],
            ]
		);
		$this->add_responsive_control(
			'button_spacing',
			[
				'label'     	=> esc_html__( 'Gap', 'pls-core' ),
				'label_block' 	=> true,
				'type'      	=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 250 ] ],
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 25,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .pls-cta-btn' => 'margin-left: {{SIZE}}px; margin-right: {{SIZE}}px'
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
					'button_style!' => [ 'link', 'text' ],
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
		
		$this->end_controls_section();
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 		= pls_uniqid( 'pls-call-to-action-' );
		$class					= array( 'pls-element', 'pls-call-to-action' );
		$class[]				= 'align-'.$alignment;
		$settings['class'] 		= implode(' ',array_filter($class));
		
		$button_class			= array();
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
			$settings['button_text'] = $btn_icon_html .' '.$button_text;
		}
		
		if( $button_icon && $icon_alignment == 'right' ){
			$settings['button_text'] = $button_text.' '.$btn_icon_html;
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
			}else {                    
				ob_start();
				Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
				$icon_html = ob_get_clean();
			}
		}	
		$settings['icon_html'] = $icon_html;
		$settings['link_attributes'] 		= isset($link) ? pls_core_elementor_get_url_attribute($link) : '';
		pls_core_get_templates( 'elements-widgets/call-to-action', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_CallToAction());