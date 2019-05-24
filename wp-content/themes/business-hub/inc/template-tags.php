<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cactus
 */

if ( ! function_exists( 'businesshub_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @params $content_div & $template are passed to Ajax pagination
 */
function businesshub_paging_nav($content_div = '#main', $template = 'html/loop/content') {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	$nav_type = ot_get_option('navigation','def');
	switch($nav_type){
		case 'def':
			cacus_paging_nav_default();
			break;
		case 'ajax':
			cacus_paging_nav_ajax($content_div, $template);
			break;
		case 'wp_pagenavi':
			if( ! function_exists( 'wp_pagenavi' ) ) {	
				// fall back to default navigation style
				cacus_paging_nav_default(); 
			} else {
				wp_pagenavi();
			}
			break;
	}
}
endif;

if ( ! function_exists( 'cacus_paging_nav_default' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable. Default WordPress style
 */
function cacus_paging_nav_default() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	?>
	<nav class="navigation paging-navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'cactus' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span>'.esc_html__( ' OLDER POSTS', 'cactus' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'NEWER POSTS ', 'cactus' ).'<span class="meta-nav">&rarr;</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'cacus_paging_nav_ajax' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable. Ajax loading
 *
 * @params $content_div (string) - ID of the DIV which contains items
 * @params $template (string) - name of the template file that hold HTML for a single item. It will look for specific post-format template files
			For example, if $template = 'content'
				it will look for content-$post_format.php first (i.e content-video.php, content-audio.php...)
				then it will look for content.php if no post-format template is found
*/
function cacus_paging_nav_ajax($content_div = '#main', $template = 'content') {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$load_more_text = ot_get_option('load_more_text');
	?>
       <nav class="navigation-ajax">
           <div class="wp-pagenavi">
               <a href="javascript:;" data-target="<?php echo esc_attr($content_div);?>" data-template="<?php echo esc_attr($template); ?>" id="navigation-ajax" class="load-more">
                   <div class="load-title"><?php if($load_more_text!=''){ echo esc_attr($load_more_text);}else{ echo esc_html__('LOAD MORE','cactus');}?></div>&nbsp;<div></div>&nbsp;<div></div>&nbsp;<div></div>
               </a>
           </div>
       </nav>                                            
	<?php
}
endif;

if ( ! function_exists( 'businesshub_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function businesshub_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	 <div class="cactus-navigation-post">
     
     	<?php if($previous):?>
                <?php previous_post_link( '<div class="prev-post h5">%link</div>', wp_kses(__( '<span><i class="fa fa-long-arrow-left"></i>PREVIOUS POSTS</span> %title', 'cactus' ),array('span'=>array(), 'i'=>array('class'=>array()), array('a'=>array('href'=>array(),'title'=>array(),'rel'=>array(),'class'=>array())))) ); ?>
        <?php endif; ?>
        <?php if($next):?>
                <?php next_post_link( '<div class="next-post h5">%link</div>',  wp_kses(__( '<span>NEXT POSTS<i class="fa fa-long-arrow-right"></i></span> %title', 'cactus' ),array('span'=>array(), 'i'=>array('class'=>array()), array('a'=>array('href'=>array(),'title'=>array(),'rel'=>array(),'class'=>array())))) );?>
        <?php endif; ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'businesshub_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function businesshub_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( wp_kses( __('<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'cactus' ), array('span'=>array('class'=>array()) )),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function businesshub_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'businesshub_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'businesshub_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so businesshub_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so businesshub_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in businesshub_categorized_blog.
 */
function businesshub_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'businesshub_categories' );
}
add_action( 'edit_category', 'businesshub_category_transient_flusher' );
add_action( 'save_post',     'businesshub_category_transient_flusher' );
// Global Function
function businesshub_get_global_title(){
	global $page_title;
	if(isset($page_title) && $page_title!=''){
		return $page_title;
	}
	if(is_search()){
		$page_title = esc_html__('Search Result: ','cactus').(isset($_GET['s'])?$_GET['s']:'');
	}elseif(is_category()){
		$page_title = single_cat_title('',false);
	}elseif(is_tag()){
		$page_title = single_tag_title('',false);
	}elseif(is_tax()){
		$page_title = single_term_title('',false);
	}elseif(is_author()){
		$author = get_userdata( get_query_var('author') );
		$page_title = esc_html__("Author: ",'cactus') . esc_html($author->display_name);
	}elseif(is_day()){
		$page_title = esc_html__("Archives for ",'cactus') . date_i18n(get_option('date_format') ,strtotime(get_the_date()));
	}elseif(is_month()){
		$page_title = esc_html__("Archives for ",'cactus') . get_the_date('F, Y');
	}elseif(is_year()){
		$page_title = esc_html__("Archives for ",'cactus') . get_the_date('Y');
	}elseif(is_home()){
		if(get_option('page_for_posts')){ $page_title = get_the_title(get_option('page_for_posts'));
		}else{
			$page_title = get_bloginfo('name');
		}
	}elseif(is_404()){
		$template_404 = ot_get_option('404_page');
		if($template_404!=''){
			$page_title = get_the_title($template_404);
		}else{
			$page_title = ot_get_option('404_title',esc_html__('404 - Page Not Found','cactus'));
		}
	}elseif(  function_exists ( "is_shop" ) && is_shop()){
		$page_title = woocommerce_page_title($echo = false);
    }elseif (!is_single() && !is_page() && is_post_type_archive()) {
		$post_type = get_post_type_object(get_post_type());
		$slug = $post_type->rewrite;
		$page_title = $slug['slug']?$slug['slug']:$post_type->labels->singular_name;
		$downloads_text = ot_get_option('downloads_text');
		if($post_type->query_var=='download' && $downloads_text!=''){
			$page_title = esc_attr($downloads_text);
		}
		if(is_post_type_archive( 'ct_portfolio' ) ){
			$page_title = esc_html__('PORTFOLIO','cactus');
		}
	}else{
		global $post;
		if($post){$page_title = $post->post_title;}
	}
	return $page_title;
}
function businesshub_get_global_archives_thumb($archives_layout=false, $archives_sidebar=false){
	global $archives_thumb;
	if(isset($archives_thumb) && $archives_thumb!=''){
		return $archives_thumb;
	}
	if(!isset($archives_sidebar)){
		$archives_sidebar = ot_get_option('archives_sidebar','right');
		if(is_front_page()){
			$archives_sidebar = get_post_meta(get_the_ID(),'page_meta_sidebar', true );
		}
	}
	if(!isset($archives_layout)){ 
		$archives_layout = ot_get_option('archives_layout','style_1');
		if(is_front_page()){
			$archives_layout = get_post_meta(get_the_ID(),'meta_page_layout', true );
		}
	}
	$archives_thumb = 'businesshub_thumb_960x640';
	if($archives_layout == 'style_2'){$archives_layout_class = 'style-2'; $archives_thumb='businesshub_thumb_460x307';}
	if($archives_layout == 'style_3_thumbnail'){$archives_layout_class = 'style-3 ct-border-bottom'; $archives_thumb='businesshub_thumb_megamenu';}
	// add by T
	if($archives_sidebar=='hidden' && $archives_layout == 'style_3_thumbnail'){
		$archives_thumb = 'businesshub_thumb_460x307';
	}elseif($archives_sidebar=='hidden' && $archives_layout == 'style_2'){
		$archives_thumb = 'businesshub_thumb_640x427';
	}elseif($archives_sidebar=='hidden' && $archives_layout == 'style_1'){
		$archives_thumb = 'full';
	}

	return $archives_thumb;
}
function businesshub_get_global_header_style(){
	global $header_style;
	if(isset($header_style) && $header_style!=''){
		return $header_style;
	}
	$header_style 			= ot_get_option('header_style', 'style_1');
	return $header_style;
}
function businesshub_get_global_nav_transparency(){
	global $nav_transparency;
	if(isset($nav_transparency) && $nav_transparency!=''){
		return $nav_transparency;
	}
	$nav_transparency 		= ot_get_option('header_opacity','0.25');
	return $nav_transparency;
}
function businesshub_get_global_wp_query(){
	global $wp_query;
	return $wp_query;
}
function businesshub_get_global_wp_(){
	global $wp;
	return $wp;
}
function businesshub_get_global_meta_nav_style(){
	global $meta_nav_style;
	if(isset($meta_nav_style) && $meta_nav_style!=''){
		return $meta_nav_style;
	}
	$meta_nav_style ='';
	if(is_page_template('page-templates/front-page.php')){
		$meta_nav_style = get_post_meta(get_the_ID(),'meta_nav_style', true );
	}
	return $meta_nav_style;
}
function businesshub_get_global_meta_header_schema(){
	global $meta_header_schema;
	if(isset($meta_header_schema) && $meta_header_schema!=''){
		return $meta_header_schema;
	}
	$meta_header_schema ='';
	if(is_page_template('page-templates/front-page.php')){
		$meta_header_schema = get_post_meta(get_the_ID(),'meta_header_schema', true );
	}
	return $meta_header_schema;
}
function businesshub_get_global_meta_nav_opacity(){
	global $meta_nav_opacity;
	if(isset($meta_nav_opacity) && $meta_nav_opacity!=''){
		return $meta_nav_opacity;
	}
	$meta_nav_opacity ='';
	if(is_page_template('page-templates/front-page.php')){
		$meta_nav_opacity = get_post_meta(get_the_ID(),'meta_nav_opacity', true );
	}
	return $meta_nav_opacity;
}
function businesshub_get_global_sgportfolio_style(){
	global $port_sg_style;
	if(isset($port_sg_style) && $port_sg_style!=''){
		return $port_sg_style;
	}
	$port_sg_style = get_post_meta(get_the_ID(),'portfolio-style',true);
	if(function_exists('op_get') && $port_sg_style ==''){
		 $port_sg_style =  op_get('ct_portfolio_settings','portfolio-style');
	}
	return $port_sg_style;
}
function businesshub_get_global_sgportfolio_images(){
	global $images;
	if(isset($images) && $images!=''){
		return $images;
	}
	$images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 999 ) );
	return $images;
}
function businesshub_get_global_sgportfolio_video(){
	global $meta_video_embed;
	if(isset($meta_video_embed) && $meta_video_embed!=''){
		return $meta_video_embed;
	}
	$meta_video_embed = get_post_meta(get_the_ID(),'portfolio-video_embed', true );
	return $meta_video_embed;
}
function businesshub_get_global_post(){
	global $post;
	return $post;
}
function businesshub_get_global_edd_login_redirect(){
	global $edd_login_redirect;
	return $edd_login_redirect;
}
function businesshub_get_global_edd_current_user(){
	global $current_user;
	return $current_user;
}
function businesshub_get_global_edd_register_redirect(){
	global $edd_register_redirect;
	return $edd_register_redirect;
}
function businesshub_get_global_wl_cl_options(){
	global $wl_cl_options;
	return $wl_cl_options;
}
function businesshub_get_global_wl_color_options(){
	global $wl_color_options;
	return $wl_color_options;
}
function businesshub_get_global_wl_bgcolor_options(){
	global $wl_bgcolor_options;
	return $wl_bgcolor_options;
}
function businesshub_get_global_wl_sepcolor_options(){
	global $wl_sepcolor_options;
	return $wl_sepcolor_options;
}
function businesshub_get_global_wl_textcolor_options(){
	global $wl_textcolor_options;
	return $wl_textcolor_options;
}
function businesshub_get_global_wl_options_width(){
	global $wl_options_width;
	return $wl_options_width;
}
function businesshub_get_global_paged(){
	global $paged;
	return $paged;
}