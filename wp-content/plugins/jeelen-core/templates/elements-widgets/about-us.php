<?php 
/*
 * About Us Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	
	<?php if( ! empty( $logo_html ) ){
		echo '<p class="pls-about-logo"><a href="'.esc_url($our_site_url) .'">'.$logo_html.'</a></p>';
	}
	
	if( ! empty( $support_text ) || ! empty( $support_number ) ) {
		echo '<div class="pls-about-us-support">';
			if( ! empty( $support_icon ) ) {
				echo '<span class="pls-about-support-icon">'. $support_icon  .'</span>';
			}
			if( ! empty( $support_text ) || ! empty( $support_number ) ) {
				echo '<div class="pls-about-support-detail">';
					if( ! empty( $support_text ) ) {
						echo '<span class="pls-about-support-text">'. esc_html( $support_text ) .'</span>';
					}
					if( ! empty( $support_number ) ) {
						echo '<span class="pls-about-support-number">'. esc_html( $support_number ) .'</span>';
					}
				echo '</div>';
			}
		echo '</div>';
	}
		
	if( ! empty( $tagline ) ) {
		echo '<div class="pls-about-us-tagline">'. wp_kses_post( $tagline ) .'</div>';	
	}?>
	
	<ul class="pls-about-us">
		<?php if( ! empty( $address ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Address:', 'pls-core' ).'</span><span>'. esc_html($address) .'</span></li>';
		} ?>
		
		<?php if( ! empty( $phone_number ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Phone:', 'pls-core' ).'</span><span>'. esc_html($phone_number) .'</span></li>';
		} ?>
		
		<?php if( ! empty( $fax_number ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Fax:', 'pls-core' ).'</span><span>'. esc_html($fax_number) .'</span></li>';
		} ?>
		
		<?php if( ! empty( $email_address ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Email:', 'pls-core' ).'</span><span>';
			if(is_email($email_address)){
				echo '<a href="mailto:'. esc_attr($email_address).' ">'.esc_html($email_address) .'</a>';
			}else{
				echo esc_html__( 'Invalid Email Address', 'pls-core' );
			}
			echo '</span>';
			echo '</li>';
		} ?>
		
		<?php if( ! empty( $website ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Website:', 'pls-core' ).'</span><span><a href="'.esc_url($website) .'">'.  esc_html( $website ) .'</a></span></li>';
		}?>
		
		<?php if( ! empty( $days_hours ) ){
			echo '<li><span class="pls-about-us-title">'. esc_html__('Time:', 'pls-core' ).'</span><span>'. esc_html($days_hours) .'</span></li>';
		} ?>
	</ul>
</div>