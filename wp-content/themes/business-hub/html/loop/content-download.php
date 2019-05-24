<?php
/**
 * @package cactus
 */
?>
<!--item listing-->
<div class="cactus-post-item hentry business">

    <div class="entry-content">                                        
        <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
        <!--picture (remove)-->
        <div class="picture">
            <div class="picture-content">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo businesshub_thumbnail('businesshub_thumb_460x307');?>
                </a>
            </div>                                                                                            
        </div>                                                
        <!--picture-->
        <?php endif; ?>
        <div class="content">                                                	
            
            <!--Title (no title remove)-->
            <h3 class="h5 cactus-post-title entry-title"> 
                <a href="<?php echo esc_url( get_permalink() );?>" title=""><?php the_title(); ?></a>
            </h3><!--Title-->
            <?php businesshub_ratting_show();?>
            <!--excerpt (remove)-->
            <div class="excerpt">
                <?php echo esc_attr(get_the_excerpt()); ?>
            </div><!--excerpt-->   
            <?php if(function_exists('businesshub_edd_button')){ businesshub_edd_button();}?>            
            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
        </div>
        
    </div>
    
</div><!--item listing-->