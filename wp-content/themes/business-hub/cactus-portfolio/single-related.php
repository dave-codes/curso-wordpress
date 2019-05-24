<?php
$post = businesshub_get_global_post();
if($post) {
	$post_id = $post->ID;
} 
$reletd_number = '';
if(function_exists('op_get')){
	$reletd_number =  op_get('ct_portfolio_settings','portfolio_number_related');
}
if($reletd_number==''){$reletd_number =5;}
$post_cat = get_the_terms( get_the_ID(), 'portfolio_cat');
$cat_event = array();
if ($post_cat) {
	foreach($post_cat as $cat) {
		$cats = $cat->slug; 
		array_push($cat_event,$cats);
	}
}
if(count($cat_event)>1){
	$texo = array(
		'relation' => 'OR',
	);
	foreach($cat_event as $iterm) {
		$texo[] = 
			array(
				'taxonomy' => 'portfolio_cat',
				'field' => 'slug',
				'terms' => $iterm,
			);
	}
}else{
	$texo = array(
		array(
				'taxonomy' => 'portfolio_cat',
				'field' => 'slug',
				'terms' => $cat_event,
			)
	);
}
$args = array(
	'post_type' => 'ct_portfolio',
	'post_status' => 'publish',
	'posts_per_page' => $reletd_number,
	'orderby' => 'rand',
	'ignore_sticky_posts' => 1,
	'post__not_in' => array ($post_id),
	'tax_query' => $texo
);
$related_items = new WP_Query( $args );
if(!$related_items->have_posts()) return;
$more_project_text = ot_get_option('more_project_text');
$youmight_want_text = ot_get_option('youmight_want_text');
?>
<div class="ct-more-projects">    	
    <h3 class="primary-heading h3"><?php if($more_project_text!=''){ echo esc_attr($more_project_text);}else{ esc_html_e( 'MORE PROJECTS', 'cactus' );} ?></h3>
    <span class="sub-heading"><?php if($youmight_want_text!=''){ echo esc_attr($youmight_want_text);}else{ esc_html_e( 'You might want to check out', 'cactus' );} ?></span>
</div> 

<div class="cactus-sidebar-control"> <!-- sb-right , sb-left -->
    
    <div class="container container-1340-main portfolio is-single">
        <div class="row">
        
            <div class="col-md-9 main-content-col">
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

                            <div class="cactus-sub-wrap">
                                <?php 
            					while ( $related_items->have_posts() ) : $related_items->the_post();?>
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
                                                
                                                <div class="thumb-color bg-m-color-1"></div>
                                                <div class="ctl-icon-group">
                                                    <a href="<?php the_permalink();?>" class="ctl-icon-hover goto-link"><i class="fa fa-link"></i></a>
                                                    <?php if(isset($thumbnail[0]) && $thumbnail[0]!=''){?>
                                                    	<a href="#" data-img-src="<?php echo esc_url($thumbnail[0]);?>" class="ctl-icon-hover search-next" data-title="<?php echo esc_attr(get_the_title()); ?>"><i class="fa fa-search"></i></a>
                                                    <?php }?>
                                                </div>                                                       
                                            </div>                                         
                                        </div>                                                
                                        <!--picture-->
                                        
                                        <div class="content">                                                	
                                            
                                            <!--Title (no title remove)-->
                                            <h3 class="h5 cactus-post-title entry-title"> 
                                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a> 
                                            </h3><!--Title-->
                                            
											<?php 
                                            $terms = wp_get_post_terms( get_the_ID(), 'portfolio_cat');
                                            $count = 0; $i=0;
                                            foreach ($terms as $term) {
                                                $count ++;
                                            }
                                            if($count!=0){
                                            ?>	
                                            <div class="categories">
                                                <?php 
                                                foreach ($terms as $term) {
                                                    $i++;
                                                    echo '<a href="'.get_term_link($term->slug, 'portfolio_cat').'" class="cactus-note-cat">'.$term->name.'</a> ';
                                                    if($i!=$count){ echo ', ';}
                                                }
                                                ?>
                                            </div>
                                            <?php }?>
                                            
                                            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                                        </div>
                                        
                                    </div>
                                    
                                </div><!--item listing-->
                                <?php 
								endwhile;
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