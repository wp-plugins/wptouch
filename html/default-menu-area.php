<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
		<h2>Default Menu Items</h2>
		
		<p>Enable/Disable these default items in the WPtouch dropdown menu.</p>
	</div>		
	
	<div class="wptouch-item-content-box1">
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-home" <?php if (isset($wptouch_settings['enable-main-home']) && $wptouch_settings['enable-main-home'] == 1) echo('checked'); ?> />
			<label for="enable-main-home">Enable Home Icon</label>
		</div>
	
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-rss" <?php if (isset($wptouch_settings['enable-main-rss']) && $wptouch_settings['enable-main-rss'] == 1) echo('checked'); ?> />
			<label for="enable-main-rss">Enable RSS Icon</label>
		</div>
	
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-email" <?php if (isset($wptouch_settings['enable-main-email']) && $wptouch_settings['enable-main-email'] == 1) echo('checked'); ?> />
			<label for="enable-main-email">Enable Email Icon</label>
		</div>
	</div>

	<div class="wptouch-clearer"></div>
</div>
