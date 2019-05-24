<?php

/**
 * Core features for all themes
 *
 * @package cactus
 * @version 1.0 - 2014/13/05
 */

/**
 * Mobile Detector 
 *
 */
require get_template_directory() . '/inc/core/classes/mobile-detect.php'; 
require_once get_template_directory() . '/inc/classes/class.content-html.php';
require_once get_template_directory() . '/inc/custom-menu-walker.php';
require_once get_template_directory() . '/inc/custom-side-menu-walker.php';
$mobile_detector = new Mobile_Detect;

/**
 * plugin-activation
 */
require_once get_template_directory() . '/inc/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'businesshub_acplugins' );
function businesshub_acplugins($plugins) {

	global $_theme_required_plugins;

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'cactus',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required &amp; Recommended Plugins', 'cactus' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'cactus' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'cactus' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'cactus' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'cactus' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'cactus' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'cactus' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'cactus' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'cactus'), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'cactus'), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'cactus'), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'cactus'), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'cactus'),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'cactus' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'cactus' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'cactus' ),
            'complete'                                  => wp_kses(__( 'All plugins installed and activated successfully. %s', 'cactus' ),array('a'=>array('href'=>array(),'title'=>array(),'rel'=>array()))) // %1$s = dashboard link
        )
    );

    tgmpa( $_theme_required_plugins, $config);
}

/**
 * Option Tree integration
 */
 
 /**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/** 
 * end Option Tree integration 
 * To get options, use this code
 * $test_input = ot_get_option( 'test_input', 'default value');
 * $test_array = ot_get_option( 'test_array', array('value 1','value 2')); or 
 * $test_array = ot_get_option( 'test_array', array());
 */

require get_template_directory() . '/inc/core/utility-functions.php'; 

/* Enable oEmbed in Text/HTML Widgets */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );


/* Add Custom Variation field to all widgets */
$wl_cl_options = businesshub_get_global_wl_cl_options();
if((!$wl_cl_options = get_option('cactusthemes')) || !is_array($wl_cl_options) ) $wl_cl_options = array();

add_action( 'sidebar_admin_setup', 'businesshub_expand_control');
// adds in the admin control per widget, but also processes import/export
function businesshub_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_cl_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'businesshub_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='businesshub_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-cactusthemes']))
				$wl_cl_options[$widget_id]=trim($_POST[$widget_id.'-cactusthemes']);
	}
	
	update_option('cactusthemes', $wl_cl_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function businesshub_empty_control() {}

function businesshub_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_cl_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';
	//var_dump(get_option('cactusthemes'));
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-cactusthemes'>".__('Custom Variation', 'cactusthemes').": <input class='widefat' type='text' name='".$id_disp."-cactusthemes' id='".$id_disp."-cactusthemes' value='".$value."' /></label></p>";
}
/*------------ Add Custom color field to all widgets -----------------*/
$wl_color_options = businesshub_get_global_wl_color_options();
if((!$wl_color_options = get_option('ct_color')) || !is_array($wl_color_options) ) $wl_color_options = array();

add_action( 'sidebar_admin_setup', 'businesshub_color_expand_control');
// adds in the admin control per widget, but also processes import/export
function businesshub_color_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_color_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'businesshub_color_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_color_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='businesshub_color_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_color']))
				$wl_color_options[$widget_id]=trim($_POST[$widget_id.'-ct_color']);
	}
	
	update_option('ct_color', $wl_color_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function businesshub_color_empty_control() {}

function businesshub_color_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_color_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_color_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_color_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_color_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_color'>".esc_html__('Color Of Title', 'cactus').": <input class='color {required:false}' type='text' name='".$id_disp."-ct_color' id='".$id_disp."-ct_color' value='".$value."' />
	<script type='text/javascript'>
	if (typeof jscolor === 'function') { 
		var ct_color = new jscolor.color(document.getElementById('".$id_disp."-ct_color'), {required:false});
	}
	</script>
	</label></p>";
}
/*------------ Add Custom color field to all widgets -----------------*/
/*------------ Add Custom background color field to all widgets -----------------*/
$wl_bgcolor_options = businesshub_get_global_wl_bgcolor_options();
if((!$wl_bgcolor_options = get_option('ct_bgcolor')) || !is_array($wl_bgcolor_options) ) $wl_bgcolor_options = array();

