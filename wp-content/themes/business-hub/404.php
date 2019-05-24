<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cactus
 */
$template_404 = ot_get_option('404_page');
$page_sidebar = '';
$content_404 = '';
if( (isset($template_404)) && ($template_404 != '') ){
	$page_sidebar = get_post_meta($template_404,'page_meta_sidebar', true ); 
	$post = get_post($template_404); 
	if(is_object($post)){
		$content_404 = apply_filters('the_content', $post->post_content);
	}
}
if($content_404 ==''){$content_404 = ot_get_option('404_content');}
if($page_sidebar =='default' || $page_sidebar==''){$page_sidebar = ot_get_option('page_sidebar','full');}
get_header();?>
    <div id="cactus-body-container">
    
    	<div class="cactus-sidebar-control <?php if($page_sidebar!='hidden'){echo "sb-".esc_attr($page_sidebar);}?>"> <!-- sb-right , sb-left -->
        	<div class="container container-1340-main ">
            	<div class="row">
                	<div class="col-md-9 main-content-col">
                    	<div class="main-content-col-body">
                        
                        	<div class="single-page-content">
                            	<article class="cactus-single-content">
                                	<h2 class="title-404"><?php esc_html_e('404','cactus');?></h2>
                                    <div class="infor-404 h6"><?php if($content_404){ echo wp_kses_post($content_404); }?></div>
                                    <div class="gotohome-404"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-default"><?php esc_html_e('BACK TO HOMEPAGE','cactus');?></a></div> 
                                </article>
                             </div>
                             
                        </div>
                    </div>
                    <?php if($page_sidebar!='hidden'){ get_sidebar(); } ?>
                </div>
        	</div>  
                  
        </div>
        
    </div>
<?php get_footer(); ?>