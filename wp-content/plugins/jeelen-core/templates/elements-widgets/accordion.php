<?php 
/**
 * Accordion Template
 */
?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<?php
	$i = 0;
	$active_tab = 1;
	foreach( $tabs as $section ) {
		$i++;
		$tab_id = 'elementor-tab-title-' . $id_int . $i;
		?>		
		<div class="card pls-accordion-item">
			<div class="card-header accordion-title">
				<h4 class="card-title">
					<a class="card-link <?php echo ( $i == $active_tab ) ? 'open' : '';?>" href="#<?php echo esc_attr( $tab_id ); ?>" data-style="<?php echo esc_attr($toggle_class); ?>">
					<?php echo esc_html( $section[ 'tab_title' ] ); ?>
					</a>
				</h4>
			</div>
			<div id="<?php echo esc_attr( $tab_id ); ?>" class="collapse accordion-tab-content <?php echo ( $i == $active_tab ) ? 'show' : '';?>">
				<div class="card-body">
					<?php echo do_shortcode( $section[ 'tab_content' ] ); ?>
				</div>
			</div>
		</div>
	<?php $i++; } ?>
</div>