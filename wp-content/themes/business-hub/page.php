<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cactus
 */
	//header
/*page meta*/	
	$page_meta_sidebar 				= get_post_meta(get_the_ID(),'page_meta_sidebar', true ); 
	
/*page meta*/

	$page_sidebar = '';
	if($page_meta_sidebar != 'default' && $page_meta_sidebar != ''){
		$page_sidebar = $page_meta_sidebar;
	}else{
		$page_sidebar = ot_get_option('page_sidebar','right'); //theme options : right, left, hidden
	}
$template_404 = ot_get_option('404_page');
if(($template_404 !='') && (is_page($template_404))){
	get_template_part('404'); 
	return;
}
if(function_exists('is_bbpress') && is_bbpress()){
	$page_sidebar = ot_get_option('bbpress_sidebar','right');
}
get_header();	
?>
	<div id="cactus-body-container">    
    	<div class="cactus-sidebar-control <?php if($page_sidebar!='hidden'){echo "sb-".$page_sidebar;}?>"> <!-- sb-right , sb-left -->
        	<div class="container container-1340-main">
            	<div class="row">
                
                	<div class="col-md-9 main-content-col">
                    
                    	<div class="main-content-col-body">
                        	 <?php 
							 	while ( have_posts() ) : the_post();
									get_template_part( 'html/single/content', 'page' );
								endwhile;
							 ?>
                            <?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() ) :
									comments_template();
								endif;
							?>
                        </div>
                        
                    </div>
                    
                    <?php if($page_sidebar!='hidden'){ get_sidebar(); } ?>
                
                </div>
            </div>
        </div>
    </div>            

<?php get_footer(); ?>
