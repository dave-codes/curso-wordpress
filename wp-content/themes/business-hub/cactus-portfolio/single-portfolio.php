<?php
$images = businesshub_get_global_sgportfolio_images();
$port_sg_style =''; 
$port_sg_style = businesshub_get_global_sgportfolio_style();
$meta_video_embed = businesshub_get_global_sgportfolio_video();
$images = businesshub_get_global_sgportfolio_images();
if(!function_exists('businesshub_project_embded_video')){
	function businesshub_project_embded_video($meta_video_embed){
		?>
		<div class="ct-ft-gallery fix-video-style">
			<div class="ct-video-style">
				<?php echo $meta_video_embed;?>
			</div>
		</div>
		<?php
	}
}
get_header(); ?>
    <div id="cactus-body-container">
    
    	<div class="cactus-sidebar-control sb-right <?php if($port_sg_style=='small-image' || $port_sg_style=='small-gallery'){?> portfolio-style <?php }?>"> <!-- sb-right , sb-left -->
        
        	<div class="container container-1340-main">
            <?php
				while ( have_posts() ) : the_post();?>
            	<div class="row">
					<?php 
					if($port_sg_style!='small-image' && $port_sg_style!='small-gallery'){
						get_template_part( 'cactus-portfolio/content-image');
					}?>
                	<div class="col-md-9 main-content-col">
                    	<div class="main-content-col-body">
                        	<?php if($port_sg_style=='small-image' || $port_sg_style=='small-gallery'){
								if(!empty($images) && $port_sg_style=='small-image'){
									foreach((array)$images as $attachment_id => $attachment){
									$image_img_tag = wp_get_attachment_image_src( $attachment_id ,'full');
									?>
                                        <div class="portfolio-ng-img">
                                            <img src="<?php echo esc_attr($image_img_tag[0]); ?>" alt="<?php echo esc_attr($attachment->post_title);?>">
                                        </div>
								<?php }
                                }elseif($meta_video_embed!='' && $port_sg_style!='small-image'){ 
									businesshub_project_embded_video($meta_video_embed);
								}elseif(!empty($images) && $port_sg_style=='small-gallery'){
									?>
                                    <div class="ct-ft-gallery">
                                        <div class="ct-post-gallery">
                                            <ul class="ct-post-gallery-wrapper">
                                                <?php
                                                foreach((array)$images as $attachment_id => $attachment){
                                                $image_img_tag = wp_get_attachment_image_src( $attachment_id ,'full');?>
                                                    <li><img src="<?php echo esc_attr($image_img_tag[0]); ?>" alt="<?php echo esc_attr($attachment->post_title);?>"></li>
                                                <?php }?>                                   				
                                            </ul>                                                
                                            <div class="cactus-slider-button-prev"></div>
                                            <div class="cactus-slider-button-next"></div>
                                        </div>
                                        <div class="cactus-slider-paper"></div>
                                    </div>
                                <?php
								}else if(has_post_thumbnail()){$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);?>
                                    <div class="portfolio-ng-img">
                                          <img src="<?php echo esc_attr($thumbnail[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
                                    </div>
                                <?php }
							}else{
								 get_template_part( 'cactus-portfolio/content-single'); 
							}?>
                            
                        </div>
                    </div>
                    <?php
					if(function_exists('op_get')){
						$tmr_options =  op_get('ct_portfolio_settings','portfolio-metadata');
					}
					$rt ='';
					if($tmr_options!=''){
						$tmr_criteria = $tmr_options?explode(",", $tmr_options):'';
						foreach($tmr_criteria as $grt){
							$rt = get_post_meta(get_the_ID(),'portfolio_'.sanitize_title($grt),true);
							if($rt!=''){break;}
						}	
					}
					?>
					<div class="col-md-3 cactus-sidebar">
						<div class="cactus-sidebar-content">
							<?php if($rt!=''){?>
							<aside id="text-2" class="col-md-3 widget widget_text module widget-col widget-box-style-1 widget-box-style-2 no-hr">
							  <div class=" widget-inner">                                
								<div class="textwidget">
									<?php if($tmr_criteria){
										foreach($tmr_criteria as $criteria){
											$value = get_post_meta(get_the_ID(),'portfolio_'.sanitize_title($criteria),true);
											if($value){
											?>
											<span class="port-title"><?php echo esc_html($criteria); ?></span>
											<span class="port-content"><?php echo esc_html($value); ?></span>
											<?php
											}
										}
									}?>
								</div>
							  </div>
							</aside>
							<?php }
							if($port_sg_style=='small-image' || $port_sg_style=='small-gallery'){
								get_template_part( 'cactus-portfolio/content-single');
							}?>
							
						</div>
					</div>
                    <?php
					?>
                </div>
                <?php endwhile;?>
        	</div>  
                  
        </div>
        
    </div>    
<?php
$reletd_number = '';
if(function_exists('op_get')){
	$reletd_number =  op_get('ct_portfolio_settings','portfolio_number_related');
}
if($reletd_number !='0'){
	get_template_part( 'cactus-portfolio/single-related');
}
?>
    <?php
get_footer();
