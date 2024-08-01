<?php
/**
 *	PLS Widget: Products
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'PLS_Widget_Base' ) ) {
	return;
}

class PLS_Products_Widget extends PLS_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'pls-products woocommerce';
        $this->widget_description 	= esc_html__("Display a list of products with slider.", 'pls-core');
        $this->widget_id 			= 'pls-products';
        $this->widget_name 			= esc_html__('PLS: Products', 'pls-core');
		$this->image_sizes 			= pls_core_get_all_image_sizes( true );
        array_shift($this->image_sizes);
		$product_type_options = array(
				'recent'		=> __( 'Recent Products', 'pls-core' ),
				'featured'		=> __( 'Feature Products', 'pls-core' ),
				'on-sale'		=> __( 'On Sale Products', 'pls-core' ),				
				'top-selling'	=> __( 'Top Selling Products', 'pls-core' ),			
				'top-rated'		=> __( 'Top Rated Products', 'pls-core' ),				
			);
			
		$orderby_options = array(
				'date'		=> esc_html__('Date','pls-core'),
				'title'		=> esc_html__('Title','pls-core'), 
				'name'		=> esc_html__('Name(Slug)','pls-core'),
				'rand'		=> esc_html__('Rand','pls-core'),
				'id'		=> esc_html__('ID','pls-core')				
			);
		$order_options = array(
				'desc'			=> 'Descending', 
				'asc'			=>'Ascending'
			);
		$this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Title:', 'pls-core'),
				'std' => esc_html__('Recent Products','pls-core'),
            ),
			'show' => array(
                'type' 		=> 'select',
                'label' 	=> esc_html__('Product Type:', 'pls-core'),
                'options' 	=> $product_type_options,
                'std' 		=> 'recent',
            ),
			'number' => array(
                'type' 	=> 'number',
                'step' 	=> 1,
                'min' 	=> 1,
                'max' 	=> '',
                'std' 	=> 10,
                'label' => esc_html__('Number of products to show:', 'pls-core'),
            ),
			'orderby' => array(
                'type' 		=> 'select',
                'label' 	=> esc_html__('Order By:', 'pls-core'),
                'options' 	=> $orderby_options,
                'std' 		=> 'date',
            ),
			'order' => array(
                'type' 		=> 'select',
                'label' 	=> esc_html__('Order:', 'pls-core'),
                'options' 	=> $order_options,
                'std' 		=> 'desc',
            ),
			'hide_free' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Hide free products?', 'pls-core' )
            ),
            'show_hidden' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Show hidden products?', 'pls-core' )
            ),
			'show_rating' => array(
                'type'  => 'checkbox',
                'std'   => true,
                'label' => __( 'Show rating?', 'pls-core' )
            ),
			'slider' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__( 'Enable slider?', 'pls-core' ),
                'std' 	=> true,
            ),
			'number_slide' => array(
                'type' 	=> 'text',
                'label' => esc_html__('Per slide show products:', 'pls-core'),
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
                'std' 	=> true,
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
     * Query the products and return them.
     * @param  array $args
     * @param  array $instance
     * @return WP_Query
     */
    public function get_products($args, $instance)
    {
        $number  = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$orderby 	= !empty($instance['orderby']) ? $instance['orderby'] : 'date';
        $order 		= !empty($instance['order']) ? $instance['order'] : 'desc';
		$product_visibility_term_ids = wc_get_product_visibility_term_ids();
        $query_args = array(
            'posts_per_page' => $number,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'no_found_rows'  => 1,
            'orderby'         => $orderby,
            'order'          => $order,
            'meta_query'     => array()
        );

        if ( empty( $instance['show_hidden'] ) ) {
            $query_args['meta_query'][] = WC()->query->visibility_meta_query();
            $query_args['post_parent']  = 0;
        }

        if ( ! empty( $instance['hide_free'] ) ) {
            $query_args['meta_query'][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
        $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

        switch ( $instance['show'] ) {
            case 'featured' :
                $query_args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['featured'],
				);
                break;
            case 'on-sale' :
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query_args['post__in'] = $product_ids_on_sale;
                break;
			case 'top-selling' :
                $query_args['orderby'] 	= 'meta_value_num';
				$query_args['order'] 	= 'desc';
				$query_args['meta_key'] = 'total_sales';
                break;
			case 'top-rated' :
				$query_args['orderby'] 	= 'meta_value_num';
				$query_args['order'] 	= 'desc';
				$query_args['meta_key'] = '_wc_average_rating';
                break;
        }
		
        return new WP_Query( apply_filters( 'pls_products_widget_query_args', $query_args ) );
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
		$number_slide 	= (!empty($instance['number_slide'])) ? (int) $instance['number_slide'] : 5;
		$slider 		= (!empty($instance['slider'])) ? (bool) $instance['slider'] : false;
		$autoplay 		= (!empty($instance['autoplay'])) ? (bool) $instance['autoplay'] : false;
		$loop 			= (!empty($instance['loop'])) ? (bool) $instance['loop'] : false;
		$dots 			= (!empty($instance['dots'])) ? (bool) $instance['dots'] : false;
		$show_rating 	= (!empty($instance['show_rating'])) ? (bool) $instance['show_rating'] : false;
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
		do_action( 'pls_core_before_products_widget');
		if( $slider ){
			echo '<div class="pls-slider swiper">';
		}
		?>
		
		<ul class="product_list_widget<?php echo esc_attr( $class ); ?>"
		<?php if($slider){ echo 'data-slider_options="'.esc_attr( wp_json_encode( $slider_data ) ).'"';  } ?>>
			<?php
			$template_args = array(
				'widget_id'   => $args['widget_id'],
				'show_rating' => $show_rating,
			);
			$products 	= $this->get_products( $args, $instance );
			$row		= 1;
			if( $products->have_posts() ){
				while( $products->have_posts() ):
					$products->the_post();
					if( $slider && $row == 1 ) { 
						echo '<ul class="swiper-slide">'; 
					} 
					wc_get_template( 'content-widget-product.php', $template_args );
					if( $slider && ( $row==$number_slide || $products->current_post+1 == $products->post_count ) ){ 
						$row	= 0; 
						echo '</ul>'; 
					} 
						$row++;	
				endwhile;						
			}
			wp_reset_postdata();
			?>
		</ul>
		
		<?php
		if( $slider ){
			echo '</div>';
		}
		do_action( 'pls_core_after_products_widget');
		$this->widget_end($args);
        echo ob_get_clean();
    }

}
