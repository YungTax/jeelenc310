<?php
/**
 *	PLS Widget: About Us
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'PLS_Widget_Base' ) ) {
	return;
}

class PLS_About_Us_Widget extends PLS_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'pls-about-us';
        $this->widget_description 	= esc_html__("Display about us ", 'pls-core');
        $this->widget_id 			= 'pls-about-us';
        $this->widget_name 			= esc_html__('PLS: About Us', 'pls-core');
		$this->image_sizes 			= pls_core_get_all_image_sizes(true);
        array_shift($this->image_sizes);
		
		$this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Title:', 'pls-core'),
				'std' => __('About Us','pls-core'),
            ),
			'hide_title' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Hide Title?', 'pls-core'),
				'std' => true,
            ),
			'logo' => array(
                'type' => 'image',
                'label' => esc_html__('Upload Logo:', 'pls-core'),                
            ),
			'logo_size' => array(
                'type' => 'select',
                'label' => esc_html__('Logo Size:', 'pls-core'),
                'options' => $this->image_sizes,
                'std' => 'full',
            ),
			'our_site_url' => array(
                'type' => 'text',
                'label' => esc_html__('Site Url:', 'pls-core'),
            ),
			'support_icon' => array(
                'type' => 'text',
                'label' => esc_html__('Support Icon Class:', 'pls-core'),
                'desc' => esc_html__('Enter icon class. ex. picon-earphones', 'pls-core'),
            ),
			'support_text' => array(
                'type' => 'text',
                'label' => esc_html__('Support Text:', 'pls-core'),
            ),
			'support_number' => array(
                'type' => 'text',
                'label' => esc_html__('Support Number:', 'pls-core'),
            ),
			'about_tagline' => array(
                'type' => 'textarea',
                'label' => esc_html__('About Tagline:', 'pls-core')
            ),
			'address' => array(
                'type' => 'text',
                'label' => esc_html__('Address:', 'pls-core'),
            ),
			'phone_number' => array(
                'type' => 'text',
                'label' => esc_html__('Phone Number:', 'pls-core'),
            ),
			'fax_number' => array(
                'type' => 'text',
                'label' => esc_html__('Fax Number:', 'pls-core'),
            ),
			'email_address' => array(
                'type' => 'text',
                'label' => esc_html__('Email:', 'pls-core'),
            ),
			'website' => array(
                'type' => 'text',
                'label' => esc_html__('Website:', 'pls-core'),
            ),
			'days_hours' => array(
                'type' => 'text',
                'label' => esc_html__('Working Days/Hours:', 'pls-core'),
            ),
		);
		parent::__construct();
	}
	
	/**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance){

        ob_start();
		
		$hide_title 	= ( ! empty( $instance['hide_title'] ) ) ? (bool) $instance['hide_title'] : false;
		if($hide_title) unset( $instance['title'] );
		
		$this->widget_start( $args, $instance );
		
		do_action( 'pls_core_before_about_us' );
		
		$logo 			= ( ! empty( $instance['logo'] ) ) ?  $instance['logo'] : '';
		$logo_size 		= ( ! empty( $instance['logo_size'] ) ) ? esc_attr( $instance['logo_size'] ) : 'full';	
		$logo_url 		= '';
		if( $logo ){
			$logo_url =  pls_get_image_src( $logo,$logo_size);
		}
		$logo_url 		= apply_filters('pls_widget_about_us_logo', $logo_url );
		$our_site_url 	= ( ! empty( $instance['our_site_url'] ) ) ?  $instance['our_site_url'] : '#';
		$about_tagline 	= apply_filters( 'about_tagline', empty( $instance['about_tagline'] ) ? false : $instance['about_tagline'] );
		$support_icon 	= ( ! empty( $instance['support_icon'] ) ) ?  $instance['support_icon'] : '';
		$support_text	= ( ! empty( $instance['support_text'] ) ) ?  $instance['support_text'] : '';
		$support_number = ( ! empty( $instance['support_number'] ) ) ?  $instance['support_number'] : '';
		$address 		= ( ! empty( $instance['address'] ) ) ?  $instance['address'] : '';
		$phone_number 	= ( ! empty( $instance['phone_number'] ) ) ?  $instance['phone_number'] : '';
		$fax_number 	= ( ! empty( $instance['fax_number'])) ?  $instance['fax_number'] : '';
		$email_address 	= ( ! empty( $instance['email_address'] ) ) ?  $instance['email_address'] : '';
		$website 		= ( ! empty( $instance['website'] ) ) ?  $instance['website'] : '';
		$days_hours 	= ( ! empty( $instance['days_hours'] ) ) ?  $instance['days_hours'] : '';
		
		//$icon_html = '';
		$html = '<div class="about-us-widget">';
		
		if(  ! empty( $logo_url ) ) {
			$html.='<p class="about-logo"><a href="'.esc_url($our_site_url) .'"><img src="'. esc_url($logo_url) .'" alt="logo" /></a></p>';			
		}
		
		if( ! empty( $support_text ) || ! empty( $support_number ) ) {
			$html.='<div class="pls-about-us-support">';
				if( ! empty( $support_icon ) ) {
					$html.='<span class="pls-about-support-icon '. esc_attr( $support_icon ) .'"></span>';
				}
				if( ! empty( $support_text ) || ! empty( $support_number ) ) {
					$html.='<div class="pls-about-support-detail">';
						if( ! empty( $support_text ) ) {
							$html.='<span class="pls-about-support-text">'. esc_html( $support_text ) .'</span>';
						}
						if( ! empty( $support_number ) ) {
							$html.='<span class="pls-about-support-number">'. esc_html( $support_number ) .'</span>';
						}
					$html.='</div>';
				}
			$html.='</div>';
		}
		
		if( ! empty( $about_tagline ) ) {
			$html.='<div class="pls-about-us-tagline">'. wp_kses_post( $about_tagline ) .'</div>';
		}			
		
		$html.='<ul class="pls-about-us">';
			if( $address != '' )
				$html.='<li><span class="pls-about-us-title">'. esc_html__('Address:', 'pls-core' ).'</span><span>'. esc_html($address) .'</span></li>';				
			
			if( $phone_number != '' )
				$html.='<li><span class="pls-about-us-title">'. esc_html__('Phone:', 'pls-core' ).'</span><span>'. esc_html($phone_number) .'</span></li>';
			
			if( $fax_number != '' )
				$html.='<li><span class="pls-about-us-title">'. esc_html__('Fax:', 'pls-core' ).'</span><span>'. esc_html($fax_number) .'</span></li>';
			
			if( $email_address != '' ):
				$html.='<li><span class="pls-about-us-title">'. esc_html__('Email:', 'pls-core' ).'</span><span>';
				if(is_email($email_address)){
					$html.='<a href="mailto:'. esc_attr($email_address).' ">'.esc_html($email_address) .'</a>';
				}else{
					$html.= esc_html__( 'Invalid Email Address', 'pls-core' );
				}
				$html.='</span>';
				$html.='</li>';
			endif;
			
			if( $website != '' ) {
				$html.='<li><span class="pls-about-us-title">'. esc_html__( 'Website:', 'pls-core' ).'</span><span><a href="'.esc_url($website) .'">'.  esc_html( $website ) .'</a></span></li>';
			}
			
			if( $days_hours != '' ) {
				$html.='<li><span class="pls-about-us-title">'. esc_html__( 'Time:', 'pls-core' ).'</span><span>'. esc_html($days_hours) .'</span></li>';
			}

		$html.='</ul>';
		$html.='</div>';
		
		echo $html;

		do_action( 'pls_core_after_about_us' );

		$this-> widget_end( $args );

        echo ob_get_clean();
    }

}
