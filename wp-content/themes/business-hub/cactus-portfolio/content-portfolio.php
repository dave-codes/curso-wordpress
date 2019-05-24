<?php
/**
 * @package cactus
 */
 $terms = wp_get_post_terms( get_the_ID(), 'portfolio_cat');
 $tern_slug ='';
 foreach ($terms as $term) {
	$tern_slug .= ' '.$term->slug;
}
$port_list_style ='';
if(function_exists('op_get') ){
	$port_list_style = op_get('ct_portfolio_settings','portfolio-listing-style');
}
$port_list_style = apply_filters('ct_portfolio_listing_layoutoption_filter', $port_list_style);
?>
<!--item listing-->
<div class="cactus-post-item hentry <?php echo esc_attr($tern_slug);?>">
	
    <div class="entry-content">                                        
        <!--picture (remove)-->
        <div class="picture">
            <div class="picture-content">
                <a href="<?php echo esc_url( get_permalink() );?>" title="<?php the_title_attribute() ?>">
                    <?php 
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full', true);
					$thumb_size = 'businesshub_thumb_460x307';
					$size_default = 'thumb_3x2';
					if($port_list_style == 'modern-square'){ $thumb_size ='businesshub_thumb_460x460'; $size_default = 'thumb_1x1';}
                    if(has_post_thumbnail()){
                        if(businesshub_thumbnail($thumb_size)!=''){echo businesshub_thumbnail($thumb_size);}
                        else{echo '<img alt="" src="'.businesshub_get_default_image($size_default).'">';}
                    }elseif($port_list_style!='classic'){ echo '<img alt="" src="'.businesshub_get_default_image($size_default).'">';}?>                                                           
                </a> 
                
                <div class="thumb-color bg-m-color-1"></div>
                <div class="ctl-icon-group">
                    <a href="<?php echo esc_url( get_permalink() );?>" class="ctl-icon-hover goto-link"><i class="fa fa-link"></i></a>
                    <a href="#" class="ctl-icon-hover search-next" data-img-src="<?php if(isset($thumbnail[0])){echo esc_url($thumbnail[0]);} ?>" data-title="<?php echo esc_attr(get_the_title()); ?>"><i class="fa fa-search"></i></a>
                </div> 
                                                                       
            </div>                                                                                            
        </div>                                                
        <!--picture-->
        <?php if($port_list_style!= 'modern' && $port_list_style!= 'modern-square'){?>
            <div class="content">                                                	
            
                <!--Title (no title remove)-->
                <h3 class="h5 cactus-post-title entry-title"> 
                    <a href="<?php echo esc_url( get_permalink() );?>" title=""><?php the_title(); ?></a> 
                </h3><!--Title-->
                
                <div class="categories">
                    <?php businesshub_get_category($post_type = 'ct_portfolio');?>
                </div>                                                                                                   
                
                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
            </div>
        <?php }?>    
    </div>
    
</div><!--item listing-->