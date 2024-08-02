<?php 
/***
* Products Tabs Template
**/

if( empty( $tabs ) )  return; ?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-heading">	
		<div class="nav-tabs-wrapper">			
			<ul class="nav nav-tabs">
				<?php $i = 1;
				foreach($tabs as $tab_data){ 					
					$class 		= ($i == 1) ? 'nav-link active' : 'nav-link';
					$expanded 	= ($i == 1) ? 'true' : 'false'; ?>
					<li class="nav-item" <?php if( $enable_ajax ){ ?> data-attribute="<?php echo esc_attr($tab_data['data']); ?>" <?php } ?>>
						<a id="nav-<?php echo esc_html($tab_data['id']);?>" class="<?php echo esc_attr($class);?>" href="#<?php echo esc_html($tab_data['id']);?>" data-href="<?php echo esc_html($tab_data['id']);?>" data-toggle="tab"><?php echo esc_html($tab_data['title']);?></a>
					</li>
					<?php 
					$i++;
				}?>
			</ul>
		</div>
	</div>
	<div class="tab-content woocommerce">
	
		<?php $i = 1;
		
		foreach( $tabs as $tab_data ){
			pls_set_loop_prop( 'products_view', 'grid-view' );
			if( $layout == 'grid' ){
				pls_set_loop_prop( 'products-columns', $grid_columns );
				pls_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
				pls_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
				wc_set_loop_prop( 'columns', $grid_columns );
				$rows = 1;
			}else{
				pls_set_loop_prop('name','pls-slider');
				pls_set_loop_prop('products_view','grid-view');
				pls_set_loop_prop( 'products-columns', $slides_to_show );
				pls_set_loop_prop( 'slider_navigation', $slider_navigation );
				pls_set_loop_prop( 'slider_dots', $slider_dots );
				pls_set_loop_prop( 'slides_to_show', $slides_to_show );
				pls_set_loop_prop( 'slides_to_show_tablet', $slides_to_show_tablet );
				pls_set_loop_prop( 'slides_to_show_mobile', $slides_to_show_mobile );
				$unique_id 	= pls_uniqid( 'section-' );
				pls_set_loop_prop( 'unique_id', $unique_id );
				pls_set_loop_prop( 'slider_options', $slider_data );
			}
			pls_set_loop_prop( 'product_rows', $rows );
			pls_set_loop_prop( 'count', 0 );
			$class = ($i == 1) ? 'tab-pane fade show active' : 'tab-pane fade'; ?>
			
			<div id="<?php echo esc_attr($tab_data['id']);?>" class="<?php echo esc_attr($class);?>">			
				<?php
					echo do_shortcode( '[products ' . $tab_data['shortcodestr'] . ']'  );
					wp_reset_postdata();
					pls_reset_loop()
				?>				
			</div>
			<?php 
			if( $enable_ajax ){ 
				break;
			}
			$i++; 
		} ?>
	</div>
</div>