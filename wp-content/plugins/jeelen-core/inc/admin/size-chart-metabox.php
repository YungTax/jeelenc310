<?php 
/**
 * Handles Post Setting metabox HTML
 *
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//https://codeb.it/edittable/
// Add an nonce field so we can check for it later.
wp_nonce_field( 'pls_size_chart', 'pls_size_chart' );

global $post;
$prefix 			= PLS_PREFIX; // Metabox prefix
$chart_table 		= get_post_meta( $post->ID, $prefix.'size_chart_data', true );
$diable_chart_data 	= get_post_meta( $post->ID, $prefix.'diable_chart_data', true );
if(empty($chart_table)){
	$chart_table = array(
		array('Size','Chest', 'Shoulder', 'Length','Sleeve Length'),
		array('M','20.3', '17', '27.5', '16.5'),
		array('L','22', '17.5', '28.3', '17'),
		array('XL','21.8', '18', '29', '17.5')
	);
	$chart_table = json_encode($chart_table);
}
?>
<div class="form-table pls-size-chart-table">
	<div class="form-field">
		<input id="pls-size-chart-disable" type="checkbox" name="<?php echo esc_attr($prefix);?>diable_chart_data" value="1"  <?php checked($diable_chart_data,'1')?>>
		<label for="pls-size-chart-disable"><?php echo esc_html__('Hide Size Chart Table','pls-theme')?></label>
	</div>
	<div class="field-item">
		<textarea  id="pls-chart-table" style="display:none;" name="<?php echo $prefix;?>size_chart_data"><?php echo $chart_table; ?></textarea>
	</div>	
</div><!-- .pls-size-chart-table -->