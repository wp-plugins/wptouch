/*
 * WPtouch 1.9 -The WPtouch Core Javascript File
 * This file holds all the default jQuery & Ajax functions for the theme
 * THIS FILE IS NOT USED, AND IS MINIFIED WITH EACH CHANGE (core-min.js)
 * Copyright (c) 2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: June 14th, 2009
 */


/////// -- Hide addressbar on page load -- ///////

setTimeout(function() { window.scrollTo(0, 1) }, 100);


/////// -- Let's play nice in jQuery -- ///////

$wptouch = jQuery.noConflict();


/////// -- Switch Magic -- ///////

function wptouch_switch_confirmation() {
	var answer = confirm("Switch to regular view? \n \n You can switch back to mobile view again in the footer.");
	if (answer){
	$wptouch("#wptouch-switch-link a#switch-link").toggleClass("offimg");
	setTimeout('switch_delayer()', 1000); 
	} else {
		// stay put
	}
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
//		$wptouch("#drop-fade a#loginopen").toggleClass("baropen");
}

function bnc_jquery_cats_open() {
	jQuery('#cat').focus();
	//$wptouch("#drop-fade a#catsopen").toggleClass("baropen");
}

function bnc_jquery_tags_open() {
	jQuery('#tag-dropdown').focus();
	//$wptouch("#drop-fade a#tagsopen").toggleClass("baropen");
}

function bnc_jquery_acct_open() {
	jQuery('#acct-dropdown').focus();
	//$wptouch("#drop-fade a#tagsopen").toggleClass("baropen");
}


/////// -- Ajax comments -- ///////

function bnc_showhide_coms_toggle() {
	$wptouch('#commentlist').slideToggle(400);
	$wptouch("img#com-arrow").toggleClass("com-arrow-down");
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
    $wptouch("#some-new-comment").fadeIn(2000);
    $wptouch("#refresher").fadeIn(2000);
}