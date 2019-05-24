<div id="top-nav"> 
    <nav class="navbar navbar-default dark-div"> 
        <div class="container container-1340"> 
         	<?php
			if(is_active_sidebar('top_nav_sidebar')){
				dynamic_sidebar( 'top_nav_sidebar' );
			}
			$show_top_social = ot_get_option('show_top_social','on');
			if(function_exists('businesshub_print_social_accounts') && $show_top_social!='off'){
				businesshub_print_social_accounts($class='social-listing list-inline nav navbar-nav navbar-right ');
			}
			if(has_nav_menu( 'secondary-menus' )){
				  wp_nav_menu(array(
					  'theme_location'  => 'secondary-menus',
					  'container' => false,
					  'items_wrap'=> '<ul class="nav navbar-nav navbar-right top-menu">%3$s</ul>',
				  )); 
			 }?>
        </div>
    </nav>      
</div>