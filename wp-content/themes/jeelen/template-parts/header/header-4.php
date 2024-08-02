<?php
/**
 * Template part for displaying header style 4
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
					<div class="pls-header-col pls-header-col-left col-lg-6 col-xl-6">
						<?php pls_get_template( 'template-parts/header/elements/language-switcher' );?>
						<?php pls_get_template( 'template-parts/header/elements/currency-switcher' );?>
						<?php pls_get_template( 'template-parts/header/elements/welcome-message' );?>
					</div>
					<div class="pls-header-col pls-header-col-right col-lg-6 col-xl-6">
						<?php pls_get_template( 'template-parts/header/elements/topbar-menu' );?>
					</div>
				</div><!--.pls-header-desktop-->
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="pls-header-main">
	<div class="container">
		<div class="row">
			<div class="pls-header-col pls-header-col-left col-lg-5 col-xl-5 d-none d-lg-flex d-xl-flex">
				<?php pls_get_template( 'template-parts/header/elements/primary-menu' );?>
			</div>
			<div class="pls-header-col pls-header-col-center col-lg-2 col-xl-2 d-none d-lg-flex d-xl-flex">
				<?php pls_get_template( 'template-parts/header/elements/logo' );?>
			</div>
			<div class="pls-header-col pls-header-col-right col-lg-5 col-xl-5 d-none d-lg-flex d-xl-flex">
				<?php pls_get_template( 'template-parts/header/elements/mini-search' );?>
				<?php pls_get_template( 'template-parts/header/elements/myaccount' );?>
				<?php pls_get_template( 'template-parts/header/elements/wishlist' );?>
				<?php pls_get_template( 'template-parts/header/elements/compare' );?>
				<?php pls_get_template( 'template-parts/header/elements/cart' );?>
			</div>
			
			<!-- Mobile-->
			<div class="pls-header-col pls-header-col-left col-3 d-flex d-lg-none d-xl-none">
				<?php pls_get_template( 'template-parts/header/elements/mobile-menu' );?>
			</div>
			<div class="pls-header-col pls-header-col-center col-6 d-flex d-lg-none d-xl-none">
				<?php pls_get_template( 'template-parts/header/elements/logo' );?>
			</div>
			<div class="pls-header-col pls-header-col-right col-3 d-flex d-lg-none d-xl-none">
				<?php pls_get_template( 'template-parts/header/elements/cart' );?>
			</div>
			
		</div>
	</div>
</div>