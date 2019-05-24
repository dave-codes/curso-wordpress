;(function($){
	// Save current page
	if(typeof cactus.query_vars !== 'undefined'){
		_current_page = cactus.query_vars.paged;
	} else {
		_current_page = -1;
	}
	if(_current_page == 0) _current_page = 1;
	// flag to check if an ajax is executing
	_ajax_loading = false;
	$(document).ready(function(){
		var num_page  		= $('.cactus-sub-wrap input[name="ct_num_page"]').val();
		var archives_thumb	= $('input[name="archives_thumb"]').val();
		var page = _current_page;
		if($('#navigation-ajax').length > 0){
			$('#navigation-ajax').live('click', function(e){
				  e.preventDefault();
				  if(_current_page > -1 && !_ajax_loading){
						item_template = $(this).attr('data-template');
						ajax_button 			= $('#navigation-ajax');
						
						data = 	{	
									action: 'load_more',
									page: _current_page,
									template: item_template,
									vars:cactus.query_vars,
									archives_thumb: archives_thumb,
								};
						
						content_div = $(this).attr('data-target');
						
						_ajax_loading = true;
						ajax_button.addClass('show-loading');					
						$.ajax({
							  type: 'POST',
							  url: cactus.ajaxurl,
							  cache: false,
							  data: data,
							  success: function(data, textStatus, XMLHttpRequest){								  
								 
								page =  page +1;
								if(page == num_page){$(".navigation-ajax").hide();}
								if(data != ''){
									
									function adaptiveLoad(){
										for (var i = 0; i < lazyLoadedImages.length; i++) {
											loadAdaptiveImage(lazyLoadedImages[i]);
										};
										
										if(checkLazyLoadEnable){
											$("img.cactus-lazy:not(.ct-done)").lazyload({
												effect:"fadeIn",
											}).addClass('ct-done');
										};	
									}
									
									function removeLastPage(){
										_current_page = _current_page + 1;
	
										if($('.no-posts').length > 0){
											_current_page = -1;
											$(".navigation-ajax").hide();
											$('.no-posts').remove();
										};										
										ajax_button.removeClass('show-loading');
										_ajax_loading = false;
									};									
									if($(content_div).parents('.portfolio:not(.is-single)').length>0){	
									
										var isotopeID = $(content_div).attr('data-index-isotope');
										var dataLoadingIndex = 'dataloading-index-'+isotopeID;
										
										$(content_div).parents('.cactus-listing-config').append('<div id="'+dataLoadingIndex+'" style="display:none;">'+(data)+'</div>');
										
										$('#'+dataLoadingIndex).imagesLoaded()
										.always( function( instance ) {})
										.done( function( instance ) {
											var newItems = $(data).appendTo(content_div);																																
											masonryPortfolioIndex[isotopeID].isotope('appended',newItems).isotope('layout');
											$('#'+dataLoadingIndex).remove();
											adaptiveLoad();
											removeLastPage();																			
										})
										.fail( function() { })
										.progress( function( instance, image ) {});										
									}else{
										$(content_div).append(data);	
										adaptiveLoad();																	
										removeLastPage();
									};
								} else {
									_current_page = -1;
									 $(".navigation-ajax").hide();
								}								
							  },
							  error: function(MLHttpRequest, textStatus, errorThrown){
									alert(errorThrown);
									_ajax_loading = false;
									ajax_button.removeClass('show-loading');
							  }
						  });
					}
	
				});
		}
	});
}(jQuery));