<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox" id="push-area">
		<h3><?php _e( "Push Notifications Options", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
					<p><?php echo sprintf(__( "Here you can configure WPtouch to push selected notifications through your %sProwl%s account to your iPhone, iPod touch and Growl enabled Mac.", "wptouch" ), '<a href="http://prowl.weks.net/" target="_blank">','</a>'); ?></p>
					<p><?php echo sprintf(__( "%sMake sure you generate a Prowl API key%s and enter it on the right otherwise no notifications will be pushed to you.", "wptouch" ), '<strong>','</strong>'); ?></p>
			</div><!-- left content -->

			<div class="wptouch-right-content">
				<ul class="wptouch-make-li-italic">
					<li>
						<input name="prowl-api" type="text" value="<?php echo $wptouch_settings['prowl-api']; ?>" /><?php _e( "Prowl API Key", "wptouch" ); ?> (<?php echo sprintf(__( "%sCreate a key now%s", "wptouch" ), '<a href="https://prowl.weks.net/settings.php" target="_blank">','</a>'); ?> - <a href="#prowl-info" class="wptouch-fancylink">?</a>)
						<div id="prowl-info" style="display:none">
							<h2><?php _e( "More Info", "wptouch" ); ?></h2>
							<p><?php _e( "In order to enable Prowl notifications you have to create a Prowl account and download and configure the Prowl application for iPhone.", "wptouch" ); ?></p>
							<p><?php _e( "Once you have done this you can visit the Prowl web account settings and generate an API key which we will use securely to connect with Prowl and send your notifications.", "wptouch" ); ?></p>
							<p><?php echo sprintf(__( "%sVisit the Prowl web admin%s", "wptouch" ), '<a href="http://prowl.weks.net/settings.php" target="_blank">','</a>'); ?> | <?php echo sprintf(__( "%sVisit iTunes and Download Prowl%s", "wptouch" ), '<a href="http://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=320876271&amp;mt=8" target="_blank">','</a>'); ?></p>
						</div>
					</li>
					<li><select name="prowl-maximum">
							<option <?php if ($wptouch_settings['prowl-maximum'] == "five") echo " selected"; ?> value="five"><?php _e( "5", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['prowl-maximum'] == "ten") echo " selected"; ?> value="ten"><?php _e( "10", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['prowl-maximum'] == "twenty") echo " selected"; ?> value="twenty"><?php _e( "20", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['prowl-maximum'] == "fifty") echo " selected"; ?> value="fifty"><?php _e( "50", "wptouch" ); ?></option>
						   </select>
						   <?php _e( "Maximum notifications per hour", "wptouch" ); ?></li>
				</ul>
			
				<ul>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-comments-button" <?php if ( isset( $wptouch_settings['enable-prowl-comments-button']) && $wptouch_settings['enable-prowl-comments-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-comments-button"><?php _e( "Notify me of new comments", "wptouch" ); ?></label>
				</li>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-users-button" <?php if ( isset( $wptouch_settings['enable-prowl-users-button']) && $wptouch_settings['enable-prowl-users-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-users-button"><?php _e( "Notify me of new account registrations", "wptouch" ); ?></label>
				</li>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-message-button" <?php if ( isset( $wptouch_settings['enable-prowl-message-button']) && $wptouch_settings['enable-prowl-message-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-message-button"><?php _e( "Allow users to send me direct messages", "wptouch" ); ?></label>
				</li>				</ul>
			</div><!-- right content -->
		<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->