<?php

class businesshub_latest_posts_widget extends WP_Widget
{
	function businesshub_latest_posts_widget()
	{
		$options = array(
			'classname' 	=> 'latest-posts-wrap cactus-all-post-widget',
			'description' 	=> esc_html__('Show Latest Posts', 'cactus')
			);
		parent::__construct('latest_posts_id', esc_html__('BusinessHub - Latest Posts','cactus'), $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title'					=> esc_html__('Latest Posts', 'cactus'),
			'number_of_posts' 		=> '3',
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr(empty($instance['title']) ? '' : $instance['title']);
		$category 				= esc_attr(empty($instance['category']) ? '' : $instance['category']);
		$tags 					= esc_attr(empty($instance['tags']) ? '' : $instance['tags']);
		$post_ids 				= esc_attr(empty($instance['post_ids']) ? '' : $instance['post_ids']);
		$number_of_posts 		= esc_attr(empty($instance['number_of_posts']) ? '' : $instance['number_of_posts']);

		// Create form
		$html 	= '';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Category - Category ID or Slug', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('category') . '" value="' . $category . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Tags - Tag List', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('tags') . '" value="' . $tags . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Post IDs - If this param is used, other params are ignored', 'cactus') . ' </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('post_ids') . '" value="' . $post_ids . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Number of posts', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_posts') . '" value="' . $number_of_posts . '"/>';
		$html  .= '</p>';

		echo $html;
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['category'] 				= strip_tags($new_instance['category']);
		$instance['tags'] 					= strip_tags($new_instance['tags']);
		$instance['post_ids'] 				= strip_tags($new_instance['post_ids']);
		$instance['number_of_posts'] 		= strip_tags($new_instance['number_of_posts']);
		return $instance;
	}

	function widget($args, $instance)
	{
		$direction ='';
		if(ot_get_option( 'rtl', 0)){
			$direction = 'dir="ltr"';
		}
		//extract  this array to use variable below
		extract($args);

		$title 					= $instance['title'] != '' ? $instance['title'] : esc_html__('Recent Posts', 'cactus');
		$cat 					= $instance['category'];
		$tags 					= $instance['tags'];
		$post_ids 				= $instance['post_ids'];
		$number_of_posts 		= $instance['number_of_posts'] != '' ? $instance['number_of_posts'] : '3';

		$options = array(
			'post_type' 			=> 'post',
			'posts_per_page' 		=> $number_of_posts,
			'orderby' 				=> 'post_date',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> true
		);

		// if you don't setup post_ids param
		if(isset($post_ids) && $post_ids == '')
		{
			if(isset($cat) && $cat != '')
			{
				$cats = explode(",",$cat);
				if(is_numeric($cats[0]))
					$options['cat'] = $cat;
				else
					$options['category_name'] = $cat;
			}
			if(isset($tags) && $tags != '')
			{
				$by_tag = explode(",",$tags);
				$options['tag_slug__in'] = $by_tag;
			}
		}
		else
		{
			$ids = explode(",",$post_ids);
			if(is_numeric($ids[0]))
				$options['post__in'] = $ids;
		}

		$the_query = new WP_Query( $options );

		echo $before_widget;

		$html = '';
		$html .= '<div class="widget-inner latest-post">
					<h2 class="widget-title h4">'.$title.'</h2>
						<div class="cactus-widget-posts">';

		if($the_query->have_posts())
	    {
	    	while($the_query->have_posts())
    		{
    			$the_query->the_post();
				$postid = get_the_ID();
				$categories = get_the_category($postid);
				$category_name = $categories[0]->name;
				$category_url = get_category_link($categories[0]->term_id);
				$thumbnail_html = '';
				if(has_post_thumbnail($postid)){
					$thumbnail = businesshub_thumbnail('businesshub_latestpost_widget');
					$thumbnail_html = '<div class="widget-picture">
									  <div class="widget-picture-content"> <a title="' . get_the_title() . '" href="' . get_permalink() . '">
										'.$thumbnail.' 
										</a> </div>
										<div class="note-date-v1">'. get_the_date('M') .' '.get_the_date('j').' </div>
									</div>';
				}

    			$html .= '<div class="cactus-widget-posts-item">
								'.$thumbnail_html.'
								<div class="cactus-widget-posts-content">
								  <div class="categories">
									<a class="cactus-note-cat" href="' . $category_url . '" title="' . get_the_title() . '">' .  $category_name . '</a>
								  </div>
								  <h3 class="h6 widget-posts-title"> <a href="' . get_permalink() . '" title="Auto Draft">' . get_the_title() . '</a></h3>
								</div>
							  </div>';
    		}
    		wp_reset_postdata();
	    }
        $html .='	</div>
            	</div>';
	    echo $html;

		echo $after_widget;
	}
}

add_action('widgets_init',  create_function('', 'return register_widget("businesshub_latest_posts_widget");'));
