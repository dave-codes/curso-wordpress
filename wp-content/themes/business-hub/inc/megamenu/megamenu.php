<?php
/*
Plugin Name: Cactus - Mega Menu
Plugin URI: http://www.cactusthemes.com
Description: Rewrite menu
Author: Cactusthemes
Author URI: http://www.cactusthemes.com
License: TF
Version: 1.0
*/

define('MASHMENU_NAV_LOCS',	'wp-mash-menu-nav-locations');
define('MASHMENU_VERSION', '1.6');
require_once get_template_directory() .'/inc/megamenu/core/MegaMenuWalker.class.php';

class MashMenuContentHelper{
	/*
	 * Get 6 Latest posts in custom category (taxonomy)
	 *
	 * $post_type: post type to return
	 * $tax: type of custom taxonomy
	 * $cat_id: custom taxonomy ID
	 * Return HTML
	 */
	function getLatestCustomCategoryItems($cat_id, $tax, $post_type = 'any'){

		$term = get_term_by('id',$cat_id,$tax);
		if($term === false){
			return;
		}

		$args = array('posts_per_page'=>6,'post_type'=>$post_type,$tax=>$term->slug);

		$mega_query = new WP_Query($args);

		$html = '';

		ob_start();

		$tmp_post = $post;
		$options = get_option('mashmenu_options');
		$sizes = $options['thumbnail_size'];
		$width = 200;$height = 200;

		if($sizes != '') {
			$sizes = explode('x',$sizes);
			if(count($sizes) == 2){
				$width = intval($sizes[0]);
				$height = intval($sizes[1]);
				if($width == 0) $width = 200;
				if($height == 0) $height = 200;
			}
		}

		while($mega_query->have_posts()) : $mega_query->the_post();

		?>
		<div class="content-item">
			<?php $options['image_link'] = 'on'; if($options['image_link'] == 'on'){?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
				<?php the_post_thumbnail(array($width,$height));?>
			</a>
			<?php } else {?>
			<?php the_post_thumbnail(array($width,$height));?>
			<?php }?>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
		</div>
		<?php
		endwhile;

		$html = ob_get_contents();
		ob_end_clean();

		wp_reset_postdata();

		$post = $temp_post;

		return $html;
	}

	/*
	 * Get 6 Latest posts in category
	 *
	 * Return HTML
	 */
	function getLatestCategoryItems($cat_id, $post_type = 'post'){
		$args = array('posts_per_page'=>3,'category'=>$cat_id,'post_type'=>$post_type);

		$posts = get_posts($args);
		$html = '';

		ob_start();

		global $post;
		$tmp_post = $post;
		$options = get_option('mashmenu_options');
		$sizes = $options['thumbnail_size'];
		$width = 520;$height = 354;

		if($sizes != '') {
			$sizes = explode('x',$sizes);
			if(count($sizes) == 2){
				$width = intval($sizes[0]);
				$height = intval($sizes[1]);
				if($width == 0) $width = 200;
				if($height == 0) $height = 200;
			}
		}
		$content_helper = new businesshub_ContentHtml;
		foreach($posts as $post) : setup_postdata($post);
		?>
		<div class="content-item col-md-4">
			<?php
			echo $content_helper->get_item_cat_html();
			?>
		</div>
		<?php
		endforeach;
		$html = ob_get_contents();
		ob_end_clean();

		$temp_post='';
		$post = $temp_post;

		return $html;
	}

	/*
	 * Get 6 Latest WooCommerce/JigoShop Products in category
	 *
	 * Return HTML
	 */
	function getWProductItems($cat_id){
		$html = '';

		// get slug by ID
		$term = get_term_by('id',$cat_id,'product_cat');
		if($term){
			$args = array('posts_per_page'=>6,'product_cat'=>$term->slug,'post_type'=>'product');
			$posts = get_posts($args);
			ob_start();
			global $post;
			$tmp_post = $post;
			$options = get_option('mashmenu_options');

			$sizes = $options['thumbnail_size'];
			$width = 200;$height = 200;
			if($sizes != '') {
				$sizes = explode('x',$sizes);
				if(count($sizes) == 2){
					$width = intval($sizes[0]);
					$height = intval($sizes[1]);
					if($width == 0) $width = 200;
					if($height == 0) $height = 200;
				}
			}

			foreach($posts as $post) : setup_postdata($post);

				if (class_exists('WC_Product')) {
					// WooCommerce Installed
					global $product;
				} else if(class_exists('jigoshop_product')){
					$product = new jigoshop_product( $post->ID ); // JigoShop
				}
			?>
			<div class="content-item">
				<?php $options['image_link'] = 'on'; if($options['image_link'] == 'on'){?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
					<?php the_post_thumbnail(array($width,$height));?>
				</a>
				<?php } else {?>
				<?php the_post_thumbnail(array($width,$height));?>
				<?php }?>
				<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php if ( ($options['show_price'] == 'left') && $price_html = $product->get_price_html() ) { echo esc_html($price_html); } ?> <?php the_title();?> <?php if ( (!isset($options['show_price']) || $options['show_price'] == '') && $price_html = $product->get_price_html() ) { echo esc_html($price_html); } ?></a></h3>
			</div>
			<?php
			endforeach;
			$html = ob_get_contents();
			ob_end_clean();

			$post = $temp_post;
		}
		return $html;
	}

