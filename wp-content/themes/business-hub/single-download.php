<?php
/**
 * The Template for displaying all single downloads.
 *
 * @package cactus
 */ 
$post_sidebar = get_post_meta(get_the_ID(),'sidebar_layout', true );
if($post_sidebar=='default' || $post_sidebar==''){
	$post_sidebar = ot_get_option('digital_single_sidebar','right'); //theme options : right, left, hidden
}
$digital_single_style = get_post_meta(get_the_ID(),'digital_single_style', true );
if($digital_single_style=='default' || $digital_single_style==''){
	$digital_single_style = ot_get_option('digital_single_style');
}
$reletd_number = ot_get_option('edd_number_related','5');
if($digital_single_style =='2'){
	$post_sidebar ='right';
}
get_header();
?>
    <div id="cactus-body-container">
    
    	<div class="cactus-sidebar-control <?php if($post_sidebar!='hidden'){echo "sb-".$post_sidebar;}?>"> <!-- sb-right , sb-left -->
        
        	<div class="container container-1340-main">
            	<div class="row">
                
                	<div class="col-md-9 main-content-col">
                    	<div class="main-content-col-body">
                        
                        	<div class="single-product-content single-content"> 
                            	<article class="cactus-single-content">
                                	<h3 class="hidden-heading"><?php the_title();?></h3>
                                	<?php
									get_template_part( 'html/single/content-download-header');
									if($digital_single_style !='2'){
										?>
										<div class="product-information">
											<div class="info-table">
												<div class="info-row">
													<?php
													$edd_defaultmeta = ot_get_option('edd_defaultmeta')?explode(",", ot_get_option('edd_defaultmeta')):'';													
													$ex_df = 0;
													if($edd_defaultmeta){
														foreach($edd_defaultmeta as $check_ex){
															$ex_vl = get_post_meta(get_the_ID(),'edd_'.sanitize_title($check_ex),true);
															if($ex_vl){
																$ex_df = 1;
																break;
															}
														}
													}
													$custom_meta = get_post_meta(get_the_ID(),'edd_custom_field',true);
													if($ex_df==1 || $custom_meta){
													?>
														<div class="info-cell">
															<div class="info-cell-content">
															<?php 
															if($edd_defaultmeta){
																foreach($edd_defaultmeta as $defaultmeta){
																	$value = get_post_meta(get_the_ID(),'edd_'.sanitize_title($defaultmeta),true);
																	if($value){
																	?>
																	<div class="content-item">
																		<div><?php echo esc_html($defaultmeta); ?></div>
																		<div><?php echo esc_html($value); ?></div>
																	</div>
																	<?php
																	}
																}
															}
															
															if($custom_meta){
																foreach($custom_meta as $meta){ ?>
																		<div class="content-item">
																			<div><?php echo esc_html($meta['title']); ?></div>
																			<div><?php echo esc_html($meta['edd_custom_value']); ?></div>
																		</div>
																	<?php
																}
															}
															?>
															</div>
														</div>
													<div class="info-cell"></div>
													<?php }?>
													<div class="info-cell">
														<div class="info-cell-content">
															<?php businesshub_checkout_action();?>
														</div>
													</div>
													
												</div>
											</div>
										</div>
                                    <?php }?>
                                    <div class="body-content">
                                    <?php while ( have_posts() ) : the_post();?> 
                                    	<?php
										$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content(),1);
										$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content,1);
										$content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $content,1);
										$content =  preg_replace ('#\[/audio]#s', ' ', $content,1);
										preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
										foreach ($match[0] as $amatch) {
											if(strpos($amatch,'soundcloud.com') !== false){
												$content = str_replace($amatch, '', $content);
											}
										}
										$content = preg_replace('%<object.+?</object>%is', '', $content,1);
										echo apply_filters('the_content',$content); ?>
										<?php
                                            wp_link_pages( array(
                                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cactus' ),
                                                'after'  => '</div>',
                                            ) );
                                        ?>
                                    	<?php endwhile;?>
                                    </div>                                     
                                    
                                    <div class="elms-tag-share-content product-content">                                        
                                        <div>                                            
                                        	<?php businesshub_print_social_share();?>
                                        </div>
                                    </div>
                                    <?php if($digital_single_style !='2'){ ?>
                                    <div class="bottom-buy-info">                                        
                                        
                                        	<?php businesshub_checkout_action();?>
                                        
                                    </div>
                                    <?php } ?>
                          		</article>
                          	</div>
                            
                        </div>
                    </div>
                    
                    <?php if($post_sidebar != 'hidden' && $digital_single_style !='2'){get_sidebar();}
					if($digital_single_style =='2'){
						?>
                        <?php
						$edd_defaultmeta = ot_get_option('edd_defaultmeta')?explode(",", ot_get_option('edd_defaultmeta')):'';
						$ex_df = 0;
						
						if($edd_defaultmeta){
							foreach($edd_defaultmeta as $check_ex){
								$ex_vl = get_post_meta(get_the_ID(),'edd_'.sanitize_title($check_ex),true);
								if($ex_vl){
									$ex_df = 1;
									break;
								}
							}
						}
						$custom_meta = get_post_meta(get_the_ID(),'edd_custom_field',true);
						?>
                            <div class="col-md-3 cactus-sidebar">
                                <div class="cactus-sidebar-content">
                                	<aside class="col-md-3 widget widget_text module widget-col widget-box-style-1 widget-box-style-2 no-hr">
                                        <div class="info-cell">
                                            <div class="info-cell-content">
                                                <?php businesshub_checkout_action();?>
                                            </div>
                                        </div>
                                    </aside>
                                	<?php
                                    if($ex_df==1 || $custom_meta){?>
                                        <aside class="col-md-3 widget widget_text module widget-col widget-box-style-1 widget-box-style-2 no-hr">
                                          <div class=" widget-inner">                                
                                            <div class="textwidget">
                                                <?php 
                                                if($edd_defaultmeta){
                                                    foreach($edd_defaultmeta as $defaultmeta){
                                                        $value = get_post_meta(get_the_ID(),'edd_'.sanitize_title($defaultmeta),true);
                                                        if($value){ ?>
                                                            <span class="port-title"><?php echo esc_html($defaultmeta); ?></span>
                                                            <span class="port-content"><?php echo esc_html($value); ?></span>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                if($custom_meta){
                                                    foreach($custom_meta as $meta){ ?>
                                                        <span class="port-title"><?php echo esc_html($meta['title']); ?></span>
                                                        <span class="port-content"><?php echo esc_html($meta['edd_custom_value']); ?></span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                          </div>
                                        </aside>
                                    <?php }?>
                                </div>
                            </div>
                    <?php }?>
                </div>
        	</div>  
                  
        </div>
        
    </div>
<?php 
if($reletd_number !='0'){
	get_template_part( 'html/single/related-download');
}
?>
<div id="added-to-cart"><?php echo esc_html__('ADDED TO CART', 'cactus');?></div>
<?php get_footer(); ?>