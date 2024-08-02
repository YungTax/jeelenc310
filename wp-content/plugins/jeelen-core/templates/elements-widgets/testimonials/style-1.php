<?php 
/**
 * Testimonial item
 */
?>

<div class="testimonial swiper-slide">
	<div class="testimonial-wrap">
		<?php if( ! empty($title)){ ?>
			<div class="testimonial-title"><?php echo esc_html($title);?></div>
		<?php }?>
		<div class="testimonial-description">
			<?php echo wp_kses_post($description);?>
		</div>
		<div class="testimonial-meta">
			<div class="testimonial-name">- <?php echo esc_html($name);?></div>
			<?php if( $rating > 0){ ?>
				<div class="testimonial-rating woocommerce"> 
					<div class="star-rating">
						<span style="width:<?php echo esc_html($rating);?>%"></span>
					</div>
				</div>
			<?php }?>
		</div>
	</div>	
</div>