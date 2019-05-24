<?php
function businesshub_admin_scripts() {
	wp_register_script('admin_template', esc_url(get_template_directory_uri().'/admin/assets/js/admin_template.js'), array('jquery'));
	wp_enqueue_script('admin_template');
}

function businesshub_admin_styles() {
	wp_enqueue_style( 'style-admin', esc_url(get_template_directory_uri().'/admin/assets/css/style.css'));
}
if(is_admin()){
	add_action('admin_enqueue_scripts', 'businesshub_admin_scripts');
	add_action('admin_enqueue_scripts', 'businesshub_admin_styles');
}
// login logo
function businesshub_login_logo() {
	if($img = ot_get_option('login_logo_image')){
	?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo esc_attr($img); ?>);
			width: 320px;
			height: 120px;
			background-size:auto;
			background-position:center;
        }
    </style>
<?php }
}
add_action( 'login_enqueue_scripts', 'businesshub_login_logo' );