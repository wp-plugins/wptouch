<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2><?php _e( "Advanced Options", "wptouch" ); ?></h2>
		<p><?php _e( "Choose to enable/disable advanced features &amp; options available for WPtouch.", "wptouch"); ?></p>
	
		<p><strong><?php _e( "When advanced javascript is unchecked:", "wptouch" ); ?></strong>
			<ul class="wptouch-small-menu">
				<li><?php _e( "Site is faster on 3G/EDGE connections", "wptouch" ); ?></li>
				<li><?php _e( "Ajax &amp; jQuery are not used for comments, entries, excerpts", "wptouch" ); ?></li>
				<li><?php _e( "May solve javascript collisions where WPtouch features don't work", "wptouch" ); ?></li>
			</ul>
		</p>
	</div>
	
	<div class="wptouch-item-content-box1">
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-cats-button" <?php if ( isset( $wptouch_settings['enable-cats-button']) && $wptouch_settings['enable-cats-button'] == 1) echo('checked'); ?> />
			<label for="enable-cats-button"> <?php _e( "Enable categories in the header", "wptouch" ); ?> (<small><?php _e( "will add a categories button beside search &amp; menu buttons", "wptouch" ); ?>)</small></label>
		</div>
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-login-button" <?php if (isset($wptouch_settings['enable-login-button']) && $wptouch_settings['enable-login-button'] == 1) echo('checked'); ?> />
			<label for="enable-login-button"> <?php _e( "Enable login from the header", "wptouch" ); ?> <small>(<?php _e( "will add a login button beside search &amp; menu buttons", "wptouch" ); ?>)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-js-header" <?php if (isset($wptouch_settings['enable-js-header']) && $wptouch_settings['enable-js-header'] == 1) echo('checked'); ?> />
			<label for="enable-js-header"> <?php _e( "Use advanced", "wptouch" ); ?> <a href="http://www.jquery.com/" target="_blank"><?php _e( "jQuery", "wptouch" ); ?></a> <?php _e( "effects", "wptouch" ); ?> <small>(<?php _e( "ajax entries &amp; comments", "wptouch" ); ?>)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-gravatars" <?php if (isset($wptouch_settings['enable-gravatars']) && $wptouch_settings['enable-gravatars'] == 1) echo('checked'); ?> />
			<label for="enable-gravatars"> <?php _e( "Enable gravatars in comments", "wptouch" ); ?></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-page-coms" <?php if (isset($wptouch_settings['enable-page-coms']) && $wptouch_settings['enable-page-coms'] == 1) echo('checked'); ?> />
			<label for="enable-page-coms"> <?php _e( "Enable comments on pages", "wptouch" ); ?> <small>(<?php _e( "will add the comment form to pages with 'Allow Comments' checked in the WordPress admin", "wptouch" ); ?>)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-regular-default" <?php if (isset($wptouch_settings['enable-regular-default']) && $wptouch_settings['enable-regular-default'] == 1) echo('checked'); ?> />
			<label for="enable-regular-default"> <?php _e( "First-time mobile users will see regular (non-mobile) site", "wptouch" ); ?></label>
		</div>			
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-gzip" <?php if (isset($wptouch_settings['enable-gzip']) && $wptouch_settings['enable-gzip'] == 1) echo('checked'); ?> />
			<label for="enable-gzip"> <?php _e( "Enable GZIP compression", "wptouch" ); ?> <small>(<?php _e( "speeds up page loads, may conflict with other plugins", "wptouch" ); ?>)</small></label>
		</div>			
	</div>
	<div class="wptouch-clearer"></div>
</div>