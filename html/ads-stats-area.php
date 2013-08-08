<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox new-styles" id="advertising-options">
		<h3><span class="adsense-options">&nbsp;</span><?php _e( "Advertising, Stats &amp; Custom Code", "wptouch" ); ?></h3>
		<div id="advertising-service">
			<div class="left-content">
				<h4><?php _e( 'Advertising Service', 'wptouch' ); ?></h4>
				<p><?php _e( 'Choose which advertising service you would like to use within WPtouch.', 'wptouch' ); ?></p>
			</div>
			
			<div class="right-content">
				<ul class="wptouch-make-li-italic">
					<li>
						<select name="ad_service" id="ad_service">
							<option value="none"<?php if ( $wptouch_settings['ad_service'] == 'none') echo " selected"; ?>><?php _e( "None", "wptouch" ); ?></option>		
							<option value="adsense"<?php if ( $wptouch_settings['ad_service'] == 'adsense') echo " selected"; ?>><?php _e( "Google Adsense", "wptouch" ); ?></option>
		
						</select>
						<?php _e( "Advertising Service", "wptouch" ); ?>
					</li>
				</ul>	
			</div>			
			<div class="bnc-clearer"></div>
		</div>		
		
		<div id="google-adsense">
			<div class="left-content">
				<h4><?php _e( "Google Adsense", "wptouch" ); ?></h4>
				<p><?php _e( "Enter your Google Adsense ID if you'd like use it to add support for mobile advertising in WPtouch posts.", "wptouch" ); ?></p>
				<p><?php _e( "Make sure to include the 'pub-' part of your ID string.", "wptouch" ); ?></p>
			</div>
			
			<div class="right-content">
				<ul class="wptouch-make-li-italic">
					<li><input name="adsense-id" type="text" value="<?php echo $wptouch_settings['adsense-id']; ?>" /><?php _e( "Google Adsense Publisher ID", "wptouch" ); ?></li>
					<li><input name="adsense-slot-id" type="text" value="<?php echo $wptouch_settings['adsense-slot-id']; ?>" /><?php _e( "Google Adsense Slot ID", "wptouch" ); ?></li>
				</ul>
			</div>			
			<div class="bnc-clearer"></div>
		</div>	
		
		<div id="main-stats-area">
			<div class="left-content">
		    	<h4><?php _e( "Stats &amp; Custom Code", "wptouch" ); ?></h4>
		 		<p><?php _e( "If you'd like to capture traffic statistics ", "wptouch" ); ?><br /><?php _e( "(Google Analytics, MINT, etc.)", "wptouch" ); ?> <a href="#css-info" class="fancylink" rel="tooltip" title="<?php _e( "You may enter a custom css file link easily. Simply add the full link to the css file like this:", "wptouch" ); ?>">?</a></p>
		 		<p><?php _e( "Enter the code snippet(s) for your statistics tracking.", "wptouch" ); ?> <?php _e( "You can also enter custom CSS &amp; other HTML code.", "wptouch" ); ?></p>
			</div>
			
			<div class="right-content">
				<?php if ( is_super_admin() ) { ?>
					<textarea id="wptouch-stats" name="statistics"><?php echo stripslashes($wptouch_settings['statistics']); ?></textarea>
				<?php } else { ?>
					<em><?php _e( "(Requires Super Admin priviledges)", "wptouch" ); ?></em>
				<?php } ?>
			</div>
			<div class="bnc-clearer"></div>
		</div>		
	</div><!-- postbox -->
</div><!-- metabox -->