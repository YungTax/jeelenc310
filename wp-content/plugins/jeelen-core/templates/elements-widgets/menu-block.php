<?php 
/*
 * List template
 */
?>
<ul id="<?php echo esc_attr( $id ); ?>" class="pls-menu-element pls-megamenu-list">
	<li class="menu-item">
		<?php $link_attributes = isset($link) ? pls_core_elementor_get_url_attribute($link) : '';
		if( !empty( $link_attributes ) ){ ?>
			<a class="nav-link " <?php echo $link_attributes;?>>
				<?php echo esc_html( $title ); ?>
				<?php if( !empty( $label_text ) ){ ?>
				<span class="pls-menu-badge"><?php echo esc_html($label_text);?></span>
				<?php } ?>
			</a>
		<?php } ?>	
		<?php if( !empty( $menu_items ) ){ ?>
			<ul class="pls-sub-megamenu">
				<?php foreach ( $menu_items as $item ): ?>
					<li class="menu-item">
						<?php $link_attributes = isset($item['link']) ? pls_core_elementor_get_url_attribute($item['link']) : '';
						if( !empty( $link_attributes ) ){ ?>
							<a class="nav-link " <?php echo $link_attributes;?>>
								<span class="pls-menu-text"><?php echo esc_html( $item['title'] ); ?></span>
								<?php if( ! empty( $item['label_text'] ) ){?>
									<span class="pls-menu-badge elementor-repeater-item-<?php echo esc_attr($item['_id']);?>"><?php echo esc_html($item['label_text']);?></span>
								<?php } ?>
							</a>
						<?php } ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php } ?>
	</li>
</ul>