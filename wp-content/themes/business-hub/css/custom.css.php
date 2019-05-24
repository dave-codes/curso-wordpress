<?php

/* Get Theme Options here and echo custom CSS */
//
// for example:
// $topmenu_visible = ot_get_option( 'topmenu_visible', 1);

if(class_exists('businesshub_edd_addon')):
/******** EDD ADDON Page Template ********/
    $edd_addon_banner_area                 = get_post_meta(get_the_ID(),'edd_addon_banner_area', true );
    $edd_addon_big_banner_bg               = get_post_meta(get_the_ID(),'edd_addon_big_banner_bg', true );
    $edd_addon_big_banner_background       = isset($edd_addon_big_banner_bg['background-image']) ? $edd_addon_big_banner_bg['background-image'] : '';
    $edd_addon_big_banner_color            = isset($edd_addon_big_banner_bg['background-color']) ? $edd_addon_big_banner_bg['background-color'] : '';
    $edd_addon_small_banner1_bg            = get_post_meta(get_the_ID(),'edd_addon_small_banner1_bg', true );
    $edd_addon_small_banner1_background    = isset($edd_addon_small_banner1_bg['background-image']) ? $edd_addon_small_banner1_bg['background-image'] : '';
    $edd_addon_small_banner1_color         = isset($edd_addon_small_banner1_bg['background-color']) ? $edd_addon_small_banner1_bg['background-color'] : '';
    $edd_addon_small_banner2_bg            = get_post_meta(get_the_ID(),'edd_addon_small_banner2_bg', true );
    $edd_addon_small_banner2_background    = isset($edd_addon_small_banner2_bg['background-image']) ? $edd_addon_small_banner2_bg['background-image'] : '';
    $edd_addon_small_banner2_color         = isset($edd_addon_small_banner2_bg['background-color']) ? $edd_addon_small_banner2_bg['background-color'] : '';
    $edd_addon_banner_area_bg              = get_post_meta(get_the_ID(),'edd_addon_banner_area_bg', true );
    $edd_addon_banner_area_background      = isset($edd_addon_banner_area_bg['background-image']) ? $edd_addon_banner_area_bg['background-image'] : '';
    $edd_addon_banner_area_color           = isset($edd_addon_banner_area_bg['background-color']) ? $edd_addon_banner_area_bg['background-color'] : '';
    echo '.header-v4-builder{margin-bottom: 60px;}';
    if( (isset($edd_addon_banner_area)) && ($edd_addon_banner_area == 'built_in') ){
        if( isset($edd_addon_big_banner_bg) && $edd_addon_big_banner_bg != '' ){
            if($edd_addon_big_banner_background != ''){
                echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.big-img{background-image:url('.$edd_addon_big_banner_background.');}';
            }else{
                if ((isset($edd_addon_big_banner_color)) && ($edd_addon_big_banner_color == '')) {
                    echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.big-img{background-color:'.$edd_addon_big_banner_color.';}';
                }
            }
        }
        if( isset($edd_addon_small_banner1_bg) && $edd_addon_small_banner1_bg != '' ){
            if($edd_addon_small_banner1_background != ''){
                echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.small-img-above{background-image:url('.$edd_addon_small_banner1_background.');}';
            }else{
                if ( (isset($edd_addon_small_banner1_color)) && ($edd_addon_small_banner1_color == '') ) {
                    echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.small-img-above{background-color:'.$edd_addon_small_banner1_color.';}';
                }
            }
        }
        if( isset($edd_addon_small_banner2_bg) && $edd_addon_small_banner2_bg != '' ){
            if($edd_addon_small_banner2_background != ''){
                echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.small-img-below{background-image:url('.$edd_addon_small_banner2_background.');}';
            }else{
                if ( (isset($edd_addon_small_banner2_color)) && ($edd_addon_small_banner2_color == '') ) {
                    echo '.edd-addon .ct-shortcode-sliderv1 .absolute-img.small-img-below{background-color:'.$edd_addon_small_banner2_color.';}';
                }
            }
        }
    }else{//$edd_addon_banner_area == custom content
        echo '.edd-addon .ct-shortcode-sliderv1 .first-child.custom-content, .edd-addon .header-v4-builder .first-child.custom-content .table-content{width: 100%;}';
        if ( isset($edd_addon_banner_area_background) && ($edd_addon_banner_area_background != '') ) {
            echo '.edd-addon .ct-shortcode-sliderv1 .custom-content .absolute-img{background-image:url('.$edd_addon_banner_area_background.');}';
        } else {
            if ( isset($edd_addon_banner_area_color) && ($edd_addon_banner_area_color != '') ) {
                echo '.edd-addon .ct-shortcode-sliderv1 .custom-content .absolute-img{background-color:'.$edd_addon_banner_area_color.';}';
            }
        }
    }
/******** EDD ADDON Page Template ********/
endif;
$footer_social_bg_color = ot_get_option('footer_social_bg_color');
if($footer_social_bg_color!=''){
	echo 'footer .footer-label .f-label-content.ft-social{background-color:'.esc_attr($footer_social_bg_color).';}';
}
$nav_transparency 	= ot_get_option('header_opacity','0.25');
$header_style		= ot_get_option('header_style', 'style_1');
$header_Schema 		= ot_get_option('header_Schema', 'light');
if(is_page_template() || is_page_template('templates/edd-page-template.php') ) {
	$meta_nav_style = businesshub_get_global_meta_nav_style();
	$meta_header_schema = businesshub_get_global_meta_header_schema();
	$meta_nav_opacity = businesshub_get_global_meta_nav_opacity();
	if($meta_nav_style && $meta_nav_style != 'default'){$header_style = $meta_nav_style;}
	if($meta_header_schema && $meta_header_schema != 'default'){$header_Schema = $meta_header_schema;}
	if($meta_nav_opacity || $meta_nav_opacity == '0'){$nav_transparency = $meta_nav_opacity;}
}

