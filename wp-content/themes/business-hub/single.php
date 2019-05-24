<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cactus
 */

$post_meta_sidebar = get_post_meta(get_the_ID(),'post_meta_sidebar', true );

if($post_meta_sidebar != 'default' && $post_meta_sidebar != ''){
	$post_sidebar = $post_meta_sidebar;
}else{
	$post_sidebar = ot_get_option('post_sidebar','right'); //theme options : right, left, hidden
}

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
                                    <?php get_template_part( 'html/single/content', get_post_format() ); ?>
                                    <div class="elms-tag-share-content">
                                        <?php $post_tag = ot_get_option('post_tag', 'on');
										if( $post_tag == 'on' ):?>
											<div>
												<div class="categories">
													<?php businesshub_get_tags();?>
												</div>
											</div>
										<?php endif;?>
                                        <div>
                                            <?php businesshub_print_social_share();?>
                                        </div>
                                    </div>
                                    <?php $post_about_author = ot_get_option('post_about_author', 'on');
										if( $post_about_author == 'on' ):?>
                                        <div class="cactus-author-post">
                                            <div class="cactus-author-pic">
                                                <div class="img-content"><?php echo get_avatar( get_the_author_meta('email'), 110 ); ?></div>
                                            </div>
                                            <div class="cactus-author-content">
                                                <div class="author-content">
                                                    <span class="author-name heading-font-1 h5"><?php echo esc_html('ABOUT THE AUTHOR: ', 'cactus')?><?php the_author_meta( 'display_name' ); ?></span>
                                                    <span class="author-body"><?php the_author_meta('description'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php $post_navigation = ot_get_option('post_navigation', 'on');
										if( $post_navigation == 'on' ):
											businesshub_post_nav();
										endif;
									?>
                                    <?php 
										$post_related = ot_get_option('post_related', 'on');
										if( $post_related == 'on' ):
											get_template_part( 'html/single/single', 'related' );
										endif;
									?>

                                    <?php
                                        // If comments are open or we have at least one comment, load up the comment template

                                        if (comments_open() || '0' != get_comments_number()) :

                                            comments_template();
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