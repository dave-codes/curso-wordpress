<?php
/**
 * @package cactus
 */
$archives_thumb = businesshub_get_global_archives_thumb();
if( $archives_thumb == '' ){
	$archives_thumb = 'businesshub_thumb_960x640';
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('cactus-post-item hentry'); ?>>
    <div class="entry-content">                                        
        <?php 
		if(has_post_thumbnail()){ ?>
        <!--picture (remove)-->
        <div class="picture">
            <div class="picture-content">
                <a href="<?php echo esc_url( get_permalink() );?>" title="<?php the_title_attribute() ?>">
                    <?php echo businesshub_thumbnail($archives_thumb);?>                                                         
                </a>                                                        
            </div>  
            <div class="note-date heading-font-1"><span><?php the_time( 'M' ); ?></span> <span><?php the_time( 'd' ); ?></span></div>                                                  
        </div>
        
        <!--picture-->
        <?php } ?>
        <div class="content">
			<?php 
				$categories = array();
				$categories = get_the_category();
				if( !empty($categories) ){
					echo '<div class="categories">';
						businesshub_get_category();
					echo '</div>';
				}
            ?>
            
            <!--Title (no title remove)-->
            <h3 class="h5 cactus-post-title entry-title"> 
            	 <a href="<?php echo esc_url( get_permalink() );?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a>
            </h3><!--Title-->
        	
            <?php if(trim(get_the_excerpt()) != '' && trim(get_the_excerpt()) != null && trim(get_the_excerpt()) != '&nbsp;'):?>
            <!--excerpt (remove)-->
            <div class="excerpt">
                <?php echo get_the_excerpt(); ?>
            </div><!--excerpt-->    
            <?php endif;?>
            
            <div class="button-and-share">
            
                <a href="<?php echo esc_url( get_permalink() );?>" class="btn btn-default btn-style-1 btn-style-2 btn-style-4">
                    <div class="add-style">                                                                
                        <span><?php esc_html_e('CONTINUE READING','cactus');?></span>
                    </div>
                </a>
                
                <div class="open-close-social">
                    <i class="fa fa-share-alt"></i>
                </div>
                
                <div class="ct-share-group">
                    <?php businesshub_print_social_share();?>
                </div>
                
            </div>                                                
            
            <div class="cactus-last-child"></div> <!--fix pixel no remove-->
        </div>
        
    </div>
</div>