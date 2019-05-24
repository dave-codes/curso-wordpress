<?php
/**
 * cactus functions and definitions
 *
 * @package cactus
 */
if(!defined('PARENT_THEME')){
	define('PARENT_THEME','business-hub');
}

function businesshub_theme_required_plugins(){
	global $_theme_required_plugins;
	
	/* Define list of recommended and required plugins */
	$_theme_required_plugins = array(
		array(
            'name'      => 'Option Tree',
            'slug'      => 'option-tree',
            'required'  => true
        )
    );
}
businesshub_theme_required_plugins();
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Core features
 */
require get_template_directory() . '/inc/core/cactus-core.php';

/**
 * Data functions
 */
require get_template_directory() . '/inc/core/data-functions.php';

/**
 * Uncomment below line in Release mode. theme-options.php is generated using Export feature in Option Tree
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Add metadata (meta-boxes) for all post types
 */
require get_template_directory() . '/inc/metadata.php';

/**
 * Add metadata for categories
 */
require get_template_directory() . '/inc/category-metadata.php';

/**
 * Require Megamenu
 */
require get_template_directory() . '/inc/megamenu/megamenu.php';

/**
 * Require Widgets
 */
require get_template_directory() . '/inc/widgets/widgets_theme.php';

/**
 * Welcome page
 */
require get_template_directory() . '/inc/welcome.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */

 /* Functions, Hooks, Filters and Registers in Admin */
require_once get_template_directory() . '/inc/functions-admin.php';

if ( ! isset( $content_width ) ) {
	$content_width = 960; /* pixels */
}
if(!function_exists('businesshub_get_default_image')){
	function businesshub_get_default_image($strSize=false){
		switch($strSize) {
			case 'thumb_3x2':
				return get_template_directory_uri().'/images/no-thumb-3.2.jpg';
				break;
			case 'thumb_1x1':
				return get_template_directory_uri().'/images/no-thumb-1.1.jpg';
				break;
			default:
				return get_template_directory_uri().'/images/no-thumb-3.2.jpg';
				break;
		}
	}
}

