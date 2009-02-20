<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Advanced Options</h2>
		<p>Choose to enable/disable advanced features &amp; options available for WPtouch.</p>
	
		<p><strong>When advanced javascript is unchecked:</strong>
			<ul class="wptouch-small-menu">
				<li>Site is faster on 3G/EDGE connections</li>
				<li>Ajax &amp; jQuery are not used for comments, entries, excerpts</li>
				<li>May solve javascript collisions where WPtouch features don't work</li>
			</ul>
		</p>
	</div>
	
	<div class="wptouch-item-content-box1">
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-cats-button" <?php if ( isset( $wptouch_settings['enable-cats-button']) && $wptouch_settings['enable-cats-button'] == 1) echo('checked'); ?> />
			<label for="enable-cats-button"> Enable Categories In The Header <small>(will add a categories button beside search &amp; menu buttons)</small></label>
		</div>
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-login-button" <?php if (isset($wptouch_settings['enable-login-button']) && $wptouch_settings['enable-login-button'] == 1) echo('checked'); ?> />
			<label for="enable-login-button"> Enable Login From The Header <small>(will add a login button beside search &amp; menu buttons)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-js-header" <?php if (isset($wptouch_settings['enable-js-header']) && $wptouch_settings['enable-js-header'] == 1) echo('checked'); ?> />
			<label for="enable-js-header"> Use Advanced <a href="http://www.jquery.com/" target="_blank">jQuery</a> Javascript Effects<small>(ajax entries &amp; comments)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-gravatars" <?php if (isset($wptouch_settings['enable-gravatars']) && $wptouch_settings['enable-gravatars'] == 1) echo('checked'); ?> />
			<label for="enable-gravatars"> Enable Gravatars in Comments</label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-page-coms" <?php if (isset($wptouch_settings['enable-page-coms']) && $wptouch_settings['enable-page-coms'] == 1) echo('checked'); ?> />
			<label for="enable-page-coms"> Enable Comments For Pages <small>(will add the comment form to <strong>all</strong> pages by default)</small></label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-regular-default" <?php if (isset($wptouch_settings['enable-regular-default']) && $wptouch_settings['enable-regular-default'] == 1) echo('checked'); ?> />
			<label for="enable-regular-default"> First-time mobile users will see regular (non-mobile) site</label>
		</div>			
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-gzip" <?php if (isset($wptouch_settings['enable-gzip']) && $wptouch_settings['enable-gzip'] == 1) echo('checked'); ?> />
			<label for="enable-gzip"> Enable GZIP compression <small>(speeds up page loads, may conflict with other plugins)</small></label>
		</div>			
	</div>
	<div class="wptouch-clearer"></div>
</div>

