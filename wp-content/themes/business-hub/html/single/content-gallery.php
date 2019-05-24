<?php
/**
 * @package cactus
 */

$args = array(
	'post_parent' => $post->ID,
	'post_type' => 'attachment',
	'post_status' => 'any',
	'post_mime_type' => 'image',
	'numberposts' => 999,
	'exclude' => get_post_thumbnail_id(),
 );
$attachments = get_posts( $args );
?>
<?php if ($attachments) :?>
<div class="ct-ft-gallery">
    <div class="ct-post-gallery">
        <ul class="ct-post-gallery-wrapper">
		<?php
            foreach ( $attachments as $attachment ){
            $attachment_url = wp_get_attachment_image_src(  $attachment->ID, 'full' );
            $attachment_alt = $attachment->post_title;
        ?>
            <li><img src="<?php echo esc_attr($attachment_url[0]); ?>" alt="<?php echo esc_attr($attachment_alt); ?>"></li>
        <?php
            }// end foreach
        /*
		WP_Query( $args ) = wp_reset_postdata();
		query_posts ( $args ) = wp_reset_query();
		*/
		wp_reset_postdata();
        ?>
        </ul>
        <div class="cactus-slider-button-prev"></div>
        <div class="cactus-slider-button-next"></div>
    </div>
    <div class="cactus-slider-paper"></div>
</div>
<?php endif;?>

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