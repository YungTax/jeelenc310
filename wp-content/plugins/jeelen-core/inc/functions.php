<?php
if ( ! function_exists( 'pls_core_get_terms' ) ) :
	function pls_core_get_terms($args = array() ){
		$return_data = array();
		
		if( !isset($args['hide_empty']) ){
			$args['hide_empty'] = false;
		}
		$result = get_terms( $args );
		
		if ( is_wp_error( $result ) ) {
			return $return_data;
		}
		
		if ( !is_array( $result ) || empty( $result ) ) {
			return $return_data;
		}
		
		foreach ( $result as $term_data ) {
			if ( is_object( $term_data ) && isset( $term_data->name, $term_data->term_id ) ) {
				$return_data[$term_data->term_id] = $term_data->name. ( ( isset($args['counts']) && $args['counts'] ) ? " (".$term_data->count.")" : '' );
			}
		}
		return $return_data;
	}
endif;

if ( ! function_exists( 'pls_core_get_variant' ) ) :
	function pls_core_get_variant($args = array() ){
		$prefix = PLS_PREFIX;
		$return_data = array();
		
		if( !isset($args['hide_empty']) ){
			$args['hide_empty'] = false;
		}
		$result = get_terms( $args );
		
		if ( is_wp_error( $result ) ) {
			return $return_data;
		}
		
		if ( !is_array( $result ) || empty( $result ) ) {
			return $return_data;
		}
		
		foreach ( $result as $term_data ) {
			if ( is_object( $term_data ) && isset( $term_data->name, $term_data->term_id ) ) {
				$return_data[$term_data->term_id] = array(
					'name' => $term_data->name,
					'count' => $term_data->count,
					'year' => get_term_meta($term_data->term_id, $prefix.'product_year', true),
				);
			}
		}
		return $return_data;
	}
endif;


