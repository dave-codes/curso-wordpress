<?php
$meta_nav_style = businesshub_get_global_meta_nav_style();
$header_style = ot_get_option('header_style', 'style_1');
if($meta_nav_style && $meta_nav_style != 'default'){$header_style = $meta_nav_style;}

?>
<div id="main-nav"> 
    <nav class="navbar navbar-default">
        <div class="container container-1340">
        
            <ul class="nav navbar-nav logo-infomation">
                <li>
                	<?php $logo = ot_get_option('logo_image','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo.png' : ot_get_option('logo_image',''); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right header-mobile-sub-menu">
                <li>
                  <a href="javascript:;">
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
              </li>
            </ul>
            
           	<?php if(is_active_sidebar('callout_sidebar') && $header_style != 'style_2'){
				dynamic_sidebar( 'callout_sidebar' );
			}?>
            
        </div>
    </nav>
</div>