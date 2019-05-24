<?php
/**
 * @package cactus
 */
?>
<!--item listing-->
<?php 
preg_match("/<embed\s+(.+?)>/i", $post->post_content, $matches_emb); if(isset($matches_emb[0])){ echo $matches_emb[0];}
preg_match("/<source\s+(.+?)>/i", $post->post_content, $matches_sou) ;
preg_match('/\<object(.*)\<\/object\>/is', $post->post_content, $matches_oj); 
preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches);
preg_match( '#\[audio\s*.*?\]#s', $post->post_content, $matches_sc );
preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $post->post_content, $match);
 $check_link_s ='';
if(isset($match[0])){
	foreach ($match[0] as $matc) {
		if(strpos($matc,'soundcloud.com') !== false){
			  $check_link_s = 1;break;
		}
	}
}

if(isset($matches_emb[0]) || isset($matches_sou[0]) || isset($matches_oj[0]) || isset($matches[0]) || isset($matches_sc[0]) || ($check_link_s==1)){?>
	<div class="style-post">
        <div class="style-audio-content">
            <div class="audio-iframe">
				<?php
                if(!isset($matches_emb[0]) && isset($matches_sou[0])){
                    echo $matches_sou[0];
                }else if(!isset($matches_sou[0]) && isset($matches_oj[0])){
                    echo $matches_oj[0];
                }else if( !isset($matches_oj[0]) && isset($matches[0])){
                    echo $matches[0];
                }else
                if( !isset($matches[0]) && isset($matches_sc[0])){
                     echo do_shortcode($matches_sc[0]);
                }else if( !isset($matches_sc[0]) && isset($match[0])){
                    foreach ($match[0] as $matc) {
                        if(strpos($matc,'soundcloud.com') !== false){
                              echo wp_oembed_get($matc);break;
                        }
                    }
                }?>
            </div>
        </div>    
    </div>    
    <?php
}elseif( has_post_thumbnail() ){ ?>
<div class="style-post"> 
    
    <div class="ct-ft-standard">
        <?php echo businesshub_thumbnail('full');?>
    </div>    
        
</div>
<?php }