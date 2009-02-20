<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
		<h2>Post Listings Options</h2>
		<p>	Select which post-meta items are shown under titles on post, search, &amp; archives pages. Also, choose if excerpts are shown/hidden (default is hidden).</p>
	</div>
	
	<div class="wptouch-item-content-box1">		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-name" <?php if (isset($wptouch_settings['enable-main-name']) && $wptouch_settings['enable-main-name'] == 1) echo('checked'); ?>>
			<label for="enable-authorname"> Show Author's Name</label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-categories" <?php if (isset($wptouch_settings['enable-main-categories']) && $wptouch_settings['enable-main-categories'] == 1) echo('checked'); ?>>
			<label for="enable-categories"> Show Categories</label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-main-tags" <?php if (isset($wptouch_settings['enable-main-tags']) && $wptouch_settings['enable-main-tags'] == 1) echo('checked'); ?>>
			<label for="enable-tags"> Show Tags</label>
		</div>
		
		<div class="wptouch-checkbox-row">
			<input type="checkbox" name="enable-post-excerpts" <?php if (isset($wptouch_settings['enable-post-excerpts']) && $wptouch_settings['enable-post-excerpts'] == 1) echo('checked'); ?>>
			<label for="enable-excerpts">Hide Excerpts (if unchecked the excerpts will be shown, and the drop arrows will be hidden)</label>
		</div>
	</div>
	
	<div class="wptouch-clearer"></div>	
</div>