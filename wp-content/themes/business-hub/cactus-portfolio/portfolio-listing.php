<?php
get_header();
$port_list_full = $port_list_style ='';
if(function_exists('op_get') ){
	$port_list_full = op_get('ct_portfolio_settings','port_list_full');
	$port_list_style = op_get('ct_portfolio_settings','portfolio-listing-style');
}

// allow to change option value in different context
$port_list_full = apply_filters('ct_portfolio_listing_sidebaroption_filter', $port_list_full);
$port_list_style = apply_filters('ct_portfolio_listing_layoutoption_filter', $port_list_style);
?>
    <div id="cactus-body-container" class="portfolio-listing-page">
    
    	<div class="cactus-sidebar-control"> <!-- sb-right , sb-left -->
        
        	<div class="container container-1340<?php if($port_list_full!='off'){?>-main<?php }?> portfolio <?php if($port_list_style=="modern"){?> portfolio-modern <?php }elseif($port_list_style=="modern-square"){?> portfolio-modern version-3<?php }?>">
            	<div class="row">
                
                	<div class="<?php if($port_list_full!='off'){?>col-md-9 <?php }else{?>col-md-12 <?php }?> main-content-col">
                    	<div class="main-content-col-body">
                        
                        	<div class="cactus-listing-wrap">
                            	<div class="cactus-listing-config style-2"> <!--addClass: style-1 + (style-2 -> style-n)-->
                                
                                	<div class="ct-lb-background"></div>
                                    
                                    <div class="spinner"></div>
                                    
                                    <div class="ct-lb-content">
                                    	<div class="ct-ove-click"></div>                                    
                                    	<img src="<?php echo esc_attr(get_template_directory_uri().'/images/placeholder-img.png');?>" alt="">
                                        <div class="lb-caption"></div>
                                        <div class="ct-close-light-box"><i class="fa fa-times"></i></div>	
                                    </div>
                                
                                	<div class="portfolio-filter">
                                    	<a href="javascript:;" class="btn btn-default btn-style-1 btn-style-2 btn-style-4 active" data-filter="*">
                                            <div class="add-style">                                                
                                                <span><?php esc_html_e('ALL','cactus'); ?></span>
                                            </div>
                                        </a>
                                        <?php $portfolio_cat = get_terms('portfolio_cat');
										if ( ! empty( $portfolio_cat ) && ! is_wp_error( $portfolio_cat ) ){
											 foreach ( $portfolio_cat as $term ) {?>
											  	<a href="javascript:;" class="btn btn-default btn-style-1 btn-style-2 btn-style-4" data-filter=".<?php echo esc_attr($term->slug);?>">
                                                    <div class="add-style">                                                
                                                        <span><?php echo esc_attr($term->name);?></span>
                                                    </div>
                                                 </a>
												<?php
											 }
										 }
										?>
                                    </div>
										<?php 
                                        $wp_query = businesshub_get_global_wp_query();
										$wp = businesshub_get_global_wp_();
                                        if(is_tax('portfolio_cat')){
                                            $list_query = $wp_query;
                                        }else{
											if(function_exists('op_get') ){
												$post_per_page = op_get('ct_portfolio_settings','portfolio-post-per-page');
											}
											if(!$post_per_page){ $post_per_page = get_option('posts_per_page');}
                                            $paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
                                            $args = array(
                                                'post_type' => 'ct_portfolio',
                                                'post_status' => 'publish',
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
                                            if($list_query->have_posts()){?>
                                                <?php
                                                $main_query = $wp_query;
                                                $wp_query = $list_query;
                                                ?>
                                                            <?php while ( have_posts() ) : the_post(); ?>
                                                            
                                                                <?php get_template_part( 'cactus-portfolio/content-portfolio'); ?>
                                                
                                                            <?php endwhile; ?>
                                            <?php } else{
                                                get_template_part( 'html/loop/content', 'none' ); 
                                            }
                                            ?>
                                        </div>
                                    <div class="page-navigation"><?php businesshub_paging_nav('.portfolio-listing-page .cactus-sub-wrap','cactus-portfolio/content-portfolio'); ?></div>
                                    <?php 
                                    wp_reset_postdata();
                                    if($it>0){
                                      $wp_query = $main_query;
                                    }?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        	</div>  
                  
        </div>
        
    </div>
<?php
get_footer();
