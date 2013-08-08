<?php global $wptouch_settings; ?>
<div class="metabox-holder">
	<div class="postbox" id="push-area">
		<h3><span class="push-options">&nbsp;</span><?php _e( "Push Notification Options", "wptouch" ); ?></h3>

			<div class="left-content">
					<p><?php echo sprintf(__( "Here you can configure WPtouch to push selected notifications through your %sProwl%s account to your iPhone, iPod touch and Growl-enabled Mac or PC.", "wptouch" ), '<a href="http://prowl.weks.net/" target="_blank">','</a>'); ?></p>
					<p><?php echo sprintf(__( "%sMake sure you generate a Prowl API key to use here%s otherwise no notifications will be pushed to you.", "wptouch" ), '<strong>','</strong>'); ?></p>			
			</div><!-- left content -->

			<div class="right-content">
				<ul class="wptouch-make-li-italic">
				<?php if ( function_exists( 'curl_init' ) ) { ?>
					<li>
						<input name="prowl-api" type="text" value="<?php echo $wptouch_settings['prowl-api']; ?>" /><?php _e( "Prowl API Key", "wptouch" ); ?> (<?php echo sprintf(__( "%sCreate a key now%s", "wptouch" ), '<a href="https://prowl.weks.net/settings.php" target="_blank">','</a>'); ?> - <a href="#prowl-info" class="fancylink" rel="tooltip-down" title="<?php _e( "In order to enable Prowl notifications you must create a Prowl account and download + configure the Prowl application for iPhone.", "wptouch" ); ?>">?</a>)	
							<?php if ( isset( $wptouch_settings['prowl-api'] ) && strlen( $wptouch_settings['prowl-api'] ) ) { ?>
								<?php if ( bnc_wptouch_is_prowl_key_valid() ) { ?>
									<p class="valid"><?php _e( "Your Prowl API key has been verified.", "wptouch" ); ?></p>
								<?php } else { ?>
									<p class="invalid">
										<?php _e( "Sorry, your Prowl API key is not verified.", "wptouch" ); ?><br />
										<?php _e( "Please check your key and make sure there are no spaces or extra characters.", "wptouch" ); ?>
									</p>
								<?php } ?>
							<?php } ?>		
					</li>
				</ul>
			
				<ul>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-comments-button" <?php if ( isset( $wptouch_settings['enable-prowl-comments-button']) && $wptouch_settings['enable-prowl-comments-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-comments-button"><?php _e( "Notify me of new comments &amp; pingbacks/tracksbacks", "wptouch" ); ?></label>
				</li>
				<li>
					<input class="checkbox" <?php if (!get_option('comment_registration')) : ?>disabled="true"<?php endif; ?> type="checkbox" name="enable-prowl-users-button" <?php if ( isset( $wptouch_settings['enable-prowl-users-button']) && $wptouch_settings['enable-prowl-users-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-users-button"><?php _e( "Notify me of new account registrations", "wptouch" ); ?></label>
				</li>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-message-button" <?php if ( isset( $wptouch_settings['enable-prowl-message-button']) && $wptouch_settings['enable-prowl-message-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-message-button"><?php _e( "Allow users to send me direct messages", "wptouch" ); ?></label> <a href="#dm-info" class="fancylink" rel="tooltip" title="<?php _e( "This enables a new link to a drop-down in the submenu bar for WPtouch ('Message Me').", "wptouch" ); ?>">?</a>
					</li>			
					<?php } else { ?>
					<li><strong class="no-pages"><?php echo sprintf(__( "%sCURL is required%s on your webserver to use Push capabilities in WPtouch.", "wptouch" ), '<a href="http://en.wikipedia.org/wiki/CURL" target="_blank">','</a>'); ?></strong></li>
					<?php } ?>	
				</ul>
			</div><!-- right content -->
		<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->