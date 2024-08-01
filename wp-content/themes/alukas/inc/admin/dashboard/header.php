<?php
/**
 * PLS Dashboard
 *
 * Handles the about us page HTML
 *
 * @package PLS
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$pls_tabs 	= apply_filters( 'pls_dashboard_tabs', array(
				'pls-theme' 			=> esc_html__( 'Dashboard', 'pls-theme' ),
				'pls-system-status' 	=> esc_html__( 'System Status', 'pls-theme' ),
				'pls-theme-option' 		=> esc_html__( 'Theme Options', 'pls-theme' ),
			) );
$active_tab = isset($_GET['page']) ? $_GET['page'] : 'pls-theme'; ?>
<div class="wrap about-wrap pls-admin-wrap pls-dashboard-wrap">
	
	<h1>
		<?php
		echo apply_filters( 'pls_dashboard_title', esc_html__('Welcome to ', 'pls-theme' ). PLS_THEME_NAME );
		?>
	</h1>
	<div class="about-text">
		<?php echo apply_filters( 'pls_dashboard_description', sprintf( esc_html__( 'Thank you for purchasing our premium %1$s theme. Here you are able to start creating your awesome web store by importing our dummy content and theme options.', 'pls-theme' ), PLS_THEME_NAME ) ); ?>
	</div>
	<div class="pls-theme-badge">
		<?php $dashlogo_url = apply_filters( 'pls_dashboard_logo', PLS_URI.'/inc/admin/assets/images/dashboard-logo.png' ) ?>
		<img src="<?php echo esc_url( $dashlogo_url ); ?>">
		<span><?php echo esc_html__('Version', 'pls-theme') .' '.PLS_VERSION; ?></span>
	</div>
	
	<?php 
	$action_button = apply_filters( 'pls_dashboard_docs_rating_button', true);
	if( $action_button ){ ?>
	<p class="pls-actions">
		<a class="btn-docs button" href="https://docs.presslayouts.com/<?php echo esc_attr(PLS_THEME_SLUG);?>/" target="_blank"><?php esc_html_e('Documentation','pls-theme');?></a>
		<a class="btn-docs button" href="https://1.envato.market/AWP1Rx" target="_blank"><?php esc_html_e('Support','pls-theme');?></a>
		<a class="btn-rate button" href="https://themeforest.net/downloads" target="_blank"><?php esc_html_e('Rate our theme','pls-theme');?></a>
    </p>
	<?php }
	if( !empty( $pls_tabs ) ) { ?>
		<h2 class="nav-tab-wrapper">
			<?php foreach ($pls_tabs as $tab_key => $tab_val) { 

				if( empty($tab_key) ) {
					continue;
				}
				if( !defined( 'PLS_CORE_DIR' ) && $tab_key == 'pls-theme-option') {
					continue;
				}
				$active_tab_cls	= ( $active_tab == $tab_key ) ? ' nav-tab-active' : '';
				$tab_link 		= add_query_arg( array( 'page' => $tab_key ), admin_url('admin.php') );
				?>
				<a class="nav-tab<?php echo esc_attr( $active_tab_cls ); ?>" href="<?php echo esc_url( $tab_link ); ?>"><?php echo esc_html( $tab_val ); ?></a>
			<?php } ?>
		</h2>
	<?php } ?>
	<div id="pls-dashboard" class="pls-dashboard wp-clearfix">
	