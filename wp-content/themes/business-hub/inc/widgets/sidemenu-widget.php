<?php
 class businesshub_WP_Nav_Menu_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('Add a Side Menu to your sidebar.','cactus') );
		parent::__construct( 'side_menu', esc_html__('BusinessHub - Side Menu','cactus'), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['side_menu'] ) ? wp_get_nav_menu_object( $instance['side_menu'] ) : false;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		//$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		//echo $args['before_widget'];

		if ( !empty($instance['title']) )
			//echo $args['before_title'] . $instance['title'] . $args['after_title'];
		$wl_cl_options = get_option('cactusthemes') ;
		$nav_menu_args = array(
			'menu' => $nav_menu,
			'container'=> false,
			'items_wrap'=> '<ul>%3$s</ul>',
            'walker'=> new businesshub_custom_side_walker_nav_menu()
		);

		/**
		 * Filter the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param stdClass $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 */
		?>
        <div class="cactus-e-menu <?php echo esc_attr($wl_cl_options[$args['widget_id']])?>">
              <div class="cactus-e-menu-content">
                  
                  <div class="eco-menu-row">
                  
                      <div class="eco-main-menu">
                          <div class="eco-all-categories">
                              <div class="all-cat-no-link">
                                  <i class="fa fa-bars"></i>
                                  <span class="menu-name"><?php if ( !empty($instance['title']) ){ echo esc_html($instance['title']);}else{ esc_html_e('All Categories','cactus');}?></span>
                              </div>
                          </div>
							<?php 
                            wp_nav_menu($nav_menu_args);
							?>
                      </div>
                  </div>
              </div>
        </div>
        <?php  

		//echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['link'] ) ) {
			$instance['link'] = strip_tags( stripslashes($new_instance['link']) );
		}
		if ( ! empty( $new_instance['side_menu'] ) ) {
			$instance['side_menu'] = (int) $new_instance['side_menu'];
		}
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$link = isset( $instance['link'] ) ? $instance['link'] : '';
		$nav_menu = isset( $instance['side_menu'] ) ? $instance['side_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( esc_html__( 'No menus have been created yet. ','cactus' ).'<a href="%s">'.esc_html__('Create some','cactus').'</a>.', esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','cactus' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'side_menu' )); ?>"><?php esc_html_e( 'Select Menu:','cactus' ); ?></label>
				<select id="<?php echo esc_attr($this->get_field_id( 'side_menu' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'side_menu' )); ?>">
					<option value="0"><?php esc_html_e( '-- Select --','cactus' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
add_action('widgets_init',  create_function('', 'return register_widget("businesshub_WP_Nav_Menu_Widget");'));