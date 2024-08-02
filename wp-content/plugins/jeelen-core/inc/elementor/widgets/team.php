<?php
/*
Element: Team
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
class PLS_Elementor_Team extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-team';
    }

	/**
     * Get widget title.
     *
     * Retrieve Team widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Team', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Team widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-person';
    }
	
	/**
     * Register Team widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
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
				'placeholder'	=> esc_html__( 'Enter member name', 'pls-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label' 		=> esc_html__( 'Designation', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter member designation', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Member Avatar', 'pls-core' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
				'description'	=> esc_html__( 'Select image from media library.', 'pls-core' ),
			]
		);
		$repeater->add_control(
			'twitter',
			[
				'label' 		=> esc_html__( 'Twitter link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'facebook',
			[
				'label' 		=> esc_html__( 'Facebook link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label' 		=> esc_html__( 'Linkedin link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'skype',
			[
				'label' 		=> esc_html__( 'Skype link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'instagram',
			[
				'label' 		=> esc_html__( 'Instagram link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'youtube',
			[
				'label' 		=> esc_html__( 'Youtube Link', 'pls-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
            'team_members',
            [
                'label' 	=> esc_html__( 'Team Members', 'pls-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'name' 			=> 'Nimrod Barshad',
						'designation' 	=> 'Founder/CEO',						
						'twitter' 		=> '#',
						'facebook' 		=> '#',
						'linkedin' 		=> '#',
					],
					[
						'name' 			=> 'Claude K. Amadeo',
						'designation' 	=> 'Sales Director',
						'twitter' 		=> '#',
						'facebook' 		=> '#',
						'linkedin' 		=> '#',
					],
					[
						'name' 			=> 'Linda M. Dugan',
						'designation' 	=> 'Manager',
						'twitter' 		=> '#',
						'facebook' 		=> '#',
						'linkedin' 		=> '#',
					],
					[
						'name' 			=> 'Mark Pocket',
						'designation' 	=> 'Product Manager',
						'twitter' 		=> '#',
						'facebook' 		=> '#',
						'linkedin' 		=> '#',
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
				'default' 			=> '4',
				'tablet_default' 	=> '3',
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
					'{{WRAPPER}} .pls-member-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-member-name',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'designation_style_section',
			[
				'label' => esc_html__( 'Designation', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'designation_color',
			[
				'label'     => esc_html__( 'Designation Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} .pls-member-designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .pls-member-designation',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 3,
			'slides_to_show_mobile' => 1,
		]);
		extract( $settings );
		$settings['id'] 	= pls_uniqid( 'pls-team-' );
		$class				= array( 'row', 'pls-element', 'pls-team', 'swiper', 'pls-slider' );
		$settings['class']	= implode( ' ', $class );
		$settings['style'] 	= 'style-1';
		$settings['slider_class'] 	= 'swiper-wrapper';
		$settings['slider_class'] 	.= ' slider-col-lg-' .$slides_to_show;
		$settings['slider_class'] 	.= ' slider-col-md-' .$slides_to_show_tablet;
		$settings['slider_class'] 	.= ' slider-col-' .$slides_to_show_mobile;
		$settings['slider_options'] 	= pls_slider_attributes( $settings);
		pls_core_get_templates( 'elements-widgets/team', $settings );
	}
}

$widgets_manager->register( new PLS_Elementor_Team() );