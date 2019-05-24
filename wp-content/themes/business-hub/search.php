<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package cactus
 */
$page_sidebar = ot_get_option('page_sidebar','right');
get_header(); ?>

	<div id="cactus-body-container">
    
    	<div class="cactus-sidebar-control <?php if($page_sidebar!='hidden'){echo "sb-".$page_sidebar;}?>"> <!-- sb-right , sb-left -->
        
        	<div class="container container-1340-main">
            	<div class="row">
                
                	<div class="col-md-9 main-content-col">
                    	<div class="main-content-col-body">
                        
                        	<div class="cactus-listing-wrap">
                            	<div class="cactus-listing-config style-3 job-list"> <!--addClass: style-1 + (style-2 -> style-n)-->
                                	<?php if ( have_posts() ) : ?>
                                        <div class="cactus-elements-search"><h2 class="h4 title-search-page"><?php esc_html_e('Search Results for: ','cactus');?><span><?php echo esc_attr(get_search_query());?></span></h2> <span class="search-excerpt heading-font-1"><?php esc_html_e("If you didn't find what you were looking for, try a new search!","cactus");?></span><div class="cactus-search-input">						
                                        <?php
                                        $search_text = ot_get_option('search_text');
										if($search_text!=''){
											$search_text = esc_attr($search_text);
										}else{
											$search_text = esc_html__('Search','cactus');
										}
										?>
                                        <form action="<?php echo esc_url( home_url( '/' ) );?>" method="get">
                                            <input type="text" placeholder="<?php echo esc_html($search_text.'...');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
                                            <i class="fa fa-search"></i>
                                            <input type="submit" value="<?php echo esc_attr($search_text);?>">
                                        </form></div></div>
                                    
                                        <div class="cactus-sub-wrap">                                
                                            <?php /* Start the Loop */ ?>
                                            <?php while ( have_posts() ) : the_post(); ?>
                                
                                                <?php
                                                /**
                                                 * Run the loop for the search to output the results.
                                                 * If you want to overload this in a child theme then include a file
                                                 * called content-search.php and that will be used instead.
                                                 */
                                                get_template_part( 'html/loop/content', 'search' );
                                                ?>
                                
                                            <?php endwhile; ?>
    
                                        </div>
                      
                                    <?php else : ?>
                                        <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="page-navigation"><?php businesshub_paging_nav('.cactus-sub-wrap','html/loop/content-search'); ?></div>
                            </div>
                            
                        </div>
                    </div>
                    <?php if($page_sidebar!='hidden'){ get_sidebar(); } ?>
                </div>
        	</div>  
                  
        </div>
        
    </div>
<?php get_footer(); ?>
