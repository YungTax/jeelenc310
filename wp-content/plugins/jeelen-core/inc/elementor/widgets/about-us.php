<?php
/*
Element: About Us
*/
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
class PLS_Elementor_About_Us extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-about-us';
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
        return esc_html__( 'About Us', 'pls-core' );
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
        return 'pls-icon eicon-icon-box';
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
		return [ 'About Us', 'Contact us' ];
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
            'pls_info_box_section',
            [
                'label'		=> esc_html__( 'General', 'pls-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label'			=> esc_html__('Title', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Store Details', 'pls-core'),
				'label_block'	=> true,
            ]
        );
		$this->add_control(
			'logo',
			[
				'label'     => esc_html__( 'Choose image', 'pls-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' 	=> [
					'url'	=> Utils::get_placeholder_image_src(),
				]
			]
		);
		$this->add_control(
            'site_url',
            [
                'label'			=> esc_html__('Site Url', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );		
		$this->add_control(
			'link',
			[
				'label' 		=> esc_html__( 'Add Link', 'pls-core' ),
				'type'  		=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'pls-core' ),
				'default'		=> [
					'url'		=> '#',
				],
				'condition' 	=> [
					'apply_to_link'	=> [ 'complete_box','box_title','display_read_more' ],
				],
			]
		);
		$this->add_control(
            'support_icon',
            [
                'label' 	=> esc_html__('Icon', 'pls-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'picon-earphones',
					'library' => 'pls-icons',
				],
            ]
		);
		$this->add_control(
            'support_text',
            [
                'label'			=> esc_html__('Support Text', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'support_number',
            [
                'label'			=> esc_html__('Support Number', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'tagline',
            [
                'label'			=> esc_html__('About Tagline', 'pls-core'),
				'type'			=> Controls_Manager::TEXTAREA,
                'default'		=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'pls-core'),
                'label_block'	=> true,
            ]
        );	
		$this->add_control(
            'address',
            [
                'label'			=> esc_html__('Address', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'phone_number',
            [
                'label'			=> esc_html__('Phone Number', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'fax_number',
            [
                'label'			=> esc_html__('Fax Number', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'email_address',
            [
                'label'			=> esc_html__('Email', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'website',
            [
                'label'			=> esc_html__('Website', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->add_control(
            'days_hours',
            [
                'label'			=> esc_html__('Working Days/Hours', 'pls-core'),
                'type'			=> Controls_Manager::TEXT,
				'default'		=> '',
				'label_block'	=> true,
            ]
        );
		$this->end_controls_section();
		
		/**
		 * About Us settings.
		 */
		$this->start_controls_section(
			'about_us_style_section',
			[
				'label' => esc_html__( 'About Us', 'pls-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
				'description' 	=> esc_html__( 'Select about us alignment.', 'pls-core' ),
			]
		);
		$this->end_controls_tab();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 		= pls_uniqid( 'pls-about-us-' );
		$class					= array( 'pls-element', 'pls-about-us','about-us-widget' );
		$class[]				= 'text-'.$alignment;
		$settings['class'] 		= implode(' ',array_filter($class));
		$support_icon 			= '';			
		ob_start();
		Icons_Manager::render_icon( $settings['support_icon'], [ 'aria-hidden' => 'true' ]  );
		$support_icon = ob_get_clean();
		
		$logo_html 			= '';
		if ( isset( $settings['logo']['id'] ) && $settings['logo']['id'] ) {
			$icon_image_src = pls_get_image_src( $settings['logo']['id'], 'full' );
			$logo_html 		= '<img src="'. esc_url($icon_image_src) .'" alt="'.strip_tags( $title_text ).'"/>';
		}
		$settings['support_icon'] = $support_icon;		
		$settings['logo_html'] = $logo_html;		
		$settings['our_site_url'] = !empty($site_url) ? $site_url : '#' ;		
		
		
		pls_core_get_templates( 'elements-widgets/about-us', $settings );
	}
}

$widgets_manager->register(new PLS_Elementor_About_Us());