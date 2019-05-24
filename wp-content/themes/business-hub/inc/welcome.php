<?php
/**
 * cactus theme sample theme options file. This file is generated from Export feature in Option Tree.
 *
 * @package cactus
 */

//hook and redirect
function businesshub_activation($oldname, $oldtheme=false) {
	wp_redirect(admin_url().'themes.php?page=cactus-welcome');
}
add_action('after_switch_theme', 'businesshub_activation', 10 ,  2); 

//welcome menu
add_action('admin_menu', 'businesshub_welcome_menu');
function businesshub_welcome_menu() {
	add_theme_page(esc_html__('Welcome','cactus'), esc_html__('Business-Hub','cactus'), 'edit_theme_options', 'cactus-welcome', 'businesshub_welcome_function');
}

//welcome page
function businesshub_welcome_function(){
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fonts/awesome/css/font-awesome.min.css', array(), '4.3.0');
    $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome';
    ?>
    <div class="wrap">
        <?php
		businesshub_welcome_tabs();
		businesshub_welcome_tab_content( $tab );
		?>
    </div>
    <?php
}

//tabs
function businesshub_welcome_tabs() {
    $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome';
	$businesshub_welcome_tabs = array(
		'welcome' => '<span class="dashicons dashicons-smiley"></span> '.esc_html__('Welcome','cactus'),
		'document' => '<span class="dashicons dashicons-format-aside"></span> '.esc_html__('Document','cactus'),
		'sample' => '<span class="dashicons dashicons-download"></span> '.esc_html__('Sample Data','cactus'),
		'support' => '<span class="dashicons dashicons-businessman"></span> '.esc_html__('Support','cactus'),
	);
	
	echo '<h1></h1>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $businesshub_welcome_tabs as $tab_key => $tab_caption ) {
        $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
        echo '<a class="nav-tab ' . $active . '" href="?page=cactus-welcome&tab=' . $tab_key . '">' . $tab_caption . '</a>';
    }
    echo '</h2>';
}
function businesshub_welcome_tab_content( $tab ){
	if($tab=='document'){ ?>
    	<p>You could view <a class="button button-primary button-large" href="http://business-hub.cactusthemes.com/document/" target="_blank">Full Document</a> in new window</p>
		<iframe src="http://business-hub.cactusthemes.com/document/" width="100%" height="700" style="background:#fff;"></iframe>
        
    <?php }elseif($tab=='sample'){ ?> 
    	<?php businesshub_import_sample_data_page_callback() ?>
        
    <?php }elseif($tab=='support'){ ?> 
    	<p>You could open <a class="button button-primary button-large" href="http://ticket.cactusthemes.com/" target="_blank">Support Ticket</a> in new window</p>
    	<iframe src="http://ticket.cactusthemes.com/" width="100%" height="700" style="background:#fff;"></iframe>
        
	<?php }else{ ?>
		<div class="cactus-welcome-message">
			<h2 class="cactus-welcome-title"><?php esc_html_e('Welcome to Business-Hub','cactus');?></h2>
            <div class="cactus-welcome-inner">
            	<a class="cactus-welcome-item" href="http://business-hub.cactusthemes.com/document/quickstart.html" target="_blank">
                	<i class="fa fa-file-text"></i>
                    <h3><?php echo esc_html('Quick Start Guide','cactus'); ?></h3>
                    <p><?php echo esc_html('Save your time with Business-Hub quick start document','cactus'); ?></p>
                </a>
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=document">
                	<i class="fa fa-book"></i>
                    <h3><?php echo esc_html('Full Document','cactus'); ?></h3>
                    <p><?php echo esc_html('See the full user guide for all NewsTube functions','cactus'); ?></p>
                </a>
                <br />
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=sample">
                	<i class="fa fa-download"></i>
                    <h3><?php echo esc_html('Sample Data','cactus'); ?></h3>
                    <p><?php echo esc_html('Import sample data to have homepage like our live DEMO','cactus'); ?></p>
                </a>
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=support">
                	<i class="fa fa-user"></i>
                    <h3><?php echo esc_html('Support','cactus'); ?></h3>
                    <p><?php echo esc_html('Need support using the theme? We are here for you.','cactus'); ?></p>
                </a>
                <div class="cactus-welcome-item cactus-welcome-item-wide cactus-welcome-changelog">
                	<iframe src="http://business-hub.cactusthemes.com/release_logs.html" width="780px" height="500px"></iframe>
                </div>
            </div>
		</div>
	<?php }
}


//old import sample data
add_action( 'admin_notices', 'businesshub_print_current_version_msg' );
function businesshub_print_current_version_msg()
{
	$current_theme = wp_get_theme(PARENT_THEME);
	$current_version =  $current_theme->get('Version');
	echo '<div style="display:none" id="current_version">' . $current_version . '</div>';
}

add_action( 'admin_footer', 'businesshub_import_sample_data_comfirm' );
function businesshub_import_sample_data_comfirm()
{
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#ct_support_forum').parent().attr('target','_blank');
        $('#ct_documentaion').parent().attr('target','_blank');
        $('#option-tree-sub-header').append('<span class="option-tree-ui-button left image"></span><span class="option-tree-ui-button left vesion ">ver. ' + $('#current_version').text() + '</span>');
    });
    </script>
    <?php
}


