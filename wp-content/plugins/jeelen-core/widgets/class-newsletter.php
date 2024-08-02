<?php
/**
 *	Widget: Newsletter
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'PLS_Widget_Base' ) ) {
	return;
}

class PLS_Newsletter_Widget extends PLS_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'pls-newsletter';
        $this->widget_description 	= esc_html__("Display newsletter.", 'pls-core');
        $this->widget_id 			= 'pls-newsletter';
        $this->widget_name 			= esc_html__('PLS: Newsletter', 'pls-core');
		$this->settings = array(
            
			'title' => array(
                'type' 	=> 'text',
                'label' => esc_html__('Title', 'pls-core'),
                'std' 	=> esc_html__('Newsletter','pls-core'),
            ),
			'newsletter_tagline' => array(
                'type' 				=> 'textarea',
                'label' 			=> esc_html__('Newsletter Tagline', 'pls-core'),
				'allow_esc_html'	=> false,
                'std' 				=> 'Subscribe to our mailing list to get the new updates!',
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

        $this->widget_start($args, $instance);
		do_action( 'pls_core_before_newsletter');
		
		$newsletter_tagline = apply_filters('newsletter_tagline', empty($instance['newsletter_tagline']) ? false : $instance['newsletter_tagline']);
		
		?>
		<div class="pls-newsletter-widget">
			<?php 
			# Text
			if( ! empty( $newsletter_tagline ) ){ ?>
				<div class="subscribe-tagline">
					<?php echo do_shortcode( $newsletter_tagline ) ?>
				</div>
				<?php
			}
			 if( function_exists( 'mc4wp_show_form' ) ) {
				mc4wp_show_form();
			} ?>
		</div>
		
		<?php		
		do_action( 'pls_core_after_newsletter');
		
		$this->widget_end($args);
		
        echo ob_get_clean();
    }

}