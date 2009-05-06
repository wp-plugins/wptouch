<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3 class='hndle'><span><?php _e( "Post Listings Options", "wptouch" ); ?></span></h3>

		<div class="wptouch-left-content">
			<p> <?php _e( "Select which post-meta items are shown under titles on post, search, &amp; archives pages. Also, choose if excerpts are shown/hidden (default is hidden).", "wptouch" ); ?></p>
		</div>
	
	<div class="wptouch-right-content">		
		<ul>
			<li>
				<input type="checkbox" class="checkbox" name="enable-main-name" <?php if (isset($wptouch_settings['enable-main-name']) && $wptouch_settings['enable-main-name'] == 1) echo('checked'); ?> />
				<label for="enable-authorname"> <?php _e( "Show Author's Name", "wptouch" ); ?></label>
			</li>			
			<li>
				<input type="checkbox" class="checkbox" name="enable-main-categories" <?php if (isset($wptouch_settings['enable-main-categories']) && $wptouch_settings['enable-main-categories'] == 1) echo('checked'); ?> />
				<label for="enable-categories"> <?php _e( "Show Categories", "wptouch" ); ?></label>
			</li>			
			<li>
				<input type="checkbox" class="checkbox" name="enable-main-tags" <?php if (isset($wptouch_settings['enable-main-tags']) && $wptouch_settings['enable-main-tags'] == 1) echo('checked'); ?> />
				<label for="enable-tags"> <?php _e( "Show Tags", "wptouch" ); ?></label>
			</li>			
			<li>
				<input type="checkbox" class="checkbox" name="enable-post-excerpts" <?php if (isset($wptouch_settings['enable-post-excerpts']) && $wptouch_settings['enable-post-excerpts'] == 1) echo('checked'); ?> />
				<label for="enable-excerpts"><?php _e( "Hide Excerpts", "wptouch" ); ?></label>
			</li>
		</ul>	
	</div><!-- wptouch-right-content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->