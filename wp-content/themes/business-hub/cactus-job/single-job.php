<?php
$sidebar = get_post_meta(get_the_ID(),'job_sidebar',true);
if(function_exists('op_get') && $sidebar==''){
	$sidebar = op_get('ct_job_settings','job-sidebar');
}
$header_background 	= get_post_meta(get_the_ID(),'post_meta_header_background', true );
$post_meta_header_background 	= isset($header_background['background-image']) ? $header_background['background-image'] : '';
$post_meta_header_color		 	= isset($header_background['background-color']) ? $header_background['background-color'] : '';
$bg_header =  $bg_img_header = $header_bg_repeat = $header_bg_attachment = $header_bg_position ='';
if(function_exists('op_get')){
	if($post_meta_header_color==''){
		$post_meta_header_color =  op_get('ct_job_settings','portfolio-headerbg');
	}
	if($post_meta_header_background==''){
		$post_meta_header_background =  op_get('ct_job_settings','portfolio-header_img');
	}
	if((!isset($header_background['background-repeat']) || $header_background['background-repeat']=='')){
		$header_background['background-repeat'] =  op_get('ct_job_settings','header_bg_repeat');
	}
	if((!isset($header_background['background-attachment']) || $header_background['background-attachment']=='')){
		$header_background['background-attachment'] =  op_get('ct_job_settings','header_bg_attachment');
	}
	if((!isset($header_background['background-position']) || $header_background['background-position']=='')){
		$header_background['background-position'] =  op_get('ct_job_settings','header_bg_position');
	}
	if((!isset($header_background['background-size']) || $header_background['background-size']=='')){
		$header_background['background-size'] =  op_get('ct_job_settings','background-size');
	}
}

if((isset($header_background['background-repeat']) && $header_background['background-repeat']!='') || (isset($header_background['background-attachment']) && $header_background['background-repeat']!='')|| (isset($header_background['background-position']) && $header_background['background-position']!='') || (isset($header_background['background-size']) && $header_background['background-size']!='')){?>
	<style type="text/css">
	.single.single-ct_job .bg-header-top{
		<?php if($header_background['background-attachment']!=''){?>
		background-attachment:<?php echo esc_attr($header_background['background-attachment']);?> !important;
		<?php }
		if($header_background['background-repeat']!=''){
		 ?>
		background-repeat:<?php echo esc_attr($header_background['background-repeat']);?> !important;
		<?php }
		if($header_background['background-position']!=''){?>
		background-position:<?php echo esc_attr($header_background['background-position']); ?> !important;
		<?php }
		if($header_background['background-size']!=''){?>
		background-size:<?php echo esc_attr($header_background['background-size']); ?> !important;
		<?php }?>
	}
	</style>
<?php
}
get_header(); ?>
    <div id="cactus-body-container">
    	<div class="cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>"> <!-- sb-right , sb-left -->
        	<div class="container container-1340-main">
            	<div class="row">
                	<div class="<?php echo esc_attr($sidebar!='full'?'col-md-9':'col-md-12'); ?> main-content-col">
                    	<div class="main-content-col-body">
                        <?php
                              while ( have_posts() ) : the_post();?>
                                <div class="single-post-content single-content"> 
                                    <article class="cactus-single-content">     
                                    	<h3 class="hidden-heading"><?php the_title();?></h3>                           
                                        <div class="elms-tag-share-content top-job">
                                        	<?php 
											$location = get_post_meta(get_the_ID(),'job-location', true );
											if($location!=''){?>
                                                <div>
                                                    <div class="categories">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="cactus-note-cat"><?php echo esc_attr(get_post_meta(get_the_ID(),'job-location', true ));?></span>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <div>                                                
                                                  <?php businesshub_print_social_share();?>
                                            </div>
                                        </div>
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
                                        <?php 
										$job_url = get_post_meta(get_the_ID(),'job-apply-url', true );
										if($job_url!=''){
										?>
                                        	<a href="<?php echo esc_attr(get_post_meta(get_the_ID(),'job-apply-url', true ));?>" class="btn btn-default imp-color-1 apply-job"><?php esc_html_e('APPLY','cactus');?></a>
                                        <?php }?>
                                                                            
                                    </article>
                                </div>
                                <?php
                              endwhile;
                          	?>
                        </div>
                    </div>
                    <?php if($sidebar!='full'){ get_sidebar(); } ?>
                </div>
        	</div>  
        </div>
    </div>
<?php
get_footer();
