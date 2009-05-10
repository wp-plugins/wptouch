<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "The Drop Down Menu", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<h4>Pages/Bookmark Icon</h4>
				<p><?php _e( "Choose the logo displayed in the header (also your bookmark icon), and the pages you want included in the WPtouch drop-down menu.", "wptouch" ); ?> 						<strong><?php _e( "Remember, only those checked will be shown.", "wptouch" ); ?></strong></p>
				<p><?php _e( "Next, select the icons from the drop lists that you want to pair with each page/menu item.", "wptouch" ); ?></p>
				<p><?php _e( "Lastly, you can decide if pages are listed by the page order in WordPress, or by name (default).", "wptouch" ); ?></p>
				
				<h4>Default Items</h4>
				<p><?php _e( "Enable/Disable these default items in the WPtouch dropdown menu.", "wptouch"); ?></p>
			</div><!-- wptouch-left-content -->
		
	<div class="wptouch-right-content wptouch-pages">
		<ul>
			<li><select name="sort-order">
					<option value="name"<?php if ( $wptouch_settings['sort-order'] == 'name') echo " selected"; ?>><?php _e( "By Name", "wptouch" ); ?></option>
					<option value="page"<?php if ( $wptouch_settings['sort-order'] == 'page') echo " selected"; ?>><?php _e( "By Page ID", "wptouch" ); ?></option>
				</select>
				<?php _e( "Menu List Sort Order", "wptouch" ); ?>
			</li>
			<li><select name="enable_main_title">
					<?php bnc_get_icon_drop_down_list( $wptouch_settings['main_title']); ?>
				</select>
				<?php _e( "Logo &amp; Home Screen Bookmark Icon", "wptouch" ); ?>
			</li>
			<?php $pages = bnc_get_pages_for_icons(); ?>
			<?php foreach ( $pages as $page ) { ?>
			<li><span>
					<input class="checkbox" type="checkbox" name="enable_<?php echo $page->ID; ?>"<?php if ( isset( $wptouch_settings[$page->ID] ) ) echo " checked"; ?> />
					<label class="wptouch-page-label" for="enable_<?php echo $page->ID; ?>"><?php echo $page->post_title; ?> Page</label>
				</span>
				<select class="page-select" name="icon_<?php echo $page->ID; ?>">
					<?php bnc_get_icon_drop_down_list( $wptouch_settings[ $page->ID ]); ?>
				</select>
			</li>
		<?php } ?>
		</ul>
		<h4><?php _e( "Default Menu Items", "wptouch" ); ?></h4>
		<ul>
			<li><input type="checkbox" class="checkbox" name="enable-main-home" <?php if (isset($wptouch_settings['enable-main-home']) && $wptouch_settings['enable-main-home'] == 1) echo('checked'); ?> /><label for="enable-main-home"><?php _e( "Enable Home Link", "wptouch" ); ?></label></li>
			<li><input type="checkbox" class="checkbox" name="enable-main-rss" <?php if (isset($wptouch_settings['enable-main-rss']) && $wptouch_settings['enable-main-rss'] == 1) echo('checked'); ?> /><label for="enable-main-rss"><?php _e( "Enable RSS Link", "wptouch" ); ?></label></li>
			<li><input type="checkbox" class="checkbox" name="enable-main-email" <?php if (isset($wptouch_settings['enable-main-email']) && $wptouch_settings['enable-main-email'] == 1) echo('checked'); ?> /><label for="enable-main-email"><?php _e( "Enable Email Link", "wptouch" ); ?> <small>(<?php _e( "Uses default WordPress admin e-mail", "wptouch" ); ?>)</small></label></li>
		</ul>
	</div><!-- wptouch-right-content -->		
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->