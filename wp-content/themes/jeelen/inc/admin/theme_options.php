<?php
/**
 * PLS Theme Options
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

    $opt_name = 'pls_options';
    $theme = wp_get_theme( PLS_THEME_NAME );
	
    $args = array(
        'opt_name'             		=> $opt_name,
        'display_name'         		=> apply_filters( 'pls_theme_name', $theme->get( 'Name' ) ),
        'display_version'      		=> $theme->get( 'Version' ),
        'menu_type'            		=> 'submenu',
        'allow_sub_menu'       		=> true,
        'menu_title'           		=> esc_html__( 'Theme Options', 'pls-theme' ),
        'page_title'           		=> esc_html__( 'Theme Options', 'pls-theme' ),
		'google_api_key'       		=> '',
        'google_update_weekly' 		=> true,
        'async_typography'     		=> false,
        'global_variable'      		=> '',
        'dev_mode'             		=> false,
        'customizer'          		=> false,
        'page_priority'       		=> null,
        'page_parent'          		=> 'pls-theme',
        'page_permissions'     		=> 'manage_options',
        'menu_icon'            		=> '',
        'page_icon'            		=> 'icon-themes',
        'page_slug'            		=> 'pls-theme-option',
        'save_defaults'        		=> true,
        'default_show'         		=> false,
        'default_mark'         		=> '',
        'show_import_export'   		=> true,
        'transient_time'       		=> 60 * MINUTE_IN_SECONDS,
        'output'               		=> true,
        'output_tag'           		=> true,
		'font_display'              => 'swap',
		'footer_credit'             => ' ',
    );

    Redux::setArgs( $opt_name, $args );
	
	/*
	* General
	*/
    Redux::setSection( $opt_name, array(
        'title'            	=> esc_html__( 'General', 'pls-theme' ),
        'id'               	=> 'general-options',
        'desc'             	=> '',
		'fields'           	=> array(
			array(
                'id'       			=> 'theme-layout',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Theme Layout', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Select layout of site.', 'pls-theme' ),
                'options'  			=> array(
					'wide' => array(
                        'title' 	=> esc_html__( 'Wide', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Wide', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/wide.png',
                    ),  
					'full' => array(
                        'title' 	=> esc_html__( 'Full', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Full', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/full.png',
                    ),                   
                    'boxed' => array(
                        'title' 	=> esc_html__( 'Boxed', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Boxed', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/box.png',
                    ),
                ),
                'default'  		=> 'full',
            ),
			array(
                'id'            	=> 'theme-container-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Container Width (px)', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Theme container width in pixels', 'pls-theme' ),
                'default'       	=> 1396,
                'min'           	=> 1025,
                'step'          	=> 1,
                'max'           	=> 1920,
				'required' 			=> array( 'theme-layout', '=', array( 'full', 'boxed' ) ),
            ),
			array(
                'id'            	=> 'theme-container-wide-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Container Width (px)', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Theme container wide layout width in pixels', 'pls-theme' ),
                'default'       	=> 1820,
                'min'           	=> 1200,
                'step'          	=> 1,
                'max'           	=> 1920,
				'required' 			=> array( 'theme-layout', '=', array( 'wide' ) ),
            ),
			array(
                'id'            	=> 'theme-grid-gap',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Grid Gap', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Theme grid gapping/spacing between two columns. Like 5px, 10px, 15px, etc...', 'pls-theme' ),
                'default'       	=> 15,
                'min'           	=> 5,
                'step'          	=> 5,
                'max'           	=> 20,
            ),
			array(
                'id'       			=> 'header-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Logo', 'pls-theme' ),
                'compiler' 			=> 'true',
                'subtitle' 			=> esc_html__( 'Upload header logo.', 'pls-theme' ),
                'default'  			=> array(),
            ),
			array(
                'id'       			=> 'header-logo-light',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Logo Light Version', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Upload an alternative light logo that will be used on dark and transparent header.', 'pls-theme' ),
                'compiler' 			=> 'true',
               'default'  			=> array(),
			),
			array(
                'id'            	=> 'header-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Width', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Logo width in pixels', 'pls-theme' ),
                'default'       	=> 170,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 500,
                'display_value' 	=> 'text',
            ),
			array(
                'id'      			=> 'mobile-header-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Mobile Header Logo', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Upload mobile header logo', 'pls-theme' ),
                'compiler' 			=> 'true',
				'default'  			=> array(),
			),
			array(
                'id'            	=> 'mobile-header-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Mobile Header Logo Width', 'pls-theme' ),				
				'subtitle'          => esc_html__( 'Logo max width in pixels', 'pls-theme' ),
                'default'       	=> 148,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 500,
                'display_value' 	=> 'text',
            ),
		)
    ) );
	
	/**
	* Site Preloader
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Site Preloader', 'pls-theme' ),
        'id'         		=> 'section-site-preloader',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'site-preloader',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Site Preloader', 'pls-theme' ),
                'subtitle'    		=> esc_html__( 'Show site preloader on your website.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 0,
            ),
			array(
                'id'       			=> 'preloader-background',
                'type'    			=> 'color',
				'title'   			=> esc_html__( 'Preloader Background', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Set preloader background color.', 'pls-theme' ),				
				'transparent'		=> false,
				'default'    		=> '#222222',
				'required' 			=> array( 'site-preloader', '=', 1 ),
            ),
			array(
				'id'      			=> 'preloader-image',
				'type'    			=> 'button_set',
				'title'   			=> esc_html__( 'Preloader Image', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Set preloader type as per your need.', 'pls-theme' ),
				'options' 			=> array(
					'predefine-loader'	=> esc_html__( 'Predefined Loader', 'pls-theme' ),
					'custom'         	=> esc_html__( 'Custom', 'pls-theme' ),
				),
				'default' 			=> 'predefine-loader',
				'required' 			=> array( 'site-preloader', '=', 1 ),
			),
			array(
                'id'       			=> 'predefine-loader-style',
                'type'     			=> 'select',
				'title'   			=> esc_html__( 'Choose Preloader Style', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Set preloader type as per your need.', 'pls-theme' ),
                'options'  			=> array(
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                    '3' => 'Style 3',
                    '4' => 'Style 4',
                    '5' => 'Style 5',
                ),
                'default'  			=> '1',
				'required' 			=> array( 'site-preloader', '=', 1 ),
            ),
			array(
				'id'      			=> 'preloader-custom-image',
				'type'    			=> 'media',
				'url'     			=> false,
				'title'   			=> esc_html__( 'Upload Preloader Image', 'pls-theme' ),   
				'subtitle'			=> esc_html__( 'Upload preloader image.', 'pls-theme' ),
				'library_filter'	=> array( 'gif', 'jpg', 'jpeg', 'png' ),
				'required'      	=> array( 'preloader-image', '=', 'custom' ),
			),
		)
	) );
	
	/*
	* Back to top options
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Back To Top Button', 'pls-theme' ),
        'id'         		=> 'section-back-to-top',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'back-to-top',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show back to top button.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 1,
            ),
			array(
                'id'       			=> 'back-to-top-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button In Mobile', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show back to top button in mobile device.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 1,
            ),
		)
	) );
	
	/*
	* Promo Bar
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Promo Bar', 'pls-theme' ),
        'id'         		=> 'section-promo-bar',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'promo-bar',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Promo Bar', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show promo bar.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 0,
			),			
			array(
                'id'            	=> 'promo-bar-height',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Height', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Promo bar height in pixels.', 'pls-theme' ),
				'output' 			=> array( '.promo-bar-wrapper' ),
                'default'       	=> 40,
                'min'           	=> 10,
                'step'          	=> 1,
                'max'           	=> 200,
                'display_value' 	=> 'text',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-position',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Position', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Select location for promo bar.', 'pls-theme' ),
                'options'  			=> array(
                    'top' 		=> esc_html__( 'Top', 'pls-theme' ),
                    'bottom' 	=> esc_html__( 'Bottom', 'pls-theme' ),
                ),
                'default'  			=> 'top',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-position-type',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Position Type', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Select position type for promo bar.', 'pls-theme' ),
                'options'  			=> array(
                    'absolute' 		=> esc_html__( 'Absolute', 'pls-theme' ),
                    'fixed' 		=> esc_html__( 'Fixed', 'pls-theme' ),
                ),
                'default'  			=> 'absolute',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-message-text',
                'type'     			=> 'editor',
                'title'    			=> esc_html__( 'Message', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter promo message.', 'pls-theme' ),
				'default'  			=> esc_html__( 'SUMMER SALE, Get 40% Off for all products.', 'pls-theme' ),
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-link-btn',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Show link button in promo bar.', 'pls-theme' ),
				'default'  			=> 0,
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-link-btn-text',
                'type'     			=> 'text',
                'title'    			=>  esc_html__( 'Button Text', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'The text of the more info button.', 'pls-theme' ),
				'default'  			=> esc_html__( 'Click Here', 'pls-theme' ),
				'required' 			=> array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-link-btn-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Enter Url', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'The text of the more info button.', 'pls-theme' ),
				'default'  			=> '#',
				'required' 			=> array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-link-open-new-tab',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Open link in New Tab', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Select the link target for more info page.', 'pls-theme' ),
				'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 1,
				'required' 			=> array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-close-btn',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Close Button', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Show close button.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-dismiss',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Promo Bar Dismissing', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Show promo bar dismissing close button.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
				'required' 			=> array( 'promo-bar-close-btn', '=', 1 ),
            ),
			array(
                'id'    	=> 'promo-notice1',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Promo Bar Colors', 'pls-theme' ),
            ),
			array (
				'id'       			=> 'promo-bar-background',
				'type'     			=> 'background',
				'title'    			=> esc_html__( 'Background', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Promo bar background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-promo-bar' ),
				'default'  			=> array(
					'background-color'	 	=> '#FEBFCA',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       			=> 'promo-button-text-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Button Text Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set button text color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#ffffff',
                    'hover'   		=> '#fcfcfc',
                )
            ),
			array(
                'id'       			=> 'promo-button-background',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Button Background Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set button background color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#000000',
                )
            ),
			array(
				'id'          		=> 'promo-bar-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Promo Bar Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'These settings control the typography for promo bar.', 'pls-theme' ),
				'output' 			=> array( '.promo-bar-msg, .promo-bar-close' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> '',
					'font-size'   		=> '16px', 
					'letter-spacing'	=> '',
				),
			),
		)
	) );
	
	/*
	* Lazyload Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Lazy Load Images', 'pls-theme' ),
        'id'         		=> 'section-lazy-load',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'lazy-load',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Lazy Load Images', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Enables lazy load to reduce page requests.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      			=> esc_html__( 'No', 'pls-theme' ),
                'default'  			=> 0,
            ),
		)
	) );
	
	/*
	* Google Map API
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'API Key', 'pls-theme' ),
        'id'         		=> 'section-api-key',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'   				=> 'google-map-api',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Google Map API Key', 'pls-theme' ),
				'subtitle'			=> wp_kses( 
					sprintf( 
						__( 'You should create an API for yourself and put code here. read below link to more info: <a href="%s" target="_blank">here</a>.', 'pls-theme' ),
						esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key')
					),
					array( 
						'a'	=> array( 
							'href' 		=> array(), 
							'target'	=> array() 
						) 
					) 
				),
				'default'  			=> '',
            ),
			array(
                'id'   				=> 'instagram-access-token',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Instagram Access Token', 'pls-theme' ),
				'subtitle'			=> wp_kses( 
					sprintf( 
						__( 'You should create an API for yourself and put code here. read below link to more info: <a href="%s" target="_blank">here</a>.', 'pls-theme' ),
						esc_url('https://docs.presslayouts.com/jeelen/#theme-options-general')
					),
					array( 
						'a'	=> array( 
							'href' 		=> array(), 
							'target'	=> array() 
						) 
					) 
				),
				'default'  			=> '',
            ),
		),
	) );
	
	/*
	* Mobile
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Mobile', 'pls-theme' ),
        'id'         	=> 'section-mobile',
		'icon'		 	=> 'el el-iphone-home',
        'fields'     	=> array(
			array(
                'id'       			=> 'mobile-categories-menu',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Categories Menu', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show categories menu in mobile.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-menu-social-profile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Social Profile', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show social profile in mobile menu.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'product-hover-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Product Hover', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'By default display product hover in mobile.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'mobile-product-hover-image',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Hover Image In Mobile', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show product hover image in mobile layout.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
		),
	) );
	
	/*
	* Mobile Navbar
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Navbar', 'pls-theme' ),
        'id'         		=> 'section-mobile-navbar',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'mobile-bottom-navbar',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Mobile Bottom Navbar', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Show mobile bottom navbar in mobile device.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0
            ),
			array(
                'id'       			=> 'mobile-bottom-navbar-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Bottom Navbar Color', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select mobile bottom navbar color mode.', 'pls-theme' ),
                'options'  			=> array(
                    'light' 		=> esc_html__( 'Light', 'pls-theme' ),
                    'dark'			=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'light',
            ),
			array(
                'id'       			=> 'mobile-navbar-label',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Navbar Label', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Show navbar label.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-product-page-button',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Product Page Button', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Show Sticky Add to Cart/Buy Now button on single product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-cart-page-button',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Cart Page Button', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Show Sticky Proceed To Checkout button on cart page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-checkout-page-button',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Checkout Page Button', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Show Sticky Place Order button on checkout page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-navbar-elements',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Navbar Elements', 'pls-theme' ),
                'compiler' 			=> 'true',
                'options'  			=> array(
                    'enabled'  		=> array(
                        'home'     		=> esc_html__( 'Home', 'pls-theme' ),
						'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'pls-theme' ),
						'search'  		=> esc_html__( 'Search', 'pls-theme' ),
						'wishlist' 		=> esc_html__( 'Wishlist', 'pls-theme' ),
						'account'  		=> esc_html__( 'Account', 'pls-theme' ),
                    ),
                    'disabled' 		=> array(
						'shop'  		=> esc_html__( 'Shop', 'pls-theme' ),
						'menu'  		=> esc_html__( 'Menu', 'pls-theme' ),
						'cart'     		=> esc_html__( 'Cart', 'pls-theme' ),
						'compare'  		=> esc_html__( 'Compare', 'pls-theme' ),
						'order'			=> esc_html__( 'Order', 'pls-theme' ),
						'order-tracking'=> esc_html__( 'Order Tracking', 'pls-theme' ),
						'blog'  		=> esc_html__( 'Blog', 'pls-theme' ),
						'custom_link1'  => esc_html__( 'Custom Link 1', 'pls-theme' ),
						'custom_link2'  => esc_html__( 'Custom Link 2', 'pls-theme' ),
						'custom_link3'  => esc_html__( 'Custom Link 3', 'pls-theme' ),
					),
                ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-shop',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Shop Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter shop navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Shop', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-shop',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Shop Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-home', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-home', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-wishlist',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Wishlist Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter wishlist navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Wishlist', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-wishlist',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Wishlist Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-heart', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-heart', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-cart',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Cart Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter cart navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Cart', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-cart',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Cart Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-cart', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-cart', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-account',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Account Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter account navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Account', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-account',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Account Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-user', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-user', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-home',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Home Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter home navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Home', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-home',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Home Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-home', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-home', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-menu',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Menu Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter menu navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Menu', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-menu',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Menu Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-menu', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-menu', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-compare',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Compare Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter compare navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Compare', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-compare',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Compare Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-sync', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-sync', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-filter',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Filter Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter filter navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Filters', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-filter',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Filter Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. picon-equalizer', 'pls-theme' ),
				'default'  			=> esc_html__( 'picon-equalizer', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-order',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter order navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Order', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-order',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-dice', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-dice', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-order-tracking',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Tracking Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter order tracking navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Order Tracking', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-order-tracking',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Tracking Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-rocket', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-rocket', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-sidebar',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Sidebar Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter sidebar navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Sidebar', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-sidebar',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Sidebar Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. picon-sidebar', 'pls-theme' ),
				'default'  			=> esc_html__( 'picon-sidebar', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-blog',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Blog Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter blog navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Blog', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-blog',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Blog Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr  lnr-pencil', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr  lnr-pencil', 'pls-theme' ),
            ),
			
			array(
                'id'       			=> 'mobile-navbar-label-search',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Search Label', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter blog navbar label', 'pls-theme' ),
				'default'  			=> esc_html__( 'Search', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-search',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Search Label Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Enter pls font icon class. Ex. lnr lnr-magnifier', 'pls-theme' ),
				'default'  			=> esc_html__( 'lnr lnr-magnifier', 'pls-theme' ),
            ),
			array(
                'id'    => 'custom-link-options',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Custom Links', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 Label','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 1 label.','pls-theme'),
				'default'  			=> esc_html__( 'Custom 1', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 Icon','pls-theme'),
                'subtitle'     		=> esc_html__('Enter pls font icon class.','pls-theme'),
				'default'  			=> 'lnr lnr-user',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 URL','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 1 url.','pls-theme'),
				'default'  			=> '#',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 Label','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 2 label.','pls-theme'),
				'default'  			=> esc_html__( 'Custom 2', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 Icon','pls-theme'),
                'subtitle'     		=> esc_html__('Enter pls font icon class.','pls-theme'),
				'default'  			=> 'lnr lnr-user',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 URL','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 2 url.','pls-theme'),
				'default'  			=> '#',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 Label','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 3 label.','pls-theme'),
				'default'  			=> esc_html__( 'Custom 3', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 Icon','pls-theme'),
                'subtitle'     		=> esc_html__('Enter pls font icon class.','pls-theme'),
				'default'  			=> 'lnr lnr-user',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 URL','pls-theme'),
                'subtitle'     		=> esc_html__('Enter custom link 3 url.','pls-theme'),
				'default'  			=> '#',
            ),
		)
	) );
	
	/*
	* Mobile colors
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Colors', 'pls-theme' ),
        'id'         		=> 'section-mobile-colors',
		'subsection'   		=> true,
        'fields'     		=> array(
			array(
                'id'    		=> 'header-mobile-notice',
                'type'   		=> 'info',
                'notice' 		=> false,
                'title' 		=> esc_html__( 'Mobile Header Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'header-mobile-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Background', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Mobile header background color.', 'pls-theme' ),
                'default'  			=> '#ffffff',
            ),	
			array(
                'id'       			=> 'header-mobile-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Mobile header text color.', 'pls-theme' ),
                'default'  			=> '#777777',
            ),			
			array(
                'id'       			=> 'header-mobile-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Mobile header link and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#000000',
                )
            ),
			array(
                'id'       			=> 'header-mobile-border',
                'type'     			=> 'border',
                'title'    			=> esc_html__( 'Border', 'pls-theme' ),                
                'subtitle' 			=> esc_html__( 'Mobile  header border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
                    'border-top'    	=> '1px',
                    'border-right'  	=> '1px',
                    'border-bottom' 	=> '1px',
                    'border-left'   	=> '1px'
                )
            ),
			array(
				'id'       			=> 'google-theme-color',
				'type'     			=> 'color',
				'title'    			=> esc_html__( 'Google Theme Color', 'pls-theme' ), 				
				'subtitle'   		=> wp_kses( sprintf( __( 'Applied only on mobile devices Android on chrome browser toolbar, <a href="%s" target="_blank">click here</a> plugin.', 'pls-theme' ), esc_url( 'http://updates.html5rocks.com/2014/11/Support-for-theme-color-in-Chrome-39-for-Android/' ) ),
				array(
						'a' 	=> array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'validate' 			=> 'color',
				'default'  			=> '#FFFFFF'
			),
			array(
                'id'    		=> 'header-mobile-menu-notice',
                'type'   		=> 'info',
                'notice' 		=> false,
                'title' 		=> esc_html__( 'Mobile Menu Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'mobile-menu-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Mobile Menu Color', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select mobile menu color mode.', 'pls-theme' ),
                'options'  			=> array(
                    'light' 		=> esc_html__( 'Light', 'pls-theme' ),
                    'dark'			=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'light',
            ),
		),
	) );
	
	/*
	* Theme Typography
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'pls-theme' ),
        'id'         => 'section-typography',
		'icon'		 => 'el el-font',
        'fields'     => array(
			array(
				'id'          		=> 'body-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Primary Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'color'  			=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use primary font for all title, body text, etc...', 'pls-theme' ),
				'output' 			=> array( 'body, body .compare-list' ),
				'default'     		=> array(
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '16',
					'letter-spacing'	=> '',
				),
			),
			array(
				'id'          		=> 'secondary-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Secondary Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'font-size'   		=> false,
				'letter-spacing' 	=> false,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use secondary font for secondary(alt) titles.', 'pls-theme' ),
				'output' 			=> array( '.secondary-font' ),
				'default'     		=> array(
					'color'       		=> '#222222',
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
				),
			),			
			array(
				'id'          		=> 'h1-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H1 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H1 heading font for all H1 headings.', 'pls-theme' ),
				'output' 			=> array( 'h1, .h1' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '40px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h2-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H2 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H2 heading font for all H2 headings.', 'pls-theme' ),
				'output' 			=> array( 'h2, .h2' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '33px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h3-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H3 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H3 heading font for all H3 headings.', 'pls-theme' ),
				'output' 			=> array( 'h3, .h3' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '28px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h4-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H4 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H4 heading font for all H4 headings.', 'pls-theme' ),
				'output' 			=> array( 'h4, .h4' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '23px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h5-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H5 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H5 heading font for all H5 headings.', 'pls-theme' ),
				'output' 			=> array( 'h5, .h5' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '19px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h6-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H6 Headings Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H6 heading font for all H6 headings.', 'pls-theme' ),
				'output' 			=> array( 'h6, .h6' ),
				'default'     		=> array(
					'color'       		=> '#222222', 
					'font-weight'  		=> '500', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '16px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'main-menu-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Main Menu Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'color'				=> false,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use this typography for header main navigation.', 'pls-theme' ),
				'output' 			=> array( '.pls-main-navigation ul.menu > li > a' ),
				'default'     		=> array(
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '13px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'uppercase'
				),
			),
			array(
				'id'          		=> 'categories-menu-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Categories Menu Font', 'pls-theme' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'color'				=> false,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use this typography for categories parent menu.', 'pls-theme' ),
				'output' 			=> array( '.categories-menu ul.menu > li > a' ),
				'default'     		=> array(
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Jost', 
					'google'      		=> true,
					'font-backup' 		=> 'sans-serif',
					'font-size'   		=> '15px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
		),
	) );
	
	/*
	* Custom Fonts
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Custom Fonts', 'pls-theme' ),
        'id'         		=> 'section-custom-font',
		'desc'  			=> esc_html__( 'After uploading your fonts,you will have to save Theme Settings and RELOAD this page , Then you should select font family (custom font family)from dropdown list in (Body/Paragraph/Headings/Navigation) Typography section.', 'pls-theme' ),
        'subsection'   		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'custom-font1',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font1', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 1.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Enable', 'pls-theme' ),
				'off'      			=> esc_html__( 'Disable', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font1-name',
                'title'     		=> esc_html__( 'Font1 Name', 'pls-theme' ),
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-woff',
                'title'     		=> esc_html__( 'Font1 (.woff)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-woff2',
                'title'     		=> esc_html__( 'Font1 (.woff2)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-ttf',
                'title'     		=> esc_html__( 'Font1 (.ttf)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-svg',
                'title'     		=> esc_html__( 'Font1 (.svg)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-eot',
                'title'     		=> esc_html__( 'Font1 (.eot)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'id'       			=> 'custom-font2',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font2', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 2.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Enable', 'pls-theme' ),
				'off'      			=> esc_html__( 'Disable', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font2-name',
                'title'     		=> esc_html__( 'Font2 Name', 'pls-theme' ),
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-woff',
                'title'     		=> esc_html__( 'Font2 (.woff)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-woff2',
                'title'     		=> esc_html__( 'Font2 (.woff2)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-ttf',
                'title'     		=> esc_html__( 'Font2 (.ttf)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-svg',
                'title'     		=> esc_html__( 'Font2 (.svg)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-eot',
                'title'     		=> esc_html__( 'Font2 (.eot)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'id'       			=> 'custom-font3',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font3', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 3.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Enable', 'pls-theme' ),
				'off'      			=> esc_html__( 'Disable', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font3-name',
                'title'     		=> esc_html__( 'Font3 Name', 'pls-theme' ),
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-woff',
                'title'     		=> esc_html__( 'Font3 (.woff)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-woff2',
                'title'     		=> esc_html__( 'Font3 (.woff2)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-ttf',
                'title'     		=> esc_html__( 'Font3 (.ttf)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-svg',
                'title'     		=> esc_html__( 'Font3 (.svg)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-eot',
                'title'     		=> esc_html__( 'Font3 (.eot)', 'pls-theme' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
		),
	) );
	
	/*
	* Typekit Font
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Adobe Typekit Font', 'pls-theme' ),
        'id'         	=> 'section-typekit-font',
        'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'       			=> 'typekit-font',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Adobe Typekit Font', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Adobe Typekit.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Enable', 'pls-theme' ),
				'off'      			=> esc_html__( 'Disable', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'   				=> 'typekit-kit-id',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Typekit Kit ID', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter your ', 'pls-theme' ) . '<a target="_blank" href="https://typekit.com/account/kits">Typekit Kit ID</a>.',
				'required'  		=> array( 'typekit-font', '=', '1' ),
            ),
			array(
                'id'   				=> 'typekit-kit-family',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Typekit Font Family', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter all custom fonts you will use separated with coma.', 'pls-theme' ),
				'required'  		=> array( 'typekit-font', '=', '1' ),
            ),
		),
	) );
	
	// Theme Styling Options
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Theme Styling', 'pls-theme' ),
        'id'               => 'theme-styling',
        'desc'             => '',
        'icon'		 	   => 'el el-brush',
		'fields'           => array(
		)
	) );
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Body', 'pls-theme' ),
        'id'         		=> 'body-styling',
        'subsection' 		=> true,		
        'fields'     		=> array(
            array(
                'id'       			=> 'primary-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Primary Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Primary color', 'pls-theme' ),
                'default'  			=> '#222222',
            ),
			array(
				'id'       			=> 'primary-inverse-color',
				'type'     			=> 'color',
				'title'    			=> esc_html__( 'Primary Inverse Color', 'pls-theme' ), 
				'subtitle' 			=> esc_html__( 'Primary inverse color', 'pls-theme' ),
				'validate' 			=> 'color',
				'default'  			=> '#ffffff'
			),
			array(
                'id'       			=> 'secondary-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Secondary Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Secondary color', 'pls-theme' ),
                'default'  			=> '#222222',
            ),
			array(
				'id'       			=> 'secondary-inverse-color',
				'type'     			=> 'color',
				'title'    			=> esc_html__( 'Secondary Inverse Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Secondary inverse color', 'pls-theme' ),
				'validate' 			=> 'color',
				'default'  			=> '#ffffff'
			),
			array(
				'id'       			=> 'theme-hover-background-color',
				'type'     			=> 'color',
				'title'    			=> esc_html__( 'Hover Background Color', 'pls-theme' ), 
				'subtitle' 			=> esc_html__( 'Apply theme hover background color for ul li menu, list, etc...', 'pls-theme' ),
				'validate' 			=> 'color',
				'default'  			=> '#f5f5f5'
			),
			array(
                'id'       			=> 'body-background',
                'type'     			=> 'background',
                'title'    			=> esc_html__( 'Body Background', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Body background image or color. Only for work in Boxed layout', 'pls-theme' ),
				'output'   			=> array( 'body' ),
                'default' 			=> array(
					'background-color' 		=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
			array (
				'id'       			=> 'site-wrapper-background',
				'type'     			=> 'background',
				'title'    			=> esc_html__('Wrapper Background', 'pls-theme'),
				'output' 			=> array('.pls-site-wrapper'),
				'default'  			=> array(
					'background-color'	 	=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       			=> 'body-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Site text color.', 'pls-theme' ),
                'default'  			=> '#777777',
            ),
			array(
                'id'       			=> 'body-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Site link and hover color.', 'pls-theme' ),
				'active'   			=> false,
                'default'  			=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#000000',
                )
            ),
			array(
                'id'       			=> 'theme-border',
                'type'     			=> 'border',
                'title'    			=> esc_html__( 'Border', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Site border color, style and width.', 'pls-theme' ),
				'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
                    'border-top'    	=> '1px',
                    'border-right'  	=> '1px',
                    'border-bottom' 	=> '1px',
                    'border-left'   	=> '1px'
                )
            ),
			array(
                'id'            	=> 'theme-border-radius',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Border Radius', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'site border radius.', 'pls-theme' ),
                'default'       	=> 0,
                'min'           	=> 0,
                'step'          	=> 1,
                'max'           	=> 10,
                'display_value' 	=> 'label'
            ),			
			array(
                'id'       			=> 'body-input-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Input Field Background', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  			=> '#ffffff',
            ),
			array(
                'id'       			=> 'body-input-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Input Field Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  			=> '#777777',
            ),	
        )
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Topbar', 'pls-theme' ),
        'id'         	=> 'topbar-styling',
        'subsection' 	=> true,
        'fields'     	=> array(
			array(
                'id'       			=> 'topbar-background',
                'type'     			=> 'background',
                'title'    			=> esc_html__( ' Background', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Topbar background image or color.', 'pls-theme' ),
				'output' 			=> array( '.pls-header-topbar' ),
				'default'  			=> array(
					'background-color'	 	=> '#222222',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
            ),
            array(
                'id'       			=> 'topbar-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Topbar text color', 'pls-theme' ),
                'default'  			=> '#ffffff',
            ),
			array(
                'id'       			=> 'topbar-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Topbar link and hover color.', 'pls-theme' ),
				'active'    		=> false,
                'default'  			=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#e9e9e9',
                )
            ),
			array(
                'id'       			=> 'topbar-border',
                'type'     			=> 'border',
                'title'    			=> esc_html__( 'Border', 'pls-theme' ),                
                'subtitle' 			=> esc_html__( 'Topbar border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#222222',
                    'border-style'  	=> 'solid',
                    'border-top'    	=> '1px',
                    'border-right'  	=> '1px',
                    'border-bottom' 	=> '1px',
                    'border-left'   	=> '1px'
                )
            ),
			array(
                'id'          		=> 'topbar-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Max Height', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Set max height for topbar.', 'pls-theme' ),
                'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 42,
                )
            ),
		)
	) );
	
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Header', 'pls-theme' ),
        'id'         		=> 'header-styling',
        'subsection' 		=> true,
        'fields'     		=> array(
			array(
                'id'    	=> 'header-notice1',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Header Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'header-background',
                'type'     			=> 'background',
                'title'    			=> esc_html__( 'Background', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Header background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-header-main' ),
                'default' 			=> array(
					'background-color' 		=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       			=> 'header-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Header text color', 'pls-theme' ),
                'default'  			=> '#222222',
            ),
			array(
                'id'       			=> 'header-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Header link and hover color.', 'pls-theme' ),
				'active'   			=> false,
                'default'  			=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                ),
            ),
			array(
                'id'       			=> 'header-border',
                'type'     			=> 'border',
                'title'    			=> esc_html__( 'Border', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Header border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
                    'border-top'    	=> '1px',
                    'border-right'  	=> '1px',
                    'border-bottom' 	=> '1px',
                    'border-left'   	=> '1px'
                )
            ),
			array(
                'id'          		=> 'header-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Height', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Set min height for header.', 'pls-theme' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 85,
                )
            ),			
		)
	) );
		
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Navigation', 'pls-theme' ),
        'id'         	=> 'navigation-styling',
        'subsection' 	=> true,
        'fields'     	=> array(
			array(
                'id'       			=> 'navigation-background',
                'type'     			=> 'background',
                'title'    			=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Navigation bar background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-header-navigation' ),
                'default'  			=> array(
					'background-color' 		=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       			=> 'navigation-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Navigation bar text color', 'pls-theme' ),
                'default'  			=> '#222222',
            ),
			array(
                'id'       			=> 'navigation-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Navigation bar link and hover color.', 'pls-theme' ),
				'active'   			=> false,
                'default'  			=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                )
            ),			 
			array(
                'id'       			=> 'navigation-border',
                'type'     			=> 'border',
                'title'    			=> esc_html__( 'Navigation Border', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Navigation bar border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
                    'border-top'    	=> '1px',
                    'border-right'  	=> '1px',
                    'border-bottom' 	=> '1px',
                    'border-left'   	=> '1px'
                )
            ),
			array(
                'id'          		=> 'navigation-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Height', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Set min height for navigation bar.', 'pls-theme' ),
                'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 56,
                )
            ),	
		)
	) );
	
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Menu & Categories Menu', 'pls-theme' ),
        'id'         	=> 'menu-styling',
        'subsection' 	=> true,
        'fields'     	=> array(		
			array(
                'id'       			=> 'menu-hover-style',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Menu Hover Style', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select menu hover style(effect).', 'pls-theme' ),
                'options'  			=> array(
                    'line' 		=> esc_html__( 'Line', 'pls-theme' ),
                    'color'		=> esc_html__( 'BG Color', 'pls-theme' ),
                    'none' 		=> esc_html__( 'None', 'pls-theme' ),
                ),
                'default'  			=> 'line',
            ),
			array(
                'id'    	=> 'frist-level-menu-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'First Level Menu Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'first-level-menu-background-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Hover Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'First level menu hover background color', 'pls-theme' ),
				'desc'     			=> esc_html__( 'Notice: This options work when you have selected Menu Hover style BG Color.', 'pls-theme' ),
                'default'  			=> '#f5f5f5',
            ),		
			array(
                'id'       			=> 'first-level-menu-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'First level menu link and hover color.', 'pls-theme' ),
				'desc'     			=> esc_html__( 'Notice: This options work when you have selected Menu Hover style BG Color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#222222',
                ),
            ),
			array(
                'id'    	=> 'categories-menu-title-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Categories Menu Title Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'categories-menu-title-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Categories menu title background color.', 'pls-theme' ),
                'validate' 			=> 'color',
                'default' 			=> 'transparent',
            ),
			array(
                'id'       			=> 'categories-menu-title-hover-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Hover Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Categories menu title hover background color.', 'pls-theme' ),
                'validate' 			=> 'color',
                'default' 			=> '#222222',
            ),
			array(
                'id'       			=> 'categories-menu-title-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Categories Title Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Categories title color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#ffffff',
                )
            ),
			array(
                'id'    	=> 'categories-menu-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Categories Area & Menu Colors', 'pls-theme' ),
            ),
			array (
				'id'       			=> 'categories-menu-wrapper-background',
				'type'     			=> 'color',
				'title'    			=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Categories menu wrapper/area background color', 'pls-theme' ),
				'default'  			=> '#ffffff',
			),
			array(
                'id'       			=> 'categories-menu-hover-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Hover Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Categories menu hover background color', 'pls-theme' ),
                'validate' 			=> 'color',
                'default' 			=> '#f5f5f5',
            ),
			array(
                'id'       			=> 'categories-menu-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Categories menu link and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#555555',
                    'hover'   		=> '#222222',
                )
            ),
			array(
                'id'       			=> 'categories-menu-border',
                'type'     			=> 'border',
                'title'   	 		=> esc_html__( 'Border', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Categories menu border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
					'border-top'    	=> '1px',
					'border-right'  	=> '1px',
					'border-bottom' 	=> '1px',
					'border-left'   	=> '1px'
                )
            ),
			array(
                'id'    	=> 'menu-popup-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Main & Categories menu Popup Colors', 'pls-theme' ),
            ),
			array (
				'id'       			=> 'popup-menu-background',
				'type'     			=> 'background',
				'title'    			=> esc_html__( 'Background', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Popup menu background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-navigation ul.menu ul.sub-menu, .pls-navigation .pls-megamenu-wrapper' ),
				'default'  			=> array(
					'background-color'	 	=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       			=> 'popup-menu-hover-background',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Hover Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Popup menu hover background color', 'pls-theme' ),
				'desc'     			=> esc_html__( 'Notice: This options work when you have selected Menu Hover style BG Color.', 'pls-theme' ),
                'validate' 			=> 'color',
                'default' 			=> '#f5f5f5',
            ),
			array(
                'id'       			=> 'popup-menu-title-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Title Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Popup menu title color', 'pls-theme' ),
                'default'  			=> '#222222',
            ),
			array(
                'id'       			=> 'popup-menu-text-color',
                'type'     			=> 'color',
                'title'    			=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Popup menu text color', 'pls-theme' ),
                'default'  			=> '#555555',
            ),
			array(
                'id'       			=> 'popup-menu-link-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Popup menu link and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 	=> '#555555',
                    'hover'   	=> '#222222',
                )
            ),
			array(
                'id'       			=> 'popup-menu-border',
                'type'     			=> 'border',
                'title'   	 		=> esc_html__( 'Border', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Popup menu border color, style and width.', 'pls-theme' ),
                'default'  			=> array(
                    'border-color'  	=> '#e5e5e5',
                    'border-style'  	=> 'solid',
					'border-top'    	=> '1px',
					'border-right'  	=> '1px',
					'border-bottom' 	=> '1px',
					'border-left'   	=> '1px'
                )
            ),			
		)
	) );
	
	/*
	* Buttons colors
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Buttons', 'pls-theme' ),
        'id'         	=> 'section-buttons',
		'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'    	=> 'site-button-color-info',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Site Buttons Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'button-background',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Button Background', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set button background and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#222222',
                )
            ),
			array(
                'id'       			=> 'button-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Button Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set button text color and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#ffffff',
                    'hover'   		=> '#f1f1f1',
                )
            ),
			
			//Shop Page Buttons Colors
			array(
                'id'    	=> 'shop-page-button-color-info',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Shop Page Buttons Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'shop-cart-button-background',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Add To Cart Background', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set add to cart button background and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#222222',
                    'hover'   		=> '#222222',
                )
            ),
			array(
                'id'       			=> 'shop-cart-button-color',
                'type'     			=> 'link_color',
                'title'    			=> esc_html__( 'Add To Cart Color', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Set add to cart button text color and hover color.', 'pls-theme' ),
                'active'    		=> false,
                'default'  			=> array(
                    'regular' 		=> '#ffffff',
                    'hover'   		=> '#f1f1f1',
                )
            ),
			
			//Product Page Buttons Colors
			array(
                'id'    	=> 'product-page-button-color-info',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Product Page Buttons Colors', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'product-cart-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Background', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button background and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                )
            ),
			array(
                'id'       		=> 'product-cart-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button text color and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                )
            ),
			array(
                'id'       		=> 'buy-now-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Buy Now Background', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set buy now button background and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#e5e5e5',
                    'hover'   	=> '#222222',
                )
            ),
			array(
                'id'       		=> 'buy-now-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Buy Now Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set buy now button text color and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#ffffff',
                )
            ),
			array(
                'id'    => 'checkout-button-color-info',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Checkout Buttons Colors', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'checkout-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Checkout & Place Order Background', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set checkout button background and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                )
            ),
			array(
                'id'       		=> 'checkout-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Checkout & Place Order Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set checkout button text color and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                )
            ),
			
		),
	) );
	
	/*
	* Header
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'pls-theme' ),
        'id'         => 'header',
		'icon'		 => 'el el-photo',
        'fields'     => array(
			array(
                'id'   				=> 'header-phone-number',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Phone Number', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide phone number on header.', 'pls-theme' ),
				'default'  			=> '+(123) 4567 890',
            ),			
			array(
                'id'   				=> 'header-email',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Email Address', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide email address on header.', 'pls-theme' ),
				'default'  			=> 'support@domain.com',
            ),
			array(
                'id'   				=> 'header-store-location',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Store Location Text', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide store location on header.', 'pls-theme' ),
				'default'  			=> 'Find Store',
            ),
			array(
				'id'       			=> 'header-store-location-page',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'page','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Store Location Page', 'pls-theme' ),
				'subtitle'   	=> wp_kses( sprintf( __( 'You create store page from <a href="%s" target="_blank">here</a> and select it.', 'pls-theme' ), esc_url( admin_url( 'post-new.php?post_type=page' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__('Choose page', 'pls-theme' ),
			),
			array(
                'id'   				=> 'header-welcome-message',
                'type'      		=> 'editor',
                'title'     		=> esc_html__( 'Welcome Message', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide welcom message on header.', 'pls-theme' ),
				'default'  			=> 'Summer Sale 15% off! Shop Now!',
            ),
			array(
                'id'   				=> 'header-newsletter',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Newsletter', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide newsletter on header.', 'pls-theme' ),
				'default'  			=> 'Newsletter',
            ),
			array(
                'id'       			=> 'header-language-switcher',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Language Switcher', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show language switcher on header topbar or not.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-currency-switcher',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Currency Switcher', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show currency switcher on header topbar or not.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'      			=> 'header-language-switcher-style',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Language Switcher Style', 'pls-theme' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'This option will work if you have used <a href="%1$s" target="_blank">Polylang</a> Or <a href="%2$s" target="_blank">TranslatePress</a> plugin.', 'pls-theme' ), esc_url( 'https://wordpress.org/plugins/polylang/' ),esc_url( 'https://wordpress.org/plugins/translatepress-multilingual/' ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'options'  			=> array(
					'dropdown'		=> esc_html__( 'Dropdown', 'pls-theme' ),
                    'horizontal' 	=> esc_html__( 'Horizontal List', 'pls-theme' ),
                ),
                'default'  			=> 'dropdown',
            ),
			array(
                'id'       			=> 'header-language-switcher-view',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Language Country', 'pls-theme' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'This option will work if you have used <a href="%1$s" target="_blank">Polylang</a> Or <a href="%2$s" target="_blank">TranslatePress</a> plugin.', 'pls-theme' ), esc_url( 'https://wordpress.org/plugins/polylang/' ),esc_url( 'https://wordpress.org/plugins/translatepress-multilingual/' ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'options'  			=> array(
					'both'		=> esc_html__( 'Flag & Name', 'pls-theme' ),
                    'name' 		=> esc_html__( 'Name', 'pls-theme' ),
                    'flag' 		=> esc_html__( 'Flag', 'pls-theme' ),
                ),
                'default'  			=> 'both',
            ),			
			array(
				'id'       => 'header-myaccount',
                'type'     => 'switch',
                'title'    => esc_html__( 'My Account', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Show my account on header.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       			=> 'login-register-popup',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Login/Register Popup', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show header login/register popup.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-cart',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Cart', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show cart with Icon on header.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-minicart-popup',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Mini Cart Popup', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select header mini cart popup.', 'pls-theme' ),
                'options'  			=> array(
                    'slider' 		=> esc_html__( 'Slider', 'pls-theme' ),
                    'dropdow'		=> esc_html__( 'Dropdown', 'pls-theme' ),
                    'none' 			=> esc_html__( 'None', 'pls-theme' ),
                ),
                'default'  			=> 'slider',
				'required' 			=> array( 'header-cart', '=', 1 ),
            ),
			array(
                'id'       			=> 'header-minicart-slider-color-mode',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Mini Cart Slider Color', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select header mini cart slider color mode.', 'pls-theme' ),
                'options'  			=> array(
                    'light-mode' 		=> esc_html__( 'Light Mode', 'pls-theme' ),
                    'dark-mode'			=> esc_html__( 'Dark Mode', 'pls-theme' ),
                ),
                'default'  			=> 'light-mode',
				'required' 			=> array( 'header-minicart-popup', '=', 'slider' ),
            ),
			array(
                'id'       			=> 'header-cart-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Cart Style', 'pls-theme' ),
				'subtitle' 	   		=> esc_html__( 'Select cart style.', 'pls-theme' ),
                'options'  			=> array(					
					1	=> array(
                        'alt' 	=> '1',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/cart/1.png'
                    ),
					2	=> array(
                        'alt' 	=> '2',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/cart/2.png'
                    ),
                ),
                'default'  			=> 1,
				'required' 			=> array( 'header-cart', '=', 1 ),
            ),
			array(
                'id'       			=> 'header-wishlist',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Wishlist Icon', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show wishlist icon on header.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-compare',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Compare Icon', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show compare icon on header.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-icon-text',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Icon Text', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Show icon text on header.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       => 'categories-menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories Menu', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show shopping categories menu on header or not.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'categories-menu-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Categories Menu Title', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter categories menu title.', 'pls-theme' ),
				'default'  => 'Browse Categories',
            ),
			array(
                'id'       => 'open-categories-menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories(Vertical) Menu On Home Page', 'pls-theme' ),
                'subtitle' => esc_html__( 'You always want to keep the categories (vertical) menu open on the home page.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
		)
	) );
	
	/*
	* Header Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Manager', 'pls-theme' ),
        'id'         		=> 'header-manager',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-topbar',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Topbar', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show header topbar or not.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-transparent',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Transparent', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Make the header transparent/overlay the content.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-transparent-on',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Header Transparent On', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Make the header transparent/overlay the content on front page or all pages.', 'pls-theme' ),
                'options'  			=> array(
                    'front-page' 	=> esc_html__( 'Front Page', 'pls-theme' ),
                    'all-pages' 	=> esc_html__( 'All Pages', 'pls-theme' ),
                ),
                'default'  			=> 'front-page',
				'required' 			=> array( 'header-transparent', '=', 1 ),
            ),
			array(
                'id'       			=> 'header-transparent-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Header Transparent Color', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'This color will work when header transparent/overlay enable.', 'pls-theme' ),
                'options'  			=> array(
                    'light' 	=> esc_html__( 'Light', 'pls-theme' ),
                    'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'light',
				'required' 			=> array( 'header-transparent', '=', 1 ),
            ),
			array(
                'id'       			=> 'header-full-width',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Full Width', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Display header in full width.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-select',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Select Header', 'pls-theme' ),
                'options'  			=> array(
                    'style' 		=> esc_html__( 'Header Style', 'pls-theme' ),
                    'builder' 		=> esc_html__( 'Header Builder', 'pls-theme' ),
                ),
                'default'  			=> 'style',
            ),
			array(
                'id'       			=> 'header-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Header Style', 'pls-theme' ),
                'subtitle' 			=> esc_html__( 'Select a header style.', 'pls-theme' ),
				'full_width' 		=> true,
				'options'  			=> array(
					'1' => array( 'title' => '1', 'alt' => 'Header 1', 'img' => PLS_ADMIN_IMAGES.'header/header-1.png' ),
                    '2' => array( 'title' => '2', 'alt' => 'Header 2', 'img' => PLS_ADMIN_IMAGES.'header/header-2.png' ),
                    '3' => array( 'title' => '3', 'alt' => 'Header 3', 'img' => PLS_ADMIN_IMAGES.'header/header-3.png' ),
                    '4' => array( 'title' => '4', 'alt' => 'Header 4', 'img' => PLS_ADMIN_IMAGES.'header/header-4.png' ),
                    '5' => array( 'title' => '5', 'alt' => 'Header 5', 'img' => PLS_ADMIN_IMAGES.'header/header-5.png' ),
                ),
                'default'  			=> '1',				
				'required' 			=> array( 'header-select', '=', 'style' ),
            ),
			array(
                'id'    			=> 'header-topbar-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Topbar Manager', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-topbar-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Topbar Manager', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header topbar', 'pls-theme' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
						'email' 			=> esc_html__( 'Email', 'pls-theme' ),
                        'customer-care'		=> esc_html__( 'Customer Care', 'pls-theme' ),
                    ),
					'right' 	=> array(
						'welcome-message'	=> esc_html__( 'Welcome Message', 'pls-theme' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'pls-theme' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'pls-theme' ),
					),
					'disabled' 	=> array(							
						'topbar-menu'		=> esc_html__( 'Topbar Menu', 'pls-theme' ),
						'social-profile'	=> esc_html__( 'Social Profile', 'pls-theme' ),
						'location'			=> esc_html__( 'Location', 'pls-theme' ),
						'newsletter'		=> esc_html__( 'Newsletter', 'pls-theme' ),
						'mini-search'		=> esc_html__( 'Mini Search', 'pls-theme' ),
						/* 'topbar-widget'		=> 'Widget', */
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-topbar-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Topbar Left', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-topbar-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Topbar Right', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'    			=> 'header-main-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Main Manager', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-main-manager',
                'type'     			=> 'sorter',
                'title'    			=> 'Header Main Manager',
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header main', 'pls-theme' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
                        'logo' 			=> esc_html__( 'Logo', 'pls-theme' ),
                    ),
                    'center' 	=> array(
						'ajax-search'	=> esc_html__( 'Ajax Search', 'pls-theme' ),
					),
					'right' 	=> array(
						'myaccount'			=> esc_html__( 'My Account', 'pls-theme' ),					
						'wishlist'			=> esc_html__( 'Wishlist', 'pls-theme' ),
						'cart'				=> esc_html__( 'Cart', 'pls-theme' ),						
					),
					'disabled' 	=> array(
						'primary-menu'		=> esc_html__( 'Primary Menu', 'pls-theme' ),
						'secondary-menu'	=> esc_html__( 'Secondary Menu', 'pls-theme' ),
						'compare'			=> esc_html__( 'Compare', 'pls-theme' ),	
						'mini-search'		=> esc_html__( 'Mini Search', 'pls-theme' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'pls-theme' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'pls-theme' ),
						'customer-support'	=> esc_html__( 'Customer Support', 'pls-theme' ),
						'custom-html'		=> esc_html__( 'Custom HTML', 'pls-theme' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-main-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Left', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-main-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Center', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-main-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Align center for above section.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-main-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Right', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'      			=> 'header-main-custom-html',
				'type'    		 	=> 'editor',
                'title'    			=> esc_html__( 'Custom HTML', 'pls-theme' ),
				'default'  			=>'',
				'subtitle' 			=> esc_html__( 'Add your custom html here.', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'    			=> 'header-navigation-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Navigation Manager', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-navigation',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Navigation', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show header navigation.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-navigation-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Navigation Manager', 'pls-theme' ),
                'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header navigation', 'pls-theme' ),
				'full_width' 		=> true,
                'options'  			=> array(
                   'left'  		=> array(
                       'category-menu'		=> esc_html__( 'Category Menu', 'pls-theme' ),
                    ),
                    'center' 	=> array(
						'primary-menu'			=> esc_html__( 'Primary Menu', 'pls-theme' ),
					),
					'right' 	=> array(
					),
					'disabled' => array(
						'secondary-menu'	=> esc_html__( 'Secondary Menu', 'pls-theme' ),	
						'ajax-search'		=> esc_html__( 'Ajax Search', 'pls-theme' ),
						'myaccount'			=> esc_html__( 'My Account', 'pls-theme' ),
						'cart'				=> esc_html__( 'Cart', 'pls-theme' ),					
						'wishlist'			=> esc_html__( 'Wishlist', 'pls-theme' ),
						'customer-support'	=> esc_html__( 'Customer Support', 'pls-theme' ),
						'custom-html'		=> esc_html__( 'Custom HTML', 'pls-theme' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-navigation-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Left', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-navigation-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Center', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '9',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-navigation-align',
				'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Align center for above section.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-navigation-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Right', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'      			=> 'header-navigation-custom-html',
				'type'    		 	=> 'editor',
                'title'    			=> esc_html__( 'Custom HTML', 'pls-theme' ),
				'default'  			=> '',
				'subtitle' 			=> esc_html__( 'Add your custom html here.', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
		)
	) );

	/*
	* Header Sticky Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Sticky Manager', 'pls-theme' ),
        'id'         		=> 'header-sticky-manager',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-sticky',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Enable header sticky.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-sticky-part',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Make Header Sticky', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Select header section and make header sticky.', 'pls-theme' ),
                'options'  			=> array(
					'topbar'		=>	esc_html__( 'Topbar', 'pls-theme' ),
					'main'			=>	esc_html__( 'Middle(Main)', 'pls-theme' ),
					'navigation'	=>	esc_html__( 'Navigation', 'pls-theme' ),					
				),
                'default'  			=> 'main',
				'required' 			=> array( 'header-sticky', '=', 1 )
            ),
			array(
                'id'          		=> 'header-sticky-main-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Middle(Main) Height', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Set middle(|Main) header sticky height.', 'pls-theme' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array( 
                    'height' 		=> 65,
                ),
				'required' 			=> array( 'header-sticky-part', '=', 'main' ),
            ),	
			array(
                'id'       			=> 'header-sticky-scroll-up',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky Scroll-up', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show header sticky on scroll up.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-sticky', '=', 1 ),
            ),
		)
	) );
	
	/*
	* Header Mobile Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Mobile Manager', 'pls-theme' ),
        'id'         		=> 'header-mobile',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-sticky-tablet',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky On Tablet', 'pls-theme' ),
                'subtitle' 	  		=> esc_html__( 'Header sticky on tablet width < 992px.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-sticky-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky On Mobile', 'pls-theme' ),
                'subtitle' 	 		=> esc_html__( 'Header sticky mobile width < 480px.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'          		=> 'header-mobile-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Height', 'pls-theme' ),
				'subtitle'    		=> esc_html__( 'Set mobile header height.', 'pls-theme' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 60,
                )
            ),			
			array(
                'id'    			=> 'header-mobile-topbar-info',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Mobile Topbar Manager', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-mobile-topbar-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Mobile Topbar Manager', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header topbar', 'pls-theme' ),
				'full_width' 		=> true,
                'options'  			=> array(
					'center' 	=> array(
						'welcome-message'	=> esc_html__( 'Welcome Message', 'pls-theme' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'pls-theme' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'pls-theme' ),
					),
					'disabled' 	=> array(
						'email' 			=> esc_html__( 'Email', 'pls-theme' ),
                        'customer-care'		=> esc_html__( 'Customer Care', 'pls-theme' ),
						'topbar-menu'		=> esc_html__( 'Topbar Menu', 'pls-theme' ),
						'social-profile'	=> esc_html__( 'Social Profile', 'pls-theme' ),
						'location'			=> esc_html__( 'Location', 'pls-theme' ),
						'newsletter'		=> esc_html__( 'Newsletter', 'pls-theme' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-mobile-topbar-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show align center for mobile topbar section.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'    			=> 'header-mobile-main-info',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Mobile Main Manager', 'pls-theme' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-mobile-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Mobile Manager', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header mobile', 'pls-theme' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
						'mobile-menu'		=> esc_html__( 'Mobile Menu', 'pls-theme' ),				
                    ),
					'center' 	=> array(
						'logo'				=> esc_html__( 'Logo', 'pls-theme' ),
					),
					'right' 	=> array(
						'mini-search'		=> esc_html__( 'Mini Search', 'pls-theme' ),
						'cart'				=> esc_html__( 'Cart', 'pls-theme' ),
					),
					'disabled' 	=> array(
						'myaccount'			=> esc_html__( 'My Account', 'pls-theme' ),
                        'wishlist'			=> esc_html__( 'Wishlist', 'pls-theme' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-mobile-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Left', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			
			array(
				'id'       			=> 'header-mobile-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Center', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-mobile-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show Header Mobile Center section in align center.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-mobile-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Right', 'pls-theme' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'pls-theme' ),
					'2'  => esc_html__( '2 columns - 1/6', 'pls-theme' ),
					'3'  => esc_html__( '3 columns - 1/4', 'pls-theme' ),
					'4'  => esc_html__( '4 columns - 1/3', 'pls-theme' ),
					'5'  => esc_html__( '5 columns - 5/12', 'pls-theme' ),
					'6'  => esc_html__( '6 columns - 1/2', 'pls-theme' ),
					'7'  => esc_html__( '7 columns - 7/12', 'pls-theme' ),
					'8'  => esc_html__( '8 columns - 2/3', 'pls-theme' ),
					'9'  => esc_html__( '9 columns - 3/4', 'pls-theme' ),
					'10' => esc_html__( '10 columns - 5/6', 'pls-theme' ),
					'11' => esc_html__( '11 columns - 11/12', 'pls-theme' ),
					'12' => esc_html__( '12 columns - 1/1', 'pls-theme' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
		)
	) );
	
	// Header Ajax Search
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Ajax Search', 'pls-theme' ),
        'id'         		=> 'header-ajax-search',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       => 'header-search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Header Search', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Enable/Disable header search.', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'product-ajax-search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Live/Ajax Search', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Live product search or not on header.', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       			=> 'header-ajax-search-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Ajax Search Style', 'pls-theme' ),
				'subtitle' 	   		=> esc_html__( 'Select ajax search box style.', 'pls-theme' ),
                'options'  			=> array(
					'1' 	=> array(
                        'alt' 	=> '1',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/search/1.png'
                    ), 
					'2' 	=> array(
                        'alt' 	=> '2',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/search/2.png'
                    ), 
					'3' 	=> array(
                        'alt' 	=> '3',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/search/3.png'
                    ), 
					'4' 	=> array(
                        'alt' 	=> '4',
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/search/4.png'
                    ), 
                ),
                'default'  			=> '3',
            ),
			array(
                'id'       			=> 'ajax-search-shape',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Ajax Search Shape', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Select ajax search box shape.', 'pls-theme' ),
                'options'  			=> array(
                    'square'	=> esc_html__( 'Square', 'pls-theme' ),
                    'round' 	=> esc_html__( 'Round', 'pls-theme' ),
                ),
                'default'  			=> 'square',
            ),
			array(
                'id'       			=> 'search-content-type',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Search Content Type', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select content type you want to use in the search box.', 'pls-theme' ),
                'options'  			=> array(
                    'all'			=> esc_html__( 'All', 'pls-theme' ),
                    'product' 		=> esc_html__( 'Product', 'pls-theme' ),
                    'post' 			=> esc_html__( 'Post', 'pls-theme' ),
                ),
                'default'  			=> 'product',
            ),
			array(
                'id'       => 'show-categories-dropdow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories Dropdown', 'pls-theme' ),
                'subtitle' 	   => esc_html__( 'Show categories dropdow in product search.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'search-categories',
                'type'     => 'radio',
                'title'    => esc_html__( 'Search Categories Dropdown', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Display categories in search categories dropdow.', 'pls-theme' ),
                'options'  => array(
								'all' 	 => esc_html__( 'Show All Categories', 'pls-theme' ),
								'parent' => esc_html__( 'Only Parent(top level) Categories', 'pls-theme' ),
							),
				'default'  => 'all',
				'required' => array( 'show-categories-dropdow', '=', 1 ),
            ),
			array(
                'id'       => 'categories-hierarchical',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories Hierarchical', 'pls-theme' ),
                'subtitle' 	   => esc_html__( 'Show categories in hierarchical (Must be need to select above option Show All Categories).', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'search-categories', '=', 'all' )
            ),
			array(
                'id'       			=> 'search-placeholder-text',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Search Palceholder Text', 'pls-theme' ),
                'subtitle'     		=> esc_html__('Enter search palceholder text', 'pls-theme' ),
				'default'  			=> esc_html__('Search products', 'pls-theme' ),
            ),			
			array(
                'id'       			=> 'header-search-image',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Image', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__('Show product Image in search results.', 'pls-theme' ),
                'on'       			=> esc_html__('Yes', 'pls-theme' ),
				'off'      			=> esc_html__('No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-search-price',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Price', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__('Show product price in search results.', 'pls-theme' ),
                'on'       			=> esc_html__('Yes', 'pls-theme' ),
				'off'      			=> esc_html__('No', 'pls-theme' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-search-rating',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Rating', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__('Show product raing in search results.', 'pls-theme' ),
                'on'       			=> esc_html__('Yes', 'pls-theme' ),
				'off'      			=> esc_html__('No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'trending-search',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Trending Search', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__('Enable trending search. It will show when focus on search box.', 'pls-theme' ),
                'on'       			=> esc_html__('Yes', 'pls-theme' ),
				'off'      			=> esc_html__('No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
				'id'       			=> 'trending-search-categories',
				'type'     			=> 'select',
				'multi'    			=> true,
				'data' 	   			=> 'terms',
				'args' 				=> array( 'taxonomies'=>'product_cat' ),
				'title'    			=> esc_html__('Trending Categories', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select your trending search categories.', 'pls-theme' ),
				'placeholder' 		=> esc_attr__('Choose product categories', 'pls-theme' ),
				'required' 			=> array( 'trending-search', '=', 1),
			),
		)
	) );
	
	/*
	* Page Heading options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Heading', 'pls-theme' ),
        'id'         => 'page-heading',
		'icon'		 => 'el el-icon-website',
        'fields'     => array(
			array(
                'id'       		=> 'page-title-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Title Layout', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select page title layout.', 'pls-theme' ),
                'options'  		=> array(
					'title-centered' => array(
                        'title' 	=> esc_html__( 'Title Centered', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-default.png',
                    ),
					'center' => array(
                        'title' 	=> esc_html__( 'Centered', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-centered.png',
                    ),
                    'left' => array(
                        'title' 	=> esc_html__( 'Left', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-default.png',
                    ),
					'disable' => array(
                        'title' 	=> esc_html__( 'Disable', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-none.png',
                    )
                ),
                'default'  		=> 'title-centered',
            ),
			array(
                'id'       		=> 'page-heading',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show page title.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'page-breadcrumb',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Breadcrumbs', 'pls-theme' ),
                'subtitle'    	=> esc_html__( 'Show breadcrumbs.', 'pls-theme' ),
                'on'      		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'breadcrumbs-delimiter',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Breadcrumbs Delimiter', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select breadcrumb seperator', 'pls-theme' ),
                'options'  		=> array(
                    'greater-than'		=> esc_html__( '>', 'pls-theme' ),
                    'forward-slash' 	=> esc_html__( '/', 'pls-theme' ),
                ),
                'default'  		=> 'greater-than',
            ),
			
			array(
                'id'    	=> 'page-heading-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Page Heading Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'page-heading-background',
                'type'     			=> 'background',
                'title'    			=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Page title background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-page-title' ),
                'default' 			=> array(
					'background-color' 		=> '#f5f5f5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> 'cover',
					'background-attachment' => '',
					'background-position' 	=> 'center center'
				),
            ),
			array(
                'id'       			=> 'page-title-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Color', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Page title color.', 'pls-theme' ),
                'options'  			=> array(
                    'default' 	=> esc_html__( 'Default', 'pls-theme' ),
                    'light' 	=> esc_html__( 'Light', 'pls-theme' ),
                    'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'dark',
            ),
			array(
                'id'       			=> 'page-title-size',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Size', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Page title size.', 'pls-theme' ),
                'options'  			=> array(
                    'default' 		=> esc_html__( 'Default', 'pls-theme' ),
                    'small' 		=> esc_html__( 'Small', 'pls-theme' ),
                    'large' 		=> esc_html__( 'Large', 'pls-theme' ),
                ),
                'default'  			=> 'default',
            ),
			array(
				'id'             	=> 'page-title-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for page title.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.pls-page-title' ),
				'default'            => array(
					'padding-top'     	=> '50', 
					'padding-bottom'  	=> '50',
					'units'          	=> 'px', 
				)
			),			
		)
	) );
	
	//Footer Options
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'pls-theme' ),
        'id'         => 'footer',
		'icon'		 => 'el el-photo',
        'fields'     => array(
			array(
                'id'       		=> 'site-footer-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Footer', 'pls-theme' ),
				'subtitle'   	=> wp_kses( sprintf( __( 'Select footer style. You can add custom block from <a href="%s" target="_blank">here</a>', 'pls-theme' ), esc_url( admin_url( 'post-new.php?post_type=block' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'options'  		=> array(
					'predefined'	=> esc_html__( 'Predefined', 'pls-theme' ),
                    'custom-block'	=> esc_html__( 'Custom Block', 'pls-theme' ),	
					'none'			=> esc_html__( 'None', 'pls-theme' ),
				),
				'default'  		=> 'predefined',
            ),			
			array(
                'id'       		=> 'footer-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Footer Layout', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select footer layout.', 'pls-theme' ),
                'options'  		=> array(
                    '1' => array(
                        'title' 	=> esc_html__( '1', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-1.png',
                        'alt' 		=> esc_html__( 'Layout 1', 'pls-theme' ),
                    ),
					'2' => array(
                        'title' 	=> esc_html__( '2', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-2.png',
                        'alt' 		=> esc_html__( 'Layout 2', 'pls-theme' ),
                    ),
					'3' => array(
                        'title' 	=> esc_html__( '3', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-3.png',
                        'alt' 		=> esc_html__( 'Layout 3', 'pls-theme' ),
                    ),
					'4' => array(
                        'title' 	=> esc_html__( '4', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-4.png',
                        'alt' 		=> esc_html__( 'Layout 4', 'pls-theme' ),
                    ),
					'5' => array(
                        'title' 	=> esc_html__( '5', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-5.png',
                        'alt' 		=> esc_html__( 'Layout 5', 'pls-theme' ),
                    ),
					'6' => array(
                        'title' 	=> esc_html__( '6', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-6.png',
                        'alt' 		=> esc_html__( 'Layout 6', 'pls-theme' ),
                    ),
					'7' => array(
                        'title' 	=> esc_html__( '7', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/footer-7.png',
                        'alt' 		=> esc_html__( 'Layout 7', 'pls-theme' ),
                    ),
                ),
                'default'  			=> '3',
				'required'			=> array( 'site-footer-style', '=', 'predefined' )
            ),
			array(
				'id'       			=> 'footer-block-id',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'block','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Block', 'pls-theme' ),
				'subtitle'   	=> wp_kses( sprintf( __( 'You can add custom block from <a href="%s" target="_blank">here</a>', 'pls-theme' ), esc_url( admin_url( 'post-new.php?post_type=block' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__('Choose block', 'pls-theme' ),
				'required'			=> array( 'site-footer-style', '=', 'custom-block' )
			),
			array(
				'id'             	=> 'footer-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer section.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.pls-site-footer .pls-footer-main' ),
				'default'            => array(
					'padding-top'     	=> '4.5', 
					'padding-bottom'  	=> '4.5',
					'units'          	=> 'rem', 
				),
				'required'			=> array( 'site-footer-style', '=', 'predefined' )
			),
			array(
                'id'       		=> 'footer-widget-alignment',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Widget Alignment Center', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Display footer widget alignment center.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
				'required'			=> array( 'site-footer-style', '=', 'predefined' )
            ),
			array(
                'id'       		=> 'footer-widget-collapse',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Collapse Widgets on Mobile', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Yes/No collapse footer widgets on mobile device.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required'			=> array( 'site-footer-style', '=', 'predefined' )
            ),
			
			array(
                'id'    => 'footer-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Footer Colors', 'pls-theme' ),
            ),			
			array(
                'id'       		=> 'footer-background',
                'type'     		=> 'background',
                'title'    		=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Footer background image or color.', 'pls-theme' ),
				'output'  	 	=> array( '.pls-site-footer .pls-footer-main, .pls-site-footer .pls-footer-categories' ),
                'default' 		=> array(
					'background-color' 		=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
			array(
                'id'       => 'footer-heading-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Footer heading color like widget, etc.', 'pls-theme' ),
                'default'  => '#222222',
            ),
            array(
                'id'       => 'footer-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' => esc_html__( 'Footer text color', 'pls-theme' ),
                'default'  => '#777777',
            ),
			array(
                'id'       => 'footer-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' => esc_html__( 'Footer link and hover color.', 'pls-theme' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#777777',
                    'hover'   => '#222222',
                )
            ),
			array(
                'id'       => 'footer-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'pls-theme' ),
                'subtitle' => esc_html__( 'Footer border color, style and width.', 'pls-theme' ),
                'default'  => array(
                    'border-color'  => '#e5e5e5',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ), 
			array(
                'id'       => 'footer-social-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Social Icon Color', 'pls-theme' ),
				'subtitle' => esc_html__( 'Footer social icon color.', 'pls-theme' ),
				'active'   => false,
            ),
			array(
                'id'       			=> 'footer-social-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Social Icon Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Footer social icon color.', 'pls-theme' ),
                'options'  			=> array(
                    'default' 	=> esc_html__( 'Default', 'pls-theme' ),
                    'light' 	=> esc_html__( 'Light', 'pls-theme' ),
                    'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'default',
            ),
		)
	) );	
	
	/*
	* Footer Subscribe
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Subscribe', 'pls-theme' ),
        'id'         		=> 'section-footer-subscribe',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-subscribe',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Subscribe', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show subscribe section in footer.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0
            ),
			array(
                'id'       		=> 'footer-subscribe-layout',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Layout', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select subscribe layout.', 'pls-theme' ),
                'options'  		=> array(
                    'centered'		=> esc_html__( 'Centered', 'pls-theme' ),
                    'columns' 		=> esc_html__( '2 Columns', 'pls-theme' ),
                ),
                'default'  		=> 'centered',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'footer-subscribe-title',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Title', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enter subscribe title.', 'pls-theme' ),
				'default'  		=> esc_html__( 'Subscribe Newsletter', 'pls-theme'),
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'footer-subscribe-subtitle',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Subtitle', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enter subscribe subtitle.', 'pls-theme' ),
				'default'  		=> esc_html__( 'Sing up to our Newsletter and get the discount code.', 'pls-theme'),
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'subscribe-form-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Subscribe Form Style', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select subscribe form style.', 'pls-theme' ),
				'options'  		=> array(
                    'simple-form' 		=> array(
                        'title' 	=> esc_html__( 'Simple Form', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/subscribe-form.png',
                    ),
                    'overlay-form' 		=> array(
                        'title' 	=> esc_html__( 'Overlay Form', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/overlay-form.png',
                    ),
                ),
                'default'  		=> 'simple-form',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'subscribe-field-shape',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Field Shape', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select subscribe form field shape.', 'pls-theme' ),
                'options'  		=> array(
                    'shape-square' 	=> esc_html__( 'Square', 'pls-theme' ),
					'shape-round' 	=> esc_html__( 'Round', 'pls-theme' ),
                ),
                'default'  		=> 'shape-square',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'    => 'subscribe-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Subscribe Colors', 'pls-theme' ),
            ),
			array (
				'id'       		=> 'footer-subscribe-background',
				'type'     		=> 'background',
				'title'    		=> esc_html__( 'Background', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Footer subscribe background image or color', 'pls-theme' ),
				'output' 		=> array( '.footer-subscribe' ),
				'default'  		=> array(
					'background-color'	 	=> '#f5f5f5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       		=> 'footer-subscribe-heading-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Heading Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'subscribe heading color.', 'pls-theme' ),
				'output' 		=> array( '.footer-subscribe h3' ),
                'default'  		=> '#222222',
            ),
			array(
                'id'       => 'footer-subscribe-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'pls-theme' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  => '#777777',
            ),	
			array(
                'id'       		=> 'subscribe-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set button text color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                )
            ),
			array(
                'id'       		=> 'subscribe-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set button background color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#000000',
                )
            ),
			array(
                'id'       		=> 'footer-subscribe-border',
                'type'     		=> 'border',
                'title'    		=> esc_html__( 'Border', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'footer subscribe border color, style and width.', 'pls-theme' ),
				'default'  => array(
                    'border-color'  => '#222222',
                    'border-style'  => 'solid',
                    'border-top'    => '2px',
                    'border-right'  => '2px',
                    'border-bottom' => '2px',
                    'border-left'   => '2px'
                )
            ),		
			array(
                'id'       => 'footer-subscribe-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'pls-theme' ),
                'subtitle' => esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  => '#f5f5f5',
            ),
			array(
                'id'       => 'footer-subscribe-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'pls-theme' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  => '#777777',
            ),
			array(
				'id'             	=> 'footer-subscribe-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer subscribe section.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.footer-subscribe' ),
				'default'            => array(
					'padding-top'     	=> '4.5', 
					'padding-bottom'  	=> '4.5',
					'units'          	=> 'rem', 
				)
			),
		)
	) );
	
	/*
	* Footer Features Box
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Features Box', 'pls-theme' ),
        'id'         		=> 'section-footer-featuresbox',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-features-box',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Footer Features Box', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show features box on footer top.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0
            ),
			array(
				'id'       			=> 'footer-features-block',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type' => 'block','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Block', 'pls-theme' ),
				'placeholder' 		=> esc_attr__('Choose block', 'pls-theme' ),
				'required' 			=> array( 'footer-features-box', '=', 1 ),
			),
		)
	) );
	
	/*
	* Footer Copyright
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Copyright', 'pls-theme' ),
        'id'         		=> 'section-footer-copyright',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-copyright',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Copyright', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show website copyright.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1
            ),
			array(
                'id'       		=> 'copyright-layout',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Copyright Layout', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select copyright layout.', 'pls-theme' ),
                'options'  		=> array(
                    'centered'		=> esc_html__( 'Centered', 'pls-theme' ),
                    'columns' 		=> esc_html__( 'Columns', 'pls-theme' ),
                ),
                'default'  		=> 'centered',
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'copyright-text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright', 'pls-theme' ),
				'subtitle' => esc_html__( 'Enter copyright text. Use {current_year} for get dynamic current year.', 'pls-theme' ),
				'default'  => wp_kses( sprintf( __( PLS_THEME_NAME .' &copy; {current_year} by <a href="%s" target="_blank">PressLayouts</a> All Rights Reserved.', 'pls-theme' ), esc_url( 'https://presslayouts.com' ) ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						) 
				),
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'show-payments-logo',
                'type'     => 'switch',
                'title'    => esc_html__( 'Payments Logo', 'pls-theme' ),
				'subtitle' => esc_html__( 'Show payment logo.', 'pls-theme' ),
                'default'  => 0,
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
                'off'      => esc_html__( 'No', 'pls-theme' ),
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'payments-logo',
                'type'     => 'media',
                'url'      => false,
                'title'    => esc_html__( 'Payments Logo Image', 'pls-theme' ),
                'subtitle' => esc_html__( 'Upload payments logo image.', 'pls-theme' ),
				'required' => array( 'show-payments-logo', '=', 1 )
            ),
			array(
				'id'             	=> 'footer-copyright-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer copyright section.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.pls-site-footer .pls-footer-copyright' ),
				'default'            => array(
					'padding-top'     	=> '1.4', 
					'padding-bottom'  	=> '1.4',
					'units'          	=> 'rem', 
				)
			),
			
			array(
                'id'    => 'copyright-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Copyright Colors', 'pls-theme' ),
            ),
			array(
                'id'       => 'copyright-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' => esc_html__( 'Copyright background image or color', 'pls-theme' ),
				'output'   => array( '.pls-site-footer .pls-footer-copyright' ),
                'default'  => array(
					'background-color' => '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       => 'copyright-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' => esc_html__( 'Copyright text color', 'pls-theme' ),
                'default'  => '#777777',
            ),
			array(
                'id'       => 'copyright-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'pls-theme' ),
                'subtitle' => esc_html__( 'Copyright link and hover color.', 'pls-theme' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#777777',
                    'hover'   => '#222222',
                )
            ),
			array(
                'id'       => 'copyright-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Copyright Border', 'pls-theme' ),
                'subtitle' => esc_html__( 'Copyright border color, style and width.', 'pls-theme' ),
                'default'  => array(
                    'border-color'  => '#e5e5e5',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
		)
	) );
	
	/*
	* Shop Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__('Shop','pls-theme'),
        'id'         => 'section-shop',
		'icon'		 => 'el el-shopping-cart',
		'fields'     => array(
			array(
                'id'       		=> 'order-tracking-page',
                'type'     		=> 'select',
                'data'     		=> 'pages',
                'title'    		=> esc_html__( 'Order Tracking Page', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set your order tracking page.', 'pls-theme' ),
                'desc' 			=> esc_html__( 'Page contents: [woocommerce_order_tracking]', 'pls-theme' ),
            ),
			array(
                'id'       => 'product-search-by-sku',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search By Product SKU', 'pls-theme' ),
				'subtitle' => esc_html__( 'Ajax search product by  sku.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'manage-password-strength',
                'type'     => 'switch',
                'title'    => esc_html__( 'Manage Password Strength', 'pls-theme' ),
				'subtitle' => esc_html__( 'Reduce the strength requirement on the woocommerce user login/signup password', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'user-password-strength',
                'type'     => 'button_set',
                'title'    => esc_html__( 'User Password Strength', 'pls-theme' ),
                'options'  => array(
                    '3' => esc_html__( 'Strong (default)', 'pls-theme' ),
                    '2' => esc_html__( 'Medium', 'pls-theme' ),
					'1' => esc_html__( 'Weak', 'pls-theme' ),
					'0' => esc_html__( 'Very Weak', 'pls-theme' ),
                ),
                'default'  => '3',
				'required' => array( 'manage-password-strength', '=', 1 )
            ),
			array(
                'id'       		=> 'single-line-product-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Single Line Title', 'pls-theme' ),
				'subtitle' 	   	=> esc_html__( 'Show product/category/widget  title in single line.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       => 'mini-cart-quantity',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quantity Field in Mini Cart', 'pls-theme' ),
				'subtitle'     => esc_html__( 'Show quantity field in mini cart. ', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       		=> 'product-price-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Product Price Color', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select product price color.', 'pls-theme' ),
                'default'  		=> '#222222',
            ),
		),
	) );
	
	/*
	* Product labels		
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Product labels', 'pls-theme' ),
        'id'         => 'section-product-labels',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'product-labels',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Labels', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show labels sale, featured, new and out of stock on product.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sale-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sale Product Label', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show sale label on product.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'sale-product-label-text-options',
                'type'     => 'button_set',
				'desc' => esc_html__( 'sale product label in percentage or text.', 'pls-theme' ),
                'options'  => array(
                    'text' => esc_html__( 'Text', 'pls-theme' ),
                    'percentages' => esc_html__( 'Percentages', 'pls-theme' ),
                ),
                'default'  => 'text',
				'required' => array( 'sale-product-label', '=', 1 )
            ),
			array(
                'id'       => 'sale-product-label-percentage-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Sale label percentage text.', 'pls-theme' ),
				'default'  => esc_html__( 'Off', 'pls-theme' ),
				'required' => array( 'sale-product-label-text-options', '=', 'percentages' )
            ),
			array(
                'id'       => 'sale-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Sale product label text.', 'pls-theme' ),
				'default'  => esc_html__( 'Sale', 'pls-theme' ),
				'required' => array( 'sale-product-label-text-options', '=', 'text' )
            ),
			array(
                'id'       => 'sale-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'Sale product label color.', 'pls-theme' ),
                'default'  => '#ffa965',
				'required' => array( 'sale-product-label', '=', 1 )
            ),
			array(
                'id'       => 'product-new-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'New Product Label', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show new product label on product.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'new-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'New product label text.', 'pls-theme' ),
				'default'  => esc_html__( 'New', 'pls-theme' ),
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'            => 'product-newness-days',
                'type'          => 'slider',
                'subtitle'          => esc_html__( 'Enter number of days to newness.', 'pls-theme' ),
                'default'       => 30,
                'min'           => 1,
                'step'          => 1,
                'max'           => 90,
                'display_value' => 'text',
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'       => 'new-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'New product label color.', 'pls-theme' ),
                'default'  => '#58cbe5',
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Featured Product Label', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show featured label on product.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Featured product label text.', 'pls-theme' ),
				'default'  => esc_html__( 'Hot', 'pls-theme' ),
				'required' => array( 'featured-product-label', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label-color',
                'type'     => 'color',
                'subtitle'     => esc_html__( 'Featured product label color.', 'pls-theme' ),
                'default'  => '#ff554e',
				'required' => array( 'featured-product-label', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Out Of Stock Product Label', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show out of stock label on product.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label-text',
                'type'     => 'text',
                'subtitle'     => esc_html__( 'out of stock product label text.', 'pls-theme' ),
				'default'  => esc_html__( 'Out Of Stock', 'pls-theme' ),
				'required' => array( 'outofstock-product-label', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'Out of stock product label color.', 'pls-theme' ),
                'default'  => '#a9a9a9',
				'required' => array( 'outofstock-product-label', '=', 1 )
            ),		
		),
	) );
		
	/*
	* Free Shipping Bar		
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Free Shipping Bar', 'pls-theme' ),
        'id'         => 'section-freeshipping',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'free-shipping-bar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Free Shipping Bar', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'You want to enable free shipping bar or not?', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
				'id'      		=> 'free-shipping-amount',
				'type'    		=> 'text',
				'title'   		=> esc_html__( 'Enter Required Amount', 'pls-theme' ), 
				'subtitle'   	=> wp_kses( sprintf( __( 'You can set frees hipping method amount from Woocommerce => settings => shipping => shipping zones => manage shipping method.For more read <a href="%s" target="_blank"> WooCommerce documentation </a> guide.', 'pls-theme' ), esc_url( 'https://docs.woocommerce.com/document/free-shipping/' ) ),
				array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),     
				'default' 		=> '',								  
			),
			array(
				'id'      		=> 'free-shipping-msg',
				'type'    		=> 'textarea',
				'subtitle'    	=> esc_html__( 'Enter free shipping message text. Use {missing_amount} - The remaing amount for free shipping.', 'pls-theme' ),
				'title'  		=> esc_html__( 'Free Shipping Message', 'pls-theme' ),               
				'default' 		=> 'Spend {missing_amount} to get <span>free shipping</span>',
			),
			array(
				'id'      		=> 'free-shipping-complete-msg',
				'type'    		=> 'textarea',
				'title'   		=> esc_html__( 'Free Shipping Success Message', 'pls-theme' ), 
				'subtitle'    	=> esc_html__( 'Message show after reaching progress bar 100%.', 'pls-theme' ),
				'default' 		=> esc_html__( 'Congratulation! You have got free shipping', 'pls-theme' ),	  
			),
		),
	) );
	/*
	* Login to See Price
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Login To See Price', 'pls-theme' ),
        'id'         => 'section-login-to-see-price',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'login-to-see-price',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Login To See Price', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Only logged in users can see the pricing.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
		),
	) );		
	
	/*
	* Cart Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Cart', 'pls-theme' ),
        'id'         => 'section-cart-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'cart-auto-update',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Auto Update Cart ', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Auto update cart when change product quantity.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
		)
	) );
	
	/*
	* Checkout Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Checkout', 'pls-theme' ),
        'id'         => 'section-checkout-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'checkout-product-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Image', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show product image on checkout page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'checkout-product-quantity',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Quantity Filed', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show product quantity filed on checkout page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
		)
	) );
	
	/*
	* Shop Pages Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Archive(Shop) Pages', 'pls-theme' ),
        'id'         => 'section-shop-page',
		'icon'		 => 'el el-shopping-cart',
        'fields'     => array(			
			array(
                'id'       		=> 'shop-page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select shop/archive page layout with sidebar postion.', 'pls-theme' ),
                'options'  			=> array(
                    'full-width' 	=> array(
                        'title' 	=> esc_html__( 'Full Width', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'title' 	=> esc_html__( 'Left Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'title' 	=> esc_html__( 'Right Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'left-sidebar'
            ),
			array(
                'id'       		=> 'shop-page-sidebar',
                'type'     		=> 'select',
                'title'    		=> esc_html__( 'Sidebar', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select sidebar for shop page.', 'pls-theme' ),
                'data'     		=> 'sidebars',
                'default'  		=> 'shop-page-sidebar',
                'required' 		=> array( 'shop-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       		=> 'shop-page-off-canvas-sidebar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Off Canvas Sidebar', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Display off canvas sidebar.', 'pls-theme' ),
                'default'  		=> 0,
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'required' 		=> array( 'shop-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) ),
            ),
			array(
                'id'       		=> 'off-canvas-button-text',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Off Canvas Button Text', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Enter off canvas button text.', 'pls-theme' ),
                'default'  		=> esc_html__( 'Filters', 'pls-theme' ),
                'required' 		=> array( 'shop-page-off-canvas-sidebar', '=', 1 )
            ),
			array(
				'id'      		=> 'shop-page-top-content',
				'type'    		=> 'select',
				'title'   		=> esc_html__( 'Page Top Custom Content', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Select block that display on shop page top area. You can create new block from Blocks => Add New', 'pls-theme' ),
				'options'    	=> pls_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'pls-theme' ) ),
				'default' 		=> ' ',
			),
			array(
				'id'      		=> 'shop-page-bottom-content',
				'type'    		=> 'select',
				'title'   		=> esc_html__( 'Page Bottom Custom Content', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Select block that display on shop page bottom area. You can create new block from Blocks => Add New', 'pls-theme' ),
				'options'    	=> pls_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'pls-theme' ) ),
				'default' 		=> ' ',
			),
			array(
                'id'       		=> 'shop-page-categories',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Shop Loop Categories', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show shop loop categories in page title or on products header.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'shop-page-categories-position',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Categories Position', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select display categories position.', 'pls-theme' ),
                'options'  		=> array(
					'in-page-title' 		=> esc_html__( 'In Page Title', 'pls-theme' ),
                    'in-products-header' 	=> esc_html__( 'In Products Header', 'pls-theme' ),
				),
				'default'  		=> 'in-products-header',
				'required' 		=> array( 'shop-page-categories', '=', 1 )
            ),			
			array(
                'id'       		=> 'shop-page-categories-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Categories Styles', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select categories style.', 'pls-theme' ),
                'options'  		=> array(
					'cate-with-image' 	=> esc_html__( 'Categories with Image', 'pls-theme' ),
                    'cate-with-icon' 	=> esc_html__( 'Categories with Icon', 'pls-theme' ),	
					'only-link' 		=> esc_html__( 'Only Link', 'pls-theme' ),
				),
				'default'  		=> 'cate-with-image',
				'required' 		=> array( 'shop-page-categories', '=', 1 )
            ),
			array(
                'id'       		=> 'shop-page-current-child-cat',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Current Child Categories', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enable this option for show current category\'s child categories', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
                'required' 		=> array( 'shop-page-categories', '=', 1 )
            ),
			array(
				'id'       			=> 'shop-page-selected-categories',
				'type'     			=> 'select',
				'multi'    			=> true,
				'data' 	   			=> 'terms',
				'args' 				=> array( 'taxonomies'=>'product_cat' ),
				'title'    			=> esc_html__('Select Categories', 'pls-theme' ),
				'subtitle'     		=> esc_html__( 'Select specific categories.', 'pls-theme' ),
				'placeholder' 		=> esc_attr__('Choose product categories', 'pls-theme' ),
				'required' 		=> array( 'shop-page-categories', '=', 1 )
			),
			array(
				'id'       			=> 'shop-page-exculde-categories',
				'type'     			=> 'select',
				'multi'    			=> true,
				'data' 	   			=> 'terms',
				'args' 				=> array( 'taxonomies'=>'product_cat' ),
				'title'    			=> esc_html__('Exculde Categories', 'pls-theme' ),
				'placeholder' 		=> esc_attr__('Choose product categories', 'pls-theme' ),
				'required' 		=> array( 'shop-page-categories', '=', 1 )
			),			
			array(
                'id'       		=> 'shop-page-hide-empty-category',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Hide Empty Categories', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enable this option for hide empty categories', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
                'required' 		=> array( 'shop-page-categories', '=', 1 )
            ),
			array(
                'id'       		=> 'shop-page-categories-limit',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Category Limit', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show Number of category.', 'pls-theme' ),
                'default'  		=> 6,
                'required' 		=> array( 'shop-page-categories', '=', 1 )
            ),
			array(
                'id'       		=> 'products-header',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Header', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show products header.', 'pls-theme' ),
                'default'  		=> 1,
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'shop-top-filter',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Header Filter', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show shop page filters on products header.', 'pls-theme' ),
                'default'  		=> 0,
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'products-view-icon',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product View Mode Icon', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show Product view mode icon on product header', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'products-view-icon',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product View Mode Icon', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show Product view mode icon on product header', 'pls-theme' ),
				'multi'    		=> true,
                'options'  		=> array(
					'grid-list' 		=> esc_html__( 'List View', 'pls-theme' ),
                    'grid-two-col' 		=> esc_html__( 'Two Columns', 'pls-theme' ),	
					'grid-three-col' 	=> esc_html__( 'Three Columns', 'pls-theme' ),
					'grid-four-col' 	=> esc_html__( 'Four Columns', 'pls-theme' ),
				),
				'default'  => array( 'grid-list', 'grid-two-col','grid-three-col','grid-four-col' ),
            ),
			array(
                'id'       		=> 'products-view',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product View Mode', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select by default product view mode.', 'pls-theme' ),
                'options'  		=> array(
                    'grid-view' => esc_html__( 'Grid View', 'pls-theme' ),
                    'list-view' => esc_html__( 'List View', 'pls-theme' ),
                ),
                'default'  		=> 'grid-view',
            ),
			array(
                'id'            => 'products-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Products Per Page', 'pls-theme' ),
                'subtitle'      => esc_html__( 'Show number of products per page.', 'pls-theme' ),
                'min'           => 6,
                'step'          => 1,
                'max'           => 120,
                'display_value' => 'text',
                'default'       => 12,
            ),
			array(
                'id'       		=> 'products-per-page-dropdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Per Page Dropdown', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show products per page dropdown on products header', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'products-per-page-number',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Products Per Page Variations', 'pls-theme' ),
				'subtitle'     	=> esc_html__( 'Add product variations by comma. Ex. 9,12,24,36,48', 'pls-theme' ),
                'default'  		=> '6,9,12,24,36,48',
				'required' 		=> array( 'products-per-page-dropdown', '=', 1 )
            ),			
			array(
                'id'       		=> 'products-sorting',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Sorting', 'pls-theme' ),
				'subtitle' 	   	=> esc_html__( 'Show products sorting on shop page and archive pages.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),	
			array(
                'id'       		=> 'ajax-filter',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Ajax Filter', 'pls-theme' ),
				'subtitle' 	   	=> esc_html__( 'Enable ajax filter on shop and product archive pages.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'products-columns',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    2		=> esc_html__( '2', 'pls-theme' ),
                    3	 	=> esc_html__( '3', 'pls-theme' ),
					4	 	=> esc_html__( '4', 'pls-theme' ),
					5	 	=> esc_html__( '5', 'pls-theme' ),
					6	 	=> esc_html__( '6', 'pls-theme' ),
                ),
                'default'  		=> 3,
            ),
			array(
                'id'       		=> 'products-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Tablet', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                    3	 	=> esc_html__( '3', 'pls-theme' ),
					4	 	=> esc_html__( '4', 'pls-theme' ),
                ),
                'default'  		=> 2,
            ),
			array(
                'id'       		=> 'products-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Mobile', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                ),
                'default'  		=> 2,
            ),
			array(
                'id'       		=> 'products-pagination-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Pagination', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select product pagination type.', 'pls-theme' ),
                'options'  		=> array(
					'default'				=> esc_html__( 'Default', 'pls-theme' ),
					'infinity-scroll'		=> esc_html__( 'Infinity Scroll', 'pls-theme' ),
					'load-more-button'		=> esc_html__( 'Load More', 'pls-theme' ),
				),
                'default'  		=> 'default',
            ),
			array(
                'id'       		=> 'products-pagination-load-more-button-text',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Load More Button Text', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enter load more button text.', 'pls-theme' ),
                'default'  		=> 'Load More',
				'required' 		=> array( 'products-pagination-style', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
			array(
                'id'       		=> 'products-pagination-finished-message',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Finished Message', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Text to display when no additional products are available.', 'pls-theme' ),
                'default'  		=> 'No More Products Available',
				'required' 		=> array( 'products-pagination-style', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
		)
	) );
	
	/*
	* Shop Archive Page Title
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Title', 'pls-theme' ),
        'id'         => 'shop-page-title-section',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'shop-page-title-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Title Layout', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Select shop page title layout.', 'pls-theme' ),
                'options'  		=> array(
					'title-centered' => array(
                        'title' 	=> esc_html__( 'Title Centered', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-default.png',
                    ),
					'center' => array(
                        'title' 	=> esc_html__( 'Centered', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-centered.png',
                    ),
                    'left' => array(
                        'title' 	=> esc_html__( 'Left', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-default.png',
                    ),
					'disable' => array(
                        'title' 	=> esc_html__( 'Disable', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/page-title-none.png',
                    )
                ),
                'default'  		=> 'center',
            ),
			array(
                'id'       		=> 'shop-page-heading',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Show page title.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'shop-page-breadcrumb',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Breadcrumbs', 'pls-theme' ),
                'subtitle'    	=> esc_html__( 'Show breadcrumbs.', 'pls-theme' ),
                'on'      		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			
			array(
                'id'    	=> 'shop-page-title-notice',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'Page Title Colors', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'shop-page-title-background',
                'type'     			=> 'background',
                'title'    			=>  esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Page title background image or color', 'pls-theme' ),
				'output' 			=> array( '.pls-catalog-page .pls-page-title' ),
                'default' 			=> array(
					'background-color' 		=> '#f5f5f5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> 'cover',
					'background-attachment' => '',
					'background-position' 	=> 'center center'
				),
            ),
			array(
                'id'       			=> 'shop-page-title-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Color', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Page title color.', 'pls-theme' ),
                'options'  			=> array(
                    'default' 	=> esc_html__( 'Default', 'pls-theme' ),
                    'light' 	=> esc_html__( 'Light', 'pls-theme' ),
                    'dark' 		=> esc_html__( 'Dark', 'pls-theme' ),
                ),
                'default'  			=> 'dark',
            ),
			array(
                'id'       			=> 'shop-page-title-size',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Size', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Page title size.', 'pls-theme' ),
                'options'  			=> array(
                    'default' 		=> esc_html__( 'Default', 'pls-theme' ),
                    'small' 		=> esc_html__( 'Small', 'pls-theme' ),
                    'large' 		=> esc_html__( 'Large', 'pls-theme' ),
                ),
                'default'  			=> 'default',
            ),
			array(
				'id'             	=> 'shop-page-title-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for page title.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.pls-catalog-page .pls-page-title' ),
				'default'            => array(
					'padding-top'     	=> '50', 
					'padding-bottom'  	=> '50',
					'units'          	=> 'px', 
				)
			),
		)
	) );
			
	/*
	* Product Styles
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Product Styles', 'pls-theme' ),
        'id'         => 'product-styles',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'product-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Product Style', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Choose product style.', 'pls-theme' ),
				'full_width' 	=> true,
                'options'  		=> array(
                    'product-style-1' 	=> array(
                        'title' 	=> esc_html__( 'Product Style 1', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'product-style-1.png',
                    ),
					'product-style-2' 	=> array(
                        'title' 	=> esc_html__( 'Product Style 2', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'product-style-2.png',
                    ),
                    'product-style-3' 	=> array(
                        'title' 	=> esc_html__( 'Product Style 3', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'product-style-3.png',
                    ), 
					'product-style-4' => array(
                        'title' 	=> esc_html__( 'Product Style 4', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'product-style-4.png',
                    ),
                ),
                'default'  	=> 'product-style-1',
            ),
			array(
                'id'       		=> 'product-hover-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Hover Image', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show product hover image on products.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),		
			array(
                'id'       		=> 'product-countdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Countdown', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product countdown.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'product-category',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Category', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product category.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Title', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product title.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-rating',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product rating.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'product-rating-count',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating Count', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product rating count.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-rating', '=', 1 )
            ),
			array(
                'id'       		=> 'product-price',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Price', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product price.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),			
			array(
                'id'       		=> 'product-variations',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Variation(Options)', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product variation(attribute) on product hover. Like Color, Size, ...', 'pls-theme' ),
				'desc' 			=> esc_html__( 'Note: Product variation(attribute) not display in Product style 3.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),				
			array(
                'id'       		=> 'product-short-description',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Short Description', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product short description in list view.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),		
		)
	) );
		
	/*
	* Product Catalog Mode
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Catalog Mode', 'pls-theme' ),
        'id'         => 'product-catalog-mode',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'catalog-mode',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Catalog Mode', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Enable catalog mode.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'open-product-page-new-tab',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Open Product In New Tab', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Open product page in new tab.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'product-buttons',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Buttons', 'pls-theme' ),
                'subtitle'      => esc_html__( 'Show product buttons cart, wishlist, compare and quick view in shop page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-cart-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Cart Button', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Show cart button on shop page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-wishlist-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Wishlist Button', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Show wishlist button on shop page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-compare-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Compare Button', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Show compare button on shop page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required'		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-quickview-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Quick View Button', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Show quick view button on shop page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-quick-buy',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Quick Buy Button', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Show quick buy button on product page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'type'      	=> 'text',
                'id'        	=> 'product-quickbuy-button-text',
                'title'     	=> esc_html__( 'Quick Buy Button Text', 'pls-theme' ),
                'subtitle'  	=> esc_html__( 'Enter quick buy button text.', 'pls-theme' ),
                'default'     	=> 'Buy It Now',
                'required'  	=> array( 'single-product-quick-buy', '=', 1 ),
            ),
		)
	) );

	/*
	* Single Product Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Product', 'pls-theme' ),
        'id'         => 'pls-single-product-page',
		'icon'		 => 'el el-shopping-cart',
        'fields'     => array(
			array(
                'id'       		=> 'product-page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select product page layout with sidebar postion.', 'pls-theme' ),
				'options'  		=> array(
                    'full-width' 	=> array(
                        'title' 	=> esc_html__( 'Full Width', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'title' 	=> esc_html__( 'Left Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'title' 	=> esc_html__( 'Right Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'full-width'				
            ),
			array(
                'id'       		=> 'product-page-sidebar',
                'type'     		=> 'select',
                'title'    		=> esc_html__( 'Sidebar', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select sidebar for product page.', 'pls-theme' ),
                'data'     		=> 'sidebars',
                'default'  		=> 'single-product-sidebar',
                'required' 		=> array( 'product-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),			
			array(
                'id'       		=> 'single-product-content-layout',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product Content layout', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Select product content layout.', 'pls-theme' ),
                'options'  		=> array(
					'style-1' 		=> esc_html__( 'Simple', 'pls-theme' ),
                    'style-2' 		=> esc_html__( 'Showcase', 'pls-theme' ),	
					'style-3' 		=> esc_html__( 'Modern', 'pls-theme' ),
				),
				'default'  		=> 'style-1',
            ),
			array(
				'id'       		=> 'product-content-fullwidth',
				'type'     		=> 'switch',
				'title'    		=> esc_html__( 'Product Content Full Width', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'You want to display product content area in full width?', 'pls-theme' ),
				'desc' 			=> esc_html__( 'Note: This option only works when the page layout is full width (no sidebar).', 'pls-theme' ),
				'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
			),
			array(
                'id'       		=> 'product-content-background',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Content Background Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'You want to display content background color?', 'pls-theme' ),
				'desc' 			=> esc_html__( 'Note: This option only works when the page layout is full width (no sidebar).', 'pls-theme' ),
                'options'  		=> array(
					'none' 			=> esc_html__( 'None', 'pls-theme' ),
                    'custom' 		=> esc_html__( 'Custom', 'pls-theme' ),	
					'dark' 			=> esc_html__( 'Dark', 'pls-theme' ),
				),
				'default'  		=> 'none',
            ),
			array (
				'id'       		=> 'product-content-background-color',
				'type'     		=> 'background',
				'title'    		=> esc_html__( 'Background Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set product content background color.', 'pls-theme' ),
				'background-repeat'		=> false,
				'background-attachment'	=> false,
				'background-position'	=> false,
				'background-size'		=> false,
				'background-image'		=> false,
				//'output' 		=> array( '.pls-product-container:before' ),
				'default'  		=> array(
					'background-color'	 	=> '#f5f5f5',
				),
				'required'  	=> array( 'product-content-background', '=', 'custom' ),
			),
			array(
                'id'       		=> 'sticky-product-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Product Image', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'When you scroll the product page at this time you want to stick product image part or not.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
			array(
                'id'       		=> 'sticky-product-summary',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Product Summary', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'When you scroll the product page at this time you want to stick product summary part or not.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
			array(
                'id'       		=> 'sticky-add-to-cart-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Add to Cart Button', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Sticky add to cart button on bottom when scroll the page.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
		)
	));
		
	/*
	* Product Images/Gallery
	*/
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Images/Gallery', 'pls-theme' ),
		'id'         => 'product-images-gallery',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       	=> 'product-gallery-style',
				'type'     	=> 'image_select',
				'title'    	=> esc_html__( 'Gallery Style', 'pls-theme' ),
				'subtitle' 	=> esc_html__( 'Select product gallery style.', 'pls-theme' ),
				'options'  	=> array(
					'product-gallery-left' 	=> array(
						'title' 	=> esc_html__( 'Thumbnail Left', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
					),
					'product-gallery-right' 	=> array(
						'title' 	=> esc_html__( 'Thumbnail Right', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
					),                  
					'product-gallery-bottom' 	=> array(
						'title' 	=> esc_html__( 'Thumbnail Bottom', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
					),
					'product-gallery-none' 	=> array(
						'title' 	=> esc_html__( 'No Thumbnail', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
					),
					'product-gallery-grid' 	=> array(
						'title' 	=> esc_html__( 'Gallery Grid', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-grid.png',
					),
					'product-sticky-info' 	=> array(
						'title' 	=> esc_html__( 'Sticky Info', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-sticky-info.png',
					),
					'product-gallery-horizontal' 	=> array(
						'title' 	=> esc_html__( 'Gallery Horizontal', 'pls-theme' ),
						'img' 	=> PLS_ADMIN_IMAGES . 'product-page/product-gallery-horizontal.png',
					),
				),
				'default'  	=> 'product-gallery-left'
			),
			array(
				'id'       		=> 'product-gallery-zoom',
				'type'     		=> 'switch',
				'title'    		=> esc_html__( 'Product Gallery Zoom', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enable product gallery zoom.', 'pls-theme' ),
				'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
			),
			array(
				'id'       		=> 'product-gallery-lightbox',
				'type'     		=> 'switch',
				'title'    		=> esc_html__( 'Product Gallery Lightbox', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Enable product gallery lightbox.', 'pls-theme' ),
				'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
			),
			array(
				'id'       => 'product-video',
				'type'     => 'switch',
				'title'    => esc_html__( 'Product Video', 'pls-theme' ),
				'subtitle' => esc_html__( 'You want to show product video?', 'pls-theme' ),
				'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
			),
			array(
				'id'       => 'product-360-degree',
				'type'     => 'switch',
				'title'    => esc_html__( 'Product 360 degree Image', 'pls-theme' ),
				'subtitle' => esc_html__( 'You want to show product image in 360 degree view?', 'pls-theme' ),
				'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
			),				
		),
	) );
		
	/*
	* Product Summary
	*/
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Summary', 'pls-theme' ),
		'id'         => 'product-summary',
		'subsection' => true,
		'fields'     => array(
			array(
                'id'       		=> 'single-product-breadcrumbs',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Breadcrumbs', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-navigation',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Navigation', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-rating',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-countdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Countdown', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-availability',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Availability', 'pls-theme' ),
				'subtitle'     	=> esc_html__( 'Show Product availability message like In Stock, Out Of Stock, Hurry left, etc...', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'        	=> 'single-product-availability-instock-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'In Stock Message', 'pls-theme' ),
                'default' 		=> 'In Stock',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'            => 'single-product-availability-lowstock-qty',
                'type'          => 'slider',
                'title'         => esc_html__( 'Low Stock Qty', 'pls-theme' ),
                'subtitle'		=> esc_html__( 'How many numbers you want to display below low stock messages. like Hurry, Only {qty} left.', 'pls-theme' ),
                'default'       => 5,
                'min'           => 1,
                'step'          => 1,
                'max'           => 25,
                'display_value' => 'text',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'        	=> 'single-product-availability-hurry-left-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Stock Hurry Left Message', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Default template is: Hurry, Only {qty} left.Here {qty} is number of item available in stock', 'pls-theme' ),
                'default' 		=> 'Hurry, Only {qty} left.',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'        	=> 'single-product-availability-outstock-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Out of Stock Message', 'pls-theme' ),
                'default' 		=> 'Out of Stock',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-brands',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Brands', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-short-description',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Short Description.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-add-to-cart-ajax',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Add to Cart Using Ajax', 'pls-theme' ),
				'subtitle'    	 => esc_html__( 'Add to cart product using ajax without load page. ', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'single-product-size-chart',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Size Guide', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Show product size guide.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'single-product-meta',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Meta', 'pls-theme' ),
				'subtitle'  	=> esc_html__( 'Show product brand, category, tag, etc...', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),		
			array(
                'id'       		=> 'single-product-share',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Share', 'pls-theme' ),
				'subtitle'  	=> esc_html__( 'Show product share.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
		)
	) );
	
	/*
	* Product Bought Together
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Bought Together', 'pls-theme' ),
        'id'         => 'product-bought-together',
		'subsection' => true,
        'fields'     => array(
			
			array(
                'id'       		=> 'single-product-bought-together',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Bought Together', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'type'     		=> 'text',
                'id'			=> 'product-bought-together-title',
                'title'			=> esc_html__( 'Bought Together Title', 'pls-theme' ),
				'default'  		=> 'Frequently Bought Together',
                'required' 		=> array( 'single-product-bought-together', '=', 1 )
            ),
			array(
                'id'       		=> 'product-bought-together-location',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Bought Together Location', 'pls-theme' ),
                'options'  		=> array(
					'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'pls-theme' ),
					'after-summary'		=> esc_html__( 'After Summary', 'pls-theme' ),					
					'in-tab'  			=> esc_html__( 'In Tab', 'pls-theme' ),
				),
                'default'  		=> 'summary-bottom',
				'required' 		=> array( 'single-product-bought-together', '=', 1 )
            ),			
		),
	) );
	
	/*
	* Product Tags
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Tabs', 'pls-theme' ),
        'id'         => 'product-tabs',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'single-product-tabs',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Tabs', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-tabs-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product Tabs Style', 'pls-theme' ),
                'options'  		=> array(
					'tabs'  		=> esc_html__( 'Tabs', 'pls-theme' ),
					'accordion'		=> esc_html__( 'Accordion', 'pls-theme' ),					
					'toggle'  		=> esc_html__( 'Toggle', 'pls-theme' ),
				),
                'default'  		=> 'tabs',
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-tabs-location',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product Tabs Location', 'pls-theme' ),
                'options'  		=> array(
					'after-summary'		=> esc_html__( 'After Summary', 'pls-theme' ),	
					'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'pls-theme' ),
				),
                'default'  		=> 'after-summary',
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
			array(
                'id'            	=> 'single-product-tabs-content-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Tabs Content Width', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Select product description tabs content width(%).', 'pls-theme' ),				
				'output' 			=> array( '.woocommerce-tabs.tabs-layout .tab-content-wrap' ),
                'default'       	=> 70,
                'min'           	=> 30,
                'step'          	=> 1,
                'max'           	=> 100,
				'required' 			=> array( 'single-product-tabs-style', '=', array( 'tabs' ) ),
            ),
			array(
                'id'       		=> 'single-product-tabs-titles',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Tabs Titles', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
		),
	) );
	
	/*
	* Product Related/Up-Sells/Recently-Viewed
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Related/Up-Sells/Rviewed', 'pls-theme' ),
        'id'         => 'product-related-upsells-rv',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'upsells-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Up Sells Products', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show Up sells products.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'related-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Related Products', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show related products.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'recently-viewed-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Recently Viewed Products', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show Recently viewed products.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'            => 'related-upsells-products',
                'type'          => 'slider',
                'title'         => esc_html__( 'Show Number Of Products', 'pls-theme' ),
				'subtitle'     	=> esc_html__( 'How many products you want to display?', 'pls-theme' ),
                'default'       => 12,
                'min'           => 1,
                'step'          => 1,
                'max'           => 24,
                'display_value' => 'text',
            ),
			array(
                'id'       		=> 'related-upsell-auto-play',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Slider Autoplay', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Autoplay.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'related-upsells-loop',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Slider Inifnity Loop', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Enables related/up sells products slider Inifnity loop. Duplicate last and first products to get loop illusion.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'related-upsell-navigation',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Slider Navigation', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show next/prev navigation.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'related-upsell-product-dots',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Slider Pagination(Dots)', 'pls-theme' ),
				'subtitle'      => esc_html__( 'Show dots pagination.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),			
			array(
                'id'       		=> 'related-upsell-products-columns',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    2		=> esc_html__( '2', 'pls-theme' ),
                    3	 	=> esc_html__( '3', 'pls-theme' ),
					4	 	=> esc_html__( '4', 'pls-theme' ),
					5	 	=> esc_html__( '5', 'pls-theme' ),
					6	 	=> esc_html__( '6', 'pls-theme' ),
                ),
                'default'  		=> 4,
            ),
			array(
                'id'       		=> 'related-upsell-products-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Tablet', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                    3	 	=> esc_html__( '3', 'pls-theme' ),
					4	 	=> esc_html__( '4', 'pls-theme' ),
                ),
                'default'  		=> 3,
            ),
			array(
                'id'       		=> 'related-upsell-products-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Mobile', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                ),
                'default'  		=> 2,
            ),
		),
	) );
	
	/**
	* Advance Options
	*/ 
    Redux::setSection( $opt_name, array(
        'title'   		=> esc_html__( 'Advance Options ', 'pls-theme' ),
		'id'         	=> 'section-advance-options',
		'subsection' 	=> true,
        'fields'  		=> array(
			array(
                'id'    			=> 'delivery-return-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Delivery & Return', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'product-delivery-return',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Delivery & Return', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show delivery & return terms on product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'delivery-return-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Delivery & Return Label', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter your own delivery & return label.', 'pls-theme' ),
				'default'  			=> 'Delivery & Return',
				'required'			=> array( 'product-delivery-return', '=', 1 )
            ),
			array(
				'id'       			=> 'delivery-return-terms',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'block','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Terms Block', 'pls-theme' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'Choose delivery & retund terms block. You can add custom block from <a href="%s" target="_blank">here</a>', 'pls-theme' ), esc_url( admin_url( 'post-new.php?post_type=block' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__( 'Choose terms block', 'pls-theme' ),
				'required'			=> array( 'product-delivery-return', '=', 1 )
			),
			array(
                'id'    			=> 'ask-quetion-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Ask a Question', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'product-ask-quetion',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Ask a Question', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show ask a question form on product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'ask-quetion-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Ask a Question Label', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter ask a question label text.', 'pls-theme' ),
				'default'  			=> 'Ask a Question',
				'required'			=> array( 'product-ask-quetion', '=', 1 )
            ),
			array(
                'id'       			=> 'ask-quetion-form-title',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Ask a Question Form Title', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter ask a question form(popup) title.', 'pls-theme' ),
				'default'  			=> 'Ask a Question',
				'required'			=> array( 'product-ask-quetion', '=', 1 )
            ),
			array(
				'id'       			=> 'ask-question-form',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'wpcf7_contact_form','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Ask Question Form', 'pls-theme' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'Choose ask a question form. You can add custom form  from <a href="%s" target="_blank">here</a>', 'pls-theme' ), esc_url( admin_url( 'admin.php?page=wpcf7-new' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__( 'Choose form block', 'pls-theme' ),
				'required'			=> array( 'product-ask-quetion', '=', 1 )
			),
			array(
                'id'    			=> 'estimated-delivery-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Estimated Delivery Time', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'product-estimated-delivery',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Estimated Delivery', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show estimated delivery on product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'estimated-delivery-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Estimated Delivery Label', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter your own estimated delivery label.', 'pls-theme' ),
				'default'  			=> 'Estimated Delivery:',
				'required'			=> array( 'product-estimated-delivery', '=', 1 )
            ),
			array(
				'id' 				=> 'estimated-delivery-days',
				'type' 				=> 'slider',
				'title' 			=> esc_html__( 'Set Estimated Days', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Set estimated delivery days. Ex. 3-7 days', 'pls-theme' ),
				"min" 				=> 1,
				"step" 				=> 1,
				"max" 				=> 30,
				'display_value' 	=> 'text',
				'handles' 			=> 2,
				"default" 			=> array(
					1 		=> 3,
					2 		=> 7,
				),
				'required' 			=> array( 'product-estimated-delivery', '=', 1 ),
			),
			array(
                'id'    			=> 'product-visitor-count-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Visitor Count', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'single-product-visitor-count',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Visitor Count', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show the number of fake visitors currently viewing a product on product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
				'id' 				=> 'random-visitor-number',
				'type' 				=> 'slider',
				'title' 			=> esc_html__( 'Set Random Number', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Set min and max range to get random number between these value.', 'pls-theme' ),
				"min" 				=> 1,
				"step" 				=> 1,
				"max" 				=> 200,
				'display_value' 	=> 'text',
				'handles' 			=> 2,
				"default" 			=> array(
					1 		=> 20,
					2 		=> 50,
				),
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
			),
			array(
                'id'       			=> 'visitor-count-text',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Enter Visitor Text', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter visitor text. Use {visitor_count} for display visitor count number.', 'pls-theme' ),
				'default'  			=> '{visitor_count} People viewing this product right now!',
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
            ),
			array(
				'id'       			=> 'visitor-count-delay-time',
				'type'     			=> 'slider', 
				'title'    			=> esc_html__( 'Update Visitors Count Number', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Select seconds to delay update the number of visitors count.', 'pls-theme' ),
				'default'  			=> 5,
				'min'      			=> 1,
				'step'     			=> 1,
				'max'      			=> 60,
				'display_value' 	=> 'text',
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
			),
			array(
                'id'    			=> 'product-policy-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Product Policy', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'single-product-policies',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Product Policy', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show product policy on single product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
				'id'				=> 'product-policies',
				'type'				=> 'repeater',
				'title'				=> esc_html__( 'Product Policy List', 'pls-theme' ),
				'bind_title'		=> 'policy_title',
				'group_values'		=> true,
				'fields'     		=> array(
					array(
						'id'          	=> 'policy_title',
						'title'   		=> esc_html__( 'Enter Title', 'pls-theme' ),
						'type'        	=> 'text',
						'placeholder' 	=> esc_html__( 'Tile', 'pls-theme' ),
					),
					array(
						'id'			=> 'policy_icon_class',
						'title'   		=> esc_html__( 'Enter Font Class', 'pls-theme' ),
						'type'			=> 'text',
						'placeholder'	=> esc_html__( 'Font icon class', 'pls-theme' ),
					),               
					array(
						'id'      		=> 'policy_block',
						'type'    		=> 'select',
						'title'   		=> esc_html__( 'Select Block', 'pls-theme' ),
						'options' 		=> pls_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'pls-theme' ) ),
						'placeholder' 	=> esc_html__( 'Select Block', 'pls-theme' ),
					),
				),
				'default'			=> array(
					'redux_repeater_data' 	=> array(
						array(
							'title' => '',
						),
						array(
							'title' => '',
						),
						array(
							'title' => '',
						),
						array(
							'title' => '',
						)
					),
					'policy_title'      	=> array(
						'Free Shipping',
						'1 Year Warranty',
						'Secure payment',
						'30 Days Return',
					),
					'policy_icon_class'   	=> array(
						'picon-truck',
						'picon-shield-check',
						'picon-handshake',
						'picon-reload',
					),				
					'policy_block'          => array(
						'',
						'',
						'',
						'',
					),
				),
				'required' 			=> array( 'single-product-policies', '=', 1 ),
			),
			array(
                'id'    		=> 'product-trust-badge-notice',
                'type'   		=> 'info',
                'notice' 		=> false,
                'title' 		=> esc_html__( 'Trust Badge Image', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'single-product-trust-badge',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Trust Badge', 'pls-theme' ),
				'subtitle'			=> esc_html__( 'Show trust badge image on single product page.', 'pls-theme' ),
                'on'       			=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      			=> esc_html__( 'No', 'pls-theme' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'trust-badge-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Trust Badge Label', 'pls-theme' ),
				'subtitle' 			=> esc_html__( 'Enter your own trust badge label.', 'pls-theme' ),
				'default'  			=> 'Guaranteed Safe Checkout',
				'required'			=> array( 'single-product-trust-badge', '=', 1 )
            ),
			array(
                'id'       		=> 'trust-badge-image',
                'type'     		=> 'media',
                'url'      		=> true,
                'title'    		=> esc_html__( 'Trust Badge Image', 'pls-theme' ),
                'compiler' 		=> 'true',
                'subtitle' 		=>  esc_html__( 'Upload trust badge image.', 'pls-theme' ),
                'default'  		=> array(),
				'required' 		=> array( 'single-product-trust-badge', '=', 1 ),
            ),
		)
    ));
	
	if ( function_exists( 'pls_vendor_theme_options' ) && ( class_exists( 'WeDevs_Dokan' ) || class_exists( 'WC_Vendors' ) || class_exists( 'WCMp' ) || class_exists( 'WCFMmp' ) ) ) {
		/*
		* Vendor Options
		*/
		$vendor_options = pls_vendor_theme_options();
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Vendor Options', 'pls-theme' ),
			'id'         => 'vendor-options',
			'icon'		 => 'el-icon-broom',
			'fields'     => $vendor_options,
		) );
	}
	
	/*
	* Page Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'pls-theme' ),
        'id'         => 'page',
		'icon'		 => 'el el-list-alt',
        'fields'     => array(
			array(
                'id'       		=> 'page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select page layout with sidebar postion.', 'pls-theme' ),
				'options'  		=> array(
                    'full-width' 	=> array(
                        'title' 	=> esc_html__( 'Full Width', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'title' 	=> esc_html__( 'Left Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'title' 	=> esc_html__( 'Right Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'full-width'
            ),
			array(
                'id'       => 'page-sidebar',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar', 'pls-theme' ),
				'subtitle' 	=> esc_html__( 'Select sidebar for page.', 'pls-theme' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'page-comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comment', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show page comments and comment form or not.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
		)
	) );
	
	/*
	* Page Widget Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar Widget', 'pls-theme' ),
        'id'         => 'page-widget',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'widget-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Widget Style', 'pls-theme' ),
                'subtitle'    	=> esc_html__( 'Select sidebar widget style.', 'pls-theme' ),
                'options'  		=> array(
					'default' 		=> esc_html__( 'Default', 'pls-theme' ),
					'bordered' 		=> esc_html__( 'Bordered', 'pls-theme' ),
				),
                'default'  		=> 'default',
            ),
			array(
                'id'       		=> 'sticky-sidebar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sidebar Sticky', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'When you scroll the page at this time you want to sticky sidebar part in all pages or not.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'widget-toggle',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Widget Toggle', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Enable page widget toggle or not.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       => 'widget-menu-toggle',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Widget Menu Toggle', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Enable page widget menu toggle or not.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'widget-items-hide-max-limit',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Widget Items Hide', 'pls-theme' ),
                'subtitle'     => esc_html__( 'Enable widget items hide max limit.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'            => 'number-of-show-widget-items',
                'type'          => 'slider',
                'title'         => esc_html__( 'Show Number Of Widget Items', 'pls-theme' ),
                'default'       => 8,
                'min'           => 5,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'text',
				'required' => array( 'widget-items-hide-max-limit', '=', 1 )
            ),
			array(
                'id'       => 'sidebar-canvas-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sidebar Canvas In Mobile', 'pls-theme' ),
                'subtitle' => esc_html__( 'Display sidebar canvas in mobile.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
		)
	) );
	
	/*
	* 404 Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'pls-theme' ),
        'id'         => '404-page',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'      		=> '404-page-content',
				'type'    		=> 'select',
				'title'   		=> esc_html__( '404 Page Content', 'pls-theme' ),
				'subtitle'   	=> wp_kses( sprintf( __( 'Select 404 page custom content block that display on 404 page. You can add custom block from <a href="%s" target="_blank">here</a>', 'pls-theme' ), esc_url( admin_url( 'post-new.php?post_type=block' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'options'    	=> pls_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'pls-theme' ) ),
				'default' 		=> ' ',
			),
		)
	) );

	/*
	* Post options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog / Post', 'pls-theme' ),
        'id'         => 'blog',
		'icon'		 => 'el el-edit',
        'fields'     => array(			
			array(
                'id'       => 'post-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Categories', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show post categories', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sticky-post-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Post Icon', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show sticky post icon', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'post-format-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Format Icon', 'pls-theme' ),
                'subtitle'    => esc_html__( 'show post format icon', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'post-meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show post meta', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'specific-post-meta',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Specific Post Meta', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select specific post meta to dispaly on post.', 'pls-theme' ),
                'multi'    => true,
                'options'  => array(
					'post-author' 		=> esc_html__( 'Author', 'pls-theme' ),
                    'post-date' 		=> esc_html__( 'Date', 'pls-theme' ),	
					'post-comments' 	=> esc_html__( 'Comments', 'pls-theme' ),
					'post-views' 		=> esc_html__( 'Views', 'pls-theme' ),
					'post-rtime' 		=> esc_html__( 'Read Time', 'pls-theme' ),
					'post-share' 		=> esc_html__( 'Share', 'pls-theme' ),
					'post-edit' 		=> esc_html__( 'Edit', 'pls-theme' ),
				),
                'default'  => array( 'post-author', 'post-date' ),
				'required' => array( 'post-meta', '=', 1 )
            ),
			array(
                'id'       => 'post-meta-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta Icon', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show post meta icon', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
                'off'      => esc_html__( 'No', 'pls-theme' ),
                'default'  => 0,
				'required' => array( 'post-meta', '=', 1 )
            ),
			array(
                'id'       => 'post-meta-separator',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Meta Separator', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Select post meta separator', 'pls-theme' ),
                'options'  => array(
					'meta-separator-slash'	=> esc_html( '/' ),
					'meta-separator-colon'	=> esc_html( ':' ),
					'meta-separator-dot'	=> esc_html( '.' ),
					'meta-separator-bar'	=> esc_html( '|' ),
					'meta-separator-hyphen'	=> esc_html( '-' ),
					'meta-separator-tilde'	=> esc_html( '~' ),
				),
                'default'  => 'meta-separator-hyphen',
				'required' => array( 'post-meta', '=', 1 )
            ),
		)
	) );
	
	/*
	* Blog/Archives options
	*/
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog/Archive Page', 'pls-theme' ),
        'id'         => 'blog-archive',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       		=> 'blog-page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select blog/archive page layout with sidebar postion.', 'pls-theme' ),
				'options'  		=> array(
                    'full-width' 	=> array(
                        'title' 	=> esc_html__( 'Full Width', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'title' 	=> esc_html__( 'Left Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'title' 	=> esc_html__( 'Right Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'right-sidebar'
            ),
			array(
                'id'       => 'blog-page-sidebar',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Select sidebar for blog page.', 'pls-theme' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'blog-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       		=> 'blog-page-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Show blog page title.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'          	=> 'blog-page-title-text',
                'type'        	=> 'text',
                'title'       	=> esc_html__( 'Page Title', 'pls-theme' ),
                'subtitle' 	  	=> esc_html__( 'Enter blog page title text.', 'pls-theme' ),
                'default'       => esc_html__( 'Blog', 'pls-theme' ),
                'placeholder' 	=> esc_attr__( 'Enter blog post title here', 'pls-theme' ),
				'required' 		=> array( 'blog-page-title', '=', 1 )
            ),
			array(
                'id'       		=> 'blog-page-breadcrumb',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Breadcrumb', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Show blog page breadcrumb.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'blog-archive-categories',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Top Archive Categories', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Show archive categories on blog top.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'blog-post-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Post Style', 'pls-theme' ),
                'subtitle'    	=> esc_html__( 'Select post style.', 'pls-theme' ),
                'options'  		=> array(
					'blog-classic' => array(
                        'title' 	=> esc_html__( 'Blog Classic', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Blog Classic', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/blog-classic.png',
                    ),
					'blog-listing' => array(
                        'title' 	=> esc_html__( 'Blog Listing', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Blog Listing', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/blog-listing.png',
                    ),
					'blog-grid' => array(
                        'title' 	=> esc_html__( 'Blog Grid', 'pls-theme' ),
                        'alt' 		=> esc_html__( 'Blog Grid', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/blog-grid.png',
                    ),
                ),
                'default'  	=> 'blog-classic',
            ),
			array(
                'id'       => 'first-standard-post',
                'type'     => 'switch',
                'title'    => esc_html__( 'First Standard Post', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show first standard(fullwidth) post.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'blog-post-style', '=', array( 'blog-listing', 'blog-grid' ) )
            ),
			array(
                'id'       => 'blog-grid-layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gird Layout', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Select blog gird layout', 'pls-theme' ),
                'options'  => array(
                    'simple-grid' 		=> esc_html__( 'Simple', 'pls-theme' ),
                    'masonry-grid' 		=> esc_html__( 'Masonry', 'pls-theme' ),
                ),
                'default'  => 'simple-grid',
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),
			array(
                'id'       		=> 'blog-grid-columns',
                'type'    		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'If you have choosed post style grid or masonry grid layout, so you can manage here number of grid columns display.', 'pls-theme' ),
                'options'  		=> array(
                    2 			=> esc_html__( '2', 'pls-theme' ),
                    3 			=> esc_html__( '3', 'pls-theme' ),
					4 			=> esc_html__( '4', 'pls-theme' ),
                ),
                'default'  		=> 2,
				'required' 		=> array( 'blog-post-style', '=', 'blog-grid' )
            ),			
			array(
                'id'       		=> 'blog-grid-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Tablet', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many post should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                    3	 	=> esc_html__( '3', 'pls-theme' ),
                ),
                'default'  		=> 2,
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),
			array(
                'id'       		=> 'blog-grid-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Mobile', 'pls-theme' ),
				'subtitle'      => esc_html__( 'How many post should be shown per row?', 'pls-theme' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'pls-theme' ),
                    2		=> esc_html__( '2', 'pls-theme' ),
                ),
                'default'  		=> 1,
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),			
			array(
                'id'       => 'blog-post-thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Thumbnail', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show post thumbnail', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'blog-post-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Title', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show post title', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
                'off'      => esc_html__( 'No', 'pls-theme' ),
                'default'  => 1,
            ),
			array(
                'id'       => 'show-blog-post-content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Content', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show blog post content.', 'pls-theme' ),
                'default'  => 1,
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
                'off'      => esc_html__( 'No', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'blog-post-content',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Post Content', 'pls-theme' ),
                'subtitle'    	=> esc_html__( 'Select post content', 'pls-theme' ),
                'options'  		=> array(
					'excerpt-content' 	=> esc_html__( 'Excerpt Content', 'pls-theme' ),
					'full-content' 		=> esc_html__( 'Full Content', 'pls-theme' ),
				),
                'default'  		=> 'full-content',
				'required' 		=> array( 'show-blog-post-content', '=', 1 )
            ),
			array(
                'id'            => 'blog-excerpt-length',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt Length (words)', 'pls-theme' ),
                'subtitle'      => esc_html__( 'Show blog listing excerpt content length (words).', 'pls-theme' ),
                'default'       => 30,
                'min'           => 10,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text',
				'required' => array( 'blog-post-content', '=', 'excerpt-content' )
            ),
			array(
                'id'       => 'read-more-button',
                'type'     => 'switch',
                'title'    => esc_html__( 'Read More Button', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Show read more button', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),			
			array(
                'id'       => 'read-more-button-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Button Style', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Select read more button style', 'pls-theme' ),
                'options'  => array(
					'read-more-link' => esc_html__( 'Link', 'pls-theme' ),
					'read-more-button-fill' => esc_html__( 'Button Fill', 'pls-theme' ),
					'read-more-button' => esc_html__( 'Button', 'pls-theme' ),
				),
                'default'  => 'read-more-button-fill',
				'required' => array( 'read-more-button', '=', 1 )
            ),
			array(
                'id'       => 'post-readmore-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Read More Button Text', 'pls-theme' ),
                'subtitle'    => esc_html__( 'Enter read more button text', 'pls-theme' ),
				'default'  => 'Continue Reading',
				'required' => array( 'read-more-button', '=', 1 )
            ),
			array(
                'id'       => 'blogs-pagination-type',
                'type'     => 'button_set',
                'title'    => esc_html__( ' Pagination Style', 'pls-theme' ),
                'subtitle'    => esc_html__( ' Select pagination style', 'pls-theme' ),
                'options'  => array(
					'default' 				=> esc_html__( 'Default', 'pls-theme' ),
					'infinity-scroll'		=> esc_html__( 'Infinity Scroll', 'pls-theme' ),
					'load-more-button' 		=> esc_html__( 'Load More', 'pls-theme' ),
				),
                'default'  => 'default',
            ),
			array(
                'id'       => 'blog-pagination-load-more-button-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Load More Button Text', 'pls-theme' ),
				'subtitle' => esc_html__( 'Enter load more button text.', 'pls-theme' ),
                'default'  => 'Load More',
				'required' => array( 'blogs-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
			array(
                'id'       => 'blog-pagination-finished-message',
                'type'     => 'text',
                'title'    => esc_html__( 'Finished Message', 'pls-theme' ),
				'subtitle' => esc_html__( 'Text to display when no additional items are available.', 'pls-theme' ),
                'default'  => 'No More Posts Available',
				'required' => array( 'blogs-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),			
		)
	) );
	
	/*
	* Single Post options
	*/
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Post', 'pls-theme' ),
        'id'         => 'single-post',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       		=> 'single-post-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Select single post page layout with sidebar postion.', 'pls-theme' ),
				'options'  		=> array(
                    'full-width' 	=> array(
                        'title' 	=> esc_html__( 'Full Width', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'title' 	=> esc_html__( 'Left Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'title' 	=> esc_html__( 'Right Sidebar', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'right-sidebar'
            ),
			array(
                'id'       => 'single-post-sidebar',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar', 'pls-theme' ),
				'subtitle' 	=> esc_html__( 'Select sidebar for single post.', 'pls-theme' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'single-post-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'single-post-thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Thumbnail', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show post thumbnail or not.', 'pls-theme' ),
                'on'       => esc_html__( 'Show', 'pls-theme' ),
				'off'      => esc_html__( 'Hide', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-gallery-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Gallery Style', 'pls-theme' ),
                'options'  => array(
					'slider'		=>esc_html__( 'Slider', 'pls-theme' ),
					'grid'			=>esc_html__( 'Grid', 'pls-theme' ),
					'one-column'	=>esc_html__( 'One Column', 'pls-theme' ),					
				),
                'default'  => 'slider',
				'required' => array( 'single-post-thumbnail', '=', 1 )
            ),
			array(
                'id'       => 'single-post-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Title', 'pls-theme' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'pls-theme' ),
                'off'      => esc_html__( 'Hide', 'pls-theme' ),
            ),
			array(
                'id'       => 'single-post-author-info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Info', 'pls-theme' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'pls-theme' ),
                'off'      => esc_html__( 'Hide', 'pls-theme' ),
            ),
			array(
                'id'       => 'single-post-tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Tags', 'pls-theme' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'pls-theme' ),
                'off'      => esc_html__( 'Hide', 'pls-theme' ),
            ),
			array(
                'id'       => 'single-post-social-share-link',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share Links', 'pls-theme' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'pls-theme' ),
                'off'      => esc_html__( 'Hide', 'pls-theme' ),
            ),
			array(
                'id'       => 'single-post-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Navigation', 'pls-theme' ),
                'on'       => esc_html__( 'Show', 'pls-theme' ),
				'off'      => esc_html__( 'Hide', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-comment',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Post Comment', 'pls-theme' ),
                'subtitle' => esc_html__( 'Show post comments and comment form or not.', 'pls-theme' ),
                'on'       => esc_html__( 'Show', 'pls-theme' ),
				'off'      => esc_html__( 'Hide', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Post', 'pls-theme' ),
                'on'       => esc_html__( 'Show', 'pls-theme' ),
				'off'      => esc_html__( 'Hide', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       	=> 'single-posts-related',
                'type'     	=> 'slider',
                'title'    	=> esc_html__( 'Show Related Posts', 'pls-theme' ),
				'subtitle'  => esc_html__( 'Show/display number of related posts.', 'pls-theme' ),
                'default'   => 6,
                'min'       => 2,
                'step'      => 1,
                'max'       => 12,
                'display_value' => 'text',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-taxonomy',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Taxonomy', 'pls-theme' ),
				'subtitle' => esc_html__( 'Get related posts by post taxonomy category or tag.', 'pls-theme' ),
                'options'  => array(
					'post_tag'=>esc_html__( 'Tag', 'pls-theme' ),
					'category'=>esc_html__( 'Category', 'pls-theme' ),					
				),
                'default'  => 'post_tag',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-orderby',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Orderby', 'pls-theme' ),
                'options'  => array(
					'none'=>esc_html__( 'None', 'pls-theme' ),
					'rand'=>esc_html__( 'Random', 'pls-theme' ),
					'ID'=>esc_html__( 'ID', 'pls-theme' ),
					'name'=>esc_html__( 'Name', 'pls-theme' ),
					'date'=>esc_html__( 'Date', 'pls-theme' ),
					'modified'=>esc_html__( 'Modified Date', 'pls-theme' ),					
					'comment_count'=>esc_html__( 'Comment Count', 'pls-theme' ),
				),
                'default'  => 'rand',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-order',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Order', 'pls-theme' ),
                'options'  => array(
					'DESC'=>esc_html__( 'DESC', 'pls-theme' ),
					'ASC'=>esc_html__( 'ASC', 'pls-theme' ),					
				),
                'default'  => 'DESC',
				'required' => array( 'single-post-related', '=', 1 ),
            ),			
		)
	) );
			
	/*
	* Social
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'pls-theme' ),
        'id'         => 'social',
		'icon'		 => 'el el-group',
        'fields'     => array(
		)
	) );
	
	/*
	* Social Profile
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Profile', 'pls-theme' ),
        'id'         => 'social-profile-section',
		'icon'		 => '',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'social-profile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Profile Icon', 'pls-theme' ),
				'subtitle' => esc_html__( 'Show social profile icon in header and footer.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'social-profile-icons-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Icons Style', 'pls-theme' ),
                'options'  => array(
					'icons-default' 	=> array(
                        'title' => 'Default',
                        'alt' => 'Default',
                        'img' => PLS_ADMIN_IMAGES . 'layout/social-icon/default.png',
                    ),
					'icons-colour'	=> array(
                        'title' => 'Colour',
                        'alt' => 'Colour',
                        'img' => PLS_ADMIN_IMAGES . 'layout/social-icon/colour.png',
                    ),									
                ),
                'default'  => 'icons-default',
				'required' => array( 'social-profile', '=', 1 )
            ),
			array(
                'id'       => 'profile-icons-size',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Icons Size', 'pls-theme' ),
                'options'  => array(
                    'icons-size-default'=> esc_html__( 'Default', 'pls-theme' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'pls-theme' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'pls-theme' ),
                ),
                'default'  => 'icons-size-default',
				'required' => array( 'social-profile', '=', 1 )
            ),
			array(
                'id'       => 'facebook-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the facebook icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'twitter-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the twitter icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'instagram-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the instagram icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'linkedin-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the linkedin icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'flickr-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the flickr icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),			
			array(
                'id'       => 'rss-link',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the rss icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'pinterest-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the pinterest icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'youtube-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the youtube icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'tiktok-link',
                'type'     => 'text',
                'title'    => esc_html__( 'TikTok', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the tiktok icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'github-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Github', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the github icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'whatsapp-link',
                'type'     => 'text',
                'title'    => esc_html__( 'WhatsApp', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the whatsapp icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'telegram-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Telegram', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the telegram icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'vk-link',
                'type'     => 'text',
                'title'    => esc_html__( 'VK', 'pls-theme' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the VK icon. Leave blank to hide icon.', 'pls-theme' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
		)
	) );
	
	/*
	* Social Share
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Share', 'pls-theme' ),
        'id'         => 'social-share-section',
		'icon'		 => '',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'social-sharing',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share Icons', 'pls-theme' ),
				'subtitle' => esc_html__( 'Show social share icons in blog, posts, products, etc...', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'social-sharing-icons-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Icons Style', 'pls-theme' ),
                'options'  => array(
					'icons-default' 	=> array(
                        'title' => 'Default',
                        'alt' => 'Default',
                        'img' => PLS_ADMIN_IMAGES . 'layout/social-icon/default.png',
                    ),
					'icons-colour'	=> array(
                        'title' => 'Colour',
                        'alt' => 'Colour',
                        'img' => PLS_ADMIN_IMAGES . 'layout/social-icon/colour.png',
                    ),										
                ),
                'default'  => 'icons-default',
				'required' => array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'       => 'sharing-icons-size',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Icons Size', 'pls-theme' ),
                'options'  => array(
                    'icons-size-default'=> esc_html__( 'Default', 'pls-theme' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'pls-theme' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'pls-theme' ),
                ),
                'default'  => 'icons-size-default',
				'required' => array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'       => 'social-share-manager',
                'type'     => 'sorter',
                'title'    => 'Share Icons Manager',
                'compiler' => 'true',
                'options'  => array(
                    'enabled'  => array(
                        'facebook' 		=> 'Facebook',
                        'twitter'     	=> 'Twitter',
                        'linkedin'   	=> 'Linkedin',
						'telegram'		=> 'Telegram',
						'pinterest'		=> 'Pinterest',
                    ),
                    'disabled' => array(
						'stumbleupon'	=> 'StumbleUpon',
						'tumblr'   		=> 'Tumblr',
						'reddit'   		=> 'Reddit',
						'vk'   			=> 'VK',
						'odnoklassniki' => 'Odnoklassniki',
						'pocket'   		=> 'Pocket',
						'whatsapp'  	=> 'WhatsApp',
						'email'   		=> 'Email',
						'print'   		=> 'Print',
					),
                ),
				'required' => array( 'social-sharing', '=', 1 )
            ),			
		)
	) );/* End Social sections */
	
	/*
	* Newsletter Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Newsletter', 'pls-theme' ),
        'id'         => 'newsletter',
		'icon'       => 'el el-envelope',
        'fields'     => array(
			array(
                'id'       => 'newsletter-popup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Newsletter', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'subtitle' => esc_html__( 'Newsletter popup enable or disable in your site.', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       			=> 'newsletter-popup-on',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Newsletter Popup On', 'pls-theme' ),
                'subtitle' 	   		=> esc_html__( 'Show newsletter popup on front page or all pages.', 'pls-theme' ),
                'options'  			=> array(
                    'front-page' 	=> esc_html__( 'Front Page', 'pls-theme' ),
                    'all-pages' 	=> esc_html__( 'All Pages', 'pls-theme' ),
                ),
                'default'  			=> 'all-pages',
            ),
			array(
                'id'       => 'newsletter-show-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'subtitle' => esc_html__( 'You want to show newsletter for mobile devices.', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
				'id'      	=> 'newsletter-when-appear',
				'type'    	=> 'button_set',
				'title'   	=> esc_html__( 'When Popup Appear?', 'pls-theme' ),                    
				'options' 	=> array(
					'page_load' 	=> esc_html__( 'On Page Load', 'pls-theme' ),
					'scroll' 		=> esc_html__( 'When Page Scroll', 'pls-theme' ),
					'exit' 			=> esc_html__( 'On Exit Intent', 'pls-theme' ),
				), 
				'default' 	=> 'page_load',
			),
			array(
				'id'       => 'newsletter-delay',
				'type'     => 'text',
				'title'    => esc_html__( 'Popup Delay', 'pls-theme' ),
				'default'  => '5',
				'subtitle' =>  esc_html__( 'Enter no of second to open popup after page load.', 'pls-theme' ),
				'required' => array( 'newsletter-when-appear', '=', 'page_load' ),
			),
			array(
				'id'       => 'newsletter-version',
				'type'     => 'text',
				'title'    => esc_html__( 'Popup Version', 'pls-theme' ),
				'default'  => '1',
				'subtitle' =>  esc_html__( 'Increase version number, for show forcefully popup who already closed it.', 'pls-theme' ),
			),
			array(
				'id'       => 'newsletter-x-scroll',
				'type'     => 'text',
				'title'    => esc_html__( 'Open When User Scroll % of Page', 'pls-theme' ),
				'default'  => '30',
				'subtitle' =>  esc_html__( '100% - For end of page', 'pls-theme' ),
				'required' => array( 'newsletter-when-appear', '=', 'scroll' ),
			),
			array(
                'id'       => 'newsletter-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Newsletter Logo', 'pls-theme' ),
                'compiler' => 'true',
                'subtitle' =>  esc_html__( 'Upload newsletter logo.', 'pls-theme' ),
                'default'  => array(),
				'required' => array( 'newsletter-popup', '=', 1 ),
            ),
			array(
                'id'       => 'newsletter-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Newsletter Title', 'pls-theme' ),
				'default'  => esc_html__( 'Join the our family', 'pls-theme' ),
            ),
			array(
                'id'       => 'newsletter-tag-line',
                'type'     => 'editor',
                'title'    => esc_html__( 'Newsletter Tag Line', 'pls-theme' ),
				'default'  => esc_html__( 'Sign up to get all the latest fashion news, website updates, offers and promos.', 'pls-theme' ),
            ),
			array(
                'id'       => 'newsletter-dont-show',
                'type'     => 'text',
                'title'    => esc_html__( 'Newsletter Don\'t Show Msg', 'pls-theme' ),
				'default'  => esc_html__( 'Do not show this window', 'pls-theme' ),
            ),			
			array(
                'id'    => 'newsletter-popup-layout',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Newsletter Layout & Style', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'newsletter-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Newsletter Layout', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select newsletter popup layout.', 'pls-theme' ),
				'options'  		=> array(
                    'full-content' 	=> array(
                        'title' 	=> esc_html__( 'Full Content', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/newsletter-full-content.png',
                    ),
                    'banner-left' 	=> array(
                        'title' 	=> esc_html__( 'Banner Left', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/newsletter-banner-left.png',
                    ),
					'banner-right' 	=> array(
                        'title' 	=> esc_html__( 'Banner Right', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/newsletter-banner-right.png',
                    ),
                ),
                'default'  => 'banner-left',
            ),
			array(
                'id'       => 'newsletter-banner',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Newsletter Banner', 'pls-theme' ),
                'compiler' => 'true',
                'subtitle' =>  esc_html__( 'Upload newsletter banner.', 'pls-theme' ),
                'default'  => array(),
				'required' => array( 'newsletter-layout', '=', array ( 'banner-left', 'banner-right' ) ),
            ),
			array(
                'id'            	=> 'newsletter-popup-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Newsletter Width (px)', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Newsletter popup width in pixels', 'pls-theme' ),
				'output'   			=> array( '.pls-newsletter-popup' ),
                'default'       	=> 750,
                'min'           	=> 300,
                'step'          	=> 1,
                'max'           	=> 840,
            ),
			array(
				'id'             	=> 'newsletter-content-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Content Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Set newsletter content padding.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'output' 			=> array( '.pls-newsletter-content' ),
				'default'            => array(
					'padding-top'     	=> '2', 
					'padding-right'    	=> '2', 
					'padding-bottom'  	=> '2',
					'padding-left'  	=> '2',
					'units'          	=> 'rem', 
				),
			),
			array(
                'id'       		=> 'newsletter-form-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Newsletter Form Style', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select newsletter form style.', 'pls-theme' ),
				'options'  		=> array(
                    'simple-form' 		=> array(
                        'title' 	=> esc_html__( 'Simple Form', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/simple-form.png',
                    ),
                    'overlay-form' 		=> array(
                        'title' 	=> esc_html__( 'Overlay Form', 'pls-theme' ),
                        'img' 		=> PLS_ADMIN_IMAGES . 'layout/overlay-form.png',
                    ),
                ),
                'default'  => 'simple-form',
            ),
			array(
                'id'       		=> 'newsletter-field-shape',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Field Shape', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Select newsletter form field shape.', 'pls-theme' ),
                'options'  		=> array(
                    'shape-square' 	=> esc_html__( 'Square', 'pls-theme' ),
					'shape-round' 	=> esc_html__( 'Round', 'pls-theme' ),
                ),
                'default'  		=> 'shape-square',
				'required' 		=> array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'		=> 'newsletter-popup-color',
                'type'		=> 'info',
                'notice'	=> false,
                'title'		=> esc_html__( 'Newsletter Colors', 'pls-theme' ),
            ),
			array(
                'id'       		=> 'newsletter-background',
                'type'     		=> 'background',
                'title'    		=> esc_html__( 'Background Color', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Newsletter background with image, color, etc.', 'pls-theme' ),
				'output'   		=> array( '.pls-newsletter-content' ),
                'default'  		=> array(
					'background-color' 		=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       		=> 'newsletter-title-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set text color', 'pls-theme' ),
				'output'   		=> array( '.pls-newsletter-content > .pls-newsletter-title' ),
                'default'  		=> '#222222',
            ),
            array(
                'id'       		=> 'newsletter-text-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set text color', 'pls-theme' ),
                'default'  		=> '#777777',
            ),
			array(
                'id'       		=> 'newsletter-button-bg-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set button background color', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                ),
            ),
			array(
                'id'       		=> 'newsletter-button-text-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Text Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set button text color', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                ),
            ),
			array(
                'id'       		=> 'newsletter-border',
                'type'     		=> 'border',
                'title'    		=> esc_html__( 'Border', 'pls-theme' ),                
                'subtitle' 		=> esc_html__( 'Set border color, style and width.', 'pls-theme' ),
                'default'  		=> array(
                    'border-color'  => '#e5e5e5',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                ),
            ),
			array(
                'id'            => 'newsletter-border-radius',
                'type'          => 'slider',
                'title'         => esc_html__( 'Border Radius', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Newsletter popup border radius.', 'pls-theme' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 22,
                'display_value' => 'label'
            ),
		)
	) );

	/*
	* Cookie Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Cookie Notice', 'pls-theme' ),
        'id'         => 'section-cookie-notice',
		'icon'       => 'el el-dashboard',
        'fields'     => array(
			array(
                'id'       => 'cookie-notice',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cookie', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'subtitle' => esc_html__( 'Cookie notice enable or disable in your site.', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-title',
                'type'     => 'text',
                'title'    => 'Cookie Title',
                'subtitle' => esc_html__( 'Enter the Cookie Title/Name.', 'pls-theme' ),
				'default'  => esc_html__( 'Cookies Notice', 'pls-theme' ),
            ),
			array(
                'id'       => 'cookie-message-text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Message', 'pls-theme' ),
				'subtitle' => esc_html__( 'Enter the cookie notice message.', 'pls-theme' ),
				'default'  => esc_html__( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'pls-theme' ),
            ),
			array(
                'id'       => 'cookie-accept-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'pls-theme' ),
                'subtitle' => esc_html__( 'The text of the option to accept the usage of the cookies and make the notification disappear.', 'pls-theme' ),
				'default'  => esc_html__( 'Yes, I\'m Accept', 'pls-theme' ),
            ),
			array(
                'id'       => 'cookie-see-more-opt',
                'type'     => 'switch',
                'title'    => esc_html__( 'More Info Link', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'subtitle' => esc_html__( 'Enable Read more link.', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-see-more-text',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'The text of the more info button.', 'pls-theme' ),
				'default'  => esc_html__( 'Read more', 'pls-theme' ),
				'required' => array( 'cookie-see-more-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-see-more-link-type',
                'type'     => 'radio',
                'title'    => '',
                'subtitle' => esc_html__( 'Select where to redirect user for more information about cookies.', 'pls-theme' ),
                'options'  => array(
								'custom' 	 => esc_html__( 'Custom link', 'pls-theme' ),
								'page' => esc_html__( 'Page link', 'pls-theme' ),
							),
				'default'  => 'custom',
				'required' => array( 'cookie-see-more-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-see-more-link-custom',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'Enter the full URL starting with http://', 'pls-theme' ),
				'default'  => 'http://empty',
				'placeholder' => esc_attr( 'http://#' ),
				'required' => array( 'cookie-see-more-link-type', '=', 'custom' ),
            ),
			array(
                'id'       => 'cookie-see-more-link-pages',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => '',
                'subtitle' => esc_html__( 'Select from one of your site\'s pages', 'pls-theme' ),
				'required' => array( 'cookie-see-more-link-type', '=', 'page' ),
            ),
			array(
                'id'       => 'cookie-see-more-link-target',
                'type'     => 'select',
                'title'    => esc_html__( 'Link Target', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select the link target for more info page.', 'pls-theme' ),
                'options'  => array(
                    '_blank' 	=> esc_html__( 'New Page', 'pls-theme' ),
                    '_self' 	=> esc_html__( 'This page', 'pls-theme' ),
                ),
                'default'  => '_blank',
            ),
			array(
                'id'       => 'cookie-refuse-opt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Refuse Button', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'subtitle' => esc_html__( 'Give to the user the possibility to refuse third party non functional cookies.', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-refuse-text',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'The text of the option to refuse the usage of the cookies. To get the cookie notice status use pls_cn_cookies_accepted() function.', 'pls-theme' ),
				'default'  => esc_html__( 'Dismiss', 'pls-theme' ),
				'required' => array( 'cookie-refuse-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-refuse-code',
                'type'     => 'textarea',
                'title'    => '',
				'subtitle' => esc_html__( 'Enter non functional cookies Javascript code here (for e.g. Google Analytics). It will be used after cookies are accepted.', 'pls-theme' ),
				'required' => array( 'cookie-refuse-opt', '=', 1 ),
				
            ),
			array(
                'id'       => 'cookie-on-scroll',
                'type'     => 'switch',
                'title'    => esc_html__( 'On Scroll', 'pls-theme' ),
                'on'       => esc_html__( 'Enable', 'pls-theme' ),
				'off'      => esc_html__( 'Disable', 'pls-theme' ),
				'subtitle' => esc_html__( 'Enable cookie notice acceptance when users scroll.', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-on-scroll-offset',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'Number of pixels user has to scroll to accept the usage of the cookies and make the notification disappear.', 'pls-theme' ),
				'default'  => 100,
				'required' => array( 'cookie-on-scroll', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-expiry-times',
                'type'     => 'select',
                'title'    => esc_html__( 'Cookie Expiry', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select the link target for more info page.', 'pls-theme' ),
                'options'  => array(
					'86400'	 	=> esc_html__( '1 day', 'pls-theme' ),
					'604800'	=> esc_html__( '1 week', 'pls-theme' ),
					'2592000'	=> esc_html__( '1 month', 'pls-theme' ),
					'7862400'	=> esc_html__( '3 months', 'pls-theme' ),
					'15811200'	=> esc_html__( '6 months', 'pls-theme' ),
					'31536000'	=> esc_html__( '1 year', 'pls-theme' ),
					'31337313373' => esc_html__( 'infinity', 'pls-theme' ),
                ),
                'default'  => '2592000',
            ),
			array(
                'id'       => 'cookie-script-placements',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Script Placement', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select where all the plugin scripts should be placed.', 'pls-theme' ),
                'options'  => array(
                    'header' => esc_html__( 'Header', 'pls-theme' ),
                    'footer' => esc_html__( 'Footer', 'pls-theme' ),
                ),
                'default'  => 'footer',
            ),
			array(
                'id'       => 'cookie-positions',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Position', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select location for your cookie notice.', 'pls-theme' ),
                'options'  => array(
                    'top' 		=> esc_html__( 'Top', 'pls-theme' ),
                    'bottom' 	=> esc_html__( 'Bottom', 'pls-theme' ),
                ),
                'default'  => 'bottom'
            ),
			array(
                'id'       => 'cookie-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Cookie Style', 'pls-theme' ),
                'subtitle' => esc_html__( 'Select style of cookie notice on bottom.', 'pls-theme' ),
                'options'  => array(
                    'bar' 		=> esc_html__( 'Bar', 'pls-theme' ),
                    'box' 	=> esc_html__( 'Box', 'pls-theme' ),
                ),
                'default'  => 'bar',
				'required' => array( 'cookie-positions', '=', 'bottom' ),
            ),
			array(
                'id'       => 'cookie-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'pls-theme' ),
                'default'  => '#777777',
            ),
			array(
                'id'       => 'cookie-background-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Bar Background Color', 'pls-theme' ),
                'default'  => '#ffffff',
            ),
		)
	) );
	
	
	/*
	* Slider Config
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Slider Config', 'pls-theme' ),
        'id'         => 'slider-config',
		'icon'		 => 'el el-picture',
        'fields'     => array(
			array(
                'id'       => 'slider-loop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Loop', 'pls-theme' ),
				'subtitle' => esc_html__( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-autoplay',
                'type'     => 'switch',
                'title'    => esc_html__( 'Autoplay', 'pls-theme' ),
                'subtitle' => esc_html__( 'Autoplay.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),			
			array(
                'id'       => 'slider-autoplay-hover-pause',
                'type'     => 'switch',
                'title'    => esc_html__( 'autoplayHoverPause', 'pls-theme' ),
				'subtitle' => esc_html__( 'Pause on mouse hover.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
				'required' => array( 'slider-autoplay', '=', 1 )
            ),
			array(
                'id'       => 'slider-autoplay-speed',
                'type'     => 'text',
                'title'    => esc_html__( 'autoplayTimeout', 'pls-theme' ),
				'subtitle' => esc_html__( 'Autoplay interval timeout.', 'pls-theme' ),
                'default'  => 1000,
				'validate' => 'numeric',
				'required' => array( 'slider-autoplay', '=', 1 )
            ),			
			array(
                'id'       => 'slider-rewind',
                'type'     => 'switch',
                'title'    => esc_html__( 'Rewind', 'pls-theme' ),
				'subtitle' => esc_html__( 'Go backwards when the boundary has reached.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-autoHeigh',
                'type'     => 'switch',
                'title'    => esc_html__( 'AutoHeight', 'pls-theme' ),
                'subtitle' => esc_html__( 'AutoHeight.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navigation', 'pls-theme' ),
				'subtitle' => esc_html__( 'Show next/prev navigation.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-pagination',
                'type'     => 'switch',
                'title'    => esc_html__( 'Pagination(Dots)', 'pls-theme' ),
				'subtitle' => esc_html__( 'Show dots pagination.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-touchDrag',
                'type'     => 'switch',
                'title'    => esc_html__( 'TouchDrag', 'pls-theme' ),
				'subtitle' => esc_html__( 'Touch drag enabled.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-touchDrag-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'TouchDrag In Mobile', 'pls-theme' ),
				'subtitle' => esc_html__( 'Touch drag enabled in mobile.', 'pls-theme' ),
                'on'       => esc_html__( 'Yes', 'pls-theme' ),
				'off'      => esc_html__( 'No', 'pls-theme' ),
				'default'  => 1,
            ),
		)
	) );/* END SLIDER CONFIG SECTIONS */
	
	/*
	* Optimize
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Optimize(Performance)', 'pls-theme' ),
        'id'         => 'site-optimize',
		'icon'		 => 'el el-dashboard',
        'fields'     => array(
			array(
                'id'       		=> 'disable-fontawesome',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Font Awesome', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Disable font awesome style from plugins.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'disable-gutenberg',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Gutenberg', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Disable gutenberg styles.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
			array(
                'id'       		=> 'disable-wc-blocks',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'WC Blocks', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Disable default WooCommerce blocks styles.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
                'off'      		=> esc_html__( 'No', 'pls-theme' ),
                'default'  		=> 0,
            ),
		)
	) );
	
	/*
	* Maintenance Mode
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Maintenance Mode', 'pls-theme' ),
        'id'         => 'site-maintenance-mode',
		'icon'		 => 'el el-icon-website',
        'fields'     => array(
			array(
                'id'       		=> 'maintenance-mode',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Maintenance Mode', 'pls-theme' ),
				'subtitle'		=> esc_html__( 'Status of Maintenance Mode.', 'pls-theme' ),
                'default'  		=> 0,
                'on'       		=> esc_html__( 'On', 'pls-theme' ),
                'off'      		=> esc_html__( 'Off', 'pls-theme' ),
            ),
			array(
				'id'      	=> 'maintenance-page',
				'type'    	=> 'select',
				'title'   	=> esc_html__( 'Page', 'pls-theme' ),
				'subtitle'	=> esc_html__( 'Select page to display as maintenance page.', 'pls-theme' ),
				'data'    	=> 'pages',
			),
		)
	) );
	
	/*
	* White Label
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'White Label', 'pls-theme' ),
        'id'         => 'white-label',
		'icon'       => 'el el-tag',
        'fields'     => array(
			array(
                'id'       			=> 'white-label-enable',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Enable White Label?','pls-theme'),
                'on'       			=> esc_html__('Enable','pls-theme'),
				'off'      			=> esc_html__('Disable','pls-theme'),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'theme-name',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Theme Name', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace all the theme name in admin dashboard.', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'theme-screenshot',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Theme Screenshot', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace the theme screenshot in Appearance > Themes. Recommended size 1200x900px.', 'pls-theme' ),
				'default'  			=> array(),
			),
			array(
                'id'       			=> 'theme-menu-icon',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Theme Menu Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace the theme menu icon. Recommended size 32x32px.', 'pls-theme' ),
				'default'  			=> array(),
			),
			array(
                'id'       			=> 'theme-welcome-page-title',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Welcome Page Title', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page title.', 'pls-theme' ),
				'default'  			=> '',
			),
			array(
                'id'       			=> 'theme-welcome-page-description',
                'type'     			=> 'textarea',
                'title'    			=> esc_html__( 'Welcome Page Description','pls-theme'),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page description.', 'pls-theme' ),
				'default'  			=> '',
            ),
			array(
                'id'       			=> 'theme-welcome-page-icon',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Welcome Page Icon', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page icon. Recommended size 150x150px.', 'pls-theme' ),
				'default'  			=> array()
			),
			array(
                'id'       		=> 'disable-welcome-page',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Disable Welcome Menu','pls-theme' ),
                'subtitle'     	=> esc_html__( 'Disable welcome/dashboard menu.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'disable-demo-import',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Disable Demo Import Menu','pls-theme' ),
                'subtitle'     	=> esc_html__( 'Disable Demo Import Menu.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 0,
            ),
			array(
                'id'    	=> 'section-wodpress-login-page',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'WordPress Login Page Design', 'pls-theme' ),
            ),
			array(
                'id'       			=> 'wp-login-page-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Wordpress Logo', 'pls-theme' ),
                'subtitle'     		=> esc_html__( 'Replace the wordpress logo.', 'pls-theme' ),
				'default'  			=> array()
			),
			array(
                'id'            	=> 'wp-login-page-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Width', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Logo width in pixels', 'pls-theme' ),
                'default'       	=> 150,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 300,
                'display_value' 	=> 'text',
            ),
			array(
                'id'            	=> 'wp-login-page-logo-height',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Height', 'pls-theme' ),
				'subtitle'          => esc_html__( 'Logo height in pixels', 'pls-theme' ),
                'default'       	=> 84,
                'min'           	=> 25,
                'step'          	=> 1,
                'max'           	=> 250,
                'display_value' 	=> 'text',
            ),
			array(
                'id'       		=> 'wp-login-page-background',
                'type'    	 	=> 'background',
                'title'    		=> esc_html__( 'Page Background', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Set wordpress login page background.', 'pls-theme' ),
                'default'  		=> array(
					'background-color' => '#f0f0f1'
				),
            ),
			
			array(
                'id'       		=> 'wp-login-form-background',
                'type'    	 	=> 'color',
                'title'    		=> esc_html__( 'Login Form Background', 'pls-theme' ),
                'subtitle'     	=> esc_html__( 'Set wordpress login form background color.', 'pls-theme' ),
                'default'  		=> '#ffffff',
            ),
			array(
                'id'       		=> 'wp-login-form-box-shadow',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Login Form Box Shadow','pls-theme' ),
                'subtitle'     	=> esc_html__( 'Set login form box shadow.', 'pls-theme' ),
                'on'       		=> esc_html__( 'Yes', 'pls-theme' ),
				'off'      		=> esc_html__( 'No', 'pls-theme' ),
				'default'  		=> 1,
            ),
			array(
				'id'             	=> 'wp-login-form-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Login Form Padding', 'pls-theme' ),
				'subtitle'       	=> esc_html__( 'Add login form spacing using padding.', 'pls-theme' ),
				'mode'           	=> 'padding',
				'units'          	=> array( 'em', '%', 'px' ),
				'default'           => array(
					'padding-top' 		=> '2',
					'padding-right' 	=> '2',
					'padding-bottom' 	=> '2',
					'padding-left' 		=> '2',
					'units'         	=> 'em', 
				)
			),
			array(
                'id'       => 'wp-login-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set text color.', 'pls-theme' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'wp-login-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'Set link and hover color.', 'pls-theme' ),
				'active'    	=> false,
                'default'  => array(
                    'regular' => '#222222',
                    'hover'   => '#222222',
                )
            ),
			array(
                'id'       => 'wp-login-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'pls-theme' ),                
                'subtitle' 		=> esc_html__( 'Set border color, style and width.', 'pls-theme' ),
                'default'  => array(
                    'border-color'  => '#e5e5e5',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'            => 'wp-login-border-radius',
                'type'          => 'slider',
                'title'         => esc_html__( 'Border Radius', 'pls-theme' ),
				'subtitle' 		=> esc_html__( 'site border radius.', 'pls-theme' ),
                'default'       => 4,
                'min'           => 0,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'label'
            ),
			array(
                'id'       => 'wp-login-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color( TextBox, SelectBox, etc..)', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  => '#545454',
            ),
			 array(
                'id'       => 'wp-login-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background( TextBox, SelectBox, etc..)', 'pls-theme' ),
				'subtitle'    	=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'pls-theme' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'       		=> 'wp-login-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set button background color and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#222222',
                    'hover'   	=> '#222222',
                )
            ),
			array(
                'id'       		=> 'wp-login-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Color', 'pls-theme' ),
                'subtitle' 		=> esc_html__( 'Set button text color and hover color.', 'pls-theme' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
		)
	) );
	
	/*
	* Custom CSS/JS Code
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom JS/CSS', 'pls-theme' ),
        'id'         => 'custom-code',
		'icon'		 => 'el-icon-broom',
        'fields'     => array(
			array(
                'id'       => 'custom-css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'CSS Code', 'pls-theme' ),
                'subtitle' => esc_html__( 'Paste your CSS code here.', 'pls-theme' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => ""
            ),	
			array(
				'id'       => 'custom-js-header',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'JS Code before &lt;/head&gt;', 'pls-theme' ),
				'subtitle' => esc_html__( 'Paste your JS code here.', 'pls-theme' ),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'default'  => '',
			),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'JS Code before &lt;/body&gt;', 'pls-theme' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'pls-theme' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
		)
	) );
	
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

      /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'pls-theme' ),
                'subtitle'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'pls-theme' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }