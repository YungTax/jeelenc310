<?php
/**
 * Template part for displaying header style 1
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	PressLayouts
 * @package /template-parts/header
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}?>

<?php if ( $header_top ) : ?>
	<div class="pls-header-topbar d-none d-lg-flex">
		<div class="container">
			<div class="row">
				<div class="pls-header-desktop d-flex">
					<div class="pls-header-col pls-header-col-left col-6">
						<?php pls_get_template( 'template-parts/header/elements/language-switcher' );?>
						<?php pls_get_template( 'template-parts/header/elements/currency-switcher' );?>
						<?php pls_get_template( 'template-parts/header/elements/welcome-message' );?>
					</div>
					<div class="pls-header-col pls-header-col-right col-6">
						<?php pls_get_template( 'template-parts/header/elements/topbar-menu' );?>
					</div>
				</div><!--.pls-header-desktop-->				
			</div>
		</div>
	</div><!--.pls-header-topbar-->
<?php endif; ?>

<div class="pls-header-main">
	<div class="container">
		<div class="row">
			<div class="pls-header-desktop d-none d-lg-flex">
				<div class="pls-header-col pls-header-col-left col-4">
					<?php pls_get_template( 'template-parts/header/elements/ajax-search' );?>
				</div>
				<div class="pls-header-col pls-header-col-center justify-content-center col-4">
					<?php pls_get_template( 'template-parts/header/elements/logo' );?>
				</div>
				<div class="pls-header-col pls-header-col-right col-4"> 
					<?php pls_get_template( 'template-parts/header/elements/myaccount' );?>
					<?php pls_get_template( 'template-parts/header/elements/wishlist' );?>
					<?php pls_get_template( 'template-parts/header/elements/cart' );?>
				</div>
			</div><!--.pls-header-desktop-->
			
			<div class="pls-header-mobile d-flex d-lg-none">
				<div class="pls-header-col pls-header-col-left col-3">
					<?php pls_get_template( 'template-parts/header/elements/mobile-menu' );?>
				</div>
				<div class="pls-header-col pls-header-col-center col-6">
					<?php pls_get_template( 'template-parts/header/elements/logo' );?>
				</div>
				<div class="pls-header-col pls-header-col-right col-3">
					<?php pls_get_template( 'template-parts/header/elements/cart' );?>
				</div>
			</div><!--.pls-header-mobile-->
		</div>
	</div>
</div><!--.pls-header-main-->

<div class="pls-header-navigation d-none d-lg-flex">
	<div class="container">
		<div class="row">
			<div class="pls-header-desktop d-none d-lg-flex">
				<?php if ( pls_get_option( 'categories-menu', 1 ) && has_nav_menu( 'categories-menu' ) ) { ?>
					<div class="pls-header-col pls-header-col-left col-3">
						<?php pls_get_template( 'template-parts/header/elements/category-menu' );?>
					</div>
					<div class="pls-header-col pls-header-col-center col-6">
						<?php pls_get_template( 'template-parts/header/elements/primary-menu' );?>
					</div>
					<div class="pls-header-col pls-header-col-right col-3">
						<?php pls_get_template( 'template-parts/header/elements/customer-care' );?>
						<?php pls_get_template( 'template-parts/header/elements/location' );?>
					</div>
				<?php }else{ ?>
					<div class="pls-header-col pls-header-col-center col-9">
						<?php pls_get_template( 'template-parts/header/elements/primary-menu' );?>
					</div>
					<div class="pls-header-col pls-header-col-right col-3">
						<?php pls_get_template( 'template-parts/header/elements/customer-care' );?>
						<?php pls_get_template( 'template-parts/header/elements/location' );?>
					</div>
				<?php } ?>
			</div><!--.pls-header-desktop-->
		</div>
	</div>
</div><!--.pls-header-navigation-->