<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$archives_sidebar = get_post_meta(get_the_ID(),'post_meta_sidebar', true );
if($archives_sidebar == 'default' ||  $archives_sidebar == ''){
	$archives_sidebar = ot_get_option('woosingle_sidebar','right');
}
get_header( 'shop' ); ?>
<div id="cactus-body-container" class="business-woolist single-woo">
	<div class="cactus-sidebar-control <?php if( $archives_sidebar!='hidden' ){ echo "sb-".$archives_sidebar; }?>"> <!-- sb-right , sb-left -->
    <div class="container container-1340-main">
    <div class="row">
    <div class="<?php echo esc_attr($archives_sidebar!='hidden'?'col-md-9':'col-md-12'); ?> main-content-col">
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
    </div>
    </div>
    </div>
</div>
<?php get_footer( 'shop' ); ?>