if ( ! function_exists( 'pls_core_get_all_image_sizes' ) ) :
    /**
     * Returns all image sizes available.
     *
     * @since 1.0.0
     *
     * @param bool $for_choice True/False to construct the output as key and value choice
     * @return array Image Size Array.
     */
    function pls_core_get_all_image_sizes( $for_choice = false ) {

        global $_wp_additional_image_sizes;

        $sizes = array();

        if( true == $for_choice ){
            $sizes['no-image'] = __( 'No Image', 'pls-core' );
        }

        foreach ( get_intermediate_image_sizes() as $_size ) {
            if ( in_array( $_size, array('thumbnail', 'medium', 'large') ) ) {

                $width = get_option( "{$_size}_size_w" );
                $height = get_option( "{$_size}_size_h" );

                if( true == $for_choice ){
                    $sizes[$_size] = ucfirst($_size) . ' (' . $width . 'x' . $height . ')';
                }else{
                    $sizes[ $_size ]['width']  = $width;
                    $sizes[ $_size ]['height'] = $height;
                    $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
                }
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                $width = $_wp_additional_image_sizes[ $_size ]['width'];
                $height = $_wp_additional_image_sizes[ $_size ]['height'];

                if( true == $for_choice ){
                    $sizes[$_size] = ucfirst($_size) . ' (' . $width . 'x' . $height . ')';
                }else{
                    $sizes[ $_size ] = array(
                        'width'  => $width,
                        'height' => $height,
                        'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                    );
                }
            }
        }

        if( true == $for_choice ){
            $sizes['full'] = __( 'Full Image', 'pls-core' );
        }

        return $sizes;
    }
endif;

/**
* Get server info
*/
if( ! function_exists( 'pls_core_get_server_info' ) ) {
	function pls_core_get_server_info(){
		return $_SERVER['SERVER_SOFTWARE'];
	}
}

/**
 * Function to add array after specific key
 * 
 * @since 1.0.0
 */
function pls_core_add_array( $array, $value, $index, $from_last = false ) {
    
    if( is_array($array) && is_array($value) ) {
        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }    
    return $array;
}

/* 	Social share
/* --------------------------------------------------------------------- */
if( ! function_exists( 'pls_social_share' ) ) {
	function pls_social_share( $atts = array(), $echo = true ) {
		
		
		extract(shortcode_atts( array(
			'type' 			=> 'share',			
			'style' 		=> 'icon-bordered',
			'shape' 		=> 'icons-shape-circle',
			'size' 			=> 'icons-size-default',
		), $atts ));
			
		$classes []		= 'pls-social';
		$classes []		= $style;
		$classes []		= $shape;
		$classes []		= $size;
		$classes 		= implode( ' ', $classes );		
		$post_title 	= '';
		$post_link 		= '';
		$share_twitter_username = '';
		$thumb_id 		= '';
		$thumb_url 		= array( 0=> '' );
		$enabled_social_networks = array();
		
		if($type == 'share' && pls_get_option( 'social-sharing', 1 ) ){
			$post_title   = htmlspecialchars( urlencode( html_entity_decode( esc_attr( get_the_title() ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
			$post_link = get_the_permalink();
			// Twitter username
			$share_twitter_username = pls_get_option( 'share_twitter_username', '' ) ? ' via %40'.pls_get_option( 'share_twitter_username','' ) : '';
			$thumb_id 	= get_post_thumbnail_id();
			$thumb_url 	= wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true );
			$social_networks = (array) pls_get_option( 'social-share-manager', array(
                'enabled'  =>array(
					'facebook' 		=> 'Facebook',
					'twitter'     	=> 'Twitter',
					'linkedin'   	=> 'Linkedin',
					'telegram'		=> 'Telegram',
					'pinterest'		=> 'Pinterest',
				)
			));
			
			if(!isset($social_networks['enabled'])){
				$social_networks['enabled'] = array(
					'facebook' 		=> 'Facebook',
					'twitter'     	=> 'Twitter',
					'linkedin'   	=> 'Linkedin',
					'telegram'		=> 'Telegram',
					'pinterest'		=> 'Pinterest',
				);
			}
			
			$enabled_social_networks = $social_networks['enabled'];			
		}
		
		// Buttons array
		$share_buttons = array(

			'facebook' => array(
				'url'  => 'https://www.facebook.com/sharer/sharer.php?u='. $post_link,
				'text' => esc_html__( 'Facebook', 'pls-core' ),
				'icon' => 'picon-facebook',
			),

			'twitter' => array(
				'url'   => 'https://twitter.com/share?url='. $post_title . $share_twitter_username .'&amp;url='. $post_link,
				'text'  => esc_html__( 'Twitter', 'pls-core' ),
				'icon' => 'picon-x-twitter',
			),

			'linkedin' => array(
				'url'  => 'https://www.linkedin.com/shareArticle?mini=true&url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'LinkedIn', 'pls-core' ),
				'icon' => 'picon-linkedin',
			),

			'stumbleupon' => array(
				'url'  => 'http://www.stumbleupon.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'StumbleUpon', 'pls-core' ),
				'icon' => 'picon-stumbleupon',
			),

			'tumblr' => array(
				'url'  => 'https://tumblr.com/widgets/share/tool?canonicalUrl='. $post_link .'&amp;name='. $post_title,
				'text' => esc_html__( 'Tumblr', 'pls-core' ),
				'icon' => 'picon-tumblr',
			),

			'pinterest' => array(
				'url'  => 'https://pinterest.com/pin/create/button/?url='. $post_link .'&amp;description='. $post_title .'&amp;media='. $thumb_url[0],
				'text' => esc_html__( 'Pinterest', 'pls-core' ),
				'icon' => 'picon-pinterest-alt',
			),

			'reddit' => array(
				'url'  => 'https://reddit.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'Reddit', 'pls-core' ),
				'icon' => 'picon-reddit',
			),
			'vk' => array(
				'url'  => 'https://vk.com/share.php?url='. $post_link,
				'text' => esc_html__( 'VKontakte', 'pls-core' ),
				'icon' => 'picon-vk',
			),
			
			'odnoklassniki' => array(
				'url'  => 'https://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='. $post_link .'&amp;description='. $post_title .'&amp;media='. $thumb_url[0],
				'text' => esc_html__( 'Odnoklassniki', 'pls-core' ),
				'icon' => 'picon-odnoklassniki',
			),
			
			'pocket' => array(
				'url'  => 'https://getpocket.com/save?title='. $post_title .'&amp;url='.$post_link,
				'text' => esc_html__( 'Pocket', 'pls-core' ),
				'icon' => 'picon-pocket',
			),
			
			'whatsapp' => array(
				'url'   => 'https://wa.me/?text='. $post_link,
				'text'  => esc_html__( 'WhatsApp', 'pls-core' ),
				'icon' => 'picon-whatsapp',
				'avoid_esc' => true,
			),
			
			'telegram' => array(
				'url'   => 'https://telegram.me/share/url?url='.$post_link,
				'text'  => esc_html__( 'Telegram', 'pls-core' ),
				'icon'  => 'picon-telegram',
				'avoid_esc' => true,
			),	
			
			'email' => array(
				'url'  => 'mailto:?subject='. $post_title .'&amp;body='. $post_link,
				'text' => esc_html__( 'Email', 'pls-core' ),
				'icon' => 'picon-envelope',
			),
			
			'print' => array(
				'url'  => '#',
				'text' => esc_html__( 'Print', 'pls-core' ),
				'icon' => 'picon-printer',
				'check'=> pls_get_option('share-print', 0 ),
			),
			
			'tiktok' => array(
				'url'  => '#',
				'text' => esc_html__( 'TikTok', 'pls-core' ),
				'icon' => 'picon-tik-tok',
			),
			
			'instagram' => array(
				'url'  => '#',
				'text' => esc_html__( 'Instagram', 'pls-core' ),
				'icon' => 'picon-instagram',
			),
			
			'flickr' => array(
				'url'  => '#',
				'text' => esc_html__( 'Flickr', 'pls-core' ),
				'icon' => 'picon-flickr',
			),
			
			'rss' => array(
				'url'  => '#',
				'text' => esc_html__( 'RSS', 'pls-core' ),
				'icon' => 'picon-feed',
			),
			
			'youtube' => array(
				'url'  => '#',
				'text' => esc_html__( 'Youtube', 'pls-core' ),
				'icon' => 'picon-youtube',
			),
			
			'github' => array(
				'url'  => '#',
				'text' => esc_html__( 'Github', 'pls-core' ),
				'icon' => 'picon-github',
			),			
		);
		
		$share_buttons = apply_filters( 'pls_social_share_buttons', $share_buttons );
		
		$active_share_buttons = array();
		
		foreach ( $share_buttons as $network => $button ){
			$social_link = '';
			
			if($type == 'share' && array_key_exists( $network, $enabled_social_networks ) ){
				$social_link = $button['url'];
			}elseif($type == 'profile' && pls_get_option( $network.'-link', '' ) ){
				$social_link = pls_get_option($network.'-link','');
			}
			if( !empty($social_link)  && ! isset( $button['avoid_esc'] ) ){
				$button['url'] = esc_url( $social_link );
			}
			if( !empty( $social_link ) ){
				$active_share_buttons[$network] = '<a href="'. $social_link .'" rel="external" target="_blank" class="social-'. $network.'"><i class="'. $button['icon'] .'"></i> <span class="social-text">'. $button['text'] .'</span></a>';
			}
		}
		
		/**
		* social share icon order
		*/
		$active_share = array();
		if( ! empty( $enabled_social_networks ) ){
			foreach( $enabled_social_networks as $social_key => $value ){
				if(isset($active_share_buttons[$social_key]))
				$active_share[$social_key] =  $active_share_buttons[$social_key]; 
			}
			$active_share_buttons = array_merge( $active_share, $active_share_buttons );
		}
		if( is_array( $active_share_buttons ) && ! empty( $active_share_buttons ) ){
			if( $echo ){?>
				<div class="<?php echo esc_attr( $classes ); ?>">					
					<span class="social-title"><?php esc_html_e( 'Share:', 'pls-core' ); ?></span>
					<?php echo implode( '', $active_share_buttons ); ?>
				</div>
			<?php			
			}else{
				return implode( '', $active_share_buttons );
			}		
		} 
	}
}

/* Function to get required plugin list*/
function pls_core_get_required_plugins_list() {   
    $plugins = array(
		array(
			'name'                     => PLS_THEME_NAME.' Core',
			'slug'                     => PLS_THEME_SLUG.'-core',
			'required'                 => true,
			'url'                      => PLS_THEME_SLUG.'-core/'.PLS_THEME_SLUG.'-core.php',
			'version'                  => '1.0',
		),
		array(
            'name'                     => 'Revolution Slider',
            'slug'                     => 'revslider',
            'required'                 => false,
            'url'                      => 'revslider/revslider.php',
        ),
        array(
            'name'                     => 'Elementor',
            'slug'                     => 'elementor',
            'required'                 => true,
            'url'                      => 'elementor/elementor.php',
        ),
		array(
            'name'                     => 'Woocommerce',
            'slug'                     => 'woocommerce',
            'required'                 => true,
            'url'                      => 'woocommerce/woocommerce.php',
        ),			
    );
    return $plugins;
}

/**
 * Get post type dropdown
 */
function pls_core_get_posts_dropdown($post_type ='post',$select_options = ''){
	$results = array();
	$args = array('post_type'	=> $post_type,
				'post_status' 	=>  array('publish'),
				'posts_per_page'=>-1);
	$post_type_query = get_posts( $args );
	if(!empty($select_options)){
		$results[' '] = $select_options;
	}
    foreach ( $post_type_query as $p ):
		$results[$p->ID] = $p->post_title;
    endforeach; 
	return $results;
}

/**
 * Get shortcode template parts.
 */
function pls_core_get_templates( $slug,$args = array() ) {
	$template = '';
	
	$template_path = 'template-parts/';
	$plugin_path = trailingslashit( PLS_CORE_DIR );
	
	// If template file doesn't exist, look in yourtheme/template-parts/elements-widgets/slug.php
	if ( ! $template ) {
		$template = locate_template( array(
			$template_path . "{$slug}.php"
		) );
	}
	
	// Get default slug.php
	if ( ! $template && file_exists( $plugin_path . "templates/{$slug}.php" ) ) {
		$template = $plugin_path . "templates/{$slug}.php";
	}
	
	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'pls_core_get_templates', $template, $slug);	
	extract( $args );
	if ( $template ) {		
		include( $template );
	}
}

function pls_core_get_posts( $args ) {
	$defaults = array(
		'post_type'           	=> isset($args['post_type']) ? $args['post_type'] : 'post',
		'status'              	=> 'published',
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> isset($args['orderby']) ? $args['orderby'] : 'date',
		'order'               	=> isset($args['order']) ? $args['order'] : 'desc',
		'posts_per_page'      	=> isset( $args['limit'] ) > 0 ? intval( $args['limit'] ) : 10,
		'paged'      			=> isset($args['paged']) > 0 ? intval( $args['paged'] ) : 1,
	);
	if( isset($args['title']) ){
		unset($args['title']);
	}
	$args = wp_parse_args( $args, $defaults );
	// Posts Order
	if( ! empty( $orderby ) ){
		
		// Random Posts
		if( $args['orderby'] == 'rand' ){
			$args['orderby'] = 'rand';
		}

		// Most Viewd posts
		elseif( $args['orderby'] == 'views'){
			$prefix = PLS_PREFIX;
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = apply_filters( 'pls_views_meta_field', $prefix.'views_count' );
		}

		// Popular Posts by comments
		elseif( $args['orderby'] == 'popular' ){
			$args['orderby'] = 'comment_count';
		}

		// Recent modified Posts
		elseif( $args['orderby']== 'modified' ){
			$args['orderby'] = 'modified';
		}		
	}
	//Specific categories
	$categories = isset($args['categories']) ? $args['categories'] : '';
	
	if( !empty($categories) ){
		$taxonomy = isset($args['taxonomy']) ? $args['taxonomy'] : 'category';
		$args['tax_query'][] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);
		
	}	
	
	// Exclude Blog
	if ( !empty($args['exclude']) ) {					
		$args['post__not_in'] = $args['exclude'];
		if(!empty($args['post__in'])){
			$args['post__in'] = array_diff( $args['post__in'], $args['post__not_in'] );
		}
	}
	return $args;
}

/**
 Vendor products
*/
function pls_core_vendor_products($args){
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $args['posts_per_page'],
		'author' => $args['author'],
		'ignore_sticky_posts'=> true,
		'no_found_rows'=> true
	);
	$args['meta_query'] 	= WC()->query->get_meta_query();
	$args['tax_query']   	= WC()->query->get_tax_query();
	$products = new WP_Query($args);
	return $products;
}

function pls_core_get_products( $data_source, $atts, $args = array() ) {
	$defaults = array(
		'post_type'           	=> 'product',
		'status'              	=> 'published',
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> isset($atts['orderby']) ? $atts['orderby'] : 'DATE',
		'order'               	=> isset($atts['order']) ? $atts['order'] : 'DESC',
		'posts_per_page'      	=> isset( $atts['limit'] ) > 0 ? intval( $atts['limit'] ) : 10,
		'paged'      			=> isset($atts['paged']) > 0 ? intval( $atts['paged'] ) : 1,
	);
	if( isset($atts['title']) ){
		unset($atts['title']);
	}
	$args['meta_query'] 	= WC()->query->get_meta_query();
	$args['tax_query']   	= WC()->query->get_tax_query();
	$args = wp_parse_args( $args, $defaults );
	
	switch ( $data_source ) {
		case 'featured_products';
			$args['tax_query'][] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'featured' ),
					'operator' => 'IN',
				),
			);			
			break;
		case 'sale_products';
			$product_ids_on_sale   = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$args['post__in']      = $product_ids_on_sale;
			break;
		case 'best_seller_products';
			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;
		case 'top_rated_products';
			$args['meta_key'] = '_wc_average_rating';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;		
		case 'products';
			if ( is_array($atts['product_ids']) && !empty( $atts['product_ids'] ) ) {
				$args['post__in'] = $atts['product_ids'];
			}elseif($atts['product_ids'] != '' ) {
				$args['post__in'] = explode( ',', $atts['product_ids'] );
			}
			break;
		case 'deal_products';
			 global $wpdb;
			// Get products on sale
			$product_ids_raw = $wpdb->get_results(
			"SELECT posts.ID, posts.post_parent
			FROM `$wpdb->posts` posts
			INNER JOIN `$wpdb->postmeta` ON (posts.ID = `$wpdb->postmeta`.post_id)
			INNER JOIN `$wpdb->postmeta` AS mt1 ON (posts.ID = mt1.post_id)
			WHERE
				posts.post_status = 'publish'
				AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().") 
				GROUP BY posts.ID 
				ORDER BY posts.post_title");

			$product_ids_on_sale = array();

			foreach ( $product_ids_raw as $product_raw ) 
			{
				if(!empty($product_raw->post_parent))
				{
					$product_ids_on_sale[] = $product_raw->post_parent;
				}
				else
				{
					$product_ids_on_sale[] = $product_raw->ID;  
				}
			}
			$product_ids_on_sale = array_unique($product_ids_on_sale);
			$args['post__in'] = $product_ids_on_sale;			
			break;
	}
	
	//Specific categories
	$categories = isset($atts['categories']) ? $atts['categories'] : '';
	
	if( !empty($categories) ){
		$taxonomy = isset($atts['taxonomy']) ? $atts['taxonomy'] : 'product_cat';
		$args['tax_query'][] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);
		
	}	
	// Exclude Products
	if ( !empty($atts['exclude']) ) {					
		$args['post__not_in'] = $atts['exclude'];
		if(!empty($args['post__in'])){
			$args['post__in'] = array_diff( $args['post__in'], $args['post__not_in'] );
		}
	}
	
	return $args;
}

