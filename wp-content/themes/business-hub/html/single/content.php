<?php
/**
 * @package cactus
 */
 
$post_feature_img = ot_get_option('post_feature_img', 'on');
?>
<?php if( $post_feature_img == 'on'):
	if( has_post_thumbnail() ){ ?>
		<div class="style-post"> 
			<div class="ct-ft-standard">
				<?php echo businesshub_thumbnail('full');?> 
			</div>    
				
		</div>
<?php } endif ?>

<?php businesshub_post_on();?>

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


