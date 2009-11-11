<?php if (bnc_is_login_button_enabled()) { ?>
	<?php if (!is_user_logged_in()) { ?>
		    <a id="loginopen" class="top" href="#" onclick="bnc_jquery_login_toggle(); return false;"><?php _e( 'Login', 'wptouch' ); ?></a>	
	<?php } else { ?>
		    <a id="accountopen" class="top" href="#" onclick="bnc_jquery_acct_open(); return false;"><?php _e( 'Account', 'wptouch' ); ?></a>	
	<?php } ?>
<?php } ?>

	<?php if (wptouch_prowl_direct_message_enabled()) { ?>			    
    	<a id="prowlopen" class="top" href="#" onclick="bnc_jquery_prowl_open(); return false;"><?php _e( 'Message', 'wptouch' ); ?></a>
	<?php } ?>

	<?php if (bnc_is_cats_button_enabled()) { ?>			    
    	<a id="catsopen" class="top" href="#" onclick="bnc_jquery_cats_open(); return false;"><?php _e( 'Categories', 'wptouch' ); ?></a>
	<?php } ?>

	<?php if (bnc_is_tags_button_enabled()) { ?>	
    	<a id="tagsopen" class="top" href="#" onclick="bnc_jquery_tags_open(); return false;"><?php _e( 'Tags', 'wptouch' ); ?></a>
	<?php } ?>

	<?php // if (wptouch_wordtwit_enabled()) { ?>			    
    	<a id="wordtwitopen" class="top" href="#" onclick="bnc_jquery_wordtwit_open(); return false;"><?php _e( 'Twitter', 'wptouch' ); ?></a>
	<?php //} ?>

 <!-- #start the Prowl Message Area -->
 <div id="prowl-message" style="display:none">
 	 <div id="prowl-style-bar"></div><!-- filler to get the styling just right -->
	 <img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/push-icon.png" alt="push icon" />
	 <h4><?php _e( 'Send a Message', 'wptouch' ); ?></h4>
	 <p><?php _e( 'This message will be pushed to the admin\'s iPhone instantly.', 'wptouch' ); ?></p>
	 
	 <form id="prowl-direct-message" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	 	<p>
	 		<input name="prowl-msg-name"  id="prowl-msg-name" type="text" />
	 		<label for="prowl-msg-name"><?php _e( 'Name', 'wptouch' ); ?></label>
	 	</p>

		<p>
			<input name="prowl-msg-email" id="prowl-msg-email" type="text" />
			<label for="prowl-msg-email"><?php _e( 'E-Mail', 'wptouch' ); ?></label>
		</p>

		<textarea name="prowl-msg-message"></textarea>
		<input type="hidden" name="wptouch-prowl-message" value="1" /> 
		<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce( 'wptouch-prowl' ); ?>" />			
		<input type="submit" name="prowl-submit" value="<?php _e('Send Now', 'wptouch' ); ?>" id="prowl-submit" />
	 </form>
	<div class="clearer"></div>
 </div>

 <!-- #start the Categories Select List -->
	<form action="<?php bloginfo('home'); ?>/" id="select-cats" method="get">
<?php
	$select = wp_dropdown_categories('show_option_none=Select category:&show_count=1&orderby=name&echo=0');
	$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
	echo $select;
?>
	</form>

 <!-- #start the Tags Select List -->
<form id="select-tags" action="">
	<select id="tag-dropdown" name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
		<option value="">Select Tag:</option>
		<?php dropdown_tag_cloud('number=50&order=asc'); ?>
	</select>
</form>

 <!-- #start the Account Select List -->
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
			<?php } // End fancy iPhone stuff ?>
	</select>
</form>

 <!-- #start the WordTwit Twitter Integration -->
	<div id="wptouch-wordtwit" class="dropper" style="display:none">
            <div id="wordtwit-avatar">
            	<img src="http://a1.twimg.com/profile_images/359969318/3717943096_00752017f6-1_normal.jpg" alt="Twitter Avatar" />
            		<p class="twitter_username">duanestorey</p>
            		<p><a href="http://twitter.com/duanestorey">Follow me on Twitter</a></p>
            </div>
            <ul id="tweets">
	  	 	<li>awesome, just picked up the phone and called myself...<p class="time">29 minutes ago</p></li>
	  	 	<li>@jennmae just stay by the airport, it's too much of a pain to head downtown..<p class="time">about 1 hour ago</p></li>
	  	 	<li>someone set up an 'official' wptouch twitter feed last week. thankfully twitter shut them down for us..<p class="time">about 5 hours ago</p></li>
	  	 	<li>going out for some soup...<p class="time">about 5 hours ago</p></li>
            </ul>
	</div>