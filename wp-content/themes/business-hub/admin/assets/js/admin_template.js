//custom upload image in User Setting.
jQuery(document).ready(function($){
    var custom_uploader;
    var data_ref ;
    var data_img_scr ;
/* Category Header Background */
    $('#upload_cat_header_background_button, #upload_footer_cta_background').click(function(e) {
        e.preventDefault();
        data_ref = $(this).attr('data-ref');
        data_img_scr = $(this).attr('data-img-scr');
        $(data_img_scr).show();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
			if($(data_ref).length > 0)
            	$(data_ref).val(attachment.url);
            	$(data_img_scr).attr('src', attachment.url)

        });
        //Open the uploader dialog
        custom_uploader.open();

    });
});

//Remove image in User Setting.
jQuery(document).ready(function($){
/* Category Header Background */
	$('#remove_image_cat_header_background_button').click(function(e) {
	  	if($('#cat_header_background').length > 0)
	  		$('#cat_header_background').val('');
			$('#img-preview-header-bg').hide(200);
	});
/* Category Header Background */

/* Category Footer CTA Background */
	$('#remove_cta_background').click(function(e) {
	  	if($('#cat_footer_cta_background').length > 0)
	  		$('#cat_footer_cta_background').val('');
			$('#img-preview-footer-cta').hide(200);
	});
/* Category Footer CTA Background */
//custom upload image in User Setting.

/* Page Template Settings */

	var page_templates 							= jQuery('select[name=page_template]');
	var templates								= jQuery('select[name=page_template]').val();
	var front_page_metadata 					= jQuery('#front_page_metadata.postbox');
	var front_page_content_settings 			= jQuery('#front_page_content_settings.postbox');
	var text_heading_style 						= jQuery('#page_meta_text_heading_style');
	var text_heading_style_value				= jQuery('#page_meta_text_heading_style').val();
	var setting_page_meta_sidebar 				= jQuery('#setting_page_meta_sidebar');
	var setting_page_meta_heading_sub_text 		= jQuery('#setting_page_meta_heading_sub_text');
	var setting_page_meta_heading_icon 			= jQuery('#setting_page_meta_heading_icon');
	var setting_page_meta_header_background 	= jQuery('#setting_page_meta_header_background');
	var edd_addon_header_settings 				= jQuery('#edd_addon_header_settings.postbox');

	if(text_heading_style_value == 'hidden'){
		setting_page_meta_heading_sub_text.hide(200);
		setting_page_meta_heading_icon.hide(200);
		setting_page_meta_header_background.hide(200);
	}else{
		setting_page_meta_heading_sub_text.show();
		setting_page_meta_heading_icon.show();
		setting_page_meta_header_background.show();
	}
	text_heading_style.change(function(event) {
		if(jQuery(this).val() == 'hidden'){
			setting_page_meta_heading_sub_text.hide(200);
			setting_page_meta_heading_icon.hide(200);
			setting_page_meta_header_background.hide(200);
		}else{
			setting_page_meta_heading_sub_text.show(200);
			setting_page_meta_heading_icon.show(200);
			setting_page_meta_header_background.show(200);
		}
	});

	if(templates == 'page-templates/front-page.php'){
		front_page_metadata.show(200);
		front_page_content_settings.show(200);
		setting_page_meta_sidebar.hide(200)
		edd_addon_header_settings.hide(200);
	}else if(templates == 'templates/edd-page-template.php'){
		edd_addon_header_settings.show(200);
		setting_page_meta_sidebar.show(200)
		front_page_metadata.show(200);
		front_page_content_settings.hide(200);
	}else{
		front_page_metadata.hide(200);
		front_page_content_settings.hide(200);
		edd_addon_header_settings.hide(200);
		setting_page_meta_sidebar.show();
	}

	page_templates.change(function(event) {
		if(jQuery(this).val() == 'page-templates/front-page.php'){
			front_page_metadata.show(200);
			front_page_content_settings.show(200);
			edd_addon_header_settings.hide(200);
			setting_page_meta_sidebar.hide(200);
		}else if(jQuery(this).val() == 'templates/edd-page-template.php'){
			front_page_metadata.show(200);
			front_page_content_settings.hide(200);
			edd_addon_header_settings.show(200);
			setting_page_meta_sidebar.show(200);
		}else{
			front_page_metadata.hide(200);
			front_page_content_settings.hide(200);
			edd_addon_header_settings.hide(200);
			setting_page_meta_sidebar.show(200);
		}
	});

	var frontpage_content					= jQuery('#meta_page_content');
	var frontpage_content_value				= jQuery('#meta_page_content').val();
	var setting_frontpage_sidebar			= jQuery('#setting_frontpage_sidebar');
	var setting_meta_page_layout			= jQuery('#setting_meta_page_layout');
	var setting_meta_page_content_cat		= jQuery('#setting_meta_page_content_cat');
	var setting_meta_page_content_tag		= jQuery('#setting_meta_page_content_tag');
	var setting_meta_page_content_id		= jQuery('#setting_meta_page_content_id');
	var setting_meta_page_content_orderby	= jQuery('#setting_meta_page_content_orderby');
	var setting_meta_page_content_count		= jQuery('#setting_meta_page_content_count');

	var edd_addon_banner_area					= jQuery('#edd_addon_banner_area');
	var edd_addon_banner_area_value				= jQuery('#edd_addon_banner_area').val();
	var edd_addon_productnews_content			= jQuery('#edd_addon_productnews_content');
	var edd_addon_productnews_content_value		= jQuery('#edd_addon_productnews_content').val();
	var setting_edd_addon_big_banner_bg			= jQuery('#setting_edd_addon_big_banner_bg');
	var setting_edd_addon_big_banner_content	= jQuery('#setting_edd_addon_big_banner_content');
	var setting_edd_addon_small_banner1_bg		= jQuery('#setting_edd_addon_small_banner1_bg');
	var setting_edd_addon_small_banner1_text	= jQuery('#setting_edd_addon_small_banner1_text');
	var setting_edd_addon_small_banner2_bg		= jQuery('#setting_edd_addon_small_banner2_bg');
	var setting_edd_addon_small_banner2_text	= jQuery('#setting_edd_addon_small_banner2_text');
	var setting_edd_addon_custom_news_content	= jQuery('#setting_edd_addon_custom_news_content');
	var setting_edd_addon_banner_area_bg		= jQuery('#setting_edd_addon_banner_area_bg');
	var setting_edd_addon_banner_area_custom_content	= jQuery('#setting_edd_addon_banner_area_custom_content');

	if(edd_addon_productnews_content_value == 'custom_content'){
		setting_edd_addon_custom_news_content.show(200);
	}else{
		setting_edd_addon_custom_news_content.hide(200);
	}
	edd_addon_productnews_content.change(function(event) {
		if(jQuery(this).val()  == 'custom_content'){
			setting_edd_addon_custom_news_content.show(200);

		}else{
			setting_edd_addon_custom_news_content.hide(200);
		}
	});

	if(edd_addon_banner_area_value == 'built_in'){
		setting_edd_addon_big_banner_bg.show(200);
		setting_edd_addon_big_banner_content.show(200);
		setting_edd_addon_small_banner1_bg.show(200);
		setting_edd_addon_small_banner1_text.show(200);
		setting_edd_addon_small_banner2_bg.show(200);
		setting_edd_addon_small_banner2_text.show(200);
		setting_edd_addon_banner_area_bg.hide(200)
		setting_edd_addon_banner_area_custom_content.hide(200);
	}else{
		setting_edd_addon_big_banner_bg.hide(200);
		setting_edd_addon_big_banner_content.hide(200);
		setting_edd_addon_small_banner1_bg.hide(200);
		setting_edd_addon_small_banner1_text.hide(200);
		setting_edd_addon_small_banner2_bg.hide(200);
		setting_edd_addon_small_banner2_text.hide(200);
		setting_edd_addon_banner_area_bg.show(200);
		setting_edd_addon_banner_area_custom_content.show(200);
	}
	edd_addon_banner_area.change(function(event) {
		if(jQuery(this).val()  == 'built_in'){
			setting_edd_addon_big_banner_bg.show(200);
			setting_edd_addon_big_banner_content.show(200);
			setting_edd_addon_small_banner1_bg.show(200);
			setting_edd_addon_small_banner1_text.show(200);
			setting_edd_addon_small_banner2_bg.show(200);
			setting_edd_addon_small_banner2_text.show(200);
			setting_edd_addon_banner_area_bg.hide(200)
			setting_edd_addon_banner_area_custom_content.hide(200);
		}else{
			setting_edd_addon_big_banner_bg.hide(200);
			setting_edd_addon_big_banner_content.hide(200);
			setting_edd_addon_small_banner1_bg.hide(200);
			setting_edd_addon_small_banner1_text.hide(200);
			setting_edd_addon_small_banner2_bg.hide(200);
			setting_edd_addon_small_banner2_text.hide(200);
			setting_edd_addon_banner_area_bg.show(200);
			setting_edd_addon_banner_area_custom_content.show(200);
		}
	});

	if(frontpage_content_value == 'this_page'){
		setting_meta_page_layout.hide(200);
		setting_meta_page_content_cat.hide(200);
		setting_meta_page_content_tag.hide(200);
		setting_meta_page_content_id.hide(200);
		setting_meta_page_content_orderby.hide(200);
		setting_meta_page_content_count.hide(200);
		setting_frontpage_sidebar.hide(200);
	}else{
		setting_meta_page_layout.show();
		setting_meta_page_content_cat.show();
		setting_meta_page_content_tag.show();
		setting_meta_page_content_id.show();
		setting_meta_page_content_orderby.show();
		setting_meta_page_content_count.show();
		setting_frontpage_sidebar.show();
	}

	frontpage_content.change(function(event) {
		if(jQuery(this).val()  == 'this_page'){
			setting_meta_page_layout.hide(200);
			setting_meta_page_content_cat.hide(200);
			setting_meta_page_content_tag.hide(200);
			setting_meta_page_content_id.hide(200);
			setting_meta_page_content_orderby.hide(200);
			setting_meta_page_content_count.hide(200);
			setting_frontpage_sidebar.hide(200);
		}else{
			setting_meta_page_layout.show();
			setting_meta_page_content_cat.show();
			setting_meta_page_content_tag.show();
			setting_meta_page_content_id.show();
			setting_meta_page_content_orderby.show();
			setting_meta_page_content_count.show();
			setting_frontpage_sidebar.show();
		}
	});
/* Page Template Settings */
});
