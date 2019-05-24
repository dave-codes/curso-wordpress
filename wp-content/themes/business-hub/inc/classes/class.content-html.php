<?php
if(!class_exists('businesshub_ContentHtml')){
	class businesshub_ContentHtml{
		function get_item_cat_html(){	
			$thumb='businesshub_thumb_megamenu';
			$html='';
			$html .= '	
			<div class="video-item">';
				if(has_post_thumbnail()){
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),$thumb , true);
					$html .='
					<div class="item-thumbnail">
						  <a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">';
							
							$html .= '<img src="'.esc_attr($thumbnail[0]).'" width="'.esc_attr($thumbnail[1]).'" height="'.esc_attr($thumbnail[2]).'" alt="'.the_title_attribute('echo=0').'" title="'.the_title_attribute('echo=0').'">
							<div class="link-overlay fa fa-search"></div>
						</a>
					</div>';
				}
				$html .='
				<div class="item-head">
					<h3><a href="'.get_permalink(get_the_ID()).'">'.strip_tags(get_the_title(get_the_ID())).'</a></h3>
				</div>
			</div>';
			return $html;
		}
	}
}
?>