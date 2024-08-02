<?php 
/**
 * Tabs Template
 */
?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<ul class="nav nav-tabs" role="tablist">
		<?php 
		$i 	= $sum = 0;
		$active_tab = 1;
		foreach( $tabs as $section ){ 
			$icon = $content_shortcode = '';
			$i++;
			$add_icon  = $section[ 'tab_icon' ]  ? true : false;		
			$icon_html 			= '';
			if( $add_icon ) {			
				ob_start();
				Elementor\Icons_Manager::render_icon( $section['selected_icon'], [ 'aria-hidden' => 'true' ]  );
				$icon_html = ob_get_clean();
			}
			$icon_html 		= $icon_html;
				
			$position_icon = isset( $section[ 'icon_alignment' ] ) ? $section[ 'icon_alignment' ] : '';
			$tab_nav_class = array('nav-link');
			if ( $i == $active_tab ){
				$tab_nav_class[] = 'active';
				$tab_nav_class[] = 'loaded';
				
			}
			
			$expanded 	= ( $i == $active_tab ) ? 'true' : 'false';	
			$tab_nav_class = array('nav-link');
			if ( $i == $active_tab ){
				$tab_nav_class[] = 'active';
				$tab_nav_class[] = 'loaded';
				
			}
			$nav_class = implode(' ',array_filter($tab_nav_class));
			$tab_id = 'pls-tab-'.$id_int.$i;
			?>
			
			<li class="nav-item">
				<a id="nav-<?php echo esc_attr( $tab_id ); ?>" 
				class="<?php echo esc_attr( $nav_class ); ?>" 
				href="#<?php echo esc_attr( $tab_id ); ?>" 
				data-href="<?php echo esc_attr( $tab_id ); ?>" 
				data-toggle="tab" role="tab" aria-controls="<?php echo esc_attr( $tab_id ); ?>" 
				aria-selected="<?php echo esc_attr($expanded);?>">
				<?php if ( $add_icon && $position_icon != 'right' ) :
					echo $icon_html;
				endif; ?>
				<?php echo esc_html( $section[ 'tab_title' ] ); ?>
				<?php if ( $add_icon && $position_icon == 'right' ) : 
					echo $icon_html;
				endif; ?>
				</a>
			</li>
		<?php } ?>
	</ul>	
	<div class="tab-content">	
		<?php $i = 0;
		$active_tab = 1;
		foreach( $tabs as $section ){  
			$i++; 
			$tab_content_class = ($i == $active_tab ) ? 'tab-pane fade show active' : 'tab-pane fade'; 
			$tab_id = 'pls-tab-'.$id_int.$i; ?>			
			<div class="<?php echo esc_attr($tab_content_class);?>"
				 id="<?php echo esc_attr( $tab_id ); ?>"
				 role="panel" aria-labelledby="nav-<?php echo esc_attr($tab_id );?>">
				<?php echo do_shortcode( $section[ 'tab_content' ] ); ?>
			</div>
		<?php } ?>
	</div>
</div>