<?php 
/**
 * Elementor Functions
 */
function pls_core_elementor_get_url_attribute($link) {
	$attrs = '';
	if ( isset( $link['url'] ) && $link['url'] ) {
		$attrs = ' href="' . esc_url( $link['url'] ) . '"';
		$attrs .= $link['is_external'] ? ' target="_blank"' : '';
		$attrs .= $link['nofollow'] ? ' rel="nofollow"' : '';			
	}
	if ( isset( $link['custom_attributes'] ) ) {
		$custom_attributes = Elementor\Utils::parse_custom_attributes( $link['custom_attributes'] );
		foreach ( $custom_attributes as $attr_key => $value ) {
			$attrs .= ' ' . $attr_key . '="' . $value . '"';
		}
	}
	return $attrs;
}
function pls_core_elementor_get_url_data($link) {
	$attrs = [];
	if ( isset( $link['url'] ) && $link['url'] ) {
		$attrs['url'] = 'href="'.$link['url'].'"';
		$attrs['is_external'] = $link['is_external'] ? 'target="_blank"' : '';
		$attrs['nofollow'] = $link['nofollow'] ? 'rel="nofollow"' : '';
	}
	if ( isset( $link['custom_attributes'] ) ) {
		$custom_attributes = Elementor\Utils::parse_custom_attributes( $link['custom_attributes'] );
		foreach ( $custom_attributes as $attr_key => $value ) {
			$attrs[$attr_key] = $attr_key.'="'.$value.'"';
		}
	}
	return $attrs;
}

	
/**
 * Get Image Url
 */
 
function pls_core_elementor_get_image_url( $image, $size = 'thumbnail' ) {
	if ( empty( $image['url'] ) ) {
		return '';
	}
	if ( ! empty( $image['id'] ) ) {
		$attr = wp_get_attachment_image_src( $image['id'], $size );
		if ( isset( $attr['url'] ) && $attr['url'] ) {
			$image['url'] = $attr['url'];
		}
	}
	return $image['url'];
}
	
 /**
 * Fetch Product Categories
 */
function pls_core_elementor_get_terms( $term_slug = 'product_cat', $show_count=false ) {
	$category = array();

	$cats = get_terms( $term_slug );
	$category[''] =  esc_html__( '--Select--', 'pls-core' );
	if ( is_array( $cats ) ) {
	  foreach ( $cats as $cat ) {
		$category[$cat->term_id] = $cat->name .( ( isset($show_count) && $show_count ) ? " (".$cat->count.")" : '' );
	  }
	}
	return $category;
}

/**
 * Get theme primary color
 */
function pls_core_get_primary_color() {
	return pls_get_option( 'primary-color', '#222222' );
}

/**
 * Get theme primary inverse color
 */
function pls_core_get_primary_inverse_color() {
	return pls_get_option( 'primary-inverse-color', '#ffffff' );
}

/**
 * Get theme primary inverse color
 */
function pls_core_get_secondary_color() {
	return pls_get_option( 'secondary-color', '#222222' );
}


 /**
 * Default blog args
 */
function pls_core_default_blog_args( ) {
	$args = array(
		'blog_style'			=> '',
		'pagination'			=> '',
		'categories'			=> '',
		'exclude'				=> '',
		'limit'					=> '',
		'orderby'				=> '',
		'order'					=> '',
		'grid_layout'			=> '',
		'grid_columns'			=> '',
		'grid_columns_tablet'	=> '',
		'grid_columns_mobile'	=> '',
		'blog_title'			=> '',
		'post_single_line_title'=> '',
		'post_date'				=> '',
		'post_category'			=> '',
		'image_size'			=> '',
		'blog_thumbnail'		=> '',
		'post_meta'				=> '',
		'specific_post_meta'	=> '',
		'show_blog_content'		=> '',
		'blog_content'			=> '',
		'blog_excerpt_length'	=> '',
		'read_more_btn'			=> '',
		'read_more_btn_style'	=> '',
		'paged'					=> ''
	);	
	return $args;
}

 /**
 * Default product args
 */
function pls_core_default_product_args( ) {
	$args = array(
		'title'					=> '',
		'post_type'				=> 'product',
		'layout'				=> 'grid',
		'product_view_mode'		=> 'vertical',
		'product_deal_style'	=> 'vertical',
		'product_style'			=> 'default',
		'products_countdown'	=> '',
		'pagination'			=> 'none',
		'data_source'			=> 'recent_products',
		'product_ids'			=> '',
		'categories'			=> array(),
		'exclude'				=> array(),
		'limit'					=> '10',
		'orderby'				=> 'date',
		'order'					=> 'desc',
		'grid_columns'			=> '4',
		'grid_columns_tablet'	=> '3',
		'grid_columns_mobile'	=> '2',
		'rows'					=> '1',
		'slides_to_show'		=> 4,
		'slides_to_show_tablet'	=> 4,
		'slides_to_show_mobile'	=> 4,
		'slides_to_scroll'		=> 1,
		'slides_to_scroll_tablet' => 1,
		'slides_to_scroll_mobile' => 1,
		'slider_autoplay'		=> 0,
		'slider_loop'			=> 0,
		'slider_navigation'		=> '',
		'navigation_position'	=> '',
		'slider_dots'			=> 0,
	);
	
	return $args;
}

