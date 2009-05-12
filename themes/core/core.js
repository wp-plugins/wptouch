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

	function bnc_jquery_menu_drop() {
		$wptouch('#wptouch-menu').slideToggle(200);
		$wptouch("#headerbar-menu a").toggleClass("open");
	}
	
	function bnc_jquery_login_drop() {
		$wptouch('#wptouch-login').slideToggle(200);
		$wptouch("#drop-fade a#loginopen").toggleClass("baropen");
	}
	
	function bnc_jquery_cats_drop() {
		$wptouch('#wptouch-cats').slideToggle(200);
		$wptouch("#drop-fade a#catsopen").toggleClass("baropen");
	}
	
	function bnc_jquery_tags_drop() {
		$wptouch('#wptouch-tags').slideToggle(200);
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