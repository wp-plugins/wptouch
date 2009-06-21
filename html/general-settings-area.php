<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "General Settings", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<h4><?php _e( "Home Page Re-Direction", "wptouch" ); ?></h4>
				<p><?php echo sprintf( __( "WPtouch uses front page you've defined in the %sWordPress &raquo; Reading Options%s.", "wptouch"), '<a href="options-reading.php">', '</a>' ); ?> <?php _e( "You can however select a unique one for WPtouch.", "wptouch" ); ?><br />

				<h4><?php _e( "Site Title", "wptouch" ); ?></h4>
				<p><?php _e( "You can shorten your site title here so it won't be truncated by WPtouch.", "wptouch" ); ?><br />

				<h4><?php _e( "Font Options", "wptouch" ); ?></h4>
				<p><?php _e( "Set the default size, paragraph and zoom for text.", "wptouch" ); ?><br />
			</div>

			<div class="wptouch-right-content">
				<p><label for="home-page"><strong><?php _e( "WPtouch Home Page", "wptouch" ); ?></strong></label></p>
				<?php $pages = bnc_get_pages_for_icons(); ?>
				<?php if ( count( $pages ) ) { ?>
					<?php wp_dropdown_pages( 'show_option_none=WordPress Settings&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
				<?php } else {?>
					<strong class="no-pages"><?php _e( "You have no pages yet. Create some first!", "wptouch" ); ?></strong>
				<?php } ?>

				<br /><br />

				<ul class="wptouch-make-li-italic">
					<li><input type="text" class="no-right-margin" name="header-title" value="<?php $str = $wptouch_settings['header-title']; echo stripslashes($str); ?>" /><?php _e( "Site title text", "wptouch" ); ?></li>
				</ul>

				<br />

				<ul class="wptouch-make-li-italic">
					<li><select name="style-text-size">
							<option <?php if ($wptouch_settings['style-text-size'] == "small-text") echo " selected"; ?> value="small-text"><?php _e( "Regular", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-size'] == "medium-text") echo " selected"; ?> value="medium-text"><?php _e( "Medium", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-size'] == "large-text") echo " selected"; ?> value="large-text"><?php _e( "Large", "wptouch" ); ?></option>
						   </select>
						   <?php _e( "Font size", "wptouch" ); ?>
					</li>
					<li><select name="style-text-justify">
							<option <?php if ($wptouch_settings['style-text-justify'] == "left-justified") echo " selected"; ?> value="left-justified"><?php _e( "Left", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-justify'] == "full-justified") echo " selected"; ?> value="full-justified"><?php _e( "Full", "wptouch" ); ?></option>
						</select>
						<?php _e( "Font justification", "wptouch" ); ?>
					</li>
					<li><select name="bnc-zoom-state">
							<option <?php if ($wptouch_settings['bnc-zoom-state'] == "auto") echo " selected"; ?> value="auto"><?php _e( "On Rotate", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['bnc-zoom-state'] == "none") echo " selected"; ?> value="none"><?php _e( "None", "wptouch" ); ?></option>
						</select>
						<?php _e( "Font zoom (accessibilty)", "wptouch" ); ?>
					</li>
				</ul>	
			</div>
			
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->