if ( ! function_exists( 'pls_core_elementor_search_post' ) ) {
	/**
	 * Get post by search
	 *
	 * @since 1.0.0
	 */
	function pls_core_elementor_search_post() {
		$search_string = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : ''; // phpcs:ignore
		$post_type     = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
		$results       = array();

		$query = new WP_Query(
			array(
				's'              => $search_string,
				'post_type'      => $post_type,
				'posts_per_page' => - 1,
			)
		);

		if ( ! isset( $query->posts ) ) {
			return;
		}

		foreach ( $query->posts as $post ) {
			$results[] = array(
				'id'   => $post->ID,
				'text' => $post->post_title,
			);
		}

		wp_send_json( $results );
	}

	add_action( 'wp_ajax_pls_core_elementor_search_post', 'pls_core_elementor_search_post' );
	add_action( 'wp_ajax_nopriv_pls_core_elementor_search_post', 'pls_core_elementor_search_post' );
}

if ( ! function_exists( 'pls_core_elementor_render_post' ) ) {
	/**
	 * Get post title by ID
	 *
	 * @since 1.0.0
	 */
	function pls_core_elementor_render_post() {
		$ids       = isset( $_POST['id'] ) ? $_POST['id'] : array(); // phpcs:ignore
		$post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
		$results   = array();

		$query = new WP_Query(
			array(
				'post_type'      => $post_type,
				'post__in'       => $ids,
				'posts_per_page' => - 1,
				'orderby'        => 'post__in',
			)
		);

		if ( ! isset( $query->posts ) ) {
			return;
		}

		foreach ( $query->posts as $post ) {
			$results[ $post->ID ] = $post->post_title;
		}

		wp_send_json( $results );
	}

	add_action( 'wp_ajax_pls_core_elementor_render_post', 'pls_core_elementor_render_post' );
	add_action( 'wp_ajax_nopriv_pls_core_elementor_render_post', 'pls_core_elementor_render_post' );
}

if ( ! function_exists( 'pls_core_elementor_search_taxonomies' ) ) {
	/**
	 * Search taxonomies by word
	 *
	 * @since 1.0.0
	 */
	function pls_core_elementor_search_taxonomies() {
		$search_string = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : ''; // phpcs:ignore
		$taxonomy      = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : ''; // phpcs:ignore
		$results       = array();

		$args = array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'search'     => $search_string,
			'orderby' => 'include',
		);

		$terms = get_terms( $args );

		if ( is_array( $terms ) && $terms ) {
			foreach ( $terms as $term ) {
				if ( is_object( $term ) ) {
					$results[] = array(
						'id'   => $term->term_id,
						'text' => $term->name,
					);
				}
			}
		}

		wp_send_json( $results );
	}

	add_action( 'wp_ajax_pls_core_elementor_search_taxonomies', 'pls_core_elementor_search_taxonomies' );
	add_action( 'wp_ajax_nopriv_pls_core_elementor_search_taxonomies', 'pls_core_elementor_search_taxonomies' );
}

if ( ! function_exists( 'pls_core_elementor_render_taxonomies' ) ) {
	/**
	 * Get taxonomies by id
	 *
	 * @since 1.0.0
	 */
	function pls_core_elementor_render_taxonomies() {
		$ids     = isset( $_POST['id'] ) ? $_POST['id'] : array(); // phpcs:ignore
		$results = array();

		$args = array(
			'include' => $ids,
			'orderby' => 'include',
		);

		$terms = get_terms( $args );

		if ( is_array( $terms ) && $terms ) {
			foreach ( $terms as $term ) {
				if ( is_object( $term ) ) {
					$results[ $term->term_id ] = $term->name;
				}
			}
		}

		wp_send_json( $results );
	}

	add_action( 'wp_ajax_pls_core_elementor_render_taxonomies', 'pls_core_elementor_render_taxonomies' );
	add_action( 'wp_ajax_nopriv_pls_core_elementor_render_taxonomies', 'pls_core_elementor_render_taxonomies' );
}

if ( ! function_exists( 'pls_init_woocommerce_loop_hook' ) ) {
	function pls_init_woocommerce_loop_hook(){
		if( pls_elementor_is_editor_mode() ){
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			if( function_exists( 'YITH_WCWL_Frontend' ) ){
				$wcwl_obj = YITH_WCWL_Frontend();
				remove_action( 'woocommerce_before_shop_loop_item', array( $wcwl_obj, 'print_button' ), 5 );
				remove_action( 'woocommerce_after_shop_loop_item', array( $wcwl_obj, 'print_button' ), 7 );
				remove_action( 'woocommerce_after_shop_loop_item', array( $wcwl_obj, 'print_button' ),15 );		
				remove_action( 'woocommerce_single_product_summary', array( $wcwl_obj, 'print_button' ),31 );		
				remove_action( 'woocommerce_product_thumbnails', array( $wcwl_obj, 'print_button' ),21 );		
				remove_action( 'woocommerce_after_single_product_summary', array( $wcwl_obj, 'print_button' ),11 );				
			}
			if( !pls_get_option( 'product-rating', 1 ) ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			}else{
				add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			} 
		}			
	}
}