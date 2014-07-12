/*! PushIt - v1.0
* An elegant transform-based off-canvas solution for providing left & right menus for mobile websites, complete with jQuery fallback.
* Based on "Pushy" by Christopher Yee - http://christopheryee.ca/pushy/
* Modified for left and right menu support by BraveNewCode Inc. for WPtouch - http://www.wptouch.com
*/

// Let's get the current vendor prefix for each browser
var prefix = (function() {
	var styles = window.getComputedStyle( document.documentElement, '' ),
	vendor = ( Array.prototype.slice.call( styles ).join( '' ).match( /-(moz|webkit|ms)-/ ) || ( styles.OLink === '' && ['', 'o'] ) )[1];
	return {
		css: '-' + vendor + '-'
	}
})();

( function( $ ){

	// Hey! Ow! Push it good!
	$.fn.pushIt = function( options ) {

		var settings = $.extend( {
			leftMenu: 			jQuery( '.pushit-left' ),
			rightMenu:	 		jQuery( '.pushit-right' ),
			body: 				jQuery( 'body' ),
			container: 			jQuery( '.page-wrapper' ),	// container element
			pushItActiveClass:	'pushit-active',			// element to toggle site overlay
			containerClass: 	'container-pushit',			// container open
			menuBtn: 			jQuery('.menu-btn'),		// css classe(s) to toggle the menu
			viewportWidth:	 	jQuery( window ).width(),	// Needed to position a right menu
			menuWidth:	 		240,						// Menu width (default is 240px)
			menuSpeed:	 		330,						// Speed of the menu transistion, in milliseconds
			bezierCurve:		'.290, .050, .140, .870',	// Menu transistion bezier
			pushed: 			false
		}, options );

		var hasOverflowScroll = typeof( jQuery( 'body' )[0].style['-webkit-overflow-scrolling'] ) !== 'undefined';

		if ( hasOverflowScroll ) {
			jQuery( 'body' ).addClass( 'has-overflow-scroll' );
		}

		// Setup default positioning and width
		settings.leftMenu.addClass( 'pushit-left' )
			.css( 'left', '-' + settings.menuWidth + 'px' )
			.css( 'width', settings.menuWidth + 'px' );

		settings.rightMenu.addClass( 'pushit-right' )
			.css( 'left', settings.viewportWidth + 'px' )
			.css( 'width', settings.menuWidth + 'px' );

		settings.container
			.css( 'position', 'relative' )
			.css( prefix.css+'transform', 'translateZ(0)' )
			.css( prefix.css+'transition', prefix.css+'transform .'+settings.menuSpeed+'s cubic-bezier('+settings.bezierCurve+')' );

		// Setup the animations
		jQuery( '.pushit' )
			.css( prefix.css+'transform', 'translateZ(0)' )
			.css( prefix.css+'transition', prefix.css+'transform .'+settings.menuSpeed+'s cubic-bezier('+settings.bezierCurve+')' );

		// Before we start, append the site overlay div, and check for overflow scrolling
		jQuery( settings.body ).prepend( '<div id="site-overlay"><!-- appended by Pushit --></div>' );
		var siteOverlay = jQuery( '#site-overlay' );

		// Update the position of right menus if they exist
		if ( settings.rightMenu.length ) {
			var currentWindow = jQuery( window );
			currentWindow.resize( function(){
				settings.viewportWidth = currentWindow.width();
				settings.rightMenu.css( 'left', settings.viewportWidth );
			}).resize();
		}

		function whichPushIt( clicked ){
			var parent = clicked;
			if ( parent.hasClass( 'pushit-left' ) ) {
				return 'left';
			} else {
				return 'right';
			}
		}

		function oppositePushIt( direction ) {
			var direction = ( direction == 'left' ? 'right' : 'left' );
			return direction;
		}

		// For the site overlay when open
		function preventTouch( e ){ e.preventDefault(); }

		// Stop the TouchMove on the overlay
		function disableTouch( e ){
			siteOverlay.bind( 'touchmove', preventTouch, false );
		}

		// Re-enable touchmove on the overlay area
		function enableTouch( e ){
			siteOverlay.unbind( 'touchmove' );
		}

		function togglePushIt( clicked ){
			settings.pushed = clicked;
			direction = whichPushIt( clicked );
			var side = ('.pushit-' + direction );
			jQuery( side ).toggleClass( 'pushit-open' );

			// Left Menus
			// Open
			if ( side == '.pushit-left' && jQuery( side ).hasClass( 'pushit-open' ) ) {
				disableTouch();
				if ( prefix.css != '' ){
					jQuery( side ).css( prefix.css+'transform', 'translate3d(' + settings.menuWidth + 'px, 0, 0)' );
					settings.container.css( prefix.css+'transform', 'translate3d(' + settings.menuWidth + 'px, 0, 0)' );
				} else {
					jQuery( side ).animate( { left: '0' }, settings.menuSpeed );
					settings.container.animate( { left: settings.menuWidth }, settings.menuSpeed );
				}
			// Closed
			} else if ( side == '.pushit-left' && !jQuery( side ).hasClass( 'pushit-open' ) ) {
				enableTouch();
				if ( prefix.css != '' ){
					jQuery( side ).css( prefix.css+'transform', 'translate3d(0, 0, 0)' );
					settings.container.css( prefix.css+'transform', 'translate3d(0, 0, 0)' );
				} else {
					jQuery( side ).animate( { left: '-' + settings.menuWidth }, settings.menuSpeed );
					settings.container.animate( { left: '0' }, settings.menuSpeed );
				}
			}
			// Right Menus
			// Open
			if ( side == '.pushit-right' && jQuery( side ).hasClass( 'pushit-open' ) ) {
				disableTouch();
				if ( prefix.css != '' ){
					jQuery( side ).css( prefix.css+'transform', 'translate3d(-' + settings.menuWidth + 'px, 0, 0)' );
					settings.container.css( prefix.css+'transform', 'translate3d(-' + settings.menuWidth + 'px, 0, 0)' );
				} else {
					jQuery( side ).animate( { left: settings.viewportWidth - settings.menuWidth }, settings.menuSpeed );
					settings.container.animate( { left: '-' + settings.menuWidth }, settings.menuSpeed );
				}
			// Closed
			} else if ( side == '.pushit-right' && !jQuery( side ).hasClass( 'pushit-open' ) ) {
				enableTouch();
				if ( prefix.css != '' ){
					jQuery( side ).css( prefix.css+'transform', 'translate3d(0, 0, 0)' );
					settings.container.css( prefix.css+'transform', 'translate3d(0, 0, 0)' );
				} else {
					jQuery( side ).animate( { left: settings.viewportWidth }, settings.menuSpeed );
					settings.container.animate( { left: '0' }, settings.menuSpeed );
				}
			}

			settings.container.toggleClass( whichPushIt( clicked ) );
			settings.body.toggleClass( settings.pushItActiveClass ); //toggle site overlay
			settings.container.toggleClass( settings.containerClass );
		}

		// Toggle menu
		settings.menuBtn.click( function( e ) {
			e.preventDefault();
			e.stopImmediatePropagation();
			target = '#' + jQuery( this ).attr( 'data-menu-target' );
			togglePushIt( jQuery( target ).parent() );
		});
		// Close menu when clicking site overlay
		siteOverlay.on( 'click', function(){
			togglePushIt( settings.pushed );
		});

	}
})( jQuery );