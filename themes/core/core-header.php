<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php $str = bnc_get_header_title(); echo stripslashes($str); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php 
// In order to have some dynamic CSS, we've written the below
include('core-styles.php' ); ?>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<!--This makes the iPhone/iPod touch ask for the same icon the user chooses for a logo to be the bookmark icon as well. -->
<link rel="apple-touch-icon" href="<?php echo bnc_get_title_image(); ?>" />
<?php wptouch_core_header_enqueue(); ?>
<?php wptouch_core_header_corejs(); ?>
<?php wptouch_core_header_plugin_compat(); ?>
</head>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>
<body class="<?php echo $wptouch_settings['style-background']; ?>">
<div id="menubar">
	<div  id="blogtitle">
		<!-- This fetches the admin selection logo icon for the header, which is also the bookmark icon -->
		<img src="<?php echo bnc_get_title_image(); ?>" alt="" /> <a href="<?php bloginfo('home'); ?>"><?php $str = bnc_get_header_title(); echo stripslashes($str); ?></a>
	</div>
</div>

<div id="drop-fade">
<?php if (bnc_is_login_button_enabled()) { ?>

	<?php if (!is_user_logged_in()) { ?>
		    <a href="javascript:<?php if (bnc_is_js_enabled()) echo "bnc_jquery_login_drop();"; else echo "document.getElementById('wptouch-login').style.display='block';" ?>">
					<img src="<?php bloginfo('template_directory'); ?>/images/menu/touchmenu-login.png" alt="" /> <?php _e( 'Login', 'wptouch' ); ?>
				</a>	
	<?php } else { ?>
		<?php $version = (float)get_bloginfo('version'); if ($version >= 2.7) { ?>
			<a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>">
		<?php } else { ?>
			<a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=logout&redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?>">
		<?php } ?>
			<img src="<?php bloginfo('template_directory'); ?>/images/menu/touchmenu-logout.png" alt="" /> <?php _e( 'Logout', 'wptouch' ); ?>
			</a>
	<?php } ?>

<?php } ?>

	<?php if (bnc_is_cats_button_enabled()) { ?>	
		    <a href="javascript:<?php if (bnc_is_js_enabled()) echo "bnc_jquery_cats_drop();"; else echo "document.getElementById('wptouch-cats').style.display='block';" ?>">
				<img src="<?php bloginfo('template_directory'); ?>/images/menu/catsmenu.png" alt="" /> <?php _e( 'Categories', 'wptouch' ); ?>
			</a>	
	<?php } ?>
	
		    <a href="javascript:<?php if (bnc_is_js_enabled()) echo "bnc_jquery_search_drop();"; else echo "document.getElementById('wptouch-search').style.display='block';" ?>">
		 	   <img src="<?php bloginfo('template_directory'); ?>/images/menu/search-touchmenu.png" alt="" /> <?php _e( 'Search', 'wptouch' ); ?>
			</a>

	
		    <a href="javascript:<?php if (bnc_is_js_enabled()) echo "bnc_jquery_menu_drop();"; else echo "document.getElementById('wptouch-menu').style.display='block';" ?>">
				<img src="<?php bloginfo('template_directory'); ?>/images/menu/touchmenu.png" alt="" /> <?php _e( 'Menu', 'wptouch' ); ?>
			</a>

</div>
<!--#start The Login Drop-Down -->

	<div id="wptouch-login" style="display:none">
		<div id="wptouch-login-inner">
			<form name="loginform" id="loginform" action="<?php bloginfo('wpurl'); ?>/wp-login.php" method="post">
				<label>
					<input type="text" name="log" id="log" onfocus="if (this.value == 'username') {this.value = ''}" value="username" />
				</label>
				<label>
					<input type="password" name="pwd"  onfocus="if (this.value == 'password') {this.value = ''}" id="pwd" value="password" /></label>
					<input type="hidden" name="rememberme" value="forever" />
					<input type="submit" id="logsub" name="submit" value="<?php _e('Login'); ?>" tabindex="9" />
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
				</form>
			</div>
		</div>

<!-- #start The Categories Drop-Down -->

	<div id="wptouch-cats" style="display:none">
		<div id="catsmenu-inner">
            <ul>
	   	<?php bnc_get_ordered_cat_list(); ?>
	   		<?php if (!bnc_is_js_enabled()) { ?>
           		<li class="noarrow"><a class="menu-close" href="javascript:document.getElementById('wptouch-cats').style.display = 'none';"><img src="<?php bloginfo('template_directory'); ?>/images/cross.png" alt="" /> <?php _e( "Close Menu", "wptouch" ); ?></a></li>
           	<?php } ?>

            </ul>
        </div>
	</div>

<!-- #start The Search Drop-Down -->

	<div id="wptouch-search" style="display:none">
		<div id="wptouch-search-inner">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" /> 
			<input name="submit" type="submit" id="ssubmit" tabindex="5" value="Search" />
			</form>
		</div>
	</div>

<!-- 
The Pages Drop-Down 
We're checking the pages that are enabled in the admin, and the icons which were assigned to them. 
We're also checking to see if the user has enabled the RSS< Mail, and/or Home link to be shown in the menu. 
-->
	<div id="wptouch-menu" style="display:none"> 
        <div id="wptouch-menu-inner">
            <ul>
            <?php if (bnc_is_home_enabled()) { ?>
            	<li><a href="<?php bloginfo('home'); ?>"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/icon-pool/Home.png" alt="" /><?php _e( "Home", "wptouch" ); ?></a></li> 
            <?php } ?>
            
            <?php wptouch_core_header_get_pages(); ?>
		
            <?php if (bnc_is_rss_enabled()) { ?>
           		<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/icon-pool/RSS.png" alt="" /><?php _e( "RSS Feed", "wptouch" ); ?></a></li>
           	<?php } ?>
           
           	<?php if (bnc_is_email_enabled()) { ?>
           		<li class="noborder"><a href="mailto:<?php bloginfo('admin_email'); ?>"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/icon-pool/Mail.png" alt="" /><?php _e( "E-Mail", "wptouch" ); ?></a></li>
           	<?php } ?>
           
           	<?php if (!bnc_is_js_enabled()) { ?>
           		<li class="noarrow"><a class="menu-close" href="javascript:document.getElementById('dropmenu').style.display = 'none';"><img src="<?php bloginfo('template_directory'); ?>/images/cross.png" alt="" /> <?php _e( "Close Menu", "wptouch" ); ?></a></li>
           	<?php } ?>
           </ul>
        </div>
	</div>

<!-- This just checks if the user is trying to use the theme with anything other than WPtouch, 
and if its not an iPhone/iPod touch/Android/BlackBerry Storm, kills it -->
<?php wptouch_core_header_check_use(); ?>

<!-- End of the Header -->