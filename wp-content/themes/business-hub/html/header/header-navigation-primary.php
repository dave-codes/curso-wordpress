<?php
	$classStickyMenu = '';
	$stickyNavigation = ot_get_option('sticky_navigation', 'off');
	$stickyBehavoir = ot_get_option('sticky_up_down');
	if($stickyNavigation=='on') {
		$classStickyMenu = 'set-sticky-menu';
		if($stickyBehavoir=='down') {
			$classStickyMenu.=' is-always';
		};
	};
	
	$header_style = businesshub_get_global_header_style(); $nav_transparency = businesshub_get_global_nav_transparency();
	if(is_page_template() || is_page_template('templates/edd-page-template.php') ) {
		$meta_nav_style = businesshub_get_global_meta_nav_style();
		$meta_header_schema = businesshub_get_global_meta_header_schema();
		$meta_nav_opacity = businesshub_get_global_meta_nav_opacity();
		if($meta_nav_style && $meta_nav_style != 'default'){$header_style = $meta_nav_style;}
		if($meta_header_schema && $meta_header_schema != 'default'){$header_Schema = $meta_header_schema;}
		if($meta_nav_opacity || $meta_nav_opacity == '0'){$nav_transparency = $meta_nav_opacity;}
	}
	$meta_page_content ='';
	if(is_page_template('page-templates/front-page.php') ) {
		$meta_page_content = get_post_meta(get_the_ID(),'meta_page_content', true );
	}
?>
<div id="main-menu" class="<?php echo esc_attr($classStickyMenu);if(($nav_transparency=='1' && $header_style=='style_2') || ($meta_page_content == "blog")){echo ' no-main-menu-absolute';}?>">
  <nav class="navbar navbar-default">
    <div class="container container-1340">
      <div class="main-menu-wrap">
        
        <!--Brand style 2 & 3-->
        <ul class="nav navbar-nav logo-infomation">
            <li>
            	<?php $logo = ot_get_option('logo_image','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo.png' : ot_get_option('logo_image',''); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
            </li>
        </ul>
        <!--Brand style 2 & 3-->
              	
        <?php 
		$enable_search = ot_get_option('enable_search','off');
		if(is_page_template('page-templates/front-page.php') || is_page_template('templates/edd-page-template.php')){
			$meta_enable_search 			= get_post_meta(get_the_ID(),'meta_enable_search', true );
			$enable_search = $meta_enable_search;
		}
		if($enable_search != 'off'){ ?>
        <!--search-drop-down-->
        <ul class="nav navbar-nav navbar-right search-drop-down">
            <li>
            	<?php
				$search_text = ot_get_option('search_text');
				if($search_text!=''){
					$search_text = esc_attr($search_text);
				}else{
					$search_text = esc_html__('Search','cactus');
				}
				?>
                <a href="javascript:;" class="open-search-main-menu"><i class="fa fa-search"></i><i class="fa fa-times"></i></a>
                <ul class="search-main-menu dark-div">
                    <li>
                        <form action="<?php echo esc_url( home_url( '/' ) );?>" method="get">
                            <input type="text" placeholder="<?php echo esc_html($search_text.'...');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
                            <i class="fa fa-search"></i>
                            <input type="submit" value="<?php echo esc_attr($search_text);?>">
                        </form>
                    </li>
                </ul>
            </li>
        </ul><!--search-drop-down-->
        <?php }?>
        
        <?php businesshub_checkout_bt($show_ic = '1');?>	
        
        <ul class="nav navbar-nav open-menu-mobile">
          <li>
              <a href="javascript:;">
                <span></span>
                <span></span>
                <span></span>
              </a>
          </li>
        </ul>
                        
        <!--cactus-main-menu-->
        <ul class="nav navbar-nav cactus-main-menu">
			<?php
				$megamenu = ot_get_option('megamenu', 'off');
                if($megamenu == 'on' && function_exists('mashmenu_load') && has_nav_menu( 'primary' )){
                    mashmenu_load();
                }elseif(has_nav_menu( 'primary' )){
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker'=> new businesshub_custom_walker_nav_menu()
                    )); 
                }else{?>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>/"><?php esc_html_e('Home','cactus') ?></a></li>
                    <?php wp_list_pages('depth=1&title_li=' ); ?>
            <?php } ?>
        </ul>
        
      </div>
    </div>
  </nav>
</div>