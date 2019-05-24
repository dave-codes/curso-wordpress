<?php
$port_sg_style = businesshub_get_global_sgportfolio_style();
$meta_video_embed = businesshub_get_global_sgportfolio_video();
if($meta_video_embed!='' && $port_sg_style!='small-image'){ ?>
	<div class="col-md-12 project-features">
		<?php
		businesshub_project_embded_video($meta_video_embed);
		?>
    </div>
    <?php
}elseif(!empty($images)){?>
	<div class="col-md-12 project-features">
    	<?php if($port_sg_style =='big-image'){?>
		<div class="ct-ft-img-static">
		<?php
			$i =0;
			foreach((array)$images as $attachment_id => $attachment){
				$i++;
				$image_img_tag = wp_get_attachment_image_src( $attachment_id ,'full');
				?>
				<!-- display the gallery -->
				<div class="project-1-img-listing<?php if($i==1){echo '-left';}elseif($i==3){echo '-right';}?>">
					<img src="<?php echo esc_attr($image_img_tag[0]); ?>" alt="<?php echo esc_attr($attachment->post_title);?>">
				</div>
			<?php
			if($i==3){break;}
			}// end foreach?>
		</div>
        <?php }else{?>
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
        <?php }?>
	</div>    
	<?php
}else if(has_post_thumbnail()){$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);?>
<div class="col-md-12 project-features">
	<div class="ct-ft-img-static">
		<img src="<?php echo esc_attr($thumbnail[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
	</div>
</div>
<?php }?>
