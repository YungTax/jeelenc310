<?php 
/**
 * Social Button Template
 */
?>
<div class="<?php echo esc_attr($class);?>">
	<?php pls_social_share( array( 'type'=> $social_type, 'style' => $social_style, 'size' => $social_icon_size ) ); ?>
</div>