if($header_style == 'style_2' && $nav_transparency != '1' && $header_Schema=='light'){
	echo '.header-style-forall{background-color:transparent;}';	
}
/*Footer CTA Content*/
if(!is_single() && !is_page()){
	if( (is_archive()) || (is_front_page() && ('page' != get_option('show_on_front'))) ){
		$archives_footer_cta_height 			= ot_get_option('archives_footer_cta_height','');
		$archives_footer_cta_bg_group			= ot_get_option('archives_footer_cta_background','');
		$archives_footer_cta_background			= isset($archives_footer_cta_bg_group['background-image']) ? $archives_footer_cta_bg_group['background-image'] : '';
		$archives_footer_cta_background_color 	= isset($archives_footer_cta_bg_group['background-color']) ? $archives_footer_cta_bg_group['background-color'] : '';

		if(is_category()){
			$cat 		= get_query_var('cat');
			$yourcat 	= get_category ($cat);
			$cat_id  	= $yourcat->cat_ID	;
			$cat_footer_cta_height			= get_option( "cat_footer_cta_height$cat_id") ? get_option( "cat_footer_cta_height$cat_id"):'';
			$cat_footer_cta_background		= get_option( "cat_footer_cta_background$cat_id") ? get_option( "cat_footer_cta_background$cat_id"):'';
			$cat_footer_cta_background_color = get_option( "cat_footer_cta_background_color$cat_id") ? get_option( "cat_footer_cta_background_color$cat_id"):'';
			if($cat_footer_cta_background_color){$cat_footer_cta_background_color 	= '#'.$cat_footer_cta_background_color;}

			if($cat_footer_cta_height){$archives_footer_cta_height = $cat_footer_cta_height;}
			if($cat_footer_cta_background){$archives_footer_cta_background = $cat_footer_cta_background;}
			if($cat_footer_cta_background_color){$archives_footer_cta_background_color = $cat_footer_cta_background_color;}
		}

		$footer_cta_height_css ='';
		$footer_cta_background_css ='';

		if($archives_footer_cta_background){
			$footer_cta_background_css ='.ct-info-bottom{ background:url('.$archives_footer_cta_background.') no-repeat center; background-size: cover;} ';
			echo esc_html($footer_cta_background_css);
		}else{
			$footer_cta_background_css ='.ct-info-bottom{ background-color:'.$archives_footer_cta_background_color.';} ';
			echo esc_html($footer_cta_background_css);
		}

		if($archives_footer_cta_height){
			$footer_cta_height_css ='.ct-info-bottom{ height:'.$archives_footer_cta_height.'px ; } ';
			echo esc_html($footer_cta_height_css);
		}
	}
}
/*Footer CTA Content*/
$body_font = ot_get_option('body_font',''); // for example, Playfair+Display:900
if($body_font){
	$font_name = businesshub_get_google_font_name($body_font);
?>
body{font-family: "<?php echo esc_html($font_name);?>"}
<?php
}?>

<?php if($header_style == 'style_1'){?>
#main-menu>.navbar-default{background-color: rgba(0,0,0,<?php echo esc_html($nav_transparency);?>);}
<?php } if($header_style == 'style_2' && $header_Schema != 'light'){?>
.cactus-nav.style-2.style-3:not(.schema-light) #main-menu>.navbar-default:not(.sticky-menu){ background-color:rgba(17,17,17,<?php echo esc_html($nav_transparency);?>)}
<?php }else if($header_style == 'style_2' && $header_Schema == 'light'){ ?> 
.cactus-nav.style-2.style-3 #main-menu>.navbar-default{ background-color:rgba(248,248,248,<?php echo esc_html($nav_transparency);?>)}
<?php }

$main_color_1 = ot_get_option('color_1','#ffd800');

if(strtolower($main_color_1) != '#ffd800') {
?>
/*color*/
	.m-color-1,
    .btn-style-1.btn-style-3.imp-color-1:not(:hover),
    #top-nav .navbar-default .navbar-nav.top-menu>li>a>i,
    #main-menu .dropdown-mega .channel-content .row .content-item .video-item .item-head h3 a:hover,
    #off-canvas .off-menu ul li a:hover,
    .dark-div .widget_calendar a:hover
    {color:<?php echo esc_html($main_color_1);?>}
/*color*/

/*background*/
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
    .woocommerce span.onsale, .woocommerce ul.products li.product .onsale,
	.bg-m-color-1,
    .btn-default.imp-color-1:not(:hover):not(.btn-style-2):not(.btn-style-3),
    .btn-style-1.imp-color-1:not(:hover),
    .ct-custom-cf7 input[type="submit"]:not(:hover),
    .edd_checkout a:not(:hover),
    .widget_edd_product_details .button.edd-submit:not(:hover),
    .widget_edd_product_details .button.edd-submit:focus,
    #edd_checkout_form_wrap .edd-cart-adjustment input.edd-submit:not(:hover), 
    #edd_checkout_wrap .edd-submit:not(:hover),
    .item-review .box-progress .progress .progress-bar, .ct-custom-social-account.fa a
    {background-color:<?php echo esc_html($main_color_1);?>}
/*background*/

/*border color*/
	.btn-style-1.btn-style-3.imp-color-1:not(:hover)
    {border-color:<?php echo esc_html($main_color_1);?>}
/*border color*/
<?php
}

