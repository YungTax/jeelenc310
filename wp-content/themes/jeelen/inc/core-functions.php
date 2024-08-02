<?php
/**
 * PLS Core Fucntions
 *
 * @package /inc
 */
 
 /**
 * Get theme Options
 */
if ( ! function_exists( 'pls_get_option' ) ) :
	function pls_get_option( $name, $default = '' ) {
		global $pls_options;
		
		$pls_options = apply_filters( 'pls_get_options', $pls_options );
		$value = $default;
		if ( isset( $pls_options[$name]  ) ) {
			if(  is_array( $pls_options[$name] ) && isset($pls_options[$name]['url']) && empty ( $pls_options[$name]['url'] ) ){
				$value = $default;
			}elseif(is_array( $pls_options[$name] ) && empty( $pls_options[$name] ) ){
				$value = $default;
			}else{
				$value =  $pls_options[$name];
			}			
		}
		$value = apply_filters( 'pls_get_option', $value, $name, $pls_options );
		return apply_filters( 'pls_get_option_' . $name, $value, $name, $pls_options ) ;
	}
endif;

/**
 * Get theme Options
 */
if ( ! function_exists( 'pls_uniqid' ) ) :
	function pls_uniqid( $prefix = '' ) {		
		return $prefix.rand( 1000, 100000 );
	}
endif;

/**
 * Get protocol (https or http)
 */
if( ! function_exists( 'pls_get_protocol' )) :
	function pls_get_protocol() {
		if( is_ssl() ) {
			return 'https:';
		} else {
			return 'http:';
		}
	}
endif;

/* Check if WooCommerce is Active.*/
if ( ! function_exists( 'pls_is_woocommerce_activated' ) ) {
	function pls_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

/* Check if Elementor is active.*/
if ( ! function_exists( 'pls_is_elementor_activated' ) ) {
	function pls_is_elementor_activated() {
		return defined( 'ELEMENTOR_VERSION' ) ? true : false;
	}
}

/**
 * Check is Editor mode
 */
if ( ! function_exists( 'pls_elementor_is_editor_mode' ) ) {
    function pls_elementor_is_editor_mode() {
        if ( ! pls_is_elementor_activated() ) {
            return false;
        }

        return Elementor\Plugin::$instance->editor->is_edit_mode();
    }
}

/**
 * Check is Preview mode
 */
if ( ! function_exists( 'pls_elementor_is_preview_mode' ) ) {
    function pls_elementor_is_preview_mode() {
        return Elementor\Plugin::$instance->preview->is_preview_mode();
    }
}

if ( ! function_exists( 'pls_block_get_content' ) ) {
	/**
	 * Get block content
	 */
	function pls_block_get_content( $block_id ) {
		if( empty( $block_id ) ){
			return;
		}
		if(function_exists( 'pll_get_post') ){
			$block_id = pll_get_post( $block_id );
		}
		if( class_exists('SitePress') ){
			$block_id = apply_filters( 'wpml_object_id', $block_id, 'block' , true );
		}
		$content = '';
		if(pls_is_elementor_activated()){		
			$content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $block_id );
		}else{
			$content = do_shortcode( get_post_field('post_content', $block_id ) );       
		}
		$output = '<div class="pls-block pls-block-'. esc_attr( $block_id ) .'">'.$content.'</div>';
		return apply_filters( 'pls_html_block_output', $output );
	}
}

/**
 * Manage Hook
 */
if( ! function_exists( 'pls_manage_hook' ) ) :
	function pls_manage_hook() {
		
		// Manage promo bar position
		if( pls_get_option('promo-bar', 0 ) ) {
			if( 'top'  == pls_get_option( 'promo-bar-position', 'top' ) ) {
				add_action( 'wp_body_open', 'pls_promo_bar', 10 );
			}else{
				add_action( 'pls_body_bottom', 'pls_promo_bar', 45 );
			}			
		}
	}
	add_action( 'init', 'pls_manage_hook' );
endif;

/**
 * Set Plugins with Theme
 */
if( ! function_exists( 'pls_revslider_as_theme' ) ) :
	function pls_revslider_as_theme() {
		if( function_exists( 'set_revslider_as_theme' ) ) {
			set_revslider_as_theme();
		}
	}
	add_action( 'init', 'pls_revslider_as_theme' );
