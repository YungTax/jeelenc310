<?php 
/**
 * Instagram Template
 */
?>
<section id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	<div class="section-content <?php echo esc_attr( $section_class ); ?>">
		<div class="pls-instagram-wrap <?php echo esc_attr( $slider_class ); ?>" <?php if( ! empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >		
			<?php if ( ! empty( $gallery_images ) ) {
				$count 	= 0;
				$row 	= 1;
				$lastElement = end( $gallery_images );	
				$total_images = count( $gallery_images );
				$image_size = apply_filters( 'pls_instagram_image_size' , 'full' );
				foreach( $gallery_images as $index => $attchData ){
					$image_url = wp_get_attachment_image_src( $attchData['id'], $image_size );
					if( $row == 1 && $rows > 1) { 
						echo '<div class="slider-group swiper-slide">'; 
					}?>					
					<div class="pls-instagram-image <?php echo esc_attr ( $column_class );?>">
						<div class="image-wrap">
							<a href="<?php echo esc_url( $profile_link );?>" target="<?php echo esc_attr( $target ); ?>"></a>
							<?php if( wp_get_attachment_url($attchData['id'] ) ) :
								$image_output = wp_get_attachment_image( $attchData['id'], 'full', false );
								echo $image_output;
							else:?>
								<img src="<?php echo esc_url( PLS_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html_e('Gallery Image','pls-core');?>"/>
							<?php endif;?>
						</div>
					</div>
					<?php 
					if( ( $row == $rows || $gallery_images == $lastElement ) && $rows > 1 ){
						$row=0;
						echo '</div>';
					} $row++;
				}
			} ?>			
		</div>
		<?php if( $show_profile_name == 'yes' && ! empty( $profile_name ) ){ ?>
			<div class="pls-instagram-profile">
				<a href="<?php echo esc_url($profile_link); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html__( 'Follow Us ', 'pls-core' ).' '.$profile_name; ?></a>
			</div>
		<?php } ?>
	</div>
</section>