$main_color_2 = ot_get_option('color_2', '#77b727');
if(strtolower($main_color_2) != '#77b727') {
?>
/*color*/
	.m-color-2,
    .btn-style-1.btn-style-3.imp-color-2:not(:hover),
    .widget.widget-m-color-2 .widget-title,
    .dark-div .widget.widget-m-color-2 .widget-title,
    .star-rating-block .rating-stars
	{color:<?php echo esc_html($main_color_2);?>}
/*color*/

/*background*/
	.bg-m-color-2,
    .btn-default.imp-color-2:not(:hover):not(.btn-style-2):not(.btn-style-3),
    .btn-style-1.imp-color-2:not(:hover),
    .social-listing li.email a:not(:hover),
    .textwidget .wpcf7 input[type="submit"]:not(:hover),
    .widget.widget-box-style-1.widget-box-style-3,
    .ct-sc-services .cactus-listing-config.style-3 .button-and-share .btn:not(:hover),
    .ct-sc-content-box .button-and-share .btn:not(:hover),
    .ct-sc-content-box.ct-sc-blog-v2 .cactus-listing-config.style-3 .button-and-share .btn:not(:hover), .header-cart-mobile [class^="ct-icon-"] .total-item, .header-top-checkout [class^="ct-icon-"] .total-item,
    #added-to-cart
	{background-color:<?php echo esc_html($main_color_2);?>}
/*background*/

/*border color*/
	.btn-style-1.btn-style-3.imp-color-2:not(:hover),
    .widget.widget-m-color-2 .widget-title,
    .dark-div .widget.widget-m-color-2 .widget-title,
    .textwidget div.wpcf7-mail-sent-ok
	{border-color:<?php echo esc_html($main_color_2);?>}
/*border color*/
<?php }

/*font family*/
	$google_font = ot_get_option('google_font', 'on');
	if($google_font == 'on'){
		//main font
		$font_name='';
		$main_font = trim(ot_get_option('main_font_family'));
		if(isset($main_font) && $main_font!=''){
			$font_name = businesshub_get_google_font_name($main_font);
		}

		//heading font
		$font_heading_name='';
		$heading_font = trim(ot_get_option('heading_font_family'));
		if(isset($heading_font) && $heading_font!=''){
			$font_heading_name = businesshub_get_google_font_name($heading_font);
		}

		//navigation font
		$font_navigation_name='';
		$navigation_font = trim(ot_get_option('navigation_font_family'));
		if(isset($navigation_font) && $navigation_font!=''){
			$font_navigation_name = businesshub_get_google_font_name($navigation_font);
		}

		if($font_name!=''){
		?>
        	/*main font*/
                body,               
                .main-font-1,
                #main-menu .search-drop-down>li>ul,
                .widget_recent_comments .recentcomments > .comment-author-link,
                .widget_recent_comments .recentcomments > .comment-author-link a,
                .body-content .vc_progress_bar .vc_single_bar .vc_label .vc_label_units,
                .ct-note-menu,
                .widget_edd_product_details h3,
                .h6.main-font-1,
                .ct-vote .total_user_rate,
                .user-rating-block .rating-item .criteria-title > span
                {font-family:"<?php echo esc_html($font_name);?>"}
            /*main font*/
		<?php
		}

		if($font_heading_name!=''){
		?>
        	/*heading font*/
            	h1:not(.main-font-1),
                h2:not(.main-font-1),
                h3:not(.main-font-1),
                h4:not(.main-font-1),
                h5:not(.main-font-1),
                h6:not(.main-font-1),
                .h1:not(.main-font-1),
                .h2:not(.main-font-1),
                .h3:not(.main-font-1),
                .h4:not(.main-font-1),
                .h5:not(.main-font-1),
                .h6:not(.main-font-1),
                .heading-font-1,
                .btn-default,
                button,
                input[type=button],
                input[type=submit],
                .btn-default:visited,
                button:visited,
                input[type=button]:visited,
                input[type=submit]:visited,
                .widget_categories li,
                .widget_meta li,
                .widget_archive li,
                .widget_recent_entries li,
                .widget_recent_comments li,
                .widget_pages li,
                .widget_nav_menu li,
                .widget_edd_categories_tags_widget li,
                .paging-navigation,
                .comments-area .comment-author > .fn,
				.comments-area .comment-author > .fn > a,
                .comments-area .reply a,
                .body-content .vc_tta.vc_general .vc_tta-tab > a,
                .body-content .vc_progress_bar .vc_single_bar .vc_label,
                .edd-cart li.edd_total,
                .edd_checkout a,
                .widget_edd_product_details .button.edd-submit,
				.widget_edd_product_details .button.edd-submit:focus,

                #main-menu>.navbar-default,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu .eco-all-categories > * span.menu-name,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > a span.menu-name,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li > a > span.menu-name,
                .star-rating-block .rating-title,
                .user-rating-block .rating-item .criteria-title,
                #edd_profile_editor_form > fieldset legend,
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
                .woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
                .woocommerce div.product form.cart .button,
                .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button
                {font-family:"<?php echo esc_html($font_heading_name);?>";}
            /*heading font*/
		<?php
		}

		if($font_navigation_name!=''){
		?>
        	/*navigation font*/
            	#main-menu>.navbar-default,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu .eco-all-categories > * span.menu-name,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > a span.menu-name,
                .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li > a > span.menu-name
                {font-family:"<?php echo esc_html($font_navigation_name);?>";}
            /*navigation font*/
		<?php
		}
	}
