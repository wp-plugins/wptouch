<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><span class="adsense-options"></span><?php _e( "Adsense, Stats &amp; Custom Code", "wptouch" ); ?></h3>

			<div class="left-content">
				<h4><?php _e( "Adsense", "wptouch" ); ?></h4>
					<p><?php _e( "Enter your Google AdSense ID if you'd like to support mobile advertising in WPtouch posts.", "wptouch" ); ?></p>
					<p><?php _e( "Make sure to include the 'pub-' part of your ID string.", "wptouch" ); ?></p>
				<br />
			    <h4><?php _e( "Stats &amp; Custom Code", "wptouch" ); ?></h4>
			 		<p><?php _e( "If you'd like to capture traffic statistics ", "wptouch" ); ?><br /><?php _e( "(Google Analytics, MINT, etc.)", "wptouch" ); ?></p>
			 		<p><?php _e( "Enter the code snippet(s) for your statistics tracking here.", "wptouch" ); ?></p>
			 		<p><?php _e( "You can also enter custom CSS &amp; other code here.", "wptouch" ); ?></p>
			 	<br />
			 		<h4><?php _e( "Custom User-Agents", "wptouch" ); ?></h4>
			 		<p><?php _e( "Enter a comma-separated list of user-agents here if you'd like to enable WPtouch for a device that isn't currently supported.", "wptouch" ); ?></p>
			 		<p><?php echo sprintf( __( "The currently enabled user-agents are <em>%s</em>", "wptouch" ), implode( ", ", bnc_wptouch_get_user_agents() ) ); ?></p>
			</div><!-- left content -->

			<div class="right-content">
				<ul class="wptouch-make-li-italic">
					<li><input name="adsense-id" type="text" value="<?php echo $wptouch_settings['adsense-id']; ?>" /><?php _e( "Google AdSense ID", "wptouch" ); ?></li>
					<li><input name="adsense-channel" type="text" value="<?php echo $wptouch_settings['adsense-channel']; ?>" /><?php _e( "Google AdSense Channel", "wptouch" ); ?></li>
				</ul>
			
				<textarea id="wptouch-stats" name="statistics"><?php echo stripslashes($wptouch_settings['statistics']); ?></textarea>
				
				<br /><br /><br />
				<ul class="wptouch-make-li-italic">
					<li><input type="text" name="custom-user-agents" value="<?php if ( isset( $wptouch_settings['custom-user-agents'] ) ) echo implode( ', ', $wptouch_settings['custom-user-agents'] ); ?>" /><?php _e( "Custom user-agents", "wptouch" ); ?></li>
				</ul>
			</div><!-- right content -->
		<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->