	/*
	 * Get page content
	 *
	 * Return HTML
	 */
	function getPageContent($page_id){
		$page = get_page($page_id);

		$html = '';
		if($page){
			ob_start();
			?>
			<div class="page-item">
				<h3 class="title"><a href="<?php echo get_permalink($page->ID); ?>" title="<?php echo esc_attr($page->post_title);?>"><?php echo apply_filters('the_title', $page->post_title);?></a></h3>
				<?php
					$morepos = strpos($page->post_content,'<!--more-->');
					if($morepos === false){
						echo apply_filters('the_content',$page->post_content);
					} else {
						echo apply_filters('the_content',substr($page->post_content,0,$morepos));
					}
				?>
			</div>
			<?php
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	/*
	 * Get post content
	 *
	 * Return HTML
	 */
	function getPostContent($post_id){
		$page = get_post($post_id);

		$html = '';

		$options = get_option('mashmenu_options');
		$sizes = $options['thumbnail_size'];

		$width = 200;$height = 200;
		if($sizes != '') {
			$sizes = explode('x',$sizes);
			if(count($sizes) == 2){
				$width = intval($sizes[0]);
				$height = intval($sizes[1]);
				if($width == 0) $width = 200;
				if($height == 0) $height = 200;
			}
		}

		if($page){
			ob_start();
			?>
			<div class="page-item">
				<h3 class="title"><a href="<?php echo get_permalink($page->ID); ?>" title="<?php echo esc_attr($page->post_title);?>"><?php echo apply_filters('the_title', $page->post_title);?></a></h3>
				<div>
					<div class="thumb">
					<?php echo get_the_post_thumbnail( $page->ID, array($width,$height));?>
					</div>
				<?php
					$morepos = strpos($page->post_content,'<!--more-->');
					if($morepos === false){
						echo apply_filters('the_content',$page->post_content);
					} else {
						echo apply_filters('the_content',substr($page->post_content,0,$morepos));
					}
				?>
				</div>
			</div>
			<?php
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	/*
	 * Get 6 Latest posts that has tag id
	 *
	 * Return HTML
	 */
	function getLatestItemsByTag($tag_id, $post_type = 'post'){
		$tag = get_term($tag_id,'post_tag');
		$args = array('showposts'=>6,'tag'=>$tag->slug,'caller_get_posts'=>1,'post_status'=>'publish','post_type'=>$post_type);
		$mega_query = new WP_Query($args);

		$html = '';

		ob_start();
		$options = get_option('mashmenu_options');

		$sizes = $options['thumbnail_size'];
		$width = 200;$height = 200;
		if($sizes != '') {
			$sizes = explode('x',$sizes);
			if(count($sizes) == 2){
				$width = intval($sizes[0]);
				$height = intval($sizes[1]);
				if($width == 0) $width = 200;
				if($height == 0) $height = 200;
			}
		}

		while($mega_query->have_posts()) : $mega_query->the_post();
		?>
		<div class="content-item">
			<?php if($options['image_link'] == 'on'){?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
				<?php the_post_thumbnail(array($width,$height));?>
			</a>
			<?php } else {?>
			<?php the_post_thumbnail(array($width,$height));?>
			<?php }?>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
		</div>
		<?php
		endwhile;
		$html = ob_get_contents();
		ob_end_clean();

		$post = $temp_post;
		wp_reset_postdata();
		return $html;
	}
}

class MashMenu{
	protected $baseURL;

	protected $menuItemOptions;
	protected $optionDefaults;

	protected $count = 0;

	function __construct($base_url = ''){
		if( $base_url ){
			//Integrated theme version
			$this->baseURL = $base_url;
		}
		else{
			//Plugin Version
			$this->baseURL =  get_template_directory_uri().'/inc/megamenu/';
		}

		$this->menuItemOptions = array();

		//ADMIN
		if( is_admin() ){
			add_action( 'admin_menu' , array( $this , 'adminInit' ) );

			add_filter( 'wp_edit_nav_menu_walker', array( $this , 'editWalker' ) , 2000);
			add_action( 'wp_ajax_mashMenu_updateNavLocs', array( $this , 'updateNavLocs_callback' ) );			//For logged in users
			add_action( 'wp_ajax_mashMenu_addMenuItem', array( $this , 'addMenuItem_callback' ) );
			//Appearance > Menus : save custom menu options
			add_action( 'wp_update_nav_menu_item', array( $this , 'updateNavMenuItem' ), 10, 3); //, $menu_id, $menu_item_db_id, $args;
			add_action( 'mashmenu_menu_item_options', array( $this , 'menuItemCustomOptions' ), 10, 1);		//Must go here for AJAX purposes

			// front-end Ajax
			add_action( 'wp_ajax_mashMenu_getChannelContent', array( $this , 'getChannelContent_callback' ) );
			add_action( 'wp_ajax_nopriv_mashMenu_getChannelContent', array( $this , 'getChannelContent_callback' ));

			$this->optionDefaults = array(
				'menu-item-isMega'				=> 'off'
			);
		} else {
			$this->init();
		}

		add_action( 'init', array($this, 'register_sidebars' ), 500);
		add_action( 'wp_enqueue_scripts', array ($this, 'add_scripts'));
	}

	function register_sidebars(){
		$options = get_option('mashmenu_options');


		if(is_admin()){
			wp_enqueue_script('jscolor',$this->baseURL.'js/jscolor/jscolor.js');
		}
	}

	function init(){
		//Filters
		add_filter( 'wp_nav_menu_args' , array( $this , 'megaMenuFilter' ), 2000 );  	//filters arguments passed to wp_nav_menu
	}

	function adminInit(){
		//add_action( 'admin_head', array( $this , 'addActivationMetaBox' ) );

		//Appearance > Menus : load additional styles and scripts
		add_action( 'admin_print_styles-nav-menus.php', array( $this , 'loadAdminNavMenuJS' ) );
		add_action( 'admin_print_styles-nav-menus.php', array( $this , 'loadAdminNavMenuCSS' ));
	}

	/*
	 * Save the Menu Item Options
	 */
	function updateNavMenuItem( $menu_id, $menu_item_db_id, $args ){
		$mashmenu_options_string = isset( $_POST[sanitize_key('mashmenu_options')][$menu_item_db_id] ) ? $_POST[sanitize_key('mashmenu_options')][$menu_item_db_id] : '';
		$mashmenu_options = array();
		parse_str( $mashmenu_options_string, $mashmenu_options );

		$mashmenu_options = wp_parse_args( $mashmenu_options, $this->optionDefaults );

		update_post_meta( $menu_item_db_id, '_mashmenu_options', $mashmenu_options );
	}
	
	function getChannelContent_callback(){
		$data = $_POST[sanitize_key('data')];	 // Array(dataType, dataId, postType)
		$helper = new MashMenuContentHelper();
		switch($data[0]){
			case 'category':
				echo $helper->getLatestCategoryItems($data[1]);
				break;
			case 'post_tag':
				echo $helper->getLatestItemsByTag($data[1]);
				break;
			case 'page':
				echo $helper->getPageContent($data[1]);
				break;
			case 'post':
				echo $helper->getPostContent($data[1]);
				break;
			/* WooCommerce/JigoShop Product Category */
			case 'product_cat':
				echo $helper->getWProductItems($data[1]);
				break;
			/* Custom Taxonomy */
			default:
				echo $helper->getLatestCustomCategoryItems($data[1],$data[0],$data[2]);
				break;
		}

		die();
	}

	/*
	 * Update the Locations when the Activate Mash Menu Locations Meta Box is Submitted
	 */
	function updateNavLocs_callback(){

		$data = $_POST[sanitize_key('data')];
		$data = explode(',', $data);

		update_option( MASHMENU_NAV_LOCS, $data);

		echo $data;
		die();
	}

	function addMenuItem_callback(){

		if ( ! current_user_can( 'edit_theme_options' ) )
		die('-1');

		check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );

		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

		// For performance reasons, we omit some object properties from the checklist.
		// The following is a hacky way to restore them when adding non-custom items.

		$menu_items_data = array();
		foreach ( (array) $_POST[sanitize_key('menu-item')] as $menu_item_data ) {
			if (
				! empty( $menu_item_data['menu-item-type'] ) &&
				'custom' != $menu_item_data['menu-item-type'] &&
				! empty( $menu_item_data['menu-item-object-id'] )
			) {
				switch( $menu_item_data['menu-item-type'] ) {
					case 'post_type' :
						$_object = get_post( $menu_item_data['menu-item-object-id'] );
					break;

					case 'taxonomy' :
						$_object = get_term( $menu_item_data['menu-item-object-id'], $menu_item_data['menu-item-object'] );
					break;
				}

				$_menu_items = array_map( 'wp_setup_nav_menu_item', array( $_object ) );
				$_menu_item = array_shift( $_menu_items );

				// Restore the missing menu item properties
				$menu_item_data['menu-item-description'] = $_menu_item->description;
			}

			$menu_items_data[] = $menu_item_data;
		}

		$item_ids = wp_save_nav_menu_items( 0, $menu_items_data );
		if ( is_wp_error( $item_ids ) )
			die('-1');

		foreach ( (array) $item_ids as $menu_item_id ) {
			$menu_obj = get_post( $menu_item_id );
			if ( ! empty( $menu_obj->ID ) ) {
				$menu_obj = wp_setup_nav_menu_item( $menu_obj );
				$menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
				$menu_items[] = $menu_obj;
			}
		}

		if ( ! empty( $menu_items ) ) {
			$args = array(
				'after' => '',
				'before' => '',
				'link_after' => '',
				'link_before' => '',
				'walker' =>	new MashMenuWalkerEdit,			//EDIT FOR MASHMENU
			);
			echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
		}
	}

	function menuItemCustomOptions( $item_id ){
		?>

			<!--  START MASHMENU ATTS -->
			<div>
				<div class="wpmega-atts wpmega-unprocessed" style="display:block">
					<input id="mashmenu_options-<?php echo esc_attr($item_id);?>" class="mashmenu_options_input" name="mashmenu_options[<?php echo esc_attr($item_id);?>]" type="hidden" value="" />

					<?php $this->showMenuOptions( $item_id ); ?>

				</div>
				<!--  END MASHMENU ATTS -->
			</div>
	<?php
	}

	function showMenuOptions( $item_id ){
		if(ot_get_option('megamenu')=='on'){
			$this->showCustomMenuOption(
				'menu_style',
				$item_id,
				array(
					'level'    => '0',
					'title' => esc_html__( 'Select style for Menu' , 'cactus' ),
					'label' => esc_html__( 'Menu Style' , 'cactus' ),
					'type'     => 'select',
					'default' => '',
					'ops'    => array('list'=>esc_html__('List Style','cactus'),'columns'=>esc_html__('Columns Style','cactus'), 'preview'=>esc_html__('Preview Mode','cactus'))
				)
			);
		}
		
		/** Get Sidebar **/
		global  $wp_registered_sidebars;
			$arr = array("0"=>"No Sidebar");
			foreach ( $wp_registered_sidebars as $sidebar ) :
		         $arr = array_merge($arr, array($sidebar['id']=>$sidebar['name']));
		    endforeach;
		if(ot_get_option('megamenu')=='on'){
			$this->showCustomMenuOption(
				'addSidebar',
				$item_id,
				array(
					'level'	=> '1',
					'title' => esc_html__( 'Select the widget area to display' , 'cactus' ),
					'label' => esc_html__( 'Display widgets area ' , 'cactus' ),
					'type' 	=> 'select',
					'default' => '0',
					'ops'	=> $arr
				)
			);
		}
		/** Get Sidebar **/

		if(ot_get_option('megamenu')=='on'){
			$this->showCustomMenuOption(
				'displayLogic',
				$item_id,
				array(
					'level'	=> '0',
					'title' => esc_html__( 'Logic to display this menu item' , 'cactus' ),
					'label' => esc_html__( 'Display Logic' , 'cactus' ),
					'type' 	=> 'select',
					'default' => '',
					'ops'	=> array('both'=>esc_html__('Always visible','cactus'),'guest'=>esc_html__('Only Visible to Guests','cactus'),'member'=>esc_html__('Only Visible to Members','cactus'))
				)
			);
		}
		if(class_exists('businesshub_custom_side_walker_nav_menu')){
			$this->showCustomMenuOption(
				'sub_label',
				$item_id,
				array(
					'level'	=> '0',
					'title' => esc_html__( 'Only work with side menu widget' , 'cactus' ),
					'label' => esc_html__( 'Sub Label' , 'cactus' ),
					'type' 	=> 'text',
					'default' => '',
					'ops'	=> ''
				)
			);
			$this->showCustomMenuOption(
				'sub_label_color',
				$item_id,
				array(
					'level'	=> '0',
					'title' => esc_html__( 'Select color' , 'cactus' ),
					'label' => esc_html__( 'Sub Label color' , 'cactus' ),
					'type' 	=> 'color',
					'default' => '',
					'ops'	=> ''
				)
			);
			$this->showCustomMenuOption(
				'background_image',
				$item_id,
				array(
					'level'	=> '0',
					'title' => esc_html__( 'Only work with side menu widget' , 'cactus' ),
					'label' => esc_html__( 'Background Image' , 'cactus' ),
					'type' 	=> 'text',
					'default' => '',
					'ops'	=> ''
				)
			);
			$this->showCustomMenuOption(
				'background_link',
				$item_id,
				array(
					'level'	=> '0',
					'title' => esc_html__( 'Only work with side menu widget' , 'cactus' ),
					'label' => esc_html__( 'BackGround Link' , 'cactus' ),
					'type' 	=> 'text',
					'default' => '',
					'ops'	=> ''
				)
			);
			$this->showCustomMenuOption(
				'link_viewall',
				$item_id,
				array(
					'level'	=> '1',
					'title' => esc_html__( 'Only work with side menu widget' , 'cactus' ),
					'label' => esc_html__( 'Link view all' , 'cactus' ),
					'type' 	=> 'text',
					'default' => '',
					'ops'	=> ''
				)
			);
		}
	}

	function showCustomMenuOption( $id, $item_id, $args ){
		extract( wp_parse_args(
			$args, array(
				'level'	=> '0-plus',
				'title' => '',
				'label' => '',
				'type'	=> 'text',
				'ops'	=>	array(),
				'default'=> '',
			) )
		);

		$_val = $this->getMenuItemOption( $item_id , $id );

		$desc = '<span class="ss-desc">'.$label.'<span class="ss-info-container">?<span class="ss-info">'.$title.'</span></span></span>';
		
		?>
				<p class="field-description description description-wide wpmega-custom wpmega-l<?php echo esc_attr($level);?> wpmega-<?php echo esc_attr($id);?>">
					<label for="edit-menu-item-<?php echo esc_attr($id);?>-<?php echo esc_attr($item_id);?>">

						<?php

						switch($type) {
							case 'text':
								echo wp_kses($desc,array('span'=>array('class'=>array())));
								?>
								<input type="text" id="edit-menu-item-<?php echo esc_attr($id);?>-<?php echo esc_attr($item_id);?>"
									class="edit-menu-item-<?php echo esc_attr($id);?>"
									name="menu-item-<?php echo esc_attr($id);?>[<?php echo esc_attr($item_id);?>]"
									size="30"
									value="<?php echo htmlspecialchars( $_val );?>" />
								<?php

								break;
							case 'color':
								echo wp_kses($desc,array('span'=>array('class'=>array())));
								?>
								<input type="text" id="edit-menu-item-<?php echo $id;?>-<?php echo esc_attr($item_id);?>"
									class="edit-menu-item-<?php echo esc_attr($id);?> color {required:false}"
									name="menu-item-<?php echo esc_attr($id);?>[<?php echo esc_attr($item_id);?>]"
									size="30"
									value="<?php echo htmlspecialchars( $_val );?>" />
                                    <script type='text/javascript'>
									var side_color = new jscolor.color(document.getElementById('edit-menu-item-<?php echo esc_attr($id);?>-<?php echo esc_attr($item_id);?>'), {required:false})
									</script>
								<?php

								break;
							case 'checkbox':
								?>
								<input type="checkbox"
									id="edit-menu-item-<?php echo esc_attr($id);?>-<?php echo esc_attr($item_id);?>"
									class="edit-menu-item-<?php echo esc_attr($id);?>"
									name="menu-item-<?php echo esc_attr($id);?>[<?php echo esc_attr($item_id);?>]"
									<?php
										if ( ( $_val == '' && $default == 'on' ) ||
												$_val == 'on')
											echo 'checked="checked"';
									?> />
								<?php
								echo wp_kses($desc,array('span'=>array('class'=>array())));
								break;
							case 'select':
								echo wp_kses($desc,array('span'=>array('class'=>array())));
								if( empty($_val) ) $_val = $default;
								?>
								<select
									id="edit-menu-item-<?php echo esc_attr($id); ?>-<?php echo esc_attr($item_id); ?>"
									class="edit-menu-item-<?php echo esc_attr($id); ?>"
									name="menu-item-<?php echo esc_attr($id);?>[<?php echo esc_attr($item_id);?>]">
									<?php foreach( $ops as $opval => $optitle ): ?>
										<option value="<?php echo esc_attr($opval); ?>" <?php if( $_val == $opval ) echo 'selected="selected"'; ?> ><?php echo esc_attr($optitle); ?></option>
									<?php endforeach; ?>
								</select>
								<?php
								break;
						}
 						?>

					</label>
				</p>
	<?php
	}

	function getMenuItemOption( $item_id , $id ){

		$option_id = 'menu-item-'.$id;

		//We haven't investigated this item yet
		if( !isset( $this->menuItemOptions[ $item_id ] ) ){

			$mashmenu_options = get_post_meta( $item_id , '_mashmenu_options', true );
			//If $mashmenu_options are set, use them
			if( $mashmenu_options ){
				$this->menuItemOptions[ $item_id ] = $mashmenu_options;
			}
			//Otherwise get the old meta
			else{
				return get_post_meta( $item_id, '_menu_item_'.$id , true );
			}
		}
		return isset( $this->menuItemOptions[ $item_id ][ $option_id ] ) ? $this->menuItemOptions[ $item_id ][ $option_id ] : '';

	}

	/*
	 * Custom Walker Name - to be overridden by Standard
	 */
	function editWalker( $className ){
		return 'MashMenuWalkerEdit';
	}

	/*
	 * Default walker, but this can be overridden
	 */
	function getWalker(){
		return new MashMenuWalkerCore();
	}

	function getMenuArgs( $args ){
		$args['walker'] 			= $this->getWalker();
		$args['container'] 			= false;
		$args['menu_class']			= 'nav navbar-nav mashmenu';
		$args['depth']				= 0;
		$args['items_wrap']			= '%3$s';
		$args['link_before']		= '';
		$args['link_after']			= '';
		
		return $args;
	}
	/*
	 * Apply options to the Menu via the filter
	 */
	function megaMenuFilter( $args ){

		//Only print the menu once
		if( $this->count > 0 ) return $args;

		if( isset( $args['responsiveSelectMenu'] ) ) return $args;
		if( isset( $args['filter'] ) && $args['filter'] === false ) return $args;

		//Check to See if this Menu Should be Megafied
		if(!isset($args['is_megamenu']) || !$args['is_megamenu']){
			return $args;
		}
		
		$this->count++;

		$items_wrap 	= '<ul id="%1$s" class="%2$s" data-theme-location="primary-menu">%3$s</ul>'; //This is the default, to override any stupidity

		$args['items_wrap'] = $items_wrap;

		$args = $this->getMenuArgs( $args );

		return $args;
	}

	function add_scripts(){
		wp_enqueue_script('mashmenu-js', $this->baseURL.'js/mashmenu.js', array('jquery'), MASHMENU_VERSION, true);

		$options = get_option('mashmenu_options');

		wp_enqueue_style('mashmenu-css',$this->baseURL.'css/mashmenu.css');
		wp_localize_script( 'mashmenu-js', 'mashmenu', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'ajax_loader'=>'on','ajax_enabled'=>($options['ajax_loading'] == "on" ? 1 : 0)) );
	}

	function loadAdminNavMenuJS(){
		wp_enqueue_script('mashmenu-admin-js', $this->baseURL.'js/mashmenu.admin.js', array('jquery'), MASHMENU_VERSION, true);
	}

	function loadAdminNavMenuCSS(){
		wp_enqueue_style('mashmenu-admin-css',$this->baseURL.'css/mashmenu.admin.css');
	}
}

$mashmenu = new MashMenu();

/* ADMIN - Setting page */
if(!defined('_DS_')){
	define('_DS_', DIRECTORY_SEPARATOR);
}
require_once get_template_directory() . '/inc/megamenu/options.php';

if ( is_admin() ){ // admin actions
  //add_action( 'admin_menu', 'add_mashmenu_menu' );
  add_action( 'admin_init', 'register_mashmenu_settings' );
} else {
  // non-admin enqueues, actions, and filters
}

function register_mashmenu_settings(){
	//register our settings
	register_setting( 'mashmenu_options', 'mashmenu_options', 'mashmenu_validate_setting' );

	add_settings_section('mashmenu_settings_group', 'Main Settings', 'mashmenu_section_cb', __FILE__);

	add_settings_field('logo', 'Logo:', 'mashmenu_logo_setting', __FILE__, 'mashmenu_settings_group'); // LOGO
	add_settings_field('remove_logo', '', 'mashmenu_remove_logo_setting', __FILE__, 'mashmenu_settings_group'); // LOGO
	add_settings_field('maincolor', 'Main Color:', 'mashmenu_maincolor_setting', __FILE__, 'mashmenu_settings_group'); // Main color
	add_settings_field('hovercolor', 'Hover Color:', 'mashmenu_hovercolor_setting', __FILE__, 'mashmenu_settings_group'); // Hover color
	add_settings_field('channeltitlecolor', 'Channel Title Color:', 'mashmenu_channeltitle_color_setting', __FILE__, 'mashmenu_settings_group'); // Hover color
	add_settings_field('icon_mainmenu_parent', 'Icon for MainMenu Parent Item:', 'icon_mainmenu_parent_setting', __FILE__, 'mashmenu_settings_group');
	add_settings_field('icon_subchannel_item_right', 'Icon for Sub Channel Item (LTR):', 'icon_subchannel_item_right_setting', __FILE__, 'mashmenu_settings_group');
	add_settings_field('icon_subchannel_item_left', 'Icon for Sub Channel Item (RTL):', 'icon_subchannel_item_left_setting', __FILE__, 'mashmenu_settings_group');
	add_settings_field('image_link', 'Link on preview image:', 'mashmenu_image_link_setting', __FILE__, 'mashmenu_settings_group');
	add_settings_field('sidebars', 'Sidebars:', 'mashmenu_sidebars', __FILE__, 'mashmenu_settings_group');

	add_settings_section('mashmenu_layout_group', 'Layout Settings', 'mashmenu_section_cb', __FILE__);
	add_settings_field('thumbnail_size', 'Thumbnail Size:', 'mashmenu_thumbnails_setting', __FILE__, 'mashmenu_layout_group');
	add_settings_field('subcontent_height', 'Sub-content Height:', 'mashmenu_subcontentheight_setting', __FILE__, 'mashmenu_layout_group');
	add_settings_field('rtl', 'RTL Language:', 'mashmenu_rtl_setting', __FILE__, 'mashmenu_layout_group');

	add_settings_section('mashmenu_responsive_group', 'Responsive Settings', 'mashmenu_section_cb', __FILE__);

	add_settings_field('menu_hidden_limit', 'Width limit to hide menu:', 'mashmenu_menuhiddenlimit_setting', __FILE__, 'mashmenu_responsive_group');
	add_settings_field('menu_mobile_limit', 'Width limit for mobile:', 'mashmenu_mobilelimit_setting', __FILE__, 'mashmenu_responsive_group');

	add_settings_section('mashmenu_advance_settings_group', 'Advance Settings', 'mashmenu_section_cb', __FILE__);
	add_settings_field('load_fontawesome', 'Load FontAwesome:', 'mashmenu_loadawesome_setting', __FILE__, 'mashmenu_advance_settings_group');

	add_settings_field('ajax_loading', 'Ajax loading:', 'mashmenu_ajax_loading_setting', __FILE__, 'mashmenu_advance_settings_group');

	add_settings_field('ajax_loaderimage', 'Ajax loader image:', 'mashmenu_ajax_loaderimage_setting', __FILE__, 'mashmenu_advance_settings_group');

	add_settings_field('ajax_loaderimage_default', '', 'mashmenu_ajax_loaderimage_default_setting', __FILE__, 'mashmenu_advance_settings_group');

	add_settings_field('disable_css', 'Disable CSS Setting', 'mashmenu_css_setting', __FILE__, 'mashmenu_advance_settings_group');
	add_settings_field('advance_css', 'Advance CSS', 'mashmenu_advancecss_setting', __FILE__, 'mashmenu_advance_settings_group');
	add_settings_field('hide_on_mobile', 'Hide on mobile', 'mashmenu_hide_on_mobile_setting', __FILE__, 'mashmenu_advance_settings_group');

	add_settings_section('mashmenu_woocommerce_settings_group', 'WooCommerce/JigoShop Settings', 'mashmenu_section_cb', __FILE__);
	add_settings_field('show_price', 'Show Price:', 'mashmenu_woo_showprice_setting', __FILE__, 'mashmenu_woocommerce_settings_group');
}

function mashmenu_woo_showprice_setting() {
	$options = get_option('mashmenu_options');
	echo "<select name='mashmenu_options[show_price]'>
				<option ".((isset($options['show_price']) && $options['show_price'] == '')?"selected='selected'":'')." value=''>Right of name</option>
				<option ".((isset($options['show_price']) && $options['show_price'] == 'left')?"selected='selected'":'')." value='left'>Left of name</option>
				<option ".((isset($options['show_price']) && $options['show_price'] == 'no')?"selected='selected'":'')." value='no'>Do not show price</option>
			</select><br/>
	     <i>Whether to show price of product or not</i> ";
}

function mashmenu_hide_on_mobile_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[hide_on_mobile]' ". (($options['hide_on_mobile'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>Check if you want to hide menu on mobile. MashMenu will use mobile screen width setting above to detect mobile browser</i> ";
}

function mashmenu_image_link_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[image_link]' ". (($options['image_link'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>Check if you want to put link on preview image!</i> ";
}

