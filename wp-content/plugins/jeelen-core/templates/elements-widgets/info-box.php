<?php 
/**
 * Info Box Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	<div class="info-box-wrap" <?php echo $link_on_complete_box; ?> >
		<div class="box-icon-wrap">
			<?php if( ! empty( $icon_html ) ){ ?>
				<div class="info-box-icon"><?php echo $icon_html;?></div>
			<?php } ?>
		</div>
		<div class="info-box-content">
			<?php if( ! empty( $subtitle ) ){ ?>
				<div class="info-box-subtitle">				
					<?php echo wp_kses_post($subtitle);?>					
				</div>
			<?php } ?>
			<?php if( ! empty( $title_text ) ){ ?>
				<div class="info-box-title mb" <?php echo $link_on_box_title;?>>				
					<?php echo '<'.$title_tag.'>'.wp_kses_post($title_text).'</'.$title_tag.'>';?>					
				</div>
			<?php } ?>
			<?php if( ! empty( $description ) ){ ?>
				<div class="info-box-description mb">
					<p><?php echo wp_kses_post($description);?></p>
				</div>
			<?php } 
			if( $apply_to_link == 'display_read_more' && !empty( $read_more_text ) ) { ?>
				<div class="info-box-btn pls-button">
					<a <?php echo $link_attributes;?> class="<?php echo esc_attr( $button_class );?>"><?php echo $read_more_text;?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>