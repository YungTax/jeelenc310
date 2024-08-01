/*
 * Theme js functions file.
 */
 
var $ 				= jQuery.noConflict(),
	pls_options 	= pls_options || {},
	pls 			= pls || {},
	pls_sliders 	= []; 
(function($) { 
	
    "use strict";
	
	pls.init = function() {
		pls.$doc          	= $(document);
		pls.$html    		= $('html');
		pls.$body 			= $(document.body);
		pls.$window 		= $(window);
		pls.$windowWidth 	= $(window).width();
		pls.$windowHeight 	= $(window).height();
		pls.ajaxXHR 		= null;
		pls.isPostLoading 	= false;
		pls.$tooltip 		= $('.product-buttons a,.whishlist-button a');
		pls.$swatches 		= pls.$doc.find( 'div.pls-swatches-wrap' );
		pls.$swatchForm 	= pls.$doc.find( 'form.pls-swatches-wrap.variations_form' );
		
		this.isCheckRTL();
		this.mobileDevice();
		this.BrowserDetection();
		this.addSpinner();
		this.backToTop();
		this.imagelazyload();
		this.reinitLazyload();
		this.plsElementorSwiperSlider();
		this.initNanoScroller();
		this.initMagnaficPopup();
		this.newsLetterPopup();	
		this.plsMegamenu();
		this.mobileMenu();
		this.promoBar();
		this.stickyHeader();
		this.StickyHeaderScrollUP();
		this.stickySidebar();
		this.canvasSidebar();
		this.openMiniSearch();
		this.widgetMenuToggle();
		this.widgetToggle();
		this.footerWidgetCollapse();
		this.widgetMaxLimitItem();
		this.MasonryGrid();
		this.loadmorePosts();
		this.socialShare();
		
		/* Woocommerce */
		this.productLiveSearch();
		this.swapLoginSignupFrom();
		this.userLoginSignupPopup();
		this.miniCartWidget();		
		this.addToWishlist();
		this.wishlistCount();
		this.addToCompare();
		this.compareCount();		
		this.removeToCompare();
		this.ProductLoopQuantityField();
		this.addToCart();
		this.addToCartAjax();	
		this.stickyAddToCart();
		this.productQuickView();
		this.productShowFilter();
		this.productShowHideFilters();
		this.productFilterAjax();
		this.productSwatch();
		this.initAjaxLoad();
		this.loadmoreProducts();
		this.tooltip();
		this.productGallerySummarySticky();
		this.productGallerySlider();
		this.productImageZoom();
		this.productPhotoSwipe();		
		this.productSaleCountdown();
		this.productReviewLink();
		this.getProductSizeChart();
		this.getAjaxBlock();
		this.productQuantityPlusMinus();
		this.productQuickShop();
		this.productBoughtTogetherInit();
		this.wooProductTabsAccordian();
		this.wooProductTabsToggle();
		this.wcfm_vendor();
		this.MiniCartUpdateQuantity();
		this.autoCartUpdate();
		this.checkoutUpdateQuantity();
		this.getVisitorCount();
		this.askQuestionsForm();
		
		/* Elements */
		this.plsEqualTabsHeight();
		this.plsAjaxtab();
		this.plsResponsiveTab();
		this.plsProgressbar();
		this.plsCounterUp();
		this.imageGaleryMasonry();
		this.BackgroundParallax();
		this.accordion();
	}
	
	pls.isCheckRTL = function(){
		/*
		* If check is site RTL
		*/		
		$('html[dir="rtl"] body').addClass('rtl');
		var pls_rtl = false;
		if($('body,html').hasClass('rtl')){ 
			pls_rtl =  true;
		}	
		
		return pls_rtl;
	};
	
	pls.mobileDevice = function() {
		var window_size = jQuery('body').innerWidth();
		if(window_size < 991){
			jQuery( 'body' ).addClass( 'pls-mobile-device' );
		}else{
			jQuery( 'body' ).removeClass( 'pls-mobile-device' );
		}
		 pls.$window.on( 'resize', function () {
			var window_size = jQuery( 'body' ).innerWidth();
			if( window_size < 991 ){
				jQuery( 'body' ).addClass( 'pls-mobile-device' );
			}else{
				jQuery( 'body' ).removeClass( 'pls-mobile-device' );
			}
		}); 
	};
	
	pls.BrowserDetection = function () {
		/* Check if browser is IE */
		if (navigator.userAgent.search("MSIE") >= 0) {
			jQuery('body').addClass('browser-msie');
		}
		/* Check if browser is Chrome */
		else if (navigator.userAgent.search("Chrome") >= 0) {
			jQuery('body').addClass('browser-chrome');
		}
		/* Check if browser is Firefox  */
		else if (navigator.userAgent.search("Firefox") >= 0) {
			jQuery('body').addClass('browser-firefox');
		}
		/* Check if browser is Safari */
		else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
			jQuery('body').addClass('browser-safari');
		}
		/* Check if browser is Opera */
		else if (navigator.userAgent.search("Opera") >= 0) {
			jQuery('body').addClass('browser-opera');
		}
	};
	
	pls.addSpinner = function(){
		/*
		* Add Spinner
		*/
		
		$( document ).ajaxStart(function() {
			 $( '.wcml_currency_switcher' ).append( '<span class="pls-spinner"></span>' );
		});
		
		$( document ).ajaxComplete(function() {
			pls.reinitLazyload();
		  $( '.wcml_currency_switcher > span' ).remove();
		});	
		
			
	};	
	
	pls.backToTop = function(){
		//*******************************************************************
		//* Back to top button 
		//********************************************************************/
		var el = $( '.pls-back-to-top' );
		pls.$window.on('scroll',function(){				
			if( el.length > 0 ){
				if( pls.$window.scrollTop() > 150 ){
					el.fadeIn(400);	
				}else{
					el.fadeOut(400);	
				}	
			}	
		});
		
		el.on('click', function (e) {
				$( 'html, body' ).animate({scrollTop:0}, 600);	
				return false;
		});				
	};
	
	pls.imagelazyload = function(){
		if ( pls.$body.find('.lazy').length > 0 && pls_options.lazy_load ) {
			var lazy_args = [];
			lazy_args.afterLoad      = function (element) {
				element.removeClass( 'lazy' );
				element.removeClass( 'loading' );
				element.addClass( 'lazy-loaded' );
			};
			lazy_args.effect         = "fadeIn";
			lazy_args.enableThrottle = true;
			lazy_args.throttle       = 250;
			lazy_args.effectTime     = 1000;
			lazy_args.threshold      = 0;
			pls.$body.find('.lazy').lazy(lazy_args);			
		}
	};
	
	pls.reinitLazyload = function(){
		if ( !pls_options.lazy_load )  return;
		$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
			pls.imagelazyload();			
		});
		$(document).on( 'removed_from_cart', function (e) {
			pls.imagelazyload();			
		});
		$(window).bind( 'mousewheel DOMMouseScroll', function(event){
			if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
				
			}
			else {
				pls.imagelazyload();		
			}
		});
	}
	
	pls.initNanoScroller = function() {
		/*
		* Nano Scroller
		*/		
		if( $(window).width() < 1024 ) return;
		$(".pls-scroll").nanoScroller({
			paneClass: 'pls-scroll-pane',
			sliderClass: 'pls-scroll-slider',
			contentClass: 'pls-scroll-content',
			preventPageScrolling: false
		});

		$( 'body' ).on( 'wc_fragments_refreshed wc_fragments_loaded added_to_cart', function() {
			$( ".widget_shopping_cart .pls-scroll" ).nanoScroller({
				paneClass: 'pls-scroll-pane',
				sliderClass: 'pls-scroll-slider',
				contentClass: 'pls-scroll-content',
				preventPageScrolling: false
			});
		} );
	}
	
	pls.initMagnaficPopup = function (){		
		
		var wordpress_galery = $(document).find('.gallery');
		wordpress_galery.each(function(index){
			var current_gallery = $(this);
			$( current_gallery ).magnificPopup({
				delegate: 'img',
				type: 'image',
				removalDelay: 500,
				callbacks: {
					beforeOpen: function() {
						this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						this.st.mainClass = 'mfp-with-zoom mfp-img-mobile';
					},
					elementParse: function(item) {  item.src = item.el.attr('src'); }
				},
				image: {
					verticalFit: true
				},
				gallery: {
					enabled: true,
					navigateByImgClick: true
				},
			});			
		});
		
		$( '.product-360-degree-btn a' ).magnificPopup({
		  type: 'inline',
		  midClick: true,
		  mainClass: 'mfp-fade'
		});
		
		init_magnificpopup('.pls-slider','.pls-post-gallery__image.swiper-slide:not(.swiper-slide-duplicate) a');
		init_magnificpopup('.product-sizechart','a.zoom-gallery');
		
		function init_magnificpopup(container,delegate){
			
			var container_wrap = $(document).find(container);
			
			if( typeof('container_wrap') !== 'undefined' && container_wrap != '' ) {
				container_wrap.each(function(index){
					var portfolio_item = $(this);
					$(portfolio_item).magnificPopup({
						delegate    : delegate,
						type: 'image',
						removalDelay: 500,
						callbacks: {
							beforeOpen: function() {
								this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
								this.st.mainClass = 'mfp-with-zoom mfp-img-mobile';
							}
						},
						image: {
							verticalFit: true
						},
						gallery: {
							enabled: true,
							navigateByImgClick: false
						},
					});
					
				});
			}
		}
		
		$('.link-popup').magnificPopup({
			type: 'image',
			removalDelay: 500,
			callbacks: {
				beforeOpen: function() {
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					this.st.mainClass = 'mfp-with-zoom mfp-img-mobile';
				}
			},
			image: {
				verticalFit: true
			},
		});
		
		var $ombed_vids = $(".pls-video-popup");
		if( $ombed_vids.length > 0 ) {
			$ombed_vids.each(function () {
				var $mfp_popup_link_non_html5 = $(this);

				$($mfp_popup_link_non_html5).magnificPopup({
					disableOn: 320,
					type: 'iframe',
					mainClass: 'mfp-fade product-video-popup',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false,
					iframe: {
						patterns: {
							youtube: {
								index: 'youtube.com/',
								id: function(url) {
									var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
									if ( !m || !m[1] ) return null;
									return m[1];
								},
								src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0'
							},
							youtu: {
								index: 'youtu.be',
								id: '/',
								src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0'
							},
							vimeo: {
								index: 'vimeo.com/',
								id: function(url) {
									var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
									if ( !m || !m[5] ) return null;
									return m[5];
								},
								src: '//player.vimeo.com/video/%id%?autoplay=1'
							},
						}
					}
				});
			});
		}		
    };
	
	pls.newsLetterPopup = function(){		
		
		if( !pls_options.newsletter_args.newsletter_popup ){
			return;
		}
		
		var newsletter_popup 	= pls_options.newsletter_args.newsletter_popup,
			popup_display_on 	= pls_options.newsletter_args.popup_display_on,
			popup_delay 		= pls_options.newsletter_args.popup_delay,
			x_scroll 			= pls_options.newsletter_args.popup_x_scroll,
			show_for_mobile 	= parseInt(pls_options.newsletter_args.show_for_mobile),
			popup_exit 			= false,
			startinterval 		= false,
			newsletter_key 		= 'pls_newsletter_closed_' + pls_options.newsletter_args.version,
			popup_closed 		= Cookies.get( newsletter_key ),
			$news_letter_wrap 	= $(".pls-newsletter-popup"),
			from_button         = false;
		if( !$news_letter_wrap.length) {
			return false;
		}
		
		/* yith-woocompare */
		if(jQuery(document).find('#yith-woocompare').length > 0){
			return false;
		}
		
		if( ! newsletter_popup || pls_options.maintenance_mode || ( ! show_for_mobile && $(window).width() < 768 ) ){
			return false; 
		}
		
		/* newsletter popup opened from button on click by user
		it must be enabled even if with 'do-not-show' cookie saved */
		var newsletter_btn = $('.header-newsletter');
		newsletter_btn.on('click',function(){
			from_button = true;
			show_popup();
		});
		
		
		if( popup_closed == 'do-not-show' ) {
			return false; 
		}
		
		if( popup_display_on == 'exit' ){
			jQuery(document).on('mouseleave', function (e) {
				show_popup();
			});
		}else if(popup_display_on == 'scroll'){

            jQuery(window).scroll(function () {
                var h = jQuery(document).height() - jQuery(window).height();
                var sp = jQuery(window).scrollTop();
                var p = parseInt(sp / h * 100);

                if (p >= x_scroll) {
                   show_popup();                
                }
            });
        }else{
			if( popup_delay ){
				setTimeout(function(){show_popup(); }, popup_delay * 1000);	
			}else{
				show_popup();
			}			         
        }
		
		$news_letter_wrap.find('.mc4wp-form').submit(function () {
            Cookies.set( newsletter_key , 'do-not-show', { expires: parseInt(pls_options.newsletter_args.show_in_next_days), path: '/' });
        });
		
		function show_popup() {
			/* popup must open everytime if the user clicked to open it */
			if(popup_exit && !from_button){
				return;
			}
			
			popup_exit = true;
			$.magnificPopup.open({
				type: 'inline',
				removalDelay: 500,
				items: {
					src: '.pls-newsletter-popup' ,					
				},
				callbacks: {
					open: function () {
						var popupWrap = $( '.pls-newsletter-popup' );
						popupWrap.addClass('animated slideInDown');
						
						/* donotshow div element must be hidden if the user clicked to open popup */
						if (from_button){
							$('#newsletter-donotshow').parent('div').hide();
						}
						
					},							
					beforeClose: function() {
						var popupWrap = $( '.pls-newsletter-popup' );
						popupWrap.removeClass('slideInDown').addClass('slideOutUp');
					}, 
					close: function() {
						this.content.removeClass('animated slideOutUp'); 
						/* check box click */
						if($('#newsletter-donotshow:checked') && $('#newsletter-donotshow:checked').val() == 'do-not-show'){
							Cookies.set( newsletter_key , 'do-not-show', { expires: parseInt(pls_options.newsletter_args.show_in_next_days), path: '/' });
						}
						
						/* we restore the default visibility of donotshow div element if the user clicked to open popup */
						if (from_button) {
							$('#newsletter-donotshow').parent('div').show();
							from_button = false;
						}
					}
				},				
			});
		}
	};
	
	pls.plsMegamenu = function(){
		
		var main_menu_wrap 				= $('.pls-main-navigation').find('ul.menu');
		
		main_menu_wrap.on('mouseover', ' > li.pls-megamenu-dropdown:not(.pls-megamenu-item-full-width)', function(e) {
			setOffset( $(this) );
		});
		jQuery(window).resize(function() {
			main_menu_wrap.on('mouseover', ' > li.pls-megamenu-dropdown:not(.pls-megamenu-item-full-width)', function(e) {
				setOffset( $(this) );
			});
		});

		var setOffset = function( li ) {

			var megaMenuWrapper 		= li.find(' > .pls-megamenu-wrapper'),
				megaMenuHolder 			= li.find(' .pls-megamenu-holder');
			
			megaMenuWrapper.attr('style', '');

			var container	 			= $('.pls-site-header .container'),
				containerWidth 			= container.outerWidth(),
				containerOffsetLeft 	= container.offset().left + 15,
				containerPaddingLeft 	= parseInt(container.css('padding-left')),
				containerPaddingRight 	= parseInt(container.css('padding-right')),
				viewportWidth 		  	= containerWidth - containerPaddingLeft - containerPaddingRight;
				
			/* if( li.hasClass( 'pls-megamenu-item-full-width' ) ) { 
				megaMenuHolder.css({
					width: viewportWidth
				});
			} */
			
			var	megaMenuWrapperWidth	= megaMenuWrapper.outerWidth(),
				megaMenuWrapperOffset	= megaMenuWrapper.offset();		
				
			if( ! megaMenuWrapperWidth || ! megaMenuWrapperOffset ) return;
			
			var mega_menu_wrapOffsetRight = viewportWidth - megaMenuWrapperOffset.left - megaMenuWrapperWidth;
			
			if( $('body').hasClass('rtl') && mega_menu_wrapOffsetRight + megaMenuWrapperWidth + containerOffsetLeft >= viewportWidth && ( li.hasClass( 'pls-megamenu-dropdown' ) ) ) {
				
				var toLeft = mega_menu_wrapOffsetRight + megaMenuWrapperWidth - viewportWidth + containerOffsetLeft;
				megaMenuWrapper.css({
					right: - toLeft
				}); 

			}else if( megaMenuWrapperOffset.left + megaMenuWrapperWidth - containerOffsetLeft >= viewportWidth && ( li.hasClass( 'pls-megamenu-dropdown' ) ) ) {
				
				var toRight = megaMenuWrapperOffset.left + megaMenuWrapperWidth - viewportWidth - containerOffsetLeft;
				megaMenuWrapper.css({
					left: - toRight
				}); 
			}				
		};	
	}
	
	pls.mobileMenu = function(){
		/*
		* Mobile menu
		*/
		
		/* Menu wrapper */
		$(document).on('click', '.mobile-nav-tabs li', function(e) {
			if(!$(this).hasClass("active")){
				var cn=$(this).data("menu");
				$(this).parent().find(".active").removeClass("active");
				$(this).addClass("active");
				$(".mobile-nav-content").removeClass("active").fadeOut(300);
				$(".mobile-"+cn+"-menu").addClass("active").fadeIn(300);
			}
		});
		
		/* Menu */
		var $mobileMenu 	= $('.pls-mobile-menu'),
			$closeSidebar 	= $('.pls-mask-overaly');
		$( '.pls-mobile-menu-btn .pls-mobile-menu-toggle' ).on( 'click', function ( e ) {
			e.preventDefault();			
			if ( ! $mobileMenu.hasClass('opened') ) {
				$mobileMenu.addClass('opened');
				$closeSidebar.addClass('opened');
			}
		});

		$( '.mobile-main-menu li.menu-item-has-children' ).append( '<span class="menu-toggle"></span>' );
		
		$mobileMenu.on('click', '.menu-item-has-children > .menu-toggle', function (e) {
			e.preventDefault();

			$(this).closest('li').siblings().find('ul').slideUp();
			$(this).closest('li').siblings().removeClass('active');
			$(this).closest('li').siblings().find('li').removeClass('active');

			$(this).closest('li').children('ul').slideToggle();
			$(this).closest('li').toggleClass('active');

		});
		
		pls.$body.on('click', '.pls-mask-overaly, .pls-mobile-menu .close-sidebar', function (e) {
			if ( $mobileMenu.hasClass( 'opened' ) ) {
				$mobileMenu.removeClass('opened');
				$closeSidebar.removeClass('opened');
			}
		});
		
		pls.$window.on('resize', function () {
			if ( pls.$window.width() > 991 ) {
				if ( $mobileMenu.hasClass( 'opened' ) ) {
					$mobileMenu.removeClass('opened');
					$closeSidebar.removeClass('opened');
				}
			}
		});
	};
	
	pls.promoBar = function(){
		/*
		 * Promo Bar
		 */
		var $promo_bar 			= $( '.pls-promo-bar' ),
			$siteWrapper 		= $( '.pls-site-wrapper' ),
			$siteHeader 		= $( '.pls-site-header' ),
			$stickyElements 	= $( '.header-sticky' ),
			position_type 		= $promo_bar.attr('data-position_type'),
			position 			= $promo_bar.attr('data-position'),
			promo_barHeight 	= $promo_bar.outerHeight(),
			adminBarHeight 		= $('#wpadminbar').outerHeight(),
			promo_bar_key 		= 'pls_promo_bar_close';
			
		if( position == 'top' && position_type == 'fixed'){
			$siteWrapper.css({'margin-top' : promo_barHeight + 'px'});
		}
		/* Set a cookie and hide Promo bar when the dismiss button is clicked */
		$( '.promo-bar-close' ).on( 'click', function( event ) {
			event.preventDefault();
			if( $(this).hasClass('promo-bar-dismiss') ) {
				Cookies.set( promo_bar_key, true, { path: '/',expires: parseInt(pls_options.show_promobar_in_next_days) } );
			}
			if( position == 'top' && position_type == 'fixed'){
				$siteWrapper.css({'margin-top' : '0px'});
			}
			if( position == 'top' && position_type == 'fixed'){
				if(adminBarHeight){
					if( $siteHeader.hasClass('pls-header-sticked')){
					$stickyElements.css({
					'top': adminBarHeight+'px'
				});
				}
				}else{
					if( $siteHeader.hasClass('pls-header-sticked')){
							$stickyElements.css({
							'top': '0px'
						});
						}
				}
			}
			$promo_bar.slideUp('slow',function(){ $(this).remove();});
			
		});
	};
	
	pls.stickyHeader = function(){
		/*
		 *  Sticky Header.
		 */
		if( ! pls_options.sticky_header ){
			return;
		}
		var $header 			= $('.pls-site-header'),
			$headerStickyClass 	= $('.pls-header-' + pls_options.sticky_header_class),
			$window 			= pls.$window,
			origPosition 		= $(window).scrollTop(),
			isSticked 			= false;
			
		if ( ! $headerStickyClass.length > 0 ) {
			$headerStickyClass = $('.pls-header-main');
		}
			
		if(  pls.$windowWidth  < 1023 ){
			$headerStickyClass = $('.pls-header-main');
		}
		$window.on('scroll', function () {
			var windowWidth 	= pls.$windowWidth ,
				headerHeight 	= $header.outerHeight(),
				stickyOffset 	= headerHeight + 200;
			pls.promoBar();
			
			/* Disable sticky in desktop & tablet & mobile */
			if( ( !pls_options.sticky_header && windowWidth > 992 ) ||
				( !pls_options.sticky_header_tablet && ( windowWidth <= 992 && windowWidth > 576 ) ) ||
				( !pls_options.sticky_header_mobile && windowWidth <= 575 ) ) {
				return false; 
			}
			var currentScroll 	= $(this).scrollTop();
			if ( currentScroll > stickyOffset ) {
				stickHeader();
			} else {
				unstickHeader();
			}
		});
		
		function stickHeader() {
			if ( isSticked ) { 
				return; 
			}
			isSticked = true;
			//var adminBarHeight 	= $('#wpadminbar').outerHeight();
			
			var adminBarHeight = 0, promo_top = 0, offset_top = 0;
			
			if( $('#wpadminbar').length > 0 ){
				adminBarHeight 	= $('#wpadminbar').outerHeight();
			}
			
			if( $('.position-top.position-type-fixed').length > 0 ){
				promo_top 	= $('.position-top.position-type-fixed').outerHeight();
			}
			
			offset_top = adminBarHeight + promo_top;
			
			$header.addClass('fixed');
			$headerStickyClass.addClass('pls-header-sticked');
			$('.pls-open-categories-menu .pls-categories-menu-wrapper').removeClass('opened-categories');
			$headerStickyClass.css({
				'top': offset_top+'px'
			});
		}

		function unstickHeader() {
			if ( !isSticked ) { 
				return;
			}
			isSticked = false;
			$header.removeClass('fixed');
			$headerStickyClass.removeClass('pls-header-sticked');
			$('.pls-open-categories-menu .pls-categories-menu-wrapper').addClass('opened-categories');
			$headerStickyClass.css({
				'top': 0
			});
		}
	}
	
	pls.StickyHeaderScrollUP = function(){
		/*
		 * Sticky header on ScrollUp
		 */		
		if ( ! pls_options.sticky_header ||  ! pls_options.sticky_header_scroll_up) { return; }
				
		var origPosition 		= $(window).scrollTop(),			
			$headerStickyClass 	= $('.pls-header-' + pls_options.sticky_header_class);
		
		if ( ! $headerStickyClass.length > 0 ) {
			$headerStickyClass = $('.pls-header-main');
		}
		
		if(  pls.$windowWidth  < 1023 ){			
			$headerStickyClass = $('.pls-header-main');
		}
		$(window).scroll(function(e) {
			var currentScroll = $(window).scrollTop();
			if( currentScroll > origPosition ) {
				$headerStickyClass.removeClass( 'scroll-up' ).addClass( 'scroll-down' );
			} else {
				$headerStickyClass.removeClass( 'scroll-down' ).addClass( 'scroll-up' );
			}
			origPosition = currentScroll;
		});
	};
	
	pls.stickySidebar = function(){
		/*
		 *  Sticky Sidebar.
		 */
		if ( ! pls_options.sticky_sidebar ) { return; }
		
		if ( typeof ( $.fn.stick_in_parent ) != 'undefined' ) {
			$(document).ready(function(){
				if( $( window ).width() <= 768  ) { return; }
				
				var sticky_sidebar = $( '#secondary .sidebar-inner' );	
				var offset = 15;
				
				if ( $( '#header .pls-header-sticked' )[0] ) {
					offset = $( '#header .pls-header-sticked' ).height() + 30;
				}
				
				sticky_sidebar.stick_in_parent({ offset_top: offset });
				
				$( window ).resize(function() {
					if ( $( window ).width() <= 768 ) {
						sticky_sidebar.trigger( 'sticky_kit:detach' );					
					}else{
						sticky_sidebar.stick_in_parent({
							offset_top: offset
						});
					}
				});
			});
		}
	};
	
	pls.canvasSidebar = function(){
		/*
		 *  Canvas Sidebar.
		 */
		
		var sidebar_canvas 		= $('.pls-canvas-sidebar .canvas-sidebar-icon, .pls-product-off-canvas-btn, .pls-mobile-navbar .canvas-sidebar-icon');
		var secondary 			= $('#secondary');
        var closeSidebar 		= $('.pls-mask-overaly');
		
		sidebar_canvas.on('click', function(e) {
			e.preventDefault();	
			
			if ( ! secondary.hasClass('opened') ) {
				secondary.addClass('opened');
				setTimeout(function() {pls.imagelazyload();}, 1000);
				closeSidebar.addClass('opened');
			}					
		});
		
		pls.$body.on('click', '.pls-mask-overaly, .close-sidebar', function (e) {
			e.preventDefault();
			secondary.removeClass('opened');
			closeSidebar.removeClass('opened');
		});	
		
		pls.$window.on('resize', function () {
			if ( pls.$window.width() > 767 ) {
				if ( secondary.hasClass( 'opened' ) ) {
					secondary.removeClass('opened');
					closeSidebar.removeClass('opened');
				}
			}
		});
		
	};
	
	pls.openMiniSearch = function(){
		//*******************************************************************
		//* openMiniSearch
		//*******************************************************************/
		
		var sidebar_canvas 	= $('a.search-icon-text');
		var search_popup 	= $('.pls-search-popup');
		var closeSidebar 	= $('.pls-search-popup .close-sidebar');
		
		sidebar_canvas.on('click', function(e) {
			e.preventDefault();
			
			if ( ! search_popup.hasClass('opened') ) {
				search_popup.addClass('opened');
			}					
		});
		
		closeSidebar.on('click', function(e) {
			e.preventDefault();
			
			if ( search_popup.hasClass('opened') ) {
				search_popup.removeClass('opened');
			}					
		});		
	};
	
	pls.widgetMenuToggle = function(){
		//*******************************************************************
		//* Widget Menu Toggle
		//*******************************************************************/
		
		if( pls_options.widget_menu_toggle) {
			/* Wordpress Menu widget */ 
			$('#secondary .widget .menu-item > a').each(function(){ 
				if( $(this).siblings('ul.sub-menu').length > 0 ) {
					var $childIndicator = $('<span class="child-indicator"></span>');

					$(this).siblings('.sub-menu').hide();
					$('.current-menu-item > .sub-menu').show();
					$('.current-menu-parent > .sub-menu').show();
					if($(this).siblings('.sub-menu').is(':visible')){
						$childIndicator.addClass( 'open-item' );
					}

					$childIndicator.on( 'click', function(){
						$(this).parent().siblings('.sub-menu').toggle( 'fast', function(){
							if($(this).is(':visible')){
								$childIndicator.addClass( 'open-item' );
							}else{
								$childIndicator.removeClass( 'open-item' );
							}
						});
						return false;
					});
					$(this).append($childIndicator);
				}
			});
			
			/* Product/Category widget */
			$('#secondary .widget .cat-item > a').each(function(){
				if( $(this).siblings('ul.children').length > 0 ) {
					var $childIndicator = $('<span class="child-indicator"></span>');

					$(this).siblings('.children').hide();
					$('.current-cat > .children').show();
					$('.current-cat-parent > .children').show();
					if($(this).siblings('.children').is(':visible')){
						$childIndicator.addClass( 'open-item' );
					}

					$childIndicator.on( 'click', function(){
						$(this).parent().siblings('.children').toggle( 'fast', function(){
							if($(this).is(':visible')){
								$childIndicator.addClass( 'open-item' );
							}else{
								$childIndicator.removeClass( 'open-item' );
							}
						});
						return false;
					});
					
					if( ! $(this).find('.child-indicator').length > 0 ){
						$(this).append($childIndicator);
					}
				}
			});
		}		
	};
	
	pls.widgetToggle = function(){
		//*******************************************************************
		//* Widget Menu Toggle
		//*******************************************************************/		
		if( pls_options.widget_toggle) {
			$( document ).find('.pls-widget-area .widget, .widget-area .widget').addClass('widget-toggle').removeClass('closed');
			$( document ).on( 'click', '.pls-widget-area .widget .widget-title,.pls-widget-area .widget .wp-block-group__inner-container > h2, .dokan-widget-area .widget .widget-title, .widget-area .widget .widget-title', function(e) {
				e.stopImmediatePropagation();
				if ($(this).next().is(':visible')){
                    $(this).parent().addClass('closed');
                } else {
                    $(this).parent().removeClass('closed');
                }
                $(this).next().stop().slideToggle(200);
			});			
		}
	};
	
	pls.footerWidgetCollapse = function(){
		//*******************************************************************
		//* Footer Widget Collapse
		//*******************************************************************/	
		if ($(window).width() > 576) {
			return;
		}
		$( document ).on( 'click', '.pls-mobile-device .footer-widget-collapse .widget .widget-title', function(e) {
			var $title 		= $(this);
			var $widget 	= $title.parent();
			var $content 	= $widget.find('> *:not(.widget-title)');

			if ($widget.hasClass('footer-widget-opened')) {
				$widget.removeClass('footer-widget-opened');
				$content.stop().slideUp(200);
			} else {
				$widget.addClass('footer-widget-opened');
				$content.stop().slideDown(200);
			}
					
		});
				
	};
	
	pls.widgetMaxLimitItem = function(){
		//*******************************************************************
		//* Widget Hide Max Limit Item
		//*******************************************************************/
		if( pls_options.widget_hide_max_limit_item) {
			var js_translate_text = pls_options.js_translate_text;
			$('#secondary .widget .widget-title + ul,#footer .widget .widget-title + ul').hideMaxListItems({
				'max': pls_options.number_of_show_widget_items,
				'speed': 500,
				'moreText': js_translate_text.show_more,
				'lessText': js_translate_text.show_less
			});
		}
	};
	
	pls.MasonryGrid = function (){
		
		/*
		* Init Masonry grid
		*/
		if($( '.articles-list.masonry-grid' ).length){
			 pls.$body.imagesLoaded(function () {
				pls.$body.find('.articles-list.masonry-grid').isotope({
					itemSelector: '.type-post',
					layoutMode: 'masonry'
				});
			});			
		}
	};
	
	pls.loadmorePosts = function(){
		
		$('.pls-blog-load-more .pls-load-more').on('click',function(){
			
			var load_more_btn = $(this);
			var page = parseInt(load_more_btn.parent().attr('data-page'));
			var data_attr = load_more_btn.parent().data();
			var	atts = data_attr.attribute;
			var post_wrap = load_more_btn.closest('.pls-element').find('.articles-list');
            var wrap_id = load_more_btn.closest('.pls-element').attr('id');
			var data = {
				action: 'pls_loadmore_posts',
				nonce: pls_options.nonce,
				attr: atts,
				page: page,
			};
			if(load_more_btn.hasClass('process')){ return false;}
			pls.loadAjaxPost(load_more_btn,data,post_wrap,wrap_id);
		});
		var animationFrame = function () {
			$('.pls-blog-load-more a.infinity-scroll').each(function (i, val) {
				var load_more_btn = $(this);
				var page = parseInt(load_more_btn.parent().attr('data-page'));
				var post_wrap = load_more_btn.closest('.pls-element').find('.articles-list');
				var wrap_id = load_more_btn.closest('.pls-element').attr('id');
				var bottomOffset = post_wrap.offset().top + post_wrap.height() - $(window).scrollTop();
				if (bottomOffset < window.innerHeight && bottomOffset > 0) {
					if(load_more_btn.hasClass('process')){ 
						pls.isPostLoading = true;
					}else{
						pls.isPostLoading = false;
					}
					var page = parseInt(load_more_btn.parent().attr('data-page'));
					if(!load_more_btn.hasClass('pls-loadmore-disabled')){ 
						load_more_btn.trigger('click');
					}
				}
			});
		}
		
		var scrollHandler = function () {
			requestAnimationFrame(animationFrame);
		};                    
		$(window).scroll(scrollHandler);
	}
	
	pls.socialShare = function (){
		/*
		* Social Share
		*/
		pls.$doc.on('click', '.social-print', function(){
			window.print();
			return false;
		});

		/*
		 * Open Share buttons in a popup
		 */
		pls.$doc.on('click', '.social-share a', function(){
			var link = jQuery(this).attr('href');
			if( link != '#' ){
				window.open( link, 'TIEshare', 'height=450,width=760,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0' );
				return false;
			}
		});
	};
	
	/* PLS product live search */
	pls.productLiveSearch = function () {
		if ( ! pls_options.product_ajax_search ) { return false; }
		$('.trending-search-wrap').hide();
		var serviceUrl = pls_options.ajax_url + '?action=pls_ajax_search';
		$('.pls-ajax-search').each(function(){
			
			var append 				= $(this).find('.search-results-wrapper'),
				container 			= $(this),
				search_categories 	= $(this).find('.categories-filter'),
				product_cat 		= '';

			if (search_categories.length && search_categories.val() !== '') {
				product_cat = search_categories.val();
			}
		
			$(this).find('.search-field').keyup(function(){
				 var search_text = $(this).val();
				 if(search_text.length < 3){
					$('.trending-search-wrap').show();
				 }else{
					 $('.trending-search-wrap').hide();
				 }
			});
			$(this).find('.search-field').focus(function() {
				var search_text = $(this).val();
				if(search_text.length < 3){
					$('.trending-search-wrap').show();
				}else{
					$('.trending-search-wrap').hide();
				}
			});
			$(this).find('.search-field').focusout(function() {
			});
			$(this).find('.search-field').devbridgeAutocomplete({
				minChars        : 3,
				appendTo        : append,
				triggerSelectOnValidInput: false,
				serviceUrl      : serviceUrl,
				type            : 'POST',
				params 			: { 'product_cat' : product_cat,nonce: pls_options.nonce },
				onSearchStart   : function () { 
					container.find('.search-submit').removeClass('pls-spinner');
					container.find('.search-submit').addClass('pls-spinner');
					$('.trending-search-wrap').hide();
				},
				onSearchComplete: function () { 
					container.find('.search-submit').removeClass('pls-spinner');
				},
				beforeRender: function (container) {					
					$(container).removeAttr('style');
				},
				formatResult: function (suggestion, currentValue) {
					
					var pattern = '(' + $.Autocomplete.utils.escapeRegExChars(currentValue) + ')';
					var html = '';
					if (suggestion.id != -1) {
						html += '<a href="'+suggestion.url+'" title="'+ suggestion.value +'">';
					} 
					if(suggestion.img) html += '<img class="search-image" src="'+suggestion.img+'">';
					html += '<div class="search-name">'+suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')+'</div>';
					if(suggestion.price || suggestion.rating ) {
						html += '<div class="serch-price-rating">';
						if(suggestion.price) html += '<span class="search-price">'+suggestion.price+'</span>';
						if(suggestion.rating) html += '<span class="search-rating">'+suggestion.rating+'</span>';
						html += '</div>';
					}
					if (suggestion.id != -1) {
						html += '</a>';
					} 
					return html;
				}
			});

			if( search_categories.length ){
				var searchForm = $(this).find('.search-field').devbridgeAutocomplete();
				search_categories.on( 'change', function( e ){
					if( search_categories.val() != '' ) {
						product_cat = search_categories.val();
						searchForm.setOptions({
							params : { 'product_cat' : product_cat, nonce: pls_options.nonce }
							
						});
					} else{
						searchForm.setOptions({
							params : { 'product_cat' : '', nonce: pls_options.nonce }
						});
					}
					/* update suggestions */
					searchForm.hide();
					searchForm.onValueChange();
				});
			}
		});
		 
		/* Hide .trending-search-wrap */
		$(document).mouseup(function (e){
			var container = $(".pls-ajax-search");			
			if (!container.is(e.target) && container.has(e.target).length === 0){				
				$(".trending-search-wrap").hide();				
			}
		}); 
	};
	
	pls.swapLoginSignupFrom = function () {
		/*
		* Swap Login Signup Form
		*/
		var userSignup 	= $('.pls-new-register');
		var userSignin	= $('.pls-new-login');
		
		userSignup.on('click', function(e) {
			e.preventDefault();	
			$('.pls-customer-login').removeClass('active')
			$('.pls-customer-register').addClass('active');
			
		});
		userSignin.on('click', function(e) {
			e.preventDefault();
			$('.pls-customer-register').removeClass('active');
			$('.pls-customer-login').addClass('active');
			
		});
	}
	
	pls.userLoginSignupPopup = function () {
		/*
		* User Login Signup Popup
		*/

		if( !pls_options.login_register_popup || $('body').hasClass('woocommerce-account') )  return false;
		
		$('.customer-signinup').magnificPopup({
			type: 'inline',
			preloader: false,			
			removalDelay: 500,
			items: {
				src: '#pls-login-register-popup' ,					
			},
			callbacks: {
				open: function() {
					var closeSidebar 	= $('.pls-mask-overaly');
					var mobileSidebar = $('.pls-mobile-menu');
					closeSidebar.removeClass('opened');
					mobileSidebar.removeClass('opened');
					$('.pls-login-register-popup').addClass('animated slideInDown');
				},
				beforeClose: function() {
						var popupWrap = $( '.pls-login-register-popup' );
						popupWrap.removeClass('slideInDown').addClass('slideOutUp');
					}, 
				close: function() {
					$('.pls-login-register-popup').removeClass('animated slideOutUp');
					$('.pls-login-register-popup').find('.signin-up-error-message').remove();
				}
			} 
		});
		
		if( pls_options.button_loader ){
			$(document).on('click', '#pls-login-register-popup .woocommerce-login-button .button', function(e) {
				var $this = $(this);
				var $loginform = $this.closest('form');			
				$this.addClass('loading');
			});		
			$(document).on('click', '#pls-login-register-popup .woocommerce-form-register .woocommerce-Button.button', function(e) {			
				var $this = $(this),
				$regform = $this.closest('form');			
				$this.addClass('loading');		
			});	
		}
	};
	
	pls.miniCartWidget = function () {
		/*
		 * Mini Cart Widget Sidebar
		 */
		 
		if ( 'slider' != pls_options.header_minicart_popup ) { return false; }

		var headerCart 		= $('.pls-header-cart');
		var miniCartSidebar = $('.pls-minicart-slide');
        var closeSidebar 	= $('.pls-mask-overaly');
		var mobileSidebar = $('.pls-mobile-menu');
		
		
		headerCart.on('click', function(e) {
			
			if( $('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout') ) { return; };
			
			e.preventDefault();
			pls.imagelazyload();
			if ( ! miniCartSidebar.hasClass('opened') ) {
				miniCartSidebar.addClass('opened');
				closeSidebar.addClass('opened');				
			}
			setTimeout(function(){
			 pls.imagelazyload();
			}, 200);

			
		});
		
		pls.$body.on('click', '.pls-mask-overaly, .close-sidebar', function (e) {
			e.preventDefault();
			miniCartSidebar.removeClass('opened');
			closeSidebar.removeClass('opened');
			mobileSidebar.removeClass('opened');
		});	
		 
		pls.$doc.keyup( function( e ) {
            if ( e.keyCode === 27 ) {
				miniCartSidebar.removeClass('opened');
				closeSidebar.removeClass('opened');
			}
        });
	};
	
	pls.addToWishlist = function(){
		/*
		* Add wishlist loader
		*/
       pls.$body.on("click", ".add_to_wishlist", function() {
		  /*  Bootstrap tooltips hide */
			var tooltip_hide = ('.yith-wcwl-add-to-wishlist a');			
			$(tooltip_hide).tooltip('hide');
			
            $(this).addClass("loading");
        });
	}
	
	pls.wishlistCount = function(){
		/*
		* Ajax Count Wishlist Product
		*/
		
		var pls_ajax_wishlist_count = function() {
			$.ajax({
				type: 'POST',
				url: yith_wcwl_l10n.ajax_url,
				data      : {
					action	: 'pls_ajax_wishlist_count',
					nonce   : pls_options.nonce,
				},
				beforeSend: function () {
				},
				complete  : function () {
				},			
				success   : function (data) {
					$('span.pls-header-wishlist-count').html(data);
					pls.tooltip();
				}
			});
		};
		$('body').on( 'added_to_wishlist removed_from_wishlist', pls_ajax_wishlist_count );
	};
	
	
	pls.compareCount = function(){
		//*******************************************************************
		//* Ajax Count Compare Product
		//*******************************************************************/
		
		$('body').on( 'yith_woocompare_open_popup woocompare_open_popup_mod', function () {				
			$.ajax({
				type: 'post',
				url: pls_options.ajax_url,
				data      : {
					action: 'pls_ajax_compare_count',
					nonce	: pls_options.nonce,
				},
				beforeSend: function () { 
				},
				complete  : function () { 
				},	
				success: function (response) { 
					$('span.pls-header-compare-count').html(response);				
				},
				error: function(errorThrown){
					/* alert(errorThrown); */
			   } 
			});
		});

		$(window).on('yith_woocompare_product_removed', function () {
			$('body').trigger('woocompare_open_popup_mod');
		});
		
		/* Remove product in compare product widget */
		$('.yith-woocompare-widget').on('click', 'li a.remove, a.clear-all', function (e) {

			e.preventDefault();
			var product_id = $(this).data('product_id');
			
			$.ajax({
				type: 'post',
				url: pls_options.ajax_url,
				data      : {
					action	: 'pls_ajax_compare_count',
					nonce	: pls_options.nonce,
					id		: product_id
				},
				beforeSend: function () { 
				},
				complete  : function () { 
				},	
				success: function (response) { 
					$('label.compare-count').html(response);				
				},
				error: function(errorThrown){
					/* alert(errorThrown); */
			   } 
			});

		});
	};
	pls.addToCompare = function () {
		
		/*
		* Add to compare list
		*/
		var button = $("a.compare");

        pls.$body.on("click", "a.compare", function() {
            $(this).addClass("loading");
        });

        pls.$body.on("yith_woocompare_open_popup", function() {
			
           pls.$body.find('.compare').removeClass('loading');
           pls.$body.addClass("compare-opened");
        });

        pls.$body.on('click', '#cboxClose, #cboxOverlay', function() {
            pls.$body.removeClass("compare-opened");
        });
	}
	
	pls.removeToCompare = function () {
		/*
		* Remove to compare list
		*/
		
		$(document).find('.compare-list').on('click', '.remove a', function (e) {
            e.preventDefault();
			$(this).addClass('loading');
            var compare_counter = $('.pls-header-compare-count', window.parent.document).html();
            compare_counter = parseInt(compare_counter, 10) - 1;
            if (compare_counter < 0) {
                compare_counter = 0;
            }

            $('.pls-header-compare-count', window.parent.document).html(compare_counter);
        });
		
		pls.$body.on("click", ".yith-woocompare-widget li a.remove", function(e) {
            e.preventDefault();
            var compare_counter = $(document).find('.pls-header-compare-count').html();
            compare_counter = parseInt(compare_counter, 10) - 1;
            if (compare_counter < 0) {
                compare_counter = 0;
            }

            setTimeout(function () {
                $(document).find('.pls-header-compare-count').html(compare_counter);
            }, 2000);

        });

        pls.$body.on("click", ".yith-woocompare-widget a.clear-all", function(e) {
            e.preventDefault();
            setTimeout(function () {
                $(document).find('.pls-header-compare-count').html('0');
            }, 2000);
        });
		
		
	}
	
	pls.ProductLoopQuantityField = function () {
		/*
		* Product Quantity Field
		*/		
		
		$(".woocommerce .pls-product-buttons").on("change input", ".quantity .qty", function () {
		  var add_to_cart_button = $(this).parents(".product").find(".add_to_cart_button");
		  add_to_cart_button.attr("data-quantity", $(this).val());
		});
		$(".woocommerce .pls-product-buttons").on("keypress", ".quantity .qty", function (e) {
		  if ((e.which || e.keyCode) === 13) {
			$(this).parents(".product").find(".add_to_cart_button").trigger("click");
		  }
		});
	}
	
	pls.addToCart = function () {
		/*
		 *  Adding to cart
		 */
		 $('body').on('added_to_cart', function(event, fragments, cart_hash) {
			$.magnificPopup.close();
			if( $('.pls-header-cart').length > 0 ) {
				if ( pls_options.mini_cart_popup == '1' ) {
					$('.pls-header-cart').trigger('click');
				}
			}
		 });
	};
	
	pls.addToCartAjax = function () {
		/*
		 *  Adding to cart Ajax
		 */
		if ( ! pls_options.enable_add_to_cart_ajax ) { return; }
		
		$('.single_add_to_cart_button').addClass('single_add_to_cart_ajax_button');
		pls.$body.find('form.cart').on('click', '.single_add_to_cart_button', function (e) {
			 
			var $productWrapper = $(this).parents('.pls-single-product-page');
            if ($productWrapper.hasClass('product-type-external')) return;          

            var $form = $(this).closest('form.cart'),
                $singleBtn =  $(this),
				product_id = $form.find('input[name=add-to-cart]').val() || $singleBtn.val();
			if ($singleBtn.hasClass('disabled')) {
				return;
			}
			if ($singleBtn.hasClass('quick-buy-proceed')) {
				return;
			}
			if ($form.length > 0) {
                e.preventDefault();
            } else {
                return;
            }
			var data = {
				action			: 'pls_ajax_add_to_cart',
				'add-to-cart'	: product_id,
				nonce   		: pls_options.nonce,
			};

			$form.serializeArray().forEach(function (element) {
				data[element.name] = element.value;
			});
			if ($singleBtn.hasClass('loading')) {
				return;
			}
			$singleBtn.addClass('loading');
			
			$(document.body).trigger('adding_to_cart', [$singleBtn, data]);
			$.ajax({
				type: 'post',
				url: pls_options.ajax_url,
				data: data,
				beforeSend: function (response) {
					$singleBtn.removeClass('added').removeClass('not-added');
				},
				success: function (response) {
					if (response.error & response.product_url) {
					  window.location = response.product_url;
					  return;
					} else {
						if (typeof wc_add_to_cart_params !== 'undefined') {
							if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
								window.location = wc_add_to_cart_params.cart_url;
								return;
							}
						}					
						
						/* Show notices */
                        if( response.notices.indexOf( 'error' ) > 0 ) {
                            $('.woocommerce-notices-wrapper').empty().append(response.notices);
							$singleBtn.addClass('not-added').removeClass('loading');
                        } else {
                            if ( pls_options.product_open_cart_mini == '1' ) {
								$('.pls-header-cart').trigger('click');
							}
							$singleBtn.addClass('added').removeClass('loading');
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $singleBtn]);
                        }
						
					}
				},
			});
			
		});
	};
	
	pls.stickyAddToCart = function(){
		/*
		* Sticky Add To Cart Bottom Button
		*/	
		
		if ( ! $('body').hasClass( 'single-product' ) || $('.pls-sticky-add-to-cart').length == 0 || $(window).width() < 992 || $('.entry-summary form .single_add_to_cart_button').length == 0 ) {
			return;
		}
		
		$('body').on( 'click', '.pls-sticky-add-to-cart .button', function (event) {
			event.preventDefault();			
			if( $(this).hasClass('variable') || $(this).hasClass('grouped') ){				
				$('html, body').animate({
					scrollTop: $(".variations").offset().top - 70
				}, 1000);
			}else{
				$(this).addClass('loading');
				$( '.entry-summary .single_add_to_cart_button' ).click();
				event.stopPropagation();				
			}
		});
		
		$(document.body).on( 'added_to_cart', function () {			
			$('.pls-sticky-add-to-cart .button').removeClass('loading');
		});
		
		var cartButtonOffset = $('.entry-summary form .single_add_to_cart_button').offset().top;
		
		$(window).scroll(function(e) {			
			var documentHeight = $(document).height();
			var windowHeight = $(this).height();
			var scrollTop = $(this).scrollTop();
			var bottomscroll = parseInt( windowHeight + scrollTop ) + 100;
			
			if ( scrollTop > cartButtonOffset ) {
				$('.pls-sticky-add-to-cart').slideDown();
				$('.pls-back-to-top').addClass('sticky-add-cart');
			} else if ( scrollTop < cartButtonOffset) {
				$('.pls-sticky-add-to-cart').slideUp(); /* Hide on bottom */
				$('.pls-back-to-top').removeClass('sticky-add-cart');
			}
		});		
	};
	
	pls.productQuickView = function () {
		/*
		* Product Quickview
		*/		
		pls.$doc.on("click", ".pls-quickview-btn", function(e) {
            e.preventDefault();
			var $btn = $(this),pid;
			if($btn.hasClass('loading')) return;
			$btn.addClass('loading');
			var pid           = $btn.attr( 'data-id' );
			$.ajax( {
				url    : pls_options.ajax_url,
				data   : {
					action	: 'pls_product_quick_view',
					pid   	: pid,
					nonce   : pls_options.nonce,
				},
				timeout: 10000,
				success: function( response ) {
					$.magnificPopup.open({
						alignTop: true,
						removalDelay: 500,
						overflowY: 'scroll',
						items: {
						  src: '<div class="animated slideInDown pls-quick-view woocommerce">' + response + '</div>', 
						  type: 'inline'
						},
						callbacks: {
							open: function () {
														
							},
							close: function () {
								pls.singlePageSwatch();						
							},
							beforeClose: function() {
								var quickViewWrap = $( '.pls-quick-view' );
								quickViewWrap.addClass('slideOutUp');
							},
						},
					});
					
					if( $('.woocommerce-product-gallery').find( '.single-product-gallery' ).length > 0 ) {
						$( '.single-product-gallery' ).not( '.slick-initialized' ).slick({
							slidesToShow	: 1,
							slidesToScroll	: 1,
							rtl				: ( pls.isCheckRTL() ) ? true : false,
						});
					}
					$('.product-quick-view .woocommerce-product-gallery__image a').on('click', function(e){
						e.stopPropagation();
						e.preventDefault();
					});
					setTimeout(function() {
						var form_variation = $( '.product-quick-view' ).find( '.variations_form' );
						if ( form_variation.length > 0 ) {
							form_variation.trigger( 'check_variations' );
							form_variation.trigger( 'reset_image' );						
							form_variation.wc_variation_form();
							form_variation.find( 'select' ).change();
							pls.singlePageSwatch();
							
						}
					}, 1000);
					
					
					$btn.removeClass( 'loading' );
					
					pls.productSaleCountdown();
					pls.addToCartAjax();
					pls.productQuickShop();
					pls.tooltip();
					pls.imagelazyload();
					
				},
				error  : function( error ) {
					console.log( error );
					$btn.removeClass( 'loading' );
				},

			} );
        });
	}
	pls.productShowFilter = function () {
		$('.pls-product-show .show-number').on('change', function () {
			 if ( !pls.$body.hasClass('pls-catalog-ajax-filter') ) {
				$( this ).closest( 'form' ).submit();
			}
      });
	}
	
	/* Get price js slider */
	pls.priceSlider = function () {
		/* woocommerce_price_slider_params is required to continue, ensure the object exists */
		if (typeof woocommerce_price_slider_params === 'undefined') {
			return false;
		}
		
		if (!$('#main-content').find('.widget_price_filter').length) {
			return false;
		}
		
		/* Get markup ready for slider */
		$('input#min_price, input#max_price').hide();
		$('.price_slider, .price_label').show();

		/* Price slider uses jquery ui */
		var min_price = $('.price_slider_amount #min_price').data('min'),
			max_price = $('.price_slider_amount #max_price').data('max'),
			current_min_price = parseInt(min_price, 10),
			current_max_price = parseInt(max_price, 10);

		if ($('.price_slider_amount #min_price').val() != '') {
			current_min_price = parseInt($('.price_slider_amount #min_price').val(), 10);
		}
		if ($('.price_slider_amount #max_price').val() != '') {
			current_max_price = parseInt($('.price_slider_amount #max_price').val(), 10);
		}

		$(document.body).on('price_slider_create price_slider_slide', function (event, min, max) {
			if (woocommerce_price_slider_params.currency_pos === 'left') {

				$('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + min);
				$('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + max);

			} else if (woocommerce_price_slider_params.currency_pos === 'left_space') {

				$('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + ' ' + min);
				$('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + ' ' + max);

			} else if (woocommerce_price_slider_params.currency_pos === 'right') {

				$('.price_slider_amount span.from').html(min + woocommerce_price_slider_params.currency_symbol);
				$('.price_slider_amount span.to').html(max + woocommerce_price_slider_params.currency_symbol);

			} else if (woocommerce_price_slider_params.currency_pos === 'right_space') {

				$('.price_slider_amount span.from').html(min + ' ' + woocommerce_price_slider_params.currency_symbol);
				$('.price_slider_amount span.to').html(max + ' ' + woocommerce_price_slider_params.currency_symbol);

			}

			$(document.body).trigger('price_slider_updated', [min, max]);
		});
		if (typeof $.fn.slider !== 'undefined') {
			$('.price_slider').slider({
				range  : true,
				animate: true,
				min    : min_price,
				max    : max_price,
				values : [current_min_price, current_max_price],
				create : function () {

					$('.price_slider_amount #min_price').val(current_min_price);
					$('.price_slider_amount #max_price').val(current_max_price);

					$(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
				},
				slide  : function (event, ui) {

					$('input#min_price').val(ui.values[0]);
					$('input#max_price').val(ui.values[1]);

					$(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
				},
				change : function (event, ui) {

					$(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
				}
			});
		}
	};
	
	pls.productShowHideFilters = function () {
		$('.archive.woocommerce').on('click','.pls-product-filter-btn',function(e) {
			var $this = $(this),
			filter_content = $('#pls-filter-widgets');
			$this.toggleClass("active");
			filter_content.toggleClass('active');
			filter_content.slideToggle('slow');			
      });
	}
	
	pls.productSortOrderFilter = function () {
		var $sortOrdering = $('.woocommerce-ordering');

		$sortOrdering.on('change', 'select.orderby', function () {
			var $form = $(this).closest('form');

			$form.find('[name="_pjax"]').remove();

			$.pjax({
				container: '.pls-site-content',
				timeout: 10000,
				url: '?' + $form.serialize(),
				scrollTo: false,
				fragment	: '#main-content'
			});
		});

		$sortOrdering.submit(function (e) {
			e.preventDefault(e);
		});
	}
	
	pls.productSortPerpage = function () {
		var $sortPerpage = $('.show-products-number');

		$sortPerpage.on('change', 'select.per_page', function () {
			var $form = $(this).closest('form');

			$form.find('[name="_pjax"]').remove();

			$.pjax({
				container: '.pls-site-content',
				timeout: 10000,
				url: '?' + $form.serialize(),
				scrollTo: false,
				fragment	: '#main-content'
			});
		});

		$sortPerpage.submit(function (e) {
			e.preventDefault(e);
		});
	}
	
	pls.productFilterAjax = function () {
		if (!pls.$body.hasClass('pls-catalog-ajax-filter')) {
			return;
		}
		
		pls.productSortOrderFilter();
		pls.productSortPerpage();
		
		pls.$doc.on('submit', '.widget_price_filter form', function(event) {
			$.pjax.submit(event, '.pls-site-content', {
				timeout      : 10000,
				scrollTo      : false,
				fragment	: '#main-content'
			});
		});
		
		var ajaxLinkSelector = '.widget_product_categories ul a,.pls-widget-brands ul a, .widget_rating_filter ul a, .widget_layered_nav_filters ul a, .widget_product_tag_cloud a,.pls-products-view a,.pls-pagination .page-numbers a,.pls_widget_product_sorting li a,.widget_layered_nav_filters a, .pls-clear-filters-wrapp a,.widget_layered_nav a';
		
		pls.$doc.pjax( ajaxLinkSelector , '.pls-site-content', {
			timeout      : 10000,
			scrollTo      : false,
			fragment	: '#main-content'
		});
		
		$(document).on('pjax:error', function(xhr, textStatus, error) {
			console.log('pjax error ' + error);
		});
		
		$(document).on('pjax:start', function() {
			$(document.body).trigger('pls_ajax_filter_before_send_request');
		});
		
		$(document).on('pjax:end', function() {
			$(document.body).trigger('pls_ajax_filter_request_end');			
		});		
		
		pls.$body.on('click','.pls-products-view a',function(e) {				
			var $this = $(this);			
			$this.siblings().removeClass("active");
			$this.addClass('active');
		});
		
		/* Sorting filter*/
		$('.archive.woocommerce').on('click','.pls_widget_product_sorting li',function(e) {			
			var $this = $(this);
			$this.siblings().removeClass("chosen");
			if($this.hasClass('chosen')){
                $this.removeClass('chosen');
            }else{
                $this.addClass('chosen');
            };			
		});
		
		/* Attribute/Rating filter*/
		$('.archive.woocommerce').on('click','.widget_layered_nav li,.widget_rating_filter li,.widget_layered_nav_filters li',function(e) {
			var $this = $(this);
			if($this.hasClass('chosen')){
                $this.removeClass('chosen');
            }else{
                $this.addClass('chosen');
            };			
		});
		
		$(document.body).on('pls_ajax_filter_before_send_request', function () {
			
			var $product_container = $('#main-content .products-wrap');
			$product_container.addClass('products_overlay');
			$product_container.append('<div class="pls_product_loading loading"></div>');
			$('#secondary').removeClass('opened');
			$('.pls-mask-overaly').removeClass('opened');
			
		});
		
		$(document.body).on('pls_ajax_filter_request_end', function () {
			var $product_container = $('#main-content .products-wrap');
				
			$('#pls-filter-widgets').slideUp(200);
			if ($product_container.length > 0) {
				var position = $('.products').offset().top - 200;
				$('html, body').stop().animate({
						scrollTop: position
					},
					1200
				);
			}
			pls.priceSlider();
			pls.imagelazyload();
			pls.plsElementorSwiperSlider();
			pls.initAjaxLoad();
			pls.tooltip();
			pls.widgetToggle();
			pls.widgetMenuToggle();
			pls.widgetMaxLimitItem();
			pls.stickySidebar();
			pls.swatchInLoop();
			pls.productQuickView();
			pls.canvasSidebar();
			pls.productSortOrderFilter();
			pls.productSortPerpage();
			$('.pls-mask-overaly').removeClass('opened');
		});
	}	
	
	pls.productSwatch = function(){
		this.singlePageSwatch();
		this.swatchInLoop();
	}
	pls.swatchSelectedLabel = function( element ){
		var $label = $( element ).closest( '.variation-swatche' ).find( '.label' ),
			$holder = $label.find( '.pls-swatches-selected-label' ),
			$label_txt = $( element ).attr('title');
		if ( ! $holder.length ) {
			$holder = $( '<span class="pls-swatches-selected-label" />' );

			$label.append( $holder )
		}
		if ( $label_txt != '' ) {
			$holder.text( $label_txt ).show();
		} else {
			$holder.text( '' ).hide();
		}
	}
	pls.singlePageSwatch = function () {
		
		var variationForm; 
		
		if( pls.$doc.find( '.pls-quick-view form.pls-swatches-wrap.variations_form' ).length && !pls.$doc.find( '.pls-quick-view' ).hasClass( 'slideOutUp' ) ){
			variationForm 	= pls.$doc.find( '.pls-quick-view form.pls-swatches-wrap.variations_form' );
		}else{
			variationForm 	= pls.$doc.find( 'form.pls-swatches-wrap.variations_form' );
		}
		var self 			= this,					
			$term 			= variationForm.find( '.swatch-term' ),
			$activeTerm 	= variationForm.find( '.swatch-term:not(.swatch-disabled)' );
		self.$swatchForm	= variationForm;
		
		$activeTerm.unbind( 'click' ).on( 'click', function () {

			var $this 		= $( this ),
				term 		= $this.attr( 'data-term' ),
				attr 		= $this.parent().attr( 'data-attribute' ),
				$selectbox 	= self.$swatchForm.find( 'select#' + attr );

			if ( $this.hasClass( 'swatch-disabled' ) ) {
				return false;
			}

			$selectbox.val( term ).trigger( 'change' );
			$this.closest('.pls-swatches').find( '.swatch-selected' ).removeClass( 'swatch-selected' );
			$this.addClass( 'swatch-selected' );
			pls.swatchSelectedLabel(this);
		} );

		self.$swatchForm.on( 'woocommerce_update_variation_values',
			function () {
				
				self.$swatchForm.find( 'select' ).each( function () {
					var $this 		= $( this );
					var $swatch 	= $this.parent().parent().find( '.pls-swatches' );
					
					$swatch.find( '.swatch-term' ).removeClass( 'swatch-enabled' ).addClass( 'swatch-disabled' );

					$this.find( 'option.enabled' ).each( function () {
						var val 	= $( this ).val();
						$swatch.find(
							'.swatch-term[data-term="' + val + '"]' ).removeClass( 'swatch-disabled' ).addClass( 'swatch-enabled' );
					} );
				} );
			} );

		self.$swatchForm.on( 'reset_data', function () {
			if ( $('.pls-swatches-selected-label').length ) {
				$('.pls-swatches-selected-label').text('');
			}
			/* load default value */
			$term.each( function () {
				var $this = $( this ),
					term = $this.attr( 'data-term' ),
					attr = $this.parent().attr( 'data-attribute' ),
					$selectbox = self.$swatchForm.find( 'select#' + attr ),
					val = $selectbox.val();				
				if ( val != '' && term == val ) {				
					$( this ).addClass( 'swatch-selected' );
				}else{
					$( this ).removeClass( 'swatch-selected' );
				}
			} );
		
		} );

	}
	pls.swatchInLoop = function(){
		var self 			= this,
		swatchesInLoop 		= pls.$doc.find( 'div.pls-swatches-wrap' );
		self.$swatches 		= swatchesInLoop;
		self.$swatches.each( function () {
			var $swatches 	= $( this ),
			$term 			= $swatches.find(
				'.swatch-term:not(.swatch-disabled)' ),
			$resetBtn 		= $swatches.find(
				'.reset_variations--loop' ),
			$product 		= $swatches.closest('.product'),
			variationData 	= $.parseJSON(
			$swatches.attr( 'data-product_variations' ) );
			
			if ( $swatches.find( '.pls-swatches' ).length == 0 ) {
				$swatches.addClass( 'swatch-empty' );
			}
			
			$term.unbind( 'click' ).on( 'click', function () {

				var $this = $( this );

				if ( $this.hasClass( 'swatch-disabled' ) ) {
					return false;
				}

				var term = $this.attr( 'data-term' );				
				
				$product.find( '.swatch-term' ).removeClass( 'swatch-disabled swatch-enabled' );
				$this.parent().find( '.swatch-term.swatch-selected' ).removeClass( 'swatch-selected' );

				if ( $this.hasClass( 'swatch-selected' ) ) {
					$this.parent().removeClass( 'swatch-activated' );
					$product.removeClass( 'swatch-product-swatched' );

					if ( !$product.find( '.swatch-selected' ).length ) {
						$resetBtn.trigger( 'click' );
					}
				} else {
					$this.parent().addClass( 'swatch-activated' );
					$this.addClass( 'swatch-selected' );

					$product.addClass( 'swatch-product-swatched' );
					/* $resetBtn.show(); */
				}
				
				var attributes 			= self.getChosenAttributes(
					$swatches ),
					currentAttributes 	= attributes.data;
				if ( attributes.count === attributes.chosenCount ) {
					self.updateAttributes( $swatches, variationData );

					var matching_variations = self.findMatchingVariations(
						variationData, currentAttributes ),
						variation = matching_variations.shift();

					if ( variation ) {
						/* Found variation */
						self.foundVariation( $swatches, variation );
					} else {
						
						$resetBtn.trigger( 'click' );
					}
				} else {
					
					self.updateAttributes( $swatches, variationData );
				} 

			} );
			
			$resetBtn.unbind( 'click' ).on( 'click', function () {

				$product.removeClass( 'swatch-product-swatched' );

				$swatches.removeAttr( 'data-variation_id' );
				$swatches.find( '.swatch-swatch' ).removeClass( 'swatch-activated' );
				$swatches.find( '.swatch-term' ).removeClass(
					'swatch-enabled swatch-disabled swatch-selected' );
				
				/* reset image */
				self.variationsImageUpdate( false, $product );

				$( this ).hide();

				return false;
			} );					
		});
	};
	
	pls.getChosenAttributes = function ( $swatches ) {

		var data = {},
			count = 0,
			chosen = 0,
			$swatch = $swatches.find( '.pls-swatches' );

		$swatch.each( function () {
				var attribute_name = 'attribute_' +
						$( this ).attr( 'data-attribute' ),
					value = $( this ).find( '.swatch-term.swatch-selected' ).attr( 'data-term' ) || '';

				if ( value.length > 0 ) {
					chosen++;
				}

				count++;
				data[ attribute_name ] = value;			
		} );

		return {
			'count': count,
			'chosenCount': chosen,
			'data': data,
		};
	}
	
	pls.updateAttributes = function ( $swatches, variationData ) {

		var self = this,
			attributes = self.getChosenAttributes( $swatches ),
			currentAttributes = attributes.data,
			available_options_count = 0,
			$swatch = $swatches.find( '.pls-swatches' );

		$swatch.each( function ( idx, el ) {

			var current_attr_sw = $( el ),
				current_attr_name = 'attribute_' +
					current_attr_sw.attr(
						'data-attribute' ),
				selected_attr_val = current_attr_sw.find(
					'.swatch-term.swatch-selected' ).attr( 'data-term' ),
				selected_attr_val_valid = true,
				checkAttributes = $.extend( true, {},
					currentAttributes );
			
			checkAttributes[ current_attr_name ] = '';
			
			var variations = self.findMatchingVariations(
				variationData, checkAttributes );
			
			/* Loop through variations. */
			for (var num in variations) {
				if ( typeof variations[ num ] !== 'undefined' ) {
					var variationAttributes = variations[ num ].attributes;

					for (var attr_name in variationAttributes) {
						if ( variationAttributes.hasOwnProperty(
								attr_name ) ) {
							var attr_val = variationAttributes[ attr_name ],
								variation_active = '';
							
							if ( attr_name === current_attr_name ) {
								if ( variations[ num ].variation_is_active ) {
									variation_active = 'enabled';
								}
								
								if ( attr_val ) {
									/* available */
									current_attr_sw.find(
										'.swatch-term[data-term="' + attr_val + '"]' ).addClass( 'swatch-' + variation_active );
								}
								else {
									/* apply for all swatches */
									current_attr_sw.find( '.swatch-term' ).addClass( 'swatch-' + variation_active );
								}
							}
						}
					}
				}
			}

			available_options_count = current_attr_sw.find(
				'.swatch-term.swatch-enabled' ).length;

			if ( selected_attr_val && (
					available_options_count === 0 || current_attr_sw.find(
						'.swatch-term.swatch-enabled[data-term="' +
						self.addSlashes( selected_attr_val ) + '"]' ).length ===
					0
				) ) {
				selected_attr_val_valid = false;
			}

			/* Disable terms not available */
			current_attr_sw.find( '.swatch-term:not(.swatch-enabled)' ).addClass( 'swatch-disabled' );

			/* Choose selected value. */
			if ( selected_attr_val ) {
				/* If the previously selected value is no longer available,
				fall back to the placeholder (it's going to be there). */
				if ( !selected_attr_val_valid ) {
					current_attr_sw.find( '.swatch-term.swatch-selected' ).removeClass( 'swatch-selected' );
				}
			}
			else {
				current_attr_sw.find( '.swatch-term.swatch-selected' ).removeClass( 'swatch-selected' );
			}
		} );
	}
	
	pls.addSlashes = function ( string ) {
		string = string.replace( /'/g, '\\\'' );
		string = string.replace( /"/g, '\\\"' );
		return string;
	}

	pls.findMatchingVariations = function ( variationData, settings ) {
		var matching = [];
		for (var i = 0; i < variationData.length; i++) {
			var variation = variationData[ i ];

			if ( this.isMatch( variation.attributes, settings ) ) {
				matching.push( variation );
			}
		}
		return matching;
	}

	pls.isMatch = function ( variation_attributes, attributes ) {
		var match = true;
		for (var attr_name in variation_attributes) {
			if ( variation_attributes.hasOwnProperty( attr_name ) ) {
				var val1 = variation_attributes[ attr_name ];
				var val2 = attributes[ attr_name ];
				if ( val1 !== undefined && val2 !== undefined &&
					val1.length !== 0 && val2.length !== 0 &&
					val1 !== val2 ) {
					match = false;
				}
			}
		}
		return match;
	}

	pls.foundVariation = function ( $swatches, variation ) {

		var self = this,
		$product = $swatches.closest( '.product' );
		/* add variation id */
		$swatches.attr( 'data-variation_id', variation.variation_id );

		/* update image */
		self.variationsImageUpdate( variation, $product );
		
	}

	/**
	 * Stores a default attribute for an element so it can be reset later
	 */
	pls.setVariationAttr = function ( $el, attr, value ) {
		if ( undefined === $el.attr( 'data-o_' + attr ) ) {
			$el.attr( 'data-o_' + attr, (
				!$el.attr( attr )
			) ? '' : $el.attr( attr ) );
		}
		if ( false === value ) {
			$el.removeAttr( attr );
		}
		else {
			$el.attr( attr, value );
		}
	}

	/**
	 * Reset a default attribute for an element so it can be reset later
	 */
	pls.resetVariationAttr = function ( $el, attr ) {
		if ( undefined !== $el.attr( 'data-o_' + attr ) ) {
			$el.attr( attr, $el.attr( 'data-o_' + attr ) );
		}
	}

	pls.variationsImageUpdate = function ( variation, $product ) {

		var self = this,
			$product_img = $product.find( 'img.front-image' );
		
		if ( variation && variation.image_src && variation.image.src && variation.image_src.length > 1 ) {			
			self.setVariationAttr( $product_img, 'src',
				variation.image_src[ 0 ] );
			self.setVariationAttr( $product_img, 'srcset',
				variation.image_srcset );
			self.setVariationAttr( $product_img, 'sizes',
				variation.image_sizes );
		} else {
			self.resetVariationAttr( $product_img, 'src' );
			self.resetVariationAttr( $product_img, 'srcset' );
			self.resetVariationAttr( $product_img, 'sizes' );
		}

	}
	
	pls.initAjaxLoad = function(){ 
		var button = $( '.pls-ajax-load' );

		button.each( function( i, val ) {
			var _option = $( this ).data();
			
			if ( _option !== undefined ) {
				var page      = _option.total_page,
					container = _option.container,
					container_element = _option.container_element,
					layout    = _option.layout,
					load_more_label    = _option.load_more_label,
					loading_finished_msg    = _option.loading_finished_msg,
					loading_msg    = pls_options.js_translate_text.loading_txt,					
					isLoading = false,
					anchor    = $( val ).find( 'a' ),
					next      = $( anchor ).attr( 'href' ),
					i         = 2;

				if ( layout == 'load-more-button' ) {
					$( val ).on( 'click', 'a', function( e ) {
						e.preventDefault();
						anchor = $( val ).find( 'a' );
						next   = $( anchor ).attr( 'href' );

						$( anchor ).addClass('active-loading').text(loading_msg);
						
						getData();
					});
				}  else if( layout == 'infinity-scroll' ) {
					var waiting = false,
						endScrollHandle;
						pls.$window.on('scroll', function () {
							
							if (pls.$body.find('.infinity-scroll').is(':in-viewport')) {
								
								pls.$body.find('.infinity-scroll a').trigger('click');
							}
						}).trigger('scroll');
						
						pls.$body.on('click', '.pls-pagination a.button', function (e) {
							if ( waiting ) {
								return;
							}
							waiting = true;
							e.preventDefault();
							
							var $el = $(this);
							$el.addClass('active-loading').text(loading_msg);
							if ($el.data('requestRunning')) {
								return;
							}

							$el.data('requestRunning', true);

							var $pagination = $el.closest('.pls-pagination'),								
								container = _option.container,
								container_element = _option.container_element,
								$products = $pagination.prev('.'+container),
								href = $el.attr('href');
							
							
							$.get(
								href,
								function (response) {
									
									var content = $(response).find('#primary .'+ container).children('.'+container_element),
										$pagination_html = $(response).find('.pls-pagination').html();

									$pagination.html($pagination_html);

									if ($('.masonry-grid').length > 0) {
							
										$products.append(content).isotope( 'appended', content );
										$products.imagesLoaded().progress(function() {
											$products.isotope('layout');
										});
									
									}else{
										$products.append(content);
									}
						
									$pagination.find('a').data('requestRunning', false);
									waiting = false;
									pls.initMagnaficPopup();
									/* pls.priceSlider(); */
									pls.plsElementorSwiperSlider();
									pls.tooltip();
									pls.imagelazyload();
									pls.widgetToggle();
									pls.widgetMenuToggle();
									pls.widgetMaxLimitItem();
									pls.canvasSidebar();
									pls.stickySidebar();
									pls.ProductLoopQuantityField();
									pls.productQuickView();
									pls.addToCompare();
									$(document.body).trigger('pls_shop_ajax_loading_end');
								}
							);
						});
				} 
				var getData = function() {
					$.get( next + '', function( data ) {
						var content    = $( '.' + container, data ).wrapInner( '' ).html(),
							newElement = $( '.' + container, data ).find( '.' + container_element );
						next = $( anchor, data ).attr( 'href' );
						if ($('.masonry-grid').length > 0) {
							
							$( '.'+ container ).append(newElement).isotope( 'appended', newElement );
						$( '.'+ container ).imagesLoaded().progress(function() {
							$( '.'+ container ).isotope('layout');
						});
						
						}else{
							$( '.' + container ).append(newElement);
						}
						$( anchor ).removeClass('active-loading').text( load_more_label );

						if ( page > i ) {
							if ( pls_options.permalink == 'plain' ) {
								var link = next.replace( /paged=+[0-9]+/gi, 'paged=' + ( i + 1 ) );
							} else {
								var link = next.replace( /page\/+[0-9]+\//gi, 'page/' + ( i + 1 ) + '/' );
							}

							$( anchor ).attr( 'href', link );
						} else {
							$( anchor ).text( loading_finished_msg );
							$( anchor ).attr( 'href', 'javascript:void(0);' ).addClass( 'disabled' );
						}
						isLoading = false;
						i++;
						pls.initMagnaficPopup();
						pls.plsElementorSwiperSlider();
						pls.tooltip();
						pls.imagelazyload();
						pls.widgetToggle();
						pls.widgetMenuToggle();
						pls.widgetMaxLimitItem();
						pls.canvasSidebar();
						pls.stickySidebar();
						pls.ProductLoopQuantityField();
						pls.productQuickView();
						pls.addToCompare();
						$(document).trigger('yith_wcwl_reload_fragments'); /* Fixed wishlist icon afer ajax*/
						$(document.body).trigger('pls_shop_ajax_loading_end');
					});
				}
			}
		});
	}
	
	pls.loadmoreProducts = function(){
		var load_more_products_button = $('.pls-products-load-more');
		$('.pls-products-load-more .pls-load-more').on('click',function(){
			
			var load_more_btn = $(this);
			var page = parseInt(load_more_btn.parent().attr('data-page'));
			var data_attr = load_more_btn.parent().data();
			var	atts = data_attr.attribute;
			var post_wrap = load_more_btn.closest('.pls-element').find('.products-wrap');
            var wrap_id = load_more_btn.closest('.pls-element').attr('id');
			var data = {
				action: 'pls_loadmore_product',
				nonce: pls_options.nonce,
				attr: atts,
				page: page,
			};
			if(load_more_btn.hasClass('loading')){ return false;}
			pls.loadAjaxPost(load_more_btn,data,post_wrap,wrap_id);
		});
		var animationFrame = function () {
			$('.pls-products-load-more a.infinity-scroll').each(function (i, val) {
				var load_more_btn = $(this);
				var page = parseInt(load_more_btn.parent().attr('data-page'));
				var atts = load_more_btn.parent().attr('data-attribute');
				var post_wrap = load_more_btn.closest('.pls-element').find('.products-wrap');
				var wrap_id = load_more_btn.closest('.pls-element').attr('id');
				var bottomOffset = post_wrap.offset().top + post_wrap.height() - $(window).scrollTop();
				if (bottomOffset < window.innerHeight && bottomOffset > 0) {
					
					var page = parseInt(load_more_btn.parent().attr('data-page'));
					if(!load_more_btn.hasClass('pls-loadmore-disabled')){ 
						if(!pls.isPostLoading){
							pls.isPostLoading = true;
							load_more_btn.trigger('click');
						}
					}
				}
			});
		}
		
		var scrollHandler = function () {
			requestAnimationFrame(animationFrame);
		};                    
		$(window).scroll(scrollHandler);		
	}
	
	pls.loadAjaxPost = function( btn, data, element_wrap, parantElement ){
		var load_more_label = btn.parent().data('load_more_label');
		var loading_finished_msg = btn.parent().data('loading_finished_msg');
		var label_txt = '';
		btn.addClass('process');
		if(btn.hasClass('pls-loadmore-disabled')){
			return;
		}
		btn.html('<span class="loading"> '+pls_options.js_translate_text.loading_txt+'</span>');
		$.ajax({
			url: pls_options.ajax_url,
			data: data,
			dataType: 'json',
			method: 'POST',
			success: function(response) {
				var items = $('' + response['html'] + '');
				if ($.trim(response['success']) == 'ok') {
					if ($('.masonry-grid').length > 0) {
												
						 setTimeout(function () {
						  element_wrap.imagesLoaded().masonry().append(items).masonry( 'appended', items).masonry('layout');
						 }, 500);
						 
						 
					}else{
						element_wrap.append(items);
					}
					
					if ($.trim(response['show_bt']) == '0') {
						$('#' +parantElement + ' .pls-load-more').addClass('disabled pls-loadmore-disabled').html(loading_finished_msg);
					} else {
						$('#' +parantElement + ' .pls-load-more').parent().attr('data-page', data['page'] + 1);
						btn.html(load_more_label);
					}
				}
			},
			error: function(data) {
				console.log('ajax error');
			},
			complete: function() {
				pls.isPostLoading = false;
				pls.imagelazyload();
				pls.initMagnaficPopup();
				pls.swatchInLoop();
				pls.ProductLoopQuantityField();
				pls.tooltip();
				pls.productQuickView();
				pls.productSaleCountdown();
				btn.removeClass('process');
			},
		});
	}
	
	pls.tooltip = function () {
		
		if ( ! pls_options.product_tooltip ) { return; }
		
		var tooltip_left = ('.product-style-1:not(.list-view) .pls-whishlist-button a,.product-style-1:not(.list-view) .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,.product-style-1:not(.list-view) .pls-compare-button a,.product-style-1:not(.list-view) .pls-quickview-button a,.product-style-3:not(.list-view) .pls-whishlist-button a,.product-style-3:not(.list-view) .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,.product-style-3:not(.list-view) .pls-compare-button a,.product-style-3:not(.list-view) .pls-quickview-button a');
		/* Bootstrap tooltips */
		$(tooltip_left).tooltip({
			animation: false,
			container: 'body',
			trigger : 'hover',
			placement : !pls.isCheckRTL() ? 'left':'right',
			title: function() {
				return $(this).text();
			}
		});
		
		$('.product-style-2:not(.list-view) .pls-whishlist-button a,.product-style-2:not(.list-view) .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,.product-style-2:not(.list-view) .pls-compare-button a,.product-style-2:not(.list-view) .pls-quickview-button a,.product-style-2:not(.list-view) .pls-product-buttons .pls-cart-button,.product-style-4:not(.list-view) .pls-whishlist-button a,.product-style-4:not(.list-view) .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,.list-view .pls-whishlist-button a,.product-style-2:not(.list-view) .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,.list-view .pls-compare-button a,.list-view .pls-quickview-button a, .pls-tooltip').tooltip({
			animation: false,
			container: 'body',
			trigger : 'hover',
			title: function() {
				if( $(this).find('.added_to_cart').length > 0 ) {
					return $(this).find('.add_to_cart_button').text();
				}
				return $(this).text();
			}
		});
		
	}
	
	pls.productGallerySummarySticky = function () {
		/*
		* Single Product Gallary & Summary Sticky
		*/
		if ( $( window ).width() <= 767 || ( ! $('.pls-product-sticky').length > 0 ) || 'undefined' === typeof ($.fn.stick_in_parent) ) {
			return;
		}
		
		var $wrapper 	= $( '.pls-product-sticky' );
		var $gallery 	= $wrapper.find( '.woocommerce-product-gallery' );
		var $summary 	= $wrapper.find( '.entry-summary' );
		var offset 		= 50;
		
		if ( 0 === $wrapper.length ) {
			return;
		}
		
		setTimeout(function () {
			if( pls_options.sticky_product_image || pls_options.sticky_product_summary ){
				if ( $summary.outerHeight() < $gallery.outerHeight() ) {
					stickySummary();
				} else {
					stickyGallery();
				}
						
				$( window ).resize( function() {
					if ( $( window ).width() <= 767 ) {
						$gallery.trigger('sticky_kit:detach');
						$summary.trigger('sticky_kit:detach');
					}else{
						if ($summary.outerHeight() < $gallery.outerHeight()) {
							stickySummary();
						} else {
							stickyGallery();
						}
					}
				});
			}
		}, 100);
		
		function stickyGallery(){
			
			if( ! pls_options.sticky_product_image ) { return; }
			
			$gallery.stick_in_parent({
				offset_top  : offset,
				sticky_class: 'pls-is-stucked'
			});
		}
		
		function stickySummary(){
			
			if( ! pls_options.sticky_product_summary ){ return; }
			
			$summary.stick_in_parent({
				offset_top  : offset,
				sticky_class: 'pls-is-stucked'
			});
		}
	}
	
	pls.productGallerySlider = function() {
		/*
		 * Product Gallery  & Thumnails slider
		 */
		if ( ! $.isFunction($.fn.slick) ) {
			return;
		}
		
		/* Product Gallery Slider */
		if( $('.woocommerce-product-gallery').find( '.single-product-gallery' ).length > 0 ) {
			$( '.single-product-gallery' ).not( '.slick-initialized' ).slick({
				slidesToShow	: ( 'product-gallery-horizontal' == pls_options.product_gallery_style ) ? 3 : 1,
				slidesToScroll	: 1,
				asNavFor		: ( 'product-gallery-left' == pls_options.product_gallery_style || 'product-gallery-right' == pls_options.product_gallery_style || 'product-gallery-bottom' == pls_options.product_gallery_style ) ? '.single-product-thumbnails' : '',
				fade			: ( 'product-gallery-left' == pls_options.product_gallery_style || 'product-gallery-right' == pls_options.product_gallery_style || 'product-gallery-bottom' == pls_options.product_gallery_style ) ? true : false,
				infinite 		: false,
				adaptiveHeight	: true,
				rtl				: ( pls.isCheckRTL() ) ? true : false,
				responsive		:[
					{
						breakpoint	: 639,
						settings	: {
							slidesToShow 	: 1,
							dots 			: true
						}
					}
				]
			});
		}
		
		/* Product Thumbnails Silder */
		if( $('.woocommerce-product-gallery').find( '.single-product-thumbnails' ).length > 0 ) {
			$( '.single-product-thumbnails' ).not( '.slick-initialized' ).slick({
				slidesToShow	: 4,
				slidesToScroll	: 1,
				asNavFor		: '.single-product-gallery',
				infinite 		: false,
				arrows			: true,
				focusOnSelect	: true,
				vertical		: ( 'product-gallery-left' == pls_options.product_gallery_style || 'product-gallery-right' == pls_options.product_gallery_style ) ? true : false,			
				rtl				: ( 'product-gallery-bottom' == pls_options.product_gallery_style && pls.isCheckRTL() ) ? true : false,
				responsive		:[
					{
						breakpoint	: 639,
						settings	: {
							slidesToShow 	: 4,
							infinite 		: false,
							vertical		: false,
							rtl				: ( pls.isCheckRTL() ) ? true : false,
						}
					}
				]
			});
		}
					
		/* Reset the index of image on product variation */
		$(document).on( 'found_variation', '.variations_form', function( es, variation ) {		
			if ( variation && variation.image && variation.image.src && variation.image.src.length > 1 ) {
				$( '.single-product-gallery, .single-product-thumbnails' ).slick( 'slickGoTo', 0 );
				setTimeout(function () {
					var $product_img = $(document).find( '.pls-quick-view .woocommerce-product-gallery__wrapper  .slick-current.slick-active img' );
					pls.setVariationAttr( $product_img, 'src',
					variation.image.src );
					pls.setVariationAttr( $product_img, 'srcset',
					variation.image.srcset );
					pls.setVariationAttr( $product_img, 'sizes',
					variation.image.sizes );
				}, 300);
			}
		}).on('reset_image', function () {
			$( '.single-product-gallery, .single-product-thumbnails').slick( 'slickGoTo', 0 );
			setTimeout(function () {
				var $product_img = $(document).find( '.pls-quick-view .woocommerce-product-gallery__wrapper  .slick-current.slick-active img' );
				pls.resetVariationAttr( $product_img, 'src' );
				pls.resetVariationAttr( $product_img, 'srcset' );
				pls.resetVariationAttr( $product_img, 'sizes' );
			}, 300);
		});
	};
	
	pls.productImageZoom = function(){
		/*
		 * Single Product image zoom
		 */
		if ( pls_options.product_image_zoom ) {
			var $wc_gallery = $( '.woocommerce-product-gallery' ),
			    zoomTarget = pls_options.product_PhotoSwipe ? $wc_gallery.find( '.woocommerce-product-gallery__image > a' ) : $wc_gallery.find( '.woocommerce-product-gallery__image' ),
				width 		= zoomTarget.children('img').attr( 'data-large_image_width' ),
				/* zoom option */
				zoom_options = $.extend( {
					touch: false
				});
				
			/* On Click Zoom */
			if ('ontouchstart' in document.documentElement) {
				zoom_options.on = 'click';
			}			
			
			setTimeout(function () {
				zoomTarget.parent().trigger('zoom.destroy').children('.zoomImg').remove();
			}, 500);			
			
			/* Zoom */
			if ( 'undefined' != typeof width && zoomTarget.width() < width ) {
				zoomTarget.trigger( 'zoom.destroy' );
				zoomTarget.zoom(zoom_options);
				
				/* show zoom on hover */
				zoomTarget.find(':hover').length && zoomTarget.trigger('mouseover');
			}
		}
	};
	
	pls.productPhotoSwipe = function () {
		/*
		 * Single Product Photo Swipe
		 */
		if ( pls_options.product_PhotoSwipe ) {
			if( $( '.woocommerce-product-gallery' ).length === 0 ){
				return;
			}
			/* var self = this; */
			var $wc_gallery = $( '.woocommerce-product-gallery' );	
			
			setTimeout( function () {
				/* If woocommmerce product gallery is undefined, create it */
				typeof $wc_gallery.data('product_gallery') == 'undefined' && $wc_gallery.wc_product_gallery();
				this.$wc_gallery = $wc_gallery;
				this.wc_gallery = $wc_gallery.data('product_gallery');
			
				/* Remove woocommerce zoom triggers */
				$wc_gallery.children('.woocommerce-product-gallery__trigger').remove();
				
				/* Prevent going to image link */
				$wc_gallery
					.off('click', '.woocommerce-product-gallery__image a')
					.on('click', pls.preventDefault);
								
				$wc_gallery.on('click', '.woocommerce-product-gallery__image a, .woocommerce-product-gallery__image', pls.openPhotoswipe.bind(this));
				$wc_gallery.on('click', '.pls-product-image-full', pls.openPhotoswipe.bind(this));
			}, 100 );
		}else{
			$('.woocommerce-product-gallery__image a').on('click', function(e){
				e.preventDefault();
			});			
		}		
	};
	
	pls.openPhotoswipe = function (e) {
		if (wc_single_product_params.photoswipe_options) {	
			/* Slick slider index */
			var slider = this.$wc_gallery.find('.single-product-gallery').slick("getSlick");
			if (slider) {
				wc_single_product_params.photoswipe_options.index = slider.currentSlide;
			}		

			this.wc_gallery.openPhotoswipe(e);			
			e.stopPropagation();	
		}
	}
	
	pls.productSaleCountdown = function() {
		/*
		 * Product Sale CountDown
		 */
		
		$('.product-countdown,.pls-countdown-timer').each(function(){
			
			var $this 	= $(this),
				template 	= '',
				end_date = $this.data('end-date');			
			
			template = '<span class="days">%-D<span>'+pls_options.js_translate_text.days_text+'</span></span><span class="hour">%H<span>'+pls_options.js_translate_text.hours_text+'</span></span><span class="minute">%M<span>'+pls_options.js_translate_text.mins_text+'</span></span><span class="second">%S<span>'+pls_options.js_translate_text.secs_text+'</span></span>';				
			
			if ( typeof ( $.fn.countdown ) != 'undefined' ) {
				/* initialize  */
				$this.countdown( end_date, function(event) {
					 $(this).html(event.strftime(template));
				});
			}
		});
	};
	
	pls.productReviewLink = function() {
		/*
		 * Scroll Show Product Review Tab
		 */
		
		$('.woocommerce-product-rating .rating-counts').on('click', function (e) {
			$('.woocommerce-review-link').trigger('click');
			 var tabpanel = '#tab-title-reviews';
			 $('html,body').animate({scrollTop:$(tabpanel).offset().top-100}, 750);
		});
	};
		
	pls.getProductSizeChart = function () {
		/*
		 * Get Product Size Chart
		 */	
		$('.pls-ajax-size-chart').on('click', function (e) {
			e.preventDefault();
			 var id = $(this).data('id'); /* get post value */
			 var data = {
				action			: 'pls_ajax_get_size_chart',
				'id'			: id,
				nonce   		: pls_options.nonce,
			};
			var chart_btn = $(this);
			if(chart_btn.hasClass('loading')){
				return false;
			}
			chart_btn.addClass('loading');
			$.ajax({
				type: 'post',
				url: pls_options.ajax_url,
				data: data,
				beforeSend: function (response) {
					
				},
				complete: function (response) {
					chart_btn.removeClass('loading');
				},
				success: function (response) {
					$(this).magnificPopup({
						removalDelay: 500,
						items: {
							src: response,
							type: 'inline'
						},
						callbacks: {
							open: function () {
								var popupWrap = $( '.pls-product-sizechart' );
								popupWrap.addClass('animated fadeInLeft');						
							},							
							beforeClose: function() {
								var popupWrap = $( '.pls-product-sizechart' );
								popupWrap.removeClass('fadeInLeft').addClass('fadeOutRight');
							}, 
							close: function() {
								var popupWrap = $( '.pls-product-sizechart' );
								popupWrap.removeClass('animated fadeOutRight');
								
							}
						},
					}).magnificPopup('open');
				},
			});
			
      });
	}
	
	pls.getAjaxBlock = function () {
		/*
		 * Get Product Size Chart
		 */	
		$('.pls-ajax-block').on('click', function (e) {
			e.preventDefault();
			 var id = $(this).data('id'); /* get block value */
			 var title = $(this).data('title'); /* title */
			 var data = {
				action			: 'pls_ajax_get_block',
				'id'			: id,
				'title'			: title,
				nonce   		: pls_options.nonce,
			};
			var chart_btn = $(this);
			if(chart_btn.hasClass('loading')){
				return false;
			}
			chart_btn.addClass('loading');
			$.ajax({
				type: 'post',
				url: pls_options.ajax_url,
				data: data,
				beforeSend: function (response) {
					
				},
				complete: function (response) {
					chart_btn.removeClass('loading');
				},
				success: function (response) {
					$(this).magnificPopup({
						removalDelay: 500,
						items: {
							src: response,
							type: 'inline'
						},
						callbacks: {
							open: function () {
								var popupWrap = $( '.pls-ajax-blok-content' );
								popupWrap.addClass('animated slideInDown');						
							},							
							beforeClose: function() {
								var popupWrap = $( '.pls-ajax-blok-content' );
								popupWrap.removeClass('slideInDown').addClass('slideOutUp');
							}, 
							close: function() {
								var popupWrap = $( '.pls-ajax-blok-content' );
								popupWrap.removeClass('animated slideOutUp');
								
							}
						},
					}).magnificPopup('open');
				},
			});
			
      });
	}
	
	pls.productQuantityPlusMinus = function() {
		/*
		 * Product Quantity Plus/Minus
		 */
		$( document ).on( 'click', '.quantity .plus, .quantity .minus', function() {
            /* Get values */
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            /* Format values */
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = '1';

            /* Change the value */
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max == currentVal || currentVal > max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( currentVal + parseFloat( step ) );
                }
            } else {
                if ( min && ( min == currentVal || currentVal < min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( currentVal - parseFloat( step ) );
                }
            }

            /* Trigger change event */
            $qty.trigger( 'change' );
        });
	};
	
	pls.productQuickShop = function () {
		/*
		 * Product Buy Now Button click
		 */
		$('body').on('click', '.pls_quick_buy_button', function() {
			
			var $this		= $(this),
			product_id		= $(this).attr('data-pls-product-id'),
			product_type	= $(this).attr('data-product-type'),
			selected 		= $(this).closest('form.cart').find( 'input.pls_quick_buy_product_' + product_id ),
			productform 	= selected.parent(),			
			submit_btn 		= productform.find('[type="submit"]'),
			is_disabled 	= submit_btn.is(':disabled');
			
			if(!$(this).closest('.woocommerce-variation-add-to-cart').hasClass('woocommerce-variation-add-to-cart-disabled')){
				$this.addClass('loading');
			}else{
				is_disabled = true;
			}
			
			if ( is_disabled ) {
				$('html, body').animate({
					scrollTop: submit_btn.offset().top - 200
				}, 900);
			} else {
				if(!$this.hasClass('disable')){
					productform.append('<input type="hidden" value="true" name="pls_quick_buy" />');
				}
				if ( pls_options.enable_add_to_cart_ajax ) {
					$('.single_add_to_cart_button').addClass('quick-buy-proceed');
				}
				productform.find('.single_add_to_cart_button').trigger('click');
			} 
		});
		
		$('form.cart').change(function () {
			var is_submit_disabled = $(this).find('[type="submit"]').is(':disabled');
			if ( is_submit_disabled ) {
				$('.pls_quick_buy_button').attr('disabled', 'disable');
			} else {
				$('.pls_quick_buy_button').removeAttr('disabled');
			}
		});
	}
	
	pls.productBoughtTogetherInit = function(){ 
		/* Procut Bought Together */
		
		if ( pls.$body.find('.pls-bought-together-products').length === 0 ) {
			return;
		}
		
		var self = this;
		/* check box click */
		$('body').on('click', '.pls-bought-together-products .product-checkbox input[type=checkbox]', function() {
			if ($(this).is(":checked")) {
				$(this).closest('.pls-product-inner').removeClass('pls-disable-product');				
			}else{
				$(this).closest('.pls-product-inner').addClass('pls-disable-product');
			}
			self.productBoughtTogetherChangeEvent();
		});
		/* check all */
		self.productBoughtTogetherCheckAllItems();
		/* add to cart */
		self.productBoughtTogetherAddToCart();
		
		$( 'body' ).on( 'found_variation', function( event, variation ) {
			$('.pls-bought-together-products .current-item .item-price').each(function() {				
				if( $(this).data( 'type' ) == 'variable' ) {
					$(this).data( 'itemprice', variation.display_price );
					$(this).html(self.pls_woo_formated_price(variation.display_price));
					self.productBoughtTogetherChangeEvent();
				}
			});
		});
	}
	pls.productBoughtTogetherChangeEvent = function() {
		var self = this;
		$('.add-items-to-cart').addClass('loading');
		
		var total_price = self.product_bought_together_get_total_price();
		var addon_total_price = self.product_addons_get_total_price();
		var total_addon = self.product_bought_together_product_count();
		if(total_addon){
			$('.add-items-to-cart').removeAttr("disabled");
		}else{
			$('.add-items-to-cart').attr("disabled", true);
		}
		$( '.addons-item .addon-count' ).html( total_addon );
				$( '.addons-item span.items-price' ).html( self.pls_woo_formated_price(addon_total_price) );
				$( '.items-total span.total-price' ).html( self.pls_woo_formated_price(total_price) );
		$('.add-items-to-cart').removeClass('loading');
	}
	
	pls.pls_woo_formated_price = function(number){
		var self = this;
		return self.pls_formated_price(number, pls_options.price_thousand_separator,
		pls_options.price_decimal_separator, pls_options.price_decimals, 
		pls_options.currency_symbol,pls_options.price_format);
	}
	
	pls.pls_formated_price = function(number, thousand_sep, decimal_sep, tofixed, symbol, woo_price_format){
		  var before_text = '';
        var after_text = '';
        number = number || 0;
        tofixed = !isNaN(tofixed = Math.abs(tofixed)) ? tofixed : 2;
        symbol = symbol !== undefined ? symbol : "$";
        thousand_sep = thousand_sep || ",";
        decimal_sep = decimal_sep || ".";
        var negative = number < 0 ? "-" : "",
            i = parseInt(number = Math.abs(+number || 0).toFixed(tofixed), 10) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        
        symbol = '<span class="woocommerce-Price-currencySymbol">' + symbol + '</span>';
        
        switch (woo_price_format) {
            case '%1$s%2$s':
                /* left */
                before_text += symbol;
                break;
            case '%1$s %2$s':
                /* left with space */
                before_text += symbol + ' ';
                break;
            case '%2$s%1$s':
                /* right */
                after_text += symbol;
                break;
            case '%2$s %1$s':
                /* right with space */
                after_text += ' ' + symbol;
                break;
            default:
                /* default */
                before_text += symbol;
        }       
        
        var woo_price_return = before_text +
            negative + (j ? i.substr(0, j) + thousand_sep : "" ) +
            i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand_sep) +
            (tofixed ? decimal_sep + Math.abs(number - i).toFixed(tofixed).slice(2) : "") +
            after_text;
        
        woo_price_return = '<span class="woocommerce-Price-amount amount">' + woo_price_return + '</span>';
        
        return woo_price_return;
	}
	
	pls.productBoughtTogetherCheckAllItems = function(){
		var self = this;
		$('body').on('click', '.check-all-items', function(){
			$('.pls-together-product:checkbox').not(this).prop('checked', this.checked);
			if ($(this).is(":checked")) {
				$('.pls-together-product:checkbox').prop('checked', true);  
			} else {
				$('.pls-together-product:checkbox').prop("checked", false);
			}

			self.productBoughtTogetherChangeEvent();
		});
	}
	
	pls.BoughtTogetherIsVariationProduct = function(){
		
		var product_type = $('.pls-bought-together-products .current-item .item-price').data('type');
		if( product_type == 'variable'){
			return true
		}
		return false;
	}
	
	pls.BoughtTogetherCurrentProductid = function(){
				
		var product_id = $('.pls-bought-together-products .current-item .item-price').data('id');
		
		return 	product_id;
	}
	
	pls.BoughtTogetherVariationAvailable = function(){
		if( $(".single_add_to_cart_button").length === 0 || $(".single_add_to_cart_button").hasClass("disabled") || $(".single_add_to_cart_button").hasClass("wc-variation-is-unavailable") ) {
			return false;
		}
		return true;
	}
	
	pls.productBoughtTogetherAddToCart = function(){
		var self = this;
		$('body').on('click', '.add-items-to-cart:not(.loading)', function(e){
			e.preventDefault();
			
			var is_variation_product = pls.BoughtTogetherIsVariationProduct();
			var variation_product_id = pls.BoughtTogetherCurrentProductid();
			
			if(is_variation_product && pls.BoughtTogetherVariationAvailable() === false){
				alert(pls_options.js_translate_text.variation_unavailable);
				return;
			}
			
			var self_this = $(this);
			self_this.addClass('loading');
			
			var all_product_ids = self.product_bought_together_get_checked_product_ids();
			var msg='';
			if( all_product_ids.length === 0 ) {
				msg = pls_options.bought_together_error;
			} else {
				
				setTimeout(function () {
					for (var i = 0; i < all_product_ids.length; i++ ) {
						if( is_variation_product && all_product_ids[i] == variation_product_id ){							
							var variation_id  = $('.variations_form .variations_button').find('input[name^=variation_id]').val();
							var variation = {};
							if( $( '.variations_form' ).find('select[name^=attribute]').length ) {
								$( '.variations_form' ).find('select[name^=attribute]').each(function() {
									var attribute = $(this).attr("name");
									var attributevalue = $(this).val();
									variation[attribute] = attributevalue;
								});
							} else {

								$( '.variations_form' ).find('.select').each(function() {
									var attribute = $(this).attr("data-attribute-name");
									var attributevalue = $(this).find('.selected').attr('data-name');
									variation[attribute] = attributevalue;
								});

							}
							$.ajax({
								type: "POST",
								async: false,
								url: pls_options.ajax_url,
								data: {
									'product_id': all_product_ids[i],
									'variation_id': variation_id, 
									'variation': variation,
									'action': 'pls_all_add_to_cart'
								},
								success : function( response ) {
									self.product_bought_together_refresh_fragments( response );
								}
							}); 
						} else {
							$.ajax({
								type: "POST",
								async: false,
								url: pls_options.ajax_url,
								data: {
									'product_id': all_product_ids[i],
									'action': 'pls_all_add_to_cart'
								},
								success : function( response ) {
									self.product_bought_together_refresh_fragments( response );
								}
							}); 
						}
					}
					var miniCartSidebar = $('.pls-minicart-slide');
					var closeSidebar 	= $('.pls-mask-overaly');
					if ( ! miniCartSidebar.hasClass('opened') ) {
						miniCartSidebar.addClass('opened');
						closeSidebar.addClass('opened');
						self.initNanoScroller();
					}
					self_this.removeClass('loading');
				}, 300); 
				
			}
			if(msg != ''){
				$( '.pls-wc-message' ).html(msg).show(100);
				self_this.removeClass('loading');
				setTimeout(function () {
					$( '.pls-wc-message' ).slideUp(500);
					
				}, 3000);				
			}
			
		});
	}
	
	pls.product_bought_together_get_total_price = function(){
		var tprice = 0,itemprice =0;
		itemprice = $('.items-total-price .item-price').data('itemprice');
		tprice = parseFloat(itemprice);
		$('.pls-bought-together-products .product-checkbox input[type=checkbox]').each(function() {
			if( $(this).is(':checked') ) {
				tprice += parseFloat( $(this).data( 'price' ) );
			}
		});
		return tprice;
	}
	pls.product_addons_get_total_price = function(){
		var tprice = 0;
		
		$('.pls-bought-together-products .product-checkbox input[type=checkbox]').each(function() {
			if( $(this).is(':checked') ) {
				tprice += parseFloat( $(this).data( 'price' ) );
			}
		});
		return tprice;
	}
	pls.product_bought_together_product_count = function(){
		var pcount = 0;
		$('.pls-bought-together-products .product-checkbox input[type=checkbox]').each(function() {
			if ($(this).is(':checked')) {
				pcount++;
			}
		});
		return pcount;
	}
	
	/* get checked product ids */
	pls.product_bought_together_get_checked_product_ids = function(){
		var pids = [],pidd;
		pidd = $('.items-total-price .item-price').data('id');
		
		pids.push( pidd);
		$('.pls-bought-together-products .product-checkbox input[type=checkbox]').each(function() {
			if( $(this).is(':checked') ) {
				pids.push( $(this).data( 'id' ) );
			}
		});
		return pids;
	}
	
	/* get checked product ids */
	pls.product_bought_together_refresh_fragments = function(response){
		var frags = response.fragments;

            /* Block fragments class */
            if ( frags ) {
                $.each( frags, function( key ) {
                    $( key ).addClass( 'updating' );
                });
            }
            if ( frags ) {
                $.each( frags, function( key, value ) {
                    $( key ).replaceWith( value );
                });
            }
	}
	
	pls.wooProductTabsAccordian = function(){
		if( ( $('.woocommerce-tabs.accordion-layout').length > 0 ) || ( $('.woocommerce-tabs.tabs-layout').length > 0 ) ){
			
			var $accordion = $('.tab-content-wrap');
			var hash  = window.location.hash;
			var url   = window.location.href;
		
			if ( hash.toLowerCase().indexOf( 'comment-' ) >= 0 || hash === '#reviews' || hash === '#tab-reviews' ) {
				$accordion.find('.title-reviews').addClass('open');
			} else if ( url.indexOf( 'comment-page-' ) > 0 || url.indexOf( 'cpage=' ) > 0 ) {
				$accordion.find('.title-reviews').addClass('open');
			}else if ( hash === '#tab-additional_information' ) {
				$accordion.find('.title-additional_information').addClass('open');
			}  else {
				$accordion.find('.accordion-title').first().addClass('open');
			}
			$accordion.on('click', '.accordion-title', function( e ) {
				e.preventDefault();
				$(this).parent().siblings().find('.woocommerce-Tabs-panel').slideUp('fast');
				$(".accordion-title").not($(this)).removeClass("open");
				$(this).toggleClass("open").next().slideToggle('fast');
			});
			$(document).on('click', 'a.woocommerce-review-link', function(e) {
				$accordion.find('.accordion-title').removeClass("open");
				$accordion.find('.title-reviews').addClass("open");
			});
		}
	}
	
	pls.wooProductTabsToggle = function(){
		if($('.woocommerce-tabs.toggle-layout').length > 0){
			var $accordion = $('.tab-content-wrap');
			
			$accordion.find('.accordion-title').addClass('open');
			$accordion.find('.woocommerce-Tabs-panel').css("display", "block");
			$accordion.on('click', '.accordion-title', function( e ) {
				e.preventDefault();				
				var accordion = $(this);
				var accordionContent = accordion.next('.woocommerce-Tabs-panel');				
				accordion.toggleClass("open");
				accordionContent.slideToggle(250);				
			});
			$(document).on('click', 'a.woocommerce-review-link', function(e) {
				e.stopPropagation();
			});
		}
	}
	
	pls.wcfm_vendor = function(){
		//*******************************************************************
		//* WCFM Vendor
		//*******************************************************************/
		if ($('#_pls_product_ids').length <= 0) {
            return false;
        }
        if (typeof $wcfm_product_select_args === 'undefined') {
            return false;
        }

        $('#_pls_product_ids').select2($wcfm_product_select_args);
	};
	
	pls.MiniCartUpdateQuantity = function(){
		/* Update Minicart item quantity */
		$(document).on('change', '.woocommerce-mini-cart .qty', function(){
			var quantity = parseFloat($(this).val());
			var max = parseFloat($(this).attr('max'));
			if( max !== 'NaN' && max < quantity ){
				quantity = max;
				$(this).val( max );
			}
			
			$(this).parents('.woocommerce-mini-cart-item').addClass('loading');
			var cart_item_key = $(this).parents('.woocommerce-mini-cart-item').attr('data-cart_item_key');
			
			var data = {
				quantity: quantity,
				cart_item_key: cart_item_key,
				nonce: pls_options.nonce,
				action: 'pls_update_cart_widget_quantity',
			};
			$.ajax({
				url: pls_options.ajax_url,
				data: data,
				dataType: 'json',
				method: 'POST',
				success: function (response) {
					if( !response ){
						return;
					}
					$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash ] );
				}				
			});
		});
	};
	
	pls.autoCartUpdate = function(){
		if( ! pls_options.cart_auto_update || $('.woocommerce-cart-form').length <= 0){
			return;
		}
		$(document).on('change','.woocommerce-cart-form .product-quantity',function(e) {
			$("[name='update_cart']").removeAttr('disabled');
			$("[name='update_cart']").trigger("click"); 
        });
	};
	
	pls.checkoutUpdateQuantity = function(){
		
		/* Update Minicart item quantity */
		
		if( ! pls_options.checkout_product_quantity || $('.woocommerce-checkout-review-order-table').length <= 0){
			return;
		}
		
		$(document).on('change', '.woocommerce-checkout-review-order-table .qty', function(){
			var $form = $( 'form.checkout' );
			var form_data =  $( 'form.checkout' ).serialize();
			$(".woocommerce-checkout-payment, .woocommerce-checkout-review-order-table").block({
                message: null,
                overlayCSS: {
                    opacity: 0.6
                }
            })						
			var data = {
				action 		: 'pls_update_checkout_quantity',
				form_data 	: form_data,
				nonce		: pls_options.nonce,
			};
			$.ajax({
				url: pls_options.ajax_url,
				data: data,
				dataType: 'json',
				method: 'POST',
				success: function (response) {
					if( !response ){
						location.reload();
					}
					$.each( response.fragments, function( key, value ) {
						$( key ).replaceWith( value );
					});			
					$( 'body' ).trigger( 'update_checkout' );
				},
				error: function (jqXHR, exception) {
					console.log("Error: Something went wrong.");
					$(".woocommerce-checkout-payment, .woocommerce-checkout-review-order-table").unblock();
				}
			});
		});
	};
	
	pls.getVisitorCount = function(){
		
		var min,max,delay;
		var visitor_elm = $('.pls-visitor-change');
		if(  visitor_elm.length <= 0){
			return;
		}
		min 	= parseInt( visitor_elm.data('min') );
		max 	= parseInt( visitor_elm.data('max') );
		delay 	= parseInt( visitor_elm.data('delay') );
		setInterval(function() {
		  var variation = plsGetRandomInt(min, max );
		  visitor_elm.find('.product-visitor-count').html(variation);
		}, delay * 1000 );
		function plsGetRandomInt(min, max) {			
			let difference = max - min;
			let rand = Math.random();
			rand = Math.floor( rand * difference);
			rand = rand + min;
			return rand;
		}
	}
	
	pls.askQuestionsForm = function(){
		
		var ask_questions_form = $('.pls-ask-questions-ajax');
		if(  ask_questions_form.length <= 0){
			return;
		}
		$('.pls-ask-questions').magnificPopup({
			type: 'inline',
			preloader: false,			
			removalDelay: 500,
			items: {
				src: '#pls-ask-questions-popup' ,					
			},
			/* mainClass: 'animated bounceIn', */
			callbacks: {
				open: function() {
					var closeSidebar 	= $('.pls-mask-overaly');
					var mobileSidebar = $('.pls-mobile-menu');
					closeSidebar.removeClass('opened');
					mobileSidebar.removeClass('opened');
					$('.pls-ask-questions-popup').addClass('animated slideInDown');
				},
				beforeClose: function() {
						var popupWrap = $( '.pls-ask-questions-popup' );
						popupWrap.removeClass('slideInDown').addClass('slideOutUp');
					}, 
				close: function() {
					$('.pls-ask-questions-popup').removeClass('animated slideOutUp');
				}
			} 
		});
		
	}
	
	pls.plsEqualTabsHeight = function(){
		//*******************************************************************
		//* Equal tabs height
		//*******************************************************************/
		setTimeout(function () {
			$('.products-tab-content').each(function () {
				var $this = $(this);
				if ($this.find('.tab-content').length) {
					$this.find('.tab-content').css({
						'height': 'auto'
					});
					var elem_height = 0;
					$this.find('.tab-content').each(function () {
						var this_elem_h = $(this).height();
						if (elem_height < this_elem_h) {
							elem_height = this_elem_h;
						}
					});
					$this.find('.tab-content').height(elem_height);
				}
			});
		}, 4000);
	};
	
	pls.plsAjaxtab = function() {
		/* Ajax tabs */
		var category_tab_cache = [];
		$(document).on('click', '.products-tabs.enable-ajax .nav-tabs a', function (e) {			
			e.preventDefault();			
			var $_this 		= $(this),			
			data_attr 		= $_this.parent().data(),
			atts 			= data_attr.attribute,
			data_href 		= $_this.data('href'),
			$tab_content 	= $_this.closest('.pls-element').find('.tab-content'),
			$swiper_content 	= $_this.closest('.pls-element').find('.tab-content .pls-slider'),
			swiper_obj 	= $swiper_content.attr("data-obj_instance"),
			element_wrap 	= $_this.closest('.pls-element').find('.tab-content .products');
			
			if(category_tab_cache[data_href] != undefined ){
				$tab_content.addClass('loading');
				var items = category_tab_cache[data_href];
				if( swiper_obj !== undefined ){
					$tab_content.find('.pls-slider-navigation').remove();
					$tab_content.find('.pls-slider-pagination').remove();
					pls_sliders[swiper_obj].destroy(true, true);
				}				
				element_wrap.html(items).fadeIn(600);
				$tab_content.removeClass('loading');
				pls.imagelazyload();
				pls.initMagnaficPopup();
				pls.swatchInLoop();
				pls.ProductLoopQuantityField();
				pls.tooltip();
				pls.productQuickView();
				pls.productSaleCountdown();
				pls.plsElementorSwiperSlider();
				return;
			}
			var data = {
					attr: atts,
					nonce: pls_options.nonce,
					action: 'pls_category_tab_product',
				};
			if($_this.hasClass('process')){ return false;}
			$_this.addClass('process');
			$tab_content.addClass('loading');
			$.ajax({
				url: pls_options.ajax_url,
				data: data,
				dataType: 'json',
				method: 'POST',
				success: function(response) {
					var items_res = $('' + response['html'] + '');
					var items = items_res.find('.products').html();
					category_tab_cache[data_href] = items;
					if( swiper_obj !== undefined ){
						$tab_content.find('.pls-slider-navigation').remove();
						$tab_content.find('.pls-slider-pagination').remove();
						pls_sliders[swiper_obj].destroy(true, true);
					}
					if ($.trim(response['success']) == 'ok') {						
						element_wrap.html(items).fadeIn(600);						
					} 
				},
				error: function(data) {
					console.log('ajax error');
				},
				complete: function() {
					pls.isPostLoading = false;
					pls.imagelazyload();
					pls.initMagnaficPopup();
					pls.swatchInLoop();
					pls.ProductLoopQuantityField();
					pls.tooltip();
					pls.productQuickView();
					pls.productSaleCountdown();
					pls.plsElementorSwiperSlider();
					$_this.removeClass('process');
					$tab_content.removeClass('loading');
				},
			});
		} );
	}
	
	pls.plsResponsiveTab = function() {
		/* Responsive tabs */
		$(document).on('click', '[data-trigger="tab"]', function (event) {
			var href = $( this ).attr( 'href' );
			event.preventDefault();
			$( '[data-toggle="tab"][href="' + href + '"]' ).trigger( 'click' );
		} );

	}
	
	pls.plsProgressbar = function() {
		/*
		* Progress Bar
		*/		
		$('.progress .progress-bar').each(function(){
			if (typeof ($.fn.waypoint) != 'undefined') {
				$(this).waypoint(function(){
					var width = $(this).attr('data-value');
					$(this).animate({
							width: width+'%'
						},
						{
							duration: 1000,
							easing: 'swing'
						}
					);
				}, { offset: '100%', triggerOnce: true });
			}
		});	
	}
	
	pls.plsCounterUp = function() {
		/*
		* Counter Up
		*/	
		if ( ! $.isFunction($.fn.counterUp) ) {
			return;
		}
		jQuery('.counter').counterUp({
            delay: 20,
            time: 2000
        });
	}
	
	pls.imageGaleryMasonry = function (){
		
		/*
		* Image Gallery Masonry
		*/
		
		if ( ! $('.pls-image-gallery.image-gallery-masonry-grid').length > 0 ) return;
		var $layoutMode='masonry';
		
		if($( '.pls-image-gallery.image-gallery-masonry-grid' ).length){
			$( '.pls-image-gallery.image-gallery-masonry-grid' ).each(function(){
				
				var image_gallery_container = $( this );
				/* initialize Masonry after all images have loaded */
                image_gallery_container.imagesLoaded(function() {
					image_gallery_container.isotope({
						itemSelector: '.pls-gallery',
						isOriginLeft: ! $('body').hasClass('rtl'),
						layoutMode: $layoutMode
					});
				 });
			});			
		}		
	};
	
	/*
	 * Document ready
	 */ 
	$(document).ready(function(){ 
		pls.init();		
    });
	
	$(document).ready(function(){ 
		$(window).on('vc_reload', function () {
           pls.init();            
        });	
    });
	
	$( window ).on('load', function () {
		var pls_pre_loader = $( '.pls-site-preloader' );
		if ( pls_pre_loader.length ) {
            pls_pre_loader.fadeOut( 800 );
		}
	});
	
	var ElementorCounterUp = function($scope, $) {
		var $this = $scope.find('.counter');
		$this.counterUp({
            delay: 20,
            time: 2000
        });
	};
	
	var ElementorImaeGalleryMasonary = function($scope, $) {	
		var $layoutMode = 'masonry';
		var image_gallery_container = $scope.find('.image-gallery-masonry-grid');
		
		if(image_gallery_container.length){
			/* initialize Masonry after all images have loaded */
			image_gallery_container.imagesLoaded(function() {
				image_gallery_container.isotope({
					itemSelector: '.pls-gallery',
					isOriginLeft: ! $('body').hasClass('rtl'),
					layoutMode: $layoutMode
				});
			});	
		}		
	};
	
	var Elementorcountdown = function($scope, $) {
		var $this = $scope.find('.pls-countdown-timer'),
			template 	= '',
			end_date = $this.data('end-date');
			
		if( $this.data('countdown-style') == 'countdown-box' ) {
			template = '<span class="days">%-D<span>'+pls_options.js_translate_text.days_text+'</span></span><span class="hour">%H<span>'+pls_options.js_translate_text.hours_text+'</span></span><span class="minute">%M<span>'+pls_options.js_translate_text.mins_text+'</span></span><span class="second">%S<span>'+pls_options.js_translate_text.secs_text+'</span></span>';
		}else{
			template = '%-D'+pls_options.js_translate_text.sdays_text+':%H'+pls_options.js_translate_text.shours_text+':%M'+pls_options.js_translate_text.smins_text+':%S'+pls_options.js_translate_text.ssecs_text;
		}
		
		/* initialize  */
		$this.countdown( end_date, function(event) {
			 $(this).html(event.strftime(template));
		});
	};
	
	pls.plsElementorSwiperSlider = function() {
		/*
		* Swiper Slider
		*/
		setTimeout( function(){
			$( '.pls-slider' ).each( function ( index, element ) {
				
				var $selector 	= $(this),
				slider_index 	= 'swiper-'+index,
				$sliderWrapper 	= $selector.find( '.swiper-wrapper' ),
				numItems 		= $sliderWrapper.children().length,				
				$obj_instance 	= $selector.attr( "data-obj_instance", slider_index ),
				sliderArg 		= ( $sliderWrapper.attr('data-slider_options') ) ? $sliderWrapper.data('slider_options') : {},
				touchMove = ( sliderArg.slider_touchDrag ) ? true : false,
				touchMove_mobile = ( sliderArg.slider_touchDrag_mobile ) ? true : false,
				options = {
					loop: false,
					//cssMode: true,
					allowTouchMove:touchMove,
					autoHeight:( sliderArg.slider_autoHeigh ) ? true : false,
					rewind:( sliderArg.slider_rewind ) ? true : false,
					slidesPerView: parseInt(sliderArg.slides_to_show),
					slidesPerGroup: parseInt(sliderArg.slides_to_scroll),
					spaceBetween: parseInt(sliderArg.slider_spaceBetween),
					breakpoints: {
						0: {
							slidesPerView: parseInt( sliderArg.slides_to_show_mobile ),
							allowTouchMove: touchMove_mobile,
						},
						768: {
							slidesPerView: parseInt( sliderArg.slides_to_show_tablet ),
							allowTouchMove: touchMove_mobile,
						},
						1025: {
							slidesPerView: parseInt( sliderArg.slides_to_show ),
						},
					}
				};
				
				if( sliderArg.slider_loop === true ){
					options.loop = ( numItems > parseInt(sliderArg.slides_to_show)) ? sliderArg.slider_loop : false;
				}					
				if( sliderArg.slider_autoplay === true ){
					options.autoplay = {
						delay: parseInt( sliderArg.slider_autoplay_speed ),
						disableOnInteraction: false,
						pauseOnMouseEnter: sliderArg.slider_pause_on_hover
					}
				} 
				options.speed = parseInt( sliderArg.slider_autoplay_speed );
				
				if( !$selector.parent().hasClass('pls-slider-wrapper') ) {
					$selector.wrap('<div class="pls-slider-wrapper"/>');
				}				
				if($sliderWrapper.hasClass('product-style-3')){
					$sliderWrapper.closest('.pls-slider-wrapper').addClass('product-layout-3');
				}
				var $selectorWrap = $selector.closest('.pls-slider-wrapper');
				
				/* Add Pagination */
				if ( sliderArg.slider_pagination === true && 0 === $selectorWrap.find('> .pls-slider-pagination').length) {
					$selector.addClass('swiper-paginataion');
					$selector.after('<div class="pls-slider-pagination"></div>');
					options.pagination = {
						el: $selectorWrap.find('.pls-slider-pagination')[0],
						clickable: true
					}
				}

				/* Add Navigation */
				if (sliderArg.slider_navigation === true && 0 === $selectorWrap.find('> .pls-slider-navigation').length) {
					$selector.after('<div class="pls-slider-navigation"><div class="pls-slider-prev"></div><div class="pls-slider-next"></div></div>');
					options.navigation = {
						prevEl: $selectorWrap.find('.pls-slider-prev')[0],
						nextEl: $selectorWrap.find('.pls-slider-next')[0],
					}
				}
				
				$selector.addClass(slider_index);
				var $swiperObj = new Swiper( '.'+slider_index, options );
				if( pls.isCheckRTL() ){
					$swiperObj.changeLanguageDirection('rtl');
				}
				$swiperObj.on('transitionEnd', function() {
					pls.imagelazyload();
				});
				pls_sliders[slider_index] = $swiperObj;
			});
		}, 300 );
		
		/* function add_slider_overlayclass(){
			$('.pls-slider-wrapper').mouseenter(function(){
				var slider_elemnt = $(this).find('.swiper-wrapper');
				if( slider_elemnt.hasClass('product-style-3') ){
					var slider_elemnt2 = $(this).closest('.pls-slider-wrapper');
					slider_elemnt2.addClass('overlay');
				}
			}).mouseleave(function(){
				//var slider_elemnt = $(this).find('.pls-slider-wrapper');
				if( $(this).hasClass('overlay') ){
					$(this).removeClass('overlay');
				}
				
			});
		}
		setTimeout(function() { add_slider_overlayclass() }, 1000 );
		 */
		/* function add_slider_overlayclass(){
			$('.swiper .pls-product-inner').mouseenter(function(){
				var slider_elemnt = $(this).closest('.pls-slider-wrapper');
				slider_elemnt.addClass('overlay');
			}).mouseleave(function(){
				var slider_elemnt = $(this).closest('.pls-slider-wrapper');
				slider_elemnt.removeClass('overlay');
			});
		}
		setTimeout(function() { add_slider_overlayclass() }, 1000 ); */
		
	}
	
	pls.BackgroundParallax = function(){
		/*
		* Parallax Background
		*/		
		if ($(window).width() <= 1024) {
			return;
		}
		$('.pls-parallax-background').each(function() {			
			$(this).parallax("50%", 0.3);
		});
	};
	
	pls.accordion = function(){
		if($('.pls-accordion').length > 0 ){
			var $accordion = $('.pls-accordion');			
			$('.pls-accordion').each(function () {
				var $element = $(this).find('.pls-accordion-item > .card-header .card-link');
				$element.off('click').on('click', function(e) {
					console.log('click');
					e.preventDefault();
					var style = $(this).attr('data-style');
					if( $(this).hasClass("open") ) {
						$(this).removeClass("open");
						$(this).closest('.card ').find('.collapse').slideUp(300);
					}else{						
						if( style != 'toggle'){
							$(this).closest('.card ').siblings().find('.card-link').removeClass("open");
							$(this).closest('.card ').siblings().find('.collapse').slideUp(300);
						}
						$(this).addClass("open");
						$(this).closest('.card ').find('.collapse').slideDown(300);
					}
				});
			});
		} 
	}
	/* Elementor Elements*/
	$( window ).on( 'elementor/frontend/init', function () {
		if (!elementorFrontend.isEditMode()) {
			return;
		}
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-accordion.default', pls.accordion)
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-counter.default', ElementorCounterUp)
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-countdown.default', Elementorcountdown);
		
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-image-gallery.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
			ElementorImaeGalleryMasonary($wrapper, $);
		});
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-progress-bar.default', function($wrapper, $) {
			pls.plsProgressbar();
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-testimonials.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-team.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-banner-slider.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-product-categories-thumbnail.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-product-categories.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-custom-categories.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-widget.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-product-brands.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});		
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-grid-slider.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
			pls.productSaleCountdown();
			pls.tooltip();
			pls.imagelazyload();
			pls.productSwatch();
			pls.productQuickView();
			pls.addToCompare();
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-hot-deal-products.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
			Elementorcountdown($wrapper, $);
			pls.productSaleCountdown();
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-and-categories_box.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-recently-viewed.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-with-banner.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-products-tabs.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-blog.default', function($wrapper, $) {
			pls.MasonryGrid();
		});		
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-blog-slider.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-wcfm-vendors.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-dokan-vendors.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-wcmp-vendors.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-wc-vendors.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
		elementorFrontend.hooks.addAction('frontend/element_ready/pls-instagram.default', function($wrapper, $) {
			pls.plsElementorSwiperSlider($wrapper, $);
		});
		
	});
})(jQuery);