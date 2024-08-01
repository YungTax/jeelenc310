<?php 
/***
* Banners Slider template
**/
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	<div class="<?php echo $slider_class; ?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
		<?php 
			foreach( $banners as $banners_data ){
				
				$banner_args 					= $banners_data;
				$banner_args['id'] 				= pls_uniqid('pls-banner-');
				$banner_args['subtitle_style'] 	= $banners_data['subtitle_style'];				
				
				$button_class			= array( );
				if( $banners_data['button_style'] != 'text' ){
					$button_class[] = 'button';
				}
				$button_class[]			= 'btn-style-'.$banners_data['button_style'];
				if( 'flat' == $banners_data['button_style'] || 'outline' == $banners_data['button_style'] ){
					$button_class[]			= 'btn-shape-'.$banners_data['button_shape'];
				}
				$button_class[]			= ( $banners_data['button_icon'] ) ? 'btn-icon-'.$banners_data['icon_alignment'] : '';
				$button_class[]			= ( $banners_data['button_icon'] ) ? 'btn-icon-'.$banners_data['icon_alignment'] : '';
				$banner_args['button_class'] 	= implode(' ', array_filter( $button_class ) );
				$icon_html 			= '';
				if( $banners_data['button_icon'] ) {			
					ob_start();
					Elementor\Icons_Manager::render_icon( $banners_data['selected_icon'], [ 'aria-hidden' => 'true' ]  );
					$icon_html = ob_get_clean();
				}
				$icon_html 		= $icon_html;
				
				if( $banners_data['button_icon'] && $banners_data['icon_alignment'] == 'left' ){
					$banner_args['button_text'] = $icon_html .' '.$banners_data['button_text'];
				}
				
				if( $banners_data['button_icon'] && $banners_data['icon_alignment'] == 'right' ){
					$banner_args['button_text'] = $banners_data['button_text'].' '.$icon_html;
				}
				$banner_args['icon_html'] 		= $icon_html;
				$ele_class			= array( 'pls-element', 'pls-banner','swiper-slide' );		
				$ele_class[]		= 'elementor-repeater-item-' . $banners_data['_id'];
				$ele_class[]		= !empty( $banners_data['banner_hover_effect'] ) ? 'banner-'.$banners_data['banner_hover_effect'] : '';
				
				$link_url 					= $banners_data['banner_link']['url'];
				$window_link_target 		= $banners_data['banner_link']['is_external'] ? '_blank' : '_self';
				$banner_args['link_target']	= $banners_data['banner_link']['is_external'] ? "_blank" : "_self";
				$banner_args['link_url']	= empty($link_url) ?  'javascript:voide();' : $link_url;
				$link_on_box_title = '';		
				if( empty ( $banners_data['button_text'] ) && ! empty( $link_url) ){
					$link_on_box_title = ' onclick="window.open(\''.$link_url.'\',\''.$window_link_target.'\')"';
					$ele_class[]			= 'wrap-link';
				}
								
				$banner_args['link_on_box_title']	= $link_on_box_title;
				$banner_args['class'] 				= implode(' ', array_filter( $ele_class ) );
				$banner_args['content'] 			= $banners_data['banner_content'];
				$banner_args['image_src'] 			= '';
				if ( !empty( $banners_data['banner_image']['id'] ) ) {
					$banner_args['image_src'] = pls_get_image_src($banners_data['banner_image']['id'],$banners_data['banner_image_size']);
				} elseif( !empty( $banners_data['banner_image']['url'] ) ) {
					$banner_args['image_src'] = $banners_data['banner_image']['url'];
				}
				
				pls_core_get_templates('elements-widgets/banner', $banner_args );
			}
		?>
	</div>
</div>