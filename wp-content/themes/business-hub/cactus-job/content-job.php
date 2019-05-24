<?php
/**
 * @package cactus
 */
?>
<div class="cactus-post-item hentry">

    <div class="entry-content">                                        
                                                        
        <div class="content">
            <div class="categories">
                <i class="fa fa-map-marker"></i>
                <span class="cactus-note-cat"><?php echo esc_attr(get_post_meta(get_the_ID(),'job-location', true ));?></span>
            </div>
            
            <!--Title (no title remove)-->
            <h3 class="h5 cactus-post-title entry-title"> 
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a>
            </h3><!--Title-->
        
            <!--excerpt (remove)-->
            <div class="excerpt">
                <?php echo get_the_excerpt();?>
            </div><!--excerpt-->    
            
            <div class="button-and-share">
            
                <a href="<?php the_permalink() ?>" class="btn btn-default btn-style-1 btn-style-2 btn-style-4">
                    <div class="add-style">                                                                
                        <span><?php esc_html_e('CONTINUE READING','cactus');?></span>
                    </div>
                </a>
                
    
            </div>                                                
            
            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
        </div>
        
    </div>

</div><!--item listing-->