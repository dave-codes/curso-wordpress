<?php
$post = businesshub_get_global_post();
if($post) {
	$post_id = $post->ID;
} 
$reletd_number = ot_get_option('edd_number_related');
if($reletd_number==''){$reletd_number =5;}
$post_cat = get_the_terms( get_the_ID(), 'download_category');
$cat_download = array();
if ($post_cat) {
	foreach($post_cat as $cat) {
		$cats = $cat->slug; 
		array_push($cat_download,$cats);
	}
}
if(count($cat_download)>1){
	$texo = array(
		'relation' => 'OR',
	);
	foreach($cat_download as $iterm) {
		$texo[] = 
			array(
				'taxonomy' => 'download_category',
				'field' => 'slug',
				'terms' => $iterm,
			);
	}
}else{
	$texo = array(
		array(
				'taxonomy' => 'download_category',
				'field' => 'slug',
				'terms' => $cat_download,
			)
	);
}
$args = array(
	'post_type' => 'download',
	'post_status' => 'publish',
	'posts_per_page' => $reletd_number,
	'orderby' => 'rand',
	'ignore_sticky_posts' => 1,
	'post__not_in' => array ($post_id),
	'tax_query' => $texo
);
$related_items = get_posts( $args );
if(count($related_items) < 1) return;
$more_product_like = ot_get_option('more_product_text');
$pick_product_text = ot_get_option('pick_product_text');
?>
<div class="ct-more-projects product-content">    	
    <h3 class="primary-heading h3"><?php if($more_product_like!=''){ echo esc_attr($more_product_like);}else{ esc_html_e( 'MORE PRODUCTS YOU MAY LIKE', 'cactus' );} ?></h3>
    <span class="sub-heading"><?php if($pick_product_text!=''){ echo esc_attr($pick_product_text);}else{  esc_html_e( 'We pick out some of our products', 'cactus' );}?></span>
</div> 

<div class="cactus-sidebar-control"> <!-- sb-right , sb-left -->
    
    <div class="container container-1340-main portfolio is-single">
        <div class="row">
        
            <div class="col-md-9 main-content-col">
                <div class="main-content-col-body">
                
                    <div class="cactus-listing-wrap">
                        <div class="cactus-listing-config style-2"> <!--addClass: style-1 + (style-2 -> style-n)-->                                
                            <div class="cactus-sub-wrap">
                                <?php 
            					foreach ( $related_items as $post ) : setup_postdata( $post ); ?>
                                <!--item listing-->
                                <div class="cactus-post-item hentry books">
                                
                                    <div class="entry-content">                                        
                                        
                                        <!--picture (remove)-->
                                        <div class="picture">
                                            <div class="picture-content">
                                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
                                                    <?php
													$thumbnail = '';
													if(has_post_thumbnail()){ 
													$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);
														echo businesshub_thumbnail('businesshub_thumb_460x307');
                                                    } ?>                                                        
                                                </a>                                                  
                                            </div>                                         
                                        </div>                                                
                                        <!--picture-->
                                        
                                        <div class="content">                                                	
                                            
                                            <!--Title (no title remove)-->
                                            <h3 class="h5 cactus-post-title entry-title"> 
                                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a> 
                                            </h3><!--Title-->
                                            <?php businesshub_ratting_show();?>
											<div class="excerpt">
												<?php echo get_the_excerpt(); ?>
                                            </div><!--excerpt-->
                                            <?php if(function_exists('businesshub_edd_button')){ businesshub_edd_button();}?>
                                            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                        </div>
                                        
                                    </div>
                                    
                                </div><!--item listing-->
                                <?php 
								endforeach;
								?>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>  
          
</div>
<?php
/*
WP_Query( $args ) = wp_reset_postdata();
query_posts ( $args ) = wp_reset_query();
*/
wp_reset_postdata();