add_action( 'sidebar_admin_setup', 'businesshub_bgcolor_expand_control');
// adds in the admin control per widget, but also processes import/export
function businesshub_bgcolor_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_bgcolor_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'businesshub_bgcolor_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_bgcolor_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='businesshub_bgcolor_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_bgcolor']))
				$wl_bgcolor_options[$widget_id]=trim($_POST[$widget_id.'-ct_bgcolor']);
	}
	
	update_option('ct_bgcolor', $wl_bgcolor_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function businesshub_bgcolor_empty_control() {}

function businesshub_bgcolor_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_bgcolor_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_bgcolor_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_bgcolor_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_bgcolor_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_bgcolor'>".esc_html__('Background Color', 'cactus').": <input class='color {required:false} ' type='text' name='".$id_disp."-ct_bgcolor' id='".$id_disp."-ct_bgcolor' value='".$value."' />
	<script type='text/javascript'>
	if (typeof jscolor === 'function') { 
		var ct_bgcolor = new jscolor.color(document.getElementById('".$id_disp."-ct_bgcolor'), {required:false});
	}
	</script>
	</label></p>";
}
/*------------ Add Custom bgcolor field to all widgets -----------------*/
/*------------ Add Custom Separator Color field to all widgets -----------------*/
$wl_sepcolor_options = businesshub_get_global_wl_sepcolor_options();
if((!$wl_sepcolor_options = get_option('ct_sepcolor')) || !is_array($wl_sepcolor_options) ) $wl_sepcolor_options = array();

add_action( 'sidebar_admin_setup', 'businesshub_sepcolor_expand_control');
// adds in the admin control per widget, but also processes import/export
function businesshub_sepcolor_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_sepcolor_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'businesshub_sepcolor_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_sepcolor_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='businesshub_sepcolor_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_sepcolor']))
				$wl_sepcolor_options[$widget_id]=trim($_POST[$widget_id.'-ct_sepcolor']);
	}
	
	update_option('ct_sepcolor', $wl_sepcolor_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function businesshub_sepcolor_empty_control() {}

function businesshub_sepcolor_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_sepcolor_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_sepcolor_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_sepcolor_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_sepcolor_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_sepcolor'>".esc_html__('Separator Color', 'cactus').": <input class='color {required:false} ' type='text' name='".$id_disp."-ct_sepcolor' id='".$id_disp."-ct_sepcolor' value='".$value."' />
	<script type='text/javascript'>
	if (typeof jscolor === 'function') { 
		var ct_sepcolor = new jscolor.color(document.getElementById('".$id_disp."-ct_sepcolor'), {required:false});
	}
	</script>
	</label></p>";
}
/*------------ Add Custom Separator field to all widgets -----------------*/
/*------------ Add Custom text Color field to all widgets -----------------*/
$wl_textcolor_options = businesshub_get_global_wl_textcolor_options();
if((!$wl_textcolor_options = get_option('ct_textcolor')) || !is_array($wl_textcolor_options) ) $wl_textcolor_options = array();

add_action( 'sidebar_admin_setup', 'businesshub_textcolor_expand_control');
// adds in the admin control per widget, but also processes import/export
function businesshub_textcolor_expand_control(){
	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_textcolor_options;
	
	// ADD EXTRA CUSTOM FIELDS TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'businesshub_textcolor_empty_control');
		
		$wp_registered_widget_controls[$id]['callback_ct_textcolor_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='businesshub_textcolor_widget_add_custom_fields';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}
	
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-ct_textcolor']))
				$wl_textcolor_options[$widget_id]=trim($_POST[$widget_id.'-ct_textcolor']);
	}
	
	update_option('ct_textcolor', $wl_textcolor_options);
}

/* Empty function for callback - DO NOT DELETE!!! */
function businesshub_textcolor_empty_control() {}

