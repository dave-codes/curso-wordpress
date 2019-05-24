<?php

/**
 * return number of published sticky posts
 */
function businesshub_get_sticky_posts_count() {
	 global $wpdb;
	 $sticky_posts = array_map( 'absint', (array) get_option('sticky_posts') );
	 return count($sticky_posts) > 0 ? $wpdb->get_var($wpdb->prepare( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (%s)",implode(',', $sticky_posts)) ) : 0;
}

/**
 * Get related posts
 *
 * @params $post_id (optional). If not passed, it will try to get global $post
 */
if(!function_exists('businesshub_get_related_posts')){
	function businesshub_get_related_posts( $options = array() ) 
	{
		if($options['enable_yarpp_plugin'] == 'on' && is_plugin_active('yet-another-related-posts-plugin/yarpp.php'))
		{
		    $related_posts =  yarpp_get_related(array('limit' => $options['related_post_limit'], 'post_type' => 'post'), $options['post_ID']);
		}
		else
		{
		    $args = array(
		        'post_type'             => 'post',
		        'posts_per_page'        => $options['related_post_limit'],
		        'orderby'               => $options['get_related_order_by'],
		        'post_status'           => 'publish',
		        'post__not_in'          => array($options['post_ID']),
		        'ignore_sticky_posts'   => true
		    );

		    if($options['get_related_post_by'] != '' && $options['get_related_post_by'] == 'cat')
		    {
		        //get categories of post
		        $categories =  get_the_category($options['post_ID']);
		        $cats       = array();
		        if(count($categories) > 0)
		        {
		            foreach($categories as $category)
		            {
		                $cats[] = $category->term_id;
		            }
		            $cats_str = implode(",",$cats);
		            $args['cat'] = $cats_str;
		        }
		    }
		    else if($options['get_related_post_by'] != '' && $options['get_related_post_by'] == 'tag')
		    {
		        $tags       = wp_get_post_tags($options['post_ID']);
		        $tags_arr   = array();
		        if(count($tags) > 0)
		        {
		            foreach($tags as $tag)
		            {
		                $tags_arr[] = $tag->term_id;
		            }
		            $args['tag__in'] = $tags_arr;
		        }
		    }

		    $related_post_query = new WP_Query( $args );
		    $related_posts      = $related_post_query->posts;
		}
		return $related_posts;
	}
}