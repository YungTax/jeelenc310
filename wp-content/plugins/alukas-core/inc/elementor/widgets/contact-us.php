<?php
/*
Element: Contact Us
*/
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class PLS_Elementor_Contactus extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-contactus';
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
        return esc_html__( 'Contact Us', 'pls-core' );
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
        return 'pls-icon eicon-form-horizontal';
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
		$form_list = pls_core_get_posts_dropdown( 'wpcf7_contact_form', esc_html__( 'Select Contact Form', 'pls-core' ) );
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Contact Us' , 'pls-core'),
            ]
        );
		$this->add_control(
            'description',
            [
                'label' 	=> esc_html__('Description', 'pls-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$this->add_control(
            'form_id',
            [
                'label' 	=> esc_html__( 'Select Form', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $form_list,
				'default'	=> ' ',
            ]
        );
		$this->add_control(
            'form_shape',
            [
                'label'		=> esc_html__( 'Form Field Shape', 'pls-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'shape-round'	=> esc_html__( 'Round', 'pls-core' ),
					'shape-square'	=> esc_html__( 'Square', 'pls-core' ),
				],
                'default'	=> 'shape-square',
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
					'{{WRAPPER}} .pls-contact-us h3' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-contact-us h3',
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
					'{{WRAPPER}} .pls-contact-us .form-description' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-contact-us .form-description',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings 			= $this->get_settings();
		$class				= array( 'pls-element', 'pls-contact-us' );
		$class[]			= $settings['form_shape'];
		$settings['class']	= implode( ' ', $class );	
		pls_core_get_templates( 'elements-widgets/contact-us', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_Contactus());