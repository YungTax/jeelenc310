<?php
/*
Element: Menu Block
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class PLS_Elementor_MenuBlock extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-menu-block';
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
        return esc_html__( 'Mega Menu Item', 'pls-core' );
    }

    /**
     * Get widget icon.
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-editor-list-ul';
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
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> esc_html__('Menu Item', 'pls-core'),
            ]
        );
		$this->add_control(
			'link',
			[
				'label' 	=> esc_html__( 'Link', 'pls-core' ),
				'type' 		=> Controls_Manager::URL,				
				'default' 	=> [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
		$this->add_control(
            'label_text',
            [
                'label' 	=> esc_html__('Label', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]
        );
		$this->add_control(
            'label_color',
            [
                'label' 	=> esc_html__( 'Label Color', 'pls-core' ),
                'type' 		=> Controls_Manager::COLOR,                
                'selectors' => [
					
                    '{{WRAPPER}} .pls-megamenu-list > li > a > .pls-menu-badge' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .pls-megamenu-list > li > a > .pls-menu-badge:before' => 'border-color: {{VALUE}};'
                ],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
            'pls_submenu_section',
            [
                'label' => esc_html__( 'Submenu Item', 'pls-core' ),
            ]
        );
		
		$repeater = new Repeater();
		$repeater->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]
        );
		$repeater->add_control(
			'link',
			[
				'label' 	=> esc_html__( 'Link', 'pls-core' ),
				'type' 		=> Controls_Manager::URL,				
				'default' 	=> [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
		$repeater->add_control(
            'label_text',
            [
                'label' 	=> esc_html__('Label', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]
        );
		$repeater->add_control(
            'label_color',
            [
                'label' 	=> esc_html__( 'Label Color', 'pls-core' ),
                'type' 		=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:before' => 'border-color: {{VALUE}}'
                ],
            ]
        );
		$this->add_control(
            'menu_items',
            [
                'label' 	=> esc_html__('Menu Item','pls-core'),
                'type' 		=> Controls_Manager::REPEATER,
                'fields' 	=> $repeater->get_controls(),
                'default'	=> [
					[
						'title'	=> 'Menu Item 1',						
						'link' 	=> [
							'url'         => '#',
							'is_external' => false,
							'nofollow'    => false,
						],
					],
					[
						'title'	=> 'Menu Item 2',						
						'link'	=> [
							'url'         => '#',
							'is_external' => false,
							'nofollow'    => false,
						],
					],
					[
						'title'	=> 'Menu Item 3',						
						'link'	=> [
							'url'         => '#',
							'is_external' => false,
							'nofollow'    => false,
						],
					],
				],
                'title_field' => '{{{ title }}}',
            ]
        );
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		if ( empty( $settings['menu_items'] ) ) {
			return;
		}
		$settings['id'] 	= pls_uniqid('pls-list-');
		$class				= array( 'pls-element', 'pls-menu-block' );		 
			
		$settings['class'] 	= implode(' ', array_filter( $class ) );		
		
		pls_core_get_templates( 'elements-widgets/menu-block', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_MenuBlock());