endif;

/**
 * Clean up CSS	
 * @return string
 */
function pls_cleanup_css( $css = '' ) {

	if ( ! empty( $css ) ) {
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
		$css = str_replace( ', ', ',', $css );
	}

	return $css;
}

/**
 * Get locale in uniform format.
 */
function pls_get_locale() {
	$pls_locale = get_locale();
	if ( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $pls_locale ) ) {
		$pls_locale = str_replace( '-', '_', $pls_locale );
	} elseif ( preg_match( '#^[a-z]{2}$#', $pls_locale ) ) {
		$pls_locale .= '_' . mb_strtoupper( $pls_locale, 'UTF-8' );
	}

	if ( empty( $pls_locale ) ) {
		$pls_locale = 'en_US';
	}
	return apply_filters( 'pls_locale', $pls_locale );
}

 
 /**
 * Allowed html
 */
function pls_allowed_html( $allowed_els = '' ){

	// bail early if parameter is empty
	if( empty($allowed_els) ) return array();

	if( is_string($allowed_els) ){
		$allowed_els = explode(',', $allowed_els);
	}

	$allowed_html = array();

	$allowed_tags = wp_kses_allowed_html('post');

	foreach( $allowed_els as $el ){
		$el = trim($el);
		if( array_key_exists($el, $allowed_tags) ){
			$allowed_html[$el] = $allowed_tags[$el];
		}
	}

	return $allowed_html;
}

/**
 * Get timezone string
 */
function pls_timezone_string() {
    $timezone_string = get_option( 'timezone_string' );
 
    if ( $timezone_string ) {
        return $timezone_string;
    }
 
    $offset  = (float) get_option( 'gmt_offset' );
    $hours   = (int) $offset;
    $minutes = ( $offset - $hours );
 
    $sign      = ( $offset < 0 ) ? '-' : '+';
    $abs_hour  = abs( $hours );
    $abs_mins  = abs( $minutes * 60 );
    $tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );
 
    return $tz_offset;
}

/**
 * Standard menu fallback
 */

if ( ! function_exists( 'pls_fallback_menu' ) ) :
	function pls_fallback_menu() {
		if ( current_user_can( 'manage_options' ) ) {
			$menu_link = get_admin_url( null, 'nav-menus.php' );	
			printf( 
				wp_kses( __('Add your &nbsp; <a href="%s"><strong>navigation menu here</strong></a>', 'pls-theme')
					,pls_allowed_html( 'a', 'strong')
				) , $menu_link 
			);
		} else {
			$menu_link = home_url('/');
			printf( 
				wp_kses( __('<div class="pls-main-navigation pls-navigation"> <ul class="menu"><li> <a href="%s"><span>Home</span></a></li></ul> </div>', 'pls-theme' )
					,pls_allowed_html( 'a', 'span')
				) , esc_url( $menu_link ) 
			);
		}
	}
endif;

 /**
 * Check is plugin active
 */
function pls_check_plugin_active( $plugin ) {
	
	if( empty($plugin) ) return false;
	
	return in_array( $plugin , apply_filters( 'active_plugins', (array) get_option( 'active_plugins',  array() ) ) ) ;
}

/**
 * Check tgmpa listed plugin active
 */
function pls_tgmpa_is_plugin_check_active( $slug ) {
	$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

	return ( ( ! empty( $instance->plugins[ $slug ]['is_callable'] ) && is_callable( $instance->plugins[ $slug ]['is_callable'] ) ) || pls_check_plugin_active( $instance->plugins[ $slug ]['file_path'] ) );
}

/**
 * Add some custom Css code.
 *
 * @param string $code Code.
 */
function pls_add_custom_css( $code ) {
	global $pls_custom_css;

	if ( empty( $pls_custom_css ) ) {
		$pls_custom_css = '';
	}

	$pls_custom_css .= "\n" . $code . "\n";
}

/**
 * Get responsive class.
 */
