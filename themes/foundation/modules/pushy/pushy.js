/*! Pushy - v2.0 - 2014-6-19
* Pushy is a responsive off-canvas navigation menu using CSS transforms & transitions.
* Originally by Christopher Yee
* Modified for left and right menu support by BraveNewCode Inc. for WPtouch ( http://www.wptouch.com )
*/

( function( $ ){

	//Before we start, append the site overlay div
	jQuery( 'body' ).prepend( '<div class="site-overlay"><!-- appended by pushy for the off-canvas menu --></div>' );

	$.fn.pushy = function( options ) {

		var settings = $.extend( {
			leftMenu : 			jQuery('.pushy-left' ),
			rightMenu : 		jQuery('.pushy-right'),
			body : 				jQuery('body'),
			container : 		jQuery('.page-wrapper'), 	//container css class
			siteOverlay : 		jQuery('.site-overlay'), 	//site overlay
			pushyClass : 		'pushy-open', 				//menu position & menu open class
			pushyActiveClass :	'pushy-active', 			//css class to toggle site overlay
			containerClass : 	'container-push', 			//container open class
			menuBtn : 			jQuery('.menu-btn'), 		//css classes to toggle the menu
			viewportWidth : 	jQuery( window ).width(),	// Needed to position right menu
			menuWidth : 		240, 						// Menu width (default is 240px)
			menuSpeed : 		330, 						//jQuery fallback menu speed
			pushed : 			false
		}, options );


		// Setup default positioning and width
		settings.leftMenu.addClass( 'pushy-left' ).css( 'left', '-' + settings.menuWidth + 'px' ).css( 'width', settings.menuWidth + 'px' );;
		settings.rightMenu.addClass( 'pushy-right' ).css( 'left', settings.viewportWidth + 'px' ).css( 'width', settings.menuWidth + 'px' );;

		// update the position of right menus if they exist
		if ( settings.rightMenu.length ) {
			var currentWindow = jQuery( window );
			currentWindow.resize( function(){
				settings.viewportWidth = currentWindow.width();
				settings.rightMenu.css( 'left', settings.viewportWidth );
			}).resize();
		}

		function whichPushy( clicked ){
			var parent = clicked;
			if ( parent.hasClass( 'pushy-left' ) ) {
				return 'left';
			} else {
				return 'right';
			}
		}

		function oppositePushy( direction ) {
			var direction = ( direction == 'left' ? 'right' : 'left' );
			return direction;
		}

		function togglePushy( clicked ){
			settings.pushed = clicked;
			direction = whichPushy( clicked );
			var side = ('.pushy-' + direction );
			jQuery( side ).toggleClass( settings.pushyClass );

			if ( side == '.pushy-right' && jQuery( side ).hasClass( 'pushy-open' ) ) {
				jQuery( side ).css( 'transform', 'translate(-' + settings.menuWidth + 'px, 0)' );
				settings.container.css( 'transform', 'translate(-' + settings.menuWidth + 'px, 0)' );
			} else if ( side == '.pushy-right' && !jQuery( side ).hasClass( 'pushy-open' ) ) {
				jQuery( side ).css( 'transform', 'translate(0, 0)' );
				settings.container.css( 'transform', 'translate(0, 0)' );
			}

			if ( side == '.pushy-left' && jQuery( side ).hasClass( 'pushy-open' ) ) {
				jQuery( side ).css( 'transform', 'translate(' + settings.menuWidth + 'px, 0)' );
				settings.container.css( 'transform', 'translate(' + settings.menuWidth + 'px, 0)' );
			} else if ( side == '.pushy-left' && !jQuery( side ).hasClass( 'pushy-open' ) ) {
				jQuery( side ).css( 'transform', 'translate(0, 0)' );
				settings.container.css( 'transform', 'translate(0, 0)' );
			}

			settings.container.toggleClass( whichPushy( clicked ) );
			settings.body.toggleClass( settings.pushyActiveClass ); //toggle site overlay
			settings.container.toggleClass( settings.containerClass );
			settings.siteOverlay.css( direction, settings.menuWidth ).css( oppositePushy( direction ), '0px' );

		}

		function openPushyFallback( clicked ){
			settings.pushed = clicked;
			var direction = whichPushy( clicked );
			settings.body.addClass( settings.pushyActiveClass );

			if ( direction == 'left' ) {
				clicked.container.animate( { left: '0' }, settings.menuSpeed );
			} else {
				clicked.container.animate( { left: settings.viewportWidth - settings.menuWidth }, settings.menuSpeed );
			}
		}

		function closePushyFallback( clicked ){
			settings.pushed = clicked;
			var direction = whichPushy( clicked );
			settings.body.removeClass( settings.pushyActiveClass );

			if ( direction == 'left' ) {
				clicked.container.animate( { left: '-' + settings.menuWidth }, settings.menuSpeed );
			} else {
				clicked.container.animate( {left: settings.viewportWidth }, settings.menuSpeed );
			}
		}

		if ( Modernizr.csstransforms3d ){
			//toggle menu
			settings.menuBtn.click( function( e ) {
				e.preventDefault();
				e.stopImmediatePropagation();
				target = '#' + jQuery( this ).attr( 'data-menu-target' );
				togglePushy( jQuery( target ).parent() );
			});
			//close menu when clicking site overlay
			settings.siteOverlay.click( function(){
				togglePushy( settings.pushed );
			});
		} else {
			//jQuery fallback
			settings.container.css( { 'overflow-x': 'hidden' } ); //fixes IE scrollbar issue

			//keep track of menu state (open/close)
			var state = true;

			//toggle menu
			settings.menuBtn.click( function( e ) {
				e.preventDefault();
				e.stopImmediatePropagation();
				target = '#' + jQuery( this ).attr( 'data-menu-target' );
				if ( state ) {
					openPushyFallback( jQuery( target ).parent() );
					state = false;
				} else {
					closePushyFallback( jQuery( target ).parent() );
					state = true;
				}
			});

			//close menu when clicking site overlay
			settings.siteOverlay.click( function(){
				if ( state ) {
					openPushyFallback( settings.pushed );
					state = false;
				} else {
					closePushyFallback( settings.pushed );
					state = true;
				}
			});
		}
	}
})( jQuery );