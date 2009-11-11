/*
 * WPtouch 1.9.x -The WPtouch Core JS File
 * This file holds all the default jQuery & Ajax functions for the theme
 * Copyright (c) 2008-2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: November 11th, 2009
 */

/////// -- Get out of frames! -- ///////
if (top.location!= self.location) {top.location = self.location.href}


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

setTimeout(function() { $wptouch('#prowl-success').fadeOut(350); }, 5250);
setTimeout(function() { $wptouch('#prowl-fail').fadeOut(350); }, 5250);

function wptouch_toggle_text() {
	$wptouch("p").toggleClass("fontsize");
}


/////// -- Menus -- ///////
// Creating a new function, fadeToggle()
$wptouch.fn.fadeToggle = function(speed, easing, callback) { 
	return this.animate({opacity: 'toggle'}, speed, easing, callback); 
};
 
function bnc_jquery_menu_drop() {
	$wptouch('#wptouch-menu').fadeToggle(400);
	$wptouch("#headerbar-menu a").toggleClass("open");
}

function bnc_jquery_login_toggle() {
	$wptouch('#wptouch-login').fadeToggle(400);
}

function bnc_jquery_prowl_open() {
	$wptouch('#prowl-message').fadeToggle(400);
}

function bnc_jquery_wordtwit_open() {
	$wptouch('#wptouch-wordtwit').fadeToggle(400);
}


function bnc_jquery_cats_open() {
	$wptouch('#cat').focus();
}

function bnc_jquery_tags_open() {
	$wptouch('#tag-dropdown').focus();
}

function bnc_jquery_acct_open() {
	$wptouch('#acct-dropdown').focus();
}


/////// -- Ajax comments -- ///////
function bnc_showhide_coms_toggle() {
	$wptouch('#commentlist').fadeToggle(350);
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


/////// --Single Post Page -- ///////

function wptouch_toggle_twitter() {
	$wptouch('#twitter-box').fadeToggle(400);
}

function wptouch_toggle_bookmarks() {
	$wptouch('#bookmark-box').fadeToggle(400);
}


/////// -- Tweak jQuery Timer -- ///////
$wptouch.timerId = setInterval(function(){
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

//Lazy Load
(function($){$.fn.lazyload=function(options){var settings={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};if(options){$.extend(settings,options);}
var elements=this;if("scroll"==settings.event){$(settings.container).bind("scroll",function(event){var counter=0;elements.each(function(){if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){$(this).trigger("appear");}else{if(counter++>settings.failurelimit){return false;}}});var temp=$.grep(elements,function(element){return!element.loaded;});elements=$(temp);});}
return this.each(function(){var self=this;$(self).attr("original",$(self).attr("src"));if("scroll"!=settings.event||$.belowthefold(self,settings)||$.rightoffold(self,settings)){if(settings.placeholder){$(self).attr("src",settings.placeholder);}else{$(self).removeAttr("src");}
self.loaded=false;}else{self.loaded=true;}
$(self).one("appear",function(){if(!this.loaded){$("<img />").bind("load",function(){$(self).hide().attr("src",$(self).attr("original"))
[settings.effect](settings.effectspeed);self.loaded=true;}).attr("src",$(self).attr("original"));};});if("scroll"!=settings.event){$(self).bind(settings.event,function(event){if(!self.loaded){$(self).trigger("appear");}});}});};$.belowthefold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).height()+$(window).scrollTop();}
else{var fold=$(settings.container).offset().top+$(settings.container).height();}
return fold<=$(element).offset().top-settings.threshold;};$.rightoffold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).width()+$(window).scrollLeft();}
else{var fold=$(settings.container).offset().left+$(settings.container).width();}
return fold<=$(element).offset().left-settings.threshold;};$.extend($.expr[':'],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"});})(jQuery);

$("img").lazyload({         
	effect : "fadeIn", 
    failurelimit : 10
});

// End WPtouch jS