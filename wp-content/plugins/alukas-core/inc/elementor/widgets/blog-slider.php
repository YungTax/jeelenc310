<?php
/*
Element: Blog Slider
*/
use Elementor\Controls_Manager;

class PLS_Elementor_Blog_Slider extends PLS_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'pls-blog-slider';
    }

	/**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blog Slider', 'pls-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'pls-icon eicon-post-slider';
    }
	
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'blog', 'post'];
	}
	
	/**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= pls_core_get_all_image_sizes(true);
		$pls_blog_cats = pls_core_elementor_get_terms('category',true);
		
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'blog_view_mode',
            [
                'label' 	=> esc_html__( 'Blog View Mode', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'vertical'		=> esc_html__( 'Vertical', 'pls-core' ),
					'horizontal'	=> esc_html__( 'Horizontal', 'pls-core' ),
				],
				'default' 	=> 'vertical',				
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_blog_query',
			array(
				'label'     => esc_html__( 'Query', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
            'categories',
            [
                'label'			=> esc_html__( 'Specific Category', 'pls-core' ),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_taxonomies',
				'render'		=> 'pls_core_elementor_render_taxonomies',
				'taxonomy'		=> array('category'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Select specific categories.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'exclude',
            [
                'label'			=> esc_html__('Exclude Post', 'pls-core'),
                'type'			=> 'pls_autocomplete',
				'search'		=> 'pls_core_elementor_search_post',
				'render'		=> 'pls_core_elementor_render_post',
				'post_type'		=> 'post',
				'multiple'		=> true,
				'label_block'	=> true,
				'description' 	=> esc_html__( 'Exclude some blog which you do not want to display.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Per Page', 'pls-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 4,
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'date'   	=> esc_html__( 'Recent Posts', 'pls-core' ),
					'rand'     	=> esc_html__( 'Random Posts', 'pls-core' ),
					'modified' 	=> esc_html__( 'Last Modified Posts', 'pls-core' ),
					'popular'  	=> esc_html__( 'Most Commented posts', 'pls-core' ),
					'views'  	=> esc_html__( 'Most Viewed posts', 'pls-core' ),
				],
				'default' 	=> 'date',
            ]
        );
		$this->add_control(
            'order',
            [
                'label' 	=> esc_html__( 'Sort By', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'DESC'	=> esc_html__( 'Descending', 'pls-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'pls-core' ),
				],
				'default' 	=> 'DESC',
            ]
        );		
		$this->end_controls_section();	
		
		$this->start_controls_section(
			'section_content_blog_settings',
			array(
				'label'     => esc_html__( 'Blog Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
            'blog_title',
            [
                'label' 		=> esc_html__( 'Post Title', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'pls-core' ),
					'0'	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 		=> '1',
				'description'	=> esc_html__( 'Show/hide blog post title.', 'pls-core' ),
            ]
        );
		$this->add_control(
			'post_single_line_title',
			[
				'label'     => esc_html__( 'Single Line Title', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'1'	=> esc_html__( 'Yes', 'pls-core' ),
					'0'	=> esc_html__( 'No', 'pls-core' ),
				],
				'default' 	=> '0',
				'condition' => [
					'blog_title' => '1',
				],
			]
		);
		$this->add_control(
			'post_category',
			[
				'label'     => esc_html__( 'Post Categories', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'pls-core' ),
					'0'	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 	=> '1',
			]
		);
		$this->add_control(
            'image_size',
            [
                'label' 	=> esc_html__( 'Banner Image Size', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
				'default' 	=> 'full',
            ]
        );
		$this->add_control(
            'blog_thumbnail',
            [
                'label' 	=> esc_html__( 'Post Thumbnail', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					1	=> esc_html__( 'Show', 'pls-core' ),
					0	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 	=> 1,
				'description' 	=> esc_html__( 'Show/hide blog post thumbnail.', 'pls-core' ),
            ]
        );
		
		$this->add_control(
            'post_meta',
            [
                'label' 	=> esc_html__( 'Post Meta', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'pls-core' ),
					'0'	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 	=> '1',
				'description' 	=> esc_html__( 'Show/hide post meta.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'specific_post_meta',
            [
                'label' 	=> esc_html__( 'Post Meta', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT2,
                'options' 	=> [
					'post-author' 		=> esc_html__( 'Author', 'pls-core' ),
                    'post-date' 		=> esc_html__( 'Date', 'pls-core' ),
					'post-comments' 	=> esc_html__( 'Comments', 'pls-core' ),
					'post-views' 		=> esc_html__( 'Views', 'pls-core' ),
					'post-rtime' 		=> esc_html__( 'Read Time', 'pls-core' ),
					'post-share' 		=> esc_html__( 'Share', 'pls-core' ),
					'post-edit' 		=> esc_html__( 'Edit', 'pls-core' ),
				],
				'default' 	=> [ 'post-author', 'post-date' ],
				'multiple' 	=> true,
				'condition' => [
					'post_meta' => '1',
				],
            ]
        );		
		$this->add_control(
            'show_blog_content',
            [
                'label' 		=> esc_html__( 'Show Post Content', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'pls-core' ),
					'0'	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 		=> '1',
				'description' 	=> esc_html__( 'Show/hide blog post content.', 'pls-core' ),
            ]
        );
		$this->add_control(
            'blog_content',
            [
                'label' 		=> esc_html__( 'Post Content', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'excerpt-content'	=> esc_html__( 'Expert', 'pls-core' ),
					'full-content'		=> esc_html__( 'Full', 'pls-core' ),
				],
				'default' 	=> 'excerpt-content',
				'condition' => [
					'show_blog_content' => '1'
				],
            ]
        );
		$this->add_control(
            'blog_excerpt_length',
            [
                'label' 	=> esc_html__( 'Expert Length', 'pls-core' ),
                'type' 		=> Controls_Manager::NUMBER,                
				'default' 	=> '30',
				'condition' => [
					'show_blog_content' => '1',
					'blog_content' 		=> 'excerpt-content',
				],
            ]
        );
		$this->add_control(
            'read_more_btn',
            [
                'label' 		=> esc_html__( 'Read More Button', 'pls-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'pls-core' ),
					'0'	=> esc_html__( 'Hide', 'pls-core' ),
				],
				'default' 		=> '1',
				'description' 	=> esc_html__( 'Show/hide blog read more button.', 'pls-core' ),
				'condition' 	=> [
					'show_blog_content' => '1',
				],
            ]
        );
		$this->add_control(
            'read_more_btn_style',
            [
                'label' 	=> esc_html__( 'Read More Style', 'pls-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'read-more-link'		=> esc_html__( 'Link', 'pls-core' ),
					'read-more-button'		=> esc_html__( 'Button', 'pls-core' ),
					'read-more-button-fill'	=> esc_html__( 'Button Fill', 'pls-core' ),
				],
				'default' 	=> 'read-more-link',
				'condition' => [
					'read_more_btn' => '1'
				],
            ]
        );
		$this->end_controls_section();		
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Slider Settings', 'pls-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'			=> esc_html__( 'Slides to Show', 'pls-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'pls-core' ),
					'2'		=> esc_html__( '2', 'pls-core' ),
					'3'		=> esc_html__( '3', 'pls-core' ),
					'4'		=> esc_html__( '4', 'pls-core' ),
				],
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_pause_on_hover',
			[
				'label'     => esc_html__( 'Pause On Hover', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
				'condition' => [
					'slider_autoplay' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Loop', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_navigation',
			[
				'label'     => esc_html__( 'Nav', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'slider_dots',
			[
				'label'     => esc_html__( 'Dots', 'pls-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);		
		$this->end_controls_section();	
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [
			'slides_to_show_tablet' => 2,
			'slides_to_show_mobile' => 1,
		]);
		extract( $settings );
		
		$settings['id'] 	= pls_uniqid('section-');
		$class				= array( 'pls-element', 'pls-blog-slider' );
		$class[]			= ( 'horizontal' == $blog_view_mode ) ? 'pls-blog-'.$blog_view_mode : '';
		$settings['class'] 	= implode( ' ', array_filter( $class ) );
		
		
		$query_args = array(
			'post_type'          	=> 'post',
			'post_status'        	=> array('publish'),
			'posts_per_page'     	=> $limit,
			'ignore_sticky_posts'	=> true,
		);
		
		
		if( !empty($categories) ){
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);			
		}
		
		$query_args['orderby'] = 'date';
		
		// Posts Order
		if( ! empty( $orderby ) ){

			// Random Posts
			if( $orderby == 'rand' ){
				$query_args['orderby'] = 'rand';
			}

			// Most Viewd posts
			elseif( $orderby == 'views'){
				$prefix = PLS_PREFIX;
				$query_args['orderby']  = 'meta_value_num';
				$query_args['meta_key'] = apply_filters( 'pls_core_views_meta_field', $prefix.'views_count' );
			}

			// Popular Posts by comments
			elseif( $orderby == 'popular' ){
				$query_args['orderby'] = 'comment_count';
			}

			// Recent modified Posts
			elseif( $orderby == 'modified' ){
				$query_args['orderby'] = 'modified';
			}
		}
		
		$query_args['order'] = $order;
		
		// Exclude Posts
		if( ! empty( $exclude )){
			$exclude_blogs_array = explode( ',', $exclude );
			if( is_array( $exclude_blogs_array ) && !empty( $exclude_blogs_array ) ){
				$query_args['post__not_in'] = $exclude_blogs_array;		
			}
		}
		
		$the_query = new WP_Query( $query_args );
		$settings['query'] 			= $the_query; 
		
		pls_set_loop_prop( 'name', 'posts-slider-shortcode' );
		pls_set_loop_prop( 'unique_id',  pls_uniqid( 'pls-blog-slider-' ) );
		pls_set_loop_prop( 'post-single-line-title', $post_single_line_title);
		pls_set_loop_prop( 'blog-post-style', 'blog-grid');
		pls_set_loop_prop( 'post-category', $post_category);
		pls_set_loop_prop( 'post-meta', $post_meta);
		pls_set_loop_prop( 'specific-post-meta', array( 'post-author', 'post-date' ) );
		pls_set_loop_prop( 'blog-grid-layout', 'simple-grid' );
		pls_set_loop_prop( 'blog-grid-columns', $slides_to_show );
		if( !empty( $specific_post_meta ) ){
			pls_set_loop_prop( 'specific-post-meta', $specific_post_meta );
		}
		pls_set_loop_prop( 'show-blog-post-content', $show_blog_content );
		pls_set_loop_prop( 'blog-post-content', $blog_content );
		pls_set_loop_prop( 'blog-excerpt-length', $blog_excerpt_length );
		if( ! $show_blog_content ){
			$read_more_btn = 0;
		}
		pls_set_loop_prop( 'read-more-button', $read_more_btn );
		pls_set_loop_prop( 'read-more-button-style', $read_more_btn_style );
		pls_set_loop_prop( 'blog-post-thumbnail', $blog_thumbnail);
		pls_set_loop_prop( 'blog-custom-thumbnail-size', $image_size );
		pls_set_loop_prop( 'blog-post-title', $blog_title );
		pls_set_loop_prop( 'slides_to_show', $slides_to_show );
		pls_set_loop_prop( 'slides_to_show_tablet', $slides_to_show_tablet );
		pls_set_loop_prop( 'slides_to_show_mobile', $slides_to_show_mobile );
		pls_set_loop_prop( 'slider_navigation', $slider_navigation );
		pls_set_loop_prop( 'slider_dots', $slider_dots );
		pls_set_loop_prop( 'slider_options', pls_slider_attributes( $settings) );
		
		pls_core_get_templates( 'elements-widgets/blog-slider', $settings );
	}
}

$widgets_manager -> register( new PLS_Elementor_Blog_Slider );