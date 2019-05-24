<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cactus
 */
$job_listing = $port_listing ='';
$archives_footer_cta_content = '';
if(function_exists('op_get')){
	$job_listing = op_get('ct_job_settings','job-listing-page');
	$port_listing = op_get('ct_portfolio_settings','portfolio-listing-page');
}
if(!is_single() && !is_page() || ($job_listing!='' && is_page($job_listing)) || ($port_listing!='' && is_page($port_listing))):
	$page_footer_cta_content 	= '';
	
	if( (is_archive()) || (is_front_page() && ('page' != get_option('show_on_front'))) ){
		$archives_footer_cta_content 	= ot_get_option('archives_footer_cta_content','');
		$archives_footer_cta_fullwidth 	= ot_get_option('archives_footer_cta_fullwidth','on');	
		if(is_category()){
			$cat 		= get_query_var('cat');
			$yourcat 	= get_category ($cat);
			$cat_id  	= $yourcat->cat_ID	;
			$cat_footer_cta					= get_option( "cat_footer_cta$cat_id") ? get_option( "cat_footer_cta$cat_id"):'';
			$cat_footer_cta_fullwidth 		= get_option( "cat_footer_cta_fullwidth$cat_id") ? get_option( "cat_footer_cta_fullwidth$cat_id"):'default';
			if($cat_footer_cta){$archives_footer_cta_content = $cat_footer_cta; }
			if($cat_footer_cta_fullwidth != 'default'){$archives_footer_cta_fullwidth = $cat_footer_cta_fullwidth; }
		}
	}
	if(function_exists('op_get')){
		$archives_footer_cta_content 	= ot_get_option('archives_footer_cta_content','');
		$archives_footer_cta_fullwidth 	= ot_get_option('archives_footer_cta_fullwidth','on');	
		$cta_content = '';
		if(is_post_type_archive( 'ct_job' ) || ($job_listing!='' && is_page($job_listing)) ){
			$cta_content = op_get('ct_job_settings','job-footer-cta-content');
			$cta_content = isset($cta_content) && $cta_content != '' ? $cta_content : '';
		}else if(is_post_type_archive( 'ct_portfolio' ) || ($port_listing!='' && is_page($port_listing))){
			$cta_content = op_get('ct_portfolio_settings','portfolio-footer-cta-content');
			$cta_content = isset($cta_content) && $cta_content != '' ? $cta_content : '';
		}
		if($cta_content !=''){
			$archives_footer_cta_content = $cta_content;
		}
	}	
?>
<?php if(!is_single() && $archives_footer_cta_content != ''){ 
	$cta_html_before = '';
	$cta_html_after	 = '';
	
	if($archives_footer_cta_fullwidth == 'on'){ 
		$cta_html_before = '<div class="cactus-sidebar-control ct-info-bottom dark-div"><div class="container container-1340-main"><div class="row"><div class="col-md-12 main-content-col">';		
	}else{
		$cta_html_before = '<div class="cactus-sidebar-control"><div class="container container-1340-main"><div class="row"><div class="col-md-12 main-content-col"><div class="ct-info-bottom dark-div">';			
	}
	$cta_html_after	 = '</div></div></div></div>';
	if($archives_footer_cta_fullwidth != 'on'){
		$cta_html_after	 .= '</div>';
	}
	if(function_exists('businesshub_remove_wpautop')){
		echo wp_kses_post($cta_html_before.do_shortcode(businesshub_remove_wpautop($archives_footer_cta_content, true)).$cta_html_after);
	}
}
endif;
?>

			<footer>
            	<?php 
				$show_bottom_social = ot_get_option('show_bottom_social','on');
				$accounts = array('facebook','youtube','twitter','linkedin','tumblr','google-plus','pinterest','flickr','envelope','rss');
				$visible_ss='';
				foreach($accounts as $account){
					$url = ot_get_option($account,'');
					$label = businesshub_get_setting_label_by_id($account);
					if($url){
						$visible_ss = '1';
					}
				}
				if($show_bottom_social!='off' && $visible_ss=='1'){?>
            	<div class="footer-label dark-div">
                    <div class="f-label-content ft-social">
                    	<?php businesshub_print_social_accounts($class=' social-listing list-inline mini-custom ', $show_class=true); ?>
                    </div>
                </div>
            	<?php }?>
            
                <div class="footer-inner dark-div">        
                
                  <div class="footer-sidebar">
                    <div class="container container-1340">
                      <div class="row control-sidebar">
                      
                         <?php 
						  businesshub_get_default_widgets_flag(1);
						  dynamic_sidebar( 'footer-sidebar' );
						  businesshub_get_default_widgets_flag(0);
								?>
                        
                      </div>
                    </div>
                  </div>
                  
                </div>
                
                <div class="footer-info dark-div">
                  <div class="container container-1340">
                      <div class="row">                        
                          <div class="col-md-6 col-sm-6 copyright font-1"><?php echo ot_get_option('copyright', '@2015 CactusThemes.com - We built amazing and functional Wordpress Themes');?></div>
                          <div class="col-md-6 col-sm-6 link font-1">
                              <div class="menu-footer-menu-container">
                                  <ul id="menu-footer-menu" class="menu">
                                    	<?php
											if(has_nav_menu( 'footer-menu' )){
												wp_nav_menu(array(
													'theme_location'  => 'footer-menu',
													'container' => false,
													'items_wrap' => '%3$s',
												));	
											}
										?>
                                  </ul>
                               </div>
                          </div>
                      </div>
                  </div>
                </div>
            </footer>
            
    	</div><!--#wrap-->
        
        <!--Menu moblie-->
          <div class="canvas-ovelay"></div>
          <div id="off-canvas" class="off-canvas-default heading-font-1 dark-div">
              <div class="off-canvas-inner">
                <div class="close-canvas-menu"></div>
                <nav class="off-menu">
                  <?php 
				  if(has_nav_menu( 'primary' )){
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'container' => false,
                        'items_wrap'=> '<ul>%3$s</ul>',
                    )); 
                }?>
                </nav>
                
                <div class="header-sidebar-mobile">             	
                </div>
                
              </div>
            </div>
        <!--Menu moblie-->
    	
        <div class="go-to-top"> 
        	<i class="fa fa-angle-up"></i>
        </div>
        
	</div><!--#body-wrap-->
	<?php wp_footer(); ?>
</body>
</html>
