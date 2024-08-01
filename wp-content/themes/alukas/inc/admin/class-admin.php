<?php
 /**
 * PLS Include Admin Customizer Function
 *
 * @package pls
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class PLS_Admin {
	public $prefix, $current_version, $api_url, $api_key;
	
	function __construct() {
		$this->prefix 			= PLS_PREFIX;
		$theme_data 			= wp_get_theme();
        $this->current_version 	= $theme_data->get('Version');
        $this->api_url 			= 'https://www.presslayouts.com/api/envato';
        $this->api_key 			= 'token';		
		
		/*Admin menu*/
		add_action( 'admin_menu', array( $this, 'theme_page_menu' ) );		
		
		// Register walker replacement
		add_action('wp_update_nav_menu_item', array( $this, 'save_custom_fields' ), 10, 3 );		
		add_action( 'wp_nav_menu_item_custom_fields',   array( $this, 'custom_menu_field'), 10 , 4 );
	}
	
	public function theme_page_menu() {
		$menu_title = apply_filters( 'pls_menu_title', PLS_THEME_NAME );
		$menu_icon = apply_filters( 'pls_menu_icon', PLS_URI.'/inc/admin/assets/images/menu-icon.png' );
		
        add_menu_page( $menu_title,
			$menu_title,
            'manage_options',
            'pls-theme',
            array( $this, 'pls_dashboard_page' ),$menu_icon,
			25
        );
		add_submenu_page( 'pls-theme',
            esc_html__( 'Welcome', 'pls-theme' ),
            esc_html__( 'Welcome', 'pls-theme' ),
            'manage_options',
            'pls-theme',
            array( $this, 'pls_dashboard_page' )
        );
		add_submenu_page( 'pls-theme',
            esc_html__( 'System Status', 'pls-theme' ),
            esc_html__( 'System Status', 'pls-theme' ),
            'manage_options',
            'pls-system-status',
            array( $this, 'pls_system_status' )
        );		
    }
	
	public function pls_dashboard_page() {
		require( PLS_FRAMEWORK. '/admin/dashboard/welcome.php' );
	}
	
	public function pls_system_status() {		 
		require(PLS_FRAMEWORK. '/admin/dashboard/system_status.php' );
	}
	
	public function save_custom_fields($menu_id, $menu_item_db_id, $args){
		
		$custom_fields = array('enable','design','width','height','custom_block','label_text','label_color','icon','thumbnail_url','attachment_id');

		foreach ( $custom_fields as $key ) {
			$value = isset($_REQUEST['menu-item-'.$key][$menu_item_db_id]) ? $_REQUEST['menu-item-'.$key][$menu_item_db_id] : '';
			update_post_meta( $menu_item_db_id, '_menu_item_pls_'.$key, $value );
		}
	}
		
	public function custom_menu_field($item_id, $item, $depth, $args ){
		
		$enable  		= get_post_meta( $item_id, '_menu_item_pls_enable',  true );
		$design  		= get_post_meta( $item_id, '_menu_item_pls_design',  true );
		$custom_block  	= get_post_meta( $item_id, '_menu_item_pls_custom_block',  true );
		$height  		= get_post_meta( $item_id, '_menu_item_pls_height',  true );
		$width   		= get_post_meta( $item_id, '_menu_item_pls_width',   true );
		$label_text   	= get_post_meta( $item_id, '_menu_item_pls_label_text',  true );
		$label_color   	= get_post_meta( $item_id, '_menu_item_pls_label_color',  true );
		$icon    		= get_post_meta( $item_id, '_menu_item_pls_icon',    true );		
		$attachment_id  = get_post_meta( $item_id, '_menu_item_pls_attachment_id',  true );
		$thumbnail_url  = get_post_meta( $item_id, '_menu_item_pls_thumbnail_url',  true );
		$icon_btn_text = (!empty($thumbnail_url)) ? esc_html__('Change Custom Icon','pls-theme') : esc_html__('Upload Custom Icon','pls-theme');
		$megamenu_class = ($enable != 'enabled') ? 'hidden-field' : '';
		$img_remove_cls = (empty($thumbnail_url)) ? 'hidden-field' : '';
		$custom_size_class = (($design == 'custom-size') && ($enable == 'enabled')) ? '' : 'hidden-field';
		$custom_blocks = pls_get_posts_by_post_type('block');
		$custom_block_edit_link = !empty($custom_block) ? admin_url( 'post.php?post='.$custom_block.'&action=edit' ) : 'javascript:void();'; ?>
		
		<!--  PLS custom fields-->
		<div id="pls-custom-fields" class="pls-custom-fields">
			<p class="description description-wide pls-megamenu-enable">
				<label for="edit-menu-item-megamenu-enable-<?php echo esc_attr( $item_id ); ?>">
					<input type="checkbox" id="edit-menu-item-megamenu-enable-<?php echo esc_attr( $item_id ); ?>" data-itemid=<?php echo esc_attr( $item_id ); ?> class="widefat code edit-menu-item-megamenu-enable" name="menu-item-enable[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked($enable,'enabled')?> />
					<strong><?php esc_html_e( 'Enable Mega Menu (only for main menu)', 'pls-theme' ); ?></strong>
				</label>
			</p>
			<p class="description description-wide pls-menu-design megamenu-field <?php echo esc_attr($megamenu_class);?>">
				<label for="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Design', 'pls-theme'); ?><br>
					<select id="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>" data-field="pls-menu-design" data-itemid="<?php echo esc_attr( $item_id ); ?>" class="widefat pls-menu-design" name="menu-item-design[<?php echo esc_attr( $item_id ); ?>]">
						<option value="full-width" <?php selected( esc_attr( $design ), 'full-width', true); ?>><?php esc_html_e('Full width', 'pls-theme'); ?></option>
						<option value="custom-size" <?php selected( esc_attr( $design ), 'custom-size', true); ?>><?php esc_html_e('Custom sizes', 'pls-theme'); ?></option>
					</select>
				</label>
			</p>
			<div id="pls-custom-design-block-<?php echo esc_attr( $item_id ); ?>" class="pls-custom-design-block <?php echo esc_attr($custom_size_class);?>">
			<p class="description description-thin pls-menu-width">
				<label for="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Width', 'pls-theme'); ?><br>
					<input type="number" id="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-width[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($width);?>">
				</label>
			</p>			
			<p class="description description-thin pls-menu-height ">
				<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Height', 'pls-theme'); ?><br>
					<input type="number" id="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-height[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($height);?>">
				</label>
			</p>
			</div>
			<p class="description description-wide pls-menu-custom-block megamenu-field <?php echo esc_attr($megamenu_class);?>">
				<label for="edit-menu-item-custom-block-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Select block', 'pls-theme'); ?><br>
					<select id="edit-menu-item-custom-block-<?php echo esc_attr( $item_id ); ?>" data-field="pls-menu-custom-block" class="widefat pls-custom-block select" name="menu-item-custom_block[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""><?php esc_html_e('Select block','pls-theme');?></option>
						<?php
						if(!empty($custom_blocks)){
							foreach ($custom_blocks as $id => $title) {
							$edit_link = admin_url( 'post.php?post='.$id.'&action=edit' );
							?>
							<option value="<?php echo esc_attr($id);?>" <?php selected($custom_block,$id); ?> data-block-link="<?php echo esc_url($edit_link);?>"><?php echo esc_html($title);?></option>
							<?php
							}
						}
						?>
					</select>
					<?php if(!empty( $custom_block ) ){?>
					<a href="<?php echo esc_url($custom_block_edit_link);?>" class="edit-block-link" target="_blank"><?php esc_html_e( 'Edit megamenu block', 'pls-theme' ); ?></a> | 
					<?php } ?>
					<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=block' ) ); ?>" class="add-block-link" target="_blank"><?php esc_html_e( 'Add megamenu block', 'pls-theme' ); ?></a>
				</label>
			</p>
			
			<p class="description description-thin pls-label-text">
				<label for="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>">					
					<?php esc_html_e('Label text','pls-theme');?><br>
					<input id="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label_text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($label_text);?>" type="text">
				
			</p>
			<p class="description description-thin pls-label-color">
				<label for="edit-menu-item-label-color-<?php echo esc_attr( $item_id ); ?>">					
					<?php esc_html_e('Label color','pls-theme');?></label><br>
					<input id="edit-menu-item-label-color-<?php echo esc_attr( $item_id ); ?>" class="widefat pls-color-box" name="menu-item-label_color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($label_color);?>" type="text">
				
			</p>
			<p class="description description-thin pls-menu-icon">
				<label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
					<a href="#" class="button-secondary pick-icon"><i class=" fa <?php echo esc_attr($icon);?>"></i> <?php esc_html_e( 'Menu Icon', 'pls-theme' ) ?></a>
					<span class="icons-block">
						<input type="text" class="search-icon" placeholder="<?php esc_attr_e( 'Quick search', 'pls-theme' ) ?>">
						<span class="pls-icon-close"> X </span>
						<span class="icon-selector">
							<i data-icon="">&nbsp;</i>
							<?php echo implode( "\n", pls_get_icons( $icon ) ); ?>
						</span>
					</span>
					<input type="hidden" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($icon);?>">
				</label>
			</p>			
			<p class="description description-thin pls-menu-icon-img">				
				<label for="edit-menu-item-megamenu-thumbnail-<?php echo esc_attr( $item_id ); ?>">
					<span class="img-wrp">
						<?php if(!empty($thumbnail_url)){?>
						<img src="<?php echo esc_url($thumbnail_url);?>" id="pls-media-img-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="pls-megamenu-thumbnail-image pls-attr-img" height="32" width="32" align="left" alt="<?php echo esc_attr__('Menu icon','pls-theme');?>"/>
						<span data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="pls-menu-image-clear"></span>
						<?php }?>
					</span>					
					<a href="#" id="pls-media-upload-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="pls-menu-image-upload button button-primary"><?php echo esc_html($icon_btn_text ); ?></a>
				</label>
				<input type="hidden" id="edit-menu-item-thumbnail-url-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" name="menu-item-thumbnail_url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($thumbnail_url);?>" />
				<input type="hidden" id="pls-attachment-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" name="menu-item-attachment_id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($attachment_id);?>" />
			</p>
			
		</div><!-- End #pls-custom-fields. -->
		
	<?php
	}
}
$obj_pls_admin = new PLS_Admin();