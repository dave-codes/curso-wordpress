<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cactus
 */
$archives_sidebar = ot_get_option('digital_archives_sidebar','right');
$digital_archives_full = ot_get_option('digital_archives_full','off');
get_header(); 
?>

	<div id="cactus-body-container">
    
    	<div class="cactus-sidebar-control <?php if( $archives_sidebar!='hidden' ){ echo "sb-".$archives_sidebar; }?>"> <!-- sb-right , sb-left -->
        
        	<div class="container container-1340-main <?php if($archives_sidebar == 'hidden' && $digital_archives_full=='on'){?> portfolio is-single <?php }?>">
            	<div class="row">
                
                	<div class="<?php echo esc_attr($archives_sidebar!='hidden'?'col-md-9':'col-md-12'); ?> main-content-col">
                    	<div class="main-content-col-body">
                        
                        	<div class="cactus-listing-wrap">
                            	<div class="cactus-listing-config "> <!--addClass: style-1 + (style-2 -> style-n)-->
                                    <div class="cactus-listing-config style-2 <?php if($archives_sidebar == 'hidden' && $digital_archives_full!='on'){?> style-2a <?php }?>"> <!--addClass: style-1 + (style-2 -> style-n)-->
                                        <div class="cactus-sub-wrap">
    
                                        <?php if ( have_posts() ) : ?>
                                
                                            <?php /* Start the Loop */ ?>
                                            <?php while ( have_posts() ) : the_post(); ?>
                                
                                                <?php
                                                    /* Include the Post-Format-specific template for the content.
                                                     * If you want to override this in a child theme, then include a file
                                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                                     */
                                                    get_template_part( 'html/loop/content-download');
                                                ?>
                                
                                            <?php endwhile; ?>
                                
                                        <?php else : ?>
                                
                                            <?php get_template_part( 'html/loop/content', 'none' ); ?>
                                
                                        <?php endif; ?>
                                        </div>
                                        <div class="page-navigation"><?php businesshub_paging_nav('.cactus-sub-wrap','html/loop/content-download'); ?></div>
                                    </div>
                                   
                                </div>
                                </div>
                            </div>
                        </div>
					  <?php if($archives_sidebar != 'hidden'){get_sidebar();} ?>
        		</div>  
            </div>      
        </div>
    </div>
<?php get_footer(); ?>
