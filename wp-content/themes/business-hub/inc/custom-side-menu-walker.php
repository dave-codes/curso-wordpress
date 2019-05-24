<?php
class businesshub_custom_side_walker_nav_menu extends Walker_Nav_Menu {
  
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array()) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			//'dropdown-menu',
			//( $display_depth >=2 ? 'dropdown-submenu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );
		global $sidemenu_background;
		$style_bg = '';
		if($depth==0 && $sidemenu_background!=''){ $style_bg = 'style=" background-image:url('.$sidemenu_background.')"';}
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '" '.$style_bg.'>' . "\n";
		global $sidemenu_background_link;
		if($depth==0 && $sidemenu_background_link!=''){
			$output .='<li class="background-link"><a href="'.esc_url($sidemenu_background_link).'" class=""></a></li>';
		}
		global $multi_column;
		if($multi_column){
			global $first_column;
			$first_column = 1;
			global $column_open;
			$column_open = 0;
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ){
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		global $multi_column;
		global $column_open;
		if($multi_column && $column_open){
			$output .= '</ul>';
		}
		$output .= "\n$indent</ul>\n";
		global $link_viewall;
		if($depth==1 && $link_viewall!=''){
			$output .='<a href="'.esc_url($link_viewall).'" class="ct-see-all">'.esc_html__('See all','cactus').'<i class="fa fa-caret-right"></i></a>';
		}
	}
  
	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {
		$args = (object) $args;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	  
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			//( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$is_parent = false;
		
		$valid_classes = array();
		// check if there is "icon-*" class set. If found, remove it 
		foreach($classes as $class){			
			$valid_classes[] = $class;
			
			if($class == 'parent'){
				$is_parent = true;
				$valid_classes[]=$depth==0?'dropdown':'dropdown-submenu';
			}
		}
		
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $valid_classes ), $item ) ) );
		//column
		if(in_array('column-header',$valid_classes) || in_array('column-new',$valid_classes)){
			global $first_column;
			global $column_open;
			if($first_column){
				$indent = $indent.'<ul class="menu-column">';
				$first_column = 0;
			}else{
				$indent = $indent.'</ul><ul class="menu-column">';
			}
			$column_open = 1;
		}
		
		// build html
		global $sidemenu_background,$sidemenu_background_link;
		$sidemenu_background = $sidemenu_background_link = $sub_label ='';
		if($depth==0 && class_exists('MashMenuWalkerCore')){
			$mg = new MashMenuWalkerCore();
			$sidemenu_background = $mg->getMashMenuOption( $item->ID, 'background_image');
			$sidemenu_background_link = $mg->getMashMenuOption( $item->ID, 'background_link');
			$sub_label = $mg->getMashMenuOption( $item->ID, 'sub_label');
			$sub_label_color = $mg->getMashMenuOption( $item->ID, 'sub_label_color');
		}
		global $link_viewall;
		if($depth==1){
			$link_viewall ='';
			if(class_exists('MashMenuWalkerCore')){
				$mg = new MashMenuWalkerCore();
				$link_viewall = $mg->getMashMenuOption( $item->ID, 'link_viewall');
			}
		}
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ' href="' . get_permalink($item->ID) . '"';
		
		global $multi_column;
		if($depth==0){
			$multi_column = false;
		}
		if(in_array('multi-column',$valid_classes)){
			$multi_column = true;
		}
		$sublabe_html = '';
		if($sub_label!=''){
			$subcl ='';
			if($sub_label_color!=''){
				$subcl ='style ="background-color:#'.$sub_label_color.';"';
			}
			$sublabe_html = '<span class="ct-note-menu bg-m-color-2" '.$subcl.'>'.$sub_label.'</span>';
		}
		$attributes .= ' class="menu-link '.($is_parent&&$depth==0?'dropdown-toggle disabled':'').' '.( $depth > 0 ? 'sub-menu-link':'main-menu-link' ).'"';
	  
		$item_output = sprintf( '%1$s<a%2$s>'.($is_parent&&$depth==0?' <i class="fa fa-angle-right"></i>':'').'<span class="menu-name">%3$s%4$s%5$s%6$s</span>' . ($item->description&&$depth==0?'<span class="menu-excerpt">'.$item->description.'</span>':'') .'</a>%7$s',
		   is_array($args) ?  $args['before'] : $args->before,
		   $attributes,
		   is_array($args) ? $args['link_before'] : $args->link_before,
		   apply_filters( 'the_title',(empty($item->post_title) ? $item->title : $item->post_title) , $item->ID ),
		   is_array($args) ? $args['link_after']  : $args->link_after,
		   $sublabe_html,
		   is_array($args) ? $args['after'] : $args->after
		  );
		
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}	
}