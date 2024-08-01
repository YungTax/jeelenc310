<?php 
/**
 * Info Box Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	<div class="pls-cta-wrapper">
		
		<?php if( ! empty( $title_text ) ){ ?>
			<div class="pls-cta-title">					
				<?php if( ! empty( $icon_html ) ){ ?>
					<span class="pls-cta-icon">
						<?php echo $icon_html;?>
					</span>
				<?php } ?>
				<?php echo wp_kses_post($title_text);?>
			</div>
		<?php } ?>	
		
		<?php if(  !empty( $button_text ) ) { ?>
			<div class="pls-cta-btn pls-button">
				<a <?php echo $link_attributes;?> class="<?php echo esc_attr( $button_class );?>"><?php echo $button_text;?></a>
			</div>
		<?php } ?>
		
		<?php if( ! empty( $subtitle ) ){ ?>
			<div class="pls-cta-subtitle">			
				<?php echo wp_kses_post($subtitle);?>
			</div>
		<?php } ?>
	</div>
</div>