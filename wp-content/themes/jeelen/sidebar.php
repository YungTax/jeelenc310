<?php
/**
 * The sidebar containing the main widget area
 *
 * @package pls
 */


$layout = pls_get_layout();
if( 'full-width' == $layout ){
	return;
}

$sidebar_name = pls_get_sidebar_name();
if ( ! is_active_sidebar( $sidebar_name ) ) {
	return;
}
?>

<div id="secondary" <?php pls_sidebar_class();?>>
	<div class="sidebar-inner">
		<?php dynamic_sidebar( $sidebar_name ); ?>
	</div>
</div><!-- #secondary -->