function businesshub_import_sample_data_page_callback()
{
	if ( !current_user_can( 'manage_options' ) )
	{
	    global $current_user;
	    $msg = "I'm sorry, " . $current_user->display_name . " I'm afraid I can't do that.";
	    echo '<div class="wrap">' . $msg . '</div>';
	    return false;
	}

	if(isset($_POST['is_submit_import_data_form']) && $_POST['is_submit_import_data_form'] == 'Y')
	{
	    $import_data_comfirm = $_POST['import_data_comfirm'];
		$option_only = isset($_POST['option_only'])?$_POST['option_only']:0;

	    if($import_data_comfirm == 'ok'){
			echo '<script type="text/javascript">';
			echo 'location.href = "'.site_url().'/wp-admin/themes.php?page=ot-theme-options&import_data=true&pack='.$_POST['pack'].'&option_only='.$option_only.'";';
			echo '</script>';
		} else {
			echo '<script type="text/javascript">';
			echo 'alert(\'' . esc_html__('Invalid confirmation word. Please type the word ok in the confirmation field','cactus') . '\');';
			echo '</script>';
		}
	} else {
		if ( current_user_can( 'manage_options' ) && isset($_GET['imported'])){ ?>
			<div class="updated business_sample_notice">
                <p><?php esc_html_e( 'Sample data imported!', 'cactus' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('View site','cactus'); ?></a></p>
            </div>
		<?php }

?>
		<div class="wrap">
			<h2><?php esc_html_e('Import Sample Data','cactus');?></h2>
		</div>
		<?php
		
		if(!is_plugin_active('bizhub-sampledata/bizhub-sampledata.php')){
			?>
			<p style="color:#ff0000"><?php esc_html_e('Please install Bizhub-SampleData plugin to use this feature','cactus');?></p>
			<?php
		} else {
		?>
			<p style="color:#ff0000"><?php esc_html_e('!!!Make sure you have installed all recommended plugins from WordPress repository (WordPress.org) and built-in plugins which come in the full package!!!','cactus');?></p>
			<h4><?php esc_html_e('Choose a Sample Data','cactus');?></h4>
			<form method="post" id="import_data_form">
				<input type="hidden" name="is_submit_import_data_form" value="Y">
				<input type="hidden" name="site_url" value="<?php echo esc_attr(site_url());?>">
				<?php 
				$demo_array = array(
					array(
						'name'=> 'pack',
						'value' => 'all',
						'label' => esc_html__('All data','cactus'),
						'img' => site_url().'/wp-content/plugins/bizhub-sampledata/thumbnail/home-v1.jpg',
					)
				);
				businesshub_welcome_image_radio($default = @$_GET['pack']?$_GET['pack']:'all',$demo_array);
				?>
				<h4><?php esc_html_e('Import Homepage Only','cactus');?></h4>
				<p><input type="checkbox" name="option_only" id="option_only" value="1" /> <?php esc_html_e('Check if you don\'t want to import all posts (only Homepage Demo Pages are created)','cactus'); ?></p>
				<h4><?php esc_html_e('Confirm Import','cactus');?></h4>
				<p><input type="text" value="" name="import_data_comfirm" id="import_data_comfirm"> <?php echo wp_kses(__('Type <strong>\'ok\'</strong> in the confirmation field and then click the import button','cactus'),array('strong'=>array()));?></p>
				
				<p class="submit">
					<input type="submit" value="Import" class="button-primary" name="Submit" style="width: 80px;" id="import_data_button">
				</p>
			</form>
		<?php
		}?>
<?php
	}
}

/*
 * build radio image select
 */
function businesshub_welcome_image_radio($option,$array){
?>
<span class="cactus-image-select">
	<?php foreach($array as $item){ ?>
    <input type="radio" name="<?php echo esc_attr($item['name']); ?>" id="<?php echo esc_attr($item['name']); ?>-<?php echo esc_attr($item['value']); ?>" value="<?php echo esc_attr($item['value']); ?>" <?php echo ($option==$item['value'])?'checked':'' ?> />
    <label for="<?php echo esc_attr($item['name']); ?>-<?php echo esc_attr($item['value']); ?>" class="<?php echo esc_attr(($option==$item['value'])?'selected':''); ?>" >
    	<?php if(@$item['img']){ ?>
        	<img src="<?php echo esc_attr($item['img']); ?>" />
		<?php }elseif(@$item['icon']){ ?>
        	<i class="<?php echo esc_attr($item['icon']) ?> icon-large"></i>
		<?php } ?>
		<br>
    	<b><?php echo esc_html($item['label']); ?></b>
    </label>
    <?php } ?>
</span>
<script>
jQuery(document).ready(function(e) {
	jQuery('.cactus-image-select input:radio').addClass('input_hidden');
	jQuery('.cactus-image-select label').click(function(){
		jQuery(this).addClass('selected').siblings().removeClass('selected');
	});
});
</script>
<?php
}