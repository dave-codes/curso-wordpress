<?php
/**
 * The Template for displaying all related posts by Category & tag.
 *
 * @package cactus
 */

	$show_related_post = ot_get_option('show_related_post');

	if($show_related_post == 'off') return;

    $get_related_post_by    = ot_get_option('get_related_post_by', 'cat');
    $get_related_order_by   = ot_get_option('related_posts_order_by', 'date');

    $related_post_limit     = ot_get_option('related_posts_count', 3);
    $enable_yarpp_plugin    = ot_get_option('enable_yarpp_plugin_single_post', 'off');
    $related_posts          = businesshub_get_related_posts(array('post_ID' => $post->ID, 'related_post_limit' => $related_post_limit, 'get_related_order_by' => $get_related_order_by, 'get_related_post_by' => $get_related_post_by, 'enable_yarpp_plugin' => $enable_yarpp_plugin));

	if(count($related_posts) == 0) return;
?>
<div class="ct-related-post">
	<h2 class="ct-related-post-title"><?php esc_html_e('RELATED POSTS','cactus'); ?></h2>
	<div class="cactus-listing-wrap">
        <div class="cactus-listing-config"> <!--addClass: style-1 + (style-2 -> style-n)-->
            <div class="cactus-sub-wrap">
				<?php foreach ( $related_posts as $related_post) : ?>
					<div class="cactus-post-item hentry">
                        <div class="entry-content">
                        <?php if(has_post_thumbnail($related_post->ID)):?>
                            <!--picture (remove)-->
                            <div class="picture">
                                <div class="picture-content">
                                    <a href="<?php echo get_the_permalink($related_post->ID);?>" title="<?php the_title_attribute(array('post' => $related_post->ID));?>">
                                        <?php echo businesshub_thumbnail( $related_post->ID,'businesshub_thumb_megamenu' );?> 
                                    </a>
                                </div>
                                <div class="note-date heading-font-1"><span> <?php echo get_the_date('M', $related_post->ID)?> </span> <span><?php echo get_the_date('j', $related_post->ID)?></span></div>
                            </div>
                            <!--picture-->
                        <?php endif;?>
                            <div class="content">
                                <!--Title (no title remove)-->
                                <h3 class="h5 cactus-post-title entry-title">
                                    <a href="<?php echo get_the_permalink($related_post->ID);?>" title=""><?php the_title_attribute(array('post' => $related_post->ID));?></a>
                                </h3><!--Title-->
                                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
                            </div>
                        </div>
                    </div><!--item listing-->
                <?php endforeach; wp_reset_postdata();?>
            </div>
        </div>
    </div>
</div>
