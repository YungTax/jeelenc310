<?php 
/**
 * @author  PressLayouts
 * @version 1.0.0
 */
 
class PLS_Post_Content{
	private $cat_sidebars = array();
	function __construct() {
		add_action('init', array( $this, 'addProductBrand' ) );
		add_action('init', array( $this, 'blocks_post_type' ) );
		add_filter( 'manage_block_posts_columns', array($this, 'block_posts_columns') );
		add_action('manage_block_posts_custom_column', array($this, 'block_post_columns_data'), 10, 2);
		add_action('init', array( $this, 'size_chart_post_type' ) );
    }
	
	// Register brand taxonomy
    function addProductBrand() {
		
        register_taxonomy(
            'product_brand',
            'product',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(esc_html__('Brands', 'pls-core'), esc_html__('Brands', 'pls-core')),
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => true
            )
        );
    }
	
	/**
	*	Get content type labels
	*/
    function getLabels($singular_name, $name, $title = FALSE) {
        if( !$title )
            $title = $name;

        return array(
            'name' => $title,
            'singular_name' => $singular_name,
            'add_new' => esc_html__('Add New', 'pls-core'),
            'add_new_item' => sprintf( esc_html__('Add New %s', 'pls-core'), $singular_name),
            'edit_item' => sprintf( esc_html__('Edit %s', 'pls-core'), $singular_name),
            'new_item' => sprintf( esc_html__('New %s', 'pls-core'), $singular_name),
            'view_item' => sprintf( esc_html__('View %s', 'pls-core'), $singular_name),
            'search_items' => sprintf( esc_html__('Search %s', 'pls-core'), $name),
            'not_found' => sprintf( esc_html__('No %s found', 'pls-core'), $name),
            'not_found_in_trash' => sprintf( esc_html__('No %s found in Trash', 'pls-core'), $name),
            'parent_item_colon' => ''
        );
    }
	
	/**
	*	Get content type taxonomy labels
	*/
    function getTaxonomyLabels($singular_name, $name) {
        return array(
            'name' => $name,
            'singular_name' => $singular_name,
            'search_items' => sprintf( esc_html__('Search %s', 'pls-core'), $name),
            'all_items' => sprintf( esc_html__('All %s', 'pls-core'), $name),
            'parent_item' => sprintf( esc_html__('Parent %s', 'pls-core'), $singular_name),
            'parent_item_colon' => sprintf( esc_html__('Parent %s:', 'pls-core'), $singular_name),
            'edit_item' => sprintf( esc_html__('Edit %s', 'pls-core'), $singular_name),
            'update_item' => sprintf( esc_html__('Update %s', 'pls-core'), $singular_name),
            'add_new_item' => sprintf( esc_html__('Add New %s', 'pls-core'), $singular_name),
            'new_item_name' => sprintf( esc_html__('New %s Name', 'pls-core'), $singular_name),
            'menu_name' => $name,
        );
    }
	
	/**
	*	Register Custom Block content type
	*/
	function blocks_post_type() {
		if( ! defined( 'PLS_DIR' ) ){
			return;
		}
		$singular_name = esc_html__('Block', 'pls-core') ;
		$name = esc_html__('Blocks', 'pls-core');
		
		register_post_type(
            'block',apply_filters('pls_core_register_post_type_blocks',
            array(
                'labels' 				=> $this->getLabels($singular_name,$name),
                'exclude_from_search' 	=> true,
                'public' 				=> true,
				'show_ui' 				=> true,
                'menu_icon' 			=> 'dashicons-format-aside',
				'supports' 				=> array('title', 'editor'),
				'show_in_nav_menus' 	=> false,
            ))
        );
		
	}
	
	/**
	*	Add shortcode column in block post type
	*/
	function block_posts_columns( $columns ) {
	    $new_column['block_shortcode'] 	= esc_html__('Shortcode', 'pls-core');
	    $columns = pls_core_add_array( $columns, $new_column, 1, true );
	    return $columns;
	}
	
	/**
	*	Add column data to shortcode column
	*/
	function block_post_columns_data( $column, $post_id ) {		
	    switch ($column) {
			case 'block_shortcode':
				echo '<div class="block-shortcode-preview">[pls_block_html id="'.$post_id.'"]</div>';
	    		break;
		}
	}
	
	/**
	*	Register Size Chart content type
	*/
	function size_chart_post_type() {
		if( ! defined( 'PLS_DIR' ) ){
			return;
		}
		$singular_name = esc_html__('Size Chart', 'pls-core') ;
		$name = esc_html__('Size Charts', 'pls-core');
		 register_post_type(
            'pls_size_chart', apply_filters( 'pls_core_register_post_type_size_chart',
            array(
                'labels' 				=> $this->getLabels($singular_name,$name),
                'public' 				=> false,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'query_var' 			=> true,
				'rewrite' 				=> false,
				'capability_type' 		=> 'post',
				'has_archive' 			=> false,
				'hierarchical' 			=> false,
				'menu_position' 		=> null,
				'show_in_nav_menus' 	=> false,
				'exclude_from_search' 	=> true,
                'menu_icon' 			=> 'dashicons-format-aside',
				'supports' 				=> array('title', 'editor'),
				
            ) )
        );
	}
}
new PLS_Post_Content();
?>