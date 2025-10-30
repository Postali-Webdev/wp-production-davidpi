/**
 * Theme scripting
 *
 * @package gds_2018
 * @author Postali
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
  "use strict";

  	// Trigger animation for mobile menu slide down
	$('#menu-icon').click(function(e){
		e.preventDefault();
		$('#mobile-nav').slideToggle(300);
		// Change this boolean number to adjust animation speed
		$('body').toggleClass('fixed');
		$(this).toggleClass('open');
	});

	// Dropdown for nested menus
	// Must turn css classes on in WordPress and add the class of 'mobile-parent'
	// Then use that as a dummy link with the real link below it
	$('.menu-item-has-children>a').click(function(e){
	    e.preventDefault();
	    $(this).siblings('.sub-menu').slideToggle(300);
	    // Change this boolean number to adjust animation speed
	    $(this).toggleClass('open');
	});

	// Contact form 7 /form-success/ forwarder
  	document.addEventListener( 'wpcf7mailsent', function( event ) {
    	location = '/form-success/';
	}, false );

	// Touch Device Detection
	var isTouchDevice = 'ontouchstart' in document.documentElement;
		if( isTouchDevice ) {
		$('body').removeClass('no-touch');
	};

	// Turn on header CTA after scroll
	$(function() {
		var header = $(".header-cta");
		var logo = $(".logo-pt");
	
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
			if (scroll >= 600) {
				header.addClass("visible");
			} else {
				header.removeClass("visible");
			}
			if (scroll >= 1) {
				logo.addClass("shrink");
			} else {
				logo.removeClass("shrink");
			}
		});
  
});


	//keeps menu expanded so user can tab through sub-menu, then closes menu after user tabs away from last child
	$(document).ready(function() {
		console.log('listening...');
		function tabableMenu() {
			var screenSize = $(document).outerWidth();
			if( screenSize > 1024 ) {
				var focusActive = false;
				var navMenu = '#menu-main-menu-desktop > .menu-item';
				//do functions below while user is focused on sub menu
				$(navMenu).on('focusin keydown', function(e) {
					var subMenu = $(this).find('.second');
					//adding active menu state while user is focused on sub menu
					subMenu.addClass('focus-active');
					// subMenu.slideToggle('medium');
					focusActive = true;
					//remove menu when user tabs away from menus last child item
					$(subMenu).find('.inner2 ul > li:last-of-type').on('focusout', function(e) {
						console.log('remove!')
						subMenu.removeClass('focus-active');
						// subMenu.slideToggle('medium');
						focusActive = false;
					});
				})
				//remove active sub menu when user reverse tabs away 
				$(navMenu).on('focusout keydown', function(e) { 
					//focusActive = false;
					var subMenu = $(this).find('.sub-menu');

					if (e.type === "focusout") {
						var parentElId = $(e.relatedTarget).parent()[0].id;
						var parentInFocus = navMenu.includes(parentElId);
					}
					
					if(e.shiftKey && e.keyCode == 9 && focusActive && parentInFocus ) { 
						subMenu.removeClass('focus-active');
						focusActive = false;
					}
				});
				//remove active sub menu when user clicks anywhere on page outside of the menu
				$('html').on('click', function(e) {
					var target = e.target;
					if( $(target).closest('.sub-menu').length ) {
						return;
					} else {
						if ( focusActive ) {
							$('.sub-menu').removeClass('focus-active');
							focusActive = false;
						}
					}
				});
			} 
		}
		tabableMenu();
		$(window).resize(function() {
			tabableMenu();
		});
	});


	
});
