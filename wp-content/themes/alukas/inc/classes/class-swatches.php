<?php
if ( ! class_exists( 'PLS_Swatches' ) ) {

	class PLS_Swatches{
		public $prefix 			= PLS_PREFIX;
		private $cat_sidebars	= array();
		function __construct() {
			
			/*Swatches fronted display*/		
			$this->init();
			
			add_action( 'woocommerce_variable_add_to_cart', array( $this, 'enqueue_variable_script' ) );
			
			$this->cat_sidebars[''] = esc_html__( 'Default', 'pls-theme' );
			global $wp_registered_sidebars;			
			if ( $wp_registered_sidebars ) {
				foreach ( $wp_registered_sidebars as $sidebar ) {
					$this->cat_sidebars[ $sidebar['id'] ] = $sidebar['name'];
				}
			}
		
			/*Swatches admin options*/			
			/* add attribute */
			add_filter('woocommerce_after_add_attribute_fields', array( $this,'add_attribute_swatch_size_selector'),10, 3 );
			add_action( 'woocommerce_attribute_added', array( $this, 'save_attribute_swatch_size' ), 10, 2 );

			/* edit attribute */
			add_filter('woocommerce_after_edit_attribute_fields', array( $this,'edit_attribute_swatch_size_selector'),10, 3 );
			add_action( 'woocommerce_attribute_updated', array( $this, 'save_attribute_swatch_size' ), 10,2);
			
			/* delete attribute */
			add_action( 'woocommerce_attribute_deleted', array( $this, 'delete_attribute_swatch_size' ), 10, 1 );
			
			/* Product attribute meta */
			$attribute_taxonomies = $this->wc_get_attribute_taxonomies();

			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $attribute ) {
					add_action( 'pa_' . $attribute->attribute_name . '_add_form_fields', array( $this, 'taxonomy_add_new_meta_field' ) );
					add_action( 'pa_' . $attribute->attribute_name .'_edit_form_fields', array( $this, 'taxonomy_edit_meta_field' ), 10 );
					
					// Save taxonomy fields
					add_action('edited_pa_'.$attribute->attribute_name, array($this, 'save_attr_extra_fields'));
					add_action('create_pa_'.$attribute->attribute_name, array($this, 'save_attr_extra_fields'));
				}
			}
			
			//Clear cache
			add_action( 'save_post', array( $this, 'clear_swatches_cache_save_post' ) );
			add_action( 'woocommerce_before_product_object_save', array( $this, 'clear_swatches_cache_product_object_save' ) );
			
			
		}
		public function enqueue_variable_script() {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
		
		public function init() {			
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'product_swatches' ) , 15 );
		}
		
		/**
		 * Show swatches
		 */
		public function product_swatches() {
			global $product;
			if ( $product->is_type( 'variable' ) ) {
				$attributes				= $product->get_attributes();
				$available_variations	= $product->get_available_variations();
				$variation_attributes	= $product->get_variation_attributes();
				$selected_attributes 	= $product->get_default_attributes();
				$is_loop = current_filter() == 'woocommerce_after_shop_loop_item';

				$args = array(
					'is_loop'              => $is_loop,
					'attributes'           => $attributes,
					'available_variations' => $available_variations,
					'variation_attributes' => $variation_attributes,
					'selected_attributes'  => $selected_attributes,
				);
				if ( $is_loop ) {
					$this->swatch_loop($args);
				}
			}			
		}
		public function swatch_loop( $args ){			
			
			if( ! pls_get_option( 'product-variations', 0 ) || 'product-style-3' == pls_get_loop_prop( 'product-style' ) ) {
				return; 
			}
			
			global $product;
			extract($args);	?>
			<div class="product-variations">
				<div class="pls-swatches-wrap" <?php if ( has_post_thumbnail() ) {
				$srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'shop_catalog' );
				$sizes  = wp_get_attachment_image_sizes( get_post_thumbnail_id(), 'shop_catalog' );
				echo  'data-srcset="' . esc_attr( $srcset ) . '" data-sizes="' . esc_attr( $sizes ) . '" data-product_id="' . esc_attr( get_the_ID() ) . '"';
				$available_variations = $this->swatch_variations( $available_variations );
				} ?> data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
					<?php 
					foreach ( $attributes as $attribute_name => $options ) {
						
						if ( $options['is_variation'] == 1) {
							$output 		= '';
							$enable_swatch 	= $this->has_enable_switch($attribute_name);						
							$swatches_html 	= '';
							if($enable_swatch){
								$class			= 'pls-hidden';
								$terms 			= wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );
								$swatches_html	= $this->swatch_html($output,$terms,$options, $attribute_name, $selected_attributes, $product);
								if ( ! empty( $swatches_html ) ){ ?>
									<div class="pls-swatches" data-attribute="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
										<?php echo wp_kses( $swatches_html, pls_allowed_html(array('span','img')) ); ?>
									</div> <?php
								}
							}
						}
					}?>
					
					<a class="reset_variations reset_variations--loop" href="#" style="display: none;"><?php esc_html_e( 'Clear', 'pls-theme' ); ?></a>
				</div>
			</div>
			<?php
		}
		
		/**
		 * Customize product variations
		 *
		 * @param $variations
		 *
		 * @return array
		 */
		public function swatch_variations( $variations ) {

			$new_variations = array();
			foreach ( $variations as $variation ) {
				if ( $variation['variation_id'] != '' ) {
					$id							= get_post_thumbnail_id( $variation['variation_id'] );
					$src						= wp_get_attachment_image_src( $id, 'shop_catalog' );
					$srcset 					= wp_get_attachment_image_srcset( $id, 'shop_catalog' );
					$sizes  					= wp_get_attachment_image_sizes( $id, 'shop_catalog' );
					$variation['image_src']		= $src;
					$variation['image_srcset']	= $srcset;
					$variation['image_sizes']	= $sizes;
					$new_variations[] = $variation;
				}
			}
			return $new_variations;
		}
		
		public function has_enable_switch($attribute_name){
			$prefix = PLS_PREFIX;
			$enable_swatch = get_option($prefix.$attribute_name.'_enable_swatch',false);
			if( !empty( $enable_swatch ) && $enable_swatch ){
				return true;
			}
			return false;
		}
		
		public function swatch_html($html,$terms,$options, $attribute_name, $selected_attributes, $product){

			if ( isset( $_REQUEST[ 'attribute_' . $attribute_name ] ) ) {
				$selected_value = $_REQUEST[ 'attribute_' . $attribute_name ];
			} elseif ( isset( $selected_attributes[ $attribute_name ] ) ) {
				$selected_value = $selected_attributes[ $attribute_name ];
			} else {
				$selected_value = '';
			}	
			foreach ( $terms as $term ) {
				$html .= $this->get_swatch_html($term,$selected_value,$attribute_name, $product);
			}
			return $html;
		}
		
		/* Function get switch html*/
		public function get_swatch_html($term,$selected_value ='',$attribute_name = '',$product = null){
			$html 					= '';
			$prefix 				= $this->prefix;
			$swatch_display_style 	= get_option($prefix.$attribute_name.'_swatch_display_style',true);
			$swatch_display_type 	= get_option($prefix.$attribute_name.'_swatch_display_type',true);
			$swatch_size 			= get_option($prefix.$attribute_name.'_swatch_display_size',true);
			$name     				= esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );
				$selected = sanitize_title( $selected_value ) == $term->slug ? 'swatch-selected' : '';
				if($swatch_display_type == 'color'){			
					$color = get_term_meta( $term->term_id,  $prefix.'color', true );
					list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
					$html .= sprintf(
					'<span class="swatch-term swatch swatch-color term-%s swatch-%s swatch-%s %s"  title="%s" data-term="%s"><span class="pls-tooltip" style="background-color:%s;color:%s;">%s</span></span>',
					esc_attr( $term->slug ),
					$swatch_display_style,
					$swatch_size,
					$selected,					
					esc_attr( $name ),
					esc_attr( $term->slug ),
					esc_attr( $color ),
					"rgba($r,$g,$b,0.5)",
					$name
					);
				}else if($swatch_display_type == 'image'){
					$image = get_term_meta( $term->term_id, $prefix.'attachment_id', true );
					
					$show_variation_image = apply_filters( 'pls_show_variation_image', true );
					if( $show_variation_image ) {						
						$pid 	= $product->get_id();
						$cache_enabled = apply_filters( 'pls_has_swatches_cache', true );
						$transient_name     = 'pls_swatches_cache_' . $pid;						
						if ( $cache_enabled ) {
							$available_variations = get_transient( $transient_name );
						} else {
							$available_variations = array();
						}
						
						if ( ! $available_variations ) {					
							$available_variations = $product->get_available_variations();
							if ( $cache_enabled ) {
								set_transient( $transient_name, $available_variations, apply_filters( 'pls_swatches_cache_time', WEEK_IN_SECONDS ) );
							}
						}
						if ( empty( $available_variations ) ) {
							return;
						}
						foreach ( $available_variations as $variation ) {
							if ( $variation['attributes'][ 'attribute_' . $attribute_name ] == $term->slug ) {
								$data_var_id = $variation['variation_id'];
							}
						}
						$variation = new WC_Product_Variation( $data_var_id );
						$image_id = $variation->get_image_id(); 
						
						if($image_id){
							$image = $image_id;
						}
					}
					
					$image = $image ? wp_get_attachment_image_src( $image ) : '';
					$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
					$html  .= sprintf(
						'<span class="swatch-term swatch swatch-image term-%s swatch-%s swatch-%s %s" title="%s" data-term="%s"><img src="%s" alt="%s"></span>',
						esc_attr( $term->slug ),
						$swatch_display_style,
						$swatch_size,
						$selected,
						esc_attr( $name ),
						esc_attr( $term->slug ),
						esc_url( $image ),
						esc_attr( $name )
					);
				}else{
					$label = get_term_meta( $term->term_id, 'label', true );
					$label = $label ? $label : $name;
					if( $swatch_display_style == 'square' ){
						$swatch_size = 'default';
					}
					$html  .= sprintf(
						'<span class="swatch-term swatch swatch-label term-%s swatch-%s swatch-%s %s" title="%s" data-term="%s"><span>%s</span></span>',
						esc_attr( $term->slug ),
						$swatch_display_style,
						$swatch_size,
						$selected,
						esc_attr( $name ),
						esc_attr( $term->slug ),
						esc_html( $label )
					);
				}
			return apply_filters('pls_single_swatch_html',$html,$term,$selected_value);
		}
		
		/**
		 * Function to add attribute
		*/
		public function add_attribute_swatch_size_selector() {
		?>
			<div class="form-field">
				<label for="pls_swatch_enable"><?php echo esc_html__('Enable swatch','pls-theme')?></label>
				<input id="pls_swatch_enable" type="checkbox" name="<?php echo esc_attr($this->prefix);?>enable_swatch" value="1">
				<p class="description"><?php echo esc_html__('Attribute dropdown will be replaces with swatches.','pls-theme')?></p>
			</div>
			<div class="form-field">
				<label for="pls_swatch_size"><?php echo esc_html__('Attributes swatch size','pls-theme')?></label>
				<select id="pls_swatch_size" name="<?php echo esc_attr($this->prefix);?>swatch_display_size" class="pls_swatch_display_size">
					<option value="normal"><?php echo esc_html__('Normal','pls-theme')?></option>
					<option value="small"><?php echo esc_html__('Small','pls-theme')?></option>
					<option value="large"><?php echo esc_html__('Large','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select display swatches size for terms of this attribute.','pls-theme')?></p>
			</div>
			<div class="form-field">
				<label for="pls_swatch_display_style"><?php echo esc_html__('Swatch display style','pls-theme')?></label>
				<select id="pls_swatch_display_style" name="<?php echo esc_attr($this->prefix);?>swatch_display_style" class="pls_swatch_display_style">
					<option value="square"><?php echo esc_html__('Square','pls-theme')?></option>
					<option value="circle"><?php echo esc_html__('Circle','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select swatches display style.','pls-theme')?></p>
			</div>
			<div class="form-field">
				<label for="pls_swatch_display_type"><?php echo esc_html__('Swatch display type','pls-theme')?></label>
				<select id="pls_swatch_display_type" name="<?php echo esc_attr($this->prefix);?>swatch_display_type" class="pls_swatch_display_type">
					<option value="color"><?php echo esc_html__('Color','pls-theme')?></option>
					<option value="image"><?php echo esc_html__('Image','pls-theme')?></option>
					<option value="label"><?php echo esc_html__('Label','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select swatches display type.','pls-theme')?></p>
			</div>
		<?php
		}
		
		/**
		 * Function to save attribute
		*/
		function save_attribute_swatch_size($attribute_id,$attribute) {
			
			$prefix = $this->prefix; // Taking metabox prefix
			$attribute_id = (int)$attribute_id;
			
			$enable_swatch 			= isset($_POST[$prefix.'enable_swatch']) ? $_POST[$prefix.'enable_swatch'] : 0 ;
			$swatch_display_size 	= isset($_POST[$prefix.'swatch_display_size']) ? $_POST[$prefix.'swatch_display_size'] : 'normal';
			$swatch_display_style 	= isset($_POST[$prefix.'swatch_display_style']) ? $_POST[$prefix.'swatch_display_style'] : 'square';
			$swatch_display_type 	= isset($_POST[$prefix.'swatch_display_type']) ? $_POST[$prefix.'swatch_display_type'] : 'label';
			
			update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_enable_swatch', $enable_swatch );
			update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_size', $swatch_display_size );	
			update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_style', $swatch_display_style );
			update_option( $prefix.'pa_' . $attribute['attribute_name'] .'_swatch_display_type', $swatch_display_type);
		}
		
		/**
		 * Function to edit attribute
		*/
		function edit_attribute_swatch_size_selector( $term,$attribute=null,$old_attribute=null) {
			$prefix = $this->prefix; // Taking metabox prefix
			
			//getting term ID
			$attribute_id 	= absint( $_GET['edit'] );
			$attribute_data = $this->get_tax_attribute($attribute_id);
			
			// Getting stored values
			$swatch_display_size	= get_option( $prefix.'pa_' . $attribute_data->attribute_name .'_swatch_display_size', true );
			$enable_swatch			= get_option( $prefix.'pa_' . $attribute_data->attribute_name .'_enable_swatch', true );
			$swatch_display_style	= get_option( $prefix.'pa_' . $attribute_data->attribute_name .'_swatch_display_style', true );
			$swatch_display_type	= get_option( $prefix.'pa_' . $attribute_data->attribute_name .'_swatch_display_type', true );
			   
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls_swatch_enable"><?php echo esc_html__('Enable swatch','pls-theme')?></label></th>
				<td>
					<input id="pls_swatch_enable" type="checkbox" name="<?php echo esc_attr($this->prefix);?>enable_swatch" value="1" <?php checked($enable_swatch,'1')?>>
					<p class="description"><?php echo esc_html__('Attribute dropdown will be replaces with swatches.','pls-theme')?></p>
				</td>
			</tr>  
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls_swatch_display_size"><?php echo esc_html__('Attributes swatch size','pls-theme')?></label></th>
			<td>
				<select name="<?php echo esc_attr($this->prefix);?>swatch_display_size" id="pls_swatch_display_size" class="pls_swatch_display_size">
					<option value="normal" <?php selected('normal',$swatch_display_size);?>><?php echo esc_html__('Normal','pls-theme')?></option>
					<option value="small" <?php selected('small',$swatch_display_size);?>><?php echo esc_html__('Small','pls-theme')?></option>
					<option value="large" <?php selected('large',$swatch_display_size);?>><?php echo esc_html__('Large','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select display swatches size for terms of this attribute.','pls-theme')?></p>
			</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls_swatch_display_style"><?php echo esc_html__('Swatch display style','pls-theme')?></label></th>
			<td>
				<select id="pls_swatch_display_style" name="<?php echo esc_attr($this->prefix);?>swatch_display_style" class="pls_swatch_display_style">
					<option value="square" <?php selected('square',$swatch_display_style);?>><?php echo esc_html__('Square','pls-theme')?></option>
					<option value="circle" <?php selected('circle',$swatch_display_style);?>><?php echo esc_html__('Circle','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select swatches display style.','pls-theme')?></p>
			</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls_swatch_display_type"><?php echo esc_html__('Swatch display type','pls-theme')?></label></th>
			<td>
				<select id="pls_swatch_display_type" name="<?php echo esc_attr($this->prefix);?>swatch_display_type" class="pls_swatch_display_type">
					<option value="color" <?php selected('color',$swatch_display_type);?>><?php echo esc_html__('Color','pls-theme')?></option>
					<option value="image" <?php selected('image',$swatch_display_type);?>><?php echo esc_html__('Image','pls-theme')?></option>
					<option value="label" <?php selected('label',$swatch_display_type);?>><?php echo esc_html__('Label','pls-theme')?></option>
				</select>
				<p class="description"><?php echo esc_html__('Select swatches display type.','pls-theme')?></p>
			</td>
			</tr>  
			<?php
		}
		
		/**
		 * Function to delete attribute
		*/
		public function delete_attribute_swatch_size($attribute_id){
			$prefix 		= $this->prefix; // Taking metabox prefix
			$attribute_id	= (int)$attribute_id;
			delete_option( $prefix.'pa_' . $attribute_id .'_swatch_display_size');		
			delete_option( $prefix.'pa_' . $attribute_id .'_enable_swatch');		
			delete_option( $prefix.'pa_' . $attribute_id .'_swatch_display_style');		
			delete_option( $prefix.'pa_' . $attribute_id .'_swatch_display_type');		
		}
		
		/**
		 * Get attribute taxonomies.
		 *
		 * @return array of objects
		 */
		function wc_get_attribute_taxonomies() {
			$attribute_taxonomies = get_transient( 'wc_attribute_taxonomies' );
			if ( false === $attribute_taxonomies ) {
				global $wpdb;
				$attribute_taxonomies = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name != '' ORDER BY attribute_name ASC;" );
				set_transient( 'wc_attribute_taxonomies', $attribute_taxonomies );
			}
			return (array) array_filter( apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies ) );
		}
		
		/**
		 * Function to add taxonomy meta field
		*/
		function taxonomy_add_new_meta_field() {
			$prefix = $this->prefix; // Taking metabox prefix
		?>
			<div class="form-field">
				<label for="pls-image"><?php echo esc_html__('Upload Image', 'pls-theme'); ?></label>
				<input type="hidden" class="pls-attachment-id" name="<?php echo esc_attr( $prefix );?>attachment_id">
				<img class="pls-attr-img" src="<?php echo esc_url( wc_placeholder_img_src() );?>" alt="<?php echo esc_attr__('Upload/Add image','pls-theme')?>" height="50px" width="50px">
				<button class="pls-image-upload button" type="button"><?php echo esc_html__('Upload/Add image','pls-theme');?></button>
				<button class="pls-image-clear button" type="button" data-src="<?php echo esc_url( wc_placeholder_img_src() );?>"><?php esc_html_e('Remove image','pls-theme');?></button>
				 <p class="description"><?php esc_html_e('Upload image for this value.', 'pls-theme'); ?></p>
			</div>
			
			<div class="form-field">
				<label for="pls-color"><?php esc_html_e('Select Color', 'pls-theme'); ?></label>
				<input type="text" name="<?php echo esc_attr( $prefix );?>color" id="pls-color-picker" class="pls-color-picker pls-color-box" />
				<p class="description"><?php esc_html_e('Select color for this value.', 'pls-theme'); ?></p>
			</div>
			<script>
			jQuery( document ).ajaxComplete( function( event, request, options ) {
				if ( request && 4 === request.readyState && 200 === request.status
					&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

					var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
					if ( ! res || res.errors ) {
						return;
					}
					// Clear Thumbnail fields on submit
					jQuery( '.pls-attr-img').attr( 'src', '<?php echo esc_url(wc_placeholder_img_src()); ?>' );
					jQuery( '.pls-attachment-id' ).val( '' );
					//jQuery( '.pls-color-box' ).val( '' );
					/* Color Picker */
					if( jQuery('.pls-color-box').length > 0 ) {
						var myOptions = {defaultColor: false}; 
						jQuery('.pls-color-box').wpColorPicker(myOptions);
					}
					return;
				}
			} );
			</script>
		<?php
		}
		
		/**
		 * Function to edit taxonomy meta field
		*/
		function taxonomy_edit_meta_field( $term ) {		
			$prefix = $this->prefix; // Taking metabox prefix	    
			//getting term ID
			$term_id = $term->term_id;
			// Getting stored values
			$attachment_id	= get_term_meta($term_id, $prefix.'attachment_id', true);    
			$color			= get_term_meta($term_id, $prefix.'color', true); 
			$image			= wc_placeholder_img_src();
			if(!empty($attachment_id)){
				$image = pls_get_image_src( $attachment_id,'thumnail');
			}		
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls-attr-image"><?php esc_html_e('Upload Image', 'pls-theme'); ?></label></label></th>
				<td>
					<input type="hidden" class="pls-attachment-id" value="<?php echo esc_attr($attachment_id);?>" name="<?php echo esc_attr( $prefix );?>attachment_id">
					<img class="pls-attr-img" src="<?php echo esc_url($image);?>" alt="<?php esc_attr_e('Upload/Add image','pls-theme')?>" height="50px" width="50px">
					<button class="pls-image-upload button" type="button"><?php esc_html_e('Upload/Add image','pls-theme');?></button>
					<button class="pls-image-clear button" type="button" data-src="<?php echo wc_placeholder_img_src();?>"><?php esc_html_e('Remove image','pls-theme');?></button>
					<p class="description"><?php esc_html_e('Upload image for this value.', 'pls-theme'); ?></p>
				</td>
			</tr>  
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pls-color"><?php esc_html_e('Select Color', 'pls-theme'); ?></label></th>
				<td>
					<input type="text" name="<?php echo esc_attr( $prefix );?>color" value="<?php echo esc_attr($color);?>" id="pls-color-picker" class="pls-color-picker pls-color-box" />
					<p class="description"><?php esc_html_e('Select color for this value.', 'pls-theme'); ?></p>
				</td>
			</tr>  
			<?php
		}
		
		/**
		 * Function to save taxonomy meta field
		*/
		function save_attr_extra_fields($term_id) {

			$prefix 		= $this->prefix; // Taking metabox prefix
			$attachment_id 	= !empty($_POST[$prefix.'attachment_id']) ? $_POST[$prefix.'attachment_id'] : '';
			$color			= !empty($_POST[$prefix.'color']) ? $_POST[$prefix.'color'] : '';

			update_term_meta($term_id, $prefix.'attachment_id', $attachment_id);
			update_term_meta($term_id, $prefix.'color', $color);
		}
		
		/**
		 * Function to save taxonomy meta field
		*/
		public function get_tax_attribute( $attribute_id ) {
			global $wpdb;
			$attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_id = '$attribute_id'" );
			return $attr;
		}
		
		function clear_swatches_cache_save_post($post_id){
			if ( ! apply_filters( 'pls_has_swatches_cache', true ) ) {
				return;
			}
			$transient_name     = 'pls_swatches_cache_' . $post_id;
			delete_transient( $transient_name );
		}
		
		function clear_swatches_cache_product_object_save($product){
			if ( ! apply_filters( 'pls_has_swatches_cache', true ) ) {
				return;
			}
			$post_id			= $product->get_id();
			$transient_name		= 'pls_swatches_cache_' . $post_id;
			delete_transient( $transient_name );
		}
		
	}
	function pls_swatch_class_init(){
		$obj_swatches = new PLS_Swatches();
	}
	add_action( 'init', 'pls_swatch_class_init');	
}