/*font family*/

//custom fonts 1
	$custom_font_1=ot_get_option('custom_font_1');
	$custom_font_1A=ot_get_option('custom_font_1A');
	if($custom_font_1!=''||$custom_font_1A!=''){ ?>
		@font-face{
			font-family:'custom-font-1';
			<?php if($custom_font_1!=''){?>
				src:url(<?php echo esc_url($custom_font_1); ?>) format('woff2');
			<?php };
				if($custom_font_1A!=''){
			?>
				src:url(<?php echo esc_url($custom_font_1A); ?>) format('woff');
			<?php } ?>
		}
	<?php }

	//custom fonts 2
	$custom_font_2 = ot_get_option('custom_font_2');
	$custom_font_2A = ot_get_option('custom_font_2A');
	if($custom_font_2!=''||$custom_font_2A!=''){ ?>
		@font-face{
			font-family:'custom-font-2';
			<?php if($custom_font_2!=''){?>
				src:url(<?php echo esc_url($custom_font_2); ?>) format('woff2');
			<?php };
				if($custom_font_2A!=''){
			?>
				src:url(<?php echo esc_url($custom_font_2A); ?>) format('woff');
			<?php } ?>
		}
	<?php }

	//custom fonts 3
	$custom_font_3 = ot_get_option('custom_font_3');
	$custom_font_3A = ot_get_option('custom_font_3A');
	if($custom_font_3!=''||$custom_font_3A!=''){ ?>
		@font-face{
			font-family:'custom-font-3';
			<?php if($custom_font_3!=''){?>
				src:url(<?php echo esc_url($custom_font_3); ?>) format('woff2');
			<?php };
				if($custom_font_3A!=''){
			?>
				src:url(<?php echo esc_url($custom_font_3A); ?>) format('woff');
			<?php } ?>
		}
	<?php }

