<?php
/*
Element: Accordion
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
class PLS_Elementor_Accordion extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-accordion';
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
        return esc_html__( 'Accordion', 'pls-core' );
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
		return [ 'accordion', 'tabs', 'toggle' ];
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
				'label'     => esc_html__( 'Accordion', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => esc_html__( 'Title & Description', 'pls-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Accordion Title', 'pls-core' ),
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
				'default' => esc_html__( 'Accordion Content', 'pls-core' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Accordion Items', 'pls-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' 	=> esc_html__( 'Accordion #1', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
					[
						'tab_title' 	=> esc_html__( 'Accordion #2', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
					[
						'tab_title' 	=> esc_html__( 'Accordion #3', 'pls-core' ),
						'tab_content' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pls-core' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
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
				'default' 		=> 'left',
				'description' 	=> esc_html__( 'Select tabs section title alignment.', 'pls-core' ),
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Position', 'pls-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' 	=> esc_html__( 'Left', 'pls-core' ),
					'right' 	=> esc_html__( 'Right', 'pls-core' ),
				],
				'default' => 'right',
				'description' 	=> esc_html__( 'Select accordion navigation icon position.', 'pls-core' ),	
			]
		);
		$this->add_control(
			'toggle',
			[
				'label'     => esc_html__( 'Allow Toggle?', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pls-accordion .card-header .card-title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' 	=> esc_html__( 'Padding', 'pls-core' ),
				'type'		=> Controls_Manager::SLIDER,
				'range'		=> [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
				'selectors' => [
					'{{WRAPPER}} .pls-accordion .card-link' => 'padding-top: {{SIZE}}px; padding-bottom: {{SIZE}}px;',
				],
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .pls-accordion .card-body',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' 	=> esc_html__( 'Padding', 'pls-core' ),
				'type'		=> Controls_Manager::SLIDER,
				'range'		=> [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
				'selectors' => [
					'{{WRAPPER}} .pls-accordion .accordion-tab-content' => 'padding-bottom: {{SIZE}}px;',
				],
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		
		extract( $settings );
		$settings['id'] 	= pls_uniqid( 'pls-accordion-' );
		$class				= array( 'pls-element', 'pls-accordion', 'panel-group' );
		$class[]			= 'align-'.$alignment;
		$class[]			= 'icon-position-'.$icon_position;
		if( $toggle ){
			$class[]			= 'pls-toggle-accordion';
		}
		$settings['class'] 	= implode( ' ', array_filter( $class ) );
		$settings['toggle_class']			= 'default';
		if($toggle){
			$settings['toggle_class']			= 'toggle';
		}
		
		$data_parent 		= 'data-parent="#'.$settings['id'].'"';
		if( $toggle ){
			$data_parent = '';
		}
		$settings['data_parent'] 	= $data_parent;
		
		$id_int = substr( $this->get_id_int(), 0, 3 );
		$settings['id_int'] 	= $id_int;
		pls_core_get_templates( 'elements-widgets/accordion', $settings );
	}
}

$widgets_manager->register( new PLS_Elementor_Accordion() );