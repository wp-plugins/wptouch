/*
 * WPtouch 1.9 -The WPtouch Core Javascript File
 * This file holds all the default jQuery & Ajax functions all in one neat place.
 * 
 * Copyright (c) 2009 Duane Storey & Dale Mugford (BraveNewCode Inc.)
 * Licensed under GPL.
 *
 * Date: May 11th, 2009
 */

/////// -- Header Bump on page load -- ///////

addEventListener("load",function() {
setTimeout(updateLayout,0);
setTimeout(function(){window.scrollTo(0,1);},100);},false);
var currentWIdth=0;function updateLayout() {
if(window.innerWIdth!=currentWIdth) {currentWIdth=window.innerWIdth;
var orient=currentWIdth==320?"profile":"portrait";
document.body.setAttribute("orient",orient);setTimeout(function() {
window.scrollTo(0,1);},500);}}
setInterval(updateLayout,300);


/////// -- Drop Down Menus -- ///////

$wptouch = jQuery.noConflict();
jQuery.fn.fadeToggle = function(speed, easing, callback) { 
   return this.animate({opacity: 'toggle'}, speed, easing, callback); 
}; 
	function bnc_jquery_menu_drop() {
		$wptouch('#wptouch-menu').fadeToggle(400);
		$wptouch("#headerbar-menu a").toggleClass("open");
	}
	
	function bnc_jquery_login_drop() {
		$wptouch('#wptouch-login').fadeToggle(400);
		$wptouch("#drop-fade a#loginopen").toggleClass("baropen");
	}
	
	function bnc_jquery_cats_drop() {
		jQuery('#cat').focus();
		$wptouch("#drop-fade a#catsopen").toggleClass("baropen");
	}
	
	function bnc_jquery_tags_drop() {
		$wptouch('#wptouch-tags').fadeToggle(400);
		$wptouch("#drop-fade a#tagsopen").toggleClass("baropen");
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