function businesshub_textcolor_widget_add_custom_fields() {
	global $wp_registered_widget_controls, $wl_textcolor_options;

	$params=func_get_args();
	
	$id=array_pop($params);
	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_ct_textcolor_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);	
	$value = !empty( $wl_textcolor_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_textcolor_options[$id ] ),ENT_QUOTES ) : '';
	
	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	
	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-ct_textcolor'>".esc_html__('Text Color', 'cactus').": <input class='color {required:false} ' type='text' name='".$id_disp."-ct_textcolor' id='".$id_disp."-ct_textcolor' value='".$value."' />
	<script type='text/javascript'>
	if (typeof jscolor === 'function') { 
		var ct_sepcolor = new jscolor.color(document.getElementById('".$id_disp."-ct_textcolor'), {required:false});
	}
	</script>
	</label></p>";
}
/*------------ Add Custom text color field to all widgets -----------------*/

/*------------ Add Custom Column field to all widgets in Footer Sidebar -----------------*/
$wl_options_width = businesshub_get_global_wl_options_width();
if((!$wl_options_width = get_option('cactusthemes_width')) || !is_array($wl_options_width) ) $wl_options_width = array();

if ( is_admin() )
{
    add_action( 'sidebar_admin_setup', 'businesshub_widget_width_expand_control' );
}

// CALLED VIA 'sidebar_admin_setup' ACTION
// adds in the admin control per widget, but also processes import/export
function businesshub_widget_width_expand_control()
{
    global $wp_registered_widgets, $wp_registered_widget_controls, $wl_options_width;

    // ADD EXTRA WIDGET LOGIC FIELD TO EACH WIDGET CONTROL
    // pop the widget id on the params array (as it's not in the main params so not provided to the callback)
    foreach ( $wp_registered_widgets as $id => $widget )
    {   // controll-less widgets need an empty function so the callback function is called.
        if (!$wp_registered_widget_controls[$id])
            wp_register_widget_control($id,$widget['name'], 'businesshub_widget_width_empty_control');
        $wp_registered_widget_controls[$id]['callback_width_redirect'] = $wp_registered_widget_controls[$id]['callback'];
        $wp_registered_widget_controls[$id]['callback'] = 'businesshub_widget_width_extra_control';
        array_push( $wp_registered_widget_controls[$id]['params'], $id );
    }
	// UPDATE CUSTOM FIELDS OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-cactusthemes_width']))
				$wl_options_width[$widget_id]=trim($_POST[$widget_id.'-cactusthemes_width']);
	}

	update_option('cactusthemes_width', $wl_options_width);
}

// added to widget functionality in 'businesshub_widget_width_expand_control' (above)
function businesshub_widget_width_empty_control() {}

// added to widget functionality in 'businesshub_widget_width_expand_control' (above)
function businesshub_widget_width_extra_control()
{
    global $wp_registered_widget_controls, $wl_options_width;

    $params = func_get_args();
    $id = array_pop($params);

    // go to the original control function
    $callback = $wp_registered_widget_controls[$id]['callback_width_redirect'];
    if ( is_callable($callback) )
        call_user_func_array($callback, $params);

    $value = !empty( $wl_options_width[$id] ) ? htmlspecialchars( stripslashes( $wl_options_width[$id ] ),ENT_QUOTES ) : '';

    // dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	if(isset($params[0]['number']))
		$number = $params[0]['number'];
    if ($number == -1) {
        $number = "%i%";
        $value = "";
    }
    $id_disp=$id;
    if ( isset($number) )
        $id_disp = $wp_registered_widget_controls[$id]['id_base'].'-'.$number;
    // output our extra widget logic field
    echo "
	<p class='uni-footer-width' id='uni-".$id_disp."'><label for='".$id_disp."-cactusthemes_width'>".esc_html__('Widget width', 'cactus').":
	<select name='".$id_disp."-cactusthemes_width' id='".$id_disp."-cactusthemes_width'>
	  <option value='col-md-12' ".($value=='col-md-12'?'selected="selected"':'').">col-md-12</option>
	  <option value='col-md-11' ".($value=='col-md-11'?'selected="selected"':'').">col-md-11</option>
	  <option value='col-md-10' ".($value=='col-md-10'?'selected="selected"':'').">col-md-10</option>
	  <option value='col-md-9' ".($value=='col-md-9'?'selected="selected"':'').">col-md-9</option>
	  <option value='col-md-8' ".($value=='col-md-8'?'selected="selected"':'').">col-md-8</option>
	  <option value='col-md-7' ".($value=='col-md-7'?'selected="selected"':'').">col-md-7</option>
	  <option value='col-md-6' ".($value=='col-md-6'?'selected="selected"':'').">col-md-6</option>
	  <option value='col-md-5' ".($value=='col-md-5'?'selected="selected"':'').">col-md-5</option>
	  <option value='col-md-4' ".($value=='col-md-4'?'selected="selected"':'').">col-md-4</option>
	  <option value='col-md-3' ".($value=='col-md-3'?'selected="selected"':'').">col-md-3</option>
	  <option value='col-md-2' ".($value=='col-md-2'?'selected="selected"':'').">col-md-2</option>
	  <option value='col-md-1' ".($value=='col-md-1'?'selected="selected"':'').">col-md-1</option>
	</select>
	</label></p>";
}