function pls_get_responsive_class( $col='' ) {
	
	if( empty( $col ) ){ return ''; }
	
	switch( $col ){
		case 1:
			$col_class = 'col-1';
			break;
		case 2:
			$col_class = 'col-2';
			break;
		case 3:
			$col_class = 'col-3';
			break;
		case 4:
			$col_class = 'col-4';
			break;
		case 5:
			$col_class = 'col-5';
			break;
		case 6:
			$col_class = 'col-6';
			break;
		case 7:
			$col_class = 'col-7';
			break;
		case 8:
			$col_class = 'col-8';
			break;
		case 9:
			$col_class = 'col-9';
			break;
		case 10:
			$col_class = 'col-10';
			break;
		case 11:
			$col_class = 'col-11';
			break;
		case 12:
			$col_class = 'col-12';
			break;
		default:
			$col_class = 'col';
	}
	return apply_filters( 'pls_responsive_class', $col_class, $col );
}

/**
 * Get responsive grid columns.
 */
function pls_get_rs_grid_columns( $columns = 4 ){
	
	$columns_val = ( 12 / $columns  );			
	$columns = ( is_float( $columns_val ) ) ?  $columns * 10 : $columns_val;
	
	return apply_filters( 'pls_rs_grid_columns', $columns );
}

/**
 * Get footer layout.
 */
function pls_get_footer_layout( $footer_style = '1' ) {
	$footer_layouts = array();
	$footer_layouts['style_1'] = array(
		'grid'	=> 4,
		'class'	=> array(
			'col-xs-12 col-sm-6 col-lg-3',
			'col-xs-12 col-sm-6 col-lg-3',
			'col-xs-12 col-sm-6 col-lg-3',
			'col-xs-12 col-sm-6 col-lg-3',
		)
	);
	$footer_layouts['style_2'] = array(
		'grid'	=> 4,
		'class'	=> array(
			'col-xs-12 col-sm-6 col-lg-2',
			'col-xs-12 col-sm-6 col-lg-2',
			'col-xs-12 col-sm-6 col-lg-3',
			'col-xs-12 col-sm-6 col-lg-5',
		)
	);
	$footer_layouts['style_3'] = array(
		'grid'	=> 5,
		'class'	=> array(
			'col-xs-12 col-sm-6 col-lg-50',
			'col-xs-12 col-sm-6 col-lg-50',
			'col-xs-12 col-sm-6 col-lg-50',
			'col-xs-12 col-sm-6 col-lg-50',
			'col-xs-12 col-sm-6 col-lg-50',
		)
	);	
	$footer_layouts['style_4'] = array(
		'grid'	=> 5,
		'class'	=> array(
			'col-xs-12 col-sm-6 col-lg-3',
			'col-xs-12 col-sm-6 col-lg-2',
			'col-xs-12 col-sm-6 col-lg-2',
			'col-xs-12 col-sm-6 col-lg-2',
			'col-xs-12 col-sm-6 col-lg-3',
		)
	);
	$footer_layouts['style_5'] = array(
		'grid'	=> 5,
		'class'	=> array(
			'col-xs-12 col-lg-3',
			'col-xs-12 col-lg-6',
			'col-xs-12 col-lg-3',
		)
	);
	$footer_layouts['style_6'] = array(
		'grid'	=> 2,
		'class'	=> array(
			'col-xs-12 col-sm-6 col-lg-6',
			'col-xs-12 col-sm-6 col-lg-6',
		)
	);
	$footer_layouts['style_7'] = array(
		'grid'	=> 1,
		'class'	=> array(
			'col-12',
		)
	);
	$footer_layouts = apply_filters( 'pls_footer_layouts', $footer_layouts, $footer_style );
	
	return $footer_layouts['style_'.$footer_style];
}

if ( ! function_exists( 'pls_set_cookie' ) ) :
	function pls_set_cookie( $key, $value ){
		$default_cookie_expire = time() + 3600 * 24 * 30;
		setcookie(
			$key,
			$value,
			$default_cookie_expire,
			COOKIEPATH
		);
	}
endif;

if ( ! function_exists( 'pls_get_cookie' ) ) :
	function pls_get_cookie($var){
		return isset($_COOKIE[$var]) ? $_COOKIE[$var] : null;
	}
endif;

