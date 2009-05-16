<?php 
include( dirname(__FILE__) . '/../core/core-header.php' ); 
// End WPtouch Core Header
?>

<body class="<?php wptouch_core_body_background(); ?>">
<div id="headerbar">
	<div id="headerbar-title">
		<!-- This fetches the admin selection logo icon for the header, which is also the bookmark icon -->
		<img src="<?php echo bnc_get_title_image(); ?>" alt="<?php $str = bnc_get_header_title(); echo stripslashes($str); ?>" />
		<a href="<?php bloginfo('home'); ?>"><?php wptouch_core_body_sitetitle(); ?></a>
	</div>
	<div id="headerbar-menu">
		    <a href="#" onclick="bnc_jquery_menu_drop();"></a>
	</div>
</div>

<div id="drop-fade">

	<?php if (bnc_is_cats_button_enabled()) { ?>			    
	    <a id="catsopen" href="#" onclick="bnc_jquery_cats_open();">
	    	<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/menu/wptouch-menu-cats.png" alt="" /> <?php _e( 'Categories', 'wptouch' ); ?>
	    </a>
	<?php } ?>
	
	<?php if (bnc_is_tags_button_enabled()) { ?>	
	    <a id="tagsopen" href="#" onclick="bnc_jquery_tags_open();">
	    	<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/menu/wptouch-menu-tags.png" alt="" /> <?php _e( 'Tags', 'wptouch' ); ?>
	    </a>
	<?php } ?>

	<?php if (bnc_is_login_button_enabled()) { ?>
		<?php if (!is_user_logged_in()) { ?>
			    <a id="loginopen" href="#" onclick="bnc_jquery_login_drop();">
			    	<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/menu/wptouch-menu-login.png" alt="" /> <?php _e( 'Login', 'wptouch' ); ?>
			    </a>	
	
		<?php } else { ?>
			    <a id="accountopen" href="#" onclick="bnc_jquery_acct_open();">
			    	<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/menu/wptouch-menu-acct.png" alt="" /> <?php _e( 'My Account', 'wptouch' ); ?>
			    </a>	
	<?php } } ?>
	

</div><!-- #drop-fade -->


<!-- #start The Search / Menu Drop-Down -->
	<div id="wptouch-menu" class="dropper" style="display:none"> 
 		<div id="wptouch-search-inner">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<input type="text" value="Search..." onfocus="this.value=''" onblur="this.value=''" name="s" id="s" /> 
			<input name="submit" type="hidden" tabindex="5" value="Search"  />
			</form>
		</div>
        <div id="wptouch-menu-inner">
			<ul>
				<?php wptouch_core_header_home(); ?>            
				<?php wptouch_core_header_pages(); ?>
				<?php wptouch_core_header_rss(); ?>
				<?php wptouch_core_header_email(); ?>           
			</ul>
        </div>
	</div>

<!--#start The Login Drop-Down -->
	<div id="wptouch-login" class="dropper" style="display:none">
		<div id="wptouch-login-inner">
			<form name="loginform" id="loginform" action="<?php bloginfo('wpurl'); ?>/wp-login.php" method="post">
				<label>
					<input type="text" name="log" id="log" onfocus="if (this.value == 'username') {this.value = ''}" value="username" />
				</label>
				<label>
					<input type="password" name="pwd"  onfocus="if (this.value == 'password') {this.value = ''}" id="pwd" value="password" />
				</label>
				<input type="hidden" name="rememberme" value="forever" />
				<input type="submit" id="logsub" name="submit" value="<?php _e('Login'); ?>" tabindex="9" />
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
			</form>
		</div>
	</div>
 
 <!-- #start The Categories Select List -->
	<form action="<?php bloginfo('home'); ?>/" id="select-cats" method="get">
<?php
	$select = wp_dropdown_categories('show_option_none=Select category:&show_count=1&orderby=name&echo=0');
	$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
	echo $select;
?>
	</form>

 <!-- #start The Tags Select List -->
<form id="select-tags" action="">
	<select id="tag-dropdown" name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
		<option value="">Select Tag:</option>
		<?php dropdown_tag_cloud('number=50&order=asc'); ?>
	</select>
</form>

 <!-- #start The Account Select List -->
<form id="select-acct" action="">	
	<select id="acct-dropdown" name="acct-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
	<option value="#"><?php _e("My Account:", "wptouch"); ?></option>
			<?php if (current_user_can('edit_posts')) : ?>
				<option value="<?php bloginfo('wpurl'); ?>/wp-admin/"><?php _e("Admin", "wptouch"); ?></option>
			<?php endif; ?>
			<?php if (get_option('comment_registration')) { ?>
				<option value="<?php bloginfo('wpurl'); ?>/wp-register.php"><?php _e( "Register for this site", "wptouch" ); ?></option>
			<?php } ?>
			<?php if (is_user_logged_in()) { ?>
				<option value="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php"><?php _e( "Account Profile", "wptouch" ); ?></option>
				<option value="<?php $version = (float)get_bloginfo('version'); if ($version >= 2.7) { ?><?php echo wp_logout_url($_SERVER['REQUEST_URI']); } else { bloginfo('wpurl'); ?>/wp-login.php?action=logout&redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?><?php } ?>"><?php _e( "Logout", "wptouch" ); ?></option>	
			<?php } ?>
	</select>
</form>
		
<!-- #start the wptouch plugin use check -->
<?php wptouch_core_header_check_use(); ?>