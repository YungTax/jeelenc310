<?php
/*
Element: Social Buttons
*/
use Elementor\Controls_Manager;
class PLS_Elementor_SocialButton extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-social-buttons';
    }

	/**
     * Get widget title.
     *
     * Retrieve Social Buttons widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Social Buttons', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Social Buttons widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-social-icons';
    }
	
	/**
     * Register Social Buttons widget controls.
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
            'social_type',
            [
                'label' 	=> esc_html__('Social Type', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'share'		=> esc_html__( 'Share', 'pls-core' ),
					'profile'	=> esc_html__( 'Profile', 'pls-core' ),
				],
				'default'	=> 'share',
            ]
		);
		$this->add_control(
            'social_style',
            [
                'label' 	=> esc_html__('Icons Style', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icons-default'			=> esc_html__( 'Default', 'pls-core' ),
					'icons-colour'	    	=> esc_html__( 'Colour', 'pls-core' ),
				],
				'default'	=> 'icons-default',
            ]
		);
		$this->add_control(
            'social_icon_size',
            [
                'label' 	=> esc_html__('Icons Size', 'pls-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icons-size-default'	=> esc_html__( 'Default', 'pls-core' ),
					'icons-size-small'	    => esc_html__( 'Small', 'pls-core' ),
					'icons-size-large'	    => esc_html__( 'Large', 'pls-core' ),
				],
				'default'	=> 'icons-size-default',
            ]
		);
		$this->add_control(
            'social_alignment',
            [
                'label' 	=> esc_html__('Alignment', 'pls-core'),
                'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> $this->alignment_options(),
				'default'	=> 'left',
            ]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings['id']		= pls_uniqid( 'pls-social-button-' );
		$class				= array( 'pls-element', 'pls-social-button-wrap', 'pls-social-buttons' );
		$class[]			= 'text-'.$settings['social_alignment'];
		$settings['class']	= implode( ' ', $class );	
		pls_core_get_templates( 'elements-widgets/social-buttons', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_SocialButton());