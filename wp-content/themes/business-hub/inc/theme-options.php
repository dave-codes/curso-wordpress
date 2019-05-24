<?php
/**
 * cactus theme sample theme options file. This file is generated from Export feature in Option Tree.
 *
 * @package cactus
 */

/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'businesshub_custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function businesshub_custom_theme_options() {

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( ot_settings_id(), array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'option_types_help',
          'title'     => esc_html__( 'Option Types', 'cactus' ),
          'content'   => '<p>' . esc_html__( 'Help content goes here!', 'cactus' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . esc_html__( 'Sidebar content goes here!', 'cactus' ) . '</p>'
    ),
	'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => esc_html__('General','cactus')
      ),
	   array(
        'id'          => 'site_header',
        'title'       =>  esc_html__('Site Header','cactus')
      ),
	  array(
        'id'          => 'typography_color',
        'title'       =>  esc_html__('Typography & Color','cactus')
      ),
      array(
        'id'          => 'archives',
        'title'       =>  esc_html__('Archives','cactus')
      ),
      array(
        'id'          => 'single_post',
        'title'       =>  esc_html__('Single Post','cactus')
      ),
	  array(
        'id'          => 'single_page',
        'title'       =>  esc_html__('Single Page','cactus')
      ),
      array(
        'id'          => '404',
        'title'       =>  esc_html__('404 Page Not Found','cactus')
      ),
      array(
        'id'          => 'social_accounts',
        'title'       => esc_html__('Social Accounts','cactus')
      ),
       array(
        'id'          => 'social_sharing',
        'title'       => esc_html__('Social Sharing','cactus')
      ),
	  array(
        'id'          => 'digital_download',
        'title'       => esc_html__('Digital Download Manager','cactus')
      ),
	  array(
        'id'          => 'static_strings',
        'title'       => esc_html__('Static Strings','cactus')
      )
    ),
