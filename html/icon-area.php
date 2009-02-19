<?php require_once( ABSPATH . '/wp-content/plugins/wptouch/include/icons.php' ); ?>
<?php global $wptouch_settings; ?>

<div class="wptouch-select-row">
	<div class="wptouch-select-left">
		<?php _e( "Logo &amp; Home Screen Bookmark Icon", "wptouch"); ?>
	</div>
	<div class="wptouch-select-right">
		<select name="enable_main_title">
			<?php bnc_get_icon_drop_down_list( $wptouch_settings['main_title']); ?>
		</select>
	</div>
</div>

<?php $pages = bnc_get_pages_for_icons(); ?>
<?php foreach ( $pages as $page ) { ?>
<div class="wptouch-select-row">
	<div class="wptouch-select-left">
		<input type="checkbox" name="enable_<?php echo $page->ID; ?>"<?php if ( isset( $wptouch_settings[$page->ID] ) ) echo " checked"; ?> />
		<label for="enable_<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></label>
	</div>
	<div class="wptouch-select-right">
		<select name="icon_<?php echo $page->ID; ?>">
			<?php bnc_get_icon_drop_down_list( $wptouch_settings[ $page->ID ]); ?>
		</select>
	</div>
</div>
<?php } ?>
<div class="wptouch-select-row" id="pages-sort-order">
	<div class="wptouch-select-left">	
		<?php _e( "Sort Order", "wptouch" ); ?>
	</div>
	<div class="wptouch-select-right">
		<select name="sort-order">
			<option value="name"<?php if ( $wptouch_settings['sort-order'] == 'name') echo " selected"; ?>><?php _e( "Name", "wptouch" ); ?></option>
			<option value="page"<?php if ( $wptouch_settings['sort-order'] == 'page') echo " selected"; ?>><?php _e( "Page", "wptouch" ); ?></option>
		</select>
	</div>
</div>


