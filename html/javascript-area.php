<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "Advanced Options", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<p><?php _e( "Choose to enable/disable advanced features &amp; options available for WPtouch.", "wptouch"); ?></p>	
				<p><strong><?php _e( "When advanced javascript is unchecked:", "wptouch" ); ?></strong></p>
					<ul>
						<li><?php _e( "Faster load on 3G/EDGE connections", "wptouch" ); ?></li>
						<li><?php _e( "Ajax / jQuery not used", "wptouch" ); ?></li>
						<li><?php _e( "May solve javascript collisions", "wptouch" ); ?></li>
					</ul>
			</div><!-- wptouch-left-content -->
	
	<div class="wptouch-right-content">
		<ul>
			<li>
				<input class="checkbox" type="checkbox" name="enable-cats-button" <?php if ( isset( $wptouch_settings['enable-cats-button']) && $wptouch_settings['enable-cats-button'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-cats-button"><?php _e( "Enable categories in the header", "wptouch" ); ?> <a href="#cats-info" class="wptouch-fancylink">?</a></label>
				<div id="cats-info" style="display:none">
					<h2><?php _e( "More Info", "wptouch" ); ?></h2>
					<p><?php _e( "This will add a categories drop-down item in the WPtouch sub header beside the Login (if also enabled), Search, and Menu link buttons.", "wptouch" ); ?><br /><br /><?php _e( "It will display your top categories, and show the number of entries they have in each.", "wptouch" ); ?></p>
				</div>
			</li>
			<li>
				<input class="checkbox" type="checkbox" name="enable-tags-button" <?php if ( isset( $wptouch_settings['enable-tags-button']) && $wptouch_settings['enable-tags-button'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-tags-button"><?php _e( "Enable tags in the header", "wptouch" ); ?> <a href="#tags-info" class="wptouch-fancylink">?</a></label>
				<div id="tags-info" style="display:none">
					<h2><?php _e( "More Info", "wptouch" ); ?></h2>
					<p><?php _e( "This will add a 'Tags' drop-down item in the WPtouch sub header beside the Categories (if also enabled), Login (if also enabled), Search, and Menu link buttons.", "wptouch" ); ?><br /><br /><?php _e( "It will display your most used tags.", "wptouch" ); ?></p>
				</div>
			</li>
			<li>
				<input class="checkbox" type="checkbox" name="enable-login-button" <?php if (isset($wptouch_settings['enable-login-button']) && $wptouch_settings['enable-login-button'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-login-button"><?php _e( "Enable login from the header", "wptouch" ); ?> <a href="#login-info" class="wptouch-fancylink">?</a></label>
				<div id="login-info" style="display:none">
					<h2><?php _e( "More Info", "wptouch" ); ?></h2>
					<p><?php _e( "This will add a login drop-down item in the WPtouch sub header beside the Categories (if also enabled), Search, and Menu link buttons.", "wptouch" ); ?></p>
					<p><?php _e( "It will display a username/password drop-down, and allows users to login + be automatically re-directed without seeing the WP admin.", "wptouch" ); ?></p>
				</div>
			</li>

			<li>
				<input class="checkbox" type="checkbox" name="enable-js-header" <?php if (isset($wptouch_settings['enable-js-header']) && $wptouch_settings['enable-js-header'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-js-header"> <?php _e( "Use advanced", "wptouch" ); ?> <a href="http://www.jquery.com/" target="_blank"><?php _e( "jQuery", "wptouch" ); ?></a> <?php _e( "effects", "wptouch" ); ?> <small>(<?php _e( "ajax entries &amp; comments", "wptouch" ); ?>)</small></label>
			</li>

			<li>
				<input class="checkbox" type="checkbox" name="enable-gravatars" <?php if (isset($wptouch_settings['enable-gravatars']) && $wptouch_settings['enable-gravatars'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-gravatars"> <?php _e( "Enable gravatars in comments", "wptouch" ); ?></label>
			</li>
			
			<li>
			<input class="checkbox" type="checkbox" name="enable-page-coms" <?php if (isset($wptouch_settings['enable-page-coms']) && $wptouch_settings['enable-page-coms'] == 1) echo('checked'); ?> />
			<label class="label" for="enable-page-coms"> <?php _e( "Enable comments on pages", "wptouch" ); ?> <a href="#page-coms-info" class="wptouch-fancylink">?</a></label>
				<div id="page-coms-info" style="display:none">
					<h2><?php _e( "More Info", "wptouch" ); ?></h2>
					<p><?php _e( "This will add the comment form to all pages with 'Allow Comments' checked in your WordPress admin.", "wptouch" ); ?></p>
				</div>
			</li>

			<li>
				<input class="checkbox" type="checkbox" name="enable-regular-default" <?php if (isset($wptouch_settings['enable-regular-default']) && $wptouch_settings['enable-regular-default'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-regular-default"><?php _e( "First-time mobile users will see regular (non-mobile) site", "wptouch" ); ?> <a href="#reg-info" class="wptouch-fancylink">?</a></label>
				<div id="reg-info" style="display:none">
					<h2><?php _e( "More Info", "wptouch" ); ?></h2>
					<p><?php _e( "When this option is checked, users will see your regular site theme first, and have the option in your footer to switch to the WPtouch mobile view. They'll be able to change back and forth either way. Make sure you have the wp_footer(); function call in your regular theme's footer.php file for the switch link to work properly.", "wptouch" ); ?></p>
				</div>
			</li>

<!-- old GZIP functionality
<input class="checkbox" type="checkbox" name="enable-gzip" <?php if (isset($wptouch_settings['enable-gzip']) && $wptouch_settings['enable-gzip'] == 1) echo('checked'); ?> />
<label class="label" for="enable-gzip"> <?php _e( "Enable GZIP compression", "wptouch" ); ?> <small>(<?php _e( "speeds up page loads, may conflict with other plugins", "wptouch" ); ?>)</small></label>
 -->				

			<li>
				<input class="checkbox" type="checkbox" name="enable-exclusive" <?php if (isset($wptouch_settings['enable-exclusive']) && $wptouch_settings['enable-exclusive'] == 1) echo('checked'); ?> />
				<label class="label" for="enable-exclusive"> <?php _e( "Enable WPtouch exclusive mode", "wptouch" ); ?> <a href="#exclusive-info" class="wptouch-fancylink">?</a></label>
					<div id="exclusive-info" style="display:none">
						<h2><?php _e( "More Info", "wptouch" ); ?></h2>
						<p><?php _e( "Disallows other plugins from loading into WPtouch. Fixes incompatibilities and speeds up WPtouch.", "wptouch" ); ?><?php _e( "Some plugins load conflicting javascript, extra CSS style sheets, and other functional code into your theme to accomplish what they add to your site. As WPtouch works complete on its own without any other plugin installed, in some cases (where you have several plugins or find something doesn't work right with WPtouch) you may want to enable Exclusive Mode to ensure that WPtouch works properly, and loads quickly for mobile users.", "wptouch" ); ?></p>
					</div>
			</li>

			</ul>
		</div><!-- right content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->