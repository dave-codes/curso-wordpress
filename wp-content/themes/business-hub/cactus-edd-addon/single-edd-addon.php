<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cactus
 */


$post_sidebar = ot_get_option('post_sidebar','right'); //theme options : right, left, hidden

/*Cactus EDD Addon Plugin */
if(class_exists('businesshub_edd_addon') && function_exists('op_get')){
	$edd_addon_single 	= op_get('ct_edd_addon_settings','edd-addon-single-page');
	$edd_addon_single 	= isset($edd_addon_single) && $edd_addon_single != '' ? $edd_addon_single : 'on';
	$edd_addon_sidebar 	=  op_get('ct_edd_addon_settings','edd-addon-sidebar');
	$edd_addon_sidebar 	= isset($edd_addon_sidebar) && $edd_addon_sidebar != '' ? $edd_addon_sidebar : 'right';
	if($edd_addon_single == 'on'):
		if($edd_addon_sidebar != ''){ $post_sidebar = $edd_addon_sidebar; }
	endif;
}
/*Cactus EDD Addon Plugin - END */
$post_feature_img = ot_get_option('post_feature_img', 'on');
$product_news_published_date 	= get_post_meta(get_the_ID(), 'product_news_published_date', true);
$product_news_published_date 	= isset($product_news_published_date) && $product_news_published_date != '' ? $product_news_published_date : 'on';
$product_news_comment_count 	= get_post_meta(get_the_ID(), 'product_news_comment_count', true);
$product_news_comment_count 	= isset($product_news_comment_count) && $product_news_comment_count != '' ? $product_news_comment_count : 'on';
$product_news_social_share 		= get_post_meta(get_the_ID(), 'product_news_social_share', true);
$product_news_social_share	 	= isset($product_news_social_share) && $product_news_social_share != '' ? $product_news_social_share : 'on';
$product_news_post_nav 			= get_post_meta(get_the_ID(), 'product_news_post_nav', true);
$product_news_post_nav		 	= isset($product_news_post_nav) && $product_news_post_nav != '' ? $product_news_post_nav : 'on';
$product_news_comment		 	= get_post_meta(get_the_ID(), 'product_news_comment', true);
$product_news_comment		 	= isset($product_news_comment) && $product_news_comment != '' ? $product_news_comment : 'on';
get_header();
?>
<div id="cactus-body-container">
    <div class="cactus-sidebar-control <?php if($post_sidebar!='hidden'){echo "sb-".$post_sidebar;}?>"> <!-- sb-right , sb-left -->
        <div class="container container-1340-main">
            <div class="row">
                <div class="<?php echo esc_attr($post_sidebar!='hidden'?'col-md-9':'col-md-12'); ?> main-content-col">
                    <div class="main-content-col-body">
                        <div class="single-post-content single-content">
                            <?php while ( have_posts() ) : the_post();?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('cactus-single-content'); ?>>
                                    <?php if( $post_feature_img == 'on'):
										if( has_post_thumbnail() ){ ?>
											<div class="style-post"> 
												<div class="ct-ft-standard">
													<?php echo businesshub_thumbnail('full');?> 
												</div>    
													
											</div>
									<?php } endif ?>
									
									<div class="posted-on">
										<?php if( $product_news_published_date == 'on' ): ?>
                                            <div>
                                                <?php echo businesshub_get_datetime();?> 
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if( $product_news_comment_count == 'on' ): ?>
                                            <div class="ups_text"> 
                                                <a href="<?php comments_link(); ?>" class="comment cactus-info"><?php echo get_comments_number(get_the_ID()); esc_html_e(' comments','cactus')?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
									
									<div class="body-content">
										<?php the_content(); ?>
										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cactus' ),
												'after'  => '</div>',
											) );
										?>
									<?php edit_post_link( esc_html__( 'Edit', 'cactus' ), '<span class="edit-link">', '</span>' ); ?>    
									</div><!-- .entry-content -->
                                    <?php if ($product_news_social_share == 'on') : ?>
                                        <div class="elms-tag-share-content">
                                            <div>
                                                <?php businesshub_print_social_share();?>
                                            </div>
                                        </div>
									<?php endif;?>
                                    <?php if ($product_news_social_share == 'on') :
											businesshub_post_nav();
										endif;
									?>
                                    <?php // Comment area 
										// If comments are open or we have at least one comment, load up the comment template
										if ( $product_news_comment != 'off' && comments_open() ) : ?>
											<div class="wrap-block-list-comment">
												<div class="list-comment">
													<?php comments_template();?>
												</div>
											</div>
										<?php 
										endif;
                                    ?>
                                </article>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
                <?php if($post_sidebar != 'hidden'){get_sidebar();} ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>