function mashmenu_advancecss_setting() {
	$options = get_option('mashmenu_options');

	echo "<textarea cols='100' rows='5' name='mashmenu_options[advance_css]'>{$options['advance_css']}</textarea><br/>
	     <i>Enter your own CSS here</i> ";
}

function mashmenu_css_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[disable_css]' ". (($options['disable_css'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>If you want to load custom CSS in this setting, you can disable it. Remember to add your own code somewhere else!</i> ";
}

function mashmenu_rtl_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[rtl]' ". (($options['rtl'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>Choose to set the layout of MashMenu to adapt with RTL Language!</i> ";
}

function icon_mainmenu_parent_setting(){
	$options = get_option('mashmenu_options');
	echo "<input name='mashmenu_options[icon_mainmenu_parent]' value='{$options['icon_mainmenu_parent']}'/><br/><i>If leave empty, Caret-Down icon will be used. Check <a href='http://fortawesome.github.io/Font-Awesome/icons/'>Font Awesome icons</a> to get icon class</i>. For example, fa-caret-down";
}

function icon_subchannel_item_right_setting(){
	$options = get_option('mashmenu_options');
	echo "<input name='mashmenu_options[icon_subchannel_item_right]' value='{$options['icon_subchannel_item_right']}'/><br/><i>If leave empty, Chevron-Right icon will be used. Check <a href='http://fortawesome.github.io/Font-Awesome/icons/'>Font Awesome icons</a> to get icon class</i>. For example, fa-chevron-right";
}

