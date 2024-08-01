<?php
/*
Element: Button
*/

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

class PLS_Elementor_Button extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-button';
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
        return esc_html__( 'Button', 'pls-core' );
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
        return 'pls-icon eicon-button';
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
            'pls_button_section',
            [
                'label'		=> esc_html__( 'General', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'text',
            [
                'label' 		=> esc_html__('Button Text', 'pls-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__('Click here', 'pls-core'),
				'placeholder' 	=> esc_html__('Button text here', 'pls-core'),
            ]
        );
		
		$this->add_control(
			'button_link',
			[
				'label'	 	 	=> esc_html__( 'Link', 'pls-core' ),
				'type' 		 	=> Controls_Manager::URL,
				'dynamic' 	 	=> [
					'active' => true,
				],
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'pls-core' ),
				'default' 	 	=> [
					'url'	=> '#',
				],
			]
		);
		
		$this->add_responsive_control(
			'align',
			[
				'label' 	=> esc_html__( 'Alignment', 'pls-core' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options'	=> $this->alignment_options(),
				'selectors'	=> [
                    '{{WRAPPER}} .pls-button' => 'text-align: {{VALUE}};',
                ],
				'default' 	=> 'left',
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
					'right'	=> esc_html__( 'Right', 'pls-core' ),
					'left'	=> esc_html__( 'Left', 'pls-core' ),
				],
                'default' 	=> 'right',
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);
		
		$this->add_control(
            'selected_icon',
            [
                'label' 	=> esc_html__('Icon', 'pls-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'lnr lnr-chevron-right',
					'library' => 'linearicons-icons',
				],
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);
		
		$this->end_controls_section();
		
		/**
		 * Title settings.
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
                'label' 	=> esc_html__('Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'flat'		=> esc_html__( 'Flat', 'pls-core' ),
					'outline'	=> esc_html__( 'Outline', 'pls-core' ),
					'link'	  	=> esc_html__( 'Link', 'pls-core' ),
					'text'		=> esc_html__( 'Text', 'pls-core' ),
				],
                'default' 	=> 'flat',
            ]
		);
		
		$this->add_control(
            'shape',
            [
                'label' 	=> esc_html__('Shape', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'square'	=> esc_html__( 'Square', 'pls-core' ),
					'rounded'	=> esc_html__( 'Rounded', 'pls-core' ),
					'round'		=> esc_html__( 'Round', 'pls-core' ),
				],
                'default' 	=> 'square',
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
		
		$this->start_controls_tabs( 'buttons_colors' );

        $this->start_controls_tab(
            'custom_buttons_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'pls-core' ),                
            ]
        );
		$this->add_control(
            'button_text_color',
            [
                'label'		=> esc_html__('Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-button .btn-style-flat, {{WRAPPER}} .pls-button .btn-style-link, {{WRAPPER}} .pls-button .btn-style-text'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} .pls-button .btn-style-link:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pls-button a > svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-button .btn-style-flat' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pls-button .btn-style-outline' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pls-button .btn-style-outline' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pls-button .btn-style-outline svg' => 'fill: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'link', 'text' ],
				]
            ]
        );
		$this->end_controls_tab();

        $this->start_controls_tab(
            'custom_buttons_colors_hover',
            [
                'label' 	=> esc_html__( 'Hover', 'pls-core' ),
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
					'{{WRAPPER}} .pls-button a:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pls-button .btn-style-link:hover:after' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pls-button .btn-style-outline:hover' => 'border-color: {{VALUE}};',
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
		$icon_html 			= '';
		if( $settings['button_icon'] ) {			
			ob_start();
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
			$icon_html = ob_get_clean();
		}
		$settings['id'] 	= pls_uniqid('pls-button-');
		$settings['class'] 	= 'pls-element pls-button';
		
		$button_class			= array( );
		if( $button_style != 'text' ){
			$button_class[] = 'button';
		}
		$button_class[]			= 'btn-style-'.$button_style;
		if( 'flat' == $button_style || 'outline' == $button_style ){
			$button_class[]			= 'btn-shape-'.$shape;
		}
		$button_class[]				= !empty ( $settings['button_icon'] ) ? 'btn-icon-'.$settings['icon_alignment'] : '';
		$settings['button_class']	= implode(' ', array_filter( $button_class ) );
		$settings['icon_html'] 		= $icon_html;
		$settings['link_url'] 		= $settings['button_link']['url'];
		$settings['target'] 		= $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$settings['nofollow']		= $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';		
		pls_core_get_templates( 'elements-widgets/button', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_Button());