// General Block
    'settings'        => array(
	  array(
        'id'          => 'seo_meta_tags',
        'label'       => esc_html__('SEO - Echo Meta Tags','cactus'),
        'desc'        => esc_html__('By default, The Blog generates its own SEO meta tags (for example: Facebook Meta Tags). If you are using another SEO plugin like YOAST or a Facebook plugin, you can turn off this option','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'copyright',
        'label'       => esc_html__('Copyright Text','cactus'),
        'desc'        => esc_html__('Enter copyright text','cactus'),
        'std'         => 'WordPress Theme by cactusthemes.com',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'rtl',
        'label'       => esc_html__( 'RTL Mode', 'cactus' ),
        'desc'        => esc_html__('Support Right-to-Left language','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'custom_css',
        'label'       => esc_html__( 'Custom CSS', 'cactus' ),
        'desc'        => esc_html__('Enter custom CSS. Ex:<i> .class{ font-size: 13px; }</i>','cactus'),
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'custom_code',
        'label'       => esc_html__('Custom Code','cactus'),
        'desc'        => esc_html__('Enter custom code or JS code here. For example, enter Google Analytics code','cactus'),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_image',
        'label'       => esc_html__('Logo Image','cactus'),
        'desc'        => esc_html__('Upload your logo image','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'retina_logo',
        'label'       => esc_html__('Retina Logo (optional)','cactus'),
        'desc'        => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'login_logo_image',
        'label'       => esc_html__('Login Logo Image','cactus'),
        'desc'        => esc_html__('Upload your Admin Login logo image','cactus'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
          'id'          => 'lazy_load',
          'label'       => esc_html__('Lazy Load','cactus'),
          'desc'        => esc_html__('Enable Lazy Load','cactus'),
          'std'         => 'off',
          'type'        => 'on-off',
          'section'     => 'general',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'min_max_step'=> '',
          'class'       => '',
          'condition'   => '',
          'operator'    => 'and'
        ),
	  array(
          'id'          => 'scroll_effect',
          'label'       => esc_html__('Scroll Effect','cactus'),
          'desc'        => esc_html__('Enable Page Scroll effect','cactus'),
          'std'         => 'off',
          'type'        => 'on-off',
          'section'     => 'general',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'min_max_step'=> '',
          'class'       => '',
          'condition'   => '',
          'operator'    => 'and'
        ),
		array(
			'id'          => 'sticky_navigation',
			'label'       => esc_html__('Sticky Menu','cactus'),
			'desc'        => esc_html__('Enable Sticky Menu','cactus'),
			'std'         => 'off',
			'type'        => 'on-off',
			'section'     => 'general',
			'rows'        => '',
			'post_type'   => '',
			'taxonomy'    => '',
			'min_max_step'=> '',
			'class'       => '',
			'condition'   => '',
			'operator'    => 'and'
		  ),
		  array(
			'id'          => 'sticky_up_down',
			'label'       => esc_html__('Sticky Menu Behavior', 'cactus' ),
			'std'         => 'up',
			'type'        => 'select',
			'section'     => 'general',
			'rows'        => '',
			'post_type'   => '',
			'condition'	  => 'sticky_navigation:is(on)',
			'taxonomy'    => '',
			'class'       => '',
			'choices'     => array(
			  array(
				'value'       => 'up',
				'label'       => esc_html__('Only appears when page is Scrolled Up', 'cactus'),
				'src'         => ''
			  ),array(
				'value'       => 'down',
				'label'       => esc_html__('Always Sticky', 'cactus'),
				'src'         => ''
			  ),         
			)
		  ),	  
//End General Block

//Site Header Block
	  array(
        'id'          => 'header_style',
        'label'       => esc_html__( 'Style', 'cactus' ),
        'desc'        => esc_html__('Select navigation style','cactus'),
        'std'         => 'style_1',
        'type'        => 'radio-image',
        'section'     => 'site_header',
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
            'label'       => esc_html__( 'Style 1 ', 'cactus' ),
            'src'         =>   get_template_directory_uri(). '/images/themeoptions/header-layout-1.jpg'
          ),
          array(
            'value'       => 'style_2',
            'label'       => esc_html__( 'Style 2', 'cactus' ),
            'src'         =>  get_template_directory_uri() . '/images/themeoptions/header-layout-2.jpg'
          )
        )
      ),
	  array(
        'id'          => 'header_Schema',
        'label'       => esc_html__( 'Schema', 'cactus' ),
        'std'         => 'light',
        'type'        => 'select',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'megamenu',
        'label'       => esc_html__('Mega Menu','cactus'),
        'desc'        => esc_html__('Enable Mega Menu','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_opacity',
        'label'       => esc_html__('Navigation Transparency', 'cactus' ),
        'desc'        => esc_html__('Enter Navigation Background  Transparency (Ex: 0.8)', 'cactus' ),
        'std'         => '1',
        'type'        => 'numeric-slider',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,1,0.05',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'enable_search',
        'label'       => esc_html__('Enable Search','cactus'),
        'desc'        => esc_html__('Enable default search form in Header Navigation','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_background',
        'label'       => esc_html__('Heading Background', 'cactus' ),
        'desc'        => esc_html__('Default Header Background', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'custom_nav_responsive',
        'label'       => esc_html__('Custom Responsive Navigation','cactus'),
        'desc'        => esc_html__('Enable Custom Responsive Navigation','cactus'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and' //'condition'	  => 'sticky_navigation:is(on)',
      ),
	  array(
        'id'          => 'desktop_width',
        'label'       => esc_html__('Minimum width to push main navigation go to next line','cactus'),
        'desc'        => esc_html__('Unit: pixel. Example: 1280, 1400, 1600 ...','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'custom_nav_responsive:is(on)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'mobile_width',
        'label'       => esc_html__('Minimum width to open menu on mobile version','cactus'),
        'desc'        => esc_html__('Unit: pixel. Example: 767, 800, 991 ...','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'site_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'custom_nav_responsive:is(on)',
        'operator'    => 'and'
      ),
//End Site Header Block

//Font & Colors Block
	  array(
        'id'          => 'color_1',
        'label'       => esc_html__('Color 1', 'cactus' ),
        'desc'        => esc_html__('Main color 1', 'cactus' ),
        'std'         => '#ffd800',
        'type'        => 'colorpicker',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'color_2',
        'label'       => esc_html__('Color 2', 'cactus' ),
        'desc'        => esc_html__('Main color 2', 'cactus' ),
        'std'         => '#77b727',
        'type'        => 'colorpicker',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'google_font',
        'label'       => esc_html__('Google Font','cactus'),
        'desc'        => esc_html__('Use Google Fonts','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_family',
        'label'       => esc_html__('Main Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'main_font_size',
        'label'       => esc_html__('Main Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size (in Pixel)', 'cactus' ),
        'std'         => '14',
        'type'        => 'numeric-slider',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,20,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'navigation_font_family',
        'label'       => esc_html__('Navigation Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_font_size',
        'label'       => esc_html__('Navigation Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size (in Pixel)', 'cactus' ),
        'std'         => '12',
        'type'        => 'numeric-slider',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '9,18,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_font_family',
        'label'       => esc_html__('Heading Font Family', 'cactus' ),
        'desc'        => esc_html__('Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" <a href="http://www.google.com/fonts/">Google Font</a> with font-weight 400,500,600, enter Source Code Pro: 400,500,600', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_size',
        'label'       => esc_html__('Heading Font Size', 'cactus' ),
        'desc'        => esc_html__('Select base font size (in Pixel)', 'cactus' ),
        'std'         => '14',
        'type'        => 'numeric-slider',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,20,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'custom_font_1A',
        'label'       => esc_html__('Custom Font 1 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-1" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_1',
        'label'       => esc_html__('Custom Font 1 (woff2)', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'custom_font_2A',
        'label'       => esc_html__('Custom Font 2 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-2" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_2',
        'label'       => esc_html__('Custom Font 2 (woff2)', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'custom_font_3A',
        'label'       => esc_html__('Custom Font 3 (woff)', 'cactus' ),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-3" in "Main Font Family", "Navigation Font Family" or "Heading Font Family" setting above.', 'cactus' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_font_3',
        'label'       => esc_html__('Custom Font 3 (woff2)', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'letter_spacing',
        'label'       => esc_html__('Letter Spacing', 'cactus' ),
        'desc'        => esc_html__('The letter-spacing property increases or decreases the space between characters in a text (unit: em - defaults to: 0.2em)', 'cactus' ),
        'std'         => '0.2',
        'type'        => 'numeric-slider',
        'section'     => 'typography_color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,1,0.01',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Font & Colors Block

//Archive Block
      array(
        'id'          => 'archives_layout',
        'label'       => esc_html__( 'Layout', 'cactus' ),
        'desc'        => esc_html__('Choose default layout for archives pages (blog, categories, authors, tags)','cactus'),
        'std'         => 'style_1',
        'type'        => 'radio-image',
        'section'     => 'archives',
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
            'value'       => 'style_3_thumbnail',
            'label'       => esc_html__( 'Thumbnail Classic', 'cactus' ),
            'src'         =>  get_template_directory_uri() . '/images/themeoptions/archive-thumbnail-classic.jpg'
          )
        )
      ),
	  array(
        'id'          => 'archives_sidebar',
        'label'       => esc_html__( 'Sidebar', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'archives_text_heading_style',
        'label'       => esc_html__( 'Heading Text - Style', 'cactus' ),
		'desc'        => esc_html__('Choose default Heading style for Archive pages', 'cactus' ),
        'std'         => 'simple',
        'type'        => 'select',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'simple',
            'label'       => esc_html__( 'Simple', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'big_center',
            'label'       => esc_html__( 'Big Center', 'cactus' ),
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
        'id'          => 'archives_heading_icon',
        'label'       => esc_html__('Heading Text - Icon','cactus'),
        'desc'        => esc_html__('Enter default icon class for Heading Text','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'archives_heading_sub_text',
        'label'       => esc_html__('Heading - Sub-Text','cactus'),
        'desc'        => esc_html__('Enter Heading Sub-Text','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'archives_header_background',
        'label'       => esc_html__('Header Background', 'cactus' ),
        'desc'        => esc_html__('Default Header Background for Archives', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'navigation',
        'label'       => esc_html__('Page Navigation', 'cactus' ),
        'desc'        => esc_html__('Choose type of navigation for blog and any listing page. For WP PageNavi, you will need to install WP PageNavi plugin', 'cactus' ),
        'std'         => 'def',
        'type'        => 'select',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'def',
            'label'       => esc_html__('Default', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'ajax',
            'label'       => esc_html__('Ajax', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'wp_pagenavi',
            'label'       => esc_html__('WP PageNavi', 'cactus' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'archives_footer_cta_content',
        'label'       => esc_html__('Footer CTA - Content', 'cactus' ),
        'desc'        => esc_html__('Footer CTA content for all pages', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'archives_footer_cta_height',
        'label'       => esc_html__('Footer CTA - Height', 'cactus' ),
		'desc'        => esc_html__('Height (in pixels)', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'archives_footer_cta_fullwidth',
        'label'       => esc_html__('Footer CTA - Fullwidth','cactus'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	 	
	  array(
        'id'          => 'archives_footer_cta_background',
        'label'       => esc_html__('Footer CTA - Background', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'archives',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Archive Block

//Single Post Block
      array(
        'id'          => 'post_sidebar',
        'label'       => esc_html__( 'Sidebar', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'post_text_heading_style',
        'label'       => esc_html__( 'Text heading - Style', 'cactus' ),
		'desc'        => esc_html__('Choose default single posts heading style', 'cactus' ),
        'std'         => 'simple',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'post_heading_icon',
        'label'       => esc_html__('Text Heading - Icon','cactus'),
        'desc'        => esc_html__('Enter default icon class for Text Heading','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_heading_sub_text',
        'label'       => esc_html__('Heading - Sub-Text','cactus'),
        'desc'        => esc_html__('Enter Heading Sub-Text','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_header_background',
        'label'       => esc_html__('Header Background', 'cactus' ),
        'desc'        => esc_html__('Default Header Background for Single Post', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_feature_img',
        'label'       => esc_html__( 'Feature Image', 'cactus' ),
        'desc'        => esc_html__('Enable Featured image in single post', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_published_date',
        'label'       => esc_html__( 'Published Date', 'cactus' ),
        'desc'        => esc_html__('Enable Published Date info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_author',
        'label'       => esc_html__( 'Author', 'cactus' ),
        'desc'        => esc_html__('Enable Author info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_categories',
        'label'       => esc_html__( 'Categories', 'cactus' ),
        'desc'        => esc_html__('Enable Categories info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_comment_count',
        'label'       => esc_html__( 'Comment Count', 'cactus' ),
        'desc'        => esc_html__('Enable Comment Count info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_tag',
        'label'       => esc_html__( 'Tags', 'cactus' ),
        'desc'        => esc_html__('Enable Tags info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_about_author',
        'label'       => esc_html__( 'About Author', 'cactus' ),
        'desc'        => esc_html__('Enable About Author info', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'post_navigation',
        'label'       => esc_html__( 'Post Navigation', 'cactus' ),
        'desc'        => esc_html__('Enable Post Navigation', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'show_related_post',
        'label'       => esc_html__( 'Show Related Posts', 'cactus' ),
        'desc'        => esc_html__('Show/hide Related Posts section in single post page', 'cactus' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'get_related_post_by',
        'label'       => esc_html__('Related Posts - Select', 'cactus' ),
        'desc'        => esc_html__('Get Related Posts by Categories or Tags', 'cactus' ),
        'std'         => 'cat',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'cat',
            'label'       => 'Categories',
            'src'         => ''
          ),
          array(
            'value'       => 'tag',
            'label'       => 'Tags',
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),

      array(
        'id'          => 'related_posts_count',
        'label'       => esc_html__('Related Posts - Count','cactus'),
        'desc'        => '',
        'std'         => '3',
        'type'        => 'text',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'related_posts_order_by',
        'label'       => esc_html__('Related Posts - Order By', 'cactus' ),
        'desc'        => esc_html__('Order related posts randomly or by date', 'cactus' ),
        'std'         => 'date',
        'type'        => 'select',
        'section'     => 'single_post',
        'choices'     => array(
          array(
            'value'       => 'date',
            'label'       => esc_html__('Date','cactus'),
            'src'         => ''
          ),
          array(
            'value'       => 'rand',
            'label'       => esc_html__('Random','cactus'),
            'src'         => ''
          )
        ),
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_yarpp_plugin_single_post',
        'label'       => esc_html__( 'Related Posts - Integrate YARPP Plugin?', 'cactus' ),
        'desc'        => esc_html__('Enabling this will allow you to use YARPP (Yet Another Related Posts Plugin) in single post', 'cactus' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Single Post Block

//Single Page Block
      array(
        'id'          => 'page_sidebar',
        'label'       => esc_html__( 'Sidebar', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'page_text_heading_style',
        'label'       => esc_html__( 'Text heading - Style', 'cactus' ),
		'desc'        => esc_html__('Choose default single pages heading style', 'cactus' ),
        'std'         => 'simple',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'page_heading_icon',
        'label'       => esc_html__('Text Heading - Icon','cactus'),
        'desc'        => esc_html__('Enter default icon class for Text Heading','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'page_heading_sub_text',
        'label'       => esc_html__('Heading - Sub-Text','cactus'),
        'desc'        => esc_html__('Enter Heading Sub-Text','cactus'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'page_header_background',
        'label'       => esc_html__('Header Background', 'cactus' ),
        'desc'        => esc_html__('Default Header Background for Single Pages', 'cactus' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Single Page Block

//404 - Page Not Found block
      array(
        'id'          => '404_page',
		'label'       => esc_html__( 'Page Template', 'cactus' ),
        'desc'        => '',
        'std'         => esc_html__('Select a template for 404 page', 'cactus' ),
        'type'        => 'page_select',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => '404_title',
		'label'       => esc_html__( 'Page Title', 'cactus' ),
        'desc'        => '',
        'std'         => '404 - Page Not Found',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => '404_content',
		'label'       => esc_html__( 'Page Content', 'cactus' ),
        'desc'        => '',
        'std'         => '404 - Page Not Found',
        'type'        => 'textarea',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End 404 - Page Not Found block	  

//Social Account block	
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'linkedin',
        'label'       => 'LinkedIn',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tumblr',
        'label'       => 'Tumblr',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google-plus',
        'label'       => 'Google Plus',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => esc_html__('Enter full link to your profile page', 'cactus' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
		'id'          => 'custom_social_account',
		'label'       => esc_html__('Custom Social Account', 'cactus' ),
		'desc'        => esc_html__('Add more social accounts using Font Awesome Icons','cactus'),
		'type'        => 'list-item',
		'class'       => '',
		'section'     => 'social_accounts',
		'choices'     => array(),
		'settings'    => array(
		   array(
			  'label'       => esc_html__('Icon Font Awesome','cactus'),
			  'id'          => 'icon_custom_social_account',
			  'type'        => 'text',
			  'desc'        => esc_html__('Enter Font Awesome class (Ex: fa-facebook)','cactus'),
			  'std'         => '',
			  'rows'        => '',
			  'post_type'   => '',
			  'taxonomy'    => ''
		   ),
		   array(
			  'label'       =>  esc_html__('URL','cactus'),
			  'id'          => 'url_custom_social_account',
			  'type'        => 'text',
			  'desc'        => esc_html__('Enter full link to your account (including http://)','cactus'),
			  'std'         => '',
			  'rows'        => '',
			  'post_type'   => '',
			  'taxonomy'    => ''
		   ),
		)
	  ),
	  array(
        'id'          => 'open_social_link_new_tab',
        'label'       => esc_html__( 'Open Social Link in new tab', 'cactus' ),
        'desc'        => esc_html__('Open link in new tab?', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'show_top_social',
        'label'       => esc_html__( 'Show Top Social Accounts', 'cactus' ),
        'desc'        => esc_html__( 'Show Social Accounts on Top of the page', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'show_bottom_social',
        'label'       => esc_html__( 'Show Footer Social Accounts', 'cactus' ),
        'desc'        => esc_html__( 'Show Social Accounts at Bottom of the page', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_social_bg_color',
        'label'       => esc_html__('Footer Social Accounts - Background', 'cactus' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'show_bottom_social:is(on)',
        'operator'    => 'and'
      ),
//End Social Account block		  
	  
//Social Sharing block		  
      array(
        'id'          => 'sharing_facebook',
        'label'       => esc_html__( 'Facebook', 'cactus' ),
        'desc'        => esc_html__( 'Enable Facebook Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sharing_twitter',
        'label'       => esc_html__( 'Twitter', 'cactus' ),
        'desc'        => esc_html__( 'Enable Twitter Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sharing_linkedIn',
        'label'       => esc_html__( 'LinkedIn', 'cactus' ),
        'desc'        => esc_html__( 'Enable LinkedIn Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'sharing_tumblr',
        'label'       => esc_html__( 'Tumblr', 'cactus' ),
        'desc'        => esc_html__( 'Enable Tumblr Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'sharing_google',
        'label'       => esc_html__( 'Google+', 'cactus' ),
        'desc'        => esc_html__( 'Enable Google+ Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'sharing_pinterest',
        'label'       => esc_html__( 'Pinterest', 'cactus' ),
        'desc'        => esc_html__( 'Enable Pinterest Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
        array(
        'id'          => 'sharing_email',
        'label'       => esc_html__( 'Email', 'cactus' ),
        'desc'        => esc_html__( 'Enable Email Share button', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_sharing',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Social Sharing block	  
	  
//Digital Download Manager block
      array(
        'id'          => 'digital_checkout_bt',
		'label'       => esc_html__( 'Enable Cart icon', 'cactus' ),
        'desc'        => esc_html__( 'Enable Cart icon on Header', 'cactus' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  array(
        'id'          => 'digital_archives_sidebar',
        'label'       => esc_html__( 'Listing Sidebar', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'id'          => 'digital_archives_full',
        'label'       => esc_html__( 'Listing Fullwidth', 'cactus' ),
        'std'         => 'off',
        'type'        => 'select',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'digital_archives_sidebar:is(hidden)',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'off',
            'label'       => esc_html__( 'Off', 'cactus' ),
            'src'         => ''
          ),
          array(
            'value'       => 'on',
            'label'       => esc_html__( 'On', 'cactus' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'digital_single_sidebar',
        'label'       => esc_html__( 'Single Download Page - Sidebar', 'cactus' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
        'label'       => esc_html__( 'Single Download Page - Style', 'cactus' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
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
	  array(
        'id'          => 'edd_defaultmeta',
        'label'       => esc_html__('Default Metadata', 'cactus' ),
        'desc'        => esc_html__('Define default metadata for all downloads, ex: licenses, software version...', 'cactus' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'edd_number_related',
        'label'       => esc_html__('Number Of Related Downloads', 'cactus' ),
        'desc'        => esc_html__('enter 0 to hide Related Downloads', 'cactus' ),
        'std'         => '5',
        'type'        => 'text',
        'section'     => 'digital_download',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
//End Digital Download Manager block	  
	  array(
        'id'          => 'more_product_text',
        'label'       => esc_html__('More Products You May Like', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	
	  array(
        'id'          => 'pick_product_text',
        'label'       => esc_html__('We pick out some of our products', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'more_project_text',
        'label'       => esc_html__('More Projects', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'youmight_want_text',
        'label'       => esc_html__('You might want to check out', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'back_portfolio_text',
        'label'       => esc_html__('Back to Portfolios', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'load_more_text',
        'label'       => esc_html__('Load More', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'checkout_text',
        'label'       => esc_html__('Checkout', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'free_text',
        'label'       => esc_html__('Free', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'downloads_text',
        'label'       => esc_html__('Downloads', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'download_now_text',
        'label'       => esc_html__('Download Now', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'buy_now_text',
        'label'       => esc_html__('Buy Now', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'search_text',
        'label'       => esc_html__('Search', 'cactus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'static_strings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    )
  );
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if(is_plugin_active('bbpress/bbpress.php')){
	  $custom_settings['sections'][]=array(
        'id'          => 'bbpress',
        'title'       => esc_html__('BBPress','cactus')
      );
	  $custom_settings['settings'][]= array(
		'id'          => 'bbpress_sidebar',
		'label'       => esc_html__( 'Sidebar', 'cactus' ),
		'std'         => 'right',
		'type'        => 'select',
		'section'     => 'bbpress',
		'rows'        => '',
		'post_type'   => '',
		'taxonomy'    => '',
		'min_max_step'=> '',
		'class'       => '',
		'condition'   => '',
		'operator'    => 'and',
		'choices'     => array(
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
	  );
  }	
  if(is_plugin_active('woocommerce/woocommerce.php')){
	  $custom_settings['sections'][]=array(
        'id'          => 'woocommerce',
        'title'       => esc_html__('Woocommerce','cactus')
      );
	  $custom_settings['settings'][]= array(
		'id'          => 'woolist_sidebar',
		'label'       => esc_html__( 'Archives Sidebar', 'cactus' ),
		'std'         => 'right',
		'type'        => 'select',
		'section'     => 'woocommerce',
		'rows'        => '',
		'post_type'   => '',
		'taxonomy'    => '',
		'min_max_step'=> '',
		'class'       => '',
		'condition'   => '',
		'operator'    => 'and',
		'choices'     => array(
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
	  );
	  $custom_settings['settings'][]= array(
		'id'          => 'woosingle_sidebar',
		'label'       => esc_html__( 'Single Sidebar', 'cactus' ),
		'std'         => 'right',
		'type'        => 'select',
		'section'     => 'woocommerce',
		'rows'        => '',
		'post_type'   => '',
		'taxonomy'    => '',
		'min_max_step'=> '',
		'class'       => '',
		'condition'   => '',
		'operator'    => 'and',
		'choices'     => array(
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
	  );
  }	
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

}