function icon_subchannel_item_left_setting(){
	$options = get_option('mashmenu_options');
	echo "<input name='mashmenu_options[icon_subchannel_item_left]' value='{$options['icon_subchannel_item_left']}'/><br/><i>If leave empty, Chevron-Left icon will be used. Check <a href='http://fortawesome.github.io/Font-Awesome/icons/'>Font Awesome icons</a> to get icon class</i>. For example, fa-chevron-left";
}

function mashmenu_subcontentheight_setting() {
	$options = get_option('mashmenu_options');
	echo "<input name='mashmenu_options[subcontent_height]' value='{$options['subcontent_height']}'/><br/><i>By default, sub-content has the height of 200px. Set the height you want here (includes 'px'), or enter 0 to make it expandable</i>";
}

function mashmenu_thumbnails_setting(){
	$options = get_option('mashmenu_options');
	echo "<input name='mashmenu_options[thumbnail_size]' value='{$options['thumbnail_size']}'/><br/><i>Enter size of thumbnails in format [width]x[height]. For example: 150x120</i>";
}

function mashmenu_ajax_loaderimage_setting(){
	echo '<input type="file" name="loader" /><br/>';
	$options = get_option('mashmenu_options');
	if($options['loader'] != ''){
		echo '<span style="padding:3px;border:1px solid #CCC;background:#F2F2F2;display:inline-block"><img src="'.esc_attr($options['loader']).'"/></span> <a href="javascript:void(0)" onclick="jQuery(\'#mashmenu_default_image\').val(\'\');jQuery(this).prev().remove()">Use default loader image</a>';
	};
}

