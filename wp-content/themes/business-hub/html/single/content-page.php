<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package cactus
 */
?>
<div class="single-page-content single-content"> 
	<article id="post-<?php the_ID(); ?>" <?php post_class('cactus-single-content');?>>
    	<div class="body-content">
        	<?php the_content(); ?>
            
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cactus' ),
                    'after'  => '</div>',
                ) );
            ?>
            <!--Content-->
            <div class="entry-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'cactus' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-footer -->
            
        </div>
    </article>
</div>
