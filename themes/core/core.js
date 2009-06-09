/*
 * WPtouch 1.9 -The WPtouch Core Javascript File
 * This file holds all the default jQuery & Ajax functions all in one neat place.
 * 
 * Copyright (c) 2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Last Updated: June 3rd, 2009
 */

/////// -- Header Bump on page load -- ///////

//addEventListener("load",function() {
//setTimeout(updateLayout,0);
//setTimeout(function(){window.scrollTo(0,1);},100);},false);
//var currentWIdth=0;function updateLayout() {
//if(window.innerWIdth!=currentWIdth) {currentWIdth=window.innerWIdth;
//var orient=currentWIdth==320?"profile":"portrait";
//document.body.setAttribute("orient",orient);setTimeout(function() {
//window.scrollTo(0,1);},500);}}
//setInterval(updateLayout,300);


/////// -- Let's Play Nice -- ///////

$wptouch = jQuery.noConflict();


/////// -- Switch Link Background Magic -- ///////

	function bnc_jquery_switch() {
		$wptouch("#wptouch-switch-link a#switch-link").toggleClass("offimg");
	}

/////// -- Drop Down Menus -- ///////

// Creating a new function, fadeToggle()
jQuery.fn.fadeToggle = function(speed, easing, callback) { 
   return this.animate({opacity: 'toggle'}, speed, easing, callback); 
}; 
	function bnc_jquery_menu_drop() {
		$wptouch('#wptouch-menu').fadeToggle(400);
		$wptouch("#headerbar-menu a").toggleClass("open");
	}
	
	function bnc_jquery_login_drop() {
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
	
/////// -- Ajax Comments -- ///////

function commentAdded() {
    if ($wptouch('#errors')) {
        $wptouch('#errors').hide();
}
    $wptouch("#commentform").hide();
    $wptouch("#some-new-comment").fadeIn(2000);
    $wptouch("#refresher").fadeIn(2000);
    if ($wptouch('#nocomment')) {
        $wptouch('#nocomment').hide();
    }
    if($wptouch('#hidelist')) {
        $wptouch('#hidelist').hide();
    }
}