// hidden field to clear custom loader image
function mashmenu_ajax_loaderimage_default_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='hidden' id='mashmenu_default_image' name='mashmenu_options[ajax_loaderimage_default]' value='{$options['loader']}'/>";
}

function mashmenu_ajax_loading_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[ajax_loading]' ". (($options['ajax_loading'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>Choose to load content in submenu by Ajax (asynchronous) or not. Using Ajax increases the performance, but it would affect your site's SEO. It's you who decides!</i> ";
}

// Output Load Font Awesome setting
function mashmenu_loadawesome_setting() {
	$options = get_option('mashmenu_options');
	echo "<input type='checkbox' name='mashmenu_options[load_fontawesome]' ". (($options['load_fontawesome'] == 'on')?"checked='checked'":'')."/><br/>
	     <i>Choose to load <a href='http://fortawesome.github.io/Font-Awesome/' target='_blank'>Font-Awesome</a> or not. Turn it off if your theme has already loaded this library</i> ";
}

// Ouput Sidebar settings
function mashmenu_sidebars() {
	$options = get_option('mashmenu_options');
	// for compatible with MashMenu 1.5.1. This option is removed since 1.6
	$sidebars = array();
	if(isset($options['sidebars']) && $options['sidebars'] != ''){
		echo "<input type='text' style='display:none' name='mashmenu_options[sidebars]'/>"; // to clear value after saving
		$sidebars = explode(PHP_EOL, $options['sidebars']);
	}
	for($i = 1; $i <= 5; $i++){
		echo "<p><input type='text' name='mashmenu_options[sidebar".$i."]' value='".(isset($sidebars[$i-1]) && $sidebars[$i-1] != ''?$sidebars[$i-1]:$options['sidebar'.$i])."'/> <select name='mashmenu_options[sidebar".$i."_logic]'><option value='both' ".($options['sidebar'.$i.'_logic'] == "both"?"selected='selected'":"").">Always visible</option><option value='guest' ".($options['sidebar'.$i.'_logic'] == "guest"?"selected='selected'":"").">Only visible to guest</option><option value='member' ".($options['sidebar'.$i.'_logic'] == "member"?"selected='selected'":"").">Only visible to members</option></select></p>";
	}

	echo "<i>Enter names of awesome icons here, one a line. Each icon will represent a sidebar. For example, if you enter facebook, then the fa-facebook will be used. Check list of <a href='http://fortawesome.github.io/Font-Awesome/icons/'>Font Awesome icons</a></i> ";
	/*
	sidebar options will be save in the following format
		[name of awesome icon],[name of awesome icon]
	Sidebars will be created with the name
		"mashmenu-sidebar-iconname"
	*/
}