function pls_core_get_products_shortcode_attr( $settings = [] ){
	$shortcode_str = '';
	$attrs = array(
		'limit'		=> isset($settings['limit']) ? $settings['limit'] : 8,
		'orderby'	=> isset($settings['orderby']) ? $settings['orderby'] : 'DATE',
		'order'		=> isset($settings['order']) ? $settings['order'] : 'DESC',
		'paginate'	=> isset($settings['paginate']) ? $settings['paginate'] : 'false',
	);
	if(isset( $settings['pagination'] ) && $settings['layout'] == 'grid' && $settings['pagination'] != 'none' ){
		$attrs['paginate'] = 1;
	}
	
	if( $settings['data_source'] == 'featured_products' ){
		$attrs['visibility'] = 'featured';
	}elseif( $settings['data_source'] == 'sale_products' ){
		$attrs['on_sale'] = true;
	}elseif( $settings['data_source'] == 'best_seller_products' ){
		$attrs['best_selling'] = true;
	}elseif( $settings['data_source'] == 'top_rated_products' ){
		$attrs['top_rated'] = true;
	}elseif( $settings['data_source'] == 'products' ){
		if( !empty( $settings['product_ids'] ) ){
			$attrs['ids'] = implode( ",",$settings['product_ids']) ;
		}		
	}
	
	if( !empty( $settings['categories'] ) && $settings['data_source'] != 'products' ){
		if( is_array( $settings['categories'] ) ){
			$attrs['category'] = implode( ",",$settings['categories']) ;
		}else{
			$attrs['category'] = $settings['categories'] ;
		}
		
	}
	
	if(isset( $settings['paged'] ) ){
		$attrs['page'] = $settings['paged'] ;
	}
	if(!empty( $attrs ) ){
		foreach( $attrs as $key => $value ){
			$shortcode_str .= ' '. $key . '="' . $value . '"';
		}
	}
	return $shortcode_str;
}

