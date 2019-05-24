var masonryPortfolioIndex = [];

function isNumber(n) {return !isNaN(parseFloat(n)) && isFinite(n);};

function updateQueryStringParameter(uri, key, value) {
	var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
};

;(function($){
	/*function*/
		
		$( ".ct-eddbutton-group .btn" ).each(function(){
			$(this).on('click', function(){
				var ct_price_id;
				ct_price_id = $('.price-options-group .add-custom-select', $(this).parent().parent() ).val();
			
				if(ct_price_id == null){
					ct_price_id = 0;
				}
			
				if(ct_price_id != null){
					var data_price_id = "[data-price-id='"+ct_price_id+"']";
					var dataLink_value = $(data_price_id, $(this).parent().parent()).attr("data-link");
					$(this).attr('href', dataLink_value);
				}
				});
		});
		
		function setCounterUp( elms ){
			
			$(elms).each(function(index, element) {
                var $dataDelay = $(this).parents('.ct-counter-up').attr('data-delay');
				if($dataDelay=='' || typeof($dataDelay)=='undefined' || !isNumber($dataDelay)) {$dataDelay=10;}else{$dataDelay=parseInt($dataDelay)};
				
				var $dataTime = $(this).parents('.ct-counter-up').attr('data-time');
				if($dataTime=='' || typeof($dataTime)=='undefined' || !isNumber($dataTime)) {$dataTime=1000;}else{$dataTime=parseInt($dataTime)};
				
				try {
					$(this).counterUp({
						delay: $dataDelay,
						time: $dataTime
					});
				}
				catch(err) {
					
				};
            });
			
		};
		
		/*scroll Up & down*/
		function scrollFunc(e) {
			var $mainMenu = $('#main-menu.set-sticky-menu');
			var $menuSticky = $('#main-menu.set-sticky-menu > .navbar.navbar-default');
			var $parrentStyle = $('#main-menu').parents('.cactus-nav');
			
			if ( typeof scrollFunc.x == 'undefined' ) {
				scrollFunc.x=window.pageXOffset;
				scrollFunc.y=window.pageYOffset;
			};
			
			var diffX=scrollFunc.x-window.pageXOffset;
			var diffY=scrollFunc.y-window.pageYOffset;
		
			if(diffX<0) {
				// Scroll right
			}else if( diffX>0 ) {
				// Scroll left
			}else if( diffY<0 ) {
				// Scroll down				
				/*sticky menu*/
					if(!$('#main-menu').hasClass('set-sticky-menu')) { return; };								
					if($(window).scrollTop() >= (($mainMenu.offset().top) + $mainMenu.height())) {
						$mainMenu.height($menuSticky.height());
						
						if($mainMenu.hasClass('is-always')) {
							$menuSticky.css({'transform':'translateY(0)', '-webkit-transform':'translateY(0)', '-ms-transform':'translateY(0)'});
						}else{
							$menuSticky.css({'transform':'translateY(-100%)', '-webkit-transform':'translateY(-100%)', '-ms-transform':'translateY(-100%)'});
						};
						if(!$parrentStyle.hasClass('style-2')){
							$parrentStyle.addClass('style-2 style-for-sticky');
						};
						$menuSticky.addClass('sticky-menu');
					};					
				/*sticky menu*/
				
			}else if( diffY>0 ) {
				// Scroll up				
				/*sticky menu*/	
					if(!$('#main-menu').hasClass('set-sticky-menu')) { return; };					
					if($(window).scrollTop() <= (($mainMenu.offset().top) + $mainMenu.height())) {
						$menuSticky
						.removeAttr('style')
						.removeClass('sticky-menu animate-sticky');
						
						if($parrentStyle.hasClass('style-for-sticky')){
							$parrentStyle.removeClass('style-2 style-for-sticky');							
						};
						
						$mainMenu.height($menuSticky.height());							
						
					}else{						
						$mainMenu.height($menuSticky.height());						
						$menuSticky
						.addClass('animate-sticky')
						.css({'transform':'translateY(0)', '-webkit-transform':'translateY(0)', '-ms-transform':'translateY(0)'});
					};
				/*sticky menu*/
				
			}else {
				// First scroll event
			}
			scrollFunc.x=window.pageXOffset;
			scrollFunc.y=window.pageYOffset;
		};
		/*scroll Up & down*/
	/*function*/
	
	$(document).ready(function() {
		
		$('[data-toggle="tooltip"]').tooltip();		
		
		$('#main-menu .cactus-main-menu>li>*:not(a)').each(function(index, element) {
            if($(this).length>0){
				$(this).parents('li').children('a').append('<i class="fa fa-angle-down"></i>');
			};
        }); //Menu lv1
		
		$('#main-menu .cactus-main-menu>li>*:not(a) li>*:not(a)').each(function(index, element) {
            if($(this).length>0){
				if($('[id="rtl-css"]').length>0){					
					$(this).parent().children('a').append('<i class="fa fa-angle-left"></i>');
				}else{
					$(this).parent().children('a').append('<i class="fa fa-angle-right"></i>');
				}
			};
        }); //Menu lv2, 3, 4 ...
		jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" id="add1" class="plus" />' ).prepend( '<input type="button" value="-" id="minus1" class="minus" />' );
		jQuery('.buttons_added #minus1').click(function(e) {
			var value = parseInt(jQuery(this).next().val()) - 1;
			if(value>0){
				jQuery(this).next().val(value);
				jQuery('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
			}
		});
		jQuery('.buttons_added #add1').click(function(e) {
			var value = parseInt(jQuery(this).prev().val()) + 1;
			jQuery(this).prev().val(value);
			jQuery('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
		});
		/*Mobile*/
		$('#off-canvas .off-menu>ul>li>*:not(a)').each(function(index, element) {
            if($(this).length>0){
				$(this).parents('li').append('<i class="fa fa-angle-down"></i>');
			};
        }); //Menu lv1
		
		/*widget custom menu*/
			$('.widget_nav_menu .menu>li>*:not(a)').each(function(index, element) {
				if($(this).length>0){
					$(this).parents('li').children('a').addClass('havesubmenu');
				};
			}); //Menu lv1
			
			$('.widget_nav_menu .menu>li>*:not(a) li>*:not(a)').each(function(index, element) {
				if($(this).length>0){
					$(this).parent().children('a').addClass('havesubmenu');
				};
			}); //Menu lv2, 3, 4 ...
			
			$('.widget_nav_menu .menu>li a.havesubmenu').on('click', function() {
				var $this = $(this).parent('li');
				if($this.hasClass('active')) {
					$this.removeClass('active');
				}else{
					$this.addClass('active');
				};
				return false;
			}); 
		/*widget custom menu*/
		
		//Open search main menu
		$('.navbar-default .open-search-main-menu').on('click', function(){
			$this = $(this);
			if($this.hasClass('close-sb')) {
				$this.parents('.navbar-default').find('.search-main-menu').removeClass('active');
				setTimeout(function(){$this.parents('.navbar-default').find('.search-main-menu').find('input[type="text"]').blur();},200);	
				$this.removeClass('close-sb');				
			}else{
				$this.parents('.navbar-default').find('.search-main-menu').addClass('active');
				setTimeout(function(){$this.parents('.navbar-default').find('.search-main-menu').find('input[type="text"]').focus();},200);	
				$this.addClass('close-sb');
			};
		});
		//Open search main menu
		
		//Clone Sidebar
		if($('#top-nav .header-top-info').length > 0) {
			$('#top-nav .header-top-info').clone().appendTo('.header-sidebar-mobile');
		}
		if($('#main-nav .header-top-slogan').length > 0) {
			$('#main-nav .header-top-slogan').clone().appendTo('.header-sidebar-mobile');
		}
		//Clone Sidebar
		
		//Open Main menu mobile	
		$(".open-menu-mobile>li>a").on('click', function(){
			$('body').toggleClass('open-true');
		});
		
		
		var timeOutOpen = null;
		$(".header-mobile-sub-menu>li>a").on('click', function(){			
			if($('body').hasClass("open-true-right")) {				
				$('body').removeClass('open-true-right active');
			}else{
				if(timeOutOpen!=null) {clearTimeout(timeOutOpen)};				
				$('body').addClass('open-true-right');				
				timeOutOpen=setTimeout(function(){
					$('body').addClass('active');
				},100);
							
			};			
		});		
		//Open Main menu mobile
		
		/*Close Main menu mobile*/
		$("#off-canvas .close-canvas-menu, .canvas-ovelay").on('click', function(){					
			$('body').removeClass('open-true');
			var timeOutRemove = null;
			if($('body').hasClass('open-true-right')) {
				$('body').removeClass("active");
				$('#off-canvas').css('opacity','0');
				if(timeOutRemove!=null) {clearTimeout(timeOutRemove)};
				timeOutRemove=setTimeout(function(){
					$('body').removeClass("open-true-right");
					setTimeout(function(){
						$('#off-canvas').removeAttr('style');		
					},400);												
				},300);
			};		
		});
		/*Close Main menu mobile*/
		
		/*Menu mobile open sub*/
		var subMenuLv2 = $('#off-canvas .off-menu>ul>li>ul');
		var heightDFindex = [];
		subMenuLv2.each(function(index, element) {
			var $this = $(this);
			heightDFindex[index] = $this.outerHeight();
			$this.addClass('hidden');
			
			function callback(){
				if($this.hasClass('hidden')) {
					$this.removeClass('hidden');										
				}else{					
					$this.addClass('hidden');
				};				
				return false;
			};
			
			$this.parents('li').children('i.fa-angle-down').on('click', callback);
			$this.parents('li').children('i.fa-angle-down').bind('touchstart', callback);			
        });
		/*Menu mobile open sub*/
		
		$('.cactus-main-menu li>a, .top-menu li>a').bind('touchstart', function(e){
			var $this = $(this);
			if($this.parents('li').find('ul').length > 0 && !$this.hasClass('no-go-to-touch')){
				$this.addClass('no-go-to-touch');
				return false;
			};
		});
		
		/*masonry portfolio*/
		if($('.portfolio:not(.is-single) .cactus-sub-wrap').length>0) {
			$(window).load(function(e) {
				$('.portfolio:not(.is-single) .cactus-sub-wrap').each(function(index, element) {
					
					$(this).attr('data-index-isotope', index);
										
                    masonryPortfolioIndex[index] = $(this).isotope({});
					
					if(masonryPortfolioIndex[index].parents('.portfolio').find('.portfolio-filter').length>0) {
						masonryPortfolioIndex[index].parents('.portfolio').find('.portfolio-filter').on( 'click', '.btn', function() {
							$(this).parent().find('.btn').removeClass('active');
							$(this).addClass('active');
							var filterValue = $(this).attr('data-filter');
							masonryPortfolioIndex[index].isotope({ filter: filterValue });
						});
					};
                });
                
            });
		};			
		/*masonry portfolio*/
		
		setCounterUp('.ct-counter-up > .counter-up-item > .counter-number');
		
		var myBxSlider = [];
		$('.ct-ft-gallery').each(function(index, element) {
            var $this = $(this);
			
			if($this.find('.ct-post-gallery-wrapper > *').length==0) {return;}; // stop
			
			var __dataItem 			= $this.attr('data-item');
			if(__dataItem=='' || typeof(__dataItem)=='undefined' || !isNumber(__dataItem)) {__dataItem=1;}else{__dataItem=parseInt(__dataItem)};
			
			var __dataAutoPlay 		= $this.attr('data-auto-play');
			if(__dataAutoPlay=='' || typeof(__dataAutoPlay)=='undefined' || !isNumber(__dataAutoPlay)) {__dataAutoPlay=0;};
			
			var __dataAutoPlaySpeed = $this.attr('data-auto-play-speed');
			if(__dataAutoPlaySpeed=='' || typeof(__dataAutoPlaySpeed)=='undefined' || !isNumber(__dataAutoPlaySpeed)) {__dataAutoPlaySpeed=5000;}
			
			var sliderConfig = $('.ct-post-gallery-wrapper', $this);
			//if(sliderConfig.length>0) {
			sliderConfig
			.imagesLoaded()
			.done( function( instance ) {
				if(sliderConfig.length==0) {return};
				createSlider();
			});
				
			var createSlider = function(){	
				
				var checkClickElms = 0;
				var checkEffectElms = 1;
				var adaptiveHeight = function(){
					var elmsheight = sliderConfig.find('.slick-slide:not(.slick-cloned).slick-active');
					var totalElmsheight = sliderConfig.find('.slick-slide:not(.slick-cloned)');
					
					if(elmsheight.length == totalElmsheight.length) {
						$('.cactus-slider-button-prev, .cactus-slider-button-next', $this).hide();
						return;
					}
					if(!$this.is('.archive, .ct-testi, .story-box')) {
						$('.cactus-slider-button-prev, .cactus-slider-button-next', $this).show();
					}
					
					var elmsSetHeight = sliderConfig.find('.slick-list[aria-live="polite"]');
					if(elmsheight.length==1 && checkClickElms==0) {return;}
					
					var totalHeight=Array();
					elmsheight.each(function(index, element) {
                        totalHeight.push($(this).height());
                    });
					
					//totalHeight.sort();					
					totalHeight.sort(function(a, b){return b-a});	
					
					if(checkEffectElms==1) {				
						elmsSetHeight.css({'overflow':'hidden'}).animate({height:totalHeight[0]},300);
					}else{
						elmsSetHeight.css({'overflow':'hidden'}).height(totalHeight[0]);
					}									
					checkClickElms = 0;
				};
								
				var responsiveParam = [];
				
				switch(__dataItem){
					case 1:
						break;
					case 2:
						responsiveParam = [												
							{
							  breakpoint: 			768,
							  settings: {
								slidesToShow: 		1,
								slidesToScroll:		1,
								dots: 				true
							  }
							},
						];
						break;	
					case 3:
						responsiveParam = [	
							{
							  breakpoint: 			1025,
							  settings: {
								slidesToShow: 		2,
								slidesToScroll:		2,
								dots: 				true
							  }
							},							
							{
							  breakpoint: 			768,
							  settings: {
								slidesToShow: 		1,
								slidesToScroll:		1,
								dots: 				true
							  }
							},
						];
						break;
					case 4:
						responsiveParam = [	
							{
							  breakpoint: 			1367,
							  settings: {
								slidesToShow: 		3,
								slidesToScroll:		3,
								dots: 				true
							  }
							},
							{
							  breakpoint: 			1025,
							  settings: {
								slidesToShow: 		2,
								slidesToScroll:		2,
								dots: 				true
							  }
							},							
							{
							  breakpoint: 			768,
							  settings: {
								slidesToShow: 		1,
								slidesToScroll:		1,
								dots: 				true
							  }
							},
						];
						break;
					case 5:
						responsiveParam = [	
							{
							  breakpoint: 			1601,
							  settings: {
								slidesToShow: 		4,
								slidesToScroll:		4,
								dots: 				true
							  }
							},
							{
							  breakpoint: 			1367,
							  settings: {
								slidesToShow: 		3,
								slidesToScroll:		3,
								dots: 				true
							  }
							},
							{
							  breakpoint: 			1025,
							  settings: {
								slidesToShow: 		2,
								slidesToScroll:		2,
								dots: 				true
							  }
							},							
							{
							  breakpoint: 			768,
							  settings: {
								slidesToShow: 		1,
								slidesToScroll:		1,
								dots: 				true
							  }
							},
						];
						break;	
				};
				
				sliderConfig.on('init', function(event, slick){
					checkEffectElms=0;
					adaptiveHeight();
				});
				
				sliderConfig.slick({
					arrows:						true,	
					dots: 						true,
					infinite: 					true,
					speed: 						__dataItem>1?600:300,
					slidesToShow: 				__dataItem?__dataItem:1,
					slidesToScroll:				__dataItem?__dataItem:1,
					adaptiveHeight: 			true,
					autoplay:					__dataAutoPlay=='1'?true:false,
					autoplaySpeed:				__dataAutoPlaySpeed?__dataAutoPlaySpeed:5000,
					accessibility:				false,
					pauseOnHover:				true,
					touchThreshold:				15,
					fade: 						__dataItem>1?false:true,
					responsive: 				responsiveParam,
					draggable:					true,				
				});
				
				$('.cactus-slider-button-prev', $this).on('click', function(){
					sliderConfig.slick('slickPrev');
				});
				
				$('.cactus-slider-button-next', $this).on('click', function(){
					sliderConfig.slick('slickNext');
				});						
				
				var _df_width = $(window).width();
				$(window).on('resize', function(){
					if($(window).width()==_df_width){return};
					checkEffectElms=0;
					checkClickElms=1;
					sliderConfig.slick('slickGoTo', 0);
					_df_width = $(window).width();
				});
				
				sliderConfig.on('afterChange', function(){
					checkEffectElms=1;
					adaptiveHeight();			
				});
				
				var clearTimeoutSlider = null;
				sliderConfig.find('.open-close-social').on('click', function(){
					if(clearTimeoutSlider!=null) {clearTimeout(clearTimeoutSlider);};
					clearTimeoutSlider=setTimeout(function(){
						checkClickElms=1;
						checkEffectElms=1;
						adaptiveHeight();
					},200);					
				});			
			};
        });	
		
		$('.open-close-social').live('click', function(){
			var $this = $(this);
			var $parentElms = $this.parents('.button-and-share');
			
			if($parentElms.hasClass('active') || $this.hasClass('active')) {
				$parentElms.removeClass('active');
				$this.removeClass('active');
			}else{
				$parentElms.addClass('active');
				$this.addClass('active');
			};
		});
		
		/*go to top*/
		$('.go-to-top').on('click', function(){
			$('html, body').animate({scrollTop:0},500);
		});		

		/*go to top*/
		
		/*lightbox*/
		function resizeElmsLB(elmsImg){
			var leftandright = 0;
			if(elmsImg.width() > elmsImg.find('img').width()) {
				leftandright = (elmsImg.width() - elmsImg.find('img').width()) / 2;
			};
			
			var bottom = 0;
			if(elmsImg.height() > elmsImg.find('img').height()) {
				bottom = (elmsImg.height() - elmsImg.find('img').height()) / 2;
			};
			
			$('.ct-lb-content .lb-caption').css({'top':(bottom+elmsImg.find('img').height())+'px', 'left':(leftandright)+'px', 'right':(leftandright)+'px', });
			$('.ct-close-light-box').css({'top':(bottom-40)+'px', 'right':(leftandright-12)+'px'});
		};
		
		function setImgToLightBox(elm){
			var $this=elm;
			
			var imgSRC = $this.attr('data-img-src');
			var imgTitle = $this.attr('data-title');
			
			var $__parents = $this.parents('.cactus-listing-config');
			
			if($('.nav-lightbox', $__parents).length==0){
				$__parents.append('<a href="javascript:;" class="nav-lightbox ct-lb-prev"><i class="fa fa-chevron-left"></i></a><a href="javascript:;" class="nav-lightbox ct-lb-next"><i class="fa fa-chevron-right"></i></a>');
			};
			
			if(imgSRC!='' && imgSRC!=null && typeof(imgSRC)!='undefined') {
				$('.ct-lb-background, .spinner, .nav-lightbox', $__parents ).addClass('active');
				$('.ct-lb-content img', $__parents ).attr('src', imgSRC);
				$('.ct-lb-content .lb-caption', $__parents ).text(imgTitle);
				$('<img src="'+imgSRC+'">').load(function(){
					$('.ct-lb-content', $__parents ).addClass('active');
					resizeElmsLB($('.ct-lb-content', $__parents ));
				});
				
				var __df_width = $(window).width();
				$(window).on('resize.ctLightBox', function(){
					if($(window).width()==__df_width){return};
					resizeElmsLB($('.ct-lb-content', $__parents));
					__df_width = $(window).width();
				});
			}
		}
		
		$('.ctl-icon-hover.search-next').live('click', function(){
			var $this=$(this);
			var $__parents =  $this.parents('.cactus-listing-config');			
			setImgToLightBox($this);			
			
			$('.nav-lightbox', $__parents).off('.setImgNextPrev').on('click.setImgNextPrev', function(){			
					
				$('.ct-lb-background, .spinner, .ct-lb-content').removeClass('active');
				$(window).off('.ctLightBox');				

				var $prev = $('.ctl-icon-hover.search-next', $this.parents('.cactus-post-item').prev('.cactus-post-item'));
				if($prev.length==0){
					$prev = $('.ctl-icon-hover.search-next', $('.cactus-post-item:last-child', $__parents));
				}
				
				var $next = $('.ctl-icon-hover.search-next', $this.parents('.cactus-post-item').next('.cactus-post-item'));
				if($next.length==0){
					$next = $('.ctl-icon-hover.search-next', $('.cactus-post-item:first-child', $__parents));
				}
								
				if($(this).hasClass('ct-lb-prev')){
					$prev.trigger('click');			
				}	
							
				if($(this).hasClass('ct-lb-next')){
					$next.trigger('click');
				}
				
			});		
			return false;
		});
		
		$('.ct-close-light-box, .ct-lb-background, .ct-ove-click').live('click', function(){
			$('.ct-lb-background, .spinner, .ct-lb-content, .nav-lightbox').removeClass('active');
			$(window).off('.ctLightBox');
		});
		/*lightbox*/
		
		/*Menu*/
		
			$('.eco-all-categories').on('click', function(){
				if(window.innerWidth<=767) {
					$(this).next('ul').toggleClass('active');
					return false;
				};
			});
			
			$('.eco-main-menu > ul > li > a').on('click', function(){
				if(window.innerWidth>=768 && window.innerWidth<=1024){
					return false;
				}else if(window.innerWidth<=767){
					$('.eco-main-menu > ul > li > a').removeClass('toogle-check');
					$('.eco-main-menu > ul > li > a').next('ul').removeClass('toogle-check');
					
					$(this).addClass('toogle-check');
					$(this).next('ul').addClass('toogle-check');
								
					$(this).next('ul').toggleClass('active');
					$(this).toggleClass('active');
					
					$('.eco-main-menu > ul > li > a').next('ul:not(.toogle-check)').removeClass('active');
					$('.eco-main-menu > ul > li > a:not(.toogle-check)').removeClass('active');			
								
					$(window).scrollTop($(this).offset().top);
					
					return false;
				}				
			});		
		
		/*Menu*/
		
		/*digital price*/
			var $selectBoxPriceID = $('.add-custom-select');
			$selectBoxPriceID.removeAttr('disabled');
			$selectBoxPriceID.on('change', function(){
				var $this = $(this);
				var newVal = $this.val();				
				$selectBoxPriceID.val(newVal);
				
				//var currentBuyURL = $this.parents('.price-options-group').nextAll('.bt-stylev1-product').attr('href');
				//var newBuyURL = updateQueryStringParameter(currentBuyURL, 'edd_options[price_id]', newVal);		
				
				$('.single-price').addClass('ct-hidden').removeClass('ct-show');
				$('.single-price[data-price-id="'+newVal+'"]').removeClass('ct-hidden').addClass('ct-show');
				$selectBoxPriceID.parents('.price-options-group').nextAll('.bt-stylev1-product').attr('href', $('.single-price[data-price-id="'+newVal+'"]').attr('data-link'));
			});
		/*digital price*/
		
		/*Digital add to cart action*/
			function checkAddToCartEDD(){
				var checkSessCartEdd = $.cookie('sess_cart_edd');			
				var $emls_single_cart = $('.single-download .ct-cart-content .total-item');
				var $elms_cart = $('.ct-cart-content .total-item');
				
				if($emls_single_cart.length>0){				
					if(checkSessCartEdd!='' && checkSessCartEdd!=null){
						if($.trim($elms_cart.text()) != $.trim(checkSessCartEdd)){	
							if($('#added-to-cart').length>0){
								$('#added-to-cart').removeClass('active').addClass('active');
							};					
							//console.log('Add To Cart');
						};					
					};				
				};			
				
				if($elms_cart.length==0){
					if($.trim(checkSessCartEdd)!='0'){	
						$.cookie('sess_cart_edd', '0');
						//console.log('First Update');
					}
				}else{		
					if($.trim($elms_cart.text()) != $.trim(checkSessCartEdd)){							
						$.cookie('sess_cart_edd', $elms_cart.text());
						//console.log('Update items');
					};
				};	
			};
		/*Digital add to cart action*/
		
		$('.ct-ts-content-slider .ct-ts-content').each(function(index, element) {
			var $this_slider_widget = $(this);
			var $__parents = $this_slider_widget.parents('.widget-inner');
			if($this_slider_widget.parents('#off-canvas').length>0) {return;}
            $this_slider_widget.slick({
				dots: false,
				infinite: false,
				arrows:false,
				speed: 300,
				variableWidth:true,
				slidesToShow: 4,
				slidesToScroll:2,
				draggable:true,
				responsive: [
					{
						breakpoint: 1800,
						settings: {
							slidesToShow: 3,
							slidesToScroll:1,
						}
					},
					{
						breakpoint: 1400,
						settings: {
							slidesToShow: 2,
							slidesToScroll:1,
						}
					},
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 1,
							slidesToScroll:1,
						}
					},				
				],
			});
			
			function setMaxWidth(){						
				var iz=0;		
				$('.slick-slide', $this_slider_widget).each(function(index, element) {
                    iz+=$(this).outerWidth();
                });
				if($__parents.width()+42 > iz) {
					$__parents.find('.ct-ts-content-slider').width(iz-39)
				}else{
					$__parents.find('.ct-ts-content-slider').removeAttr('style');
				};
				
				if($__parents.width()==0) {
					$__parents.find('.ct-ts-content-slider').removeAttr('style');
				};				
			}
			setMaxWidth();
			$(window).resize(function(){
				$this_slider_widget.slick('slickGoTo', 0);
				setMaxWidth();
			});
        });
		
		checkAddToCartEDD();
				
		$(window).on('scroll', function(){
			if($(this).scrollTop() >= (window.innerHeight * 0.75)) {
				if(!$('.go-to-top').hasClass('active')) {
					$('.go-to-top').addClass('active');
				};
				if($(this).scrollTop() + $(window).height() == $(document).height()) {
				   $('.go-to-top').css({'margin-bottom':$('.footer-info').height()+'px'});
			    }else{
					$('.go-to-top').css({'margin-bottom':'0'});
				}
			}else{
				$('.go-to-top').removeClass('active');
			};
			
			scrollFunc();
				
		});
		
		var ___df_width = $(window).width();
		$(window).on('resize', function(){
			if($(window).width()==___df_width){return};
			
			/*sticky menu*/
			var $mainMenu = $('#main-menu.set-sticky-menu');
			var $menuSticky = $('#main-menu.set-sticky-menu > .navbar.navbar-default');
			$mainMenu.height($menuSticky.height());
			
			$('.eco-main-menu > ul > li > a').next('ul').removeClass('toogle-check active');
			$('.eco-main-menu > ul > li > a').removeClass('toogle-check active');
			/*sticky menu*/
			
			___df_width = $(window).width();
		});
				
	});
	
}(jQuery));	
