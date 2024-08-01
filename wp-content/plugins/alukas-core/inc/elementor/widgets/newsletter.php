<?php
/*
Element: Newsletter
*/
use Elementor\Controls_Manager;
class PLS_Elementor_Newsletter extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-newsletter';
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
        return esc_html__( 'Newsletter', 'pls-core' );
    }

    /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-mailchimp';
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
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'subscribe_form_style',
            [
                'label'		=> esc_html__( 'Form Style', 'pls-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'simple-form'	=> esc_html__( 'Simple Form', 'pls-core' ),
					'overlay-form'	=> esc_html__( 'Overlay Form', 'pls-core' ),
				],
                'default'	=> 'simple-form',
            ]
        );
		$this->add_control(
            'subscribe_form_shape',
            [
                'label'		=> esc_html__( 'Form Field Shape', 'pls-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'shape-square'	=> esc_html__( 'Square', 'pls-core' ),
					'shape-round'	=> esc_html__( 'Round', 'pls-core' ),
				],
                'default'	=> 'shape-square',
            ]
        );
		$this->add_responsive_control(
            'subscribe_form_alignment',
            [
                'label'		=> esc_html__( 'Alignment', 'pls-core' ),
                'type'		=> Controls_Manager::CHOOSE,
                'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'pls-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'pls-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'pls-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors'	=> [
                    '{{WRAPPER}} .mc4wp-form' => 'align-items: {{VALUE}};'
                ],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Newsletter Settings', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'newsletter_border_color',
            [
                'type'		=> Controls_Manager::COLOR,                
                'label'		=> esc_html__( 'Border Color', 'pls-core' ),
				'description' => esc_html__( 'Select input fields border color.', 'pls-core' ),
                'selectors'	=> [
                    '{{WRAPPER}} .mc4wp-form-fields input:not(input[type="checkbox"]):not(input[type="submit"]), {{WRAPPER}}  .mc4wp-form-fields select' => 'border-color: {{VALUE}};'
                ],
            ]
        );
		
		$this->start_controls_tabs( 'newsletter_buttons_colors' );

        $this->start_controls_tab(
            'newsletter_buttons_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'pls-core' ),                
            ]
        );
		$this->add_control(
            'button_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-newsletter input[type="submit"]' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_text_color',
            [
                'label'		=> esc_html__('Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-newsletter input[type="submit"]'	=> 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->start_controls_tab(
            'newsletter_buttons_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'button_bg_hover_color',
            [
                'label'		=> esc_html__( 'Background Color', 'pls-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-newsletter input[type="submit"]:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_text_hover_color',
            [
                'label' 	=> esc_html__('Color', 'pls-core'),
				'type'		=> Controls_Manager::COLOR,
                'default'	=> pls_core_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .pls-newsletter input[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->end_controls_tabs();
		
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings	= $this->get_settings();
		$class		= array( 'pls-element', 'pls-newsletter' );
		$class[]	= $settings['subscribe_form_style'];
		$class[]	= $settings['subscribe_form_shape'];
		
		
		$settings['class']	= implode( ' ', $class );
		
		pls_core_get_templates( 'elements-widgets/newsletter', $settings );
	}
}
$widgets_manager->register( new PLS_Elementor_Newsletter() );