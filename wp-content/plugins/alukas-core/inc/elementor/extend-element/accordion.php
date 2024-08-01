<?php
/**
 * Elementor Extend Accordion control.
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
add_action( 'elementor/element/accordion/section_title_style/before_section_end', 'pls_core_accordion_title_style_extend', 10, 2 );
add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end','pls_core_accordion_toggle_style_title_extend', 10, 2 );

function pls_core_accordion_title_style_extend( $element, $args ){
	
	$element->update_control(
        'border_width',
        [
            'selectors' => [
				'{{WRAPPER}} .elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',				
                '{{WRAPPER}} .elementor-accordion-item + .elementor-accordion-item' => 'border: {{SIZE}}{{UNIT}} solid {{border_color.VALUE}};',
            ],
        ]
    );
	$element->update_control(
        'border_color',
        [
            'default' => '#d4d4d4',
        ]
    );
	$element->add_control(
        'title_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'pls-core' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;',
            ],
        ]
    );
	
    $element->add_responsive_control(
        'title_margin_bottom',
        [
            'label'			=> esc_html__( 'Margin Bottom', 'pls-core' ),
			'label_block'	=> true,
			'type'			=> Controls_Manager::SLIDER,
			'range'			=> [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 5,
				],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'margin-bottom: {{SIZE}}px',
            ],
        ]
    );
}

function pls_core_accordion_toggle_style_title_extend( $element, $args ){
	$element->add_control(
        'title_background_active',
        [
            'label' => esc_html__( 'Active Background Color', 'pls-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
            ],
        ]
    );
}