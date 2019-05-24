<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cactus
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- Retina Logo-->
<?php if(ot_get_option('retina_logo','')):?>
<style type="text/css" >
	@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
		/* Retina Logo */
		.logo-infomation li a{background:url(<?php echo ot_get_option('retina_logo', ''); ?>) no-repeat center; background-size:contain;}
		.logo-infomation li a img{ opacity:0; visibility:hidden}		
	}
</style>
<?php endif;?>

<?php
$page_heading_style_class 	= '';

$ct_hd_meta = businesshub_heading_meta();
$page_meta_text_heading_style = $ct_hd_meta['page_meta_text_heading_style'];
$page_heading_style = $ct_hd_meta['page_heading_style'];
$page_heading_icon = $ct_hd_meta['page_heading_icon'];
$page_heading_sub_text = $ct_hd_meta['page_heading_sub_text'];
$page_header_background = $ct_hd_meta['page_header_background'];
$page_header_color = $ct_hd_meta['page_header_color'];

if(is_singular('download') || is_post_type_archive( 'download' )){
	$page_heading_style 	= 'simple';
}
//default Heading Text Style
if( $page_heading_style == 'simple' ){
	$page_heading_style_class 	= 'header-style-forall';
	if($page_header_background == ''){ $page_heading_style_class .= ' s-style-6';}
}else if( $page_heading_style == 'big_center' ){
	$page_heading_style_class 	= 'header-style-forall s-style-8';
	if($page_header_background == ''){ $page_heading_style_class = 'header-style-forall s-style-7';}
}else if($page_heading_style == 'icon_left'){
	$page_heading_style_class 	= 'header-style-forall s-style-2';
	if($page_header_background == ''){ $page_heading_style_class .= ' s-style-1';}
	if($page_heading_icon == ''){ $page_heading_style_class .= ' no-icon';}
}else if($page_heading_style == 'center_sub_line'){
	$page_heading_style_class 	= 'header-style-forall s-style-2 s-style-3';
	if($page_header_background == ''){ $page_heading_style_class .= ' s-style-1';}
}else{
	$page_heading_style_class 	= 'header-style-forall';
}	
/* Page Header Style*/	
$header_style 			= businesshub_get_global_header_style();
$header_Schema 			= ot_get_option('header_Schema', 'light');
$nav_transparency 		= businesshub_get_global_nav_transparency();

if(is_page_template() || is_page_template('templates/edd-page-template.php') ) {
	$meta_nav_style = businesshub_get_global_meta_nav_style();
	$meta_header_schema = businesshub_get_global_meta_header_schema();
	$meta_nav_opacity = businesshub_get_global_meta_nav_opacity();
	if($meta_nav_style && $meta_nav_style != 'default'){$header_style = $meta_nav_style;}
	if($meta_header_schema && $meta_header_schema != 'default'){$header_Schema = $meta_header_schema;}
	if($meta_nav_opacity || $meta_nav_opacity == '0'){$nav_transparency = $meta_nav_opacity;}
}
$header_container_class = ' dark-div ';
if( ($page_header_background && $page_header_color) == '' ){
	if($header_style == 'style_2' && $nav_transparency != '1' && $header_Schema=='light'){
		$header_container_class = '';
	}
}
/* Page Header Style*/
$businesshub_layzyload = '';	
if(ot_get_option('lazy_load', 'off')=='on'){
	$businesshub_layzyload = 'enable-lazy-load';	
}
wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="body-wrap" <?php echo ($businesshub_layzyload!=''?'class="'.$businesshub_layzyload.'"':'');?>> <!--body-wrap-->
    	<div id="wrap"> <!--wrap-->
        	<header class="config-header-list-page">
            	<?php
					get_template_part( 'html/header/header', 'navigation' ); // load header-navigation.php
					if( is_singular('ct_portfolio')){
						get_template_part( 'cactus-portfolio/header', 'single-portfolio' );
					}else{
						?>
                        <?php if(!isset($page_meta_text_heading_style) || (isset($page_meta_text_heading_style) && $page_meta_text_heading_style != 'hidden')):?>               
						<div class="<?php echo esc_attr($page_heading_style_class); ?>">
							<div class="hs-ct-content">
								<div class="bg-header-top"
                                <?php
                                	if($page_header_background != ''){
										echo 'style="background-image:url('.$page_header_background.')"';
									}else {
										if( $page_header_color != ''){
											echo 'style="background-color:'.$page_header_color.'"';
										}	
									}
								?>>
									<div class="header-style-basic container container-1340 <?php echo esc_attr($header_container_class);?>">
										<?php if($page_heading_style == 'icon_left'){?>
											<div class="title-block">
												<?php if($page_heading_icon != ''):?>
													<div class="text-icon">
														<div class="<?php echo esc_attr($page_heading_icon);?>"></div>
													</div>
												<?php endif;?>
												<div class="text-group">
													<h1 class="h3"><?php echo do_shortcode (businesshub_get_global_title());?></h1>
													<?php if($page_heading_sub_text != ''):?>
														<h2 class="main-font-1 h6"><?php echo esc_attr($page_heading_sub_text);?></h2>
													<?php endif;?>
												</div>
											</div>
										<?php }else if($page_heading_style == 'center_sub_line'){?>
											<div class="title-block">
												<div class="text-group">
													<h1 class="h3"><?php echo do_shortcode (businesshub_get_global_title());?></h1>
													<?php if($page_heading_sub_text != ''):?>
														<h2 class="main-font-1 h6"><?php echo esc_attr($page_heading_sub_text);?></h2>
													<?php endif;?>
												</div>
											</div>			
										<?php } else {?>
											<h1 class="h3"><?php echo do_shortcode (businesshub_get_global_title());?></h1> 
										<?php }?>
										<?php if(!is_404()){ businesshub_breadcrumbs();}?>
									</div>
								</div>                              
							</div>
                        </div>
                        <?php endif;?>
                     <?php }?>   
            </header>