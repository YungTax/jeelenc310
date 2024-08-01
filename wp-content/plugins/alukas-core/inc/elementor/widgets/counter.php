<?php
/*
Element: Counter
*/
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
class PLS_Elementor_Counter extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-counter';
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
        return esc_html__( 'Counter', 'pls-core' );
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
        return 'pls-icon eicon-counter';
    }
	
	public function get_script_depends() {
       return [ 'counterup' ];
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
            'content_section',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'counter_title',
            [
                'label'			=> esc_html__('Counter Title', 'pls-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__('Happy Customer', 'pls-core'),
				'description'	=> esc_html__( 'Enter title for stats counter block.', 'pls-core' ),
            ]
        );

        $this->add_control(
            'counter_value',
            [
                'label'			=> esc_html__( 'Counter Value', 'pls-core' ),
                'type'			=> Controls_Manager::NUMBER,
				'default'		=> 41,
				'description'	=> esc_html__( 'Enter number for counter without any special character. You may enter a decimal number.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'counter_suffix',
            [
                'label'   	=> esc_html__('Counter Suffix', 'pls-core'),
				'default'	=> 'k+',
                'type' 	  	=> Controls_Manager::TEXT,
            ]
        );
		$this->add_control(
            'counter_prefix',
            [
                'label'   => esc_html__('Counter Prefix', 'pls-core'),
                'type' 	  => Controls_Manager::TEXT,
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
				'label' => esc_html__( 'Counter Title', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_font_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .counter-title',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'counter_value_style_section',
			[
				'label' => esc_html__( 'Counter Value', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'counter_value_font_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
				'selectors' => [
					'{{WRAPPER}} .counter-number' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_value_typography',
				'label'    => esc_html__( 'Typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .counter-number',
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
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> '',
				'condition' => [
					'icon_display_type' => [ 'image' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .counter-icon-wrap img' => 'width: {{VALUE}}px;',
                ],
            ]
        );
		$this->add_responsive_control(
            'icon_size',
            [
                'label' 	=> esc_html__('Icon Size', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> '48',
				'condition' => [
					'icon_display_type' => [ 'font' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'font-size: {{VALUE}}px;',
                ],
            ]
        );
		
		$this->add_control(
            'icon_color',
            [
                'label' 	=> esc_html__( 'Icon Color', 'pls-core' ),
                'type' 		=> Controls_Manager::COLOR,
				'default'	=> pls_core_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .counter-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition' => [
					'icon_display_type' => [ 'font' ],
				],
            ]
        );
		$this->add_control(
            'icon_position',
            [
                'label' 	=> esc_html__('Icon Position', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'top'	=> esc_html__( 'Top', 'pls-core' ),
					'left'	=> esc_html__( 'Left', 'pls-core' ),
					'right'	=> esc_html__( 'Right', 'pls-core' ),
				],
				'default'	=> 'top',
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
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .counter-icon' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_control(
            'icon_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'border-color: {{VALUE}};',
                ],
				'condition' => [
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				
            ]
		);
		$this->add_control(
            'icon_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> 1,
				'condition' => [
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'border-width: {{VALUE}}px;',
                ],
            ]
		);
		$this->add_control(
            'icon_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT, 
				'default'	=> 500,
				'condition' => [
					'icon_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'border-radius: {{VALUE}}px;',
                ],
				
            ]
		);
		$this->add_control(
            'icon_bg_size',
            [
                'label' 	=> esc_html__('Background Size(px)', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT, 
				'default'	=> 50,
				'condition' => [
					'icon_style' => [ 'icon-custom' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'width: {{VALUE}}px; height: {{VALUE}}px; line-height: {{VALUE}}px;',
                ],
            ]
		);
		
		$this->end_controls_section();
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 		= pls_uniqid( 'pls-info-box-' );
		$class					= array( 'pls-element', 'pls-counter', $icon_style, 'icon-'.$icon_position );		
		$settings['class'] 		= implode( ' ', array_filter( $class ) );
		
		
		
		$icon_html 			= '';
		if( $icon_display_type !== '' ){
			if ( $icon_display_type == 'image' ) {
				if ( isset( $settings['icon_image']['id'] ) && $settings['icon_image']['id'] ) {
					$icon_image_src = pls_get_image_src($settings['icon_image']['id'],'full');
					$icon_html 		= '<img src=" '. esc_url($icon_image_src) .' " alt="'.$counter_title.'"/>';
				}elseif( !empty($settings['icon_image']['url'])){
					$icon_image_src = $settings['icon_image']['url'];
					$icon_html 		= '<img src=" '. esc_url($icon_image_src) .' " alt="'.$counter_title.'"/>';
				}
			}else {                    
				ob_start();
				Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
				$icon_html = ob_get_clean();
			}

		}	
		$settings['icon_html'] = $icon_html;	
		
		pls_core_get_templates( 'elements-widgets/counter', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_Counter());