/**
 * Hook before widget
 */
	add_filter('dynamic_sidebar_params', 'businesshub_hook_before_width_widget');
	function businesshub_hook_before_width_widget($params){
		/* Add custom variation classs to widgets */
		global $wl_options_width;
		$id=$params[0]['widget_id'];
		$classe_to_add = !empty( $wl_options_width[$id ] ) ? htmlspecialchars( stripslashes( $wl_options_width[$id ] ),ENT_QUOTES ) : '';

		if(preg_match('/icon-\w+\s*/',$classe_to_add,$matches)){
			if(ot_get_option_core( 'righttoleft', 0)){
				$params[0]['after_title'] = '<i class="'.$matches[0].'"></i>' . $params[0]['after_title'];
			} else {
				$params[0]['before_title'] .= '<i class="'.$matches[0].'"></i>';
			}
			$classe_to_add = str_replace('icon-','wicon-',$classe_to_add); // replace "icon-xxx" class to not add Awesome Icon before div.widget
		};

		if ($params[0]['before_widget'] != ""){
			if($classe_to_add ==''){
				global $wid_def;
				if($wid_def==1){
					$classe_to_add ='col-md-4';
				}else{
					$classe_to_add ='col-md-12';
				}
			}
			$classe_to_add = 'class="'.$classe_to_add.' ';
			//$params[0]['before_widget'] = str_replace('class="',$classe_to_add,$params[0]['before_widget']);
			$params[0]['before_widget'] = implode($classe_to_add, explode('class="', $params[0]['before_widget'], 2)); //replace only 1st class="
		}else{
			$classe_to_add = $classe_to_add;
			$params[0]['before_widget'] = '<div class="'.$classe_to_add.'">';
			$params[0]['after_widget'] = '</div>';
		}

		return $params;
	}
	
	function businesshub_get_default_widgets_flag($val){
		global $wid_def;
		
		$wid_def = $val;
	}
/*------------ Add Custom Column field to all widgets in Footer Sidebar -----------------*/

/**
 * Hook before widget 
 */