if ( ! function_exists( 'pls_get_current_page_url' ) ) :
	function pls_get_current_page_url() {
		$current_url = add_query_arg(null,null);		
		return esc_url($current_url);
	}
endif;

/* Function to check is theme activated */
function pls_is_license_activated(){
	$option_name = 'envato_purchase_code_45256351';
	if( get_option( PLS_THEME_SLUG.'_is_activated' ) && get_option( $option_name ) ){
		return true;
	}
	return false;
}

/* Function to get purchase code */
function pls_get_purchase_code(){
	$option_name = 'envato_purchase_code_45256351';
	return get_option($option_name);
}

/* Function to get api key */
function pls_get_token_key(){
	return get_option(PLS_THEME_NAME.'_token_key');
}

/*Template function*/
/**
 *	Get template from pls theme
 */
function pls_get_template_part( $slug, $name = '', $args = array() ) {
	$name = (string) $name;
	if ( '' !== $name ) {
		$templates = "{$slug}-{$name}";
	} else {
		$templates = "{$slug}";
	}
	pls_get_template($templates,$args);
	
}

function pls_get_template( $templates, $args = array() ) {

	// Templates prefix
	$templates = sprintf( '%s', $templates );
	if( strpos( $templates, '.php' ) === false) {
		$templates = $templates.'.php';
	}
	// Locate template file
	$located = locate_template( $templates, false );
	
	// Apply filters to current template file
	$template_file = apply_filters( 'pls_get_template', $located, $templates, $args );
	
	// File does not exists
	if ( ! file_exists( $template_file ) ) {
		pls_doing_it_wrong( __FUNCTION__, sprintf( '%s does not exist.', '<code>' . $templates . '</code>' ), '2.1' );
		return;
	}
	
	// Filter arguments by "pls_get_template-filename.php"
	$args = apply_filters( "pls_get_template-{$templates}", $args );
	
	// Extract arguments (to use in template file)
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}
	
	// Actions before parsing template
	do_action( 'pls_get_template_before', $located, $templates, $args );
	
	include( $template_file );
	
	// Actions after parsing template
	do_action( 'pls_get_template_after', $located, $templates, $args );
}

/**
 *	Doing it wrong
 */
function pls_doing_it_wrong( $function, $message, $version ) {
	$message .= ' Backtrace: ' . wp_debug_backtrace_summary();

	if ( defined( 'DOING_AJAX' ) ) {
		do_action( 'doing_it_wrong_run', $function, $message, $version );
		error_log( "{$function} was called incorrectly. {$message}. This message was added in version {$version}." );
	} else {
		_doing_it_wrong( $function, $message, $version );
	}
}

// **********************************************************************//
// Get custom and typekit fonts
// **********************************************************************//
if ( ! function_exists( 'pls_add_custom_fonts' ) ):
	function pls_add_custom_fonts() {
		
		$fonts = array();
		
		$enable_custom_font1 = pls_get_option( 'custom-font1',0);
		$enable_custom_font2 = pls_get_option( 'custom-font2',0);
		$enable_custom_font3 = pls_get_option( 'custom-font3',0);
		
		if($enable_custom_font1){
			$font1_name =  pls_get_option( 'custom-font1-name',''); 
			if(!empty($font1_name)){
				$fonts['Custom-Fonts'][$font1_name] = $font1_name;
			}
			
		}
		if($enable_custom_font2){
			$font2_name =  pls_get_option( 'custom-font2-name',''); 
			if(!empty($font2_name)){
				$fonts['Custom-Fonts'][$font2_name] = $font2_name;
			}			
		}
		if($enable_custom_font3){
			$font3_name =  pls_get_option( 'custom-font3-name',''); 
			if(!empty($font3_name)){
				$fonts['Custom-Fonts'][$font3_name] = $font3_name;
			}
		}
		
		$enable_typekit_font 	= pls_get_option( 'typekit-font',0);
		$typekit_id 			= pls_get_option( 'typekit-kit-id', '' );
		$typekit_family 		= pls_get_option( 'typekit-kit-family', '' );
		if ( $enable_typekit_font && !empty($typekit_id) && $typekit_family ) {
			$typekit = explode( ',', $typekit_family );
			foreach($typekit as $key => $font_family){
				$fonts['Custom-Fonts'][$font_family] = $font_family;
			}
		}
		
		return $fonts;
		
	}
	add_filter( 'redux/pls_options/field/typography/custom_fonts', 'pls_add_custom_fonts' );
