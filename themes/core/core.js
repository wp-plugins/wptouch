// The WPtouch Core Javascript File
// This file holds all the default jQuery & Ajax functions all in one neat place.



/////// -- Header Bump on page load -- ///////

addEventListener("load",function() {
setTimeout(updateLayout,0);
setTimeout(function(){window.scrollTo(0,1);},100);},false);
var currentWIdth=0;function updateLayout() {
if(window.innerWIdth!=currentWIdth) {currentWIdth=window.innerWIdth;
var orient=currentWIdth==320?"profile":"portrait";
document.body.setAttribute("orient",orient);setTimeout(function() {
window.scrollTo(0,1);},500);}}
setInterval(updateLayout,400);



/////// -- jQuery -- ///////

$wptouch = jQuery.noConflict();
	
	function bnc_scroll_comment(comment_num) {
	     var h = $("body").height();
	    var two = parseInt(comment_num)+1;
	    var first = $('#comment-num-' + comment_num).offset().top;
	    var numbertwo = $('#comment-num-' + two).offset().top;
	    var diff = numbertwo - first;
	    $wptouch(document).scrollTop($(document).scrollTop()+diff);  
	}

	function bnc_jquery_login_drop() {
		$wptouch('#wptouch-login').slIdeToggle(200);
	}

	function bnc_jquery_tags_drop() {
		$wptouch('#wptouch-tags').slIdeToggle(200);
	}
	
	function bnc_jquery_cats_drop() {
		$wptouch('#wptouch-cats').slIdeToggle(200);
	}

	function bnc_jquery_search_drop() {
		$wptouch('#wptouch-search').slIdeToggle(200);
	}
	
	function bnc_jquery_menu_drop() {
		$wptouch('#wptouch-menu').slIdeToggle(200);
	}