if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'businesshub_hook_before_widget'); 	
	function businesshub_hook_before_widget($params){
		/* Add custom variation classs to widgets */
		global $wl_cl_options;
		global $wl_bgcolor_options;
		global $wl_color_options;
		global $wl_sepcolor_options;
		global $wl_textcolor_options;
		$id=$params[0]['widget_id'];
		$classe_to_add = !empty( $wl_cl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_cl_options[$id ] ),ENT_QUOTES ) : '';
		if(!empty( $wl_bgcolor_options[$id ])){$classe_to_add .= " widget-box-style-1 ";}
		
		if ($params[0]['before_widget'] != ""){  
			$classe_to_add = 'class="'.$classe_to_add.' ';
			$params[0]['before_widget'] = implode($classe_to_add, explode('class="', $params[0]['before_widget'], 2));
		}else{
			$classe_to_add = $classe_to_add;
			$params[0]['before_widget'] = '<div class="'.$classe_to_add.'">';
			$params[0]['after_widget'] = '</div>';
		}
		if(!empty( $wl_color_options[$id ] ) || !empty( $wl_bgcolor_options[$id ] ) || !empty( $wl_textcolor_options[$id ] ) || !empty( $wl_sepcolor_options[$id ] )){
			if(!empty( $wl_color_options[$id ] )){ $wl_color_options[$id ] = 'color:#'.$wl_color_options[$id ].' !important;';}
			$bd_cl = '';
			if(!empty( $wl_sepcolor_options[$id ] )){ 
				$bd_cl = 'border-color:#'.$wl_sepcolor_options[$id ].' !important;';
				$wl_sepcolor_options[$id ] = 'background-color:#'.$wl_sepcolor_options[$id ].' !important;';
			}
			if(!empty( $wl_textcolor_options[$id ] )){ $wl_textcolor_options[$id ] = 'color:#'.$wl_textcolor_options[$id ].';';}
			
			if(strrpos($params[0]['before_widget'], 'widget-inner')){
                $params[0]['before_widget'] = 
                str_replace('<div class="widget-inner">', '', $params[0]['before_widget']).'
                <style type="text/css" scoped>
                    #'.$id.' .widget-inner{'.$wl_textcolor_options[$id ].'}
                    #'.$id.' .widget-title{'.$wl_color_options[$id ].' '.$bd_cl.'}
                    #'.$id.' .widget-title:after{'.$wl_sepcolor_options[$id ].'}
                    #'.$id.'.widget{background:#'.$wl_bgcolor_options[$id ].' !important}
                </style>' . '<div class="widget-inner">';
            } else {
                $params[0]['before_widget'] = '
                <style type="text/css" scoped>
                    #'.$id.' .widget-inner{'.$wl_textcolor_options[$id ].'}
                    #'.$id.' .widget-title{'.$wl_color_options[$id ].' '.$bd_cl.'}
                    #'.$id.' .widget-title:after{'.$wl_sepcolor_options[$id ].'}
                    #'.$id.'.widget{background:#'.$wl_bgcolor_options[$id ].' !important}
                </style>' . $params[0]['before_widget'];
            }
		}
		return $params;
	}
}

//cactus thumbnails
function businesshub_inline_script() {
?>
<script>
<?php // these JS are inline to make sure images are loaded as soon as possible ?>
	/*! Lazy Load 1.9.7 - MIT license - Copyright 2010-2015 Mika Tuupola */
	!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);

	function businesshub_hasClass(element, cls) {
		return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
	}
	var checkLazyLoadEnable = businesshub_hasClass(document.getElementById('body-wrap'), 'enable-lazy-load'); // check lazy load mode
	
	function getDevicePixelRatio(){
		if(window.screen.logicalXDPI){
			return window.screen.logicalXDPI / 96; // IE
		} else if(window.devicePixelRatio){
			return window.devicePixelRatio;
		} else return 1;
	}
	
	function getImageVersion() {
		var devicePixelRatio = getDevicePixelRatio();
		var width = window.innerWidth * devicePixelRatio;
		if (width > 2047 || devicePixelRatio > 1) { // check ratio
					return "x-high";
		} else if (width > 991) {
					return "high";
		} else if (width > 767) {
					return "medium";
		} else {
			return "small"; // default version
		}
	}
	
	function loadAdaptiveImage(imageContainer) {
		
		var imageVersion = getImageVersion();
		
		if (!imageContainer || !imageContainer.children) {
			return;
		}
		var img = imageContainer.children[0];
		
		if (img) {
			var imgSRC = img.getAttribute("data-src-" + imageVersion);
			var imgWidth = img.getAttribute("data-width");
			var imgHeight = img.getAttribute("data-height");
			var altTxt = img.getAttribute("data-alt");
			
			var imgPlaceholder = '<?php echo get_template_directory_uri().'/images/placeholder-img.png';?>';
			if(parseInt(imgWidth) / parseInt(imgHeight) != 1) {
				imgPlaceholder = '<?php echo get_template_directory_uri().'/images/placeholder-img-3x2.png';?>';
			}
			if (imgSRC) {
				var newImg='<img src="'+(checkLazyLoadEnable?imgPlaceholder:imgSRC)+'" alt="'+(altTxt?altTxt:'')+'"	width="'+(imgWidth)+'" height="'+(imgHeight)+'" class="'+(checkLazyLoadEnable?'cactus-lazy':'')+'" data-original="'+(imgSRC)+'">';				
				imageContainer.innerHTML=newImg;			
			}
		}
	}
	
	lazyLoadedImages = document.getElementsByClassName("adaptive");
	
	;(function($){		
		for (var i = 0; i < lazyLoadedImages.length; i++) {
			loadAdaptiveImage(lazyLoadedImages[i]);
		};		
		if(checkLazyLoadEnable){
			$('.cactus-sidebar img.cactus-lazy, .ct-post-gallery img.cactus-lazy').each(function(index, element) {
                $(this).attr('src',$(this).attr('data-original')).css({'display':'block'}).removeAttr('data-original');
            });
			$("img.cactus-lazy").lazyload({
				effect	:'fadeIn',
				effectspeed:100,
			}).addClass('ct-done');
		};		
	}(jQuery));