endif;

/**
 * Get blog meta
 *
 * @since  1.0
 *
 * @return string
 */
function  pls_get_post_meta( $meta ) {
	
	$prefix = PLS_PREFIX;
	
	if ( is_home() && ! is_front_page() ) {
		$post_id = get_queried_object_id();

		return get_post_meta( $post_id, $prefix.$meta, true );
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$post_id = intval( get_option( 'woocommerce_shop_page_id' ) );
		
		return get_post_meta( $post_id, $prefix.$meta, true );
	}
	
	if ( ! is_singular() ) {
		return false;
	}
	
	$post_meta = get_post_meta( get_the_ID(), $prefix.$meta, true );
	
	return apply_filters('pls_get_post_meta', $post_meta, $meta);
}

if ( ! function_exists( 'pls_has_post_thumbnail' ) ) :
	function pls_has_post_thumbnail( $post_id = '' ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$prefix = PLS_PREFIX;
		$format =get_post_format();
		if( ( $format=='image') && pls_get_post_meta( 'post_format_image' ) ){
			return true;
		}elseif( $format=='gallery' && pls_get_post_meta( 'post_format_gallery' ) ){
			return true;
		}elseif( $format=='video' && pls_get_post_meta( 'post_format_video' ) ){
			return true;
		}elseif( $format=='audio' && pls_get_post_meta( 'post_format_audio' ) ){
			return false;
		}elseif( $format=='quote' && pls_get_post_meta( 'post_format_quote' ) ){
			return false;
		}elseif( $format=='link' && pls_get_post_meta( 'post_format_link_url' ) ){
			return false;
		}else{
			return has_post_thumbnail();
		}			
	}
endif;

/**
 * Function to get post types
 */
function pls_get_post_types() {     
    
    $post_types = array();
    $args       = array('public' => true);
    $default_post_types = get_post_types($args,'name');

    $exclude_post = array('attachment', 'revision', 'nav_menu_item');
	$exclude_post = apply_filters('pls_exclude_post',$exclude_post);

    foreach ($default_post_types as $post_type_key => $post_data) {
        if( !in_array( $post_type_key, $exclude_post) ) {
            $post_types[$post_type_key] = $post_data->label;
        }
    }

    return apply_filters('pls_public_post_types', $post_types );  
}

/**
 * Returns the Taxonomies in a list.
 *
 * @param int    $post_id Post ID.
 * @param string $sep (default: ', ').
 * @param string $before (default: '').
 * @param string $after (default: '').
 * @return string
 */
function pls_get_taxonomy_list( $post_id, $taxonomy = 'category', $sep = ', ', $before = '', $after = '' ) {
	$term_list	= get_the_term_list( $post_id, $taxonomy, $before, $sep, $after );
	if( !is_wp_error( $term_list )){
		return $term_list;
	}
}

/**
 * Function to get image src by id
*/
function pls_get_image_src( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( $post_id, $size );
    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
	}
    // Getting default image
    if( $default_img && empty($image) ) {
        $image = '';
    }
	return $image;
}

if ( ! function_exists( 'pls_implode_classes' ) ) :
	function pls_implode_classes($classes=array()) {
		
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}
		
		echo esc_attr( $classes );
	}
endif;

/**
 * Get post type list
 */
function pls_get_posts_by_post_type($post_type ='post',$select_options = ''){
	$results = array();
	$args = array('post_type'	=> $post_type,
				'post_status' 	=>  array('publish'),
				'posts_per_page'=>-1);
	$post_type_query = get_posts( $args );
	if(!empty($select_options)){
		$results[' '] = $select_options;
	}
    foreach ( $post_type_query as $p ):
		$results[$p->ID] = $p->post_title;
    endforeach; 
	return $results;
}

