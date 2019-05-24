<?php
/**
 * Template Name: Front Page
 *
 * @package cactus
 */

//header
/*page meta*/
	$page_meta_sidebar 				= get_post_meta(get_the_ID(),'page_meta_sidebar', true );
/*page meta*/

/*page meta*/

/*Front-Page Metadata*/
	$meta_page_content 				= get_post_meta(get_the_ID(),'meta_page_content', true );
	$meta_page_layout 				= get_post_meta(get_the_ID(),'meta_page_layout', true );
	$frontpage_sidebar 				= get_post_meta(get_the_ID(),'frontpage_sidebar', true );
	$frontpage_sidebar = (isset($frontpage_sidebar) && $frontpage_sidebar != '') ? $frontpage_sidebar : 'right';

	businesshub_get_global_archives_thumb($meta_page_layout,$page_meta_sidebar);
	$template_layout_class = '';
	
	if($meta_page_layout == 'style_2'){$template_layout_class = 'style-2'; $archives_thumb='businesshub_thumb_460x307';}
	if($meta_page_layout == 'style_3'){$template_layout_class = 'style-3 ct-border-bottom'; $archives_thumb='businesshub_thumb_megamenu';}
/*Front-Page Metadata*/

get_header();
?>
    <div id="cactus-body-container" <?php if($meta_page_content == 'this_page'){echo 'class="template-full-width"';}?>>
    	<div class="cactus-sidebar-control <?php if(($meta_page_content == 'blog') && ($frontpage_sidebar != 'hidden')){echo "sb-".$frontpage_sidebar;}?>">
        	<div class="container container-1340-main">
            	<div class="row">
                	<div class="<?php echo (($meta_page_content == 'blog') && ($frontpage_sidebar != 'hidden')) ? 'col-md-9 ' : 'col-md-12 ' ?>main-content-col">
                    	<div class="main-content-col-body">
                            <?php if($meta_page_content == 'this_page'):?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'html/single/content', 'page' ); ?>
                                <?php endwhile; // end of the loop. ?>
                            <?php else:?>

									<?php
                                        $paged =businesshub_get_global_paged();
                                        $wp_query = businesshub_get_global_wp_query();
										$wp = businesshub_get_global_wp_();
                                        $temp_query = $wp_query;
                                        $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

        								$meta_page_content_cat 			= get_post_meta(get_the_ID(),'meta_page_content_cat', true );
										$meta_page_content_tag 			= get_post_meta(get_the_ID(),'meta_page_content_tag', true );
										$meta_page_content_id 			= get_post_meta(get_the_ID(),'meta_page_content_id', true );
										$meta_page_content_orderby 		= get_post_meta(get_the_ID(),'meta_page_content_orderby', true );
										$meta_page_content_count 		= get_post_meta(get_the_ID(),'meta_page_content_count', true );

                                        $options = array(
                                            'post_type'             => 'post',
											'posts_per_page'		=> $meta_page_content_count,
											'orderby' 				=> $meta_page_content_orderby,
                                            'order'                 => 'desc',
                                            'paged'                 => $paged,
                                            'post_status'           => 'publish',
                                            'ignore_sticky_posts'   => true
                                        );

                                        // if you don't setup post_ids param
                                        if(isset($meta_page_content_id) && $meta_page_content_id == '')
                                        {
                                            if(isset($meta_page_content_cat) && $meta_page_content_cat != '')
                                            {
                                                $cats = explode(",",$meta_page_content_cat);
                                                if(is_numeric($cats[0]))
                                                    $options['category__in'] = $cats;
                                                else
                                                    $options['category_name'] = $meta_page_content_cat;
                                            }
                                            if(isset($meta_page_content_tag) && $meta_page_content_tag != '')
                                            {
                                                $options['tag'] = $meta_page_content_tag;
                                            }
                                        }
                                        else
                                        {
                                            $ids = explode(",",$meta_page_content_id);
                                            if(is_numeric($ids[0]))
                                                $options['post__in'] = $ids;
                                        }

                                        $query= new WP_Query($options);

                                        $wp_query = $query;

                                        $total_page = ceil($query->found_posts / get_option('posts_per_page'));

                                        $wp_query = businesshub_get_global_wp_query();
										$wp = businesshub_get_global_wp_();

                                        $js_params['current_url'] =  home_url($wp->request);
                                        //$query->query_vars;
                                        $js_query_vars = '';
                                        foreach($query->query as $key=>$value){
                                           if(is_numeric($value)){
                                               $js_query_vars .= '"'.$key.'":'.$value.',';
                                           }
                                            elseif(is_array($value)) {
                                                $output = array();
                                                foreach($value as $json_arr)
                                                {
                                                    $output[] = '"' . $json_arr . '"';
                                                }
                                                $js_query_vars .= '"'.$key.'":['.implode(',', $output).'],';
                                            }
                                            else
                                               $js_query_vars .= '"'.$key.'":"'.$value.'",';

                                        }

                                    ?>
                                    <script type="text/javascript">
                                     var cactus = {"ajaxurl":"<?php echo admin_url( 'admin-ajax.php' );?>","query_vars":{<?php echo $js_query_vars; ?>},"current_url":"<?php echo home_url($wp->request);?>" }
                                    </script>

                                    <div class="cactus-listing-wrap">
                                    	<div class="cactus-listing-config <?php echo esc_attr($template_layout_class);?>">
                                        	<div class="cactus-sub-wrap">
												<?php if ( have_posts() ) : ?>
                                                    <?php while ( have_posts() ) : the_post(); ?>

                                                        <?php get_template_part( 'html/loop/content', get_post_format() ); ?>

                                                    <?php endwhile; ?>
                                                <?php else : ?>

                                                    <?php get_template_part( 'html/loop/content', 'none' ); ?>

                                                <?php endif; ?>
                                    		</div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="archives_thumb" value="<?php echo esc_attr($archives_thumb);?>"/>
                                    <div class="page-navigation"><?php businesshub_paging_nav('.cactus-sub-wrap','html/loop/content'); ?></div>
                            <?php endif; /*
							WP_Query( $args ) = wp_reset_postdata();
							query_posts ( $args ) = wp_reset_query();
							*/
							wp_reset_postdata();?>
                        </div>
                    </div> <!-- main-content-col cam-md-9|col-md-12 -->
                    <?php if(($meta_page_content == 'blog') && ($frontpage_sidebar != 'hidden')): ?>
                        <div class="col-md-3 cactus-sidebar">
                            <div class="cactus-sidebar-content">
                            <?php
                                if( is_active_sidebar('blog_sidebar') ){
                                    dynamic_sidebar( 'blog_sidebar' );
                                }else{
                                    dynamic_sidebar( 'main-sidebar' );
                                }
                            ?>
                            </div>
                        </div> <!-- sidebar -->
                	<?php endif;//Check Sidebar?>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- cactus-sidebar-control -->
    </div> <!-- cactus-body-container -->
<?php
get_footer();