function mashmenu_menuhiddenlimit_setting(){
	$options = get_option('mashmenu_options');

	echo "<textarea cols='100' rows='5' name='mashmenu_options[menu_hidden_limit]'>{$options['menu_hidden_limit']}</textarea><br/>
	     <i>This will control the visibility of menu items in different browser's sizes. Use the following format:</i><br/>
		 <i>[width],[menu item]<br/>
			[width],[menu item]<br/>
			[width],[menu item]<br/>
		 </i><br/>
		 <i>In which, [width] is the width of browser (in pixels); [menu item] is the order of menu item that will be hidden. For example <br/>
		 1137,7<br/>
1126,6<br/>
946,5<br/>
850,4<br/>
710,3<br/>
610,2<br/>
539,1<br/>
		 </i>";
	/*
	sidebar options will be save in the following format
		[name of awesome icon],[name of awesome icon]
	Sidebars will be created with the name
		"mashmenu-sidebar-iconname"
	*/
}

// Output MainColor setting
function mashmenu_mobilelimit_setting() {
	$options = get_option('mashmenu_options');

	echo "<input name='mashmenu_options[menu_mobile_limit]' value='{$options['menu_mobile_limit']}'/><br/>
	     <i>Width limit for mobile screen (in pixels). For example: 480</i> ";
}