function pls_get_round_number( $number, $min_value = 1000, $decimal = 1 ) {
	if ( $number < $min_value ) {
		return number_format_i18n( $number );
	}
	$alphabets = array(
		1000000000 => 'B',
		1000000 => 'M',
		1000 => 'K',
	);
	foreach ( $alphabets as $key => $value ) {
		if ( $number >= $key ) {
			return round( $number / $key, $decimal ) . $value;
		}
	}
}

/**
 * Polylang Languages Switcher
 */
function pls_polylang_language_switcher() {
	
	$lang_arr = $langs = array();
	$country_view 	= pls_get_option( 'header-language-switcher-view', 'both' );
	$country_name 	= pls_get_option( 'header-language-switcher-country-name', 'name' );
	$has_flag 		= ( $country_view =='both'|| $country_view == 'flag') ? true : false;
	$has_name 		= ( $country_view =='both'|| $country_view == 'name') ? true : false;		
	$languages 		= pll_the_languages(array('raw' => 1));
	
	if( ! empty( $languages ) ) {
		$flag	= $has_flag ? pll_current_language('flag') : '';
		$name	= $has_name ? pll_current_language('name') : '';			
		$lang_arr['current_language'] = array( 'flag'=>$flag, 'name'=>$name );
		
		foreach ($languages as $lang):
		
			$flag	= $has_flag ? '<img src="'.esc_url( $lang['flag'] ) .'" alt="'. esc_attr( $lang['name'] ).'"/>' : '';
			$name	= $has_name ? $lang['name'] : '';			
			$langs[] = array( 'flag'=>$flag, 'url'=> $lang['url'], 'name'=> $name, 'current_lang'=> $lang['current_lang'] );
			
		endforeach;
		
		$lang_arr['languages'] = $langs;
	}
	
	return $lang_arr;
}

/**
 * Get image size
 */
if ( ! function_exists('pls_get_image_size') ) :
	function pls_get_image_size( $size = 'thumbnail' ) {		
		global $_wp_additional_image_sizes;
		$sizes = array();  
		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array('thumbnail', 'medium', 'large') ) ) {
				$width = get_option( "{$_size}_size_w" );
				$height = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['width']  = $width;
			$sizes[ $_size ]['height'] = $height;
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$width = $_wp_additional_image_sizes[ $_size ]['width'];
			$height = $_wp_additional_image_sizes[ $_size ]['height'];
			$sizes[ $_size ] = array(
				'width'  => $width,
				'height' => $height,
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}
	return isset( $sizes[$size] ) ? $sizes[$size] : array();
}
endif;

function pls_get_post_thumbnail($size = 'thumbnail', $css_class = '', $attributes = false){
	
	global $post;
	
	$thumbnail_id = get_post_thumbnail_id();
	$html = pls_get_image_html($thumbnail_id, $size, $css_class, $attributes);
	
	return $html;
}

function pls_get_image_html($attachment_id, $size = 'thumbnail', $css_class = '', $attr = false){
	
	$html = '';
	$image = wp_get_attachment_image_src( $attachment_id, $size );
	if ( $image ) {
		list( $src, $width, $height ) = $image;
		$hwstring = image_hwstring( $width, $height );
		$size_class = $size;
		if ( is_array( $size_class ) ) {
			$size_class = join( 'x', $size_class );
		}
		$attachment = get_post($attachment_id);

		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size_class size-$size_class ".$css_class,
			'alt'	=> trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
		);

		$attr = wp_parse_args( $attr, $default_attr );
		if ( empty( $attr['srcset'] ) ) {
			$image_meta = wp_get_attachment_metadata( $attachment_id );
			if ( is_array( $image_meta ) ) {
				$size_array = array( absint( $width ), absint( $height ) );
				$srcset = wp_get_attachment_image_srcset( $attachment_id, $size, $image_meta  );
				$sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );

				if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
					$attr['srcset'] = $srcset;

					if ( empty( $attr['sizes'] ) ) {
						$attr['sizes'] = $sizes;
					}
				}
			}
		}
		
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
		$attr = array_map( 'esc_attr', $attr );
		$html .= rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}else{
		$src = apply_filters( 'pls_placeholder_image_url', PLS_IMAGES.'transparent.png');	
		$dimensions		= pls_get_image_size( $size );
		$hwstring 		= image_hwstring($dimensions['width'], $dimensions['height'] );				
		$size_class 	= $size;
		if ( is_array( $size_class ) ) {
			$size_class = join( 'x', $size_class );
		}
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size_class size-$size_class ".$css_class,
			'alt'	=> esc_attr__('Place holder', 'pls-theme' ),
		);
		$attr = wp_parse_args( $attr, $default_attr );		
		$attr = array_map( 'esc_attr', $attr );
		$html .= rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';		
	}
	
	return $html;
}
if ( !function_exists('pls_get_src_image_loaded') ) {
	function pls_get_src_image_loaded($src, $attr = '', $hwstring ='' , $echo = true)  {

		$src_blank = apply_filters( 'pls_lazyload_image_url', PLS_IMAGES.'transparent.png' );
		$default_attr = array(
			'src'	=> $src_blank,
			'data-src'	=> $src,
			'class'	=> '',
		);
		$lazy_load = pls_get_option( 'lazy-load', 0 );
		if( !$lazy_load ) {
			$default_attr['src'] = $src;
			unset($default_attr['data-src']);
		}

		$attr = wp_parse_args( $attr, $default_attr );

		if( $lazy_load ) {
			$attr['class'] = $attr['class']. ' lazy loading';
		}

		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';

		if( $echo ) {
			echo trim($html);
		} else {
			return $html;
		}		
	}
}

