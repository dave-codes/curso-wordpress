<?php
/**
 * @package cactus
 */
?>
<!--item listing-->
<div id="post-<?php the_ID(); ?>" <?php post_class('cactus-post-item hentry'); ?>>

    <div class="entry-content">                                        
		<?php 
        if(has_post_thumbnail() && get_post_type( get_the_ID() ) =='download'){ ?>
        <!--picture (remove)-->
        <div class="picture">
            <div class="picture-content">
                <a href="<?php echo esc_url( get_permalink() );?>" title="<?php the_title_attribute() ?>">
                    <?php echo businesshub_thumbnail('businesshub_thumb_megamenu');?>                                                         
                </a>                                                        
            </div>  
        </div>
        
        <!--picture-->
        <?php } ?>
                                                        
        <div class="content">
            <!--Title (no title remove)-->
            <h3 class="h5 cactus-post-title entry-title"> 
                <a href="<?php echo esc_url( get_permalink() );?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a> 
            </h3><!--Title-->
        
            <!--excerpt (remove)-->
            <div class="excerpt">
                <?php echo get_the_excerpt(); ?>
            </div><!--excerpt-->    
            
            <div class="button-and-share">
            
                <a href="<?php echo esc_url( get_permalink() );?>" class="btn btn-default btn-style-1 btn-style-2 btn-style-4">
                    <div class="add-style">                                                                
                        <span><?php 
						if(get_post_type( get_the_ID() ) =='download'){
							esc_html_e('View Product','cactus');
						}else{
							esc_html_e('CONTINUE READING','cactus');
						}
						?></span>
                    </div>
                </a>
                

            </div>                                                
            
            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
        </div>
        
    </div>
    
</div><!--item listing-->