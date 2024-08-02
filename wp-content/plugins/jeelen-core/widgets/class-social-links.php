<?php
/**
 *	PLS Widget: Social Links
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'PLS_Widget_Base' ) ) {
	return;
}

class PLS_Social_Links extends PLS_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'pls-social-link';
        $this->widget_description 	= esc_html__( 'Display social links.', 'pls-core' );
        $this->widget_id 			= 'pls-social-links';
        $this->widget_name 			= esc_html__( 'PLS: Social Links', 'pls-core' );
		$this->settings = array(
            'title' => array(
                'type' 	=> 'text',
                'label' => esc_html__( 'Title:', 'pls-core' ),
				'std' => esc_html__( 'Social', 'pls-core' ),
            ),
			'hide_title' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__( 'Hide Widget Title?', 'pls-core' ),
                'std' 	=> true,
            ),
			'social_Style' => array(
                'type' => 'select',
                'label' => esc_html__( 'Icons Style:', 'pls-core' ),
                'options' => array(
					'icons-default' 		=> esc_html__( 'Default', 'pls-core' ),					
                    'icons-colour' 			=> esc_html__( 'Colour', 'pls-core' ),										
                ),
                'std' => 'icons-fill-colour',
            ),
			'social_icon_size' => array(
                'type' => 'select',
                'label' => esc_html__( 'Icons Size:', 'pls-core' ),
                'options' => array(
                    'icons-size-default'=> esc_html__( 'Default', 'pls-core' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'pls-core' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'pls-core' ),
                ),
                'std' => 'icons-size-small',
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
    public function widget( $args, $instance ){

        ob_start();
		
		$hide_title = ( !empty( $instance['hide_title'] ) ) ? (bool) $instance['hide_title'] : false;
		if( $hide_title ) unset( $instance['title'] );
		
		$this->widget_start( $args, $instance );
		
		do_action( 'pls_core_before_social_links' );
		
		$social_Style 		= ( !empty($instance['social_Style'] ) ) ?  $instance['social_Style'] : 'icons-fill-colour';
		$social_icon_size 	= ( !empty($instance['social_icon_size'] ) ) ?  $instance['social_icon_size'] : 'icons-size-small';	?>
		
		<div class="pls-social-links-widget">
			<?php //Get Social link
			if ( function_exists( 'pls_social_share' ) ){
				pls_social_share( array(
					'type'	=> 'profile',
					'style' => $social_Style,
					'size' 	=> $social_icon_size
				) );
			}?>
		</div>
		
		<?php
		do_action( 'pls_core_after_social_links' );

		$this->widget_end($args);

        echo ob_get_clean();
    }
}