/**
 * Add lazyload to attachment image
 */
if ( ! function_exists('pls_lazyload_to_attachment_image') ) :
	function pls_lazyload_to_attachment_image( $attr, $attachment, $size ) {
	
		if( ! is_admin() && pls_get_option( 'lazy-load', 0 ) ) {
			if( apply_filters( 'pls_enable_lazyload', true) ) {
				$attr['data-src'] 	= $attr['src'];
				$image 				= wp_get_attachment_image_src( $attachment->ID, $size );
				$attr['src'] 		= apply_filters( 'pls_lazyload_image_url', PLS_IMAGES.'transparent.png');
				$lazy_class 		= 'lazy';	
				$attr['class'] 		= ( isset( $attr['class'] ) ? $attr['class'] . " {$lazy_class}" : $lazy_class );
				
				if ( isset( $attr['srcset'] ) ) {
					$attr['data-srcset'] = $attr['srcset'];
					unset( $attr['srcset'], $attr['sizes'] );
				}
			}
		}
		return $attr;
	}
	add_filter( 'wp_get_attachment_image_attributes', 'pls_lazyload_to_attachment_image', 10, 3 );
endif;

/* Get slider options */
if( ! function_exists( 'pls_slider_options' ) ) :
	function pls_slider_options(){
		$options = array(
			'slider_loop'				=> ( pls_get_option('slider-loop', 0 ) ) ? true : false,
			'slider_autoplay'			=> ( pls_get_option('slider-autoplay', 0 ) ) ? true : false,
			'slider_autoplay_speed'		=> pls_get_option('slider-autoplay-speed', 1000 ),
			'slider_pause_on_hover'		=> ( pls_get_option('slider-autoplay-hover-pause', 0 ) ) ? true : false,
			'slider_rewind'				=> ( pls_get_option( 'slider-rewind', 0 ) ) ? true : false,
			'slider_autoHeigh'			=> ( pls_get_option( 'slider-autoHeigh', 0 ) ) ? true : false,
			'slider_touchDrag'			=> ( pls_get_option( 'slider-touchDrag', 1 ) ) ? true : false,
			'slider_touchDrag_mobile'	=> ( pls_get_option( 'slider-touchDrag-mobile', 1 ) ) ? true : false,
			'slider_navigation'			=> ( pls_get_option( 'slider-navigation', 1 ) ) ? true : false,
			'slider_pagination'			=> ( pls_get_option( 'slider-pagination', 1 ) ) ? true : false,
			'slider_effect'				=> 'fade',
			'slider_spaceBetween'		=> pls_get_option( 'slider-spacebetween', 0 ),
			'slides_to_show'			=> 4,
			'slides_to_show_tablet'		=> 3,
			'slides_to_show_mobile'		=> 2,
			'slides_to_scroll'			=> 1,
		);
		$options = apply_filters( 'pls_slider_options', $options );
		return $options;
	}