function pls_core_shop_pagination(){
	if ( ! wc_get_loop_prop( 'is_paginated' ) || ( pls_get_loop_prop( 'type' ) != 'products_shortcode' ) ||
	1 >= wc_get_loop_prop( 'total_pages' ) ) {
		return;
	}
	
	?>
	<div class="pls-pagination">
			<?php 
			$pagination		= pls_get_loop_prop( 'pagination' );
			$attribute		= pls_get_loop_prop( 'attribute' );
			$total			= wc_get_loop_prop( 'total_pages' );
			$current		= wc_get_loop_prop( 'current_page' );			
			
			if ( $pagination != 'default' ){
				$load_more_label 		= pls_get_loop_prop( 'products-pagination-load-more-button-text' );
				$loading_finished_msg 	= pls_get_loop_prop( 'products-pagination-finished-message' );
				?>
				<div class="pls-products-load-more" data-pagination_style = "<?php echo esc_attr($pagination);?>" data-page="2" data-total="<?php echo esc_attr($total);?>" data-attribute="<?php echo esc_attr($attribute); ?>" data-load_more_label="<?php echo esc_html($load_more_label); ?>" data-loading_finished_msg="<?php echo esc_html($loading_finished_msg); ?>"> 
					<a class="btn pls-load-more <?php echo esc_attr($pagination); ?>" href="javascript:void(0);">
						<?php echo esc_html($load_more_label); ?>
					</a>
				</div>
				<?php
			}else{				
				echo paginate_links(
					apply_filters(
						'woocommerce_pagination_args',
						array( // WPCS: XSS ok.
							'base'      => $base,
							'format'    => $format,
							'add_args'  => false,
							'current'   => max( 1, $current ),
							'total'     => $total,
							'prev_text' => esc_html__( 'Previous', 'pls-core' ),
							'next_text' => esc_html__( 'Next', 'pls-core' ),
							'type'      => 'list',
							'end_size'  => 2,
							'mid_size'  => 2,
						)
					)
				);		
			} ?>
		</div>
		<?php
}

