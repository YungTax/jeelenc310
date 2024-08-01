<?php 
/**
 * Testimonials Template
 */
?>
<div class="element-wrap">
	<div class="section-content">
		<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class ); ?>">	
			<div class="<?php echo $slider_class;?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
				<?php foreach( $testimonials_items as $client_data ) {
					$testimonial_args = $client_data;
					$testimonial_args['id'] 			= pls_uniqid('pls-team-member-');
					$testimonial_args['style'] 			= $style;
									
					$testimonial_args['image'] 			= '';
					$testimonial_args['rating']			= 100 * $client_data['rating'] / 5;
					if( !empty( $client_data['image']['id'] ) ){
						$image_output 		= wp_get_attachment_image( $client_data['image']['id'],  'full', false );
						$testimonial_args['image'] 		= $image_output;
					}elseif( !empty( $client_data['image']['url'] ) ){
						$testimonial_args['image'] 		= '<img src="'.$client_data['image']['url'].'"/>';
					}					
					pls_core_get_templates('elements-widgets/testimonials/'.$style, $testimonial_args );
				} ?>
			</div>			
		</div>		
	</div>
</div>