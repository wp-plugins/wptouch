<?php

/*
#  Plugin Name: WPtouch Growl Add-On
#  Plugin URI: http://www.wptouch.com
#  Description: Send growl notifications from WordPress to your computer, or through Prowl on the iPhone & iPod touch.
#  Author: Dale Mugford and Duane Storey
#  Version: 1.0 (beta)
#  Author URI: http://www.bravenewcode.com
#  NOTE: This plugin uses growl php code originally created by Phil Nelson, built upon work by Tyler Hall, 
#  which can be found here: 
#  http://philnelson.name/2007/09/09/introducing-murderous-growling-a-wordpress-growl-plugin/
#  http://code.google.com/p/php-growl/
*/ 


require_once("class.growl.php");
load_plugin_textdomain('pubgrowl');

function pubgrowl_add_options_page() {
    if (function_exists('add_options_page')) {
                add_options_page('WPtouch Growl Options', 'WPtouch Growl', 9, 'options-growl.php');
    }
}

add_action('comment_post','sendComment');
add_action('publish_post','sendPost');
add_action('user_register','sendRegistration');
add_action('wp_print_scripts','sendPageview');

function sendComment() {
	SendAGrowl("comment");
}

function sendPost() { 
	SendAGrowl("post");
}

function sendPageview() { 
	SendAGrowl("pageview");
}
function sendRegistration() { 
	SendAGrowl("registration");
}

function SendAGrowl($type) {
global $wpdb;
$pubgrowl_password = stripslashes(get_option('pubgrowl_password'));
$pubgrowl_ip = stripslashes(get_option('pubgrowl_ip'));
$pubgrowl_comments = stripslashes(get_option('pubgrowl_comments'));
$pubgrowl_posts = stripslashes(get_option('pubgrowl_posts'));
$pubgrowl_pageviews = stripslashes(get_option('pubgrowl_pageviews'));
$pubgrowl_registration = stripslashes(get_option('pubgrowl_pageviews'));

switch($type) {

	case 'comment':
		if($pubgrowl_comments == "on") {
			$results = $wpdb->get_results("SELECT ".$wpdb->comments.".comment_author as author, ".$wpdb->posts.".post_title as title, ".$wpdb->comments.".comment_content as content from ".$wpdb->comments." LEFT JOIN ".$wpdb->posts." on ".$wpdb->posts.".ID = ".$wpdb->comments.".comment_post_ID where comment_approved != 'spam' order by ".$wpdb->comments.".comment_ID DESC limit 1");
			
			foreach($results as $comment) {
				$notification = "New Comment";
				$title = "Comment on " . stripslashes($comment->title)."";
				$content = stripslashes($comment->author) . ": ".strip_tags($comment->content)."";
			}
			$i = 1;
		}
	break;
	
	case 'post':
		if($pubgrowl_posts == "on") {
			$results = $wpdb->get_results("SELECT user_nicename as author, post_title as content from ".$wpdb->posts." LEFT JOIN ".$wpdb->users." ON ".$wpdb->posts.".post_author = ".$wpdb->users.".ID order by ".$wpdb->posts.".ID DESC limit 1");
			foreach($results as $comment) {
				$notification = "New Post";
				$title = stripslashes($comment->author) . " added a post";
				$content = stripslashes($comment->content);
			}
			$i = 1;
		}
	break;

	case 'pageview':
		
		if($pubgrowl_pageviews == "on") {
			$page_title = wp_title('',FALSE);
			if(is_home())
			{
				$page_title = "the home page";
			}
			if($page_title != "")
			{
				if($page_title != "the home page")
				{
					$page_title = "the page" . $page_title;
				}
				$notification = "Pageview";
				$title = "Pageview";
				$content = "Someone is viewing ".$page_title." on ".get_option('blogname');
				$i = 1;
			}
			
			
		}
	
	break;

}
	$the_ip = gethostbyname($pubgrowl_ip);
	if($i > 0 && $_SERVER['REMOTE_ADDR'] != $the_ip) {
		$g = new Growl("WPtouch Growl");
		$g->setAddress($pubgrowl_ip, $pubgrowl_password);
		$g->notify($notification, $title, $content);
		$i = 0;
	}
}

add_action('admin_menu', 'pubgrowl_add_options_page');

?>