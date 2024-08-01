<?php 
/**
 * The template for displaying product size chart
 * $title
 * $content
 * $table_html
 * $chart_id
 */
 
defined( 'ABSPATH' ) || exit;
?>
<div class="pls-product-sizechart">
	<div class="sizechart-header row">
		<div class="col-12"><h2><?php echo apply_filters( 'pls_product_sizechart_popup_title', esc_html__('Size Chart', 'pls-theme') );?></h2></div>
	</div>
	<div class="product-sizechart-inner row">
		<?php if( empty ( $content ) && !$diable_chart_data ){ ?>
				<div class="col-12 pls-table-responsive"><?php echo wp_kses_post( $table_html );?></div>
		<?php } else {
			if( $diable_chart_data ){ ?>
				<div class="col-12"><?php echo do_shortcode( $content );?></div>
				<?php } else{ ?>
					<div class="col-12 col-md-6 pls-table-responsive"><?php echo wp_kses_post( $table_html );?></div>
					<div class="col-12 col-md-6"><?php echo do_shortcode( $content );?></div>
				<?php }
			} ?>
	</div>
</div>