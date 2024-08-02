<?php

/**
 * WCFM Functions
 *
 * @since  1.0
 */
 
add_filter( 'end_wcfm_products_manage',  'pls_wcfm_product_manage_frequently' , 160 );
add_action( 'after_wcfm_products_manage_meta_save',  'pls_wcfm_product_meta_save', 500, 2 );
add_filter( 'wcfmmp_is_allow_sold_by_review', '__return_false', 10 );

add_filter( 'wcfmmp_store_sidebar_args', 'pls_wcfm_sidebar_args' );
add_filter( 'wcfmmp_store_lists_sidebar_args', 'pls_wcfm_sidebar_args' );

if ( ! function_exists( 'pls_wcfm_sidebar_args' ) ) {
	function pls_wcfm_sidebar_args( $args ){
		$args['before_title'] = '<h3 class="widget-title">';
		$args['after_title'] = '</h3>';
		return $args;
	}
}

if ( ! function_exists( 'pls_wcfm_product_manage_frequently' ) ) {	
	function pls_wcfm_product_manage_frequently() {
		global $wp, $WCFM;
		$prefix 		= PLS_PREFIX;	
		$product_id 	= 0;
		if( isset( $wp->query_vars['wcfm-products-manage'] ) && !empty( $wp->query_vars['wcfm-products-manage'] ) ) {
			$product_id = absint( $wp->query_vars['wcfm-products-manage'] );
		} ?>
		
		<div class="page_collapsible products_manage_wc_product_pls_fbt simple variable" id="wcfm_products_manage_form_wc_product_pls_fbt_head">
			<label class="wcfmfa fa-clone"></label><?php esc_html_e('Frequently Bought Together', 'pls-theme'); ?><span></span>
		</div>
		<div class="wcfm-container simple variable">
			<div id="wcfm_products_manage_form_wc_product_pls_fbt_expander" class="wcfm-content">
				<?php
				
				$products_array 	= array();
				$pbt_product_ids 	= get_post_meta( $product_id,$prefix.'product_ids', true );	
				$pbt_product_ids 	= $pbt_product_ids ? $pbt_product_ids : array();
				
				if ( ! empty( $pbt_product_ids ) ) {
					foreach ( $pbt_product_ids as $pbt_product_id ) {
						$products_array[ $pbt_product_id ] = get_post( absint( $pbt_product_id ) )->post_title;
					}
				}
				
				$WCFM->wcfm_fields->wcfm_generate_form_field( array(
					$prefix.'product_ids' => array(
						'label'       => esc_html__( 'Frequently Bought Together', 'pls-theme' ),
						'type'        => 'select',
						'attributes'  => array( 'multiple' => 'multiple', 'style' => 'width: 60%;' ),
						'class'       => 'wcfm-select wcfm_ele simple variable',
						'label_class' => 'wcfm_title',
						'options'     => $products_array,
						'value'       => $pbt_product_ids,
					)
				) );
				
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'pls_wcfm_product_meta_save' ) ) {
	function pls_wcfm_product_meta_save( $post_id, $wcfm_products_manage_form_data ) {
		$prefix 			= PLS_PREFIX;
		$pbt_product_ids 	= ( isset( $wcfm_products_manage_form_data[$prefix.'product_ids'] ) ) ? array_map( 'intval', (array) $wcfm_products_manage_form_data[$prefix.'product_ids'] ) : array();
		update_post_meta( $post_id, $prefix.'product_ids', $pbt_product_ids );
	}
}

add_action('init','pls_wcfm_hook');

if ( ! function_exists( 'pls_wcfm_hook' ) ) {
	function pls_wcfm_hook(){
		add_filter( 'wcfmmp_is_allow_archive_product_sold_by', '__return_false' );
		$sold_by_template = pls_get_option('vendor-sold-by-template','theme');
		if( $sold_by_template == 'theme' ) {
			add_filter( 'wcfmmp_is_allow_single_product_sold_by', '__return_false' );
			add_action( 'woocommerce_shop_loop_item_title', 'pls_wcfm_loop_sold_by_label', 10 );
			add_action( 'woocommerce_single_product_summary', 'pls_wcfm_item_sold_by_label',8 );
		}
	}
}

if ( ! function_exists( 'pls_wcfm_loop_sold_by_label' ) ) {
	function pls_wcfm_loop_sold_by_label(){	
		$sold_by_loop = pls_get_option( 'enable-sold-by-in-loop' , 1 );
		if( !$sold_by_loop ) { return false; }
		pls_get_wcfm_vendor_name();	
	}
}

if ( ! function_exists( 'pls_wcfm_item_sold_by_label' ) ) {
function pls_wcfm_item_sold_by_label(){
	$sold_by_single = pls_get_option( 'enable-sold-by-in-single' , 1 );
	if( !$sold_by_single ) { return false; }
	pls_get_wcfm_vendor_name();	
}
}

if ( ! function_exists( 'pls_get_wcfm_vendor_name' ) ) {
	function pls_get_wcfm_vendor_name(){
		
		global $WCFM, $post;

		$vendor_id 		= $WCFM->wcfm_vendor_support->wcfm_get_vendor_id_from_product( $post->ID );

		if ( ! $vendor_id ) {
			return;
		}

		$shop_name   	= $WCFM->wcfm_vendor_support->wcfm_get_vendor_store_by_vendor( absint( $vendor_id ) );
		
		$store_user     = wcfmmp_get_store( $vendor_id );
		$store_info     = $store_user->get_shop_info();
		$store_name     = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : esc_html__( 'N/A', 'pls-theme' );
		$store_name     = apply_filters( 'wcfmmp_store_title', $store_name , $vendor_id );
		$store_url      = wcfmmp_get_store_url( $vendor_id );
		$sold_by_label	= apply_filters('wcfmmp_sold_by_label',esc_html__( 'Sold By : ', 'pls-theme' ));
		?>
		<div class="sold-by">
			<span class="sold-by-label"><?php echo esc_html( $sold_by_label ); ?> </span>
			<a href="<?php echo esc_url(  $store_url  ); ?>"><?php echo esc_html( $store_name ); ?></a>
		</div>
		<?php	
	}
}