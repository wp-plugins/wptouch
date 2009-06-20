/*
 * WPtouch 1.9 -The WPtouch Admin Javascript File
 * This file holds all the default jQuery & Ajax functions for the theme
 * Copyright (c) 2008-2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: June 20th, 2009
 */

$j = jQuery.noConflict();
jQuery(document).ready(function($j) {

	new Ajax_upload('#upload_button', {
		action: '../?wptouch=upload',
		autoSubmit: true,
		name: 'submitted_file',
		onSubmit: function(file, extension) { $j("#upload_progress").show(); },
		onComplete: function(file, response) { $j("#upload_progress").hide();
		$j('#upload_response').hide().html(response).fadeIn(); }
	});
	
	setTimeout(function() { 	
		jQuery.ajax({
			url: "../?wptouch=news",
			success: function(data) {$j("#wptouch-news-content").html(data).fadeIn(500);}
		});
	}, 1000);

	setTimeout(function() { 	
		jQuery.ajax({
			url: "../?wptouch=beta",
			success: function(data) {$j("#wptouch-beta-content").html(data).fadeIn(250);}
		});
	}, 1000);

	setTimeout(function() { $j('#wptouchupdated').fadeIn(350); }, 300);
	setTimeout(function() { $j('#wptouchupdated').fadeOut(350); }, 2300);
	setTimeout(function() { $j('img.ajax-load').fadeOut(1000); }, 2000);

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
		'hideOnContentClick': 	true
	});
});