/*font size*/
	$main_font_size = ot_get_option('main_font_size', '14');
	if($main_font_size != '14'){
		$fontsizenew11 = round($main_font_size * 0.786);
		$fontsizenew12 = round($main_font_size * 0.858);
		$fontsizenew16 = round($main_font_size * 1.143);
		$fontsizenew18 = round($main_font_size * 1.286);
		$fontsizenew24 = round($main_font_size * 1.715);
		$fontsizenew32 = round($main_font_size * 2.286);
		$fontsizenew48 = round($main_font_size * 3.429);
	?>
    	/*14px*/
        	.gallery-item,
            html,
            body,

            .tooltip,

            input:not([type]),
            input[type="color"],
            input[type="email"],
            input[type="number"],
            input[type="password"],
            input[type="tel"],
            input[type="url"],
            input[type="text"],
            input[type="search"],
            textarea,
            .form-control,
            select,

            table:not(#wp-calendar) tbody tr:first-child > *,
			table:not(#wp-calendar) thead tr:first-child > *,

            .sub-menu,

            #top-nav .navbar-default,
            #top-nav .navbar-default .navbar-nav.top-menu>li>a,

            .header-top-info .widget-inner > *,

            .widget_tag_cloud .tagcloud > *,

            .cactus-all-post-widget:not(.w-jobs) .cactus-widget-posts-item .cactus-note-cat,

            .widget_recent_comments .recentcomments > .comment-author-link,
			.widget_recent_comments .recentcomments > .comment-author-link a,

            footer .row.control-sidebar > *,
            footer .footer-info .link a,
            footer .footer-info .link #menu-footer-menu li:after,

            .cactus-sub-wrap > *,

            .portfolio .cactus-note-cat,

            .wp-pagenavi > *,

            .s-style-8.ct-project .cactus-note-cat,

            .s-style-2 .title-block > *,

            .ct-post-gallery-wrapper:not(.slick-slider) > li,

            .top-job .categories a,
			.top-job .categories span,

            .comments-area .comment-author > *,

            .ct-counter-up > *,

            .ct-sc-blog-v2 .cactus-note-cat,

            .ct-compare-table-group > *.compare-table-item,

            .ct-sc-icon-box-content [class*="col-md-"],

            .ct-sc-icon-box.style-2 .ct-sc-icon-box-content,

            .ct-sc-icon-box.style-2.style-2a .iconbox-item,

            .ct-sc-services .cactus-note-cat,

            .ct-sc-services .cactus-listing-config.style-3 .cactus-post-item .entry-content > *,
            
            .partner-wrap > *,
            
            .h6.main-font-1
            {font-size: <?php echo esc_html($main_font_size);?>px}
        /*14px*/


        /*11px*/
            table:not(#wp-calendar) tbody tr:first-child,
            table:not(#wp-calendar) thead tr:first-child

            {font-size:<?php echo esc_html($fontsizenew11);?>px}

            .widget_tag_cloud .tagcloud a[class*="tag-link-"]

            {font-size:<?php echo esc_html($fontsizenew11);?>px !important}
        /*11px*/

        /*12px*/
        	#top-nav .top-menu.navbar-nav>li ul li a,

            .note-date-v1,

            .cactus-note-cat,

            .cactus-elements-search .search-excerpt,

            .paging-navigation .nav-links,

            .paging-navigation .nav-next a,

            .cactus-breadcrumb > *,

            .posted-on > *,

            .cactus-navigation-post .prev-post > a > span,
			.cactus-navigation-post .next-post > a > span,

            .comments-area .comment-author > .fn > a,
            .comments-area .comment-author > .fn,
            .comments-area .comment-metadata a,

            .comments-area .comment-metadata .edit-link:before,
            .ct-sc-schedule-box .ct-sc-schedule-box-cell:nth-child(1)

            {font-size:<?php echo esc_html($fontsizenew12);?>px}
        /*12px*/

        /*16px*/
        	.widget_calendar caption,
            .widget_calendar td#prev,
			.widget_calendar td#next,

            .wp-pagenavi a,
			.wp-pagenavi span,

            .ct-compare-table-group .compare-table-price span:nth-child(2)

            {font-size:<?php echo esc_html($fontsizenew16);?>px}
        /*16px*/

        /*18px*/
        	.cactus-parallax-sections
            {font-size:<?php echo esc_html($fontsizenew18);?>px}
        /*18px*/

        /*24px*/
        	blockquote

            {font-size:<?php echo esc_html($fontsizenew24);?>px}
        /*24px*/

        /*32px*/
        	.body-content .vc_pie_chart .vc_pie_chart_value

            {font-size:<?php echo esc_html($fontsizenew32);?>px}
        /*32px*/

        /*48px*/
        	.ct-compare-table-group .compare-table-price span:nth-child(1)

            {font-size:<?php echo esc_html($fontsizenew48);?>px}
        /*48px*/
    <?php
	}

	$navigation_font_size = ot_get_option('navigation_font_size', '12');
	if($navigation_font_size != '12'){
		$fontsizenewNAV9 = round($navigation_font_size * 0.75); //df:9
		$fontsizenewNAV13 = round($navigation_font_size * 1.083); //df:18
		$fontsizenewNAV18 = round($navigation_font_size * 1.5); //df:18
	?>

    	/*12px*/
            #main-menu .navbar-default .navbar-nav>li>a,
            #main-menu .navbar-nav>li ul li a,

            #off-canvas .off-menu ul li a,

            .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu .eco-all-categories > * span.menu-name,
            .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > a span.menu-name,
            .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li > a > span.menu-name,
            .ct-note-menu.large

            {font-size:<?php echo esc_html($navigation_font_size);?>px;}
         /*12px*/

         /*9px*/
         	.ct-note-menu

            {font-size:<?php echo esc_html($fontsizenewNAV9);?>px;}
         /*9px*/

         /*13px*/
         	.cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > a span.menu-excerpt,
            .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul li ul li a,
            .ct-see-all,
			.cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li > a.ct-see-all

            {font-size:<?php echo esc_html($fontsizenewNAV13);?>px;}
         /*13px*/

         /*18px*/
         	.cactus-sidebar .cactus-sidebar-content .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu .eco-all-categories > * span.menu-name,
            .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li

            {font-size:<?php echo esc_html($fontsizenewNAV18);?>px;}
         /*18px*/
    <?php
	}

	$heading_font_size = ot_get_option('heading_font_size', '14');
	if($heading_font_size != '14'){
		$fontsizenewH1 = round($heading_font_size * 2.858);	//df:40
		$fontsizenewH2 = round($heading_font_size * 2.286);	//df:32
		$fontsizenewH3 = round($heading_font_size * 1.715);	//df:24
		$fontsizenewH4 = round($heading_font_size * 1.286); //df:18
		$fontsizenewH5 = round($heading_font_size * 1.143); //df:16

		$fontsizenewH_12 = round($heading_font_size * 0.858);
		$fontsizenewH_15 = round($heading_font_size * 1.072);
		$fontsizenewH_20 = round($heading_font_size * 1.428);
		$fontsizenewH_36 = round($heading_font_size * 2.571);
		$fontsizenewH_48 = round($heading_font_size * 3.429);
	?>
    	/*40px*/
            h1,
            .h1

            {font-size:<?php echo esc_html($fontsizenewH1);?>px;}
        /*40px*/

        /*32px*/
            h2,
            .h2

            {font-size:<?php echo esc_html($fontsizenewH2);?>px;}
        /*32px*/

        /*24px*/
            h3,
            .h3,

            .note-date span:last-child,

            .s-style-2 .header-style-basic .title-block  h1,

            .price-options-group .price-options-row > *.single-price

            {font-size:<?php echo esc_html($fontsizenewH3);?>px;}

            @media(max-width:600px){
                .header-style-basic h1
                {font-size:<?php echo esc_html($fontsizenewH3);?>px}
            }

            @media(max-width:767px){
                .s-style-7 .header-style-basic h1,
                .s-style-8 .header-style-basic h1

                {font-size:<?php echo esc_html($fontsizenewH3);?>px}
            }
        /*24px*/

        /*18px*/
            h4,
            .h4,
            .btn-default,
            button,
            input[type=button],
            input[type=submit],
            .btn-default:visited,
            button:visited,
            input[type=button]:visited,
            input[type=submit]:visited,

            .comments-area .comment-reply-title,
			.comments-area .comments-title,

            .ct-related-post-title,

            .ct-related-post .note-date span:last-child

            {font-size:<?php echo esc_html($fontsizenewH4);?>px;}
        /*18px*/

        /*16px*/
            h5,
            .h5,

            .widget.widget-box-style-1 .widget-title,

            .ct-compare-table-group .compare-table-title,

            #main-menu .dropdown-mega .channel-content .row .content-item .video-item .item-head h3

            {font-size:<?php echo esc_html($fontsizenewH5);?>px;}
        /*16px*/

        /*14px*/
            h6,
            .h6,

            .widget_nav_menu li,

            .widget_nav_menu li a,

            .widget_recent_comments .recentcomments > a,

            .body-content .vc_tta.vc_general .vc_tta-tab > a,
            .body-content .vc_tta.vc_general .vc_tta-panel-title > a,
            .body-content .vc_progress_bar .vc_single_bar .vc_label,
            .body-content .wpb_pie_chart_heading,
            .ct-sc-content-box.ct-sc-blog-v2 .cactus-post-item .cactus-post-title

            {font-size:<?php echo esc_html($heading_font_size);?>px}

            @media(max-width:599px) {
                .header-v4-builder .table-cell-content h1,
                .header-v4-builder .table-cell-content h2,
                .header-v4-builder .table-cell-content h3,
                .header-v4-builder .table-cell-content h4,
                .header-v4-builder .table-cell-content h5,
                .header-v4-builder .table-cell-content h6

                {font-size:<?php echo esc_html($heading_font_size);?>px}
            }
        /*14px*/

        /*15px*/
         	#main-menu .dropdown-mega .sub-menu-box-grid .columns li ul li.header

            {font-size:<?php echo esc_html($fontsizenewH_15);?>px}
         /*15px*/

        /*12px*/
            .btn-style-1.btn-style-2.btn-style-4,

            .textwidget .wpcf7 input[type="submit"],

            .widget_categories li,
            .widget_meta li,
            .widget_archive li,
            .widget_recent_entries li,
            .widget_recent_comments li,
            .widget_pages li,
            .widget_nav_menu li,

            .widget_categories li a,
            .widget_meta li a,
            .widget_archive li a,
            .widget_recent_entries li a,
            .widget_recent_comments li a,
            .widget_pages li a,
            .widget_nav_menu li a,

            .note-date span:first-child,

            .comments-area .reply a,

            .ct-custom-cf7 input[type="submit"],

            .special-text

            {font-size:<?php echo esc_html($fontsizenewH_12);?>px}

            @media(max-width:767px){
            	.gotohome-404 .btn
                {font-size:<?php echo esc_html($fontsizenewH_12);?>px}
            }
        /*12px*/

        /*20px*/
        	.digital-price .price-details

            {font-size:<?php echo esc_html($fontsizenewH_20);?>px}

            @media(max-width:767px){
            	.cactus-parallax-sections .ct-content h3
                {font-size:<?php echo esc_html($fontsizenewH_20);?>px}
            }
        /*20px*/

        /*36px*/
        	.header-style-basic h1 ,
            .cactus-parallax-sections .ct-content h3,
            .ct-counter-up .counter-number

            {font-size:<?php echo esc_html($fontsizenewH_36);?>px}
        /*36px*/

        /*48px*/
        	.s-style-7 .header-style-basic h1,

            .s-style-8 .header-style-basic h1

            {font-size:<?php echo esc_html($fontsizenewH_48);?>px}
        /*48px*/
    <?php
	}
	
	$letter_spacing = ot_get_option('letter_spacing', '0.2');
	if($letter_spacing!='0.2'){
		?>
        h1, .h1,
        h2, .h2,
        h3, .h3,
        h4, .h4,
        h5, .h5,
        h6, .h6,        
        .btn-default, button, 
        input[type=button], 
        input[type=submit],
        .btn-default:visited, 
        button:visited, 
        input[type=button]:visited, 
        input[type=submit]:visited,        
        form .btn-default:not(.btn-style-1), 
		form button:not(.btn-style-1), 
		form input[type=button]:not(.btn-style-1), 
		form input[type=submit]:not(.btn-style-1),
		form .btn-default:not(.btn-style-1):visited, 
		form button:not(.btn-style-1):visited, 
		form input[type=button]:not(.btn-style-1):visited, 
		form input[type=submit]:not(.btn-style-1):visited,        
        .btn-style-1.btn-style-2.btn-style-4,
        table:not(#wp-calendar) tbody tr:first-child > *,
		table:not(#wp-calendar) thead tr:first-child > *,    	
        #main-menu .navbar-default .navbar-nav>li>a,        
        #main-menu .navbar-nav>li ul li a,
        #top-nav .top-menu.navbar-nav>li ul li a,        
        #main-menu .dropdown-mega .sub-menu-box-grid .columns li ul li.header,
        #off-canvas .off-menu ul li a,
        .textwidget .wpcf7 input[type="submit"],
        .widget_tag_cloud .tagcloud a[class*="tag-link-"],
        .widget_calendar caption,
        .widget_edd_categories_tags_widget li a,
        .widget_nav_menu li a,
        .edd-cart li.edd_total .cart-total,
        .edd_checkout a,
		.edd_checkout a:focus,
        .widget_edd_product_details .button.edd-submit,
		.widget_edd_product_details .button.edd-submit:focus,
        .note-date span:first-child,
        .note-date span:last-child,
        .cactus-elements-search .search-excerpt,
        .paging-navigation .nav-links,
        .s-style-7 .header-style-basic h1,
        .s-style-8 .header-style-basic h1,
        .comments-area .comments-title,
        .comments-area .comment-author > .fn,
		.comments-area .comment-author > .fn > a,
        .comments-area .reply a,
        .ct-related-post-title,
        .ct-related-post .note-date span:last-child,
        .body-content .vc_progress_bar .vc_single_bar .vc_label,
        .body-content .wpb_pie_chart_heading,
        .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu .eco-all-categories > * span.menu-name,
        .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > a span.menu-name,
        .cactus-e-menu .cactus-e-menu-content .eco-menu-row .eco-main-menu > ul > li > ul > li > a > span.menu-name,
        .ct-custom-cf7 input[type="submit"],
        .widget_categories li a, 
		.widget_meta li a, 
		.widget_archive li a, 
		.widget_recent_entries li a, 
		.widget_recent_comments li a,
		.widget_pages li a, 
		.widget_nav_menu li a,
		.widget_edd_categories_tags_widget li a,
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
		.woocommerce #payment #place_order, 
        .woocommerce-page #payment #place_order,
		.woocommerce div.product form.cart .button,
		.woocommerce #respond input#submit, .woocommerce a.button, 
        .woocommerce button.button, .woocommerce input.button         
        {letter-spacing:<?php echo esc_html($letter_spacing);?>em}
        
        @media(max-width:767px){
			.s-style-7 .header-style-basic h1,
            .s-style-8 .header-style-basic h1,
            .gotohome-404 .btn
            
            {letter-spacing:<?php echo esc_html($letter_spacing);?>em}
		}
        <?php
	}
	
	/*main navigation responsive*/
	$custom_navigation = ot_get_option('custom_nav_responsive', 'off');
	if($custom_navigation=='on'){
		$desktop_width = trim(ot_get_option('desktop_width', ''));
		$mobile_width = trim(ot_get_option('mobile_width', ''));
		
		if(is_numeric($desktop_width)){
		?>
        	@media(max-width:<?php echo $desktop_width;?>px) {
				.cactus-nav.style-2 .cactus-main-menu { width:100%; float:left; text-align:center; font-size:0; line-height:0; border-top:1px solid rgba(34,34,34,0.1);}
				.cactus-nav.style-2 .navbar-default.sticky-menu .cactus-main-menu { width:auto; border:none;}
				
				.cactus-nav.style-2 .cactus-main-menu > * { display:inline-block; float:none;}
				.cactus-nav.style-2 .search-drop-down > li:before { display:none;}
				.cactus-nav.style-2.style-3:not(.schema-light) .cactus-main-menu { border-color: rgba(255,255,255,0.1);}
				
				.cactus-nav.style-2 #main-menu .navbar-default .navbar-nav.cactus-main-menu>li>a { padding-top:15px; padding-bottom:14px;}
                
                .cactus-nav.style-2.style-3:not(.style-for-sticky) + .header-style-forall {min-height:185px;}
                
                .config-header-list-page .cactus-nav.style-2.style-3:not(.style-for-sticky) + .header-style-forall > .hs-ct-content > .bg-header-top { min-height:310px; padding-top:195px;}
			} 
        <?php
			if(is_numeric($mobile_width)){
		?>
            	@media(min-width:<?php echo ((int)$mobile_width+1).'px';?>) and (max-width:<?php echo esc_html($desktop_width).'px';?>){
                 
            <?php } else {
				?>
                @media(min-width:992px) and (max-width:<?php echo esc_html($desktop_width).'px';?>){
            <?php } ?>     
                    body.single.single-ct_portfolio #body-wrap .config-header-list-page .cactus-nav.style-2.style-3 + .s-style-8.ct-project .hs-ct-content .bg-header-top { min-height:720px; padding-top:230px;} 
                    body.single.single-ct_portfolio #body-wrap .config-header-list-page .cactus-nav.style-2.style-3 + .s-style-8.ct-project.p-v2 .hs-ct-content .bg-header-top { min-height:385px; padding-top:210px;}
                }
        <?php    
		}
		
		
		if(is_numeric($mobile_width)){
		?>
        	@media(max-width:<?php echo esc_html($mobile_width);?>px){
                #main-menu .navbar-nav { margin:0; float:left;}
                #main-menu .navbar-nav.navbar-right { float:right;}
                
                .cactus-main-menu { display:none;}
               
                #main-menu>.navbar-default .main-menu-wrap { min-height:50px;}
                #main-menu .navbar-default .navbar-nav>li>a { padding-top:15px; padding-bottom:15px;}
                
                #main-menu .navbar-default .navbar-nav>li>a.open-search-main-menu {padding-top:20px; padding-bottom:20px;}
				#main-menu .search-drop-down ~ .header-cart-mobile { margin-right:-10px;}                
                
                .open-menu-mobile { display:block;} 
                
                #main-menu .navbar-default .navbar-nav>li>a.open-search-main-menu { min-height:50px;}
                #main-menu .navbar-default .navbar-nav>li>a.open-search-main-menu>span { display:none;}
                #main-menu .search-drop-down>li>ul { right:0;}	
                
                #main-menu .header-cart-mobile { display:block;}
                
                .header-top-hotline,
                .header-top-slogan { display:none;}
			}
            @media(max-width:479px) {
                #main-menu .container-1340 {padding-left: 15px; padding-right: 15px;}
                #main-menu .search-drop-down>li>ul { width:100vw;right:5px;}
                .cactus-nav.style-2 #main-menu .search-drop-down>li>ul { right:-5px;}
                #main-menu .navbar-nav.search-drop-down>li > ul.search-main-menu:before {right:15px;}
                .cactus-nav.style-2 #main-menu .navbar-nav.search-drop-down>li > ul.search-main-menu:before {right:15px;}
            }
            
            @media(max-width:<?php echo esc_html($mobile_width);?>px){
				.cactus-nav.style-2 #main-menu .header-top-checkout { display:none;}
				.cactus-nav.style-2 #main-menu .open-menu-mobile { float:right;}
				.cactus-nav.style-2 #main-menu>.navbar-default .main-menu-wrap { min-height:80px;}
				.cactus-nav.style-2 .search-drop-down { padding-left:0;}
				.cactus-nav.style-2 .search-drop-down > li:before { display:none;}
				.cactus-nav.style-2 #main-menu .navbar-default .navbar-nav>li>a { min-height:80px; padding-top:32px; padding-bottom:32px; padding-left:20px; padding-right:20px;}
				.cactus-nav.style-2 #main-menu .navbar-default .navbar-nav>li>a.open-search-main-menu {padding-left:35px; padding-top:32px; padding-bottom:32px;}
				.cactus-nav.style-2 .header-cart-mobile a:before { display:none;}
			}	
			@media(max-width:600px){
				.cactus-nav.style-2 #main-menu .main-menu-wrap .logo-infomation { width:60%;}
			}	
			@media(max-width:479px){
				.cactus-nav.style-2 #main-menu>.navbar-default .main-menu-wrap { margin-left:-10px; margin-right:-10px;}
				.cactus-nav.style-2 #main-menu .container-1340 {padding-left:15px; padding-right:15px;}	
				.cactus-nav.style-2 #main-menu .navbar-default .navbar-nav>li>a { padding-left:10px; padding-right:10px;}
				.cactus-nav.style-2 #main-menu .navbar-default .navbar-nav>li>a.open-search-main-menu {padding-left:35px; padding-right:10px;}
				.cactus-nav.style-2 #main-menu .open-search-main-menu .fa-search,
				.cactus-nav.style-2 #main-menu .open-search-main-menu .fa-times { right:10px;}
				
				.cactus-nav.style-2 .header-cart-mobile a {padding-left:10px; padding-right:10px;}
				.cactus-nav.style-2 #main-menu .main-menu-wrap .logo-infomation { width:55%;}
			}
            
            @media(max-width:<?php echo esc_html($mobile_width);?>px) {
                #main-nav .navbar-nav { margin:0;float:left;}
                #main-nav .navbar-nav.navbar-right { float:right;}
                
                #main-nav .container-full-width { padding-left:30px; padding-right:30px;}
                .header-top-checkout { display:none;}
                
                #main-nav>.navbar-default { min-height:80px;}
                .logo-infomation>li {height:80px; padding-top:15px; padding-bottom:15px;}
                .logo-infomation>li>a>img {max-height:50px;}	
                
                .header-mobile-sub-menu { display:block;}
                #main-nav .navbar-default>.container>.navbar-nav.navbar-right.header-mobile-sub-menu { margin-right:0;}
            }
            
            @media(max-width:767px) {
                .logo-infomation>li>a>img {max-width:45vw;}	
            }
            
            @media(max-width:479px) {
                #main-nav .container-full-width { padding-left:15px; padding-right:15px;}
                .logo-infomation { width:80%;}
            }	
            
            @media(max-width:<?php echo esc_html($mobile_width);?>px) {
                #off-canvas { width:70%;}
                body.open-true .canvas-ovelay {visibility: visible; opacity:1;}
                body.open-true #off-canvas {transform:translate(0,0); -webkit-transform:translate(0,0); -ms-transform:translate(0,0);}			
                
                body.open-true-right.active .canvas-ovelay {visibility: visible; opacity:1;}
                
                body.open-true-right #off-canvas { transition:none; -webkit-transition:none;}
                body.open-true-right.active #off-canvas {visibility: visible; opacity:1; transform:translate(0,0); -webkit-transform:translate(0,0); -ms-transform:translate(0,0); transition:transform 0.2s, visibility 0.2s, opacity 0.2s; -webkit-transition:-webkit-transform 0.2s, visibility 0.2s, opacity 0.2s;}
                
            }
            
            @media(min-width:<?php echo esc_html(((int)$mobile_width+1));?>px) {
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .main-menu-wrap { min-height:60px;}		
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .navbar-nav.cactus-main-menu>li>a {padding-top: 20px; padding-bottom:19px;}	
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .navbar-nav>li>a.open-search-main-menu {padding-top: 30px; padding-bottom:30px;}                
                
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .header-top-checkout { padding-top:22px; padding-bottom:22px; min-height:60px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .search-drop-down > li:before,
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .header-top-checkout > .widget-inner:before { top:16px; height:30px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .header-top-checkout [class^="ct-icon-"] { font-size:30px; margin-right:0;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .header-top-checkout .btn-default { display:none;}
                
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation>li { height:60px; padding-top:12px; padding-bottom:12px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation>li>a>img { max-height:36px; max-width:100%; width:auto;}
            }		
            
            @media(max-width:<?php echo esc_html($mobile_width);?>px) {
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .main-menu-wrap { min-height:60px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .header-cart-mobile a { min-height:60px; padding-top:18px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .navbar-nav>li>a { padding-top:22px; padding-bottom:22px; min-height:60px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation.navbar-nav>li>a { padding-top:0; padding-bottom:0;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation>li { height:60px; padding-top:10px; padding-bottom:10px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation>li>a { min-height:1px;}
                .cactus-nav.style-2 #main-menu > .navbar-default.sticky-menu .logo-infomation>li>a>img { max-height:40px;}
            }
        <?php	
		}
	}
	/*main navigation responsive*/
	
/*custom css*/
echo ot_get_option('custom_css','');