// Output Logo setting
function mashmenu_logo_setting(){
	echo '<input type="file" name="logo" /><br/>';
	$options = get_option('mashmenu_options');
	if($options['logo'] != ''){
		echo '<span style="padding:3px;border:1px solid #CCC;background:#F2F2F2;display:inline-block" id="img_logo"><img src="'.esc_attr($options['logo']).'"/></span><input type="checkbox" onchange="if(this.checked){jQuery(\'#remove_logo\').val(1);jQuery(\'#img_logo\').hide();} else {jQuery(\'#remove_logo\').val(0);jQuery(\'#img_logo\').show();}"/> Remove Current Logo?';
	};
}

function mashmenu_remove_logo_setting(){
	echo '<input type="hidden" value="0" id="remove_logo" name="mashmenu_options[remove_logo]"/>';
}

// Output MainColor setting
function mashmenu_maincolor_setting() {
	$options = get_option('mashmenu_options');

	echo "<input name='mashmenu_options[maincolor]' class='color' value='{$options['maincolor']}'/><br/>
	     <i>Hexa color (ex. #2AA4CF).</i> ";
}

// Output HoverColor setting
function mashmenu_hovercolor_setting() {
	$options = get_option('mashmenu_options');

	echo "<input name='mashmenu_options[hovercolor]' class='color' value='{$options['hovercolor']}'/><br/>
	     <i>Hexa color (ex. #DDF0F9).</i> ";
}

function mashmenu_channeltitle_color_setting(){
	$options = get_option('mashmenu_options');

	echo "<input name='mashmenu_options[channeltitlecolor]' class='color' value='{$options['channeltitlecolor']}'/><br/>
	     <i>Hexa color (ex. #C7E6F5).</i> ";
}

function mashmenu_section_cb() {}

function mashmenu_validate_setting($plugin_options) {
	$keys = array_keys($_FILES); $i = 0;
	$loader_image = false;

	if($plugin_options['remove_logo'] == '1'){
		$plugin_options['logo'] = '';
	} else {
		foreach ( $_FILES as $image ) {
			// if a files was upload
			if ($image['size']) {
			// if it is an image
				if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
					$override = array('test_form' => false);
					// save the file, and store an array, containing its location in $file
					$file = wp_handle_upload( $image, $override );
					$plugin_options[$keys[$i]] = $file['url'];

					if($keys[$i] == 'loader')
						$loader_image = true;
				} else {
					// Not an image.
					$options = get_option('plugin_options');
					$plugin_options[$keys[$i]] = $options[$logo];
					// Die and let the user know that they made a mistake.
					wp_die('No image was uploaded.');
				}
			}
			// Else, the user didn't upload a file.
			// Retain the image that's already on file.
			else {
				$options = get_option('mashmenu_options');
				$plugin_options[$keys[$i]] = $options[$keys[$i]];
			}
			$i++;
		}
	}

	if(!$loader_image){
		// no image was uploaded, check if users choose to use default loader image
		if($plugin_options['ajax_loaderimage_default'] == ''){
			$plugin_options['loader'] = '';
		}
	}
	return $plugin_options;
}

function mashmenu_activate() {
	// called when mashmenu is activated
	// set some default values
	$options = get_option('mashmenu_options');
	if(isset($options) && is_array($options)){
		$options['maincolor'] = '222222';
		$options['hovercolor'] = 'dd4c39';
		$options['channeltitlecolor'] = 'ffffff';
		$options['menu_hidden_limit'] = '1137,7'.PHP_EOL.'1126,6'.PHP_EOL.'946,5'.PHP_EOL.'850,4'.PHP_EOL.'710,3'.PHP_EOL.'610,2'.PHP_EOL.'539,1';
		$options['logo'] = get_template_directory_uri() .'/inc/megamenu/images/mashmenu.png';
		$options['load_fontawesome'] = 'on';
		$options['ajax_loading'] = 'on';
		$options['menu_mobile_limit'] = 480;
		$options['sidebars'] = 'search'.PHP_EOL.'facebook';
		$options['image_link'] = 'on';
		update_option('mashmenu_options',$options);
	}
}
register_activation_hook( __FILE__, 'mashmenu_activate' );

function mashmenu_load() {
	wp_nav_menu(array( 'theme_location'  => 'primary','is_megamenu' => true));
	wp_reset_query();
}
//add_action('wp_footer', 'mashmenu_load');