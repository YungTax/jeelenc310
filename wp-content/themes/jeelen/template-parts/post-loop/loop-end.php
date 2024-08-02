<?php
/**
 * Post Loop End
 *
 * @author 	PressLayouts
 * @package /template-parts/post-loop
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( pls_get_loop_prop( 'name' ) == 'pls-slider' || pls_get_loop_prop( 'name' ) == 'posts-slider-shortcode' || ( pls_get_loop_prop('name') == 'related-posts' ) ) { ?>
		</div>
	</div>
<?php } else { ?>
	</div>
<?php } ?>