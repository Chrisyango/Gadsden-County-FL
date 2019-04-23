/*-----------------------------------------------------------------------------------

	Theme Name: Gadsden County, FL
	Front-End Developer: Chris Yang
	Author Design: Kat Wiard
	Author URI: http://www.revize.com/
	Date: February 11, 2019

-----------------------------------------------------------------------------------*/

(function($) {

	'use strict';

	var $window = $(window),
		$body = $('body');

	/*!
	 * IE10 viewport hack for Surface/desktop Windows 8 bug
	 * Copyright 2014-2015 Twitter, Inc.
	 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
	 */

	// See the Getting Started docs for more information:
	// http://getbootstrap.com/getting-started/#support-ie10-width
	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement('style');
		msViewportStyle.appendChild(
			document.createTextNode(
			  '@-ms-viewport{width:auto!important}'
			)
		); document.querySelector('head').appendChild(msViewportStyle);
	}

	/*
	* E-Notify Auto submit
	*/
	$.urlParam=function(n){var e=new RegExp("[?&]"+n+"=([^]*)").exec(window.location.href);return null==e?null:e[1]||0};
	var $enotify = $('iframe[src*="/revize/plugins/notify/notify.jsp"]');
	if( $enotify.length > 0 ){
		var emailStr = $.urlParam("email");
		if( emailStr != null ){
			$enotify.attr("src", $enotify.attr("src") + "&email=" + emailStr);
		}
	}

	// RZ Class
	if(typeof RZ !== "undefined"){
	 if(RZ.login){
	  $body.addClass("user-logged-in");
	 } else{
		 $body.addClass("user-not-logged-in");
	 }
	}

	// Inner Menu
	$('.inner-menu').on('click', function(e){
		$('ul', this).stop().slideToggle(300);
		$('.subheader', this).hasClass('cross') ? $('.subheader', this).removeClass('cross') : $('.subheader', this).addClass('cross');
	})

	// Search Toggle
	$('#search-toggle').on('click',function(e){
		$('#search').stop().fadeToggle(200);
		$(this).toggleClass('fa-search fa-close');
	});

	$('#search-toggle-mobile').on('click',function(e){
		$('#search').stop().fadeToggle(200);
		$(this).toggleClass('fa-search fa-close');
	});

	// Navigation Toggle
	$("#nav-toggle").on("click", function(){
		$("#nav").stop().slideToggle();
		$(this).toggleClass("active");
	});

	// Menu Arrows
	$("#nav > li:has(ul)").addClass('first-parent').children("a,span").append('<i class="fa fa-angle-down down-arrow">');

	// Menu Toggles
	$("#nav >li:has(ul)").children("a,span").append('<i class="fa fa-angle-down toggle">');
	$("#nav li li:has(ul)").children("a,span").append('<i class="fa fa-angle-down toggle2">');

	function addNavClass() {
		if ($window.width() < 992) {
			$("#nav >li>ul").addClass('first-level');
			$("#nav  li ul ul").addClass('second-level');

		} else{
				$("#nav >li>ul").removeClass('first-level').css('display','');
				$("#nav  li ul ul").removeClass('second-level').css('display','');
		}
	}
	addNavClass();
	$window.resize(addNavClass);
	$('.toggle').on('click keydown', function(e) {
		if (e.keyCode === 13 || e.type === 'click') {
			e.preventDefault();
			if ($(this).parent().next('.first-level').is(':visible')) {
				$(this).parent().next('.first-level').slideUp();
			} else {
				$('.first-level').slideUp('slow');
				$(this).parent().next('.first-level').slideToggle();
			}
		}
	});

	$('.toggle2').on('click keydown', function(e) {
		if (e.keyCode === 13 || e.type === 'click') {
			e.preventDefault();
			if ($(this).parent().next('.second-level').is(':visible')) {
				$(this).parent().next('.second-level').slideUp();
			} else {
				$('.second-level').slideUp('slow');
				$(this).parent().next('.second-level').slideToggle();
			}
		}
	});

	// Add Class To Nav Items + Icons if Needed
	$('#nav> li:nth-child(1) >a, #nav> li:nth-child(1) >span').addClass('nav-item-one').prepend();
	$('#nav> li:nth-child(2) >a, #nav> li:nth-child(2) >span').addClass('nav-item-two').prepend();
	$('#nav> li:nth-child(3) >a, #nav> li:nth-child(3) >span').addClass('nav-item-three').prepend();
	$('#nav> li:nth-child(4) >a, #nav> li:nth-child(4) >span').addClass('nav-item-four').prepend();
	$('#nav> li:nth-child(5) >a, #nav> li:nth-child(5) >span').addClass('nav-item-five').prepend();
	$('#nav> li:nth-child(6) >a, #nav> li:nth-child(6) >span').addClass('nav-item-six').prepend();
	$('#nav> li:nth-child(7) >a, #nav> li:nth-child(7) >span').addClass('nav-item-seven').prepend();

	// Flyout
	var flyout = $('#flyout'),
		flyoutwrap = $('#flyout-wrap');

	if (flyout.text().length){
		flyoutwrap.prepend('<div id="flyout-toggle"><i class="fa fa-bars"></i> Useful Links + Forms</div>');
	}

	$("#flyout-toggle").on("click", function(){
		flyout.slideToggle();
		$(this).toggleClass("active");
	});

	$("#flyout li:has(ul)").children("a,span").append('<i class="fa fa-angle-down toggle-children">');
	$("#flyout ul").addClass('flyout-children');

	var flyoutChildren = $('.flyout-children');

	$(".toggle-children").on('click keypress', function(e) {
		if (e.keyCode === 13 || e.type === 'click') {
			e.preventDefault();
			if($(this).parent().next(flyoutChildren).is(":visible")){
				$(this).parent().next(flyoutChildren).slideUp();
			} else {
				$(flyoutChildren).slideUp("slow");
				$(this).parent().next(flyoutChildren).slideToggle();
			}
		}
	});

	// start calendar resize handler
	function resizeIframe(height) {
		var iFrameID = document.getElementById('calendar');
		if(iFrameID) {
				// here you can set the height, I delete it first, then I set it again
				iFrameID.height = "";
				iFrameID.height = height;
		}
		console.log("height to: " + height);
	}
	var eventMethod = window.addEventListener
	? "addEventListener"
	: "attachEvent";
	var eventHandler = window[eventMethod];
	var messageEvent = eventMethod === "attachEvent"
		? "onmessage"
		: "message";
	eventHandler(messageEvent, function (e) {

		if( e.data && e.data[0] === "setCalHeight" )
		{
			if(typeof resizeIframe === 'function'){
				resizeIframe(e.data[1]);
			}

		}

	});
	// end calendar resize handler

	// revizeWeather
	if( typeof $.fn.revizeWeather !== "undefined" ){
		$.fn.revizeWeather({
			zip: '32353',
			city_name: '',
			unit: 'f',
			success: function(weather) {
				var date = new Date();
				date = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
				var html = '<span>'+date+'</span> <span class="forecast">'+weather.temp+'&deg; '+weather.forecast+'</span>';
				html += '<i class="'+weather.icon+'"></i>';

				$("#weather").html(html);
			},
			error: function(error) {
				// better to just hide the secion if there is an error
				$('.weather').hide();
				console.log(error);
			}
		});
	}

	// bxSlider
	if(typeof $.fn.bxSlider !== "undefined"){
		$('#slider > .bxslider').bxSlider({
			mode:'fade',
			auto:($('#slider > .bxslider').children().length < 2) ? false : true,
			pager: false
		});
	}

	// Owl Slider
	if(typeof $.fn.owlCarousel !== "undefined"){
		let quickLinksCount = $('.quick-link').length;
		const itemCount = function(num) {
			return (quickLinksCount >= num ? num : quickLinksCount);
		}
		$(".quick-links-carousel").owlCarousel({
			loop: true,
			responsiveClass: true,
			nav: true,
			navText: ['<i class="fa fa-angle-left fa-3x"></i>', '<i class="fa fa-angle-right fa-3x"></i>'],
			responsive: {
				0: {
					items: itemCount(1)
				},
				767: {
					items: itemCount(2)
				},
				991: {
					items: itemCount(3)
				},
				1200: {
					items: itemCount(4)
				}
			}
		});

		let newsLinkCount = $('.news-link').length;
		const newsItem = function(num) {
			return (newsLinkCount >= num ? num : newsLinkCount);
		}
		$("#news-links").owlCarousel({
			loop: newsLinkCount > 1 ? true : false,
			responsiveClass: true,
			nav: true,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive: {
				0: {
					items: newsItem(1),
					margin: 15
				},
				500: {
					items: newsItem(2),
					margin: 35
				},
				1000: {
					items: newsItem(3),
					margin: 55
				}
			}
		});

		let innerQuickLinksCount = $('.inner-quick-link').length;
		const innerQuickLinkItem = function(num) {
			return (innerQuickLinksCount >= num ? num : innerQuickLinksCount);
		}
		$("#inner-quick-links-wrapper").owlCarousel({
			loop: false,
			responsiveClass: true,
			nav: true,
			navText: ['<i class="fa fa-angle-left fa-3x"></i>', '<i class="fa fa-angle-right fa-3x"></i>'],
			responsive: {
				0: {
					items: innerQuickLinkItem(1)
				},
				479: {
					items: innerQuickLinkItem(2)
				},
				768: {
					items: innerQuickLinkItem(3)
				}
			}
		});
	}
	
	$window.ready(function(){

	if ($('#counter').length) {
		$('.timer').countTo();
		$('.timer-2').countTo({
			onComplete: function() {
				$(this).addClass('fourth');
			}
		});
	}
		
		if ( typeof $.fn.socialfeed !== "undefined"){
			$('#social-feed').socialfeed({
				// Facebook
				facebook:{
					accounts: ['@GadsdenCountyBOCC'],
					limit: 10,
					access_token: 'EAAFsTjd21XMBAE9NQVHsxSxe1SpyV3KTQ2dX38YB3F5ZCHXp3ZBWamxKbdLA5W0Q41TmqKGBZApgeyRSEQnnIldb1mpjdjlT1tV2ujleHSBqKyCtp8FmvuBQCVG0jBkoluV8IMWoC5MQVZCZCVYfRojLVnBeNX96udhZCswPyXtQZDZD'
				},
				template: "_assets_/templates/template.html",
				length: 70,
				show_media: true
			});
		}
		
		if ($('#side-content').length){
			$('main').css('position','relative');
			$('<div id="side-background" class="hidden-sm hidden-xs"></div>').prependTo('main');
		}
		
		function sideBackground(){
			$('#side-background').width($('#side-content').outerWidth());
		}
		sideBackground();
		$window.resize(sideBackground);

		// Fill sides script
		function fillSide(){
			var windowWidth = $('body').outerWidth();
			var pixelValue = (windowWidth - $('.container').width()) / 2;
			$('.fillLeft').css({
					'margin-left': -pixelValue
			});
			
			$('.fillRight').css({
					'margin-right': -pixelValue
			});
			$('.fillLeft.withPadding').css({
					'margin-left': -pixelValue,
					'padding-left': pixelValue
			});
			
			$('.fillRight.withPadding').css({
					'margin-right': -pixelValue,
					'padding-right': pixelValue
			});
			
			$('#side-background').width($('#side-content').outerWidth());
		}
		fillSide();
		$window.resize(fillSide);

		function sliderWidth(){
			var windowWidth = $('body').outerWidth();
			var pixelValue = (windowWidth - $('.container').width()) / 2;
			$('#slider2').css('margin-right', -pixelValue);
			if ($('.fullwidth').length){
				$('#slider2').css('margin-left', -pixelValue);
			}
		}
		sliderWidth();
		$window.resize(sliderWidth);

		$('#slider2 > .bxslider').bxSlider({
			mode:'fade',
			auto:($('#slider2 > .bxslider').children().length < 2) ? false : true,
			pager: false
		});

		$('.translation-links span').on('keydown click', function(e){
			if (e.keyCode === 13 || e.type === 'click') {
				$('.translation-links ul').stop().fadeToggle();
			}
		});

		$('.translation-links ul').on('mouseleave',function(){
			$('.translation-links ul').fadeOut();
		});

		var translateURL = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";

		 // Translate Script
		$.getScript(translateURL);
		console.log(translateURL);
		$('.translation-links a').click(function() {
			var lang = $(this).data('lang');
			console.log(lang);
			var $frame = $('.goog-te-menu-frame:first');
			if (!$frame.size()) {
				return false;
			}
			$frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
			return false;
		});

		// matchHeight
		if(typeof $.fn.matchHeight !== "undefined"){
			$('.equal').matchHeight({
				//defaults
				byRow: true,
				property: 'height', // height or min-height
				target: null,
				remove: false
			});
		}

		// Animations http://www.oxygenna.com/tutorials/scroll-animations-using-waypoints-js-animate-css
		function onScrollInit( items, trigger ) {
			items.each( function() {
				var osElement = $(this),
					osAnimationClass = osElement.data('os-animation'),
					osAnimationDelay = osElement.data('os-animation-delay');

				osElement.css({
					'-moz-animation-delay':     osAnimationDelay,
					'animation-delay':          osAnimationDelay,
					'-webkit-animation-delay':  osAnimationDelay
				});

				var osTrigger = ( trigger ) ? trigger : osElement;

				if(typeof $.fn.waypoint !== "undefined"){
					osTrigger.waypoint(function() {
						osElement.addClass('animated').addClass(osAnimationClass);
					},{
						triggerOnce: true,
						offset: '100%'
					});
				}
			});
		}
		onScrollInit($('.os-animation'));

		//#Smooth Scrolling
		$('a[href*=#]:not([href=#],[href*="#collapse"])').click(function() {
			if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});

		/*global jQuery */
		/*!
		* FlexVerticalCenter.js 1.0
		*
		* Copyright 2011, Paul Sprangers http://paulsprangers.com
		* Released under the WTFPL license
		* http://sam.zoy.org/wtfpl/
		*
		* Date: Fri Oct 28 19:12:00 2011 +0100
		*/
		$.fn.flexVerticalCenter = function( options ) {
			var settings = $.extend({
				cssAttribute:   'margin-top', // the attribute to apply the calculated value to
				verticalOffset: 0,            // the number of pixels to offset the vertical alignment by
				parentSelector: null,         // a selector representing the parent to vertically center this element within
				debounceTimeout: 25,          // a default debounce timeout in milliseconds
				deferTilWindowLoad: false     // if true, nothing will take effect until the $(window).load event
			}, options || {});

			return this.each(function(){
				var $this   = $(this); // store the object
				var debounce;

				// recalculate the distance to the top of the element to keep it centered
				var resizer = function () {

					var parentHeight = (settings.parentSelector && $this.parents(settings.parentSelector).length) ?
						$this.parents(settings.parentSelector).first().height() : $this.parent().height();

					$this.css(
						settings.cssAttribute, ( ( ( parentHeight - $this.height() ) / 2 ) + parseInt(settings.verticalOffset) )
					);
				};

				// Call on resize. Opera debounces their resize by default.
				$(window).resize(function () {
					clearTimeout(debounce);
					debounce = setTimeout(resizer, settings.debounceTimeout);
				});

				if (!settings.deferTilWindowLoad) {
					// call it once, immediately.
					resizer();
				}

				// Call again to set after window (frames, images, etc) loads.
				$(window).load(function () {
					resizer();
				});

			});

		};
		$('.v-align').flexVerticalCenter();

	}); // Ready

})(jQuery);
