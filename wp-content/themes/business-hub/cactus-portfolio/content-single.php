<div class="single-project-content single-content"> 
    <article class="cactus-single-content">
    	<h3 class="hidden-heading"><?php the_title();?></h3>
        <div class="body-content"> 
            <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cactus' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                ?>
        </div> 
        
        
        <div class="elms-tag-share-content">
            <div>
                <?php 
                $id_p ='';
                if(function_exists('op_get')){
                        $id_p = op_get('ct_portfolio_settings','portfolio-listing-page');
                }
                if($id_p!=''){
                    $link_url = get_permalink($id_p);
                }else{
                    $link_url = get_post_type_archive_link( 'ct_portfolio' );
                }
				$back_portfolio_text = ot_get_option('back_portfolio_text');?>
                <a href="<?php echo esc_url($link_url);?>" class="btn btn-default btn-style-1 btn-style-2 btn-style-4">
                    <div class="add-style">
                        <div class="ct-icon-140-layout-grid"></div> 
                        <span><?php if($back_portfolio_text!=''){ echo esc_attr($back_portfolio_text);}else{ esc_html_e('BACK TO PORTFOLIOS','cactus');}?></span>
                    </div>
                </a>
            </div>
            <div>
                  <?php businesshub_print_social_share();?>
            </div>
        </div>
        
    </article>
</div>    