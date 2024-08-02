<?php
/**
 * PLS Welcome Tab
 *
 * Handles the about us page HTML
 *
 * @package pls
 */
 require_once PLS_FRAMEWORK.'admin/dashboard-pages/header.php';

?>

<div class="pls-cnt-wrap">
	<?php esc_html_e( 'Please Activete theme license', 'pls-theme' );?>
</div> <!-- .pls-cnt-wrap -->
<?php 
require_once PLS_FRAMEWORK.'admin/dashboard-pages/footer.php';
?>