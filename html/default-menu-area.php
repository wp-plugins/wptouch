<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3 class='hndle'><span><?php _e( "Default Menu Items", "wptouch" ); ?></span></h3>
			<div class="wptouch-left-content">
				<p><?php _e( "Enable/Disable these default items in the WPtouch dropdown menu.", "wptouch"); ?></p>
			</div>		

			<div class="wptouch-right-content">
				<ul>
					<li><input type="checkbox" class="checkbox" name="enable-main-home" <?php if (isset($wptouch_settings['enable-main-home']) && $wptouch_settings['enable-main-home'] == 1) echo('checked'); ?> /><label for="enable-main-home"><?php _e( "Enable Home Icon", "wptouch" ); ?></label></li>
					<li><input type="checkbox" class="checkbox" name="enable-main-rss" <?php if (isset($wptouch_settings['enable-main-rss']) && $wptouch_settings['enable-main-rss'] == 1) echo('checked'); ?> /><label for="enable-main-rss"><?php _e( "Enable RSS Icon", "wptouch" ); ?></label></li>
					<li><input type="checkbox" class="checkbox" name="enable-main-email" <?php if (isset($wptouch_settings['enable-main-email']) && $wptouch_settings['enable-main-email'] == 1) echo('checked'); ?> /><label for="enable-main-email"><?php _e( "Enable Email Icon", "wptouch" ); ?></label></li>
				</ul>
			</div><!-- wptouch-right-content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->