function pls_core_loadmore_product(){
	$response        = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr      		= isset( $_POST['attr'] ) ? $_POST['attr'] : array();
	$paged      	= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args      		=  $attr;	
	$args['paged'] 	= $paged;
	$query 			= pls_core_get_products( $args['data_source'], $args );	
	$loop 			= new WP_Query( $query );	
	$max_num_page 	= $loop->max_num_pages;
	$query_paged  	= $loop->query_vars['paged'];
	if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
		$show_button = '1';
	} else {
		$show_button = '0';
	}
	if ( $max_num_page <= 1 ) {
		$show_button = 0;
	}	
	ob_start();
	
	$args['show_button'] =  $show_button;
	extract( $args );
	if( $product_style != 'default' ){
		pls_set_loop_prop( 'product-style', $product_style );
	}
	pls_set_loop_prop( 'products_view', 'grid-view' );
	if( isset( $products_countdown ) ){
		pls_set_loop_prop( 'product-countdown', $products_countdown );
	}	
	pls_set_loop_prop( 'products-columns', $grid_columns );
	pls_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
	pls_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
	wc_set_loop_prop( 'columns', $grid_columns );
	while ( $loop->have_posts() ) : $loop->the_post();
		wc_get_template_part( 'content-product' );       
	endwhile;
	wp_reset_postdata();
	pls_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	$response['show_bt'] = $show_button;
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_pls_loadmore_product', 'pls_core_loadmore_product' );
add_action( 'wp_ajax_nopriv_pls_loadmore_product', 'pls_core_loadmore_product' );


