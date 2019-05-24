<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */

$archives_header_bg_color = ot_get_option('archives_header_background');
$archives_header_bg_color = isset($archives_header_bg_color['background-color']) ? $archives_header_bg_color['background-color'] : '';
$archives_sidebar = ot_get_option('archives_sidebar','right');
get_header();
$archives_layout = ot_get_option('archives_layout','style_1');
$archives_layout_class = '';

businesshub_get_global_archives_thumb($archives_layout,$archives_sidebar);

if($archives_layout == 'style_2'){$archives_layout_class = 'style-2';}
if($archives_layout == 'style_3_thumbnail'){$archives_layout_class = 'style-3 ct-border-bottom';}
?>
	<div id="cactus-body-container">
    	<div class="cactus-sidebar-control <?php if( $archives_sidebar!='hidden' ){ echo "sb-".$archives_sidebar; }?>"> <!-- sb-right , sb-left -->
        	<div class="container container-1340-main">
            	<div class="row">
                	<div class="<?php echo esc_attr($archives_sidebar!='hidden'?'col-md-9':'col-md-12'); ?> main-content-col">
                    	<div class="main-content-col-body">
                        	<div class="cactus-listing-wrap">
                            	<div class="cactus-listing-config <?php echo esc_attr($archives_layout_class);?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
                                	<div class="cactus-sub-wrap">
										<?php
                                        if(class_exists('businesshub_edd_addon') && function_exists('op_get') ){
                                            $edd_listing_page = op_get('ct_edd_addon_settings','edd-addon-listing-page');
                                        }
											$wp_query = businesshub_get_global_wp_query();
											$wp = businesshub_get_global_wp_();
											if(is_tax('ct_edd_addon')){
												$list_query = $wp_query;
											}else{
												if(function_exists('op_get') ){
													$post_per_page 	= op_get('ct_edd_addon_settings','edd-addon-post-per-page');
													$post_per_page 	= isset($post_per_page) && $post_per_page != '' ? $post_per_page : '10';
												}
												if(!$post_per_page){ $post_per_page = get_option('posts_per_page');}
												$paged = get_query_var('paged')?get_query_var('paged'):(get_query_var('page')?get_query_var('page'):1);
												$args = array(
													'post_type' => 'ct_edd_addon',
													'posts_per_page' => $post_per_page,
													'paged' => $paged,
												);
												$list_query = new WP_Query( $args );
											}
											$it = $list_query->post_count;
											?>
											<script type="text/javascript">
											 var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":<?php echo str_replace('\/', '/', json_encode($args)) ?> ,"current_url":"<?php echo home_url($wp->request);?>" }
											</script> 
											<?php
												if($list_query->have_posts()){
													$main_query = $wp_query;
													$wp_query = $list_query;?>
													<?php while ( have_posts() ) : the_post(); ?>
														<?php get_template_part( 'cactus-edd-addon/content-edd-addon'); ?>
													<?php endwhile; ?>
													<?php
												} else {
													get_template_part( 'html/loop/content', 'none' );
												}
											?>
                                    	</div><!-- .cactus-sub-wrap-->
                                	</div><!-- .cactus-listing-config -->
                            	<input type="hidden" name="archives_thumb" value="<?php echo esc_attr($archives_thumb);?>"/>
                                <div class="page-navigation"><?php businesshub_paging_nav('.cactus-sub-wrap','html/loop/content'); ?></div>
                                <?php 
								wp_reset_postdata();
								if(isset($it) && $it > 0){
								  $wp_query = $main_query;
								}?>
                            	</div>
                            </div>
                        </div>
					<?php if($archives_sidebar != 'hidden'){get_sidebar();} ?>
        		</div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>