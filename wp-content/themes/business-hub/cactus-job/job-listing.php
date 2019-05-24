<?php
get_header();
$sidebar = get_post_meta(get_the_ID(),'page_meta_sidebar',true);
if(!$sidebar|| $sidebar =='' || $sidebar =='default'){
	$sidebar = ot_get_option('archives_sidebar','right');
}
?>
<div id="cactus-body-container" class="jobs-listing-page">

  <div class="cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>"> <!-- sb-right , sb-left -->
  
      <div class="container container-1340-main">
          <div class="row">
          
              <div class="<?php echo esc_attr($sidebar!='full'?'col-md-9':'col-md-12'); ?> main-content-col">
                  <div class="main-content-col-body">
                  
                      <div class="cactus-listing-wrap">
                          <div class="cactus-listing-config style-3 job-list"> <!--addClass: style-1 + (style-2 -> style-n)-->
                              <?php 
                                $wp_query = businesshub_get_global_wp_query();
								$wp = businesshub_get_global_wp_();
                                if(is_tax('job_cat')){
                                    $list_query = $wp_query;
                                }else{
									if(function_exists('op_get') ){
										$post_per_page = op_get('ct_job_settings','job-post-per-page');
									}
									if(!$post_per_page){ $post_per_page = get_option('posts_per_page');}
                                    $paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
                                    $args = array(
                                        'post_type' => 'ct_job',
                                        'posts_per_page' => $post_per_page,
                                        'paged' => $paged,
                                    );
                                    $list_query = new WP_Query( $args );
                                }
                                $it = $list_query->post_count;
								$num_pg =  $list_query->max_num_pages;?>
                                <input type="hidden"  name="ct_num_page" value="<?php echo esc_attr($num_pg);?>">
                                <script type="text/javascript">
								 var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":<?php echo str_replace('\/', '/', json_encode($args)) ?>,"current_url":"<?php echo home_url($wp->request);?>" }
								</script>  
                                <div class="cactus-sub-wrap"> 
                                <?php
                                if($list_query->have_posts()){
                                    $main_query = $wp_query;
                                    $wp_query = $list_query;?>
                                            <?php while ( have_posts() ) : the_post(); ?>
                                            
                                                <?php get_template_part( 'cactus-job/content-job'); ?>
                                
                                            <?php endwhile; ?>
                                    <?php 
                                } else{
                                    get_template_part( 'html/loop/content', 'none' ); 
                                }?>
                              </div>
                              <div class="page-navigation"><?php businesshub_paging_nav('.jobs-listing-page .cactus-sub-wrap','cactus-job/content-job'); ?></div>
                              <?php 
                                wp_reset_postdata();
                                if($it>0){
                                  $wp_query = $main_query;
                                }?>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <?php if($sidebar!='full'){ get_sidebar(); } ?>                   
          </div>
      </div>  
            
  </div>
  
</div> 
<?php
get_footer();