if ( ! function_exists( 'businesshub_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function businesshub_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cactus, use a find and replace
	 * to change 'cactus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cactus', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Menu', 'cactus' ),
		'secondary-menus' => esc_html__( 'Top Nav Menu', 'cactus' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'cactus' ),
		
	) );
	// Enable support for title tag
	add_theme_support('title-tag');
	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'audio', 'video', 'gallery' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'businesshub_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	/**
	 * Add Thumbnail Sizes
	 */
	global $businesshub_size_array;
	if(!$businesshub_size_array) $businesshub_size_array = array();
	$businesshub_size_array_theme = array(
		'businesshub_thumb_960x640' => array(960, 640, true, array('businesshub_thumb_960x640','businesshub_thumb_960x640','businesshub_thumb_960x640','full')),
		'businesshub_thumb_460x307' => array(460, 307, true, array('businesshub_thumb_460x307','businesshub_thumb_460x307','businesshub_thumb_460x307','businesshub_thumb_960x640')),
		'businesshub_thumb_megamenu' => array(320, 213, true, array('businesshub_thumb_megamenu','businesshub_thumb_megamenu','businesshub_thumb_megamenu','businesshub_thumb_640x427')),
		'businesshub_latestpost_widget' => array(80, 80, true, array('businesshub_latestpost_widget','businesshub_latestpost_widget','businesshub_latestpost_widget','businesshub_thumb_160x160')),
		
		//retina
		'businesshub_thumb_640x427' => array(640, 427, true, array('businesshub_thumb_640x427','businesshub_thumb_640x427','businesshub_thumb_640x427','businesshub_thumb_960x640')),
		'businesshub_thumb_160x160' => array(160, 160, true, ''),
	);
	$businesshub_size_array = array_merge($businesshub_size_array, $businesshub_size_array_theme);
	do_action( 'businesshub_reg_thumbnail', $businesshub_size_array );
}
endif;
add_action( 'after_setup_theme', 'businesshub_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function businesshub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar ', 'cactus' ),
		'id'            => 'main_sidebar',
		'description'   => esc_html__( 'Applied for all pages', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title'  => '<h2 class="widget-title h4">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar', 'cactus' ),
		'id' => 'blog_sidebar',
		'description' => esc_html__( 'Appear in Blog page', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Top Nav Sidebar', 'cactus' ),
		'id' => 'top_nav_sidebar',
		'description' => esc_html__( 'Appear on the top of the page', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="%2$s widget col-md-12 widget-col nav navbar-nav header-top-info hidden-xs"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Portfolio Sidebar', 'cactus' ),
		'id' => 'portfolio_sidebar',
		'description' => esc_html__( 'Appear in Portfolio pages. Available when Cactus-Portfolio plugin is installed', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Job Sidebar', 'cactus' ),
		'id' => 'job_sidebar',
		'description' => esc_html__( 'Appear in Job pages. Available when Cactus-Job plugin is installed', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	if(class_exists( 'Easy_Digital_Downloads' )){
		register_sidebar( array(
			'name' => esc_html__( 'EDD Sidebar', 'cactus' ),
			'id' => 'product_sidebar',
			'description' => esc_html__( 'Appear in EDD pages. Available when EDD plugin is installed', 'cactus' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h2 class="widget-title h4">',
			'after_title' => '</h2>',
		));
	}
	register_sidebar( array(
		'name' => esc_html__( 'Footer Sidebar', 'cactus' ),
		'id' => 'footer_sidebar',
		'description' => esc_html__( 'Appear in Footer', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs Sidebar', 'cactus' ),
		'id' => 'breadcrumb_sidebar',
		'description' => esc_html__( 'To replace default breadcrumb', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Search Box Sidebar', 'cactus' ),
		'id' => 'searchbox_sidebar',
		'description' => esc_html__( 'To replace default Search Form', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Main Menu Sidebar', 'cactus' ),
		'id' => 'mainmenu_sidebar',
		'description' => esc_html__( 'To replace Main Menu', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Top Sidebar', 'cactus' ),
		'id' => 'top_sidebar',
		'description' => esc_html__( 'Appear before main content', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Bottom Sidebar', 'cactus' ),
		'id' => 'bottom_sidebar',
		'description' => esc_html__( 'Appear after main content', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Content Top Sidebar', 'cactus' ),
		'id' => 'content_top_sidebar',
		'description' => esc_html__( 'Appear in main content, before text content', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Content Bottom Sidebar', 'cactus' ),
		'id' => 'content_bottom_sidebar',
		'description' => esc_html__( 'Appear in main content, after text content', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Callout Sidebar', 'cactus' ),
		'id' => 'callout_sidebar',
		'description' => esc_html__( 'Special position to display Call To Action text', 'cactus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col nav navbar-nav navbar-right header-top-slogan"><div class="widget-inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h2 class="widget-title h4">',
		'after_title' => '</h2>',
	));
	if(class_exists('businesshub_edd_addon')){
		register_sidebar( array(
			'name' => esc_html__( 'EDD SidebarMenu Sidebar', 'cactus' ),
			'id' => 'edd_addon_sidemenu_sidebar',
			'description' => esc_html__( 'To use in EDD Page Template. It is recommended to use a menu here', 'cactus' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col menu-content"><div class="widget-inner">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h2 class="widget-title h4">',
			'after_title' => '</h2>',
		));
	}
	if (class_exists('Woocommerce')) {
		register_sidebar( array(
			'name' => esc_html__( 'WooCommerce Sidebar', 'cactus' ),
			'id' => 'woocommerce_sidebar',
			'description' => esc_html__( 'Appear in WooCommerce pages. Available when WooCommerce plugin is installed', 'cactus' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h2 class="widget-title h4">',
			'after_title'   => '</h2>',
		));
	}
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(is_plugin_active('bbpress/bbpress.php')){
		register_sidebar( array(
			'name' => esc_html__( 'BBPress Sidebar', 'cactus' ),
			'id' => 'bbpress_sidebar',
			'description' => esc_html__( 'Appear in BBPress pages. Available when BBPress plugin is installed', 'cactus' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s module widget-col"><div class="widget-inner">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h2 class="widget-title h4">',
			'after_title'   => '</h2>',
		));
	}
}
add_action( 'widgets_init', 'businesshub_widgets_init' );

/**
 *  Get URL to google fonts
 * 
 * @param
 * 	$font_names - array - Array of Google Font Names
 * 
 * @return
 * 	string - URL of Google Fonts to enqueue
 */
function businesshub_get_google_fonts_url ($font_names) {

    $font_url = '';

    $font_url = add_query_arg( 'family', urlencode(implode('|', $font_names)) , "//fonts.googleapis.com/css" );
    return $font_url;
}
/**
 * Enqueue scripts and styles.
 */
function businesshub_scripts() {
	/**
	*Register Google Font
	*/
	$main_font_default='Open Sans:400,700,400italic,700italic';
	$heading_font_default='Poppins:700';
	$g_fonts=array($main_font_default, $heading_font_default);

	$google_font=ot_get_option('google_font', 'on');
	if($google_font=='on'){		
		$main_font=ot_get_option('main_font_family');
		if($main_font!=''){
			$font_names=businesshub_get_google_font_name($main_font);
			array_push($g_fonts, $main_font);
		}
		$heading_font=ot_get_option('heading_font_family');
		if($heading_font!=''){
			$heading_font_name=businesshub_get_google_font_name($heading_font);
			array_push($g_fonts, $heading_font);
		}		
		$navigation_font=ot_get_option('navigation_font_family');
		if($navigation_font!=''){
			$navigation_font_name=businesshub_get_google_font_name($navigation_font);
			array_push($g_fonts, $navigation_font);
		}
	}
	else{
		array_push($g_fonts, $main_font_default);
	}
	wp_enqueue_style( 'google-fonts', businesshub_get_google_fonts_url($g_fonts), array(), '1.0.0' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/init.css'); //bootstrap
	wp_enqueue_style( 'business-hub-font-awesome', get_template_directory_uri() . '/css/fonts/awesome/css/font-awesome.min.css'); //fontawesome
	wp_enqueue_style( 'cactus-icon', get_template_directory_uri() . '/css/fonts/ct-icon/styles.css'); //cactus icon
	wp_enqueue_style( 'cactus-style', get_stylesheet_uri());
	if(class_exists( 'Easy_Digital_Downloads' )){
		wp_enqueue_style( 'cactus-easy-digtal-download', get_template_directory_uri() . '/css/edd-styles.css'); //Easy Digital Downloads
	}
	if (class_exists('Woocommerce')) {
		wp_enqueue_style( 'business-woocommrce', get_template_directory_uri() . '/css/businesshub-woocommerce.css');
	}
	add_editor_style( array( get_template_directory_uri() . 'css/editor-style.css' ) );
	
	/**
	*Right To Left CSS
	*/
	if(ot_get_option('rtl') == 'on'){
		wp_enqueue_style( 'rtl', get_template_directory_uri() . '/rtl.css', array('ct-shortcode-css'));
	};
	
	$smoothScroll = ot_get_option('scroll_effect', 'off');
	if($smoothScroll=='on') {
		wp_enqueue_script( 'businesshub_smoothScroll', get_template_directory_uri() . '/js/smoothscroll.js', array('jquery'), '1.4.0', false );
	}
	
	wp_enqueue_script( 'cactus-jquery-library', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// code to embed the java script file that makes the Ajax request
	wp_enqueue_script( 'cactus-ajax-request', get_template_directory_uri() . '/js/ajax.js', array('jquery'));

	// main theme javascript code
	wp_enqueue_script( 'cactus-theme-js', get_template_directory_uri() . '/js/template.js', array('jquery'), '', true );

	// code to declare the URL to the file handling the AJAX request <p></p>
	$js_params = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
	global $wp_query, $wp;
	$js_params['query_vars'] = $wp_query->query_vars;
	$js_params['current_url'] =  home_url($wp->request);

	wp_localize_script( 'cactus-ajax-request', 'cactus', $js_params  );

}
add_action( 'wp_enqueue_scripts', 'businesshub_scripts' );

/**
 * Style for admin
 */

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom WP Footer
 */
add_action('wp_footer','businesshub_wp_foot',100);
if(!function_exists('businesshub_wp_foot')){
	function businesshub_wp_foot(){
		// write out custom code
		$custom_code = ot_get_option('custom_code','');
		echo $custom_code;
	}
}

add_action('wp_head','businesshub_wp_head',1000);
if(!function_exists('businesshub_wp_head')){
	function businesshub_wp_head(){
		echo '<!-- custom css -->
				<style type="text/css">';
		
		require get_template_directory() . '/css/custom.css.php';
		
		echo '</style>
			<!-- end custom css -->';
	}
}

/*
 * Get label of an option in Option Tree / Theme Options
 */
function businesshub_get_setting_label_by_id( $id ) {
  if ( empty( $id ) )
    return false;
  $settings = get_option( 'option_tree_settings' );
  if ( empty( $settings['settings'] ) )
    return false;
  foreach( $settings['settings'] as $setting ) {
    if ( $setting['id'] == $id && isset( $setting['label'] ) ) {
      return $setting['label'];
    }
  }
}

/**
 * Print out social accounts link.
 */
if(!function_exists('businesshub_print_social_accounts')){
	function businesshub_print_social_accounts($class=false, $show_class=false){
		/* below are default supported social networks. To support more, add the name of theme option in the array */
		$accounts = array('facebook','youtube','twitter','linkedin','tumblr','google-plus','pinterest','flickr','envelope','rss');
		$target = ot_get_option('open_social_link_new_tab', 'on') == 'on' ? '_blank' : '_parent';
		/* this HTML uses Font Awesome icons */
		?>
		<ul class='social-accounts <?php if($class){ echo esc_attr($class);}?>'>
		<?php
		foreach($accounts as $account){
			$url = ot_get_option($account,'');
			$label = businesshub_get_setting_label_by_id($account);
			if($url){
				if($account == 'envelope'){
					// this is email account, so use mailto protocol
					$url = 'mailto:' . $url;
				}
			?>
				<li <?php if(isset($show_class) &&$show_class==true){echo 'class="'.$account.'"';}?>><a <?php echo ($account == 'envelope' ? '' : "target='" . $target . "'");?> href="<?php echo esc_url($url);?>" title='<?php echo esc_attr($label);?>'><i class="fa fa-<?php echo esc_attr($account);?>"></i></a></li>
			<?php }?>
			<?php
		}
		?>
        <?php
			// Custom Social Account
			$custom_social_accounts = ot_get_option('custom_social_account','');
			if( $custom_social_accounts ):
				foreach ($custom_social_accounts as $custom_social_account):?>
					<li  class="<?php echo 'custom-'.$custom_social_account['icon_custom_social_account']; ?>"><a href="<?php echo esc_url($custom_social_account["url_custom_social_account"]);?>" title='<?php echo esc_attr($custom_social_account["title"]);?>' target='<?php echo esc_attr($target);?>'><i class="fa <?php echo esc_attr($custom_social_account["icon_custom_social_account"]);?>"></i></a></li>
				<?php endforeach;
			endif;
		?>
		</ul>
		<?php
	}
}


/**
 * Display Social Share buttons for FaceBook, Twitter, LinkedIn, Google+, Thumblr, Pinterest, Email
 */
if(!function_exists('businesshub_print_social_share')){
function businesshub_print_social_share($class_css = false, $id = false){
	if(!$id){
		$id = get_the_ID();
	}
?>
		<ul class="social-listing list-inline <?php if(isset($class_css)){ echo esc_attr($class_css);} ?>">
	  		<?php if(ot_get_option('sharing_facebook')!='off'){ ?>
		  		<li class="facebook">
		  		 	<a class="trasition-all" title="<?php esc_html_e('Share on Facebook','cactus');?>" href="#" target="_blank" rel="nofollow" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo urlencode(get_permalink($id)); ?>','facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-facebook"></i>
		  		 	</a>
		  		</li>
	    	<?php }

			if(ot_get_option('sharing_twitter')!='off'){ ?>
		    	<li class="twitter">
			    	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Twitter','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php echo urlencode(get_permalink($id)); ?>','twitter-share-dialog','width=626,height=436');return false;"><i class="fa fa-twitter"></i>
			    	</a>
		    	</li>
	    	<?php }

			if(ot_get_option('sharing_linkedIn')!='off'){ ?>
				   	<li class="linkedin">
				   	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on LinkedIn','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink($id)); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>','linkedin-share-dialog','width=626,height=436');return false;"><i class="fa fa-linkedin"></i>
				   	 	</a>
				   	</li>
		   	<?php }

			if(ot_get_option('sharing_tumblr')!='off'){ ?>
			   	<li class="tumblr">
			   	   <a class="trasition-all" href="#" title="<?php esc_html_e('Share on Tumblr','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink($id)); ?>&amp;name=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','tumblr-share-dialog','width=626,height=436');return false;"><i class="fa fa-tumblr"></i>
			   	   </a>
			   	</li>
	    	<?php }

			if(ot_get_option('sharing_google')!='off'){ ?>
		    	 <li class="google-plus">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Google Plus','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink($id)); ?>','googleplus-share-dialog','width=626,height=436');return false;"><i class="fa fa-google-plus"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }

			 if(ot_get_option('sharing_pinterest')!='off'){ ?>
		    	 <li class="pinterest">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Pin this','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($id)) ?>&amp;media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($id))); ?>&amp;description=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','pin-share-dialog','width=626,height=436');return false;"><i class="fa fa-pinterest"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }
			 
			 /*if(ot_get_option('sharing_vk')!='off'){ ?>
		    	 <li class="vk">
		    	 	<a class="trasition-all" href="#" title="<?php esc_html_e('Share on VK','cactus');?>" rel="nofollow" target="_blank" onclick="window.open('//vkontakte.ru/share.php?url=<?php echo urlencode(get_permalink(get_the_ID())); ?>','vk-share-dialog','width=626,height=436');return false;"><i class="fa fa-vk"></i>
		    	 	</a>
		    	 </li>
	    	 <?php }*/

			 if(ot_get_option('sharing_email')!='off'){ ?>
		    	<li class="email">
			    	<a class="trasition-all" href="mailto:?subject=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;body=<?php echo urlencode(get_permalink($id)) ?>" title="<?php esc_html_e('Email this','cactus');?>"><i class="fa fa-envelope"></i>
			    	</a>
			   	</li>
		   	<?php }?>
	    </ul>
        <?php
	}
}

/**
 * Ajax page navigation
 */

// when the request action is 'load_more', the businesshub_ajax_load_next_page() will be called
add_action( 'wp_ajax_load_more', 'businesshub_ajax_load_next_page' );
add_action( 'wp_ajax_nopriv_load_more', 'businesshub_ajax_load_next_page' );

function businesshub_ajax_load_next_page() {
    // Get current page
	$page = $_POST['page'];
	global $archives_thumb;
	$archives_thumb = isset($_POST['archives_thumb']) ? esc_html($_POST['archives_thumb']) : '';
	// number of published sticky posts
	$sticky_posts = businesshub_get_sticky_posts_count();

	// current query vars
	$vars = $_POST['vars'];


	// convert string value into corresponding data types
	foreach($vars as $key=>$value){
		if(is_numeric($value)) $vars[$key] = intval($value);
		if($value == 'false') $vars[$key] = false;
		if($value == 'true') $vars[$key] = true;
	}

	// item template file
	$template = $_POST['template'];

	// Return next page
	$page = intval($page) + 1;
	if($vars['posts_per_page']){
		$posts_per_page = $vars['posts_per_page'];
	}else{
		$posts_per_page = get_option('posts_per_page');
	}

	if($page == 0) $page = 1;
	$offset = ($page - 1) * $posts_per_page;
	/*
	 * This is confusing. Just leave it here to later reference
	 *

	if(!$vars['ignore_sticky_posts']){
		$offset += $sticky_posts;
	}
	 *
	 */


	// get more posts per page than necessary to detect if there are more posts
	$args = array('post_status'=>'publish','posts_per_page' => $posts_per_page + 1,'offset' => $offset);
	$args = array_merge($vars,$args);

	// remove unnecessary variables
	unset($args['paged']);
	unset($args['p']);
	unset($args['page']);
	unset($args['pagename']); // this is neccessary in case Posts Page is set to a static page

	$query = new WP_Query($args);


	$idx = 0;
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$idx = $idx + 1;
			if($idx < $posts_per_page + 1){
				global $post_type;
				if(isset($vars['post_type']))
					$post_type = $vars['post_type'];
				else 
					$post_type = '';
				get_template_part( $template, get_post_format() );
			}
		}

		if($query->post_count <= $posts_per_page){
			// there are no more posts
			// print a flag to detect
			echo '<div class="invi no-posts"><!-- --></div>';
		}
	} else {
		// no posts found
	}

	/* Restore original Post Data */
	wp_reset_postdata();

	die('');
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active('option-tree/ot-loader.php'))
{

	if ( ! function_exists( 'ot_get_option' ) )
	{
		function ot_get_option($id, $default_value=null)
		{
			return $default_value;
		}
	}

	if ( ! function_exists( 'ot_settings_id' ) )
	{
		function ot_settings_id()
		{
			return null;
		}
	}

	if ( ! function_exists( 'ot_register_meta_box' ) )
	{
		function ot_register_meta_box()
		{
			return null;
		}
	}
}

/* Custom Upload Image */
add_action('admin_enqueue_scripts', 'businesshub_admin_upload');

function businesshub_admin_upload() {
        wp_enqueue_media();
}
// get category
if(!function_exists('businesshub_get_category')){
	function businesshub_get_category($post_type=false)
	{
		$output = '';
		if($post_type && ($post_type =='ct_portfolio' || $post_type =='download' )){
			if($post_type =='ct_portfolio'){$tern_name = 'portfolio_cat';}
			else{$tern_name = 'download_category';}
			$terms =array();
			if(!is_wp_error(wp_get_post_terms( get_the_ID(), $tern_name))){
				$terms = wp_get_post_terms( get_the_ID(), $tern_name);
			}
			$count = 0; $i=0;
			foreach ($terms as $term) {
				$count ++;
			}
			if($count!=0){
				foreach ($terms as $term) {
					$i++;
					$output .= '<a class="cactus-note-cat" href="'.esc_url(get_term_link($term->slug, $tern_name)).'">'.esc_attr($term->name).'</a> ';
				}
				echo wp_kses($output,array('a'=>array('href'=>array(), 'class' => array())));
			}
		}else{
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a class="cactus-note-cat" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' .esc_html__('View all posts in ','cactus') . $category->name . '">' . esc_html( $category->name ) . '</a>';
				}
				echo wp_kses($output,array('a'=>array('href'=>array(),'title' => array(), 'class' => array())));
			}
		}
	}
}
// get tags
if(!function_exists('businesshub_get_tags')){
	function businesshub_get_tags()
	{
		$tags = get_the_tags();
		$output = '';
		if ( ! empty( $tags ) ) {
			$output .= '<i class="fa fa-tag"></i>';
			foreach( $tags as $tag ) {
				$output .= '<a class="cactus-note-cat" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' .esc_html__('View all posts in ','cactus') . $tag->name . '">' . esc_html( $tag->name ) . '</a>';
			}
			echo wp_kses($output,array('a'=>array('href'=>array(),'title' => array(),'class' => array())));
		}
	}
}
/* Breadcumb */
if(!function_exists('businesshub_breadcrumbs')){
	function businesshub_breadcrumbs(){
		/* === OPTIONS === */
		$text['home']     = esc_html__('Home','cactus'); // text for the 'Home' link
		$text['category'] = '%s'; // text for a category page
		$text['search']   = esc_html__('Search Results for','cactus').' "%s"'; // text for a search results page
		$text['tag']      = esc_html__('Tag','cactus').' "%s"'; // text for a tag page
		$text['author']   = ' %s'; // text for an author page
		$text['404']      = esc_html__('404','cactus'); // text for the 404 page

		$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
		$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_title     = 1; // 1 - show the title for the links, 0 - don't show
		$delimiter      = ' <span class="ct-s-v-u">\</span> '; // delimiter between crumbs
		$before         = '<span class="current">'; // tag before the current crumb
		$after          = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$home_link    = home_url('/');
		$link_before  = '';
		$link_after   = '';
		$link_attr    = '';//' rel="v:url" property="v:title"';
		$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$parent_id    = $parent_id_2 = ($post) ? $post->post_parent : 0;
		$frontpage_id = get_option('page_on_front');
		$event_layout ='';

		if(is_front_page()) {

			if ($show_on_home == 1) echo '<div class="cactus-breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

		}elseif(is_home()){
			$title = get_option('page_for_posts')?get_the_title(get_option('page_for_posts')):esc_html__('Blog','cactus');
			echo '<div class="cactus-breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a> \ '.$title.'</div>';
		}else{

			echo '<div class="cactus-breadcrumb">';
			if ($show_home_link == 1) {
				if(function_exists ( "is_shop" ) && is_shop()){

				}else{
					echo '<a href="' . $home_link . '">' . $text['home'] . '</a>'; //rel="v:url" property="v:title"
					if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
				}
			}

			if ( is_category() ) {
				$this_cat = get_category(get_query_var('cat'), false);
				if ($this_cat->parent != 0) {
					$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
					if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo esc_html($cats);
				}
				if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $home_link . $slug['slug'] . '/', $slug['slug']?$slug['slug']:$post_type->labels->singular_name);
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
					if ($show_current == 1) echo $before . get_the_title() . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				if(function_exists ( "is_shop" ) && is_shop()){
					do_action( 'woocommerce_before_main_content' );
					do_action( 'woocommerce_after_main_content' );
				}else{
					$post_type = get_post_type_object(get_post_type());
					if(isset($post_type->rewrite)){
						$slug = $post_type->rewrite;
						$downloads_text = ot_get_option('downloads_text');
						if(get_post_type() == 'download' && $downloads_text!=''){
							echo $before . (esc_attr($downloads_text)) . $after;
						}else{
							echo $before . ($slug['slug']?$slug['slug']:$post_type->labels->singular_name) . $after;
						}
					}
				}

			} elseif ( is_attachment() ) {
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID); $cat = isset($cat[0])?$cat[0]:'';
				if($cat){
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo esc_html($cats);
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$parent_id ) {
				if ($show_current == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $parent_id ) {
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo strip_shortcodes($breadcrumbs[$i]);
						if ($i != count($breadcrumbs)-1) echo $delimiter;
					}
				}
				if ($show_current == 1) {
					if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
					echo $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {
				echo $before . esc_attr(sprintf($text['tag']), single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . esc_attr(sprintf($text['author']), $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . esc_attr($text['404']) . $after;
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	} // end tm_breadcrumbs()
}
//post on
if(!function_exists('businesshub_get_datetime')){
	function businesshub_get_datetime($post_ID = '')
	{
		if($post_ID == ''){
			global $post;
		 	if($post) {
		 		$post_ID = $post->ID;
		 	}
		}
		$post_datetime_setting  = ot_get_option('enable_link_on_datetime', 'on');
		if($post_datetime_setting == 'on')
			return '<a href="' . esc_url(get_the_permalink($post_ID)) . '" class="cactus-info" rel="bookmark"><time datetime="' . get_the_date( 'c', $post_ID ) . '" class="entry-date updated">' . date_i18n(get_option('date_format') ,get_the_time('U', $post_ID)) . '</time></a>';
		else
			return '<div class="cactus-info" rel="bookmark"><time datetime="' . get_the_date( 'c', $post_ID ) . '" class="entry-date updated">' . date_i18n(get_option('date_format') ,get_the_time('U', $post_ID)) . '</time></div>';
	}
}

if(!function_exists('businesshub_post_on')){
	function businesshub_post_on(){
		?>
            <div class="posted-on">
            	<?php $post_published_date = ot_get_option('post_published_date', 'on');
					if( $post_published_date == 'on' ):	?>
                    <div>
                        <?php echo businesshub_get_datetime();?> 
                    </div>
                <?php endif; ?>
                
                <?php $post_author = ot_get_option('post_author', 'on');
					if( $post_author == 'on' ):	?>
                    <div>
                        <?php esc_html_e('By','cactus');?> 
                        <span class="vcard author">
                            <span class="fn"><?php the_author_posts_link(); ?></span>
                        </span>
                    </div>
                <?php endif; ?>
                
                <?php $post_categories = ot_get_option('post_categories', 'on');
				if( $post_categories == 'on' ){	?>
					<div class="ups_text">
						<div class="categories">
							<?php businesshub_get_category();?>
						</div>
					</div>
				<?php } ?>        
                
                <?php $post_comment_count = ot_get_option('post_comment_count', 'on');
					if( $post_comment_count == 'on' ):	?>
                    <div class="ups_text"> 
                        <a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID()); esc_html_e(' comments','cactus')?></a>
                    </div>
                <?php endif; ?>
            </div>
		<?php 				
	}
}
if(!function_exists('businesshub_checkout_bt')){
	function businesshub_checkout_bt($show_ic = false){
		$digital_checkout_bt = ot_get_option('digital_checkout_bt','on');
		$url_checkout ='';
		if(function_exists('edd_get_checkout_uri') && (!function_exists('is_woocommerce') || !is_woocommerce()) && (!function_exists('is_cart') || !is_cart()) && (!function_exists('is_checkout') || !is_checkout())){
			$url_checkout =  edd_get_checkout_uri(); 
		}elseif(class_exists('Woocommerce')){
			global $woocommerce;
			$url_checkout = $woocommerce->cart->get_checkout_url();
			$nb_it = $woocommerce->cart->get_cart_contents_count();
		}
		$checkout_text = ot_get_option('checkout_text');
		if(($url_checkout!='') && ($digital_checkout_bt!='off')){
			if(function_exists('edd_get_cart_contents') && (!function_exists('is_woocommerce') || !is_woocommerce()) && (!function_exists('is_cart') || !is_cart()) && (!function_exists('is_checkout') || !is_checkout())){
				$nb_it = edd_get_cart_contents();
				if($nb_it!= '' && is_array($nb_it) && !empty($nb_it)){
					$nb_it = count($nb_it);
				}else{
					$nb_it = 0;
				}
			}
			?>
        	<!--checkout - remove in style 1-->
            <aside class="widget col-md-12 widget-col nav navbar-nav navbar-right header-top-checkout">
                <div class="widget-inner">
                    <div class="ct-cart-content">
                    	<?php if($nb_it>0){?>
                            <a href="<?php echo esc_url($url_checkout)?>">
                                <div class="fa fa-shopping-cart"><span class="total-item"><?php echo esc_html($nb_it);  ?></span></div>
                            </a>   
                        <?php }else{?>      
                           <a href="<?php echo esc_url($url_checkout)?>" style="pointer-events:none;">      
                                <div class="fa fa-shopping-cart"></div>
                            </a>
                        <?php }?>            
                    </div>
                </div>
            </aside>
            <?php if(isset($show_ic) && ($show_ic =='1')){ ?>
                <aside class="widget col-md-12 widget-col nav navbar-nav navbar-right header-cart-mobile">
                    <div class="widget-inner">
                        <div class="ct-cart-mobile-content">
                            <?php if($nb_it>0){?>
                                <a href="<?php echo esc_url($url_checkout)?>">
                                    <div class="fa fa-shopping-cart"><span class="total-item"><?php echo esc_html($nb_it);  ?></span></div>
                                </a>   
                            <?php }else{?>
                            	<a href="<?php echo esc_url($url_checkout)?>" style="pointer-events:none;">      
                               		<div class="fa fa-shopping-cart"></div>
                                </a>
                            <?php }?>
                        </div>
                    </div>
                </aside> 
            <?php }?>
        <!--checkout--> 
        <?php }
	}
}
if(!function_exists('businesshub_edd_button')){
	function businesshub_edd_button($hide_price=false){
		if(class_exists( 'Easy_Digital_Downloads' )){
			if( !edd_has_variable_prices( get_the_ID()) ) {
				$price = get_post_meta(get_the_ID(),'edd_price', true );
			}?>
            <div class="digital-price">
                <div class="price-details <?php if(!edd_has_variable_prices( get_the_ID()) && $price ==0) {?> free-price <?php }?>" <?php if(isset($hide_price) && $hide_price=='yes'){?> style="display:none;" <?php }?>>
					<?php
                    if( !edd_has_variable_prices( get_the_ID()) ) {
						
                        if($price ==0){
							$free_text = ot_get_option('free_text');
							if($free_text!=''){
								echo esc_attr($free_text);
							}else{
                            	esc_html_e('Free','cactus');
							}
                        }else{
                            edd_price(get_the_ID());
                        }
                    }else{
                        echo edd_price( get_the_ID()); 
                    }?>
                </div>
                <?php 
				$download_now_text = ot_get_option('download_now_text');
				if($download_now_text!=''){
					$download_now_text = esc_attr($download_now_text);
				}else{
					$download_now_text = esc_html__('DOWNLOAD NOW','cactus');
				}
				$buy_now_text = ot_get_option('buy_now_text');
				if($buy_now_text!=''){
					$buy_now_text = esc_attr($buy_now_text);
				}else{
					$buy_now_text = esc_html__('BUY NOW','cactus');
				}?>
                <div class="buy-button <?php if(!edd_has_variable_prices( get_the_ID()) && $price ==0) {?> dl-free <?php }?>">
                    <a href="<?php echo esc_url( get_permalink() );?>" class="btn btn-default btn-style-1 btn-style-2 btn-style-4 imp-color-1">
                        <div class="add-style">                                                                
                            <span><?php if(!edd_has_variable_prices( get_the_ID()) && $price ==0) { echo esc_html($download_now_text);}else{ echo esc_html($buy_now_text);}?></span>
                        </div>
                    </a>
                </div>
            </div>                                                                     	
    	<?php }
	}
}
if(!function_exists('businesshub_checkout_action')){
	function businesshub_checkout_action(){
		if(class_exists( 'Easy_Digital_Downloads' )){
			$price = 'fee';
			$currency_pss = get_option('edd_settings');
			if(isset($currency_pss['currency_position'])) {
				$currency_pss = $currency_pss['currency_position'];
			}
			//echo $currency_pss;
			?>
            <div class="price-options-group">
            	<div class="price-options-row">
					<?php
                    if( edd_has_variable_prices( get_the_ID()) ) {				
                        $edd_variable_prices = get_post_meta(get_the_ID(),'edd_variable_prices', true );
                        ?>
                        <div class="price-options-select">
                            <select class="add-custom-select" disabled>
                                <?php foreach($edd_variable_prices as $item => $val){?>
                                <option value="<?php echo esc_attr($item);?>"><?php echo esc_attr($val['name'])?></option>
                                <?php }?>
                            </select>
                        </div>
                        <?php foreach($edd_variable_prices as $item => $val){?>
                            <div class="single-price" data-link="<?php echo add_query_arg( array('edd_action' => 'add_to_cart', 'download_id' => get_the_ID(), 'edd_options[price_id]' => $item), get_the_permalink() ); ?>" data-price-id="<?php echo esc_attr($item);?>">
                            	<span>
                                    <?php if($currency_pss=='before'){ echo businesshub_sumobi_edd_currency(edd_get_currency());} echo esc_attr($val['amount']); if($currency_pss=='after'){ echo businesshub_sumobi_edd_currency(edd_get_currency());}?>
                                </span>
                            </div>
                        <?php }?>
                    <?php }else{
                        $price = get_post_meta(get_the_ID(),'edd_price', true );
                        if($price ==0 || $price ==''){?>
                            <div class="single-price">
                            	<span>
									<?php $free_text = ot_get_option('free_text');
                                    if($free_text!=''){
                                        echo esc_attr($free_text);
                                    }else{
                                        esc_html_e('Free','cactus');
                                    } ?>
                                </span>
                            </div>
                            <?php
                        }else{$price = 'fee';?>
                            <div class="single-price"><span><?php edd_price(get_the_ID());?></span></div>
                            <?php
                        }
                    }?>
                </div>
            </div>
            
            <?php $has_add = edd_get_cart_contents();
			$checkout_text = ot_get_option('checkout_text');
			if($checkout_text!=''){
				$checkout_text = esc_attr($checkout_text);
			}else{
				$checkout_text = esc_html__('Checkout','cactus');
			}
			$html_checkoutlink = '';
			if($has_add){
				foreach($has_add as $it_cart){
					if(get_the_ID() == $it_cart['id']){
						$html_checkoutlink =  '<a class="link-checkout" href="'.edd_get_checkout_uri().'">'.$checkout_text.' <i class="fa fa-long-arrow-right"></i></a>';
						break;
					}
				}
			}
			?>        
            <?php 
			$download_now_text = ot_get_option('download_now_text');
			if($download_now_text!=''){
				$download_now_text = esc_attr($download_now_text);
			}else{
				$download_now_text = esc_html__('DOWNLOAD NOW','cactus');
			}
			$buy_now_text = ot_get_option('buy_now_text');
			if($buy_now_text!=''){
				$buy_now_text = esc_attr($buy_now_text);
			}else{
				$buy_now_text = esc_html__('BUY NOW','cactus');
			}?>
            <div class="ct-eddbutton-group">
                <a href="<?php echo add_query_arg( array('edd_action' => 'add_to_cart', 'download_id' => get_the_ID(), 'edd_options[price_id]' => 0), get_the_permalink() ); ?>" class="btn btn-default btn-style-1 btn-style-2 <?php if($price !='fee'){ ?>btn-style-4 <?php }?> imp-color-1 <?php if($price =='fee'){ ?>bt-stylev1-product <?php }?>">
                    <span class="add-style">
                        <span class="ct-icon-20-ecommerce-shopping-bag"></span> 
                        <span><?php if($price !='fee'){ echo esc_html($download_now_text);}else{ echo esc_html($buy_now_text); }?></span>
                    </span>
                </a>
                <?php echo $html_checkoutlink;?> 
            </div>                                                                      	
    	<?php }
	}
}
if(!function_exists('businesshub_sumobi_edd_currency')){
	function businesshub_sumobi_edd_currency( $currency ) {
		switch ( $currency ) :
			case "GBP" :
				$symbol = '&pound;';
				break;
			case "BRL" :
				$symbol = 'R&#36;';
				break;
			case "EUR" :
				$symbol = '&euro;';
				break;
			case "USD" :
			case "AUD" :
			case "NZD" :
			case "CAD" :
			case "HKD" :
			case "MXN" :
			case "SGD" :
				$symbol = '&#36;';
				break;
			case "JPY" :
				$symbol = '&yen;';
				break;
			default :
				$symbol = $currency;
				break;
		endswitch;
	
		return $symbol;
	}
}
//Display Shortcode in Text Widget default WordPress
add_filter('widget_text', 'do_shortcode');

add_filter( 'the_title', 'businesshub_remove_shortcode' );
function businesshub_remove_shortcode( $title ) {
    return strip_shortcodes( $title );
}

function businesshub_enable_extended_upload ( $mime_types =array() ) {
   $mime_types['woff2']  = 'application/font-woff2';
   $mime_types['woff']  = 'application/x-font-woff';
   
   unset( $mime_types['exe'] );
   unset( $mime_types['bin'] ); 
   return $mime_types;
} 
if(!function_exists('businesshub_ratting_show')){
	function businesshub_ratting_show(){
		if(!class_exists('cactusRating')){
			return false;
		}
		$avg_score_rate='';
		$rt = new cactusRating();
		$rate_options = $rt->tmr_get_all_option();
		$user_rate = isset($rate_options['tmr_user_rate']) ? $rate_options['tmr_user_rate'] : '';
		if($user_rate!='none' && $user_rate!='only_user'){
			$user_rate_option_meta  = get_post_meta(get_the_ID(),'user_rate_option',true);
			$user_rate_option 		= $user_rate_option_meta != '' ? $user_rate_option_meta : 'on';
			if($user_rate_option != '' && $user_rate_option == 'on') {
				$avg_score_rate = get_post_meta(get_the_ID(), 'avg_score_rate', true)*10;
			}else{
				$avg_score_rate  = get_post_meta(get_the_ID(),'taq_review_score',true);
			}
		}elseif($user_rate=='only_user'){
			$user_rate_option_meta  = get_post_meta(get_the_ID(),'user_rate_option',true);
			$user_rate_option 		= $user_rate_option_meta != '' ? $user_rate_option_meta : 'on';
			if($user_rate_option != '' && $user_rate_option == 'on') {
				$avg_score_rate = get_post_meta(get_the_ID(), 'avg_score_rate', true)*10;
			}
		}
		if($avg_score_rate!=''&& $avg_score_rate!='0'){
			$rt = new cactusRating();
			?>
			<div class="user-rating">
				<?php $rt->tmr_draw_star($avg_score_rate);?>
			</div>
		<?php }
	}
}
add_filter('upload_mimes', 'businesshub_enable_extended_upload');
	if(class_exists( 'Easy_Digital_Downloads' )){
	function businesshub_downloadsc_hook($display, $atts, $buy_button, $columns, $column_width, $downloads, $excerpt, $full_content, $price, $thumbnails, $query ) {
		ob_start();
		$downloads = new WP_Query( $query );
		if ( $downloads->have_posts() ) :
			?>
            <div class="portfolio  shortcode is-single custom-download-sc">
                <div class="cactus-listing-config style-2 column-<?php echo esc_attr($columns);?>">
                    <div class="cactus-sub-wrap">
                    <?php
                    while ( $downloads->have_posts() ) : $downloads->the_post();?>
                        <!--item listing-->
                        <div class="cactus-post-item hentry business">
                        
                            <div class="entry-content">                                        
                                <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) && $thumbnails!='false') : ?>
                                <!--picture (remove)-->
                                <div class="picture">
                                    <div class="picture-content">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php echo businesshub_thumbnail('businesshub_thumb_460x307');?>
                                        </a>
                                    </div>                                                                                            
                                </div>                                                
                                <!--picture-->
                                <?php endif; ?>
                                <div class="content">                                                	
                                    
                                    <!--Title (no title remove)-->
                                    <h3 class="h5 cactus-post-title entry-title"> 
                                        <a href="<?php echo esc_url( get_permalink() );?>" title=""><?php the_title(); ?></a>
                                    </h3><!--Title-->
                                    <?php businesshub_ratting_show();?>
                                    <!--excerpt (remove)-->
                                    <div class="excerpt">
                                        <?php if($excerpt!='no'){
											echo esc_attr(get_the_excerpt()); 
										}elseif($full_content=='yes'){
											echo get_the_content();
										}?>
                                    </div><!--excerpt-->   
                                    <?php if(function_exists('businesshub_edd_button')){ businesshub_edd_button($price);}?>            
                                    <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                </div>
                                
                            </div>
                            
                        </div><!--item listing-->
                    <?php    
                    endwhile;
                    ?>
                    </div>
                    <?php
					if(isset($atts['pagination']) && isset($atts['pagination']) =='true'){
							$pagination = false;
			
							if ( is_single() ) {
								$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
									'base'    => get_permalink() . '%#%',
									'format'  => '?paged=%#%',
									'current' => max( 1, $query['paged'] ),
									'total'   => $downloads->max_num_pages
								), $atts, $downloads, $query ) );
							} else {
								$big = 999999;
								$search_for   = array( $big, '#038;' );
								$replace_with = array( '%#%', '&' );
								$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
									'base'    => str_replace( $search_for, $replace_with, get_pagenum_link( $big ) ),
									'format'  => '?paged=%#%',
									'current' => max( 1, $query['paged'] ),
									'total'   => $downloads->max_num_pages
								), $atts, $downloads, $query ) );
							}
						?>
			
						<?php if ( ! empty( $pagination ) ) : ?>
						<div id="edd_download_pagination" class="navigation">
							<?php echo $pagination; ?>
						</div>
						<?php endif;
					}?>
                </div>
            </div>
            <?php
		endif;
		$display = ob_get_contents();
		ob_end_clean();
		return $display;
	}
	add_filter( 'downloads_shortcode', 'businesshub_downloadsc_hook',10,11 );
}
function businesshub_heading_meta(){
	$ct_hd_meta = array();
	$page_meta_text_heading_style ='';
	//Page Header Background
	$page_header_background = '';
	$page_header_background = ot_get_option('page_header_background');
	$page_header_background = isset($page_header_background['background-image']) ? $page_header_background['background-image'] : '';
	//Page Header Background
	
	//Page Header Background
	$page_header_color = '';
	$page_header_color = ot_get_option('page_header_background');
	$page_header_color = isset($page_header_color['background-color']) ? $page_header_color['background-color'] : '';
	//Page Header Background
	
	//Page heading text style block
	$page_heading_icon = '';
	$page_heading_icon = ot_get_option('page_heading_icon'); 
	
	$page_heading_sub_text = '';
	$page_heading_sub_text = ot_get_option('page_heading_sub_text'); 	
	
	$page_heading_style 		= '';
	$page_heading_style_class 	= '';
	$page_heading_style 		= ot_get_option('page_text_heading_style','simple');

	if(is_front_page() && ('page' == get_option('show_on_front')) || is_page_template('templates/edd-page-template.php') ){
		$page_heading_style 	= $page_heading_style;
		$page_heading_icon 		= $page_heading_icon;
		$page_heading_sub_text 	= $page_heading_sub_text;
		$page_header_background = $page_header_background;
		$page_header_color 		= $page_header_color;
		
		$page_meta_text_heading_style 	= get_post_meta(get_the_ID(),'page_meta_text_heading_style', true );
		$page_meta_heading_icon 		= get_post_meta(get_the_ID(),'page_meta_heading_icon', true );
		$page_meta_heading_sub_text 	= get_post_meta(get_the_ID(),'page_meta_heading_sub_text', true );
		$page_meta_header_bg_group	 	= get_post_meta(get_the_ID(),'page_meta_header_background', true );
		$page_meta_header_background	= isset($page_meta_header_bg_group['background-image']) ? $page_meta_header_bg_group['background-image'] : '';
		$page_meta_header_color			= isset($page_meta_header_bg_group['background-color']) ? $page_meta_header_bg_group['background-color'] : '';
		if($page_meta_text_heading_style != '' && $page_meta_text_heading_style != 'default'){
			$page_heading_style = $page_meta_text_heading_style;
		}
		if($page_meta_heading_icon != ''){
			$page_heading_icon = $page_meta_heading_icon;
		}
		if($page_meta_heading_sub_text != ''){
			$page_heading_sub_text = $page_meta_heading_sub_text;
		}
		if($page_meta_header_background != ''){
			$page_header_background = $page_meta_header_background;
		}else{
			$page_header_background = $page_header_background;	
		}
		if($page_meta_header_color != ''){
			$page_header_color = $page_meta_header_color;
		}
		//Page heading text style block 
	} elseif( (is_archive()) || (is_front_page() && ('page' != get_option('show_on_front'))) || (is_home() && !is_front_page()) ){
		$archives_text_heading_style 	= ot_get_option('archives_text_heading_style', 'simple');
		$archives_heading_icon 			= ot_get_option('archives_heading_icon');
		$archives_heading_sub_text 		= ot_get_option('archives_heading_sub_text');
		$archives_header_background 	= ot_get_option('archives_header_background');
		$archives_header_background 	= isset($archives_header_background['background-image']) ? $archives_header_background['background-image'] : '';
		$archives_header_bg_color 		= ot_get_option('archives_header_background');
		$archives_header_bg_color 		= isset($archives_header_bg_color['background-color']) ? $archives_header_bg_color['background-color'] : '#444444';
		
		if(is_category()){
	
			//footer
			$cat 		= get_query_var('cat');
			$yourcat 	= get_category ($cat);
			$cat_id  	= $yourcat->cat_ID	;
			$cat_sidebar		 			= get_option( "cat_sidebar$cat_id") ? get_option( "cat_sidebar$cat_id"):'';
			$cat_text_heading_style			= get_option( "cat_text_heading_style$cat_id") ? get_option( "cat_text_heading_style$cat_id"):'';
			$cat_text_heading_icon			= get_option( "cat_text_heading_icon$cat_id") ? get_option( "cat_text_heading_icon$cat_id"):'';
			$cat_heading_sub_text			= get_option( "cat_heading_sub_text$cat_id") ? get_option( "cat_heading_sub_text$cat_id"):'';
			$cat_header_background 			= get_option( "cat_header_background$cat_id") ? get_option( "cat_header_background$cat_id"):'';
			$cat_header_background_color	= get_option( "cat_header_background_color$cat_id") ? get_option( "cat_header_background_color$cat_id"):'';
			if($cat_header_background_color){$cat_header_background_color 	= '#'.$cat_header_background_color;}
		
			if( $cat_text_heading_style != '' && $cat_text_heading_style != 'default'){	$archives_text_heading_style = $cat_text_heading_style;	}
			if( $cat_text_heading_icon 	!= ''){	$archives_heading_icon 			= $cat_text_heading_icon;	}
			if( $cat_heading_sub_text 	!= ''){	$archives_heading_sub_text 		= $cat_heading_sub_text;	}
			if( $cat_header_background 	!= ''){	$archives_header_background 	= $cat_header_background;	}
			if( $cat_header_background_color != ''){ $archives_header_bg_color = $cat_header_background_color;	}		
		}
		
		if($archives_text_heading_style != '' && $archives_text_heading_style != 'default'){
			$page_heading_style = $archives_text_heading_style;
		}
		if($archives_heading_icon != ''){
			$page_heading_icon = $archives_heading_icon;
		}
		if($archives_heading_sub_text != ''){
			$page_heading_sub_text = $archives_heading_sub_text;
		}
		if($archives_header_background != ''){
			$page_header_background = $archives_header_background;
		}else{
			$page_header_background = '';		
		}
		if( $archives_header_bg_color != '' ){
			$page_header_color = $archives_header_bg_color;
		}
			
	}else if(is_single()){
		$post_meta_text_heading_style 	= get_post_meta(get_the_ID(),'post_meta_text_heading_style', true );
		$post_meta_heading_icon 		= get_post_meta(get_the_ID(),'post_meta_heading_icon', true );
		$post_meta_heading_sub_text 	= get_post_meta(get_the_ID(),'post_meta_heading_sub_text', true );
		$post_meta_header_bg_group		= get_post_meta(get_the_ID(),'post_meta_header_background', true );
		$post_meta_header_background 	= isset($post_meta_header_bg_group['background-image']) ? $post_meta_header_bg_group['background-image'] : '';
		$post_meta_header_color		 	= isset($post_meta_header_bg_group['background-color']) ? $post_meta_header_bg_group['background-color'] : '';
	
	
		$post_text_heading_style 	= ot_get_option('post_text_heading_style', 'simple');
		$post_heading_icon 			= ot_get_option('post_heading_icon');
		$post_heading_sub_text 		= ot_get_option('post_heading_sub_text');
		$post_header_background 	= '';
		$post_header_bg_group	 	= ot_get_option('post_header_background');
		$post_header_background 	= isset($post_header_bg_group['background-image']) ? $post_header_bg_group['background-image'] : '';
		$post_header_color 			= isset($post_header_bg_group['background-color']) ? $post_header_bg_group['background-color'] : '';
		
	/* Overwirte options in Theme Option > Single Post with Post Metadata*/
		if($post_meta_text_heading_style != '' && $post_meta_text_heading_style != 'default'){
			$post_text_heading_style = $post_meta_text_heading_style;
		}
		if($post_meta_heading_icon != ''){
			$post_heading_icon = $post_meta_heading_icon;
		}
		if($post_meta_heading_sub_text != ''){
			$post_heading_sub_text = $post_meta_heading_sub_text;
		}
		if($post_meta_header_background != ''){
			$post_header_background = $post_meta_header_background;
		}else{
			$page_header_background = '';
		}
		if($post_meta_header_color != ''){
			$post_header_color = $post_meta_header_color;
		}
		if( $post_header_color != '' ){
			$page_header_color = $post_header_color;
		}else{
			$page_header_color = '';
		}
	/* Overwirte options in Theme Option with Post Metadata*/
	
	/* Overwirte options in Theme Option > Single Page with Theme Option > Single Post */	
		if($post_text_heading_style != '' && $post_text_heading_style != 'default'){
			$page_heading_style = $post_text_heading_style;
		}
		if($post_heading_icon != ''){
			$page_heading_icon = $post_heading_icon;
		}else{
			$page_heading_icon = '';
		}
		if($post_heading_sub_text != ''){
			$page_heading_sub_text = $post_heading_sub_text;
		}else{
			$page_heading_sub_text = '';
		}
		if($post_header_background != ''){
			$page_header_background = $post_header_background;
		}
	/* Overwirte options in Theme Option > Single Page with Theme Option > Single Post */			
	
	}else{
		$template_404 = ot_get_option('404_page');
		$page_meta_heading_icon = '';
		$page_meta_heading_sub_text  = '';
		$page_meta_header_background = '';
		$page_meta_header_color  = '';
		if(is_404() && (isset($template_404)) && ($template_404 != '')){
			$page_meta_text_heading_style 	= get_post_meta($template_404,'page_meta_text_heading_style', true );
			$page_meta_heading_icon 		= get_post_meta($template_404,'page_meta_heading_icon', true );
			$page_meta_heading_sub_text 	= get_post_meta($template_404,'page_meta_heading_sub_text', true );
			$page_meta_header_bg_group	 	= get_post_meta($template_404,'page_meta_header_background', true );
			$page_meta_header_background	= isset($page_meta_header_bg_group['background-image']) ? $page_meta_header_bg_group['background-image'] : '';
			$page_meta_header_color			= isset($page_meta_header_bg_group['background-color']) ? $page_meta_header_bg_group['background-color'] : '';
		}else if(is_page() || is_front_page()){
			$page_meta_text_heading_style 	= get_post_meta(get_the_ID(),'page_meta_text_heading_style', true );
			$page_meta_heading_icon 		= get_post_meta(get_the_ID(),'page_meta_heading_icon', true );
			$page_meta_heading_sub_text 	= get_post_meta(get_the_ID(),'page_meta_heading_sub_text', true );
			$page_meta_header_bg_group	 	= get_post_meta(get_the_ID(),'page_meta_header_background', true );
			$page_meta_header_background	= isset($page_meta_header_bg_group['background-image']) ? $page_meta_header_bg_group['background-image'] : '';
			$page_meta_header_color			= isset($page_meta_header_bg_group['background-color']) ? $page_meta_header_bg_group['background-color'] : '';		
		}
		if($page_meta_text_heading_style != '' && $page_meta_text_heading_style != 'default'){
			$page_heading_style = $page_meta_text_heading_style;
		}
		if($page_meta_heading_icon != ''){
			$page_heading_icon = $page_meta_heading_icon;
		}
		if($page_meta_heading_sub_text != ''){
			$page_heading_sub_text = $page_meta_heading_sub_text;
		}
		if($page_meta_header_background != ''){
			$page_header_background = $page_meta_header_background;
		}else{
			$page_header_background = $page_header_background;	
		}
		if($page_meta_header_color != ''){
			$page_header_color = $page_meta_header_color;
		}
	}
	$ct_hd_meta['page_meta_text_heading_style'] = $page_meta_text_heading_style;
	$ct_hd_meta['page_heading_style'] = $page_heading_style;
	$ct_hd_meta['page_heading_icon'] = $page_heading_icon;
	$ct_hd_meta['page_heading_sub_text'] = $page_heading_sub_text;
	$ct_hd_meta['page_header_background'] = $page_header_background;
	$ct_hd_meta['page_header_color'] = $page_header_color;

	return $ct_hd_meta;
}

if(!function_exists('businesshub_alter_comment_form_fields')){
	function businesshub_alter_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$fields['author']='<input id="author" name="author" type="text" placeholder="'.($req ? '' : '').esc_html__('YOUR NAME *','cactus').'" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . '>';
		$fields['email']='<input id="email" placeholder="'.($req ? '' : '').esc_html__('YOUR EMAIL *','cactus').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . '>';
		$fields['url']='<input id="url" placeholder="'.esc_html__('YOUR WEBSITE','cactus').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />';
		
		return $fields;
	}
	add_filter('comment_form_default_fields','businesshub_alter_comment_form_fields');
}
if(!function_exists('bizhub_loop_shop_columns')){
	add_filter( 'loop_shop_columns', 'bizhub_loop_shop_columns', 1, 10 );
	/*
	* Return a new number of maximum columns for shop archives
	* @param int Original value
	* @return int New number of columns
	*/
	function bizhub_loop_shop_columns( $number_columns ) {
		return 3;
	}
}
if(!function_exists('bizhub_related_products_args')){
	add_filter( 'woocommerce_output_related_products_args', 'bizhub_related_products_args' );
	  function bizhub_related_products_args( $args ) {
		$args['posts_per_page'] = 3; // 3 related products
		$args['columns'] = 3; // arranged in 3 columns
		return $args;
	}
}