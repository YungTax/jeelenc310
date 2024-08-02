<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

class PLS_Elementor_Heading extends  PLS_Elementor_Widget_Base{
    /**
     * Get widget name.
     * @return string Widget name.
     */
    public function get_name() {
        return 'pls-heading';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Heading', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-heading';
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
		return [ 'heading', 'title' ];
	}
	
    /**
     * Register tabs widget controls.
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__( 'Heading', 'pls-core' ),
            ]
        );		
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> esc_html__('Heading Text Here', 'pls-core'),
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' 	=> esc_html__( 'Title HTML Tag', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
                    'h1' 	=> 'H1',
                    'h2' 	=> 'H2',
                    'h3' 	=> 'H3',
                    'h4' 	=> 'H4',
                    'h5' 	=> 'H5',
                    'h6' 	=> 'H6',
                    'div' 	=> 'div',
                    'span'	=> 'span',
                    'p' 	=> 'p',
                ],
                'default' 	=> 'h2',
            ]
        );		
		$this->add_control(
            'sub_title',
            [
                'label' 	=> esc_html__('Sub Title', 'pls-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]

		); 
        $this->add_control(
            'tagline',
            [
                'label' 	=> esc_html__('Tagline', 'pls-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
				'default' 	=> esc_html__('Enter Tagline text here', 'pls-core'),
            ]
        );		
        $this->add_responsive_control(
            'title_align',
            [
                'label' 	=> esc_html__('Alignment', 'pls-core'),
                'type' 		=> Controls_Manager::CHOOSE,
                'options' 	=> $this->alignment_options(),
                'default' 	=> 'center',
				'selectors'		=> [
					'{{WRAPPER}} .pls-heading' => 'text-align: {{VALUE}};',
				],
            ]
        );		
		$this->add_responsive_control(
            'title_width',
            [
                'label' 	=> esc_html__('Title Width', 'pls-core'),
				'type'			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range'			=> [ 
					'px' 	=> [ 'min' => 0, 'max' => 1600,'step' => 1 ], 
					'%' 	=> [ 'min' => 1,'max' => 100 ] 
				],
				'default' 		=> [ 'unit' => '%', 'size' => 100 ],
				'selectors'		=> [
					'{{WRAPPER}} .pls-heading' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
            ]

		);     
        $this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'title_style_section',
			[
				'label'	=> esc_html__( 'Title', 'pls-core' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);		
		$this->add_control(
            'title_separator',
            [
                'label' 	=> esc_html__('Separator', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'none'		=> esc_html__( 'None', 'pls-core' ),
					'underline'	=> esc_html__( 'Underline', 'pls-core' ),
					'line'		=> esc_html__( 'Line', 'pls-core' ),
					'image'		=> esc_html__( 'Image', 'pls-core' ),
				],
                'default'	=> 'none',
            ]

		);		
		$this->add_control(
            'underline_color',
            [
                'label' 	=> esc_html__('Underline Color', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'default'	=> esc_html__( 'Default', 'pls-core' ),
					'light'		=> esc_html__( 'Light', 'pls-core' ),						
					'dark'		=> esc_html__( 'Dark', 'pls-core' ),
				],
                'default' 	=> 'default',
				'condition' => [
					'title_separator' => [ 'underline' ],
				],
            ]

		);		
		$this->add_control(
            'separator_line_style',
            [
                'label' 	=> esc_html__('Line Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'solid'		=> esc_html__( 'Solid', 'pls-core' ),
					'dashed'	=> esc_html__( 'Dashed', 'pls-core' ),
					'dotted'	=> esc_html__( 'Dotted', 'pls-core' ),
					'double'	=> esc_html__( 'Double', 'pls-core' ),
					'inset'		=> esc_html__( 'Inset', 'pls-core' ),
					'outset'	=> esc_html__( 'Outset', 'pls-core' ),
				],
                'default' 	=> 'solid',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);		
		$this->add_control(
            'separator_line_width',
            [
                'label' 	=> esc_html__('Line Width', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '1',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);		
		$this->add_control(
            'separator_line_color',
            [
                'label' 	=> esc_html__('Line Color', 'pls-core'),
                'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .separator-left,{{WRAPPER}} .separator-right' => 'border-bottom-color: {{VALUE}}',
				],
                'default' 	=> '#e5e5e5',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);		
		$this->add_control(
            'separator_image',
            [
                'label' 	=> esc_html__('Select Image', 'pls-core'),
                'type' 		=> Controls_Manager::MEDIA,
				'condition' => [
					'title_separator' => [ 'image' ],
				],
            ]

		);		
		$this->add_control(
            'separator_image_width',
            [
                'label' 	=> esc_html__('Image Width', 'pls-core'),
				'type' 			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 1600 ] ],
				'label_block' 	=> true,
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 150,
				],
				'selectors' => [
                    '{{WRAPPER}} .heading-wrap .image-separator img' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'title_separator' => [ 'image' ],
				],
            ]

		);		
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-title' => 'color: {{VALUE}}',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .heading-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .heading-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Subtitle settings.
		 */
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
					'{{WRAPPER}} .heading-subtitle' => 'color: {{VALUE}}',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .heading-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .heading-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Tagline settings.
		 */
		$this->start_controls_section(
			'tagline_style_section',
			[
				'label' => esc_html__( 'Tagline', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);		
		$this->add_control(
			'tagline_color',
			[
				'label'     => esc_html__( 'Color', 'pls-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-tagline' => 'color: {{VALUE}}',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tagline_typography',
				'label'    => esc_html__( 'Custom typography', 'pls-core' ),
				'selector' => '{{WRAPPER}} .heading-tagline',
			]
		);
		$this->add_responsive_control(
			'tagline_margin',
			[
				'label'			=> esc_html__( 'Margin Top', 'pls-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .heading-tagline' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
    }
	
	protected function render() {
		
		$settings = $this->get_settings();
		
		if( $settings['separator_image'] ){
			if ( isset( $settings['separator_image']['id'] ) && $settings['separator_image']['id'] ) {
				$separator_image_src 				= pls_get_image_src($settings['separator_image']['id'],'full');
				$settings['separator_image_src']	= $separator_image_src;
			}
		}
		
		$settings['separator_class']	= ( 'underline' == $settings['title_separator'] && 'default' != $settings['underline_color'] ) ? ' color-scheme-'.$settings['underline_color'] : '';
		$settings['id'] 				= pls_uniqid('pls-header-');
		$settings['class']				= 'pls-element pls-heading separator-'.$settings['title_separator'];
		
		/* Dynamic Css */
		$title_css 							= array();
		$style_css 							= '';
		$title_css['separator'][] 			= ( !empty($settings['separator_line_style']) && 'underline' != $settings['title_separator'] )  ? 'border-bottom-style:'.$settings['separator_line_style'] : '';
		$title_css['separator'][] 			= ( !empty($settings['separator_line_style']) && 'underline' != $settings['title_separator'] ) ? 'border-bottom-width:'.$settings['separator_line_width'].'px' : '' ;
				
		if( ! empty( array_filter( $title_css['separator'] ) ) ){
			$style_css .= '#'.$settings['id'].' .separator-left,#'.$settings['id'].' .separator-right {';
			$style_css .=  implode('; ', array_filter($title_css['separator']) );
			$style_css .= '}';
		}
		
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() ){
			echo '<style>'.esc_attr($style_css).'</style>';
		} else {
			pls_add_custom_css( $style_css );
		}		
		pls_core_get_templates( 'elements-widgets/heading', $settings );		
	}

}
$widgets_manager->register(new PLS_Elementor_Heading());