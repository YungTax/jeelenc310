<?php
/*
Element: Instagram
*/
use Elementor\Controls_Manager;
class PLS_Elementor_Instagram extends PLS_Elementor_Widget_Base {
	
	public $access_token, $new_refresh_token, $option_name = 'pls_instagram_access_token';
	
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-instagram';
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
        return esc_html__( 'Instagram', 'pls-core' );
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
        return 'pls-icon eicon-instagram-gallery';
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
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Layout', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'slider'	=> esc_html__( 'Slider', 'pls-core' ),
					'grid'		=> esc_html__( 'Grid', 'pls-core' ),
				],
                'default' 	=> 'slider',
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Number Of Photos', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 8,
            ]
        );
		$this->add_control(
            'column_gap',
            [
                'label' 	=> esc_html__( 'Columns Gap', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'0'		=> esc_html__( 'None', 'pls-core' ),
					'5'		=> esc_html__( '5', 'pls-core' ),
					'10'	=> esc_html__( '10', 'pls-core' ),
					'15'	=> esc_html__( '15', 'pls-core' ),
				],
				'default' 	=> '10',
				'selectors' => [
					'{{WRAPPER}} .section-content.row, {{WRAPPER}} .pls-instagram-wrap.row' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
					'{{WRAPPER}} .pls-instagram-image' => 'padding: {{VALUE}}px',
				],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_image',
			array(
				'label'     => esc_html__( 'Images', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
            'image_source',
            [
                'label' 	=> esc_html__( 'Data Source', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'api'	 => esc_html__( 'API', 'pls-core' ),
					'custom'	 => esc_html__( 'Custom Images', 'pls-core' ),
				],
				'default' 	=> 'custom',
            ]
        );
		$this->add_control(
			'gallery_images',
			[
				'label'			=> esc_html__( 'Gallery Images', 'pls-core' ),
				'type'			=> Controls_Manager::GALLERY,
				'description'	=> esc_html__( 'Select gallery images.', 'pls-core' ),
				'condition' => [
					'image_source'	=> 'custom'
				],
			]
		);
		$this->add_control(
			'show_profile_name',
			[
				'label'     => esc_html__( 'Show Profile Name', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
            'profile_name',
            [
                'label' 	=> esc_html__( 'Profile Name', 'pls-core' ),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> '',
				'condition' => [
					'show_profile_name'	=> 'yes'
				],
            ]
        );
		$this->add_control(
            'profile_link',
            [
                'label' 	=> esc_html__( 'Profile Link', 'pls-core' ),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> '#',
				'condition' => [
					'image_source'	=> 'custom'
				],
            ]
        );		
		$this->add_control(
            'target',
            [
                'label' 	=> esc_html__( 'Open Link In', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'_blank'	=> esc_html__( 'New window', 'pls-core' ),
					'_self'		=> esc_html__( 'Current window', 'pls-core' )
				],
				'default' 	=> '_blank',
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_responsive_control(
			'grid_columns',
			[
				'label'		=> esc_html__( 'Columns', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'pls-core' ),
					'2'		=> esc_html__( '2', 'pls-core' ),
					'3'		=> esc_html__( '3', 'pls-core' ),
					'4'		=> esc_html__( '4', 'pls-core' ),
					'5'		=> esc_html__( '5', 'pls-core' ),
					'6'		=> esc_html__( '6', 'pls-core' ),
					'7'		=> esc_html__( '7', 'pls-core' ),
					'8'		=> esc_html__( '8', 'pls-core' ),
				],
				'default' 			=> '6',
				'tablet_default' 	=> '4',
				'mobile_default' 	=> '2',
				'condition' => [
					'layout'	=> 'grid'
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Slider Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout'	=> 'slider',
				),
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
					'7'		=> esc_html__( '7', 'pls-core' ),
					'8'		=> esc_html__( '8', 'pls-core' ),
				],
				'default' 			=> '6',
				'tablet_default' 	=> '4',
				'mobile_default' 	=> '2',
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
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slides_to_show_tablet' => 3,
			'slides_to_show_mobile' => 2,
			'grid_columns_tablet'	=> 3,
			'grid_columns_mobile'	=> 2
		]);
		extract( $settings );
		
		$class					= array( 'pls-element', 'pls-instagram' );
		$settings['class']		= implode( ' ', $class );
		$settings['id']			= pls_uniqid( 'pls-instagram-' );
		$settings['section_class'] 	= '';
		$settings['column_class'] 	= '';
		$settings['slider_class'] 	= '';
		$settings['rows'] = 1;
		if( $settings['layout'] == 'slider' ){
			$settings['slider_options'] 	=  pls_slider_attributes( $settings);
			$settings['slider_class'] 	.= ' swiper-wrapper';
			$settings['slider_class'] 	.= ' slider-col-lg-'.$slides_to_show;
			$settings['slider_class'] 	.= ' slider-col-md-'.$slides_to_show_tablet;
			$settings['slider_class'] 	.= ' slider-col-'.$slides_to_show_mobile;
			$settings['section_class'] 	= 'pls-slider swiper row';
			$settings['column_class'] 	= 'swiper-slide';
		}else{
			$settings['slider_class'] = 'row';
			$settings['column_class'] = 'col-lg-' .pls_get_rs_grid_columns ( $grid_columns );
			$settings['column_class'] .= ' col-md-' .pls_get_rs_grid_columns ( $grid_columns_tablet );
			$settings['column_class'] .= ' col-' .pls_get_rs_grid_columns ( $grid_columns_mobile );
		}
		
		$settings['num'] 			= (int)$limit;
		$settings['cols'] 			= (int)$grid_columns;
		$instagram_data = '';
		
		if( $image_source == 'api' ) {
			$access_token = pls_get_option( 'instagram-access-token', '' );	
			if( empty( $access_token ) ){
				return;
			}
			$this->access_token 	= $access_token;
			$refresh_token = $this->refresh_access_token();
			if( is_wp_error($refresh_token) ){
				echo esc_html( $refresh_token->get_error_message() );
				$this->access_token = '';
				return;
			}
			
			if( !empty( $this->access_token ) ){
				$instagram_data = $this->instagram_media( $limit );
				if( is_wp_error( $instagram_data ) ){
					echo esc_html( $instagram_data->get_error_message() );
				}
			}
			if( !is_wp_error( $instagram_data ) && !empty( $instagram_data ) ){
				$settings['instagram_data'] 	= $instagram_data ;
			}
			
			if( empty( $settings['instagram_data'] ) ){
				return;
			}
		}
		if( empty( $settings['profile_link'] ) ){
			$settings['profile_link'] = '#';
		}
		
		if( $image_source == 'custom' && empty( $settings['gallery_images'] ) ){ 
			return; 
		}
		
		pls_core_get_templates( 'elements-widgets/instagram/'.$image_source, $settings );
	}
	
	public function instagram_media( $limit = 10 ){
		
		$transient_key = 'pls_'.sanitize_title_with_dashes($this->access_token).'_'.$limit;
		
		$stored_transient 	= get_transient( $transient_key ); // Getting cache value
		$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : false;
		if ( false === $stored_transient ) {
			/*
				Get instagram media
			*/
			$args = [
				'fields'       	=> 'id,caption,media_type,media_url,permalink,thumbnail_url,username',
				'limit'			=> $limit,
				'access_token' 	=> $this->access_token,
			];
			$result_data = array();
			$url = add_query_arg( $args, 'https://graph.instagram.com/me/media' );

			$response = wp_remote_get( $url );
			
			$response = wp_remote_retrieve_body( $response );		
			$response   = json_decode( $response, true );
			
			if( !is_array($response) ){
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram has returned invalid data.', 'pls-core' ) );
			}
			
			if( isset( $response['error']['message'] ) ){
				return new WP_Error( 'error_response', $response['error']['message'] );
			}
			
			foreach ( $response['data'] as $media ) {
				$result_data[] = array(
					'username'    	=> $media['username'],
					'type'    		=> $media['media_type'],
					'caption' 		=> isset( $media['caption'] ) ? $media['caption'] : $media['id'],
					'image_link'    => $media['permalink'],
					'image_url'  	=> strtolower( $media['media_type'] ) == 'video' ? $media['thumbnail_url'] : $media['media_url'],
				);
			}
			set_transient( $transient_key, json_encode($result_data), apply_filters( 'pls_instagram_cache_time', HOUR_IN_SECONDS * 24 ) );
		}else{
			$result_data = $stored_transient;
		}
		if ( ! empty( $result_data ) ) {
			return array_slice( $result_data, 0, $limit );
		} else {
			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'pls-core' ) );
		}
	}
	
	public function refresh_access_token(){
		$token_data = array();
		$generate_new_taken = true;
		$access_token = get_option( $this->option_name, [] );
		
		if ( !empty( $access_token ) && isset( $access_token[$this->access_token] ) ) {
			if( isset( $access_token[$this->access_token]['timestamp'] ) && 
			 $access_token[$this->access_token]['timestamp'] > time() ){
				$generate_new_taken = false;
			}
			$this->access_token = $access_token[$this->access_token]['refreshed_token'];			
		}
		
		if( $generate_new_taken ){
			/*
			 Generate Access toke
			*/
			$args = [
				'grant_type' => 'ig_refresh_token',
				'access_token'  => $this->access_token
			];
			$url 		= add_query_arg( $args, 'https://graph.instagram.com/refresh_access_token' );
			$response 	= wp_remote_get( $url );
			$data 		= wp_remote_retrieve_body( $response );			
			$data = json_decode( $data, true );			
			if( isset($data['access_token']) ){
				$token_data[$this->access_token]['refreshed_token'] = $data['access_token'];
				$token_data[$this->access_token]['timestamp'] = time() + MONTH_IN_SECONDS;
				if(!empty($access_token)){
					$token_data = array_merge($access_token, $token_data);
				}
				update_option($this->option_name, $token_data);
				$this->access_token = $data['access_token'];
				return true;
			}else{
				return new WP_Error( 'access_token_refresh', esc_html__( "can't refresh token. Please check your access key.", 'pls-core' ) );
			}
		}		
	}	
}

$widgets_manager->register( new PLS_Elementor_Instagram() );