<?php
$port_sg_style = businesshub_get_global_sgportfolio_style();
$port_header_background		= get_post_meta(get_the_ID(),'port_header_background', true );
$meta_video_embed = businesshub_get_global_sgportfolio_video();
$images = businesshub_get_global_sgportfolio_images();?>
<div class="header-style-forall s-style-8 ct-project <?php if($port_sg_style && ($port_sg_style=='small-image' || $port_sg_style=='small-gallery') || (empty($images) && !has_post_thumbnail() && $meta_video_embed =='')){ ?> p-v2 <?php }?>">
  <div class="hs-ct-content">
  	  <?php
	  $bg_header =  $bg_img_header = $header_bg_repeat = $header_bg_attachment = $header_bg_position ='';
	  if(function_exists('op_get')){
		  $bg_header =  isset($port_header_background['background-color']) ? $port_header_background['background-color'] : op_get('ct_portfolio_settings','portfolio-headerbg');
		  $bg_header = str_replace("#", "", $bg_header);
		  $bg_img_header =  isset($port_header_background['background-image']) ? $port_header_background['background-image'] : op_get('ct_portfolio_settings','portfolio-header_img');
		  $header_bg_repeat =  isset($port_header_background['background-repeat']) ? $port_header_background['background-repeat'] : op_get('ct_portfolio_settings','header_bg_repeat');
		  $header_bg_attachment =  isset($port_header_background['background-attachment']) ? $port_header_background['background-attachment'] : op_get('ct_portfolio_settings','header_bg_attachment');
		  $header_bg_position =  isset($port_header_background['background-position']) ? $port_header_background['background-position'] : op_get('ct_portfolio_settings','header_bg_position');
		  $header_bg_size =  isset($port_header_background['background-size']) ? $port_header_background['background-size'] : op_get('ct_portfolio_settings','background-size');
	  }
	  ?> 	
      <div class="bg-header-top" style=" <?php if($bg_img_header){ echo 'background-image:url('.$bg_img_header.');';}?> <?php if($header_bg_repeat){ echo 'background-repeat:'.$header_bg_repeat.';';}?> <?php if($header_bg_attachment){ echo 'background-attachment:'.$header_bg_attachment.';';}?> <?php if($header_bg_position){ echo 'background-position:'.$header_bg_position.';';}?> <?php if($bg_header){ echo 'background-color:#'.$bg_header.';';}?> <?php if($header_bg_size){ echo 'background-size:'.$header_bg_size.';';}?>">
          
          <div class="header-style-basic container container-1340 dark-div">
          	  <?php 
			  $terms = wp_get_post_terms( get_the_ID(), 'portfolio_cat');
			  $count = 0; $i=0;
			  foreach ($terms as $term) {
				  $count ++;
			  }
			  if($count!=0){
			  ?>	
              <div class="categories">
				  <?php 
                  foreach ($terms as $term) {
                      $i++;
                      echo '<a href="'.get_term_link($term->slug, 'portfolio_cat').'" class="cactus-note-cat">'.$term->name.'</a> ';
                      if($i!=$count){ echo ', ';}
                  }
                  ?>
              </div>
              <?php }?>
              <h1 class="h3"><?php the_title(); ?></h1>
          </div>
      </div>
  </div>
</div>