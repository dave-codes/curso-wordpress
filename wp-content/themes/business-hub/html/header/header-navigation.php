<?php do_action( 'businesshub_before_nav' ); ?>

<?php
	$header_style 			= ot_get_option('header_style', 'style_1');
	$header_Schema 			= ot_get_option('header_Schema', 'light');
	$nav_transparency 		= ot_get_option('header_opacity','0.25');
	
	if(is_page_template() || is_page_template('templates/edd-page-template.php') ) {
		$meta_nav_style = businesshub_get_global_meta_nav_style();
		$meta_header_schema = businesshub_get_global_meta_header_schema();
		$meta_nav_opacity = businesshub_get_global_meta_nav_opacity();
		if($meta_nav_style && $meta_nav_style != 'default'){$header_style = $meta_nav_style;}
		if($meta_header_schema && $meta_header_schema != 'default'){$header_Schema = $meta_header_schema;}
		if($meta_nav_opacity || $meta_nav_opacity == '0'){$nav_transparency = $meta_nav_opacity;}
	}
	$navigation_schema_class = '';
	$navigation_style_class = '';

	if($header_style == 'style_1'){
		if($header_Schema == 'dark'){
			$navigation_schema_class = ' dark-div ';	
		}
	}else{ 
		$navigation_style_class = 'style-2';
		if($header_Schema == 'dark' ){
			$navigation_schema_class = ' dark-div ';
		}
		if( $nav_transparency != '1' ){ 
			$navigation_style_class.= ' style-3 no-border-bottom ';
			$navigation_schema_class = 'schema-'.$header_Schema;
		}
	}
?>
<!--Navigation style-->
<div class="cactus-nav <?php echo esc_attr($navigation_style_class.$navigation_schema_class);?>">
	<?php get_template_part( 'html/header/header', 'navigation-top' ); ?>
	<?php if($header_style == 'style_1'):
		get_template_part( 'html/header/header', 'navigation-branding');
		get_template_part( 'html/header/header', 'navigation-primary');
	?>
    <?php elseif($header_style == 'style_2'):
		get_template_part( 'html/header/header', 'navigation-primary');
		get_template_part( 'html/header/header', 'navigation-branding');
	
	?>
    <?php endif;?>
</div>
<!--Navigation style-->
<?php do_action( 'businesshub_after_nav' ); ?>