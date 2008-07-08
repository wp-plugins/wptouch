<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--Strict viewport options to control how the content is shown. Increase the maximum-scale number to allow for zooming if you wish-->
<meta name="viewport" content="maximum-scale=1.0 width=device-width initial-scale=1.0 user-scalable=no" />
<!--This makes the iPhone/iPod touch look in the  wptouch/images directory for a bookmark icon (your header logo choice), add yours to the 'wptouch/images' directory to customize in the wptouch admin-->
<link rel="apple-touch-icon" href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/icon-pool/<?php echo bnc_get_title_image(); ?>"/>
<script src="<?php bloginfo('template_directory'); ?>/js/global.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/scriptaculous.js?load=effects" type="text/javascript" charset="utf-8"></script>
<?php wp_head(); ?>
<style type="text/css">
#menubar {
	width: 100%;
	height: 45px;
	background: #<?php echo bnc_get_header_background(); ?> url(<?php bloginfo('template_directory'); ?>/images/head-fade-bk.png) repeat-x;
}
#blogtitle a {
	text-decoration: none;
	font: bold 20px Helvetica, sans-serif;
	letter-spacing: -1px;
	position: relative;
	color: #<?php echo bnc_get_header_color(); ?>
}
</style>
</head>
<body>

<div id="menubar">
<div  id="blogtitle">
<img src="<?php
  bloginfo('wpurl');
?>/wp-content/plugins/wptouch/images/icon-pool/<?php
  echo bnc_get_title_image();
?>" alt="" /> <a href="<?php
  bloginfo('siteurl');
?>"><?php
  bloginfo('name');
?></a></div>
</div>

<div id="drop-fade">
  <?php 
  // Taken out for now, until we add admin options for login controls
  /*?><?php
  get_currentuserinfo();
  if (current_user_can('edit_posts'))
      :
?>        
<a href="javascript:new Effect.toggle($('wptouch-login'),'Appear', {duration: 0.6});">
<img src="<?php
      bloginfo('template_directory');
?>/images/menu/touchmenu-login.png" alt="" />
</a>
<?php
  else
      :
?>
<a href="<?php
      bloginfo('url');
?>/wp-login.php?action=logout">
<img src="<?php
  bloginfo('template_directory');
?>/images/menu/touchmenu-logout.png" alt="" />
</a>
<?php
  endif;
?><?php */?><a href="javascript:new Effect.toggle($('wptouch-search'),'Appear', {duration: 0.4});"><img src="<?php
  bloginfo('template_directory');
?>/images/menu/search-touchmenu.png" alt="" /></a><a href="javascript:new Effect.toggle($('dropmenu'),'Appear', {duration: 0.6});"><img src="<?php
  bloginfo('template_directory');
?>/images/menu/touchmenu.png" alt="" /></a></div>

        <div id="wptouch-search" style="display:none">
        <div id="wptouch-search-inner">
        <form method="get" id="searchform" action="<?php
  bloginfo('siteurl');
?>/">
<div><input type="text" value="<?php
  the_search_query();
?>" name="s" id="s" /> <input name="submit" type="submit" id="ssubmit" tabindex="5" value="Search" />
</div>
</form>
        </div>
        </div>
    
<?php 
//Disabled for now, until admin login options are available.

/*?>            <div id="wptouch-login" style="display:none">
        <div id="wptouch-login-inner">
  <form name="loginform" id="loginform" action="<?php
  echo get_settings('url');
?>/wp-login.php" method="post">
    <label><input type="text" name="log" id="log" onfocus="if (this.value == 'username') {this.value = ''}" value="username" /></label>
    <label><input type="password" name="pwd"  onfocus="if (this.value == 'password') {this.value = ''}" id="pwd" value="password" /></label>
    <input type="hidden" name="rememberme" value="forever" />
    <input type="submit" id="logsub" name="submit" value="<?php
  _e('Login');
?>" tabindex="9" />
    <input type="hidden" name="redirect_to" value="<?php
  echo $_SERVER['REQUEST_URI'];
?>"/>
    </form>
        </div>
        </div><?php */?>

<div id="dropmenu" style="display:none">
<div id="dropmenu-inner">
<ul>
<li><a href="<?php
  bloginfo('url');
?>"><img src="<?php
  bloginfo('wpurl');
?>/wp-content/plugins/wptouch/images/icon-pool/Home.png" alt="" />Home</a></li>
<?php
  $pages = bnc_wp_touch_get_pages();
  foreach ($pages as $p) {
      $image = get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/icon-pool/' . $p['icon'];
      echo('<li><a href="' . get_permalink($p['ID']) . '"><img src="' . $image . '" />' . $p['post_title'] . '</a></li>');
  }
?>
<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php
  bloginfo('wpurl');
?>/wp-content/plugins/wptouch/images/icon-pool/RSS.png" alt="" />RSS Feed</a></li>
<li class="noborder"><a href="mailto:<?php
  bloginfo('admin_email');
?>"><img src="<?php
  bloginfo('wpurl');
?>/wp-content/plugins/wptouch/images/icon-pool/Mail.png" alt="" />E-Mail</a></li>
</ul>
</div>
</div>

<?php
  if (false && function_exists('bnc_is_iphone') && !bnc_is_iphone()) {
?>
  <div class="content post">
  <a href="#" class="h2">Warning</a>
  <div class="mainentry">
  Sorry, this theme is only meant for use with WordPress on Apple's iPhone and iPod Touch.  </div>
  </div>
  
  <?php get_footer(); ?></body> 
<?php die; } ?>
<!--End of the Header-->
<div class="post-spacer"></div>