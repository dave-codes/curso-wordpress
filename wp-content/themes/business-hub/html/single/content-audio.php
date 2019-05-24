<?php
/**
 * @package cactus
 */
 
	preg_match("/<embed\s+(.+?)>/i", $post->post_content, $matches_emb); if(isset($matches_emb[0])){ echo $matches_emb[0];}
	preg_match("/<source\s+(.+?)>/i", $post->post_content, $matches_sou) ;
	preg_match('/\<object(.*)\<\/object\>/is', $post->post_content, $matches_oj);
	preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches);
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match);
	
	if(!isset($matches_emb[0]) && isset($matches_sou[0])){
	  echo $matches_sou[0];
	}else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
	  echo $matches_oj[0];
	}else if( !isset($matches_oj[0]) && isset($matches[0])){
	  echo $matches[0];
	}else if( !isset($matches[0]) && isset($match[0])){
	  foreach ($match as $matc) {
		  if(isset($matc[0])){
			if(wp_oembed_get($matc[0])){
				echo '<div class="style-post"><div class="ct-ft-standard">'.wp_oembed_get($matc[0]).'</div></div>';
			}
		  }
	  }
	}
?>
    

<?php businesshub_post_on();?>

<div class="body-content">
<?php
	if(get_post_format()=='video' || get_post_format()=='audio'){
		$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content());
		$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content);
		preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
		foreach ($match[0] as $amatch) {
			if(strpos($amatch,'youtube.com') !== false || strpos($amatch,'youtu.be') !== false || strpos($amatch,'vimeo.com') !== false || strpos($amatch,'soundcloud.com') !== false || strpos($amatch,'wordpress.tv') !== false || strpos($amatch,'videopress.com') !== false){
				$content = str_replace($amatch, '', $content);
			}
		}
		$content = preg_replace('%<object.+?</object>%is', '', $content);
			echo apply_filters('the_content',$content);
	}else{ 
	the_content(); 
}?>
    <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cactus' ),
            'after'  => '</div>',
        ) );
    ?>
<?php edit_post_link( esc_html__( 'Edit', 'cactus' ), '<span class="edit-link">', '</span>' ); ?>    
</div><!-- .entry-content -->