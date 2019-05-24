<?php

/**
 * Initialize the meta boxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 * @package cactus
 */
add_action( 'admin_init', 'businesshub_meta_boxes' );

if ( ! function_exists( 'businesshub_meta_boxes' ) ){
	function businesshub_meta_boxes() {
		$meta_boxes = array();
		//Page Metadata
		  	$page_meta_boxes = array(
				'id'        => 'page_meta_box_layout_settings',
				'title'     => esc_html__('Layout settings','cactus'),
				'desc'      => '',
				'pages'     => array( 'page' ),
				'context'   => 'normal',
				'priority'  => 'high',
				'fields'    => array(
					array(
						  'id'          => 'page_meta_sidebar',
						  'label'       => esc_html__('Sidebar','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
							  'value'       => 'default',
							  'label'       => esc_html__( 'Default', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'right',
							  'label'       => esc_html__( 'Right', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'left',
							  'label'       => esc_html__( 'Left', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'hidden',
							  'label'       => esc_html__( 'Hidden', 'cactus' ),
							  'src'         => ''
							)
						  )
					),
					array(
						  'id'          => 'page_meta_text_heading_style',
						  'label'       => esc_html__('Heading Text - Style','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
								'value'       => 'default',
								'label'       => esc_html__( 'Default', 'cactus' ),
								'src'         => ''
							  ),
							array(
								'value'       => 'simple',
								'label'       => esc_html__( 'Simple', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'big_center',
								'label'       => esc_html__( 'Big Center Heading', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'icon_left',
								'label'       => esc_html__( 'Icon Left', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'center_sub_line',
								'label'       => esc_html__( 'Center with Sub-Line', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'hidden',
								'label'       => esc_html__( 'Hidden', 'cactus' ),
								'src'         => ''
							  )
						  )
					),
					array(
						'id'          => 'page_meta_heading_icon',
						'label'       => esc_html__('Heading Text - Icon','cactus'),
						'desc'        => esc_html__('Leave blank to use settings in Theme Options','cactus'),
						'std'         => '',
						'type'        => 'text',
						'operator'    => 'and'
					),
					array(
						'id'          => 'page_meta_heading_sub_text',
						'label'       => esc_html__('Heading - Sub-Text','cactus'),
						'desc'        => esc_html__('Leave blank to use settings in Theme Options','cactus'),
						'std'         => '',
						'type'        => 'text',
						'operator'    => 'and'
					),
					array(
						  'id'          => 'page_meta_header_background',
						  'label'       => esc_html__('Header Background','cactus'),
						  'desc'        => esc_html__('Choose background for this Page. Overwrite setting in Theme Options','cactus'),
						  'std'         => '',
						  'type'        => 'background'
					),
				 )
			);

		//Post Metadata
			$post_meta_boxes = array(
				'id'        => 'post_meta_box_layout_settings',
				'title'     => esc_html__('Layout settings','cactus'),
				'desc'      => '',
				'pages'     => array( 'post' ),
				'context'   => 'normal',
				'priority'  => 'high',
				'fields'    => array(
					array(
						  'id'          => 'post_meta_sidebar',
						  'label'       => esc_html__('Sidebar','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
							  'value'       => 'default',
							  'label'       => esc_html__( 'Default', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'right',
							  'label'       => esc_html__( 'Right', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'left',
							  'label'       => esc_html__( 'Left', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'hidden',
							  'label'       => esc_html__( 'Hidden', 'cactus' ),
							  'src'         => ''
							)
						  )
					),
					array(
						  'id'          => 'post_meta_text_heading_style',
						  'label'       => esc_html__('Heading Text - Style','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
							  'value'       => 'default',
							  'label'       => esc_html__( 'Default', 'cactus' ),
							  'src'         => ''
							),
							array(
								'value'       => 'simple',
								'label'       => esc_html__( 'Simple', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'big_center',
								'label'       => esc_html__( 'Big Center Heading', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'icon_left',
								'label'       => esc_html__( 'Icon Left', 'cactus' ),
								'src'         => ''
							  ),
							  array(
								'value'       => 'center_sub_line',
								'label'       => esc_html__( 'Center with Sub-Line', 'cactus' ),
								'src'         => ''
							  )
						  )
					),
					array(
						'id'          => 'post_meta_heading_icon',
						'label'       => esc_html__('Heading Text - Icon','cactus'),
						'desc'        => esc_html__('Leave blank to use settings in Theme Options','cactus'),
						'std'         => '',
						'type'        => 'text',
						'operator'    => 'and'
					),
					array(
						'id'          => 'post_meta_heading_sub_text',
						'label'       => esc_html__('Heading Sub-Text','cactus'),
						'desc'        => esc_html__('Leave blank to use settings in Theme Options','cactus'),
						'std'         => '',
						'type'        => 'text',
						'operator'    => 'and'
					),
					array(
						  'id'          => 'post_meta_header_background',
						  'label'       => esc_html__('Header Background','cactus'),
						  'desc'        => esc_html__('Choose background for this post. Overwrite setting in Theme Options','cactus'),
						  'std'         => '',
						  'type'        => 'background'
					),
				 )
			);
			$front_page_metadata = array(
			'id'        => 'front_page_metadata',
			'title'     =>  esc_html__('Navigation Settings','cactus'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'meta_nav_style',
					  'label'       =>  esc_html__('Navigation Style','cactus'),
					  'desc'        =>  esc_html__('Select navigation style','cactus'),
					  'std'         => 'default',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'default',
					      'label'       =>  esc_html__( 'Default','cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'style_1',
					      'label'       =>  esc_html__( 'Layout 1','cactus' ),
					      'src'         => ''
					    ),
						array(
					      'value'       => 'style_2',
					      'label'       =>  esc_html__( 'Layout 2','cactus' ),
					      'src'         => ''
					    )
					  )
				),
				array(
					'id'          => 'meta_header_schema',
					'label'       => esc_html__( 'Schema', 'cactus' ),
					'std'         => 'light',
					'type'        => 'select',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'condition'   => '',
					'operator'    => 'and',
					'choices'     => array(
					  array(
					      'value'       => 'default',
					      'label'       =>  esc_html__( 'Default','cactus' ),
					      'src'         => ''
					    ),
					  array(
						'value'       => 'light',
						'label'       => esc_html__( 'Light', 'cactus' ),
						'src'         => ''
					  ),
					  array(
						'value'       => 'dark',
						'label'       => esc_html__( 'Dark', 'cactus' ),
						'src'         => ''
					  )
					)
				),
				array(
					'id'          => 'meta_nav_opacity',
					'label'       => esc_html__('Navigation Transparency', 'cactus' ),
					'desc'        => esc_html__('Enter Navigation Background  Transparency (Ex: 0.8)', 'cactus' ),
					'std'         => '1',
					'type'        => 'numeric-slider',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '0,1,0.05',
					'class'       => '',
					'condition'   => '',
					'operator'    => 'and'
				),
				array(
					'id'          => 'meta_enable_search',
					'label'       => esc_html__('Enable Search','cactus'),
					'desc'        => esc_html__('Enable default search form in Header Navigation','cactus'),
					'std'         => 'on',
					'type'        => 'on-off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'condition'   => '',
					'operator'    => 'and'
				)
			 )
			);
			$front_page_content_settings = array(
			'id'        => 'front_page_content_settings',
			'title'     => esc_html__('Front Page Content Settings','cactus'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'meta_page_content',
					  'label'       => esc_html__('Content','cactus'),
					  'desc'        => '',
					  'std'         => 'page_ct',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'this_page',
					      'label'       => esc_html__( 'This Page Content', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'blog',
					      'label'       => esc_html__( 'Blog (Latest Post)', 'cactus' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
					  'id'          => 'frontpage_sidebar',
					  'label'       => esc_html__('Sidebar Layout','cactus'),
					  'std'         => 'right',
					  'type'        => 'select',
					  'choices'     => array(
						array(
						  'value'       => 'left',
						  'label'       => esc_html__( 'Left', 'cactus' ),
						  'src'         => ''
						),
						array(
						  'value'       => 'right',
						  'label'       => esc_html__( 'Right', 'cactus' ),
						  'src'         => ''
						),
						array(
						  'value'       => 'hidden',
						  'label'       => esc_html__( 'Hidden', 'cactus' ),
						  'src'         => ''
						)
					  )
				),
				array(
					'id'          => 'meta_page_layout',
					'label'       => esc_html__( 'Layout', 'cactus' ),
					'desc'        => esc_html__('Choose default layout for this page','cactus'),
					'std'         => 'style_1',
					'type'        => 'radio-image',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'condition'   => '',
					'operator'    => 'and',
					'choices'     => array(
					  array(
						'value'       => 'style_1',
						'label'       => esc_html__( 'One Column', 'cactus' ),
						'src'         =>  get_template_directory_uri() . '/images/themeoptions/archive-one-column.jpg'
					  ),
					  array(
						'value'       => 'style_2',
						'label'       => esc_html__( 'Two Columns', 'cactus' ),
						'src'         =>  get_template_directory_uri() . '/images/themeoptions/archive-two-columns.jpg'
					  ),
					  array(
						'value'       => 'style_3',
						'label'       => esc_html__( 'Thumbnail Classic', 'cactus' ),
						'src'         =>  get_template_directory_uri() . '/images/themeoptions/archive-thumbnail-classic.jpg'
					  )
					)
				),
				array(
				  'id'          => 'meta_page_content_cat',
				  'label'       => esc_html__('Post Categories', 'cactus' ),
				  'desc'        => esc_html__('Enter category Ids or slugs to get posts from, separated by a comma', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
				  'id'          => 'meta_page_content_tag',
				  'label'       => esc_html__('Post Tags', 'cactus' ),
				  'desc'        => esc_html__('Enter tags to get posts from, separated by a comma', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
				  'id'          => 'meta_page_content_id',
				  'label'       => esc_html__('Post Ids', 'cactus' ),
				  'desc'        => esc_html__('Enter post IDs, separated by a comma.If this param is used, other params are ignored', 'cactus' ),
				  'std'         => '',
				  'type'        => 'text',
				),
				array(
					  'id'          => 'meta_page_content_orderby',
					  'label'       => esc_html__('Order By','cactus'),
					  'desc'        => '',
					  'std'         => 'date',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'date',
					      'label'       => esc_html__( 'Post date', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'rand',
					      'label'       => esc_html__( 'Random', 'cactus' ),
					      'src'         => ''
					    )
					  )
				),
				array(
				  'id'          => 'meta_page_content_count',
				  'label'       => esc_html__('Post Count', 'cactus' ),
				  'desc'        => esc_html__('Number of posts per page. Default is 10', 'cactus' ),
				  'std'         => '10',
				  'type'        => 'text',
				),
			 )
			);
	  //Post Metadata
			$EDD_settings = array(
				'id'        => 'easy_dd_layout_settings',
				'title'     => esc_html__('Layout settings','cactus'),
				'desc'      => '',
				'pages'     => array( 'download' ),
				'context'   => 'normal',
				'priority'  => 'high',
				'fields'    => array(
					array(
						  'id'          => 'sidebar_layout',
						  'label'       => esc_html__('Sidebar','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
							  'value'       => 'default',
							  'label'       => esc_html__( 'Default', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'right',
							  'label'       => esc_html__( 'Right', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'left',
							  'label'       => esc_html__( 'Left', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => 'hidden',
							  'label'       => esc_html__( 'Hidden', 'cactus' ),
							  'src'         => ''
							)
						  )
					),
					array(
						  'id'          => 'digital_single_style',
						  'label'       => esc_html__('Style','cactus'),
						  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
						  'std'         => 'default',
						  'type'        => 'select',
						  'choices'     => array(
							array(
							  'value'       => 'default',
							  'label'       => esc_html__( 'Default', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => '1',
							  'label'       => esc_html__( 'Style 1', 'cactus' ),
							  'src'         => ''
							),
							array(
							  'value'       => '2',
							  'label'       => esc_html__( 'Style 2', 'cactus' ),
							  'src'         => ''
							),
						  )
					),
				 )
			);
		  $tmr_criteria = ot_get_option('edd_defaultmeta')?explode(",", ot_get_option('edd_defaultmeta')):'';
		  if($tmr_criteria){
			  foreach($tmr_criteria as $criteria){
				  $EDD_settings['fields'][] = array(
					  'id'          => 'edd_'.sanitize_title($criteria),
					  'label'       => $criteria,
					  'desc'        => '',
					  'std'         => '',
					  'type'        => 'text',
					  'class'       => '',
					  'choices'     => array()
				  );
			  }
		  }
		  $EDD_settings['fields'][] = array(
				'label'       => esc_html__('Custom Fields', 'cactus'),
				'id'          => 'edd_custom_field',
				'type'        => 'list-item',
				'class'       => '',
				'desc'        => esc_html__('Add custom field', 'cactus'),
				'choices'     => array(),
				'settings'    => array(
					 array(
						'label'       => esc_html__('Value','cactus'),
						'id'          => 'edd_custom_value',
						'type'        => 'text',
						'desc'        => '',
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => ''
					 ),
				)
		  );
/************************  EDD ADDON METADATA  ************************/
			$edd_addon_metadata = array(
			'id'        => 'edd_addon_header_settings',
			'title'     => esc_html__('EDD Header Settings ','cactus'),
			'desc'      => '',
			'pages'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'fields'    => array(
				array(
					  'id'          => 'edd_addon_productnews_content',
					  'label'       => esc_html__('Product News','cactus'),
					  'desc'        => esc_html__('Choose to load latest product news or custom content','cactus'),
					  'std'         => 'latest_productnews',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'latest_productnews',
					      'label'       => esc_html__( 'Latest Product News', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'custom_content',
					      'label'       => esc_html__( 'Custom Content', 'cactus' ),
					      'src'         => ''
					    ),
					  )
				),
				array(
					  'id'          => 'edd_addon_custom_news_content',
					  'label'       => esc_html__('Custom News Content','cactus'),
					  'desc'        => esc_html__('Custom content for product news','cactus'),
					  'std'         => '',
				  	  'type'        => 'textarea',
				),
				array(
					'id'          => 'edd_addon_banner_area',
					'label'       => esc_html__( 'Layout', 'cactus' ),
					'desc'        => esc_html__('Choose to load built-in layout for banner area or custom content','cactus'),
					'std'         => 'date',
					  'type'        => 'select',
					  'choices'     => array(
					  	array(
					      'value'       => 'built_in',
					      'label'       => esc_html__( 'Built-in', 'cactus' ),
					      'src'         => ''
					    ),
					    array(
					      'value'       => 'custom_content',
					      'label'       => esc_html__( 'Custom Content', 'cactus' ),
					      'src'         => ''
					    )
					)
				),
				array(
					  'id'          => 'edd_addon_banner_area_height',
					  'label'       => esc_html__('Banner Area - Height','cactus'),
					  'desc'        => esc_html__('Enter height (in pixels) for Banner Area','cactus'),
					  'std'         => '',
				  	  'type'        => 'text',
				),
				array(
					  'id'          => 'edd_addon_big_banner_bg',
					  'desc'        => esc_html__('Image for the big banner','cactus'),
					  'label'       => esc_html__('Banner Area - Big Banner Background','cactus'),
					  'std'         => '',
					  'type'        => 'background'
				),
				array(
					  'id'          => 'edd_addon_big_banner_content',
					  'label'       => esc_html__('Banner Area - Big Banner Content','cactus'),
					  'desc'        => esc_html__('Enter content for the big banner','cactus'),
					  'std'         => '',
				  	  'type'        => 'textarea',
				),
				array(
					  'id'          => 'edd_addon_small_banner1_bg',
					  'label'       => esc_html__('Banner Area - Small Banner 1 Background','cactus'),
					  'desc'        => esc_html__('Choose background image for the small banner 1','cactus'),
					  'std'         => '',
					  'type'        => 'background'
				),
				array(
					  'id'          => 'edd_addon_small_banner1_text',
					  'label'       => esc_html__('Banner Area - Small Banner 1 Text','cactus'),
					  'desc'        => esc_html__('Enter text for the small banner 1','cactus'),
					  'std'         => '',
				  	  'type'        => 'textarea',
				),
				array(
					  'id'          => 'edd_addon_small_banner2_bg',
					  'label'       => esc_html__('Banner Area - Small Banner 2 Background','cactus'),
					  'desc'        => esc_html__('Choose background image for the small banner 1','cactus'),
					  'std'         => '',
					  'type'        => 'background'
				),
				array(
					  'id'          => 'edd_addon_small_banner2_text',
					  'label'       => esc_html__('Banner Area - Small Banner 2 Text','cactus'),
					  'desc'        => esc_html__('Enter text for the small banner 2','cactus'),
					  'std'         => '',
				  	  'type'        => 'textarea',
				),
				array(
					  'id'          => 'edd_addon_banner_area_bg',
					  'label'       => esc_html__('Banner Area - Background','cactus'),
					  'desc'        => esc_html__('Choose background for the Banner Area','cactus'),
					  'std'         => '',
					  'type'        => 'background'
				),
				array(
					  'id'          => 'edd_addon_banner_area_custom_content',
					  'label'       => esc_html__('Banner Area - Custom Content','cactus'),
					  'desc'        => esc_html__('Enter custom content for the Banner Area','cactus'),
					  'std'         => '',
				  	  'type'        => 'textarea',
				),
			 )
			);
			
	  $product_meta_boxes = array(
		  'id'        => 'post_meta_box_layout_settings',
		  'title'     => esc_html__('Layout settings','cactus'),
		  'desc'      => '',
		  'pages'     => array( 'product' ),
		  'context'   => 'normal',
		  'priority'  => 'high',
		  'fields'    => array(
			  array(
					'id'          => 'post_meta_sidebar',
					'label'       => esc_html__('Sidebar','cactus'),
					'desc'        => esc_html__('Select "Default" to use settings in Theme Options','cactus'),
					'std'         => 'default',
					'type'        => 'select',
					'choices'     => array(
					  array(
						'value'       => 'default',
						'label'       => esc_html__( 'Default', 'cactus' ),
						'src'         => ''
					  ),
					  array(
						'value'       => 'right',
						'label'       => esc_html__( 'Right', 'cactus' ),
						'src'         => ''
					  ),
					  array(
						'value'       => 'left',
						'label'       => esc_html__( 'Left', 'cactus' ),
						'src'         => ''
					  ),
					  array(
						'value'       => 'hidden',
						'label'       => esc_html__( 'Hidden', 'cactus' ),
						'src'         => ''
					  )
					)
			  ),
			  
		   )
	  );
	  if(class_exists('Easy_Digital_Downloads')){
	  	ot_register_meta_box( $EDD_settings );
	  }
	  if(class_exists('businesshub_edd_addon')){
	  	ot_register_meta_box( $edd_addon_metadata );
	  }
	  ot_register_meta_box( $front_page_content_settings );
	  ot_register_meta_box( $front_page_metadata );
	  ot_register_meta_box( $page_meta_boxes );
	  ot_register_meta_box( $post_meta_boxes );
	  ot_register_meta_box( $product_meta_boxes );
	}
}