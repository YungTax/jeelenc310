<?php
/**
 *	PLS Widget: Recent Posts
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'PLS_Widget_Base' ) ) {
	return;
}

class PLS_Recent_Posts_Widget extends PLS_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'pls-recent-posts';
        $this->widget_description 	= esc_html__("Your most resent post with slider.", 'pls-core');
        $this->widget_id 			= 'pls-recent-posts';
        $this->widget_name 			= esc_html__('PLS: Recent Posts', 'pls-core');
		$this->settings = array(
            
			'title' => array(
                'type' 	=> 'text',
                'label' => esc_html__('Title', 'pls-core'),
                'std' 	=> esc_html__('Recent Posts','pls-core'),
            ),
			'number' => array(
                'type' 	=> 'number',
                'step' 	=> 1,
                'min' 	=> 1,
                'max' 	=> '',
                'std' 	=> 10,
                'label' => esc_html__( 'Number of posts to show:', 'pls-core' ),
            ),
			'slider' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__( 'Enable slider?', 'pls-core' ),
                'std' 	=> false,
            ),
			'number_slide' => array(
                'type' 	=> 'text',
                'label' => esc_html__('Per slide show posts:', 'pls-core'),
                'std' 	=> 5,
            ),
			'autoplay' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__('Enable Auto play slider?', 'pls-core'),
                'std' 	=> false,
            ),
			'loop' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__('Continue slider loop?', 'pls-core'),
                'std' 	=> false,
            ),
			'dots' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__('Show slider dots?', 'pls-core'),
                'std' 	=> false,
            ),
		);
		parent::__construct();
	}
	
	/**
     * Query the posts and return them.
     * @param  array $args
     * @param  array $instance
     * @return WP_Query
     */
    public function get_posts($args, $instance)
    {
        $number = !empty($instance['number']) ? absint($instance['number']) : $this->settings['number']['std'];
        
        $query_args = array(
            'posts_per_page' 		=> $number,
            'post_status' 			=> 'publish',
            'no_found_rows' 		=> 1,
            'ignore_sticky_posts' 	=> 1
        );

        return new WP_Query(apply_filters( 'pls_recent_posts_query_args', $query_args ) );
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
	   if ( ( $recent_posts = $this->get_posts( $args, $instance ) ) && $recent_posts->have_posts() ) {
			$number_slide 	= ( ! empty( $instance['number_slide'] ) ) ? (int) $instance['number_slide'] : 5;
			$slider 		= ( ! empty( $instance['slider'] ) ) ? (bool) $instance['slider'] : false;
			$autoplay 		= ( ! empty( $instance['autoplay'] ) ) ? (bool) $instance['autoplay'] : false;
			$loop 			= ( ! empty( $instance['loop'] ) ) ? (bool) $instance['loop'] : false;
			$dots 			= ( ! empty( $instance['dots'] ) ) ? (bool) $instance['dots'] : false;
			$id 			= $args['widget_id'];
			$class			= '';
			$slider_data 	= [];
			if( $slider ){
				$class	.=	" swiper-wrapper";				
				$owl_data		= array(
					'slider_loop'			=> $loop,
					'slider_autoplay' 		=> $autoplay,
					'slider_navigation'		=> false,
					'slider_dots'			=> $dots,
					'slides_to_show' 		=> 1,
					'slides_to_show_tablet'	=> 1,
					'slides_to_show_mobile' => 1,
				);
				$slider_data 		= shortcode_atts(pls_slider_options(),$owl_data);
			}	
			$this->widget_start($args, $instance);
			do_action( 'pls_core_before_recent_posts_widget');
			if( $slider ){
				echo '<div class="pls-slider swiper">';
			}
			?>
			
			<div class="pls-widget-recent-posts<?php echo esc_attr($class); ?>"
			<?php if($slider){ echo 'data-slider_options="'.esc_attr( wp_json_encode( $slider_data ) ).'"';  } ?>>
				<?php $row=1; 
				while ( $recent_posts->have_posts() ) : $recent_posts->the_post();?>
					<?php if( $slider == true && $row==1 ){?>
						<div class="swiper-slide">
					<?php }?>
						<div class="widget-post-item">
							<div class="widget-post-thumbnail">
								<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php echo get_the_post_thumbnail($recent_posts->ID,'thumbnail')?></a>
							</div>
							<div class="widget-post-body">
								<div class="post-title">
									<a href="<?php the_permalink() ?>" title="<?php get_the_title();?>"><?php the_title(); ?></a>
								</div>
								<div class="post-meta"> 
									<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
								</div>
							</div>
						</div>
					<?php if( $slider == true && $row==$number_slide){ $row=0;?>
						</div>
					<?php } $row++;?>
				<?php endwhile;
				wp_reset_postdata();?>
			</div>
			
			<?php
			if( $slider ){
				echo '</div>';
			}
			do_action( 'pls_core_after_recent_posts_widget');
			$this->widget_end($args);
	   }
        echo ob_get_clean();
    }

}