$wptouch = jQuery.noConflict();
jQuery(document).ready( function() {
var imgWidth = $wptouch(".post img").width();
var captionWidth = $wptouch(".post .wp-caption").width();
if (imgWidth && captionWidth > 125) {
$wptouch('.pageentry img').removeClass('alignleft').addClass('aligncenter');
$wptouch('.pageentry img').removeClass('alignright').addClass('aligncenter');
$wptouch('.post img').removeClass('alignleft').addClass('aligncenter');
$wptouch('.post img').removeClass('alignright').addClass('aligncenter');
$wptouch('.post .wp-caption').removeClass('alignleft').addClass('aligncenter');
$wptouch('.post .wp-caption').removeClass('alignright').addClass('aligncenter');
}
var formoptions = {
beforeSubmit: function() {$wptouch("#loading").fadeIn(400);},
success:  function() {
$wptouch("#commentform").hide();
$wptouch("#loading").fadeOut(400);
$wptouch("#refresher").fadeIn(400);
},
error:  function() {
$wptouch('#errors').show();
$wptouch("#loading").fadeOut(400);
}
}	$wptouch('#commentform').ajaxForm(formoptions);
});
if (top.location!= self.location) {top.location = self.location.href}
jQuery.fn.replaceClass = function(toReplace,replaceWith){
return $wptouch(this).each(function(){
return $wptouch(this).removeClass(toReplace).addClass(replaceWith);
});
}
jQuery.fn.fadeToggle = function(speed, easing, callback) {
return this.animate({opacity: 'toggle'}, speed, easing, callback);
};
function wptouch_switch_confirmation() {
if (document.cookie && document.cookie.indexOf("wptouch_switch_cookie") > -1) {
$wptouch("a#switch-link").toggleClass("offimg");
setTimeout('switch_delayer()', 1250);
} else {
var answer = confirm("Switch to regular view? \n \n You can switch back to mobile view again in the footer.");
if (answer){
$wptouch("a#switch-link").toggleClass("offimg");
setTimeout('switch_delayer()', 1350);
}
}
}
setTimeout(function() { $wptouch('#prowl-success').fadeOut(400); }, 5250);
setTimeout(function() { $wptouch('#prowl-fail').fadeOut(400); }, 5250);
function bnc_jquery_menu_drop() {
$wptouch('#wptouch-menu').fadeToggle(400);
$wptouch("#headerbar-menu a").toggleClass("open");
}
function bnc_jquery_login_toggle() { $wptouch('#wptouch-login').fadeToggle(400);}
function bnc_jquery_search_toggle() { $wptouch('#wptouch-search').fadeToggle(400);}
function bnc_jquery_gigpress_toggle() { $wptouch('#wptouch-gigpress').fadeToggle(400);}
function bnc_jquery_prowl_open() { $wptouch('#prowl-message').fadeToggle(400);}
function bnc_jquery_wordtwit_open() { $wptouch('#wptouch-wordtwit').fadeToggle(400);}
function wptouch_toggle_twitter() {
$wptouch('#twitter-box').fadeToggle(400);
}
function wptouch_toggle_bookmarks() {
$wptouch('#bookmark-box').fadeToggle(400);
}
$wptouch(function () {
var tabContainers = $wptouch('#menu-head > ul');
$wptouch('#tabnav a').click(function () {
tabContainers.hide().filter(this.hash).show();
$wptouch('#tabnav a').removeClass('selected');
$wptouch(this).addClass('selected');
return false;
}).filter(':first').click();
});
function bnc_showhide_coms_toggle() {
$wptouch('#commentlist').fadeToggle(400);
$wptouch("img#com-arrow").toggleClass("com-arrow-down");
$wptouch("h3#com-head").toggleClass("comhead-open");
}
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