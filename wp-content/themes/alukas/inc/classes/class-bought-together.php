<?php
if ( ! class_exists( 'PLS_Bought_Together' ) ) {

	class PLS_Bought_Together{
		private $prefix = PLS_PREFIX;
		function __construct() {
			if( ! class_exists( 'WooCommerce' ) ) return;
		    //Admin hook
			// Add Prodcut Frequently Buy Tab
			add_action( 'woocommerce_product_data_tabs', array( $this, 'bought_panel_tab' ) );
			add_action( 'woocommerce_product_data_panels', array( $this, 'bought_panel_data' ) );
			add_action( 'woocommerce_process_product_meta', array( $this, 'bought_save_data' ) );
			
		}
		
		public function bought_panel_tab($tabs){	
			if(!$this->is_enable_FBT()){ 
				return $tabs;
			}
			$tabs['pls_fbt_product'] = array(
				'label'  => esc_html__( 'Frequently Bought Together', 'pls-theme' ),
				'target' => 'bought_together_data',
				'class'  => array( 'show_if_simple', 'show_if_variable' ),
			);
			return $tabs;
		}
		
		public function bought_panel_data( $post_id ){
			if( !$this->is_enable_FBT() ){ 
				return;
			}
			global $post;
			$post_id			= $post->ID;
			$selected_products	= get_post_meta( $post_id,$this->prefix.'product_ids', true ); ?>
			
			<div id="bought_together_data" class="panel woocommerce_options_panel">
				<div class="options_group">
					<p class="form-field">
						<label for="grouped_products"><strong><?php esc_html_e( 'Select Products', 'pls-theme' ); ?></strong></label>
						<select class="wc-product-search  short" multiple="multiple" style="width: 50%;" id="<?php echo esc_attr($this->prefix);?>bundle_products" name="<?php echo esc_attr($this->prefix);?>product_ids[]" data-sortable="true" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'pls-theme' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
							<?php 							
							if(!empty($selected_products)){
								foreach ( $selected_products as $product_id ) {
									$product = wc_get_product( $product_id );
									if ( is_object( $product ) ) {
										echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
									}
								}
							}?>
						</select> <?php echo wc_help_tip( esc_html__( 'Choose products which you recommend to be bought along with this product.', 'pls-theme' ) ); ?>
					</p>
				</div>
			</div>
			<?php
		}
		
		public function bought_save_data($product_id) {
			if(!$this->is_enable_FBT()){ 
				return $tabs;
			}
			$data =  isset($_POST[$this->prefix.'product_ids']) ? $_POST[$this->prefix.'product_ids'] : array();			
			update_post_meta( $product_id,$this->prefix.'product_ids', $data );
		}
		
		public function is_enable_FBT(){
			$bought_together = pls_get_option( 'single-product-bought-together', 1 );
			if($bought_together){
				return true;
			}
			return false;
		}
	}
	$obj_bought_together = new PLS_Bought_Together();
}