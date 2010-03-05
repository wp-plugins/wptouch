/*
 * WPtouch 1.9 -The WPtouch Admin Javascript File
 * This file holds all the default jQuery & Ajax functions for the theme
 * Copyright (c) 2008-2010 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: March 5th, 2010
 */
jQuery(document).ready(function(jQuery) {
var button = jQuery('#upload_button'), interval;
	new AjaxUpload(button, {
		action: '../?wptouch=upload',
		autoSubmit: true,
		name: 'submitted_file',
		onSubmit: function(file, extension) { jQuery("#upload_progress").show(); },
		onComplete: function(file, response) { jQuery("#upload_progress").hide();
		jQuery('#upload_response').hide().html(response).fadeIn(); }
	});

	setTimeout(function() { jQuery('img.ajax-load').fadeOut(1000); }, 2000);
	setTimeout(function() { jQuery('#wptouchupdated').fadeIn(350); }, 750);
	setTimeout(function() { jQuery('#wptouchupdated').fadeOut(350); }, 1750);

	jQuery('#header-text-color, #header-background-color, #header-border-color, #link-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) { jQuery(el).val(hex); jQuery(el).ColorPickerHide(); },
		onBeforeShow: function () { jQuery(this).ColorPickerSetColor( jQuery(this).attr('value') ); }
		});

	jQuery("a.fancylink").fancybox({
		'padding':	10, 'zoomSpeedIn': 250, 'zoomSpeedOut': 250, 'zoomOpacity': true, 'overlayShow': false, 'frameHeight': 320, 'frameWidth': 450, 'hideOnContentClick': true
	});
});