function pls_core_category_tab_product(){
	$response        = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr      		= isset( $_POST['attr'] ) ? $_POST['attr'] : array();
	$paged      	= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args      		=  $attr;	
	$args['paged'] 	= 1;
	$args['paginate'] 	= '0';
	$data_source = $args['data_source'];
	if( isset($args['data_source'])){
		$data_source = $args['data_source'];
	}
	$shortcodestr	= pls_core_get_products_shortcode_attr( $args );
	ob_start();
	extract( $args );
	if( $product_style != 'default' ){
		pls_set_loop_prop( 'product-style', $product_style );
	}
	if( $layout == 'slider' ){
		pls_set_loop_prop('name','pls-slider');
		pls_set_loop_prop( 'slider_navigation', $slider_navigation );
		pls_set_loop_prop( 'slider_dots', $slider_dots );
	}
	
	pls_set_loop_prop( 'products_view', 'grid-view' );
	if( isset( $products_countdown ) ){
		pls_set_loop_prop( 'product-countdown', $products_countdown );
	}		
	pls_set_loop_prop( 'products-columns', $grid_columns );
	pls_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
	pls_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
	wc_set_loop_prop( 'columns', $grid_columns );
	if( ! pls_get_option( 'product-rating', 0 ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5	 );
	}
	pls_set_loop_prop( 'product_rows', $rows );
	pls_set_loop_prop( 'count', 0 );
	//echo 'products ' . $shortcodestr;
	echo do_shortcode( '[products cache="false" ' . $shortcodestr . ']'  );
	wp_reset_postdata();
	pls_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_pls_category_tab_product', 'pls_core_category_tab_product' );
add_action( 'wp_ajax_nopriv_pls_category_tab_product', 'pls_core_category_tab_product' );

function pls_core_loadmore_posts(){
	$response = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr			= isset( $_POST['attr'] ) ? $_POST['attr'] : '';
	$paged			= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args			= $attr;
	$args['paged'] 	= $paged;	
	$query 			= pls_core_get_posts($args );	
	$loop 			= new WP_Query( $query );	
	$max_num_page 	= $loop->max_num_pages;
	$query_paged  	= $loop->query_vars['paged'];
	if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
		$show_button = '1';
	} else {
		$show_button = '0';
	}
	if ( $max_num_page <= 1 ) {
		$show_button = 0;
	}
	ob_start();	
	extract( $args );	
	pls_set_loop_prop( 'name','posts-loop-shortcode');
	pls_set_loop_prop( 'post-single-line-title', $post_single_line_title);
	pls_set_loop_prop( 'blog-post-style', $blog_style );
	pls_set_loop_prop( 'post-category', $post_category);
	pls_set_loop_prop( 'post-meta', $post_meta);
	wp_enqueue_script( 'masonry' );
	if( 'blog-grid' == $blog_style ){		
		pls_set_loop_prop( 'blog-grid-layout', $grid_layout );
		pls_set_loop_prop( 'blog-grid-columns', $grid_columns );
		pls_set_loop_prop( 'blog-grid-columns-tablet', $grid_columns_tablet );
		pls_set_loop_prop( 'blog-grid-columns-mobile', $grid_columns_mobile );
	}		
	pls_set_loop_prop( 'show-blog-post-content', $show_blog_content );
	pls_set_loop_prop( 'blog-post-content', $blog_content );
	pls_set_loop_prop( 'blog-excerpt-length', $blog_excerpt_length );
	pls_set_loop_prop( 'read-more-button', $read_more_btn);
	if(!$show_blog_content){
		pls_set_loop_prop( 'read-more-button', 0);
	}else{
		pls_set_loop_prop( 'read-more-button', $read_more_btn);
	}
	pls_set_loop_prop( 'read-more-button-style', $read_more_btn_style );
	pls_set_loop_prop( 'blog-custom-thumbnail-size', $image_size );
	pls_set_loop_prop( 'blog-post-thumbnail', $blog_thumbnail );
	pls_set_loop_prop( 'blog-post-title', $blog_title );		
	while ( $loop->have_posts() ) :
		$loop->the_post();			
		// Include the loop post content template.
		get_template_part( 'template-parts/post-loop/layout', get_post_format() );      
	endwhile;
	wp_reset_postdata();
	pls_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	$response['show_bt'] = $show_button;
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_pls_loadmore_posts', 'pls_core_loadmore_posts' );
add_action( 'wp_ajax_nopriv_pls_loadmore_posts', 'pls_core_loadmore_posts' );