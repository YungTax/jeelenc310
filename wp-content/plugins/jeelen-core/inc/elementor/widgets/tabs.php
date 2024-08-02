<?php
/*
Element: Tab
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
class PLS_Elementor_Tabs extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-tabs';
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
        return esc_html__( 'Tabs', 'pls-core' );
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
        return 'pls-icon eicon-accordion';
    }
	
	/**
	 * Get widget keywords.
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [  'tabs', 'accordion','toggle' ];
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
			'section_title',
			array(
				'label'     => esc_html__( 'Tabs', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => esc_html__( 'Title & Description', 'pls-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Title', 'pls-core' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => esc_html__( 'Content', 'pls-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Tab Content', 'pls-core' ),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'tab_icon',
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
					'tab_icon' => 'yes'
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
					'tab_icon' => 'yes'
				],
            ]
		);		
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Tab Items', 'pls-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' 	=> esc_html__( 'Tab #1', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
					[
						'tab_title' 	=> esc_html__( 'Tab #2', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
					[
						'tab_title' 	=> esc_html__( 'Tab #3', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Tabs', 'pls-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_alignment',
			[
				'label' => esc_html__( 'Alignment', 'pls-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' 		=> esc_html__( 'Left', 'pls-core' ),
					'center' 	=> esc_html__( 'Center', 'pls-core' ),
					'right' 	=> esc_html__( 'Right', 'pls-core' ),
				],
				'default' => 'center',
				'description' 	=> esc_html__( 'Select tabs section title alignment.', 'pls-core' ),				
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label'			=> esc_html__( 'Tab Gap', 'pls-core' ),
				'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 5, 'max' => 50 ] ],
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .nav-tabs .nav-item' => 'margin-left: {{SIZE}}px; margin-right: {{SIZE}}px',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => esc_html__( 'Title', 'pls-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .nav-link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pls-tabs .nav-link svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .nav-link.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pls-tabs .nav-link:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pls-tabs .nav-link.active svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .pls-tabs .nav-link:hover svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .pls-tabs .nav-link:after' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pls-tabs .nav-tabs .nav-link',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => esc_html__( 'Content', 'pls-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_alignment',
			[
				'label' 		=> esc_html__( 'Alignment', 'pls-core' ),
				'description' 	=> esc_html__( 'Select tabs content alignment.', 'pls-core' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'left' 		=> esc_html__( 'Left', 'pls-core' ),
					'center' 	=> esc_html__( 'Center', 'pls-core' ),
					'right' 	=> esc_html__( 'Right', 'pls-core' ),
				],
				'default' 		=> 'left',
				'selectors' 	=> [
					'{{WRAPPER}} .tab-content > .tab-pane' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .tab-content > .tab-pane' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .pls-tabs .tab-content',
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label'			=> esc_html__( 'Width', 'pls-core' ),
				'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 30, 'max' => 100 ] ],
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .tab-content' => 'width: {{SIZE}}%',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'pls-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pls-tabs .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		
		extract( $settings );
		$settings['id'] 	= pls_uniqid('pls-tabs-');
		$class				= array( 'pls-element', 'pls-tabs' );
		$class[]			= 'align-'.$title_alignment;	
		$settings['class'] 	= implode( ' ', array_filter( $class ) );		
		$id_int = substr( $this -> get_id_int(), 0, 3 );
		$settings['id_int'] 	= $id_int;
		
		pls_core_get_templates( 'elements-widgets/tabs', $settings );
	}
}

$widgets_manager->register( new PLS_Elementor_Tabs() );