endif;

/* Get slider attributes*/
if( ! function_exists( 'pls_slider_attributes' ) ) :
	function pls_slider_attributes( $settings = array() ){
		$attr_options = array();
		if( isset( $settings['slider_loop'] ) ){
			$attr_options['slider_loop'] = "yes" === $settings['slider_loop'];
		}
		if( isset( $settings['slider_autoplay'] ) ){
			$attr_options['slider_autoplay'] = "yes" === $settings['slider_autoplay'];
		}
		if( isset( $settings['slider_pause_on_hover'] ) ){
			$attr_options['slider_pause_on_hover'] = "yes" === $settings['slider_pause_on_hover'];
		}
		if( isset( $settings['slider_autoplay_speed'] ) ){
			$attr_options['slider_autoplay_speed'] = $settings['slider_autoplay_speed'];
		}
		if( isset( $settings['slider_navigation'] ) ){
			$attr_options['slider_navigation'] = "yes" === $settings['slider_navigation'];
		}
		if( isset( $settings['slider_pagination'] ) ){
			$attr_options['slider_pagination'] = "yes" === $settings['slider_pagination'];
		}
		if( isset( $settings['slider_dots'] ) ){
			$attr_options['slider_pagination'] = "yes" === $settings['slider_dots'];
		}
		if( isset( $settings['slides_to_show'] ) ){
			$attr_options['slides_to_show'] = $settings['slides_to_show'];
		}
		if( isset( $settings['slides_to_show_tablet'] ) ){
			$attr_options['slides_to_show_tablet'] = $settings['slides_to_show_tablet'];
		}
		if( isset( $settings['slides_to_show_mobile'] ) ){
			$attr_options['slides_to_show_mobile'] = $settings['slides_to_show_mobile'];
		}
		$slider_data 	= shortcode_atts( pls_slider_options(), $attr_options );
		return wp_json_encode($slider_data);
	}
endif;

/* PLS css animation */
if ( ! function_exists( 'pls_get_css_animation' ) ) :
	function pls_get_css_animation( $css_animation ) {
		$output = '';
		if ( $css_animation && $css_animation != 'none' ) {
			$output = 'wow ' . $css_animation;
		}
		return $output;
	}
endif;

if ( ! function_exists( 'pls_hex2rgb' ) ) :
	/**
	 * Convert HEX to RGB.
	 */
	function pls_hex2rgb( $hex ) {
	   $hex = str_replace( "#", "", $hex );

	   if( strlen( $hex ) == 3 ) {
		  $r = hexdec( substr( $hex, 0, 1 ).substr( $hex ,0 , 1 ) );
		  $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
		  $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
	   } else {
		  $r = hexdec( substr( $hex, 0, 2 ) );
		  $g = hexdec( substr( $hex, 2, 2 ) );
		  $b = hexdec( substr( $hex, 4, 2 ) );
	   }
	   $rgb = array( $r, $g, $b );
	   return implode( ",", $rgb ); // returns the rgb values separated by commas
	   //return $rgb; // returns an array with the rgb values
	}
endif;

/**
 * remove all redux notice 
 *
 * @since 1.0
 */
if ( ! class_exists( 'reduxNewsflash' ) ){
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
}
add_filter( 'redux/pls_options/aURL_filter', '__return_empty_string' );

if ( ! function_exists( 'pls_get_icons' ) ) :
	/**
	 * Display field type icon
	 *
	 * @since 1.0
	 *
	 * @param  string $selected The selected icon
	 */
	function pls_get_icons( $selected = '' ) {
		$icons = pls_fonts();
		$list = array();

		foreach( $icons as $icon => $utf_code ) {
			
			$list[] = sprintf(
				'<i class="pls %1$s %2$s" data-icon="%3$s"></i>',
				esc_attr( key($utf_code) ),
				key($utf_code) == trim($selected) ? 'selected' : '',
				esc_attr( key($utf_code) )
			);
		}
		return $list;
	}
endif;

if ( ! function_exists( 'pls_pre' ) ) :
	/* debug function */
	function pls_pre( $test_data = '' ){
		echo '<pre>';
		print_r( $test_data );
		echo '</pre>';
	}
endif;