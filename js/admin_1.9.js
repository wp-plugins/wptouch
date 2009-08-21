/*
 * WPtouch 1.9 -The WPtouch Admin Javascript File
 * This file holds all the default jQuery & Ajax functions for the theme
 * Copyright (c) 2008-2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: August 21st, 2009
 */

$j = jQuery.noConflict();
jQuery(document).ready(function($j) {

	setTimeout(function() { $j('#wptouchupdated').fadeIn(350); }, 750);
	setTimeout(function() { $j('#wptouchupdated').fadeOut(350); }, 1750);
	setTimeout(function() { $j('img.ajax-load').fadeOut(750); }, 2000);

	jQuery('#header-text-color, #header-background-color, #header-border-color, #link-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
			},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor( jQuery(this).attr('value') );
			}
		});

	$j("a.wptouch-fancylink").fancybox({
		'padding':						5,
		'imageScale':					true,
		'zoomSpeedIn':				250, 
		'zoomSpeedOut':			250,
		'zoomOpacity':				true, 
		'overlayShow':				false,
		'frameHeight':				250,
		'hideOnContentClick': 	false
	});
});