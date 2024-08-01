<?php 
/**
 * Instagram Template
 */

if ( is_wp_error($instagram_data) ) {
	   echo esc_html( $instagram_data->get_error_message() );
}else{ ?>
	<section id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
		<div class="section-content <?php echo esc_attr( $section_class ); ?>">
			<div class="pls-instagram-wrap <?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >		
				<?php $count = 0; $username = '';
				foreach( $instagram_data as $item ) {
					if( $rows > 1 && $count % $rows == 0 ) {
						echo '<div class="slider-group swiper-slide">';
					}
					$username 	= $item['username'];
					$image_url 	= $item['image_url']; ?>					
					<div class="pls-instagram-image <?php echo esc_attr($column_class); ?>">					
						<div class="image-wrap">
							<a href="<?php echo esc_url( $item['image_link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
							<?php echo pls_get_src_image_loaded($image_url);?>
						</div>
					</div>					
					<?php if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $number_of_photos - 1) ){
						echo '</div>';
					} $count++;
				} ?>			
			</div>
			<?php if( $show_profile_name == 'yes' && ! empty( $profile_name ) ){ ?>
				<div class="pls-instagram-profile">
					<a href="<?php echo esc_url($profile_link); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html__( 'Follow Us ', 'pls-core' ).' '.$profile_name; ?></a>
				</div>
			<?php } ?>
		</div>
	</section>
<?php }