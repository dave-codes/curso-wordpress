<?php

class businesshub_latest_comments_widget extends WP_Widget
{
	function businesshub_latest_comments_widget()
	{
		$options = array(
			'classname' 	=> 'widget cactus-all-post-widget w-comments',
			'description' 	=> esc_html__('Show Latest Comments', 'cactus')
			);
		parent::__construct('latest_comments_id', 'BusinessHub - Latest Comments', $options);
	}

	function form($instance)
	{
		$default_value 		= array(
			'title'					=> esc_html__('Latest Comments', 'cactus'),
			'number_of_comments' 	=> '3',
			);
		$instance 				= wp_parse_args((array) $instance, $default_value);
		$title 					= esc_attr($instance['title']);
		$number_of_comments		= esc_attr($instance['number_of_comments']);

		// Create form
		$html 	= '';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Title', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
		$html  .= '</p>';

		$html  .= '<p>';
		$html  .= '<label>' . esc_html__('Number of comments', 'cactus') . ': </label>';
		$html  .= '<input class="widefat" type="text" name="' . $this->get_field_name('number_of_comments') . '" value="' . $number_of_comments . '"/>';
		$html  .= '</p>';

		global $allowedposttags;
		$allowattributes = array('class'=>array(),'id'=>array(),'type'=>array(),'name'=>array(),'value'=>array());
		$allowedposttags['input']=$allowattributes;

		echo wp_kses_post($html,$allowedposttags);
	}

	function update($new_instance, $old_instance)
	{
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['number_of_comments'] 	= strip_tags($new_instance['number_of_comments']);
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

		$title 					= $instance['title'] != '' ? $instance['title'] : esc_html__('RELATED POSTS', 'cactus');
		$number_of_comments 	= $instance['number_of_comments'] != '' ? $instance['number_of_comments'] : '3';

		$options = array(
			'status'		=> 'approve',
			'number' 		=> $number_of_comments,
			'post_status' 	=> 'publish'
		);

		$comments = get_comments( $options );

		echo $before_widget;

		$html = '';
		$html .= '<h2 class="widget-title h4">'.$title.'</h2><div class="cactus-widget-posts">';

    	foreach($comments as $comment)
		{
			$avatar_size = 60;
			if($_is_retina_){ $avatar_size = 120; }
			$avatar = get_avatar( $comment->user_id, $avatar_size );
			
			if($avatar){
				$avatar_html=	'<div class="widget-picture">
									<div class="widget-picture-content">
										<a title="'.get_comment_author( $comment->comment_ID ).'" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">'.$avatar.'</a>
									</div>
								</div>';
			}else{
				$avatar_html = '';
			}			
			$html .= 	'<div class="cactus-widget-posts-item">
							'.$avatar_html.'
							<div class="cactus-widget-posts-content">
							  <div class="categories">
								<a class="cactus-note-cat" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" title="'. get_the_title( $comment->comment_post_ID ) . '">'.get_comment_author( $comment->comment_ID ).'</a>
							  </div>
								<h3 class="h6 widget-posts-title">
								<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" title="'. get_the_title( $comment->comment_post_ID ) . '">'. get_the_title( $comment->comment_post_ID ) . '</a>
								</h3>                                      
							</div>
						  </div>';
		}
		$html .= '</div>';
	    echo $html;
		echo $after_widget;
	}
}

add_action('widgets_init',  create_function('', 'return register_widget("businesshub_latest_comments_widget");'));

?>