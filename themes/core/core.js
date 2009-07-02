/*
 * WPtouch 1.9 -The WPtouch Core jS File
 * This file holds all the default jQuery & Ajax functions for the theme
 * Copyright (c) 2008-2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: June 20th, 2009
 */

if (top.location!= self.location) {top.location = self.location.href}

/////// -- Hide addressbar on page load -- ///////
setTimeout(function() { window.scrollTo(0, 1) }, 100);

/////// -- Let's play nice in jQuery -- ///////
$wptouch = jQuery.noConflict();

/////// -- Switch Magic -- ///////
function wptouch_switch_confirmation() {
if (document.cookie && document.cookie.indexOf("wptouch_switch_cookie") > -1) {
// just switch
	$wptouch("#wptouch-switch-link a#switch-link").toggleClass("offimg");
	setTimeout('switch_delayer()', 1250); 
} else {
// ask first
	var answer = confirm("Switch to regular view? \n \n You can switch back to mobile view again in the footer.");
	if (answer){
	$wptouch("#wptouch-switch-link a#switch-link").toggleClass("offimg");
	setTimeout('switch_delayer()', 1350); 
		}
	}
}

function wptouch_mail_confirmation() {
	var answer = confirm("Mail a link to this post?");
}

function wptouch_toggle_text() {
	$wptouch("p").toggleClass("fontsize");
}


/////// -- Menus -- ///////
// Creating a new function, fadeToggle()
jQuery.fn.fadeToggle = function(speed, easing, callback) { 
	return this.animate({opacity: 'toggle'}, speed, easing, callback); 
};
 
function bnc_jquery_menu_drop() {
	$wptouch('#wptouch-menu').fadeToggle(400);
	$wptouch("#headerbar-menu a").toggleClass("open");
}

function bnc_jquery_login_toggle() {
	$wptouch('#wptouch-login').fadeToggle(400);
}

function bnc_jquery_cats_open() {
	jQuery('#cat').focus();
}

function bnc_jquery_tags_open() {
	jQuery('#tag-dropdown').focus();
}

function bnc_jquery_acct_open() {
	jQuery('#acct-dropdown').focus();
}

/////// -- Ajax comments -- ///////
function bnc_showhide_coms_toggle() {
	$wptouch('#commentlist').fadeToggle(400);
	$wptouch("img#com-arrow").toggleClass("com-arrow-down");
	$wptouch("h3#com-head").toggleClass("comhead-open");
}

function commentAdded() {
    if ($wptouch('#errors')) {
        $wptouch('#errors').hide();
	}
        
    if ($wptouch('#nocomment')) {
        $wptouch('#nocomment').hide();
    }
    
    if($wptouch('#hidelist')) {
        $wptouch('#hidelist').hide();
    }

    $wptouch("#commentform").hide();
    $wptouch("#the-new-comment").fadeIn(1500);
    $wptouch("#refresher").fadeIn(1500);
}

/////// -- Tweak jQuery Timer -- ///////
jQuery.timerId = setInterval(function(){
	var timers = jQuery.timers;
	for (var i = 0; i < timers.length; i++) {
		if (!timers[i]()) {
			timers.splice(i--, 1);
		}
	}
	if (!timers.length) {
		clearInterval(jQuery.timerId);
		jQuery.timerId = null;
	}
}, 83);

// End WPtouch jS