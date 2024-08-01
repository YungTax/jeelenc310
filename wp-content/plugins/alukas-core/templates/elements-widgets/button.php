<?php 
/**
 * Button Template
 */
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class );?>">
	<a class="<?php echo esc_attr( $button_class );?>" href="<?php echo $link_url;?>" <?php echo $target . $nofollow;?>>
		<?php if( $button_icon && 'left' == $icon_alignment ){
			echo $icon_html;
		}
		echo $text;
		if( $button_icon && 'right' == $icon_alignment ){
			echo $icon_html;
		} ?>
	</a>
</div>