</script>
<?php
}
add_action( 'wp_footer', 'businesshub_inline_script' );
/**
 * Add Thumbnail Sizes
 */
add_action( 'businesshub_reg_thumbnail', 'businesshub_reg_thumbnail_function', 1, 1 );
if(!function_exists('businesshub_reg_thumbnail_function')){
	function businesshub_reg_thumbnail_function($size_array){
		if(is_array($size_array) && count($size_array)){
			foreach($size_array as $size => $att){
				add_image_size( $size, $att[0], $att[1], $att[2] );
			}
		}
	}
}

/** 
 * Get Thumbnail Image
 *
 */
if(!function_exists('businesshub_thumbnail')){
	function businesshub_thumbnail($post_id = -1, $size = 'thumbnail'){
		$thumbnail = array();
		//check post
		global $post;
		if($post_id == -1){ //if there is no ID
			$post_id = get_the_ID();
		}elseif( is_string($post_id) && !is_numeric($post_id) ){ //if it's only thumbnail size
			$size = $post_id;
			$post_id = get_the_ID();
		}
		//get attachment id
		if(get_post_type($post_id)=='attachment'){
			$attachment_id = $post_id;
		}else{
			$attachment_id = get_post_thumbnail_id($post_id);
		}
		//process size
		$size = apply_filters( 'businesshub_thumbnail_size', $size );
		//get image
		$thumbnail = wp_get_attachment_image_src( $attachment_id, $size );
		
		//return
		if(is_array($size) && count($size) == 4){
			$small =  wp_get_attachment_image_src($attachment_id, $size[0]);$def_w = $small[1]; $def_h = $small[2];$small = $small[0];
			$medium = wp_get_attachment_image_src($attachment_id, $size[1]);$medium = $medium[0];
			$high = wp_get_attachment_image_src($attachment_id, $size[2]);$high_w = $high[1]; $high_h = $high[2];$high = $high[0];
			$xhigh = wp_get_attachment_image_src($attachment_id, $size[3]);$xhigh = $xhigh[0];
			
			$place_holder_img = get_template_directory_uri().'/images/placeholder-img.png';
			if(isset($high_w) && isset($high_h) && ($high_w / $high_h != 1)) {
				$place_holder_img = get_template_directory_uri().'/images/placeholder-img-3x2.png';
			}
			
			$html = '	<div class="adaptive">
							<noscript 
								data-src-small="'.$small.'" 
								data-src-medium="'.$medium.'" 
								data-src-high="'.$high.'" 
								data-src-x-high="'.$xhigh.'"
								data-width="'.$high_w.'" 
								data-height="'.$high_h.'"
								data-alt="'.esc_attr(get_the_title($attachment_id)).'"
							>
							</noscript>
							<img src="'.esc_attr($place_holder_img).'" alt="" width="'.esc_attr($def_w).'" height="'.esc_attr($def_h).'">				
						</div>';
						
			return $html;
		} else {
			return wp_get_attachment_image($attachment_id, $size);
		}
	}
}

/**
 * Filter thumbnail size
 *
 **/
add_filter('businesshub_thumbnail_size', 'businesshub_thumbnail_size', 10, 1);
function businesshub_thumbnail_size($size){
	//thumbnail size
	if(!is_array($size)){
		global $businesshub_size_array;
		if( isset($businesshub_size_array[$size][3]) && $businesshub_size_array[$size][3] ){
			$size = $businesshub_size_array[$size][3];
		}
	}
	return $size;
}